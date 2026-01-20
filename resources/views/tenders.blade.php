@extends('layouts.admin.header')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/themes/base/jquery-ui.min.css">
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}

    <style>
        .ui-front {
            z-index: 1001 !important;
        }

        .modal-backdrop {
            /* z-index: 100 !important; */
        }

        .dm-wrap.first .deMakerRemoveBtn {
            display: none !important;
        }
    </style>
    <script language="JavaScript">
        async function duplicateTender(tenderId, type) {
            $('.load_container').show();

            editA(tenderId, type, true)

            $('.load_container').hide();


        }

        $(document).on('click', '.editDMBtn', function(event) {
            var dmInfo = $('.dmInfo_box_' + $(this).data('id')).val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('decisionMakerUpdate', '___') }}".replaceAll('___', $(this).data('id')),
                data: {
                    data: dmInfo
                },
                type: 'POST',
                // contentType: false,
                // cache: false,
                // processData: false,
                success: function(data) {
                    try {
                        // var dat2=JSON.parse(data);
                        // var key= Object.keys(data)[0];
                        //var data2=data[key];
                        //console.log('dd',data[key]);

                        window.location.reload()
                        console.log(data);

                    } catch (ex) {
                        console.log(ex);

                    }
                    return false;
                }
            });

        })

        $(document).on('click', '.deleteDMBtn', function(event) {
            if (confirm('Are you sure?')) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('decisionMakerDelete', '___') }}".replaceAll('___', $(this).data('id')),
                    type: 'POST',
                    // contentType: false,
                    // cache: false,
                    // processData: false,
                    success: function(data) {
                        try {
                            // var dat2=JSON.parse(data);
                            // var key= Object.keys(data)[0];
                            //var data2=data[key];
                            //console.log('dd',data[key]);

                            window.location.reload()
                            console.log(data);

                        } catch (ex) {
                            console.log(ex);

                        }
                        return false;
                    }
                });
            }


        })

        $(document).on('click', '.deMakerAddBtn', function(event) {
            $('.extra-dm-wrap').append($('.dm-wrap.first').clone().removeClass('first').val(''))
        })
        $(document).on('click', '.deMakerRemoveBtn', function(event) {
            $(this).parents('.dm-wrap').remove()
        })

        $(document).on('click', '.stopTender', function(event) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('stopTender', '___') }}".replaceAll('___', $(this).data('id')),
                data: new FormData($(this).parents('form')[0]),
                type: 'POST',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    try {
                        // var dat2=JSON.parse(data);
                        // var key= Object.keys(data)[0];
                        //var data2=data[key];
                        //console.log('dd',data[key]);

                        window.location.reload()
                        console.log(data);

                    } catch (ex) {
                        console.log(ex);

                    }
                    return false;
                }
            });
        });

        $(document).on('change', '.tenderFileUpload', function(event) {

            $('label[for="tenderFileUpload' + $(this).data('id') + '"]').find('.choose-file-text').text(
                'uploading...')
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('tenderFileupload', '___') }}".replaceAll('___', $(this).data('id')),
                data: new FormData($(this).parents('form')[0]),
                type: 'POST',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    try {
                        // var dat2=JSON.parse(data);
                        // var key= Object.keys(data)[0];
                        //var data2=data[key];
                        //console.log('dd',data[key]);

                        window.location.reload()
                        console.log(data);

                    } catch (ex) {
                        console.log(ex);

                    }
                    return false;
                }
            });
        });
        $(document).on('click', '.DecisionMakerModalOpenBtn', function(event) {
            $('#DecisionMakerModal').find('.DecisionMakerSaveBtn').data('id', $(this).data('id'))
            $('#DecisionMakerModal').modal('show')

            $.get('{{ route('decisionMakerEdit', '___') }}'.replace("___", $(this).data('id')), function(data) {
                /*optional stuff to do after success */
                $('.dmEditWrap').html(data)
            });
        })
        $(document).on('click', '.DecisionMakerSaveBtn', function(event) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('decisionMakerAdd', '___') }}".replaceAll('___', $(this).data('id')),
                data: new FormData($('#tender_decision_makerForm')[0]),
                type: 'POST',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    try {
                        // var dat2=JSON.parse(data);
                        // var key= Object.keys(data)[0];
                        //var data2=data[key];
                        //console.log('dd',data[key]);

                        window.location.reload()
                        // console.log(data);

                    } catch (ex) {
                        console.log(ex);

                    }
                    return false;
                }
            });
        });

        $(document).on('click', '.addNoteBtn', function(event) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('addTenderLog', '___') }}".replaceAll('___', $(this).data('id')),
                data: {
                    log: $('#noteInput').val()
                },
                type: 'POST',
                // contentType: false,
                // cache: false,
                // processData: false,
                success: function(data) {
                    try {
                        // var dat2=JSON.parse(data);
                        // var key= Object.keys(data)[0];
                        //var data2=data[key];
                        //console.log('dd',data[key]);

                        window.location.reload()
                        console.log(data);

                    } catch (ex) {
                        console.log(ex);

                    }
                    return false;
                }
            });
        });


        function get_logs(idd) {
            console.log('id', idd);
            unMore2(idd);
            var tid = idd;
            $('body').addClass('show-log');
            $(".app-logs-content").html('<img src="/img/loader.gif" class="loader-img">');
            var form_data = new FormData();
            //   form_data.append('ID', idd);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/tenderlogs/" + tid,
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

                        var htmlA = data && data.map ? data.map((e) => {

                            return '<p><span>' + e.l_date + '</span><span>' + e.description +
                                '</span></p>';
                        }) : '---';

                        var noteBox = `<div class="form-group">
    <label for="" class="w-100 font-weight-bold">Note</label>
    <textarea class="form-control" name="" id="noteInput" cols="30" rows="10"></textarea>
    <button data-id="${idd}" class="btn btn-success addNoteBtn">Add Note</button>
</div>`;
                        $(".app-logs-content").html(htmlA + noteBox);

                    } catch (ex) {
                        console.log(ex);

                    }
                    return false;
                }
            });
        }
        @php
            $options = '';
            foreach ($users ?? [] as $user) {
                $options .= '<option value="' . $user->id . '">#' . $user->id . ' ' . $user->name . '</option>';
            }

            $jobDetailsList = config('static_array.jobDetails');
            $jobDetails__option = '';
            foreach ($jobDetailsList as $key => $jobDetail) {
                $jobDetails__option .= '<option value="' . $key . '">' . $jobDetail . '</option>';
            }

            $functional__level = '';
            $functional__level_array = config('static_array.functional_label');
            foreach ($functional__level_array as $key => $value) {
                $functional__level .= '<option value="' . $value . '">רמה ' . $value . '</option>';
            }

        @endphp

        var options__list = `<div class="mx-3">
            <label for="userSelect" class="caption captiogreen">Select User</label>
            <select class="form-control" name="users[]" multiple id="userSelect">
                {!! $options !!}
            </select>
        </div>`

        var functional__level__list = ``

        var is_protocol_required_block = `<div class="col-4 custom-control custom-checkbox">
            <input type="checkbox" name="is_protocol_required" id="is_protocol_required_checkbox" checked style="display: none;" >
        </div>`

        var is_test_required_block = `<div class="col-4 custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" name="is_test_required" id="is_test_required_checkbox" />
            <label for="is_test_required_checkbox" class="custom-control-label caption captiogreen">מבחן חובה</label>
        </div>`

        var is_recommended_block = `<div class="col-4 custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" name="is_recommended" id="is_recommended_checkbox" />
            <label for="is_recommended_checkbox" class="custom-control-label caption captiogreen">ממליצים חובה</label>
        </div>`

        var jobDetails__option = ` <div class="row">
                <div class="col-auto">
                    <div class="form-group mr-2">
                        <label for="" class="caption captiogreen">מנהל 	 </label>
                        <input name="input_manager" id="input_manager" class="form-control">
                    </div>
                </div>

                <div class="col-auto">
                    <div class="form-group mr-2">
                        <label for="" class="caption captiogreen">היקף 	</label>
                        <input name="job_scope" id="job_scope" class="form-control">
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-group mr-2">
                        <label for="" class="caption captiogreen">כפיפות 	 </label>
                        <input name="subordinations" id="subordinations" class="form-control">
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-group mr-2">
                        <label for="" class="caption captiogreen">דרגת המשרה ודירוגה</label>
                        <input name="grades_voltage" id="grades_voltage" class="form-control">
                    </div>
                </div>
        </div>`

        function closs_logs() {
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
        jQuery(document).ready(function($) {
            $(".jssearch").select2({
                tags: true
            });

            $('.jssearch').on('select2:select', function(e) {
                var doc = e.params.data;
                console.log('ee', e, doc.id);

                if (doc && doc.id && doc.id === 'All') {
                    window.location.href = '/admin/tenders/list';
                }
                if (doc && doc.id && doc.id.length >= 8) {
                    window.location.href = '/admin/tenders/' + doc.id;
                }
            });

            if ($('#date_range').length) {

                $('#date_range').daterangepicker({
                    "autoApply": true,
                    "opens": 'right',
                    startDate: moment().startOf('hour'),
                    endDate: moment().startOf('hour').add(32, 'hour'),

                    "ranges": {
                        "הכל": [
                            "01/01/2019",
                            moment().add(1, 'days').format('MM/DD/YYYY')
                        ],
                        "היום": [
                            moment().format('MM/DD/YYYY'),
                            moment().format('MM/DD/YYYY')
                        ],
                        "אתמול": [
                            moment().subtract(1, 'days').format('MM/DD/YYYY'),
                            moment().subtract(1, 'days').format('MM/DD/YYYY')
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
                        "monthNames": ['ינואר', 'פברואר', 'מרץ', 'אפריל', 'מאי', 'יוני', 'יולי', 'אוגוסט',
                            'ספטמבר', 'אוקטובר', 'נובמבר', 'דצמבר'
                        ],
                        "firstDay": 0
                    },
                    //  "startDate": startd,
                    // "endDate": endd,
                    "linkedCalendars": false,
                    "maxDate": moment().add(1, 'month').format('MM/DD/YYYY'),
                    "opens": "left"
                }, function(start, end, label) {
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


            function gopage(page) {
                var currParams = $.fn.getUrlParams();
                currParams.page = page;
                goByParams(currParams);

            }

            function godate() {
                var currParams = $.fn.getUrlParams();
                currParams.page = 0;

                // let url = '/admin/tenders/' + params.filter + '?page_num=' + params.page + (params.start ?
                //     '&start_date=' + params.start : '') + (params.finish ? '&finish_date=' + params.finish :
                //     '') + '&tender_type=' + params.tender_type;

                    // params.start
                    // params.finish
                if(currParams.start && currParams.finish){

                }

                console.log('cgo', currParams);

                goByParams(currParams);
            }

            $.fn.gofiltersByName = function(action,name='tender_type') {
                var doc = document.getElementById('filterstatus');
                doc.value = action;
                console.log('dcc', action, doc.value);
                var currParams = $.fn.getUrlParamsName(name);
                console.log('gop', currParams);
                currParams.page = 0;
                console.log(doc, currParams);
                $.fn.goByParams(currParams);
                return false;
            }

            $.fn.getUrlParamsName = function(type) {
                return $.fn.getUrlParams(type);
            }

            $.fn.gofilters = function(action) {
                var doc = document.getElementById('filterstatus');
                doc.value = action;
                console.log('dcc', action, doc.value);
                // setTimeout(()=> {
                var currParams = $.fn.getUrlParams();
                console.log('gop', currParams);
                currParams.page = 0;
                console.log(doc, currParams);
                $.fn.goByParams(currParams);

                //  },100);
                return false;
            }

            $.fn.getUrlParams = function(type) {
                var sel = document.getElementById("filterstatus");
                var value = parseInt(sel.value);
                var gourl = '';
                if (type) {
                    gourl = type;
                    var tender_type = value;
                } else {
                    switch (value) {
                        case 0:
                            gourl = 'all';
                            break;
                        case 1:
                            gourl = 'active';
                            break;
                        case 2:
                            gourl = 'inactive';
                            break;
                        case 3:
                            gourl = 'stopped';
                            break;
                    }
                }
                console.log('sll', sel, value, gourl, '!!');

                var vw = window.location.search;
                var page_sr = vw.substr(vw.indexOf('page_num='));
                var page_num = vw.indexOf('&') ? page_sr.substr(vw.indexOf('&')) : page_sr;
                var datee = document.getElementById("date_range");
                var dates = false;
                try {

                    var dates = JSON.parse(datee.getAttribute('data-val'));
                } catch (ex) {
                    console.log(ex);
                }
                var srch = document.getElementById("search-imput");

                var res = {
                    page: page_num,
                    filter: gourl,
                    start: dates.start ? dates.start : false,
                    finish: dates.finish ? dates.finish : false,
                    search: srch ? srch.value : "",
                    tender_type: tender_type ? tender_type : 0
                };
                console.log('datee', res);

                return res;
            }




            $.fn.showCloseMore = function(tenderid) {
                console.log('tend', tenderid);
                var y = window.scrollY;
                var x = window.scrollX;


                var btn = document.getElementById('ocbutton_' + tenderid);
                if (btn && btn.style) {
                    if (btn.style.transform === "rotate(180deg)") {
                        unMore2(tenderid);
                        document.getElementById('ocbutton_' + tenderid).style.transform = "rotate(0deg)";


                    } else {
                        showMore(tenderid);
                        document.getElementById('ocbutton_' + tenderid).style.transform = "rotate(180deg)";

                    }
                    setTimeout(() => {
                        window.scrollTo(x, y)
                    }, 100);
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

            $.fn.gosearch = function() {
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
        $daterange = $_GET['start_date'] . ' - ' . $_GET['finish_date'];
        //  echo($daterange);
    } else {
        $activedate = 'הכל ';
        $daterange = ''; //'01/01/2019-' . date("m/d/Y", time() + 86400);
    }

    ?>
    <script src="{{ asset('js/jquery.table2excel.min.js') }}"></script>

    <main class="content">
        <div class="sky-card-header <?php if (isset($_GET['search'])) {
            echo 'showsearch';
        } ?>" style="display:flex;justify-content: space-between">
            <div style="display:flex;align-items: stretch ">
                <a href="{{ route('tenderListExcelDownload',request()->query()) }}"

                    style="color:rgb(94, 123, 137)">הורדת אקסל</a>

                <a class="headerright" style="cursor:pointer" onclick="" href="/admin/tenders/">מכרזים
                </a>


                <input type="hidden" id="filterstatus" value="{{ $filter }}" />

                <a class="select_on_tenders_drop"
                    style="text-align:center;padding-top:2px;
                {{ $daterange === '' ? 'min-width:200px;' : 'min-width:400px;' }}
                        display:block"
                    href="#" id="date_range" data-label="{{ $daterange }}" data-name="daterange"
                    data-val="{{ $daterange }}">בין
                    תאריכים: <span class="caret">{{ $daterange === '' ? ' הכל' : $daterange }}</span></a>
                <div>
                    <select class="form-control jssearch">
                        <option>הכל</option>
                        @foreach ($tenders as $tenderline)
                            <option {{ $tenderid === $tenderline->generated_id ? 'selected' : '' }}
                                value="{{ $tenderline->generated_id }}">{{ $tenderline->tname }}
                                @php
                                    $app_id = explode('-', $tenderline->generated_id);
                                    if (!empty($app_id) && isset($app_id[1])) {
                                        $meta_value = DB::table('apps_meta')
                                            ->where([
                                                ['app_id', '=', $app_id[1]],
                                                ['meta_name', '=', 'tender_num_display'],
                                            ])
                                            ->first();
                                        $display_generate_id = $meta_value?->meta_value;
                                        $dis = !empty($display_generate_id)
                                            ? $display_generate_id
                                            : $tenderline->generated_id;
                                        echo '(' . $dis . ')';
                                    }
                                @endphp
                            </option>
                        @endforeach
                    </select>

                </div>
                <div class="aaa dropdown">
                    <button type="button" class="btn dropdown-toggle"
                        style="height:39px;font-size:20px;margin-top:-15px;text-align:left;padding:0;padding-top:10px;background:transparent; color:rgb(94, 123, 137);border:none;"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span> סטטוס</span>
                        <span class="" id='tenderstatus' class="tenderstatus"
                            style="position:relative;cursor:pointer;top:0;color:rgb(94, 123, 137)">: @if ($filter === 'all')
                                הכל
                            @endif
                            @if ($filter === 'active')
                                פעילים
                            @endif
                            @if ($filter === 'inactive')
                                מכרזים לא פעילים
                            @endif
                            @if ($filter === 'stopped')
                                מכרזים שהסתיימו
                            @endif
                        </span>
                    </button>
                    <div class="dropdown-menu choosestatus" style="position:absolute">
                        <a class="dropdown-item"  href="/admin/tenders/">הכל</a>
                        <a class="dropdown-item" href="/admin/tenders/active">מכרזים פעילים</a>
                        <a class="dropdown-item" href="/admin/tenders/canceled">מבוטל</a>
                        <a class="dropdown-item" href="{{ url()->current() }}?find=not_active_tender">מכרז לא פעיל</a>

                        {{-- <a class="dropdown-item" onclick='$.fn.gofilters(3)' href="#">מכרזים שהסתיימו</a> --}}
                    </div>
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle"
                    style="position:relative;top:-23px;font-size:20px;background:transparent; color:rgb(94, 123, 137);border:none;"
                    type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    שם מכרז
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" onclick='$.fn.gofiltersByName(0)' href="#">מכרז</a>
                    {{-- <a class="dropdown-item" onclick='$.fn.gofiltersByName(1)' href="#">משרת סטודנט</a> --}}
                    <a class="dropdown-item" onclick='$.fn.gofiltersByName(4)' href="#">דרושים</a>
                    {{-- <a class="dropdown-item" onclick='$.fn.gofiltersByName(2)' href="#">ממלא מקום</a> --}}
                    {{-- <a class="dropdown-item" onclick='$.fn.gofiltersByName(3)' href="#">אחר</a> --}}
                </div>
            </div>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle"
                    style="position:relative;top:-23px;font-size:20px;background:transparent; color:rgb(94, 123, 137);border:none;"
                    type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    סינון
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ url()->current() }}?find=has_salary">מצויין שכר</a>
                    <a class="dropdown-item" href="{{ url()->current() }}?find=is_test_required">מבחן חובה</a>
                    <a class="dropdown-item" href="{{ url()->current() }}?find=test_is_not_required">מבחן אינו חובה</a>
                    <a class="dropdown-item" href="{{ url()->current() }}?find=is_recommended">ממליצים חובה</a>
                    <a class="dropdown-item" href="{{ url()->current() }}?type=internal_tender">מכרז פנימי</a>
                    <a class="dropdown-item" href="{{ url()->current() }}?type=external_tender">מכרז חיצוני</a>
                    <a class="dropdown-item" href="{{ url()->current() }}?type=internal_external_tender">פנימי/ חיצוני</a>
                </div>
            </div>


            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle"
                    style="position:relative;top:-23px;font-size:20px;background:transparent; color:rgb(94, 123, 137);border:none;"
                    type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    רמה תפקודית
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($functional__level_array as $key => $details)
                    <a class="dropdown-item" href="{{ url()->current() }}?level={{ $details }}">{{ $details }}</a>
                    @endforeach
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle"
                    style="position:relative;top:-23px;font-size:20px;background:transparent; color:rgb(94, 123, 137);border:none;"
                    type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    רשימת מחלקות

                </button>
                <div class="dropdown-menu dept-filter" aria-labelledby="dropdownMenuButton">

                </div>
            </div>

            <div style="display:flex;">
                <div class="w-25">
                    <a id="search" href="#" class="paginate"
                        style="position:relative;top:-10px;margin: auto 10px auto 100px;display:inline-block"><img
                            src="/img/s.png"> <span>חיפוש </span>
                        <form class="search" onsubmit=" $.fn.gosearch()">
                            <div class="input-group">
                                <div class="form-group has-feedback has-clear">
                                    <input type="text" name="search" class="form-control" id="search-imput"
                                        style="width:400px;position:absolute;left:0"
                                        placeholder="אנא הזינו מילה/מספר פניה לחיפוש" />

                                    <span class="form-control-clear form-control-feedback hidden"
                                        style="transform:translateX(50px)">X</span>
                                </div>
                            </div>
                        </form>
                    </a>
                </div>
                @if (\App\User::check_auth_user_permission(3))
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle"
                            style="position:relative;top:-23px;font-size:20px;background:transparent; color:rgb(94, 123, 137);border:none;"
                            type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            הוספת מכרז
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" onclick='newtender(0)' href="#">מכרז</a>
                            {{-- <a class="dropdown-item" onclick='newtender(1)' href="#">משרת סטודנט</a> --}}
                            <a class="dropdown-item" onclick='newdrushim()' href="#">דרושים</a>
                            {{-- <a class="dropdown-item" onclick='newtender(2)' href="#">ממלא מקום</a>
                            <a class="dropdown-item" onclick='newtender(3)' href="#">אחר</a> --}}
                        </div>
                    </div>

                    <!--
             <div class="aaa dropdown">
                            <button type="button" class="btn dropdown-toggle"
                                    style="height:39px;font-size:20px;margin-top:-15px;text-align:left;padding:0;padding-top:10px;background:transparent; color:rgb(94, 123, 137);border:none;"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>הוספה</span>
                                <span class="" id='tenderstatus1' class="tenderstatus"
                                      style="position:relative;cursor:pointer;top:0;color:rgb(94, 123, 137)">:
               @if ($filter1 === 'tender')
    מכרז
    @endif
               @if ($filter1 === 'student')
    סטודנט
    @endif
               @if ($filter1 === 'acting')
    ממלא מקום
    @endif
               @if ($filter1 === 'other')
    אחר
    @endif
        </span>
                            </button>
                            <div class="dropdown-menu choosestatus" style="position:absolute">
                                <a class="dropdown-item" onclick='newtender(0)' href="#">מכרז</a>
                                <a class="dropdown-item" onclick='newtender(1)' href="#">סטודנט</a>
                                <a class="dropdown-item" onclick='newtender(2)' href="#">ממלא מקום</a>
              <a class="dropdown-item" onclick='newtender(3)' href="#">אחר</a>
                            </div>
                        </div>
                            <a href="#" class="nvlink" onClick="newtender()"
                               style="border:0;position:relative;top:-10px;display:inline-block"><img src="/img/plus.png"/><span
                                        class="admtoptopheader"> מכרז חדש</span> </a>-->
                @endif
            </div>


        </div>


        {{-- <select><option   {{$filter==="all"?'bold':''}}>All</option><option
                    {{$filter==="active"?'bold':''}}
            >Active</option><option   {{$filter==="selected"?'bold':''}}>Selected</option></select> --}}
        {{-- <a href="/admin/tenders/all"  class="nvlink {{$filter==="all"?'bold':''}}" >All</a>
        <a href="/admin/tenders/active"  class="nvlink {{$filter==="active"?'bold':''}}" >Active</a>
        <a href="/admin/tenders/stopped"  class="nvlink {{$filter==="stopped"?'bold':''}}" >Stopped</a> --}}


        <div class="apps-card-body" style="padding-top:0">

            <table cellspacing="10" class="apps-list">
                <thead>
                    <th>מס' מכרז</th>
                    <th>שם מכרז</th>
                    <th>נספח מכרז/משרה</th>
                    <th>מצב מכרז/משרה</th>
                    <th>מבחן אינו חובה</th>
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
                    @if (!empty($list))
                        @foreach ($list as $key => $line)
                            @php
                                $tender = $line->tender;
                            @endphp
                            <?php $id = explode('-', $line->generated_id); ?>
                            @if ($id && isset($id[1]))
                                <tr id="line_{{ $line->generated_id }}" class="<?php echo $line->status == 0 ? 'new' : ''; ?>">
                                    <?php

                                    $use_id = $id[1];
                                    $flag = 'flag';
                                    $file = 'file';

                                    ?>
                                    <td>
                                        <span style="font-weight: 400">{{ $line->tender_number ?? $line->generated_id }} </span>

                                        @if ($tender->tender_type == 0)
                                            <span class="badge badge-info">
                                                @php
                                                    echo match ($tender->ttype) {
                                                        1 => 'מכרז פנימי',
                                                        2 => 'מכרז חיצוני',
                                                        3 => 'פנימי/ חיצוני'
                                                    };
                                                @endphp
                                            </span>
                                        @endif
                                        <span class="badge badge-primary">
                                            {{ $tender->is_drushim == 1 ? 'דרושים' : 'מכרז' }}
                                        </span>
                                        <button type="button" class="btn btn-bs bg-info btn-primary DecisionMakerModalOpenBtn"
                                            data-id="{{ $line->generated_id }}">חברי וועדה</button>


                                    </td>
                                    <td width="250px">
                                        @if (\Carbon\Carbon::now() < $line->finish_date)
                                            <a target=_blank
                                                href="/page5?tenderid={{ $line->generated_id }}&file={{ $is_contain_file[$id[1]][$file] }}&tenderdisplay={{ $display_list[$key]['display_generated_id'] }}"
                                                style="font-weight: 400">{{ $line->tname ?? '--No Title--' }}</a>
                                        @else
                                            <a target="_blank" href="/not-active"
                                                style="font-weight: 400">{{ $line->tname }}</a>
                                        @endif
                                        @if ($tender->template_id)
                                        <br>
                                        תבנית: {{ $tender->template->name }}
                                        @endif
                                    </td>

                                    <td>
                                        <form id="form-{{ $line->id }}" class="form">

                                            <div style="display:flex;flex-direction:row;">
                                                <div>
                                                    <div class="">
                                                        <div class="row">
                                                            @foreach ($line->tender->files as $file)
                                                                <div class="col-12">
                                                                    <a
                                                                        href="{{ asset($file->url) }}"><small>{{ $file->file_name }}</small></a>
                                                                    <a href="{{ route('tenderFileDelete', ['fileID' => $file->id]) }}"
                                                                        onclick="return confirm('Are you sure? deleted file can not be undo')"><i
                                                                            class="trash-icon"></i></a>
                                                                    <br>
                                                                </div>
                                                            @endforeach
                                                            <div class="col-12">
                                                                <form action="" method="POST"
                                                                    enctype="multipart/form-data">
                                                                    <div class="btn-input-upload">
                                                                        <input multiple accept="application/pdf"
                                                                            type="file" name="file[]"
                                                                            class="d-none tenderFileUpload"
                                                                            data-id="{{ $line->id }}"
                                                                            id="tenderFileUpload{{ $line->id }}">
                                                                        <label class=""
                                                                            for="tenderFileUpload{{ $line->id }}">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                width="19px" height="13px"
                                                                                style="transform: scale(0.8)  translateY(4px);">
                                                                                <path fill-rule="evenodd"
                                                                                    fill="rgb(128, 184, 57)"
                                                                                    d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                                                            </svg>

                                                                            <span class="choose-file-text"
                                                                                style="margin-top:-2px">
                                                                                בחר קובץ
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>


                                                    </div>

                                                    {{-- <input type="file" name="file" id="fileuploader{{ $line }}"> --}}

                                                    {{-- <a href="#" id="rcfile-upload-{{ $line->id }}"
                                                            class="rm" style="{{ $css_show }}"
                                                            onclick="removeFile(this,{{ $line->id }});return false;"><i
                                                                class="trash-icon"></i></a>
                                                        <a id="tcfile-upload-{{ $line->id }}" target="_blank"
                                                            href="{{ $url }}"
                                                            style="font-weight: 400; {{ $css_show }};"
                                                            {{ $download }}>{{ $filename }}</a>
                                                        <input id="key-{{ $line->id }}" type="text" disabled
                                                            class="btn-input-upload" value="אנא צרף קובץ רלוונטי"
                                                            style="{{ $css_hide }}" />
                                                        <label for="cfile-upload-{{ $line->id }}" class="btn-upload"
                                                            style="{{ $css_hide }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="19px"
                                                                height="13px"
                                                                style="transform: scale(0.8)  translateY(4px);">
                                                                <path fill-rule="evenodd" fill="rgb(128, 184, 57)"
                                                                    d="M14.537,4.008 L-0.000,4.008 L3.496,13.001 L17.666,13.001 L14.537,4.008 ZM19.000,-0.001 L13.480,-0.001 L12.375,2.000 L3.508,2.000 L3.510,2.985 L15.230,2.985 L18.725,13.001 L19.000,13.001 L19.000,-0.001 Z" />
                                                            </svg>

                                                            <span id="choose-file-text" style="margin-top:-2px">

                                                                בחר קובץ
                                                            </span>
                                                        </label> --}}

                                                    {{-- <input id="cfile-upload-{{ $line->id }}" type="file"
                                                            name="file[]" multiple class="btn-file-upload"
                                                            onchange="fileChange(this, {{ $line->id }});"
                                                            accept="application/pdf" style="{{ $css_hide }}" /> --}}
                                                </div>
                                            </div>


        </div>

        </form>
        </td>

        <td>
            <select name="tender_status" id="tender_status" onchange="saveStatus(this,'<?php echo $line->generated_id; ?>');">
                <?php
						 foreach($tender_status as $key=>$status){
							 $selected ='';
						 if($line->tender_status == $key)
						 $selected = 'selected';?>
                <option value="{{ $key }}" {{ $selected }}>{{ $status }}
                </option>
                <?php } ?>

            </select>
        </td>
        <td>
            @if ($line->tender?->is_test_required === 1)
                <span class="badge badge-success">מבחן חובה</span>
            @else
                <span class="badge badge-info">מבחן אינו חובה</span>
            @endif
        </td>
        <?php
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Jerusalem'));

        $fdate = $date->format('Y-m-d H:i:s');
        ?>
        <td>
            @if ($fdate < $line->finish_date && $line->stopped == 0)
                <span class="adminlighthdr">פעיל</span>
                <button class="btn btn-info bg-danger btn-bs stopTender" onclick="confirm('האם אתה בטוח?')"
                data-id="{{ $line->generated_id }}">Cancel Tender</button>
            @elseif ($line->stopped == 1)
                <span class="adminlighthdr">מבוטל</span>
                <button class="btn btn-bs stopTender" onclick="confirm('האם אתה בטוח?')"
                data-id="{{ $line->generated_id }}">Start Tender</button>
            @else
                <span class="adminlighthdr">לא פעיל</span>
            @endif
        </td>
        <td><span style="font-weight: 400">{{ date('d/m/Y', strtotime($line->finish_date)) }}</span>
        </td>
        <td> <?php if ($line->tname && $line->ccount > 0) {?><span><img src="/img/eye.png"> <a
                    href="/admin/tenders/requestsorted/all/{{ $line->generated_id }}" style="font-weight: 400">הצגת
                    הפניות</a></span><?php } else {
								};?></td>
        <td>
            @if (\App\User::check_auth_user_permission(4))
                <a href="#" onClick="editA('<?php echo $line->generated_id; ?>', '<?php echo $line->tender_type; ?>')"><img
                        src="/img/pen.png" /><span class="admintendercomment">עריכה</span></a>
            @endif
        </td>

        <td>

            <?php if($line->stopped) { ?>

            @if (\App\User::check_auth_user_permission(6))
                <a href="#" onClick="continueA('<?php echo $line->generated_id; ?>')"><img src="/img/play.png" /><span
                        class="admintendercomment">הפעל
                        מכרז</span></a>
            @endif
            <?php } else   { ?>
            @if (\App\User::check_auth_user_permission(5))
                <a href="#" onClick="stopA('<?php echo $line->generated_id; ?>')"><img src="/img/stop.png" /><span
                        class="admintendercomment">מכרז
                        שהסתיים</span></a>
            @endif

            <?php }?>
        </td>
        @if (\App\User::check_auth_user_permission(7))
            <td><a href="#" onClick="duplicateTender('<?php echo $line->generated_id; ?>', '<?php echo $line->tender_type; ?>')"><img
                        src="/img/dublicate.png" /><span class="admintendercomment">שכפול
                        מכרז</span></a>

            </td>
        @endif
        <td>

            @if (\App\User::check_auth_user_permission(2))
                <a href="#" onClick="delA('<?php echo $line->generated_id; ?>')">
                    <img src="/img/del.png" /><span class="admintendercomment">מחיקה</span></a>
            @endif
        </td>
        <td> <a href="#" onClick="get_logs('<?php echo $line->generated_id; ?>')">
                <img src="/img/openlogs-btn.png" /><span class="admintendercomment">יומן</span></a>
        </td>

        <td width="50px">
            <a href="#" onClick="$.fn.showCloseMore('<?php echo $line->generated_id; ?>')"><img
                    id="ocbutton_<?php echo $line->generated_id; ?>" src="../../img/selg.png" /></a>
        </td>
        </tr>
        <tr id="zzline_{{ $line->generated_id }}" style="display:none">
            <td colspan="10">
                <div class="tender_table_details">
                    <div style="display:flex; flex-direction: row;height: 50px; overflow-y: auto;">
                        <div>
                            @if (isset($id[1]) && !$is_contain_file[$id[1]][$flag])
                                <form id="upload_form" action="/admin/upload-file/{{ $id[1] }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-control mr-0">
                                        <div>צירוף תכולת מכרז:</div>
                                        <span class="captiogreen adminlighthdr" style="text-decoration: none;">
                                            <input type="file" name="file" class="typeahead form-control"
                                                accept="application/pdf, image/jpeg, image/jpg, image/gif, image/png, image/jpe, image/tiff, image/bmp, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword" />
                                            <button class="btn" style="display: inline-block;"
                                                type="submit">הוסף</button>
                                        </span>
                                    </div>
                                </form>
                            @elseif (isset($id[1]) && $is_contain_file[$id[1]][$file])
                                <a href="{{ asset('upload/admin/' . $is_contain_file[$id[1]][$file]) }}" download
                                    style="margin-bottom: 5px;margin-left: 5px;">
                                    הורדת קובץ צירוף תכולת מכרז
                                </a>
                            @endif
                        </div>
                        <div style="display:flex; flex-direction: column;">

                            <a style="margin-left:5px;"
                                href="/protocol?tenderid={{ $line->generated_id }}&tname={{ $line->tname }}"
                                target="_blank">פרוטוקול - {{$tender->is_protocol? "true":"False"}}</a>

                            @if($tender->is_protocol)
                            <a style="margin-left:5px;"
                                href="/protocol-table?tenderid={{ $line->generated_id }}&tname={{ $line->tname }}"
                                target="_blank">טבלת מועמדים</a>
                            @endif

                            @if (!empty($files_protocol))
                                @foreach ($files_protocol as $file)
                                    @if ($file->app_id === $id)
                                        <div>
                                            <a style="margin-left:5px;" href="{{ asset('upload/' . $file->url) }}"
                                                download>{{ $file->file_name }}</a>
                                            <a style="margin-left:5px;"
                                                href="/admin/showapps/protocol?tenderid={{ $line->generated_id }}&tname={{ $line->tname }}?formdata={{ $id }}&pdf={{ $file->url }}"
                                                target="_blank">ערוך</a>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div style="display:flex; flex-direction: column;">
                            {{-- <a href="/zichron-devarim?tenderid={{ $line->generated_id }}&tname={{ $line->tname }}"
                                target="_blank">זכרון דברים</a> --}}

                            @if (!empty($files_zichron_devarim))
                                @foreach ($files_zichron_devarim as $file)
                                    @if ($file->app_id == $id[1])
                                        <div><a href="{{ asset('upload/' . $file->url) }}"
                                                download>{{ $file->file_name }}</a></div>
                                    @endif
                                @endforeach
                            @endif


                        </div>
                    </div>
                    <div style="height: 50px; overflow-y: auto;">
                        <div class="captiogreen">תנאי סף</div>
                        <?php
                        $cond = $line->conditions;
                        if ($cond && strlen($cond) > 0) {
                            $condArr = explode('!+!+!+!', $cond);
                            if (strpos($condArr[0], '=>') !== false) {
                                $isCond = true;
                                foreach ($condArr as $key => $val) {
                                    if (strpos($condArr[$key], '=>required') !== false) {
                                        $condArrRequired = explode('=>required', $condArr[$key]);
                                        $rArr = implode('&nbsp;', $condArrRequired);
                                        echo $rArr;
                                    }
                                }
                            } else {
                                $rArr = implode('&nbsp;', $condArr);
                                $isCond = false;
                                echo $rArr;
                            }
                        }
                        ?>
                        @if (isset($isCond))
                            <div class="captiogreen">יתרון</div>
                            <?php
                            $cond = $line->conditions;
                            if ($cond && strlen($cond) > 0) {
                                $condArr = explode('!+!+!+!', $cond);
                                foreach ($condArr as $key => $val) {
                                    if (strpos($condArr[$key], '=>not_required') !== false) {
                                        $condArrRequired = explode('=>not_required', $condArr[$key]);
                                        $rArr = implode('&nbsp;', $condArrRequired);
                                        echo $rArr;
                                    }
                                }
                            }
                            ?>
                        @endif
                    </div>
                    <div>
                        <div class="captiogreen">סה"כ פניות שהתקבלו
                        </div>{{ $line->ccount ? $line->ccount : 0 }}
                    </div>
                    <div>
                        <div class="captiogreen">ממתין להחלטת ועדה
                        </div>{{ $line->pendingcount ? $line->pendingcount : 0 }}
                    </div>
                    <div>
                        <div class="captiogreen">אושר</div>{{ $line->accepted ? $line->accepted : 0 }}
                    </div>
                    <div>
                        <div class="captiogreen">נדחה</div>
                        {{ $line->trejected ? $line->trejected : 0 }}
                    </div>
                    <a href="#" style='display:none'
                        onclick="unMore2('{{ $line->generated_id ? $line->generated_id : 0 }}')">
                        <img width="15" height="9" style="transform:rotate(180deg)"
                            src="../../img/selg.png" /></a>

                </div>
            </td>
        </tr>
        @endif
        @endforeach
        @endif
        </tbody>
        <tfoot>
            @if (!empty($list))
                <tr class="sky-paginate">
                    <td colspan="6">

                        <div class="footer-menu sky-rtl">
                            <span>סה”כ מכרזים: {{ $count_all }}</span>|
                            <span> מכרזים פעילים: {{ $count_active }}</span>|
                            <span> מכרזים לא פעילים: {{ $count_inactive }}</span>|
                            <span>מכרזים שנעצרו: {{ $count_stopped }}</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="12" style="text-align: center">

                        @for ($i = 0; $i < $total_pages; $i++)
                            <a class="pages {{ $i == $page_num ? 'active_page' : '' }}" href="#"
                                onClick="gopage({{ $i }})">{{ $i }}</a>
                        @endfor
                    </td>

                </tr>
            @endif
        </tfoot>
        </table>
        </div>
        <div class="modal fade" id="DecisionMakerModal" tabindex="-1" aria-labelledby="DecisionMakerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="DecisionMakerModalLabel">הוסף חבר וועדה</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">מכרז הוסף חבר וועדה</label>
                            <form id="tender_decision_makerForm" action="">
                                <div class="input-group dm-wrap first">
                                    <div class="input-group-prepend">
                                        <div class=""><button type="button" style="min-width: 25px"
                                                class="p-0 btn btn-dagner deMakerAddBtn"><i
                                                    class="fas fa-plus"></i></button></div>
                                    </div>
                                    <textarea name="tender_decision_maker[]" class="form-control tender_decision_maker"></textarea>
                                    <div class="input-group-addon">
                                        <div class=""><button type="button" style="min-width: 25px"
                                                class="p-0 btn btn-dagner deMakerRemoveBtn"><i
                                                    class="fas fa-trash"></i></button></div>
                                    </div>
                                </div>
                                <div class="extra-dm-wrap">

                                </div>
                            </form>
                            <button data-id="" class="btn btn-primary DecisionMakerSaveBtn">שמור</button>
                        </div>
                        <div class="dmEditWrap">

                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="app-logs">
            <div class="app-logs-header">
                יומן פעולות
                <a href="#" class="close-lg" onclick="closs_logs()"><img
                        src="{{ asset('img/close-lg.png') }}"></a>
            </div>
            <div class="app-logs-content">
                <img src="{{ asset('img/loader.gif') }}" class="loader-img">
            </div>
        </div>

    </main>
    <script>
        $(document).on('change', '#hasSalaryInput', function(event) {
            $('#salaryInput, #salaryInput_aud').css('display', $('#hasSalaryInput').is(':checked') ? 'block' :
                'none')
        });

        $(document).ready(function(){
            var dept_list = $('#pref_tender_brunch option');
            var url = `<a class="dropdown-item" href="{{ url()->current() }}?dept=___">___</a>`
            dept_list.map(function(index, elem) {
                // val = (elem.value.slice(0, -1))
                val = (elem.value)

                if(elem.value[0]=='"' || elem.value[0]=="'" ){
                    val = val.slice(0)
                }

                if(elem.value[-1]=='"' || elem.value[-1]=="'" ){
                    val = val.slice(-1)
                }
                // val = (elem.value.slice(0, -1))
                $('.dept-filter').prepend(`${url.replaceAll('___',val)}`)
            })
        })



    </script>
@endsection
@push('extra_js')
    <script>
        $.fn.goByParams = function(params) {
            let url = '/admin/tenders/' + params.filter + '?page_num=' + params.page + (params.start ?
                '&start_date=' + params.start : '') + (params.finish ? '&finish_date=' + params.finish :
                '') + '&tender_type=' + params.tender_type;
            console.log(url);

            window.location.href = url;

        }
    </script>
@endpush
