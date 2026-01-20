@extends('layouts.admin.header')
@section('content')
    <script language="JavaScript">
        function gofilters(e)
        {
            var sel=document.getElementById("filterstatus");
            var value=sel.value
            console.log(e, sel.value);
            var gourl='';
            switch (value) {
                case 'All': gourl='all';break;
                case 'Active': gourl='active';break;
                case 'Stopped': gourl='stopped';break;
            }
            //console.log(e, value, gourl);

            window.location.href='/admin/tenders/'+gourl;

        }

    </script>
    <main class="content">
        <div class="sky-card-header <?php if (isset($_GET['q'])) echo 'showsearch'; ?>">
            <select onchange="gofilters()" class="c-select apppermissions nvlink" id="filterstatus" name="form_type"  style="max-width: 50%;font-size:12px;background:#eaeaea;height:39px;text-align-last:center;transform:translateY(-3px);width:100px;border-radius: 10px;padding:5px;margin-right:20px;margin-left:20px; border:0">
                <option style="color:#ddd" {{$filter==="all"?'selected':''}}>All</option>
                <option style="color:#ddd" {{$filter==="active"?'selected':''}}>Active</option>
                <option style="color:#ddd" {{$filter==="stopped"?'selected':''}}>Stopped</option>
            </select>
            <a href="#"  class="nvlink" onClick="newtender()" style="border:0"><img src="/img/plus.png"/><span class="admtoptopheader"> מכרז חדש</span>   </a>

        </div>

        {{--<select><option   {{$filter==="all"?'bold':''}}>All</option><option
                    {{$filter==="active"?'bold':''}}
            >Active</option><option   {{$filter==="selected"?'bold':''}}>Selected</option></select>--}}
        {{--<a href="/admin/tenders/all"  class="nvlink {{$filter==="all"?'bold':''}}" >All</a>
        <a href="/admin/tenders/active"  class="nvlink {{$filter==="active"?'bold':''}}" >Active</a>
        <a href="/admin/tenders/stopped"  class="nvlink {{$filter==="stopped"?'bold':''}}" >Stopped</a>--}}


        <div class="apps-card-body">

            <table cellspacing="10" class="apps-list">
                <thead>
                {{-- <th>מס’ פניה</th>
                 <th>שם הטופס</th>
                 <th>תאריך פנייה</th>
                 <th>שם הפונה </th>
                 <th>סטטוס </th>
                 <th>פעולות</th>--}}
                <th>מס' מכרז</th>
                <th>שם מכרז</th>
                <th>סטטוס</th>
                <th>תאריך פקיעת תוקף</th>
                <th>פעולות</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th style="width:30px"></th>

                </thead>
                <tbody>
                @if(!empty($list))
                    @foreach($list as $line)
                        <tr id="line_{{$line->generated_id}}" class="<?php echo $line->status == 0 ? 'new' : ''; ?>">
                            <td><span style="font-weight: 400">{{$line->generated_id}} </span></td>
                            <td>
                                <a target=_blank href="/page1?tenderid={{$line->generated_id}}" style="font-weight: 400">{{$line->tname}}</a>
                            </td>
                            <td><span class="adminlighthdr">{{$line->stopped==1?"לא פעיל":"פעיל"}}</span></td>
                            <td><span style="font-weight: 400">{{ date('Y-m-d', strtotime($line->finish_date)) }}</span></td>
                            <td> <?php if ($line->tname && $line->ccount>0) {?><span><img src="/img/eye.png"> <a href="/admin/tenders/requestsorted/all/{{$line->generated_id}}" style="font-weight: 400">הצגת הפניות</a></span><?php } else {};?></td>
                            <td><a href="#" onClick="editA('<?php echo($line->generated_id);?>')"><img src="/img/pen.png"/><span class="admintendercomment">עריכה</span></a></td>
                            <td>
                                <?php if($line->stopped) { ?>
                                    <a href="#"  onClick="continueA('<?php echo($line->generated_id);?>')"><img src="/img/play.png" /><span class="admintendercomment">הפעל מכרז</span></a>
                                <?php } else   { ?>
                                    <a href="#"  onClick="continueA('<?php echo($line->generated_id);?>')"><img src="/img/stop.png" /><span class="admintendercomment">עצור מכרז</span></a>

                                <?php }?>
                            </td>
                            <td><a href="#" onClick="dubA('<?php echo($line->generated_id);?>')"><img src="/img/dublicate.png" /><span class="admintendercomment">שכפול מכרז</span></a></td>
                            <td>


                                <a href="#" onClick="delA('<?php echo($line->generated_id);?>')">
                                    <img src="/img/del.png"/><span class="admintendercomment">מחיקה</span></a>
</td>

                            <td width="50px">
                                <a href="#" onClick="showMore('<?php echo $line->generated_id ?>')">
                                    <img src="../../img/selg.png"/></a></td>
                        <!--<td>{{ date('Y-m-d', strtotime($line->start_date)) }}</td>-->

                            <td id="zline_{{$line->generated_id}}" style="display:none" colspan="8">

                                <div style="display: flex;flex-direction: column;justify-content:space-between">
                                    <div style="display: flex;flex-direction: row;justify-content:space-between">
                                    <div>{{$line->generated_id}} </div>
                                    <div>
                                        <a target=_blank href="/page1?tenderid={{$line->generated_id}}">{{$line->tname}}</a>


        </div>
                                    <div>{{ date('Y-m-d', strtotime($line->finish_date)) }}</div>
                                    <div><?php if ($line->tname && $line->ccount>0) {?><a href="/admin/tenders/requests/{{$line->generated_id}}">הצגת הפנות</a><?php } else {};?>
                                    </div>
                                    <div><a href="#" onClick="editA('<?php echo($line->generated_id);?>')"><i
                                                    class="icon icon-edit" style="color: #4c9d4c;"></i></a>
                                    </div>
                                    <div><a href="#" onClick="delA('<?php echo($line->generated_id);?>')"><i
                                                    class="icon remove-btn "></i></a></div>
                                    <br/><br  />
                                </div>
                                    <div style="display: flex;flex-direction: row;justify-content:space-between">
                                    <div><div class="captiogreen">תנאי סף</div><?php
                                        $cond= $line->conditions;
                                        if ($cond && strlen($cond)>0) {
                                        	$condArr=explode('!+!+!+!', $cond);
	                                        $rArr=implode('<br />',$condArr);
	                                        echo($rArr);


                                        }
                                       // $line->conditions;
 ?></div>


                                    <div><div class="captiogreen">סה"כ פניות שהתקבלו</div>{{$line->ccount}}</div>
                                    <div><div  class="captiogreen">ממתין להחלטת ועדה</div>{{$line->pendingcount}}</div>
                                    <div><div  class="captiogreen">אושר</div>{{$line->accepted}}</div>
                                    <div><div  class="captiogreen">נדחה</div>{{$line->trejected}}</div>
                                    </div>
                                </div>
                            </td>
                            <td id="azline_{{$line->generated_id}}" style="display:none"> <a href="#" onclick="unMore('{{$line->generated_id}}')">
                                    <img width="15" height="9" style="transform:rotate(180deg)"
                                         src="../../img/selg.png"/></a>
                            </td>


                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                @if(!empty($list))
                    <tr class="sky-paginate">
                        <td colspan="6">

                            <div class="footer-menu sky-rtl">
                                <span>סה”כ מכרזים:  {{$count_all}}</span>|
                                <span> מכרזים פעילים: {{$count_active}}</span>|
                                <span>מכרזים לא פעילים: {{$count_stopped}}</span>
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
