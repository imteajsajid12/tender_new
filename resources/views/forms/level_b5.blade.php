
@extends('forms.layouts.header3')
@section('content')

<script language="JavaScript">
        function dublibe(block, line) {
            var langPos = document.getElementById(block);
            var langLine = document.getElementById(line).cloneNode(true);
            langLine.style.display='';
            langPos.appendChild(langLine);
        }
	
		function remove(tableId, elmeId){
			var table = document.getElementById(tableId);
			var length = table.rows.length;
			if(length > 2){
				var el = document.getElementById(elmeId);
				el.remove();
			}
		}
    </script>
<form id="form" method="post" action="/page5/create_level_b">
	@include('forms.101')
	<input type="hidden" name="approver" value="0"/>
	<div class="text-center subtop-row">
        <h2 class="site-subtitle">השלמה לטופס 101</h2>
    </div>
			
	<div class="faind_line" style="margin-bottom: 0;">
		<span class="max-w180"><b>1. נא להעביר את המשכורת שלי לבנק:</b></span>
	</div>
	<div class="faind_line" style="margin-bottom: 0">
		<div class="inline-input-control">
			<span class="max-w180">שם הבנק:</span>
			<input type="text" name="bank_name" class="max-300"/>
		</div>
	</div>
	<div class="faind_line" style="margin-bottom: 0">
		<div class="inline-input-control">
			<span class="max-w180">שם הסניף:</span>
			<input type="text" name="brunch_name" class="max-300"/>
		</div>
	</div>
	<div class="faind_line" style="margin-bottom: 0">
		<div class="inline-input-control">
			<span class="max-w180">מספר הסניף:</span>
			<input type="text" name="brunch_number" class="max-300"/>
		</div>
	</div>
	<div class="faind_line" style="margin-bottom: 0">
		<div class="inline-input-control">
            <div>
                <span class="max-w180">כתובת מלאה של הבנק:</span>
                <input type="text" name="bank_addres1" required="" pattern="^[a-zA-Zא-ת\s]+$" class="max-150" placeholder="עיר">
                <input type="text" name="bank_addres11" required="" pattern="^[a-zA-Zא-ת\s]+$" class="max-150 mmr-48" placeholder="רחוב">
                <input type="text" name="bank_addres12" required="" pattern="^[0-9]+$" minlength="1" maxlength="3" class="max-55" placeholder="מס’ בית">
            </div>
        </div>
	</div>
	<div class="faind_line" style="margin-bottom: 0">
		<div class="inline-input-control">
            <div>
                <span class="caption max-w180">שם פרטי ומשפחה של בעל/ת החשבון:</span>
                <input type="text" name="pn1" required="" pattern="^[a-zA-Zא-ת\s]+$" class="max-130" placeholder="שם פרטי">
                <input type="text" name="pf1" required="" pattern="^[a-zA-Zא-ת\s]+$" class="max-130 mmr-77" placeholder="שם משפחה">
            </div>
        </div>
	</div>
	<div class="faind_line" style="margin-bottom: 0">
		<div class="inline-input-control">
			<span class="max-w180">מספר חשבון בנק:</span>
			<input type="text" name="account_number" class="max-300"/>
		</div>
	</div>
	<div class="faind_line" style="margin-bottom: 0">
		<div class="inline-input-control">
			<span class="max-w180">קוד הבנק:</span>
			<input type="text" name="bank_code" class="max-300"/>
		</div>
	</div>
	<div class="faind_line" style="margin-bottom: 0">
		<div class="inline-input-control">
            <div>
                <span class="caption max-w180">שם העובד/ת:</span>
                <input type="text" name="pn2" required="" pattern="^[a-zA-Zא-ת\s]+$" class="max-130" placeholder="שם פרטי">
                <input type="text" name="pf2" required="" pattern="^[a-zA-Zא-ת\s]+$" class="max-130 mmr-77" placeholder="שם משפחה">
            </div>
        </div>
	</div>
	<div class="faind_line" style="margin-bottom: 0">
        <div class="inline-input-control">
            <div>
                <span class="caption max-w180">כתובת העובד/ת:</span>
                <input type="text" name="addres1" required="" pattern="^[a-zA-Zא-ת\s]+$" class="max-150" placeholder="עיר">
                <input type="text" name="addres11" required="" pattern="^[a-zA-Zא-ת\s]+$" class="max-150 mmr-48" placeholder="רחוב">
                <input type="text" name="addres12" required="" pattern="^[0-9]+$" minlength="1" maxlength="3" class="max-55" placeholder="מס’ בית">
				<input type="text" name="postal" required="" pattern="^[0-9]+$" class="max-150" placeholder="מיקוד">
            </div>
        </div>
    </div>
	<div class="faind_line" style="margin-bottom: 0">
		<div class="input-control ml-0">
			<label>
				<span class="caption max-w180">תאריך:</span>
				<input type="text" name="date" class="date_val max-240 mmax-205" autocomplete="off" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="DD/MM/YYYY">
			</label>
		</div>
	</div>
	<div class="faind_line" style="margin-bottom: 0">
		<div class="inline-input-control">
            <label>
                <span class="caption max-w180">מספר זהות:</span>
                <input type="text" name="identity_number" required="" pattern="^[0-9]+$" minlength="9" maxlength="9" class="max-300 id_number">
            </label>
        </div>
	</div>
	<div class="faind_line" style="margin-bottom: 0">
		
		<div class="faind_line" style="margin-bottom: 0;">
			<span class="max-w180"><b><u>2. כתב התחייבות עובד לשמירת מידע בתחום הגנת הפרטיות אבטחת מידע</u></b></span>
		</div>
		<div class="faind_line text" style="margin-bottom: 0">
		אני הח"מ,{{$metaJson['firstname']}} {{$metaJson['personal_lastname']}}, נושא ת.ז. מספר {{$metaJson['id_tz']}},   
