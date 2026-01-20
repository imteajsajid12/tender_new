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
         {{$metaJson['disposal']}}<br>
      </p>
      <p style="text-align: center;text-decoration: underline;font-size: 20px">הנדון: בקשתכם לביטול רישום</p><br>
      <p style="margin-top: 20px;line-height: 30px;">
      <?php $num_childrens = $metaJson['num_children']; ?>
      @for($i=1; $i <= $num_childrens; $i++)
        הרני מאשר כי גרענו את   ילד/ים הר"מ ממוסדות החינוך שלנו לשנה"ל תש"פ.<br>
         {{$metaJson['cn'.$i]}} {{$metaJson['cf'.$i]}}    ת.ז:   {{$metaJson['id'.$i]}}     ת.לידה: {{$metaJson['date_birth'.$i]}} <br>
        שם המוסד: {{$metaJson['current'.$i] }}    כיתה: {{$metaJson['grade'.$i] }}    מסגרת חינוכית: {{$metaJson['educational_framework'.$i]}}<br><br>
      @endfor  
      </p>
      <div style="text-align: left;margin-top: 250px;">
        <img src="{{asset('img/Sig.png')}}">
      </div>

      <div style="margin-top: 20px;font-weight: normal;">
        <p style="line-height: 40px">העתקים: <br> {!! $users !!} </p>
      </div>
  </body>

</html>