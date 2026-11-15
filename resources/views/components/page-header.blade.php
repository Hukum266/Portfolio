@props(['title', 'subtitle' => null])

<div class="mb-10">
    <h1 class="text-3xl sm:text-4xl font-extrabold text-[var(--color-text)] relative pb-3 inline-block">
        {{ $title }}
        <span class="absolute left-0 bottom-0 w-12 h-1 bg-[var(--color-accent)] rounded-full"></span>
    </h1>
    @if($subtitle)
    <p class="mt-4 text-[var(--color-text-muted)] max-w-2xl">{{ $subtitle }}</p>
    @endif
</div>
