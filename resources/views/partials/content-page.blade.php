<x-section class="pt-0" tight>
  <div class="prose max-w-2xl">
    @php(the_content())
  </div>

  @if ($pagination())
    <nav class="page-nav mt-8 text-sm" aria-label="Page">
      {!! $pagination !!}
    </nav>
  @endif
</x-section>
