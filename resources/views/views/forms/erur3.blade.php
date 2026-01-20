@extends('forms.layouts.header')
@section('content')
<div class="text-center subtop-row" style="margin-top: -70px;margin-bottom: 70px;">
    <h2 class="site-subtitle" style="padding-right: 100px;">בקשת ערעור - העברה למסגרת אחרת</h2>
</div>

<div class="faind_line text" style="line-height: 40px">
	ילד/ה 1: {{$metaJson['cn1']}} {{$metaJson['cf1']}} מספר זהות: {{$metaJson['id1']}}  כתובת: {{$metaJson['addres1']}} {{$metaJson['addres11']}} {{$metaJson['addres2']}} <br>
	שם בית הספר אליו התקבל התלמיד: {{$metaJson['current1']}}<br>
	<div class="input-control">
        <div>
            <span class="caption max-w180" style="margin-right: 0;">שם בית הספר אליו מבקש לעבור התלמיד:</span>
            <select name="current11" class="max-160" required>
           		@if(isset($metaJson['current_select_html'])) {!!$metaJson['current_select_html']!!} @endif
            </select>
        </div>
    </div><br>
    שם הורה 1: {{$metaJson['pn1']}} {{$metaJson['pf1']}}  נייד: {{$metaJson['mobile_phone1']}} {{$metaJson['mobile_phone1_select']}}<br>
    שם הורה 2: {{$metaJson['pn2']}} {{$metaJson['pf2']}}  נייד: {{$metaJson['mobile_phone2']}} {{$metaJson['mobile_phone2_select']}}
</div>
<div class="faind_line" >
	<h3 style="margin-bottom: 0">הסיבה להגשת הערעור הינה:</h3>
	<textarea class="detail" name="detail" style="height: 350px" required></textarea>
</div>
<div class="text" style="font-weight: bold;">מסמכים לצירוף</div>
<table class="file-table faind_line hidden-pdf">
    <thead>
        <tr>
            <th class="text-right">שם הקובץ  </th>
            <th class="hidden-xs text-right">העלאת הקובץ</th>
            <th>פעולות </th>
        </tr>
    </thead>
    <tbody>
        @foreach($form_file as $key => $file)
        <tr <?php if(!empty($file['show_type'])) echo 'data-show_type="'.$file['show_type'].'"'; ?>>
            <td class="text-right">
                {{$file['name']}}
                <label for="file-upload-{{$key}}" class="btn btn-default pda success hidden-lg hidden-md hidden-sm">לחץ להעלאת קובץ</label>
                <label class="file-name hidden-lg hidden-md hidden-sm"></label>
            </td>
            <td class="hidden-xs">
                <label for="file-upload-{{$key}}" class="btn btn-default  success">לחץ להעלאת קובץ</label>
                <label class="file-name"></label>
                <input id="file-upload-{{$key}}" type="file" name="file[{{$key}}]" onchange="fileChange(this)" accept="application/pdf, image/jpeg, image/jpg, image/gif, image/png, image/jpe, image/tiff, image/bmp, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword" {{$file['required']}} />
            </td>
            <td>
                <a href="#" class="rm" onclick="removeFile({{$key}});return false;" ><i class="trash-icon"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table><br><br>
<div class="faind_line mi100">
    <div class="input-control">
        <label>
            <span class="caption">אבקש לקבל את תשובת המחלקה לדוא”ל הבא:</span>
            <input type="email" name="email" required  class="max-280" placeholder="username@domainname.co.il" />
        </label>
    </div><br>
    <div class="signature-container" style="text-align: left;float: left;margin-bottom: 50px">
        <span class="caption" style="vertical-align: bottom;">חתימה:</span>
        <div class="signature-content" style="position: relative;">
            <canvas class="signature" width="200" height="40" style="width: calc(100% - 36px);height: 40px;touch-action: none;z-index: 1;position: relative;"></canvas>
            <span class="plesh_sig">
                 נא תחתום כאן עם העכבר 
            </span>
            <img class="signature-eraser" src="{{ asset('/front/img/eraser.png') }}" />
        </div>
        <div class="img"></div>
        <input class="signature-text" type="text" name="moth_sign" tabindex="-1" required style="opacity: 0; width: 0.1px; height: 0.1px; margin: 0!important; display: inline-block;">
    </div>
    <div class="center  hidden-pdf">
        <button class="btn btn-lg btn-default success" id="reportSendBtn"  type="submit">שלח בקשה  </button>
        <br>
        <div class="submit-error-msg"></div>
    </div>
</div>

@endsection