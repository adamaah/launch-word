{{--
  Title: Process Slider
  Description: Slider qui explique les process
  Category: template-blocks
  Icon: slides
  Post-Type: page post
  Keywords: slider, slide, process
--}}

@php
  $data = Block::processSlider($block['data']);
  $total = count($data['slides']);
@endphp

<section class="b-ps">
  <div class="container">
    <div class="row d-none d-lg-flex">
      <div class="b-ps__t">{!! $data['title'] !!}</div>
    </div>
    <div class="row b-ps__w">
      @for ($i = 0; $i < $total; $i++)
      <div class="col-md-6 @if($i === 0){{ 'offset-md-9' }}@else{{ 'offset-md-1' }}@endif">
        <div class="b-ps__i @if($i === 0){{ 'a' }}@endif">
          @include('elements/image', ['data' => $data['slides'][$i]['image']])
          <span>{{ $i + 1 }}</span>
        </div>
      </div>
      @endfor
    </div>
    <div class="row justify-content-center z1">
      <div class="col-auto">
        <div class="b-ps__d">
          @for ($i = 0; $i < $total; $i++)
            <div class="b-ps__svg @if($i === 0){{ 'a' }}@endif">{!! display_svg('dot') !!}</div>
          @endfor
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 d-none d-lg-flex">
        <div class="b-ps__sm anchors">
          @if(isset($data['scroll_more']['url']))<div class="anchor" data-href="{{ $data['scroll_more']['url'] }}" @if($data['scroll_more']['target']){{ 'target="_blank" rel="noopener"' }}@endif><span>{{ $data['scroll_more']['title'] }}</span></div>@endif
          {!! display_svg('arrow') !!}
        </div>
      </div>
      <div class="col-lg-16 offset-lg-1 b-ps__o">
        <div class="b-ps__it">
          <div class="b-ps__n">
            <span class="items">
              @for ($i = 0; $i < $total; $i++)
                <span class="current">{{ $i + 1 }}</span>
              @endfor
            </span>
            <span class="total">/{{ $total }}</span>
          </div>
          @for ($i = 0; $i < $total; $i++)
            <div class="b-ps__c">
              <h2 class="b-ps__ct">{!! $data['slides'][$i]['title'] !!}</h2>
              <div class="b-ps__tx">{!! wpautop($data['slides'][$i]['text']) !!}</div>
            </div>
          @endfor
        </div>
      </div>
      <div class="col-lg-3 offset-lg-1 d-none d-lg-flex">
        <div class="b-ps__a">
          <div class="b-ps__ai">
            {!! display_svg('arrow-blue') !!}
            {!! display_svg('replay') !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>