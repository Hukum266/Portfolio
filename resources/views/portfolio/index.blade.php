@extends('layouts.app')

@section('content')

{{-- ═══════════════════════════════════════════════════════════════════
     SECTION 1 — HERO
════════════════════════════════════════════════════════════════════ --}}
<section id="home"
         class="min-h-screen flex items-center px-6 lg:px-14 py-20 lg:py-0
                bg-[var(--color-surface)]">
    <div class="w-full max-w-6xl mx-auto">
        <div class="flex flex-col-reverse lg:flex-row items-center gap-12">

            {{-- Text block --}}
            <div class="flex-1 fade-in-up">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold tracking-widest uppercase
                             bg-[var(--color-accent-light)] text-[var(--color-accent)] mb-4">
                    {{ $profile->hero_intro }}
                </span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-[var(--color-text)] leading-tight mb-4">
                    {{ $profile->hero_heading }}
                </h1>
                <p class="text-[var(--color-text-muted)] text-lg max-w-lg mb-8 leading-relaxed">
                    {{ $profile->hero_description }}
                </p>
                <div class="flex flex-wrap gap-4 mb-12">
                    <a href="#portfolio" class="btn-accent" onclick="scrollToSection('portfolio')">
                        <i class="fas fa-eye"></i> View Portfolio
                    </a>
                    @if($profile->cv_file)
                    <a href="{{ Storage::url($profile->cv_file) }}" target="_blank" class="btn-outline">
                        <i class="fas fa-download"></i> View Resume
                    </a>
                    @else
                    <a href="#resume" class="btn-outline" onclick="scrollToSection('resume')">
                        <i class="fas fa-file-alt"></i> View Resume
                    </a>
                    @endif
                </div>

                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-6">
                    @foreach($stats as $stat)
                    <div class="text-center">
                        <div class="text-3xl font-extrabold text-[var(--color-accent)]">
                            <span class="counter" data-target="{{ $stat->value }}" data-suffix="{{ $stat->suffix }}">0</span>
                        </div>
                        <p class="text-xs text-[var(--color-text-muted)] mt-1">{{ $stat->label }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Profile image --}}
            <div class="flex-shrink-0 fade-in-up" style="animation-delay:.15s">
                <div class="relative p-4">
                    <div class="w-56 h-56 sm:w-72 sm:h-72 rounded-full overflow-hidden
                                ring-8 ring-[var(--color-accent)]/30 relative z-10">
                        @if($profile->hero_image)
                            <img src="{{ $profile->heroImageUrl() }}"
                                 alt="{{ $profile->full_name }}"
                                 class="w-full h-full object-cover" loading="lazy" />
                        @elseif($profile->profile_image)
                            <img src="{{ $profile->profileImageUrl() }}"
                                 alt="{{ $profile->full_name }}"
                                 class="w-full h-full object-cover" loading="lazy" />
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[var(--color-accent)] to-green-700
                                        flex items-center justify-center text-white text-6xl font-bold">
                                {{ strtoupper(substr($profile->full_name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    {{-- Decorative ring — contained within padding so it never bleeds outside --}}
                    <div class="absolute inset-0 rounded-full border-2 border-dashed border-[var(--color-accent)]/40 animate-spin"
                         style="animation-duration:12s"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════
     SECTION 2 — ABOUT
════════════════════════════════════════════════════════════════════ --}}
<section id="about" class="py-20 px-6 lg:px-14 bg-[var(--color-surface-alt)]">
    <div class="max-w-6xl mx-auto">
        <h2 class="section-heading">About Me</h2>
        <div class="grid lg:grid-cols-2 gap-12 items-start">

            {{-- Left: image --}}
            <div>
                <div class="rounded-2xl overflow-hidden aspect-square max-w-sm mx-auto lg:mx-0
                            ring-1 ring-[var(--color-border)]">
                    @if($profile->profile_image)
                        <img src="{{ $profile->profileImageUrl() }}"
                             alt="{{ $profile->full_name }}"
                             class="w-full h-full object-cover" loading="lazy" />
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-[var(--color-accent)] to-green-700
                                    flex items-center justify-center text-white text-7xl font-bold">
                            {{ strtoupper(substr($profile->full_name, 0, 1)) }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right: bio + info + skills --}}
            <div>
                <p class="text-[var(--color-text-muted)] leading-relaxed mb-6">
                    {{ $profile->biography ?? $profile->short_bio }}
                </p>

                {{-- Personal info grid --}}
                <div class="grid grid-cols-2 gap-3 mb-8 text-sm">
                    @if($profile->email)
                    <div class="flex items-center gap-2 text-[var(--color-text-muted)]">
                        <i class="fas fa-envelope text-[var(--color-accent)] w-4"></i>
                        <span>{{ $profile->email }}</span>
                    </div>
                    @endif
                    @if($profile->phone)
                    <div class="flex items-center gap-2 text-[var(--color-text-muted)]">
                        <i class="fas fa-phone text-[var(--color-accent)] w-4"></i>
                        <span>{{ $profile->phone }}</span>
                    </div>
                    @endif
                    @if($profile->location)
                    <div class="flex items-center gap-2 text-[var(--color-text-muted)]">
                        <i class="fas fa-map-marker-alt text-[var(--color-accent)] w-4"></i>
                        <span>{{ $profile->location }}</span>
                    </div>
                    @endif
                    @if($profile->website)
                    <div class="flex items-center gap-2 text-[var(--color-text-muted)]">
                        <i class="fas fa-globe text-[var(--color-accent)] w-4"></i>
                        <a href="{{ $profile->website }}" target="_blank"
                           class="hover:text-[var(--color-accent)] transition-colors">
                            {{ $profile->website }}
                        </a>
                    </div>
                    @endif
                </div>

                {{-- Skills --}}
                <h3 class="font-semibold text-[var(--color-text)] mb-4">Technical Skills</h3>
                <div class="space-y-3">
                    @foreach($skills->where('is_active', true)->take(8) as $skill)
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-[var(--color-text)] font-medium">{{ $skill->name }}</span>
                            <span class="text-[var(--color-text-muted)]">{{ $skill->percentage }}%</span>
                        </div>
                        <div class="skill-bar">
                            <div class="skill-bar-fill" style="width: {{ $skill->percentage }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($profile->cv_file)
                <a href="{{ Storage::url($profile->cv_file) }}" target="_blank" class="btn-accent mt-6">
                    <i class="fas fa-download"></i> Download CV
                </a>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════
     SECTION 3 — PORTFOLIO
════════════════════════════════════════════════════════════════════ --}}
<section id="portfolio" class="py-20 px-6 lg:px-14 bg-[var(--color-surface)]">
    <div class="max-w-6xl mx-auto">
        <h2 class="section-heading">Portfolio</h2>

        {{-- Filter buttons --}}
        <div class="flex flex-wrap gap-2 mb-8">
            <button class="filter-btn active" data-filter="all">All</button>
            @foreach($categories as $cat)
            <button class="filter-btn" data-filter="{{ $cat->slug }}">
                {{ $cat->name }}
            </button>
            @endforeach
        </div>

        {{-- Project grid --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($projects as $project)
            <article class="project-card card group cursor-pointer"
                     data-category="{{ $project->category?->slug ?? 'uncategorized' }}">
                {{-- Thumbnail --}}
                <div class="rounded-lg overflow-hidden aspect-video mb-4 bg-[var(--color-surface-alt)]">
                    @if($project->thumbnail)
                        <img src="{{ Storage::url($project->thumbnail) }}"
                             alt="{{ $project->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             loading="lazy" />
                    @else
                        <div class="w-full h-full flex items-center justify-center text-[var(--color-text-muted)]">
                            <i class="fas fa-code text-4xl"></i>
                        </div>
                    @endif
                </div>

                {{-- Category badge --}}
                @if($project->category)
                <span class="inline-block px-2 py-0.5 text-xs font-medium rounded-full
                             bg-[var(--color-accent-light)] text-[var(--color-accent)] mb-2">
                    {{ $project->category->name }}
                </span>
                @endif

                <h3 class="font-bold text-[var(--color-text)] mb-2">{{ $project->title }}</h3>
                <p class="text-sm text-[var(--color-text-muted)] mb-4 line-clamp-2">{{ $project->description }}</p>

                {{-- Technologies --}}
                @if($project->technologies)
                <div class="flex flex-wrap gap-1 mb-4">
                    @foreach($project->technologies_array as $tech)
                    <span class="px-2 py-0.5 text-xs rounded bg-[var(--color-surface-alt)]
                                 text-[var(--color-text-muted)] border border-[var(--color-border)]">
                        {{ $tech }}
                    </span>
                    @endforeach
                </div>
                @endif

                {{-- Links --}}
                <div class="flex gap-3 pt-2 border-t border-[var(--color-border)]">
                    @if($project->live_url && $project->live_url !== '#')
                    <a href="{{ $project->live_url }}" target="_blank" rel="noopener"
                       class="text-sm text-[var(--color-accent)] hover:underline flex items-center gap-1">
                        <i class="fas fa-external-link-alt text-xs"></i> Live
                    </a>
                    @endif
                    @if($project->github_url && $project->github_url !== '#')
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener"
                       class="text-sm text-[var(--color-text-muted)] hover:text-[var(--color-accent)] flex items-center gap-1 transition-colors">
                        <i class="fab fa-github text-xs"></i> Code
                    </a>
                    @endif
                </div>
            </article>
            @empty
            <p class="col-span-3 text-center text-[var(--color-text-muted)] py-12">No projects added yet.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════
     SECTION 4 — SERVICES
════════════════════════════════════════════════════════════════════ --}}
<section id="services" class="py-20 px-6 lg:px-14 bg-[var(--color-surface-alt)]">
    <div class="max-w-6xl mx-auto">
        <h2 class="section-heading">Services</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($services as $service)
            <div class="card text-center group">
                <div class="w-14 h-14 mx-auto mb-4 rounded-xl flex items-center justify-center
                            bg-[var(--color-accent-light)] text-[var(--color-accent)] text-2xl
                            group-hover:bg-[var(--color-accent)] group-hover:text-white transition-all duration-300">
                    <i class="{{ $service->icon }}"></i>
                </div>
                <h3 class="font-bold text-[var(--color-text)] mb-2">{{ $service->title }}</h3>
                <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">{{ $service->description }}</p>
            </div>
            @empty
            <p class="col-span-3 text-center text-[var(--color-text-muted)] py-12">No services added yet.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════
     SECTION 5 — RESUME
