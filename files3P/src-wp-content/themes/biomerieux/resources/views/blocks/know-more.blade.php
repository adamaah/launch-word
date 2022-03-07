{{--
  Title: Know more
  Description: List of cards with image title, content and button
  Category: template-blocks
  Icon: ellipsis
  Post-Type: page post
  Keywords: know more, card, title, text, content, image
--}}

@php
  $data = Block::knowMore($block['data']);
@endphp

<section class="b-km">
  <div class="container">
    <div class="row">
      <div class="col-24">
        <h2 class="b-km__t underline-wrapper js-observer">{!! $data['title'] !!}</h2>
      </div>
    </div>
    <div class="row">
      @forelse ($data['cards'] as $item)
        <div class="col-md-11 col-lg-6 @if($loop->index % 2 !== 0){{ 'offset-md-2' }}@endif @if($loop->index % 3 !== 0){{ 'offset-lg-3' }}@else{{ 'offset-lg-0' }}@endif">
          <div class="b-km__w c">
            @if($item['image'])@include('elements/image', ['data' => $item['image']])@endif
            @if($item['title'])<h3 class="b-km__it">{!! $item['title'] !!}</h3>@endif
            @if($item['text'])<div class="b-km__tx">{!! $item['text'] !!}</div>@endif
            @if(isset($item['link']['url']))<a href="{{ $item['link']['url'] }}" @if($item['link']['target']){{ 'target="_blank" rel="noopener"' }}@endif class="b"><span><span>{{ $item['link']['title'] }}</span></span></a>@endif
            <div class="c__i" data-min="40" data-max="210" style="--s: 250px; --b: translateY(15px); --a: translateY(-15px);"></div>
          </div>
        </div>
      @empty
      @endforelse
    </div>
  </div>
</section>