@extends('forms.layouts.header')
@section('content')
    <script language="JavaScript">

      function  gocheck() {
          console.log('gogo');
          var doc=document.getElementById('fform3');
          if (doc && doc.style)
          {
              if (doc.style.display==='none') doc.style.display='';
              else doc.style.display='none';
          }
      }
    </script>
    <script language="JavaScript">


    </script>
    <form id="form" method="post" action="/page3/create">

		<?php
		//$tenderid = 0;
		//$email = "";
		//$decisionId = 0;

		function getQParam($param) {
			$res = "";
			if (strpos($_SERVER['QUERY_STRING'], $param) >= 0) {
				$line0 = substr($_SERVER['QUERY_STRING'], strpos($_SERVER['QUERY_STRING'], $param) + strlen($param) + 1);
				if (!strpos($line0, '&')) $res = $line0; else
					$res = substr($line0, 0, strpos($line0, '&'));
			}
			return $res;
		}
		$tenderid = getQParam("tenderid");
		$email = getQParam("email");
		$decisionId = getQParam("decisionId");
		?>
        <input type="hidden" name="tenderid" value="{{$tenderid}}"/>
        <input type="hidden" name="email" value="{{$email}}"/>
        <input type="hidden" name="decisionId" value="{{$decisionId}}"/>




        <div>
            <div class="header_line faind_line">
                הרשות מקנה עדיפות לזכאים לכך על פי דין, בכדי לקדם את עקרונות הייצוג ההולם ושיוויון ההזדמנויות בעבודה. אם
                את/ה נמנה עם אחת הקבוצות הבאות,
                אנא סמן/י:
            </div>
            <div class="faind_line">
<span>
                <input type="checkbox"  style='    transform: translateY(7px);' name="form3_ch1" class="" value="2" id="educ_school">
                <span class="caption max-w180">אני או אחד מהוריי נולדנו באתיופיה.</span>
                </span>
            </div>
            <div class="faind_line">
<span>
                <input onchange='gocheck()' type="checkbox"  style='    transform: translateY(7px);' name="form3_ch2" class="" value="2" id="educ_school">
                <span class="caption max-w180"> אני אדם עם מגבלות כמשמעו בצו ההרחבה לעידוד והגברת תעסוקה של אנשים עם מוגבלות.</span>
                </span>
            </div>


            <div class="faind_line" id='fform3' style="margin-bottom: 0;display:none">


                <div class="input-control">
                    <div>
                        <div class="caption max-w300">אנא תאר את המוגבלות
                        </div>
                        <textarea type="text" name="form3_text" required="" pattern="^[a-zA-Zא-ת\s]+$"
                                  class="max-880 height-2lines"
                                  placeholder=""></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="input-control"  style="width:300px">
            <label>מסמך רלוונטי (ילדי אתיופיה)</label>
		    <?php $key="0"; $file=$form_file[$key];?>

	        <?php $key = "0"; $file = $form_file[$key];?>
            <div>
                <div class="upload-block">

                    <a href="#" id="rfile-upload-{{$key}}" class="rm" style="display:none"
                       onclick="removeFile({{$key}});return false;"><i
                                class="trash-icon"></i></a>
                    <input type="text" disabled class="btn-input-upload"
                    />
                    <label for="file-upload-{{$key}}" class="btn-upload ">
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="19px" height="13px" style="transform: scale(0.8)  translateY(4px);">
                            <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                  d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z"/>
                        </svg>
                        <span style="margin-top:-2px">

                        בחר קובץ
                        </span>

                    </label>
                    <input id="file-upload-{{$key}}" type="file" name="file[{{$key}}]"
                           onchange="fileChange(this)"
                           accept="application/pdf, image/jpeg, image/jpg, image/gif, image/png, image/jpe, image/tiff, image/bmp, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword" {{$file['required']}} />
                </div>
        </div>
        </div>


        <div class="faind_line">
