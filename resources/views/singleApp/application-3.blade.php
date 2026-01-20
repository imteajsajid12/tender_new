<br>  
@if(isset($application->apps_meta['answer_pdf']))
<div class="mt-3 mb-2" style="overflow: hidden;padding-bottom: 10px" id="buttons-content">
    <h3 class="title" style="margin-bottom: 5px;">מסמך תשובה</h3>
    <div class="file-content">
        <a href="{{asset('upload/admin/'.$application->apps_meta['answer_pdf'])}}" download style="margin-bottom: 5px">
            <img class="file-icon" src="{{ asset('img/file.jpg') }}">
        </a>
        <span class="doc-filename">Answer.pdf</span>
    </div>  
</div>
@endif
@if(isset($application->erur_files) && !empty($application->erur_files))
<?php  $p_m = $application->st > 8 ? 'pointer-events: none' : ''; ?>
<div style="overflow: hidden;">
	<div class="sky-rtl doc-name">טופס ערעור</div>
	<div class="align-right" style="overflow: hidden;">
	    @foreach($application->erur_files as  $file)
	        <?php $file_name = explode('^^', $file->file_name); ?>
	        <div class="file-content">
	            <span class="file-title">{{$file_name[1]}}</span>
	            <a href="{{asset('upload/'.$file->url)}}" download style="margin-bottom: 5px"  title="{{$file_name[1]}}">
	                <img class="file-icon" src="{{ asset('img/file.jpg') }}">
	                <?php if($file->status == 1){ $tclass = 'approve'; }elseif($file->status == 2){ $tclass = 'cancel'; }else{  $tclass = '';  }?>
	                <span class="type {{$tclass}}"></span>
	            </a>
	            <span class="doc-filename">{{$file_name[0]}}</span>
	            <?php
	            if($file->status == 3){
	                echo '<span class="doc-filename replace">ממתין לאישור</span>';
	            }
	            if($file->status == 4){
	                echo '<span class="doc-filename replace">נשלחה בקשה למסמך אחר</span>';
	            }
	            ?>
	            @if(\App\User::check_auth_user_AppPermission($application,2))
	                <div><button class="apps-btn"  id="cancel_{{$file->id}}" onclick="cancel_file_tk(this, {{$file->id}} )"  style="{{$p_m}}">דחה  </button> </div>
	                <div><button class="apps-btn" onclick="approve_file_tk(this, {{$file->id}} )"  style="{{$p_m}}"> אשר</button></div>
	            @endif
	        </div>
	    @endforeach
	</div>
</div>
@endif
@if(isset($application->apps_meta['answer_pdf_2']))
<div class="mt-3 mb-2" style="overflow: hidden;padding-bottom: 10px" id="buttons-content">
    <h3 class="title" style="margin-bottom: 5px;">מסמך תשובה</h3>
    <div class="file-content">
        <a href="{{asset('upload/admin/'.$application->apps_meta['answer_pdf_2'])}}" download style="margin-bottom: 5px">
            <img class="file-icon" src="{{ asset('img/file.jpg') }}">
        </a>
        <span class="doc-filename">Answer.pdf</span>
   </div>   
</div>
@endif   
@if($application->st == 3 || ($application->st == 8 && \App\Applications::erur_files_statuses($application->id)))
    <div class="mt-5 mb-5">
        <h3 class="title">הגדרת נמענים להעתקים:</h3> <br>
        <div class="input-control mr-0">
            <input class="typeahead form-control " type="text" placeholder="אנא הזינו את שם הנמען להגדרת העתק" data-path="/admin/users/autocomplete_users" autocomplete="off" id="typeahead" data-provide="typeahead">
            <button class="btn" style="display: inline-block;" id="add-user-inappp">הוסף</button>
        </div><br>
        <div class="typeahead_res">
            <?php echo $application->appusers ?>
        </div>
    </div>
    <div class="mt-3 " style="overflow: hidden;padding-bottom: 10px" id="buttons-content">
        <!--<h3 class="title" style="margin-bottom: 5px;">שליחת תשובה למגיש הבקשה:</h3>-->
        @if(\App\User::check_auth_user_AppPermission($application,3))
            <a href="#" class="apps-btn btn float-right ml-3" onclick="send_app({{$application->id}}, 1)">אישור</a>
            <a href="#" class="apps-btn btn float-right ml-3" onclick="show_text_area(this, {{$application->id}}, {{$application->st}})">דחייה</a>
        @endif
    </div>
@endif
@if($application->st >= 3)                      
<div class="mb-3" style="overflow: hidden;">
    <a href="/admin/apps/{{$application->id}}/file-download" class="btn float-left" onclick="">הורדת כלל המסמכים למחשב</a>
</div>
@endif