@if (session()->has('success'))

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong><span class="icon-check"></span> Success!</strong> {{ session('success')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
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
  <strong><span class="icon-info"></span> Info:</strong> {{ session('info')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
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
  <p><i class="icon-exclamation"></i> There was an error.</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <ul>
    @foreach ($errors->all() as $message)
    <li>{{ $message }}</li>
    @endforeach
  </ul>
</div>

@endif