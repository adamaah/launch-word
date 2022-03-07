{{--
  Title: Slider
  Description: Slider avec image et contenu
  Category: template-blocks
  Icon: slides
  Post-Type: page post
  Keywords: slider, slide
--}}

@php
  $data = Block::slider($block['data']);
@endphp

<section class="b-s">
  <div class="container">
    <div class="row">
      <div class="col-24"><h2 class="b-s__t underline-wrapper js-observer">{!! $data['title'] !!}</h2></div>
    </div>
    <div class="row">
      <div class="col-lg-14">
        <div class="b-s__l">
          @forelse ($data['slides'] as $slide)
            <div class="b-s__w">
              <div class="b-s__wi">
                <div class="b-s__i">@include('elements/image', ['data' => $slide['image']])</div>
              </div>
            </div>
          @empty
          @endforelse
        </div>
      </div>
      <div class="col-lg-9 offset-lg-1">
        <div class="b-s__r">
          <div class="b-s__ct">
            @forelse ($data['slides'] as $slide)
              <h3 class="b-s__cti">{!! $slide['title'] !!}</h3>
            @empty
            @endforelse
          </div>
          <div class="b-s__c">
            @forelse ($data['slides'] as $slide)
              <div class="b-s__ci">
                <div class="b-s__ctx">{!! wpautop($slide['text']) !!}</div>
                @if($slide['link'])<a href="{{ $slide['link']['url'] }}" @if($slide['link']['target']){{ 'target="_blank" rel="noopener"' }}@endif class="b"><span><span>{{ $slide['link']['title'] }}</span></span></a>@endif
              </div>
            @empty
            @endforelse
          </div>
          <div class="b-s__a">
            <div class="b-s__ai b-s__ap d">{!! display_svg('arrow-slider') !!}</div>
            <div class="b-s__ai b-s__an">{!! display_svg('arrow-slider') !!}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>