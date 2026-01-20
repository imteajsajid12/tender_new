<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $template->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <div class="mt-2">
            <div class="page-header-title pt-4 bg-white text-center font-weight-bold" style="background-image: url('{{ asset('img/templates/temp1-header.jpg') }}');    background-position: center;
        background-repeat: repeat;
        background-size: cover; height:120px">
                <b><u>מכרז כ"א 24.24 למשרת נהגי.ות אוטובוס </u></b>
                <img  alt="">
            </div>
        </div>
        <div class="text-left mt-4 w-100">
            25 אוגוסט, 2024
        </div>
        <form action="" method="POST">
            <div class="form-group">
                <label for="">מקום העבודה</label>
                <input class="form-control" name="workplace" type="text" value="מועצה מקומית קריית ארבע חברון (ליד גדרה)">
            </div>
            <div class="form-group input-group">
                <label for="" class="w-100">הקף משרה</label>
                <input name="position" class="form-control" type="number" value="">
                <div class="input-group-append">
                    <div class="input-group-text">%</div>
                </div>
            </div>
            <div class="form-group">
                <label for="">שכר</label>
                <input name="wage" class="form-control" type="text" value="מינהלי 7-10">
            </div>
            <div class="form-group">
                <label for="">כפיפות</label>
                <input class="form-control" name="subordination" type="text" value='למנהל התחבורה, מונחה מקצועית ע"י קצין בטיחות בתעבורה 5'>
            </div>
            <div class="form-group">
                <label for="">תחילת עבודה</label>
                <input name="starting_work" class="form-control" type="text" value="מיידי">
            </div>
            <div class="form-group">
                <label for="">תיאור התפקיד</label>
                <input class="form-control" name="job_description" type="text" value="נהיגה באוטובוס השייך לרשות המקומית או משמש אותה והפעלתו לצורך הסעת תלמידים או
    הסעת נוסעים אחרים, בהתאם לצרכי הרשות המקומית.">
            </div>
            <div class="form-group">
                <label for="">תחומי אחריות עיקריים</label>
                <textarea class="form-control" name="main_areas_of_responsibility" id="" cols="30" rows="10">1 הסעת נוסעים באוטובוס, בהתאם לצרכי הרשות המקומית.
    .2 הסעת תלמידים למסגרות חינוכיות ולפעילויות מטעם המסגרות החינוכיות.
    .3 טיפול בבטיחות ובתקינות של האוטובוס .</textarea>
            </div>
            <div class="font-weight-bold">פירוט הביצועים והמשימות העיקריות, כנגזר מתחומי האחריות:
            </div>
            <div class="form-group">
                <label for="">.1 הסעת נוסעים באוטובוס, בהתאם לצרכי הרשות המקומית
                </label>
                <textarea name="transportation_of_passengers_by_bus"
                class="form-control" id="" cols="30" rows="10">א. נהיגה בטוחה בהתאם לכללי הבטיחות ולהוראות הדין הקיים, לרבות הקפדה על
                    שעות הנהיגה וההפסקות שנקבעו בדין.
                    ב. נקיטת אמצעי זהירות, לצורך הבטחת ביטחון הנוסעים.
                    ג. קיום סדרי ביטחון ובדיקות לאיתור חפצים חשודים, בהתאם להוראות הדין
                    הקיים.
                    ד. העלאה והורדה של הנוסעים, על פי כללי הבטיחות.
                    ה. מתן שירות אדיב ומנומס לנוסעים .</textarea>
            </div>
            <div class="form-group">
                <label for="">.2 הסעת תלמידים למסגרות חינוכיות ולפעילויות מטעם המסגרות החינוכיות
                </label>
                <textarea name="transportation_of_students_to_educational_settings"
                class="form-control" id="" cols="30" rows="10">א. התקנת שילוט, לפני ומאחורי האוטובוס, ועליו כיתוב בולט "הסעות ילדים".
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
            <div class="form-group">
                <label for="">.3 טיפול בבטיחות ובתקינות של האוטובוס
                </label>
                <textarea name="bus_safety_and_soundness"
                class="form-control" id="" cols="30" rows="10">א. בדיקת תקינות מערכותיו ההידראוליות והמכניות של האוטובוס, מדי יום לפני
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
                <textarea name="unique_performance_characteristics"
                class="form-control" id="" cols="30" rows="10">א. שירותיות בעבודה מול קהל ועם ילדים בפרט.
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
                <textarea name="criminal_record"
                class="form-control" id="" cols="30" rows="10">היעדר הרשעות פליליות או תחבורתיות, בהתאם לתקנה 15 ב לתקנות התעבורה.
                    • היעדר הרשעה בעבירת מין ,בהתאם לחוק למניעת העסקה של עברייני מין במוסדות
                    מסוימים , תשס"א 2001- .
                </textarea>
            </div>
            <div class="form-group">
                <label for="">ידע והשכלה1:
                </label>
                <textarea name="knowledge_and_education_1"
                class="form-control" id="" cols="30" rows="10">12 שנות לימוד או תעודת בגרות מלאה.
                </textarea>
            </div>
            <div class="form-group">
                <label for="">קורסים והכשרות מקצועיות:2
                </label>
                <textarea name="professional_courses_and_trainings_2"
                class="form-control" id="" cols="30" rows="10">א. קורס לנהגי רכב ציבורי של משרד התחבורה.
                    ב. השתלמות להסעת תלמידים בהתאם לתקנה 84 לתקנות התעבורה.
                </textarea>
            </div>
            <div class="form-group">
                <label for="">נסיון מקצועי3:
                </label>
                <input name="professional_experience_3"
                type="text" class="form-control" value="נדרש ניסיון של שנתיים לפחות בעבודה כנהג אוטובוס.">
            </div>
            <div class="form-group">
                <label for="">דרישות נוספות4:
                </label>
                <input name="additional_requirements_4"
                type="text" class="form-control" value="נדרש ניסיון של שנתיים לפחות בעבודה כנהג אוטובוס..">
            </div>
            <div class="form-group">
                <label for="">לצורך הגשת מועמדות חובה להגיש:
                </label>
                <textarea name="application_requirements"
                class="form-control" id="" cols="30" rows="10">• שאלון אישי למילוי השאלון לחץ כאן
                    • קורות חיים
                    • תעודות השכלה בהתאם לדרישות המשרה
                    • המלצות )במידה ויש(
                </textarea>
            </div>
            <div class="w-100 font-weight-bold">
                על המעוניינים.ות העונים לדרישות התפקיד להעביר את כל המסמכים הנדרשים לעיל, באופן
    מסודר וקריא , וזאת לא יאוחר מיום 07/09/2024 באמצעות הגשה למייל: form send to link או
    לפקס 08-8500703 או במסירה ידנית - לידי לילך פרסקו מנהלת ההון האנושי במשרדי מועצה מקומית קריית ארבע חברון, בשעות הפעילות הקבועות
            </div>
            <div class="w-100 my-4">מועמדים.ות שלא יגישו את כל המסמכים הנדרשים במלואם כאמור לעיל ובמועד שנקבע,
                מועמדותם.ן לא תיבדק והיא תפסל על הסף.
            </div>
            <div class="w-100 font-weight-bold">
                כל מקום בו מפורט תיאור התפקיד בלשון זכר, הכוונה גם ללשון נקבה, וכן להיפך
    הארגון נכון לבצע התאמות על מנת לשלב בתפקיד עובדים עם מוגבלות.
    בוועדה תינתן עדיפות להעסקתם של מועמדים עם מוגבלות משמעותית, בהתאם להוראות סעיף
    9ג)ג()1( לחוק שוויון זכויות לאנשים עם מוגבלות, תשנ"ח1998- אשר כישוריהם דומים
    לכישורים של מועמדים אחרים.
            </div>
            <button class="btn btn-info text-center w-100 my-4">שמור תבנית</button>
        </form>
    </div>
</body>
</html>
