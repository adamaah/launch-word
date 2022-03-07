<div class="breadcrumb">
  <div class="container">
    <div class="row">
      <div class="col-auto">
        @php
          if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<div id="breadcrumbs">','</div>');
          }
        @endphp
      </div>
    </div>
  </div>
</div>