@extends('layouts.app')

@section('content')
<div class="px-6 lg:px-14 py-14 max-w-6xl mx-auto">

    <div class="flex items-start justify-between flex-wrap gap-4 mb-10">
        <x-page-header title="Resume" class="mb-0" />
        @if($profile->cv_file)
        <a href="{{ Storage::url($profile->cv_file) }}" target="_blank" class="btn-accent">
            <i class="fas fa-download"></i> Download CV
        </a>
        @endif
    </div>

    <div class="grid lg:grid-cols-2 gap-12">

        {{-- Experience --}}
        <div>
            <h3 class="text-lg font-bold text-[var(--color-text)] mb-6 flex items-center gap-2">
                <i class="fas fa-briefcase text-[var(--color-accent)]"></i> Work Experience
            </h3>
            <div class="relative pl-6 border-l-2 border-[var(--color-border)] space-y-8">
                @forelse($experiences as $exp)
                <div class="relative">
                    <div class="absolute -left-[1.65rem] top-1 w-3 h-3 rounded-full
                                bg-[var(--color-accent)] ring-4 ring-[var(--color-surface)]"></div>
                    <span class="text-xs font-semibold text-[var(--color-accent)] mb-1 block">
                        {{ $exp->period }}
                    </span>
                    <h4 class="font-bold text-[var(--color-text)]">{{ $exp->job_title }}</h4>
                    <p class="text-sm text-[var(--color-text-muted)] mb-2">
                        {{ $exp->company }}@if($exp->location) · {{ $exp->location }}@endif
                    </p>
                    @if($exp->description)
                    <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">{{ $exp->description }}</p>
                    @endif
                </div>
                @empty
                <p class="text-[var(--color-text-muted)] text-sm">No experience added yet.</p>
                @endforelse
            </div>
        </div>

        {{-- Education --}}
        <div>
            <h3 class="text-lg font-bold text-[var(--color-text)] mb-6 flex items-center gap-2">
                <i class="fas fa-graduation-cap text-[var(--color-accent)]"></i> Education
            </h3>
            <div class="relative pl-6 border-l-2 border-[var(--color-border)] space-y-8">
                @forelse($educations as $edu)
                <div class="relative">
                    <div class="absolute -left-[1.65rem] top-1 w-3 h-3 rounded-full
                                bg-[var(--color-accent)] ring-4 ring-[var(--color-surface)]"></div>
                    <span class="text-xs font-semibold text-[var(--color-accent)] mb-1 block">
                        {{ $edu->period }}
                    </span>
                    <h4 class="font-bold text-[var(--color-text)]">{{ $edu->degree }}</h4>
                    <p class="text-sm text-[var(--color-text-muted)] mb-2">
                        {{ $edu->institution }}@if($edu->location) · {{ $edu->location }}@endif
                    </p>
                    @if($edu->field_of_study)
                    <p class="text-xs text-[var(--color-text-muted)]">{{ $edu->field_of_study }}</p>
                    @endif
                </div>
                @empty
                <p class="text-[var(--color-text-muted)] text-sm">No education added yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Skills --}}
    <div class="mt-14">
        <h3 class="text-lg font-bold text-[var(--color-text)] mb-6 flex items-center gap-2">
            <i class="fas fa-code text-[var(--color-accent)]"></i> Technical Skills
        </h3>
        <div class="grid sm:grid-cols-2 gap-x-10 gap-y-4">
            @foreach($skills as $skill)
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="font-medium text-[var(--color-text)]">{{ $skill->name }}</span>
                    <span class="text-[var(--color-text-muted)]">{{ $skill->percentage }}%</span>
                </div>
                <div class="skill-bar">
                    <div class="skill-bar-fill" style="width:{{ $skill->percentage }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Certifications --}}
    @if($certs->isNotEmpty())
    <div class="mt-14">
        <h3 class="text-lg font-bold text-[var(--color-text)] mb-6 flex items-center gap-2">
            <i class="fas fa-certificate text-[var(--color-accent)]"></i> Certifications
        </h3>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($certs as $cert)
            <div class="card flex items-start gap-4">
                <div class="w-10 h-10 rounded-lg bg-[var(--color-accent-light)] flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-award text-[var(--color-accent)]"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-[var(--color-text)] text-sm">{{ $cert->title }}</h4>
                    <p class="text-xs text-[var(--color-text-muted)]">{{ $cert->issuer }}</p>
                    @if($cert->issued_date)
                    <p class="text-xs text-[var(--color-text-muted)]">{{ $cert->issued_date->format('M Y') }}</p>
                    @endif
                    @if($cert->credential_url)
                    <a href="{{ $cert->credential_url }}" target="_blank"
                       class="text-xs text-[var(--color-accent)] hover:underline mt-1 inline-block">
                        View Credential →
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
