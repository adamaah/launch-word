{{--
  Title: Client
  Description: Logos of client
  Category: template-blocks
  Icon: admin-users
  Post-Type: page post
  Keywords: client, logo,
--}}

@php
  $data = Block::client($block['data']);
@endphp

<section class="b-cl">
  <div class="container">
    <div class="row">
      <div class="col-24"><h2 class="b-cl__t underline-wrapper js-observer">{!! $data['title'] !!}</h2></div>
    </div>
    <div class="row flex-column flex-lg-row align-items-center row-cols-5">
      @foreach ($data['images'] as $image)
        @include('elements/image', ['data' => $image['image']])
      @endforeach
    </div>
    <div class="row">
      <div class="col-24">
        <div class="b-cl__l">
          @if($data['link'])<div href="{{ $data['link']['url'] }}" @if($data['link']['target']){{ 'target="_blank" rel="noopener"' }}@endif class="b"><span><span>{{ $data['link']['title'] }}</span></span></div>@endif
        </div>
      </div>
    </div>
  </div>
</section>