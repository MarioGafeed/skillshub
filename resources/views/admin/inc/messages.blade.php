@if(session('msg'))
<div class="alert alert-success">
  {{ session('msg') }}
</div>
@endif

@if(session('msgError'))
<div class="alert alert-danger">
  {{ session('msgError') }}
</div>
@endif
