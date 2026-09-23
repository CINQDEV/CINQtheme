@php
  $hasAcf = function_exists('get_field');
  $contactEmail = $hasAcf ? get_field('contact_email', 'option') : null;
  $contactPhone = $hasAcf ? get_field('contact_phone', 'option') : null;
  $blurb = $hasAcf ? get_field('footer_blurb', 'option') : null;
  $socials = [
    'Facebook' => $hasAcf ? get_field('social_facebook', 'option') : null,
    'Instagram' => $hasAcf ? get_field('social_instagram', 'option') : null,
    'LinkedIn' => $hasAcf ? get_field('social_linkedin', 'option') : null,
    'X' => $hasAcf ? get_field('social_twitter', 'option') : null,
    'YouTube' => $hasAcf ? get_field('social_youtube', 'option') : null,
  ];
  $hasContactColumn = $contactEmail || $contactPhone || array_filter($socials);
@endphp

<footer class="content-info relative isolate overflow-hidden border-t border-ink/10 bg-ink text-paper px-6">
  <div class="pointer-events-none absolute inset-0 -z-10" aria-hidden="true">
    <x-logo-mark :size="380" dark class="absolute -top-20 -right-20 opacity-[0.16] motion-safe:animate-spin-slow" />
  </div>

  <div class="relative mx-auto grid max-w-6xl gap-12 py-16 md:grid-cols-4">
    <div class="md:col-span-2">
      <p class="flex items-center gap-2 text-lg font-semibold tracking-tight">
        <x-logo-mark :size="32" dark />
        {!! $siteName !!}
      </p>
      @if ($blurb)
        <p class="mt-4 max-w-sm text-sm text-paper/70">{{ $blurb }}</p>
      @endif
    </div>

    <div>
      <p class="text-sm font-medium text-paper/50">{{ __('Explore', 'sage') }}</p>
      <ul class="mt-4 space-y-2 text-sm">
        <li><a class="hover:text-teal" href="{{ home_url('/') }}">{{ __('Home', 'sage') }}</a></li>
        <li><a class="hover:text-teal" href="{{ get_post_type_archive_link('portfolio') ?: home_url('/work') }}">{{ __('Work', 'sage') }}</a></li>
        <li><a class="hover:text-teal" href="{{ get_post_type_archive_link('client') ?: home_url('/clients') }}">{{ __('Clients', 'sage') }}</a></li>
        <li><a class="hover:text-teal" href="{{ home_url('/about') }}">{{ __('About', 'sage') }}</a></li>
        <li><a class="hover:text-teal" href="{{ home_url('/contact') }}">{{ __('Contact', 'sage') }}</a></li>
      </ul>
    </div>

    @if ($hasContactColumn)
      <div>
        <p class="text-sm font-medium text-paper/50">{{ __('Get in touch', 'sage') }}</p>
        <ul class="mt-4 space-y-2 text-sm">
          @if ($contactEmail)
            <li><a class="hover:text-teal" href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a></li>
          @endif
          @if ($contactPhone)
            <li><a class="hover:text-teal" href="tel:{{ $contactPhone }}">{{ $contactPhone }}</a></li>
          @endif
          @foreach ($socials as $label => $url)
            @if ($url)
              <li><a class="hover:text-teal" href="{{ $url }}" rel="noopener" target="_blank">{{ $label }}</a></li>
            @endif
          @endforeach
        </ul>
      </div>
    @endif
  </div>

  @php(dynamic_sidebar('sidebar-footer'))

  <div class="border-t border-paper/10 py-6">
    <div class="mx-auto flex max-w-6xl flex-col gap-2 text-xs text-paper/50 md:flex-row md:items-center md:justify-between">
      <p>&copy; {{ date('Y') }} {!! $siteName !!}. {{ __('All rights reserved.', 'sage') }}</p>
      <div class="flex gap-4">
        <a class="hover:text-teal" href="{{ home_url('/cookie-policy') }}">{{ __('Cookie Policy', 'sage') }}</a>
        <a class="hover:text-teal" href="{{ home_url('/terms-and-conditions') }}">{{ __('Terms & Conditions', 'sage') }}</a>
      </div>
    </div>
  </div>
</footer>

<div
  id="cookie-notice"
  class="fixed inset-x-0 bottom-0 z-50 hidden border-t border-ink/10 bg-paper px-6 py-4 shadow-[0_-4px_20px_rgba(0,0,0,0.06)]"
>
  <div class="mx-auto flex max-w-6xl flex-col items-start gap-4 md:flex-row md:items-center md:justify-between">
    <p class="text-sm text-ink/80">
      {{ __('We use cookies to make this site work well for you.', 'sage') }}
      <a class="underline hover:text-rust" href="{{ home_url('/cookie-policy') }}">{{ __('Learn more', 'sage') }}</a>
    </p>
    <button type="button" id="cookie-accept" class="shrink-0 rounded-full bg-ink px-5 py-2 text-sm font-medium text-paper hover:bg-rust">
      {{ __('Accept', 'sage') }}
    </button>
  </div>
</div>
