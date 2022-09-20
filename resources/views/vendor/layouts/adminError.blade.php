@if(Session::has('success'))
<div class="alert alert-success">
    <strong>Success!</strong> {{ Session::get('success') }}
  </div>
@elseif(Session::has('failed'))
  <div class="alert alert-danger">
    <strong></strong> {{ Session::get('failed') }}
  </div>
  @elseif(Session::has('warning'))
  <div class="alert alert-warning">
    <strong> {{ Session::get('warning') }}</strong>
  </div>

@endif