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

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

    <div id="app">

        @include('header')

        <div class="app-body">
            @include('sidebar')
        </div>

        <main class="main">
            @include('breadcrumbs')
            <div class="container-fluid">
                <div id="ui-view">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    @include('footer')

</body>

</html>