@extends('layouts.app')

@section('content')
  <x-section class="pt-24 pb-8 md:pt-32">
    <p class="text-sm font-medium uppercase tracking-widest text-teal-deep">{{ __('Blog', 'sage') }}</p>
    <h1 class="mt-4 text-4xl md:text-5xl">{{ __('From the blog', 'sage') }}</h1>
  </x-section>

  <x-section class="pt-0">
    @if (! have_posts())
      <x-alert type="warning">
        {!! __('No posts found.', 'sage') !!}
      </x-alert>
    @endif

    <div class="grid gap-8 md:grid-cols-3">
      @while (have_posts()) @php(the_post())
        <x-card :href="get_permalink()" flush>
          @if (has_post_thumbnail())
            <div class="aspect-4/3 overflow-hidden bg-teal/10">
              {!! get_the_post_thumbnail(null, 'medium_large', ['class' => 'h-full w-full object-cover transition-transform duration-300 group-hover:scale-105']) !!}
            </div>
          @endif
          <div class="p-6">
            <p class="text-xs text-ink/50">{{ get_the_date() }}</p>
            <h2 class="mt-2 text-lg">{!! get_the_title() !!}</h2>
            <p class="mt-2 text-sm text-ink/60">{!! wp_trim_words(wp_strip_all_tags(get_the_excerpt()), 20) !!}</p>
          </div>
        </x-card>
      @endwhile
    </div>

    <div class="blog-pagination mt-12">
      {!! get_the_posts_pagination([
        'mid_size' => 2,
        'prev_text' => __('&larr; Newer', 'sage'),
        'next_text' => __('Older &rarr;', 'sage'),
        'screen_reader_text' => __('Posts navigation', 'sage'),
      ]) !!}
    </div>
  </x-section>
@endsection
