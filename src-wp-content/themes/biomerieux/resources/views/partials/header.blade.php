<header class="h">
  <div class="container h__c">
    <div class="h__w h100">
      <a href="{{ pll_home_url() }}" class="h__l" aria-label="{{ pll__('Home')}}">
        <figure>
          <img src="{{ $GLOBALS['options']['h_logo']['url'] }}" alt="{{ $GLOBALS['options']['h_logo']['alt'] }}" width="60px" height="60px">
        </figure>
      </a>
      <div class="h__r">
        @if($GLOBALS['options']['m_active'])@include('components/langswitcher')@endif
        <div class="h__b">
          <span style="--transition-order: 0"></span>
          <span style="--transition-order: 1"></span>
          <span style="--transition-order: 2"></span>
          <div style="--transition-order: 0"></div>
          <div style="--transition-order: 1"></div>
        </div>
      </div>
    </div>
  </div>
  @include('partials/menu')
</header>
