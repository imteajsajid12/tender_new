@extends('layouts.admin.header')
@section('content')
	<?php
	// var_dump($application);
	/*$metaJson1 = unserialize($application->p1_meta['metaJson']);
	$metaJson2 = unserialize($application->p2_meta['metaJson']);
	$metaJson3 = unserialize($application->p3_meta['metaJson']);*/
//echo('111');
//ec//ho(json_encode($metaJson1));
//	json_encode($application->ff);
//exit();
            // function showTitle($page)
            //     {
                //	global $ff,$application;
	              //  var_dump($application->ff);
                	//$ff0=$ff[0];
                //	var_dump($ff);
               // 	$ff2=$ff[2];
                	/*foreach($ff0 as $line)
                		{
			                echo(json_encode($line));

		                }
*/
	            //    var_dump($ff);


	            //     return $page;
                // }

	?>
    <script language="JavaScript">


    </script>
    <div class="content single-app">
        <main>
            <input type="hidden" name="appid_input" id="appid_input" value="{{$application->id}}">
            <div class="card-header single-card-header">
                <div class="h-right-bar">
                    <span>טופס {{$application->decision->generated_dec_id}} (2020-1{{$application->decision->id}}) </span>
                    <a href="/admin/tenders/requestsorted/all/{{$application->tenderid}}"
                       class="paginate apps-link rectangle"> <img
                                src="{{ asset('img/right-back.png') }}"></a>
                </div>
            </div>
            <div class="apps-card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
				<?php  $p_e = $application->st > 2 ? 'pointer-events: none' : ''; ?>
                <div class="container_child">

                    @if(!empty($application))
                        <table style="width: 100%" class="align-right">
                            <tr>
                                <td>
                                    <div class="app-head">מס’ פניה:</div>

                                    <div class="app-head-info"
                                         confirm-icon>{{"2020-".(100+$application->decision->id)}} {{$application->decision->generated_dec_id}}


                                    </div>
                                </td>
                                <td>
                                    <div class="app-head">שם הטופס:</div>
                                    <div class="app-head-info"
                                         confirm-icon>{{$application->decision->generated_dec_id}}


                                    </div>
                                    <div class="app-head-info">{{$application->tenderid}}</div>

                                </td>
                                <td>
                                    <div class="app-head">תאריך פנייה:</div>
                                    <div class="app-head-info">{{date('d/m/Y', strtotime($application->send_date))}}</div>
                                </td>
                                <td>
                                    <div class="app-head">שם הפונה:</div>
                                    <div class="app-head-info">{{ $application->decision->applicant_name}}</div>
                                </td>
                                <td>
                                    <div class="app-head">סטטוס:</div>
                                    <div class="app-head-info">{{\App\Applications::get_status($application->status)}}</div>
                                </td>
                            </tr>
                        </table>



                        @if(!empty($application->p1_meta['metaJson']))
							<?php

							?>

                        @else
                            <h3 style="color: red">qqלא ניתן לבצע פעולה נוספת, ישנם נתונים חסרים</h3>
                        @endif
                    @else
                        No application
                    @endif
                </div>
            </div>
            <div class="doc-name" style="float:right;margin-right: 50px;position: absolute;transform: translateY(-20px);">טופס הבקשה:</div>

            <div style="display:flex;flex-direction: row;margin:50px">
                <div style="display:flex;flex-direction: column">
                    <div>
						<?php
						if (!empty($allforms))
						{

						for ($i = 0;$i < 3;$i++)
						{

						$file = $allforms[$i];
						if (!isset($file->url)) continue;
						// echo(json_encode($file));
						// echo($file->url);
						//  exit();
						$file_1 = '';
						$tclass = '';
						$file_name = '';
						$tclass = '';

						?>
                        <div class="file-content">
                            <span class="file-title"> שלב {{$i+1}} </span>
                            <a href="{{asset('upload/'.$file->url)}}" download style="margin-bottom: 5px"
                               title="{{$file_1}}">
                                <img class="file-icon" src="{{ asset('img/file.jpg') }}">
								<?php if ($file->status == 1) {
									$tclass = 'approve';
								} elseif ($file->status == 2) {
									$tclass = 'cancel';
								} else {
									$tclass = '';
								}?>
                                <span class="type {{$tclass}}"></span>
                            </a>
                            <span class="doc-filename">{{$file_name}}</span>
							<?php
							if ($file->status == 3) {
								echo '<span class="doc-filename replace">ממתין לאישור</span>';
							}
							if ($file->status == 4) {
								echo '<span class="doc-filename replace">נשלחה בקשה למסמך אחר</span>';
							}
							?>
                            @if(\App\User::check_auth_user_AppPermission2($application,2))
                                <div>
                                    <button class="apps-btn" id="cancel_{{$file->id}}"
                                            onclick="cancel_file_tk(this, {{$file->id}} )" style="{{$p_e}}">דחה
                                    </button>
                                </div>
                                <div>
                                    <button class="apps-btn" onclick="approve_file_tk(this, {{$file->id}} )"
                                            style="{{$p_e}}"> אשר
                                    </button>
                                </div>
                            @endif
                        </div>
						<?php
						}
						}

						?></div>
                    <div>
                        @if(!empty($application->files))
                            <div style="text-align:right;margin-right:0px" class="doc-name">מסמכים לצירוף</div>
                            @foreach ($application->files as $file)


								<?php $file_name = explode('^^', $file->file_name);
								//echo(json_encode($file_name));
								//	echo(count($file_name));
								$file_1 = count($file_name) > 1 ? $file_name[1] : '';
								?>
                                <div class="file-content">
                                    <span class="file-title">{{isset($formFileNames[$file_1])?isset($formFileNames[$file_1]):$file_1}}</span>
                                    <a href="{{asset('upload/'.$file->url)}}" download style="margin-bottom: 5px"
                                       title="{{$file_1}}">
                                        <img class="file-icon" src="{{ asset('img/file.jpg') }}">
										<?php if ($file->status == 1) {
											$tclass = 'approve';
										} elseif ($file->status == 2) {
											$tclass = 'cancel';
										} else {
											$tclass = '';
										}?>
                                        <span class="type {{$tclass}}"></span>
                                    </a>
                                    <span class="doc-filename">{{$file_name[0]}}</span>
									<?php
									if ($file->status == 3) {
										echo '<span class="doc-filename replace">ממתין לאישור</span>';
									}
									if ($file->status == 4) {
										echo '<span class="doc-filename replace">נשלחה בקשה למסמך אחר</span>';
									}
									?>
                                    @if(\App\User::check_auth_user_AppPermission2($application,2))
                                        <div>
                                            <button class="apps-btn" id="cancel_{{$file->id}}"
                                                    onclick="cancel_file_tk(this, {{$file->id}} )" style="{{$p_e}}">דחה
                                            </button>
                                        </div>
                                        <div>
                                            <button class="apps-btn" onclick="approve_file_tk(this, {{$file->id}} )"
                                                    style="{{$p_e}}"> אשר
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                        <div class="file-content">
                            <span class="file-title" style="font-weight: 700;text-align: right;font-size:0.9em">מסמך אחר</span>
                            <a href="#" onclick="requestNewFile(<?php echo($application->id);?>)">
                                <div style="width:130px;height:130px;background:#d3d3d3;
  display: flex;
  align-items: center;
  justify-content: center;">

                                    <img style="width:56px;height:76px" src="/img/newfile.png">
                                </div>
                            </a>
                            <button class="apps-btn" style="width:100%;margin-top:5px;"
                                    onclick="showRequestNewFile(<?php echo($application->id);?>)">בקשה למסמך אחר
                            </button>
                            <div id="files_comment" style="display:none;margin-top:50px;width:400px;height:300px; border:thin solid #4c9d4c"><textarea id="files_comment_data" type="text" style="width:100%;height:100%"></textarea>
                                <button class="apps-btn" style="width:100%;margin-top:0;margin-left:0"
                                        onclick="requestNewFile(<?php echo($application->id);?>)">בקשה למסמך אחר
                                </button>
                            </div>
                        </div>


                    </div>
                </div>

            </div>

            <div style="  text-align:right;margin:50px">
                <div class="captioblack max-w300" style="font-weight: 700">הגדרת נמענים להעתקים:</div>
                @if($decision->decision_5!=1  && $decision->decision_6!=1 && $decision->decision_rejectedbyuser!=1)

                <div style="display: flex">
                    <input type="email" onkeyup="checkUserDecision({{$application->decision->id}})"
                           id="adduser_decision"
                           name="pref_tender_email[]" required=""
                           class="max-440" style="height:25px" placeholder="">
                    <button class="apps-btn apdecision" style="height:25px">הוסף</button>
                </div>
                <div id="userlist" style="margin-top:20px"></div>
                <div id="usercurrentlist" style="display: flex;flex-direction: column">
                    @foreach ($users as $line)
                        <div><span onClick="delLw({{$line->userId}},{{$application->decision->id}} )" style="cursor:pointer"><img src="/img/delclose.png" /></span>  {{$line->name}} </div>

                        @endforeach

                </div>
                @endif
                @if (($decision->decision_3 || $decision->decision_4) && !($decision->decision_5!=1  && $decision->decision_6!=1 && $decision->decision_rejectedbyuser!=1))
                    <div>
                        @if ($decision->decision_3)<img src="/img/allok.png" />
                        <span class="captiogreen adminlighthdr">
                        אושר
                       </span> @elseif ($decision->decision_4)<img src="/img/nok.png" /><span class="captiored">
                        נדחה
                     </span>  @endif
                    </div>
                @endif
                @if ((!$decision->decision_1 || !$decision->decision_2) && !($decision->decision_3 || $decision->decision_4) && ($decision->decision_5!=1  && $decision->decision_6!=1 && $decision->decision_rejectedbyuser!=1))
                    <div>אישור/דחיה שלב א</div>
                    @endif

                @if (($decision->decision_1 || $decision->decision_2) && !($decision->decision_3 || $decision->decision_4))
                    <div>
                    @if ($decision->decision_1)<img src="/img/allok.png" />
                            <span class="captiogreen adminlighthdr">
                        אושר
                       </span> @elseif ($decision->decision_2)<img src="/img/nok.png" /><span class="captiored">
                        נדחה
                     </span>  @endif
                    </div>



    @if ($decision->decision_1 && !($decision->decision_5!=1  && $decision->decision_6!=1 && $decision->decision_rejectedbyuser!=1))

 <span >אישור דחיה שלב א</span>
        @endif
     @endif
                @if ($decfile)
                    @foreach($decfile as $decline)
                    <div  style="    margin-bottom: 20px;
    margin-left: 20px;
    width: 130px;">
                        <span class="file-title" style="font-weight: 700;text-align: right">אישור מנהל אגף</span>
                        <a href="{{asset('upload/'.$decline)}}" download style="margin-bottom: 5px"
                           title="decision.pdf">
                            <img class="file-icon" src="{{ asset('img/file.jpg') }}">
                            <span class="type pdf"></span>
                        </a>
                    </div>
                    @endforeach
                @endif
