@props([
  'href' => null,
  'variant' => 'primary',
  'tag' => null,
])

@php
  $tag = $tag ?? ($href ? 'a' : 'button');

  $variants = [
    'primary' => 'bg-ink text-paper hover:bg-rust',
    'outline' => 'border border-ink/20 text-ink hover:border-teal-deep hover:text-teal-deep',
    'inverse' => 'bg-paper text-ink hover:bg-sand',
  ];

  $class = 'inline-flex items-center gap-2 rounded-full px-6 py-3 text-sm font-medium '
    .($variants[$variant] ?? $variants['primary']);
@endphp

<{{ $tag }} @if($href) href="{{ $href }}" @endif {{ $attributes->merge(['class' => $class]) }}>
  {{ $slot }}
</{{ $tag }}>
