@extends('layouts.admin.header')
@section('content')
    <script language="JavaScript">
        jQuery( document ).ready(function($) {
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
                    console.log('!!!!', label)
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

        });
        $.fn.gosearch=function(e){
            var currParams=    $.fn.getUrlParams  ();
            currParams.page = 0;

          //  console.log('cgo', currParams);
            goByParams(currParams);
           // e.preventDefault();
           // alert('___');
            return false;
        }
        $.fn.gofiltersL= function (e)
        {
            var params=    $.fn.getUrlParams  ();
            var tenderid=params.tenderid;
            window.location.href='/admin/tenders/requestsorted/'+params.filter+(tenderid && tenderid.length>0?'/'+tenderid:'');
        }
        function godate() {
            var currParams=    $.fn.getUrlParams  ();
            currParams.page = 0;

            console.log('cgo', currParams);
            goByParams(currParams);
        }

        $.fn.getUrlParams   = function ()
        {
            var sel=document.getElementById("filterstatus");
            var value=sel.value
            //console.log(e, sel.value);
            var gourl='';
            switch (value) {
                case 'All': gourl='all';break;
                case 'New': gourl='new';break;
                case 'Interview': gourl='interview';break;
                case 'Waiting for files': gourl='files';break;
                case 'Accepted': gourl='accepted';break;
                case 'Rejected': gourl='rejected';break;
                case 'Rejected due to conditions': gourl='rejected0';break;
            }
            //console.log(e, value, gourl);
           // var tenderid='{{$tenderid}}';
            var vw=window.location.search;

            var page_sr=vw.substr(vw.indexOf('page_num='));
            var page_num=vw.indexOf('&')?page_sr.substr(vw.indexOf('&')):page_sr;
            var datee = document.getElementById("date_range");
            var dates = false;
            try {

                var dates = JSON.parse(datee.getAttribute('data-val'));
            }
            catch (ex) {
                //console.log(ex);
            }
            var srch = document.getElementById("search-imput");


            console.log('datee', datee, dates);
            return {
                filter:gourl, tenderid:'{{$tenderid}}',page:page_num,
                start: dates.start ? dates.start : false,
                finish: dates.finish ? dates.finish : false,
                search:srch?srch.value:""
            }

           // window.location.href='/admin/tenders/requestsorted/'+gourl+(tenderid && tenderid.length>0?'/'+tenderid:'');
        }




        $.fn.gopageR=function (page)
        {
            var currParams=    $.fn.getUrlParams  ();
            currParams.page=page;
            goByParams(currParams);

        }

        $("#supersearch").submit(function(e){
            console.log('supsearch');
            alert('sup')
            return false;
        });


        function goByParams(params)
        {
          //  let url='/admin/tenders/'+params.filter+'?page_num='+params.page;
            var tenderid=params.tenderid;
            let url ='/admin/tenders/requestsorted/'+params.filter+(tenderid && tenderid.length>0?'/'+tenderid:'')+'?page_num='+params.page+(params.start?'&start_date='+params.start:'')+(params.finish?'&finish_date='+params.finish:'')+(params.search && params.search.length>0?'&search='+params.search:'');
            console.log(url);

            window.location.href=url;

        }

        function goexport()
        {
            var doc=document.getElementById("goexport");
            if (doc && doc.value)
            {
                var params=    $.fn.getUrlParams  ();
                var tenderid=params.tenderid;
                if (doc.value==='goall')  { window.open('/admin/exportTenders/'+tenderid) }
                if (doc.value==='gospecial')  { window.open('/admin/exportSpec/'+tenderid) }
                //console.log(doc, doc.value);


            }

        }

    </script><?php
    $activedate='';
            if (isset($_GET['label'])) {
            $activedate = $_GET['label'];
            }

    if (isset($_GET['start_date']) && !empty($_GET['start_date']) &&  $_GET['finish_date'] && !empty($_GET['finish_date'])) {
	    $daterange = $_GET['start_date']." - ".$_GET['finish_date'];
	 //   echo($daterange);
    } else {
	    $activedate = 'הכל ';
	    $daterange = '';//'01/01/2019-' . date("m/d/Y", time() + 86400);
    }

    ?>
    <main class="content">
        <div class="sky-card-header <?php if(isset($_GET['search'])) echo 'showsearch'; ?>">
            <a href="/admin/tenders" class="paginate apps-link headerright">{{$pageTitle}}</a>
            <div class="btn-group type_form_group filter-app" style="margin-top:0px"><a class="dropdown-toggle btn-select" href="#"
                                                                                         id="date_range" data-label="{{$activedate}}"
                                                                                         data-name="daterange" data-val="{{$daterange}}">בין
                    תאריכים: <span class="caret"><?php echo($daterange);?></span></a></div>
            <a id="search" href="#"  class="paginate"
               style="position:relative;top:0px;margin: auto 10px auto 250px"
            ><img src="/img/s.png"> <span>חיפוש  </span>
                <form class="search"  onsubmit=" $.fn.gosearch(this)">
                    <div class="input-group">
                        <div class="form-group has-feedback has-clear">
                            <input type="text" name="q" class="form-control" id="search-imput" style="width:400px" placeholder="אנא הזינו מילה/מספר פניה לחיפוש" />

                            <span class="form-control-clear form-control-feedback hidden" style="transform:translateX(50px)">X</span>
                        </div>
                    </div>
                </form>
            </a>
            <a class="select_on_tenders_drop" style="position:relative;top:0px;left:100px">


                <select onchange="$.fn.gofiltersL()" class="c-select apppermissions nvlink select_on_tenders select_on_tenders_drop" id="filterstatus" name="form_type"
                        style="max-width: 50%;text-align-last:center;font-size:12px;background:#eaeaea;height:39px;transform:translateY(-3px);width:100px;border-radius: 10px;padding:5px;margin-right:20px;border:0;margin-left:20px">
                    <option style="color:#ddd" {{$filter==="all"?'selected':''}}>All</option>
                    <option style="color:#ddd" {{$filter==="new"?'selected':''}}>New</option>
                    <option style="color:#ddd" {{$filter==="interview"?'selected':''}}>Interview</option>
                    <option style="color:#ddd" {{$filter==="files"?'selected':''}}>Waiting for files</option>
                    <option style="color:#ddd" {{$filter==="accepted"?'selected':''}}>Accepted</option>
                    <option style="color:#ddd" {{$filter==="rejected"?'selected':''}}>Rejected</option>
                    <option style="color:#ddd" {{$filter==="rejected0"?'selected':''}}>Rejected due to conditions</option>
                </select><span class="caret"></span>
            </a>
            <a class="select_on_tenders_drop" style="position:relative;top:0px;left:100px">

            <select class="c-select select_on_tenders_drop" id="goexport"
                    style="font-size:12px;background:#eaeaea;border:0"
                    onchange="goexport()"

            >
                <option>Export</option>
                <option value="goall">All</option>
                <option value="gospecial">Data all</option>
            </select><span class="caret"></span>
            </a>



        </div>
        <div class="apps-card-body">

            <div >
            <table cellspacing="10" class="apps-list" >
                <thead>
                <th style="padding-right:20px">מס’ פניה</th>
                <th>שם הטופס</th>
                <th>תאריך פנייה</th>
                <th>שם הפונה </th>
                <th>סטטוס </th>

                </thead>
                <tbody>
                @if(!empty($list))
                    @foreach($list as $line)
                        <tr class="<?php echo $line->app_status == "New" ? 'new' : ''; ?>"
onClick="javascript:window.location.href='/admin/tenders/application/{{$line->id}}'"
                    style="cursor:pointer"    >
                            <td style="padding-right:10px">2020-{{$line->id}} </td>
                            <td >{{$line->generated_id}} </td>

                            <td>{{date('Y-m-d', strtotime($line->crdate))}} </td>

                            <td>{{$line->applicant_name}} </td>
                            <td>{{$line->app_status}} </td>
                          {{--  <td>{{ date('Y-m-d', strtotime($line->finish_date)) }}</td>--}}
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                @if(!empty($list))
                    <tr class="sky-paginate">
                        <td colspan="2">

                            <div class="footer-menu sky-rtl">
                                סה”כ פניות: {{count($list)}} / {{$count}}
                            </div>
                        </td>
                        <td colspan="4">
                            @for ($i=0;$i<$total_pages;$i++)

                                <a class="pages {{$i==$page_num?'active_page':''}}" href="#" onClick="$.fn.gopageR({{$i}})">{{$i}}</a>

                            @endfor
                        </td>

                    </tr>

                @endif
                </tfoot>
            </table>
            </div>
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
