<!DOCTYPE html>
<html dir="rtl" lang="he-IL">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description" content="בקשת העברה למסגרת אחרת - בתי ספר  - מחלקת החינוך"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>המועצה האזורית לכיש - מחלקת חינוך</title>

    <meta http-equiv="X-UA-Compatible" content="IE=11"/>
    <meta http-equiv="Content-Language" content="he"/>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/img/favicon-16x16.png') }}">

    <link href="{{ asset('/front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/front/css/main.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/front/css/media.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/front/css/new.css') }}" rel="stylesheet"/>


</head>
<body style="direction: rtl">
<div class="container">



    <main>

@yield('content')
@extends('forms.layouts.footer')
