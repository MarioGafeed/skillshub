<!-- @if(session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
   @foreach($errors->all() as $error)
      <p>{{ $error }}</p>
   @endforeach
</div>
@endif -->


<div id="success-div" class="alert alert-success">
  {{ session('success') }}
</div>

<div id="errors-div" class="alert alert-danger">
  
</div>
