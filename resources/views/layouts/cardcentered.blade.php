<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            {{-- <div class="col-md-6">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body"> --}}
            {{-- <h1>Login</h1>
                            <p class="text-muted">Sign In to your account</p> --}}
            @yield('content')
            {{-- </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</body>

</html>