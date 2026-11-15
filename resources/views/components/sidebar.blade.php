@php
    $activePage = $activePage ?? '';
    $nav = [
        ['route' => 'home',      'icon' => 'fas fa-house',       'label' => 'Home'],
        ['route' => 'about',     'icon' => 'fas fa-user',         'label' => 'About Me'],
        ['route' => 'portfolio', 'icon' => 'fas fa-briefcase',    'label' => 'Portfolio'],
        ['route' => 'services',  'icon' => 'fas fa-cogs',         'label' => 'Service'],
        ['route' => 'resume',    'icon' => 'fas fa-file-alt',     'label' => 'Resume'],
        ['route' => 'products',  'icon' => 'fas fa-shopping-bag', 'label' => 'Products'],
        ['route' => 'blog',      'icon' => 'fas fa-blog',         'label' => 'Blog'],
        ['route' => 'contact',   'icon' => 'fas fa-envelope',     'label' => 'Contact'],
    ];
@endphp

<aside id="sidebar"
       class="fixed top-0 left-0 z-50 h-screen w-[280px] flex flex-col
              bg-[var(--color-sidebar-bg)] border-r border-[var(--color-sidebar-border)]
              -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto">

    {{-- ── Top bar ─────────────────────────────────────────────────── --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-[var(--color-border)]">
        <a href="{{ route('home') }}"
           class="flex items-center gap-2 text-[var(--color-accent)] font-bold hover:opacity-80 transition-opacity">
            <i class="fas fa-home text-lg"></i>
            <span class="text-sm">Home</span>
        </a>
        <button id="theme-toggle-desktop"
                onclick="toggleTheme()"
                class="hidden lg:flex w-9 h-9 items-center justify-center rounded-full
                       bg-[var(--color-surface-alt)] text-[var(--color-text-muted)]
                       hover:text-[var(--color-accent)] transition-colors"
                aria-label="Toggle theme">
            <i class="theme-icon fas fa-moon text-sm"></i>
        </button>
    </div>

    {{-- ── Profile ─────────────────────────────────────────────────── --}}
    <div class="flex flex-col items-center px-5 py-6 border-b border-[var(--color-border)]">
        <a href="{{ route('home') }}" class="block">
            <div class="w-24 h-24 rounded-full overflow-hidden ring-4 ring-[var(--color-accent)] mb-3 mx-auto">
                @if($profile->profile_image)
                    <img src="{{ Storage::url($profile->profile_image) }}"
                         alt="{{ $profile->full_name }}"
                         class="w-full h-full object-cover" loading="lazy" />
                @else
                    <div class="w-full h-full bg-[var(--color-accent)] flex items-center justify-center text-white text-3xl font-bold">
                        {{ strtoupper(substr($profile->full_name, 0, 1)) }}
                    </div>
                @endif
            </div>
        </a>
        <h2 class="text-base font-bold text-[var(--color-text)] text-center">{{ $profile->full_name }}</h2>
        <p class="text-xs text-[var(--color-text-muted)] text-center mt-1 leading-snug">
            {{ $profile->professional_title }}
        </p>

        {{-- Social links --}}
        <div class="flex items-center gap-2 mt-4 flex-wrap justify-center">
            @foreach($socials as $social)
            <a href="{{ $social->url }}"
               target="_blank" rel="noopener noreferrer"
               title="{{ $social->platform }}"
               class="w-8 h-8 flex items-center justify-center rounded-full
                      bg-[var(--color-surface-alt)] text-[var(--color-text-muted)]
                      hover:bg-[var(--color-accent)] hover:text-white transition-all text-xs">
                <i class="{{ $social->icon }}"></i>
            </a>
            @endforeach
        </div>
    </div>

    {{-- ── Navigation ──────────────────────────────────────────────── --}}
    <nav class="flex-1 px-4 py-4 space-y-1">
        @foreach($nav as $item)
        @php $isActive = $activePage === $item['route']; @endphp
        <a href="{{ route($item['route']) }}"
           class="nav-link {{ $isActive ? 'active' : '' }}">
            <i class="{{ $item['icon'] }} w-4 text-center"></i>
            <span>{{ $item['label'] }}</span>
            @if($isActive)
            <span class="ml-auto w-1.5 h-1.5 rounded-full bg-[var(--color-accent)]"></span>
            @endif
        </a>
        @endforeach
    </nav>

    {{-- ── Footer ──────────────────────────────────────────────────── --}}
    <div class="px-5 py-4 border-t border-[var(--color-border)] text-center">
        <p class="text-xs text-[var(--color-text-muted)]">
            &copy; {{ date('Y') }} {{ $profile->full_name }}
        </p>
    </div>
</aside>
