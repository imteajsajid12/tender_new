@extends('layouts.admin.header')
@section('content')
    <main class="content">
        <div class="sky-card-header <?php if(isset($_GET['q'])) echo 'showsearch'; ?>">
            <a href="/admin/apps" class="paginate apps-link" style="font-weight: bold;">{{$pageTitle}}</a>
            <?php echo $submenu ?>
        </div>
        <div class="apps-card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <table cellspacing="10" class="apps-list">
                <thead>
                <th>מס’ פניה</th>
                <th>שם הטופס</th>
                <th>תאריך פנייה</th>
                <th>שם הפונה </th>
                <th>סטטוס </th>
                <th>פעולות</th>
                </thead>
                <tbody>
                @if(!empty($applications))
                    @foreach($applications as $app)
                    <tr class="<?php echo $app->status == 0 ? 'new' : ''; ?>">
                        <td>{{ date('Y', strtotime($app->send_date)) }}-{{ $app->id}}</td>
                        <td><a href="/admin/apps/{{$app->id}}">{{\App\Applications::app_forms_name($app->form_id)}}</a></td>
                        <td>{{date('d/m/Y', strtotime($app->send_date))}}</td>
                        <td>{{$app->sender}} </td>
                        <td>{{\App\Applications::get_status($app->status)}}</td>
                        <td>
                            @if(\App\User::check_auth_user_permission(2))
                            <a href="#" onclick="remove_app( this, {{$app->id}} )" class="remove-btn">מחיקה</a>
                            @endif
                            <a href="#" onclick="open_logs( this, {{$app->id}} )" class="openlogs-btn">יומן</a>
                        </td>
                    </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                @if(!empty($applications))
                    <tr class="sky-paginate">
                        <td colspan="6">
                            <div class="sky-paginate">
                                {{$applications->appends(request()->input())->links()}}
                            </div>
                            <div class="footer-menu sky-rtl">
                                סה”כ פניות: {{$applications->count}}
                            </div>
                        </td>

                    </tr>

                @endif
                </tfoot>
            </table>
        </div>
        <div class="app-logs">
        	<div class="app-logs-header">
        		יומן פעולות
        		<a href="#" class="close-lg" onclick="closs_logs()"><img src="{{ asset('img/close-lg.png') }}"></a>
        	</div>
        	<div class="app-logs-content">
        		<img src="{{ asset('img/loader.gif') }}" class="loader-img">
        	</div>
        </div>
    </main>
@endsection