@extends('layouts.app')

@section('content')
  @while (have_posts()) @php the_post() @endphp
    <div data-router-view="page">
      {!! the_content() !!}

      @php do_action('get_footer') @endphp

      @include('partials.footer')

    </div>
  @endwhile
@endsection
