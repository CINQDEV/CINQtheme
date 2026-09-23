@props([
  'size' => 32,
  'dark' => false,
])

@php
  $height = round($size * 180.90 / 190.22);
  $seam = $dark ? '#2B2622' : '#FAF8F4';
  $outline = $dark ? '#FAF8F4' : '#2B2622';
  $fifthFacet = $dark ? '#FAF8F4' : '#2B2622';
@endphp

<svg width="{{ $size }}" height="{{ $height }}" viewBox="4.89 0 190.22 180.90" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" {{ $attributes }}>
  <polygon points="100,100 100,0 195.11,69.10" fill="#9BB4C0" stroke="{{ $seam }}" stroke-width="1.5" />
  <polygon points="100,100 195.11,69.10 158.78,180.90" fill="#703B3B" stroke="{{ $seam }}" stroke-width="1.5" />
  <polygon points="100,100 158.78,180.90 41.22,180.90" fill="#A18D6D" stroke="{{ $seam }}" stroke-width="1.5" />
  <polygon points="100,100 41.22,180.90 4.89,69.10" fill="#E1D0B3" stroke="{{ $seam }}" stroke-width="1.5" />
  <polygon points="100,100 4.89,69.10 100,0" fill="{{ $fifthFacet }}" stroke="{{ $seam }}" stroke-width="1.5" />
  <polygon points="100,0 195.11,69.10 158.78,180.90 41.22,180.90 4.89,69.10" fill="none" stroke="{{ $outline }}" stroke-width="3" stroke-linejoin="round" />
</svg>
