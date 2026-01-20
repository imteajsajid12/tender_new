<!DOCTYPE html>
<html dir="rtl" lang="he-IL">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="IE=11" />
    <meta http-equiv="Content-Language" content="he" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/img/favicon-16x16.png') }}">



    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front/css/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('front/css/pdf.css?v=3') }}" rel="stylesheet" />

    <style>
        body {
            background-color: white;
            color: black;
            line-height: 1.6;
            font-size: 12px !important;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .field-title {
            font-weight: bold;
            margin-bottom: 0.25rem;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .checkbox-mark {
            margin-left: 0.5rem;
            font-weight: bold;
        }

        .language-level {
            display: flex;
            margin-bottom: 0.5rem;
        }

        .language-level-title {
            width: 5rem;
        }

        .signature-area {
            margin-top: 3rem;
        }

        .notes {
            margin-top: 1rem;
            padding: 0.75rem;
            border: 1px solid #dee2e6;
            background-color: #f8f9fa;
            border-radius: 0.25rem;
        }

        @media print {
            .section {
                margin-bottom: 1.5rem;
            }

            .no-print-break {
                page-break-inside: avoid;
            }
        }

        .header-label {
            background-color: #734dfd;
            color: #000;
        }

        .col-label {
            background-color: #7bbddd;
            color: #000;
        }

        td,
        th {
            height: 16px;
            border: solid 1px #7bbddd;
            text-align: right;
            font-size: 12px !important;
        }
    </style>
</head>

<body>
    <div class="container mt-4 mb-5">
        <table class="table table-bordered" style="width: 100%">
            <!--<thead>
                <tr>
                    <th colspan="4" class="header-label">:שמות ממליצים</th>
                </tr>
            </thead> -->
            <tbody>
                <tr>
                    <td class="col-label" style="width: 25%">אני מגיש/ה את מועמדותי לתפקיד:</td>
                    <td colspan="3" style="width: 75% text-align: start">{{ $request->tname }}</td>
                </tr>

                <tr>
                    <td colspan="2" class="col-label" style="width: 50%">:אישיים פרטים</td>
                    <td colspan="2" class="col-label" style="width: 50%">שירות לאומי/ צבאי</td>
                </tr>
                <tr>
                    <td class="col-label" style="width: 25%">שם פרטי</td>
                    <td style="width: 25%">{{ $request->firstname }}</td>
                    <td class="col-label" style="width: 25%">מתאריך</td>
                    <td style="width: 25%">
                        @if (isset($request->military_from_date) && is_array($request->military_from_date))
                            {{ $request->military_from_date[0] ?? '' }}
                        @else
                            {{ $request->military_from_date ?? '' }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="col-label" style="width: 25%">שם משפחה</td>
                    <td style="width: 25%">{{ $request->lastname ?? '' }}</td>
                    <td class="col-label" style="width: 25%">עד תאריך</td>
                    <td style="width: 25%">
                        @if (isset($request->military_to_date) && is_array($request->military_to_date))
                            {{ $request->military_to_date[0] ?? '' }}
                        @else
                            {{ $request->military_to_date ?? '' }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="col-label" style="width: 25%">טלפון</td>
                    <td style="width: 25%; direction: ltr; ">
                        {{ $request->personal_phone_select . ' ' . $request->personal_phone }}</td>
                    <td class="col-label" style="width: 25%">תפקיד</td>
                    <td style="width: 25%">
                        @if (isset($request->military_roles) && is_array($request->military_roles))
                            {{ $request->military_roles[0] ?? '' }}
                        @else
                            {{ $request->military_roles ?? '' }}
                        @endif
                    </td>
                </tr>

                @php
                    // Function to calculate duration in months only (not years)
                    // Format: Total months only (e.g., 13, 14, 18 months)
                    // Rounding: days < 15 = 0 months, days >= 15 = 1 month
                    //
                    // Example: From 2023-12-01 to 2025-04-10 (1yr 4mo 9days) = 16 months
                    //          From 2023-12-01 to 2025-04-20 (1yr 4mo 19days) = 17 months (rounds up)
                    function calculateMilitaryDuration($fromDate, $toDate) {
                        if (empty($fromDate) || empty($toDate)) {
                            return 0;
                        }

                        try {
                            $start = \Carbon\Carbon::parse($fromDate);
                            $end = \Carbon\Carbon::parse($toDate);

                            // Use DateInterval for accurate calculation
                            $interval = $start->diff($end);

                            $years = $interval->y;
                            $months = $interval->m;
                            $days = $interval->d;

                            // Convert to total months
                            $totalMonths = ($years * 12) + $months;

                            // Apply rounding rule: days < 15 round down, days >= 15 round up
                            if ($days >= 15) {
                                $totalMonths += 1;
                            }

                            // Edge case: less than 15 days total = 0
                            if ($years === 0 && $months === 0 && $days < 15) {
                                return 0;
                            }

                            // Return total months only (e.g., 13, 14, 18) - not converted to years
                            return max(0, $totalMonths);
                        } catch (\Exception $e) {
                            return 0;
                        }
                    }

                    // Collect all military service entries with calculated durations
                    $militaryEntries = [];
                    $totalDuration = 0;

                    if (isset($request->military_from_date) && is_array($request->military_from_date)) {
                        foreach ($request->military_from_date as $key => $fromDate) {
                            $toDate = $request->military_to_date[$key] ?? null;
                            $role = $request->military_roles[$key] ?? '';

                            if (!empty($fromDate) || !empty($toDate) || !empty($role)) {
                                $duration = calculateMilitaryDuration($fromDate, $toDate);
                                $totalDuration += $duration;

                                $militaryEntries[] = [
                                    'from_date' => $fromDate,
                                    'to_date' => $toDate,
                                    'role' => $role,
                                    'duration' => $duration
                                ];
                            }
                        }
                    }
                @endphp

                <tr>
                    <td class="col-label" style="width: 25%">דוא"ל</td>
                    <td style="width: 25%">{{ $request->email }}</td>
                    <td class="col-label" style="width: 25%">משך השירות (חודשים)</td>
                    <td style="width: 25%">
                        @if (isset($militaryEntries[0]))
                            {{ $militaryEntries[0]['duration'] }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="col-label" style="width: 25%">ת.ז</td>
                    <td style="width: 25%">{{ $request->id_tz }}</td>
                    @if (count($militaryEntries) == 1)
                        {{-- If only ONE entry, show total on this row --}}
                        <td class="col-label" style="width: 25%">סה״כ</td>
                        <td style="width: 25%">{{ $totalDuration }}</td>
                    @elseif (count($militaryEntries) > 1)
                        {{-- If MULTIPLE entries, start showing entry 2 on this row --}}
                        <td class="col-label" style="width: 25%">מתאריך</td>
                        <td style="width: 25%">{{ $militaryEntries[1]['from_date'] }}</td>
                    @else
                        {{-- No military entries --}}
                        <td class="col-label" style="width: 25%"></td>
                        <td style="width: 25%"></td>
                    @endif
                </tr>
                <tr>
                    <td class="col-label" style="width: 25%">כתובת</td>
                    <td style="width: 25%">
                        {{ $request->personal_house . ' ' . $request->personal_street . ' ' . $request->personal_city }}
                    </td>
                    @if (count($militaryEntries) > 1)
                        {{-- Continue entry 2 --}}
                        <td class="col-label" style="width: 25%">עד תאריך</td>
                        <td style="width: 25%">{{ $militaryEntries[1]['to_date'] }}</td>
                    @else
                        {{-- No additional entries --}}
                        <td class="col-label" style="width: 25%"></td>
                        <td style="width: 25%"></td>
                    @endif
                </tr>
                <tr>
                    <td class="col-label" style="width: 25%">שם משפחה קודם</td>
                    <td style="width: 25%">{{ $request->oldlastname }}</td>
                    @if (count($militaryEntries) > 1)
                        {{-- If MULTIPLE entries, continue showing entry 2 (role) --}}
                        <td class="col-label" style="width: 25%">תפקיד</td>
                        <td style="width: 25%">{{ $militaryEntries[1]['role'] }}</td>
                    @else
                        {{-- Single entry or no entries --}}
                        <td class="col-label" style="width: 25%"></td>
                        <td style="width: 25%"></td>
                    @endif
                </tr>

                {{-- Additional military service entries (entry 2 onwards) - Continue from row 8+ --}}
                @if (count($militaryEntries) > 1)
                    {{-- Continue entry 2 - show duration --}}
                    <tr>
                        <td class="col-label" style="width: 25%"></td>
                        <td style="width: 25%"></td>
                        <td class="col-label" style="width: 25%">משך השירות (חודשים)</td>
                        <td style="width: 25%">{{ $militaryEntries[1]['duration'] }}</td>
                    </tr>

                    {{-- Entry 3 onwards (if any) - Full 6 rows per entry --}}
                    @for ($i = 2; $i < count($militaryEntries); $i++)
                        <tr>
                            <td class="col-label" style="width: 25%"></td>
                            <td style="width: 25%"></td>
                            <td class="col-label" style="width: 25%">מתאריך</td>
                            <td style="width: 25%">{{ $militaryEntries[$i]['from_date'] }}</td>
                        </tr>
                        <tr>
                            <td class="col-label" style="width: 25%"></td>
                            <td style="width: 25%"></td>
                            <td class="col-label" style="width: 25%">עד תאריך</td>
                            <td style="width: 25%">{{ $militaryEntries[$i]['to_date'] }}</td>
                        </tr>
                        <tr>
                            <td class="col-label" style="width: 25%"></td>
                            <td style="width: 25%"></td>
                            <td class="col-label" style="width: 25%">תפקיד</td>
                            <td style="width: 25%">{{ $militaryEntries[$i]['role'] }}</td>
                        </tr>
                        <tr>
                            <td class="col-label" style="width: 25%"></td>
                            <td style="width: 25%"></td>
                            <td class="col-label" style="width: 25%">משך השירות (חודשים)</td>
                            <td style="width: 25%">{{ $militaryEntries[$i]['duration'] }}</td>
                        </tr>
                    @endfor

                    {{-- Total duration row for multiple entries --}}
                    @if ($totalDuration > 0)
                        <tr>
                            <td class="col-label" style="width: 25%"></td>
                            <td style="width: 25%"></td>
                            <td class="col-label" style="width: 25%">סה״כ</td>
                            <td style="width: 25%">{{ $totalDuration }}</td>
                        </tr>
                    @endif
                @endif
                <tr>
                    <th colspan="4" class="header-label">נסיון תעסוקתי רלוונטי : (יש לציין תאריכים מדוייקים!)
                    </th>
                </tr>
                <tr>
                    <td colspan="4">
                        <table class="table table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="col-label" style="width: 20%">שם המעסיק</th>
                                    <th class="col-label" style="width: 20%">מתאריך</th>
                                    <th class="col-label" style="width: 20%">עד תאריך</th>
                                    <th class="col-label" style="width: 20%">תפקיד ודרגה (במידה ויש)</th>
                                    <th class="col-label" style="width: 20%">סיבת סיום עבודה</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($request->exp_position) > 0)
                                    @for ($i = 0; $i < count($request->exp_position); $i++)
                                        @if ($request->exp_position[$i] != '')
                                            <tr>
                                                <td>{{ $request->exp_position[$i] }}</td>
                                                <td>{{ $request->expe_start[$i] }}</td>
                                                <td>{{ $request->exp_finish[$i] }}</td>
                                                <td>{{ $request->exp_scope[$i] }}</td>
                                                <td>{{ $request->exp_reasontocomplete[$i] }}</td>
                                            </tr>
                                        @endif
                                    @endfor
                                @endif
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <th colspan="4" class="header-label">שפות: (5 רמה גבוהה מאוד , 4 רמה טובה , 3 רמה סבירה , 2 רמה
                        מעט נמוכה , 1 רמה נמוכה)</th>
                </tr>
                <tr>
                    <td colspan="4">
                        <table class="table table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="col-label" style="width: 25%">שפה</th>
                                    <th class="col-label" style="width: 25%">קריאה</th>
                                    <th class="col-label" style="width: 25%">כתיבה</th>
                                    <th class="col-label" style="width: 25%">דיבור</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $languages = $request->language ?? [];
                                    $reads = $request->language_read_ ?? [];
                                    $writes = $request->language_write_ ?? [];
                                    $speaks = $request->language_speak_ ?? [];
                                    $total = is_array($languages) ? count($languages) : 0;
                                @endphp

                                @for ($j = 0; $j < $total; $j++)
                                    @php
                                        $language = trim($languages[$j] ?? '');
                                    @endphp

                                    @if (!empty($language))
                                        <tr>
                                            <td class="col-label">{{ $language }}</td>
                                            <td>{{ $reads[$j] ?? '' }}</td>
                                            <td>{{ $writes[$j] ?? '' }}</td>
                                            <td>{{ $speaks[$j] ?? '' }}</td>
                                        </tr>
                                    @endif
                                @endfor

                                @if ($total === 0)
                                    <tr>
                                        <td colspan="4">&nbsp;</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <th colspan="4" class="header-label">השכלה:</th>
                </tr>
                <tr>
                    <td colspan="4">
                        <table class="table table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="col-label" style="width: 14%"></th>
                                    <th class="col-label" style="width: 14%">שם המוסד</th>
                                    <th class="col-label" style="width: 14%">מס' שנות לימוד</th>
                                    <th class="col-label" style="width: 14%">שנת סיום</th>
                                    <th class="col-label" style="width: 14%">מקצוע עיקרי</th>
                                    <th class="col-label" style="width: 14%">תעודה/תואר</th>
                                    <th class="col-label" style="width: 14%">תאריך קבלת התעודה</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $hasEducationData = false;
                                    $eduTypes = $request->edu_type ?? [];
                                    $educTypeEntries = $request->educ_type_for_entry ?? [];
                                    $eduTypeCount = [];

                                    foreach ($educTypeEntries as $type) {
                                        $eduTypeCount[$type] = ($eduTypeCount[$type] ?? 0) + 1;
                                    }

                                    // Debug: Log certificate dates
                                    \Log::debug('PDF Template Education Debug', [
                                        'educ_certificate_date' => $request->educ_certificate_date ?? 'NOT SET',
                                        'educTypeEntries_count' => count($educTypeEntries),
                                        'educ_institution_name_count' => is_array(
                                            $request->educ_institution_name ?? null,
                                        )
                                            ? count($request->educ_institution_name)
                                            : 'NOT ARRAY',
                                    ]);
                                @endphp

                                {{-- Form 5: Education based on educ_type_for_entry arrays --}}
                                @foreach ($educTypeEntries as $index => $eduType)
                                    @if (!empty($request->educ_institution_name[$index] ?? null))
                                        @php
                                            $hasEducationData = true;

                                            $displayEduType = $eduType ?: $request->edu_type[$index] ?? 'השכלה גבוהה';

                                            $typeCounter = 0;
                                            for ($i = 0; $i <= $index; $i++) {
                                                if (($educTypeEntries[$i] ?? null) === $eduType) {
                                                    $typeCounter++;
                                                }
                                            }

                                            $diplomaValues = [];

                                            // Show diploma based on education type
                                            if ($displayEduType == 'השכלה תיכונית') {
                                                // For high school - show diploma_type
                                                if (isset($request->diploma_type) && is_array($request->diploma_type)) {
                                                    $diplomaValues = array_filter($request->diploma_type, function (
                                                        $value,
                                                    ) {
                                                        return !empty($value) && is_string($value);
                                                    });
                                                }
                                            } elseif ($displayEduType == 'השכלה על תיכונית') {
                                                // For post-secondary - show diploma_exist + diploma_post_type
                                                if (
                                                    isset($request->diploma_exist) &&
                                                    $request->diploma_exist == 'yes'
                                                ) {
                                                    $diplomaValues[] = 'תעודת גמר';
                                                }
                                                if (
                                                    isset($request->diploma_post_type) &&
                                                    is_array($request->diploma_post_type)
                                                ) {
                                                    $diplomaValues = array_merge(
                                                        $diplomaValues,
                                                        array_filter($request->diploma_post_type, function ($value) {
                                                            return !empty($value) && is_string($value);
                                                        }),
                                                    );
                                                }
                                            } elseif ($displayEduType == 'השכלה גבוהה') {
                                                // For higher education - show diploma for this specific entry
                                                if (isset($request->diploma_high_type)) {
                                                    if (
                                                        isset($request->diploma_high_type[$index]) &&
                                                        is_array($request->diploma_high_type[$index])
                                                    ) {
                                                        // Index-based format: diploma_high_type[0][], diploma_high_type[1][], etc.
                                                        $diplomaValues = array_filter(
                                                            $request->diploma_high_type[$index],
                                                            function ($value) {
                                                                if (is_array($value)) {
                                                                    return !empty(array_filter($value));
                                                                }
                                                                return !empty($value) && is_string($value);
                                                            },
                                                        );
                                                    } else {
                                                        // Fallback: show all values (backward compatibility)
                                                        $diplomaValues = [];
                                                        if (is_array($request->diploma_high_type)) {
                                                            $diplomaValues = array_filter(
                                                                $request->diploma_high_type,
                                                                function ($value) {
                                                                    if (is_array($value)) {
                                                                        return !empty(array_filter($value));
                                                                    }
                                                                    return !empty($value) && is_string($value);
                                                                },
                                                            );
                                                        } elseif (
                                                            is_string($request->diploma_high_type) &&
                                                            !empty(trim($request->diploma_high_type))
                                                        ) {
                                                            $diplomaValues = [$request->diploma_high_type];
                                                        }
                                                    }
                                                }
                                            }

                                            // Clean and prepare final output
                                            $diplomaValues = array_map(function ($item) {
                                                return is_string($item) ? trim($item) : $item;
                                            }, $diplomaValues);

                                            $diplomaValues = array_filter($diplomaValues); // Remove any empty values

                                        @endphp
                                        <tr>
                                            <td class="col-label">
                                                {{ $displayEduType }}@if ($eduTypeCount[$eduType] > 1)
                                                    ({{ $typeCounter }})
                                                @endif
                                            </td>
                                            <td>{{ $request->educ_institution_name[$index] ?? '' }}</td>
                                            <td>{{ $request->educ_institution_years_years[$index] ?? '' }}</td>
                                            <td>{{ $request->educ_last_year[$index] ?? '' }}</td>
                                            <td>{{ $request->educ_institution_mode[$index] ?? '' }}</td>
                                            <td>{{ implode(', ', $diplomaValues) }}</td>
                                            <td>{{ $request->educ_certificate_date[$index] ?? '' }}</td>
                                        </tr>
                                    @endif
                                @endforeach

                                {{-- Fallback: Original edu_type method --}}
                                @if (empty($educTypeEntries) && is_array($eduTypes))
                                    @foreach ($eduTypes as $index => $eduType)
                                        @if (!empty($request->educ_institution_name[$index] ?? null))
                                            @php $hasEducationData = true; @endphp
                                            <tr>
                                                <td class="col-label">{{ $eduType }}</td>
                                                <td>{{ $request->educ_institution_name[$index] ?? '' }}</td>
                                                <td>{{ $request->educ_institution_years_years[$index] ?? '' }}</td>
                                                <td>{{ $request->educ_last_year[$index] ?? '' }}</td>
                                                <td>{{ $request->educ_institution_mode[$index] ?? '' }}</td>
                                                <td>{{ implode(', ', $request->diploma_type ?? []) }}</td>
                                                <td>{{ $request->educ_certificate_date[$index] ?? '' }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif

                                {{-- Courses and Training --}}
                                @foreach ($request->add_educ_name ?? [] as $i => $name)
                                    @if (!empty($name))
                                        @php $hasEducationData = true; @endphp
                                        <tr>
                                            <td class="col-label">קורס {{ $i + 1 }}</td>
                                            <td>{{ $name }}</td>
                                            <td>{{ $request->add_educ_start[$i] ?? '' }}</td>
                                            <td>{{ $request->add_educ_finish[$i] ?? '' }}</td>
                                            <td>{{ $request->add_educ_desc[$i] ?? '' }}</td>
                                            <td>{{ $request->diploma_exist_relevant[$i] ?? '' }}</td>
                                            <td></td>
                                        </tr>
                                    @endif
                                @endforeach

                                {{-- Empty fallback row --}}
                                @if (!$hasEducationData)
                                    <tr>
                                        @for ($i = 0; $i < 7; $i++)
                                            <td class="col-label">&nbsp;</td>
                                        @endfor
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </td>

                </tr>

                <tr>
                    <th colspan="4" class="header-label">:והשתלמויות קורסים</th>
                </tr>
                <tr>
                    <td colspan="4">
                        <table class="table table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="col-label" style="width: 20%">שם הקורס</th>
                                    <th class="col-label" style="width: 20%">מתאריך</th>
                                    <th class="col-label" style="width: 20%">עד תאריך</th>
                                    <th class="col-label" style="width: 20%">מסגרת הלימודים</th>
                                    <th class="col-label" style="width: 20%">תעודת גמר</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $request->course_name }}</td>
                                    <td>{{ $request->start_date }}</td>
                                    <td>{{ $request->end_date }}</td>
                                    <td>{{ $request->study_framework }}</td>
                                    <td>{{ $request->certificate }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <th colspan="4" class="header-label">קרובי משפחה שעובדים ברשות:</th>
                </tr>
                <tr>
                    <td colspan="4">קרובי משפחה שעובדים ברשות ו/או קרובי משפחה המשמשים כנבחרי ציבור: בן/בת זוג,
                        הורה, בן/בת ובני זוגם, אח/אחות וילדיהם, גיס/גיסה,
                        דוד/דודה, חותן/חותנת, חם/חמות, חתן/כלה, נכד/נכדה לרבות חורג או מאומץ )אם יש יותר משני קרובי
                        משפחה שעובדים ברשות, יש לציין זאת בדף
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table class="table table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="col-label" style="width: 20%">האם יש קרובי משפחה שעובדים ברשות?</th>
                                    <th class="col-label" style="width: 20%">שם מלא</th>
                                    <th class="col-label" style="width: 20%">יחס קירבה</th>
                                    <th class="col-label" style="width: 20%">מחלקה</th>
                                    <th class="col-label" style="width: 20%">תפקיד</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nearness = $request->input('nearness', '');
                                    $relativeNames = $request->input('relative_name', []);
                                    $relativeDistances = $request->input('relative_distance', []);
                                    $roles = $request->input('relative_name_d1', []);
                                    $departments = $request->input('relative_division_department_d1', []);
                                @endphp

                                @if ($nearness === 'no')
                                    {{-- User explicitly selected "No relatives" --}}
                                    <tr>
                                        <td>לא</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                @elseif (!empty($relativeNames) || !empty($relativeDistances) || !empty($roles) || !empty($departments))
                                    {{-- User selected "Yes" and filled in relative details --}}
                                    @foreach ($relativeDistances as $index => $distance)
                                        <tr>
                                            <td>כן</td>
                                            <td>{{ $relativeNames[$index] ?? '' }}</td>
                                            <td>{{ $distance }}</td>
                                            <td>{{ $departments[$index] ?? '' }}</td>
                                            <td>{{ $roles[$index] ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    {{-- Nothing selected or form incomplete --}}
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </td>
                </tr>

                <!-- <tr>
                    <th colspan="4" class="header-label">:ממליצים שמות</th>
                </tr>*/ -->
                <tr>
                    <th colspan="4" class="header-label">ממליצים</th>
                </tr>
                <tr>
                    <td colspan="4">
                        <table class="table table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="col-label" style="width: 20%">שם ושם משפחה</th>
                                    <th class="col-label" style="width: 20%">שם משפחה</th>
                                    <th class="col-label" style="width: 20%">תפקיד/ מקצוע</th>
                                    <th class="col-label" style="width: 20%">כתובת</th>
                                    <th class="col-label" style="width: 20%">טלפון</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Additional recommenders (dynamic) --}}
                                @php
                                    $fullNames = $request->recomendations_full_name_z ?? [];
                                    $lastNames = $request->recomendations_last_name_z ?? [];
                                    $roles = $request->recomendations_role_z ?? [];
                                    $addresses = $request->recomendations_address_z ?? [];
                                    $phones = $request->recomendations_phone_z ?? [];
                                    $count = count($fullNames);
                                @endphp

                                @for ($i = 0; $i < $count; $i++)
                                    @if ($i == 1)
                                        @continue
                                    @endif
                                    @if (!empty($fullNames[$i]))
                                        <tr>
                                            <td>{{ $fullNames[$i] }}</td>
                                            <td>{{ $lastNames[$i] ?? '' }}</td>
                                            <td>{{ $roles[$i] ?? '' }}</td>
                                            <td>{{ $addresses[$i] ?? '' }}</td>
                                            <td style="direction: ltr; text-align: right;">{{ $phones[$i] ?? '' }}
                                            </td>
                                        </tr>
                                    @endif
                                @endfor

                                {{-- Show one empty row if no data --}}
                                @if ($count === 0)
                                    <tr>
                                        <td colspan="5">&nbsp;</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td colspan="4">
                        <table class="table table-bordered" style="width: 100%">
                            <tr>
                                <th colspan="4" class="header-label">הערות נוספות / שונות (כגון ציונים לשבח, פרסי
                                    עידוד מיוחדים וכדומה):</th>
                            </tr>
                            <tr>
                                <td colspan="4">{{ $request->form5_additional_text }}</td>
                            </tr>
                            <tr>
                                <th colspan="4" class="header-label">סמן "כן" אם הנך נמנה עם אחת הקבוצות הבאות:
                                    הרשות מקנה עדיפות לזכאים לכך על פי דין, כדי לקדם את עקרונות הייצוג ההולם ושיוויון
                                    ההזדמנויות בעבודה.
                                </th>
                            </tr>

                            <tr>
                                <td class="col-label" style="width: 50%">אני או אחד מהורי נולדנו באתיופיה:</td>
                                {{-- <td style="width: 50%">
                                    @if (isset($request->form3_ch2) && $request->form3_ch2 == 'disability')
                                        כן
                                        @if (!empty($request->form3_disability_text))
                                            - {{ $request->form3_disability_text }}
                                        @endif
                                    @endif
                                </td> --}}
                                  <td style="width: 50%">
                                    @if (isset($request->form3_ch2) && $request->form3_ch2 == 'minority')
                                        @if (!empty($request->form3_minority_text))
                                         {{ $request->form3_minority_text }}
                                        @endif
                                    @endif
                                 </td>

                            </tr>
                            <tr>
                                <td class="col-label" style="width: 50%">אני אדם עם מוגבלות כמשמעו בצו ההרחבה לעידוד
                                    והגברת תעסוקה של אנשים עם מוגבלות:</td>
                                {{-- <td style="width: 50%">
                                    @if (isset($request->form3_ch2) && $request->form3_ch2 == 'minority')
                                        כן
                                        @if (!empty($request->form3_minority_text))
                                            - {{ $request->form3_minority_text }}
                                        @endif
                                    @endif
                                </td> --}}

                                 <td style="width: 50%">
                                    @if (isset($request->form3_ch2) && $request->form3_ch2 == 'disability')

                                        @if (!empty($request->form3_disability_text))
                                            {{ $request->form3_disability_text }}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="col-label" style="width: 50%">במידה וכן ציין איזה התאמות נגישות נדרשות
                                    לצורך מילוי תפקידתך:</td>
                                <td style="width: 50%">
                                    {{-- This row is no longer used as disability text now shows in row 1 --}}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    מודגש כי רק מי שעומד/ת בכל תנאי הסף תישקל מועמדותו/ה לתפקיד שבמכרז.
                                    אני מגיש/ה בזאת את מועמדותי למכרז הנ״ל ומצהיר/ה שכל הפרטים שמילאתי בטופס נכונים.
                                    יש לצרף קורות חיים/מסמכים תעודות והמלצות המעידים על עמידה בתנאי הסף שפורסמו במכרז.
                                </td>
                            </tr>
                            <tr>
                                <th colspan="4" class="header-label">אישור וחתימה:</th>
                            </tr>
                            <tr>
                                <td class="col-label" style="width: 25%">תאריך</td>
                                <td style="width: 75%">{{ now()->format('Y-m-d') }}</td>
                            </tr>
                            <tr>
                                <td class="col-label" style="width: 25%">חתימה</td>
                                <td style="width: 75%">{{ $request->firstname }} {{ $request->lastname ?? '' }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
