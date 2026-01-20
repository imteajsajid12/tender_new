@extends('forms.layouts.header')
@section('content')
	<?php
	$tenderid = 0;
	if (strpos($_SERVER['QUERY_STRING'], 'tenderid') >= 0) {
		$line0 = substr($_SERVER['QUERY_STRING'], strpos($_SERVER['QUERY_STRING'], 'tenderid') + 9);
		if (!strpos($line0, '&')) $tenderid = $line0; else
			$tenderid = substr($line0, 0, strpos($line0, '&'));
	}
	//echo($tenderid);
	//   var_dump($tender);


	?>

    <form id="form" method="post" action="/page1/create">

        <div class="text-center subtop-row" style="display:flex;flex-direction: row;justify-content:space-between;">
            <div style="text-align:right">לכבוד<br/>
                מחלקת מכרזי כוח אדם - עיריית אשדוד,
            </div>
            <div style="text-align:left">קישורים נדרשים:<br/><a target="_blank"
                                                                href="https://www.ashdod.muni.il/he-il/%D7%90%D7%AA%D7%A8-%D7%94%D7%A2%D7%99%D7%A8/%D7%9E%D7%9B%D7%A8%D7%96%D7%99%D7%9D/%D7%9E%D7%9B%D7%A8%D7%96%D7%99%D7%9D/">
                    מחלקת מכרזים - עמוד הבית
                </a></div>


        </div>
        <div class="header_line faind_line">
            נתוני מכרז
        </div>
        <div class="faind_line fullwidth">
            <div class="input-control inline fg2">
                <div>
                    <div class="caption max-w180">שם פרטי</div>
                    <input type="text" name="firstname" required="" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-220"
                           placeholder="">
                </div>
            </div>
            <div class="input-control inline  fg2">
                <div>
                    <div class="caption max-w180">שם משפחה</div>
                    <input type="text" name="soname" required="" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-220 mmr-77"
                           placeholder="">
                </div>
            </div>
            <div class="input-control inline  fg2">
                <div>
                    <div class="caption max-w180">מספר פלאפון</div>

                    <div style="display:flex">
                        <div>
                        <input type="text" name="mobile_phone1" required="" pattern="^[0-9]+$" minlength="7"
                               maxlength="7"
                               class="max-130">
                    </div>

                    <select class="max-65 phn ssla" name="mobile_phone1_select" style="display:block;border-radius: 0">
                        <option value="050">050</option>
                        <option value="052"> 052</option>
                        <option value="053"> 053</option>
                        <option value="054"> 054</option>
                        <option value="055"> 055</option>
                        <option value="057"> 057</option>
                        <option value="058"> 058</option>
                    </select></div></div>
            </div>
            <div class="input-control inline">
                <div class="caption max-w180">מספר טלפון</div>
