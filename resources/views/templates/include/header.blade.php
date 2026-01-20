<!DOCTYPE html>
<meta charset="UTF-8">

<div class="mt-5">
    <div class="page-header-title pt-4 bg-white text-center font-weight-bold text-center" style="background-image: url('{{ asset('img/templates/temp1-header.jpg') }}');    background-position: center;
background-repeat: repeat;
background-size: cover; height:@isset($isView) 185px @else 125px @endisset ;
justify-content: center; align-items: center;">
        <b class="text-center">
            @if (isset($download))
            <div class="w-100 text-center" style="width: 100%; text-align: center;">
                מכרז כ"א 24.24 למשרת נהגי.ות אוטובוס
            </div>
            @else
            <u><input type="text" class="form-control text-center border-0" style="background:transparent" id="header_title" name="header_title" value='מכרז כ"א 24.24 למשרת נהגי.ות אוטובוס'> </u>
            @endif
            
            
        </b>
        <img  alt="">
    </div>
</div>