<header class="banner sticky top-0 z-40 border-b border-ink/10 bg-teal/90 backdrop-blur px-6">
  <div class="mx-auto flex max-w-6xl items-center justify-between py-5">
    <a class="brand flex items-center gap-2 text-xl font-semibold tracking-tight text-paper" href="{{ home_url('/') }}">
      <x-logo-mark :size="40" dark />
      {!! $siteName !!}
    </a>

    @if (has_nav_menu('primary_navigation'))
      <nav class="nav-primary hidden items-center gap-8 md:flex" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
        {!! wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class' => 'flex items-center gap-8 text-base font-medium text-paper/80',
          'container' => false,
          'echo' => false,
          'link_before' => '<span class="transition-colors hover:text-paper">',
          'link_after' => '</span>',
        ]) !!}
      </nav>
    @endif

    <button
      type="button"
      id="nav-toggle"
      class="flex flex-col gap-1.5 md:hidden"
      aria-expanded="false"
      aria-controls="nav-mobile"
    >
      <span class="sr-only">{{ __('Toggle menu', 'sage') }}</span>
      <span class="h-px w-6 bg-paper"></span>
      <span class="h-px w-6 bg-paper"></span>
    </button>
  </div>

  @if (has_nav_menu('primary_navigation'))
    <nav id="nav-mobile" class="hidden border-t border-paper/10 py-4 md:hidden" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
      {!! wp_nav_menu([
        'theme_location' => 'primary_navigation',
        'menu_class' => 'flex flex-col gap-4 text-base font-medium text-paper/80',
        'container' => false,
        'echo' => false,
      ]) !!}
    </nav>
  @endif
</header>