כתובת {{$metaJson['personal_street']}} {{$metaJson['personal_house']}} {{$metaJson['personal_city']}}
			
			<div class="inline-input-control">
				<span class="max-w180">עומד להתחיל לעבוד במועצה האזורית הגליל העליון בתפקיד:</span>
				<input type="text" name="role" class="max-300"/>
			</div>
			<div class="input-control ml-0">
				<label>
					<span class="caption max-w180">ביום:</span>
					<input type="text" name="start_date" class="date_val max-240 mmax-205" autocomplete="off" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="DD/MM/YYYY">
				</label>
			</div>
			<style>
				ol {
				  counter-reset: item;
				}
				li {
				  display: block;
				}
				li:before {	
				  display: inline;
				  content: counters(item, ".") " ";
				  counter-increment: item
				}
			</style>
			הנני מצהיר ומתחייב לשמור על כללי אבטחת מידע והגנת הפרטיות כפי שהסבר לי על ידי ממונה אבטחת מידע של הרשות, לפי הנושאים הבאים:
			<ol>
				<li>מידע לגבי אזרח, תושב, קטין שניתן לפרסם: שם פרטי, שם משפחה, מספר תעודת זהות, כתובת מגורים.</li>
				<li>מידע שנמצא בתחום הגנת הפרטיות שאין להעביר לגורמים מחוץ למועצה ולגורמים בלתי מורשים:
				<ol>
					<li>אישיותו של אדם.</li>
					<li>מעמדו האישי.</li>
					<li>צנעת אישותו.</li>
					<li>מצב בריאותו.</li>
					<li>מצבו הכלכלי.</li>
					<li>הכשרתו המקצועית</li>
					<li>דעותיו ואמונתו.</li>
				</ol>
				</li>
				<li><b><u>אבטחת מידע:</u></b>
					<ol>
						<li>כניסה לרשת המועצה באמצאות סיסמא, נעילת מסך תופעל לאחר 15 דקות.</li>
						<li>כניסה לדוא"ל באמצאות סיסמא, סנכרון דוא"ל בטלפון ניד רק במידה ויש סיסמת כניסה לטלפון.</li>
						<li>תוכנות ואפליקציות שעובדי המועצה מתפעלים במסגרת תפקידם, כניסה בעזרת שם משתמש וסיסמא.</li>
						<li>יש לסגור את המשרד/מקום העבודה במידה ונשאר ללא עובדים.</li>
						<li>אין להשאיר מחשב נייד ללא השגחה או נעול במקום מאובטח</li>
					</ol>
				</li>
				<li>אירוע חדירה למערכות המועצה, (פריצת סיבר) יש לדוח מידית למנכ"ל המועצה ולממונה אבטחת מידע.</li>
			</ol>
			בחתימתי שלהלן אני מאשר שעברתי הדרכה בתחום הגנת הפרטיות אבטחת מידע וכללי ההתנהגות בתחום ברורים לי.
		</div>
		<div class="faind_line" style="margin-bottom: 0;">
			<span class="max-w180"><b><u>3. התחייבות לשמירת סודיות </u></b></span>
		</div>
		<div class="faind_line text" style="margin-bottom: 0">
			אני הח"מ,{{$metaJson['firstname']}} {{$metaJson['personal_lastname']}}, נושא ת.ז. מספר {{$metaJson['id_tz']}},
			<div class="inline-input-control">
				<span class="max-w180">המשמש כ:</span>
				<input type="text" name="role1" class="max-300"/>
			</div>
			<div class="inline-input-control">
				<span class="max-w180">מטעם:</span>
				<input type="text" name="role1_from_comp" class="max-300"/>
			</div>
			<b>מתחייב בזאת כלפי</b>, מועצה אזורית הגליל העליון/החברה/העמותה<br> 
			<b>כדלהלן:</b><br>
			במשך תקופת עבודתי עמכם וכן בכל עת לאחר מכן, אני ו/או העובדים מטעמי:<br><br>

