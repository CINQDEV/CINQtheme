@props([
  'type' => null,
  'message' => null,
])

@php($class = match ($type) {
  'success' => 'text-ink bg-teal/20 border border-teal/40',
  'caution' => 'text-ink bg-sand/40 border border-camel/40',
  'warning' => 'text-ink bg-rust/10 border border-rust/30',
  default => 'text-ink bg-ink/5 border border-ink/10',
})

<div {{ $attributes->merge(['class' => "rounded-xl px-4 py-3 text-sm {$class}"]) }}>
  {!! $message ?? $slot !!}
</div>
