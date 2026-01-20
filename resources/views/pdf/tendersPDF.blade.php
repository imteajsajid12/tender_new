<div class="apps-card-body" style="padding-top:0">

    <table cellspacing="10" class="apps-list">
        <thead>
            <th>מס' מכרז</th>
            <th>שם מכרז</th>
            <th>נספח מכרז/משרה</th>
            <th>מצב מכרז/משרה</th>
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
                    <?php $id = explode('-', $line->generated_id); ?>
                    @if ($id && isset($id[1]))
                        <tr id="line_{{ $line->generated_id }}" class="<?php echo $line->status == 0 ? 'new' : ''; ?>">
                            <?php
                            
                            $use_id = $id[1];
                            $flag = 'flag';
                            $file = 'file';
                            
                            ?>
                            @if ($key < count($display_list) && $display_list[$key]['display_generated_id'] != '')
                                <td><span
                                        style="font-weight: 400">{{ $display_list[$key]['display_generated_id'] }}
                                    </span></td>
                            @else
                                <td><span style="font-weight: 400">{{ $line->generated_id }} </span></td>
                            @endif
                            <td width="250px">
                                @if (
                                    \Carbon\Carbon::now() < $line->finish_date &&
                                        $key < count($display_list) &&
                                        $display_list[$key]['display_generated_id'] != '')
                                    <a target=_blank
                                        href="/page5?tenderid={{ $line->generated_id }}&file={{ $is_contain_file[$id[1]][$file] }}&tenderdisplay={{ $display_list[$key]['display_generated_id'] }}"
                                        style="font-weight: 400">{{ $line->tname }}</a>
                                @else
                                    <a target="_blank" href="/not-active"
                                        style="font-weight: 400">{{ $line->tname }}</a>
                                @endif

                            </td>

                            <td>
                                <form id="form-{{ $line->id }}" class="form">

                                    <div style="display:flex;flex-direction:row;">
                                        <div>
                                            <div class="upload-block">
                                                <?php if (!empty($line->tender_file_name) && !empty($line->tender_file_url)) {
                                                    $css_hide = 'display:none';
                                                    $css_show = '';
                                                    $url = asset('upload/tender/' . $line->tender_file_url);
                                                    $download = 'download';
                                                    $filename = $line->tender_file_name;
                                                } else {
                                                    $css_show = 'display:none';
                                                    $css_hide = '';
                                                    $url = '/';
                                                    $download = '';
                                                    $filename = '';
                                                } ?>




                                                <a href="#" id="rcfile-upload-{{ $line->id }}"
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
                                                </label>

                                                <input id="cfile-upload-{{ $line->id }}" type="file"
                                                    name="file[]" multiple class="btn-file-upload"
                                                    onchange="fileChange(this, {{ $line->id }});"
                                                    accept="application/pdf" style="{{ $css_hide }}" />
                                            </div>
                                        </div>


                                    </div>

                                </form>
                            </td>

                            <td>
                                <select name="tender_status" id="tender_status"
                                    onchange="saveStatus(this,'<?php echo $line->generated_id; ?>');">
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
                            <?php
                            $date = new DateTime();
                            $date->setTimezone(new DateTimeZone('Asia/Jerusalem'));
                            
                            $fdate = $date->format('Y-m-d H:i:s');
                            ?>
                            @if ($fdate < $line->finish_date && $line->stopped == 0)
                                <td><span class="adminlighthdr">פעיל</span></td>
                            @elseif ($line->stopped == 1)
                                <td><span class="adminlighthdr">הסתיים</span></td>
                            @else
                                <td><span class="adminlighthdr">לא פעיל</span></td>
                            @endif
                            <td><span
                                    style="font-weight: 400">{{ date('d/m/Y', strtotime($line->finish_date)) }}</span>
                            </td>
                            <td> <?php if ($line->tname && $line->ccount > 0) {?><span><img src="/img/eye.png"> <a
                                        href="/admin/tenders/requestsorted/all/{{ $line->generated_id }}"
                                        style="font-weight: 400">הצגת הפניות</a></span><?php } else {
                        };?></td>
                            <td>
                                @if (\App\User::check_auth_user_permission(4))
                                    <a href="#"
                                        onClick="editA('<?php echo $line->generated_id; ?>', '<?php echo $line->tender_type; ?>')"><img
                                            src="/img/pen.png" /><span class="admintendercomment">עריכה</span></a>
                                @endif
                            </td>

                            <td>

                                <?php if($line->stopped) { ?>

                                @if (\App\User::check_auth_user_permission(6))
                                    <a href="#" onClick="continueA('<?php echo $line->generated_id; ?>')"><img
                                            src="/img/play.png" /><span class="admintendercomment">הפעל
                                            מכרז</span></a>
                                @endif
                                <?php } else   { ?>
                                @if (\App\User::check_auth_user_permission(5))
                                    <a href="#" onClick="stopA('<?php echo $line->generated_id; ?>')"><img
                                            src="/img/stop.png" /><span class="admintendercomment">מכרז
                                            שהסתיים</span></a>
                                @endif

                                <?php }?>
                            </td>
                            @if (\App\User::check_auth_user_permission(7))
                                <td><a href="#" onClick="dubA('<?php echo $line->generated_id; ?>')"><img
                                            src="/img/dublicate.png" /><span class="admintendercomment">שכפול
                                            מכרז</span></a>

                                </td>
                            @endif
                            <td>

                                @if (\App\User::check_auth_user_permission(2))
                                    <a href="#" onClick="delA('<?php echo $line->generated_id; ?>')">
                                        <img src="/img/del.png" /><span
                                            class="admintendercomment">מחיקה</span></a>
                                @endif
                            </td>
                            <td> <a href="#" onClick="get_logs('<?php echo $line->generated_id; ?>')">
                                    <img src="/img/openlogs-btn.png" /><span
                                        class="admintendercomment">יומן</span></a>
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
                                                <form id="upload_form"
                                                    action="/admin/upload-file/{{ $id[1] }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="input-control mr-0">
                                                        <div>צירוף תכולת מכרז:</div>
                                                        <span class="captiogreen adminlighthdr"
                                                            style="text-decoration: none;">
                                                            <input type="file" name="file"
                                                                class="typeahead form-control"
                                                                accept="application/pdf, image/jpeg, image/jpg, image/gif, image/png, image/jpe, image/tiff, image/bmp, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword" />
                                                            <button class="btn" style="display: inline-block;"
                                                                type="submit">הוסף</button>
                                                        </span>
                                                    </div>
                                                </form>
                                            @elseif (isset($id[1]) && $is_contain_file[$id[1]][$file])
                                                <a href="{{ asset('upload/admin/' . $is_contain_file[$id[1]][$file]) }}"
                                                    download style="margin-bottom: 5px;margin-left: 5px;">
                                                    הורדת קובץ צירוף תכולת מכרז
                                                </a>
                                            @endif
                                        </div>
                                        <div style="display:flex; flex-direction: column;">
                                            <a style="margin-left:5px;"
                                                href="/protocol?tenderid={{ $line->generated_id }}&tname={{ $line->tname }}"
                                                target="_blank">פרוטוקול</a>
                                            @if (!empty($files_protocol))
                                                @foreach ($files_protocol as $file)
                                                    @if ($file->app_id === $id)
                                                        <div>
                                                            <a style="margin-left:5px;"
                                                                href="{{ asset('upload/' . $file->url) }}"
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
                                            <a href="/zichron-devarim?tenderid={{ $line->generated_id }}&tname={{ $line->tname }}"
                                                target="_blank">זכרון דברים</a>

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