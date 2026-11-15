<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ProfileSetting;
use App\Models\SiteStatistic;
use App\Models\SocialLink;
use App\Models\Skill;
use App\Models\Service;
use App\Models\ProjectCategory;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Certification;
use App\Models\Product;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /* ── Admin user ──────────────────────────────────────────── */
        $user = User::firstOrCreate(
            ['email' => 'admin@hukumroka.com'],
            [
                'name'     => 'Hukum Roka',
                'password' => Hash::make('password'),
            ]
        );

        /* ── Profile ─────────────────────────────────────────────── */
        ProfileSetting::firstOrCreate([], [
            'full_name'          => 'Hukum Roka',
            'professional_title' => 'Web Developer | Graphics Designer',
            'short_bio'          => 'Passionate freelance web developer and graphics designer crafting modern, responsive digital experiences.',
            'biography'          => 'I am Hukum Roka, a passionate web developer and graphics designer with hands-on experience building modern, high-performance web applications. I specialize in full-stack development using PHP, Laravel, JavaScript, and modern CSS frameworks. I enjoy turning complex problems into simple, beautiful, and intuitive designs.',
            'email'              => 'hukumroka@example.com',
            'phone'              => '+977 98XXXXXXXX',
            'location'           => 'Nepal',
            'hero_intro'         => "HI I'M A FREELANCER",
            'hero_heading'       => 'Web Developer',
            'hero_description'   => 'I build clean, fast, and responsive websites and web applications. Available for freelance projects.',
            'accent_color'       => '#22c55e',
            'site_title'         => 'Hukum Roka – Web Developer & Designer',
            'meta_description'   => 'Portfolio of Hukum Roka – Freelance Web Developer and Graphics Designer based in Nepal.',
        ]);

        /* ── Statistics ──────────────────────────────────────────── */
        $stats = [
            ['label' => 'Years of Experience', 'value' => '3',  'suffix' => '+', 'icon' => 'fas fa-calendar-alt', 'sort_order' => 1],
            ['label' => 'Projects Completed',  'value' => '30', 'suffix' => '+', 'icon' => 'fas fa-briefcase',    'sort_order' => 2],
            ['label' => 'Clients Worldwide',   'value' => '20', 'suffix' => '+', 'icon' => 'fas fa-globe',        'sort_order' => 3],
        ];
        foreach ($stats as $stat) {
            SiteStatistic::firstOrCreate(['label' => $stat['label']], $stat);
        }

        /* ── Social Links ────────────────────────────────────────── */
        $socials = [
            ['platform' => 'Facebook',  'url' => 'https://facebook.com/',  'icon' => 'fab fa-facebook-f',  'sort_order' => 1],
            ['platform' => 'GitHub',    'url' => 'https://github.com/',    'icon' => 'fab fa-github',      'sort_order' => 2],
            ['platform' => 'Twitter',   'url' => 'https://twitter.com/',   'icon' => 'fab fa-x-twitter',   'sort_order' => 3],
            ['platform' => 'LinkedIn',  'url' => 'https://linkedin.com/',  'icon' => 'fab fa-linkedin-in', 'sort_order' => 4],
        ];
        foreach ($socials as $social) {
            SocialLink::firstOrCreate(['platform' => $social['platform']], $social);
        }

        /* ── Skills ──────────────────────────────────────────────── */
        $skills = [
            ['name' => 'HTML & CSS',       'percentage' => 95, 'category' => 'Frontend'],
            ['name' => 'JavaScript',        'percentage' => 85, 'category' => 'Frontend'],
            ['name' => 'PHP & Laravel',     'percentage' => 88, 'category' => 'Backend'],
            ['name' => 'MySQL',             'percentage' => 82, 'category' => 'Backend'],
            ['name' => 'React.js',          'percentage' => 70, 'category' => 'Frontend'],
            ['name' => 'Tailwind CSS',      'percentage' => 92, 'category' => 'Frontend'],
            ['name' => 'Adobe Photoshop',   'percentage' => 80, 'category' => 'Design'],
            ['name' => 'Adobe Illustrator', 'percentage' => 75, 'category' => 'Design'],
            ['name' => 'Git & GitHub',      'percentage' => 85, 'category' => 'Tools'],
            ['name' => 'WordPress',         'percentage' => 78, 'category' => 'CMS'],
        ];
        foreach ($skills as $i => $skill) {
            Skill::firstOrCreate(['name' => $skill['name']], array_merge($skill, ['sort_order' => $i + 1]));
        }

        /* ── Services ────────────────────────────────────────────── */
        $services = [
            ['title' => 'Web Development',           'description' => 'Building robust, scalable web applications using modern frameworks like Laravel and React.',       'icon' => 'fas fa-code',           'sort_order' => 1],
            ['title' => 'Frontend Development',      'description' => 'Crafting beautiful, responsive user interfaces with HTML, CSS, Tailwind, and JavaScript.',         'icon' => 'fas fa-laptop-code',    'sort_order' => 2],
            ['title' => 'Backend Development',       'description' => 'Developing powerful server-side logic, REST APIs, and database architecture with PHP & Laravel.',  'icon' => 'fas fa-server',         'sort_order' => 3],
            ['title' => 'Graphics Design',           'description' => 'Creating stunning visuals, logos, branding materials, and UI designs using Adobe tools.',          'icon' => 'fas fa-paint-brush',    'sort_order' => 4],
            ['title' => 'Responsive Website Design', 'description' => 'Ensuring your website looks and works perfectly on all devices – desktop, tablet, and mobile.',   'icon' => 'fas fa-mobile-alt',     'sort_order' => 5],
            ['title' => 'Website Maintenance',       'description' => 'Keeping your website secure, up-to-date, and running smoothly with regular maintenance.',          'icon' => 'fas fa-tools',          'sort_order' => 6],
        ];
        foreach ($services as $service) {
            Service::firstOrCreate(['title' => $service['title']], $service);
        }

        /* ── Project Categories ──────────────────────────────────── */
        $categories = [
            ['name' => 'Web Development', 'slug' => 'web-development'],
            ['name' => 'Design',          'slug' => 'design'],
            ['name' => 'Full Stack',      'slug' => 'full-stack'],
            ['name' => 'WordPress',       'slug' => 'wordpress'],
        ];
        foreach ($categories as $cat) {
            ProjectCategory::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        $webCat  = ProjectCategory::where('slug', 'web-development')->first();
        $fullCat = ProjectCategory::where('slug', 'full-stack')->first();

        /* ── Projects ────────────────────────────────────────────── */
        $projects = [
            [
                'title'               => 'Personal Portfolio Website',
                'slug'                => 'personal-portfolio-website',
                'description'         => 'A modern, responsive personal portfolio built with Laravel MVC, Tailwind CSS, and MySQL.',
                'technologies'        => 'Laravel, MySQL, Tailwind CSS, Alpine.js',
                'live_url'            => '#',
                'github_url'          => '#',
                'is_featured'         => true,
                'project_category_id' => $fullCat->id,
            ],
            [
                'title'               => 'E-Commerce Platform',
                'slug'                => 'ecommerce-platform',
                'description'         => 'Full-featured e-commerce web application with product management, cart, and payment integration.',
                'technologies'        => 'Laravel, MySQL, Tailwind CSS, Stripe',
                'live_url'            => '#',
                'github_url'          => '#',
                'is_featured'         => true,
                'project_category_id' => $fullCat->id,
            ],
            [
                'title'               => 'Restaurant Management System',
                'slug'                => 'restaurant-management-system',
                'description'         => 'Web-based restaurant management system with order tracking, menu management, and reporting.',
                'technologies'        => 'PHP, MySQL, Bootstrap, jQuery',
                'live_url'            => '#',
                'github_url'          => '#',
                'is_featured'         => false,
                'project_category_id' => $webCat->id,
            ],
            [
                'title'               => 'Task Management App',
                'slug'                => 'task-management-app',
                'description'         => 'A collaborative task management application with real-time updates and team features.',
                'technologies'        => 'Laravel, Vue.js, MySQL, Pusher',
                'live_url'            => '#',
                'github_url'          => '#',
                'is_featured'         => false,
                'project_category_id' => $fullCat->id,
            ],
        ];
        foreach ($projects as $project) {
            Project::firstOrCreate(['slug' => $project['slug']], $project);
        }

        /* ── Experience ──────────────────────────────────────────── */
        $experiences = [
            [
                'job_title'   => 'Freelance Web Developer',
                'company'     => 'Self-Employed',
                'location'    => 'Nepal (Remote)',
                'start_date'  => '2022-01-01',
                'is_current'  => true,
                'description' => 'Building custom websites and web applications for clients worldwide. Specializing in Laravel, PHP, and modern frontend frameworks.',
                'sort_order'  => 1,
            ],
            [
                'job_title'   => 'Web Developer Intern',
                'company'     => 'Tech Company Nepal',
                'location'    => 'Kathmandu, Nepal',
                'start_date'  => '2021-06-01',
                'end_date'    => '2021-12-31',
                'is_current'  => false,
                'description' => 'Developed and maintained web applications. Worked with PHP, MySQL, and JavaScript on client projects.',
                'sort_order'  => 2,
            ],
        ];
        foreach ($experiences as $exp) {
            Experience::firstOrCreate(['job_title' => $exp['job_title'], 'company' => $exp['company']], $exp);
        }

        /* ── Education ───────────────────────────────────────────── */
        $educations = [
            [
                'degree'         => 'Bachelor in Computer Science',
                'institution'    => 'Tribhuvan University',
                'location'       => 'Nepal',
                'field_of_study' => 'Computer Science & Information Technology',
                'start_year'     => 2018,
                'end_year'       => 2022,
                'is_current'     => false,
                'description'    => 'Studied programming, algorithms, database management, and software engineering.',
                'sort_order'     => 1,
            ],
            [
                'degree'         => '+2 Science',
                'institution'    => 'Higher Secondary School',
                'location'       => 'Nepal',
                'field_of_study' => 'Science (Physics, Chemistry, Mathematics)',
                'start_year'     => 2016,
                'end_year'       => 2018,
                'is_current'     => false,
                'sort_order'     => 2,
            ],
        ];
        foreach ($educations as $edu) {
            Education::firstOrCreate(['degree' => $edu['degree'], 'institution' => $edu['institution']], $edu);
        }

        /* ── Certifications ──────────────────────────────────────── */
        $certs = [
            ['title' => 'Laravel Certified Developer',    'issuer' => 'Laravel',  'issued_date' => '2023-01-01', 'sort_order' => 1],
            ['title' => 'Web Development Bootcamp',       'issuer' => 'Udemy',    'issued_date' => '2022-06-01', 'sort_order' => 2],
            ['title' => 'JavaScript Algorithms',          'issuer' => 'freeCodeCamp', 'issued_date' => '2022-03-01', 'sort_order' => 3],
        ];
        foreach ($certs as $cert) {
            Certification::firstOrCreate(['title' => $cert['title']], $cert);
        }

        /* ── Products ────────────────────────────────────────────── */
        $products = [
            [
                'name'        => 'Portfolio Pro Template',
                'slug'        => 'portfolio-pro-template',
                'description' => 'A professional, fully responsive portfolio template built with Tailwind CSS and Alpine.js.',
                'price'       => 29.00,
                'product_url' => '#',
                'status'      => 'available',
            ],
            [
                'name'        => 'Laravel Starter Kit',
                'slug'        => 'laravel-starter-kit',
                'description' => 'A complete Laravel 12 starter kit with authentication, admin panel, and common features pre-built.',
                'price'       => 49.00,
                'product_url' => '#',
                'status'      => 'available',
            ],
            [
                'name'        => 'UI Component Library',
                'slug'        => 'ui-component-library',
                'description' => 'A comprehensive collection of Tailwind CSS components ready to use in any project.',
                'price'       => 19.00,
                'product_url' => '#',
                'status'      => 'coming_soon',
            ],
        ];
        foreach ($products as $product) {
            Product::firstOrCreate(['slug' => $product['slug']], $product);
        }

        /* ── Blog Categories ─────────────────────────────────────── */
        $blogCats = [
            ['name' => 'Web Development', 'slug' => 'web-development'],
            ['name' => 'Laravel',         'slug' => 'laravel'],
            ['name' => 'Design',          'slug' => 'design'],
            ['name' => 'Tutorial',        'slug' => 'tutorial'],
        ];
        foreach ($blogCats as $bc) {
            BlogCategory::firstOrCreate(['slug' => $bc['slug']], $bc);
        }

        $laravelCat = BlogCategory::where('slug', 'laravel')->first();
        $webDevCat  = BlogCategory::where('slug', 'web-development')->first();

        /* ── Blog Posts ──────────────────────────────────────────── */
        $posts = [
            [
                'title'            => 'Getting Started with Laravel 12',
                'slug'             => 'getting-started-with-laravel-12',
                'excerpt'          => 'Laravel 12 brings exciting new features and improvements. Learn how to set up your first project.',
                'content'          => '<p>Laravel 12 is the latest major version of the popular PHP framework. It introduces several improvements to developer experience, performance, and tooling.</p><h2>Installation</h2><p>You can create a new Laravel 12 project using Composer...</p>',
                'is_published'     => true,
                'published_at'     => now()->subDays(5),
                'blog_category_id' => $laravelCat->id,
                'user_id'          => $user->id,
            ],
            [
                'title'            => 'Tailwind CSS v4: What\'s New',
                'slug'             => 'tailwind-css-v4-whats-new',
                'excerpt'          => 'Tailwind CSS v4 introduces a new engine and significant performance improvements. Here\'s everything you need to know.',
                'content'          => '<p>Tailwind CSS v4 represents a complete rewrite of the framework with a new engine called Oxide. The new version brings faster build times and new features.</p>',
                'is_published'     => true,
                'published_at'     => now()->subDays(10),
                'blog_category_id' => $webDevCat->id,
                'user_id'          => $user->id,
            ],
            [
                'title'            => 'Building a REST API with Laravel',
                'slug'             => 'building-rest-api-with-laravel',
                'excerpt'          => 'A step-by-step guide to building a production-ready REST API using Laravel and best practices.',
                'content'          => '<p>REST APIs are the backbone of modern web applications. Laravel makes it easy to build robust, well-structured APIs...</p>',
                'is_published'     => true,
                'published_at'     => now()->subDays(15),
                'blog_category_id' => $laravelCat->id,
                'user_id'          => $user->id,
            ],
        ];
        foreach ($posts as $post) {
            BlogPost::firstOrCreate(['slug' => $post['slug']], $post);
        }
    }
}