════════════════════════════════════════════════════════════════════ --}}
<section id="resume" class="py-20 px-6 lg:px-14 bg-[var(--color-surface)]">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-10 flex-wrap gap-4">
            <h2 class="section-heading mb-0">Resume</h2>
            @if($profile->cv_file)
            <a href="{{ Storage::url($profile->cv_file) }}" target="_blank" class="btn-accent">
                <i class="fas fa-download"></i> Download CV
            </a>
            @endif
        </div>

        <div class="grid lg:grid-cols-2 gap-12">

            {{-- Experience --}}
            <div>
                <h3 class="text-lg font-bold text-[var(--color-text)] mb-6 flex items-center gap-2">
                    <i class="fas fa-briefcase text-[var(--color-accent)]"></i> Work Experience
                </h3>
                <div class="relative pl-6 border-l-2 border-[var(--color-border)] space-y-8">
                    @forelse($experiences as $exp)
                    <div class="relative">
                        <div class="absolute -left-[1.65rem] top-1 w-3 h-3 rounded-full
                                    bg-[var(--color-accent)] ring-4 ring-[var(--color-surface)]"></div>
                        <span class="inline-block text-xs font-semibold text-[var(--color-accent)] mb-1">
                            {{ $exp->period }}
                        </span>
                        <h4 class="font-bold text-[var(--color-text)]">{{ $exp->job_title }}</h4>
                        <p class="text-sm text-[var(--color-text-muted)] mb-2">
                            {{ $exp->company }}@if($exp->location) · {{ $exp->location }}@endif
                        </p>
                        @if($exp->description)
                        <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">{{ $exp->description }}</p>
                        @endif
                    </div>
                    @empty
                    <p class="text-[var(--color-text-muted)] text-sm">No experience added yet.</p>
                    @endforelse
                </div>
            </div>

            {{-- Education --}}
            <div>
                <h3 class="text-lg font-bold text-[var(--color-text)] mb-6 flex items-center gap-2">
                    <i class="fas fa-graduation-cap text-[var(--color-accent)]"></i> Education
                </h3>
                <div class="relative pl-6 border-l-2 border-[var(--color-border)] space-y-8">
                    @forelse($educations as $edu)
                    <div class="relative">
                        <div class="absolute -left-[1.65rem] top-1 w-3 h-3 rounded-full
                                    bg-[var(--color-accent)] ring-4 ring-[var(--color-surface)]"></div>
                        <span class="inline-block text-xs font-semibold text-[var(--color-accent)] mb-1">
                            {{ $edu->period }}
                        </span>
                        <h4 class="font-bold text-[var(--color-text)]">{{ $edu->degree }}</h4>
                        <p class="text-sm text-[var(--color-text-muted)] mb-2">
                            {{ $edu->institution }}@if($edu->location) · {{ $edu->location }}@endif
                        </p>
                        @if($edu->field_of_study)
                        <p class="text-xs text-[var(--color-text-muted)]">{{ $edu->field_of_study }}</p>
                        @endif
                    </div>
                    @empty
                    <p class="text-[var(--color-text-muted)] text-sm">No education added yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Certifications --}}
        @if($certs->isNotEmpty())
        <div class="mt-14">
            <h3 class="text-lg font-bold text-[var(--color-text)] mb-6 flex items-center gap-2">
                <i class="fas fa-certificate text-[var(--color-accent)]"></i> Certifications
            </h3>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($certs as $cert)
                <div class="card flex items-start gap-4">
                    <div class="w-10 h-10 rounded-lg bg-[var(--color-accent-light)] flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-award text-[var(--color-accent)]"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-[var(--color-text)] text-sm">{{ $cert->title }}</h4>
                        <p class="text-xs text-[var(--color-text-muted)]">{{ $cert->issuer }}</p>
                        @if($cert->issued_date)
                        <p class="text-xs text-[var(--color-text-muted)]">{{ $cert->issued_date->format('M Y') }}</p>
                        @endif
                        @if($cert->credential_url)
                        <a href="{{ $cert->credential_url }}" target="_blank"
                           class="text-xs text-[var(--color-accent)] hover:underline mt-1 inline-block">
                            View Credential →
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════
     SECTION 6 — PRODUCTS
