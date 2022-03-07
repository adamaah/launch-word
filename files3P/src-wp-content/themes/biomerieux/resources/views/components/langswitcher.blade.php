@if ($polylang_active)
  <div class="l">
    @php
      $langs = pll_the_languages(array(
        'display_names_as' => 'slug',
        'raw' => 1,
        'show_flags' => 0
      ));
    @endphp
    @foreach ($langs as $lang)
      <div class="{{ implode (" ", $lang['classes']) }}">
        <a lang="{{ $lang['locale'] }}" hreflang="{{ $lang['locale'] }}" href="{{ $lang['url'] }}" data-router-disabled>{{ $lang['name'] }}</a>
      </div>
    @endforeach
  </div>
@endif
