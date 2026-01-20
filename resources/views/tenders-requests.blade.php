@extends('layouts.admin.header')
<style>
    i.started{
        color: #ffca00;
    }

    .meeting {
        display: none;
    }

    .meeting-data {
        display: none;
    }

    .apps-list th {
        font-size: 12px;
        padding: 8px 4px;
        text-align: center !important;
        vertical-align: middle;
    }

    .apps-list td {
        font-size: 11px;
        padding: 6px 4px;
        vertical-align: top;
        max-width: 150px;
        word-wrap: break-word;
        text-align: center;
    }

    .qualification-column {
        min-width: 120px;
        max-width: 150px;
    }

    .badge {
        font-size: 10px;
        padding: 2px 6px;
    }
</style>
@section('content')
    <script language="JavaScript">
        // console.log('qq');
        var token = document.getElementsByName('csrf-token')[0].content;

        $(document).on('click', '.star-btn', function(event) {

            if(confirm('Are you sure?')){
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ route("tender-application.start","___") }}'.replaceAll('___',$(this).data('id')),
                    type: 'POST',
                     headers: {
                        "X-CSRF-TOKEN": token
                    },
                })
                .done(function(e) {
                    if(e.success){
                        window.location.reload()
                    }
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            }
        });

        $(document).on('change', '.send_all', function(event) {
            if ($(this).val() == "committee") {
                $(".meeting").css('display','block');
            } else {
                $(".meeting").css('display','none');
            }

            $('#start_hour_check').change(function() {
                if ($(this).is(':checked')) {
                    $('#start_hour_data').show();
                } else {
                    $('#start_hour_data').hide();
                }
            });

            $('#meeting_minutes_check').change(function() {
                if ($(this).is(':checked')) {
                    $('#meeting_minutes_data').show();
                } else {
                    $('#meeting_minutes_data').hide();
                }
            });

            $('#pluse_meeting_check').change(function() {
                if ($(this).is(':checked')) {
                    $('#pluse_meeting_data').show();
                } else {
                    $('#pluse_meeting_data').hide();
                }
            });

            $('#pluse_meeting_minutes_check').change(function() {
                if ($(this).is(':checked')) {
                    $('#pluse_meeting_minutes_data').show();
                } else {
                    $('#pluse_meeting_minutes_data').hide();
                }
            });
        });

        // Handle the new committee email form submission
        $(document).on('click', '#send-committee-email', function(event) {
            event.preventDefault();

            // Get selected applications
            let app_ids = [];
            $('input[name="send_all"]').each(function(index) {
                if(this.checked){
                    let id = $(this).attr('data-val');
                    app_ids.push(id);
                }
            });

            if(app_ids.length === 0) {
                alert('אנא בחר לפחות פניה אחת');
                return;
            }

            // Check if start_hour is checked (required for sending emails)
            if(!$('#start_hour_check').is(':checked')) {
                alert('יש לבחור "שעה שאנחנו מתחילים" כדי לשלוח מיילים');
                return;
            }

            // Get all form data including checkbox states and their values
            const formData = {
                app_ids: app_ids,
                type: 'committee',
                // Basic meeting info (only if start_hour is checked)
                meeting_date: $('#meeting_date').val(),
                meeting_time: $('#meeting_time').val(),
                meeting_location: $('#meeting_location').val(),

                // Checkbox states and their corresponding values
                start_hour_checked: $('#start_hour_check').is(':checked'),
                meeting_minutes_checked: $('#meeting_minutes_check').is(':checked'),
                meeting_minutes_value: $('#minutes').val() || 10, // Default 10 minutes

                pluse_meeting_checked: $('#pluse_meeting_check').is(':checked'),
                pluse_meeting_value: $('#pluse_meeting_input').val() || 2, // Default break after 2 meetings

                pluse_meeting_minutes_checked: $('#pluse_meeting_minutes_check').is(':checked'),
                pluse_meeting_minutes_value: $('#pluse_meeting_time_input').val() || 5 // Default 5 minutes break
            };

            // Validation
            if(!formData.meeting_date) {
                alert('יש להזין תאריך פגישה');
                return;
            }
            if(!formData.meeting_time) {
                alert('יש להזין שעת פגישה');
                return;
            }
            if(!formData.meeting_location) {
                alert('יש להזין מקום פגישה');
                return;
            }

            // Show loader (following system pattern)
            $('#fader').css('display', 'block');

            // Send AJAX request
            $.ajax({
                url: '/admin/send-committee-email',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#fader').css('display', 'none');
                    if(response.success) {
                        alert('המיילים נשלחו בהצלחה עם זמני פגישה אישיים');
                        window.location.reload();
                    } else {
                        alert('שגיאה בשליחת המיילים: ' + (response.message || 'שגיאה לא ידועה'));
                    }
                },
                error: function(xhr, status, error) {
                    $('#fader').css('display', 'none');
                    alert('שגיאה בשליחת המיילים');
                    console.error('Error:', error);
                }
            });
        });

        $(document).on('change', '#testResultSelect', function(event) {
            var id = $(this).data('id');
            $.ajax({
                url: '{{ route("tender-application.changeTestResult","___") }}'.replaceAll('___',$(this).data('id')),
                type: 'POST',
                data: {status: $(this).val()},
                 headers: {
                    "X-CSRF-TOKEN": token
                },
            })
            .done(function(e) {
                if(e.success){
                    window.location.reload()
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        });

        $(document).on('click', '.grade-save-btn', function(event) {
            var id = $(this).data('id');
            $.ajax({
                url: '{{ route("tender-application.gradeSave","___") }}'.replaceAll('___',$(this).data('id')),
                type: 'POST',
                data: {grade: $('#testResultGrade'+$(this).data('id')).val()},
                 headers: {
                    "X-CSRF-TOKEN": token
                },
            })
            .done(function(e) {
                if(e.success){
                    window.location.reload()
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        });

        jQuery(document).ready(function($) {

            $(".jssearch").select2({
                tags: true
            });

            $('.jssearch').on('select2:select', function(e) {
                var doc = e.params.data;
                console.log('ee', e, doc.id);

                /*
                    *  var doc = document.getElementById('filtertender');
                if (doc && doc.value && doc.value === 'all') {
                    window.location.href = '/admin/tenders/requestsorted/all';
                }
                if (doc && doc.value && doc.value.length === 8) {
                    window.location.href = '/admin/tenders/requestsorted/' + doc.value;
                    //  console.log(doc.value);
                }
                    * */
                if (doc && doc.id && doc.id === 'All') {
                    window.location.href = '/admin/tenders/requestsorted/all';
                }
                if (doc && doc.id && doc.id.length === 8) {
                    window.location.href = '/admin/tenders/requestsorted/all/' + doc.id;
                    //  console.log(doc.value);
                }
                // console.log(data);
            });

            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }
                var baseUrl = "/user/pages/images/flags";
                var $state = $(
                    '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() +
                    '.png" class="img-flag" /> ' + state.text + '</span>'
                );
                return $state;
            };
            /* setTimeout(function () {
                     console.log('10w0');
                     if ($("#tmpex").length > 0) {
                         $("#tmpex").select2({
                             templateResult: formatState
                         });
                     }
                 },1000);
     */

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

        });
        $.fn.gosearch = function(e) {
            var currParams = $.fn.getUrlParams();
            currParams.page = 0;

            //  console.log('cgo', currParams);
            goByParams(currParams);
            // e.preventDefault();
            // alert('___');
            return false;
        }
        $.fn.gofiltersL = function(action) {
            var doc = document.getElementById('filterstatus');
            doc.value = action;
            var params = $.fn.getUrlParams();
            var tenderid = params.tenderid;
            window.location.href = '/admin/tenders/requestsorted/' + params.filter + (tenderid && tenderid.length > 0 ?
                '/' + tenderid : '');
        }

        function godate() {
            var currParams = $.fn.getUrlParams();
            currParams.page = 0;

            console.log('cgo', currParams);
            goByParams(currParams);
        }

        $.fn.getUrlParams = function() {
            var sel = document.getElementById("filterstatus");
            var value = sel.value
            // console.log(e, sel.value);
            var gourl = value;
            if (gourl === '') gourl = 'all';
            /* switch (value) {
                 case 'All':
                     gourl = 'all';
                     break;
                 case 'New':
                     gourl = 'new';
                     break;
                 case 'Interview':
                     gourl = 'interview';
                     break;
                 case 'Waiting for files':
                     gourl = 'files';
                     break;
                 case 'Accepted':
                     gourl = 'accepted';
                     break;
                 case 'Rejected':
                     gourl = 'rejected';
                     break;
                 case 'Rejected due to conditions':
                     gourl = 'rejected0';
                     break;
                     case 'newfiles':
                     gourl = 'nfiles';
                     break;
                 case 'canceled':
                     gourl = 'canceled';
                     break;
             }*/


            //console.log(e, value, gourl);
            // var tenderid='{{ $tenderid }}';
            var vw = window.location.search;

            var page_sr = vw.substr(vw.indexOf('page_num='));
            var page_num = vw.indexOf('&') ? page_sr.substr(vw.indexOf('&')) : page_sr;
            var datee = document.getElementById("date_range");
            var dates = false;
            try {

                var dates = JSON.parse(datee.getAttribute('data-val'));
            } catch (ex) {
                //console.log(ex);
            }
            var srch = document.getElementById("search-imput");


            console.log('datee', datee, dates);
            return {
                filter: gourl,
                tenderid: '{{ $tenderid }}',
                page: page_num,
                start: dates.start ? dates.start : false,
                finish: dates.finish ? dates.finish : false,
                search: srch ? srch.value : ""
            }

            // window.location.href='/admin/tenders/requestsorted/'+gourl+(tenderid && tenderid.length>0?'/'+tenderid:'');
        }


        $.fn.gofiltersA = function() {
            var doc = document.getElementById('filtertender');
            if (doc && doc.value && doc.value === 'all') {
                window.location.href = '/admin/tenders/requestsorted/all';
            }
            if (doc && doc.value && doc.value.length === 8) {
                window.location.href = '/admin/tenders/requestsorted/' + doc.value;
                //  console.log(doc.value);
            }

        }
        $.fn.gopageR = function(page) {
            var currParams = $.fn.getUrlParams();
            currParams.page = page;
            goByParams(currParams);

        }

        $("#supersearch").submit(function(e) {
            console.log('supsearch');
            alert('sup')
            return false;
        });


        function goByParams(params) {
            //  let url='/admin/tenders/'+params.filter+'?page_num='+params.page;
            var tenderid = params.tenderid;
            let url = '/admin/tenders/requestsorted/' + params.filter + (tenderid && tenderid.length > 0 ? '/' + tenderid :
                '') + '?page_num=' + params.page + (params.start ? '&start_date=' + params.start : '') + (params
                .finish ? '&finish_date=' + params.finish : '') + (params.search && params.search.length > 0 ?
                '&search=' + params.search : '');
            console.log(url);

            window.location.href = url;

        }

        $.fn.goexport = function(value) {
            console.log(';gog', value);
            // var doc = document.getElementById("goexport");
            if (value) {
                var params = $.fn.getUrlParams();
                var tenderid = params.tenderid;
                if ((value === 'gocandidatedetails' || value === 'gotendersorted') && !tenderid) {
                    alert('יש לבחור מכרז!');
                    return false;
                }
                if (value === 'goall') {
                    window.open('/admin/exportTenders/' + tenderid)
                }
                if (value === 'gospecial') {
                    window.open('/admin/exportSpec/' + tenderid)
                }
                if (value === 'gotenderstatus') {
                    window.open('/admin/exportTenderStatus');
                }
                if (value === 'gotenderstatusbrunch') {
                    window.open('/admin/exportTenderStatusBrunch');
                }
                if (value === 'gocandidatedetails') {
                    window.open('/admin/exportCandidateDetails/' + tenderid);
                }
                if (value === 'gotendersorted') {
                    window.open('/admin/exportTenderSorted/' + tenderid);
                }
            }

        }
        $.fn.checkall = function() {

            var ischeckall = Boolean(Number($('#ischeckall').val()));
            var newVal = ischeckall ? 0 : 1;

            $('input[name="send_all"]').each(function(index) {
                $(this).prop('checked', newVal);
            });
            $('#ischeckall').val(newVal);
            $('#ischeckalltext').children('span').text(newVal == 0 ? "סמן הכל" : "נקה הכל");
        }

        // Function to upload test file
        function uploadTestFile(applicationId, fileInput) {
            if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
                alert('אנא בחר קובץ להעלאה');
                return;
            }

            var formData = new FormData();
            formData.append('test_file', fileInput.files[0]);

            $.ajax({
                url: '/admin/upload-test-file/' + applicationId,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.success) {
                        alert('קובץ מבחן הועלה בהצלחה');
                        window.location.reload();
                    } else {
                        alert('שגיאה: ' + (result.error || 'שגיאה לא ידועה'));
                    }
                },
                error: function(xhr, status, error) {
                    alert('שגיאה בהעלאת הקובץ');
                    console.error('Error:', error);
                }
            });
        }
    </script><?php
    $activedate = '';
    if (isset($_GET['label'])) {
        $activedate = $_GET['label'];
    }

    if (isset($_GET['start_date']) && !empty($_GET['start_date']) && $_GET['finish_date'] && !empty($_GET['finish_date'])) {
        $daterange = $_GET['start_date'] . ' - ' . $_GET['finish_date'];
        //   echo($daterange);
    } else {
        $activedate = 'הכל ';
        $daterange = ''; //'01/01/2019-' . date("m/d/Y", time() + 86400);
    }

    ?>
    <main class="content">
        <input type="hidden" id="filterstatus" value="{{ $filter }}" />
        <input type="hidden" id="ischeckall" value="0" />
        <div class="sky-card-header <?php if (isset($_GET['search'])) {
            echo 'showsearch';
        } ?>"
            style="display:flex;justify-content: space-between;align-items: center;padding-left:10px">
            <div style="display:flex;align-items:baseline">

                <a href="/admin/tenders/requestsorted/all/" class="paginate apps-link headerright">{{ $pageTitle }}</a>
                <div class="btn-group type_form_group filter-app" style="margin-top:0px"><a
                        class="dropdown-toggle btn-select" href="#" id="date_range" data-label="{{ $activedate }}"
                        data-name="daterange" data-val="{{ $daterange }}">בין
                        תאריכים: <span class="caret"><?php echo $daterange; ?></span></a></div>
                <div>
                    <select class="form-control jssearch">
                        <option>All</option>
                        @foreach ($tenders as $k => $tenderline)
                            <?php

                            ?>
                            <option {{ $tenderid === $tenderline->generated_id ? 'selected' : '' }}
                                value="{{ $tenderline->generated_id }}">{{ $tenderline->tname }}
                                @php
                                    $app_id = explode('-', $tenderline->generated_id);
                                    $meta_value = null;
                                    if (count($app_id) > 1) {
                                        $meta_value = DB::table('apps_meta')
                                            ->where([['app_id', '=', $app_id[1]], ['meta_name', '=', 'tender_num_display']])
                                            ->first();
                                    }
                                    $display_generate_id = $meta_value?->meta_value;
                                    $dis = !empty($display_generate_id)
                                        ? $display_generate_id
                                        : $tenderline->generated_id;
                                    echo '(' . $dis . ')';
                                @endphp
                            </option>
                        @endforeach
                    </select>

                </div>

                <div class="aaa dropdown">
                    <button type="button" class="btn dropdown-toggle"
                        style="height:39px;font-size:20px;margin-top:-15px;text-align:left;padding:0;padding-top:10px;background:transparent; color:rgb(94, 123, 137);border:none;"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span> סטטוס</span><?php

                        /*
                         * ["All"=>"הכל",
            "New"=>"ממתין לטיפול",
            'newfiles'=>'ממתין למסמכים',// Waiting for files !
            "Waiting for files"=>'ממתין לאישור מסמך חדש', //waiting for approve new file !
            "Waiting"=>"ממתין לאישור שלב א",
            "Interview"=>'ממתין לאישור שלב ב',
            'Rejected due to conditions'=>'נדחה שלב א\'',
            'Accepted'=>'אושר שלב ב\'',
            'Rejected'=>'נדחה שלב ב\'',
            'RejUser'=>'פניה שנעצרה',
            'canceled'=>'פנייה שנעצרה']
                         * */
                        ?>
                        <span class="" id='tenderstatus' class="tenderstatus"
                            style="position:relative;cursor:pointer;top:0;color:rgb(94, 123, 137)">:
                            @if ($filter === '' || $filter === 'all')
                                הכל
                            @endif
                            @if ($filter === 'new')
                                ממתין לטיפול
                            @endif
                            @if ($filter === 'waitingforfiles')
                                ממתין למסמכים
                            @endif
                            @if ($filter === 'waitingforfilesapproval')
                                ממתין לאישור מסמך חדש
                            @endif
                            @if ($filter === 'waiting')
                                ממתין לאישור עמידה בתנאי סף
                            @endif

                            @if ($filter === 'interview')
                                עבר תנאי סף
                            @endif
                            @if ($filter === 'interview_a')
                                ממתין לאישור שכר
                            @endif
                            @if ($filter === 'interview_b')
                                אישר שכר וממתין למכרז
                            @endif
                            @if ($filter === 'committee')
                                ממתין למכרז
                            @endif
                            @if ($filter === 'rejected0')
                                נדחה שלב א
                            @endif
                            @if ($filter === 'rejected')
                                לא נבחר במכרז
                            @endif
                            @if ($filter === 'accepted_a')
                                מקום 2
                            @endif
                            @if ($filter === 'accepted_b')
                                מקום 3
                            @endif
                            @if ($filter === 'accepted')
                                זכה במכרז
                            @endif

                            @if ($filter === 'canceled')
                            נדחה על ידי המועמד
                            @endif


                        </span>
                    </button>
                    <div class="dropdown-menu choosestatus" style="position:absolute;width:225px">
                        <a class="dropdown-item" onclick='$.fn.gofiltersL("all")' href="#">הכל</a>
                        <a class="dropdown-item" onclick='$.fn.gofiltersL("new")' href="#">ממתין לטיפול</a>
                        <a class="dropdown-item" onclick='$.fn.gofiltersL("waitingforfiles")' href="#">ממתין
                            למסמכים</a>
                        <a class="dropdown-item" onclick='$.fn.gofiltersL("waitingforfilesapproval")' href="#">ממתין
                            לאישור מסמך חדש</a>
                        <a class="dropdown-item" onclick='$.fn.gofiltersL("waiting")' href="#">ממתין לאישור עמידה
                            בתנאי סף</a>

                        <a class="dropdown-item" onclick='$.fn.gofiltersL("interview")' href="#">עבר תנאי סף</a>
                        <a class="dropdown-item" onclick='$.fn.gofiltersL("interview_a")' href="#">ממתין לאישור
                            שכר</a>
                        <a class="dropdown-item" onclick='$.fn.gofiltersL("interview_b")' href="#">אישר שכר וממתין
                            למכרז</a>
                        <a class="dropdown-item" onclick='$.fn.gofiltersL("committee")' href="#">ממתין למכרז</a>

                        <a class="dropdown-item" onclick='$.fn.gofiltersL("rejected0")' href="#">נדחה שלב א'</a>

                        <a class="dropdown-item" onclick='$.fn.gofiltersL("accepted")' href="#">זכה במכרז</a>
                        <a class="dropdown-item" onclick='$.fn.gofiltersL("accepted_a")' href="#">מקום 2</a>
                        <a class="dropdown-item" onclick='$.fn.gofiltersL("accepted_b")' href="#">מקום 3</a>

                        <a class="dropdown-item" onclick='$.fn.gofiltersL("rejected")' href="#">לא נבחר במכרז</a>
                        <a class="dropdown-item" onclick='$.fn.gofiltersL("canceled")' href="#">הסרת מועמדות </a>
                        <a class="dropdown-item" onclick='$.fn.gofiltersL("stared")' href="#">כוכב</a>

                        <a class="dropdown-item" onclick='$.fn.gofiltersL("test-required")' href="#">מבחן חובה</a>
                        <a class="dropdown-item" onclick='$.fn.gofiltersL("test-not-required")' href="#">מבחן אינו חובה</a>
                        <a class="dropdown-item" onclick='$.fn.gofiltersL("passed")' href="#">עבר</a>
                        <a class="dropdown-item" onclick='$.fn.gofiltersL("failed")' href="#">נכשל</a>
                        <a class="dropdown-item" onclick='$.fn.gofiltersL("no-result")' href="#">אין תוצאה</a>
                    </div>
                </div>


            </div>
            <div><span class="tmpex" id="tmpex"></span></div>

            <div class="" style="display: flex;width:350px">
                <a id="search" href="#" class="paginate line2menuadm" style="top:0px;"><img style="margin-top:-4px"
                        src="/img/s.png"> <span>חיפוש </span>
                    <form class="search" onsubmit=" $.fn.gosearch(this)">
                        <div class="input-group">
                            <div class="form-group has-feedback has-clear">
                                <input type="text" name="search" class="form-control" id="search-imput"
                                    style="width:400px;position:absolute;left:0;z-Index:1000"
                                    placeholder="אנא הזינו מילה/מספר פניה לחיפוש" />

                                <span class="form-control-clear form-control-feedback hidden"
                                    style="transform:translateX(50px)">X</span>
                            </div>
                        </div>
                    </form>
                </a>



                <div class="gww dropdown" style="">
                    <button type="button" class="btn dropdown-toggle"
                        style="height:39px;font-size:20px;margin-left:20px;margin-top:-2px;text-align:left;padding:0;padding-right:30px;padding-top:10px;background:transparent; color:rgb(94, 123, 137);border:none;"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span>ייצוא נתונים לאקסל

                        </span>

                    </button>
                    <div class="dropdown-menu choosestatus"
                        style="position:absolute;width:100px;left:100px;transform: translateX(100px)">
                        <a class="dropdown-item" onclick='$.fn.goexport("gotenderstatus")' href="#">ייצוא דוח סטטוס
                            מכרזים</a>
                        <a class="dropdown-item" onclick='$.fn.goexport("gotenderstatusbrunch")' href="#">ייצוא דוח
                            סטטוס מכרזים-אגף</a>
                        <a class="dropdown-item" onclick='$.fn.goexport("gotendersorted")' href="#">ייצוא טבלת מיון
                            למכרז</a>
                        <a class="dropdown-item" onclick='$.fn.goexport("gocandidatedetails")' href="#">ייצוא דוח
                            פרטי מועמד</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="apps-card-body">
            <div>
                <table cellspacing="10" class="apps-list">
                    <thead>
                        <th style="padding-right:20px">
                            מס’ פניה
                            <input type="checkbox" id="checkall" onclick='$.fn.checkall()'>
                            <a id="ischeckalltext" onclick='$.fn.checkall()' href="#"><span
                                    style="text-decoration-line: underline;color: black; font-size:11px;">סמן
                                    הכל</span></a>
                        </th>
                        <th>תאריך פנייה</th>
                        <th>מספר מכרז</th>
                        <th>שם הפונה</th>
                        <th>מספר טלפון נייד</th>
                        <th class="qualification-column">השכלה ודרישות מקצועיות</th>
                        <th class="qualification-column">ניסיון ניהולי</th>
                        <th class="qualification-column">ניסיון מקצועי</th>
                        <th class="qualification-column">דרישות נוספות</th>
                        <th>מבחן חובה</th>
						<th>סטטוס</th>
                        <th>פעולות</th>
                    </thead>
                    <tbody>
                        @if (!empty($list))
                            @foreach ($list as $key => $line)
                                @php
                                    // $tender = App\Models\Tender::where('generated_id', $line->tenderval)->first();
                                    $applications = App\Models\AppDecisions::find($line->id);
                                @endphp
                                <input type="hidden" name="appid_input" id="appid_input{{ $key }}"
                                    value="{{ $line->id }}">
                                <tr class="<?php echo $line->app_status == 'New' ? 'new' : ''; ?>">
                                    <td><input type="checkbox" name="send_all" data-val="{{ $line->id }}"></td>
                                    <td>{{ date('d/m/Y', strtotime($line->crdate)) }} </td>
                                    <td style="cursor:pointer;"
                                        onClick="javascript:window.location.href='/admin/tenders/application/{{ $line->id }}'">
                                        {{ $line->tender_number }}</td>
                                    <td>{{ $line->applicant_name }} <span class="star-btn cursor-pointer" data-id="{{ $line->id }}"><i class="fas fa-star @if ($startList[$key]) started @endif"></i></span></td>
                                    <td>{{ $line->phone }}</td>
                                    {{-- Education and professional requirements --}}
                                    <td class="qualification-column" style="color: black;">
                                        @if(isset($qualificationsData[$line->id]['education']) && $qualificationsData[$line->id]['education']['qualification_type'] !== 'לא הוגדר')
                                            @php
                                                $qualData = $qualificationsData[$line->id]['education'];
                                                $qualificationType = $qualData['qualification_type'] ?? 'לא הוגדר';
                                                $fileStatus = $qualData['file_status'] ?? 'לא הוגדר';
                                            @endphp
                                            <div style="color: black;">
                                                <strong>{{ $qualificationType }}</strong><br>
                                                {{ $fileStatus }}
                                            </div>
                                        @else
                                            <div style="color: black;">
                                                לא הוגדר
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Management experience --}}
                                    <td class="qualification-column" style="color: black;">
                                        @if(isset($qualificationsData[$line->id]['management_experience']) && $qualificationsData[$line->id]['management_experience']['qualification_type'] !== 'לא הוגדר')
                                            @php
                                                $qualData = $qualificationsData[$line->id]['management_experience'];
                                                $qualificationType = $qualData['qualification_type'] ?? 'לא הוגדר';
                                                $fileStatus = $qualData['file_status'] ?? 'לא הוגדר';
                                            @endphp
                                            <div style="color: black;">
                                                <strong>{{ $qualificationType }}</strong><br>
                                                {{ $fileStatus }}
                                            </div>
                                        @else
                                            <div style="color: black;">
                                                לא הוגדר
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Professional experience --}}
                                    <td class="qualification-column" style="color: black;">
                                        @if(isset($qualificationsData[$line->id]['professional_experience']) && $qualificationsData[$line->id]['professional_experience']['qualification_type'] !== 'לא הוגדר')
                                            @php
                                                $qualData = $qualificationsData[$line->id]['professional_experience'];
                                                $qualificationType = $qualData['qualification_type'] ?? 'לא הוגדר';
                                                $fileStatus = $qualData['file_status'] ?? 'לא הוגדר';
                                            @endphp
                                            <div style="color: black;">
                                                <strong>{{ $qualificationType }}</strong><br>
                                                {{ $fileStatus }}
                                            </div>
                                        @else
                                            <div style="color: black;">
                                                לא הוגדר
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Additional requirements --}}
                                    <td class="qualification-column" style="color: black;">
                                        @if(isset($qualificationsData[$line->id]['additional_requirements']) && $qualificationsData[$line->id]['additional_requirements']['qualification_type'] !== 'לא הוגדר')
                                            @php
                                                $qualData = $qualificationsData[$line->id]['additional_requirements'];
                                                $qualificationType = $qualData['qualification_type'] ?? 'לא הוגדר';
                                                $fileStatus = $qualData['file_status'] ?? 'לא הוגדר';
                                            @endphp
                                            <div style="color: black;">
                                                <strong>{{ $qualificationType }}</strong><br>
                                                {{ $fileStatus }}
                                            </div>
                                        @else
                                            <div style="color: black;">
                                                לא הוגדר
                                            </div>
                                        @endif
                                    </td>
                                    {{-- Mandatory test --}}
                                    <td>
                                        {{-- Check if test file is uploaded --}}
                                        @php
                                            $testFileUploaded = false;
                                            if($applications && $applications->files) {
                                                foreach($applications->files as $file) {
                                                    if($file->type === 'mandatory_test' || strpos($file->file_name, 'מבחן') !== false || strpos($file->file_name, 'test') !== false) {
                                                        $testFileUploaded = true;
                                                        break;
                                                    }
                                                }
                                            }
                                        @endphp
                                        @if($line->is_test_required || $testFileUploaded)
                                            <div><strong>{{ $qualificationsData[$line->id]['mandatory_test']['status'] }}</strong></div>
                                            @if ($applications?->test_result === 0)
                                                <span class="badge badge-danger">נכשל</span>
                                            @elseif ($applications?->test_result === 1)
                                                <span class="badge badge-success">עבר</span>
                                                <div class="input-group mt-1">
                                                    <input class="form-control" type="text" value="{{ $applications->grade }}" name="grade" id="testResultGrade{{ $applications?->id }}" placeholder="ציון">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-info grade-save-btn" data-id="{{ $applications?->id }}"><i class="fas fa-check"></i></button>
                                                    </div>
                                                </div>
                                            @else
                                                <select onchange="confirm('האם אתה בטוח?')" name="testResult" data-id="{{ $applications?->id }}" id="testResultSelect" class="form-control">
                                                    <option @selected($applications->test_result) value="">אין תוצאה</option>
                                                    <option @selected($applications->test_result) value="1">עבר</option>
                                                    <option @selected($applications->test_result) value="0">נכשל</option>
                                                </select>
                                            @endif

                                            <div class="mt-1">
                                                @if($testFileUploaded)
                                                    <small class="text-success">מצורף</small>
                                                    {{-- Show uploaded test files --}}
                                                    @if($applications && $applications->files)
                                                        @foreach($applications->files as $file)
                                                            @if($file->type === 'mandatory_test' || strpos($file->file_name, 'מבחן_חובה') !== false)
                                                                <br><a href="{{ asset('upload/admin/' . $file->url) }}" target="_blank" class="text-primary">
                                                                    <i class="fas fa-file"></i> קובץ מבחן
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @else
                                                    <small class="text-black">לא מצורף</small>
                                                @endif
                                            </div>
                                        @else
                                            <span class="badge badge-secondary">לא חובה</span>
                                        @endif
                                    </td>
									<td>
                                        @php
                                            // Get Hebrew status label from the statuses array
                                            $hebrewStatus = $statuses[$line->app_status] ?? $line->app_status;
                                        @endphp
                                        {{ $hebrewStatus }}
                                    </td>
                                    <td style="padding: 8px; text-align: center;">
                                        @if (\App\User::check_auth_user_permission(2))
                                            <a href="#" onclick="remove_app(this, {{ $line->id }})" class="remove-btn1" title="מחיקה" style="text-decoration: none;">
                                                <i class="fas fa-trash text-danger"></i>
                                            </a>
                                        @endif
                                        <a href="#" onclick="open_logs(this, {{ $line->id }})" class="openlogs-btn1 ml-2" title="יומן" style="text-decoration: none; padding-right:20px;">
                                            <i class="fas fa-book text-info"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        @if (!empty($list))
                            <tr class="sky-paginate">
                                <td colspan="2">

                                    <div class="footer-menu sky-rtl">
                                        סה”כ פניות: {{ count($list) }} / {{ $count }}
                                    </div>
                                </td>
                                <td colspan="4">
                                    @for ($i = 0; $i < $total_pages; $i++)
                                        <a class="pages {{ $i == $page_num ? 'active_page' : '' }}" href="#"
                                            onClick="$.fn.gopageR({{ $i }})">{{ $i }}</a>
                                    @endfor
                                </td>

                            </tr>
                        @endif
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="input-control">

            <!--<a href="/admin/tenders/cvfiledownload" class="btn" style="height:25px; margin-left: 10px;" id="download-cv-app-ids">הורדת כלל הקורות חיים</a>-->

            <select id="download-cv-app-ids">
                <option value="0">--בחר--</option>
                <option value="1">לפי צ'ק בוקס</option>
                <option value="2">עמידה בתנאי סף</option>
                <option value="3">זומן לראיון</option>
            </select>

            <select class="send_all">
                <option value="0">--בחר--</option>
                <option value="approve0a">בלי ציפיות שכר</option>
                <option value="reject2">דחייה רגילה</option>
                <option value="reject0a">ביטול ההליך המכרזי</option>
                <option value="reject0d">פרסום נוסף של המכרז</option>
                <option value="reject3">אי זימון למכרז</option>
                <option value="approve5">מעבר שלב א</option>
                <option value="approve4">מצריך מבדק מהימנות</option>
                <option value="approve3">קבלת מועמד</option>
                <option value="approve2">כשיר 2</option>
                <option value="approve1">כשיר 3</option>
                <option value="committee">זימון לוועדה</option>
            </select>
            <div class="meeting">
                <input type="checkbox" name="committee_meeting" id="pluse_meeting_minutes_check" value="4">
                <label for="pluse_meeting_minutes_check">כמה דקות תהיה ההפסקה</label>
                <input type="checkbox" name="committee_meeting" id="pluse_meeting_check" value="3">
                <label for="pluse_meeting_check">אחרי כמה פגישות תהיה לנו הפסקה</label>
                <input type="checkbox" name="committee_meeting" id="meeting_minutes_check" value="2">
                <label for="meeting_minutes_check">כמה דקות כל פגישה</label>
                <input type="checkbox" name="committee_meeting" id="start_hour_check" value="1">
                <label for="start_hour_check">שעה שאנחנו מתחילים</label>
            </div>
            <div id="start_hour_data" class="meeting-data">
                <div class="input-control">
                    <input type="date" name="meeting_date" id="meeting_date" placeholder="Enter date">
                </div>
                <div class="input-control">
                    <input type="time" name="meeting_time" id="meeting_time" placeholder="Enter time">
                </div>
                <div class="input-control">
                    <input type="text" name="meeting_location" id="meeting_location" placeholder="Enter location">
                </div>
                <label for="start_hour">שעה שאנחנו מתחילים</label>
            </div>
            <div id="meeting_minutes_data" class="meeting-data">
                <div class="input-control">
                    <input type="number" min="0" name="minutes" id="minutes" placeholder="Enter minutes">
                </div>
                <label for="meeting_minutes">כמה דקות כל פגישה</label>
            </div>
            <div id="pluse_meeting_data" class="meeting-data">
                <div class="input-control">
                    <input type="number" min="0" name="pluse_meeting_value" id="pluse_meeting_input" placeholder="Enter number">
                </div>
                <label for="pluse_meeting_input">אחרי כמה פגישות תהיה לנו הפסקה</label>
            </div>
            <div id="pluse_meeting_minutes_data" class="meeting-data">
                <div class="input-control">
                    <input type="number" min="0" name="pluse_meeting_time_value" id="pluse_meeting_time_input" placeholder="Enter minutes">
                </div>
                <label for="pluse_meeting_time_input">כמה דקות תהיה ההפסקה</label>
            </div>
        </div>
        <div class="outer" style="display: inline-block;">
            <button class="btn" style="height:25px; padding: 0; margin-top: 0;" id="add-user-outapp-form">לחץ למייל
                משתנה</button>
            <button class="btn" style="height:25px; padding: 0; margin-top: 0; margin-left: 10px;" id="send-committee-email">שלח</button>
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
@endsection
