{{--
  Title: FAQ
  Description: List of questions and answers
  Category: template-blocks
  Icon: editor-help
  Post-Type: page post
  Keywords: faq, question, answer
--}}

@php
  $data = Block::faq($block['data']);
@endphp

<section class="b-faq mid">
  <div class="container">
    <div class="row">
      @foreach ($data['faq'] as $item)
        <div @if($item['anchor']) id="{{ $item['anchor'] }}" @endif class="b-faq__c">{!! $item['title'] !!}</div>
        <div class="dropdown">
          @foreach ($item['questions'] as $content)
            <div class="dropdown__item">
              <div class="dropdown__head">
                <div class="dropdown__title">{!! $content['question'] !!}</div>
                <div class="dropdown__icon">{!! display_svg('arrow-blue') !!}</div>
              </div>
              <div class="dropdown__content">
                <div class="dropdown__text">
                  <div class="dropdown__text-i">{!! wpautop($content['answer_left']) !!}</div>
                  <div class="dropdown__text-i">{!! wpautop($content['answer_right']) !!}</div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endforeach
    </div>
  </div>
</section>