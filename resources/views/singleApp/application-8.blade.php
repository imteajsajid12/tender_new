<?php 
    function get_json($application, $key){
        $metaJson = unserialize($application->apps_meta['metaJson']);
        if(isset($metaJson[$key])){
            return $metaJson[$key];
        }else{
			if(isset($application->apps_meta[$key])){
				$metaJson = $application->apps_meta[$key];
				return $metaJson;
			}else{
            	return '';
			}
        }
    }
 ?>
@if($application->st > 2)
<div class="sky-rtl doc-name">תקציבן</div>
<div class="faind_line">
	<div class="input-control">
		<label>
			<label class="radio">
				<input type="radio" class="radio_check"  name="budget_manager" value="not_approve"
					   @if(get_json($application, 'budget_manager') == 'not_approve')
					   		checked
					   @endif
					   @if(isset($application->apps_meta['budget_manager']))
							disabled
						@endif
					   >
				<span class="virtual"></span>
				<span class="caption">לא מאשר</span>
			</label>
			<label class="radio">
				<input type="radio" class="radio_check" id="budget_manager_approve" name="budget_manager" value="approve"
					   @if(get_json($application, 'budget_manager') == 'approve')
					   		checked
					   @endif
					   @if(isset($application->apps_meta['budget_manager']))
							disabled
						@endif
					   >
				<span class="virtual"></span>
				<span class="caption">מאשר</span>
			</label>
		</label>
	</div>
</div>
<div class="faind_line" data-show_type="budget_manager_approve" style="">
	<div class="input-control">
		<label>
			<span class="caption">סעיף תקציבי</span>
			<input type="text" id="budget_item" name="budget_item" class="max-300" value="{{$application->apps_meta['budget_item']}}">
		</label>
	</div>
</div>
<div class="faind_line" data-show_type="budget_manager_approve" style="">	
	<span class="caption" style="font-weight: bold;">הערות</span><br>
	<textarea class="detail" id="budget_remarks" name="budget_remarks">{{$application->apps_meta['budget_remarks']}}</textarea>
</div>
<div class="mt-3 mb-5" style="overflow: hidden;padding-bottom: 10px" id="buttons-content">
	@if(\App\User::check_auth_user_AppPermission($application,3) && $application->st < 4)
	<a href="#" class="apps-btn btn float-right ml-3" onclick="update_file({{$application->pdf_file->id}})">עדכן מסמך</a>
	@endif
	@if($application->st < 4)
	<a href="/admin/apps/{{$application->id}}/file-download" class="btn float-left" onclick="">הורדת כלל המסמכים למחשב</a>
	@endif
</div>
@endif
@if($application->st == 4 && isset($application->apps_meta['update_pdf']))
<div class="mt-3 mb-2" style="overflow: hidden;padding-bottom: 10px" id="buttons-content">	
	<h3 class="title" style="margin-bottom: 5px;">מסמך תשובה</h3>
	<div class="file-content">
		<a href="{{asset('upload/admin/'.$application->apps_meta['update_pdf'])}}" download style="margin-bottom: 5px">
			<img class="file-icon" src="{{ asset('img/file.jpg') }}">
		</a>
		<span class="doc-filename">Answer.pdf</span>
	</div>	    
</div>
@endif
@if($application->st > 3)
<div class="sky-rtl doc-name">גזבר/סגן גזבר</div>
<div class="faind_line">
	<div class="input-control">
		<label>
			<label class="radio">
				<input type="radio" class="radio_check"  name="treasurer" value="not_approve" required="required"
					   @if(get_json($application, 'treasurer') == 'not_approve')
					   		checked
					   @endif
					   @if(isset($application->apps_meta['treasurer']))
							disabled
						@endif
					   >
				<span class="virtual"></span>
				<span class="caption">לא מאשר</span>
			</label>
			<label class="radio">
				<input type="radio" class="radio_check" id="treasurer" name="treasurer" value="approve" required="required"
					   @if(get_json($application, 'treasurer') == 'approve')
					   		checked
					   @endif
					   @if(isset($application->apps_meta['treasurer']))
							disabled
						@endif
					   >
				<span class="virtual"></span>
				<span class="caption">מאשר</span>
			</label>
		</label>
	</div>
	<div class="mt-3 mb-5" style="overflow: hidden;padding-bottom: 10px" id="buttons-content">
	@if(\App\User::check_auth_user_AppPermission($application,3) && $application->st < 5)
	<a href="#" class="apps-btn btn float-right ml-3" onclick="update_file({{$application->pdf_file->id}})">עדכן מסמך</a>
	@endif
	@if($application->st < 5)
	<a href="/admin/apps/{{$application->id}}/file-download" class="btn float-left" onclick="">הורדת כלל המסמכים למחשב</a>
	@endif
	</div>
