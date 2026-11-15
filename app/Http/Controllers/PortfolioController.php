<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Certification;
use App\Models\ContactMessage;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Product;
use App\Models\ProfileSetting;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Models\Skill;
use App\Models\SiteStatistic;
use App\Models\SocialLink;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /* -------------------------------------------------------------- */
    /*  Shared data every page needs                                   */
    /* -------------------------------------------------------------- */
    private function shared(): array
    {
        return [
            'profile' => ProfileSetting::getSingleton(),
            'socials' => SocialLink::where('is_active', true)->orderBy('sort_order')->get(),
        ];
    }

    /* -------------------------------------------------------------- */
    /*  Home                                                           */
    /* -------------------------------------------------------------- */
    public function home(): View
    {
        $shared = $this->shared();
        $stats  = SiteStatistic::where('is_active', true)->orderBy('sort_order')->get();

        return view('portfolio.home', array_merge($shared, [
            'stats'      => $stats,
            'activePage' => 'home',
        ]));
    }

    /* -------------------------------------------------------------- */
    /*  About                                                          */
    /* -------------------------------------------------------------- */
    public function about(): View
    {
        $shared = $this->shared();
        $skills = Skill::where('is_active', true)->orderBy('sort_order')->get();

        return view('portfolio.about', array_merge($shared, [
            'skills'     => $skills,
            'activePage' => 'about',
        ]));
    }

    /* -------------------------------------------------------------- */
    /*  Portfolio                                                      */
    /* -------------------------------------------------------------- */
    public function portfolio(): View
    {
        $shared     = $this->shared();
        $categories = ProjectCategory::withCount([
            'projects' => fn ($q) => $q->where('is_active', true),
        ])->get();
        $projects   = Project::with('category')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('portfolio.portfolio', array_merge($shared, [
            'categories' => $categories,
            'projects'   => $projects,
            'activePage' => 'portfolio',
        ]));
    }

    /* -------------------------------------------------------------- */
    /*  Services                                                       */
    /* -------------------------------------------------------------- */
    public function services(): View
    {
        $shared   = $this->shared();
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();

        return view('portfolio.services', array_merge($shared, [
            'services'   => $services,
            'activePage' => 'services',
        ]));
    }

    /* -------------------------------------------------------------- */
    /*  Resume                                                         */
    /* -------------------------------------------------------------- */
    public function resume(): View
    {
        $shared      = $this->shared();
        $experiences = Experience::orderBy('sort_order')->get();
        $educations  = Education::orderBy('sort_order')->get();
        $skills      = Skill::where('is_active', true)->orderBy('sort_order')->get();
        $certs       = Certification::where('is_active', true)->orderBy('sort_order')->get();

        return view('portfolio.resume', array_merge($shared, [
            'experiences' => $experiences,
            'educations'  => $educations,
            'skills'      => $skills,
            'certs'       => $certs,
            'activePage'  => 'resume',
        ]));
    }

    /* -------------------------------------------------------------- */
    /*  Products                                                       */
    /* -------------------------------------------------------------- */
    public function products(): View
    {
        $shared   = $this->shared();
        $products = Product::where('is_active', true)->orderBy('sort_order')->get();

        return view('portfolio.products', array_merge($shared, [
            'products'   => $products,
            'activePage' => 'products',
        ]));
    }

    /* -------------------------------------------------------------- */
    /*  Blog listing                                                   */
    /* -------------------------------------------------------------- */
    public function blog(): View
    {
        $shared = $this->shared();
        $posts  = BlogPost::with(['category', 'author'])
            ->published()
            ->latest('published_at')
            ->paginate(9);

        return view('portfolio.blog', array_merge($shared, [
            'posts'      => $posts,
            'activePage' => 'blog',
        ]));
    }

    /* -------------------------------------------------------------- */
    /*  Blog detail                                                    */
    /* -------------------------------------------------------------- */
    public function blogShow(string $slug): View
    {
        $shared = $this->shared();
        $post   = BlogPost::with(['category', 'author'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();
        $recent = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('portfolio.blog-show', array_merge($shared, [
            'post'       => $post,
            'recent'     => $recent,
            'activePage' => 'blog',
        ]));
    }

    /* -------------------------------------------------------------- */
    /*  Contact page                                                   */
    /* -------------------------------------------------------------- */
    public function contact(): View
    {
        $shared = $this->shared();

        return view('portfolio.contact', array_merge($shared, [
            'activePage' => 'contact',
        ]));
    }

    /* -------------------------------------------------------------- */
    /*  Contact form submit (POST)                                     */
    /* -------------------------------------------------------------- */
    public function contactSend(ContactRequest $request): JsonResponse
    {
        ContactMessage::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'subject'    => $request->subject,
            'message'    => $request->message,
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'message' => 'Your message has been sent successfully! I will get back to you soon.',
        ]);
    }
}
