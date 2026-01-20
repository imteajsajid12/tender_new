<!DOCTYPE html>
<html dir="rtl" lang="he-IL">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description" content="מחלקת משאבי אנוש"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>עיריית מעלה אדומים - מחלקת משאבי אנוש</title> --}}
	<title>{{ request()->host() }}</title>


    <meta http-equiv="X-UA-Compatible" content="IE=11"/>
    <meta http-equiv="Content-Language" content="he"/>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/img/favicon-16x16.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="{{ asset('/front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/front/css/main.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/front/css/media.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.1.219/styles/kendo.default-v2.min.css"/>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
		<script language="JavaScript">
			function dublibe(block, line) {
				var langPos = document.getElementById(block);
				var langLine = document.getElementById(line).cloneNode(true);
				if (langLine.querySelector('.pn1')) langLine.querySelector('.pn1').value = '';
    			if (langLine.querySelector('.pf1')) langLine.querySelector('.pf1').value = '';
				if (langLine.querySelector('.committee_name')) langLine.querySelector('.committee_name').textContent = '';
				langLine.style.display='';
				var table = document.getElementById(block);
				var length = table.rows.length;
				var uniqeId = line + length;
				langLine.id = uniqeId;
				langPos.appendChild(langLine);
			}

			function remove(tableId, elmeId){
				var table = document.getElementById(tableId);
				var length = table.rows.length;
				if(length > 1){
					var el = document.getElementById(elmeId + (length-1));
					el.remove();
				}
			}
		</script>
    </head>
    <body>
        <div class="container">
			<header id="header6-7" style="display: flex; flex-direction: row; justify-content: space-between;">
				<div>
					בס"ד
				</div>
				<div>
					<h1>
					מועצה מקומית קריית ארבע חברון
					</h1>
				</div>
				<div>
					<a href="/">
						<img src="{{ asset('img/logo-b.png') }}" style="width:200px;"/>
					</a>
				</div>
			</header>
			<hr style="border-bottom: 3px solid #000;">
            <main>
@yield('content')
@extends('forms.layouts.footer')
