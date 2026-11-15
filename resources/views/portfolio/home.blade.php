@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center px-6 lg:px-14 py-20
                bg-[var(--color-surface)]">
    <div class="w-full max-w-5xl mx-auto">
        <div class="flex flex-col-reverse lg:flex-row items-center gap-14">

            {{-- Text --}}
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
                    <a href="{{ route('portfolio') }}" class="btn-accent">
                        <i class="fas fa-eye"></i> View Portfolio
                    </a>
                    @if($profile->cv_file)
                    <a href="{{ Storage::url($profile->cv_file) }}" target="_blank" class="btn-outline">
                        <i class="fas fa-download"></i> Download CV
                    </a>
                    @else
                    <a href="{{ route('resume') }}" class="btn-outline">
                        <i class="fas fa-file-alt"></i> View Resume
                    </a>
                    @endif
                </div>

                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-6">
                    @foreach($stats as $stat)
                    <div class="text-center">
                        <div class="text-3xl font-extrabold text-[var(--color-accent)]">
                            <span class="counter" data-target="{{ $stat->value }}" data-suffix="{{ $stat->suffix }}">
                                0{{ $stat->suffix }}
                            </span>
                        </div>
                        <p class="text-xs text-[var(--color-text-muted)] mt-1">{{ $stat->label }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Profile image --}}
            <div class="flex-shrink-0 fade-in-up" style="animation-delay:.15s">
                <div class="relative p-4">
                    <div class="w-56 h-56 sm:w-64 sm:h-64 lg:w-72 lg:h-72 rounded-full overflow-hidden
                                ring-8 ring-[var(--color-accent)]/30 relative z-10">
                        @if($profile->hero_image)
                            <img src="{{ Storage::url($profile->hero_image) }}"
                                 alt="{{ $profile->full_name }}"
                                 class="w-full h-full object-cover" />
                        @elseif($profile->profile_image)
                            <img src="{{ Storage::url($profile->profile_image) }}"
                                 alt="{{ $profile->full_name }}"
                                 class="w-full h-full object-cover" />
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[var(--color-accent)] to-green-700
                                        flex items-center justify-center text-white text-6xl font-bold">
                                {{ strtoupper(substr($profile->full_name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="absolute inset-0 rounded-full border-2 border-dashed
                                border-[var(--color-accent)]/40 animate-spin"
                         style="animation-duration:12s"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
