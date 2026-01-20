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
    <link href="{{ asset('css/check-status.css') }}" rel="stylesheet">
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
</head>
<body>
	<main class="box h-100" dir="rtl">
        <div class="container-fluid">
            <div class="row">
               <div class="col pl-0 logo">
                    <a href="#" class="logo__link">
                        <img src="{{asset('img/right-logo.png')}}" />
                    </a>
                </div>
                <div class="col content">
                    <h3 class="content__heading">בדיקת מצב הפניה</h3>
                    <form class="request" method="post" action="/check-status/check">
                        <label>
                            <input placeholder="מס' ת.ז." />
                        </label>
                        <button class="btn btn-success">בדוק</button>
                    </form>
                    <div class="response">
                    </div>
                </div>
            </div>
            <div class="row footer">
                <div class="col-12">
                    <ul>
                        <li>רח' הגדוד העברי 10</li>
                        <li>ת.ד. 28 אשדוד 7710001</li>
                        <li>ט.ל: 08-8545400</li>
                    </ul>
                </div>
                <div class="col-12">
                    <ul>
                        <li>www.ashdod.muni.il </li>
                        <li>galit@ashdod.muni.il</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <div id="fader"><img src="{{ asset('img/loader.gif') }}"></div>
    <script src="{{asset('js/check-status.js')}}"></script>
</body>
</html>