@if (count($breadcrumbs()) > 1)
  <nav class="border-t border-ink/10 px-6 py-4" aria-label="{{ __('Breadcrumb', 'sage') }}">
    <ol class="mx-auto flex max-w-6xl flex-wrap items-center gap-2 text-xs text-ink/50">
      @foreach ($breadcrumbs as $crumb)
        <li class="flex items-center gap-2">
          @if (! $loop->first)
            <span aria-hidden="true">/</span>
          @endif

          @if ($crumb['url'] && ! $loop->last)
            <a class="hover:text-teal-deep" href="{{ $crumb['url'] }}">{!! $crumb['label'] !!}</a>
          @else
            <span @if ($loop->last) aria-current="page" @endif>{!! $crumb['label'] !!}</span>
          @endif
        </li>
      @endforeach
    </ol>
  </nav>
@endif
