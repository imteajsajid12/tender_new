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
        מזכירות  הגן: {{$msg}} <br> מועצה איזורית לכיש<br> א.ג.נ.,
      </p>
      <p style="text-align: center;text-decoration: underline;font-size: 20px">הנדון: רישום תושב חדש</p><br>
      <p style="margin-top: 20px;line-height: 30px;">
          הננו מתכבדים להודיעכם כי אושר לקלוט את בנך/ בתך: {{$metaJson['pn1']}} {{$metaJson['pf1']}}<br>
          ת.ז: {{$metaJson['id1']}}     תאריך לידה: {{$metaJson['A_birth1']}}   <br>
          ארץ הלידה:  @if($metaJson['immigrant1'] == 'לא') ישראל  @else כן  @endif <br>
          לשנת הלימודים: תש"פ   חתך גיל: {{$metaJson['grade1']}}   בגן: {{$msg}}   כתובת  הגן: @if(isset($metaJson['departmentdetails'][1])){{$metaJson['departmentdetails'][1]}} @endif    טלפון הגן: @if(isset($metaJson['departmentdetails'][2])){{$metaJson['departmentdetails'][2]}} @endif<br><br>
      </p>
      <div style="text-align: left;margin-top: 250px;">
        <img src="{{asset('img/Sig.png')}}">
      </div>

      <div style="margin-top: 20px;font-weight: normal;">
        <p style="line-height: 40px">העתקים: <br> {!! $users !!} </p>
      </div>

  </body>

</html>