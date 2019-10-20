<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ url()->to('/') }}">/</a></li>
    @php
    $bread = url()->to('/');
    $link = request()->path();
    $subs = explode('/', $link);
    @endphp

    @if (request()->path() !== '/')

    @for ($i = 0; $i < count($subs); $i++) @php $bread=$bread."/".$subs[$i]; $title=urldecode($subs[$i]);
        $title=str_replace("-", " " , $title); $title=ucfirst($title); @endphp <li
        class="breadcrumb-item {{ $i === (count($subs) - 1) ? 'active':''}}">
        <a href="{{ $bread }}"><span>{{ $title }}</span></a>
        </li>

        @endfor

        @endif

        <li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">
                <a class="btn" href="#">
                    <i class="icon-speech"></i>
                </a>
                {{-- <a class="btn" href="./">
    <i class="icon-graph"></i> &nbsp;Dashboard</a>
    <a class="btn" href="#">
        <i class="icon-settings"></i> &nbsp;Settings</a>
    </div> --}}
        </li>
</ol>