@php
  $total = count($GLOBALS['navigation']['footer']);
  $limit = $total % 2 === 0 ? $total / 2 : ($total + 1) / 2;
@endphp

<footer class="f">
  <div class="f__p"></div>
  @include('components/form', [
    'data' => [
      'title' => $GLOBALS['options']['f_form']['title'],
      'text' => $GLOBALS['options']['f_form']['subtitle'],
      'id-form' => $GLOBALS['options']['f_form']['id-form']
    ]
  ])
  <div class="container f__c">
    <div class="row">
      <div class="col-lg-20 offset-lg-4">
        <div class="f__w">
          <div class="f__i">
            <div class="f__l">
              <div class="f__t">{{ $GLOBALS['options']['f_title'] }}</div>
              <div class="f__sn">
                @if($GLOBALS['options']['sn_linkedin'])<a href="{{ $GLOBALS['options']['sn_linkedin'] }}" target="_blank" rel="noopener" aria-label="Linkedin">{!! display_svg('linkedin') !!}</a>@endif
                @if($GLOBALS['options']['sn_youtube'])<a href="{{ $GLOBALS['options']['sn_youtube'] }}" target="_blank" rel="noopener" aria-label="Youtube">{{ display_svg('youtube') }}</a>@endif
                @if($GLOBALS['options']['sn_facebook'])<a href="{{ $GLOBALS['options']['sn_facebook'] }}" target="_blank" rel="noopener" aria-label="Facebook">{!! display_svg('facebook') !!}</a>@endif
                @if($GLOBALS['options']['sn_twitter'])<a href="{{ $GLOBALS['options']['sn_twitter'] }}" target="_blank" rel="noopener" aria-label="twitter">{!! display_svg('twitter') !!}</a>@endif
              </div>
            </div>
            <div class="f__m">
              @for ($i = 0; $i < $limit; $i++)
              <a href="{{ $GLOBALS['navigation']['footer'][$i]['url'] }}" @if($GLOBALS['navigation']['footer'][$i]['target']){{ 'target="_blank" rel="noopener"' }}@endif class="gh">{{ $GLOBALS['navigation']['footer'][$i]['title'] }}</a>
              @endfor
            </div>
            <div class="f__r">
              @for ($i = $limit; $i < $total; $i++)
              <a href="{{ $GLOBALS['navigation']['footer'][$i]['url'] }}" @if($GLOBALS['navigation']['footer'][$i]['target']){{ 'target="_blank" rel="noopener"' }}@endif class="gh">{{ $GLOBALS['navigation']['footer'][$i]['title'] }}</a>
              @endfor
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-14 offset-lg-10">
        <div class="f__sm">
          @foreach ($GLOBALS['navigation']['subfooter'] as $item)
          <a href="{{ $item['url'] }}" @if($item['target']){{ 'target="_blank" rel="noopener"' }}@endif class="gh">{!! $item['title'] !!}</a>
          @endforeach
        </div>
        @if($GLOBALS['options']['f_text'])<div class="f__st">{!! $GLOBALS['options']['f_text'] !!}</div>@endif
        @if($GLOBALS['options']['f_credits'])<div class="f__sc">{{ $GLOBALS['options']['f_credits'] }}</div>@endif
      </div>
    </div>
  </div>
</footer>
