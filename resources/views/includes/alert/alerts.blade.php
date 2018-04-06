@if ($errors->any())
  @foreach ($errors->all() as $error)
    <div class=" text-left alert alert-danger" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>   
      <p>{{$error}}</p>
    </div>
  @endforeach
@endif

@if (session()->has('message'))
<div class="col-12 align-self-end text-left">
  <div class="alert alert-warning" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
    <h6 class="alert-heading">{{ session('message') }}</h6>
  </div>
</div>
@endif

@if(session('success'))
<div class="col-md-5 align-self-end col-12 col-sm-12 col-lg-4 col-xl-3 text-left">
  <div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
    <h6 class="alert-heading">{{ session('success') }}</h6>
  </div>
</div>
@endif

@if(session('error'))
<div class="col-md-5 align-self-end col-12 col-sm-12 col-lg-4 col-xl-3 text-left">
  <div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
    <h6 class="alert-heading">{{ session('error') }}</h6>
  </div>
</div>
@endif

@if(session('update'))
<div class="col-md-5 align-self-end col-12 col-sm-12 col-lg-4 col-xl-3 text-left">
  <div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
    <h6 class="alert-heading">{{ session('update') }}</h6>
  </div>
</div>
@endif