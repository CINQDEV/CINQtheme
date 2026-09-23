@props([
  'href' => null,
  'flush' => false,
])

@php($tag = $href ? 'a' : 'div')

<{{ $tag }} @if($href) href="{{ $href }}" @endif {{ $attributes->merge(['class' => 'group block rounded-2xl border border-ink/10 bg-paper transition-all duration-150 hover:border-teal/50 hover:shadow-lg hover:shadow-teal/10 ' . ($flush ? 'overflow-hidden' : 'p-6')]) }}>
  {{ $slot }}
</{{ $tag }}>
