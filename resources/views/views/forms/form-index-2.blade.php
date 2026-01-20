@extends('forms.layouts.header')
@section('content')
	<?php
	$tenderid = 0;
	$email = "";
	$decisionId = 0;

	function getQParam($param) {
		$res = "";
		if (strpos($_SERVER['QUERY_STRING'], $param) >= 0) {
			$line0 = substr($_SERVER['QUERY_STRING'], strpos($_SERVER['QUERY_STRING'], $param) + strlen($param));
			if (!strpos($line0, '&')) $res = $line0; else
				$res = substr($line0, 0, strpos($line0, '&'));
		}
		return $res;
	}
	if (strpos($_SERVER['QUERY_STRING'], 'tenderid') >= 0) {
		$line0 = substr($_SERVER['QUERY_STRING'], strpos($_SERVER['QUERY_STRING'], 'tenderid') + 9);
		if (!strpos($line0, '&')) $tenderid = $line0; else
			$tenderid = substr($line0, 0, strpos($line0, '&'));
	}
	if (strpos($_SERVER['QUERY_STRING'], 'email') >= 0) {
		$line0 = substr($_SERVER['QUERY_STRING'], strpos($_SERVER['QUERY_STRING'], 'email') + 6);
		if (!strpos($line0, '&')) $email = $line0; else
			$email = substr($line0, 0, strpos($line0, '&'));
	}if (strpos($_SERVER['QUERY_STRING'], 'decisionId') >= 0) {
		$line0 = substr($_SERVER['QUERY_STRING'], strpos($_SERVER['QUERY_STRING'], 'decisionId') + 11);
		if (!strpos($line0, '&')) $decisionId = $line0; else
			$decisionId = substr($line0, 0, strpos($line0, '&'));
	}
	?>
    <form id="form" method="post" action="/page2/create">

        <br/><br/>
        <div>
            <div>אני הח"מ,</div>
            <br/>
            <div class="header_line faind_line"> נתוני מכרז</div>
            <br/>
            <div style="display:flex;flex-direction: row;background:white;justify-content: space-between">

                <div class="tenderdata">
                    <div class="tenderdata_header">מספר מכרז:</div>
                    <div class="tenderdata_id">{{$tenderid}}</div>
                </div>
                <div class="tenderdata">
                    <div class="tenderdata_header">מועמד לתפקיד:</div>
                    <div class="tenderdata_id">{{$tname}}</div>
                </div>
                <div class="tenderdata">
                    <div class="tenderdata_header">שם פרטי + שם משפחה:</div>
                    <div class="tenderdata_id">{{$applicant_name}}</div>
                </div>
                <div class="tenderdata">
                    <div class="tenderdata_header">מספר ת.ז:</div>
                    <div class="tenderdata_id">{{$tz}}</div>
                </div>
            </div>
            <div>
                <input type="hidden" name="tenderid" value="{{$tenderid}}"/>
                <input type="hidden" name="email" value="{{$email}}"/>
                <input type="hidden" name="decisionId" value="{{$decisionId}}"/>


            </div>
            <div>
                <div></div>
                <div class="faind_line">


                    <div class="input-control">
                        <label>
                            <span class="caption captiobblue" style="font-weight: bold;">* מצהיר/ה בזאת כי:</span><br>
                            <label class="radio">
                                <input onchange="chg_relat()" type="radio" name="if_relatives" value="yes"
                                       required="true" id="if_relatives_yes">
                                <span class="virtual"></span>

                                <span class="caption">אין לי קרובי משפחה המועסקים בעיריית אשדוד או המכהנים כחברי מועצת הרשות, לרבות קרבת משפחה חורגת.</span>
                            </label>
                            <label class="radio">
                                <input onchange="chg_relat()" type="radio" name="if_relatives" value="no"
                                       id="if_relatives_no" required="true">
                                <span class="virtual"></span>

                                <span class="caption"> יש לי קרובי משפחה המועסקים בעיריית אשדוד או המכהנים כחברי מועצת הרשות, לרבות קרבת משפחה חורגת.י</span>
                            </label>
                        </label>
                    </div>

                </div>
                <div class="bold caption">אנא פרט/י (נדרש לציין האם קרוב המשפחה חבר מועצה / חבר וועד):</div>
            </div>
            <div>
                <div class="header_line faind_line">
                    קרובי משפחה המועסקים בעיריית אשדוד
                </div>
                <div class="faind_line" style="margin-bottom: 0" id="all_relatives">
                    <div id="relatives_block">
                        <div id="relatives_line">
                            <div class="input-control inline">
                                <div>
                                    <div class="caption max-w180" style="margin-right:10px">שם פרטי</div>
                                    <input type="text" name="relative_firstname[]" required=""
                                           pattern="^[a-zA-Zא-ת\s]+$"
                                           style="margin-right:10px"
                                           class="max-220"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="input-control inline">
                                <div>
                                    <div class="caption max-w180">שם משפחה</div>
                                    <input type="text" name="relative_lastname[]" required="" pattern="^[a-zA-Zא-ת\s]+$"
                                           class="max-220"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="input-control inline">
                                <div>
                                    <div class="caption max-w180">מספר ת.ז</div>
                                    <input type="text" name="relative_id_tz[]" required="" pattern="^[0-9]+$"
                                           class="max-220"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="input-control inline">
                                <div>
                                    <div class="caption max-w180">יחס קרבה</div>
                                    <select class="max-220" name="relative_distance[]" style="margin-right: 1px">
                                        <option value="הורה">הורה</option>
                                        <option value="בן / בת">בן / בת</option>
                                        <option value=" סב / סבתא">אחות סב / סבתא</option>
                                        <option value="אח">אחיין / אחיינית</option>
                                        <option value="דוד">אח / אחות</option>
                                        <option value="גיס / גיסה (לרבות בני זוגם)">גיס / גיסה (לרבות בני זוגם)</option>
                                        <option value="דוד / דודה (לרבות בני זוגם)">דוד / דודה (לרבות בני זוגם)</option>
                                        <option value="חותן / חותנת">חותן / חותנת</option>
                                        <option value="חם / חמות">חם / חמות</option>
                                        <option value="חתן / כלב">חתן / כלב</option>
                                        <option value=" נכד / נכדה"> נכד / נכדה</option>

                                    </select>
                                </div>
                            </div>
                            <br/>
                            <div class="input-control inline">
                                <div>
                                    <div class="caption max-w180">שם היחידה</div>
                                    <input type="text" name="relative_name_d[]" required="" pattern="^[a-zA-Zא-ת\s]+$"
                                           class="max-220"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="input-control inline">
                                <div>
                                    <div class="caption max-w180">תיאור התפקיד</div>
                                    <input type="text" name="relative_name_d1[]" required="" pattern="^[a-zA-Zא-ת\s]+$"
                                           class="max-660"
                                           style="width:710px"
                                           placeholder="">
                                </div>
                            </div>
                            <div class="input-control">
                                <div>
                                    <div class="caption max-w300">אנא פרט/י (נדרש לציין האם קרוב המשפחה חבר מועצה / חבר
                                        וועד):
                                    </div>
                                    <textarea type="text" name="relative_descrt[]" required=""
                                              pattern="^[a-zA-Zא-ת\s]+$"
                                              class="max-880 height-2lines"
                                              style="width:955px"

                                              placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="addbutton" onclick="dublibe('relatives_block','relatives_line')">הוסף
                    </button>
                </div>
                <br/>
                <div class="faind_line">
                    <div style="display: flex">
                        <div style="margin-left:5px"><input type="checkbox" name="relative_confirm1" class="" value="2"
                                                            id="educ_school"></div>
                        <div class="caption max-w180 bold"><span>הריני לאשר כי הובא לידיעתי, שבהתאם להוראות סעיף 174 א' לפקודת העיריות והוראות חוזר מנכ"ל 3/2011, שעניינם סייגים להעסקת קרובי משפחה,
   </span><br/>
                            <span>ככל שקיימת קרבת משפחה לעובדי העירייה או נבחרי ציבור יכול והעסקתי לא תאושר כאמור בהוראות אלו.</span>
                        </div>
                    </div>
                </div>

                <hr/>
                <div class="faind_line">
                    <div style="display:flex">
                        <div style="position:relative;top:-6px;margin-left:5px"><input type="checkbox"
                                                                                       name="relative_confirm2" class=""
                                                                                       value="2" id="educ_school"></div>
                        <div class="caption bold max-w180">הנני מצהיר בזאת כי כל הפרטים שמסרתי לעיל נכונים.</div>
                    </div>
                </div>
                <div class="faind_line" style="display: flex">
                    <div style="position:relative;top:-6px;margin-left:5px"><input type="checkbox"
                                                                                   name="relative_confirm3" class=""
                                                                                   value="2" id="educ_school"></div>
                    <div class="caption max-w180"> ידוע לי כי מסירת פרטים לא נכונים ו/או דיווח חלקי על קרובי משפחתי,
                        עלול להביא לביטול זכייתי בתפקיד ו/או הפסקה מידית של עבודתי ברשות.
                    </div>
                </div>
            </div>

            <div class="faind_line mi100" style="display: flex;flex-direction: column">
                <br>
                <div class="signature-container" style="text-align: left;float: left; padding-bottom: 50px;">
                    <span class="caption" style="vertical-align: bottom;color:black">חתימה:</span>
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
                    <button class="btn btn-lg btn-default success bottom-btn-first" id="reportSendBtn" onclick="goback()"
                            style="margin:10px 10px 10px 1px;   background:#7fb742;width:200px;border-bottom-left-radius: 0;border-top-left-radius: 0"

                            type="submit">
                        שלח בקשה
                    </button>
                    <button class="btn btn-lg btn-default success bottom-btn-second" id="reportSendBtn" onclick="checksubmit()"
                            style="margin:10px 1px 10px 10px;   background:#7fb742;width:200px;border-top-right-radius:0;border-bottom-right-radius:0"

                            type="submit">
                        שלח
                    </button>
                </div>
                <br>
                <div class="submit-error-msg"></div>
            </div>
        </div>
    </form>
    <script language="JavaScript">
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
