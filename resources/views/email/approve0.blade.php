<?php
/**
 * Created by PhpStorm.
 * User: andrejzienko
 * Date: 29.02.2020
 * Time: 13:50
 */
?>

<body>
<div class="container">
    <main>
        <div class="content">
            <div class="top-row">
                <div class="nopadding" style="margin-left: 30px;">
                    <a href="" class="logo"><img src="{{ asset($app_dec?->tender_body_image ?? '/img/logo.png') }}"/>
                    </a>
                </div>
                <div class="site-title-content" style="margin-right: 0px; margin-left: 5px; width: 60%;">
                    <h2 class="site-title">אגף משאבי אנוש</h2>
                    <h3 class="site-title">טופס הגשת מועמדות למכרזי משאבי אנוש</h3>

                </div>
                <div align="left">{{ date('d-M-y' )}}</div>
                <div class="site-title-content" style="margin-right: 15px; margin-left: 5px; width: 60%;">
                </div>

            </div>

        </div>
        </main>

</div>
</body>
