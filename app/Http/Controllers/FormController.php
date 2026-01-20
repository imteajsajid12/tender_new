<?php

namespace App\Http\Controllers;

use App\Applications;
use App\Forms;
use App\Models\AppDecisions;
use App\Models\Tender;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jurosh\PDFMerge\PDFMerger;
use Karriere\PdfMerge\PdfMerge;
//use DB;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request, $url)
    {

        //dd($request->all(), $url);
        //var_dump(auth()->user());
        //die();
        //$tid=$request->id;
        $tid = self::getQParam("tenderid");
        $email = self::getQParam("email");
        $decisionId = self::getQParam("decisionId");
        $tz = "";
        $applicant_name = "";
        $invitation = "";
        if ($decisionId) {
            $line = DB::table('app_decisions')->select()->where('id', '=', $decisionId)->first();
            if ($line) $tz = $line->id_tz;
            if ($line) $applicant_name = $line->applicant_name;
            //var_dump($line);
        }
        // echo($tz);
        $form = Forms::where([
            ['url', '=', $url],
            ['status', '=', '1'],
        ])->first();

        abort_if(!$form, 404);

        //$form1 = DB::table('forms')->get();
        //print_r($form1);
        //echo(json_encode(isset(Forms::$form_files[$form->id]) ? Forms::$form_files[$form->id] : ''));
        //var_dump($form->id);
        // echo($tid);
        $tender = DB::table('tenders')->selectRaw('*,finish_date<now() as outofdate')->where('generated_id', '=', $tid)->first();

        if ($tender && (!$tender->is_protocol)) return view('forms.not-active', ['pageTitle' => 'המכרז אינו פעיל']);

        $tender = Tender::selectRaw('*,finish_date<now() as outofdate');
        if ($form->id == 7) {
            $tender = $tender->with(['decisionMaker', 'decision', 'applications' => function ($q) {
                return $q->secondInvitationApproved();
            }, 'applications.files']);
        } else {
            $tender = $tender->with(['decisionMaker', 'applications.files']);
        }
        $tender = $tender->where('generated_id', '=', $tid)->first();

        //echo(json_encode($conditions));
        if (empty($form) || !isset($tender)) {
            return view('error.404');
        } else {
            if ($form->id == 7 && $tender) {
                if ($tender->is_protocol == 0) {
                    return redirect()->back();
                }
            }

            if ($tender && ($tender->outofdate == 1))  return view('forms.not-active', ['pageTitle' => 'המכרז אינו פעיל']);

            $conditions = [];

            if (isset($tender) && $tender->conditions) {
                $conditions = explode('!+!+!+!', $tender->conditions);
            }

            foreach ($tender->applications as $application) {
                $application->phone = Applications::get_json($application->p5_id, 'personal_phone_select') . '-' . Applications::get_json($application->p5_id, 'personal_phone');
                $invitation = DB::table('apps_meta')
                    ->select('meta_value')
                    ->where([
                        ['app_id', '=', $application->id],
                        ['meta_name', '=', 'committee'],
                    ])->first();
            }
            if ($request->has('download',)) {
                $pdf_name = uniqid('temp_');
                $pdfpath = public_path('upload/' . $pdf_name . '.pdf');

                // Simple: Get committee date/time for form-index-7
                $date = '';
                $time = '';
                if ($form->id == 7 && $tender) {
                    $app_dec = DB::table('app_decisions')
                        ->where('tenderval', $tender->generated_id)
                        ->whereNotNull('approved_committee_time')
                        ->first();

                    if ($app_dec && $app_dec->approved_committee_time) {
                        $date = \Carbon\Carbon::parse($app_dec->approved_committee_time)->format('d m, Y');
                        $time = \Carbon\Carbon::parse($app_dec->approved_committee_time)->format('H:i');
                    }
                }

                $pdf = PDF::loadView(
                    'forms.form-index-' . $form->id,
                    [
                        'form' => $form,
                        'tid' => $tid,
                        'tz' => $tz,
                        'tender' => $tender,
                        'conditions' => $conditions,
                        'applicant_name' => $applicant_name,
                        'tname' => !empty($tender) ? $tender->tname : '',
                        'download' => true,
                        'invitation' => $invitation,
                        'date' => $date,
                        'time' => $time,
                        'form_file' => isset(Forms::$form_files[$form->id]) ? Forms::$form_files[$form->id] : '',
                        //'form_file_manual' => isset(Forms::$form_files[$form->id]['tender_add_cond']) ? Forms::$form_files[$form->id]['tender_add_cond'] : ''
                    ]
                )->setPaper('A4')->setOrientation('portrait');
                $pdf->setOption('enable-javascript', true);
                $pdf->setOption('javascript-delay', 5000);
                $pdf->setOption('enable-smart-shrinking', true);
                $pdf->setOption('no-stop-slow-scripts', true);
                $pdf->setOption('margin-top', 10);
                $pdf->setOption('margin-bottom', 0);
                $pdf->setOption('margin-left', 0);
                $pdf->setOption('margin-right', 0);

                $pdf->save($pdfpath);

                // Only merge additional files for forms other than form-index-7 (protocol)
                // Form-index-7 should only download the protocol page data without additional CV files
                if ($form->id != 7) {
                    $pdfMerge = new PdfMerge();
                    $pdfMerge->add($pdfpath);

                    foreach ($tender->applications as $application) {
                        foreach ($application->files as $file) {
                            if (str_ends_with($file->file_name, 'קורות חיים')) {
                                $pdfMerge->add(public_path('upload/' . $file->url));
                                break;
                            }
                        }
                    }

                    try {
                        $pdfMerge->merge($pdfpath);
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                }

                return response()->download($pdfpath)->deleteFileAfterSend(true);
            } else {
                // Simple: Get committee date/time for form-index-7
                $date = '';
                $time = '';
                if ($form->id == 7 && $tender) {
                    $app_dec = DB::table('app_decisions')
                        ->where('tenderval', $tender->generated_id)
                        ->whereNotNull('approved_committee_time')
                        ->first();

                    if ($app_dec && $app_dec->approved_committee_time) {
                        $date = \Carbon\Carbon::parse($app_dec->approved_committee_time)->format('d m, Y');
                        $time = \Carbon\Carbon::parse($app_dec->approved_committee_time)->format('H:i');
                    }
                }

                // Process qualifications data for form-index-7
                $qualificationsData = [];
                if ($form->id == 7 && $tender && $tender->applications) {

                    foreach ($tender->applications as $application) {
                        if ($tender->qualifications) {
                            $qualificationsData[$application->id] = $this->parseQualifications($tender->qualifications, $tender->conditions, $application->id);
                        } else {
                            $qualificationsData[$application->id] = $this->getEmptyQualifications();
                        }
                    }
                }
                // Process form file names for form-index-7
                $formFileNames = [];
                if ($form->id == 7 && isset(Forms::$form_files[$form->id])) {
                    $formFileNames = Forms::$form_files[$form->id];
                }
				// dd($qualificationsData);
                return view('forms.form-index-' . $form->id, [
                    'form' => $form,
                    'tid' => $tid,
                    'tz' => $tz,
                    'tender' => $tender,
                    'conditions' => $conditions,
                    'applicant_name' => $applicant_name,
                    'download' => false,
                    'invitation' => $invitation,
                    'tname' => !empty($tender) ? $tender->tname : '',
                    'date' => $date,
                    'time' => $time,
                    'form_file' => isset(Forms::$form_files[$form->id]) ? Forms::$form_files[$form->id] : '',
                    'qualificationsData' => $qualificationsData,
                    'formFileNames' => $formFileNames,
                    //'form_file_manual' => isset(Forms::$form_files[$form->id]['tender_add_cond']) ? Forms::$form_files[$form->id]['tender_add_cond'] : ''
                ]);
            }
        }
    }

    public function protocolTable(Request $request)
    {
        $tid = self::getQParam("tenderid");
        $tname = self::getQParam("tname");

        if (empty($tid)) {
            return view('error.404');
        }

        // Get the protocol form (form ID 7)
        $form = Forms::where([
            ['id', '=', 7],
            ['status', '=', '1'],
        ])->first();

        if (!$form) {
            return view('error.404');
        }

        $tender = Tender::selectRaw('*,finish_date<now() as outofdate')
            ->with(['decisionMaker', 'decision', 'applications' => function ($q) {
                return $q->secondInvitationApproved();
            }, 'applications.files'])
            ->where('generated_id', '=', $tid)
            ->first();

        if (!$tender || $tender->is_protocol == 0) {
            return view('forms.not-active', ['pageTitle' => 'המכרז אינו פעיל']);
        }

        // Process applications data like in the main protocol form
        foreach ($tender->applications as $application) {
            $application->phone = Applications::get_json($application->p5_id, 'personal_phone_select') . '-' . Applications::get_json($application->p5_id, 'personal_phone');
        }

        // Process qualifications data for protocol table
        $qualificationsData = [];
        if ($tender && $tender->applications) {
            foreach ($tender->applications as $application) {
                if ($tender->qualifications) {
                    $qualificationsData[$application->id] = $this->parseQualifications($tender->qualifications, $tender->conditions, $application->id);
                } else {
                    $qualificationsData[$application->id] = $this->getEmptyQualifications();
                }
            }
        }

        // Process form file names
        $formFileNames = [];
        if (isset(Forms::$form_files[7])) {
            $formFileNames = Forms::$form_files[7];
        }

        // Get committee date/time like in the main protocol form
        $date = '';
        $time = '';
        $app_dec = DB::table('app_decisions')
            ->where('tenderval', $tender->generated_id)
            ->whereNotNull('approved_committee_time')
            ->first();

        if ($app_dec && $app_dec->approved_committee_time) {
            $date = \Carbon\Carbon::parse($app_dec->approved_committee_time)->format('d m, Y');
            $time = \Carbon\Carbon::parse($app_dec->approved_committee_time)->format('H:i');
        }

        return view('forms.protocol-table', [
            'tender' => $tender,
            'tid' => $tid,
            'tname' => $tname,
            'qualificationsData' => $qualificationsData,
            'formFileNames' => $formFileNames,
            'date' => $date,
            'time' => $time,
        ]);
    }

    private function getQParam($param)
    {
        $res = "";

        if (isset($_SERVER['QUERY_STRING']) && strpos($_SERVER['QUERY_STRING'], $param) >= 0) {
            $line0 = substr($_SERVER['QUERY_STRING'], strpos($_SERVER['QUERY_STRING'], $param) + strlen($param) + 1);
            if (!strpos($line0, '&')) $res = $line0;
            else
                $res = substr($line0, 0, strpos($line0, '&'));
        }
        return $res;
    }


    /**
     * Show the aplication for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public static function checkApp(Request $request, $app_id)
    {
        // Get the application data from database
        $app = DB::table('applications')->where('id', '=', $app_id)->first();
        if (!$app) {
            return view('pdf.form-new', [
                'title' => 'שאלון אישי למועמד',
                'request' => $request
            ]);
        }

        // Get the serialized form data
        $metaJson = unserialize(Applications::get_meta_value($app_id, 'metaJson'));

        // Create a request-like object with the stored data
        $storedRequest = (object)$metaJson;

        return view('pdf.form-new', [
            'title' => 'שאלון אישי למועמד',
            'request' => $storedRequest
        ]);

        /*$form = Forms::get_app($app_id);
		var_dump($form);
		$form->title='werw';

		return view('pdf.form', [
			'formhtml' => $request->html,
			'title'=>'',
			'form' => $form,

		]);*/
    }

    public function create(Request $request, $url, $app_id = '')
    {
        $tid = $request->id;
        $resulte = array();
        $form = Forms::where([
            ['url', '=', $url],
            ['status', '=', '1'],
        ])->first();
        $res = $request->html;
        /*return view('pdf.form-new', [
			'request' => $request
		]);*/
        //  var_dump($res);
        // exit();
        empty($form) ? $resulte['error'] = 'אירעה שגיאה לא צפויה, אנא רענן את הדף ונסה שוב עכשיו או אחר כך.' : $resulte = Forms::add_app($request, $form, $app_id, $tid);
        return json_encode($resulte);
    }

    public function success_add_app(Request $request, $url, $failname)
    {
        $form = Forms::where([
            ['url', '=', $url],
            ['status', '=', '1'],
        ])->first();
        if (empty($form)) return view('error.404');

        if (empty($failname)) return view('error.404');
        return view('forms.success', [
            'form' => $form,
            'failname' => $failname
        ]);
    }

    public function success_add_app_erur(Request $request, $url, $app_id = '', $failname)
    {
        $form = Forms::where([
            ['url', '=', $url],
            ['status', '=', '1'],
        ])->first();
        if (empty($form)) return view('error.404');

        if (empty($failname)) return view('error.404');

        return view('forms.success', [
            'form' => $form,
            'failname' => $failname
        ]);
    }

    public function erur(Request $request, $url, $app_id)
    {
        $id = base64_decode($app_id, true);
        if (!$id) {
            return response(view('error.404'), 404);
        }

        $form = Forms::where([['url', '=', $url], ['status', '=', '1'],])->first();
        if (empty($form)) return view('error.404');

        $app = DB::table('applications')->where('id', '=', $id)->first();
        if (!empty($app) && $app->status == 5) {
            $metaJson = unserialize(\App\Applications::get_meta_value($id, 'metaJson'));
            $replacedata = array('no' => 'לא', 'yes' => 'כן', 'norm' => ' חינוך רגיל', 'spec' => ' חינוך מיוחד');
            foreach ($replacedata as $key => $val) {
                $metaJson = array_replace(
                    $metaJson,
                    array_fill_keys(
                        array_keys($metaJson, $key),
                        $val
                    )
                );
            }
            return view('forms.erur' . $app->form_id, [
                'app' => $app,
                'form' => $form,
                'metaJson' => $metaJson,
                'form_file' => [['name' => 'מסמך רלוונטי התומך בבקשה', 'show_type' => '', 'required' => '']]
            ]);
        } else {
            return response(view('error.404'), 404);
        }
    }

    public function check_status(Request $request)
    {
        $resulte = array();
        empty($request->input("pass_id")) ? $resulte['error'] = 'אירעה שגיאה לא צפויה, אנא רענן את הדף ונסה שוב עכשיו או אחר כך.' : $resulte = Forms::check_status($request->input("pass_id"));

        return json_encode($resulte);
    }

    public function check_status_stop(Request $request, $id)
    {

        if (empty($id)) return 'אירעה שגיאה לא צפויה, אנא רענן את הדף ונסה שוב עכשיו או אחר כך.';

        DB::table('applications')->where('id', $id)->update(['status' => 11]);

        return 'success';
    }

    public function approve(Request $request, $id)
    {
        $meta_data[] = ['app_id' => $id, 'meta_name' => 'email_msg', 'meta_value' => 'מועמד אישר ציפיות שכר'];
        DB::table('app_decisions')->where('id', $id)->update(['decision_1_b' => 1, 'committee_invitation_approved_time' => now()]);
        Forms::insert_meta($meta_data);
        $logText = 'מועמד אישר ציפיות שכר';
        DB::table('apps_logs')->insert([
            ['app_id' => $id, 'description' => $logText]
        ]);
        $to = explode(',', env('ADMIN_EMAILS'));
        $id_dec = $id + 100;
        $body = 'מייל תזכורת אישור ציפיות שכר על ידי המועמד.<br> מספר פניה ' . $id_dec;
        Applications::sendmail($to, $body, 'app');
        return view('email.app', ['body' => 'תודה רבה 😊']);
    }

    public function cancel(Request $request, $id)
    {
        Applications::cancel_tender($id);
        return view('email.app', ['body' => 'תודה רבה 😊']);
    }
    public function approve_interview(Request $request, $id)
    {
        $meta_data[] = ['app_id' => $id, 'meta_name' => 'email_msg_interview', 'meta_value' => 'מועמד אישר הגעה לראיון ראשוני'];
        Forms::insert_meta($meta_data);
        $logText = 'מועמד אישר הגעה לראיון ראשוני';
        DB::table('apps_logs')->insert([
            ['app_id' => $id, 'description' => $logText]
        ]);
        $to = explode(',', env('ADMIN_EMAILS'));
        $id_dec = $id + 100;
        $body = 'מייל תזכורת אישור הגעה לראיון מקדים על ידי המועמד.<br> מספר פניה ' . $id_dec;
        Applications::sendmail($to, $body, 'app');
        return view('email.app', ['body' => 'תודה רבה 😊']);
    }

    public function approve_test(Request $request, $id)
    {
        $meta_data[] = ['app_id' => $id, 'meta_name' => 'email_msg_test', 'meta_value' => 'מועמד אישר הגעה לבחינה בכתב'];
        Forms::insert_meta($meta_data);
        $app_dec = [];
        if ($request->date) {
            $app_dec['approved_interview_time'] = $request->date;
        }
        if ($request->place) {
            $app_dec['approved_interview_place'] = $request->place;
        }

        AppDecisions::find($id)->update($app_dec);

        $logText = 'מועמד אישר הגעה לבחינה בכתב';
        DB::table('apps_logs')->insert([
            ['app_id' => $id, 'description' => $logText]
        ]);
        return view('email.app', ['body' => 'תודה רבה 😊']);
    }

    public function approve_committee(Request $request, $id)
    {
        $meta_data[] = ['app_id' => $id, 'meta_name' => 'email_msg_committee_approve', 'meta_value' => 'מועמד אישר הגעה לועדת בחינה'];
        Forms::insert_meta($meta_data);
        $logText = 'מועמד אישר הגעה לועדת בחינה';
        DB::table('apps_logs')->insert([
            ['app_id' => $id, 'description' => $logText]
        ]);
        try {
            AppDecisions::find($id)->update(['committee_invitation_approved_time' => now()]);
        } catch (\Throwable $th) {
            throw $th;
        }
        return view('email.app', ['body' => 'אישור הגעתך למכרז התקבל. </br>בהצלחה,']);
    }

    public function approve_gotit(Request $request, $id)
    {
        $meta_data[] = ['app_id' => $id, 'meta_name' => 'email_msg_committee', 'meta_value' => 'מועמד אישר הגעה לזימון לאחר זכיה במכרז'];
        Forms::insert_meta($meta_data);
        $logText = 'מועמד אישר הגעה לזימון לאחר זכיה במכרז';
        DB::table('apps_logs')->insert([
            ['app_id' => $id, 'description' => $logText]
        ]);
        return view('email.app', ['body' => 'תודה רבה 😊']);
    }

    public function showapps(Request $request, $url)
    {
        $form = Forms::where([
            ['url', '=', $url],
            ['status', '=', '1'],
        ])->first();

        if (empty($form)) {
            return view('error.404');
        } else {
            return view('forms.form-index-7', [
                'form' => $form
            ]);
        }
    }

    public function create_level_b(Request $request, $url, $app_id = '')
    {
        $resulte = array();
        $form = Forms::where([
            ['url', '=', $url],
            ['status', '=', '1'],
        ])->first();
        empty($form) ? $resulte['error'] = 'אירעה שגיאה לא צפויה, אנא רענן את הדף ונסה שוב עכשיו או אחר כך.' : $resulte =                 Forms::add_app_level_b($request, $form, $app_id);

        return json_encode($resulte);
    }

    public function level_b(Request $request, $url, $app_id)
    {
        $id = base64_decode($app_id, true);
        if (!$id) {
            return response(view('error.404'), 404);
        }
        $form = Forms::where([['url', '=', $url], ['status', '=', '1'],])->first();
        if (empty($form)) return view('error.404');
        $app_decisions = DB::table('app_decisions')->where('p5_id', '=', $id)->first();
        $tender = DB::table('tenders')->where('generated_id', '=', $app_decisions->tenderval)->first();
        $app = DB::table('applications')->where('id', '=', $id)->first();
        if (!empty($app)) {
            //DB::table('applications')->where('id', $id)->update(['status' => '7']);
            $metaJson = unserialize(\App\Applications::get_meta_value($id, 'metaJson'));
            return view('forms.level_b' . $app->form_id, [
                'tender' => $tender,
                'app' => $app,
                'form' => $form,
                'metaJson' => $metaJson,
                'form_file' => [
                    ['name' => 'אישור נכות 100%', 'show_type' => 'bottom2', 'required' => ''],
                    ['name' => 'אישור תושב', 'show_type' => 'bottom3', 'required' => ''],
                    ['name' => 'פסק דין', 'show_type' => 'bottom9', 'required' => ''],
                    ['name' => 'צילום תעודת שחרור', 'show_type' => 'bottom11||military_service_yes', 'required' => ''],
                    ['name' => 'הצהרה בטופס 118', 'show_type' => 'bottom12', 'required' => ''],
                    ['name' => 'הצהרה בטופס 119', 'show_type' => 'bottom13', 'required' => ''],
                    ['name' => 'הוכחה לחוסר הכנסה', 'show_type' => 'bottom14', 'required' => ''],
                    ['name' => 'אישור לצבירת ותק', 'show_type' => 'is_seniority_yes', 'required' => ''],
                ]
            ]);
        } else {
            return response(view('error.404'), 404);
        }
    }
    /**
     * Parse qualifications data from database format
     */
    private function parseQualifications($qualifications, $conditionsString = null, $applicationId = null)
    {
        $parts = explode('#$$#', $qualifications);

        // Parse conditions to get status for each qualification
        $conditionsArray = [];
        if ($conditionsString) {
            $conditions = explode('!+!+!+!', $conditionsString);
            foreach ($conditions as $condition) {
                if (strpos($condition, '=>') !== false) {
                    list($text, $status) = explode('=>', $condition, 2);
                    $conditionsArray[trim($text)] = $status;
                }
            }
        }

        // Get files for this application
        $allFiles = [];
        if ($applicationId) {
            $allFiles = \App\Models\ApplicationFiles::where('app_dec_id', $applicationId)->get();
        }

        return [
            'education' => [
                'text' => isset($parts[0]) ? trim($parts[0]) : '',
                'status' => $this->getQualificationStatusFromConditions(isset($parts[0]) ? trim($parts[0]) : '', $conditionsArray, $applicationId, 'education'),
				'required' => $this->isRequired('education', $conditionsArray),
                'files' => $this->getFilesForSection('education', isset($parts[0]) ? trim($parts[0]) : '', $allFiles, $conditionsArray)
            ],
            'professional_courses' => [
                'text' => isset($parts[1]) ? trim($parts[1]) : '',
                'status' => $this->getQualificationStatusFromConditions(isset($parts[1]) ? trim($parts[1]) : '', $conditionsArray, $applicationId, 'professional_courses'),
				'required' => $this->isRequired('professional_courses', $conditionsArray),
                'files' => $this->getFilesForSection('professional_courses', isset($parts[1]) ? trim($parts[1]) : '', $allFiles, $conditionsArray)
            ],
            'professional_experience' => [
                'text' => isset($parts[2]) ? trim($parts[2]) : '',
                'status' => $this->getQualificationStatusFromConditions(isset($parts[2]) ? trim($parts[2]) : '', $conditionsArray, $applicationId, 'professional_experience'),
				'required' => $this->isRequired('professional_experience', $conditionsArray),
                'files' => $this->getFilesForSection('professional_experience', isset($parts[2]) ? trim($parts[2]) : '', $allFiles, $conditionsArray)
            ],
            'additional_requirements' => [
                'text' => isset($parts[3]) ? trim($parts[3]) : '',
                'status' => $this->getQualificationStatusFromConditions(isset($parts[3]) ? trim($parts[3]) : '', $conditionsArray, $applicationId, 'additional_requirements'),
				'required' => $this->isRequired('additional_requirements', $conditionsArray),
                'files' => $this->getFilesForSection('additional_requirements', isset($parts[3]) ? trim($parts[3]) : '', $allFiles, $conditionsArray)
            ],
            'management_experience' => [
                'text' => isset($parts[4]) ? trim($parts[4]) : '',
                'status' => $this->getQualificationStatusFromConditions(isset($parts[4]) ? trim($parts[4]) : '', $conditionsArray, $applicationId, 'management_experience'),
				'required' => $this->isRequired('management_experience', $conditionsArray),
                'files' => $this->getFilesForSection('management_experience', isset($parts[4]) ? trim($parts[4]) : '', $allFiles, $conditionsArray)
            ],
            'mandatory_test' => [
                'text' => isset($parts[5]) ? trim($parts[5]) : '',
                'status' => $this->getQualificationStatus(isset($parts[5]) ? trim($parts[5]) : ''),
                'required' => !empty($parts[5]) && trim($parts[5]) !== '',
                'files' => $this->getFilesForSection('mandatory_test', isset($parts[5]) ? trim($parts[5]) : '', $allFiles, $conditionsArray)
            ]
        ];
    }

	private function isRequired(string $sectionType, array $fields)
	{
		// Map section types to doc numbers
		$sectionMap = [
			'education' => '1',
			'professional_courses' => '2',
			'professional_experience' => '3',
			'additional_requirements' => '4',
			'management_experience' => '5'
		];

		if (!isset($sectionMap[$sectionType])) {
			return "לא הוגדר";
		}

		$docNumber = $sectionMap[$sectionType];

		// Search for conditions with this section identifier [doc{number}]
		foreach ($fields as $key => $value) {
			if (!empty($value)) {
				// Extract status from value (handle format like "required[doc1]")
				$status = $value;
				$hasSection = false;

				if (preg_match('/^(.+)\[doc(\d+)\]$/', $value, $matches)) {
					$status = $matches[1];
					$foundDocNumber = $matches[2];

					// Check if this condition belongs to our section
					if ($foundDocNumber === $docNumber) {
						$hasSection = true;
					}
				}

				// If this condition has the matching section identifier, return its status
				if ($hasSection) {
					if (str_starts_with($status, 'required')) {
						return "תנאי סף";
					} elseif (str_starts_with($status, 'not_required')) {
						return "יתרון";
					} elseif (str_starts_with($status, 'cond_or')) {
						return "תנאי סף מסוג או";
					} elseif (str_starts_with($status, 'confirm')) {
						return "מאשר/ת";
					}
				}
			}
		}

		// No matching section found - return "לא הוגדר" (Not defined)
		return "לא הוגדר";
	}

    /**
     * Get files for a specific qualification section
     * Matches files based on input_field_label (for dynamic fields) or input_field_name (for static fields)
     */
    private function getFilesForSection($sectionType, $sectionText, $allFiles, $conditionsArray)
    {
        $matchedFiles = [];

        // If no files, return empty array
        if (empty($allFiles)) {
            return $matchedFiles;
        }
		// dd($sectionType, $sectionText, $allFiles, $conditionsArray);
        // Get all condition texts for this section
        $conditionTexts = [];
		
        $__KeyText = '';
		foreach ($conditionsArray as $text => $status) {
            // Extract doc number from status (e.g., "required[doc1]" -> "1")
            if (preg_match('/\[doc(\d+)\]$/', $status, $matches)) {
                $docNumber = $matches[1];

                // Map doc number to section type
                $sectionMap = [
                    '1' => 'education',
                    '2' => 'professional_courses',
                    '3' => 'professional_experience',
                    '4' => 'additional_requirements',
                    '5' => 'management_experience'
                ];

                // If this condition belongs to our section, add the text
                if (isset($sectionMap[$docNumber]) && $sectionMap[$docNumber] === $sectionType) {
                    $conditionTexts[] = trim($text);
					$__KeyText = $text;
                }
            }
        }

        // Also add the main section text if not empty
        if (!empty(trim($sectionText))) {
            $conditionTexts[] = trim($sectionText);
        }
		// dd($__KeyText,$sectionText,$conditionTexts);
        // Match files
        foreach ($allFiles as $_key => $file) {
            $shouldInclude = false;

            // Skip CV files
            if ($file->is_cv == 1) {
                continue;
            }

            // Method 1: Check input_field_name (for files with correct section assignment)
            if (!empty($file->input_field_name) && $file->input_field_name === $sectionType) {
                $shouldInclude = true;
            }

            // Method 2: Check input_field_label against condition texts (for dynamic fields)
            if (!$shouldInclude && !empty($file->input_field_label)) {
                foreach ($conditionTexts as $conditionText) {
                    if (trim($file->input_field_label) === $conditionText) {
                        $shouldInclude = true;
                        break;
                    }
                }
            }
			
			$file_name_parts = explode('^^', $file->file_name);
			if(isset($file_name_parts[2]) && $file_name_parts[2] != "additional_files" && $file->input_field_label != $__KeyText) continue;
			
            // Method 3: Fallback - parse file_name for section (for old files)
            if (!$shouldInclude && !empty($file->file_name)) {
                
                if (count($file_name_parts) > 2) {
                    $fileSection = $file_name_parts[2];
                    if ($fileSection === $sectionType) {
                        $shouldInclude = true;
                    }
                }
            }

            if ($shouldInclude) {
                $matchedFiles[] = $file;
            }
        }
		
        return $matchedFiles;
    }

    /**
     * Get qualification status from conditions array and file uploads
     */
    private function getQualificationStatusFromConditions($qualificationText, $conditionsArray, $applicationId = null, $qualificationType = null)
    {
        // If qualification text is empty or null, return "לא הוגדר"
        if (empty(trim($qualificationText))) {
			$qualificationText = $qualificationType;
            // return 'לא הוגדר';
        }


		// dd($qualificationText, $conditionsArray, $applicationId,$qualificationType);
        // If no application ID provided, just return the basic status from conditions
        if (!$applicationId) {
            // Look for this qualification text in conditions array
            foreach ($conditionsArray as $conditionText => $status) {
                if (trim($conditionText) === trim($qualificationText)) {
                    switch ($status) {
                        case 'required':
                            return 'תנאי סף';
                        case 'not_required':
                            return 'יתרון';
                        case 'cond_or':
                            return 'תנאי סף מסוג או';
                        case 'confirm':
                            return 'מאשר/ת שהנני עומד/ת בדרישות אלה';
                        case 'no':
                        default:
                            return 'ממתין לאישור';
                    }
                }
            }
            return 'ממתין לאישור';
        }

        // Check if user has uploaded files for this qualification and their approval status
        $hasUploadedFiles = DB::table('apps_file')
            ->where('app_dec_id', $applicationId)
            ->where('file_name', 'LIKE', '%' . $qualificationText . '%')
            ->exists();

        if ($hasUploadedFiles) {
            // Check if all files for this qualification are approved
            $allApproved = DB::table('apps_file')
                ->where('app_dec_id', $applicationId)
                ->where('file_name', 'LIKE', '%' . $qualificationText . '%')
                ->where('status', '!=', '1')
                ->doesntExist();

            // Check if any files are rejected
            $hasRejected = DB::table('apps_file')
                ->where('app_dec_id', $applicationId)
                ->where('file_name', 'LIKE', '%' . $qualificationText . '%')
                ->where('status', '2')
                ->exists();

            if ($hasRejected) {
                return 'נדחה';
            } elseif ($allApproved) {
                return 'אושר';
            } else {
                return 'ממתין לאישור';
            }
        }

        // If no files uploaded yet, return "ממתין לאישור"
        return 'ממתין לאישור';
    }

    /**
     * Get qualification status based on text content
     */
    private function getQualificationStatus($text)
    {
        if (empty($text)) {
            return 'לא הוגדר';
        }

        // Check for advantage/mandatory keywords
        if (stripos($text, 'יתרון') !== false || stripos($text, 'advantage') !== false) {
            return 'יתרון';
        } elseif (stripos($text, 'חובה') !== false || stripos($text, 'mandatory') !== false || stripos($text, 'required') !== false) {
            return 'חובה';
        }

        return 'חובה'; // Default to mandatory if not specified
    }

    /**
     * Get empty qualifications structure
     */
    private function getEmptyQualifications()
    {
        return [
            'education' => [
                'text' => '',
                'status' => 'לא הוגדר'
            ],
            'professional_courses' => [
                'text' => '',
                'status' => 'לא הוגדר'
            ],
            'professional_experience' => [
                'text' => '',
                'status' => 'לא הוגדר'
            ],
            'additional_requirements' => [
                'text' => '',
                'status' => 'לא הוגדר'
            ],
            'management_experience' => [
                'text' => '',
                'status' => 'לא הוגדר'
            ],
            'mandatory_test' => [
                'text' => '',
                'status' => 'לא חובה',
                'required' => false
            ]
        ];
    }
}
