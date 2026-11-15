@extends('layouts.app')

@section('content')
<div class="px-6 lg:px-14 py-14 max-w-6xl mx-auto">
    <x-page-header title="Portfolio" subtitle="A selection of projects I have built." />

    {{-- Filter buttons --}}
    <div class="flex flex-wrap gap-2 mb-8">
        <button class="filter-btn active" data-filter="all">All</button>
        @foreach($categories as $cat)
        <button class="filter-btn" data-filter="{{ $cat->slug }}">
            {{ $cat->name }}
        </button>
        @endforeach
    </div>

    {{-- Grid --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($projects as $project)
        <article class="project-card card group"
                 data-category="{{ $project->category?->slug ?? 'uncategorized' }}">
            <div class="rounded-lg overflow-hidden aspect-video mb-4 bg-[var(--color-surface-alt)]">
                @if($project->thumbnail)
                    <img src="{{ $project->thumbnailUrl() }}"
                         alt="{{ $project->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                         loading="lazy" />
                @else
                    <div class="w-full h-full flex items-center justify-center text-[var(--color-text-muted)]">
                        <i class="fas fa-code text-4xl"></i>
                    </div>
                @endif
            </div>

            @if($project->category)
            <span class="inline-block px-2 py-0.5 text-xs font-medium rounded-full
                         bg-[var(--color-accent-light)] text-[var(--color-accent)] mb-2">
                {{ $project->category->name }}
            </span>
            @endif

            <h3 class="font-bold text-[var(--color-text)] mb-2">{{ $project->title }}</h3>
            <p class="text-sm text-[var(--color-text-muted)] mb-4 line-clamp-2">{{ $project->description }}</p>

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
        <p class="col-span-3 text-center text-[var(--color-text-muted)] py-16">No projects added yet.</p>
        @endforelse
    </div>
</div>
@endsection
