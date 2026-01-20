<!DOCTYPE html>
<html dir="rtl" lang="he-IL">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{$form->title}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=11" />
    <meta http-equiv="Content-Language" content="he" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/img/favicon-16x16.png')}}">

    <link href="{{ public_path('/front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ public_path('/front/css/main.css') }}" rel="stylesheet" />
    <link href="{{ public_path('/front/css/pdf.css?v=3') }}" rel="stylesheet" />
    <style>
        .btn-input-upload{display:none}
        .btn-upload{display:none}
        .btn-descr{display:none}
    </style>

    <script src="{{public_path('js/jquery-3.3.1.min.js')}}"></script>
</head>
<body>
<div class="container">
    <main>
        <div class="content">
            <div class="top-row">
                <div class="nopadding">
                    <a href="" class="logo">
                        <img src="{{ asset($app_dec->tender_body_image) }}" style="width: 200px;"/>
                    </a>
                </div>
                <div class="site-title-content" style="padding-right: 120px">
                    <h1 class="site-title">{{ $app_dec?->tender_body ?? 'מועצה מקומית קריית ארבע חברון' }} - מחלקת משאבי אנוש</h1>
                </div>
                <div class="input-control" style="vertical-align: bottom; margin-bottom: 15px;margin-left: 0;">
                    <label>
                        <span class="caption">תאריך:</span>
                        <input type="text" name="dd" disabled style="border:none" class="max-100" value="<?php echo date('d/m/Y'); ?>">
                    </label>
                </div>
            </div>
            <form id="form" method="post">
                {!! $formhtml !!}
            </form>
        </div>
    </main>

</div>
<script type="text/javascript">
    $('select').each(function(){
        $(this).replaceWith('<span style="    border-bottom: 1px solid #000; display: inline-block; height: 27px; margin-bottom: 5px;" class="text">'+$(this).val()+'</span>');
    });
</script>
</body>
</html>