════════════════════════════════════════════════════════════════════ --}}
<section id="products" class="py-20 px-6 lg:px-14 bg-[var(--color-surface-alt)]">
    <div class="max-w-6xl mx-auto">
        <h2 class="section-heading">Products</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($products as $product)
            <div class="card flex flex-col">
                <div class="rounded-lg overflow-hidden aspect-video mb-4 bg-[var(--color-surface)]">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover" loading="lazy" />
                    @else
                        <div class="w-full h-full flex items-center justify-center text-[var(--color-text-muted)]">
                            <i class="fas fa-box text-4xl"></i>
                        </div>
                    @endif
                </div>

                {{-- Status badge --}}
                <span class="inline-block self-start px-2 py-0.5 text-xs font-semibold rounded-full mb-2
                    @if($product->status === 'available') bg-green-100 text-green-700
                    @elseif($product->status === 'coming_soon') bg-yellow-100 text-yellow-700
                    @else bg-red-100 text-red-600 @endif">
                    {{ str_replace('_', ' ', ucfirst($product->status)) }}
                </span>

                <h3 class="font-bold text-[var(--color-text)] mb-2">{{ $product->name }}</h3>
                <p class="text-sm text-[var(--color-text-muted)] leading-relaxed mb-4 flex-1">
                    {{ $product->description }}
                </p>

                <div class="flex items-center justify-between pt-3 border-t border-[var(--color-border)]">
                    <span class="text-lg font-bold text-[var(--color-accent)]">
                        {{ $product->price ? '$' . number_format($product->price, 2) : 'Free' }}
                    </span>
                    @if($product->product_url && $product->product_url !== '#')
                    <a href="{{ $product->product_url }}" target="_blank" class="btn-accent text-sm py-2 px-4">
                        Get It
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <p class="col-span-3 text-center text-[var(--color-text-muted)] py-12">No products added yet.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════
     SECTION 7 — BLOG
