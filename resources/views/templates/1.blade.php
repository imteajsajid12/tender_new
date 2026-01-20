<!DOCTYPE html>
<html lang="il" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $template->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @if (isset($download))
    <link rel="stylesheet" href="{{ asset('css/print-template-style.css') }}?v=090924">
    @endif
    @include('templates.include.css')
</head>
<body>
    <div class="container">


        <form action="{{ $actionURL }}" method="POST" class="">
            @if (!isset($download) || isset($isView))
            @include('templates.include.header')
            @endif
            <div class="text-right">
                <div class="text-right mt-4 row justify-content-end">
                    <div class="@isset($download) col-12 @else col-auto @endisset">
                        <input type="date" class="form-control @isset($download) text-left @endisset text-left" id="date" name="date" value="25 אוגוסט, 2024">
                    </div>
                </div>
                @csrf
                @include('templates.include.template-name')
                <div class="form-group d-flex justify-content-center align-items-center">
                    <label class="col-auto w-auto d-inline mb-0" for=""><u>מקום העבודה</u></label>
                    <textarea class="form-control col w-auto d-inline @isset($download) p-0 @endisset" name="workplace" id="workplace" type="text" >מועצה מקומית קריית ארבע חברון (ליד גדרה)</textarea>
                </div>
                <div class="form-group d-flex justify-content-center align-items-center">
                    <label class="col-auto w-auto d-inline mb-0" for=""><u>הקף משרה</u></label>
                    <textarea class="form-control col w-auto d-inline @isset($download) p-0 @endisset" name="position" id="position" type="text" >100%</textarea>
                </div>
                <div class="form-group d-flex justify-content-center align-items-center">
                    <label class="col-auto w-auto d-inline mb-0" for=""><u>שכר</u></label>
                    <textarea class="form-control col w-auto d-inline @isset($download) p-0 @endisset" name="wage" id="wage" type="text" >מינהלי 7-10</textarea>
                </div>
                <div class="form-group d-flex justify-content-center align-items-center">
                    <label class="col-auto w-auto d-inline mb-0" for=""><u>כפיפות</u></label>
                    <textarea class="form-control col w-auto d-inline @isset($download) p-0 @endisset" name="subordination" id="subordination" type="text" >למנהל התחבורה, מונחה מקצועית ע"י קצין בטיחות בתעבורה 5</textarea>
                </div>
                <div class="form-group d-flex justify-content-center align-items-center">
                    <label class="col-auto w-auto d-inline mb-0" for=""><u>תחילת עבודה</u></label>
                    <textarea class="form-control col w-auto d-inline @isset($download) p-0 @endisset" name="starting_work" id="starting_work" type="text" >מיידי</textarea>
                </div>
                <div class="form-group">
                    <label for="">תיאור התפקיד</label>
                    <textarea class="form-control" name="job_description" id="job_description" type="text" >נהיגה באוטובוס השייך לרשות המקומית או משמש אותה והפעלתו לצורך הסעת תלמידים או
                        הסעת נוסעים אחרים, בהתאם לצרכי הרשות המקומית.</textarea>
                </div>
                <div class="form-group">
                    <label for="">תחומי אחריות עיקריים</label>
                    <textarea style="field-sizing: content" class="form-control" name="main_areas_of_responsibility" id="main_areas_of_responsibility">1 הסעת נוסעים באוטובוס, בהתאם לצרכי הרשות המקומית.
        .2 הסעת תלמידים למסגרות חינוכיות ולפעילויות מטעם המסגרות החינוכיות.
        .3 טיפול בבטיחות ובתקינות של האוטובוס .</textarea>
                </div>
                <div class="font-weight-bold text-right">
                    <span>פירוט הביצועים והמשימות העיקריות, כנגזר מתחומי האחריות:</span>
                </div>
                <div class="form-group mr-4">
                    <label for="">.1 הסעת נוסעים באוטובוס, בהתאם לצרכי הרשות המקומית
                    </label>
                    <textarea style="field-sizing: content" name="transportation_of_passengers_by_bus" id="transportation_of_passengers_by_bus"
                    class="form-control">א. נהיגה בטוחה בהתאם לכללי הבטיחות ולהוראות הדין הקיים, לרבות הקפדה על
                        שעות הנהיגה וההפסקות שנקבעו בדין.
                        ב. נקיטת אמצעי זהירות, לצורך הבטחת ביטחון הנוסעים.
                        ג. קיום סדרי ביטחון ובדיקות לאיתור חפצים חשודים, בהתאם להוראות הדין
                        הקיים.
                        ד. העלאה והורדה של הנוסעים, על פי כללי הבטיחות.
                        ה. מתן שירות אדיב ומנומס לנוסעים .</textarea>
                </div>
                <div class="form-group mr-4">
                    <label for="">.2 הסעת תלמידים למסגרות חינוכיות ולפעילויות מטעם המסגרות החינוכיות
                    </label>
                    <textarea style="field-sizing: content" name="transportation_of_students_to_educational_settings" id="transportation_of_students_to_educational_settings"
                    class="form-control">א. התקנת שילוט, לפני ומאחורי האוטובוס, ועליו כיתוב בולט "הסעות ילדים".
                        ב. פיקוח על ישיבת התלמידים במקומות הישיבה ועל היותם חגורים בחגורות
                        בטיחות, בהתאם למספר מקומות הישיבה.
                        ג. פיקוח על המתרחש באוטובוס במהלך ההסעה, ומניעת התנהגות לא בטיחותית.
                        ד. העלאה והורדה של התלמידים, על פי כללי הבטיחות )בין אם אוטובוס זעיר או
                        אוטובוס) בתחנות הסעה קבועות ומוסדרות מראש, לרבות הפעלת פנסי איתות
                        מהבהבים בכל עת שדלתות הרכב פתוחות.
                        ה. בדיקה כי התלמידים ירדו מהאוטובוס והתרחקו מנתיב הנסיעה, לפני המשך
                        הנסיעה.
                        ו. סריקת האוטובוס בתום ההסעה, על מנת לוודא שלא נותרו בו ילדים או חפצים.</textarea>
                </div>
                <div class="form-group mr-4">
                    <label for="">.3 טיפול בבטיחות ובתקינות של האוטובוס
                    </label>
                    <textarea style="field-sizing: content" name="bus_safety_and_soundness" id="bus_safety_and_soundness"
                    class="form-control">א. בדיקת תקינות מערכותיו ההידראוליות והמכניות של האוטובוס, מדי יום לפני
                        היציאה לנסיעות ובמהלך ביצוען )כגון: ביצוע בדיקת שמן, מים, צמיגים, בלמים,
                        מגבים, מערכת החשמל והאורות, פעולות הפתיחה והסגירה של הדלתות וכיוצ"ב).
                        ב. ביצוע תיקונים קלים הדרושים לאחזקה של האוטובוס, ודיווח לממונה על תקלות
                        או ליקויים שהתגלו.
                        ג. העברת האוטובוס למוסך המורשה של הרשות המקומית, בהתאם להנחיות
                        הממונה.
                        ד. מילוי פרטי תקלות בכרטיס הרכב.
                        ה. בדיקת האוטובוס לאחר תיקונו במוסך המורשה של הרשות המקומית, בהתאם
                        לנהלים ולהנחיות הממונה .
                        ו. זיווד האוטובוס באביזרי בטיחות ובאביזרי עזר )מטף, משולש, עזרה ראשונה, אפוד
                        זוהר וכיו"ב).
                        ז. וידוא תוקפם של מסמכי הרכב )רישיון הרכב, ביטוח חובה וכיו"ב( והימצאותם
                        ברכב בזמן הנסיעה.
                        ח. תדלוק הרכב וחנייתו בהתאם להנחיות הממונה והרשות המקומית.
                        ט. שטיפת הרכב ווידוא ניקיונו של האוטובוס, לרבות ניקיון סביר מבחוץ וחיטוי אחת
                        לשנה.
                        י. החזרת הרכב בסיום יום העבודה למקום הריכוז של רכב הרשות המקומית.
        יא. רישום מדויק ביומן הנסיעות )כרטיס הרכב( של הרשות המקומית מדי יום .
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="">מאפייני העשייה הייחודיים בתפקיד:
                    </label>
                    <textarea style="field-sizing: content" name="unique_performance_characteristics" id="unique_performance_characteristics"
                    class="form-control">א. שירותיות בעבודה מול קהל ועם ילדים בפרט.
                        ב. ייצוגיות.
                        ג. אחריות לחיי אדם.
                        ד. סמכותיות.
                        ה. סדר וארגון.
                        ו. יכולת ונכונות לעבוד בשעות בלתי שגרתיות, בסופי שבוע ובחול המועד.
                        ז. עבודה מאומצת במצבי חירום מקומיים ולאומיים.
                        ח. יכולת ניידות ורישיון נהיגה בתוקף )חובה( ונכונות לבצע נסיעות במסגרת התפקיד.
                        ט. אמינות ויושרה.
                        י. יכולת עבודה בצוות עם גורמי פנים וחוץ.
                        יא. מתן שירות בשגרה ובחירום.
                        יב. שליטה בשפה העברית ברמה טובה.
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="">רישום פלילי:
                    </label>
                    <textarea style="field-sizing: content" name="criminal_record" id="criminal_record"
                    class="form-control">היעדר הרשעות פליליות או תחבורתיות, בהתאם לתקנה 15 ב לתקנות התעבורה.
                        • היעדר הרשעה בעבירת מין ,בהתאם לחוק למניעת העסקה של עברייני מין במוסדות
                        מסוימים , תשס"א 2001- .
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="">ידע והשכלה1:
                    </label>
                    <textarea style="field-sizing: content" name="knowledge_and_education_1" id="knowledge_and_education_1"
                    class="form-control">12 שנות לימוד או תעודת בגרות מלאה.
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="">קורסים והכשרות מקצועיות:2
                    </label>
                    <textarea style="field-sizing: content" name="professional_courses_and_trainings_2" id="professional_courses_and_trainings_2"
                    class="form-control">א. קורס לנהגי רכב ציבורי של משרד התחבורה.
                        ב. השתלמות להסעת תלמידים בהתאם לתקנה 84 לתקנות התעבורה.
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="">נסיון מקצועי3:
                    </label>
                    <textarea name="professional_experience_3" id="professional_experience_3"
                    type="text" class="form-control">נדרש ניסיון של שנתיים לפחות בעבודה כנהג אוטובוס.</textarea>
                </div>
                <div class="form-group">
                    <label for="">דרישות נוספות4:
                    </label>
                    <textarea name="additional_requirements_4" id="additional_requirements_4"
                    type="text" class="form-control">נדרש ניסיון של שנתיים לפחות בעבודה כנהג אוטובוס.</textarea>
                </div>
                <div class="form-group">
                    <label for="">לצורך הגשת מועמדות חובה להגיש:
                    </label>
                    <textarea style="field-sizing: content" name="application_requirements" id="application_requirements"
                    class="form-control">• שאלון אישי למילוי השאלון לחץ כאן
                        • קורות חיים
                        • תעודות השכלה בהתאם לדרישות המשרה
                        • המלצות )במידה ויש(
                    </textarea>
                </div>


                <div class="form-group">
                    <label for="">
                    </label>
                    <textarea style="field-sizing: content" name="application_rules1" id="application_rules1"
                class="form-control"> על המעוניינים.ות העונים לדרישות התפקיד להעביר את כל המסמכים הנדרשים לעיל, באופן
                    מסודר וקריא , וזאת לא יאוחר מיום 07/09/2024 באמצעות הגשה למייל:
            </textarea>
                </div>
                <div class="w-100 font-weight-bold text-right">
                    <a href=" {{ $template->tender?->generated_id ? (url('page5?tenderid='. $template->tender?->generated_id.'&tenderdisplay='.$template->tender?->generated_id)) : '' }}" target="_blank" rel="noopener noreferrer">להגשת מועמדות לחץ כאן</a>
                            </div>
                <div class="form-group">
                    <label for="">
                    </label>
                    <textarea style="field-sizing: content" name="application_rules2" id="application_rules2"
                class="form-control">
                לפקס 08-8500703 או במסירה ידנית - לידי לילך פרסקו מנהלת ההון האנושי במשרדי מועצה מקומית קריית ארבע חברון, בשעות הפעילות הקבועות
            </textarea>
                </div>
                <div class="form-group">
                    <label for="">
                    </label>
                    <textarea style="field-sizing: content" name="application_rules3" id="application_rules3"
                class="form-control">

                מועמדים.ות שלא יגישו את כל המסמכים הנדרשים במלואם כאמור לעיל ובמועד שנקבע,
                    מועמדותם.ן לא תיבדק והיא תפסל על הסף.            </textarea>
                </div>
                <div class="form-group">
                    <label for="">
                    </label>
                    <textarea style="field-sizing: content" name="application_rules4" id="application_rules4"
                class="form-control">                            כל מקום בו מפורט תיאור התפקיד בלשון זכר, הכוונה גם ללשון נקבה, וכן להיפך
                הארגון נכון לבצע התאמות על מנת לשלב בתפקיד עובדים עם מוגבלות.
                בוועדה תינתן עדיפות להעסקתם של מועמדים עם מוגבלות משמעותית, בהתאם להוראות סעיף
                9ג)ג()1( לחוק שוויון זכויות לאנשים עם מוגבלות, תשנ"ח1998- אשר כישוריהם דומים
                לכישורים של מועמדים אחרים.

                </textarea>
                </div>



                @if (!isset($download))
                <div class="row">
                    <a href="{{ route('template.list') }}" class="d-print-none btn btn-success text-center col-auto my-4">בְּחֲזָרָה</a>
                    <button class="btn btn-info text-center col my-4"> {{ $isDuplicate ? 'העתק תבנית' : 'שמור תבנית' }}</button>
                </div>
                @endif
            </div>
        </form>
        @if (!isset($download) || isset($isView))
        @include('templates.include.footer')
        @endif
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        @if (!isset($download))
        var datas = {!! ($template->value) !!};
        console.log(datas);

        window.onload = ()=>{
            for (data in datas){

                // console.log('data ',data);


                if(document.getElementById(data)!= null){
                    var isLabel = false;
                    if(document.getElementById(data).tagName=='INPUT'){
                        // console.log('iput '+data, datas[data].value);

                        var ele = document.getElementById(data);
                        ele.value = datas[data].value
                        document.getElementById(data).setAttribute('value',datas[data].value)
                    }else{
                        var ele = document.getElementById(data);
                        ele.innerText = datas[data].value
                    }
                    // console.log(ele, ele.previousSibling);
                    if($(ele).attr('name')!='header_title'){
                        var label = ele.previousSibling.previousSibling;

                        if(label!= null && label.tagName=='LABEL' && data!='template_name'){
                            label.innerHTML = (`<input class="form-control" id="${data}_label" value="${datas[data+'_label']!=undefined ? datas[data+'_label'].value : label.innerText}" name="${data}_label">`)
                        }
                    }
                    // if(data.indexOf('label') > -1){
                    //     console.log(data,datas[data]);
                    // }

                }
            }
        }
        @endif

        // $('label').map(function(i,k){
        //     // console.log($(k).text()+' -> '+$(k).next().attr('name'));
        // })
    </script>
    @include('templates.include.js')
</body>
</html>
