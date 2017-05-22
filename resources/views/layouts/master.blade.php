<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', '') }}</title>

    <!-- Styles -->
    @section('styles')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @show

    <!-- Scripts -->
    @section('scripts')
        <script src="{{ asset('js/app.js') }}"></script>
    @show
    
</head>
<body>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a href="/movies">My Movies</a></li>
                <li><a href="/movies/create">Add a Movie</a></li>
            </ul>
        </div>
    </nav>
    
    <div class="container">
        @if (Session::has('message'))
            <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
                {{ Session::get('message') }}
            </div>
        @endif

        @yield('content')        
    </div>

</body>
</html>