1.	נשמור בסודיות מלאה ומוחלטת כל ידיעה, מסמך, רשימה, תכנית, צילום, וכל מידע אחר, כולל ממוחשב, שהגיע לידנו או לידיעתנו במסגרת עבודתנו והפעילות עבור מועצה אזורית הגליל העליון. החברה/העמותה<br><br>

2.	לא נעביר, נגלה, נמסור לאחר, או ננצל, כל מידע כנ"ל שהגיע לידינו או לידיעתנו בין במישרין ובין בעקיפין, או עקב  
 	או בקשר לביצוע עבודתנו, ולא נעשה בו כל שימוש שלא במסגרת טיפולנו עבור המועצה.<br><br>

3.	ננקוט בכל אמצעי הזהירות והאבטחה כלפי חומר כנ"ל, כדי למנוע אפשרות שייצא מרשותנו ויגיע לידי מי שלא  
 	הוסמך לקבלו.<br><br>	    

ידוע לי כי הרגישות הרבה של החומר בהיותו בבעלות מועצה אזורית הגליל העליון, וכן ידועה לי העובדה כי הינו מוגן בנוסף על פי חוק הגנת הפרטיות תשמ"א - 1981 (להלן: "החוק") ותקנות הגנת הפרטיות תשמ"ו – 1986.<br><br>               

הנני מתחייב לשמור ולקיים בקפדנות כל הוראה על פי דין לרבות כל הוראות החוק, הצווים והתקנות לפיו.<br><br>

ידוע לי כי אין בהצהרתי זו בכדי לגרוע מכל חובה המוטלת עלי על פי כל דין.<br><br>

ידוע לי ואני מסכים כי אם לא אקיים את התחייבויותיי לכם על פי כתב התחייבות זה, כולם או מקצתם, אפר את חובת הנאמנות שאני חב כלפיכם, וזאת בנוסף להפרת ההוראות הקבועות בחוק והעונשים הקבועים בדין.
		</div>
		
	<div class="faind_line" style="margin-bottom: 0;">
		<span class="max-w180"><b><u>4. זכויות פנסיוניות</u></b></span>
	</div>
	<div class="faind_line" style="margin-bottom: 0;">
		<h2><b>הזכויות אותן עלייך להסדיר הינן:</b></h2>
		<table>
			<tr>
				<th>השכר המבוטח</th>
				<th>הפרשת עובד</th>
				<th>הפרשת מעסיק</th>
				<th>פיצויים</th>
				<th>סה"כ</th>
				<th>כיסוי</th>
			</tr>
			<tr>
				<td>שכר יסוד</td>
				<td>7</td>
				<td>7.5</td>
				<td>8.33</td>
				<td>22.83</td>
				<td>שכר פנסיוני</td>
			</tr>
			<tr>
				<td>נוספות</td>
				<td>7</td>
				<td>7.5</td>
				<td>6</td>
				<td>20.5</td>
				<td>על שעות נוספות וכוננות בלבד</td>
			</tr>
		</table>
		
		<p>
		*אובדן כושר עבודה לעובד שיש לו ביטוח מנהלים ושיעור הפקדת המעסיק נמוכה מ-7.5%, יירכש עבור העובד א.כ.ע בנוסף ועד תקציב מירבי כולל של 7.5% ע"ח המעסיק.<br><br>
