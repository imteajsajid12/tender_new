<br>
@if($application->st < 3)                        

@elseif($application->st == 3)
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
    <div class="mt-3 mb-5" style="overflow: hidden;padding-bottom: 10px" id="buttons-content">
        <h3 class="title" style="margin-bottom: 5px;">שליחת תשובה למגיש הבקשה:</h3>
        @if(\App\User::check_auth_user_AppPermission($application,3))
           <?php $placeholder = $application->department == 'school' ? "בית הספר אליו התקבל תלמיד/ה" : "שם הגן אליו התקבל הילד/ה"; ?>
            <a href="#" class="apps-btn btn float-right ml-3" onclick="show_text_area(this, {{$application->id}}, 5)" data-placeholder="{{$placeholder}}">אישור</a>
            <a href="#" class="apps-btn btn float-right ml-3" onclick="show_text_area(this, {{$application->id}}, 1)">דחייה</a>
        @endif
        <a href="/admin/apps/{{$application->id}}/file-download" class="btn float-left" onclick="">הורדת כלל המסמכים למחשב</a>
    </div>
@else
    <div class="mt-3 mb-2" style="overflow: hidden;padding-bottom: 10px" id="buttons-content">
        @if(isset($application->apps_meta['answer_pdf']))
            <h3 class="title" style="margin-bottom: 5px;">מסמך תשובה</h3>
            <div class="file-content">
                <a href="{{asset('upload/admin/'.$application->apps_meta['answer_pdf'])}}" download style="margin-bottom: 5px">
                    <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                </a>
                <span class="doc-filename">Answer.pdf</span>
            </div>
        @endif    
        <a href="/admin/apps/{{$application->id}}/file-download" class="btn float-left" onclick="">הורדת כלל המסמכים למחשב</a>
    </div>
@endif