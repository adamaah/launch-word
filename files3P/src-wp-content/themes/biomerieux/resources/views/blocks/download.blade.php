{{--
  Title: Download
  Description: List of files to download
  Category: template-blocks
  Icon: download
  Post-Type: page post
  Keywords: download, file, list
--}}

@php
  $data = Block::download($block['data']);
@endphp

<section class="b-d has-bg big">
  <div class="container">
    <div class="row">
      @forelse ($data['files'] as $item)
        <div class="col-24 col-lg-10 @if($loop->index % 2 === 0){{ 'offset-lg-1' }}@else{{ 'offset-lg-2' }}@endif">
          <div class="b-d__w">
            @if($item['title'])<div class="b-d__t">{!! $item['title'] !!}</div>@endif
            @if($item['file'])<a href="{{ $item['file'] }}" download target="_blank" rel="noopener" class="b"><span><span>{{ __('Download', 'biomerieux') }}</span></span></a>@endif
          </div>
        </div>
      @empty
      @endforelse
    </div>
  </div>
</section>