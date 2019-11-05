@if (session()->has('success'))

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <h4 class="alert-heading"><span class="icon-check"></span> Success!</h4>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <hr>
  <p class="mb-0">
    {{ session('success')}}
  </p>
</div>

@endif

@if (session()->has('error'))

<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> {{ session('error')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

@endif

@if (session()->has('info'))

<div class="alert alert-info alert-dismissible fade show" role="alert">
  <h4 class="alert-heading"><span class="icon-info"></span> Info</h4>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <hr>
  <p class="mb-0">
    {{ session('info')}}
  </p>
</div>

@endif

@if (session()->has('warning'))

<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Warning:</strong> {{ session('warning')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

@endif

@if (session()->has('errors'))

<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <h4 class="alert-heading"><i class="icon-close"></i> Error</h4>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <hr>
  <ul class="mb-0">
    @foreach ($errors->all() as $message)
    <li>{{ $message }}</li>
    @endforeach
  </ul>
</div>

@endif