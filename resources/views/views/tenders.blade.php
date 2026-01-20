@extends('layouts.admin.header')
@section('content')
    <script language="JavaScript">

        function get_logs( idd ){
            console.log('id',idd);
            unMore2(idd);
            var tid=idd;
            $('body').addClass('show-log');
            $(".app-logs-content").html('<img src="/img/loader.gif" class="loader-img">');
            var form_data = new FormData();
         //   form_data.append('ID', idd);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"/admin/tenderlogs/"+tid,
                data: form_data,
                type: 'GET',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    try {
                        // var dat2=JSON.parse(data);
                        // var key= Object.keys(data)[0];
                        //var data2=data[key];
                        //console.log('dd',data[key]);

                        var htmlA=data && data.map?data.map((e)=>{

                            return '<div>'+e.l_date+':'+e.description+'</div>';
                        }).join():'---';
                        $(".app-logs-content").html(htmlA);

                    }
                    catch(ex) {
                        console.log(ex);

                    }
                    return false;
                }
            });
        }

        function closs_logs(){
            $('body').removeClass('show-log');
        }

        function simulatedClick(id, options) {
            var target = document.getElementById(id);
            if (target) {
                console.log('tt', target);

                var event = target.ownerDocument.createEvent('MouseEvents'),
                    options = options || {},
                    opts = { // These are the default values, set up for un-modified left clicks
                        type: 'mousedown',
                        canBubble: true,
                        isTrusted: true,
                        cancelable: true,
                        view: target.ownerDocument.defaultView,
                        detail: 1,
                        screenX: 0, //The coordinates within the entire page
                        screenY: 0,
                        clientX: 0, //The coordinates within the viewport
                        clientY: 0,
                        ctrlKey: false,
                        altKey: false,
                        shiftKey: false,
                        metaKey: false, //I *think* 'meta' is 'Cmd/Apple' on Mac, and 'Windows key' on Win. Not sure, though!
                        button: 0, //0 = left, 1 = middle, 2 = right
                        relatedTarget: null,
                    };

                //Merge the options with the defaults
                for (var key in options) {
                    if (options.hasOwnProperty(key)) {
                        opts[key] = options[key];
                    }
                }

                //Pass in the options
                event.initMouseEvent(
                    opts.type,
                    opts.canBubble,
                    opts.cancelable,
                    opts.view,
                    opts.detail,
                    opts.screenX,
                    opts.screenY,
                    opts.clientX,
                    opts.clientY,
                    opts.ctrlKey,
                    opts.altKey,
                    opts.shiftKey,
                    opts.metaKey,
                    opts.button,
                    opts.relatedTarget
                );
                console.log('tt', target, event);

                //Fire the event
                target.dispatchEvent(event);
            }
        }


        /*function gofilters2(e)
        {
            var sel=document.getElementById("filterstatus");
            var value=sel.selectedIndex
            console.log(e,sel, sel.value);
            var gourl='';
            switch (value) {
                case 0: gourl='all';break;
                case 1: gourl='active';break;
                case 2: gourl='stopped';break;
            }
            console.log(e, value, gourl);
            window.location.href='/admin/tenders/'+gourl;

        }*/
        jQuery(document).ready(function ($) {
            if ($('#date_range').length) {

                $('#date_range').daterangepicker({
                    "autoApply": true,
                    "opens": 'right',
                    "ranges": {
                        "הכל": [
                            "01/01/2019",
                            moment().add(1, 'days').format('MM/DD/YYYY')
                        ],
                        "היום": [
                            moment().format('MM/DD/YYYY'),
                            moment().add(1, 'days').format('MM/DD/YYYY')
                        ],
                        "אתמול": [
                            moment().subtract(1, 'days').format('MM/DD/YYYY'),
                            moment().format('MM/DD/YYYY')
                        ],
                        "7 הימים האחרונים": [
                            moment().subtract(7, 'days').format('MM/DD/YYYY'),
                            moment().format('MM/DD/YYYY')
                        ],
                        "30 הימים האחרונים": [
                            moment().subtract(30, 'days').format('MM/DD/YYYY'),
                            moment().format('MM/DD/YYYY')
                        ],
                        "החודש": [
                            moment().startOf('month').format('MM/DD/YYYY'),
                            moment().endOf('month').format('MM/DD/YYYY')
                        ],
                        "חודש שעבר": [
                            moment().subtract(1, 'month').startOf('month').format('MM/DD/YYYY'),
                            moment().subtract(1, 'month').endOf('month').format('MM/DD/YYYY')
                        ]
                    },
                    "locale": {
                        "direction": "rtl",
                        "format": "MM/DD/YYYY",
                        "separator": " - ",
                        "applyLabel": "להגיש מועמדות",
                        "cancelLabel": "בטל",
                        "fromLabel": "מ",
                        "toLabel": "ל",
                        "customRangeLabel": "המותאם אישית",
                        "daysOfWeek": ['ראשון', 'שני', 'שלישי', 'רביעי', 'חמישי', 'שישי', 'שבת'],
                        "monthNames": ['ינואר', 'פברואר', 'מרץ', 'אפריל', 'מאי', 'יוני', 'יולי', 'אוגוסט', 'ספטמבר', 'אוקטובר', 'נובמבר', 'דצמבר'],
                        "firstDay": 0
                    },
                    //  "startDate": startd,
                    // "endDate": endd,
                    "linkedCalendars": false,
                    "maxDate": moment().add(1, 'month').format('MM/DD/YYYY'),
                    "opens": "left"
                }, function (start, end, label) {
                    //console.log('!!!!', label)
                    var skylabel;
                    if (label == "המותאם אישית") {
                        skylabel = start.format('DD/MM/YYYY') + '-' + end.format('DD/MM/YYYY');
                    } else {
                        skylabel = label;
                    }
                    if (label === 'הכל')
                        $('#date_range .caret').html(skylabel);
                    $('#date_range').attr('data-label', skylabel);
                    $('#date_range').attr('data-val', label === 'הכל' ? '' : JSON.stringify({
                        start: start.format('YYYY-MM-DD'),
                        finish: end.format('YYYY-MM-DD')
                    }));
                    godate();
                    //  js_redirect_filter(".filter-app");
                });
            }


            function gopage(page) {
                var currParams = $.fn.getUrlParams();
                currParams.page = page;
                goByParams(currParams);

            }

            function godate() {
                var currParams = $.fn.getUrlParams();
                currParams.page = 0;

                console.log('cgo', currParams);
                goByParams(currParams);
            }


            $.fn.gofilters=function (action) {
                var doc = document.getElementById('filterstatus');
                doc.value = action;
                console.log('dcc',action,doc.value);
                // setTimeout(()=> {
                var currParams = $.fn.getUrlParams();
                console.log('gop', currParams);
                currParams.page = 0;
                console.log(doc, currParams);
                $.fn.goByParams(currParams);

                //  },100);
                return false;
            }

            $.fn.getUrlParams = function () {
                var sel = document.getElementById("filterstatus");
                var value = parseInt(sel.value);

                var gourl = '';
                switch (value) {
                    case 0:
                        gourl = 'all';
                        break;
                    case 1:
                        gourl = 'active';
                        break;
                    case 2:
                        gourl = 'stopped';
                        break;
                }
                console.log('sll',sel, value, gourl,'!!');

                var vw = window.location.search;
                var page_sr = vw.substr(vw.indexOf('page_num='));
                var page_num = vw.indexOf('&') ? page_sr.substr(vw.indexOf('&')) : page_sr;
                var datee = document.getElementById("date_range");
                var dates = false;
                try {

                    var dates = JSON.parse(datee.getAttribute('data-val'));
                }
                catch (ex) {
                    //console.log(ex);
                }
                var srch = document.getElementById("search-imput");

                var res= {
                    page: page_num, filter: gourl,
                    start: dates.start ? dates.start : false,
                    finish: dates.finish ? dates.finish : false,
                    search: srch ? srch.value : ""

                };
                console.log('datee', res);

                return res;
            }

            $.fn.goByParams=function(params) {

                let url = '/admin/tenders/' + params.filter + '?page_num=' + params.page + (params.start ? '&start_date=' + params.start : '') + (params.finish ? '&finish_date=' + params.finish : '');
                console.log(url);

                window.location.href = url;

            }


            $.fn.showCloseMore = function (tenderid) {
                console.log('tend', tenderid);
                var y=window.scrollY;
                var x=window.scrollX;


                var btn = document.getElementById('ocbutton_' + tenderid);
                if (btn && btn.style) {
                    if (btn.style.transform === "rotate(180deg)") {
                        unMore2(tenderid);
                        document.getElementById('ocbutton_' + tenderid).style.transform = "rotate(0deg)";


                    } else {
                        showMore(tenderid);
                        document.getElementById('ocbutton_' + tenderid).style.transform = "rotate(180deg)";

                    }
                    setTimeout(()=>{
                        window.scrollTo(x,y)
                    },100);
                    /*  console.log('bb', btn, btn.style.transform);
                      var newn = false;
                      if (!window.opentenderid) {
                          window.opentenderid = tenderid;
                          newn = true;
                      }
                      if (!newn) {
                          if (tenderid === window.opentenderid) {
                              document.getElementById('ocbutton_' + tenderid).style.transform = "rotate(0deg)";

                              unMore2(tenderid);
                              btn.style.transform = '';

                              window.opentenderid = 0;
                          } else {
                              document.getElementById('ocbutton_' + tenderid).style.transform = "rotate(180deg)";

                              showMore(tenderid);
                              // btn.style.transform='rotate(180deg)';
                              // document.getElementById("ocbutton_2020-207").style.transform = "rotate(180deg)";
                              window.opentenderid = tenderid;
                          }
                      } else {
                          document.getElementById('ocbutton_' + tenderid).style.transform = "rotate(180deg)";

                          showMore(tenderid);
                          window.opentenderid = tenderid;
                      }*/
                    var docdoc = document.getElementById('line_' + tenderid);
                    console.log('dodod', 'line_' + tenderid, docdoc);
                    setTimeout(() => {
                        // console.log('scrolling!');
                        docdoc.scrollIntoView();
                    }, 10);
                }

            }

            $.fn.gosearch = function () {
                //  var doc=document.getElementById("search-imput");
                var currParams = $.fn.getUrlParams();
                currParams.page = 0;
                console.log('search!', currParams);

                goByParams(currParams);
                // alert('++');
                return false;
            }
        });

    </script><?php
	if (isset($_GET['label'])) {
		$activedate = $_GET['label'];
	}

	if (isset($_GET['start_date']) && !empty($_GET['start_date']) && $_GET['finish_date'] && !empty($_GET['finish_date'])) {
		$daterange = $_GET['start_date'] . " - " . $_GET['finish_date'];
		//  echo($daterange);
	} else {
		$activedate = 'הכל ';
		$daterange = '';//'01/01/2019-' . date("m/d/Y", time() + 86400);
	}

	?>
    <main class="content">
        <div class="sky-card-header <?php if (isset($_GET['search'])) echo 'showsearch'; ?>"
             style="display:flex;justify-content: space-between">
            <div style="display:flex;align-items: stretch ">
                <a class="headerright" style="cursor:pointer" onclick="" href="/admin/tenders/">מכרזים
                </a>


                <input type="hidden" id="filterstatus" value="{{$filter}}"/>

                <a class="select_on_tenders_drop" style="text-align:center;padding-top:2px;
                {{$daterange===''?'min-width:200px;':'min-width:400px;'}}
                        display:block" href="#"
                   id="date_range" data-label="{{$daterange}}"
                   data-name="daterange" data-val="{{$daterange}}">בין
                    תאריכים: <span class="caret">{{$daterange===''?' הכל':$daterange}}</span></a>
                <div class="aaa dropdown">
                    <button type="button" class="btn dropdown-toggle"
                            style="height:39px;font-size:20px;margin-top:-15px;text-align:left;padding:0;padding-top:10px;background:transparent; color:rgb(94, 123, 137);border:none;"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span> סטטוס</span>
                        <span class="" id='tenderstatus' class="tenderstatus"
                              style="position:relative;cursor:pointer;top:0;color:rgb(94, 123, 137)">:  @if ($filter==="all")
                                הכל
                            @endif
                            @if ($filter==="active") עילים
                            @endif
                            @if ($filter==="stopped")מכרזים לא פעילים
                            @endif</span>
                    </button>
                    <div class="dropdown-menu choosestatus" style="position:absolute">
                        <a class="dropdown-item" onclick='$.fn.gofilters(0)' href="#">הכל</a>
                        <a class="dropdown-item" onclick='$.fn.gofilters(1)' href="#">מכרזים פעילים</a>
                        <a class="dropdown-item" onclick='$.fn.gofilters(2)' href="#">מכרזים לא פעילים</a>
                    </div>
                </div>


            </div>
            <div></div>
            <div>
                <a id="search" href="#" class="paginate"
                   style="position:relative;top:-10px;margin: auto 10px auto 100px;display:inline-block"
                ><img src="/img/s.png"> <span>חיפוש  </span>
                    <form class="search" onsubmit=" $.fn.gosearch()">
                        <div class="input-group">
                            <div class="form-group has-feedback has-clear">
                                <input type="text" name="search" class="form-control" id="search-imput"
                                       style="width:400px;position:absolute;left:0"
                                       placeholder="אנא הזינו מילה/מספר פניה לחיפוש"/>

                                <span class="form-control-clear form-control-feedback hidden"
                                      style="transform:translateX(50px)">X</span>
                            </div>
                        </div>
                    </form>
                </a>
                @if(\App\User::check_auth_user_permission(3))

                    <a href="#" class="nvlink" onClick="newtender()"
                       style="border:0;position:relative;top:-10px;display:inline-block"><img src="/img/plus.png"/><span
                                class="admtoptopheader"> מכרז חדש</span> </a>
                @endif
            </div>


        </div>

        {{--<select><option   {{$filter==="all"?'bold':''}}>All</option><option
                    {{$filter==="active"?'bold':''}}
            >Active</option><option   {{$filter==="selected"?'bold':''}}>Selected</option></select>--}}
        {{--<a href="/admin/tenders/all"  class="nvlink {{$filter==="all"?'bold':''}}" >All</a>
        <a href="/admin/tenders/active"  class="nvlink {{$filter==="active"?'bold':''}}" >Active</a>
        <a href="/admin/tenders/stopped"  class="nvlink {{$filter==="stopped"?'bold':''}}" >Stopped</a>--}}


        <div class="apps-card-body" style="padding-top:0">

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
                <th></th>
                <th style="width:30px"></th>

                </thead>
                <tbody>
                @if(!empty($list))
                    @foreach($list as $line)
                        <tr id="line_{{$line->generated_id}}" class="<?php echo $line->status == 0 ? 'new' : ''; ?>">
                            <td><span style="font-weight: 400">{{$line->generated_id}} </span></td>
                            <td>
                                <a target=_blank href="/page1?tenderid={{$line->generated_id}}"
                                   style="font-weight: 400">{{$line->tname}}</a>
                            </td>
                            <td><span class="adminlighthdr">{{$line->stopped==1?"לא פעיל":"פעיל"}}</span></td>
                            <td><span style="font-weight: 400">{{ date('d/m/Y', strtotime($line->finish_date)) }}</span>
                            </td>
                            <td> <?php if ($line->tname && $line->ccount > 0) {?><span><img src="/img/eye.png"> <a
                                            href="/admin/tenders/requestsorted/all/{{$line->generated_id}}"
                                            style="font-weight: 400">הצגת הפניות</a></span><?php } else {
								};?></td>
                            <td>
                                @if(\App\User::check_auth_user_permission(4))

                                    <a href="#" onClick="editA('<?php echo($line->generated_id);?>')"><img
                                                src="/img/pen.png"/><span class="admintendercomment">עריכה</span></a>
                            </td>
                            @endif
                            <td>

								<?php if($line->stopped) { ?>

                                @if(\App\User::check_auth_user_permission(6))

                                    <a href="#" onClick="continueA('<?php echo($line->generated_id);?>')"><img
                                                src="/img/play.png"/><span
                                                class="admintendercomment">הפעל מכרז</span></a>
                                @endif
								<?php } else   { ?>
                                @if(\App\User::check_auth_user_permission(5))

                                    <a href="#" onClick="stopA('<?php echo($line->generated_id);?>')"><img
                                                src="/img/stop.png"/><span
                                                class="admintendercomment">עצור מכרז</span></a>
                                @endif

								<?php }?>
                            </td>
                            @if(\App\User::check_auth_user_permission(7))

                                <td><a href="#" onClick="dubA('<?php echo($line->generated_id);?>')"><img
                                                src="/img/dublicate.png"/><span
                                                class="admintendercomment">שכפול מכרז</span></a>
                                    @endif
                                </td>
                                <td>

                                    @if(\App\User::check_auth_user_permission(2))
                                        <a href="#" onClick="delA('<?php echo($line->generated_id);?>')">
                                            <img src="/img/del.png"/><span class="admintendercomment">מחיקה</span></a>
                                    @endif
                                </td>
                            <td> <a href="#" onClick="get_logs('<?php echo($line->generated_id);?>')">
                                    <img src="/img/openlogs-btn.png"/><span class="admintendercomment">"יומן</span></a>
                            </td>

                                <td width="50px">
                                    <a href="#" onClick="$.fn.showCloseMore('<?php echo $line->generated_id ?>')">
                                        <img id="ocbutton_<?php echo $line->generated_id ?>" src="../../img/selg.png"/></a>
                                </td>
                        </tr>
                        <tr id="zzline_{{$line->generated_id}}" style="display:none">
                            <td colspan="10">
                                <div class="tender_table_details">
                                    <div>
                                        <div class="captiogreen">תנאי סף</div><?php
										$cond = $line->conditions;
										if ($cond && strlen($cond) > 0) {
											$condArr = explode('!+!+!+!', $cond);
											$rArr = implode('&nbsp;', $condArr);
											echo($rArr);

										}
										// $line->conditions;
										?></div>


                                    <div>
                                        <div class="captiogreen">סה"כ פניות שהתקבלו
                                        </div>{{$line->ccount?$line->ccount:0}}</div>
                                    <div>
                                        <div class="captiogreen">ממתין להחלטת ועדה
                                        </div>{{$line->pendingcount?$line->pendingcount:0}}</div>
                                    <div>
                                        <div class="captiogreen">אושר</div>{{$line->accepted?$line->accepted:0}}</div>
                                    <div>
                                        <div class="captiogreen">נדחה</div>{{$line->trejected?$line->trejected:0}}</div>
                                    <a href="#" style='display:none'
                                       onclick="unMore2('{{$line->generated_id?$line->generated_id:0}}')">
                                        <img width="15" height="9" style="transform:rotate(180deg)"
                                             src="../../img/selg.png"/></a>


                                </div>
                            </td>
                        </tr>





                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                @if(!empty($list))
                    <tr class="sky-paginate">
                        <td colspan="6">

                            <div class="footer-menu sky-rtl">
                                <span>סה”כ מכרזים: {{$count_all}}</span>|
                                <span> מכרזים פעילים: {{$count_active}}</span>|
                                <span>מכרזים לא פעילים: {{$count_stopped}}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12" style="text-align: center">

                            @for ($i=0;$i<$total_pages;$i++)

                                <a class="pages {{$i==$page_num?'active_page':''}}" href="#"
                                   onClick="gopage({{$i}})">{{$i}}</a>

                            @endfor
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