</div>
@endif
@if($application->st == 5 && isset($application->apps_meta['update_pdf']))
<div class="mt-3 mb-2" style="overflow: hidden;padding-bottom: 10px" id="buttons-content">	
	<h3 class="title" style="margin-bottom: 5px;">מסמך תשובה</h3>
	<div class="file-content">
		<a href="{{asset('upload/admin/'.$application->apps_meta['update_pdf'])}}" download style="margin-bottom: 5px">
			<img class="file-icon" src="{{ asset('img/file.jpg') }}">
		</a>
		<span class="doc-filename">Answer.pdf</span>
	</div>	    
</div>
@endif
@if($application->st > 4)
<div class="sky-rtl doc-name">משאבי אנוש</div>
<div class="faind_line">
	<div class="input-control">
		<label>
			<label class="radio">
				<input type="radio" class="radio_check"  name="hr" value="not_approve" required="required"
					   @if(get_json($application, 'hr') == 'not_approve')
					   		checked
					   @endif
					   @if(isset($application->apps_meta['hr']))
							disabled
						@endif
					   >
				<span class="virtual"></span>
				<span class="caption">לא מאשר</span>
			</label>
			<label class="radio">
				<input type="radio" class="radio_check" id="hr_approve" name="hr" value="approve" required="required"
					   @if(get_json($application, 'hr') == 'approve')
					   		checked
					   @endif
					   @if(isset($application->apps_meta['hr']))
							disabled
						@endif
					   >
				<span class="virtual"></span>
				<span class="caption">מאשר</span>
			</label>
		</label>
	</div>
	<div class="faind_line" data-show_type="hr_approve" style="">	
		<span class="caption" style="font-weight: bold;">תאריך שבו התקיימה הוועדה</span><br>
		<input id="hr_date" name="hr_date" type="date" value="<?php if(isset($application->apps_meta['hr_date'])) echo $application->apps_meta['hr_date'] ?>">
	</div>
	<div class="mt-3 mb-5" style="overflow: hidden;padding-bottom: 10px" id="buttons-content">
	@if(\App\User::check_auth_user_AppPermission($application,3) && $application->st < 6)
	<a href="#" class="apps-btn btn float-right ml-3" onclick="update_file({{$application->pdf_file->id}})">עדכן מסמך</a>
	@endif
	@if($application->st < 6)
	<a href="/admin/apps/{{$application->id}}/file-download" class="btn float-left" onclick="">הורדת כלל המסמכים למחשב</a>
	@endif
	</div>
</div>
@endif
@if($application->st == 6 && isset($application->apps_meta['update_pdf']))
<div class="mt-3 mb-2" style="overflow: hidden;padding-bottom: 10px" id="buttons-content">	
	<h3 class="title" style="margin-bottom: 5px;">מסמך תשובה</h3>
	<div class="file-content">
		<a href="{{asset('upload/admin/'.$application->apps_meta['update_pdf'])}}" download style="margin-bottom: 5px">
			<img class="file-icon" src="{{ asset('img/file.jpg') }}">
		</a>
		<span class="doc-filename">Answer.pdf</span>
	</div>
	<a href="/admin/apps/{{$application->id}}/file-download" class="btn float-left" onclick="">הורדת כלל המסמכים למחשב</a>
</div>
@endif