נבקש ליידעך כי על פי התקנות וההנחיות בתחום, הנך זכאי/ת לבחור את הגוף אשר יבטח זכויותיך אלו, וזכות זו הינה בידך בלבד ולבקשתך!!!
		</p>
		</div>
		<div class="faind_line" style="margin-bottom: 0;">
			<span class="max-w180"><b><u>אנא סמן/י את האופציה המועדפת עליך:</u></b></span>
		</div>
		<div class="faind_line" style="margin-bottom: 0;">
			<table>
				<tr>
					<td><b><u>אופציה 1</u></b>
						<label class="radio">
							<input type="radio" name="option" value="one">
							<span class="virtual"></span>
						</label>
					</td>
					<td style="text-align: center;">
						<b>אני מעוניין/ת לבחור בעצמי ועל דעתי את הגוף אשר יבטח זכויותיי.</b><br><br>
בהתאם לכך, הנך מתבקש/ת להעביר למדור שכר במועצה האזורית גליל עליון, את הניירת הנדרשת להסדרת זכויות אלו, הן בגין הביטוח  הפנסיוני והן בגין קופת הגמל אותם הנך מתבקש/ת להסדיר.<br><br>
יש למסור לקופה שלך את מספר ח.פ של העמותה 580269272 ולקבל מהקופה שלך "טופס הצטרפות למעסיק חדש", אותו יש להעביר בצירוף טופס זה, למדור שכר.<br><br>
להלן פרטי התקשורת עם המחלקה:<br>
reginaz@galil-elion.org.il<br>
04-6816629<br>
					</td>
				</tr>
				<tr>
					<td><b><u>אופציה 2</u></b>
						<label class="radio">
							<input type="radio" name="option" value="one">
							<span class="virtual"></span>
						</label>
					</td>
					<td style="text-align: center;">
						<b>ברירת מחדל:</b><br><br>

