<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$pageTitle}}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/img/favicon-16x16.png')}}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/earlyaccess/opensanshebrew.css" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sky-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sky-style-new.css') }}" rel="stylesheet">
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    
    <script src="{{asset('js/signature-pad.js')}}"></script>
    
</head>
<body>
    <div id="app" class="{{ Request::segment(1) }}">

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <div id="fader"><img src="{{ asset('img/loader.gif') }}"></div>
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>