<div style="display:flex">
                    <input type="text" name="home_phone1" required="" pattern="^[0-9]+$" minlength="7" maxlength="7"
                           class="max-130" style="display:block">
                <select class="max-65 phn ssla" name="home_phone1_select" style="display:block;border-radius: 0">
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                </select></div>
            </div>
        </div>


        <div class="faind_line fullwidth">
            <div class="input-control max-all">
                <label class="max-all">
                    <span class="caption">דוא”ל</span>
                    <input type="email" name="email" required

                           pattern=([a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])
                           class="max-330" style="width:100%"
                           placeholder="username@domainname.co.il"/>
                </label>
            </div>
        </div>
        <div class="header_line faind_line">
            נתוני מכרז
        </div>

        <div class="faind_line fullwidth">


            <div class="input-control">
                <label>
                    <span class="caption captiobblue" style="font-weight: bold;">מכרז</span><br>
                    <label class="radio">
                        <input type="radio" name="tender_type" value="yes" required="true" id="tender_type_yes">
                        <span class="virtual"></span>
                        <span class="caption"> מכרז פנימי</span>
                    </label>
                    <label class="radio">
                        <input type="radio" name="tender_type" value="no" required="true">
                        <span class="virtual"></span>
                        <span class="caption">  מכרז חיצוני</span>
                    </label>
                </label>
            </div>

        </div>


        <hr/>
        <div class="faind_line fullwidth">
            <div class="input-control fg2">
                <label>
                    <span class="caption captiobblue"> מספר מכרז כפי שמופיע במסמכי המכרז (כדוגמת 100/19):</span>
                </label>
                <div>
                <span><input disabled type="text" name="num1" required="" value="<?php echo substr($tenderid, 0, 4) ?>"
                             pattern="^[0-9]+$"
                             class="max-220"></span>
                    <span><input disabled type="text" name="num2" required="" pattern="^[0-9]+$"
                                 value="<?php echo substr($tenderid, strpos($tenderid, '-') + 1); ?>"
                                 class="max-220"></span>
                </div>
                <input type="hidden" name="tenderid" value="<?php echo $tenderid ?>"/>
                <div class="captionline" style="margin-top:5px;padding-top:20px;margin-left:20px;padding-bottom:20px;text-align: center">
                    {{$tenderid}}
                </div>
            </div>
            <div class="input-control fg2">
                <label>
                    <span class="caption captiobblue">*  מועמד/ת לתפקיד</span>
                </label>
                <div>
                    <input type="text" name="candidate_position" required="" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-400"
                           placeholder="מועמד לתפקיד כפי שרשום במסמכי המכרז">
                </div>
                <div class="captionline" style="margin-top:5px;padding-top:20px;padding-bottom:20px;text-align: center">
                    {{$tname}}
                </div>
            </div>
        </div>


        <div class="header_line faind_line">
            פרטים אישיים
        </div>
        <div class="faind_line "
             style="display:flex; flex-direction: row; flex-wrap:wrap; justify-content: space-between">

            <div class="input-control inline fg2">
                <div>
                    <div class="caption bold max-w300">שם פרטי + שם משפחה</div>
                    <input type="text" name="personal_name" required="" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-440"
                           placeholder="">
                </div>
            </div>
            <div class="input-control inline fg2">
                <div>
                    <div class="caption bold max-w300">שם משפחה קודם</div>
                    <input type="text" name="personal_lastname" required="" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-440"
                           placeholder="">
                </div>
            </div>
            <div class="input-control inline fg2">
                <div>
                    <div class="caption bold max-w300"> מספר ת.ז</div>
                    <input type="text" name="id_tz" required="" minlength="9" maxlength="9" pattern="^[0-9]+$"
                           class="mmax-440"
                           placeholder="">
                </div>
            </div>
            <div class="input-control inline fg2">
                <div>
                    <div class="caption bold max-w300"> כתובת דוא"ל</div>
                    <input type="text" name="personal_email" required="" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-440"
                           placeholder="">
                </div>
            </div>
            <div class="input-control inline fg2">
                <div>
                    <div class="caption bold max-w300"> מספר טלפון נייד</div>
                    <input type="text" name="personal_phone" pattern="^[0-9]+$"
                           minlength="10" maxlength="10"

                           class="mmax-440"
                           placeholder="">
                </div>
            </div>
            <div class="input-control inline fg2">
                <div>
                    <div class="caption bold max-w300"> מספר טלפון נוסף</div>
                    <input type="text" name="personal_phone_1" pattern="^[0-9]+$" class="mmax-440"
                           placeholder="">
                </div>
            </div>

        </div>
        <div class="header_line faind_line">
            פרטים אישיים
        </div>
        <div class="faind_line ">

            <div class="aline">
            <div class="input-control inline fg2">
                <div>
                    <div class="caption bold max-w300">עיר מגורים</div>
                    <input type="text" name="personal_city" required="" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-440"
                           placeholder="">
                </div>
            </div>
            <div class="input-control inline fg2">
                <div>
                    <div class="caption bold max-w300">* רחוב</div>
                    <input type="text" name="personal_street" required="true" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-440"
                           placeholder="">
                </div>
            </div>
            </div>
            <div class="aline">

            <div class="input-control inline fg2">
                <div>
                    <div class="caption bold max-w300">* מספר בית</div>
                    <input type="text" name="personal_house" required="" pattern="^[0-9]+$" class="mmax-440"
                           placeholder="">
                </div>
            </div>
            <div class="input-control inline fg2">
                <div>
                    <div class="caption bold max-w300">מספר דירה</div>
                    <input type="text" name="personal_flat" required="" pattern="^[0-9]+$" class="mmax-440"
                           placeholder="">
                </div>
            </div>
            </div>
        </div>
        <div class="faind_line">

            <div class="input-control inline fg2">
                <label></label>
                <label>
                    <span class="caption" style="font-weight: bold;"> כתובת למשלוח דואר</span><br>
                    <label class="radio">
                        <input onchange="showchangepostaladdress()" type="radio" checked name="personal_postal_address"
                               value="yes" required=""
                               id="personal_postal_address_yes">
                        <span class="virtual"></span>
                        <span class="scaption">כתובת למשלוח דואר זהה לכתובת המגורים</span>
                    </label>
                    <label class="radio">
                        <input type="radio" onchange="showchangepostaladdress()" name="personal_postal_address"
                               value="no" required="">
                        <span class="virtual"></span>
                        <span class="scaption">כתובת למשלוח דואר שונה מכתובת המגורים</span>
                    </label>
                </label>
                <div id="postalblock" style="display:none"><input id="postalinout" type="text" name="postal"/></div>
            </div>
        </div>
        <div class="header_line faind_line">
            שפות נוספות
        </div>
        <div class="faind_line">
            <div id="ivrblock" style="">
                <div class="input-control inline">
                    <div>
                        <div class="caption max-w300">השפה</div>
                        <input type="text" name="language_i[]" value="עברית" disabled required=""
                               pattern="^[a-zA-Zא-ת\s]+$" class="max-220"
                               placeholder="">
                    </div>
                </div>
                <div class="input-control inline" id="id1">
                    <div>
                        <div class="caption max-w300">קריאה</div>
                        <select name="language_read_i" class="max-220">
                            <option>-</option>
                            <option>שליטה מלאה</option>
                            <option> שליטה חלקית
                            </option>
                            <option>חוסר שליטה</option>

                        </select>
                    </div>
                </div>
                <div class="input-control inline" id="id2">
                    <div>
                        <div class="caption max-w300">כתיבה</div>
                        <select name="language_write_i" class="max-220">
                            <option>-</option>
                            <option>שליטה מלאה</option>
                            <option> שליטה חלקית
                            </option>
                            <option>חוסר שליטה</option>

                        </select>
                    </div>
                </div>
                <div class="input-control inline">
                    <div>
                        <div class="caption max-w300">דיבור</div>

                        <select name="language_speak_i" class="max-220">
                            <option>-</option>
                            <option>שליטה מלאה</option>
                            <option> שליטה חלקית
                            </option>
                            <option>חוסר שליטה</option>

                        </select>
                    </div>
                </div>
            </div>
            <div id="eblock">
                <div class="input-control inline">
                    <div>
                        <div class="caption max-w300">השפה</div>
                        <input type="text" name="language_e[]" value="אנגלית" disabled required=""
                               pattern="^[a-zA-Zא-ת\s]+$" class="max-220"
                               placeholder="">
                    </div>
                </div>
                <div class="input-control inline">
                    <div>
                        <div class="caption max-w300">קריאה</div>
                        <select name="language_read_e" class="max-220">
                            <option>-</option>
                            <option>שליטה מלאה</option>
                            <option> שליטה חלקית
                            </option>
                            <option>חוסר שליטה</option>

                        </select>
                    </div>
                </div>
                <div class="input-control inline">
                    <div>
                        <div class="caption max-w300">כתיבה</div>
                        <select name="language_write_e" class="max-220">
                            <option>-</option>
                            <option>שליטה מלאה</option>
                            <option> שליטה חלקית
                            </option>
                            <option>חוסר שליטה</option>

                        </select>

                    </div>
                </div>
                <div class="input-control inline">
                    <div>
                        <div class="caption max-w300">דיבור</div>
                        <select name="language_speak_e" class="max-220">
                            <option>-</option>
                            <option>שליטה מלאה</option>
                            <option> שליטה חלקית
                            </option>
                            <option>חוסר שליטה</option>

                        </select>
                    </div>
                </div>
            </div>
            <div class="language_block" id="language_block">
                <div id="language_line" style="display:none">
                    <div class="input-control inline">
                        <div>
                            <div class="caption max-w300">השפה</div>
                            <input type="text" name="language[]" required="" pattern="^[a-zA-Zא-ת\s]+$" class="max-220"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="input-control inline">
                        <div>
                            <div class="caption max-w300">קריאה</div>

                            <select name="language_read_[]" class="max-220">
                                <option>-</option>
                                <option>שליטה מלאה</option>
                                <option> שליטה חלקית
                                </option>
                                <option>חוסר שליטה</option>

                            </select>
                        </div>
                    </div>
                    <div class="input-control inline">
                        <div>
                            <div class="caption max-w300">כתיבה</div>

                            <select name="language_write_[]" class="max-220">
                                <option>-</option>
                                <option>שליטה מלאה</option>
                                <option> שליטה חלקית
                                </option>
                                <option>חוסר שליטה</option>

                            </select>
                        </div>
                    </div>
                    <div class="input-control inline">
                        <div>
                            <div class="caption max-w300">דיבור</div>

                            <select name="language_speak_[]" class="max-220">
                                <option>-</option>
                                <option>שליטה מלאה</option>
                                <option> שליטה חלקית
                                </option>
                                <option>חוסר שליטה</option>

                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="aline" style="flex-direction: row-reverse" >

        <div class="input-control leftbtn">
            <button type="button" class="addbutton" onclick="dublibe('language_block','language_line')">
                <img src="/img/icons/plus.png"/>


                הוסף שורה
            </button>
        </div>
        </div>
        <div class="header_line faind_line">השכלה</div>
        <div class="faind_line">

            <div class="input-control">
                <div style="display:flex;flex-direction: row">
                <span style="display:flex">
                <input type="checkbox" name="educ_kind_low" class=""
                       style="margin-top:-2px; margin-left:3px;margin-right:15px;" value="1" id="educ_low_school">
                <span class="caption  max-w180">השכלה יסודית</span>
                </span>
                    <span style="display:flex">
                <input type="checkbox" name="educ_kind_school" style="margin-top:-2px; margin-left:3px;margin-right:15px;"
                       class="" value="2" id="educ_school">
                <span class="caption  max-w180">השכלה תיכונית</span>
                </span> <span style="display:flex">
                <input type="checkbox" name="educ_kind_high" style="margin-top:-2px; margin-left:3px;margin-right:15px"
                       class="" value="3" id="high_school">
                <span class="caption  max-w180">השכלה גבוהה</span>
                </span>


                </div>
            </div>
            <br/>

            <div>
                <br/><label class="captiobblue bold" style="margin-right:10px">השכלה יסודית</label><br/>
            </div>
            <div id="aline1" class="aline">
                <div class="input-control fg2">
                    <div>
                        <div class="caption captioblack max-w300">שם המוסד</div>
                        <input type="text" name="educ_institution_name" required="" pattern="^[a-zA-Zא-ת\s]+$"
                               class="mmax-220"
                               placeholder="">
                    </div>
                </div>
                <div class="input-control fg2">
                    <div>
                        <div class="caption captioblack max-w300">שם הישוב של המוסד</div>
                        <input type="text" name="educ_institution_name_name" required="" pattern="^[a-zA-Zא-ת\s]+$"
                               class="mmax-220"
                               placeholder="">
                    </div>
                </div>
                <div class="input-control fg2">
                    <div>
                        <div class="caption captioblack max-w300">מספר שנות לימוד</div>
                        <input type="text" name="educ_institution_years_years" required="" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-220"
                               placeholder="">
                    </div>
                </div>
                <div class="input-control fg2">
                    <div>
                        <div class="caption captioblack max-w300">שנת סיום</div>
                        <input type="text" name="educ_last_year" required="" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-220"
                               placeholder="">
                    </div>
                </div>
            </div>
            <br/>
            <div class="aline">
            <div class="input-control fg2">
                <div>
                    <div class="caption captioblack max-w300">המקצוע העיקרי</div>
                    <textarea type="text" name="educ_main_profession" required="" pattern="^[a-zA-Zא-ת\s]+$"
                              class="mmax-440"
                              placeholder=""></textarea>
                </div>
            </div>
            <div class="input-control fg2">
                <div>
                    <div class="caption captioblack  max-w300">התואר / התעודה</div>
                    <textarea type="text" name="educ_diploma" required="" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-440"
                              placeholder=""></textarea>
                </div>
            </div>
            </div>
            <div>
                <label class="captiobblue bold" style="margin-right:10px">השכלה תיכונית</label>
            </div>
