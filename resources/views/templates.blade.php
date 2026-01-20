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
                        <label for="" class="caption captiogreen">מתח	דרגות</label>
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
    </script>
    <main class="content">


        <div class="apps-card-body" style="padding-top:0">

            <table cellspacing="10" class="apps-list">
                <thead>
                    <tr>
                        <td>
                            מס
                        </td>
                        <td>שם</td>
                        <td>פעולה</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($templates as $template)
                        <tr>
                            <td>{{ $template->id }}</td>
                            <td>{{ $template->name }}</td>
                            <td>
                                <a title="Edit" class="mx-2" href="{{ route('template.edit',$template->id) }}" target="_blank"><img src="{{ asset('img/pen.png') }}" alt=""></a>
                                <a title="View" class="mx-2" href="{{ route('template.view',$template->id) }}" target="_blank"><img src="{{ asset('img/eye.png') }}" alt=""></a>
                                <a title="Duplicate" class="mx-2" href="{{ route('template.duplicate.create',$template->id) }}" target="_blank"><img src="{{ asset('img/dublicate.png') }}" alt=""></a>
                                <a title="Download" class="mx-2" href="{{ route('template.download',$template->id) }}" target="_blank"><img width="14" src="{{ asset('img/download.png') }}" alt=""></a>
                                <a title="Delete" class="mx-2" href="{{ route('template.delete',$template->id) }}" target="_blank"><img width="14" src="{{ asset('img/del.png') }}" alt=""></a>
                                <a title="Tenders" class="mx-2" href="/admin/tenders?template={{ $template->id }}" target="_blank"><img src="{{ asset('img/openlogs-btn.png') }}" alt=""></a>
                            </td>
                        </tr>
                    @endforeach
        </tbody>
        <tfoot>
            
        </tfoot>
        </table>
        </div>
    </main>
    <script>
        $(document).ready(function(){
        })

        
        
    </script>
@endsection
