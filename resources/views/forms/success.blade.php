<html dir="rtl" lang="he-IL">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="אוטומס - מחשבון לבדיקת חיובי ארנונה" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />

        {{-- <title>{{$form->title}}</title> --}}
        <title>{{ request()->host() }}</title>


        <meta http-equiv="X-UA-Compatible" content="IE=11" />
        <meta http-equiv="Content-Language" content="he" />
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/img/favicon-16x16.png') }}">

        <link href="{{ asset('/front/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/front/css/main.css') }}" rel="stylesheet" />
        <link href="{{ asset('/front/css/media.css') }}" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <main>
                <div class="row top-row">
                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-8 text-left">
                        <h1 class="site-title" style="color: #4eb053;margin-top: 50px;line-height: 40px;text-align: right;">
                            הטופס הוזן בהצלחה ונשלח להמשך טיפול, הינך מוזמנ/ת לראות העתק של הטופס ומספר פניה במייל.                        
						</h1>

                        </h4>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-4 text-center">
                        <a href="/">
                            <img src="{{ asset('img/logo-b.png') }}" />
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
