@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12 lg:py-16">

    <a href="{{ route('blog') }}"
       class="inline-flex items-center gap-2 text-sm text-[var(--color-text-muted)]
              hover:text-[var(--color-accent)] transition-colors mb-8">
        <i class="fas fa-arrow-left text-xs"></i> Back to Blog
    </a>

    <header class="mb-8">
        <div class="flex flex-wrap items-center gap-3 text-sm text-[var(--color-text-muted)] mb-4">
            @if($post->category)
            <span class="px-3 py-1 rounded-full bg-[var(--color-accent-light)] text-[var(--color-accent)] font-semibold text-xs">
                {{ $post->category->name }}
            </span>
            @endif
            <span><i class="far fa-calendar mr-1"></i>{{ $post->published_at?->format('F d, Y') }}</span>
            @if($post->author)
            <span><i class="far fa-user mr-1"></i>{{ $post->author->name }}</span>
            @endif
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-[var(--color-text)] leading-tight mb-4">
            {{ $post->title }}
        </h1>
        @if($post->excerpt)
        <p class="text-[var(--color-text-muted)] text-lg leading-relaxed">{{ $post->excerpt }}</p>
        @endif
    </header>

    @if($post->thumbnail)
    <div class="rounded-2xl overflow-hidden aspect-video mb-10">
        <img src="{{ Storage::url($post->thumbnail) }}"
             alt="{{ $post->title }}"
             class="w-full h-full object-cover" />
    </div>
    @endif

    <div class="blog-content leading-relaxed space-y-4">
        {!! $post->content !!}
    </div>

    @if($recent->isNotEmpty())
    <div class="mt-16 pt-10 border-t border-[var(--color-border)]">
        <h2 class="text-xl font-bold text-[var(--color-text)] mb-6">More Posts</h2>
        <div class="grid sm:grid-cols-3 gap-6">
            @foreach($recent as $r)
            <a href="{{ route('blog.show', $r->slug) }}" class="card group block">
                @if($r->thumbnail)
                <div class="rounded-lg overflow-hidden aspect-video mb-3">
                    <img src="{{ Storage::url($r->thumbnail) }}" alt="{{ $r->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                         loading="lazy" />
                </div>
                @endif
                <p class="text-xs text-[var(--color-text-muted)] mb-1">{{ $r->published_at?->format('M d, Y') }}</p>
                <h3 class="font-semibold text-[var(--color-text)] group-hover:text-[var(--color-accent)]
                           transition-colors line-clamp-2 text-sm">
                    {{ $r->title }}
                </h3>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
