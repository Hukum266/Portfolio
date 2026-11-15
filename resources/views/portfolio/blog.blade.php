@extends('layouts.app')

@section('content')
<div class="px-6 lg:px-14 py-14 max-w-6xl mx-auto">
    <x-page-header title="Blog" subtitle="Thoughts, tutorials, and updates." />

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posts as $post)
        <article class="card flex flex-col group">
            <a href="{{ route('blog.show', $post->slug) }}"
               class="block rounded-lg overflow-hidden aspect-video mb-4 bg-[var(--color-surface-alt)]">
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
        <p class="col-span-3 text-center text-[var(--color-text-muted)] py-16">No blog posts published yet.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($posts->hasPages())
    <div class="mt-10 flex justify-center">
        {{ $posts->links() }}
    </div>
    @endif
</div>
@endsection
