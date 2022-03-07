{{--
  Title: Process
  Description: Liste des process avec une image, du contenu et un lien
  Category: template-blocks
  Icon: admin-generic
  Post-Type: page post
  Keywords: process
--}}

@php
  $data = Block::process($block['data']);
@endphp

<section class="b-p">
  <div class="container">
    <div class="row">
      <div class="col-24"><h2 class="b-p__t underline-wrapper js-observer">{!! $data['title'] !!}</h2></div>
    </div>
    <div class="row">
      @forelse ($data['process'] as $process)
      <div class="col-lg-8 @if($loop->index !== 2){{ 'b-p__p' }}@endif">
        <div class="b-p__w h100">
          <div class="b-p__i">
            @if($process['image'])@include('elements/image', ['data' => $process['image']])@endif
            @if($process['title'])<h3 class="b-p__pt">{!! wpautop($process['title']) !!}</h3>@endif
            @if($process['subtitle'])<div class="b-p__st">{!! wpautop($process['subtitle']) !!}</div>@endif
            @if($process['text'])<div class="b-p__tx">{!! wpautop($process['text']) !!}</div>@endif
          </div>
          @if($process['link'])<a href="{{ $process['link']['url'] }}" @if($process['link']['target']){{ 'target="_blank" rel="noopener"' }}@endif class="b"><span><span>{{ $process['link']['title'] }}</span></span></a>@endif
        </div>
      </div>
      @empty
      @endforelse
    </div>
  </div>
</section>