</div>

<div style="text-align: right;display:flex;margin:50px;justify-content: space-between">
    @if ($decision->decision_5!=1  && $decision->decision_6!=1 && $decision->decision_rejectedbyuser!=1)
 <div>
     @if (!(($decision->decision_3)||($decision->decision_4)))
         @if (!$decision->decision_1 && !$decision->decision_2)
             <div>


                 <button type="button" class="apps-btn apdecision"
                         onclick="send_decision(1,{{ $application->id}})">
                     דחייה
                 </button>
                 <button type="button" class="apps-btn apdecision"
                         onclick="send_decision(0,{{ $application->id}})">
                     אישור
                 </button>
             </div>
         @else
             @if ($decision->decision_1  )

                 <div style="display:flex;flex-direction: column">
                     <div style="display: flex;height: 25px;margin-bottom: 20px;">
                         <button type="button" class="apps-btn apdecision"
                                 onclick="approveShowDecision({{ $application->id}})">
                             אישור
                         </button>
                         <br/><Br/>
                         <button type="button" class="apps-btn apdecision"
                                 onclick="send_decision(3,{{ $application->id}})">
                             דחייה
                         </button>

                     </div>

                     <div style='display:none; border:thin solid green;padding:2px' id="comment_block">
                         <input type="text" name="comment_text" required="" class="date_val max-220"
                                id="comment_text" style="height:25px;border:none"
                                autocomplete="off" pattern="\d{1,2}/\d{1,2}/\d{4}"
                                placeholder="DD/MM/YYYY">
                         <button type="button" class="apps-btn apdecision"
                                 onclick="send_decision(2,{{ $application->id}})">
                             שלח
                         </button>
                     </div>
                 </div>


             @else
                 <div>
                     <div></div>

                 </div>
             @endif
         @endif
     @else

     @endif
 </div>
    @endif
 <div>
     <a href="/admin/tenders/{{$application->id}}/file-download" class="btn float-left downloadall"
        onclick="">הורדת כלל המסמכים למחשב</a>
 </div>
</div>


</main>
</div>
@endsection
