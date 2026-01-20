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
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/img/favicon-16x16.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="{{ asset('/front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/front/css/main.css') }}" rel="stylesheet"/>
    <link href="{{ asset('/front/css/media.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.1.219/styles/kendo.default-v2.min.css"/>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
	<script src="https://kit.fontawesome.com/aaa0796509.js" crossorigin="anonymous"></script>
	<script src="https://cdn.enable.co.il/licenses/enable-L51276pyktl8fbi-0320-12177/init.js"></script>
    <script language="JavaScript">
        function closeLine(tag)
        {
            console.log('tt',tag);
            if (tag && tag.parentElement && tag.parentElement.style)
            {
                let ntag=tag.parentElement;
                let top=window.scrollY;
                let x=window.scrollX;
                let idd=ntag.parentElement.id;
                console.log('idd',idd);
                if ((idd ==='add_educ_block' || idd ==='language_block' || idd === 'relatives_block'))
                {
                    ntag.style.display='none';
                   // con
                    setTimeout(()=> {
                        window.scrollTo(x,top);
                    },100);


                } else {
                    let lparent= tag.parentElement;
                    console.log('ttAA2', tag.parentElement);
                 //   if (tag.parentElement.childElementCount<=1)


                    if (lparent)
                    {
                        lparent.parentElement.style.display = 'none';

                        // if (lparent.parentElement.parentElement.scrollIntoView());
                       // console.log('qq',lparent,lparent.previousSibling);
                        if (lparent.previousSibling && lparent.previousSibling.style && lparent.previousSibling.style.display!=='none')
                        {
                           // console.log('sct', lparent.previousSibling);
                            setTimeout(()=> {
                                window.scrollTo(x,top);
                            },100);


                        }
                        else {
                           // console.log('scw', lparent.parentElement);
                           // console.log('top',window.scrollY);


                            setTimeout(()=> {
                               // lparent.parentElement.scrollIntoView();
                                window.scrollTo(x,top);
                            },100);


                        }

                    }
                }
              //  var pe=temp1.parentElement;
               // if ()
               //
           // <div id=​"add_education_line">​…​</div>​<div class=​"aline">​…​</div>​<br>​<div class=​"aline">​…​</div>​<a href=​"#" class=​"closebtn" onclick=​"closeLine(this)​">​…​</a>​</div>​
             //   temp1.parentElement.style.display='none
            }

        }
        function dublibe(block, line) {
            var langPos = document.getElementById(block);
            var langLine = document.getElementById(line).cloneNode(true);
            //console.log('tp', langLine);
            var res=langLine.querySelectorAll('input, textarea');
            for(var i=0;i<res.length;i++)
            {
                res[i].value='';
            }
            let btn=langLine.querySelector(".closebtn");
            if (btn) btn.style.display='';
            if (btn) btn.style.visibility='visible';
            console.log(langLine);
            langLine.style.display='';
          //  langLine.style.visibility='visible';
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

		function showLine1() {
            var rt = document.getElementById("formvals1");
            if (!rt.value || rt.value === 0) {
                var el = document.getElementById("experience_line_0");
                if (el && el.style) el.style.display = '';
            }
            else {
                let val = rt.value;
                var el2 = document.getElementById("experience_line_" + val);
                if (el2 && el2.style) el2.style.display = '';

                val++;
                rt.value = val;

            }

        }
			function showLineFile(e) {
			//	debugger;
				
				 var rts = $(e).parents('.file-block').children('input.formvalsfilestatic');
				 var rt = $(e).parents('.file-block').children('input.formvalsfile');
            //var rt = document.getElementById("formvalsfile");
            
                let val = Number(rt.val())+1;
				let valStatic = Number(rts.val())+10;
				if(val<valStatic){
                var el2 = document.getElementById("add_file_line_" + val);
                if (el2 && el2.style) el2.style.display = '';

              //  val++;
                rt.val(val);// = val;
				}

            

        }
		
			function showLineEdu() {
				var rt = document.getElementById("formvalsedu");
				if (!rt.value || rt.value === 0) {
					var el = document.getElementById("add_edic_line_0");
					if (el && el.style)
					{
						el.style.display = 'inherit';
						/*el.style.display='flex';
						el.style.flex-direction='row';
						el.style.justify-content='space-between';*/
					}
				}
				else {
					let val = rt.value;
					console.log(val);
					var el2 = document.getElementById("add_edic_line_" + val);
					if (el2 && el2.style){
						el2.style.display = 'inherit';
						/*el2.style.display='flex';
						el2.style.flex-direction='row';
						el2.style.justify-content='space-between';*/
					}

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

/*
        $(document).on("submit", "#form", function (e) {
            console.log('submiinside', e);
            e.target.action = "/page1";
            e.preventDefault();
            e.stopPropagation();
            $(".submit-error-msg").html("");
            $("#form").removeClass("invalid");
        });

*/
    </script>
</head>
<body>
<div class="container">
    <div class="top-row" style="padding:20px 20px auto 20px; height:100%;  background:white; ">
         <div class="nopadding" style="margin-left: 30px;margin-right:0px;margin-top:10px;">
            <a href="" class="logo"><img class="logo-img" style="width:127px;height:140px;" src="{{ $tender->body ? asset($tender->body_image_URL) : 'img/logo-b.png' }}"/>
            </a>
        </div>
        <div class="site-title-content" style="text-align:center;margin-left: 5px; margin-top:20px;margin-bottom: 35px; width: 100%;">
            <h2 class="site-title">אגף משאבי אנוש</h2>
            <h4 class="site-title" style="font-weight:400">שאלון אישי למועמד למשרה פנויה</h4>
			<div class="header-date" style="float:left;margin-left:20px;">{{ date('d-m-Y' )}}</div>
        </div>
        <br>
    </div>
    <main>

@yield('content')
@extends('forms.layouts.footer')
