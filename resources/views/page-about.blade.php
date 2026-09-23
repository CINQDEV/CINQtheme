{{--
  Template Name: About
--}}

@extends('layouts.app')

@section('content')
  @while (have_posts()) @php(the_post())
    <x-section class="pt-24 pb-8 md:pt-32">
      <p class="text-sm font-medium uppercase tracking-widest text-teal-deep">{{ __('About', 'sage') }}</p>
      <h1 class="mt-4 text-4xl md:text-5xl">{!! get_the_title() !!}</h1>
    </x-section>

    <x-section class="pt-0" tight>
      <div class="prose max-w-2xl">
        @php(the_content())
      </div>
    </x-section>

    @if ($stats = get_field('stats'))
      <x-section class="border-t border-ink/10">
        <div class="grid gap-8 sm:grid-cols-3">
          @foreach ($stats as $stat)
            <div>
              <p class="text-4xl font-semibold text-rust">{{ $stat['number'] }}</p>
              <p class="mt-2 text-sm text-ink/60">{{ $stat['label'] }}</p>
            </div>
          @endforeach
        </div>
      </x-section>
    @endif
  @endwhile
@endsection
