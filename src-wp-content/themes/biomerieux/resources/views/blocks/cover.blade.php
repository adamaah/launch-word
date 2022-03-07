{{--
  Title: Cover
  Description: First block with content and image
  Category: template-blocks
  Icon: cover-image
  Post-Type: page post
  Keywords: cover, image, content
--}}

@php
  $data = Block::cover($block['data']);
@endphp

<section class="b-co @if($data['choice'] === 'icon'){{ 'b-co__ic' }}@endif">
  <div class="container">
    <div class="row h100 flex-column-reverse flex-lg-row align-items-lg-center">
      <div class="@if($data['choice'] === 'icon'){{ 'col-lg-13 b-co__cp' }}@else{{ 'col-lg-11' }}@endif h100">
        <div class="b-co__w h100 @if($data['choice'] === 'icon'){{ 'b-co__wi' }}@endif">
          <h1 class="b-co__t underline-wrapper big js-observer">{!! $data['title'] !!}</h1>
          <div class="b-co__c">
            @if($data['subtitle'])<div class="b-co__st">{!! $data['subtitle'] !!}</div>@endif
            @if($data['text'])<div class="b-co__tx">{!! $data['text'] !!}</div>@endif
            <div class="b-co__l anchors">
              @if(isset($data['link']['url']))<a href="{{ $data['link']['url'] }}" @if($data['link']['target']){{ 'target="_blank" rel="noopener"' }}@endif class="b"><span><span>{{ $data['link']['title'] }}</span></span></a>@endif
              @forelse ($data['anchors'] as $anchor)
                <div data-href="{{ $anchor['item']['url'] }}" class="b anchor"><span><span>{{ $anchor['item']['title'] }}</span></span></div>
              @empty
              @endforelse
            </div>
          </div>
        </div>
      </div>
      <div class="@if($data['choice'] === 'icon'){{ 'col-lg-10 offset-lg-1' }}@else{{ 'b-co__i' }}@endif h100">
        @if($data['choice'] === 'icon')<div class="b-co__p h100">@endif
        @include('elements/image', ['data' => $data['image']])
        @if($data['choice'] === 'icon')</div>@endif
      </div>
    </div>
  </div>
</section>