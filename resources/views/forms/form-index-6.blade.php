@extends('forms.layouts.header4')
@section('content')
<?php
$tenderid = 0;
if ($_GET['tenderid'] != '') {
	$tenderid = $_GET['tenderid'];
}
$tname = '';
if ($_GET['tname'] != '') {
	$tname = $_GET['tname'];
}
$list = DB::table ('tenders_applications')->select ()->where ('generated_id', '=', $tenderid)->orderby ('id', 'desc')->get ();
$names = array();
foreach($list as $key => $line){
	if($line->app_status == 'Accepted'){
		array_push($names, $line->applicant_name);
	}
}
?>
				<input type="hidden" name="from_name" id="from_name" value="zichron-devarim"/>
				<div style="text-align: center;">
					<h1 style="font-weight: bold; text-decoration: underline;">זיכרון דברים - ועדת בחינה</h1>
				</div>	
               <div class="text faind_line" style="font-weight: bold; text-decoration: underline;">
					1. פרטי המשרה
				</div>
				<table>
					<tr>
						<td>
							<div style="font-weight: bold">מס' המכרז ותאריכו:</div>
							<div id="tenderid">{{$tenderid}}</div>
						</td>
						<td>
							<div style="font-weight: bold">למשרה של:</div>
							<div>{{$tname}}</div>
						</td>
						<td>
							<div style="font-weight: bold">דירוג משרה:</div>
							<div class="inline-input-control">
								<div>
									<input type="text" name="level1" class="max-130" placeholder="דירוג משרה">
								</div>
							</div>
						</td>
						<td>
							<div style="font-weight: bold">דירוג:</div>
							<div class="inline-input-control">
								<div>
									<input type="text" name="level2" class="max-130" placeholder="דירוג">
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div style="font-weight: bold">מס' המשרה בתקן:</div>
							<div class="inline-input-control">
								<div>
									<input type="text" name="job_id" class="max-130" placeholder="מס' המשרה בתקן">
								</div>
							</div>
						</td>
						<td>
							<div style="font-weight: bold">ביחידה:</div>
							<div class="inline-input-control">
								<div>
									<input type="text" name="unit" class="max-130" placeholder="ביחידה">
								</div>
							</div>
						</td>
						<td>
							<div style="font-weight: bold">מקום העבודה:</div>
							<div class="inline-input-control">
								<div>
									<input type="text" name="job_place" class="max-130" placeholder="מקום העבודה">
								</div>
							</div>
						</td>
						<td></td>
					</tr>
				</table>
				<div class="text faind_line" style="font-weight: bold; text-decoration: underline; margin-top: 50px;">
					2. הרכב הועדה
				</div>
				<button id="committee_add_btn" type="button" class="btn success" style="padding: 3px 3px; margin: 3px 3px;" onclick="dublibe('committee_block','committee_line')">הוסף</button>
		<button id="committee_remove_btn" type="button" class="btn fail" style="padding: 3px 3px; margin: 3px 3px;" onclick="remove('committee_block','committee_line')">הסר</button>
				<table id="committee_block">
					<tr id="committee_line">
						<td>
							<div class="inline-input-control">
								<div>
									<span class="max-w180">שם חבר ועדה:</span>
									<input type="text" class="pn1" name="pn1[]" pattern="^[a-zA-Zא-ת\s]+$" class="max-130" placeholder="שם פרטי">
									<input type="text" class="pf1" name="pf1[]" pattern="^[a-zA-Zא-ת\s]+$" class="max-130 mmr-77" placeholder="שם משפחה">
								</div>
							</div>
						</td>
					</tr>
				</table>
				<div class="text faind_line" style="font-weight: bold; text-decoration: underline; margin-top: 50px;">
					3. המועמדים
				</div>
				<button type="button" class="btn success" style="padding: 3px 3px; margin: 3px 3px;" onclick="dublibe('candidate_block','candidate_line')">הוסף</button>
		<button type="button" class="btn fail" style="padding: 3px 3px; margin: 3px 3px;" onclick="remove('candidate_block','candidate_line')">הסר</button>
				<table id="candidate_block">
					<caption><td>שם מועמד:</td><td>הופיע:</td><td>לא הופיע:</td></caption>
					@foreach ($names as $name)
					<tr id="candidate_line">
						<td>
							<div class="inline-input-control">
								<div>
									<input type="text" name="pn[]" pattern="^[a-zA-Zא-ת\s]+$" class="max-130" placeholder="שם מועמד" value={{$name}}>									
								</div>
							</div>
						</td>
						<td>
							<div>
								<label class="checkbox">
									<input type="checkbox" name="appeared[]" value="הופיע">
									<span class="virtual"></span>
								</label>
							</div>
						</td>
						<td>
							<div>
								<label class="checkbox">
									<input type="checkbox" name="not_appeared[]" value="לא הופיע">
									<span class="virtual"></span>
								</label>
							</div>
						</td>
					</tr>
					@endforeach
				</table>
				<div class="text faind_line" style="font-weight: bold; text-decoration: underline; margin-top: 50px;">
					4. החלטת הועדה
				</div>
				<div class="text faind_line">
					1. הועדה החליטה לבחור למשרה הנ"ל את <span class="inline-input-control"><input type="text" name="chosen" placeholder="המועמד הנבחר"/></span> בדרגה <span class="inline-input-control"><input class="inline-input-control" type="text" name="level" placeholder="דרגה"/></span> שהיא דרגת המשרה בתקן.<br>
					2. כמו כן, מצאה הועדה מתאים למשרה הנ"ל את: <span class="inline-input-control"><input class="inline-input-control" type="text" name="chosen2" placeholder="מועמד שני"/></span> כמועמד שני.
				</div>
				<div class="text faind_line" style="font-weight: bold; text-decoration: underline; margin-top: 50px;">
					5. הערות
				</div>
				<div class="faind_line">
					<textarea class="detail" name="remarks"></textarea>
				</div>
				<div class="text faind_line">
					6. <span style="font-weight: bold; text-decoration: underline;">חתימת חברי ועדת הבוחנים:</span> (לפי הסדר שבראש הטופס)
				</div>
				<button type="button" class="btn success" style="padding: 3px 3px; margin: 3px 3px;" onclick="dublibe('committee_sing_block','committee_sing_line')">הוסף</button>
		<button type="button" class="btn fail" style="padding: 3px 3px; margin: 3px 3px;" onclick="remove('committee_sing_block','committee_sing_line')">הסר</button>
				<table id="committee_sing_block">
					<tr id="committee_sing_line">
						<td class="committee_name"></td>
						<td>
							<div class="signature-container" style="text-align: left;float: left;">
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
						</td>
					</tr>
				</table>
				<div style="text-align: center; padding-top: 10px; padding-bottom: 10px;">
					<button style="width: 100%;" class="btn btn-lg btn-default success" id="reportSaveBtn" type="submit">שמור מסמך</button>
					<br>
					<div class="submit-error-msg"></div>
				</div>
@endsection