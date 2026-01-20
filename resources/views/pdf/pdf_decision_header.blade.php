<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title> אגף משאבי אנוש  </title>
    <link href="https://fonts.googleapis.com/earlyaccess/opensanshebrew.css" rel="stylesheet">
    <style type="text/css">
		body{
			direction: rtl;
			margin: auto;
			box-sizing: border-box;
			margin: auto;
			font-size: 18px;
			padding: 0;
			position: relative;
			font-family: 'Open Sans Hebrew';
		}
		body {
			font-size: 18px;
		}
		p {
			margin: 15px 0;
		}
		.site-title {
			font-size: 22.136px;
			color: rgb( 0, 0, 0 );
			font-weight: bold;
			text-transform: uppercase;
			-moz-transform: matrix( 1.35526644815155,0,0,1.35526644815155,0,0);
			-webkit-transform: matrix( 1.35526644815155,0,0,1.35526644815155,0,0);
			-ms-transform: matrix( 1.35526644815155,0,0,1.35526644815155,0,0);
			padding-top: 50px;
		}
		.site-title-content {
			width: 100%;
			margin: 0;
			text-align: center;
		}
		.top-row > div {
			display: inline-block;
		}
		footer {
			position:fixed;
			bottom:0;
			left:0;
			height:200px;
			width: 100%;
		}
	</style>
</head>
<body>
	<header>
		<div>
			<img style="width:127px;height:140px;" src="{{ asset($app_dec?->tender_body_image ?? '/img/logo-b.png') }}">
		</div>
	</header>
	<main>
		<p  style="position:absolute;left:20px;top:26px;" class="date-element">
			<?php
				$str = jdtojewish(gregoriantojd( date('m'), date('d'), date('Y')), true, CAL_JEWISH_ADD_GERESHAYIM); // for today
				$str1 = iconv ('WINDOWS-1255', 'UTF-8', $str); // convert to utf-8
			?>
			<span class="caption" style="float: left;display: block;"><?= $str1?></span><br>
			<span style="float: left;display: block;">
				<?php echo date('d/m/Y'); ?>
			</span>
	  	</p>
		<p style="margin-bottom: 30px;line-height: 2.083;margin-top: 3px;">
		לכבוד<br>
		{{$full_name}}<br>
		{{$email}}<br>
			א.נ/ג.נ,
		</p>
		<p style="text-align: center;text-decoration: underline;font-size: 20px; margin-bottom: 50px;">הנדון: מועמדותך לתפקיד {{$tendername}} - {{ $app_dec?->tender_body ?? 'מועצה מקומית קריית ארבע חברון' }}</p>
