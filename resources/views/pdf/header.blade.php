<!DOCTYPE html>
<html lang="he">
    <head>
        <meta charset="utf-8">
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
            body {
                font-size: 18px;
            }
            p {
                margin: 15px 0;
            }
            .site-title {
                font-size: 22.136px;
                color: rgb( 0, 0, 0 );
                font-weight: bold;
                text-transform: uppercase;
                -moz-transform: matrix( 1.35526644815155,0,0,1.35526644815155,0,0);
                -webkit-transform: matrix( 1.35526644815155,0,0,1.35526644815155,0,0);
                -ms-transform: matrix( 1.35526644815155,0,0,1.35526644815155,0,0);
                padding-top: 50px;
            }
            .site-title-content {
                width: 100%;
                margin: 0;
                text-align: center;
            }
            .top-row > div {
                display: inline-block;
            }

            .main .main-footer {
                border-top: 2px solid rgb( 142, 186, 14 );
                padding-top: 20px;
                padding-bottom: 40px;
            }
            .main{
                margin-top: 0px;
            }

            .dot-separator {
                display: inline-block;
                width: 10px;
                height: 10px;
                border-radius: 50%;
                background-color: rgb( 142, 186, 14 );
                margin: 0 10px;
                margin-bottom: 2px;
            }
        </style>
    </head>
  <body >
      <div class="top-row" style="margin-bottom: 50px;position: relative;min-height: 160px;">
          <div class="nopadding" style="position: absolute; top: 0; right: 0;">
              <a href="" class="logo">
                  <img src="{{$app_dec->tender_body_image ? asset($app_dec->tender_body_image) : asset('front/img/logo.png')}}" style="width: 200px">
              </a>
          </div>
		  <div class="site-title-content">
			  <h1 class="site-title">המועצה האזורית לכיש - מחלקת חינוך</h1>
		  </div>
      </div>
      <p style="margin-bottom: 0px;margin-top: 30px">לכבוד <span style="float: left;display: block;"><?php echo date('d/m/Y'); ?></span></p>
</body>
</html>
