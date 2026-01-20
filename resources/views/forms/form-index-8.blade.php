@extends('forms.layouts.header1')
@section('content')
<input type="hidden" name="from_name" id="from_name" value="tender-approve"/>
<div class="text-center subtop-row">
	<h2 style="font-weight: bold; text-decoration: underline;">אישור מכרז כ"א</h2>        
</div>
<div class="faind_line">
	<label class="checkbox">
		<input type="checkbox" name="job_description_attached" value="1" id="job_description_attached">
		<span class="virtual"></span>
		<span class="caption">צירוף קובץ תיאור התפקיד</span>
	</label>
</div>
<div class="faind_line">	
	<span class="caption" style="font-weight: bold;">תיאור התפקיד</span><br>
	<textarea class="detail" name="job_description"></textarea>
</div>
<div class="faind_line">
	<div class="input-control">
		<div>
			<span class="caption max-w180">אגף קולט:</span>
			<input type="text" name="colt_wing" class="max-250">
		</div>
	</div>
	<div class="input-control">
		<div>
			<span class="caption max-w180">היקף משרה:</span>
			<input type="text" name="scope_of_position" class="max-250">
		</div>
	</div>
	<div class="input-control">
		<div>
			<span class="caption max-w180">מתח דרגות:</span>
			<input type="text" name="stress_ranks" class="max-250">
		</div>
	</div>
</div>
<div class="faind_line">
	<span class="caption" style="font-weight: bold;">פירוט מתח דרגות:</span><br>
	<textarea class="detail" name="stress_ranks_description"></textarea>
</div>
<div class="faind_line">
	<div class="input-control">
		<div>
			<span class="caption max-w180">שער משוער ברוטו:</span>
			<input type="text" name="gross_estimated_rate" class="max-120">
		</div>
	</div>
	<div class="input-control">
		<div>
			<span class="caption max-w180">פרטי המבקש:</span>
			<input type="text" name="pn1" required="" pattern="^[a-zA-Zא-ת\s]+$" class="max-130" placeholder="שם פרטי">
			<input type="text" name="pf1" required="" pattern="^[a-zA-Zא-ת\s]+$" class="max-130 mmr-77" placeholder="שם משפחה">
		</div>
	</div>
</div>
<div class="text" style="font-weight: bold;">מסמכים לצירוף</div>
    @if(!empty($form_file))
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
    </table>
    @endif
<div class="faind_line mi100">
        <div class="caption" style="margin-bottom: 10px;">אבקש לקבל את תשובת המחלקה לדוא”ל הבא:</div>
        <div class="input-control">
            <label>
                <span class="caption">מייל מבקש:</span>
                <input type="email" name="email" required  class="max-280" placeholder="username@domainname.co.il" />
            </label>
        </div><br>
        <div class="signature-container" style="text-align: left;float: left;margin-bottom: 50px;">
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