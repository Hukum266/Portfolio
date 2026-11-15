@extends('layouts.app')

@section('content')
<div class="px-6 lg:px-14 py-14 max-w-6xl mx-auto">
    <x-page-header title="Contact" subtitle="Have a project in mind? Let's talk." />

    <div class="grid lg:grid-cols-2 gap-12">

        {{-- Info --}}
        <div>
            <p class="text-[var(--color-text-muted)] mb-8 leading-relaxed">
                I'm always open to discussing new projects, freelance opportunities, or just saying hello.
                Fill in the form and I'll get back to you as soon as possible.
            </p>

            <div class="space-y-5 mb-8">
                @if($profile->email)
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-[var(--color-accent-light)] flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-envelope text-[var(--color-accent)]"></i>
                    </div>
                    <div>
                        <p class="text-xs text-[var(--color-text-muted)]">Email</p>
                        <a href="mailto:{{ $profile->email }}"
                           class="font-medium text-[var(--color-text)] hover:text-[var(--color-accent)] transition-colors">
                            {{ $profile->email }}
                        </a>
                    </div>
                </div>
                @endif

                @if($profile->phone)
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-[var(--color-accent-light)] flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-phone text-[var(--color-accent)]"></i>
                    </div>
                    <div>
                        <p class="text-xs text-[var(--color-text-muted)]">Phone</p>
                        <a href="tel:{{ $profile->phone }}"
                           class="font-medium text-[var(--color-text)]">{{ $profile->phone }}</a>
                    </div>
                </div>
                @endif

                @if($profile->location)
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-[var(--color-accent-light)] flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-map-marker-alt text-[var(--color-accent)]"></i>
                    </div>
                    <div>
                        <p class="text-xs text-[var(--color-text-muted)]">Location</p>
                        <p class="font-medium text-[var(--color-text)]">{{ $profile->location }}</p>
                    </div>
                </div>
                @endif
            </div>

            {{-- Social links --}}
            <div class="flex gap-3 flex-wrap">
                @foreach($socials as $social)
                <a href="{{ $social->url }}" target="_blank" rel="noopener"
                   title="{{ $social->platform }}"
                   class="w-10 h-10 flex items-center justify-center rounded-full
                          border border-[var(--color-border)] text-[var(--color-text-muted)]
                          hover:bg-[var(--color-accent)] hover:border-[var(--color-accent)] hover:text-white
                          transition-all">
                    <i class="{{ $social->icon }} text-sm"></i>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Form --}}
        <div>
            <form id="contact-form"
                  action="{{ route('contact.send') }}"
                  method="POST"
                  class="space-y-4">
                @csrf
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-[var(--color-text)] mb-1">Name *</label>
                        <input type="text" name="name" placeholder="Your Name" required
                               class="w-full px-4 py-3 rounded-lg border border-[var(--color-border)]
                                      bg-[var(--color-surface)] text-[var(--color-text)]
                                      focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)]
                                      placeholder:text-[var(--color-text-muted)] transition" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[var(--color-text)] mb-1">Email *</label>
                        <input type="email" name="email" placeholder="Your Email" required
                               class="w-full px-4 py-3 rounded-lg border border-[var(--color-border)]
                                      bg-[var(--color-surface)] text-[var(--color-text)]
                                      focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)]
                                      placeholder:text-[var(--color-text-muted)] transition" />
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[var(--color-text)] mb-1">Subject *</label>
                    <input type="text" name="subject" placeholder="Subject" required
                           class="w-full px-4 py-3 rounded-lg border border-[var(--color-border)]
                                  bg-[var(--color-surface)] text-[var(--color-text)]
                                  focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)]
                                  placeholder:text-[var(--color-text-muted)] transition" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-[var(--color-text)] mb-1">Message *</label>
                    <textarea name="message" rows="5" placeholder="Your message..." required
                              class="w-full px-4 py-3 rounded-lg border border-[var(--color-border)]
                                     bg-[var(--color-surface)] text-[var(--color-text)]
                                     focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)]
                                     placeholder:text-[var(--color-text-muted)] transition resize-none"></textarea>
                </div>
                <button type="submit" class="btn-accent w-full justify-center">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
                <div id="form-status" class="text-sm font-medium"></div>
            </form>
        </div>
    </div>
</div>
@endsection
