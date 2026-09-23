@extends('layouts.app')

@section('content')
  <x-section class="pt-24 pb-8 md:pt-32">
    <p class="text-sm font-medium uppercase tracking-widest text-teal-deep">{{ __('Clients', 'sage') }}</p>
    <h1 class="mt-4 text-4xl md:text-5xl">{{ __('Who we work with', 'sage') }}</h1>
  </x-section>

  <x-section class="pt-0">
    @if (! have_posts())
      <x-alert type="warning">
        {!! __('No clients found.', 'sage') !!}
      </x-alert>
    @endif

    <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
      @while (have_posts()) @php(the_post())
        <x-card :href="get_permalink()" flush>
          @if (has_post_thumbnail())
            <div class="aspect-4/3 overflow-hidden bg-teal/10">
              {!! get_the_post_thumbnail(null, 'medium_large', ['class' => 'h-full w-full object-cover transition-transform duration-300 group-hover:scale-105']) !!}
            </div>
          @endif
          <div class="p-6">
            @php($logo = get_field('logo'))
            <div class="flex h-16 items-center">
              @if ($logo)
                <img class="max-h-12 w-auto" src="{{ $logo['url'] }}" alt="{{ $logo['alt'] ?: html_entity_decode(get_the_title()) }}">
              @else
                <span class="text-lg font-medium">{!! get_the_title() !!}</span>
              @endif
            </div>
            @if ($industry = get_field('industry'))
              <p class="mt-4 text-sm text-ink/50">{{ $industry }}</p>
            @endif
            @if ($description = get_field('description'))
              <p class="mt-2 text-sm text-ink/60">{!! wp_trim_words(wp_strip_all_tags($description), 16) !!}</p>
            @endif
          </div>
        </x-card>
      @endwhile
    </div>

    {!! get_the_posts_navigation() !!}
  </x-section>
@endsection
