@extends('layouts.app')

@section('content')
  <x-section class="pt-24 pb-8 md:pt-32">
    <p class="text-sm font-medium uppercase tracking-widest text-teal-deep">{{ __('Portfolio', 'sage') }}</p>
    <h1 class="mt-4 text-4xl md:text-5xl">{{ __('Our work', 'sage') }}</h1>

    @if (count($allCategories()))
      <nav class="mt-8 flex flex-wrap gap-3" aria-label="{{ __('Filter by category', 'sage') }}">
        <a href="{{ get_post_type_archive_link('portfolio') }}" class="rounded-full border border-ink/20 px-4 py-1.5 text-sm transition-colors hover:border-teal-deep hover:text-teal-deep">
          {{ __('All', 'sage') }}
        </a>
        @foreach ($allCategories as $category)
          <a href="{{ get_term_link($category) }}" class="rounded-full border border-ink/20 px-4 py-1.5 text-sm transition-colors hover:border-teal-deep hover:text-teal-deep">
            {{ $category->name }}
          </a>
        @endforeach
      </nav>
    @endif
  </x-section>

  <x-section class="pt-0">
    @if (! have_posts())
      <x-alert type="warning">
        {!! __('No projects found.', 'sage') !!}
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
            <h2 class="text-lg">{!! get_the_title() !!}</h2>
            @if ($summary = get_field('summary'))
              <p class="mt-2 text-sm text-ink/60">{{ $summary }}</p>
            @endif
          </div>
        </x-card>
      @endwhile
    </div>

    {!! get_the_posts_navigation() !!}
  </x-section>
@endsection
