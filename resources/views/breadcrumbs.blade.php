<div class="container">

    <a href="{{ url()->to('/') }}">Home</a>
    
    @php
    $bread = url()->to('/');
    $link = request()->path();
    $subs = explode('/', $link);
    @endphp

@if (request()->path() !== '/')

>

@for ($i = 0; $i < count($subs); $i++)

@php 
      $bread = $bread."/".$subs[$i]; 
      $title = urldecode($subs[$i]);
      $title = str_replace("-", " ", $title);
      $title = ucfirst($title);
      @endphp

<a href="{{ $bread }}"><span>{{ $title }}</span></a>

@if ($i !== (count($subs) - 1))
>        
@endif

@endfor

@endif
</div>