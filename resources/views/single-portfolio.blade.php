@extends('layouts.app')

@section('content')
  @while (have_posts()) @php(the_post())
    <x-section class="pt-24 pb-8 md:pt-32">
      @if (count($categories()))
        <p class="text-sm font-medium uppercase tracking-widest text-teal-deep">
          {{ collect($categories)->pluck('name')->join(', ') }}
        </p>
      @endif
      <h1 class="mt-4 text-4xl md:text-5xl">{!! get_the_title() !!}</h1>

      <dl class="mt-8 flex flex-wrap gap-x-10 gap-y-4 text-sm">
        @if ($client = get_field('client'))
          <div>
            <dt class="text-ink/50">{{ __('Client', 'sage') }}</dt>
            <dd class="mt-1"><a class="hover:text-rust" href="{{ get_permalink($client) }}">{!! $client->post_title !!}</a></dd>
          </div>
        @endif
        @if ($services = get_field('services_used'))
          <div>
            <dt class="text-ink/50">{{ __('Services', 'sage') }}</dt>
            <dd class="mt-1">{{ $services }}</dd>
          </div>
        @endif
        @if ($date = get_field('project_date'))
          <div>
            <dt class="text-ink/50">{{ __('Date', 'sage') }}</dt>
            <dd class="mt-1">{{ $date }}</dd>
          </div>
        @endif
        @if ($url = get_field('project_url'))
          <div>
            <dt class="text-ink/50">{{ __('Website', 'sage') }}</dt>
            <dd class="mt-1"><a class="hover:text-rust" href="{{ $url }}" target="_blank" rel="noopener">{{ preg_replace('#^https?://#', '', $url) }} ↗</a></dd>
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

    <x-section class="pt-0" tight>
      <div class="prose max-w-2xl">
        @php(the_content())
      </div>
    </x-section>

    @if ($gallery = get_field('gallery'))
      <x-section class="border-t border-ink/10">
        <div class="grid gap-6 md:grid-cols-2">
          @foreach ($gallery as $image)
            <div class="overflow-hidden rounded-2xl bg-teal/10">
              <img class="h-full w-full object-cover" src="{{ $image['sizes']['large'] ?? $image['url'] }}" alt="{{ $image['alt'] ?: html_entity_decode(get_the_title()) }}">
            </div>
          @endforeach
        </div>
      </x-section>
    @endif
  @endwhile

  @if (count($related()))
    <x-section class="border-t border-ink/10">
      <p class="text-sm font-medium uppercase tracking-widest text-teal-deep">{{ __('More projects', 'sage') }}</p>
      <div class="mt-8 grid gap-8 md:grid-cols-3">
        @foreach ($related as $project)
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
