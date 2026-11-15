@extends('layouts.app')

@section('content')
<div class="px-6 lg:px-14 py-14 max-w-6xl mx-auto">
    <x-page-header title="About Me" />

    <div class="grid lg:grid-cols-2 gap-12 items-start">

        {{-- Profile image --}}
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

        {{-- Bio + info + skills --}}
        <div>
            <p class="text-[var(--color-text-muted)] leading-relaxed mb-6">
                {{ $profile->biography ?? $profile->short_bio }}
            </p>

            {{-- Personal info --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-8 text-sm">
                @if($profile->email)
                <div class="flex items-center gap-2 text-[var(--color-text-muted)]">
                    <i class="fas fa-envelope text-[var(--color-accent)] w-4"></i>
                    <span class="truncate">{{ $profile->email }}</span>
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
                       class="hover:text-[var(--color-accent)] transition-colors truncate">
                        {{ $profile->website }}
                    </a>
                </div>
                @endif
            </div>

            {{-- Skills --}}
            <h3 class="font-semibold text-[var(--color-text)] mb-4">Technical Skills</h3>
            <div class="space-y-3">
                @foreach($skills as $skill)
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-[var(--color-text)] font-medium">{{ $skill->name }}</span>
                        <span class="text-[var(--color-text-muted)]">{{ $skill->percentage }}%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-bar-fill" style="width:{{ $skill->percentage }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($profile->cv_file)
            <a href="{{ $profile->cvUrl() }}" target="_blank" class="btn-accent mt-8 inline-flex">
                <i class="fas fa-download"></i> Download CV
            </a>
            @endif
        </div>
    </div>
</div>
@endsection
