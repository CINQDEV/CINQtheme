@props([
  'tight' => false,
])

<section {{ $attributes->merge(['class' => 'px-6 ' . ($tight ? 'py-10' : 'py-20')]) }}>
  <div class="mx-auto max-w-6xl">
    {{ $slot }}
  </div>
</section>
