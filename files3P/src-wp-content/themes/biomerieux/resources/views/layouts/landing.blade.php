<!doctype html>
<html @php language_attributes() @endphp>
  @include('partials.head')

  <body @php body_class(App::formSubmit()) @endphp>
    @php $gtm = $GLOBALS['options']['google_tag_manager']; @endphp
    @if ($gtm)
      <span id="gtag-el" style="display:none" data-gtag="{{ $gtm }}"></span>
      <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $gtm }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    <div class="app">
      @php do_action('get_header') @endphp

      <header></header>

      <div class="content landing" data-router-wrapper role="document">
        @yield('content')
      </div>

      @php do_action('get_footer') @endphp

      <footer>
        <div class="container">
          <a href="{{ get_home_url() }}" class="h__l" aria-label="{{ pll__('Home')}}">
            <figure>
              <img src="{{ $GLOBALS['options']['h_logo']['url'] }}" alt="{{ $GLOBALS['options']['h_logo']['alt'] }}" width="60px" height="60px">
            </figure>
            {{ __('Biomerieux', 'biomerieux') }}
          </a>
      </footer>

      @php wp_footer() @endphp
    </div>
  </body>
</html>