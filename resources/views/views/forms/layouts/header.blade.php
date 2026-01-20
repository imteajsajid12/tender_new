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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="{{ asset('/front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/front/css/main.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/front/css/media.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.1.219/styles/kendo.default-v2.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script language="JavaScript">
        function dublibe(block, line) {
            var langPos = document.getElementById(block);
            var langLine = document.getElementById(line).cloneNode(true);
            langLine.style.display='';
            langPos.appendChild(langLine);
        }

        function showchangepostaladdress ()
        {
            var doc=document.getElementById('personal_postal_address_yes');
            var target=document.getElementById('postalblock');
            if (doc && target) {
                if (!doc.checked) target.style.display='';else target.style.display='none';
            }
        }

        function dublibe2(block, line) {
            var langPos = document.getElementById(block);
            var langLine = document.getElementById(line).cloneNode(true);
            langPos.appendChild(langLine);
        }

        function showLine() {
            var rt = document.getElementById("formvals");
            if (!rt.value || rt.value === 0) {
                var el = document.getElementById("recomendations_line_0");
                if (el && el.style) el.style.display = '';
            }
            else {
                let val = rt.value;
                var el2 = document.getElementById("recomendations_line_" + val);
                if (el2 && el2.style) el2.style.display = '';

                val++;
                rt.value = val;

            }
        }

        function chg_relat() {
            //console.log('chk relatives');
            //var btns=document.getElementsByName("if_relatives");
            var relBlock = document.getElementById("all_relatives");
            var no = document.getElementById("if_relatives_no");
            var yes = document.getElementById("if_relatives_yes");
            console.log('blc', yes, no, yes.value, no.value);
            if (yes && yes.checked) {

                if (relBlock && relBlock.style) {
                    console.log('yes++', relBlock, relBlock && relBlock.style ? 'da' : 'net');

                    relBlock.style.display = 'none';
                }
            } else if (no && no.checked) {
                if (relBlock && relBlock.style) {

                    relBlock.style.display = '';
                    console.log('n!!---!!o', relBlock, relBlock && relBlock.style ? 'da' : 'net');

                }
                console.log('n!!!!o', relBlock, relBlock && relBlock.style ? 'da' : 'net');

            }

        }


        $(document).on("submit", "#form", function (e) {
            console.log('submiinside', e);
            e.target.action = "/page1";
            e.preventDefault();
            e.stopPropagation();
            $(".submit-error-msg").html("");
            $("#form").removeClass("invalid");
        });


    </script>
</head>
<body>
<div class="container">
    <div class="top-row" style="padding:20px 20px auto 20px; height:180px;  background:white; ">
        <div class="nopadding" style="margin-left: 30px;margin-right:0px;margin-top:10px;position:absolute;">
            <a href="" class="logo"><img  style="transform:scale(0.8) translateY(10px)" src="img/logo.png"/>
            </a>
        </div>
        <div class="site-title-content" style="text-align:center;margin-left: 5px; margin-top:20px; width: 100%;">
            <h2 class="site-title">אגף משאבי אנוש</h2>
            <h4 class="site-title" style="font-weight:400">טופס הגשת מועמדות למכרזי משאבי אנוש</h4>

        </div>
        <div class="site-title-content" style="margin-right: 15px; margin-left: 5px; width: 60%;">
        </div>
        <div style="float:left;margin-left:20px;transform: translateY(20px)">{{ date('d-m-yy' )}}</div>
        <br/>


    </div>

<?php
	$url = 0;
	$spos=substr($_SERVER['REQUEST_URI'],1,5);
	//echo($spos.'<hr/>');
	$page1=true;
	$page2=false;
	$page3=false;
	switch($spos) {

		case "page2":
            $page1=true;
			$page2=true;
			$page3=false;
			break;
			case "page3":
            $page1=true;
			$page2=true;
			$page3=true;
			break;
	}
	//$stat=["p1"=>$page1,"p2"=>$page2,"p3"=>$page3];
	//echo($spos."!!!!"." ".($spos==="page2"?'-':'+').$page2?'2':'net');
	//echo(json_encode($spos)." ".json_encode($stat));

 //php if ($page2) echo($_SERVER['REQUEST_URI']." "."activetop"); else echo('ttop');

	?>
    <div class="faind_line" style="margin-bottom: 0;background:white">
        <div class="ttop" style="display:flex;align-items: center">
            <div class="activetop" style=" display:flex;height:40px">
                <div class="round" style="margin-right:10px;padding-top: 2px">1</div>
                <div class="bold topnavigatorbar" style="white-space:nowrap"> שאלון אישי למועמד/ת למכרז</div>

            </div>
<?php if (!$page2 && !$page3) echo('<div class="arrow-left"></div>') ?>

            <div class="<?php if ($page2) echo("activetop"); else echo('ttop'); ?>"
                 style="border:none;
                 <?php if (!$page2 && !$page3) echo (' margin-top:8px;height:36px;margin-right:50px'); else echo ('display:flex;');
                 if ($page3) echo('height:40px');
                 ?>
                ">
                <span  <?php if ($page1 && !$page2 && !$page3) echo ('class="round_white"'); else echo ('class="round" style="margin-right:10px;padding-top: 2px"'); ?>>2</span>

                <span class="bold topnavigatorbar"> הצהרת קרובי משפחה</span>
	            <?php if ($page2 && !$page3) echo('<div class="arrow-left" style="margin-top:0px"></div>') ?>

            </div>
            <div class="<?php if ($page3) echo("activetop"); else echo('ttop');?>"
                 style="border:none;
                 <?php if ($page3) echo("width:100%;height:40px;padding-top:6px"); else echo('  margin-top:10px;height:36px;margin-right:50px'); ?>
                         ">
                <span class="round_white">3</span>
                <span class="bold topnavigatorbar"  style="white-space:nowrap">הגשת מועמדות</span>


            </div>
            <div              style="    <?php if ($page3) echo("height:46px;width:1px;background:transparent"); else echo(''); ?>"
            >
            </div>

        </div>
    </div>
    <main>

@yield('content')
@extends('forms.layouts.footer')
