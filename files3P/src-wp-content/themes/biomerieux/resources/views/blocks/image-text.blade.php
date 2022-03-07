{{--
  Title: Image et texte
  Description: Contenu avec un image
  Category: template-blocks
  Icon: align-pull-left
  Post-Type: page post
  Keywords: image, texte, contenu
--}}

@php
  $data = Block::imageText($block['data']);
@endphp

<section class="b-it @if(!$data['invert']){{ 'b-it__i' }}@endif">
  <div class="container">
    <div class="row">
      <h2 class="b-it__t underline-wrapper js-observer">{!! $data['title'] !!}</h2>
    </div>
    <div class="row justify-content-between">
      <div class="col-lg-11">
        @include('elements/image', ['data' => $data['image']])
      </div>
      <div class="col-lg-11 @if(!$data['invert']){{ 'o1' }}@endif">
        <div class="b-it__w h100">
          @if($data['subtitle'])<div class="b-it__st">{!! $data['subtitle'] !!}</div>@endif
          @if($data['text'])<div class="b-it__tx">{!! wpautop($data['text']) !!}</div>@endif
          @if(isset($data['link']['url']))<a href="{{ $data['link']['url'] }}" @if($data['link']['target']){{ 'target="_blank" rel="noopener"' }}@endif class="b"><span><span>{{ $data['link']['title'] }}</span></span></a>@endif
        </div>
      </div>
    </div>
  </div>
</section>