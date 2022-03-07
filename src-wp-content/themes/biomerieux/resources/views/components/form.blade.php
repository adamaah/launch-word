<div class="fo">
  <div class="container fo__c">
    <div class="fo__f">
      <div class="row">
        <div class="col-lg-12 offset-lg-1">
          <div class="fo__ft">{!! $data['title'] !!}</div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-7 offset-lg-2">
          <div class="fo__fst underline-wrapper js-observer h100">{!! $data['text'] !!}</div>
        </div>
        <div class="col-lg-11 offset-lg-2">
          <div class="fo__fi">{!! do_shortcode('[gravityform id="' . $data['id-form'] . '" title="false" description="false" ajax="false"]') !!}</div>
        </div>
      </div>
    </div>
  </div>
</div>