@extends('layouts.global-app')

@section('content')
    <div class="container_s">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="replacefile-content text-center" dir="rtl">
                    <h1>העלאת מסמך חדש</h1>
                    <h3>מסמך {{$filetitle}} נמצא לא תקין בבדיקתינו אנא העלו מסמך חדש</h3>
                    <div class="file-content" style="float: none; width: 190px; margin: auto; margin-top: 60px ">
                        <a href="{{asset('upload/'.$file->url)}}" download style="margin-bottom: 5px">
                            <img class="file-icon" src="{{ asset('img/file.jpg') }}" style="width: 100%">
                        </a>
                        <span class="doc-filename" style="top: 10px; width: 100%; ">{{$filename_0}}</span>
                        <label for="file-upload" class="file-upload btn btn-default  success" style="max-width: 100%;padding: 3px 25px;width: 100%;font-size: 13px;margin-bottom: 25px;">בחרו מסמך מתוך המחשב</label>
                        <input id="file-upload" type="file" name="file" accept="application/pdf, image/jpeg, image/jpg, image/gif, image/png, image/jpe, image/tiff, image/bmp, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword" required="">
                        <button class="btn btn-default success" onclick="User_fileChange(this, {{$file->id}})"  style="max-width: 100%;width: 100%;">שלח</button>
                    </div>
                </div>
                <div class="sky-container">
                    <div class="apps-cart-footer row">
                        <div class="col-md-6">
                            אוטומס ©  כל הזכויות שמורות
                        </div>
                        <!--<div class="sky-rtl col-md-6">
                            <img src="{{ asset('img/footer-menu-v2.png') }}">
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