<div class="aline">
            <div class="input-control fg2">
                <div>
                    <div class="caption captioblack max-w300">שם המוסד</div>
                    <input type="text" name="educ_school_name" required="" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-220"
                           placeholder="">
                </div>
            </div>
            <div class="input-control fg2">
                <div>
                    <div class="caption captioblack max-w300">שם הישוב של המוסד</div>
                    <input type="text" name="educ_school_namename" required="" pattern="^[a-zA-Zא-ת\s]+$"
                           class="mmax-220"
                           placeholder="">
                </div>
            </div>
            <div class="input-control fg2">
                <div>
                    <div class="caption captioblack max-w300">מספר שנות לימוד</div>
                    <input type="text" name="educ_school_years" required="" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-220"
                           placeholder="">
                </div>
            </div>
            <div class="input-control fg2">
                <div>
                    <div class="caption captioblack max-w300">שנת סיום</div>
                    <input type="text" name="educ_school_endyear" required="" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-220"
                           placeholder="">
                </div>
            </div>
</div>
            <br/>
            <div class="aline">
            <div class="input-control fg2">
                <div>
                    <div class="caption  captioblack max-w300">המקצוע העיקרי</div>
                    <textarea type="text" name="educ_school_profession" required="" pattern="^[a-zA-Zא-ת\s]+$"
                              class="mmax-440"
                              placeholder=""></textarea>
                </div>
            </div>
            <div class="input-control fg2">
                <div>
                    <div class="caption captioblack max-w300">התואר / התעודה</div>
                    <textarea type="text" name="educ_school_duploma" required="" pattern="^[a-zA-Zא-ת\s]+$"
                              class="mmax-440"
                              placeholder=""></textarea>
                </div>
            </div>
            </div>
            <br/>
            <div class="input-control btn-descr">
                <label>אנא צרף תעודת בגרות/ 12 שנות לימוד</label>
				<?php $key = "0"; $file = $form_file[$key];?>
                <div>

                    <div class="upload-block">
                        <a href="#" id="rfile-upload-{{$key}}" style="display:none" class="rm"
                           onclick="removeFile({{$key}});return false;"><i
                                    class="trash-icon"></i></a><input type="text" disabled class="btn-input-upload"
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
                    </div>
                    <input id="file-upload-{{$key}}" type="file" name="file[{{$key}}]"
                           onchange="fileChange(this)"
                           accept="application/pdf, image/jpeg, image/jpg, image/gif, image/png, image/jpe, image/tiff, image/bmp, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword"
                            {{$file['required']}} />

                </div>
            </div>

        </div>
        <div>
            <div>
                <label class="captiobblue bold" style="margin-right:10px">השכלה גבוהה</label>
            </div>
            <div class="aline">

            <div class="input-control fg2">
                <div>
                    <div class="caption captioblack max-w300">שם המוסד</div>
                    <input type="text" name="heduc_name" required="" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-220"
                           placeholder="">
                </div>
            </div>
            <div class="input-control fg2">
                <div>
                    <div class="caption captioblack max-w300">שם הישוב של המוסד</div>
                    <input type="text" name="heduc_namename" required="" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-220"
                           placeholder="">
                </div>
            </div>
            <div class="input-control fg2">
                <div>
                    <div class="caption captioblack max-w300">מספר שנות לימוד</div>
                    <input type="text" name="heduc_school_years" required="" pattern="^[a-zA-Zא-ת\s]+$" class="mmax-220"
                           placeholder="">
                </div>
            </div>
            <div class="input-control fg2">
                <div>
                    <div class="caption captioblack max-w300">שנת סיום</div>
                    <input type="text" name="heduc_school_endyear" required="" pattern="^[a-zA-Zא-ת\s]+$"
                           class="mmax-220"
                           placeholder="">
                </div>
            </div>
            </div>
            <br/>
            <div class="aline">

            <div class="input-control fg2">
                <div>
                    <div class="caption captioblack max-w300">המקצוע העיקרי</div>
                    <textarea type="text" name="heduc_school_profession" required="" pattern="^[a-zA-Zא-ת\s]+$"
                              class="mmax-440"
                              placeholder=""></textarea>
                </div>
            </div>
            <div class="input-control fg2">
                <div>
                    <div class="caption captioblack max-w300">התואר / התעודה</div>
                    <textarea type="text" name="heduc_school_duploma" required="" pattern="^[a-zA-Zא-ת\s]+$"
                              class="mmax-440"
                              placeholder=""></textarea>
                </div>
            </div>
            </div>
            <br/>

            <div class="input-control btn-descr">
                <label>אנא צרף תעודת סיום תואר</label>
				<?php $key = "1"; $file = $form_file[$key];?>
                <div>
                    <div class="upload-block">

                        <a href="#" id="rfile-upload-{{$key}}" style="display:none" class="rm"
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

                        </label></div>
                    <input id="file-upload-{{$key}}" type="file" name="file[{{$key}}]"
                           onchange="fileChange(this)"
                           accept="application/pdf, image/jpeg, image/jpg, image/gif, image/png, image/jpe, image/tiff, image/bmp, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword" {{$file['required']}} />

                </div>

            </div>
        </div>
        <br/>
        <div>
            <div>
                <label class="captiobblue bold" style="margin-right:10px">תואר נוסף </label>
            </div>
            <div id="add_education_block">
                <div id="add_education_line">
                    <div class="aline">
                    <div class="input-control fg2">
                        <div>
                            <div class="caption captioblack max-w300">שם המוסד</div>
                            <input type="text" name="add_educ_name[]" required="" pattern="^[a-zA-Zא-ת\s]+$"
                                   class="mmax-220"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="input-control fg2">
                        <div>
                            <div class="caption captioblack max-w300">שם הישוב של המוסד</div>
                            <input type="text" name="add_educ_namename[]" required="" pattern="^[a-zA-Zא-ת\s]+$"
                                   class="mmax-220"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="input-control fg2">
                        <div>
                            <div class="caption captioblack max-w300">מספר שנות לימוד</div>
                            <input type="text" name="add_educ_school_years[]" required="" pattern="^[a-zA-Zא-ת\s]+$"
                                   class="mmax-220"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="input-control fg2">
                        <div>
                            <div class="caption captioblack max-w300">שנת סיום</div>
                            <input type="text" name="add_duc_school_endyear[]" required="" pattern="^[a-zA-Zא-ת\s]+$"
                                   class="mmax-220"
                                   placeholder="">
                        </div>
                    </div>
                    </div>
                    <br/>
                    <div class="aline">

                    <div class="input-control">
                        <div>
                            <div class="caption captioblack max-w300">המקצוע העיקרי</div>
                            <textarea type="text" name="add_educ_school_profession[]" required=""
                                      pattern="^[a-zA-Zא-ת\s]+$" class="max-440"
                                      placeholder=""></textarea>
                        </div>
                    </div>

                    <div class="input-control">
                        <div>
                            <div class="caption captioblack max-w300">התואר / התעודה</div>
                            <textarea type="text" name="add_educ_school_duploma[]" required="" pattern="^[a-zA-Zא-ת\s]+$"
                                      class="max-440"
                                      placeholder=""></textarea>
                        </div>
                    </div>
                    </div>
                </div>
            <div class="aline" style="flex-direction: row-reverse" >
            <div class="input-control leftbtni">
                <button type="button" class="addbutton " onclick="dublibe('add_education_block','add_education_line')">
                    <img src="/img/icons/plus.png"/>
                    הוספת תואר נוסף


                </button>
            </div>
            </div>
        </div>
        <div>
            <div class="header_line faind_line"> קורסים והשתלמויות בתחום המקצועי הרלוונטי לתפקיד במכרז</div>
            <div id="add_educ_block" class="add_educ_block">
                <div id="add_edic_line" class="add_edic_line">
                    <div class="input-control">
                        <div>
                            <div class="caption max-w300">שם הקורס / השתלמות</div>
                            <input type="text" name="add_educ_name[]" required="" pattern="^[a-zA-Zא-ת\s]+$"
                                   class="max-220"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="input-control">
                        <div>
                            <div class="caption max-w300">תאריך סיום</div>
                            <input type="text" name="add_educ_finish[]" required="" pattern="^[a-zA-Zא-ת\s]+$"
                                   class="max-220"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="input-control">
                        <div>
                            <div class="caption max-w300">מסגרת לימודים</div>
                            <input type="text" name="add_educ_desc[]" required="" pattern="^[a-zA-Zא-ת\s]+$"
                                   class="max-220"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="input-control btn-descr">
                        <div class="caption max-w300">אנא צרף תעודה רלוונטית</div>
						<?php $key = "2"; $file = $form_file[$key];?>
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
                </div>
            </div>
            <div class="aline" style="flex-direction: row-reverse" >

            <button type="button" class="addbutton leftbtn" onclick="dublibe('add_educ_block','add_edic_line')">
                <img src="/img/icons/plus.png"/>


                הוסף שורה
            </button></div>
        </div>
        <br/>
        <div>
            <div class="header_line faind_line">
                ניסיון תעסוקתי רלוונטי
            </div>
            <div id="experience_block">
                <div id="experience_line">

                    <div class="input-control inline">
                        <div class="input-control">
                            <div>
                                <div class="caption max-w300">מקום עבודה</div>
                                <input type="text" name="exp_position[]" required=""
                                       class="max-440"
                                       placeholder="">
                            </div>
                        </div>
                        <div>
                            <div class="input-control">
                                <div>
                                    <div class="caption max-w300">תאריך תחילת עבודה</div>
                                    <input type="text" name="expe_start[]" required="" class="date_val max-220"
                                           autocomplete="off" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="DD/MM/YYYY">
                                </div>
                            </div>
                            <div class="input-control">
                                <div>
                                    <div class="caption max-w300">תאריך סיום עבודה</div>
                                    <input type="text" name="exp_finish[]" required="" class="date_val max-220"
                                           autocomplete="off" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="DD/MM/YYYY"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-control">
                        <div>
                            <div class="caption max-w300">תיאור תפקיד</div>
                            <textarea type="text" name="exp_descr[]"
                                      class="max-220 height-2lines"
                                      placeholder=""></textarea>
                        </div>
                    </div>
                    <div class="input-control">
                        <div>
                            <div class="caption max-w300">הסיבה להפסקת עבודה</div>
                            <textarea type="text" name="exp_reasontocomplete[]" required=""
                                      class="max-220 height-2lines"
                                      placeholder=""></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="aline" style="flex-direction: row-reverse" >

            <button type="button" class="addbutton leftbtni" onclick="dublibe('experience_block','experience_line')"
            ><img src="/img/icons/plus.png"/>

                הוספת מקום עבודה נוסף


            </button></div>
        </div>
        <br/>
        <div>
            <div class="header_line faind_line">
                ממליצים
            </div>
            <div id="recomendations_block">
                <div id="recomendations_line">
                    <div class="input-control">
                        <div>
                            <div class="caption max-w300">שם פרטי + שם משפחה</div>
                            <input type="text" name="recomendations_name_z[]" required="" pattern="^[a-zA-Zא-ת\s]+$"
                                   class="max-220"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="input-control">
                        <div>
                            <div class="caption max-w300">תפקיד / מקצוע</div>
                            <input type="text" name="recomendations_role_z[]" required="" pattern="^[a-zA-Zא-ת\s]+$"
                                   class="max-220"
                                   placeholder="">
                        </div>
                    </div>
                    <div class="input-control inline">
                        <label>
                            <div class="caption max-w180">מספר נייד / מספר טלפון</div>
                            <input type="text" name="recomendations_phone_z[]" required="" pattern="^[0-9]+$"
                                   minlength="7" maxlength="7"
                                   class="max-130">
                        </label>
                        <select class="max-65 phn" name="recomendations_mobile_phone1_select_z[]"
                                style="margin-right: -23px;transform:translateY(-1px)">
                            <option value="050">050</option>
                            <option value="052"> 052</option>
                            <option value="053"> 053</option>
                            <option value="054"> 054</option>
                            <option value="055"> 055</option>
                            <option value="057"> 057</option>
                            <option value="058"> 058</option>
                        </select>
                    </div>
                    <div class="input-control" style="transform:translateY(-8px)">

                        <div class="caption max-w300">אנא צרף מסמך רלוונטי</div>

						<?php $key = 3; $file = $form_file[$key];?>
                        <div>
                            <a href="#" id="rfile-upload-{{$key}}" class="rm" style="display:none"
                               onclick="removeFile('{{$key}}');return false;"><i
                                        class="trash-icon"></i></a>
                            <div class="upload-block">

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

                                </label> <input id="file-upload-{{$key}}" type="file" name="file[{{$key}}]"
                                                onchange="fileChange(this)"
                                                accept="application/pdf, image/jpeg, image/jpg, image/gif, image/png, image/jpe, image/tiff, image/bmp, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword" {{$file['required']}} />
                            </div>
                        </div>

                    </div>

                </div>
                <input type="hidden" name="vals" id="formvals" value="0"/>
                @for ($i=0;$i<9;$i++)
                    <div id="recomendations_line_{{$i}}" style="display:none">
                        <div class="input-control">
                            <div>
                                <div class="caption max-w300">שם פרטי + שם משפחה</div>
                                <input type="text" name="recomendations_name_{{$i}}" required=""
                                       pattern="^[a-zA-Zא-ת\s]+$" class="max-220"
                                       placeholder="">
                            </div>
                        </div>
                        <div class="input-control">
                            <div>
                                <div class="caption max-w300">תפקיד / מקצוע</div>
                                <input type="text" name="recomendations_role_{{$i}}" required=""
                                       pattern="^[a-zA-Zא-ת\s]+$" class="max-220"
                                       placeholder="">
                            </div>
                        </div>
                        <div class="input-control inline">
                            <label>
                                <div class="caption max-w180">מספר נייד / מספר טלפון</div>
                                <input type="text" name="recomendations_phone_{{$i}}" required="" pattern="^[0-9]+$"
                                       minlength="7" maxlength="7"
                                       class="max-130">
                            </label>
                            <select class="max-65 phn" name="recomendations_mobile_phone1_select_{{$i}}"
                                    style="margin-right: -23px">
                                <option value="050">050</option>
                                <option value="052"> 052</option>
                                <option value="053"> 053</option>
                                <option value="054"> 054</option>
                                <option value="055"> 055</option>
                                <option value="057"> 057</option>
                                <option value="058"> 058</option>
                            </select>
                        </div>
                        <div class="input-control btn-descr" style="transform:translateY(-8px)">
                            <div class="caption max-w300">אנא צרף מסמך רלוונטי</div>

							<?php $key = $i + 14; $file = $form_file[$key];

							?>
                            <div>
                                <a href="#" id="rfile-upload-{{$key}}" class="rm" style="display:none"
                                   onclick="removeFile('{{$key}}');return false;"><i
                                            class="trash-icon"></i></a>
                                <div class="upload-block">

                                    <input type="text" disabled class="btn-input-upload"
                                    />
                                    <label for="file-upload-{{$key}}" class="btn-upload ">
                                        <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                width="19px" height="13px"
                                                style="transform: scale(0.8)  translateY(4px);">
                                            <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                  d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z"/>
                                        </svg>
                                        <span style="margin-top:-2px">

                        בחר קובץ
                        </span>

                                    </label> <input id="file-upload-{{$key}}" type="file" name="file[{{$key}}]"
                                                    onchange="fileChange(this)"
                                                    accept="application/pdf, image/jpeg, image/jpg, image/gif, image/png, image/jpe, image/tiff, image/bmp, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword" {{$file['required']}} />
                                </div>
                            </div>

                        </div>

                    </div>
                @endfor
            </div>
            <div class="aline" style="flex-direction: row-reverse" >

            <button type="button" class="addbutton leftbtn" onclick="showLine()">
                <img src="/img/icons/plus.png"/>

                הוסף שורה
            </button>
            </div>

        </div>
        <br/>

        <div>
            <div class="header_line faind_line">
                שונות (כגון ציונים לשבח, פרסי עידוד מיוחדים וכדומה)
            </div>
            <div>ניתן להוסיף בטבלה הבאה:</div>
            <div id="adon_block">
                <div id="adon_line">
                    <div class="input-control">
                        <div>
                            <div class="caption max-w300">נושא</div>
                            <input type="text" name="add_data[]" class="max-440"
                                   placeholder="">
                        </div>
                    </div>
                    <br/>
                    <div class="input-control">
                        <div>
                            <div class="caption max-w300">הסיבה להפסקת עבודה</div>
                            <textarea type="text" name="add_reason[]" required="" pattern="^[a-zA-Zא-ת\s]+$"
                                      class="max-880 height-2lines"
                                      placeholder=""></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="aline" style="flex-direction: row-reverse" >

            <button type="button" class="addbutton leftbtn" onclick="dublibe('adon_block','adon_line')"
            ><img src="/img/icons/plus.png"/>

                הוסף שורה


            </button></div>
            <br/></div>
        <br/>
        <div>
            <div class="header_line faind_line">צירוף מסמכים</div>
            <div class="input-control btn-descr" style="width:300px">
                <label>אנא צרף קורות חיים</label>
				<?php $key = "4"; $file = $form_file[$key];?>
                <div>
                    <a href="#" id="rfile-upload-{{$key}}" class="rm" style="display:none"
                       onclick="removeFile({{$key}});return false;"><i
                                class="trash-icon"></i></a>
                    <div class="upload-block">

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
            <br/>
            <hr/>
            <div>
				<?php for($i = 5;$i <= 12;$i++) {

				?>

                <div class="input-control btn-descr" style="width:300px">
                    <label>אנא צרף מסמך רלוונטי נוסף</label>
					<?php $key = $i; $file = $form_file[$key];?>
                    <div>
                        <a href="#" id="rfile-upload-{{$key}}" class="rm" style="display:none"
                           onclick="removeFile({{$key}});return false;"><i
                                    class="trash-icon"></i></a>
                        <div class="upload-block">

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

                            </label> <input id="file-upload-{{$key}}" type="file" name="file[{{$key}}]"
                                            onchange="fileChange(this)"
                                            accept="application/pdf, image/jpeg, image/jpg, image/gif, image/png, image/jpe, image/tiff, image/bmp, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword" {{$file['required']}} />
                        </div>
                    </div>
                </div>
				<?php }
				?>


            </div>
            <div class="center  hidden-pdf" style="display:flex;justify-content:center">
                <button onclick="checksubmit()" class="btn btn-lg btn-default success"
                        style="margin:10px 10px 10px 10px;   background:#7fb742;width:200px;"

                        id="reportSendBtn" type="submit">שלב
                    הבא
                </button>
                <br>
                <div class="submit-error-msg"></div>
            </div>
    </form>


    <script language="JavaScript">
        function checksubmit() {
            var rt0 = Array.from(document.getElementsByTagName("textarea"));
            var rt = Array.from(document.getElementsByTagName("input"));
            rt = rt.concat(rt0);
            // rt={...rt,...rt0};
            // console.log('chk sub', rt);
            var email = document.getElementsByName("email")[0];
            var tenderid = '<?php echo $tenderid ?>';
            window.email = email ? email.value : '';
            window.data = {email: email, tenderid: tenderid};
            // var doc=document.getElementsByName("form");
            // console.log(doc);
            for (let i = 0; i < rt.length; i++) {
                // console.log(rt[i]);
                rt[i].required = false;
            }


        }

        function onsubmit() {
            console.log('submitted!');
            //  window.location.href = '/page2/{{$tid}}';
        }
    </script>


    <br/><br/>
    <div class="row last hidden-pdf">

        <div class="col-xs-12 text-center " style="margin-bottom: 10px;font-size:18px">
            רח' הגדוד העברי 10
            <i class="dot-separator"></i>
            ת.ד. 28 אשדוד 7710001
            <i class="dot-separator"></i>
            ט.ל: 08-8545400


        </div>
    </div>
    </form>
@endsection
