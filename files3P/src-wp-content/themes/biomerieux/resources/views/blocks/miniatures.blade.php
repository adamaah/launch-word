{{--
  Title: Miniatures
  Description: List of image title and content
  Category: template-blocks
  Icon: screenoptions
  Post-Type: page post
  Keywords: miniatures, title, text, content, image
--}}

@php
  $data = Block::miniatures($block['data']);
@endphp

<section class="b-m">
  <div class="container">
    <div class="row">
      <div class="col-auto">
        <h2 class="b-m__t underline-wrapper js-observer">{!! $data['title'] !!}</h2>
      </div>
    </div>
    <div class="row justify-content-between">
      @forelse ($data['miniatures'] as $item)
        <div class="col-md-11 col-lg-5">
          <div class="b-m__w c">
            @if($item['image'])@include('elements/image', ['data' => $item['image']])@endif
            @if($item['title'])<h3 class="b-m__it">{!! $item['title'] !!}</h3>@endif
            @if($item['text'])<div class="b-m__tx">{!! $item['text'] !!}</div>@endif
            <div class="c__i" data-min="40" data-max="210" style="--s: 250px; --b: translateY(15px); --a: translateY(-15px);"></div>
          </div>
        </div>
      @empty
      @endforelse
    </div>
  </div>
</section>