{{--
  Title: Key figures icon
  Description: Key figures with icon
  Category: template-blocks
  Icon: editor-bold
  Post-Type: page post
  Keywords: key figures, key, figures
--}}

@php
  $data = Block::keyFiguresPicto($block['data']);
@endphp

<section class="b-kfp has-bg">
  <div class="container">
    @if($data['title'])
      <div class="row justify-content-center">
        <div class="col-lg-16">
          <h2 class="b-kfp__t underline-wrapper js-observer">{!! wpautop($data['title']) !!}</h2>
        </div>
      </div>
    @endif
    <div class="b-kfp__s">
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-{{ count($data['figures']) }}">
        @forelse ($data['figures'] as $item)
          <div class="col">
            <div @if($loop->index !== count($data['figures']) - 1) class="b-kfp__w" @endif>
              @if($item['image'])<div class="b-kfp__i">@include('elements/image', ['data' => $item['image']])</div>@endif
              @if($item['figure'])<div class="b-kfp__f">{{ $item['figure'] }}</div>@endif
              @if($item['text'])<div class="b-kfp__tx">{!! wpautop($item['text']) !!}</div>@endif
            </div>
          </div>
        @empty
        @endforelse
      </div>
    </div>
  </div>
</section>