<x-section class="pt-24 pb-8 md:pt-32">
  <p class="text-sm font-medium uppercase tracking-widest text-teal-deep">{{ __('Blog', 'sage') }}</p>
  <h1 class="mt-4 text-4xl md:text-5xl">{!! $title !!}</h1>
  <div class="mt-6">
    @include('partials.entry-meta')
  </div>
</x-section>

@if (has_post_thumbnail())
  <x-section class="pt-0 pb-8" tight>
    <div class="aspect-video overflow-hidden rounded-2xl bg-teal/10">
      {!! get_the_post_thumbnail(null, 'large', ['class' => 'h-full w-full object-cover']) !!}
    </div>
  </x-section>
@endif

<x-section class="pt-0" tight>
  <div class="prose max-w-2xl [&>p:first-of-type]:font-semibold [&>p:first-of-type]:text-ink">
    @php(the_content())
  </div>

  @if ($pagination())
    <nav class="mt-8 text-sm" aria-label="{{ __('Page', 'sage') }}">
      {!! $pagination !!}
    </nav>
  @endif
</x-section>
