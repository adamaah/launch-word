{{--
  Title: Form
  Description: Formulaire
  Category: template-blocks
  Icon: forms
  Post-Type: page post
  Keywords: form, formulaire
--}}

@php
  $data = Block::form($block['data']);
@endphp

<section class="b-fo">
  @include('components/form', ['data' => $data])
</section>