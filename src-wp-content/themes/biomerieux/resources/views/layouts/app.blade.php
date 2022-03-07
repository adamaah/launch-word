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

      @include('partials.header')

      <div class="content" data-router-wrapper role="document">
        @yield('content')
      </div>

      @php wp_footer() @endphp
    </div>
  </body>
</html>