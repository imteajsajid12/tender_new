<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$pageTitle}} | www.kiryat-arba.muni.il</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/img/favicon-16x16.png')}}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/earlyaccess/opensanshebrew.css" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sky-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/v2.css') }}" rel="stylesheet">
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    @if(isset($appChart))
        <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset="utf-8"></script>
    @endif
</head>
<body dir="rtl">

    @guest

    @else
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @endguest

    <header id="header" class="header">
        <nav class="navbar navbar-expand-sm">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
					<li class="nav-item {{ (request()->is('admin/tenders')) ? 'active' : '' }}">
						<a class="nav-link" href="/admin/tenders">מכרזים</a>
					</li>
					<li class="nav-item {{ (request()->is('admin/tenders/requestsorted/*')) ? 'active' : '' }}">
						<a class="nav-link" href="/admin/tenders/requestsorted/all">פניות</a>
					</li>
					<li class="nav-item {{ (request()->is('admin/apps')) ? 'active' : '' }}">
						<a class="nav-link" href="/admin/apps">אישור פרסום</a>
					</li>
					<li class="nav-item {{ (request()->is('admin/tenders/application/*')) ? 'active' : '' }}">
						<a class="nav-link" href="#">החלטות</a>
					</li>
					@if(\App\User::check_auth_user_permission(1))
						<li class="nav-item {{ (request()->is('admin/users*')) ? 'active' : '' }}">
							<a class="nav-link" href="/admin/users">הגדרות</a>
						</li>
					@endif
                </ul>
                <a href="{{ route('logout') }}" class="logout-link icon icon-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></a>
            </div>
        </nav>
    </header>
    @yield('content')
@extends('layouts.admin.footer')
