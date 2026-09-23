@extends('layouts.app')

@section('content')
  @while (have_posts()) @php(the_post())
    <x-section class="pt-24 pb-8 md:pt-32">
      @php($logo = get_field('logo'))
      @if ($logo)
        <img class="h-14 w-auto" src="{{ $logo['url'] }}" alt="{{ $logo['alt'] ?: html_entity_decode(get_the_title()) }}">
      @endif
      <h1 class="mt-6 text-4xl md:text-5xl">{!! get_the_title() !!}</h1>

      <dl class="mt-8 flex flex-wrap gap-x-10 gap-y-4 text-sm">
        @if ($industry = get_field('industry'))
          <div>
            <dt class="text-ink/50">{{ __('Industry', 'sage') }}</dt>
            <dd class="mt-1">{{ $industry }}</dd>
          </div>
        @endif
        @if ($website = get_field('website'))
          <div>
            <dt class="text-ink/50">{{ __('Website', 'sage') }}</dt>
            <dd class="mt-1"><a class="hover:text-rust" href="{{ $website }}" target="_blank" rel="noopener">{{ preg_replace('#^https?://#', '', $website) }} ↗</a></dd>
          </div>
        @endif
      </dl>
    </x-section>

    @if (has_post_thumbnail())
      <x-section class="pt-0 pb-8" tight>
        <div class="aspect-video overflow-hidden rounded-2xl bg-teal/10">
          {!! get_the_post_thumbnail(null, 'large', ['class' => 'h-full w-full object-cover']) !!}
        </div>
      </x-section>
    @endif

    @if ($description = get_field('description'))
      <x-section class="pt-0" tight>
        <div class="prose max-w-2xl">
          {!! $description !!}
        </div>
      </x-section>
    @endif
  @endwhile

  @if (count($testimonials()))
    <x-section class="border-t border-ink/10">
      @foreach ($testimonials as $testimonial)
        <blockquote class="mx-auto max-w-2xl text-center">
          <p class="text-2xl leading-relaxed text-ink">
            <span class="text-rust">&ldquo;</span>{{ get_field('quote', $testimonial->ID) }}<span class="text-rust">&rdquo;</span>
          </p>
          <footer class="mt-6 text-sm text-ink/60">
            @if ($name = get_field('author_name', $testimonial->ID))
              <span class="font-medium text-ink">{{ $name }}</span>
            @endif
            @if ($role = get_field('author_role', $testimonial->ID))
              <span>&mdash; {{ $role }}</span>
            @endif
          </footer>
        </blockquote>
      @endforeach
    </x-section>
  @endif

  @if (count($projects()))
    <x-section class="border-t border-ink/10">
      <p class="text-sm font-medium uppercase tracking-widest text-teal-deep">{{ __('Projects', 'sage') }}</p>
      <div class="mt-8 grid gap-8 md:grid-cols-3">
        @foreach ($projects as $project)
          <x-card :href="get_permalink($project)" flush>
            @if (has_post_thumbnail($project))
              <div class="aspect-4/3 overflow-hidden bg-teal/10">
                {!! get_the_post_thumbnail($project, 'medium_large', ['class' => 'h-full w-full object-cover transition-transform duration-300 group-hover:scale-105']) !!}
              </div>
            @endif
            <div class="p-6">
              <h3 class="text-lg">{!! $project->post_title !!}</h3>
            </div>
          </x-card>
        @endforeach
      </div>
    </x-section>
  @endif
@endsection
