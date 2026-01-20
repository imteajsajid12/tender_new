<html lang="he">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> מחלקת חינוך, נוער וספורט </title>
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
            p {
                margin: 15px 0;
            }
        </style>
    </head>

  <body id="bod">
      <p style="margin-bottom: 30px;line-height: 2.083;margin-top: 3px">
        מנהל מחלקת החינוך<br>
         {{$metaJson['auth_nam1']}}<br>
        שלום רב,
      </p>
      <p style="text-align: center;text-decoration: underline;font-size: 20px">הנדון: אישור לימודי חוץ לשנה"ל תש"פ</p><br>
      <p style="margin-top: 20px;line-height: 30px;">
      @for($i=1; $i <= 1; $i++)
        הרינו לאשר כי הילד/ה: {{$metaJson['cn'.$i]}} {{$metaJson['cf'.$i]}} תעודת זהות:  {{$metaJson['id'.$i]}}  &nbsp;&nbsp;&nbsp; תאריך לידה: {{$metaJson['date_birth'.$i]}}  &nbsp;&nbsp;&nbsp;  חתך גיל: {{$metaJson['grade'.$i]}}<br>
        הינה תושב/ת: מועצה איזורית לכיש<br>
        הילד/ה מופנה/ית אליכם לשיבוץ חוץ<br><br>
         {{$metaJson['educational_framework'.$i]}}<br>
        גן: ארזים <br><br>
      @endfor  
        
      <b> שיבוץ זה הוא בחירתם של ההורים. אנו נעתרים לבקשת ההורים אך איננו מאשרים את התשלום הנלווה לשיבוץ זה. לתלמיד יש פתרון חינוכי שנקבע בוועדת השיבוץ שברשות. ידוע להורים שתשלום החוץ ישולם מכיסם בהתחשבנות ישירה מול הרשות הקולטת, ועל כך נתנו הסכמתם בכתב. </b>

      </p>
      <div style="text-align: left;margin-top: 200px;">
        <img src="{{asset('img/Sig.png')}}">
      </div>

      <div style="margin-top: 20px;font-weight: normal;">
        <p style="line-height: 40px">העתקים: <br> {!! $users !!} </p>
      </div>
  </body>

</html>