אינני מעוניין/ת לבחור בעצמי ביטוח פנסיוני (קרן פנסיה/ביטוח מנהלים) וקופת גמל.<br>
על כן, בגין כלל הזכויות הללו תשויך לאחת מקרנות הפנסיה אשר נבחרו כברירת המחדל  על ידי רשות שוק ההון, ביטוח וחסכון במשרד האוצר. נבקשך לבחור את קרן הפנסיה המבוקשת ולחתום מטה:<br>
                            <b>קרן הפנסיה "הלמן אלדובי פנסיה מקיפה" (מ"ה באוצר 1032)</b><br>
                        <b>קרן הפנסיה "מיטב ד"ש גמל ופנסיה בע"מ" (מ"ה באוצר 163)</b><br>
ידוע לי כי זוהי אחריותי הבלעדית לבדוק מול הקרן את תקינות התיק הביטוחי שלי על כל המשתמע מכך, כולל סוגיות לעניין אי אלו כיסויים, פרטי האישיים בקרן, דמי ניהול ועוד וכי למועצה אין ולא תהיה כל נגיעה לנושאים אלו מלבד הפרשת הכספים לקרן על פי ההנחיות.
						<div>אני {{$metaJson['firstname']}} {{$metaJson['personal_lastname']}}</div>
						<div class="max-w180">מספר זהות: {{$metaJson['id_tz']}} </div>
						<div class="inline-input-control">
							<label>
								<span class="caption max-w180">תאריך לידה:</span>
								<input type="text" name="birth_date" class="date_val max-240 mmax-205" autocomplete="off" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="DD/MM/YYYY">
							</label>
						</div>
					<div>כתובת {{$metaJson['personal_street']}} {{$metaJson['personal_house']}} {{$metaJson['personal_city']}}</div>
					<div>טלפון {{$metaJson['personal_phone']}}</div>
						<div class="inline-input-control">
							<label>
								<span class="caption max-w180">תאריך:</span>
								<input type="text" name="current_date" class="date_val max-240 mmax-205" autocomplete="off" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="DD/MM/YYYY">
							</label>
						</div>
						
					</td>
				</tr>
			</table>
		</div>
		<div><b>*במידה והטופס לא יוחזר למשאבי אנוש תוך 60 יום ממועד תחילת העבודה, תיפתח אחת מקרנות ברירת המחדל ע"פ תקנות האוצר. </b></div>
	</div>
	
	<div class="faind_line" style="margin-bottom: 0;">
		<span class="max-w180"><b>5. הצהרת העובד</b></span>
		<div class="text">
 הנני מצהיר בזאת שהפרטים כפי שמסרתי מלאים ונכונים.<br><br>
		</div>
	</div>
	<div data-show_type="bottom2||bottom3||bottom9||bottom11||bottom12||bottom13||bottom14||military_service_yes||is_seniority_yes">
		<div class="text" style="font-weight: bold;">מסמכים לצירוף</div>
		<table class="file-table faind_line hidden-pdf">
		<thead>
			<tr>
				<th class="text-right">שם הקובץ  </th>
				<th class="hidden-xs text-right">העלאת הקובץ</th>
				<th>פעולות </th>
			</tr>
		</thead>
		<tbody>
			@foreach($form_file as $key => $file)
			<tr <?php if(!empty($file['show_type'])) echo 'data-show_type="'.$file['show_type'].'"'; ?>>
				<td class="text-right">
					{{$file['name']}}
					<label for="file-upload-{{$key}}" class="btn btn-default pda success hidden-lg hidden-md hidden-sm">לחץ להעלאת קובץ</label>
					<label class="file-name hidden-lg hidden-md hidden-sm"></label>
				</td>
				<td class="hidden-xs">
					<label for="file-upload-{{$key}}" class="btn btn-default  success">לחץ להעלאת קובץ</label>
					<label class="file-name"></label>
					<input id="file-upload-{{$key}}" type="file" name="file[{{$key}}]" onchange="fileChange(this)" accept="application/pdf, image/jpeg, image/jpg, image/gif, image/png, image/jpe, image/tiff, image/bmp, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword" {{$file['required']}} />
				</td>
				<td>
					<a href="#" class="rm" onclick="removeFile({{$key}});return false;" ><i class="trash-icon"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
		</table><br><br>
	</div>
	<br/>
	<br/>
	<div class="faind_line">
	    <div class="caption" style="margin-bottom: 10px;">מייל לקבלת תלוש השכר:</div>
	    <div class="inline-input-control">
	        <label>
	            <span class="max-w180">עובד:</span>
	            <input type="email" name="email" required  class="max-280" placeholder="username@domainname.co.il" />
	        </label>
	    </div><br>
	</div>
	<div class="signature-container" style="text-align: left;float: left; padding-bottom: 50px;">
            <span class="caption" style="vertical-align: bottom;">חתימה:</span>
            <div class="signature-content" style="position: relative;">
                <canvas class="signature" width="200" height="40" style="width: calc(100% - 36px);height: 40px;touch-action: none;z-index: 1;position: relative;"></canvas>
                <span class="plesh_sig">
                     נא תחתום כאן עם העכבר 
                </span>
                <img class="signature-eraser" src="{{ asset('/front/img/eraser.png') }}" />
            </div>
            <div class="img"></div>
            <input class="signature-text" type="text" name="moth_sign" tabindex="-1" required style="opacity: 0; width: 0.1px; height: 0.1px; margin: 0!important; display: inline-block;">
        </div>
        <div class="center  hidden-pdf">
            <button class="btn btn-lg btn-default success" id="reportSendBtn"  type="submit">שלח בקשה  </button>
            <br>
            <div class="submit-error-msg"></div>
        </div>
    </div>
<form>
@endsection