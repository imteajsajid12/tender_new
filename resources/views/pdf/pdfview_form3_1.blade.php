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
      <p style="margin-bottom: 50px;line-height: 2.083;margin-top: 3px">
        הורי התלמיד/ה: {{$metaJson['cn1']}} {{$metaJson['cf1']}}<br>
        כתובת:  {{$metaJson['addres21']}}  {{$metaJson['addres22']}}  {{$metaJson['addres2']}}<br>
        טלפון הורה 1: {{$metaJson['mobile_phone1']}} {{$metaJson['mobile_phone1_select']}}&nbsp;&nbsp;הורה 2: {{$metaJson['mobile_phone2']}} {{$metaJson['mobile_phone2_select']}}
      </p>
      <p style="text-align: center;text-decoration: underline;font-size: 20px">הנדון: אישור העברה למוסד חינוכי אחר לשנה"ל תש"פ</p><br>
      <p style="margin-top: 20px;line-height: 30px;">
        הריני להודיעכם כי בקשת העברה עבר בנכם/ בתכם גיא ענבר<br> 
        ת.ז  {{$metaJson['id1']}} &nbsp;&nbsp;   ממוסד חינוכי: {{$metaJson['current1']}}<br>
        למוסד חינוכי: @if(isset($metaJson['current11'])) {{$metaJson['current11']}} @endif &nbsp;&nbsp;&nbsp;&nbsp;    אושרה<br><br>
        אי לכך בנכם/ בתכם משובץ במוסד  @if(isset($metaJson['current11'])) {{$metaJson['current11']}} @endif<br><br>
        <b>אנו מאחלים לילדכם שנת לימודים טובה ומהנה.</b>
      </p>
      <div style="text-align: left;margin-top: 250px;">
        <img src="{{asset('img/Sig.png')}}">
      </div>

      <div style="margin-top: 20px;font-weight: normal;">
        <p style="line-height: 40px">העתקים: <br> {!! $users !!} </p>
      </div>
	  

  </body>

</html>