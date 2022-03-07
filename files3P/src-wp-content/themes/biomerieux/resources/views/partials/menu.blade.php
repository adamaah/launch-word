<div class="m">
  <div class="container h100">
    <div class="row justify-content-center h100">
      <div class="col-xl-20 h100">
        <div class="m__w h100">
          @foreach ($GLOBALS['navigation']['header'] as $item)
          @if ($item['children'])
          <div class="m__i">
            {!! $item['title'] !!}
            {!! display_svg('arrow') !!}
            <div class="m__s">
              @foreach ($item['children'] as $subItem)
              <a href="{{ $subItem['url'] }}" @if($subItem['target']){{ 'target="_blank" rel="noopener"' }}@endif class="gh">{!! $subItem['title'] !!}</a>
              @endforeach
            </div>
          </div>
          @else
          <a href="{{ $item['url'] }}" @if($item['target']){{ 'target="_blank" rel="noopener"' }}@endif class="m__i">{!! $item['title'] !!}</a>
          @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>