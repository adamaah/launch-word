{{--
  Template Name: Landing Page
--}}

@extends('layouts.landing')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-landing')
  @endwhile
@endsection
