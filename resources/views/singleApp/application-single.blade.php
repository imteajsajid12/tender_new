@extends('layouts.admin.header8')
@section('content')
<div class="content single-app">
    <main>
        <input type="hidden" name="appid_input" id="appid_input" value="{{$application->id}}">
        <div class="card-header single-card-header">                        
            <div class="h-right-bar">
                <span>טופס  @if(!empty($application)) {{\App\Applications::app_forms_name($application->form_id)}} @endif </span>
                <a href="/admin/apps" class="paginate apps-link rectangle"> <img src="{{ asset('img/right-back.png') }}"></a>
            </div>
        </div>
        <div class="apps-card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <?php  $p_e = $application->st > 2 ? 'pointer-events: none' : ''; ?>
        <div class="container_child">

        @if(!empty($application))
            <table style="width: 100%" class="align-right">
                <tr>
                    <td>
                        <div class="app-head">מס’ פניה: </div>
                        <div class="app-head-info" >{{ date('Y') }}-{{ $application->id}}</div>
                    </td>
                    <td>
                        <div class="app-head">שם הטופס:</div>
                        <div class="app-head-info" confirm-icon>{{\App\Applications::app_forms_name($application->form_id)}}</div>
                    </td>
                    <td>
                        <div class="app-head">תאריך פנייה:</div>
                        <div class="app-head-info">{{date('d/m/Y', strtotime($application->send_date))}}</div>
                    </td>
                    <td>
                        <div class="app-head">שם הפונה:</div>
                        <div class="app-head-info">{{ $application->sender}}</div>
                    </td>
                    <td>
                        <div class="app-head">סטטוס:</div>
                        <div class="app-head-info">{{\App\Applications::get_status($application->status)}}</div>
                    </td>
                </tr>
            </table>
            <div style="margin-top: 60px;overflow: hidden;">
                <div class="sky-rtl doc-name" style="margin-top: 0"> טופס הבקשה </div>
                <div class="file-content">
                    <a href="{{asset('upload/'.$application->pdf_file->url)}}" download style="margin-bottom: 5px">
                        <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                        <?php if($application->pdf_file->status == 1){ $tclass = 'approve'; }elseif($application->pdf_file->status == 2){ $tclass = 'cancel'; }else{  $tclass = '';  }?>
                        <span class="type {{$tclass}}"></span>
                    </a>
                    <span class="doc-filename">{{$application->pdf_file->file_name}}</span>
                    @if(\App\User::check_auth_user_AppPermission($application,1))
                        <div><button class="apps-btn" id="cancel_{{$application->pdf_file->id}}" onclick="cancel_file_not_tender(this, {{$application->pdf_file->id}})"  style="{{$p_e}}">דחה</button> </div>
                        <div><button class="apps-btn"  onclick="approve_file(this, {{$application->pdf_file->id}} )"   style="{{$p_e}}"> אשר</button></div>
                    @endif    
                </div>
            </div>
            <div style="overflow: hidden;">
                <div class="sky-rtl doc-name">המסמכים המצורפים: </div>
                <div class="align-right" style="overflow: hidden;">
                    @foreach($application->files as  $file)
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
                                <div><button class="apps-btn"  id="cancel_{{$file->id}}" onclick="cancel_file_not_tender(this, {{$file->id}} )"  style="{{$p_e}}">דחה  </button> </div>
                                <div><button class="apps-btn" onclick="approve_file(this, {{$file->id}} )"  style="{{$p_e}}"> אשר</button></div>
                            @endif
                        </div>
                    @endforeach
                    @if($application->st < 3)
                        <div class="file-content">
                            <span class="file-title">מסמך אחר  </span>
                            <a href="#"  style="margin-bottom: 5px"  title="סמך אחר ">
                                <img class="file-icon" src="{{ asset('img/add-file.jpg') }}">
                            </a>
                            @if(\App\User::check_auth_user_AppPermission($application,2))
                            <button class="apps-btn"  id="add-new_newfile" onclick="cancel_file_tk(this, 'newfile' )"  style="width: 130px;margin: 0;margin-left: 0px;{{$p_e}}">בקשה למסמך אחר</button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            @if($application->st < 3)                        
                <div class="mt-5 mb-3" style="overflow: hidden;">
                    <a href="#" class="btn float-right" onclick="send_all_mails({{$application->id}})">שלח בקשה להשלמת מסמכים</a>
                    <a href="/admin/apps/{{$application->id}}/file-download" class="btn float-left" onclick="">הורדת כלל המסמכים למחשב</a>
                </div>
            @endif
            @if(!empty($application->apps_meta['metaJson']))
                @include('singleApp.application-'.$application->form_id)
            @else
                <h3 style="color: red">לא ניתן לבצע פעולה נוספת, ישנם נתונים חסרים</h3>
            @endif    
        @else
            No application
        @endif
        </div>
        </div>
    </main> 
</div>   
@endsection