<span>
                <input type="checkbox"  style='    transform: translateY(7px);' name="relative_confirm2" class="" value="2" id="educ_school">
                <span class="caption max-w180"> ידוע לי, כי רק מי שעומד/ת בכל תנאי הסף תישקל מועמדותו/ה לתפקיד שבמכרז.</span>
                </span>
        </div>
        <div class="faind_line">
<span>
                <input type="checkbox"  style='    transform: translateY(7px);' name="relative_confirm2" class="" value="2" id="educ_school">
                <span class="caption max-w180"> אני מגיש/ה בזאת את מועמדותי למכרז הנ"ל ומצהיר/ה שכל הפרטים שמילאתי בטופס נכונים.</span>
                </span>
        </div>

        <div class="faind_line">
            שימו לב! לאחר הגשת הטופס צריכה להתקבל הודעה כי "הטופס הוזן בהצלחה ונשלח להמשך טיפול", כולל מספר פנייה.

            * לצורך העתק ותיעוד, ניתן להדפיס / לשמור את הטופס שמילאתם מיד לאחר הגשת הטופס בלחיצה על כפתור "הדפס".

            * שימו לב! לאחר הגשת הטופס, תשלח אל כתובת המייל שהזנתם בלשונית "פרטי יצירת קשר" הודעה אוטומטית כי "הטופס
            נשלח בהצלחה", כולל מספר פניה.
            יש לשמור את המייל לצורך מעקב ותיעוד מול מחלקת מכרזי כוח אדם.
        </div>


        <hr/>


        <div class="faind_line mi100" style="display: flex;flex-direction: column">
            <br>
            <div class="signature-container" style="text-align: left;float: left; padding-bottom: 50px;">
                <span class="caption" style="vertical-align: bottom;">חתימה:</span>
                <div class="signature-content" style="position: relative;">
                    <canvas class="signature" width="200" height="140"
                            style="width: calc(100% - 36px);height: 140px;touch-action: none;z-index: 1;position: relative;"></canvas>
                    <span class="plesh_sig">
                     נא תחתום כאן עם העכבר
                </span>
                    <img class="signature-eraser" src="{{ asset('/front/img/eraser.png') }}"/>
                </div>
                <div class="img"></div>
                <input class="signature-text" type="text" name="moth_sign" tabindex="-1" required
                       style="opacity: 0; width: 0.1px; height: 0.1px; margin: 0!important; display: inline-block;">
            </div>

            <div class="center  hidden-pdf" style="display:flex;justify-content:center">
                <button class="btn btn-lg btn-default success" id="reportSendBtn" onclick="goback()"
                        style="margin:10px 10px 10px 1px;   background:#7fb742;width:200px;border-bottom-left-radius: 0;border-top-left-radius: 0"

                        type="submit">
                    לדף הקודם
                </button>
                <button class="btn btn-lg btn-default success" id="reportSendBtn" onclick="checksubmit()"
                        style="margin:10px 1px 10px 10px;   background:#7fb742;width:200px;border-top-right-radius:0;border-bottom-right-radius:0"
                        type="submit">
                    לדף הבא
                </button>
            </div>
                <div class="submit-error-msg"></div>



        </div>
    </form>

    <script language="JavaScript">
        function goback()
        {
            history.back();
        }
        function checksubmit() {
            var rt0 = Array.from(document.getElementsByTagName("textarea"));
            var rt = Array.from(document.getElementsByTagName("input"));
            rt = rt.concat(rt0);
            // rt={...rt,...rt0};
            console.log('chk sub', rt);

            // var doc=document.getElementsByName("form");
            // console.log(doc);
            for (let i = 0; i < rt.length; i++) {
                // console.log(rt[i]);
                rt[i].required = false;
            }
            var email = document.getElementsByName("email")[0];

            window.email = email ? email.value : '';


        }

        function onsubmit() {
            console.log('submitted!');
            //  window.location.href = '/page2/{{$tid}}';
        }
    </script>
@endsection