════════════════════════════════════════════════════════════════════ --}}
<section id="blog" class="py-20 px-6 lg:px-14 bg-[var(--color-surface)]">
    <div class="max-w-6xl mx-auto">
        <h2 class="section-heading">Blog</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($posts as $post)
            <article class="card flex flex-col group">
                <a href="{{ route('blog.show', $post->slug) }}" class="block rounded-lg overflow-hidden aspect-video mb-4 bg-[var(--color-surface-alt)]">
                    @if($post->thumbnail)
                        <img src="{{ Storage::url($post->thumbnail) }}"
                             alt="{{ $post->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             loading="lazy" />
                    @else
                        <div class="w-full h-full flex items-center justify-center text-[var(--color-text-muted)]">
                            <i class="fas fa-newspaper text-4xl"></i>
                        </div>
                    @endif
                </a>

                <div class="flex items-center gap-3 text-xs text-[var(--color-text-muted)] mb-3">
                    @if($post->category)
                    <span class="px-2 py-0.5 rounded-full bg-[var(--color-accent-light)] text-[var(--color-accent)] font-medium">
                        {{ $post->category->name }}
                    </span>
                    @endif
                    <span>{{ $post->published_at?->format('M d, Y') }}</span>
                </div>

                <h3 class="font-bold text-[var(--color-text)] mb-2 flex-1">
                    <a href="{{ route('blog.show', $post->slug) }}"
                       class="hover:text-[var(--color-accent)] transition-colors line-clamp-2">
                        {{ $post->title }}
                    </a>
                </h3>

                @if($post->excerpt)
                <p class="text-sm text-[var(--color-text-muted)] mb-4 line-clamp-3">{{ $post->excerpt }}</p>
                @endif

                <a href="{{ route('blog.show', $post->slug) }}"
                   class="text-sm font-semibold text-[var(--color-accent)] hover:underline flex items-center gap-1 mt-auto">
                    Read More <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </article>
            @empty
            <p class="col-span-3 text-center text-[var(--color-text-muted)] py-12">No blog posts published yet.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════
     SECTION 8 — CONTACT
