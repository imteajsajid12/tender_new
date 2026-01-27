@extends('forms.layouts.protocol-header')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        /* Full page layout styles */
        body {
            margin: 0;
            padding: 0;
            width: 100vw;
            min-height: 100vh;
            background-color: white !important;
            color: black !important;
        }

        /* Override the container class from the layout to make it full width */
        .container {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
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

        .navigation-links {
            margin: 20px 0;
            text-align: center;
        }

        .navigation-links a {
            margin: 0 10px;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }

        .navigation-links a:hover {
            color: white;
            text-decoration: none;
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

            .navigation-links {
                display: none !important;
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

        .file-title {
            display: inline-block;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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

        /* Badge styles for qualifications */
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

    <div class="content-wrapper">
        <div dir="rtl" class="text-center">
            <h3 class="text-center font-weight-bold" style="color: #000080; margin-bottom: 20px; margin-top: 1rem;">
                טבלת מועמדים - פרוטוקול ועדת בחינה מספר {{ $tender->tender_number }}
            </h3>
            <h4 class="text-center" style="margin-bottom: 20px;">
                שם הרשות המקומית: מועצה מקומית קרית ארבע
            </h4>
            <h4 class="text-center">
                תאריך הועדה: {{ date('d/m/Y') }}
            </h4>
        </div>

        <!-- Navigation Links -->
        <div class="navigation-links d-print-none">
            <a class="btn btn-info" href="/protocol?tenderid={{ $tid }}&tname={{ $tname }}" target="_blank">
                צפייה בפרוטוקול המלא
            </a>
            <a class="btn btn-info" href="javascript:window.print()">
                הדפסת הטבלה
            </a>
        </div>

        <div class="row" dir="rtl" style="font-size: 13px;">
            <div class="col-12">
                <div class="w-100">
                    <h4 class="text-right">רשימת מועמדים: </h4>

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
									@php
										$appIds = [];
									@endphp
                                    <tr>
                                        {{-- 1. Appear/Did not appear (combined column) --}}
                                        <td>
                                            @if ($application->is_appeared)
                                                <strong>הופיע ✓</strong>
                                            @else
                                                <strong>לא הופיע ✓</strong>
                                            @endif
                                        </td>

                                        {{-- 2. Order time with hour only --}}
                                        <td>
                                            @if (isset($date) && isset($time))
                                                {{ $time }}
                                            @else
                                                @php
                                                    $metaHourArr = [];
                                                    $invitation = DB::table('apps_meta')
                                                        ->select('meta_value')
                                                        ->where([
                                                            ['app_id', '=', $application->id],
                                                            ['meta_name', '=', 'committee'],
                                                        ])
                                                        ->first();

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
                                        <td><strong>{{ $application->applicant_name }}</strong></td>

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
											// Use ONLY files categorized for education from qualificationsData
											$files = (is_array($qualificationsData[$application->id]['education']['files']) && count($qualificationsData[$application->id]['education']['files']) > 0) ? $qualificationsData[$application->id]['education']['files'] : [];

											@endphp



											{{-- Show files for education --}}
											@foreach ($files as $file)
											@php
											// Skip CV files
											if ($file->is_cv == 1) continue;

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
											@endphp
											@php array_push($appIds, $file->id); @endphp
											<a href="{{ asset('upload/' . $file->url) }}" target="_blank" title="{{ $displayName }}">
												{{ $displayName }}
											</a><br>
											@endforeach
											@else
											<div style="color: black;"></div>
											@endif
										</td>										{{-- 8. Management experience --}}
										<td>
											{{-- Status display commented out as requested --}}
											@if (isset($qualificationsData[$application->id]['management_experience']['required']) &&
											$qualificationsData[$application->id]['management_experience']['required'] != "לא הוגדר")
											<div style="color: black;">
												<strong>{{$qualificationsData[$application->id]['management_experience']['required'] }}</strong>

											</div>

											@php
											// Use ONLY files categorized for management_experience from qualificationsData
											$files = (is_array($qualificationsData[$application->id]['management_experience']['files']) && count($qualificationsData[$application->id]['management_experience']['files']) > 0) ? $qualificationsData[$application->id]['management_experience']['files'] : [];

											@endphp

											{{-- Show files for management experience --}}
											@foreach ($files as $file)
											@php
											// Skip CV files
											if ($file->is_cv == 1) continue;

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
											@endphp
											@php array_push($appIds, $file->id); @endphp
											<a href="{{ asset('upload/' . $file->url) }}" target="_blank" title="{{ $displayName }}">
												{{ $displayName }}
											</a><br>
											@endforeach

											@else
											<div style="color: black;"></div>
											@endif
										</td>

										{{-- 9. Professional experience --}}
										{{-- <td>


											@if (isset($qualificationsData[$application->id]['professional_experience']['required']) &&
											$qualificationsData[$application->id]['professional_experience']['required'] != "לא הוגדר")
											<div style="color: black;">
												<strong>{{$qualificationsData[$application->id]['professional_experience']['required'] }}</strong>

											</div>
											@php
											$hasProfessionalFiles = false;
											$files = (is_array($qualificationsData[$application->id]['professional_experience']['files']) && count($qualificationsData[$application->id]['professional_experience']['files']) > 0) ? $qualificationsData[$application->id]['professional_experience']['files'] : $application->files;

											@endphp


											@foreach ($files as $file)
											@php
											array_push($appIds, $file->id);
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
											<a href="{{ asset('upload/' . $file->url) }}" target="_blank" title="{{ $displayName }}">
												{{ $displayName }}
											</a><br>
											@endif
											@endforeach
											@else
											<div style="color: black;"></div>
											@endif
										</td> --}}


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

                                                {{-- Use ONLY files categorized for professional_experience from qualificationsData --}}
                                                @php
                                                    $files = (is_array($qualificationsData[$application->id]['professional_experience']['files']) && count($qualificationsData[$application->id]['professional_experience']['files']) > 0) ? $qualificationsData[$application->id]['professional_experience']['files'] : [];
                                                @endphp

                                                @foreach ($files as $file)
                                                    @php
                                                        // Skip CV files
                                                        if ($file->is_cv == 1) continue;

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
                                                    @endphp
                                                    @php array_push($appIds, $file->id); @endphp
                                                    <a href="{{ asset('upload/' . $file->url) }}" target="_blank" title="{{ $displayName }}">
                                                        {{ $displayName }}
                                                    </a><br>
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
											// Use ONLY files categorized for additional_requirements from qualificationsData
											$files = (is_array($qualificationsData[$application->id]['additional_requirements']['files']) && count($qualificationsData[$application->id]['additional_requirements']['files']) > 0) ? $qualificationsData[$application->id]['additional_requirements']['files'] : [];

											@endphp

											{{-- Show files for additional requirements --}}
											@foreach ($files as $file)
											@php
											// Skip CV files
											if ($file->is_cv == 1) continue;

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
											@endphp
											@php array_push($appIds, $file->id); @endphp
											<a href="{{ asset('upload/' . $file->url) }}" target="_blank" title="{{ $displayName }}">
												{{ $displayName }}
											</a><br>
											@endforeach
											@else
											<div style="color: black;"></div>
											@endif
										</td>

										{{-- 11. Additional files --}}
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
                                                    // dump($file_name_parts,$qualificationSection);
                                                    }
                                                    // Only show files that belong to additional_files section and are NOT already shown in other qualification columns
                                                    $shouldShow = $file->is_cv == 0 &&
                                                                    !in_array($qualificationSection, ['mandatory_test', 'cv']);
                                                @endphp
                                                @if ($shouldShow)
                                                    @if (!$hasDoubleCarets)

                                                        <a href="{{ asset('upload/' . $file->url) }}" target="_blank"
                                                            rel="noopener noreferrer" style="margin-bottom: 5px">
                                                            @php
                                                                // For files without ^^, show the original file name
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
                                                            @endphp
                                                            {{ $display_name }}
                                                        </a><br>
                                                    @else

                                                        @php
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
                                                        @endphp
                                                        <a href="{{ asset('upload/' . $file->url) }}" target="_blank"
                                                            rel="noopener noreferrer" style="margin-bottom: 5px">
                                                            {{ $display_name }}
                                                        </a><br>
                                                    @endif
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
                    הריני לאשר כי המועמדים הנ"ל הגישו מועמדותם בזמן כנדרש בנוסח המכרז שפורסם, וכי הם עומדים בדרישות הסף כפי
                    שפורסמו בנוסח המכרז. אביב דורות בן ארי
                </p>
            </div>
        </div>
    </div>

@endsection
