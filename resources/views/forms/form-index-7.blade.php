@extends('forms.layouts.protocol-header')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <?php
    $tenderid = 0;
    if ($_GET['tenderid'] != '') {
        $tenderid = $_GET['tenderid'];
    }
    $tname = '';
    if ($_GET['tname'] != '') {
        $tname = $_GET['tname'];
    }
    ?>

    <style>
        /* Full page layout styles */
        body {
            margin: 0px;
            padding: 0;
            /* width: 100vw; */
            min-height: 100vh;
            background-color: white !important;
            color: black !important;
        }

        /* Override the container class from the layout to make it full width */
        .container {
            width: 100% !important;
            max-width: 100% !important;
            padding: 10px !important;
            margin: 0 !important;
        }

        .container-fluid {
            width: 100%;
            max-width: 100%;
            padding: 0;
            margin: 0;
        }

        .content-wrapper {
            width: 100%;
            max-width: 100%;
            padding: 15px;
            margin: 0;
            box-sizing: border-box;
        }

        .free-input {
            border: none;
            border-bottom: 1px solid;
            outline: none;
        }

        .main-footer {
            width: 100%;
            padding-bottom: 20px !important;
        }

        .hidden-pdf:first-child {
            margin-top: 1rem !important;
        }

        /* Committee members container styles */
        .committee-members-container {
            border: 1px solid #333;
            background-color: white;
            margin: 20px 0;
        }

        .committee-member-row {
            display: flex;
            border-bottom: 1px solid #333;
            background-color: white;
        }

        .committee-member-row:last-child {
            border-bottom: none;
        }

        .member-number {
            width: 60px;
            min-width: 60px;
            padding: 8px;
            border-left: 1px solid #333;
            text-align: center;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            color: black;
        }

        .member-name {
            flex: 1;
            padding: 8px;
            border-left: 1px solid #333;
            font-size: 14px;
            display: flex;
            align-items: center;
            background-color: white;
            color: black;
            word-break: break-word;
        }

        .member-signature {
            width: 300px;
            min-width: 300px;
            padding: 8px;
            font-size: 14px;
            background-color: white;
            color: black;
        }

        /* Responsive table wrapper */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border: 1px solid #ddd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            table-layout: auto;
            background-color: white;
            min-width: 100%;
            /* Full width for responsive design */
        }

        table th,
        table td {
            border: 1px solid #333;
            padding: 6px;
            text-align: right;
            white-space: normal;
            word-break: break-word;
            background-color: white;
            color: black;
            font-size: 11px;
            vertical-align: top;
        }

        /* Column width specifications for 13 columns */
        table th:nth-child(1),
        table td:nth-child(1) {
            width: 8%;
        }

        /* הופיע / לא הופיע */
        table th:nth-child(2),
        table td:nth-child(2) {
            width: 6%;
        }

        /* שעת הזמנה */
        table th:nth-child(3),
        table td:nth-child(3) {
            width: 8%;
        }

        /* שם */
        table th:nth-child(4),
        table td:nth-child(4) {
            width: 6%;
        }

        /* טלפון */
        table th:nth-child(5),
        table td:nth-child(5) {
            width: 6%;
        }

        /* קורות חיים */
        table th:nth-child(6),
        table td:nth-child(6) {
            width: 6%;
        }

        /* טופס מועמד */
        table th:nth-child(7),
        table td:nth-child(7) {
            width: 10%;
        }

        /* דרישות השכלה */
        table th:nth-child(8),
        table td:nth-child(8) {
            width: 8%;
        }

        /* ניסיון ניהולי */
        table th:nth-child(9),
        table td:nth-child(9) {
            width: 8%;
        }

        /* ניסיון מקצועי */
        table th:nth-child(10),
        table td:nth-child(10) {
            width: 8%;
        }

        /* דרישות נוספות */
        table th:nth-child(11),
        table td:nth-child(11) {
            width: 8%;
        }

        /* קבצים נוספים */
        table th:nth-child(12),
        table td:nth-child(12) {
            width: 6%;
        }

        /* מבחן חובה */
        table th:nth-child(13),
        table td:nth-child(13) {
            width: 6%;
        }

        /* תעודת זהות */

        table th {
            background-color: white !important;
            color: black !important;
            font-weight: bold;
            border: 2px solid #333;
        }

        /* Enhanced print styles to ensure proper colors and show all table content */
        @media print {
            .d-print-none {
                display: none !important;
            }

            body {
                background-color: white !important;
                color: black !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }

            .content-wrapper {
                width: 100% !important;
                max-width: 100% !important;
                padding: 10px !important;
                margin: 0 !important;
            }

            /* Full width table for print */
            table {
                background-color: white !important;
                min-width: 100% !important;
                width: 100% !important;
                table-layout: auto !important;
            }

            table th,
            table td {
                background-color: white !important;
                color: black !important;
                border: 1px solid black !important;
                font-size: 8px !important;
                padding: 3px !important;
            }

            table th {
                background-color: white !important;
                color: black !important;
                font-weight: bold !important;
            }

            .table-responsive {
                overflow: visible !important;
                border: none !important;
                width: 100% !important;
                max-width: 100% !important;
            }

            .row {
                width: 100% !important;
                margin: 0 !important;
            }

            .col-auto,
            .col-12 {
                width: 100% !important;
                max-width: 100% !important;
                padding: 0 !important;
            }
        }

        /* Badge styles for qualifications */

        /* Signature table specific styles */
        .signature-table {
            min-width: auto !important;
            /* Override the global min-width for signature table */
            table-layout: fixed;
            width: 100%;
        }

        .signature-table td:first-child {
            width: 50px;
            /* Number column */
            text-align: center;
            vertical-align: middle;
        }

        .signature-table td:nth-child(2) {
            width: auto;
            /* Name column - flexible */
            min-width: 200px;
            vertical-align: middle;
        }

        .signature-table td:last-child {
            width: 300px;
            /* Signature column - fixed width */
            min-width: 300px;
            vertical-align: middle;
        }

        .signature-container {
            min-width: 280px;
            width: 100%;
            display: block;
            text-align: left;
            float: none !important;
            height: 98px;
            /* Remove float to prevent layout issues */
        }

        .signature-content {
            min-width: 200px;
            width: 100%;
            position: relative;
        }

        .signature-content canvas {
            width: 100%;
            height: 50px;
        }

        /* Ensure signature images are visible when they exist */
        .signature-content .img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 2;
        }

        .signature-content .img img {
            max-width: 100%;
            max-height: 50px;
            border: 1px solid #ccc;
        }

        .signature-table th:first-child {
            width: 70px;
            /* Number column header */
            text-align: center;
        }

        .signature-table th:nth-child(2) {
            width: auto;
            /* Name column header - flexible */
            min-width: 200px;
            text-align: center;
        }

        .signature-table th:last-child {
            width: 300px;
            /* Signature column header - fixed width */
            min-width: 300px;
            text-align: center;
        }

        .badge {
            font-size: 10px;
            padding: 2px 6px;
        }

        .badge-info {
            background-color: #17a2b8;
            color: white;
        }

        .badge-secondary {
            background-color: #6c757d;
            color: white;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }

        .badge-warning {
            background-color: #ffc107;
            color: black;
        }

        /* Additional overrides to ensure proper styling */
        body {
            background-color: white !important;
            color: black !important;
        }

        /* Override any Bootstrap or external CSS that might affect table colors */
        .table,
        .table-bordered {
            background-color: white !important;
            color: black !important;
        }

        .table th,
        .table td,
        .table-bordered th,
        .table-bordered td {
            background-color: white !important;
            color: black !important;
            border-color: #333 !important;
        }

        /* Full width layout overrides */
        .row {
            width: 100%;
            margin: 0;
        }

        .col-12,
        .col-auto {
            width: 100%;
            max-width: 100%;
            padding: 0 15px;
        }

        .w-100 {
            width: 100% !important;
        }

        /* Header and main content full width */
        #header6-7 {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 15px !important;
            margin: 0 !important;
        }

        main {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 10px;
            }

            table th,
            table td {
                font-size: 10px !important;
                padding: 4px !important;
            }

            #header6-7 {
                padding: 0 10px !important;
            }
        }
    </style>
    @if (!$download)
        {{-- <a onclick="confirm('Did you save the form? Save the form first, otherwise no text or signature will be appeared in downloaded pdf')"
            class="btn btn-block btn-info d-print-none" href="{{ url()->full() }}&download">פרוקוקול PDF</a> --}}

        <!-- Navigation Links -->
        <div class="d-print-none" style="margin: 15px 0; text-align: center;">
            <a href="/protocol-table?tenderid={{ $tenderid }}&tname={{ $tname }}" target="_blank"
                class="btn btn-info" style="margin: 0 5px;">
                צפייה בטבלת מועמדים בלבד
            </a>
            <a href="javascript:window.print()" class="btn btn-info" style="margin: 0 5px;">
                הדפסת הפרוטוקול המלא
            </a>
        </div>
    @endif

    {{-- Flash Messages with auto-hide and close button --}}
    @if (session('success'))
        <div id="flash-success" class="alert alert-success d-print-none" style="margin: 15px; text-align: center; padding: 12px 40px 12px 12px; background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; border-radius: 4px; position: relative; transition: opacity 0.3s ease;">
            <button type="button" onclick="closeFlashMessage('flash-success')" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background: none; border: none; font-size: 20px; font-weight: bold; color: #155724; cursor: pointer; line-height: 1;">&times;</button>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div id="flash-error" class="alert alert-danger d-print-none" style="margin: 15px; text-align: center; padding: 12px 40px 12px 12px; background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; border-radius: 4px; position: relative; transition: opacity 0.3s ease;">
            <button type="button" onclick="closeFlashMessage('flash-error')" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background: none; border: none; font-size: 20px; font-weight: bold; color: #721c24; cursor: pointer; line-height: 1;">&times;</button>
            {{ session('error') }}
        </div>
    @endif
    <script>
        function closeFlashMessage(id) {
            var el = document.getElementById(id);
            if (el) {
                el.style.opacity = '0';
                setTimeout(function() { el.style.display = 'none'; }, 300);
            }
        }
        // Auto-hide after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var success = document.getElementById('flash-success');
                var error = document.getElementById('flash-error');
                if (success) { success.style.opacity = '0'; setTimeout(function() { success.style.display = 'none'; }, 300); }
                if (error) { error.style.opacity = '0'; setTimeout(function() { error.style.display = 'none'; }, 300); }
            }, 5000);
        });
    </script>

    <input type="hidden" name="from_name" id="from_name" value="protocol" />
    <div class="content-wrapper">
        <div dir="rtl" class="text-center">
            <h3 class="text-center font-weight-bold" style="color: #000080; margin-bottom: 20px; margin-top: 1rem;">
                פרוטוקול ועדת בחינה מספר {{ $tender->tender_number }}
            </h3>
            <h4 class="text-center" style="margin-bottom: 20px;">
                שם הרשות המקומית: מועצה מקומית קרית ארבע
            </h4>
            <h4 class="text-center">
                תאריך הועדה: {{ date('d/m/Y') }}
            </h4>
        </div>
        <div class="text-right">

			@php
				// Detect if it's Tender or Job
				$isTender = ($tender->tender_type == 0);
				$label = $isTender ? 'מכרז' : 'משרה';

				// Internal / External text
				$typeText = match($tender->ttype) {
					1 => 'פנימי',          // Internal
					2 => 'חיצוני',         // External
					3 => 'פנימי/חיצוני',   // Both
					default => '',
				};
			@endphp

			<h4>תואר {{ $label }}: {{ $tender->tname }}</h4>
			<h4>היקף {{ $label }}: {{ $tender->job_scope }}</h4>
			<h4>דירוג {{ $label }}: {{ $tender->grades_voltage }}</h4>
			<h4>סוג {{ $label }}: {{ $typeText }}</h4>

		</div>





        <div class="row" dir="rtl">
            <div class="col-6">
                <div class="w-100">
                    {{-- <div class="table-responsive"><table>
								<tbody>
									@foreach ($tender->decisionMaker as $dm)
										<tr><td>{{ $loop->iteration }}</td>
										<td>{!! nl2br($dm->decision_maker) !!}</td></tr>

									@endforeach
								</tbody>
							</table></div> --}}


                    <div class="committee-members-container" style="max-width: 500px;">
                        @foreach ($tender->decisionMaker as $dm)
                            <div class="committee-member-row">
                                <!-- Number column -->
                                <div class="member-number">
                                    {{ $loop->iteration }}
                                </div>

                                <!-- Name column -->
                                <div class="member-name">
                                    {!! nl2br($dm->decision_maker) !!}
                                </div>

                                <!-- Signature column -->
                                <div class="member-signature">
                                    <div class="signature-container" style="text-align: left;">
                                        <span class="caption" style="vertical-align: bottom ; float: right;">חתימה:</span>
                                        <div class="signature-content" style="position: relative;">
                                            <canvas class="signature" height="50"
                                                style="touch-action: none;z-index: 1;position: relative;"></canvas>
                                            <span class="plesh_sig">
                                                נא תחתום כאן עם העכבר
                                            </span>
                                            <img class="signature-eraser" src="{{ asset('/front/img/eraser.png') }}" />
                                            <div class="img" @style([
                                                'display:none' => !$dm->signature,
                                                'display:block' => $dm->signature,
                                            ])>
                                                @if ($dm->signature)
                                                    <img src="{{ $dm->signature }}" alt="Signature" />
                                                @endif
                                            </div>
                                        </div>
                                        <input class="signature-text" value="{{ $dm->signature }}" type="text"
                                            name="moth_sign[{{ $dm->id }}]" tabindex="-1" required
                                            style="opacity: 0; width: 0.1px; height: 0.1px; margin: 0!important; display: inline-block;">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

        <form class="text-right" method="POST" action="{{ route('saveDecision', $tenderid) }}">
            <div class="row" dir="rtl" style="font-size: 13px;">
                <div class="col-12">
                    <div class="w-100">
                        <div style="margin-bottom: 20px; font-size: 14px;">
                            <p style="margin-bottom: 10px;">
                                - הרכב הועדה יותאם לאמור בנספח ו' להנחיות משרד הפנים מיום 9/12/2010 ותקנת העיריות מיום
                                01/05/2021
                            </p>
                            <p>
                                - במידה וקיימת קרבת משפחה בין אחד מבחרי הועדה לאחר המועמדים או בעיה אחרת של ניגוד עניינים,
                                הרי
                                שעל חבר הועדה לפסול עצמו מלהשתתף בועדה זו.
                            </p>
                        </div>

                        <h4>רשימת מועמדים: </h4>

                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <th>הופיע / לא הופיע</th>
                                    <th>שעת הזמנה</th>
                                    <th>שם</th>
                                    <th>טלפון</th>
                                    <th>קורות חיים</th>
                                    <th>טופס מועמד</th>
                                    <th>דרישות השכלה</th>
                                    <th>ניסיון ניהולי</th>
                                    <th>ניסיון מקצועי</th>
                                    <th>דרישות נוספות</th>
                                    <th>קבצים נוספים</th>
                                    <th>מבחן חובה</th>
                                    <th>תעודת זהות</th>
                                </thead>
                                <tbody>
                                    @foreach ($tender->applications as $application)
                                        <tr>
                                            @php
                                                $appIds = [];
                                            @endphp
                                            {{-- 1. Appear/Did not appear (combined column) --}}
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 10px;">
                                                    <label style="display: inline-flex; align-items: center; margin: 0;">
                                                        <input @checked($application->is_appeared) name="appeared[{{ $application->id }}]"
                                                            type="radio" value="1" style="margin-left: 5px;">
                                                        <span>הופיע</span>
                                                    </label>
                                                    <label style="display: inline-flex; align-items: center; margin: 0;">
                                                        <input @checked(!$application->is_appeared) name="appeared[{{ $application->id }}]"
                                                            type="radio" value="0" style="margin-left: 5px;">
                                                        <span>לא הופיע</span>
                                                    </label>
                                                </div>
                                            </td>

                                            {{-- 2. Order time with hour only --}}
                                            <td>
                                                @if (isset($date) && isset($time))
                                                    {{ $time }}
                                                @else
                                                    @php
                                                        $metaHourArr = [];
                                                        if (!empty($invitation) && !empty($invitation->meta_value)) {
                                                            $metaArr = explode("@#$#@", $invitation->meta_value);
                                                            if (isset($metaArr[0], $metaArr[1])) {
                                                                $metaTypeArr = explode(',', $metaArr[0]);
                                                                $metaDataArr = explode(',', $metaArr[1]);
                                                                $index = array_search(1, $metaTypeArr);
                                                                if ($index !== false && isset($metaDataArr[$index])) {
                                                                    $metaHour = $metaDataArr[$index];
                                                                    $metaHourArr = explode('###', $metaHour);
                                                                }
                                                            }
                                                        }
                                                        $timeText = isset($metaHourArr[1]) ? $metaHourArr[1] : 'N/A';
                                                        echo $timeText;
                                                    @endphp
                                                @endif
                                            </td>

                                            {{-- 3. Name --}}
                                            <td>{{ $application->applicant_name }}</td>

                                            {{-- 4. Phone --}}
                                            <td>{{ $application->phone }}</td>

                                            {{-- 5. Resume --}}
                                            <td>
                                                @foreach ($application->files as $file)
                                                    @if (str_ends_with($file->file_name, 'קורות חיים') || $file->is_cv)
                                                        <a target="_blank" href="{{ asset('upload/' . $file->url) }}">קורות
                                                            חיים</a>
                                                        @break
                                                    @endif
                                                @endforeach
                                            </td>

                                            {{-- 6. Candidate form (link to blue form) --}}
                                            <td>
                                                {{-- <a href="/admin/tenders/application/{{ $application->id }}"
                                                    target="_blank">טופס מועמד</a> --}}

                                                <a href="{{ asset('upload/' . $application->files[0]->url) }}" target="_blank">טופס
                                                    מועמד</a>

                                            </td>

                                            {{-- 7. Educational requirements --}}
                                            <td>
                                                {{-- Status display commented out as requested --}}
                                                @if (isset($qualificationsData[$application->id]['education']['required']) &&
                                                        $qualificationsData[$application->id]['education']['required'] != "לא הוגדר")
                                                    <div style="color: black;">
                                                        <strong>{{$qualificationsData[$application->id]['education']['required'] }}</strong>

                                                    </div>
                                                    @php
                                                        $hasEducationFiles = false;
                                                        $files = (is_array($qualificationsData[$application->id]['education']['files']) && count($qualificationsData[$application->id]['education']['files']) > 0) ? $qualificationsData[$application->id]['education']['files'] : $application->files;

                                                    @endphp



                                                    {{-- Show files for education --}}
                                                    @foreach ($files as $file)
                                                        @php
                                                            $displayName = $file->input_field_label ?? '';
                                                            if (empty($displayName)) {
                                                                $file_name_parts = explode('^^', $file->file_name);
                                                                if (count($file_name_parts) > 1) {
                                                                    $displayName = $file_name_parts[1];
                                                                } elseif (count($file_name_parts) > 0) {
                                                                    $firstPart = $file_name_parts[0];
                                                                    if (strpos($firstPart, '@') !== false) {
                                                                        $afterAt = explode('@', $firstPart)[1];
                                                                        $displayName = strpos($afterAt, '#') !== false ? explode('#', $afterAt)[1] : $afterAt;
                                                                    } else {
                                                                        $displayName = $firstPart;
                                                                    }
                                                                }
                                                            }
                                                            $shouldShow = ($file->is_cv == 0 || $file->is_cv === null);
                                                        @endphp
                                                        @if ($shouldShow)
                                                            @php array_push($appIds, $file->id); @endphp
                                                            <a href="{{ asset('upload/' . $file->url) }}" target="_blank" title="{{ $displayName }}">
                                                                {{ $displayName }}
                                                            </a><br>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div style="color: black;"></div>
                                                @endif
                                            </td>

                                            {{-- 8. Management experience --}}
                                            <td>
                                                {{-- Status display commented out as requested --}}
                                                @if (isset($qualificationsData[$application->id]['management_experience']['required']) &&
                                                        $qualificationsData[$application->id]['management_experience']['required'] != "לא הוגדר")
                                                    <div style="color: black;">
                                                        <strong>{{$qualificationsData[$application->id]['management_experience']['required'] }}</strong>

                                                    </div>

                                                    @php
                                                        $hasManagementFiles = false;
                                                        $files = (is_array($qualificationsData[$application->id]['management_experience']['files']) && count($qualificationsData[$application->id]['management_experience']['files']) > 0) ? $qualificationsData[$application->id]['management_experience']['files'] : $application->files;

                                                    @endphp

                                                    {{-- Show files for management experience --}}
                                                    @foreach ($files as $file)
                                                        @php
                                                            $displayName = $file->input_field_label ?? '';
                                                            if (empty($displayName)) {
                                                                $file_name_parts = explode('^^', $file->file_name);
                                                                if (count($file_name_parts) > 1) {
                                                                    $displayName = $file_name_parts[1];
                                                                } elseif (count($file_name_parts) > 0) {
                                                                    $firstPart = $file_name_parts[0];
                                                                    if (strpos($firstPart, '@') !== false) {
                                                                        $afterAt = explode('@', $firstPart)[1];
                                                                        $displayName = strpos($afterAt, '#') !== false ? explode('#', $afterAt)[1] : $afterAt;
                                                                    } else {
                                                                        $displayName = $firstPart;
                                                                    }
                                                                }
                                                            }
                                                            $shouldShow = ($file->is_cv == 0 || $file->is_cv === null);
                                                        @endphp
                                                        @if ($shouldShow)
                                                            @php array_push($appIds, $file->id); @endphp
                                                            <a href="{{ asset('upload/' . $file->url) }}" target="_blank" title="{{ $displayName }}">
                                                                {{ $displayName }}
                                                            </a><br>
                                                        @endif
                                                    @endforeach

                                                @else
                                                    <div style="color: black;"></div>
                                                @endif
                                            </td>



                                            
                                            {{-- 9. ניסיון מקצועי - Professional Experience --}}
                                          <td>
                                                @php
                                                    // Show qualification requirement if defined
                                                    $showProfReq = isset($qualificationsData[$application->id]['professional_experience']['required']) &&
                                                        $qualificationsData[$application->id]['professional_experience']['required'] != "לא הוגדר";
                                                @endphp

                                                @if ($showProfReq)
                                                    <div style="color: black;">
                                                        <strong>{{ $qualificationsData[$application->id]['professional_experience']['required'] }}</strong>
                                                    </div>
                                                @endif

                                                {{-- Show ONLY ניסיון מקצועי in this column --}}
                                                @foreach ($application->files as $file)
                                                    @php
                                                        // Skip CV and test files
                                                        if ($file->is_cv == 1) continue;
                                                        if ($file->type === 'mandatory_test') continue;

                                                        // resolve display name
                                                        $displayName = $file->input_field_label ?? '';
                                                        if (empty($displayName)) {
                                                            $file_name_parts = explode('^^', $file->file_name);
                                                            if (count($file_name_parts) > 1) {
                                                                $displayName = $file_name_parts[1];
                                                            } elseif (count($file_name_parts) > 0) {
                                                                $firstPart = $file_name_parts[0];
                                                                if (strpos($firstPart, '@') !== false) {
                                                                    $afterAt = explode('@', $firstPart)[1];
                                                                    $displayName = strpos($afterAt, '#') !== false ? explode('#', $afterAt)[1] : $afterAt;
                                                                } else {
                                                                    $displayName = $firstPart;
                                                                }
                                                            }
                                                        }


                                                        // Check if this file should be shown in ניסיון מקצועי column
                                                        $isNisayonMekzoei = false;

                                                        // match in display label
                                                        if (
                                                            strpos(trim($displayName), 'ניסיון מקצועי') !== false ||
                                                            strpos(trim($displayName), 'נסיון מקצועי') !== false
                                                        ) {
                                                            $isNisayonMekzoei = true;
                                                        }

                                                        // match in file name
                                                        if (
                                                            strpos($file->file_name, 'ניסיון מקצועי') !== false ||
                                                            strpos($file->file_name, 'נסיון מקצועי') !== false
                                                        ) {
                                                            $isNisayonMekzoei = true;
                                                        }

                                                        // NOTE: Removed input_field_name === 'professional_experience' check
                                                        // because multiple files can have this field name but should be shown
                                                        // in different columns based on their actual display name

                                                        $shouldShow = $isNisayonMekzoei;
                                                        $finalDisplayName = 'ניסיון מקצועי';
                                                    @endphp

                                                    @if ($shouldShow)
                                                        @php array_push($appIds, $file->id); @endphp
                                                        <a href="{{ asset('upload/' . $file->url) }}" target="_blank" title="{{ $finalDisplayName }}">
                                                            {{ $finalDisplayName }}
                                                        </a><br>
                                                    @endif
                                                @endforeach
                                            </td>


                                            {{-- 10. Additional requirements --}}
                                            <td>
                                                {{-- Status display commented out as requested --}}

												@if (isset($qualificationsData[$application->id]['additional_requirements']['required']) &&
                                                        $qualificationsData[$application->id]['additional_requirements']['required'] != "לא הוגדר")
                                                    <div style="color: black;">
                                                        <strong>{{$qualificationsData[$application->id]['additional_requirements']['required'] }}</strong>

                                                    </div>
                                                    @php
                                                        $hasAdditionalRequirementsFiles = false;
                                                        $files = (is_array($qualificationsData[$application->id]['additional_requirements']['files']) && count($qualificationsData[$application->id]['additional_requirements']['files']) > 0) ? $qualificationsData[$application->id]['additional_requirements']['files'] : $application->files;

                                                    @endphp

                                                    {{-- Show files for additional requirements --}}
                                                    @foreach ($files as $file)
                                                        @php
                                                            $displayName = $file->input_field_label ?? '';
                                                            if (empty($displayName)) {
                                                                $file_name_parts = explode('^^', $file->file_name);
                                                                if (count($file_name_parts) > 1) {
                                                                    $displayName = $file_name_parts[1];
                                                                } elseif (count($file_name_parts) > 0) {
                                                                    $firstPart = $file_name_parts[0];
                                                                    if (strpos($firstPart, '@') !== false) {
                                                                        $afterAt = explode('@', $firstPart)[1];
                                                                        $displayName = strpos($afterAt, '#') !== false ? explode('#', $afterAt)[1] : $afterAt;
                                                                    } else {
                                                                        $displayName = $firstPart;
                                                                    }
                                                                }
                                                            }
                                                            $shouldShow = ($file->is_cv == 0 || $file->is_cv === null) ;
                                                        @endphp
                                                        @if ($shouldShow)
                                                            @php array_push($appIds, $file->id); @endphp
                                                            <a href="{{ asset('upload/' . $file->url) }}" target="_blank" title="{{ $displayName }}">
                                                                {{ $displayName }}
                                                            </a><br>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div style="color: black;"></div>
                                                @endif
                                            </td>

                                            {{-- 11. Additional files - Excludes אישור העסקה and נסיון ניהולי --}}
                                            {{-- <td>
                                                @foreach ($application->files->whereNotIn('id', $appIds) as $file)
                                                    @continue($application->files[0]->id == $file->id)
                                                    @php
                                                        // Check if file contains ^^ and determine qualification section
                                                        $hasDoubleCarets = strpos($file->file_name, '^^') !== false;
                                                        $qualificationSection = 'additional_files'; // Default

                                                        if ($hasDoubleCarets) {
                                                            $file_name_parts = explode('^^', $file->file_name);
                                                            // Check if we have the new qualification section identifier (third part)
                                                            if (count($file_name_parts) > 2) {
                                                                $qualificationSection = $file_name_parts[2];
                                                            } else {
                                                                // Fallback to old logic for existing files
                                                                $secondPart = count($file_name_parts) > 1 ? $file_name_parts[1] : '';
                                                                if (strpos($secondPart, 'מבחן') !== false) {
                                                                    $qualificationSection = 'mandatory_test';
                                                                } elseif (strpos($secondPart, 'קורות חיים') !== false) {
                                                                    $qualificationSection = 'cv';
                                                                }
                                                            }
                                                        }

                                                        // Compute display name first for filtering
                                                        $display_name = $file->input_field_label ?? '';
                                                        if (empty($display_name)) {
                                                            $file_name_parts = explode('^^', $file->file_name);
                                                            if (count($file_name_parts) > 1) {
                                                                $display_name = $file_name_parts[1];
                                                            } elseif (count($file_name_parts) > 0) {
                                                                $firstPart = $file_name_parts[0];
                                                                if (strpos($firstPart, '@') !== false) {
                                                                    $afterAt = explode('@', $firstPart)[1];
                                                                    $display_name = strpos($afterAt, '#') !== false ? explode('#', $afterAt)[1] : $afterAt;
                                                                } else {
                                                                    $display_name = $firstPart;
                                                                }
                                                            }
                                                        }

                                                        // Files to EXCLUDE from this column (shown in Professional experience instead)
                                                        $excludedFromAdditionalFiles = ['אישור העסקה', 'נסיון ניהולי'];

                                                        // Only show files that belong to additional_files section, are NOT already shown in other qualification columns,
                                                        // and are NOT אישור העסקה or נסיון ניהולי
                                                        $shouldShow = $file->is_cv == 0 &&
                                                                      !in_array($qualificationSection, ['mandatory_test', 'cv']) &&
                                                                      !in_array(trim($display_name), $excludedFromAdditionalFiles);
                                                    @endphp
                                                    @if ($shouldShow)
                                                        <a href="{{ asset('upload/' . $file->url) }}" target="_blank"
                                                            rel="noopener noreferrer" style="margin-bottom: 5px">
                                                            {{ $display_name }}
                                                        </a><br>
                                                    @endif
                                                @endforeach
                                            </td> --}}
                                            {{-- 11. קבצים נוספים - Show ALL additional files not displayed in other columns --}}
                                            <td>
                                                @foreach ($application->files as $file)
                                                    @php
                                                        // Skip mandatory test files
                                                        if ($file->type === 'mandatory_test') continue;

                                                        // Skip CV files
                                                        if ($file->is_cv == 1) continue;

                                                        // Skip the first file (טופס מועמד)
                                                        if ($application->files->first() && $application->files->first()->id == $file->id) continue;

                                                        // Skip files already shown in other columns
                                                        if (in_array($file->id, $appIds)) continue;

                                                        // Get display name
                                                        $displayName = $file->input_field_label ?? '';
                                                        if (empty($displayName)) {
                                                            $file_name_parts = explode('^^', $file->file_name);
                                                            if (count($file_name_parts) > 1) {
                                                                $displayName = $file_name_parts[1];
                                                            } elseif (count($file_name_parts) > 0) {
                                                                $firstPart = $file_name_parts[0];
                                                                if (strpos($firstPart, '@') !== false) {
                                                                    $afterAt = explode('@', $firstPart)[1];
                                                                    $displayName = strpos($afterAt, '#') !== false ? explode('#', $afterAt)[1] : $afterAt;
                                                                } else {
                                                                    $displayName = $firstPart;
                                                                }
                                                            }
                                                        }


                                                        // Skip if CV by name
                                                        // if (strpos($displayName, 'קורות חיים') !== false ||
                                                        //     strpos($file->file_name, 'קורות חיים') !== false ||
                                                        //     strpos($file->file_name, 'קורות_חיים') !== false) continue;

                                                        // Skip test files by name
                                                        if (strpos($file->file_name, 'מבחן_חובה') !== false || strpos($file->file_name, 'מבחן חובה') !== false) continue;
                                                    @endphp
                                                    <a href="{{ asset('upload/' . $file->url) }}" target="_blank" title="{{ $displayName }}">
                                                        {{ $displayName }}
                                                    </a><br>
                                                @endforeach
                                            </td>


                                            {{-- 12. Mandatory test --}}
                                            <td>
                                                @if ($tender->is_test_required)
                                                    <div><strong>חובה</strong></div>
                                                    @php
                                                        $applications = App\Models\AppDecisions::find($application->id);
                                                    @endphp
                                                    @if ($applications?->test_result === 0)
                                                        <span class="badge badge-danger">נכשל</span>
                                                    @elseif ($applications?->test_result === 1)
                                                        <span class="badge badge-success">עבר</span>
                                                        @if ($applications->grade)
                                                            <div class="mt-1">ציון: {{ $applications->grade }}</div>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-warning">אין תוצאה</span>
                                                    @endif
                                                    {{-- Link to test file if uploaded --}}
                                                    @foreach ($application->files as $file)
                                                        @php
                                                            $isTestFile = false;

                                                            // Check if it's a test file by type
                                                            if ($file->type === 'mandatory_test') {
                                                                $isTestFile = true;
                                                            }

                                                            // Check if it's a test file by qualification section
                                                            if (strpos($file->file_name, '^^') !== false) {
                                                                $file_name_parts = explode('^^', $file->file_name);
                                                                if (count($file_name_parts) > 2 && $file_name_parts[2] === 'mandatory_test') {
                                                                    $isTestFile = true;
                                                                }
                                                            }

                                                            // Check if it's a test file by name content (exact Hebrew match only)
                                                            if (strpos($file->file_name, 'מבחן_חובה') !== false || strpos($file->file_name, 'מבחן חובה') !== false) {
                                                                $isTestFile = true;
                                                            }
                                                        @endphp
                                                        @if ($isTestFile)
                                                            @php
                                                                // Extract display name
                                                                $display_name = 'קובץ מבחן';
                                                                if (strpos($file->file_name, '^^') !== false) {
                                                                    $file_name_parts = explode('^^', $file->file_name);
                                                                    $firstPart = $file_name_parts[0];
                                                                    if (strpos($firstPart, '@') !== false) {
                                                                        $afterAt = explode('@', $firstPart)[1];
                                                                        if (strpos($afterAt, '#') !== false) {
                                                                            $display_name = explode('#', $afterAt)[1];
                                                                        } else {
                                                                            $display_name = $afterAt;
                                                                        }
                                                                    }
                                                                } else {
                                                                    $display_name = $file->file_name;
                                                                }
                                                            @endphp
                                                            <br><a href="{{ asset('upload/admin/' . $file->url) }}" target="_blank">{{ $display_name }}</a>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <span class="badge badge-secondary">לא חובה</span>
                                                @endif
                                            </td>

                                            {{-- 13. Identity card --}}
                                            <td>{{ $application->id_tz }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Static confirmation text -->
                <div class="col-12" style="margin-top: 30px; margin-bottom: 20px;">
                    <p style="text-align: right; font-size: 14px; line-height: 1.6;">
                        הריני לאשר כי המועמדים הנ"ל הגישו מועמדותם בזמן כנדרש בנוסח המכרז שפורסם, וכי הם עומדים בדרישות הסף
                        כפי
                        שפורסמו בנוסח המכרז. אביב דורות בן ארי
                    </p>
                </div>

                @csrf
                <input type="hidden" value="{{ $tenderid }}" name="tender_id">
                <div class="col-12">
                    החלטת הוועדה בתאריך: <input name="decision_on" value="{{ $tender?->decision?->decision_on }}"
                        type="text" class="free-input">
                </div>

                @php
                    $select_dec = json_decode($tender?->decision?->select_dec) ?? [];
                @endphp
                <div class="text-right" style="display: block; width: 100%;" dir="rtl">
                    <div style="margin-bottom: 20px;">
                        <div style="margin-bottom: 15px;">
                            <input type="checkbox" @checked(in_array(1, $select_dec)) name="select_dec[1]" value="1"
                                id="decision_1" style="margin-left: 10px;">
                            <label for="decision_1" style="font-size: 14px;">הוועדה החליטה לבחור במועמדים הבאים לסבב ראיון
                                נוסף, לאחר בחינת התאמה לתפקיד:</label>
                        </div>

                        <div style="margin-bottom: 15px;">
                            <input type="checkbox" @checked(in_array(2, $select_dec)) name="select_dec[2]" value="2"
                                id="decision_2" style="margin-left: 10px;">
                            <label for="decision_2" style="font-size: 14px;">הוועדה החליטה לבחור ב</label>
                            <input value="{{ $tender?->decision?->proposed_pos }}" name="proposed_pos" type="text"
                                class="free-input" style="width: 200px; margin: 0 5px;">
                            <span>למשרה המוצעת.</span>
                        </div>

                        <div style="margin-bottom: 15px;">
                            <input type="checkbox" @checked(in_array(3, $select_dec)) name="select_dec[3]" value="3"
                                id="decision_3" style="margin-left: 10px;">
                            <label for="decision_3" style="font-size: 14px;">כמו כן, בוחרת הוועדה את המועמד/ת</label>
                            <input value="{{ $tender?->decision?->second_pos }}" name="second_pos" type="text"
                                class="free-input" style="width: 200px; margin: 0 5px;">
                            <span>ככשיר/ה שני/ה.</span>
                        </div>

                        <div style="margin-bottom: 15px;">
                            <input type="checkbox" @checked(in_array(4, $select_dec)) name="select_dec[4]" value="4"
                                id="decision_4" style="margin-left: 10px;">
                            <label for="decision_4" style="font-size: 14px;">ואת המועמד/ת</label>
                            <input value="{{ $tender?->decision?->third_pos }}" name="third_pos" type="text"
                                class="free-input" style="width: 200px; margin: 0 5px;">
                            <span>ככשיר/ה שלישי/ת</span>
                        </div>

                        <div style="margin-bottom: 15px;">
                            <input type="checkbox" @checked(in_array(5, $select_dec)) name="select_dec[5]" value="5"
                                id="decision_5" style="margin-left: 10px;">
                            <label for="decision_5" style="font-size: 14px;">הוועדה החליטה שאף אחד מבין המועמדים אינו
                                מתאים
                                למשרה המוצעת.</label>
                        </div>

                        <!-- Family relation question -->
                        {{-- <div style="margin-bottom: 15px; display:flex; margin-top: 20px;">
                            <label style="font-size: 14px; display: block; margin-bottom: 10px;">
                                האם המועמד/ת שנבחר/ה הינו/ה קרוב/ת משפחה של אחד/ת מעובדי או נבחרי הרשות המקומית
                            </label>
                            <div style="display: inline-block; margin-right: 20px;">
                                <input type="radio" name="family_relation" value="yes" id="family_relation_yes"
                                    @checked(old('family_relation', $tender?->decision?->family_relation) == 'yes')
                                    style="margin-left: 5px;">
                                <label for="family_relation_yes" style="font-size: 14px;">כן</label>
                            </div>
                            <div style="display: inline-block;">
                                <input type="radio" name="family_relation" value="no" id="family_relation_no"
                                    @checked(old('family_relation', $tender?->decision?->family_relation) == 'no')
                                    style="margin-left: 5px;">
                                <label for="family_relation_no" style="font-size: 14px;">לא</label>
                            </div>
                        </div> --}}

                        <div style="
    margin: 20px 0;
    display: flex;
    align-items: center;
    direction: rtl;
    gap: 20px;
">

    <label style="
        font-size: 14px;
        white-space: nowrap;
    ">
        האם המועמד/ת שנבחר/ה הינו/ה קרוב/ת משפחה של אחד/ת מעובדי או נבחרי הרשות המקומית?
    </label>

    <label style="display: flex; align-items: center; font-size: 14px; cursor: pointer;">
        <input
            type="radio"
            name="family_relation"
            value="yes"
            id="family_relation_yes"
            @checked(old('family_relation', $tender?->decision?->family_relation) == 'yes')
            style="margin-left: 5px;"
        >
        כן
    </label>

    <label style="display: flex; align-items: center; font-size: 14px; cursor: pointer;">
        <input
            type="radio"
            name="family_relation"
            value="no"
            id="family_relation_no"
            @checked(old('family_relation', $tender?->decision?->family_relation) == 'no')
            style="margin-left: 5px;"
        >
        לא
    </label>

</div>

                    </div>
                    <div class="note">
                        <p>הרכב הוועדה יותאם לאמור</p>
                        <p>בנספח ו ולהנחיות משרד הפנים. במידה וקיימת קרבת משפחה בין אחד מחברי</p>
                        <p>הוועדה לאחד המומעדים או בעיה אחרת של ניגוד עניינים הרי שעל חבר הוועדה לפסול</p>
                        <p>עצמו מלהשתתף בוועדה זו.</p>
                        <p>הערות</p>

                    </div>
                    <textarea name="title_pos" class="free-input" rows="3" style="display: block; width: 50%;">{{ $tender?->decision?->title_pos }}</textarea>

                    <!-- Static copy text -->
                    <div style="margin-top: 30px; margin-bottom: 20px;">
                        <p style="font-size: 14px; font-weight: bold; margin-bottom: 10px;">העתק:</p>
                        <p style="font-size: 14px; margin-bottom: 5px;">תיק כח אדם</p>
                        <p style="font-size: 14px; margin-bottom: 5px;">תיק אישי – של המועמד שנבחר</p>
                    </div>
                </div>

                {{-- <div class="text-right" dir="rtl">
						<div class="">חתימת חברי וועדה</div>
						<div class="table-responsive"><table>
							<tbody>
								@foreach ($tender->decisionMaker as $dm)
									<tr><td>{{ $loop->iteration }}</td>
									<td>{!! nl2br($dm->decision_maker) !!}</td>
									<td class="w-50">
										<div class="signature-container"
                                    style="text-align: left;float: left; padding-bottom: 50px;">
                                    <span class="caption" style="vertical-align: bottom;">חתימה:</span>
                                    <div class="signature-content" style="position: relative;">
                                        <canvas class="signature" width="200" height="140"
                                            style="height: 140px;touch-action: none;z-index: 1;position: relative;"></canvas>
                                        <span class="plesh_sig">
                                            נא תחתום כאן עם העכבר
                                        </span>
                                        <img class="signature-eraser" src="{{ asset('/front/img/eraser.png') }}" />
                                    </div>
                                    <div class="img" @style([
										'display:none' => !$dm->signature,
										'display:block' => $dm->signature
									])>
										@if ($dm->signature)
										<img src="{{ $dm->signature }}" alt="" srcset="">
										@endif
									</div>
                                    <input class="signature-text" value="{{ $dm->signature }}" type="text" name="moth_sign[{{ $dm->id }}]" tabindex="-1"
                                        required
                                        style="opacity: 0; width: 0.1px; height: 0.1px; margin: 0!important; display: inline-block;">
                                </div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table></div>
					</div> --}}
                <div style="" class="w-100" dir="rtl">
                    @if (!$download)
                        <button style="width: 100%;font-size: 1.2em;" class="btn btn-lg btn-default success d-print-none"
                            id="reportSaveBtn" type="submit">שמור מסמך</button>
                        <br>
                    @endif
                    <div class="submit-error-msg"></div>
                </div>
        </form>
    </div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hide canvas and show signature images when signatures exist
        $('.signature-container').each(function() {
            var container = $(this);
            var signatureImg = container.find('.img img');
            var canvas = container.find('.signature');
            var pleshSig = container.find('.plesh_sig');

            if (signatureImg.length > 0 && signatureImg.attr('src')) {
                // Hide canvas and placeholder text when signature image exists
                canvas.hide();
                pleshSig.hide();
            }
        });
    });
</script>
