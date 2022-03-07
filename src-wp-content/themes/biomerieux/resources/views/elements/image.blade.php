<div class="image @if($data['class']){{ $data['class'] }}@endif">
  <figure>
    <img
    class="@if(!$data['no-lazy']){{ 'lazy' }}@endif {{ $data['class'] }}"
    width="150"
    height="150"
    alt="{{ $data['alt'] }}"
    @if (!$data['no-lazy'])
      src="{{ $data['url-low-quality'] }}"
      data-src="{{ $data['url-low-quality'] }}"
      data-srcset="
        @foreach($data['srcset'] as $key => $value)
          {{ $value . ' ' . $key }},
        @endforeach
      "
    @else
      src="{{ $data['url'] }}" alt="{{ $data['alt'] }}"
      src="{{ $data['url-low-quality'] }}"
      srcset="
        @foreach($data['srcset'] as $key => $value)
          {{ $value . ' ' . $key }},
        @endforeach
      "
    @endif
    data-sizes="
    (max-width: 1023px) 100vw,
    {{ $data['max-width'] }}">
  </figure>
</div>
