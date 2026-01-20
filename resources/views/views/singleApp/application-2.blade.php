<?php 
    function get_json($application, $key){
        $metaJson = unserialize($application->apps_meta['metaJson']);
        if(isset($metaJson[$key])){
            return $metaJson[$key];
        }else{
            return '';
        }
    }
    $num_childrens = get_json($application, 'num_children') > 0 ? get_json($application, 'num_children') : 1;
 ?>
<br>
@if($application->st > 2)
    @for($i=1; $i <= $num_childrens; $i++)
        <div class="faind_line <?php if(isset($application->apps_meta['children'.$i])){ echo 'disabled-filds'; } ?>">
            <div class="input-control">
                <label>
                    <span class="caption max-w180">{{get_json($application, 'cn'.$i)}} {{get_json($application, 'cf'.$i)}}</span>
                    <label class="radio">
                        <input type="radio" class="radio_check"  name="educational_framework{{$i}}" value="norm" required=""
                            @if(get_json($application, 'educational_framework'.$i) == 'norm')
                                checked
                            @endif
                            @if(isset($application->apps_meta['children'.$i]))
                                disabled
                            @endif
                        >
                        <span class="virtual"></span>
                        <span class="caption">חינוך רגיל</span>
                    </label>
                    <label class="radio">
                        <input type="radio" class="radio_check"  name="educational_framework{{$i}}" value="spec" required=""
                            @if(get_json($application, 'educational_framework'.$i) == 'spec')
                                checked
                            @endif
                            @if(isset($application->apps_meta['children'.$i]))
                                disabled
                            @endif
                        >
                        <span class="virtual"></span>
                        <span class="caption">חינוך מיוחד</span>
                    </label>
                </label>
            </div>
            <div class="input-control">
                <label>
                    <button class="btn save_row" data-id="children{{$i}}"><span>אשר</span><span>אושר</span></button>
                </label>
            </div>
        </div>
    @endfor    
@endif

@if($application->st < 3 || !\App\Applications::check_rows_status($application->id, $num_childrens))                        
   
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
            <a href="#" class="apps-btn btn float-right ml-3" onclick="send_app({{$application->id}}, 1)">אישור</a>
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