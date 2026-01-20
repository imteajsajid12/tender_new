@extends('layouts.admin.header')
@section('content')

    <?php
    /*$metaJson1 = unserialize($application->p1_meta['metaJson']);
	$metaJson2 = unserialize($application->p2_meta['metaJson']);
	$metaJson3 = unserialize($application->p3_meta['metaJson']);*/
    try {
        $metaJson5 = unserialize($application?->p5_meta['metaJson']) ?? [];
    } catch (\Throwable $th) {
        //throw $th;
        $metaJson5 = [];
    }
    // function showTitle($page) {
    // 	return $page;
    // }
    ?>
    <style>
        .btn-danger {
            color: #fff;
            background-color: #e3342f;
            border-color: #e3342f;
        }

        .input-group.first .input-group-append {
            display: none !important;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js">
    </script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
    <div class="content single-app">
        <main>
            <input type="hidden" name="appid_input" id="appid_input" value="{{ $application->id }}">
            <div class="card-header single-card-header">
                <div class="h-right-bar">
                    <span>{{ $application->tname }}</span>
                    <a href="/admin/tenders/requestsorted/all/{{ $application->tenderid }}"
                        class="paginate apps-link rectangle">
                        <img src="{{ asset('img/right-back.png') }}">
                    </a>
                </div>
            </div>
            <div class="apps-card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <?php
                $p_e = $application->st > 2 ? 'pointer-events: none' : '';
                $p_1 = isset($metaJson5) ? 'visibility: hidden;' : 'text-align: right; visibility: visible;';
                ?>
                <div class="container_child">
                    @if (!empty($application))
                        <table cellspacing="10" class="apps-list">
                            <thead>

                                <th>תאריך פנייה</th>
                                <th>מספר מכרז</th>
                                <th>שם הפונה</th>
                                <th>מספר טלפון נייד</th>
                                <th class="qualification-column">השכלה ודרישות מקצועיות</th>
                                <th class="qualification-column">ניסיון ניהולי</th>
                                <th class="qualification-column">ניסיון מקצועי</th>
                                <th class="qualification-column">דרישות נוספות</th>
								<th>סטטוס</th>
                                <th>מבחן חובה</th>
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
											<td>
                                                @php
                                                    // Get Hebrew status label from the statuses array
                                                    $hebrewStatus = $statuses[$line->app_status] ?? $line->app_status;
                                                @endphp
                                                {{ $hebrewStatus }}
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

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>

                        </table>
                        @if (!empty($application->p1_meta['metaJson']) || !empty($application->p5_meta['metaJson']))
                            <?php

                            ?>
                        @else
                            <h3 style="color: red">לא ניתן לבצע פעולה נוספת, ישנם נתונים חסרים</h3>
                        @endif
                    @else
                        No application
                    @endif
                    <div style="margin-top: 60px;overflow: hidden; display: flex;">
                        <div style="width: 50%">
                            <div class="sky-rtl doc-name" style="margin-top: 0"> טופס הבקשה: </div>
                            <div>
                                <?php
                                $length = count($allforms);

                                /*for ($i = 0; $i < count($allforms); $i++) {
                                    if ($allforms[$i] instanceof Illuminate\Support\Collection) {
                                        foreach ($allforms[$i] as $item) {
                                            echo $item->url . PHP_EOL;
                                        }
                                    }
                                }*/

                                if (!empty($allforms)){
                                    for ($i = 0; $i < count($allforms); $i++) {
                                        if ($allforms[$i] instanceof Illuminate\Support\Collection) {
                                            foreach ($allforms[$i] as $item) {
                                                $file = $allforms[$i];
                                                if (!isset($item->url)) continue;
                                                $file_1 = '';
                                                $file_name = '';
                                                $tclass = '';

                                ?>
                                <div class="file-content">
                                    <span class="file-title"> שאלון אישי למועמד </span>

                                    @php
                                    $file->url = uploadFileSearch($item->url);
                                    @endphp


                                    <a href="{{ asset('upload/' . $file->url) }}" target="_blank" rel="noopener noreferrer"
                                        style="margin-bottom: 5px" title="{{ $file_1 }}">
                                        <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                                        <?php if ($item->status == 1) {
                                            $tclass = 'approve';
                                        } elseif ($item->status == 2) {
                                            $tclass = 'cancel';
                                        } else {
                                            $tclass = '';
                                        } ?>
                                        <span class="type {{ $tclass }}"></span>
                                    </a>
                                    <span class="doc-filename">{{ $file_name }}</span>
                                    <?php
                                    if ($item->status == 3) {
                                        echo '<span class="doc-filename replace">ממתין לאישור</span>';
                                    }
                                    if ($item->status == 4) {
                                        echo '<span class="doc-filename replace">נשלחה בקשה למסמך אחר</span>';
                                    }
                                    ?>
                                    @if (\App\User::check_auth_user_AppPermission2($application, 2))
                                        <div>
                                            <button class="apps-btn" id="cancel_{{ $item->id }}"
                                                onclick="cancel_file_tk(this, {{ $item->id }} )"
                                                style="{{ $p_e }}">דחה
                                            </button>
                                        </div>
                                        <div>
                                            <button class="apps-btn" onclick="approve_file_tk(this, {{ $item->id }} )"
                                                style="{{ $p_e }}"> אשר
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <?php

                                        }
                                    }
                                }
                            }
                            ?>
                            </div>
                        </div>
                        <div style="width: 50%">
                            @php
                                $i = 0;
                            @endphp
                            {{-- Display Yes/No Questions (שאלות כן ולא) --}}
                            @if (!empty($yesNoQuestions) && is_array($yesNoQuestions))
                                <div style="border: 2px solid #4c9d4c;
                                            padding: 15px;
                                            margin-bottom: 20px;">

                                    <!-- Simple Header -->
                                    <h4 style="color: #4c9d4c;
                                               margin: 0 0 15px 0;
                                               padding-bottom: 10px;
                                               border-bottom: 1px solid #ddd;
                                               font-weight: bold;">
                                        שאלות כן ולא
                                    </h4>

                                    <!-- Questions List -->
                                    @foreach ($yesNoQuestions as $index => $item)
                                        <div style="padding: 10px 0;
                                                    border-bottom: 1px solid #f0f0f0;">

                                            <!-- Question -->
                                            <div style="margin-bottom: 8px;">
                                                <strong>{{ $index + 1 }}. {{ $item['question'] }}</strong>
                                            </div>

                                            <!-- Answer -->
                                            <div style="padding-right: 20px;">
                                                <span style="padding: 4px 10px;
                                                             border-radius: 4px;
                                                             font-weight: 600;
                                                             {{ $item['answer_value'] == 1 ?
                                                                'background: #d4edda; color: #155724;' :
                                                                'background: #f8d7da; color: #721c24;' }}">
                                                    תשובה: {{ $item['answer'] }}
                                                </span>

                                                <!-- Additional Text -->
                                                @if (!empty($item['text']))
                                                    <div style="margin-top: 8px;
                                                                padding: 8px;
                                                                background: #fff3cd;
                                                                border-right: 3px solid #ffc107;">
                                                        <strong>פירוט:</strong> {{ $item['text'] }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @elseif (isset($metaJson5['condition_question']))
                                <!-- Simple bordered section for legacy format -->
                                <div style="border: 2px solid #4c9d4c;
                                            padding: 15px;
                                            margin-bottom: 20px;">

                                    <!-- Simple Header -->
                                    <h4 style="color: #4c9d4c;
                                               margin: 0 0 15px 0;
                                               padding-bottom: 10px;
                                               border-bottom: 1px solid #ddd;
                                               font-weight: bold;">
                                        שאלות כן ולא
                                    </h4>

                                    <!-- Questions -->
                                    @foreach ($metaJson5['condition_question'] as $condition_question)
                                        <div style="padding: 10px 0;
                                                    border-bottom: 1px solid #f0f0f0;">
                                            <p style="margin: 0; line-height: 1.6;">
                                                <strong>{{ $condition_question }}</strong>
                                                <span style="margin-right: 10px;
                                                             padding: 4px 10px;
                                                             border-radius: 4px;
                                                             font-weight: 600;
                                                             {{ $metaJson5['condition_answer'][$i] == 1 ?
                                                                'background: #d4edda; color: #155724;' :
                                                                'background: #f8d7da; color: #721c24;' }}">
                                                    @if ($metaJson5['condition_answer'][$i] == 1)
                                                        כֵּן
                                                    @else
                                                        לֹא
                                                    @endif
                                                </span>
                                                @if ($metaJson5['condition_answer_text'][$i] != "")
                                                    <span style="display: block;
                                                                 margin-top: 6px;
                                                                 padding: 6px 10px;
                                                                 background: #f8f9fa;
                                                                 color: #666;">
                                                        {{ $metaJson5['condition_answer_text'][$i] }}
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>

                    <!-- שירות לאומי/צבאי (National/Military Service) Section -->
                    @php
                        $militaryFiles = collect();
                        $otherFiles = collect();

                        if (!empty($application->files)) {
                            foreach ($application->files as $file) {
                                $isLegalAttach = strpos($file->file_name, 'email') !== false ? true : false;
                                if (!$isLegalAttach) {
                                    $file_name = explode('^^', $file->file_name);
                                    $file_1 = count($file_name) > 1 ? $file_name[1] : '';

                                    // Check if this is a military service file
                                    $fileTitle = isset($formFileNames[$file_1]) ? $formFileNames[$file_1] : $file_1;

                                    // Debug logging for file categorization
                                    if (strpos($file_1, 'military_') === 0) {
                                        error_log("Military file detected: " . $file_1 . " with title: " . $fileTitle);
                                    }

                                    if (strpos($file_1, 'military_') === 0 ||
                                        $file_1 === 'מסמך שירות לאומי/צבאי' ||
                                        $fileTitle === 'מסמך שירות לאומי/צבאי' ||
                                        strpos($fileTitle, 'שירות לאומי') !== false ||
                                        strpos($fileTitle, 'צבאי') !== false) {
                                        $militaryFiles[] = $file;
                                        $otherFiles[] = $file;
                                    } else {
                                        $otherFiles[] = $file;
                                    }
                                }
                            }
                        }
                    @endphp

                    <!-- Military Service Files Section -->
                    {{-- @if (!empty($militaryFiles))
                        <div style="margin-top: 60px;overflow: hidden;">
                            <div style="text-align:right;margin-right:0px" class="doc-name">מסמכי שירות לאומי/צבאי</div>
                            @foreach ($militaryFiles as $file)
                                <?php
                                // $file_name = explode('^^', $file->file_name);
                                // $file_1 = count($file_name) > 1 ? $file_name[1] : '';
                                ?>
                                @php
                                $file->url = uploadFileSearch($file->url);
                                @endphp

                                <div class="file-content">
                                    <span class="file-title"
                                        style="text-align: right">{{ isset($formFileNames[$file_1]) ? $formFileNames[$file_1] : $file_1 }}</span>
                                    <a href="{{ asset('upload/' . $file->url) }}" target="_blank"
                                        rel="noopener noreferrer" style="margin-bottom: 5px"
                                        title="{{ $file_name[0] }}">
                                        <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                                        <?php
                                        // if ($file->status == 1) {
                                        //     $tclass = 'approve';
                                        // } elseif ($file->status == 2) {
                                        //     $tclass = 'cancel';
                                        // } else {
                                        //     $tclass = '';
                                        // }
                                        ?>
                                        <span class="type {{ $tclass }}"></span>
                                    </a>
                                    <span class="doc-filename">{{ $file_name[0] }}</span>
                                    <?php
                                    // if ($file->status == 3) {
                                    //     echo '<span class="doc-filename replace">ממתין לאישור</span>';
                                    // }
                                    // if ($file->status == 4) {
                                    //     echo '<span class="doc-filename replace">נשלחה בקשה למסמך אחר</span>';
                                    // }
                                    ?>
                                    @if (\App\User::check_auth_user_AppPermission2($application, 2))
                                        <div>
                                            <button class="apps-btn" id="cancel_{{ $file->id }}"
                                                onclick="cancel_file_tk(this, {{ $file->id }} )"
                                                style="{{ $p_e }}">דחה
                                            </button>
                                        </div>
                                        <div>
                                            <button class="apps-btn"
                                                onclick="approve_file_tk(this, {{ $file->id }} )"
                                                style="{{ $p_e }}"> אשר
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif --}}
                    <!-- Other Documents Section -->
                    <div style="margin-top: 60px;overflow: hidden;">
                        @if (!empty($otherFiles))
                            <div style="text-align:right;margin-right:0px" class="doc-name">מסמכים לצירוף</div>
                            @foreach ($otherFiles as $file)
                                @continue($file->type == 'mandatory_test')
                                @php
                                    // Get display information from new columns or fallback to parsing
                                    $displayName = $file->input_field_label ?? '';
                                    $qualificationLabel = $file->input_field_label ?? '';

                                    // If new columns are empty, parse the old file_name format
                                    if (empty($displayName)) {
                                        $file_name_parts = explode('^^', $file->file_name);
                                        if (count($file_name_parts) > 1) {
                                            $qualificationLabel = $file_name_parts[1];
                                            // Extract original filename from first part
                                            $firstPart = $file_name_parts[0];
                                            if (strpos($firstPart, '@') !== false) {
                                                $afterAt = explode('@', $firstPart)[1];
                                                if (strpos($afterAt, '#') !== false) {
                                                    $displayName = explode('#', $afterAt)[1];
                                                } else {
                                                    $displayName = $afterAt;
                                                }
                                            } else {
                                                $displayName = $firstPart;
                                            }
                                        } else {
                                            $displayName = $file->file_name;
                                            $qualificationLabel = $file->file_name;
                                        }
                                    }

                                    // Determine file path
                                    $file->url = uploadFileSearch($file->url);
                                    $filePath = 'upload/' . $file->url;

                                    // Determine status class
                                    $tclass = '';
                                    if ($file->status == 1) {
                                        $tclass = 'approve';
                                    } elseif ($file->status == 2) {
                                        $tclass = 'cancel';
                                    }
                                @endphp

                                <div class="file-content">
                                    <span class="file-title" style="text-align: right">{{ $qualificationLabel }}</span>
                                    <a href="{{ asset($filePath) }}" target="_blank"
                                        rel="noopener noreferrer" style="margin-bottom: 5px"
                                        title="{{ $displayName }}">
                                        <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                                        <span class="type {{ $tclass }}"></span>
                                    </a>
                                    <span class="doc-filename">{{ $displayName }}</span>
                                    @if ($file->status == 3)
                                        <span class="doc-filename replace">ממתין לאישור</span>
                                    @endif
                                    @if ($file->status == 4)
                                        <span class="doc-filename replace">נשלחה בקשה למסמך אחר</span>
                                    @endif
                                    @if (\App\User::check_auth_user_AppPermission2($application, 2))
                                        <div>
                                            <button class="apps-btn" id="cancel_{{ $file->id }}"
                                                onclick="cancel_file_tk(this, {{ $file->id }} )"
                                                style="{{ $p_e }}">דחה
                                            </button>
                                        </div>
                                        <div>
                                            <button class="apps-btn"
                                                onclick="approve_file_tk(this, {{ $file->id }} )"
                                                style="{{ $p_e }}"> אשר
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif


                        <div class="file-content">
                            <span class="file-title" style="font-weight: 700;text-align: right;font-size:0.9em">מסמך
                                אחר</span>
                            <a href="#" onclick="requestNewFile(<?php echo $application->id; ?>)">
                                <div
                                    style="width:130px;height:130px;background:#d3d3d3;display:flex;align-items:center;justify-content:center;">

                                    <img style="width:56px;height:76px" src="/img/newfile.png">
                                </div>
                            </a>
                            <button class="apps-btn" style="width:100%;margin-top:5px;"
                                onclick="showRequestNewFile(<?php echo $application->id; ?>)">בקשה למסמך אחר
                            </button>
                            <div id="files_comment"
                                style="display:none;margin-top:50px;width:400px;height:300px; border:thin solid #4c9d4c">
                                <textarea id="files_comment_data" type="text" style="width:100%;height:100%"></textarea>
                                <button class="apps-btn" style="width:100%;margin-top:0;margin-left:0"
                                    onclick="requestNewFile(<?php echo $application->id; ?>)">בקשה למסמך אחר
                                </button>
                            </div>
                        </div>
                        {{-- Mandatory Test File Upload Section --}}
                        @if($tender->is_test_required)
                            {{-- Check if test file already exists --}}
                            @php
                                $testFiles = collect($application->files)->filter(function($file) {
                                    // Only consider files that are explicitly marked as mandatory_test type
                                    // OR have the qualification section as 'mandatory_test'
                                    // OR have 'מבחן_חובה' in the file_name (exact match for Hebrew)
                                    if ($file->type === 'mandatory_test') {
                                        return true;
                                    }

                                    // Check qualification section for files with ^^ format
                                    if (strpos($file->file_name, '^^') !== false) {
                                        $file_name_parts = explode('^^', $file->file_name);
                                        if (count($file_name_parts) > 2 && $file_name_parts[2] === 'mandatory_test') {
                                            return true;
                                        }
                                    }

                                    // Only match exact Hebrew term for mandatory test
                                    if (strpos($file->file_name, 'מבחן_חובה') !== false || strpos($file->file_name, 'מבחן חובה') !== false) {
                                        return true;
                                    }

                                    return false;
                                });
                                $hasTestFile = $testFiles->count() > 0;
                            @endphp

                            @if($hasTestFile)
                                {{-- Show existing test files following the same pattern as other files --}}
                                @foreach($testFiles as $testFile)
                                    @php
                                        // Get display name from new column or fallback to file_name
                                        $displayName = $testFile->input_field_label ?? $testFile->file_name;

                                        // Determine file path based on type
                                        if ($testFile->type === 'mandatory_test') {
                                            $filePath = 'upload/admin/' . $testFile->url;
                                        } else {
                                            $testFile->url = uploadFileSearch($testFile->url);
                                            $filePath = 'upload/' . $testFile->url;
                                        }
                                    @endphp
                                    <div class="file-content">
                                        <span class="file-title" style="text-align: right">מבחן חובה</span>
                                        <a href="{{ asset($filePath) }}" target="_blank"
                                           rel="noopener noreferrer" style="margin-bottom: 5px"
                                           title="{{ $displayName }}">
                                            <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                                            <span class="type approve"></span>
                                        </a>
                                        <span class="doc-filename">{{ $displayName }}</span>
                                        @if(\App\User::check_auth_user_permission(2))
                                            <div>
                                                <button class="apps-btn" onclick="deleteMandatoryTestFile({{ $testFile->id }})">
                                                    מחק
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                {{-- Show upload interface following the same pattern as "מסמך אחר" --}}
                                <div class="file-content">
                                    <span class="file-title" style="font-weight: 700;text-align: right;font-size:0.9em">מבחן חובה</span>
                                    @if(\App\User::check_auth_user_permission(2))
                                        <a href="#" onclick="showMandatoryTestUpload({{ $application->id }})">
                                            <div style="width:130px;height:130px;background:#d3d3d3;display:flex;align-items:center;justify-content:center;">
                                                <img style="width:56px;height:76px" src="/img/newfile.png">
                                            </div>
                                        </a>
                                        <button class="apps-btn" style="width:100%;margin-top:5px;"
                                                onclick="showMandatoryTestUpload({{ $application->id }})">העלאת מבחן חובה
                                        </button>
                                    @else
                                        <div style="width:130px;height:130px;background:#f0f0f0;display:flex;align-items:center;justify-content:center;">
                                            <img style="width:56px;height:76px;opacity:0.5" src="/img/newfile.png">
                                        </div>
                                        <div style="text-align: center; color: #999; margin-top: 5px;">
                                            לא הועלה קובץ מבחן
                                        </div>
                                    @endif

                                    {{-- Hidden upload form --}}
                                    <div id="test_upload_form" style="display:none;margin-top:20px;width:400px;border:thin solid #4c9d4c;padding:15px;background:#f8fff8;">
                                        <div style="margin-bottom: 15px;">
                                            <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #2d5a2d;">העלאת קובץ מבחן חובה (PDF בלבד):</label>
                                            <input type="file" name="test_file" id="test_file_input"
                                                   accept=".pdf,application/pdf"
                                                   placeholder="Click here"
                                                   style="width: 100%; padding: 8px;height:40px; border: 1px solid #ccc; border-radius: 4px;">
                                            <small style="color: #666; margin-top: 5px; display: block;">רק קבצי PDF מותרים (עד 20MB)</small>
                                        </div>
                                        <button type="button" class="apps-btn" style="width:100%;margin-top:0;margin-left:0"
                                                onclick="uploadMandatoryTestFile({{ $application->id }})">
                                            העלה קובץ מבחן PDF
                                        </button>
                                        <button type="button" class="apps-btn" style="width:100%;margin-top:5px;background:#ef5656;"
                                                onclick="hideMandatoryTestUpload()">
                                            ביטול
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                    @if ($ifnotapprovedfiles === 'nono' || $ifnotapprovedfiles == 0)
                        <div style="margin-top: 60px;overflow: hidden;">
                            <div class="mt-5 mb-5">
                                <h3 class="title">הגדרת נמענים להעתקים:</h3> <br>
                                <div class="input-control mr-0">
                                    <input class="typeahead form-control " type="text"
                                        placeholder="אנא הזינו את שם הנמען להגדרת העתק"
                                        data-path="/admin/users/autocomplete_users" autocomplete="off" id="typeahead"
                                        data-provide="typeahead">
                                    <button class="btn" style="display: inline-block;"
                                        id="add-user-inappp">הוסף</button>
                                    <button class="btn" style="display: inline-block;" id="add-user-outapp-form2">הוסף
                                        משתמש חיצוני</button>

                                </div><br>
                                <div class="typeahead_res">
                                    <?php echo $application->appusers; ?>
                                </div>
                                <div class="outer2"></div>
                            </div>
                        </div>
                    @endif
                </div>
                @if (
                    ($decision->decision_3 || $decision->decision_4) &&
                        !($decision->decision_5 != 1 && $decision->decision_6 != 1 && $decision->decision_rejectedbyuser != 1))
                    <div>
                        @if ($decision->decision_3)
                            <img src="/img/allok.png" />
                            <span class="captiogreen adminlighthdr">
                                אושר
                            </span>
                        @elseif ($decision->decision_4)
                            <img src="/img/nok.png" /><span class="captiored">
                                נדחה
                            </span>
                        @endif
                    </div>
                @endif
                @if (
                    $decision->decision_1 &&
                        !($decision->decision_5 != 1 && $decision->decision_6 != 1 && $decision->decision_rejectedbyuser != 1))
                    <span>אישור/ דחיה שלב א</span>
                @endif

                @if ($decfile)
                    <div style="display:inline; flex-direction: column" id="ifdecfile">
                        @foreach ($decfile as $decline)
                            <div style="margin-bottom: 20px;margin-left: 20px;width: 135px;">
                                @if (
                                    $decision->decision_1 &&
                                        ($decline->file_name === 'decisionapprove0.pdf' ||
                                            $decline->file_name === 'decisionapprove0a.pdf' ||
                                            $decline->file_name === 'decisionreject0.pdf' ||
                                            $decline->file_name === 'decisionreject0a.pdf' ||
                                            $decline->file_name === 'decisionreject0b.pdf' ||
                                            $decline->file_name === 'decisionreject0c.pdf' ||
                                            $decline->file_name === 'decisionreject0d.pdf' ||
                                            $decline->file_name === 'decisionreject1.pdf'))
                                    @if (
                                        $decline->file_name === 'decisionapprove0.pdf' ||
                                            $decline->file_name === 'decisionreject0.pdf' ||
                                            $decline->file_name === 'decisionreject0a.pdf' ||
                                            $decline->file_name === 'decisionreject0b.pdf' ||
                                            $decline->file_name === 'decisionreject0c.pdf' ||
                                            $decline->file_name === 'decisionreject0d.pdf' )
                                        <span style="font-weight: 700">אישור/ דחיה תנאי סף</span>
                                    @endif
                                    @if ($decline->file_name === 'decisionapprove1.pdf' || $decline->file_name === 'decisionreject1.pdf')
                                        <span style="font-weight: 700">אישור/ דחיה שלב א'</span>
                                    @endif
                                @endif
                                @if ($decline->file_name === 'decisionapprove0.pdf' || $decline->file_name === 'decisionapprove0a.pdf')
                                    <img src="/img/allok.png" />
                                    <span class="captiogreen adminlighthdr">
                                        אושר
                                    </span>
                                    <span class="file-title" style="font-weight: 400;text-align: right">אישור/ דחיה תנאי
                                        סף</span>
                                    <a href="{{ asset('upload/admin/' . $decline->url . '') }}" target="_blank"
                                        rel="noopener noreferrer" style="margin-bottom: 5px" title="decision.pdf">
                                        <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                                        <span class="type pdf"></span>
                                    </a>
                                @endif
                                @php
                                    $decision_arr = (array) $decision;
                                @endphp
                                @if (
                                    $decline->file_name === 'decisionreject0.pdf' ||
                                        (!$decision->decision_4 &&
                                            ($decline->file_name === 'decisionreject0.pdf' ||
                                                $decline->file_name === 'decisionreject0a.pdf' ||
                                                $decline->file_name === 'decisionreject0b.pdf' ||
                                                $decline->file_name === 'decisionreject0c.pdf'
                                                )) ||
                                        $decline->file_name === 'decisionreject1.pdf'
                                        )
                                    @if ($decline->file_name === 'decisionreject0b.pdf' && $decision_arr['2nd_invitation_rejected'])
                                        @continue
                                    @endif
                                    <img src="/img/nok.png" />
                                    <span class="captiored">
                                        נדחה
                                    </span>
                                    @if ($decline->file_name === 'decisionreject0b.pdf')
                                    <span class="" style="font-weight: 400;text-align: right">הסרת מועמדות</span>
                                    @else
                                    <span class="file-title" style="font-weight: 400;text-align: right">אישור/ דחיה תנאי
                                        סף</span>
                                    @endif
                                    <a href="{{ asset('upload/admin/' . $decline->url . '') }}" target="_blank"
                                        rel="noopener noreferrer" style="margin-bottom: 5px" title="decision.pdf">
                                        <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                                        <span class="type pdf"></span>
                                    </a>
                                    {{-- step back --}}
                                    @if ($appstep->stepback == 0 && $application->status != 'Waiting' && $application->status != 'Committee' && $application->status != 'Accepted' && $application->status != 'Accepted A' && $application->status != 'Accepted B' && $application->status != 'Rejected')
                                    <div class="stepbackfirst">
                                        <button type="button" class="apps-btn btn float-right ml-3"
                                            onclick="stepBackDecision()" data-id="999">
                                            צעד אחורה
                                        </button>
                                        <form action="/admin/tenders/stepBackDecision" id="stepbackdecision" method="post" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="app_id" value="{{ $application->id }}">
                                            <input type="hidden" name="app_status" value="{{ $application->status }}">
                                        </form>
                                    </div>
                                    @endif
                                @endif

                            </div>
                        @endforeach
                    </div>
                    <div style="display:flex;flex-direction: column;align-items: flex-start;}}" id="ifdecfile2">
                        @if (
                            ($decfile &&
                                ($ifnotapprovedfiles === 'nono' || $ifnotapprovedfiles == 0) &&
                                !($decision->decision_1 || $decision->decision_1_a || $decision->decision_1_b || $decision->decision_2) &&
                                !($decision->decision_3 || $decision->decision_4) &&
                                ($decision->decision_5 != 1 && $decision->decision_6 != 1 && ($decision->decision_rejectedbyuser != 1))))
                            <div style="font-weight: 700; ">עמידה בתנאי סף</div>
                        @endif
                    </div>
                    <div>
                        <div id="buttons-content">
                            @if (
                                ($decfile &&
                                    ($ifnotapprovedfiles === 'nono' || $ifnotapprovedfiles == 0) &&
                                    (!$decision->decision_1 &&
                                        !$decision->decision_1_a &&
                                        !$decision->decision_1_b &&
                                        !$decision->decision_2 &&
                                        !$decision->decision_3 &&
                                        !$decision->decision_4) &&
                                    !empty($metaJson5)
                                   )
                                    )
                                <div>
                                    <button type="button" class="apps-btn btn float-right ml-3"
                                        onclick="cond_details(this, 0,{{ $application->id }},[{'type':'select','class':'cancel_file_sel_approve','option':['--בחר--','ציפיות שכר','בלי ציפיות שכר']}, {'type':'textarea','class':'cancel_file_remarks','rows':'4'}], 'width: 697px;')">
                                        אישור
                                    </button>
                                    <button type="button" class="apps-btn btn float-right ml-3"
                                        onclick="cond_details(this, 1,{{ $application->id }},
[{'type':'select','class':'cancel_file_sel_reject','option':['--בחר--','דחייה רגילה']}, {'type':'textarea','class':'cancel_file_text','rows':'4'}], 'width: 697px;')">
                                        דחייה
                                    </button>
                                </div>
                            @elseif (($decision->decision_1 || $decision->decision_1_a || $decision->decision_1_b) && !$decision->decision_2 || $app_dec->last_committee_invitation_send || $decision->invitation_rejected_by_user)
                                @if (isset($email_msg))
                                    <div style="color: green;text-align: right;">{{ $email_msg }}</div>
                                @endif
                                <div style="font-weight: 700; ">זימון לראיון ראשוני/בחינה בכתב</div>
                                <div>
                                    <!--
                <div>
                 <label class="checkbox">
                  <input type="checkbox" name="interview" value="ראיון ראשוני" id="interview_yes">
                  <span class="virtual"></span>
                  <span style="font-weight: 500;">ראיון ראשוני</span>
                 </label>
                </div>
                -->
                                    <div data-show_type="interview_yes" style="display: none;">
                                        <div class="summons-user">
                                            <div class="input-control">
                                                <label>
                                                    <input type="text" name="interview_date" placeholder="הזן תאריך"
                                                        style="font-size: 12px;">
                                                </label>
                                            </div>
                                            <div class="input-control">
                                                <label>
                                                    <input type="text" name="interview_time" placeholder="הזן שעה"
                                                        style="font-size: 12px;">
                                                </label>
                                            </div>
                                            <div class="input-control">
                                                <label>
                                                    <input type="text" name="interview_place" placeholder="הזן מיקום"
                                                        style="font-size: 12px;">
                                                </label>
                                            </div>
                                            <div class="input-control">
                                                <label>
                                                    <textarea class="detail cancel_file_text" name="interview_msg" id="interview_msg" placeholder="הזן הערה"
                                                        style="font-size: 12px;" row="4"></textarea>
                                                    <button style="float: right;" type="button"
                                                        class="apps-btn btn ml-3"
                                                        onclick="send_email('interview',{{ $application->id }}, {{ $p5 }})">
                                                        שלח זימון
                                                    </button>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @if (!empty($email_msg_interview) && !empty($interview_email))
                                        <div style="color: green;text-align: right;">{{ $email_msg_interview }}</div>
                                        <div class="mt-3 mb-2" style="overflow: hidden;padding-bottom: 10px"
                                            id="buttons-content">
                                            <h3 class="title" style="margin-bottom: 5px;">הזמנה לראיון</h3>
                                            <div class="file-content">
                                                <a href="{{ asset('upload/admin/' . $interview_email) }}" target="_blank"
                                                    rel="noopener noreferrer" style="margin-bottom: 5px">
                                                    <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                                                </a>
                                                <span class="doc-filename">Answer.pdf</span>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($tender->is_test_required)
                                        <div>
                                            <label class="checkbox">
                                                <input @checked($app_dec->selected_interview_time) type="checkbox" name="test"
                                                    value="בחינה בכתב" id="test_yes">
                                                <span class="virtual"></span>
                                                <span style="font-weight: 500;">בחינה בכתב</span>
                                            </label>
                                        </div>
                                        <div data-show_type="test_yes"
                                            style="display: {{ $app_dec->selected_interview_time ? 'block' : 'none' }};">
                                            <div class="summons-user" id="test_info_block">

                                                @if ($app_dec->approved_interview_time)
                                                    <div style="color: green;">
                                                        זמן שנבחר: {{ $app_dec->approved_interview_time }}
                                                    </div>
                                                @endif

                                                @if ($app_dec->selected_interview_time)
                                                    @foreach (json_decode($app_dec->selected_interview_time) as $date)
                                                        <div class="input-group date {{ $loop->first ? 'first' : '' }}">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-danger input-delete-btn mt-0 p-0"
                                                                    data-type="date" style="min-width: 25px"
                                                                    type="button"><i class="fas fa-times"></i></button>
                                                            </div>
                                                            <input class="form-control" type="text"
                                                                value="{{ $date }}" name="test_date[]"
                                                                placeholder="הזן תאריך" style="font-size: 12px;">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-info input-copy-btn mt-0 p-0"
                                                                    data-type="date" style="min-width: 25px"
                                                                    type="button"><i class="fas fa-plus"></i></button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="input-group date first">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-danger input-delete-btn mt-0 p-0"
                                                                data-type="date" style="min-width: 25px"
                                                                type="button"><i class="fas fa-times"></i></button>
                                                        </div>
                                                        <input class="form-control" type="text" name="test_date[]"
                                                            placeholder="הזן תאריך" style="font-size: 12px;">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-info input-copy-btn mt-0 p-0"
                                                                data-type="date" style="min-width: 25px"
                                                                type="button"><i class="fas fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="date_extra_wrapper"></div>
                                                {{-- <div class="input-group time first">
											<div class="input-group-append">
												<button class="btn btn-danger input-delete-btn mt-0 p-0" data-type="time" style="min-width: 25px" type="button"><i class="fas fa-times"></i></button>
											</div>
											<input class="form-control" type="text" name="test_time[]" placeholder="הזן שעה" style="font-size: 12px;">
											<div class="input-group-prepend">
												<button class="btn btn-info input-copy-btn mt-0 p-0" data-type="time" style="min-width: 25px" type="button"><i class="fas fa-plus"></i></button>
											</div>
										</div> --}}
                                                <div class="time_extra_wrapper"></div>

                                                {{-- place --}}
                                                @if ($app_dec->approved_interview_place)
                                                    <div style="color: green;">
                                                        מיקום שנבחר {{ $app_dec->approved_interview_place }}
                                                    </div>
                                                @endif
                                                @if ($app_dec->selected_interview_place)
                                                    @foreach (json_decode($app_dec->selected_interview_place) as $place)
                                                        <div class="input-group place {{ $loop->first ? 'first' : '' }}">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-danger input-delete-btn mt-0 p-0"
                                                                    data-type="place" style="min-width: 25px"
                                                                    type="button"><i class="fas fa-times"></i></button>
                                                            </div>
                                                            <input class="form-control" type="text"
                                                                value="{{ $place }}" name="test_place[]"
                                                                placeholder="הזן מיקום" style="font-size: 12px;">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-info input-copy-btn mt-0 p-0"
                                                                    data-type="place"style="min-width: 25px"
                                                                    type="button"><i class="fas fa-plus"></i></button>
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="input-group place first">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-danger input-delete-btn mt-0 p-0"
                                                                data-type="place" style="min-width: 25px"
                                                                type="button"><i class="fas fa-times"></i></button>
                                                        </div>
                                                        <input class="form-control" type="text" name="test_place[]"
                                                            placeholder="הזן מיקום" style="font-size: 12px;">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-info input-copy-btn mt-0 p-0"
                                                                data-type="place"style="min-width: 25px" type="button"><i
                                                                    class="fas fa-plus"></i></button>
                                                        </div>

                                                    </div>
                                                @endif
                                                {{-- place --}}

                                                <div class="place_extra_wrapper">

                                                </div>
                                                <div class="input-control">
                                                    <label>
                                                        <textarea class="detail cancel_file_text" name="test_msg" id="test_msg" placeholder="הזן הערה"
                                                            style="font-size: 12px;" row="4"></textarea>
                                                        <button style="float: right;" type="button"
                                                            class="apps-btn btn ml-3"
                                                            onclick="send_email('test',{{ $application->id }}, {{ $p5 }})">
                                                            שלח זימון
                                                        </button>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if (!empty($email_msg_test) && !empty($test_email))
                                        <div style="color: green;text-align: right;">{{ $email_msg_test }}</div>
                                        <div class="mt-3 mb-2" style="overflow: hidden;padding-bottom: 10px"
                                            id="buttons-content">
                                            <h3 class="title" style="margin-bottom: 5px;">בחינה בכתב333</h3>
                                            <div class="file-content">
                                                <a href="{{ asset('upload/admin/' . $test_email) }}" target="_blank"
                                                    rel="noopener noreferrer" style="margin-bottom: 5px">
                                                    <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                                                </a>
                                                <span class="doc-filename">Answer.pdf</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div id="show_committee" style=";">
                                    <label class="checkbox">
                                        <input @checked($app_dec->approved_committee_time) type="checkbox" name="committee" value="ועדת בחינה" id="committee_yes">
                                        <span class="virtual"></span>
                                        <span style="font-weight: 500;">ועדת בחינה</span>
                                    </label>
                                </div>
                                @if ($app_dec->committee_invitation_approved_time)
                                <div class="text-success">Approved 2nd Invitation DateTime: {{ $app_dec->committee_invitation_approved_time }}</div>
                                @endif
                                <div id="committee_block" data-show_type="committee_yes"

                                @style([
                                    'display: none' => !$app_dec->approved_committee_time
                                ])>
                                    <div class="summons-user">
                                        <div class="input-control">
                                            <label>
                                                <input value="{{ now()->parse($app_dec->approved_committee_time)->format('d m, Y') }}" type="text" name="committee_date" placeholder="הזן תאריך"
                                                    style="font-size: 12px;">
                                            </label>
                                        </div>
                                        <div class="input-control">
                                            <label>
                                                <input value="{{ now()->parse($app_dec->approved_committee_time)->format('H:i') }}" type="text" name="committee_time" placeholder="הזן שעה"
                                                    style="font-size: 12px;">
                                            </label>
                                        </div>

                                        <div class="input-control">
                                            <label>
                                                <input value="{{ $app_dec->committee_selected_place }}" type="text" name="committee_place" placeholder="הזן מיקום"
                                                    style="font-size: 12px;">
                                            </label>

                                        </div>
                                        <div class="input-control">
                                            <label>
                                                <textarea class="detail cancel_file_text" name="committee_msg" id="committee_msg" placeholder="הזן הערה"
                                                    style="font-size: 12px;" row="4"></textarea>
                                                <button style="float: right;" type="button" class="apps-btn btn ml-3"
                                                    onclick="send_email('committee',{{ $application->id }}, {{ $p5 }})">
                                                    שלח זימון
                                                </button>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @if (!empty($email_msg_committee) && !empty($committee_email))
                                    <div style="color: green;text-align: right;">{{ $email_msg_committee }}</div>
                                    <div class="mt-3 mb-2" style="overflow: hidden;padding-bottom: 10px"
                                        id="buttons-content">
                                        <h3 class="title" style="margin-bottom: 5px;">ועדת בחינה</h3>

                                        <div class="file-content">
                                            <a href="{{ asset('upload/admin/' . $committee_email) }}" target="_blank"
                                                rel="noopener noreferrer" style="margin-bottom: 5px">
                                                <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                                            </a>
                                            <span class="doc-filename">Answer.pdf</span>
                                        </div>




                                        @if ($decision->decision_5)
                                        <div
                                            style="display: flex; flex-direction: row; justify-content: space-between;  margin-bottom: 10px;">
                                            <div>
                                                <button type="button" class="apps-btn btn float-right ml-3"
                                                    onclick="document.getElementById('show_committee').style.display = 'block';">
                                                    שלח מכתב מתוקן לוועדת בחינה
                                                </button>
                                            </div>
                                            <div><!--&& empty($email_msg_committee) && empty($committee_email)-->
                                                <!--<button type="button" class="apps-btn btn float-right ml-3"
                   onclick="cond_details(this, 4,{{ $application->id }},
[{'type':'select','class':'cancel_file_sel_reject','option':['--בחר--','דחייה רגילה','ביטול ההליך המכרזי']},								 {'type':'textarea','class':'cancel_file_text','it':'text','placeholder':'הערות'}], 'width: 700px;')">
                  דחייה
                 </button>-->
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                @endif
                                @if (!empty($email_msg_committee_approve))
                                    <div style="color: green;text-align: right;">{{ $email_msg_committee_approve }}</div>
                                    @if ($application->status == 'Committee')
                                            <div class="decisionapproverow" style="display: flex; flex-direction: row;">
                                                <div>
                                                    <button type="button" class="apps-btn btn float-right ml-3"
                                                        onclick="cond_details(this, 3,{{ $application->id }},[{'type':'select','class':'cancel_file_sel','option':['--בחר--','מכתב כשיר 3','מכתב כשיר 2','מצריך מבדק מהימנות','מעבר שלב א','קבלת מועמד לעבודה']},{'type':'textarea','class':'cancel_file_text','it':'text','placeholder':'הערות'}], 'width: 700px;')">
                                                        אישור
                                                    </button>
                                                </div>
                                                <div>
                                                    <button type="button" class="apps-btn btn float-right ml-3"
                                                        onclick="cond_details(this, 4,{{ $application->id }},
    [{'type':'select','class':'cancel_file_sel_reject','option':['--בחר--','דחייה רגילה','ביטול ההליך המכרזי','מכרז שנדחה','אי הגעה לוועדה']},{'type':'textarea','class':'cancel_file_text','it':'text','placeholder':'הערות'}], 'width: 700px;')
    ">
                                                        דחייה
                                                    </button>
                                                </div>
                                            </div>
                                    @endif
                                @endif
                                @php
                                    $buttonrow = true;
                                @endphp
                                @foreach ($decfile as $decline)
                                    @if (
                                        !$decision->decision_2 &&
                                            !$decision->decision_3 &&
                                            !$decision->decision_3_a &&
                                            !$decision->decision_3_b &&
                                            !$decision->decision_4 &&
                                            ($decline->file_name == 'decisionapprove0.pdf' || $decline->file_name == 'decisionapprove0a.pdf') &&
                                            empty($email_msg_committee) &&
                                            empty($committee_email) && $decision->decision_rejectedbyuser != 1)
                                        @if ($buttonrow)
                                            <div style="display: inline;">
                                                <div>
                                                    <button type="button" class="apps-btn btn float-right ml-3"
                                                        onclick="document.getElementById('show_committee').style.display = 'block';">
                                                        אישור
                                                    </button>
                                                </div>
                                                {{-- after committee --}}
                                                <div><!--&& empty($email_msg_committee) && empty($committee_email)-->
                                                    <button type="button" class="apps-btn btn float-right ml-3"
                                                        onclick="cond_details(this, 4,{{ $application->id }},
    [{'type':'select','class':'cancel_file_sel_reject','option':['--בחר--','דחייה רגילה','ביטול ההליך המכרזי','מכרז שנדחה','אי הגעה לוועדה']},{'type':'textarea','class':'cancel_file_text','it':'text','placeholder':'הערות'}], 'width: 700px;')
    ">
                                                        דחייה
                                                    </button>
                                                </div>
                                                {{-- step back --}}
                                                @if ($appstep->stepback == 0)
                                                <div class="stepbackfirst"><!--&& empty($email_msg_committee) && empty($committee_email)-->
                                                    <button type="button" class="apps-btn btn float-right ml-3"
                                                        onclick="stepBackDecision()" data-id="888">
                                                        צעד אחורה
                                                    </button>
                                                    <form action="/admin/tenders/stepBackDecision" id="stepbackdecision" method="post" style="display: none;">
                                                        @csrf
                                                        <input type="hidden" name="app_id" value="{{ $application->id }}">
                                                        <input type="hidden" name="app_status" value="{{ $application->status }}">
                                                    </form>
                                                </div>
                                                @endif
                                            </div>
                                            @php
                                                $buttonrow = false;
                                            @endphp
                                        @endif

                                    @endif

                                        @if (
                                            !$decision->decision_2 &&
                                            !$decision->decision_3 &&
                                            !$decision->decision_3_a &&
                                            !$decision->decision_3_b &&
                                            !$decision->decision_4 &&
                                            ($decline->file_name == 'decisionapprove0.pdf' || $decline->file_name == 'decisionapprove0a.pdf') &&
                                            !empty($email_msg_committee) &&
                                            !empty($committee_email)  && $decision->decision_rejectedbyuser != 1)
                                            @if ($application->status != 'FinalReject')
                                                <div class="decisionapproverow" style="display: flex; flex-direction: row;">
                                                    <div>
                                                        <button type="button" class="apps-btn btn float-right ml-3"
                                                            onclick="cond_details(this, 3,{{ $application->id }},[{'type':'select','class':'cancel_file_sel','option':['--בחר--','מכתב כשיר 3','מכתב כשיר 2','מצריך מבדק מהימנות','מעבר שלב א','קבלת מועמד לעבודה']},{'type':'textarea','class':'cancel_file_text','it':'text','placeholder':'הערות'}], 'width: 700px;')">
                                                            אישור
                                                        </button>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="apps-btn btn float-right ml-3"
                                                            onclick="cond_details(this, 4,{{ $application->id }},
        [{'type':'select','class':'cancel_file_sel_reject','option':['--בחר--','דחייה רגילה','ביטול ההליך המכרזי','מכרז שנדחה','אי הגעה לוועדה']},{'type':'textarea','class':'cancel_file_text','it':'text','placeholder':'הערות'}], 'width: 700px;')
        ">
                                                            דחייה
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif




                                    <div style="margin-bottom: 20px;margin-left: 20px;width: 130px;">
                                        @if (
                                            ($decision->decision_4 &&
                                                ($decline->file_name === 'decisionapprove1.pdf' || $decline->file_name === 'decisionreject1.pdf')) ||
                                                ($decline->file_name === 'decisionapprove2.pdf' || $decline->file_name === 'decisionreject2.pdf') ||
                                                $decline->file_name === 'decisionapprove3.pdf' ||
                                                $decline->file_name === 'decisionapprove4.pdf' ||
                                                $decline->file_name === 'decisionapprove5.pdf'  && $decision->decision_rejectedbyuser != 1)
                                            <span style="font-weight: 700">אישור/ דחיה</span>
                                        @endif
                                        @if (
                                            $decline->file_name === 'decisionapprove1.pdf' ||
                                                $decline->file_name === 'decisionapprove2.pdf' ||
                                                $decline->file_name === 'decisionapprove3.pdf' ||
                                                $decline->file_name === 'decisionapprove4.pdf' ||
                                                $decline->file_name === 'decisionapprove5.pdf')
                                            <img src="/img/allok.png" />
                                            <span class="captiogreen adminlighthdr">
                                                אושר
                                            </span>
                                            <span class="file-title" style="font-weight: 400;text-align: right">תשובה לאחר
                                                מכרז</span>
                                            <a href="{{ asset('upload/admin/' . $decline->url . '') }}" target="_blank"
                                                rel="noopener noreferrer" style="margin-bottom: 5px"
                                                title="decision.pdf">
                                                <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                                                <span class="type pdf"></span>
                                            </a>
                                            {{-- step back --}}
                                            @if ($appstep->stepback == 0 && $application->status!='Rejected' && $application->status!='Accepted')
                                                <div class="stepbacksecond">
                                                    <button type="button" class="apps-btn btn float-right ml-3"
                                                        onclick="stepBackDecision()" data-id="111">
                                                        צעד אחורה
                                                    </button>
                                                    <form action="/admin/tenders/stepBackDecision" id="stepbackdecision" method="post" style="display: none;">
                                                        @csrf
                                                        <input type="hidden" name="app_id" value="{{ $application->id }}">
                                                        <input type="hidden" name="app_status" value="{{ $application->status }}">
                                                    </form>
                                                </div>
                                                <div class="decisionapproverow"></div>
                                            @else
                                                <div class="decisionapproverow" style="display: flex; flex-direction: row;">
                                                    <div>
                                                        <button type="button" class="apps-btn btn float-right ml-3"
                                                            onclick="cond_details(this, 3,{{ $application->id }},[{'type':'select','class':'cancel_file_sel','option':['--בחר--','מכתב כשיר 3','מכתב כשיר 2','מצריך מבדק מהימנות','מעבר שלב א','קבלת מועמד לעבודה']},{'type':'textarea','class':'cancel_file_text','it':'text','placeholder':'הערות'}], 'width: 700px;')">
                                                            אישור
                                                        </button>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="apps-btn btn float-right ml-3"
                                                            onclick="cond_details(this, 4,{{ $application->id }},
        [{'type':'select','class':'cancel_file_sel_reject','option':['--בחר--','דחייה רגילה','ביטול ההליך המכרזי','מכרז שנדחה','אי הגעה לוועדה']},{'type':'textarea','class':'cancel_file_text','it':'text','placeholder':'הערות'}], 'width: 700px;')
        ">
                                                            דחייה
                                                        </button>
                                                    </div>
                                                    @if ($appstep->stepback == 0)
                                                    <div>
                                                        <button type="button" class="apps-btn btn float-right ml-3"
                                                            onclick="stepBackDecision()" data-id="777">
                                                            צעד אחורה
                                                        </button>
                                                        <form action="/admin/tenders/stepBackDecision" id="stepbackdecision" method="post" style="display: none;">
                                                            @csrf
                                                            <input type="hidden" name="app_id" value="{{ $application->id }}">
                                                            <input type="hidden" name="app_status" value="{{ $application->status }}">
                                                        </form>
                                                    </div>
                                                    @endif
                                                </div>
                                            @endif
                                        @endif
                                        @if (
                                            $decline->file_name === 'decisionreject1.pdf' ||
                                                $decline->file_name === 'decisionreject2.pdf' ||
                                                $decline->file_name === 'decisionreject0a.pdf')
                                            <img src="/img/nok.png" />
                                            <span class="captiored">
                                                נדחה
                                            </span>
                                            <span class="file-title" style="font-weight: 400;text-align: right">דחיית מנהל
                                                אגף</span>
                                            <a href="{{ asset('upload/admin/' . $decline->url . '') }}" target="_blank"
                                                rel="noopener noreferrer" style="margin-bottom: 5px"
                                                title="decision.pdf">
                                                <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                                                <span class="type pdf"></span>
                                            </a>
                                            {{-- step back --}}
                                                @if ($decision->decision_committee)
                                                    @if ($application->status == 'Committee')
                                                    <div class="decisionapproverow" style="display: flex; flex-direction: row;">
                                                        <div>
                                                            <button type="button" class="apps-btn btn float-right ml-3"
                                                                onclick="cond_details(this, 3,{{ $application->id }},[{'type':'select','class':'cancel_file_sel','option':['--בחר--','מכתב כשיר 3','מכתב כשיר 2','מצריך מבדק מהימנות','מעבר שלב א','קבלת מועמד לעבודה']},{'type':'textarea','class':'cancel_file_text','it':'text','placeholder':'הערות'}], 'width: 700px;')">
                                                                אישור
                                                            </button>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="apps-btn btn float-right ml-3"
                                                                onclick="cond_details(this, 4,{{ $application->id }},
            [{'type':'select','class':'cancel_file_sel_reject','option':['--בחר--','דחייה רגילה','ביטול ההליך המכרזי','מכרז שנדחה','אי הגעה לוועדה']},{'type':'textarea','class':'cancel_file_text','it':'text','placeholder':'הערות'}], 'width: 700px;')
            ">
                                                                דחייה
                                                            </button>
                                                        </div>
                                                    </div>
                                                    @else
                                                        @if ($application->status == 'Accepted' || $application->status == 'Accepted A')
                                                        <div class="decisionapproverow" style="display: flex; flex-direction: row;">
                                                            <div>
                                                                <button type="button" class="apps-btn btn float-right ml-3"
                                                                    onclick="cond_details(this, 3,{{ $application->id }},[{'type':'select','class':'cancel_file_sel','option':['--בחר--','מכתב כשיר 3','מכתב כשיר 2','מצריך מבדק מהימנות','מעבר שלב א','קבלת מועמד לעבודה']},{'type':'textarea','class':'cancel_file_text','it':'text','placeholder':'הערות'}], 'width: 700px;')">
                                                                    אישור
                                                                </button>
                                                            </div>
                                                            <div>
                                                                <button type="button" class="apps-btn btn float-right ml-3"
                                                                    onclick="cond_details(this, 4,{{ $application->id }},
                [{'type':'select','class':'cancel_file_sel_reject','option':['--בחר--','דחייה רגילה','ביטול ההליך המכרזי','מכרז שנדחה','אי הגעה לוועדה']},{'type':'textarea','class':'cancel_file_text','it':'text','placeholder':'הערות'}], 'width: 700px;')
                ">
                                                                    דחייה
                                                                </button>
                                                            </div>
                                                            @if ($appstep->stepback == 0)
                                                            <div>
                                                                <button type="button" class="apps-btn btn float-right ml-3"
                                                                    onclick="stepBackDecision()" data-id="777">
                                                                    צעד אחורה
                                                                </button>
                                                                <form action="/admin/tenders/stepBackDecision" id="stepbackdecision" method="post" style="display: none;">
                                                                    @csrf
                                                                    <input type="hidden" name="app_id" value="{{ $application->id }}">
                                                                    <input type="hidden" name="app_status" value="{{ $application->status }}">
                                                                </form>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        @else
                                                            @if ($appstep->stepback == 0)
                                                            <div class="stepbacksecond">
                                                                <button type="button" class="apps-btn btn float-right ml-3"
                                                                    onclick="stepBackDecision()" data-id="777">
                                                                    צעד אחורה
                                                                </button>
                                                                <form action="/admin/tenders/stepBackDecision" id="stepbackdecision" method="post" style="display: none;">
                                                                    @csrf
                                                                    <input type="hidden" name="app_id" value="{{ $application->id }}">
                                                                    <input type="hidden" name="app_status" value="{{ $application->status }}">
                                                                </form>
                                                            </div>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @else
                                                    @if ($appstep->stepback == 0)
                                                    <div class="stepbackfirst">
                                                        <button type="button" class="apps-btn btn float-right ml-3"
                                                            onclick="stepBackDecision()" data-id="777">
                                                            צעד אחורה
                                                        </button>
                                                        <form action="/admin/tenders/stepBackDecision" id="stepbackdecision" method="post" style="display: none;">
                                                            @csrf
                                                            <input type="hidden" name="app_id" value="{{ $application->id }}">
                                                            <input type="hidden" name="app_status" value="{{ $application->status }}">
                                                        </form>
                                                    </div>
                                                    @endif
                                                @endif
                                            </div>
                                        @endif
                                        @if (
                                            !$decision->decision_5 &&
                                                ($decline->file_name === 'decisionapprove1.pdf' ||
                                                    $decline->file_name === 'decisionapprove2.pdf' ||
                                                    $decline->file_name === 'decisionapprove3.pdf' ||
                                                    $decline->file_name === 'decisionapprove4.pdf' ||
                                                    $decline->file_name === 'decisionapprove5.pdf') &&
                                                empty($gotit_email))
                                            @if (isset($email_msg_gotit))
                                                <div style="color: green;text-align: right;">{{ $email_msg_gotit }}</div>
                                            @endif
                                            @if ($application->status=='Rejected')
                                            <div style="font-weight: 700; ">זימון לאחר זכיה במכרז</div>
                                            <div>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="gotit" value="זימון לאחר זכיה במכרז"
                                                        id="gotit_yes">
                                                    <span class="virtual"></span>
                                                    <span style="font-weight: 500;">זימון לאחר זכיה במכרז</span>
                                                </label>
                                            </div>
                                            @endif
                                            <div data-show_type="gotit_yes" style="display: none;">
                                                <div class="summons-user">
                                                    <div class="input-control">
                                                        <label>
                                                            <input type="text" name="gotit_date"
                                                                placeholder="הזן תאריך" style="font-size: 12px;">
                                                        </label>
                                                    </div>
                                                    <div class="input-control">
                                                        <label>
                                                            <input type="text" name="gotit_time" placeholder="הזן שעה"
                                                                style="font-size: 12px;">
                                                        </label>
                                                    </div>

                                                    <div class="input-control">
                                                        <label>
                                                            <input type="text" name="gotit_place"
                                                                placeholder="הזן מיקום" style="font-size: 12px;">
                                                        </label>

                                                    </div>
                                                    <div class="input-control">
                                                        <label>
                                                            <textarea class="detail cancel_file_text" name="gotit_msg" id="gotit_msg" placeholder="הזן הערה"
                                                                style="font-size: 12px;" row="4"></textarea>
                                                            <button style="float: right;" type="button"
                                                                class="apps-btn btn ml-3"
                                                                onclick="send_email('gotit',{{ $application->id }}, {{ $p5 }})">
                                                                שלח זימון
                                                            </button>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($decision->status!='Accepted' && $decision->decision_rejectedbyuser != 1 )
                                            <div>
                                                {{-- <button type="button" class="apps-btn btn float-right ml-3"
                                                    onclick="cond_details(this, 5,{{ $application->id }},
			[{'type':'select','class':'cancel_file_sel_reject','option':['--בחר--','מכתב קבלת מועמד לעבודה לאחר ועדת בחינה','מכתב קבלת מועמד לעבודה לאחר ועדת בחינה- מצריך מבדק מהימנות','מכתב קבלת מועמד לעבודה לאחר ועדת בחינה- מעבר שלב א','מכתב כשיר 2','מכתב כשיר 3','מכתב דחיית מועמד לאחר ועדת בחינה','ביטול ההליך המכרזי','פרסום נוסף של המכרז']},
			{'type':'textarea','class':'cancel_file_text','it':'text','placeholder':'הערות'}], 'width: 700px;')">
                                                    שליחת תשובה לאחר הפסד/ זכייה במכרז
                                                </button> --}}
                                            </div>
                                            @endif
                                        @elseif($decision->decision_5)
                                            @if (
                                                $decline->file_name === 'decisionapprove1.pdf' ||
                                                    $decline->file_name === 'decisionapprove2.pdf' ||
                                                    $decline->file_name === 'decisionapprove3.pdf')
                                                <img src="/img/allok.png" />
                                                <span class="captiogreen adminlighthdr">
                                                    אושר
                                                </span>
                                                <span class="file-title" style="font-weight: 400;text-align: right">אישור
                                                    מנהל אגף</span>
                                                <a href="{{ asset('upload/admin/' . $decline->url . '') }}"
                                                    target="_blank" rel="noopener noreferrer" style="margin-bottom: 5px"
                                                    title="decision.pdf">
                                                    <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                                                    <span class="type pdf"></span>
                                                </a>
                                                {{-- step back --}}
                                                @if ($appstep->stepback == 0)
                                                <div>
                                                    <button type="button" class="apps-btn btn float-right ml-3"
                                                        onclick="stepBackDecision()" data-id="222">
                                                        צעד אחורה
                                                    </button>
                                                    <form action="/admin/tenders/stepBackDecision" id="stepbackdecision" method="post" style="display: none;">
                                                        @csrf
                                                        <input type="hidden" name="app_id" value="{{ $application->id }}">
                                                        <input type="hidden" name="app_status" value="{{ $application->status }}">
                                                    </form>
                                                </div>
                                                @endif
                                            @endif
                                            @if ($decline->file_name === 'decisionreject0d.pdf')
                                                <img src="/img/nok.png" />
                                                <span class="captiored">
                                                    נדחה
                                                </span>
                                                <span class="file-title" style="font-weight: 400;text-align: right">דחיית
                                                    מנהל אגף</span>
                                                <a href="{{ asset('upload/admin/' . $decline->url . '') }}"
                                                    target="_blank" rel="noopener noreferrer" style="margin-bottom: 5px"
                                                    title="decision.pdf">
                                                    <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                                                    <span class="type pdf"></span>
                                                </a>
                                                {{-- step back --}}
                                                @if ($appstep->stepback == 0)
                                                <div>
                                                    <button type="button" class="apps-btn btn float-right ml-3"
                                                        onclick="stepBackDecision()" data-id="333">
                                                        צעד אחורה
                                                    </button>
                                                    <form action="/admin/tenders/stepBackDecision" id="stepbackdecision" method="post" style="display: none;">
                                                        @csrf
                                                        <input type="hidden" name="app_id" value="{{ $application->id }}">
                                                        <input type="hidden" name="app_status" value="{{ $application->status }}">
                                                    </form>
                                                </div>
                                                @endif
                                            @endif
                                        @endif

                                    </div>
                                @endforeach
                                @if (!empty($email_msg_gotit) && !empty($gotit_email))
                                    <div style="color: green;text-align: right;">{{ $email_msg_gotit }}</div>
                                    <div class="mt-3 mb-2" style="overflow: hidden;padding-bottom: 10px"
                                        id="buttons-content">
                                        <h3 class="title" style="margin-bottom: 5px;">זימון לאחר זכיה במכרז222</h3>
                                        <div class="file-content">
                                            <a href="{{ asset('upload/admin/' . $gotit_email) }}" target="_blank"
                                                rel="noopener noreferrer" style="margin-bottom: 5px">
                                                <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                                            </a>
                                            <span class="doc-filename">Answer.pdf</span>
                                        </div>
                                    </div>
                                @endif
                            @endif


                            @if ($decfile)
                    <div style="display:inline;flex-direction: column" id="ifdecfile">
                        @foreach ($decfile as $decline)
                            <div style="margin-bottom: 20px;margin-left: 20px;width: 135px;">

                                @php
                                    $decision_arr = (array) $decision;
                                @endphp
                                @if (($decline->file_name === 'decisionreject0b.pdf' && $decision_arr['2nd_invitation_rejected']))
                                    <img src="/img/nok.png" />
                                    <span class="captiored">
                                        נדחה
                                    </span>
                                    <span class="" style="font-weight: 400;text-align: right">הסרת מועמדות</span>
                                    <a href="{{ asset('upload/admin/' . $decline->url . '') }}" target="_blank"
                                        rel="noopener noreferrer" style="margin-bottom: 5px" title="decision.pdf">
                                        <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                                        <span class="type pdf"></span>
                                    </a>
                                @elseif($decline->file_name === 'decisionreject0_fd.pdf' || $decline->file_name === 'decisionreject0_fr.pdf')
                                <img src="/img/nok.png" />
                                    <span class="captiored">
                                        נדחה
                                    </span>
                                    {{-- <span class="file-title" style="font-weight: 400;text-align: right">אישור/ דחייה תנא
                                        סף</span> --}}
                                    <a href="{{ asset('upload/admin/' . $decline->url . '') }}" target="_blank"
                                        rel="noopener noreferrer" style="margin-bottom: 5px" title="decision.pdf">
                                        <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                                        <span class="type pdf"></span>
                                    </a>
                                    {{-- step back --}}
                                    @if ($appstep->stepback == 0)
                                    <div>
                                        <button type="button" class="apps-btn btn float-right ml-3"
                                            onclick="stepBackDecision()" data-id="444">
                                            צעד אחורה
                                        </button>
                                        <form action="/admin/tenders/stepBackDecision" id="stepbackdecision" method="post" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="app_id" value="{{ $application->id }}">
                                            <input type="hidden" name="app_status" value="{{ $application->status }}">
                                        </form>
                                    </div>
                                    @endif
                                @endif

                            </div>
                        @endforeach
                    </div>
                    @endif



                        </div>

                @endif
            </div>
            <div class="row w-100">
                <div class="col-2 mr-auto" id="send_custom_mail_wrap">
                    <label for=""><b>הוסף מייל שתרצה לשלוח אליו את כל קבצי המועמד</b></label>
                    <input type="email" name="send_custom_mail" class="form-control" id="send_custom_mail">
                    <input hidden type="number" name="app_id" id="send_custom_mail_app_id" value="{{ $application->id }}">
                    <button class="btn btn-sm btn-info" id="send_custom_mail_btn">לחץ כאן לשליחה</button>
                </div>
            </div>
            <div style="margin-bottom: 50px;">

                <a href="/admin/tenders/{{ $application->id }}/file-download" class="btn float-left"
                    onclick="">הורדת כלל המסמכים למחשב</a>
                <button class="btn float-left" onclick="approve_file_tk(this,0 )" style="margin-left: 8px;">אישור כל
                    הקבצים
                </button>
            </div>
        </main>
    </div>
    <script>
        $(document).ready(function() {
            $('.stepbackfirst').not(':last').hide();
            $('.stepbacksecond').not(':last').hide();
            $('.decisionapproverow').not(':last').hide();

            syncDateTimePicker();

            $('input[name="committee_date"]').datetimepicker({
                //   timepicker:false,
                format: 'd m, Y',
                mask: true,
                timepicker:false,
                minDate: "{{ now()->format('d F, Y') }}",

            });

            $('input[name="committee_time"]').datetimepicker({
                //   timepicker:false,
                datepicker:false,
                mask: true,
                format:'H:i'

            });

        });
        $(document).on('click', '.input-copy-btn', function(event) {
            event.preventDefault();
            /* Act on the event */
            var type = $(this).data('type')

            var clonedEle = $(`#test_info_block .input-group.${type}.first`).clone().removeClass('first').val('');

            $(`.${type}_extra_wrapper`).append(clonedEle)
            syncDateTimePicker();
        });

        $(document).on('click', '#send_custom_mail_btn', function(event) {
            event.preventDefault();
            /* Act on the event */
            var id = $('#send_custom_mail_wrap').find('#send_custom_mail_app_id').val()
            var mail = $('#send_custom_mail_wrap').find('#send_custom_mail').val()
            $('#send_custom_mail_btn').text('Sending...')
            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('customMailFileSend', ['did' => $application->id]) }}',
                    type: 'POST',
                    data: {
                        id: id,
                        email: mail
                    },
                })
                .done(function() {
                    console.log("success");
                    $('#send_custom_mail_btn').text('Files Sent')
                    $('#send_custom_mail_wrap').find('#send_custom_mail').val('')
                    setTimeout(() => {
                        $('#send_custom_mail_btn').text('נשלח מייל')
                    }, 5000);
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });


        });

        $(document).on('click', '.input-delete-btn', function(event) {
            event.preventDefault();
            /* Act on the event */
            $(this).parents('.input-group').not('.first').remove()
            syncDateTimePicker();
        });

        function stepBackDecision() {
            document.getElementById('stepbackdecision').submit();
        }

        function syncDateTimePicker() {
            // $('#test_info_block input[name="test_time[]"]').datetimepicker({
            //   datepicker:false,
            //   format: 'H:m',
            //   mask:true,
            // });
            $('#test_info_block input[name="test_date[]"]').datetimepicker({
                //   timepicker:false,
                formatDate: 'd M, Y, H:m',
                mask: true,
                minDate: "{{ now()->format('Y/m/d') }}",
                onSelectDate: function(a, b) {
                    // console.log(a,b)
                }
            });

        }

        // Function to upload mandatory test file
        function uploadMandatoryTestFile(applicationId) {
            var fileInput = document.getElementById('test_file_input');

            if (!fileInput.files || fileInput.files.length === 0) {
                alert('אנא בחר קובץ PDF להעלאה');
                return;
            }

            var file = fileInput.files[0];

            // Validate file type (PDF only)
            if (file.type !== 'application/pdf' && !file.name.toLowerCase().endsWith('.pdf')) {
                alert('רק קבצי PDF מותרים למבחן חובה');
                fileInput.value = ''; // Clear the input
                return;
            }

            // Validate file size (20MB max)
            if (file.size > 20971520) {
                alert('קובץ גדול מדי. הקובץ חייב להיות קטן מ-20 מגה');
                fileInput.value = ''; // Clear the input
                return;
            }

            var formData = new FormData();
            formData.append('test_file', file);

            // Show loading state
            var uploadButton = event.target;
            var originalText = uploadButton.textContent;
            uploadButton.textContent = 'מעלה קובץ...';
            uploadButton.disabled = true;
            uploadButton.style.opacity = '0.6';

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
                        alert('✅ קובץ מבחן PDF הועלה בהצלחה!');
                        // Hide the upload form and reload the page
                        hideMandatoryTestUpload();
                        window.location.reload();
                    } else {
                        alert('❌ שגיאה: ' + (result.error || 'שגיאה לא ידועה'));
                        // Reset button state
                        uploadButton.textContent = originalText;
                        uploadButton.disabled = false;
                        uploadButton.style.opacity = '1';
                    }
                },
                error: function(xhr, status, error) {
                    alert('❌ שגיאה בהעלאת הקובץ. אנא נסה שוב.');
                    console.error('Upload Error:', error);
                    console.error('Response:', xhr.responseText);
                    // Reset button state
                    uploadButton.textContent = originalText;
                    uploadButton.disabled = false;
                    uploadButton.style.opacity = '1';
                }
            });
        }

        // Function to show mandatory test upload form
        function showMandatoryTestUpload(applicationId) {
            document.getElementById('test_upload_form').style.display = 'inline-grid';
        }

        // Function to hide mandatory test upload form
        function hideMandatoryTestUpload() {
            document.getElementById('test_upload_form').style.display = 'none';
            document.getElementById('test_file_input').value = ''; // Clear file input
        }

        // Function to delete mandatory test file
        function deleteMandatoryTestFile(fileId) {
            if (confirm('האם אתה בטוח שברצונך למחוק את קובץ המבחן?')) {
                $.ajax({
                    url: '/admin/delete-test-file/' + fileId,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.success) {
                            alert('✅ קובץ המבחן נמחק בהצלחה');
                            window.location.reload();
                        } else {
                            alert('❌ שגיאה: ' + (result.error || 'שגיאה לא ידועה'));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('❌ שגיאה במחיקת הקובץ');
                        console.error('Delete Error:', error);
                    }
                });
            }
        }

        // Add file input validation on change
        $(document).ready(function() {
            $('#test_file_input').on('change', function() {
                var file = this.files[0];
                if (file) {
                    // Validate file type
                    if (file.type !== 'application/pdf' && !file.name.toLowerCase().endsWith('.pdf')) {
                        alert('❌ רק קבצי PDF מותרים למבחן חובה');
                        this.value = '';
                        return;
                    }

                    // Validate file size
                    if (file.size > 20971520) {
                        alert('❌ קובץ גדול מדי. הקובץ חייב להיות קטן מ-20 מגה');
                        this.value = '';
                        return;
                    }

                    // Show success message
                    console.log('✅ קובץ PDF נבחר בהצלחה: ' + file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)');
                }
            });

            // Track file downloads for security logging
            $(document).on('click', 'a[href*="/upload/"]', function(e) {
                var href = $(this).attr('href');
                var fileName = href.split('/').pop();
                var appId = '{{ $application->id ?? "unknown" }}';

                // Send async log request (don't block the download)
                $.ajax({
                    url: '/admin/log-file-access',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        file: fileName,
                        app_id: appId,
                        action: 'view'
                    },
                    async: true
                });
                // Allow the default action (open file in new tab)
            });
        });
    </script>
@endsection
