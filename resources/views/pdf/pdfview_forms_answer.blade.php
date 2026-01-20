<html lang="he">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> מחלקת משאבי אנוש </title>
        <link href="https://fonts.googleapis.com/earlyaccess/opensanshebrew.css" rel="stylesheet">
        <style type="text/css">
            #app{
                direction: rtl;
                margin: auto;
                box-sizing: border-box;
                margin: auto;
                font-size: 16px;
                padding: 20px 30px 0 30px;
                position: relative;
            }
            body {
                font-family: 'Open Sans Hebrew';
            }
            div#app p {
                margin: 15px 0;
            }

            .site-title {
                font-size: 30px;
                color: rgb( 0, 0, 0 );
                font-weight: bold;
                text-transform: uppercase;
                margin-top: 15px;
            }
            .site-title-content {
                width: 500px;
                margin: 0 10px 0 ;
                text-align: center;
                vertical-align: top;
            }
            .top-row > div {
                display: inline-block;
            }
			.signature {
				margin-top: 150px;
				margin-bottom: 50px;
                font-size: 20px;
                height: 100px;
                width: 100%;
                text-align: left;
				display: flex;
				flex-direction: column;
            }
        </style>
    </head>

  <body id="bod">
    <div id="app" style="direction: rtl;">
       <div class="app"  dir="rtl">
          <div class="top-row" style="margin-bottom: 50px;">
              <div class="nopadding">
                  <a href="" class="logo">
                      <img src="{{$app_dec?->tender_body_image ? asset($app_dec?->tender_body_image) : asset('front/img/logo-b.png')}}" style="width: 200px;">
                  </a>
              </div>
              <div class="site-title-content">
                <h1 class="site-title">אגף משאבי אנוש -  {{ $app_dec?->tender_body ?? 'מועצה מקומית קריית ארבע חברון' }} </h1>
              </div>
          </div>
          <p style="">לכבוד  <span style="float: left;display: block;">{{ date('d-m-y' )}}</span></p>
          <p style="margin-bottom: 50px;"> מר/ גב': {{$sender}}<br>
		   א.נ/ג.נ<br></p>
          <p style="text-align: center;text-decoration: underline;font-size: 20px">הנדון: פנייתכם בנושא {{$tendername}}</p><br>

          <p style="margin-top: 45px">
            אנו מתכבדים להודיעכם כי פנייתכם מס'  {{$decision_id}} התקבלה אצלינו במערכת ותשובה תשלח אליכם בהקדם.
          </p>
        </div>
        <div class="signature">
		{{-- <img width="150" src="{{ asset('/img/signature.jpg') }}" alt=""> --}} 
		<div> 
			<a href="https://www.tcarmel.automas.co.il">www.tcarmel.automas.co.il</a>
		</div>
		<div>
			<img src="{{$app_dec?->tender_body_image ? asset($app_dec?->tender_body_image) : asset('front/img/logo-b.png')}}">
		</div>
    </div>
        @include('pdf.pdf_decision_footer')


