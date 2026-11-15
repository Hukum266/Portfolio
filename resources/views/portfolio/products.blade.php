@extends('layouts.app')

@section('content')
<div class="px-6 lg:px-14 py-14 max-w-6xl mx-auto">
    <x-page-header title="Products" subtitle="Things I have built that you can use." />

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products as $product)
        <div class="card flex flex-col">
            <div class="rounded-lg overflow-hidden aspect-video mb-4 bg-[var(--color-surface-alt)]">
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

            <span class="inline-block self-start px-2 py-0.5 text-xs font-semibold rounded-full mb-2
                @if($product->status === 'available')    bg-green-100  text-green-700
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
        <p class="col-span-3 text-center text-[var(--color-text-muted)] py-16">No products added yet.</p>
        @endforelse
    </div>
</div>
@endsection
