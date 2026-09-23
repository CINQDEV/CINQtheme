{{--
  Template Name: Contact
--}}

@extends('layouts.app')

@php
  $hasAcf = function_exists('get_field');
  $contactEmail = $hasAcf ? get_field('contact_email', 'option') : null;
  $contactPhone = $hasAcf ? get_field('contact_phone', 'option') : null;
  $contactAddress = $hasAcf ? get_field('contact_address', 'option') : null;
@endphp

@section('content')
  @while (have_posts()) @php(the_post())
    <x-section class="pt-24 pb-8 md:pt-32">
      <p class="text-sm font-medium uppercase tracking-widest text-teal-deep">{{ __('Contact', 'sage') }}</p>
      <h1 class="mt-4 text-4xl md:text-5xl">{!! get_the_title() !!}</h1>

      @if (get_the_content())
        <div class="prose mt-6 max-w-xl">
          @php(the_content())
        </div>
      @endif
    </x-section>
  @endwhile

  <x-section class="pt-0">
    <div class="grid gap-12 md:grid-cols-2">
      <div>
        @if (isset($_GET['sent']))
          <x-alert type="success">
            {{ __('Thanks — your message has been sent. We\'ll be in touch shortly.', 'sage') }}
          </x-alert>
        @endif

        @if (isset($_GET['error']))
          <x-alert type="warning">
            {{ __('Sorry, something went wrong sending your message. Please try again or email us directly.', 'sage') }}
          </x-alert>
        @endif

        <form method="post" action="{{ admin_url('admin-post.php') }}" class="mt-6 space-y-5">
          <input type="hidden" name="action" value="cinq_contact">
          {!! wp_nonce_field('cinq_contact', 'cinq_contact_nonce', true, false) !!}

          <div class="absolute left-[-9999px]" aria-hidden="true">
            <label for="website">{{ __('Leave this field empty', 'sage') }}</label>
            <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
          </div>

          <div>
            <label for="contact_name" class="text-sm font-medium text-ink">{{ __('Name', 'sage') }}</label>
            <input type="text" id="contact_name" name="name" required
              class="mt-2 w-full rounded-lg border border-ink/20 bg-paper px-4 py-3 text-sm focus-visible:outline-2 focus-visible:outline-teal-deep">
          </div>

          <div>
            <label for="contact_email" class="text-sm font-medium text-ink">{{ __('Email', 'sage') }}</label>
            <input type="email" id="contact_email" name="email" required
              class="mt-2 w-full rounded-lg border border-ink/20 bg-paper px-4 py-3 text-sm focus-visible:outline-2 focus-visible:outline-teal-deep">
          </div>

          <div>
            <label for="contact_message" class="text-sm font-medium text-ink">{{ __('Message', 'sage') }}</label>
            <textarea id="contact_message" name="message" rows="5" required
              class="mt-2 w-full rounded-lg border border-ink/20 bg-paper px-4 py-3 text-sm focus-visible:outline-2 focus-visible:outline-teal-deep"></textarea>
          </div>

          <x-button tag="button" variant="primary">
            {{ __('Send message', 'sage') }}
          </x-button>
        </form>
      </div>

      <div class="text-sm">
        <p class="text-sm font-medium uppercase tracking-widest text-teal-deep">{{ __('Details', 'sage') }}</p>
        <ul class="mt-6 space-y-4">
          @if ($contactEmail)
            <li>
              <p class="text-ink/50">{{ __('Email', 'sage') }}</p>
              <a class="hover:text-rust" href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
            </li>
          @endif
          @if ($contactPhone)
            <li>
              <p class="text-ink/50">{{ __('Phone', 'sage') }}</p>
              <a class="hover:text-rust" href="tel:{{ $contactPhone }}">{{ $contactPhone }}</a>
            </li>
          @endif
          @if ($contactAddress)
            <li>
              <p class="text-ink/50">{{ __('Address', 'sage') }}</p>
              <p>{{ $contactAddress }}</p>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </x-section>
@endsection
