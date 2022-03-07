<div data-router-view="page">
  @include('components/breadcrumb')

  {!! the_content() !!}

  @php do_action('get_footer') @endphp

  @include('partials.footer')
</div>