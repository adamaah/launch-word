{{--
  Title: Content
  Description: Content with title
  Category: template-blocks
  Icon: editor-alignleft
  Post-Type: page post
  Keywords: content, text, two-column
--}}

@php
  $data = Block::content($block['data']);
@endphp

<section class="b-cn">
  <div class="container">
    <div class="b-cn__s">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="b-cn__w h100">
            <h2 class="b-cn__t underline-wrapper js-observer">{!! $data['title'] !!}</h2>
            @if($data['subtitle'])<div class="b-cn__st">{!! $data['subtitle'] !!}</div>@endif
            @if(isset($data['link']['url']))<a href="{{ $data['link']['url'] }}" @if($data['link']['target']){{ 'target="_blank" rel="noopener"' }}@endif class="b"><span><span>{{ $data['link']['title'] }}</span></span></a>@endif
          </div>
        </div>
        <div class="col-lg-10 offset-lg-2">
          <div class="b-cn__w h100">
          @if($data['text'])<div class="b-cn__tx">{!! wpautop($data['text']) !!}</div>@endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>