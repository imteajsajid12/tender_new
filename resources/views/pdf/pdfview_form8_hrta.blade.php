<!DOCTYPE html>
<html lang="he">
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('/front/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/front/css/main.css') }}" rel="stylesheet" />
        <link href="{{ asset('/front/css/media.css') }}" rel="stylesheet" />
		<style>
			textarea.detail {
				resize: none;
				width: 100%;
				border: 0;
				box-sizing: border-box;
				background-color: transparent;
				font-size: 18px;
				background-image: linear-gradient(transparent, transparent 39px, #000 0px);
				background-size: 100% 40px;
				background-position: 0 0px;
				height: 120px;
				line-height: 40px;
				outline: none!important;
			}
		</style>
    </head>
  <body style="direction: rtl; background-color: white;">
	<div class="text-center subtop-row">
		<h2 style="font-weight: bold; text-decoration: underline;">אישור מכרז כ"א</h2>        
	</div>
	<div class="faind_line">
		<label class="checkbox">
			<input type="checkbox" name="job_description_attached" value="{{$metaJson['job_description_attached']}}" id="job_description_attached">
			<span class="virtual"></span>
			<span class="caption">צירוף קובץ תיאור התפקיד</span>
		</label>
	</div>
	<div class="faind_line">	
		<span class="caption" style="font-weight: bold;">תיאור התפקיד</span><br>
		<textarea class="detail" name="job_description">{{$metaJson['job_description']}}</textarea>
	</div>
	<div class="faind_line">
		<div class="inline-input-control">
			<div>
				<span class="caption max-w180">אגף קולט:</span>
				<input type="text" name="colt_wing" class="max-250" value="{{$metaJson['colt_wing']}}">
			</div>
		</div>
		<div class="inline-input-control">
			<div>
				<span class="caption max-w180">היקף משרה:</span>
				<input type="text" name="scope_of_position" class="max-250" value="{{$metaJson['scope_of_position']}}">
			</div>
		</div>
		<div class="inline-input-control">
			<div>
				<span class="caption max-w180">מתח דרגות:</span>
				<input type="text" name="stress_ranks" class="max-250" value="{{$metaJson['stress_ranks']}}">
			</div>
		</div>
	</div>
	<div class="faind_line">
		<span class="caption" style="font-weight: bold;">פירוט מתח דרגות:</span><br>
		<textarea class="detail" name="stress_ranks_description">{{$metaJson['stress_ranks_description']}}</textarea>
	</div>
	<div class="faind_line">
		<div class="inline-input-control">
			<div>
				<span class="caption max-w180">שער משוער ברוטו:</span>
				<input type="text" name="gross_estimated_rate" class="max-120" value="{{$metaJson['gross_estimated_rate']}}">
			</div>
		</div>
		<div class="inline-input-control">
			<div>
				<span class="caption max-w180">פרטי המבקש:</span>
				<input type="text" name="pn1" class="max-130" placeholder="שם פרטי" value="{{$metaJson['pn1']}}">
				<input type="text" name="pf1" class="max-130 mmr-77" placeholder="שם משפחה" value="{{$metaJson['pf1']}}">
			</div>
		</div>
	</div>

	<div class="faind_line mi100">
			<div class="caption" style="margin-bottom: 10px;">אבקש לקבל את תשובת המחלקה לדוא”ל הבא:</div>
			<div class="inline-input-control">
				<label>
					<span class="caption">מייל מבקש:</span>
					<input type="email" name="email" class="max-280" placeholder="username@domainname.co.il" value="{{$metaJson['email']}}"/>
				</label>
			</div>        
		</div>

		<div class="faind_line">
			<div class="inline-input-control">
				<label>
					<span class="caption">תקציבן</span>
					<input type="text" id="budget_manager" name="budget_manager" class="max-300" value="<?php if($budget_manager == 'approve') {echo 'מאשר';} else {echo 'לא מאשר';}?>">
				</label>
			</div>
		</div> 
		<div class="faind_line">
			<div class="inline-input-control">
				<label>
					<span class="caption">סעיף תקציבי</span>
					<input type="text" id="budget_item" name="budget_item" class="max-300" value="{{$budget_item}}">
				</label>
			</div>
		</div>
		<div class="faind_line">	
			<span class="caption" style="font-weight: bold;">הערות</span><br>
			<textarea class="detail" id="budget_remarks" name="budget_remarks">{{$budget_remarks}}</textarea>
		</div>
	  	<div class="faind_line">
			<div class="inline-input-control">
				<label>
					<span class="caption">גזבר/סגן גזבר</span>
					<input type="text" id="treasurer" name="treasurer" class="max-300" value="<?php if($budget_manager == 'approve') {echo 'מאשר';} else {echo 'לא מאשר';}?>">
				</label>
			</div>
		</div>
		  <div class="faind_line">
				<div class="inline-input-control">
					<label>
						<span class="caption">משאבי אנוש</span>
						<input type="text" id="treasurer" name="treasurer" class="max-300" value="<?php if($treasurer == 'approve') {echo 'מאשר';} else {echo 'לא מאשר';}?>">
					</label>
				</div>
			</div>
	  	<div class="faind_line" data-show_type="hr_approve" style="">	
			<span class="caption" style="font-weight: bold;">תאריך שבו התקיימה הוועדה</span><br>
			<input id="hr_date" name="hr_date" type="date" value="<?php if(isset($hr_date)) echo $hr_date ?>">
		</div>
	</body>
</html>