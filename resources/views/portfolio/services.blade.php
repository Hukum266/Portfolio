@extends('layouts.app')

@section('content')
<div class="px-6 lg:px-14 py-14 max-w-6xl mx-auto">
    <x-page-header title="Services" subtitle="What I can do for you." />

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
        <p class="col-span-3 text-center text-[var(--color-text-muted)] py-16">No services added yet.</p>
        @endforelse
    </div>
</div>
@endsection
