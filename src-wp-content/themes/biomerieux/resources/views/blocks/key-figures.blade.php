{{--
  Title: Key figures
  Description: Key figures
  Category: template-blocks
  Icon: editor-bold
  Post-Type: page post
  Keywords: key figures, key, figures
--}}

@php
  $data = Block::keyFigures($block['data']);
@endphp

<section class="b-kf">
  <div class="container">
    <div class="row">
      <div class="col-auto">
        <div class="b-kf__t">{!! $data['text'] !!}</div>
      </div>
    </div>
    <div class="row">
      @forelse ($data['figures'] as $item)
        <div class="col-md-10 col-lg-6 @if($loop->index !== 0){{ 'offset-lg-3' }}@endif @if($loop->index === 1){{ 'offset-md-4' }}@elseif($loop->index === 2){{ 'offset-md-7' }}@endif">
          <div class="b-kf__w">
            @if($item['figure'])<div class="b-kf__f">{{ $item['figure'] }}</div>@endif
            @if($item['text'])<div class="b-kf__tx">{!! wpautop($item['text']) !!}</div>@endif
          </div>
        </div>
      @empty
      @endforelse
    </div>
  </div>
</section>