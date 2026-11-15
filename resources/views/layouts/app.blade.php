<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $profile->site_title ?? ($profile->full_name . ' – ' . $profile->professional_title) }}</title>
    <meta name="description" content="{{ $profile->meta_description ?? $profile->short_bio }}" />

    {{-- Open Graph --}}
    <meta property="og:title"       content="{{ $profile->site_title ?? $profile->full_name }}" />
    <meta property="og:description" content="{{ $profile->meta_description ?? $profile->short_bio }}" />
    <meta property="og:type"        content="website" />
    <meta property="og:url"         content="{{ url()->current() }}" />
    @if($profile->profile_image)
        <meta property="og:image" content="{{ $profile->profileImageUrl) }}" />
    @endif

    {{-- Favicon --}}
    @if($profile->favicon)
    <link rel="icon" href="{{ $profile->faviconUrl() }}" />
    @endif

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    {{-- Vite (Tailwind + JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Prevent theme flash + global theme toggle function --}}
    <script>
        (function(){
            var saved = localStorage.getItem('theme');
            var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if(saved==='dark'||(! saved && prefersDark)){
                document.documentElement.classList.add('dark');
            }
        })();

        function toggleTheme() {
            var html = document.documentElement;
            var isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');

            // Update all theme icons on the page
            document.querySelectorAll('.theme-icon').forEach(function(icon) {
                icon.className = 'theme-icon fas ' + (isDark ? 'fa-sun' : 'fa-moon') + ' text-sm';
            });
        }
    </script>
</head>
<body class="bg-[var(--color-surface-alt)] text-[var(--color-text)] antialiased">

    {{-- Mobile top bar --}}
    <header class="lg:hidden fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-4 py-3
                   bg-[var(--color-sidebar-bg)] border-b border-[var(--color-sidebar-border)]">
        <span class="font-bold text-[var(--color-accent)]">{{ $profile->full_name }}</span>
        <div class="flex items-center gap-3">
            <button id="theme-toggle-mobile"
                    onclick="toggleTheme()"
                    class="w-9 h-9 flex items-center justify-center rounded-full
                        bg-[var(--color-surface-alt)] text-[var(--color-text-muted)] hover:text-[var(--color-accent)]
                        transition-colors" aria-label="Toggle theme">
                <i id="theme-icon-mobile" class="theme-icon fas fa-moon text-sm"></i>
            </button>
            <button id="mobile-menu-btn" class="w-9 h-9 flex items-center justify-center rounded-full
                        bg-[var(--color-surface-alt)] text-[var(--color-text-muted)] hover:text-[var(--color-accent)]
                        transition-colors" aria-label="Open menu">
                <i class="fas fa-bars text-sm"></i>
            </button>
        </div>
    </header>

    {{-- Sidebar overlay (mobile) --}}
    <div id="sidebar-overlay" class="hidden fixed inset-0 z-40 bg-black/50 lg:hidden"></div>

    {{-- Sidebar --}}
    @include('components.sidebar')

    {{-- Main content --}}
    <main class="main-content min-h-screen pt-14 lg:pt-0 overflow-x-hidden">
        @yield('content')
    </main>

</body>
</html>