════════════════════════════════════════════════════════════════════ --}}
<section id="contact" class="py-20 px-6 lg:px-14 bg-[var(--color-surface-alt)]">
    <div class="max-w-6xl mx-auto">
        <h2 class="section-heading">Contact</h2>
        <div class="grid lg:grid-cols-2 gap-12">

            {{-- Contact info --}}
            <div>
                <p class="text-[var(--color-text-muted)] mb-8 leading-relaxed">
                    Have a project in mind or want to work together? Feel free to reach out. I'm always open to discussing new opportunities.
                </p>

                <div class="space-y-5">
                    @if($profile->email)
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-[var(--color-accent-light)] flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-[var(--color-accent)]"></i>
                        </div>
                        <div>
                            <p class="text-xs text-[var(--color-text-muted)]">Email</p>
                            <a href="mailto:{{ $profile->email }}" class="font-medium text-[var(--color-text)] hover:text-[var(--color-accent)] transition-colors">
                                {{ $profile->email }}
                            </a>
                        </div>
                    </div>
                    @endif

                    @if($profile->phone)
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-[var(--color-accent-light)] flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-[var(--color-accent)]"></i>
                        </div>
                        <div>
                            <p class="text-xs text-[var(--color-text-muted)]">Phone</p>
                            <a href="tel:{{ $profile->phone }}" class="font-medium text-[var(--color-text)]">{{ $profile->phone }}</a>
                        </div>
                    </div>
                    @endif

                    @if($profile->location)
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-[var(--color-accent-light)] flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-[var(--color-accent)]"></i>
                        </div>
                        <div>
                            <p class="text-xs text-[var(--color-text-muted)]">Location</p>
                            <p class="font-medium text-[var(--color-text)]">{{ $profile->location }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Social links --}}
                <div class="flex gap-3 mt-8">
                    @foreach($socials as $social)
                    <a href="{{ $social->url }}" target="_blank" rel="noopener"
                       title="{{ $social->platform }}"
                       class="w-10 h-10 flex items-center justify-center rounded-full border border-[var(--color-border)]
                              text-[var(--color-text-muted)] hover:bg-[var(--color-accent)] hover:border-[var(--color-accent)]
                              hover:text-white transition-all">
                        <i class="{{ $social->icon }} text-sm"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Contact form --}}
            <div>
                <form id="contact-form"
                      action="{{ route('contact.send') }}"
                      method="POST"
                      class="space-y-4">
                    @csrf
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-[var(--color-text)] mb-1">Name *</label>
                            <input type="text" name="name" placeholder="Your Name"
                                   class="w-full px-4 py-3 rounded-lg border border-[var(--color-border)]
                                          bg-[var(--color-surface)] text-[var(--color-text)]
                                          focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)]
                                          placeholder:text-[var(--color-text-muted)] transition" required />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[var(--color-text)] mb-1">Email *</label>
                            <input type="email" name="email" placeholder="Your Email"
                                   class="w-full px-4 py-3 rounded-lg border border-[var(--color-border)]
                                          bg-[var(--color-surface)] text-[var(--color-text)]
                                          focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)]
                                          placeholder:text-[var(--color-text-muted)] transition" required />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[var(--color-text)] mb-1">Subject *</label>
                        <input type="text" name="subject" placeholder="Subject"
                               class="w-full px-4 py-3 rounded-lg border border-[var(--color-border)]
                                      bg-[var(--color-surface)] text-[var(--color-text)]
                                      focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)]
                                      placeholder:text-[var(--color-text-muted)] transition" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[var(--color-text)] mb-1">Message *</label>
                        <textarea name="message" rows="5" placeholder="Your message..."
                                  class="w-full px-4 py-3 rounded-lg border border-[var(--color-border)]
                                         bg-[var(--color-surface)] text-[var(--color-text)]
                                         focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)]
                                         placeholder:text-[var(--color-text-muted)] transition resize-none" required></textarea>
                    </div>
                    <button type="submit" class="btn-accent w-full justify-center">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                    <div id="form-status" class="mt-2 text-sm font-medium"></div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
function scrollToSection(id) {
    event.preventDefault();
    document.getElementById(id)?.scrollIntoView({ behavior: 'smooth' });
}
</script>

@endsection
