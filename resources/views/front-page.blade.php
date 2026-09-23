@extends('layouts.app')

@section('content')
  <x-section class="relative isolate pt-24 pb-20 md:pt-32">
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden" aria-hidden="true">
      <x-logo-mark :size="640" class="absolute -top-40 -right-40 opacity-[0.06] motion-safe:animate-spin-slow" />
    </div>

    <div class="max-w-3xl">
      <p class="text-sm font-medium uppercase tracking-widest text-teal-deep">{{ __('WordPress design & development', 'sage') }}</p>
      <h1 class="mt-6 text-4xl leading-tight md:text-6xl">
        {{ __('We build WordPress sites that work as hard as you do.', 'sage') }}
      </h1>
      <p class="mt-6 max-w-xl text-lg text-ink/70">
        {{ __('CINQ is a WordPress design and development studio. We build clean, considered websites for businesses that want their site to actually work — for their customers, and for them.', 'sage') }}
      </p>
      <div class="mt-10 flex flex-wrap gap-4">
        <x-button :href="get_post_type_archive_link('portfolio') ?: home_url('/work')" variant="primary">
          {{ __('See our work', 'sage') }}
        </x-button>
        <x-button href="{{ home_url('/contact') }}" variant="outline">
          {{ __('Get in touch', 'sage') }}
        </x-button>
      </div>
    </div>
  </x-section>

  @if (count($latestPosts()))
    <x-section class="border-t border-ink/10">
      <div class="flex items-end justify-between gap-4">
        <p class="text-sm font-medium uppercase tracking-widest text-teal-deep">{{ __('From the blog', 'sage') }}</p>
        <a class="text-sm font-medium hover:text-rust" href="{{ get_permalink((int) get_option('page_for_posts')) }}">
          {{ __('View all →', 'sage') }}
        </a>
      </div>
      <div class="mt-8 grid gap-6 md:grid-cols-3">
        @foreach ($latestPosts as $post)
          <x-card :href="get_permalink($post)" flush>
            @if (has_post_thumbnail($post))
              <div class="aspect-4/3 overflow-hidden bg-teal/10">
                {!! get_the_post_thumbnail($post, 'medium_large', ['class' => 'h-full w-full object-cover transition-transform duration-300 group-hover:scale-105']) !!}
              </div>
            @endif
            <div class="p-5">
              <p class="text-xs text-ink/50">{{ get_the_date('', $post) }}</p>
              <h3 class="mt-1 text-base">{!! $post->post_title !!}</h3>
            </div>
          </x-card>
        @endforeach
      </div>
    </x-section>
  @endif

  @if (count($services()))
    <x-section class="border-t border-ink/10">
      <p class="text-sm font-medium uppercase tracking-widest text-teal-deep">{{ __('What we do', 'sage') }}</p>
      <div class="mt-8 grid gap-6 md:grid-cols-3">
        @foreach ($services as $service)
          <x-card>
            @if ($icon = get_field('icon', $service->ID))
              <img class="h-10 w-10" src="{{ $icon['url'] }}" alt="{{ $icon['alt'] ?: html_entity_decode($service->post_title) }}">
            @endif
            <h3 class="mt-4 text-lg">{!! $service->post_title !!}</h3>
            @if ($summary = get_field('summary', $service->ID))
              <p class="mt-2 text-sm text-ink/60">{{ $summary }}</p>
            @endif
          </x-card>
        @endforeach
      </div>
    </x-section>
  @endif

  @if (count($featuredPortfolio()))
    <x-section class="border-t border-ink/10">
      <div class="flex items-end justify-between gap-4">
        <p class="text-sm font-medium uppercase tracking-widest text-teal-deep">{{ __('Recent work', 'sage') }}</p>
        <a class="text-sm font-medium hover:text-rust" href="{{ get_post_type_archive_link('portfolio') ?: home_url('/work') }}">
          {{ __('View all →', 'sage') }}
        </a>
      </div>
      <div class="mt-8 grid gap-8 md:grid-cols-3">
        @foreach ($featuredPortfolio as $project)
          <x-card :href="get_permalink($project)" flush>
            @if (has_post_thumbnail($project))
              <div class="aspect-4/3 overflow-hidden bg-teal/10">
                {!! get_the_post_thumbnail($project, 'medium_large', ['class' => 'h-full w-full object-cover transition-transform duration-300 group-hover:scale-105']) !!}
              </div>
            @endif
            <div class="p-6">
              <h3 class="text-lg">{!! $project->post_title !!}</h3>
              @if ($summary = get_field('summary', $project->ID))
                <p class="mt-2 text-sm text-ink/60">{{ $summary }}</p>
              @endif
            </div>
          </x-card>
        @endforeach
      </div>
    </x-section>
  @endif

  @if (count($featuredClients()))
    <x-section class="border-t border-ink/10" tight>
      <p class="text-center text-sm font-medium uppercase tracking-widest text-teal-deep">{{ __('Trusted by', 'sage') }}</p>
      <div class="mt-8 flex flex-wrap items-center justify-center gap-x-12 gap-y-8">
        @foreach ($featuredClients as $client)
          @php($logo = get_field('logo', $client->ID))
          <a href="{{ get_permalink($client) }}" class="opacity-60 grayscale transition-all duration-150 hover:opacity-100 hover:grayscale-0">
            @if ($logo)
              <img class="h-8 w-auto" src="{{ $logo['url'] }}" alt="{{ $logo['alt'] ?: html_entity_decode($client->post_title) }}">
            @else
              <span class="text-sm font-medium">{!! $client->post_title !!}</span>
            @endif
          </a>
        @endforeach
      </div>
    </x-section>
  @endif

  @if ($testimonial())
    <x-section class="border-t border-ink/10">
      <blockquote class="mx-auto max-w-2xl text-center">
        <p class="text-2xl leading-relaxed text-ink md:text-3xl">
          <span class="text-rust">&ldquo;</span>{{ get_field('quote', $testimonial()->ID) }}<span class="text-rust">&rdquo;</span>
        </p>
        <footer class="mt-6 text-sm text-ink/60">
          @if ($name = get_field('author_name', $testimonial()->ID))
            <span class="font-medium text-ink">{{ $name }}</span>
          @endif
          @if ($role = get_field('author_role', $testimonial()->ID))
            <span>&mdash; {{ $role }}</span>
          @endif
        </footer>
      </blockquote>
    </x-section>
  @endif

  <x-section class="border-t border-ink/10 bg-camel text-paper" tight>
    <div class="flex flex-col items-start justify-between gap-6 md:flex-row md:items-center">
      <h2 class="text-2xl md:text-3xl">{{ __('Ready to start a project?', 'sage') }}</h2>
      <x-button href="{{ home_url('/contact') }}" variant="inverse">
        {{ __('Get in touch', 'sage') }}
      </x-button>
    </div>
  </x-section>
@endsection
