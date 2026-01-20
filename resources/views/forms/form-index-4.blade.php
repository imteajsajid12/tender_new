@extends('forms.layouts.header2')
@section('content')
    <div class="text-center subtop-row">
        <h2 class="site-subtitle" style="padding-right: 170px; padding-top:20px;padding-left: 150px;">
            <span>
            כרטיס עובד
        </span>
            <span class="ucase">(1)</span>

        </h2>
        <br/><br/>
        <h4>

            <span class="bold">ובקשה להקלה ולתיאום מס על ידי המעביד
</span>
            <span class="ucase">(1)</span>

        </h4>
        <div>לפי תקנות מס הכנסה ומס מעסיקים (ניכוי ממשכורת ומשכר עבודה ותשלום מס מעסיקים), התשנ"ג - 1993
        </div>


    </div>
    <div class="fw" style="height:20px;display: flex;justify-content: flex-end">

        <div></div>
        <div style="border-right:thin solid black;padding-right:5px" class="w4let">
            שנת המס
        </div>
        <div class="leftdowborder wlet"></div>
        <div class="leftdowborder wlet"></div>
        <div class="leftdowborder wlet"></div>
        <div class="leftdowborder wlet"></div>

    </div><br/>
    <div style="display:flex;justify-content: space-between" class="fw">

        <div style="float:right;border-right:thin solid black"></div>
        <div style="width:600px;border:thin solid black;text-align:Center">


            <br/>טופס זה ימולא על-ידי כל עובד עם תחילת עבודתו,וכן בתחילת כל שנת מס (אא"כ הנציב אישר אחרת). הטופס
            <br/>מהווה אסמכתא למעביד למתן הקלות במס ולעריכת תיאומי מס בחישוב משכורת(1) העובד.
            <br/>אם חל שינוי בפרטים – יש להצהיר על כך תוך שבוע ימים.
            <br/>{ראה הסברים (לפי המספרים) מעבר לדף}


        </div>
        <div style="float:left;border-left:thin solid black"></div>

    </div><br/><br>
    <span>א. פרטי המעביד (למילוי ע"י המעביד)
</span>

    <div class="fw wblock">
        <div class="icontrol ball wQuart" style="border-left:0">
            <div>
                <span>שם</span><br/>
                <input type="text" name="name" required="" pattern="^[a-zA-Zא-ת\s]+$" class="fw" placeholder="">
            </div>
        </div>
        <div class="icontrol ball wQuart" style="border-left:0">
            <div>
                <span>כתובת</span><br/>
                <input type="text" name="addrss" required="" pattern="^[a-zA-Zא-ת\s]+$" class="fw" placeholder="">
            </div>
        </div>
        <div class="icontrol ball wQuart" style="border-left:0">
            <div>
                <span>מספר טלפון</span><br/>
                <input type="text" name="phone" required="" pattern="^[a-zA-Zא-ת\s]+$" class="fw" placeholder="">
            </div>
        </div>
        <div class="icontrol ball wQuart">

            מספר תיק ניכויים
            <input type="text" maxlength="9" name="Deductionportfolio" id="Deductionportfolio"/>
            <span class="sw">9</span>
        </div>
    </div>
    <br/>
    <div class="linehead">ב. פרטי העובד/ת
    </div>
    <div class="fw wblock">
        <div class="icontrol ball wQuart" style="border-left:0">
            <div>
                <span>מספר זהות (9 ספרות)
</span>
                <input type="text" maxlength="9" class="id_number inputnumbers" id="id_number"/>
                <span class="sw "></span>
            </div>
        </div>
        <div class="icontrol ball wQuart" style="border-left:0">
            <div>
                <span>שם משפחה</span><br/>
                <input type="text" name="lastname" required="" pattern="^[a-zA-Zא-ת\s]+$" class="fw" placeholder="">
            </div>
        </div>
        <div class="icontrol ball wQuart" style="border-left:0">
            <div>
                <span>שם פרטי</span><br/>
                <input type="text" name="firstname" required="" pattern="^[a-zA-Zא-ת\s]+$" class="fw" placeholder="">
            </div>
        </div>
        <div class="icontrol ball wQuart">
            <span class="ltop">תאריך לידה</span>
            <input type="text" maxlength="9" name="Deductionportfolio" id="Deductionportfolio"/>
        </div>
    </div>
    <div class="fw wblock">
        <div class="w80p borderright p5r">
            כתובת פרטית
        </div>
        <div class="w20p borderright borderleft p5r">
            מספר טלפון
        </div>
    </div>
    <div class="fw wblock">
        <div class="icontrol ball w35p noborderleft">
            <div>
                <input type="text" name="addr_street" required="" pattern="^[a-zA-Zא-ת\s]+$" class="fw" placeholder="">
            </div>
        </div>
        <div class="icontrol ball w20p" style="border-left:0">
            <div>
                <input type="text" name="addr_number" required="" pattern="^[a-zA-Zא-ת\s]+$" class="fw" placeholder="">
            </div>
        </div>
        <div class="icontrol ball w15p" style="border-left:0">
            <div>
                <input type="text" name="addr_city" required="" pattern="^[a-zA-Zא-ת\s]+$" class="fw" placeholder="">
            </div>
        </div>

        <div class="icontrol ball w15p noborderleft">
            <input type="text" maxlength="5" name="postalcode" class="inputnumbers" id="postal"/>
        </div>
        <div class="icontrol ball w20p">
            <div>
                <input type="text" name="addr_phone" required="" pattern="^[a-zA-Zא-ת\s]+$" class="fw" placeholder="">
            </div>
        </div>
    </div>
    <div class="fw wblock">
        <div class="icontrol ball w35p noborderleft nobordertop">
            <div>
                <span>רחוב/שכונה</span>
            </div>
        </div>
        <div class="icontrol ball w20p noborderleft nobordertop" style="border-left:0">
            <div>
                <span>מספר</span>
            </div>
        </div>
        <div class="icontrol ball w15p noborderleft nobordertop" style="border-left:0">
            <div>
                <span>עיר/ישוב</span>
            </div>
        </div>

        <div class="icontrol ball w15p noborderleft nobordertop">
            <span>מיקוד</span>
        </div>
        <div class="icontrol ball w20p nobordertop">
            <div>
                <span>קידומת</span>
            </div>
        </div>
    </div>
    <div class="fw wblock">
        <div class="icontrol ball w20p noborderleft nobordertop">
            <span class="ltop p5r">מין</span>
            <div>
                <span><span> זכר </span><input type="radio" value="man" name="sex"/></span>
                <span><span>נקבה</span><input type="radio" value="woman" name="sex"/></span>
            </div>

        </div>
        <div class="icontrol ball w35p noborderleft nobordertop">
            <span class="ltop p5r">מצב משפחתי</span>
            <div>
                <span><span>רווק/ה</span><input type="radio" value="single" name="family_status"/></span>
                <span><span>נשוי/אה</span><input type="radio" value="married" name="family_status"/></span>
                <span><span>גרוש/ה</span><input type="radio" value="divorced" name="family_status"/></span>
                <span><span>אלמן/ה</span><input type="radio" value="widowed" name="family_status"/></span>
            </div>
        </div>
        <br/><br/>
        <div class="icontrol ball w20p noborderleft nobordertop">
            <span class="ltop p5r">תושב ישראל</span>
            <div>
                <span><span>כן</span><input type="radio" name="resident" value="resident"/></span>
                <span><span>לא</span><input type="radio" name="resident" value="nonresident"/></span>
            </div>
        </div>

        <div class="icontrol ball wQuart nobordertop ">
            <span class="ltop">תאריך עליה</span>
            <input type="text" maxlength="9" name="Deductionportfolio" id="Deductionportfolio"/>
        </div>
    </div>

    <div class="fw wblock " id="wlist" style="margin-top:25px">
        <div class="w60p" style="text-align: center">
            <span class="whead">ג. 	פרטים על ילדי שבשנת המס טרם מלאו להם 19 שנה
</span><br/>
            <span>
	סמן/י X בטור המתאים ליד השם של הילד הנמצא בחזקתך
</span>
            <div class="tableright borderbottom">
                <div class="fw wblock bordertop ">
                    <div class="w10p borderright borderleft p5r"></div>
                    <div class="w50p borderleft p5r">
                        שם
                    </div>
                    <div class="w20p borderleft p5r"><span>מספר זהות</span></div>
                    <div class="w20p borderleft p5r"><span>תאריך לדיה</span></div>
                </div>
                @for ($i=0;$i<15;$i++)
                    <div class="fw wblock bordertop">
                        <div class="w10p borderright borderleft p5r"><input type="checkbox" name="resident_{{$i}}"
                                                                            value="resident"/></div>
                        <div class="w50p borderleft "><input type="text" style="width:100%" name="name1_{{$i}}"/></div>
                        <div class="w20p borderleft "><input type="text" style="width:100%" name="id1_{{$i}}"
                                                             maxlength="9" minlength="9"/></div>
                        <div class="w20p borderleft "><input type="text" style="width:100%" name="date1_{{$i}}"/></div>
                    </div>
                @endfor

            </div>

        </div>
        <div class="w40p" style="text-align: center">
            <span class="whead">
ד. פרטים על הכנסותי ממעביד זה
</span>
            <div style="text-align:Center" class="topborder mr10r"><span>
אני מקבל/ת: (ראה הסברים מעבר לדף)
</span></div>
            <div style="margin-right:10px;text-align:right;padding-right:5px;display:flex" class="wwline">
                <div>
                    <div><input type="checkbox" name="salary_monthly" value="monthly"/><span
                                title="משכורת חודש	-	משכורת בעד עבודה של לא פחות מ- 18 יום בחודש ויותר מ- 5 שעות בכל יום.">משכורת חודש</span>
                    </div>
                    <div><input type="checkbox" name="salary_dayly" value="dayly"/><span
                                title="">שכר עבודה (עובד יומי)</span></div>
                    <div><input type="checkbox" name="salary_others" value="others"/><span title="">משכורת נוספת</span>
                    </div>
                </div>
                <div style="padding-right:10px">
                    <div><input type="checkbox" name="salary_posobie" value="posobie"/><span title="">קיצבה</span></div>
                    <div><input type="checkbox" name="salary_part" value="part"/><span title="">משכורת חלקית</span>
                    </div>
                </div>
            </div>
            <div class="topborder mr10r mr10t" style="display:flex">
                <div style="width:67%" class="borderleft">
                    <span>
                    תקופת העבודה (1) בשנת המס
                    </span>
                    <div style="display:flex">
                        <div class="w50p">
                            <div>
                                תאריך תחילה
                            </div>
                            <input type="text"
                                   autocomplete="off" pattern="\d{1,2}/\d{1,2}/\d{4}"
                                   placeholder="DD/MM/YYYY"
                                   name="date1" class="p5r"
                                   style="width:100%;border:none;border-top:thin solid black;border-left:thin solid black"/>
                        </div>
                        <div class="w50p">
                            <div>
                                תאריך סיום
                            </div>
                            <input type="text"
                                   autocomplete="off" pattern="\d{1,2}/\d{1,2}/\d{4}"
                                   placeholder="DD/MM/YYYY"
                                   name="date2" class="p5r"
                                   style="width:100%;border:none;border-top:thin solid black"/></div>
                    </div>
                </div>
                <div style="width:33%">
                    <span>
                    מס' חודשי עבודה
                    (בשנת המס)

               </span>
                    <div><input type="text" class="p5r" style="width:100%;border:none;"/></div>
                </div>

            </div>

            <br/><br/>
            <div style="text-align:Center" class=" mr10r mr10t"><span>
ה. פרטים על הכנסות אחרות</span></div>
            <div class="topborder mr10r mr10t wwline" style="text-align: right;border-bottom:thin solid black">

                <div class="p5r">
                    <input type="checkbox" name="mnth_salary_monthly" value="monthly"/> <span>אין לי הכנסות אחרות</span>

                </div>
                <div class="p5r"><input type="checkbox" name="mnth_salary_monthly" value="monthly"/> <span> יש לי הכנסות אחרות כמפורט להלן:</span>
                </div>
                <div style="display:flex">

                    <div class="p5r">
                        <div><input type="checkbox" name="mnth_salary_monthly" value="monthly"/>
                            <span>משכורת חודש</span></div>
                        <div><input type="checkbox" name="mnth_salary_monthly" value="monthly"/>
                            <span>משכורת נוספת</span></div>
                        <div><input type="checkbox" name="mnth_salary_monthly" value="monthly"/>
                            <span>משכורת חלקית</span></div>
                    </div>
                    <div class="p5r">
                        <div><input type="checkbox" name="mnth_salary_monthly" value="monthly"/> <span>שכר עבודה (עובד יומי)</span>
                        </div>
                        <div><input type="checkbox" name="mnth_salary_monthly" value="monthly"/> <span> קיצבה</span>
                        </div>
                        <div><input type="checkbox" name="mnth_salary_monthly" value="monthly"/> <span class="p5r"> ממקור אחר</span><input
                                    type="text" class="p5r" style="width:100px"/></div>

                    </div>
                </div>
                <hr/>
                <div style="text-align: right" class="p5r">
                    אם יש לך הכנסה אחרת – נא סמן/י:
                </div>
                <div class="p5r"><input type="checkbox" name="mnth_salary_monthly" value="monthly"/> <span>אבקש לקבל נקודות זיכוי ומדרגות מס כנגד הכנסתי זו (סעיף ד). איני מקבל/ת אותם בהכנסה אחרת</span>
                </div>
                <div class="p5r"><input type="checkbox" name="mnth_salary_monthly" value="monthly"/> <span>אני מקבל/ת נקודות זיכוי ומדרגות מס בהכנסה אחרת ועל כן איני זכאי/ת להם כנגד הכנסה זו</span>
                </div>
                <div class="p5r"><input type="checkbox" name="mnth_salary_monthly" value="monthly"/> <span>אין מפרישים עבורי לקרן השתלמות / לתגמולים / לביטוח אבדן כושר עבודה בגין הכנסותי האחרות</span>
                </div>

            </div>

        </div>
    </div>
    <div id="tabletestdown">
        <div class="fw wblock">

            ו. פרטים על בן/בת הזוג
        </div>
        <div class="fw wblock">
            <div class="icontrol ball w40p" style="border-left:0;border-bottom:none">
                <div>
                    <span>מספר זהות (9 ספרות)</span>
                    <input type="text" maxlength="9" class="id_number inputnumbers" id="id_number"/>
                    <span class="sw "></span>
                </div>
            </div>
            <div class="icontrol ball w15p" style="border-left:0;border-bottom:none">
                <div>
                    <span>שם משפחה</span><br/>
                    <input type="text" name="name" required="" pattern="^[a-zA-Zא-ת\s]+$" class="fw" placeholder="">
                </div>
            </div>
            <div class="icontrol ball w15p" style="border-left:0;border-bottom:none">
                <div>
                    <span>שם פרטי</span><br/>
                    <input type="text" name="name" required="" pattern="^[a-zA-Zא-ת\s]+$" class="fw" placeholder="">
                </div>
            </div>
            <div class="icontrol ball w15p" style="border-left:0;border-bottom:none">
                <div>
                    <span>תאריך לידה</span><br/>
                    <input type="text" name="name" required="" pattern="^[a-zA-Zא-ת\s]+$" class="fw" placeholder="">
                </div>
            </div>
            <div class="icontrol ball w15p" style="border-bottom:none">
                <div>
                    <span>תאריך עליה</span><br/>
                    <input type="text" name="name" required="" pattern="^[a-zA-Zא-ת\s]+$" class="fw" placeholder="">
                </div>
            </div>


        </div>
        <div class="fw wblock">
            <div class="icontrol ball w40p" style="border-left:none">


                <div class="p5r cdown"><input type="checkbox" name="mnth_salary_monthly" value="monthly"/> <span>אין לבן/בת הזוג כל הכנסה</span>
                </div>

            </div>
            <div class="icontrol ball w60p" style="display:flex">
                <div class="p5r cdown"><input type="checkbox" name="mnth_salary_monthly" value="monthly"/> <span>
יש לבן/בת הזוג הכנסה מ:  </span></div>
                <div class="p5r cdown"><input type="checkbox" name="mnth_salary_monthly" value="monthly"/> <span>
עבודה/עסק   </span></div>
                <div class="p5r cdown"><input type="checkbox" name="mnth_salary_monthly" value="monthly"/> <span>
הכנסה חייבת אחרת לרבות קיצבה
</span></div>
            </div>


        </div>
    </div>
    <br/><br/>
    <div id="tabledata">
        <div class="fw wblock">
            <div>ז. שינויים במהלך השנה (כולל שינויים הקשורים לבקשה להקלה בחישוב המס מעבר לדף)
            </div>
        </div>
    </div>
    <div>

        <div class="fw wblock">
            <div class="icontrol ball w40p noborderleft p5r ">
                תאירך השינוי
            </div>
            <div class="icontrol ball w60p noborderleft p5r">
                פרטי השינוי
            </div>
            <div class="icontrol ball w40p  p5r">
                חתימת העובד/ת
            </div>

        </div>
        @for ($i=0;$i<3;$i++)

            <div class="fw wblock">
                <div class="icontrol ball w40p noborderleft nobordertop">
                    <div class="p5r"><input type="text" class="w10n" name="mnt2323h_salary_monthly"/></div>
                </div>
                <div class="icontrol ball w60p noborderleft nobordertop">
                    <div class="p5r"><input type="text" class="w10n" name="mnth_salary_moererthly"/></div>
                </div>
                <div class="icontrol ball w40p  nobordertop">
                    <div class="p5r"><input type="text" class="w10n" name="mnth_salary_mon3r43thly"/></div>
                </div>
            </div>
        @endfor


        <br/><br/>
        <div id="tabledata2">
            <div class="fw wblock">
                <div>ח. אני מבקש/ת פטור או זיכוי ממס מהסיבות הבאות
                    <span style="font-weight:400">(סמן/י X בריבוע המתאים)</span>


                </div>
            </div>


            <div class="fw wblock" style="display: flex;flex-direction: column">
                <div class="fw bbottom border p5r"><span>1.</span><input name="bottom1" type="checkbox"><span
                            class="p5r">אני תושב/ת ישראל.</span></div>
                <div class="fw bbottom border p5r" style="border-top:none"><span>2.</span><input name="bottom2"
                                                                                                 type="checkbox"><span
                            class="p5r">אני נכה 100% / עיוור/ת לצמיתות. (מצורף אישור משרד הביטחון/האוצר/פקיד השומה/תעודת עיוור שהוצאה לאחר 1.1.94.</span>
                </div>
                <div class="fw bbottom border p5r" style="border-top:none"><span>3.</span><input name="bottom3"
                                                                                                 type="checkbox"><span
                            class="p5r">
                      <span>אני תושב/ת קבוע/ה בישוב מיוחד / באזור פיתוח מתאריך</span> <input name="bottom3_1"
                                                                                             type="text"/> <br/><span>שם הישוב</span>
                 <input name="bottom3_2" type="text"/>    <span>(מצורף אישור על הרשות ע"ג טופס 1312א.</span>        
	      </span></div>
                <div class="fw bbottom border p5r" style="border-top:none"><span>4.</span><input name="bottom4"
                                                                                                 type="checkbox"><span
                            class="p5r">
                        <span>אני עולה חדש/ה מתאריך</span>
                        <input name="bottom4" type="text"><br/>
                       <br/> <span>לא היתה לי הכנסה בישראל מתחילת שנת המס הנוכחית עד תאריך</span>
                        <input name="bottom4_2" type="text"><br/>
<div>

	(מי שהיתה לו הכנסה או שתקופת זכאותו (42 חודש) אינה רצופה בשל שירות חובה בצה"ל, לימודים על תיכוניים או יציאה לחו"ל – יפנה לפקיד השומה.
</div>

                    </span></div>

                <div class="fw bbottom border p5r " style="border-top:none"><span>5.</span><input name="bottom5"
                                                                                                  type="checkbox"><span
                            class="p5r">

                    <span> בגין בן/בת זוגי המתגורר/ת עימי ואין לו/לה הכנסות בשנת המס.</span><br/><span>
	</span>(רק אם העובד/ת או בן/בת הזוג הגיע/ה לגיל הפרישה או שהוא/היא נכה או עיוור/ת).

                </span></div>

                <div class="fw bbottom border p5r" style="border-top:none"><span>6.</span><input name="bottom6"
                                                                                                 type="checkbox"><span
                            class="p5r">בגין משפחה חד הורית.</span></div>
                <div class="fw bbottom border p5r" style="border-top:none"><span>7.</span><input name="bottom7"
                                                                                                 type="checkbox"><span
                            class="p5r">
                        <span>בגין ילדי שבחזקתי (ימולא רק ע"י אישה או ע"י גבר חד הורי) המפורטים בחלק ג.</span><br/>
                        <span>מס' הילדים שנולדו בשנת המס</span><input type="text"/>.
                        <span>ילדים שימלאו להם 18 שנה בשנת המס </span><input type="text"/>
                        <span>מס' ילדים אחרים</span><input type="text"/>
                    </span>

                </div>
                <div class="fw bbottom border p5r nobordertop" style="border-top:none"><span>8.</span><input
                            name="bottom8" type="checkbox"><span class="p5r">בגין ילדי שאינם בחזקתי המפורטים בחלק ג ואני משתתף/ת בכלכלתם</span>
                </div>
                <div class="fw bbottom border p5r nobordertop" style="border-top:none"><span>9.</span><input
                            name="bottom9" type="checkbox"><span class="p5r">בגין מזונות לבן/בת זוגי לשעבר (ימולא ע"י מי שנישא בשנית ) (מצורף פסק דין)</span>
                </div>
                <div class="fw bbottom border p5r nobordertop" style="border-top:none"><span>10.</span><input
                            name="bottom10" type="checkbox"><span
                            class="p5r">מלאו לי 16 שנים וטרם מלאו לי 18 שנים.</span></div>
                <div class="fw bbottom border p5r nobordertop" style="border-top:none"><span>11.</span><input
                            name="bottom11" type="checkbox"><span class="p5r">אני חייל/ת משוחרר/ת / שרתתי בשירות לאומי. תאריך תחילת השירות       תאריך סיום השירות


	מצורף צילום של תעודד השחרור / סיום שרות</span></div>
                <div class="fw bbottom border p5r nobordertop" style="border-top:none"><span>12.</span><input
                            name="bottom1" type="checkbox"><span class="p5r">בגין מי שחזר למעגל העבודה. מצורפת הצהרה בטופס 118.</span>
                </div>
                <div class="fw bbottom border p5r nobordertop" style="border-top:none"><span>13.</span><input
                            name="bottom1" type="checkbox"><span class="p5r">בגין סיום לימודים לתואר אקדמי או סיום לימודי הוראה / מקצוע. מצורפת הצהרה בטופס 119.</span>
                </div>


            </div>


        </div>
        <br/><br/>
        <div id="ttable3">
            <div class="fw wblock">
                <div style="font-size:20px;font-weight: 700">
                    ט. אני מבקש/ת תיאום מס מהסיבות הבאות (סמן/י X בריבוע המתאים)

                </div>

            </div>
            <div class="fw wblock" style="display: flex;flex-direction: column;font-size:18px">
                <div class="border">
                    <input name="bottom14" type="checkbox" style="transform: translateY(5px)"/>
                    <span>1. לא היתה לי הכנסה מתחילת שנת המס הנוכחית עד לתחילת עבודתי אצל מעביד זה. </span><br/><br/>
                    <div style="display: flex;flex-direction: row;">
                        <div style="margin-left:10px">
                            <span>הערות:</span>
                        </div>
                        <div>
                            <span>.1 יש להמציא הוכחה כגון: אישור משטרת הגבולות בגין שהייה בחו"ל, אישור מחלה וכיו"ב. בהעדר הוכחה יש לפנות לפקיד השומה. </span><br/>
                            <span>.2 דמי לידה ודמי אבטלה הינם הכנסה חייבת.</span>


                        </div>

                    </div>
                    <br/>
                    <div>
                        <input name="bottom14" type="checkbox" style="transform: translateY(5px)"/>
                        <span>2. יש לי הכנסות נוספות ממשכורת / קיצבה כמפורט להלן:</span>
                    </div><br/>

                </div>
            </div>
            <div class="fw wblock">
                <div class="w55p border  p5r" style="font-size:18px">
                    <div>המעביד / משלם הקיצבה / מקור אחר</div>
                    <div style="width:100%;display: flex">
                        <div class="w34p borderleft bordertop p5r">שם</div>
                        <div class="w33p borderleft bordertop p5r">כתובת</div>
                        <div class="w33p borderleft bordertop noborderbottom p5r"> מספר תיק ניכויים</div>
                    </div>
                </div>
                <div class="w45p border" style="display: flex">
                    <div class="w34p  p5r" style="border-left:thin solid black"><span>
                        סוג ההכנסה
                        (משכורת/קיצבה/אחר)</span><br/>
                    </div>
                    <div class="w33p  p5r" style="border-left:thin solid black"><span>הכנסה חודשית</span>

                    </div>
                    <div class="w33p  p5r"><span>המס שנוכה</span></div>
                </div>
            </div>
            @for ($i=0;$i<3;$i++)
            <div class="fw wblock">
                <div class="w55p border " style="font-size:18px; display:flex">
                    <div class="w34p borderleft nobordertop"><input name="wddw23" type="text" class="w10n"/></div>
                    <div class="w33p borderleft nobordertop "><input name="2wddw2233" type="text" class="w10n"/></div>
                    <div class="w33p nobordertop"><input name="w2ddw22343" type="text" class="w10n"/></div>
                </div>
                <div class="w45p border  " style="font-size:18px;display: flex">
                    <div class="w34p borderleft nobordertop"><input name="w2d343" type="text" class="w10n"/></div>
                    <div class="w33p borderleft nobordertop"><input name="w2d22879343" type="text" class="w10n"/></div>
                    <div class="w33p borderleft nobordertop"><input name="w2ddw2298343" type="text" class="w10n"/></div>

                </div>
                </div>
                @endfor



            </div>
<br/><br/>
        <div class="fw wblock" style="display: flex;justify-content: center;font-size:16px" >
            <div style="text-align: center">

         <br/>   אני מצהיר/ה כי הפרטים שמסרתי בטופס זה הינם מלאים ונכונים.
            <br/>   ידוע לי שהשמטה או מסירת פרטים לא נכונים הינה עבירה על פקודת מס הכנסה.
            <br/>אני מתחייב/ת להודיע למעביד על כל שינוי שיחול בפרטי האישיים ובפרטים דלעיל תוך שבוע ימים מתאריך השינוי.

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

                <button class="btn btn-lg btn-default success bottom-btn-second" id="reportSendBtn"

                        type="submit">
                    שלח
                </button>
            </div>
            <br>
            <div class="submit-error-msg"></div>
        </div>

    </div>
    <br/>
    <hr/>


@endsection
