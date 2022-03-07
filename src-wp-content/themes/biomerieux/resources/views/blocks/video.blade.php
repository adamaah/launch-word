{{--
  Title: Vidéo Youtube
  Description: Vidéo Youtube
  Category: template-blocks
  Icon: video-alt3
  Post-Type: page post
  Keywords: video, youtube
--}}

@php
  $data = Block::video($block['data']);
@endphp

<section @if($data['anchor']) id="{{ $data['anchor'] }}" @endif class="section video" data-scroll-section>
  <div class="container video__container">
    <div class="row">
      <div class="col-24">
        <div class="video__wrapper c">
          @if ($data['poster']['url'])
            <div class="video__cover">
              <div class="image">@include('elements/image', ['data' => $data['poster']])</div>
              <div class="video__play play">{{ display_svg('play') }}</div>
            </div>
          @endif
          <div class="video__player">
            <div id="player-{{ $data['video']['id'] }}" class="player" data-id="{{ $data['video']['id'] }}" data-src="{{ $data['video']['src'] }}"></div>
          </div>
          <div class="c__i" data-min="60" data-max="440" style="--s: 500px; --b: translate(30px, -30px); --a: translate(-30px, 30px);"></div>
        </div>
        <div class="video__content">
          <div class="video__suptitle">{!! $data['suptitle'] !!}</div>
          <div class="video__title" data-text="{{ $data['title'] }}">{!! $data['title'] !!}</div>
        </div>
      </div>
    </div>
  </div>
</section>