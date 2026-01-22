<?php

namespace App\Http\Controllers;

use App\Applications;
use App\Charts\AppChart;

use App\Exports\FormsExport;
use App\Forms;
//use DB;
use App\Mail\CustomMail;
use App\Mail\SendMailable;
use App\Models\AppDecisions;
use App\Models\Application;
//use PDF;
use App\Models\ApplicationFiles;
use App\Models\DecisionMaker;
use App\Models\Template;
use App\Models\Tender;
use App\Models\TenderDecision;
use App\Models\TenderFiles;
use App\Models\TendersStat;
use App\Models\User;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

use Dompdf\Dompdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jurosh\PDFMerge\PDFMerger;
use Karriere\PdfMerge\PdfMerge;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;




class TendersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //return User::all();
        return DB::table('tenders_stat')->get();
    }
}

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportRTL implements WithEvents
{

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }
}
class SpecialExport implements FromView
{

    private $data;

    function __construct($vw)
    {
        $this->data = $vw;
    }

    public function view(): View
    {
        //var_dump($this->data);
        //exit();
        return view('export.export_special', [
            'arr' => $this->data["arr"],
            'tenderid' => $this->data["tenderid"],

        ]);
        //return $this->data;
    }
}

class RegularExport implements FromView, WithHeadings
{

    private $data;
    private $headings;

    function __construct($vw, $head)
    {
        $this->data = $vw;
        $this->headings = $head;
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function view(): View
    {
        //var_dump($this->data);
        //exit();
        return view('export.export_regular', [
            'arr' => $this->data["arr"],
            'tenderid' => $this->data["tenderid"],

        ]);
        //return $this->data;
    }
}

class TenderSortedExport extends ExportRTL implements FromView, WithHeadings
{
    private $data;
    private $headings;

    function __construct($vw, $head)
    {
        $this->data = $vw;
        $this->headings = $head;
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function view(): View
    {
        //var_dump($this->data);
        return view('export.export_tender_sorted', [
            'tname' => $this->data["tname"],
            'arr' => $this->data["arr"],
        ]);
    }
}


class CandidateDetailsExport extends ExportRTL implements FromView, WithHeadings
{
    private $data;
    private $headings;

    function __construct($vw, $head)
    {
        $this->data = $vw;
        $this->headings = $head;
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function view(): View
    {
        //var_dump($this->data);
        return view('export.export_candidate_details', [
            'tname' => $this->data["tname"],
            'tender_type' => $this->data["tender_type"],
            'brunch' => $this->data["brunch"],
            'arr' => $this->data["arr"],
        ]);
    }
}

class TenderStatusBrunchExport extends ExportRTL implements FromView, WithHeadings
{
    private $data;
    private $headings;

    function __construct($vw, $head)
    {
        $this->data = $vw;
        $this->headings = $head;
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function view(): View
    {
        //var_dump($this->data);
        return view('export.export_tender_status_brunch', [
            'arr' => $this->data["arr"],
        ]);
    }
}

class TenderStatusExport extends ExportRTL implements FromView, WithHeadings, WithEvents
{
    private $data;
    private $headings;

    function __construct($vw, $head)
    {
        $this->data = $vw;
        $this->headings = $head;
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function view(): View
    {
        //var_dump($this->data);
        return view('export.export_tender_status', [
            'arr' => $this->data["arr"],
        ]);
    }
}
class TendersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static $tender_status = [
        0 => 'בחר',
        1 => 'מכרז הסתיים- נבחר מועמד',
        2 => 'מכרז הסתיים - לא נבחר מועמד',
        3 => 'משרה אוישה',
        4 => 'מכרז בוטל',
    ];

    public static $acceptable = array('application/pdf', 'image/jpeg', 'image/jpg', 'image/gif', 'image/png', 'image/jpe', 'image/tiff', 'image/bmp', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword', 'application/octet-stream', '.doc', '.docx');

    public function __construct()
    {
        //	$this->middleware('auth');
    }

    public function index()
    {
        $list = DB::table('tenders')->select()->get();
        return json_encode($list);
    }

    public function create(Request $request)
    {
        // $enames = $request->enames;
        //var_dump($enames);
        //
        $datstart = $request->duplicate ? date_create_from_format('Y d F H:i', $request->start) : date_create($request->start);
        $datfinish = $request->duplicate ? date_create_from_format('Y d F H:i', $request->finish) : date_create($request->finish);

        $format = 'Y-m-d H:i';
        $res = ["res" => $request->name];
        $data = array(
            'tname' => $request->name,
            'brunch' => $request->brunch,
            'is_exist' => $request->is_exist,
            'tender_number' => $request->duplicate ? $request->display : $request->num,
            'generated_id' => json_decode($this->getNewTenderId()),
            'ttype' => $request->ttype,
            'start_date' => date_format($datstart, $format),
            'finish_date' => date_format($datfinish, $format),
            'tender_type' => $request->tender_type,
            'has_salary' => $request->get('has_salary') ?? 0,
            'is_test_required' => $request->get('is_test_required') ?? 0,
            'salary' => $request->salary ?? 0,
            'is_drushim' => $request->is_drushim ?? 0,
            'additional_salary' => $request->additional_salary ?? 0,
            'is_protocol' => $request->is_protocol ?? 0,
            'is_recommended' => $request->is_recommended ?? 0,
            'note' => $request->note,
            'template_id' => $request->template_id,
            'job_details' => json_encode($request->job_details ?? []),
            'functional_level' => 0,
            'input_manager' => $request->input_manager,
            'job_scope' => $request->job_scope,
            'subordinations' => $request->subordinations,
            'grades_voltage' => $request->grades_voltage,
            'qualifications' => $request->qualifications,
            'created_by' => auth()->id(),
            // 'body' => $request->body,
        ); // ,"last_name"=>$last_name,"city_name"=>$city_name,"email"=>$email);
        // $emails = $request->emails;
        $user = \App\User::getCCurrentUser();
        if (!$user)
            return json_encode(["res" => "error", 'code' => 1]);

        $conditions = $request->conditions;
        //echo(json_encode($emails));
        if ($conditions && count($conditions) > 0) {
            $cline = implode("!+!+!+!", $conditions);
            $data["conditions"] = $cline;
        }

        try {
            $last_id = DB::table('tenders')->insertGetId($data);
            $app_id = explode('-', $request->display ?? $data['generated_id']);
            DB::table('apps_meta')->insert([
                ['app_id' => $app_id[1], 'meta_name' => 'tender_num_display', 'meta_value' => $request->display ?? $data['generated_id']],
            ]);
            // if ( count($enames) > 0 ) {
            // 	//echo('!!');
            // 	$body = '<a href="https://tcarmel.automas.co.il/admin/tenders/requestsorted/' . $request->num . '">new tender</a>';
            // 	$emails = DB::table('users')->select('email', 'id')->whereRaw('id in (' . implode(',', $enames) . ')')->get();
            // 	if ( $emails && count($emails) > 0 ) {
            // 		foreach ( $emails as $emailline ) {
            // 			DB::table('user_tenders')->insertGetId(["tenderId" => $last_id, "userId" => $emailline->id]);
            // 			$email = $emailline->email;
            // 			Log::debug('sending email to...' . $email . " body:" . $body);
            // 			Mail::to($email)->send(new SendMailable($body, [], 'app', 'new tender'));
            // 		}
            // 	}
            // }
            $id = Tender::with('user')->find($last_id);

            $id->user()->sync($request->users ?? []);

            try {
                if ($request->users != null && count(value: $request->users) > 0) {
                    $body = '<a href="' . url('/admin/tenders/requestsorted/' . $request->num) . '">new tender</a>';
                    $emails = DB::table('users')->select('email', 'id')->whereIn('id', $request->users)->get();
                    foreach ($emails as $key => $emailline) {
                        DB::table('user_tenders')->insertGetId(["tenderId" => $last_id, "userId" => $emailline->id]);
                        $email = $emailline->email;
                        Log::debug('sending email to...' . $email . " body:" . $body);
                        Mail::to($email)->send(new SendMailable($body, [], 'app', 'new tender'));
                    }
                }
            } catch (\Throwable $th) {
                //throw $th;
            }

            $gid = $id->generated_id;
            $logText = ' מכרז מספר ' . $gid . ' נוסף על ידי ' . $user;
            DB::table('apps_logs')->insert([['tender_id' => $gid, 'app_id' => '0', 'description' => $logText]]);

            //var_dump($data);
            //$cond=json_decode($conditions);
            //	var_dump($cond);
            //$last_id = DB::table('tenders')->insertGetId($data);
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            echo ($ex->getMessage());
            return json_encode(["res" => "error"]);
        }
        $res["id"] = $last_id;
        return json_encode($res);
    }


    public function updateTender(Request $request)
    {
        $user = \App\User::getCCurrentUser();
        if (!$user)
            return json_encode(["res" => "error", 'code' => 1]);

        if ($request->id) {
            $datstart = date_create_from_format('Y d F H:i', $request->start);
            $datfinish = date_create_from_format('Y d F H:i', $request->finish);
            $format = 'Y-m-d H:i';
            $res = ["res" => $request->name];
            $data = array(
                'tname' => $request->name,
                'tender_number' => $request->num,
                'start_date' => date_format($datstart, $format),
                'finish_date' => date_format($datfinish, $format),
                'brunch' => $request->brunch,
                'ttype' => $request->ttype,
                'has_salary' => $request->get('has_salary') ?? 0,
                'salary' => $request->salary ?? 0,
                'additional_salary' => $request->additional_salary ?? 0,
                'is_protocol' => $request->is_protocol ?? 0,
                'is_test_required' => $request->get('is_test_required') ?? 0,
                'is_recommended' => $request->is_recommended ?? 0,
                'note' => $request->note,
                'template_id' => $request->template_id,
                'job_details' => ($request->job_details),
                'functional_level' => 0,
                'input_manager' => $request->input_manager,
                'job_scope' => $request->job_scope,
                'subordinations' => $request->subordinations,
                'grades_voltage' => $request->grades_voltage,
                'qualifications' => $request->qualifications,
                // 'body' => $request->body,

            ); // ,"last_name"=>$last_name,"city_name"=>$city_name,"email"=>$email);
            $emails = $request->emails;
            $conditions = $request->conditions;

            if ($conditions && count($conditions) > 0) {
                $cline = implode("!+!+!+!", $conditions);
                $data["conditions"] = $cline;
            }
            if ($emails && count($emails) > 0) {
                $cline2 = implode("!+!+!+!", $emails);
                $data["emails"] = $cline2;
            }
            $tender_Data = Tender::with('user')->where('generated_id', '=', $request->id)->first();
            // $tender_Data->

            $last_id = $tender_Data->update($data);
            $gid = $request->display ?? $request->id;
            $tender_Data->user()->sync($request->users ?? []);
            // Return the tender ID instead of boolean update result
            $res["id"] = $tender_Data->id;
            $logText = ' מכרז מספר ' . $gid . ' נערך על ידי ' . $user;
            DB::table('apps_logs')->insert([['tender_id' => $gid, 'app_id' => '0', 'description' => $logText]]);
            return json_encode($res);
        }
    }

    public function getTenderDataAjax(Request $request)
    {
        if ($request->tenderid) {
            $data = Tender::with('user:id,name')->where('generated_id', '=', $request->tenderid)->first();
            $sql = "select tenders.generated_id,name,u.id, u.name from users u
												join user_tenders ut on ut.userId=u.id
join tenders on ut.tenderId=tenders.id and tenders.generated_id='" . $request->tenderid . "'";
            $users = DB::select($sql);
            //$app = DB::select( DB::raw("SELECT app.id,app_meta.meta_name,app_meta.meta_value AS applic FROM applications app
            //          INNER JOIN apps_meta app_meta ON app.id=app_meta.app_id
            //  WHERE app.id = 61") );
            //return $app;
            $cond = [];
            if ($data->conditions)
                $cond = explode('!+!+!+!', $data->conditions);
            $data->conditions = $cond;

            $data->users = $users;
            if (strpos($data->generated_id, '-') !== false) {
                $app_id = explode('-', $data->generated_id);
                $display_generated_id = \App\Applications::get_meta_value($app_id[1], 'tender_num_display');
                $data->display_generated_id = isset($display_generated_id) ? $display_generated_id : '';
            }
            return json_encode($data);
        } else {
            return json_encode(['error' => 'no id']);
        }
    }



    public function listExcelDownload(Request $request)
    {
        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone('Asia/Jerusalem'));
        $fdate = $date->format('Y-m-d H:i:s');
        //\Carbon\Carbon::now()
        $filter = 'all';
        if ($request->filter)
            $filter = $request->filter;
        $wherediff = [];
        $whereline = "";
        switch ($filter) {
            case "all":
                $whereline = "";
                break;
            case "active":
                $whereline = "`finish_date` > now() and `deleted` = 0 and `stopped` = 0";
                break;
            case "inactive":
                $whereline = "`finish_date` < now() and `deleted` = 0 and `stopped` = 0";
                break;
            case "stopped":
                $where = ["stopped" => 1];
                $whereline = "stopped=1 ";
                break;
            case "canceled":
                $where = ["stopped" => 1];
                $whereline = "stopped=1 ";
                break;

            case "tender_type":
                $whereline = "is_drushim = " . ($request->tender_type == "4" ? 1 : 0);
                break;
        }
        //echo(strpos($request->filter, '-') !== false);
        if (isset($request->filter) && strpos($request->filter, '-') !== false) {
            //echo('hi');
            $where = ["generated_id" => $request->filter];
            $whereline = "generated_id='" . $request->filter . "'";
        }

        if (isset($request->find)) {
            //echo('hi');
            if ($request->find == 'not_active_tender') {
                $where = ['finish_date' => now()];
                $whereline = "finish_date < '" . now() . "'";
            } else {
                if ($request->find == 'test_is_not_required') {
                    $data = 0;
                    $col = 'is_test_required';
                } else {
                    $data = 1;
                    $col = $request->find;
                }

                $where = [$col => $data];
                $whereline = "$col='$data'";
            }
        }

        if (isset($request->type)) {

            $where = ['ttype' => $request->type == 'internal_tender' ? 1 : 2];
            $whereline = "ttype=" . ($request->type == 'internal_tender' ? 1 : 2);
        }

        if (isset($request->dept)) {

            $where = ['brunch' => $request->dept . ""];
            $whereline = "brunch='" . $request->dept . "'";
        }
        // dd($whereline);
        if (isset($request->level)) {

            $where = ['functional_level' => $request->level];
            $whereline = 'functional_level like "%' . $request->level . '%"';
        }
        // dd($whereline);


        //echo($whereline);
        if ($whereline != '')
            array_push($wherediff, $whereline);
        //var_dump($wherediff);
        if ($request->start_date && self::checkADate($request->start_date)) {
            array_push($wherediff, ' DATE(created_date)>=STR_TO_DATE(' . self::checkADate($request->start_date) . ', \'%Y-%m-%d\')');
        }
        if ($request->finish_date && self::checkADate($request->finish_date)) {
            //	echo('ch finish');
            array_push($wherediff, ' DATE(created_date)<=STR_TO_DATE(' . self::checkADate($request->finish_date) . ', \'%Y-%m-%d\')');
        }


        if ($request->search) {
            array_push($wherediff, "tname like '" . $request->search . "%' " . " or input_manager like '%" . $request->search . "%'  or job_scope like '%" . $request->search . "%'  or subordinations like '%" . $request->search . "%'  or grades_voltage like '%" . $request->search . "%'" . " or generated_id like '%" . $request->search . "%'"); //TODO ESCAPE!!); //TODO ESCAPE!!
        }

        /*
			  if ($request->tender_type){
				  array_push ($wherediff, "tender_type = ".intVal($request->tender_type));
			  }
			  */

        ///$applications = Applications::get_all_applications();
        $whereRaw = count($wherediff) > 0 ? implode("and", $wherediff) : '1=1';
        //echo($whereRaw);
        //exit();

        $sql = DB::table('tenders_stat')->select()->whereRaw($whereRaw)->toSql();
        //echo($sql);
        $countRecords = DB::table('tenders_stat')->select()->whereRaw($whereRaw)->count();

        $userTenders = auth()->user()->load('tenders:id')->tenders->pluck('id')->toArray();
        $userLessTender = Tender::whereDoesntHave('user')->get('id')->pluck('id')->toArray();

        $userTenders = array_unique(array_merge($userTenders, $userLessTender));

        $list = DB::table('tenders_stat')->select()->where(function ($q) use ($userTenders) {
            return $q->whereIn('id', $userTenders)->orWhere('created_by', auth()->id());
        })->whereRaw($whereRaw)->orderby('id', 'desc')->get();

        $list = $list->transform(function ($v, $k) {
            $v->tender_data = \App\Models\Tender::withCount('applications')->where('generated_id', $v->generated_id)->first();
            $v->note_list = DB::table('apps_logs')->where('tender_id', $v->generated_id)->where('is_note', '1')->get('description')->pluck('description')->join(', ', ' and ');
            return $v;
        });
        // return view('excel.tender',['list' => $list]);
        return Excel::download(new TenderListExcelImport($list), 'tender_list.xls');
    }

    public function list(Request $request)
    {

        $user = \App\User::getCCurrentUser();
        // echo ("!!!".$user);
        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone('Asia/Jerusalem'));
        $fdate = $date->format('Y-m-d H:i:s');
        //\Carbon\Carbon::now()
        $filter = 'all';
        if ($request->filter)
            $filter = $request->filter;

        $active = DB::table('tenders')->where([
            ['finish_date', '>', $fdate],
            ['deleted', '=', 0],
            ['stopped', '=', 0],
        ])->get();

        $inactive = DB::table('tenders')->where([
            ['finish_date', '<', $fdate],
            ['deleted', '=', 0],
            ['stopped', '=', 0],
        ])->get();
        $pagesize = $request->page_size && $request->page_size > 0 ? $request->page_size : 15;
        $pagenum = 0;
        if ($request->page_num && $request->page_num > 0)
            $pagenum = $request->page_num;
        //echo($filter);
        //exit();
        $where = [];
        $wherediff = [];
        $whereline = "";
        switch ($filter) {
            case "all":
                $whereline = "";
                break;
            case "active":
                $whereline = "`finish_date` > now() and `deleted` = 0 and `stopped` = 0";
                break;
            case "inactive":
                $whereline = "`finish_date` < now() and `deleted` = 0 and `stopped` = 0";
                break;
            case "stopped":
                $where = ["stopped" => 1];
                $whereline = "stopped=1 ";
                break;
            case "canceled":
                $where = ["stopped" => 1];
                $whereline = "stopped=1 ";
                break;

            case "tender_type":
                $whereline = "is_drushim = " . ($request->tender_type == "4" ? 1 : 0);
                break;
        }
        //echo(strpos($request->filter, '-') !== false);
        if (isset($request->filter) && strpos($request->filter, '-') !== false) {
            //echo('hi');
            $where = ["generated_id" => $request->filter];
            $whereline = "generated_id='" . $request->filter . "'";
        }

        if (isset($request->find)) {
            //echo('hi');
            if ($request->find == 'not_active_tender') {
                $where = ['finish_date' => now()];
                $whereline = "finish_date < '" . now() . "'";
            } else {
                if ($request->find == 'test_is_not_required') {
                    $data = 0;
                    $col = 'is_test_required';
                } else {
                    $data = 1;
                    $col = $request->find;
                }

                $where = [$col => $data];
                $whereline = "$col='$data'";
            }
        }

        if (isset($request->type)) {
            $ttType  = match ($request->type) {
                'internal_tender' => 1,
                'external_tender' => 2,
                'internal_external_tender' => 3,
                default => 0,
            };
            $where = ['ttype' => $ttType];
            $whereline = "ttype=" . ($ttType);
        }

        if (isset($request->dept)) {

            $where = ['brunch' => $request->dept . ""];
            $whereline = "brunch='" . $request->dept . "'";
        }
        // dd($whereline);
        if (isset($request->level)) {

            $where = ['functional_level' => $request->level];
            $whereline = 'functional_level like "%' . $request->level . '%"';
        }
        // dd($whereline);


        //echo($whereline);
        if ($whereline != '')
            array_push($wherediff, $whereline);
        //var_dump($wherediff);
        if ($request->start_date && self::checkADate($request->start_date)) {
            array_push($wherediff, ' DATE(created_date)>=STR_TO_DATE(' . self::checkADate($request->start_date) . ', \'%Y-%m-%d\')');
        }
        if ($request->finish_date && self::checkADate($request->finish_date)) {
            //	echo('ch finish');
            array_push($wherediff, ' DATE(created_date)<=STR_TO_DATE(' . self::checkADate($request->finish_date) . ', \'%Y-%m-%d\')');
        }
        if ($request->template) {
            array_push($wherediff, " template_id = $request->template ");
        }

        if ($request->search) {
            array_push($wherediff, "tname like '%" . $request->search . "%' or input_manager like '%" . $request->search . "%' or job_scope like '%" . $request->search . "%' or
subordinations like '%" . $request->search . "%' or grades_voltage like '%" . $request->search . "%'" . " or generated_id like '%" . $request->search . "%' or
tender_number like '%" . $request->search . "%'"); //TODO ESCAPE!!); //TODO ESCAPE!!
        }

        /*
			  if ($request->tender_type){
				  array_push ($wherediff, "tender_type = ".intVal($request->tender_type));
			  }
			  */

        ///$applications = Applications::get_all_applications();
        $whereRaw = count($wherediff) > 0 ? implode("and", $wherediff) : '1=1';
        //echo($whereRaw);
        //exit();

        $sql = DB::table('tenders_stat')->select()->whereRaw($whereRaw)->toSql();
        //echo($sql);
        $countRecords = DB::table('tenders_stat')->select()->whereRaw($whereRaw)->count();
        $countPages = ceil($countRecords / $pagesize);

        $userTenders = auth()->user()->load('tenders:id')->tenders->pluck('id')->toArray();

        $userLessTender = Tender::whereDoesntHave('user')->get('id')->pluck('id')->toArray();

        $userTenders = array_unique(array_merge($userTenders, $userLessTender));

        $list = DB::table('tenders_stat')->select()->where(function ($q) use ($userTenders) {
            return $q->whereIn('id', $userTenders)->orWhere('created_by', auth()->id());
        })->whereRaw($whereRaw)->skip($pagenum * $pagesize)->take($pagesize)->orderby('id', 'desc')->get();


        $list->transform(function ($v) {
            $v->tender =  Tender::with('files')->find($v->id);
            return $v;
        });

        $count_active = DB::table('tenders_stat')->select()->where([
            ['finish_date', '>', $fdate],
            ["deleted", '=', 0],
            ["stopped", '=', 0],
        ])->where(function ($q) use ($userTenders) {
            return $q->whereIn('id', $userTenders)->orWhere('created_by', auth()->id());
        })->count();
        $count_inactive = DB::table('tenders_stat')->select()->where([
            ['finish_date', '<', $fdate],
            ["deleted", '=', 0],
            ["stopped", '=', 0],
        ])->where(function ($q) use ($userTenders) {
            return $q->whereIn('id', $userTenders)->orWhere('created_by', auth()->id());
        })->count();

        $display_list = array();
        foreach ($list as $line) {
            if (strpos($line->generated_id, '-') !== false) {
                $app_id = explode('-', $line->generated_id);
                array_push($display_list, ['generated_id' => $line->generated_id, 'display_generated_id' => \App\Applications::get_meta_value($app_id[1], 'tender_num_display')]);
            }
        }
        $count_stopped = DB::table('tenders_stat')->select()->where(["stopped" => 1])->where(function ($q) use ($userTenders) {
            return $q->whereIn('id', $userTenders)->orWhere('created_by', auth()->id());
        })->count();
        $count_all = DB::table('tenders_stat')->where(function ($q) use ($userTenders) {
            return $q->whereIn('id', $userTenders)->orWhere('created_by', auth()->id());
        })->count();
        $files_zichron_devarim = DB::table('apps_file')->select()->where(["type" => "zichron-devarim.pdf"])->get();
        $files_protocol = DB::table('apps_file')->select()->where(["type" => "protocol.pdf"])->get();
        $app_meta = DB::table('apps_meta')
            ->where('meta_name', '=', 'upload_admin_file')
            ->get();
        $id = '';
        $meta_value = null;
        $is_contain_file = array();
        foreach ($list as $key => $line) {
            $temp_id = explode('-', $line->generated_id);
            $id = isset($temp_id[1]) ? $temp_id[1] : '';
            if ($app_meta->contains('app_id', $id)) {
                $meta_value = DB::table('apps_meta')
                    ->where([
                        ['app_id', '=', $id],
                        ['meta_name', '=', 'upload_admin_file'],
                    ])
                    ->first();
                $is_contain_file[$id] = ['flag' => true, 'file' => $meta_value->meta_value];
            } else {
                $is_contain_file[$id] = ['flag' => false, 'file' => ''];
            }
        }
        $tenders = DB::table('tenders')->select('generated_id', 'tname', 'id')->where(["deleted" => 0, "stopped" => 0])->get();

        $users = User::get();

        return view('tenders', [
            'files_zichron_devarim' => $files_zichron_devarim,
            'files_protocol' => $files_protocol,
            'list' => $list,
            'display_list' => $display_list,
            'filter' => $filter,
            'filter1' => '',
            'templates' => Template::get(),
            'count_active' => $count_active,
            'count_inactive' => $count_inactive,
            'count_all' => $count_all,
            'count_stopped' => $count_stopped,
            'page_num' => $pagenum,
            'total_pages' => $countPages,
            //'submenu' => Applications::app_submenu_html( ),
            'pageTitle' => 'מכרזים',
            'upload_admin_file' => isset($meta_value->meta_value) ? $meta_value->meta_value : '',
            'is_contain_file' => $is_contain_file,
            'tenders' => $tenders,
            'tenderid' => $filter,
            'tender_status' => self::$tender_status,
            'users' => $users
        ]);
    }

    public function upload_file(Request $request, $applicationid)
    {
        \App\Applications::upload_file($request);
        return redirect()->back();
    }

    public function upload_test_file(Request $request, $applicationId)
    {
        if (empty($applicationId)) {
            return json_encode(['error' => 'אירעה שגיאה לא צפויה, אנא רענן את הדף ונסה שוב.']);
        }

        if ($request->hasFile('test_file') && !empty($request->file('test_file'))) {
            $file = $request->file('test_file');

            // Validate file type - Only PDF allowed for mandatory test
            $acceptable = ['application/pdf'];

            if (!in_array($file->getClientMimeType(), $acceptable) && !empty($file->getClientMimeType())) {
                return json_encode(['error' => 'רק קבצי PDF מותרים למבחן חובה.']);
            }

            // Additional check for file extension
            $extension = strtolower($file->getClientOriginalExtension());
            if ($extension !== 'pdf') {
                return json_encode(['error' => 'רק קבצי PDF מותרים למבחן חובה.']);
            }

            if ($file->getSize() >= 20971520 || $file->getSize() == 0) {
                return json_encode(['error' => 'קובץ גדול מדי. הקובץ חייב להיות קטן מ-20 מגה.']);
            }

            // Generate unique filename
            $filename = 'test_' . uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Move file to upload directory
            $file->move(public_path('upload/admin/'), $filename);

            // Save file data to database
            $file_data = [
                'app_dec_id' => $applicationId,
                'app_id' => 0, // For test files uploaded by admin
                'url' => $filename,
                'type' => 'mandatory_test',
                'file_name' => 'מבחן_חובה_' . $file->getClientOriginalName()."^^מבחן_חובה",
                'status' => '1'
            ];

            DB::table('apps_file')->insert($file_data);

            return json_encode(['success' => 'קובץ מבחן הועלה בהצלחה', 'filename' => $filename]);
        }

        return json_encode(['error' => 'לא נבחר קובץ להעלאה.']);
    }

    public function delete_test_file(Request $request, $fileId)
    {
        if (empty($fileId)) {
            return json_encode(['error' => 'אירעה שגיאה לא צפויה, אנא רענן את הדף ונסה שוב.']);
        }

        // Find the file in database
        $file = DB::table('apps_file')->where('id', $fileId)->where('type', 'mandatory_test')->first();

        if (!$file) {
            return json_encode(['error' => 'קובץ לא נמצא.']);
        }

        // Delete physical file
        $filePath = public_path('upload/admin/' . $file->url);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete from database
        DB::table('apps_file')->where('id', $fileId)->where('type', 'mandatory_test')->delete();

        return json_encode(['success' => 'קובץ מבחן נמחק בהצלחה']);
    }

    function checkADate($startdate)
    {
        if (strlen($startdate) != 10)
            return false;
        $newdate = explode('-', $startdate);
        //echo(count(($newdate)));
        //echo(json_encode($newdate));
        if (count($newdate) < 2)
            return false;
        $res = "'" . $newdate[0] . "-" . $newdate[1] . "-" . $newdate[2] . "'";
        //echo($res);
        return $res;
    }

    public function stopTender(Request $request, $tenderid)
    {
        $user = \App\User::getCCurrentUser();
        if (!$user)
            return json_encode(["res" => "error", 'code' => 1]);

        $gid = $tenderid ?? $request->tenderid;

        $tender = DB::table('tenders')->where('generated_id', '=', $request->tenderid)->first();

        $status = !$tender->stopped;
        $actionTxt = $tender->stopped ? 'stopped' : 'started';
        $logTxt = $tender->stopped ? 'נעצר' : 'התחיל';


        $logText = ' מכרז מספר ' . $gid . ' ' . $logTxt . ' על ידי ' . $user;
        DB::table('apps_logs')->insert([['tender_id' => $gid, 'app_id' => '0', 'description' => $logText]]);


        if (isset($request->tenderid)) {
            DB::table('tenders')->where('generated_id', '=', $request->tenderid)->update(['stopped' => $status]);
            return json_encode(['action' => $actionTxt, 'id' => $request->tenderid]);
        } else
            return json_encode(['error' => 'noid']);
    }

    public function exportTenderSorted(Request $request)
    {
        $filename = "tender_sorted.xls"; // File Name
        $line_main = DB::table('tenders')->where(['generated_id' => $request->tenderId])->first();
        $tname = $line_main->tname;
        $resArr = []; //tenders_applications
        //$data = DB::table ('app_decisions')->where (['tenderval' => $request->tenderId])->get();
        $data = DB::table('tenders_applications')->where(['tenderval' => $request->tenderId])
            ->where('app_status', 'LIKE', 'Interview')
            ->get();
        foreach ($data as $line) {
            try {
                $row1 = [
                    "candidates_name" => $line->applicant_name,
                ];
                array_push($resArr, $row1);
            } catch (\Exception $e) {
                echo ("Err!");
                echo ($e->getMessage());
            }
        }
        $viewClass = new TenderSortedExport([
            'tname' => isset($tname) ? $tname : '',
            'arr' => $resArr,
        ], ["name" => "exportCandidateDetails"]);
        return Excel::download($viewClass, $filename);
    }

    public function exportCandidateDetails(Request $request)
    {
        $filename = "candidate_details.xls"; // File Name
        $line_main = DB::table('tenders')->where(['generated_id' => $request->tenderId])->first();
        $tname = $line_main->tname;
        if (isset($line_main->tender_type)) {
            if ($line_main->tender_type == 0) {
                $tender_type = 'מכרז';
            }
            if ($line_main->tender_type == 1) {
                $tender_type = 'משרת סטודנט';
            }
            if ($line_main->tender_type == 2) {
                $tender_type = 'משרת ממלא מקום';
            }
            if ($line_main->tender_type == 3) {
                $tender_type = 'אחר';
            }
        }
        $brunch = $line_main->brunch;
        $resArr = [];
        $data = DB::table('app_decisions')->where(['tenderval' => $request->tenderId])->get();
        foreach ($data as $line) {
            $committee_date = DB::table('apps_meta')->where([
                ["app_id", "=", $line->id],
                ["meta_name", "=", "committee_date"],
            ])->first();
            if (isset($committee_date->meta_value)) {
                $is_invited = 'כן';
            } else {
                $is_invited = 'לא';
            }
            try {
                $row1 = [
                    "email" => $line->email,
                    "phone" => Applications::get_json($line->p5_id, 'personal_phone_select') . '-' . Applications::get_json($line->p5_id, 'personal_phone'),
                    "is_invited" => $is_invited,
                    "more_docs" => '',
                    "candidates_name" => $line->applicant_name,
                ];
                array_push($resArr, $row1);
            } catch (\Exception $e) {
                echo ("Err!");
                echo ($e->getMessage());
            }
        }
        $viewClass = new CandidateDetailsExport([
            'tname' => isset($tname) ? $tname : '',
            'tender_type' => $tender_type,
            'brunch' => isset($brunch) ? $brunch : '',
            'arr' => $resArr,
        ], ["name" => "exportCandidateDetails"]);
        return Excel::download($viewClass, $filename);
    }

    public function exportTenderStatusBrunch(Request $request)
    {
        $filename = "tender_status_brunch.xls"; // File Name
        $data = DB::table('tenders')->where(['deleted' => 0])->orderBy('brunch', 'desc')->get();
        $resArr = [];
        foreach ($data as $line_main) {
            $start_date = isset($line_main->start_date) ? $line_main->start_date : '';
            $finish_date = isset($line_main->finish_date) ? $line_main->finish_date : '';
            if (now() < $line_main->finish_date && $line_main->stopped == 0) {
                $status = 'פעיל';
            } else if ($line_main->stopped == 1) {
                $status = 'נעצר';
            } else {
                $status = 'לא פעיל';
            }
            if (isset($line_main->is_exist)) {
                if ($line_main->is_exist == 1) {
                    $is_exist = 'קיימת';
                } else {
                    $is_exist = 'חדשה';
                }
            } else {
                $is_exist = '';
            }
            if (isset($line_main->tender_type)) {
                if ($line_main->tender_type == 0) {
                    $tender_type = 'מכרז';
                }
                if ($line_main->tender_type == 1) {
                    $tender_type = 'משרת סטודנט';
                }
                if ($line_main->tender_type == 2) {
                    $tender_type = 'משרת ממלא מקום';
                }
                if ($line_main->tender_type == 3) {
                    $tender_type = 'אחר';
                }
            }
            $candidates_approached = DB::table('app_decisions')->where(["tenderval" => $line_main->generated_id])->count();
            $candidates_passed_thresholds = DB::table('app_decisions')->where([
                ["tenderval", "=", $line_main->generated_id],
                ["decision_1", "=", 1],
            ])->count();
            $committee_date = DB::table('apps_meta')->where([
                ["app_id", "=", $line_main->id],
                ["meta_name", "=", "committee_date"],
            ])->first();
            $data = DB::table('app_decisions')->where(['tenderval' => $line_main->generated_id])->get();
            $candidates_invited = 0;
            foreach ($data as $line) {
                $committee_date = DB::table('apps_meta')->where([
                    ["app_id", "=", $line->id],
                    ["meta_name", "=", "committee_date"],
                ])->first();
                if (isset($committee_date->meta_value)) {
                    $candidates_invited++;
                }
            }

            /*
					 $candidates_invited = DB::table('tenders_applications')->select()->where([
						 ['generated_id', '=', $line_main->generated_id],
						 ['app_statusnum', '=', 3]
					 ])->orWhere([
						 ['generated_id', '=', $line_main->generated_id],
						 ['app_statusnum', '=', 5]
					 ])->orderby('id', 'desc')->count();
					 */
            $app_id = explode('-', $line_main->generated_id);
            $display_generated_id = \App\Applications::get_meta_value($app_id[1], 'tender_num_display');
            try {
                $row1 = [
                    "status" => $status,
                    "committee_date" => isset($committee_date->meta_value) ? $committee_date->meta_value : '',
                    "candidates_invited" => $candidates_invited,
                    "candidates_passed_thresholds" => $candidates_passed_thresholds,
                    "candidates_approached" => $candidates_approached,
                    "from_to_date" => $start_date . '-' . $finish_date,
                    "is_exist" => $is_exist,
                    "ttype" => $tender_type,
                    "brunch" => isset($line_main->brunch) ? $line_main->brunch : '',
                    "tname" => isset($line_main->tname) ? $line_main->tname : '',
                    "generated_id" => isset($display_generated_id) ? $display_generated_id : '',
                ];
                array_push($resArr, $row1);
            } catch (\Exception $e) {
                echo ("Err!");
                echo ($e->getMessage());
            }
        }
        $viewClass = new TenderStatusBrunchExport([
            'arr' => $resArr,
        ], ["name" => "exportTenderStatusBrunch"]);
        return Excel::download($viewClass, $filename);
    }

    public function exportTenderStatus(Request $request)
    {
        $filename = "tender_status.xls"; // File Name
        $data = DB::table('tenders')->where(['deleted' => 0])->get();
        $resArr = [];
        foreach ($data as $line_main) {
            $start_date = isset($line_main->start_date) ? $line_main->start_date : '';
            $finish_date = isset($line_main->finish_date) ? $line_main->finish_date : '';
            if (now() < $line_main->finish_date && $line_main->stopped == 0) {
                $status = 'פעיל';
            } else if ($line_main->stopped == 1) {
                $status = 'נעצר';
            } else {
                $status = 'לא פעיל';
            }
            if (isset($line_main->is_exist)) {
                if ($line_main->is_exist == 1) {
                    $is_exist = 'קיימת';
                } else {
                    $is_exist = 'חדשה';
                }
            } else {
                $is_exist = '';
            }
            if (isset($line_main->tender_type)) {
                if ($line_main->tender_type == 0) {
                    $tender_type = 'מכרז';
                }
                if ($line_main->tender_type == 1) {
                    $tender_type = 'משרת סטודנט';
                }
                if ($line_main->tender_type == 2) {
                    $tender_type = 'משרת ממלא מקום';
                }
                if ($line_main->tender_type == 3) {
                    $tender_type = 'אחר';
                }
            }
            $candidates_approached = DB::table('app_decisions')->where(["tenderval" => $line_main->generated_id])->count();
            $candidates_passed_thresholds = DB::table('app_decisions')->where([
                ["tenderval", "=", $line_main->generated_id],
                ["decision_1", "=", 1],
            ])->count();
            $committee_date = DB::table('apps_meta')->where([
                ["app_id", "=", $line_main->id],
                ["meta_name", "=", "committee_date"],
            ])->first();
            $candidates_invited = DB::table('tenders_applications')->select()->where([
                ['generated_id', '=', $line_main->generated_id],
                ['app_statusnum', '=', 3],
            ])->orWhere([
                ['generated_id', '=', $line_main->generated_id],
                ['app_statusnum', '=', 5],
            ])->orderby('id', 'desc')->count();
            $app_id = explode('-', $line_main->generated_id);
            $display_generated_id = \App\Applications::get_meta_value($app_id[1], 'tender_num_display');
            try {
                $row1 = [
                    "status" => $status,
                    "committee_date" => isset($committee_date->meta_value) ? $committee_date->meta_value : '',
                    "candidates_invited" => $candidates_invited,
                    "candidates_passed_thresholds" => $candidates_passed_thresholds,
                    "candidates_approached" => $candidates_approached,
                    "from_to_date" => $start_date . '-' . $finish_date,
                    "is_exist" => $is_exist,
                    "ttype" => $tender_type,
                    "brunch" => isset($line_main->brunch) ? $line_main->brunch : '',
                    "tname" => isset($line_main->tname) ? $line_main->tname : '',
                    "generated_id" => isset($display_generated_id) ? $display_generated_id : '',
                ];
                array_push($resArr, $row1);
            } catch (\Exception $e) {
                echo ("Err!");
                echo ($e->getMessage());
            }
        }
        $viewClass = new TenderStatusExport([
            'arr' => $resArr,
        ], ["name" => "exportTenderStatus"]);
        return Excel::download($viewClass, $filename);
    }

    public function exportRegular(Request $request)
    {
        $where = '';
        if ($request->tenderId) {
            //$where = 'tendervar'
            $tval = DB::table('app_decisions')->where('tenderval', '=', $request->tenderId);
        } else {
            $tval = DB::table('app_decisions');
        }
        $filename = "standart_tenders" . (isset($request->tenderId) ? $request->tenderId : 'all') . ".xls"; // File Name
        $data = $tval->get();
        //	echo('1');
        //	var_dump($data);

        $resArr = [];
        // $line_main=$data[0];

        foreach ($data as $line_main) {
            $decId1 = $line_main->p1_id;
            $decId2 = $line_main->p2_id;
            $decId3 = $line_main->p3_id;
            $line1 = DB::table('apps_meta')->where(['app_id' => $decId1, 'meta_name' => 'metaJson'])->first();
            $line2 = DB::table('apps_meta')->where(['app_id' => $decId2, 'meta_name' => 'metaJson'])->first();
            $line3 = DB::table('apps_meta')->where(['app_id' => $decId3, 'meta_name' => 'metaJson'])->first();
            $datadata1 = [];
            $datadata2 = [];
            $datadata3 = [];
            if ($line1 && $line1->meta_value) {
                $vline = $line1->meta_value;
                $datadata1 = (array) unserialize($vline);
            }
            if ($line2 && $line2->meta_value) {
                $vline = $line2->meta_value;
                $datadata2 = (array) unserialize($vline);
            }
            if ($line3 && $line3->meta_value) {
                $vline = $line3->meta_value;
                $datadata3 = (array) unserialize($vline);
            }
            $datadata = array_merge($datadata1, $datadata2, $datadata3);
            //$datadata["tenderval"]=
            $allkeys = array_keys($datadata);
            $maxkeys = 0;
            foreach ($allkeys as $line) {
                $val = $datadata[$line];
                if (gettype($val) === "array") {
                    $len = count($val);
                    if ($maxkeys < $len)
                        $maxkeys = $len;
                    //echo();
                }
            }
            $datadata["max_arr_lines"] = $maxkeys;
            $datadata["tenderval"] = $line_main->tenderval;

            array_push($resArr, $datadata);
        }


        //$viewClass=new SpecialExport($view);

        /*return view('export.export_regular', [
				  'arr' => $resArr,
				  'tenderid' => $request->tenderId?$request->tenderid:0,

			  ]);*/
        $viewClass = new RegularExport([
            'arr' => $resArr,
            'tenderid' => $request->tenderid ? $request->tenderid : 0,

        ], ["name" => "TST"]);
        return Excel::download($viewClass, $filename);
    }

    public function exportSpec(Request $request)
    {
        $where = '';
        if ($request->tenderId) {
            //$where = 'tendervar'
            $tval = DB::table('app_decisions')->where(['tenderval' => $request->tenderId, 'decision_3' => '1']);
        } else {
            $tval = DB::table('app_decisions')->where(['decision_3' => '1']);
        }

        $filename = "specific_tenders" . (isset($request->tenderId) ? $request->tenderId : '') . ".xls"; // File Name
        // Download file
        /*header("Content-Disposition: attachment; filename=\"$filename\"");
			  header("Content-Type: application/vnd.ms-excel;  charset=UTF-8");
			  header("Pragma: no-cache");
			  header("Expires: 0");*/
        //	echo "\xEF\xBB\xBF"; //UTF-8 BOM
        $data = $tval->get();
        //	echo('1');
        //	var_dump($data);

        $resArr = [];
        foreach ($data as $line_main) {
            $decId = $line_main->p1_id;
            $line = DB::table('apps_meta')->where(['app_id' => $decId, 'meta_name' => 'metaJson'])->first();
            if ($line && $line->meta_value) {


                $dattmp2 = $line->meta_value;

                $dattmp = unserialize($dattmp2);
                $fname = $dattmp["firstname"];
                //var_dump($dattmp);
                //$lastname = $dattmp["soname"];
                $educ_low_school = isset($dattmp["educ_low_school"]) ? $dattmp["educ_low_school"] : '';

                $educ_institution_name = isset($dattmp["educ_institution_name"]) ? $dattmp["educ_institution_name"] : '';
                if (gettype($educ_institution_name) === "array")
                    $educ_institution_name = $educ_institution_name[0];

                $educ_kind_school = isset($dattmp["educ_kind_school"]) ? $dattmp["educ_kind_school"] : '';
                $educ_school_name = isset($dattmp["educ_school_name"]) ? $dattmp["educ_school_name"] : '';

                $educ_kind_high = isset($dattmp["educ_kind_high"]) ? $dattmp["educ_kind_high"] : '';
                $heduc_name = isset($dattmp["heduc_name"]) ? $dattmp["heduc_name"] : '';
                $expw = 0;


                $exp_finish = isset($dattmp["exp_finish"]) ? $dattmp["exp_finish"] : '';
                $expe_start = isset($dattmp["expe_start"]) ? $dattmp["expe_start"] : '';

                $exp_descr = isset($dattmp["exp_descr"]) ? $dattmp["exp_descr"] : '';
                if (gettype($exp_finish) === "array")
                    $expw = count($exp_finish);
                $aeducc = 0;
                $aeduc = isset($dattmp["add_educ_name"]) ? $dattmp["add_educ_name"] : '';
                if (gettype($aeduc) === "array")
                    $aeducc = count($aeduc);

                $asyears = isset($dattmp["add_educ_school_years"]) ? $dattmp["add_educ_school_years"] : "";
                $aeyears = isset($dattmp["add_duc_school_endyear"]) ? $dattmp["add_duc_school_endyear"] : "";

                //	[]add_duc_school_endyear[]

                try {
                    $row1 = [
                        "name" => $fname,

                        "educ" => $educ_low_school . " " . $educ_institution_name,
                        "years" => (isset($expe_start[0])) ? $expe_start[0] . " - " . (isset($exp_finish[0]) ? $exp_finish[0] : '') : '',
                        "descr" => ($expw > 0 && isset($exp_descr[0])) ? $exp_descr[0] : ''
                    ];

                    $row2 = [
                        "name" => "",
                        "educ" => $educ_kind_school . " " . $educ_school_name,
                        "years" => (isset($expe_start[1]) ? $expe_start[1] : '') . " -" . (isset($exp_finish[1]) ? $exp_finish[1] : ''),
                        "descr" => isset($exp_descr[1]) ? $exp_descr[1] : ''
                    ];

                    $row3 = [
                        "name" => "",

                        "educ" => $educ_kind_high . " " . $heduc_name,
                        "years" => ((isset($expe_start[2]) ? $expe_start[2] : '') . " - " . (isset($exp_finish[2]) ? $exp_finish[2] : '')),
                        "descr" => isset($exp_descr[2]) ? $exp_descr[2] : ''
                    ];


                    array_push($resArr, $row1);
                    array_push($resArr, $row2);
                    array_push($resArr, $row3);
                } catch (\Exception $e) {
                    echo ("Err!");
                    echo ($e->getMessage());
                    echo ($expw);
                    echo (json_encode($expe_start));
                    echo (json_encode($exp_finish));
                    echo (json_encode($exp_descr));
                }
                //echo(json_encode($resArr));

                //echo implode("\t", array_values((array)$row1)) . "\r\n";
                //echo implode("\t", array_values((array)$row2)) . "\r\n";
                //echo implode("\t", array_values((array)$row3)) . "\r\n";
                //echo($aeducc);
                //	echo(json_encode($aeduc));
                //	echo(json_encode($asyears));
                //		echo(json_encode($aeyears));

                if ($aeducc > 0) {
                    for ($i = 0; $i < $aeducc; $i++) {
                        $row = [
                            "name" => "",
                            "educ" => isset($aeduc[$i]) ? $aeduc[$i] : "",
                            "years" => (isset($asyears[$i]) ? $asyears[$i] : '') . "-" . (isset($aeyears[$i]) ? $aeyears[$i] : ''),
                            "descr" => (isset($exp_descr[$i + 3]) ? $exp_descr[$i + 3] : ''),
                        ];
                        //echo implode("\t", array_values((array)$row)) . "\r\n";
                        array_push($resArr, $row);
                    }
                }
                if ($expw > (3 + $aeducc)) {
                    for ($i = (3 + $aeducc); $i < $expw; $i++) {
                        $row = [
                            "name" => "",
                            "educ" => "",
                            "years" => ($decId . " " . $i . " " . isset($expe_start[$i]) ? $expe_start[$i] : '') . " -" . (isset($exp_finish[$i]) ? $exp_finish[$i] : ''),
                            "descr" => (isset($exp_descr[$i]) ? $exp_descr[$i] : ''),
                        ];
                        //echo implode("\t", array_values((array)$row)) . "\r\n";
                        array_push($resArr, $row);
                    }
                }
            }
            //echo(json_encode($resArr));

            //$line$dat=Applications::get_apps_data($decId);
            //echo($decId." ".json_encode($line->meta_value));

        }
        //var_dump($resArr);
        //echo(json_encode($resArr));

        $view = view('export.export_special', [
            'arr' => $resArr,
            'tenderid' => $request->tenderid,

        ]);
        // return $view;
        $viewClass = new SpecialExport([
            'arr' => $resArr,
            'tenderid' => $request->tenderid,

        ]);

        //$viewClass=new SpecialExport($view);
        return Excel::download($viewClass, $filename);


        echo (json_encode($resArr));
    }

    public function exportTenders(Request $request)
    {
        //Excel::download(new TendersExport(), 'users.xlsx');
        //	return ;

        $data = DB::table('tenders_stat')->get();
        $filename = "tenders.xls"; // File Name
        // Download file
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        //var_dump($res);
        //return Excel::download(new FormsExport, 'export.xlsx');
        //header("Content-Type: text/plain");

        $flag = false;
        foreach ($data as $row) {
            if (!$flag) {
                // display field/column names as first row
                //echo implode("\t", array_keys($row)) . "\r\n";
                $flag = true;
            }
            //echo(json_encode($row));
            echo implode("\t", array_values((array) $row)) . "\r\n";
        }
        exit;
    }


    public function continueTender(Request $request)
    {
        $user = \App\User::getCCurrentUser();
        if (!$user)
            return json_encode(["res" => "error", 'code' => 1]);

        if (isset($request->tenderid)) {


            $gid = $request->tenderid;
            $logText = ' מכרז מספר ' . $gid . ' הופעל מחדש על ידי ' . $user;
            DB::table('apps_logs')->insert([['tender_id' => $gid, 'app_id' => '0', 'description' => $logText]]);


            DB::table('tenders')->where('generated_id', '=', $request->tenderid)->update(['stopped' => 0]);
            return json_encode(['action' => 'continued', 'id' => $request->tenderid]);
            /*
					 $user=\App\User::getCCurrentUser();
					 $logText=$user.' '.' מכרז מספר "מספר המכרז" נערך על יד ';
					 DB::table ('apps_logs')->insert ([['app_id' => $data["p1_id"], 'description' => $logText]]);
					 */
        } else
            return json_encode(['error' => 'noid']);
    }

    public function dubTender(Request $request)
    {
        $user = \App\User::getCCurrentUser();
        if (!$user)
            return json_encode(["res" => "error", 'code' => 1]);

        if (isset($request->tenderid)) {
            $tender = DB::table('tenders')->where('generated_id', '=', $request->tenderid)->first();

            $newGid = json_decode(self::getNewTenderId());

            $format = 'Y-m-d H:i';
            $res = ["res" => $request->name];
            $data = array(
                'tname' => $tender->tname,
                'generated_id' => $newGid,
                'start_date' => ($tender->start_date),
                'finish_date' => ($tender->finish_date),
            ); // ,"last_name"=>$last_name,"city_name"=>$city_name,"email"=>$email);
            $last_id = DB::table('tenders')->insertGetId($data);
            $user = \App\User::getCCurrentUser();
            $gid = $request->tenderid;
            $gid2 = DB::table('tenders')->where('id', '=', $last_id)->first();
            $logText1 = ' מכרז מספר ' . $gid . ' שוכפל על ידי ' . $user;
            DB::table('apps_logs')->insert([['tender_id' => $gid, 'app_id' => '0', 'description' => $logText1]]);

            $logText2 = ' מספר מכרז ' . $gid2->generated_id . ' שוכפל ממכרז מספר ' . $gid . ' על ידי ' . $user;
            DB::table('apps_logs')->insert([['tender_id' => $gid2->generated_id, 'app_id' => '0', 'description' => $logText2]]);


            return json_encode(['action' => 'dubbed', 'newid' => $last_id, 'new_gid' => $newGid, 'old_id' => $request->tenderid]);
        } else
            return json_encode(['error' => 'noid']);
    }

    public function getNewTenderId()
    {
        $line = DB::table('tenders')->selectRaw('year(created_date) as cd, 101+max(id) as id ')->groupByRaw('year(created_date)')->get();
        if ($line->isEmpty()) {
            $line[0] = new \stdClass(); // Creating a new stdClass object if $line is empty
            $line[0]->cd = date("Y");
            $line[0]->id = 101;
        }
        $index = count($line) - 1;
        $existsCheck = DB::table('tenders')->where('generated_id', $line[$index]->cd . "-" . $line[$index]->id);
        if ($existsCheck->exists()) {
            $maxResult = DB::select("SELECT MAX(CAST(SUBSTRING(generated_id FROM POSITION('-' IN generated_id) + 1) AS UNSIGNED)) AS max_value FROM tenders");
            $maxValue = $maxResult[0]->max_value ?? 100;
            return json_encode(date("Y") . '-' . ($maxValue + 1));
        }
        return json_encode($line[$index]->cd . "-" . $line[$index]->id);
    }

    public function delTender(Request $request)
    {
        $user = \App\User::getCCurrentUser();
        if (!$user)
            return json_encode(["res" => "error", 'code' => 1]);

        if (isset($request->tenderid)) {
            DB::table('tenders')->where('generated_id', '=', $request->tenderid)->update(['deleted' => 1]);
            //$user=\App\User::getCCurrentUser();
            //$logText=$user.' '.'מכרז מספר "מספר המכרז" שוכפל על ידי';
            // DB::table ('apps_logs')->insert ([['app_id' => $data["p1_id"], 'description' => $logText]]);
            return json_encode(['action' => 'deleted', 'id' => $request->tenderid]);
        } else
            return json_encode(['error' => 'noid']);
    }

    public function saveTender(Request $request)
    {
        $user = \App\User::getCCurrentUser();
        if (!$user)
            return json_encode(["res" => "error", 'code' => 1]);
        Log::debug('tenderStatus: #:' . $request->tenderStatus);
        if (isset($request->tenderid) && isset($request->tenderStatus)) {
            DB::table('tenders')->where('generated_id', '=', $request->tenderid)->update(['tender_status' => $request->tenderStatus]);
            //$user=\App\User::getCCurrentUser();
            //$logText=$user.' '.'מכרז מספר "מספר המכרז" שוכפל על ידי';
            // DB::table ('apps_logs')->insert ([['app_id' => $data["p1_id"], 'description' => $logText]]);
            return json_encode(['action' => 'saved', 'id' => $request->tenderid]);
        } else
            return json_encode(['error' => 'noid']);
    }

    public function Allrequests(Request $request)
    {


        $list = DB::table('tenders_applications')->select()->orderby('id', 'desc')->get();
        return view('tenders-requests', [
            'list' => $list,
            'tenderid' => $request->tenderid,
            'filter' => 'all',
            'statuses' => self::getStatuses(),
            //'submenu' => Applications::app_submenu_html( ),
            'pageTitle' => 'פניות',
        ]);
    }

    function getStatuses()
    {
        return config('static_array.statusList');
    }

    public function requests(Request $request)
    {
        //echo($request->tenderid);
        $list = DB::table('tenders_applications')->select()->where('generated_id', '=', $request->tenderid)->orderby('id', 'desc')->get();
        $count = DB::table('tenders_applications')->where('generated_id', '=', $request->tenderid)->select()->count();

        //var_dump($list);
        //	exit();
        //echo(json_encode($list));
        return view('tenders-requests', [
            'list' => $list,
            'tenderid' => $request->tenderid,
            'count' => $count,
            'filter' => 'all',

            //'submenu' => Applications::app_submenu_html( ),
            'pageTitle' => 'פניות',
        ]);
    }

    public function requestssorted(Request $request)
    {
        //echo($request->tenderid);
        //$sort, $tenderid
        $startdate = false;
        $enddate = false;
        $pagesize = $request->page_size && $request->page_size > 0 ? $request->page_size : 15;
        $pagenum = 0;
        if ($request->page_num && $request->page_num > 0)
            $pagenum = $request->page_num;

        $sort = $request->sort;
        //var_dump($sort);
        $where = [];
        $wherediff = [];
        if ($sort === "all") {
            $where = [];
        }

        if ($sort === "new") {
            $where = ["app_statusnum" => "1"];
            $wherediff = [" app_statusnum=1"];
        }
        if ($sort === "accepted") {
            $where = ["app_statusnum" => "5"];
            $wherediff = [" app_status collate utf8mb4_unicode_ci ='Accepted'"];
        }
        if ($sort === "stared") {
            $where = ["is_star" => "1"];
            $wherediff = [" is_star=1"];
        }
        if ($sort === "passed") {
            $where = ["test_result" => "1"];
            $wherediff = [" test_result=1"];
        }
        if ($sort === "failed") {
            $where = ["test_result" => "0"];
            $wherediff = [" test_result=0"];
        }

        if ($sort === "test-required") {
            $where = ["is_test_required" => "1"];
            $wherediff = [" is_test_required=1"];
        }
        if ($sort === "test-not-required") {
            $where = ["is_test_required" => "0"];
            $wherediff = [" is_test_required=0"];
        }

        if ($sort === "no-result") {
            $where = ["no-result" => "is null "];
            $wherediff = [" test_result is null "];
        }



        if ($sort === "accepted_a") {
            $where = ["app_statusnum" => "13"];
            $wherediff = [" app_status collate utf8mb4_unicode_ci ='Accepted A'"];
        }
        if ($sort === "accepted_b") {
            $where = ["app_statusnum" => "14"];
            $wherediff = [" app_status collate utf8mb4_unicode_ci ='Accepted B'"];
        }

        if ($sort === "rejected0") {
            $where = ["app_statusnum" => "6"];
            $wherediff = [" app_statusnum=6"];
        }
        // if ( $sort === "canceled" ) {
        // 	$where = ["app_statusnum" => "7"];
        // 	$wherediff = [" app_statusnum=7"];

        // }
        if ($sort === "canceled") {
            $where = ["app_statusnum" => "15"];
            $wherediff = [" app_statusnum=15"];
        }
        if ($sort === "rejected") {
            $where = ["app_statusnum" => "4"];
            $wherediff = [" app_status collate utf8mb4_unicode_ci ='Rejected'"];
        }
        if ($sort === "interview") {
            $where = ["app_statusnum" => "3"];
            $wherediff = [" app_statusnum=3"];
        }

        if ($sort === "interview_b") {
            $where = ["app_statusnum" => "12"];
            $wherediff = [" app_statusnum=12"];
        }

        // if ( $sort === "stared" ) {
        // 	$where = ["is_star" => "1"];
        // 	$wherediff = [" is_star=1"];
        // }

        if ($sort === "interview_a") {
            $where = ["app_statusnum" => "11"];
            $wherediff = [" app_statusnum=11"];
        }
        if ($sort === "committee") {
            $where = ["app_statusnum" => "10"];
            $wherediff = [" app_status collate utf8mb4_unicode_ci ='Committee'"];
        }
        if ($sort === "waitingforfiles") {
            $where = ["app_statusnum" => "2"];
            $wherediff = [" app_statusnum=2"];
        }
        if ($sort === "waitingforfilesapproval") {
            //$where = ["app_statusnum" => "8"];
            $wherediff = [" app_statusnum=8"];
        }
        if ($sort === "waiting") {
            //$where = ["app_statusnum" => "8"];
            $wherediff = [" app_statusnum=9"];
        }
        //echo('+++'.$tenderid);
        //	if ($where<>[] ) array_push ($wherediff, $where);
        if ($request->tenderid && $request->tenderid !== "all") {
            $where = ["generated_id" => $request->tenderid];
            array_push($wherediff, "generated_id='" . $request->tenderid . "'");
        }
        if ($request->start_date && self::checkADate($request->start_date)) {
            array_push($wherediff, ' DATE(created_date)>=STR_TO_DATE(' . self::checkADate($request->start_date) . ', \'%Y-%m-%d\')');
        }
        if ($request->finish_date && self::checkADate($request->finish_date)) {
            //	echo('ch finish');
            array_push($wherediff, ' DATE(created_date)<=STR_TO_DATE(' . self::checkADate($request->finish_date) . ', \'%Y-%m-%d\')');
        }
        // dd($wherediff);
        if ($request->search) {
            $idSearch = str($request->search)->after('10');
            $idSearch1 = (int) $request->search - 100;
            array_push($wherediff, "applicant_name like '%" . $request->search . "%'" . " or id_tz like '" . $request->search . "%' or tender_number like '%" . $request->search .
                "%' or tname like '%" . $request->search . "%' or generated_id like '%" . $request->search . "' or id like '%" . $request->search . "' or id like '%" . $idSearch . "' or id like
'%" . $idSearch1 . "'"); //TODO ESCAPE!!
        }
        // dd($wherediff);

        $whereRaw = count($wherediff) > 0 ? implode(" and ", $wherediff) : '1=1';
        //	echo("!!!!!<Br/>".json_encode($wherediff)."+"."<br/>");

        $sql = DB::table('tenders_applications')->select()->whereRaw($whereRaw)->skip($pagenum * $pagesize)->take($pagesize)->orderby('id', 'desc')->toSql();
        //	echo(json_encode($whereRaw)."<br/>");
        //$sql=DB::

        //echo($sql);
        //	exit();

        $userTenders = auth()->user()->load('tenders')->tenders->pluck('generated_id')->toArray();
        $tenderList = Tender::where('created_by', auth()->id())->get('generated_id')->pluck('generated_id')->toArray();
        $tenderUserLess = $userLessTender = Tender::whereDoesntHave('user')->get('generated_id')->pluck('generated_id')->toArray();
        $allTenders = array_unique(array_merge($userTenders, $tenderList, $tenderUserLess));



        $ct = DB::table('tenders_applications')->select()->whereRaw($whereRaw)->whereIn('generated_id', $allTenders)->count();
        $total_pages = 0;
        $total_pages = ceil($ct / $pagesize);

        $sqla = "select p1_id,p2_id,p3_id,p5_id from app_decisions where tenderval='" . $request->tenderid . "'";
        // echo($sqla);
        $tenderall = DB::select($sqla);
        $ta = [];
        foreach ($tenderall as $tline) {
            if ($tline->p1_id !== 0)
                array_push($ta, $tline->p1_id);
            if ($tline->p2_id !== 0)
                array_push($ta, $tline->p2_id);
            if ($tline->p3_id !== 0)
                array_push($ta, $tline->p3_id);
            if ($tline->p5_id !== 0)
                array_push($ta, $tline->p5_id);
        }
        $add = ' where app_id in ' . json_encode($ta);
        //echo(count($ta));
        // exit();
        if (count($ta) === 0)
            $add = '';
        $sqlaa = 'select * from apps_logs  ' . $add . ' order by l_date';
        $sqlaa = str_replace('[', '(', $sqlaa);
        $sqlaa = str_replace(']', ')', $sqlaa);
        //	echo($sqlaa);
        $applogs = DB::select($sqlaa);
        //echo(json_encode($applogs));

        //$ta=$tenderall->get();
        //echo(json_encode ($ta));

        //	exit();

        //echo('ss');
        //echo(json_encode($tenderall));

        //	echo($ct.'<br/>');
        //echo($total_pages);

        //		exit();

        //	exit();
        //$list = DB::table('tenders_applications')->select()->where($where)->skip($pagenum*$pagesize)->take($pagesize)->orderby('id', 'desc')->get();


        $list = DB::table('tenders_applications')->select()->whereRaw($whereRaw)->whereIn('generated_id', $allTenders)->skip($pagenum * $pagesize)->take($pagesize)->orderby('id', 'desc')->get();
        $count = DB::table('tenders_applications')->select()->whereRaw($whereRaw)->whereIn('generated_id', $allTenders)->count();
        $tcount = DB::table('tenders_applications')->select()->whereIn('generated_id', $allTenders)->count();

        // echo(json_encode($list));
        //echo(json_encode($list));
        $tenders = DB::table('tenders')->select('generated_id', 'tname', 'id')->where(["deleted" => 0, "stopped" => 0])->get();
        /*	$fls=DB::select(DB::raw('select count(*) as cc, app_id from apps_file  where status=4 group by app_id'));
				  $fl=[];
				  foreach($fls as $fline)
				  {
					  array_push($fl,$fline->app_id);
				  }
				  $fline=implode(',',$fl);
				  echo($fline);
		  */

        $display_list = array();
        $startList = [];
        $appStatus = [];
        $qualificationsData = [];
        $row = 0;
        foreach ($list as $line) {
            if (strpos($line->generated_id, '-') !== false) {
                $app_id = explode('-', $line->generated_id);
                $app_dec = AppDecisions::find($line->id);
                $appStatus[$line->id] = DB::table('app_decisions_ext')->select(['id', 'status'])->where('id', $line->id)->first('status');
                $startList[] = $app_dec->is_star;
                array_push($display_list, ['generated_id' => $line->generated_id, 'display_generated_id' => \App\Applications::get_meta_value($app_id[1], 'tender_num_display')]);
            }
            $line->phone = Applications::get_json($line->p5_id, 'personal_phone_select') . '-' . Applications::get_json($line->p5_id, 'personal_phone');

            // Parse qualifications data from tender
            $tender = DB::table('tenders')->where('generated_id', $line->tenderval)->first();
            if ($tender && $tender->qualifications) {
                $qualificationsData[$line->id] = $this->parseQualifications($tender->qualifications, $tender->conditions, $line->id);
            } else {
                $qualificationsData[$line->id] = $this->getEmptyQualifications();
            }

            $row++;
        }
        //var_dump($list);
        // exit();

        return view('tenders-requests', [
            'display_list' => $display_list,
            'list' => $list,
            'tenderid' => $request->tenderid,
            'count' => $count,
            'filter' => $sort,
            'logs' => $applogs,
            'tenders' => $tenders,
            'statuses' => self::getStatuses(),
            'appStatus' => $appStatus,
            'startList' => $startList,
            'qualificationsData' => $qualificationsData,
            'page_num' => $pagenum,
            'pagesize' => $pagesize,
            'total_pages' => $total_pages,
            //'submenu' => Applications::app_submenu_html( ),
            'pageTitle' => 'פניות',
        ]);
    }

    public function adduserdecision(Request $request)
    {
        $decisionId = $request->decisionId;
        $userId = $request->userId;
        $res = DB::table('user_decisions')->insertGetId(["decisionId" => $decisionId, "userId" => $userId]);
        if ($res)
            return json_encode(["res" => "success", "data" => $res]);
        else
            return json_encode(["error" => 1]);
    }

    public function deluserdecision(Request $request)
    {
        $decisionId = $request->decisionId;
        $userId = $request->userId;
        //	echo($decisionId."\n");
        //	echo($userId."\n");
        $sql = DB::table('user_decisions')->where(["decisionId" => $decisionId, "userId" => $userId])->toSql();
        //	echo($sql);
        $res = DB::table('user_decisions')->where(["decisionId" => $decisionId, "userId" => $userId])->delete();
        if ($res)
            return json_encode(["res" => "success", "data" => $res]);
        else
            return json_encode(["error" => 1]);
    }


    public function debugDecision(Request $request)
    {
        $arrParams = self::makeDecisionActions($request);
        if ($arrParams) {
            $view = $arrParams["view"];
            $data = $arrParams["data"];
            $pdf = PDF::loadView('pdf.pdfview_' . $view, $data);
            //var_dump($arrParams);
            //exit();
            $fail_name = uniqid() . '_' . time();
            $filename = public_path('upload/admin/' . $fail_name . '.pdf');
            return $pdf->download('test.pdf');
            //	$pdf->save($filename);
            /*//$to = $app->email;
					 $body = '<h3>תודה על פנייתכם, מצ"ב:</h3>
							 <ol>
								 <li>טופס הבקשה שמילאתם.</li>
								 <li>מסמך ממחלקת חינוך. </li>
							 </ol><br><br>
							 ברכה, <br>
							 מחלקת חינוך.';
					 //$formpdf = Applications::get_pdf_file($id);
					 //$formpdfurl = asset('upload/'.$formpdf->url);
					 $files = array($filename);

					 if (file_exists($filename)) {


						 \Mail::to($data->sender)->send(new SendMailable($body, ($files), $view, 'decision'));
					 }
					 */
            //	$res=["res"=>"ok"];
            //	return json_encode($res);

        }
    }

    private function makeDecisionActions(Request $request)
    {
        $decisionId = $request->decisionId;
        $decisions = DB::table('app_decisions')->where(["id" => $request->decisionId])->first();
        $tender = DB::table('tenders')->where(["generated_id" => $decisions->tenderval])->first();
        $sql = "select tenders.generated_id,name,u.id from users u
												join user_tenders ut on ut.userId=u.id
join tenders on ut.tenderId=tenders.id and tenders.generated_id='" . $decisions->tenderval . "'";
        $users = DB::select($sql);
        $sql0 = 'select name, users.id,ud.decisionId from user_decisions ud join users on ud.userId=users.id where ud.decisionId=' . $request->decisionId;
        $rusers = DB::select($sql0);
        $apps_meta = Applications::get_all_meta($request->decisionId);
        //$decisionsA = DB::table ('app_decisions')->where (["id" => $request->decisionId])->first();
        $app = DB::table('applications')->where(["id" => $decisions->p5_id])->first();
        $decision = $request->decision;
        $comment = $request->text_value;
        $comment_text_reject = $request->comment_text_reject_value;
        $desired_hourly_rate_value = $request->desired_hourly_rate_value;
        $sender = $decisions->email;
        $tenderid = $decisions->tenderval;
        $user = \App\User::getCCurrentUser();
        $logText = '';
        $level_b_url = self::get_level_b_url($app);
        if ($decision === "5") {
            if ($comment_text_reject === "1") {
                $view = 'approve3';
                $logText = 'נשלח למועמד מכתב קבלה לעבודה על ידי ' . $user;
            }
            if ($comment_text_reject === "2") {
                $view = 'approve4';
                $logText = 'נשלח למועמד מכתב מצריך מבדק מהימנות על ידי ' . $user;
            }
            if ($comment_text_reject === "3") {
                $view = 'approve5';
                $logText = 'נשלח למועמד מכתב מעבר שלב א על ידי ' . $user;
            }
            if ($comment_text_reject === "4") {
                $view = 'approve2';
                $logText = 'נשלח למועמד מכתב ״כשיר 2״ על ידי ' . $user;
            }
            if ($comment_text_reject === "5") {
                $view = 'approve1';
                $logText = 'נשלח למועמד מכתב ״כשיר 3״ על ידי ' . $user;
            }
            if ($comment_text_reject === "6") {
                $view = 'reject2';
                $logText = 'נשלח למועמד מכתב דחיית מועמד לאחר ועדת בחינה על ידי ' . $user;
            }
            if ($comment_text_reject === "7") {
                $view = 'reject0a';
                $logText = 'נשלח למועמד מכתב ביטול ההליך המכרזי על ידי ' . $user;
            }
            if ($comment_text_reject === "8") {
                $view = 'reject0d';
                $logText = 'נשלח למועמד מכתב פרסום נוסף של המכרז על ידי ' . $user;
            }
            $arr['decision_5'] = 1;
            $rss = DB::table('app_decisions')->where('id', '=', $decisionId)->update($arr);
            $decisionsA = DB::table('app_decisions')->where(["id" => $request->decisionId])->first();
            return [
                "view" => $view,
                "data" => [
                    'send_date' => date('d/m/Y'),
                    'sender' => $sender,
                    'tenderval' => $tenderid,
                    'comment_text_reject_value' => $comment,
                    'comment' => $comment,
                    'formid' => date('Y') . '-' . $decisionId,
                    'decId' => $decisionId,
                    'users' => Applications::user_inappp_html($decisionId, true),
                    'full_name' => $decisions->applicant_name,
                    'tendername' => $tender->tname,
                    'committee_date' => isset($apps_meta['committee_date']) ? $apps_meta['committee_date'] : '',
                    'logText' => $logText,
                    'desired_hourly_rate_value' => isset($desired_hourly_rate_value) ? $desired_hourly_rate_value : '',
                    'email' => $decisions->email,
                    'p5_id' => $decisionsA->p5_id,
                    'decision_5' => $decisionsA->decision_5,
                    'decision_4' => $comment,
                    'level_b_url' => $level_b_url,
                    'app_dec' => $decisionsA
                ],
            ];
        }
        if ($decision == "0" || $decision === "1" || $decision === "2" || $decision === "3" || $decision === "4") {
            /*if ($decision < "4"){
						 if ($decision === "2" || $decision === "3"){
							 $decparan = 'decision_' .$decision;
						 } else {
							 $decparan = 'decision_' . (intVal ($decision) + 1);
						 }
					 } else {
						 $decparan = 'decision_' .$decision;
					 }

					 $arr[$decparan] = 1;
					 if ($comment) {
						 $arr[$decparan . "_comment"] = $comment;
					 }
					 $rss = DB::table ('app_decisions')->where ('id', '=', $decisionId)->update ($arr);

					 Log::debug('$decisionsA: #:'.$decision. ' $decisionsA data:'. json_encode($rss));
					 $res = ["dec" => $decision, "decId" => $decisionId, "dcc" => $decparan, "cmt" => $comment, "email" => $decisions->email];*/
            $body = ';';
            $attach = 'testfile';
            $view = '';
            $comment_text_reject_value = '';
            $decision_ext = '';
            if ($decision === "0") {
                if ($comment_text_reject === "1") {
                    $view = 'approve0';
                    $decision_ext = '_a';
                }
                if ($comment_text_reject === "2")
                    $view = 'approve0a';
                $logText = 'נשלח למועמד אישור ציפיות שכר על ידי ' . $user;
            }
            if ($decision === "1") {
                if ($comment_text_reject === "1") {
                    $arr['decision_4'] = 1;
                    $arr['rejected'] = 1;
                    $view = 'reject0';
                }
                if ($comment_text_reject === "2")
                    $view = 'reject0a';
                if ($comment_text_reject === "3") {
                    $view = 'reject0c';
                    $comment_text_reject_value = $comment;
                }
                if ($comment_text_reject === "4") {
                    $view = 'reject0d';
                    $logText = 'נשלח למועמד מכתב פרסום נוסף של המכרז על ידי ' . $user;
                } else {
                    $logText = 'נשלח למועמד מכתב אי עמידה בתנאי סף על ידי ' . $user;
                }
            }
            //stepBackFirst
            if ($decision === "2") {
                if ($comment_text_reject === "1")
                    $view = 'reject1';
                if ($comment_text_reject === "2")
                    $view = 'reject0a';
                $logText = 'נשלח למועמד מכתב דחיית קבלה לעבודה ' . $user;
            }
            if ($decision === "4") {
                if ($comment_text_reject === "1")
                    $view = 'reject2';
                if ($comment_text_reject === "2")
                    $view = 'reject0a';
                if ($comment_text_reject === "4") {

                    $view = 'reject0_fd';
                    // failed to attend committee
                    $arr['rejected_status'] = 'fd';
                }
                if ($comment_text_reject === "3") {

                    $view = 'reject0_fr';
                    // final rejection
                    $arr['rejected_status'] = 'fr';
                    $logText = 'נשלח למועמד מכתב דחיית קבלה לעבודה ' . $user;
                }
            }
            if ($decision === "3" && isset($comment_text_reject) && !empty($comment_text_reject)) {
                if ($comment_text_reject === "1") {
                    $view = 'approve1';
                    $decision_ext = '_b';
                    $logText = 'נשלח למועמד מכתב ״כשיר 3״ על ידי ' . $user;
                }
                if ($comment_text_reject === "2") {
                    $view = 'approve2';
                    $decision_ext = '_a';
                    $logText = 'נשלח למועמד מכתב ״כשיר 2״ על ידי ' . $user;
                }
                if ($comment_text_reject === "3") {
                    $view = 'approve4';
                    $logText = 'נשלח למועמד מכתב מצריך מבדק מהימנות על ידי ' . $user;
                }
                if ($comment_text_reject === "4") {
                    $view = 'approve5';
                    $logText = 'נשלח למועמד מכתב מעבר שלב א על ידי ' . $user;
                }
                if ($comment_text_reject === "5") {
                    $view = 'approve3';
                    $logText = 'נשלח למועמד מכתב קבלה לעבודה על ידי ' . $user;
                }
            }
            if ($decision < "4") {
                if ($decision === "2" || $decision === "3") {
                    $decparan = 'decision_' . $decision;
                } else {
                    $decparan = 'decision_' . (intVal($decision) + 1);
                }
            } else {
                $decparan = 'decision_' . $decision;
            }

            $arr[$decparan . $decision_ext] = 1;
            if ($comment) {
                $arr[$decparan . "_comment"] = $comment;
            }
            $arr['stepback'] = 0;
            $rss = DB::table('app_decisions')->where('id', '=', $decisionId)->update($arr);

            Log::debug('$decisionsA: #:' . $decision . ' $decisionsA data:' . json_encode($rss));
            $res = ["dec" => $decision, "decId" => $decisionId, "dcc" => $decparan, "cmt" => $comment, "email" => $decisions->email];
            $fail_name = uniqid() . '_' . time();

            //DB::table ('apps_logs')->insert ([['app_id'=>$request->decisionId,'description' => $logText]]);
            Log::debug('$view:' . $view);
            $app_id = explode('-', $tenderid);
            $display_generated_id = \App\Applications::get_meta_value($app_id[1], 'tender_num_display');

            $decisionsA = DB::table('app_decisions')->where(["id" => $request->decisionId])->first();
            return [
                "view" => $view,
                "data" => [
                    'send_date' => date('d/m/Y'),
                    'sender' => $sender,
                    'responsivetendersusers' => (array) $users,
                    'responsivedecisionusers' => (array) $rusers,
                    'tenderval' => $display_generated_id,
                    'comment_text_reject_value' => $comment_text_reject_value,
                    'comment' => $decisionsA->decision_2_comment,
                    'decision_1' => $decisionsA->decision_1_comment,
                    'decision_2' => $decisionsA->decision_2_comment,
                    'decision_3' => $decisionsA->decision_3_comment,
                    'decision_4' => $decisionsA->decision_4_comment,
                    'p5_id' => $decisionsA->p5_id,
                    'formid' => date('Y') . '-' . $decisionId,
                    'decId' => $decisionId,
                    'users' => Applications::user_inappp_html($decisionId, true),
                    'full_name' => $decisions->applicant_name,
                    'tendername' => $tender->tname,
                    'committee_date' => isset($apps_meta['committee_date']) ? $apps_meta['committee_date'] : '',
                    'logText' => $logText,
                    'desired_hourly_rate_value' => isset($desired_hourly_rate_value) ? $desired_hourly_rate_value : '',
                    'email' => $decisions->email,
                    'level_b_url' => $level_b_url,
                    'app_dec' => $decisionsA
                ],
            ];
        }
        return false;
    }

    public function sendDecision(Request $request)
    {
        $validator = validator($request->all(), [
            'dec' => 'required',
            'decId' => 'required|exists:app_decisions,id',
            'text_value' => 'nullable',
            'comment_text_reject_value' => 'required|integer|min:1',
            'comment' => 'nullable',
        ], [
            'comment_text_reject_value.min' => 'Select a reason'
        ]);

        if ($validator->fails()) {
            return response([
                "res" => "nok",
                "error" => $validator->getMessageBag()->first()
            ]);
        }

        // dd($request->all());
        $arrParams = self::makeDecisionActions($request);
        // dd($arrParams);
        try {
            if ($arrParams) {
                $view = $arrParams["view"];
                $parr = ["approve0" => "שלב א אושר על ידי ", "approve1" => "שלב ב אושר על ידי ", "reject0" => "שלב א נדחה על ", "reject1" => "שלב ב נדחה על ידי "];
                Log::debug('in sendDecision 2c view: ' . $view);
                $data = $arrParams["data"];
                //$footerHtml = view()->make('pdf.pdf_decision_footer')->render();
                //$headerHtml = view()->make('pdf.pdf_decision_header')->render();
                //$headerHtml = view()->with('data_header', ['full_name' => $data['full_name'],'tendername' => $data['tendername']]);
                $pdf = PDF::loadView('pdf.pdfview_' . $view, $data)->setPaper('A4')->setOrientation('portrait');
                //$pdf->setOption('header-html', $headerHtml);
                //$pdf->setOption('footer-html', $footerHtml);
                //$pdf->setOption('margin-top',50);
                $pdf->setOption('margin-left', 10);
                $pdf->setOption('margin-right', 10);
                $fail_name = uniqid() . '_' . time();
                $filename = public_path('upload/admin/' . $fail_name . '.pdf');
                $pdf->save($filename);
                Log::debug('in sendDecision 4b: ' . $filename);
                $body = '<h3>תודה על פנייתכם, מצ"ב:</h3>
                    <ol>
                        <li>טופס הבקשה שמילאתם.</li>
                        <li>מסמך מנהל משאבי אנוש. </li>
                    </ol><br><br>
                    ברכה, <br>
                    מנהל משאבי אנוש';
                $to[] = $data["sender"];
                $m = DB::table('apps_meta')->where([
                    ['app_id', '=', $request->decisionId],
                    ['meta_name', '=', 'app_users'],
                ])->first();
                if (!empty($m)) {
                    $ids = explode(',', $m->meta_value);
                    $Users = \App\User::select("email")->whereIn('id', $ids)->get();
                    foreach ($Users as $key => $User) {
                        $to[] = $User->email;
                    }
                }
                $dArr = [];
                /*$user=\App\User::getCCurrentUser();
							$logText=isset($parr[$view])?($user.' '.$parr[$view]):'';
							if(!empty($logText)){
								Log::debug('in sendDecision 5: ');
								DB::table ('apps_logs')->insert ([['app_id' => $data["p5_id"], 'description' => $logText]]);
							}*/
                $files = array($filename);
                if (file_exists($filename)) {
                    Log::debug('in sendDecistion 6:'); //tendername
                    Mail::to($to)->send(new SendMailable($body, ($files), $view, 'מכרז למשרת ' . $data['tendername'] . ' - מועצה מקומית קריית ארבע חברון'));
                    $meta_data[] = ['app_id' => $request->decisionId, 'meta_name' => 'email_msg', 'meta_value' => 'מייל נשלח בהצלחה'];
                    \App\Forms::insert_meta($meta_data);
                    $fileID = DB::table('apps_file')->insertGetId(
                        ['app_id' => $data["p5_id"], 'url' => $fail_name . ".pdf", 'type' => 'pdf', 'file_name' => 'decision' . $view . '.pdf', 'status' => 1],
                    );
                    DB::table('apps_logs')->insert([['app_id' => $request->decisionId, 'description' => $data["logText"]]]);

                    // Security log for application decision
                    $authUser = auth()->user();
                    $decisionType = str_contains($view, 'approve') ? 'APPROVED' : 'REJECTED';
                    security_log('INFO', 'APP_DECISION', [
                        'user' => $authUser, // Pass user object for better logging
                        'ip' => $request->ip(),
                        'app_id' => $request->decisionId,
                        'decision' => $decisionType,
                        'stage' => $view
                    ]);
                } else {
                    Log::debug('file: mo');
                }
                $res = ["res" => "ok"];
                Log::debug('return from sendDecision');
                return json_encode($res);
            } else {
                Log::debug('in sendDecision else');
                $res = ["res" => "nok", "error" => "error from else"];
                return json_encode($res);
            }
        } catch (\Exception $e) {
            $res = ["res" => "nok", "error" => $e->getMessage()];
            return json_encode($res);
        }
        $res = ["res" => "nok", "error" => "error after catch"];
        return json_encode($res);
    }

    public static function get_level_b_url($app)
    {
        $form = DB::table('forms')->where([
            ['id', '=', '6'],
        ])->first();
        if (empty($form))
            return '#';
        $url = url('/') . '/' . $form->url . '/level_b/' . base64_encode($app->id);
        return $url;
    }

    public function viewapplication(Request $request)
    {
        $apps_meta = Applications::get_all_meta($request->applicationid);
        $decs = DB::table('app_decisions_ext')->select()->where('id', '=', $request->applicationid)->first();
        $list = DB::table('tenders_applications')->select()->where('id', '=', $request->applicationid)->get();
        $appstep = DB::table('app_decisions')->select('stepback')->where('id', '=', $request->applicationid)->first();
        $app_dec = AppDecisions::find($request->applicationid, ['selected_interview_time', 'approved_interview_time', 'last_committee_invitation_send', '2nd_invitation_rejected', 'approved_interview_place', 'approved_committee_time', 'selected_interview_place', 'committee_selected_place']);
        if (count($list) > 0) {
            $line = $list[0];
            //var_dump($line->ccount);
            $p1 = $line->p1_id;
            $p2 = $line->p2_id;
            $p3 = $line->p3_id;
            $p5 = $line->p5_id;
            //var_dump($p5);
            $fl1 = self::get_all_fileswoforms($p1);
            $fl2 = self::get_all_fileswoforms($p2);
            $fl3 = self::get_all_fileswoforms($p3);
            $fl5 = self::get_all_fileswoforms($p5);
            $afiles = [];
            //	var_dump($fl1);
            //echo(typeof($fl1));
            //	exit();
            if ($fl1)
                foreach ($fl1 as $line) {
                    $line->source = 1;
                    array_push($afiles, $line);
                }
            if ($fl2)
                foreach ($fl2 as $line) {
                    $line->source = 2;
                    array_push($afiles, $line);
                }
            if ($fl3)
                foreach ($fl3 as $line) {
                    $line->source = 3;
                    array_push($afiles, $line);
                }
            if ($fl5)
                foreach ($fl5 as $line) {
                    $line->source = 5;
                    array_push($afiles, $line);
                }

            // Load mandatory test files
            $testFiles = DB::table('apps_file')
                ->where([
                    ['app_dec_id', '=', $request->applicationid],
                    ['type', '=', 'mandatory_test']
                ])
                ->get();

            if ($testFiles) {
                foreach ($testFiles as $testFile) {
                    $testFile->source = 'test';
                    array_push($afiles, $testFile);
                }
            }

            if (isset($p1) && !empty($p1)) {
                $decfile = DB::table('apps_file')->whereRaw("file_name like 'decision%.pdf' and  app_id=" . $p1)->get();
            } else {
                $decfile = DB::table('apps_file')->whereRaw("file_name like 'decision%.pdf' and  app_id=" . $p5)->get();
            }
            //echo($decs->status);
            $application = (object)
            [
                "id" => $request->applicationid,
                "form_id" => $request->applicationid,
                "st" => 1,
                "ff" => Forms::getFF(),
                "tenderid" => $list[0]->generated_id,
                "tname" => $list[0]->tname,
                "status" => $decs->status,
                "send_date" => $decs->crdate,
                "list" => $list,
                "decision" => $decs,
                'phone' => Applications::get_json($p5, 'personal_phone_select') . '-' . Applications::get_json($p5, 'personal_phone'),
                "p1_data" => Applications::find($p1),
                "p2_data" => Applications::find($p2),
                "p3_data" => Applications::find($p3),
                "p5_data" => Applications::find($p5),
                "p1_meta" => Applications::get_all_meta($p1),
                "p2_meta" => Applications::get_all_meta($p2),
                "p3_meta" => Applications::get_all_meta($p3),
                "p5_meta" => Applications::get_all_meta($p5),
                'files' => $afiles,
                'appusers' => Applications::user_inappp_html($request->applicationid) . ' ' . Applications::user_outapp_html($request->applicationid)
            ];
            $allforms = [
                Applications::getformfile($p1),
                Applications::getformfile($p2),
                Applications::getformfile($p3),
                Applications::getformfile($p5),
            ];
            //var_dump($allforms);
            //var_dump($decfile);
            //	exit();
            $formFileNames = [];
            $formsNA = Forms::getFF();
            //$forms0=$formsNA[0];
            //echo(json_encode($formsNA));
            //  	echo(json_encode(array_keys ($formsNA)));
            //echo(json_encode(array_keys ($formsNA[1])));
            $max = count(array_keys($formsNA));
            //echo($max);
            for ($i = 1; $i < $max; $i++) {
                //	echo($i);
                //	echo(json_encode($formsNA[$i]));
                foreach ($formsNA[$i] as $forline) {
                    //echo(json_encode($forline));
                    //$formNames[]
                    if ($forline) {
                        $name = $forline["name"];
                        $title = isset($forline["title"]) ? $forline["title"] : '';
                        $formFileNames[$name] = $title;
                    }
                    //array_push($formNames,[]);

                }
            }
            $sql = 'select count(*)  as cc_notapproved from apps_file where app_id in (' . $p1 . ',' . $p2 . ',' . $p3 . ',' . $p5 . ') and file_name<>\'form.pdf\'  and status not in (1,4)';
            //
            $ifnotapprovedfiles = DB::select($sql);
            // echo(json_encode($ifnotapprovedfiles));
            //echo(gettype($ifnotapprovedfiles));
            //echo(count($ifnotapprovedfiles));
            //echo(isset($ifnotapprovedfiles["cc_notapproved"]));
            //echo(array_key_exists('cc_notapproved',$ifnotapprovedfiles[0])?'da':'net');
            //var_dump($application);
            //echo(json_encode($formNames));
            $users = DB::table('sendcopy_userdecisions')->where(['decisionId' => $request->applicationid])->get();
            $sort = $request->sort;
            //var_dump($sort);
            $where = [];
            $wherediff = [];
            if ($sort === "all") {
                $where = [];
            }

            if ($sort === "new") {
                $where = ["app_statusnum" => "1"];
                $wherediff = [" app_statusnum=1"];
            }
            if ($sort === "accepted") {
                $where = ["app_statusnum" => "5"];
                $wherediff = [" app_status collate utf8mb4_unicode_ci ='Accepted'"];
            }
            if ($sort === "stared") {
                $where = ["is_star" => "1"];
                $wherediff = [" is_star=1"];
            }
            if ($sort === "passed") {
                $where = ["test_result" => "1"];
                $wherediff = [" test_result=1"];
            }
            if ($sort === "failed") {
                $where = ["test_result" => "0"];
                $wherediff = [" test_result=0"];
            }

            if ($sort === "test-required") {
                $where = ["is_test_required" => "1"];
                $wherediff = [" is_test_required=1"];
            }
            if ($sort === "test-not-required") {
                $where = ["is_test_required" => "0"];
                $wherediff = [" is_test_required=0"];
            }

            if ($sort === "no-result") {
                $where = ["no-result" => "is null "];
                $wherediff = [" test_result is null "];
            }



            if ($sort === "accepted_a") {
                $where = ["app_statusnum" => "13"];
                $wherediff = [" app_status collate utf8mb4_unicode_ci ='Accepted A'"];
            }
            if ($sort === "accepted_b") {
                $where = ["app_statusnum" => "14"];
                $wherediff = [" app_status collate utf8mb4_unicode_ci ='Accepted B'"];
            }

            if ($sort === "rejected0") {
                $where = ["app_statusnum" => "6"];
                $wherediff = [" app_statusnum=6"];
            }
            // if ( $sort === "canceled" ) {
            // 	$where = ["app_statusnum" => "7"];
            // 	$wherediff = [" app_statusnum=7"];

            // }
            if ($sort === "canceled") {
                $where = ["app_statusnum" => "15"];
                $wherediff = [" app_statusnum=15"];
            }
            if ($sort === "rejected") {
                $where = ["app_statusnum" => "4"];
                $wherediff = [" app_status collate utf8mb4_unicode_ci ='Rejected'"];
            }
            if ($sort === "interview") {
                $where = ["app_statusnum" => "3"];
                $wherediff = [" app_statusnum=3"];
            }

            if ($sort === "interview_b") {
                $where = ["app_statusnum" => "12"];
                $wherediff = [" app_statusnum=12"];
            }

            // if ( $sort === "stared" ) {
            // 	$where = ["is_star" => "1"];
            // 	$wherediff = [" is_star=1"];
            // }

            if ($sort === "interview_a") {
                $where = ["app_statusnum" => "11"];
                $wherediff = [" app_statusnum=11"];
            }
            if ($sort === "committee") {
                $where = ["app_statusnum" => "10"];
                $wherediff = [" app_status collate utf8mb4_unicode_ci ='Committee'"];
            }
            if ($sort === "waitingforfiles") {
                $where = ["app_statusnum" => "2"];
                $wherediff = [" app_statusnum=2"];
            }
            if ($sort === "waitingforfilesapproval") {
                //$where = ["app_statusnum" => "8"];
                $wherediff = [" app_statusnum=8"];
            }
            if ($sort === "waiting") {
                //$where = ["app_statusnum" => "8"];
                $wherediff = [" app_statusnum=9"];
            }


            $whereRaw = count($wherediff) > 0 ? implode(" and ", $wherediff) : '1=1';
            $userTenders = auth()->user()->load('tenders')->tenders->pluck('generated_id')->toArray();
            $tenderList = Tender::where('created_by', auth()->id())->get('generated_id')->pluck('generated_id')->toArray();
            $tenderUserLess = $userLessTender = Tender::whereDoesntHave('user')->get('generated_id')->pluck('generated_id')->toArray();
            $allTenders = array_unique(array_merge($userTenders, $tenderList, $tenderUserLess));
            $count = DB::table('tenders_applications')->select()->whereRaw($whereRaw)->whereIn('generated_id', $allTenders)->count();
            //echo (json_encode($decs));

            $display_list = array();
            $startList = [];
            $appStatus = [];
            $qualificationsData = [];
            $row = 0;
            foreach ($list as $line) {
                if (strpos($line->generated_id, '-') !== false) {
                    $app_id = explode('-', $line->generated_id);
                    $app_dec = AppDecisions::find($line->id);
                    $appStatus[$line->id] = DB::table('app_decisions_ext')->select(['id', 'status'])->where('id', $line->id)->first('status');
                    $startList[] = $app_dec->is_star;
                    array_push($display_list, ['generated_id' => $line->generated_id, 'display_generated_id' => \App\Applications::get_meta_value($app_id[1], 'tender_num_display')]);
                }
                $line->phone = Applications::get_json($line->p5_id, 'personal_phone_select') . '-' . Applications::get_json($line->p5_id, 'personal_phone');

                // Parse qualifications data from tender
                $tender = DB::table('tenders')->where('generated_id', $line->tenderval)->first();
                if ($tender && $tender->qualifications) {
                    $qualificationsData[$line->id] = $this->parseQualifications($tender->qualifications, $tender->conditions, $line->id);
                } else {
                    $qualificationsData[$line->id] = $this->getEmptyQualifications();
                }

                $row++;
            }
			
			   // Retrieve yes/no questions data (שאלות כן ולא)
            $yesNoQuestions = [];
            if (isset($apps_meta['yes_no_questions'])) {
                $yesNoQuestions = unserialize($apps_meta['yes_no_questions']);
            }

            return view('view-application', [
                'p5' => $p5,
                'list' => $list,
                'count' => $count,
                'qualificationsData' => $qualificationsData,
                'startList' => $startList,
                'appstep' => $appstep,
                'application' => $application,
                'tender' => Tender::where('generated_id', $application->tenderid)->first(),
                'decision' => $decs,
                'department' => 1,
                'statuses' => self::getStatuses(),
                'ifnotapprovedfiles' => isset($ifnotapprovedfiles[0]) && count($ifnotapprovedfiles) > 0 && property_exists($ifnotapprovedfiles[0], 'cc_notapproved') ? $ifnotapprovedfiles[0]->cc_notapproved : 'nono',
                'app_dec' => $app_dec,
                "decfile" => $decfile,
                "allforms" => $allforms,
                'formFileNames' => $formFileNames,
                'users' => $users,
                'pageTitle' => '',
                'email_msg' => isset($apps_meta['email_msg']) ? $apps_meta['email_msg'] : '',
                'email_msg_interview' => isset($apps_meta['email_msg_interview']) ? $apps_meta['email_msg_interview'] : '',
                'interview_email' => isset($apps_meta['interview_email']) ? $apps_meta['interview_email'] : '',
                'email_msg_test' => isset($apps_meta['email_msg_test']) ? $apps_meta['email_msg_test'] : '',
                'test_email' => isset($apps_meta['test_email']) ? $apps_meta['test_email'] : '',
                'email_msg_committee' => isset($apps_meta['email_msg_committee']) ? $apps_meta['email_msg_committee'] : '',
                'email_msg_committee_approve' => isset($apps_meta['email_msg_committee_approve']) ?$apps_meta['email_msg_committee_approve'] : '',
                'committee_email' => isset($apps_meta['committee_email']) ? $apps_meta['committee_email'] : '',
                'email_msg_gotit' => isset($apps_meta['email_msg_gotit']) ? $apps_meta['email_msg_gotit'] : '',
                'gotit_email' => isset($apps_meta['gotit_email']) ? $apps_meta['gotit_email'] : ''
            ]);
        } else {
            return "error";
        }
    }

    public function stepBackDecision(Request $request)
    {
        $appId = $request->app_id;
        $updateData = [];
        $updateData['stepback'] = 1;

        if ($request->app_status == 'New') {
            $updateData['decision_1'] = 0;
            $updateData['decision_1_a'] = 0;
            $updateData['decision_1_b'] = 0;
            $updateData['decision_2'] = 0;
            $updateData['decision_3'] = 0;
            $updateData['decision_3_a'] = 0;
            $updateData['decision_3_b'] = 0;
            $updateData['decision_4'] = 0;
            $updateData['decision_5'] = 0;
            $updateData['decision_committee'] = 0;
        }
        if ($request->app_status == 'Waiting') {
            $updateData['decision_1'] = 0;
            $updateData['decision_1_a'] = 0;
            $updateData['decision_1_b'] = 0;
            $updateData['decision_2'] = 0;
        }
        if ($request->app_status == 'Interview') {
            $updateData['decision_1'] = 0;
            $updateData['decision_1_a'] = 0;
            $updateData['decision_1_b'] = 0;
            $updateData['decision_2'] = 0;
            $updateData['decision_3'] = 0;
            $updateData['decision_3_a'] = 0;
            $updateData['decision_3_b'] = 0;
            $updateData['decision_4'] = 0;
            $updateData['decision_committee'] = 0;
            if (DB::table('apps_file')->whereRaw("file_name in ('decisionapprove0a.pdf') and app_id=" . $appId)->exists()) {
                DB::table('apps_file')->whereRaw("file_name in ('decisionapprove0a.pdf') and app_id=" . $appId)->delete();
            }
        }
        if ($request->app_status == 'Interview A') {
            $updateData['decision_1_a'] = 0;
            $updateData['decision_1_b'] = 0;
            $updateData['decision_2'] = 0;
            $updateData['decision_3'] = 0;
            $updateData['decision_3_a'] = 0;
            $updateData['decision_3_b'] = 0;
            $updateData['decision_4'] = 0;
            $updateData['decision_committee'] = 0;
            if (DB::table('apps_file')->whereRaw("file_name in ('decisionapprove0.pdf') and app_id=" . $appId)->exists()) {
                DB::table('apps_file')->whereRaw("file_name in ('decisionapprove0.pdf') and app_id=" . $appId)->delete();
            }
        }
        if ($request->app_status == 'Interview B') {
            $updateData['decision_1_a'] = 0;
            $updateData['decision_1_b'] = 0;
            $updateData['decision_2'] = 0;
            $updateData['decision_3'] = 0;
            $updateData['decision_3_a'] = 0;
            $updateData['decision_3_b'] = 0;
            $updateData['decision_4'] = 0;
            $updateData['decision_committee'] = 0;
            if (DB::table('apps_file')->whereRaw("file_name in ('decisionapprove0b.pdf') and app_id=" . $appId)->exists()) {
                DB::table('apps_file')->whereRaw("file_name in ('decisionapprove0b.pdf') and app_id=" . $appId)->delete();
            }
        }
        if ($request->app_status == 'Committee') {
            $updateData['decision_3'] = 0;
            $updateData['decision_3_a'] = 0;
            $updateData['decision_3_b'] = 0;
            $updateData['decision_4'] = 0;
            $updateData['decision_committee'] = 0;
        }
        if ($request->app_status == 'Rejected due to conditions') {
            $updateData['decision_2'] = 0;
            if (DB::table('apps_file')->whereRaw("file_name in ('decisionreject1.pdf', 'decisionreject0a.pdf', 'decisionreject0c.pdf', 'decisionreject0d.pdf') and app_id=" . $appId)->exists()) {
                DB::table('apps_file')->whereRaw("file_name in ('decisionreject1.pdf', 'decisionreject0a.pdf', 'decisionreject0c.pdf', 'decisionreject0d.pdf') and app_id=" . $appId)->delete();
            }
        }
        if ($request->app_status == 'Accepted') {
            $updateData['decision_3'] = 0;
            if (DB::table('apps_file')->whereRaw("file_name in ('decisionapprove3.pdf', 'decisionapprove4.pdf', 'decisionapprove5.pdf') and app_id=" . $appId)->exists()) {
                DB::table('apps_file')->whereRaw("file_name in ('decisionapprove3.pdf', 'decisionapprove4.pdf', 'decisionapprove5.pdf') and app_id=" . $appId)->delete();
            }
        }
        if ($request->app_status == 'Accepted A') {
            $updateData['decision_3_a'] = 0;
            if (DB::table('apps_file')->whereRaw("file_name in ('decisionapprove1.pdf') and app_id=" . $appId)->exists()) {
                DB::table('apps_file')->whereRaw("file_name in ('decisionapprove1.pdf') and app_id=" . $appId)->delete();
            }
        }
        if ($request->app_status == 'Accepted B') {
            $updateData['decision_3_b'] = 0;
            if (DB::table('apps_file')->whereRaw("file_name in ('decisionapprove2.pdf') and app_id=" . $appId)->exists()) {
                DB::table('apps_file')->whereRaw("file_name in ('decisionapprove2.pdf') and app_id=" . $appId)->delete();
            }
        }
        if ($request->app_status == 'Rejected') {
            $updateData['decision_4'] = 0;
            if (DB::table('apps_file')->whereRaw("file_name in ('decisionreject2.pdf', 'reject0a.pdf') and app_id=" . $appId)->exists()) {
                DB::table('apps_file')->whereRaw("file_name in ('decisionreject2.pdf', 'reject0a.pdf') and app_id=" . $appId)->delete();
            }
        }
        if ($request->app_status == 'Rejected0') {
            $updateData['decision_4'] = 0;
            $updateData['decision_2'] = 0;
            $updateData['rejected'] = 0;
            if (DB::table('apps_file')->whereRaw("file_name in ('decisionreject0.pdf') and app_id=" . $appId)->exists()) {
                DB::table('apps_file')->whereRaw("file_name in ('decisionreject0.pdf') and app_id=" . $appId)->delete();
            }
        }
        if ($request->app_status == 'FinalReject') {
            $updateData['decision_4'] = 0;
            $updateData['rejected_status'] = NULL;
            if (DB::table('apps_file')->whereRaw("file_name in ('decisionreject0_fr.pdf') and app_id=" . $appId)->exists()) {
                DB::table('apps_file')->whereRaw("file_name in ('decisionreject0_fr.pdf') and app_id=" . $appId)->delete();
            }
        }
        if ($request->app_status == 'FailedToJoinCommittee') {
            $updateData['decision_4'] = 0;
            $updateData['rejected_status'] = NULL;
            if (DB::table('apps_file')->whereRaw("file_name in ('decisionreject0_fd.pdf') and app_id=" . $appId)->exists()) {
                DB::table('apps_file')->whereRaw("file_name in ('decisionreject0_fd.pdf') and app_id=" . $appId)->delete();
            }
        }

        DB::table('app_decisions')->where('id', $appId)->update($updateData);

        return redirect()->back();
    }

    public function stepBackSecond(Request $request)
    {
        $appId = $request->app_id;
        if (DB::table('apps_file')->whereRaw("file_name in ('decisionapprove1.pdf', 'decisionapprove2.pdf', 'decisionapprove3.pdf', 'decisionapprove4.pdf', 'decisionapprove5.pdf', 'decisionreject1.pdf', 'decisionreject2.pdf', 'decisionreject0d.pdf', 'decisionreject0_fd.pdf', 'decisionreject0_fr.pdf', 'decisionreject0a.pdf') and app_id=" . $appId)->exists()) {
            DB::table('apps_file')->whereRaw("file_name in ('decisionapprove1.pdf', 'decisionapprove2.pdf', 'decisionapprove3.pdf', 'decisionapprove4.pdf', 'decisionapprove5.pdf', 'decisionreject1.pdf', 'decisionreject2.pdf', 'decisionreject0d.pdf', 'decisionreject0_fd.pdf', 'decisionreject0_fr.pdf', 'decisionreject0a.pdf') and app_id=" . $appId)->delete();
        }

        $updateData = [
            'decision_2' => 0,
            'decision_3' => 0,
            'decision_3_b' => 0,
            'decision_3_a' => 0,
            'decision_4' => 0,
            'decision_5' => 0,
            'decision_rejectedbyuser' => 0
        ];
        if ($request->app_status == 'Committee') {
            $updateData['p5_id'] = $appId;
        }

        DB::table('app_decisions')->where('id', $appId)->update($updateData);

        return redirect()->back();
    }

    public function changeTestResult(Request $request, $applicationid)
    {
        try {
            $application = AppDecisions::find($applicationid);

            $application->test_result = $request->status;
            $application->save();

            return response([
                'success' => true,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function gradeSave(Request $request, $applicationid)
    {
        try {
            $application = AppDecisions::find($applicationid);

            $application->grade = $request->grade;
            if (empty($request->grade)) {
                $application->test_result = null;
            }
            $application->save();

            return response([
                'success' => true,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function get_all_fileswoforms($app_id)
    {
        if ($app_id) {
            $sql = DB::table('apps_file')
                ->where(column: [
                    ['app_id', '=', $app_id],
                ])->whereRaw(" not ((file_name='form.pdf' or file_name like 'decision%.pdf' ) and type='pdf')")->toSql();
            //   echo($app_id);
            //var_dump($sql);
            // exit();
            $files = DB::table('apps_file')
                ->where([
                    ['app_id', '=', $app_id],
                ])->whereRaw(" not ((file_name='form.pdf' or file_name like 'decision%.pdf' )and type='pdf')")->get();
            return $files;
        }
        return false;
    }

    public function export()
    {
        return Excel::download(new FormsExport, 'export.xlsx');
    }

    public function downloadZip($did)
    {
        $decs = DB::table('app_decisions')->select()->where('id', '=', $did)->first();

        $files = DB::table('apps_file')
            ->where([
                ['app_id', '=', $decs->p5_id],
            ])->get();
        Log::debug(count($files));
        $filespath = public_path('upload');
        $marge_file = Str::replace(' ', '_', $decs->applicant_name) . "@{$did}_all_files.pdf";
        $pdf = new PdfMerge();
        foreach ($files as $key => $file) {
            if (file_exists($filespath . '/' . $file->url)) {
                if (strpos($file->url, 'docx') || strpos($file->url, 'doc') !== false) {
                    //header ("Content-type: application/vnd.ms-word");
                    //header ("Content-Disposition: attachment;Filename=document_name.doc");
                } else {
                    $pdf->add($filespath . '/' . $file->url);
                }
            }
            if (file_exists($filespath . '/admin/' . $file->url)) {
                Log::debug('admin:' . $file->url);
                if (strpos($file->url, 'docx') || strpos($file->url, 'doc') !== false) {
                    //header ("Content-type: application/vnd.ms-word");
                    //header ("Content-Disposition: attachment;Filename=document_name.doc");
                } else {
                    $pdf->add($filespath . '/admin/' . $file->url);
                }
            }
        }
        $pdf->merge(storage_path('app/public') . '/' . $marge_file);
        return response()->download(storage_path('app/public') . '/' . $marge_file)->deleteFileAfterSend(true);
    }
    function customMailFileSend(Request $request, $did)
    {
        $decs = DB::table('app_decisions')->select()->where('id', '=', $did)->first();

        $files = DB::table('apps_file')
            ->where([
                ['app_id', '=', $decs->p5_id],
            ])->get();
        Log::debug(count($files));
        $filespath = public_path('upload');
        $marge_file = Str::replace(' ', '_', $decs->applicant_name) . "@{$did}_all_files.pdf";
        $pdf = new PdfMerge();
        foreach ($files as $key => $file) {
            if (file_exists($filespath . '/' . $file->url)) {
                if (strpos($file->url, 'docx') || strpos($file->url, 'doc') !== false) {
                    //header ("Content-type: application/vnd.ms-word");
                    //header ("Content-Disposition: attachment;Filename=document_name.doc");
                } else {
                    $pdf->add($filespath . '/' . $file->url);
                }
            }
            if (file_exists($filespath . '/admin/' . $file->url)) {
                Log::debug('admin:' . $file->url);
                if (strpos($file->url, 'docx') || strpos($file->url, 'doc') !== false) {
                    //header ("Content-type: application/vnd.ms-word");
                    //header ("Content-Disposition: attachment;Filename=document_name.doc");
                } else {
                    $pdf->add($filespath . '/admin/' . $file->url);
                }
            }
        }
        $pdf->merge(storage_path('app/public') . '/' . $marge_file);
        // return response()->download(storage_path('app/public') . '/' . $marge_file)->deleteFileAfterSend(true);

        Mail::to($request->email)->send((new CustomMail($decs->applicant_name, $did, $decs->tenderval, storage_path('app/public') . '/' . $marge_file)));

        try {
            File::delete(storage_path('app/public') . '/' . $marge_file);
            return "success";
        } catch (\Throwable $th) {
            //throw $th;
            return "error";
        }
    }

    public function reqAdd_file(Request $request)
    {
        $dec = $request->decisionId;
        $msg = $request->msg;
        //echo($dec);
        $app = DB::table('app_decisions')->where('id', '=', $dec)->first();
        $appid_1 = $app->p5_id;
        $res = self::cancel_file2($appid_1, 'newfile', $msg);

        //echo(json_encode($app));
        //	echo("SUPER!");
        echo (json_encode(['res' => 'OK']));
    }

    public function cancel_file2($appid, $fileID, $msg)
    {

        $user = auth()->user();
        //$decs=DB::table('app_decisions')->whereRaw(`p1_id=${$appid} or p2_id=${$appid} or p3_id=${appid}`)->first();

        if ($fileID == 'newfile') {
            $fileID = DB::table('apps_file')->insertGetId(
                ['app_id' => $appid, 'url' => 'empty.txt', 'type' => 'newfile', 'file_name' => ' ^^מסמך אחר', 'status' => 4],
            );
        } else {
        }

        DB::table('apps_file')
            ->where('id', $fileID)
            ->update(['status' => 2, 'canceled_at' => now()]);

        $file = DB::table('apps_file')->where('id', '=', $fileID)->first();
        if (empty($file))
            return 'error' . $fileID;

        // Security log for file rejection
        $authUser = auth()->user();
        security_log('INFO', 'FILE_REJECTED', [
            'user' => $authUser, // Pass user object for better logging
            'ip' => request()->ip(),
            'app_id' => $appid,
            'file_id' => $fileID,
            'file' => $file->url ?? 'unknown',
            'reason' => substr($msg, 0, 100) // Truncate reason to 100 chars
        ]);

        $app = DB::table('applications')->where('id', '=', $file->app_id)->first();


        if ($app->id === $appid) {
            $app_decision = DB::table('app_decisions')->where('p5_id', '=', $appid)->first();
            $appid = $app_decision->id;
        }

        if ($file->type != 'pdf') {
            $file_arr = explode('^^', $file->file_name);
            if (isset($file_arr[1])) {
                $file_name = $file_arr[1];
            } else {
                $file_name = $file->file_name;
            }
        } else {
            $file_name = $file->file_name;
        }
        $formsTable = Forms::getFFF();
        $body = '<div style="color:#111;margin-bottom: 15px;">' . $msg;
        if ($file->type != 'pdf') {
            $body .= '<p style="margin: 5px 0;">למייל זה מצורף קישור להעלאת מסמך  ' . (isset($formsTable[$file_name]) ? $formsTable[$file_name] : $file_name) . ' שנמצא לא תקין בבדיקתינו, נא לחצו על הקישור שמופיע מטה והעלו את המסמך התקין.';
            $body .= '<a href="' . url('/replacefile/' . base64_encode($fileID)) . '/">להחליף<a></p>';

            $description = 'מסמך לצירוף ' . $file_name . ' נדחה ';
            if (!empty($msg)) {
                $description .= '<br>סיבת הדחייה:' . $msg;
            }
            DB::table('apps_logs')->insert([
                ['app_id' => $appid, 'description' => $description],
            ]);
            //	var_dump($body);
        } else {
            $description = 'טופס הבקשה נדחה';
            if (!empty($msg)) {
                $description .= '<br>סיבת הדחייה:' . $msg;
            }
            DB::table('apps_logs')->insert([
                ['app_id' => $appid, 'description' => $description],
            ]);
            DB::table('app_decisions')->where('id', '=', $appid)->update(['decision_5' => 1]);
        }
        $body .= '</div>';
        $metamail = self::get_meta_value($file->app_id, 'metamail');
        if (empty($metamail)) {
            DB::table('apps_meta')->insert([
                ['app_id' => $file->app_id, 'meta_name' => 'metamail', 'meta_value' => $body],
            ]);
        } else {
            $body = $metamail . $body;
            DB::table('apps_meta')
                ->where([
                    ['app_id', '=', $file->app_id],
                    ['meta_name', '=', 'metamail'],
                ])
                ->update(['meta_value' => $body]);
        }
        self::send_all_mails($file->app_id);
        //if($file->type != 'erur'){
        //	self::app_status_edit_ajaxfile($request->appid);
        //	}
        return json_encode(["res" => 'success']);
        //	}
    }

    public function get_meta_value($app_id, $meta_name)
    {
        $meta_value = DB::table('apps_meta')
            ->where([
                ['app_id', '=', $app_id],
                ['meta_name', '=', $meta_name],
            ])->first();
        return $meta_value ? $meta_value->meta_value : '';
    }

    public static function send_all_mails($id)
    {
        //$id = $request->appid;
        //$app = DB::table ('applications')->where ('id', '=', $id)->first ();
        $app = DB::table('tenders_applications')->where('p5_id', '=', $id)->first();
        if (empty($app))
            return 'error';
        $metamail = Applications::get_meta_value($id, 'metamail');
        if (empty($metamail)) {
            return "אין מידע שניתן לשלוח בדואר";
        } else {
            $to = $app->email;
            Applications::sendmail($to, $metamail, 'app', '', '', $app->tname);
            DB::table('apps_meta')
                ->where([
                    ['app_id', '=', $id],
                    ['meta_name', '=', 'metamail'],
                ])->delete();
            return "לענות על שליחת הצלחה";
        }
    }

    public function sendCommitteeEmail(Request $request)
    {
        try {
            $app_ids = $request->input('app_ids', []);

            if (empty($app_ids)) {
                return response()->json(['success' => false, 'message' => 'לא נבחרו פניות']);
            }

            // Get meeting configuration
            $meetingDate = $request->input('meeting_date');
            $meetingTime = $request->input('meeting_time');
            $meetingLocation = $request->input('meeting_location');

            // Meeting duration and break settings
            $meetingDuration = (int)$request->input('meeting_minutes_value', 10); // Default 10 minutes
            $breakAfterMeetings = (int)$request->input('pluse_meeting_value', 2); // Default after 2 meetings
            $breakDuration = (int)$request->input('pluse_meeting_minutes_value', 5); // Default 5 minutes break

            // Calculate meeting times for each user
            $meetingTimes = $this->calculateMeetingTimes($app_ids, $meetingTime, $meetingDuration, $breakAfterMeetings, $breakDuration);

            $successCount = 0;
            $errorCount = 0;

            foreach ($app_ids as $index => $decision_id) {
                // Get the calculated time slot for this user
                $timeSlot = $meetingTimes[$index];

                // Call the dedicated committee email function
                // Note: $decision_id is actually the decision ID from app_decisions table
                $res = $this->sendCommitteeEmailToUser($decision_id, $meetingDate, $timeSlot, $meetingLocation);

                if ($res == 'error') {
                    $errorCount++;
                } else {
                    $successCount++;
                }
            }

            if ($successCount > 0) {
                return response()->json([
                    'success' => true,
                    'message' => "נשלחו {$successCount} מיילים בהצלחה עם זמני פגישה אישיים" . ($errorCount > 0 ? " ו-{$errorCount} נכשלו" : "")
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'כל המיילים נכשלו']);
            }
        } catch (\Exception $e) {
            \Log::error('Committee email error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'שגיאה בשליחת המיילים: ' . $e->getMessage()]);
        }
    }

    /**
     * Calculate meeting times for each user with breaks
     *
     * @param array $app_ids List of application IDs
     * @param string $startTime Starting time (e.g., "10:00")
     * @param int $meetingDuration Duration of each meeting in minutes
     * @param int $breakAfterMeetings Number of meetings before a break
     * @param int $breakDuration Duration of break in minutes
     * @return array Array of time slots for each user
     */
    private function calculateMeetingTimes($app_ids, $startTime, $meetingDuration, $breakAfterMeetings, $breakDuration)
    {
        $meetingTimes = [];
        $currentTime = \DateTime::createFromFormat('H:i', $startTime);

        foreach ($app_ids as $index => $app_id) {
            // Calculate start and end time for this meeting
            $startTimeFormatted = $currentTime->format('H:i');
            $endTime = clone $currentTime;
            $endTime->add(new \DateInterval('PT' . $meetingDuration . 'M'));
            $endTimeFormatted = $endTime->format('H:i');

            // Store the time slot for this user
            $meetingTimes[$index] = [
                'start_time' => $startTimeFormatted,
                'end_time' => $endTimeFormatted,
                'app_id' => $app_id
            ];

            // Move to next meeting time
            $currentTime = $endTime;

            // Check if we need to add a break after this meeting
            $meetingNumber = $index + 1;
            if ($meetingNumber % $breakAfterMeetings == 0 && $meetingNumber < count($app_ids)) {
                // Add break time
                $currentTime->add(new \DateInterval('PT' . $breakDuration . 'M'));
            }
        }

        return $meetingTimes;
    }

    /**
     * Send committee email to a specific user with proper data structure
     *
     * @param int $decision_id Decision ID from app_decisions table
     * @param string $meetingDate Meeting date
     * @param array $timeSlot Time slot information
     * @param string $meetingLocation Meeting location
     * @return string Success or error status
     */
    private function sendCommitteeEmailToUser($decision_id, $meetingDate, $timeSlot, $meetingLocation)
    {
        try {
            // Get application decision record - the $decision_id is actually the decision ID
            $decision = DB::table('app_decisions')->where('id', $decision_id)->first();
            if (!$decision) {
                \Log::error("No decision found for decision_id: {$decision_id}");
                return 'error';
            }

            // Get application record using p5_id from decision
            $application = DB::table('applications')->where('id', $decision->p5_id)->first();
            if (!$application) {
                \Log::error("No application found for p5_id: {$decision->p5_id}");
                return 'error';
            }

            // Get tender information
            $tender = DB::table('tenders')->where('generated_id', $decision->tenderval)->first();
            if (!$tender) {
                \Log::error("No tender found for tenderval: {$decision->tenderval}");
                return 'error';
            }

            // Create properly formatted request object for committee emails
            $mockRequest = new \stdClass();

            // Required properties for Applications::email_to_user()
            $mockRequest->id = $decision->id; // Decision ID from app_decisions table
            $mockRequest->appid = $decision->p5_id; // Application ID from applications table
            $mockRequest->type = 'committee'; // Email type

            // Committee-specific properties - MUST match Applications::email_to_user() expectations
            // The function expects: Carbon::createFromFormat('d m, Y H:i', $request->committee_date.' '.$request->committee_time)
            // So committee_date must be in "d m, Y" format (e.g., "25 12, 2024")
            try {
                if (strpos($meetingDate, '-') !== false) {
                    // Convert Y-m-d to "d m, Y" format
                    $carbonDate = \Carbon\Carbon::createFromFormat('Y-m-d', $meetingDate);
                    $mockRequest->committee_date = $carbonDate->format('d m, Y');
                } else {
                    // Try to parse other formats and convert to "d m, Y"
                    $carbonDate = \Carbon\Carbon::parse($meetingDate);
                    $mockRequest->committee_date = $carbonDate->format('d m, Y');
                }
            } catch (\Exception $dateError) {
                // Fallback to current date in correct format
                $mockRequest->committee_date = \Carbon\Carbon::now()->format('d m, Y');
                \Log::warning("Date parsing failed for {$meetingDate}, using current date");
            }

            $mockRequest->committee_time = $timeSlot['start_time'];
            $mockRequest->committee_place = $meetingLocation;
            $mockRequest->committee_msg = "זימון לוועדה - זמן פגישה: {$timeSlot['start_time']} עד {$timeSlot['end_time']}";

            // Call the email function
            $res = \App\Applications::email_to_user($mockRequest);

            if ($res == 'error') {
                $meta_data = [['app_id' => $decision->id, 'meta_name' => 'email_msg', 'meta_value' => 'אירעה שגיאה בשליחת מייל']];
                \App\Forms::insert_meta($meta_data);
                \Log::error("Failed to send committee email for decision ID: {$decision->id}");
                return 'error';
            }

            // SUCCESS: Apply the same database updates as individual email sending
            // This makes bulk action identical to individual action
            try {
                $dateString = $mockRequest->committee_date . ' ' . $mockRequest->committee_time;
                \Log::info("Parsing committee datetime: {$dateString}");

                // Try with expected format first
                $committeeDateTime = \Carbon\Carbon::createFromFormat('d m, Y H:i', $dateString);
            } catch (\Exception $e) {
                \Log::warning("Failed to parse datetime from '{$dateString}': {$e->getMessage()}");

                // Try more flexible parse as fallback
                try {
                    $committeeDateTime = \Carbon\Carbon::parse($dateString);
                } catch (\Exception $innerE) {
                    \Log::error("Carbon parse fallback also failed for '{$dateString}': {$innerE->getMessage()}");
                    $committeeDateTime = now(); // final fallback
                }
            }

            // 1. Update app_decisions table with committee details (same as individual action)
            \App\Models\AppDecisions::find($decision->id)->update([
                'approved_committee_time' => $committeeDateTime,
                'last_committee_invitation_send' => now(),
                'committee_selected_place' => $mockRequest->committee_place,
                'decision_committee' => 1  // Set status same as individual action
            ]);

            // 2. Insert meta data (same as individual action)
            $meta_data = [
                ['app_id' => $decision->id, 'meta_name' => 'email_msg_committee', 'meta_value' => 'מייל זימון לועדת בחינה נשלח בהצלחה'],
                ['app_id' => $decision->id, 'meta_name' => 'committee_date', 'meta_value' => $mockRequest->committee_date]
            ];
            \App\Forms::insert_meta($meta_data);

            // 3. Add log entry (same as individual action)
            $user = \App\User::getCCurrentUser();
            DB::table('apps_logs')->insert([
                ['app_id' => $decision->id, 'description' => 'נשלח למועמד זימון לועדת בחינה על ידי ' . $user . ' (זמן: ' . $timeSlot['start_time'] . '-' . $timeSlot['end_time'] . ')']
            ]);

            \Log::info("Committee email sent successfully for decision ID: {$decision->id}, time slot: {$timeSlot['start_time']}-{$timeSlot['end_time']}");
            return 'success';
        } catch (\Exception $e) {
            \Log::error('Committee email error for decision_id ' . $decision_id . ': ' . $e->getMessage());
            return 'error';
        }
    }

    public function cancel_file(Request $request)
    {
        if ($request->fileID && $request->appid) {

            $fileID = $request->fileID;
            $appid = $request->appid;
            $msg = $request->msg;
            return self::cancel_file2($appid, $fileID, $msg);
        } else {
            return json_encode(["error" => 'error 2']);

            //
        }
    }

    public function approveFile(Request $request)
    {
        $files = [];

        if ($request->fileID == 0 && $request->appid > 0) {
            $app_decision = DB::table('app_decisions')->where('id', '=', $request->appid)->first();
            $appid = $app_decision->p5_id;
            $files = DB::table('apps_file')->where('app_id', '=', $appid)->get();
        } elseif ($request->fileID != 0 && $request->appid > 0) {
            $files = DB::table('apps_file')->where('id', '=', $request->fileID)->get();
            //array_push($files,$request->fileID);
        }
        if ($request->fileID > -1 && $request->appid) {
            foreach ($files as $file) {
                $user = \App\User::getCCurrentUser();
                DB::table('apps_file')
                    ->where('id', $file->id)
                    ->update(['status' => 1]);
                //$file = DB::table ('apps_file')->where ('id', '=', $request->fileID)->first ();
                if ($file->type == 'pdf') {
                    DB::table('apps_logs')->insert([
                        ['app_id' => $request->appid, 'description' => 'טופס הבקשה אושר על ידי ' . $user]
                    ]);
                } else {
                    $file_arr = explode('^^', $file->file_name);
                    if (isset($file_arr[1])) {
                        $file_name = $file_arr[1];
                    } else {
                        $file_name = $file->file_name;
                    }
                    $description = 'מסמך לצירוף ' . $file_name . ' אושר על ידי ' . $user;
                    DB::table('apps_logs')->insert([
                        ['app_id' => $request->appid, 'description' => $description]
                    ]);

                    //select count(*) as cc from apps_file where status=2 and app_id in (365,355,367)
                }

                // Security log for file approval
                $authUser = auth()->user();
                security_log('INFO', 'FILE_APPROVED', [
                    'user' => $authUser, // Pass user object for better logging
                    'ip' => $request->ip(),
                    'app_id' => $request->appid,
                    'file_id' => $file->id,
                    'file' => $file->url ?? 'unknown'
                ]);
            }
            //	if($file->type != 'erur'){
            //		self::app_status_edit_ajaxfile($request->appid);
            //	}
            $dcs = DB::table('app_decisions')->where('id', '=', $request->appid)->first();
            //DB::enableQueryLog();
            //$sq=DB::table('apps_file')->whereRaw(`status=2 and app_id in (?,?,?)`,[$dcs->p1_id,$dcs->p2_id,$dcs->p3_id])->toSql();
            //echo($sq);
            //echo(json_encode([$dcs->p1_id,$dcs->p2_id,$dcs->p3_id]));
            $cnt = DB::table('apps_file')->whereRaw('status=2 and app_id in (?,?,?)', [$dcs->p1_id, $dcs->p2_id, $dcs->p3_id])->count();
            if ($cnt === 0) DB::table('app_decisions')->where('id', '=', $request->appid)->update(['decision_5' => 0]);
            //echo($cnt);

            //$cnt=DB::table('apps_file')->whereRaw(`(status=2 and app_id in ({$dcs->p1_id},{$dcs->p2_id},{$dcs->p3_id}))`)->count();
            //var_dump($cnt);
            return json_encode(["res" => 'success']);
        } else {
            return json_encode(["error" => 'error']);
        }
    }



    /**
     * Log file access via AJAX (for tracking file views/downloads).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logFileAccess(Request $request)
    {
        $authUser = auth()->user();
        $fileName = $request->input('file', 'unknown');
        $appId = $request->input('app_id', 'unknown');
        $action = $request->input('action', 'view');

        security_log('INFO', 'DOWNLOAD_FILE', [
            'user' => $authUser, // Pass user object for better logging (handles null automatically)
            'ip' => $request->ip(),
            'file' => $fileName,
            'app_id' => $appId,
            'action' => $action
        ]);

        return response()->json(['status' => 'logged']);
    }

    /**
     * Secure file download with logging.
     * Serves files from upload directory and logs the download.
     *
     * @param Request $request
     * @param string $path The file path (can be encoded or plain)
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\Response
     */
    public function secureFileDownload(Request $request, $path)
    {
        // Decode path if it's base64 encoded
        $decodedPath = base64_decode($path, true);
        $filePath = $decodedPath !== false ? $decodedPath : $path;

        // Security: Prevent directory traversal
        $filePath = str_replace(['../', '..\\', '..'], '', $filePath);

        // Determine full path (check both upload and upload/admin directories)
        $fullPath = null;
        if (file_exists(public_path('upload/' . $filePath))) {
            $fullPath = public_path('upload/' . $filePath);
        } elseif (file_exists(public_path('upload/admin/' . $filePath))) {
            $fullPath = public_path('upload/admin/' . $filePath);
        } elseif (file_exists(public_path($filePath))) {
            $fullPath = public_path($filePath);
        }

        if (!$fullPath || !file_exists($fullPath)) {
            abort(404, 'File not found');
        }

        // Get file info
        $fileName = basename($fullPath);
        $authUser = auth()->user();

        // Security log for file download
        security_log('INFO', 'DOWNLOAD_FILE', [
            'user' => $authUser, // Pass user object for better logging (handles null automatically)
            'ip' => $request->ip(),
            'file' => $fileName,
            'path' => $filePath
        ]);

        // Return file for download or inline view
        $mimeType = mime_content_type($fullPath);
        $isPdf = str_ends_with(strtolower($fileName), '.pdf');

        if ($isPdf || $request->has('inline')) {
            return response()->file($fullPath, [
                'Content-Type' => $mimeType,
            ]);
        }

        return response()->download($fullPath, $fileName, [
            'Content-Type' => $mimeType,
        ]);
    }

    public function uploadFile(Request $request, $tenderId = null)
    {
        $files = [];
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $key => $value) {
                $tenderFile = new TenderFiles;
                $tenderFile->tender_id = $tenderId;
                $tenderFile->url = 'upload/' . $value->getClientOriginalName();
                $tenderFile->file_name = $value->getClientOriginalName();
                $tenderFile->file_type = $value->getMimeType();
                $tenderFile->status = 1;
                $tenderFile->save();
                $value->move(public_path('upload'), $value->getClientOriginalName());
            }
            return json_encode(["res" => 'success']);
        } else {
            return json_encode(["error" => 'error']);
        }
    }

    public function delete_tender_file(Request $request, $fileID)
    {
        try {
            $tenderFile = TenderFiles::find($fileID);
            File::delete(public_path($tenderFile->url));
            $tenderFile->delete();
            // json_encode(["res" => 'success']);



        } catch (\Throwable $th) {
            //throw $th;
            // return json_encode(["error" => 'error']);
        }
        return back();
    }

    function tenderExcelDownload(Request $request)
    {
        $user = \App\User::getCCurrentUser();
        // echo ("!!!".$user);
        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone('Asia/Jerusalem'));
        $fdate = $date->format('Y-m-d H:i:s');
        //\Carbon\Carbon::now()
        $filter = 'all';
        if ($request->filter)
            $filter = $request->filter;

        $active = DB::table('tenders')->where([
            ['finish_date', '>', $fdate],
            ['deleted', '=', 0],
            ['stopped', '=', 0],
        ])->get();

        $inactive = DB::table('tenders')->where([
            ['finish_date', '<', $fdate],
            ['deleted', '=', 0],
            ['stopped', '=', 0],
        ])->get();
        $pagesize = $request->page_size && $request->page_size > 0 ? $request->page_size : 15;
        $pagenum = 0;
        if ($request->page_num && $request->page_num > 0)
            $pagenum = $request->page_num;
        //echo($filter);
        //exit();
        $where = [];
        $wherediff = [];
        $whereline = "";
        switch ($filter) {
            case "all":
                $whereline = "";
                break;
            case "active":
                $whereline = "`finish_date` > now() and `deleted` = 0 and `stopped` = 0";
                break;
            case "inactive":
                $whereline = "`finish_date` < now() and `deleted` = 0 and `stopped` = 0";
                break;
            case "stopped":
                $where = ["stopped" => 1];
                $whereline = "stopped=1 ";
                break;
            case "tender_type":
                $whereline = "tender_type = " . intVal($request->tender_type);
                break;
        }
        //echo(strpos($request->filter, '-') !== false);
        if (isset($request->filter) && strpos($request->filter, '-') !== false) {
            //echo('hi');
            $where = ["generated_id" => $request->filter];
            $whereline = "generated_id='" . $request->filter . "'";
        }
        //echo($whereline);
        if ($whereline != '')
            array_push($wherediff, $whereline);
        //var_dump($wherediff);
        if ($request->start_date && self::checkADate($request->start_date)) {
            //echo('-+-');
            $url = ' finish_date>STR_TO_DATE(' . self::checkADate($request->start_date) . ', \'%Y-%m-%d\')';
            //echo(json_encode($url));
            array_push($wherediff, $url);
        }
        if ($request->finish_date && self::checkADate($request->finish_date)) {
            //			echo('---');

            array_push($wherediff, ' finish_date<STR_TO_DATE(' . self::checkADate($request->finish_date) . ', \'%Y-%m-%d\')');
        }

        if ($request->search) {
            array_push($wherediff, "tname like '%" . $request->search . "%' or input_manager like '%" . $request->search . "%' or job_scope like '%" . $request->search . "%' or
subordinations like '%" . $request->search . "%' or grades_voltage like '%" . $request->search . "%'" . " or generated_id like '%" . $request->search . "%' or
tender_number like '%" . $request->search . "%'"); //TODO ESCAPE!!); //TODO ESCAPE!!
        }

        /*
			  if ($request->tender_type){
				  array_push ($wherediff, "tender_type = ".intVal($request->tender_type));
			  }
			  */

        ///$applications = Applications::get_all_applications();
        $whereRaw = count($wherediff) > 0 ? implode("and", $wherediff) : '1=1';
        //echo($whereRaw);
        //exit();

        $sql = DB::table('tenders_stat')->select()->whereRaw($whereRaw)->toSql();
        //echo($sql);
        $countRecords = DB::table('tenders_stat')->select()->whereRaw($whereRaw)->count();
        $countPages = ceil($countRecords / $pagesize);

        $list = DB::table('tenders_stat')->select()->whereRaw($whereRaw)->skip($pagenum * $pagesize)->take($pagesize)->orderby('id', 'desc')->get();

        $count_active = DB::table('tenders_stat')->select()->where([
            ['finish_date', '>', $fdate],
            ["deleted", '=', 0],
            ["stopped", '=', 0],
        ])->count();
        $count_inactive = DB::table('tenders_stat')->select()->where([
            ['finish_date', '<', $fdate],
            ["deleted", '=', 0],
            ["stopped", '=', 0],
        ])->count();

        $display_list = array();
        foreach ($list as $line) {
            if (strpos($line->generated_id, '-') !== false) {
                $app_id = explode('-', $line->generated_id);
                array_push($display_list, ['generated_id' => $line->generated_id, 'display_generated_id' => \App\Applications::get_meta_value($app_id[1], 'tender_num_display')]);
            }
        }
        $count_stopped = DB::table('tenders_stat')->select()->where(["stopped" => 1])->count();
        $count_all = DB::table('tenders_stat')->count();
        $files_zichron_devarim = DB::table('apps_file')->select()->where(["type" => "zichron-devarim.pdf"])->get();
        $files_protocol = DB::table('apps_file')->select()->where(["type" => "protocol.pdf"])->get();
        $app_meta = DB::table('apps_meta')
            ->where('meta_name', '=', 'upload_admin_file')
            ->get();
        $id = '';
        $meta_value = null;
        $is_contain_file = array();
        foreach ($list as $key => $line) {
            $temp_id = explode('-', $line->generated_id);
            $id = isset($temp_id[1]) ? $temp_id[1] : '';
            if ($app_meta->contains('app_id', $id)) {
                $meta_value = DB::table('apps_meta')
                    ->where([
                        ['app_id', '=', $id],
                        ['meta_name', '=', 'upload_admin_file'],
                    ])
                    ->first();
                $is_contain_file[$id] = ['flag' => true, 'file' => $meta_value->meta_value];
            } else {
                $is_contain_file[$id] = ['flag' => false, 'file' => ''];
            }
        }
        $tenders = DB::table('tenders')->select('generated_id', 'tname', 'id')->where(["deleted" => 0, "stopped" => 0])->get();

        $users = User::get();

        Excel::shareView('pdf.tendersPDF', [
            'files_zichron_devarim' => $files_zichron_devarim,
            'files_protocol' => $files_protocol,
            'list' => $list,
            'display_list' => $display_list,
            'filter' => $filter,
            'filter1' => '',
            'count_active' => $count_active,
            'count_inactive' => $count_inactive,
            'count_all' => $count_all,
            'count_stopped' => $count_stopped,
            'page_num' => $pagenum,
            'total_pages' => $countPages,
            //'submenu' => Applications::app_submenu_html( ),
            'pageTitle' => 'מכרזים',
            'upload_admin_file' => isset($meta_value->meta_value) ? $meta_value->meta_value : '',
            'is_contain_file' => $is_contain_file,
            'tenders' => $tenders,
            'tenderid' => $filter,
            'tender_status' => self::$tender_status,
            'users' => $users
        ])->create();
        // return view();
    }

    public function success_add_app(Request $request, $url, $failname)
    {
        Log::debug('success_add_app');
        $decision = $request->decisionId;

        $decLine = DB::table('app_decisions')->where(['id' => $decision])->first();
        $files = [];

        if ($decLine) {
            $p1 = $decLine->p1_id;
            $p2 = $decLine->p2_id;
            $p3 = $decLine->p3_id;
            $p5 = $decLine->p5_id;
            $fnames = [];
            $fline1 = Applications::getformfile($p1);
            $fline2 = Applications::getformfile($p2);
            $fline3 = Applications::getformfile($p3);
            $fline5 = Applications::getformfile($p5);

            if ($fline1 && isset($fline1->url) && file_exists(public_path('upload/' . $fline1->url . '')))
                array_push($fnames, public_path('upload/' . $fline1->url . ''));
            else {
                //echo (public_path('upload/' . $fline1->url . ''));
                //	echo(file_exists(public_path('upload/admin/' . $fline1->url . ''))?'da':'net');
            }
            if ($fline2 && isset($fline2->url) && file_exists(public_path('upload/' . $fline2->url . '')))
                array_push($fnames, public_path('upload/' . $fline2->url . ''));
            if ($fline3 && isset($fline3->url) && file_exists(public_path('upload/' . $fline3->url . '')))
                array_push($fnames, public_path('upload/' . $fline3->url . ''));
            if ($fline5 && isset($fline5->url) && file_exists(public_path('upload/' . $fline5->url . ''))) {
                foreach ($fline5 as $line) {
                    array_push($fnames, public_path('upload/' . $line->url . ''));
                }
            } else {
                if (count($fline5) > 0) {
                    foreach ($fline5 as $line) {
                        array_push($fnames, public_path('upload/' . $line->url . ''));
                    }
                }
            }
            $files = [$fline1, $fline2, $fline3, $fline5];

            $to = $decLine->email;
            $body = '<h3>תודה על פנייתך, מצ"ב:</h3>
                    <ol>
                        <li>טופס הגשת המועמדות שמילאת.</li>
                        <li>אישור קבלת הגשת המועמדות. </li>
                    </ol><br><br>';
            //ברכה, <br>
            //מנהל משאבי אנוש.';
            $tender = DB::table('tenders')->where('generated_id', '=', $decLine->tenderval)->first();
            $data = ["decision_id" => "2020-" . (100 + $decision), "sender" => $decLine->applicant_name, "tendername" => $tender->tname, "email" => $decLine->email, "app_dec" => $decLine];
            try {
                if ($tender->tender_type != 1) {
                    $pdf = PDF::loadView('pdf.pdfview_forms_answer', $data);
                } else {
                    $pdf = PDF::loadView('pdf.pdfview_forms_answer_student', $data);
                }
                $fail_name = uniqid() . '_' . time();
                $filename = public_path('upload/' . $fail_name . '.pdf');
                $res = $pdf->save($filename);
                if (file_exists($filename))
                    array_push($fnames, $filename);
                else {
                    //Log::debug ("Error writing file" . $filename . " " . json_encode ($res));

                }
            } catch (\Exception $e) {
                Log::debug("err" . $e->getMessage());
            }
            //$filename = public_path('upload/' . $fline1->url . '');
            // try {
            //     //Log::debug (json_encode ($fnames));
            //     Mail::to($to)->send(new SendMailable($body, $fnames, 'app', 'מכרז למשרת ' . $data['tendername'] . ' - מועצה מקומית קריית ארבע חברון'));
            //     $tender_num_display = DB::table('apps_meta')->where([
            //         ['app_id', '=', $decision],
            //         ['meta_name', '=', 'tender_num_display'],
            //     ])->first();
            //     $to1 = explode(',', env('ADMIN_EMAILS'));
            //     Applications::sendmail($to1, 'במכרז ' . $tender_num_display->meta_value . ' נכנסה פניה חדשה מספר ' . $decision . ' 😊 ', 'app', '', 'משאבי אנוש - מועצה מקומית קריית ארבע חברון');
            // } catch (\Exception $e) {
            //     Log::debug($e->getMessage());
            // }
            //}
        }
        $form = Forms::where([
            ['url', '=', $url],
            ['status', '=', '1'],
        ])->first();
        if (empty($form))
            return view('error.404');

        //	if (empty($failname)) return view('error.404');

        return view('forms.success', [
            'form' => $form,
            'files' => $files,
        ]);
    }

    public function getlog(Request $request)
    {
        //echo();
        $rid = $request->id;
        $sql = 'select * from apps_logs where
		app_id = ' . $rid . '
or app_id    in (select p1_id from app_decisions where tenderval=\'' . $rid . '\')
or app_id in (select p2_id from app_decisions where tenderval=\'' . $rid . '\')
or app_id in (select p3_id from app_decisions where tenderval=\'' . $rid . '\') or tender_id=\'' . $rid . '\'';

        $logs = DB::select(($sql));
        //$sql2='select * from apps_log where '
        //$list=DB::table('apps_logs')->where(['tender_id'=>$rid])->get();
        //$logs=array_merge((array)$logs,(array)$list);
        return $logs;
    }

    public function getTenderLog(Request $request, $id)
    {
        $rid = $id;
        // echo('ee'.$rid);



        ///echo(DB::table('apps_logs')->where(['tender_id'=>$rid])->toSql());
        //exit();
        $list = DB::table('apps_logs')->where(['tender_id' => $rid])->get();
        return json_encode($list);
    }

    public function addTenderLog(Request $request, $id)
    {
        $rid = $id;
        //echo('ee'.$rid);

        ///echo(DB::table('apps_logs')->where(['tender_id'=>$rid])->toSql());
        //exit();
        $user = \App\User::getCCurrentUser();
        if (!$user) {
            return json_encode(["res" => "error", 'code' => 1]);
        }
        $list = DB::table('apps_logs')->insert(['tender_id' => $rid, 'is_note' => 1, 'description' => $request->log . ' נכתב על ידי ' . $user, 'app_id' => 0]);

        return json_encode($list);
    }


    public function check_status(Request $request)
    {
        //echo('!!');
        $pass_id = $request->pass_id;
        //$applications = DB::table ('app_decisions_ext')->where ("decision_rejectedbyuser", '<>', '1')->where ('id_tz', '=', $pass_id)->get ();
        //var_dump($applications);
        $applications = DB::table('tenders_applications')
            ->leftJoin('tenders', function ($join) {
                $join->on('tenders_applications.generated_id', '=', 'tenders.generated_id');
            })
            ->where([['tenders_applications.decision_rejectedbyuser', '<>', '1'], ['tenders_applications.id_tz', '=', $pass_id]])
            ->get(['*', 'tenders_applications.id as tender_app_id']);
        $res = array();
        /*$applications = DB::table('apps_meta')
				  ->leftJoin('applications', function ($join) {
					  $join->on('applications.id', '=', 'apps_meta.app_id');
				  })
				  ->where([['apps_meta.meta_name', '=', 'identity_number'], ['apps_meta.meta_value', '=', $pass_id]])
				  ->get(['applications.*']);*/

        if (empty($applications) || count($applications) == 0) {
            $res['data'] = '<h3 class="empty-res">אין תוצאות לתצוגה  </h3><button class="btn btn-success cansel-request">בדיקת סטטוס של פניה אחרת</button>';
        } else {
            $res['data'] = '';
            foreach ($applications as $key => $app) {

                $tmp = '<div class="response__item">
                <h4 class="item__name">' . $app->brunch . '</h4>
                <div class="item__options">
                    <div class="option">
                        <label>מס’ פניה</label>
                         2020-' . (100 + $app->tender_app_id) /*date ("Y", strtotime ($app->crdate)) . '-' . $app->id*/ . '
                    </div>
                    <div class="option">
                        <label>שם הטופס:</label>
                        ' . $app->tname/*\App\Applications::app_forms_name ($app->id)*/ . '
                    </div>
                    <div class="option">
                        <label>תאריך פניה</label>
                        ' . date('d/m/Y', strtotime($app->crdate)) . '
                    </div>
                    <div class="option">
                        <label>סטטוס פניה - </label>
                        ' . \App\Applications::get_status1($app->app_status) . '
                    </div>';
                $res['data'] = $res['data'] . $tmp;
                /*
							$files = Applications::get_file_byAppID($app->id);
							if (!empty($files)) {
								$res['data'] .= '<div class="option"> <lavel>המסמכים שצורפו:</lavel> <div class="option__lniks">';
								foreach ($files as $key => $file) {
									$file_name = explode('^^', $file->file_name);
									$res['data'] .= '<a href="' . asset("upload/" . $file->url) . '" download>' . $file_name[1] . '</a>';
								}
								$res['data'] .= '</div></div>';
							}
							$answer_pdf = Applications::get_meta_value($app->id, 'answer_pdf');
							if (!empty($answer_pdf)) {
								$res['data'] .= '<div class="option">
												<lavel>תשובת הערייה:</lavel>
												<div class="option__lniks">
													<a href="' . asset("upload/admin/" . $answer_pdf) . '" download>מכתב דחייה אי עמידה בתנאי סף</a>
												</div>
											</div>';
							}*/
                $res['data'] .= '<div class="option">
                                    <label>פעולות: </label>
                                    <div class="option__lniks">
                                        <a href="/check-status/stop-app/' . $app->id . '" class="link--stop stop-app-s">עצור פנייה</a>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }
            $res['data'] .= '<button class="btn btn-success cansel-request">בדיקת סטטוס של פניה אחרת</button>';
        }
        return json_encode($res);
    }

    public function check_status_stop(Request $request, $id)
    {

        if (empty($id))
            return 'אירעה שגיאה לא צפויה, אנא רענן את הדף ונסה שוב עכשיו או אחר כך.';

        DB::table('app_decisions')->where(['id' => $id])->update(['decision_rejectedbyuser' => 1]);

        return 'success';
    }

    public function cvDownloadZip(Request $request)
    {

        // Log::debug('cvDownloadZip'.$_GET['app_ids']);
        // Log::debug('cvDownloadZip'._GET['app_ids']);
        if (!isset($_GET['type'])) {
            return false;
        }
        $type = $_GET['type'];
        if (isset($_GET['app_ids']) && $type == '1') {
            $app_ids = explode(',', $_GET['app_ids']);
            //$app_ids=$_GET['app_ids'];
            $tenders_applications = DB::table('tenders_applications')->select()->whereIn('id', $app_ids)->orderby('id', 'desc')->get();
        } else if ($type == '2' && $request->tenderid != '') {
            $tenders_applications = DB::table('tenders_applications')->select()->where('generated_id', '=', $request->tenderid)->where('app_status', 'LIKE', 'Interview')->orderby('id', 'desc')->get();
        } else if ($type == '3' && $request->tenderid != '') {
            $tenders_applications = DB::table('tenders_applications')->select()->where('generated_id', '=', $request->tenderid)->where('app_status', 'LIKE', 'Committee')->orderby('id', 'desc')->get();
        } else {
            return false;
        }
        Log::debug('$tenders_applications' . print_r($tenders_applications, true));
        $filespath = public_path('upload');
        $marge_file = 'file.pdf';
        $pdf = new PdfMerge();
        //  $did_arr = explode('-', $did);
        /*$meta_value = DB::table('apps_meta')
			->where([
				['app_id', '=', $did_arr[1]],
				['meta_name', '=', 'upload_admin_file']
			])
			->first();
		if (isset($meta_value->meta_value)){
			$pdf->addPDF($filespath . '/admin/' . $meta_value->meta_value, 'all');
		}*/
        foreach ($tenders_applications as $key => $t) {
            //Log::debug('$t->id.$key'.$key.$t->id);
            //Log::debug('$t->p5_id.$key'.$key.$t->p5_id);
            //  $approve_value = '';
            //  $approve_value = Applications::get_meta_value($t->id, 'email_msg_committee_approve');
            // if ($approve_value != ''){
            $files = DB::table('apps_file')
                ->where([
                    ['app_id', '=', $t->p5_id],
                ])->get();

            foreach ($files as $file) {
                $file_name = $file->file_name;
                $file_name_arr = explode('^^', $file->file_name);
                $file_1 = count($file_name_arr) > 1 ? $file_name_arr[1] : '';
                //Log::debug('$t->app_status.$key'.$t->app_status);
                //Log::debug('$approve_value.$key'.$approve_value);
                //Log::debug('AAA=$file_1'.$file_1.'==='.$t->p5_id);
                if ($file_1 != '' && $file_1 == 'קורות חיים' /*&& ($t->app_status == 'Interview' || $t->app_status == 'Accepted') && $approve_value != ''*/) {
                    //Log::debug('$file_name'.$file_name);
                    $is_download = true;
                    //Log::debug('BBB=$file_1'.$file_1.'==='.$t->id.'==='.$t->p5_id);
                    if (file_exists($filespath . '/' . $file->url)) {
                        if (strpos($file->url, 'docx') || strpos($file->url, 'doc') !== false) {
                            //header ("Content-type: application/vnd.ms-word");
                            //header ("Content-Disposition: attachment;Filename=document_name.doc");
                        }
                        //else {
                        //Log::debug('addPDF'.$file->url);
                        $pdf->add($filespath . '/' . $file->url);

                        //}
                    }
                    if (file_exists($filespath . '/admin/' . $file->url)) {
                        //Log::debug('admin:'. $file->url);
                        //if (strpos($file->url, 'docx') || strpos($file->url, 'doc') !== false) {
                        //header ("Content-type: application/vnd.ms-word");
                        //header ("Content-Disposition: attachment;Filename=document_name.doc");
                        //} else {
                        $pdf->add($filespath . '/admin/' . $file->url);
                        //}
                    }
                }
            }
            // }
        }
        if (isset($is_download)) {
            try {
                $marge_file_path = storage_path('app/public') . '/' . $marge_file;
                $pdf->merge(storage_path('app/public') . '/' . $marge_file);
                $to = explode(',', env('ADMIN_EMAILS'));
                Applications::sendmail($to, 'ראה קורות חיים מצורפים 😊', 'app', $marge_file_path, 'משאבי אנוש - מועצה מקומית קריית ארבע חברון');

                return response()->download(storage_path('app/public') . '/' . $marge_file)->deleteFileAfterSend(true);
            } catch (\Exception $e) {

                return $e->getMessage();
            }
        }
        //else {
        //return 'בשלב זה אין מועמדים שאישרו הגעתם לוועדה';
        //}

    }

    public function add_file(Request $request, $tenderId)
    {
        $res = array();
        if (empty($tenderId)) {
            $res['error'] = 'אירעה שגיאה לא צפויה, אנא רענן את הדף ונסה שוב עכשיו או אחר כך.';
        } else {
            $tenders_files = DB::table('tenders_files')->where('tender_id', '=', $tenderId)->get();
            $file_data = array();
            $date = new \DateTime();
            $date->setTimezone(new \DateTimeZone('Asia/Jerusalem'));
            $fdate = $date->format('Y-m-d H:i:s');
            if ($request->hasFile('file') && !empty($request->file)) {
                // var_dump('upload!');
                $res['file_errors'] = array();
                //$fail_titles = self::$form_files[$form->id];
                //$fail_titles_cond = array();
                Log::debug('$request->file' . json_encode($request->file));
                foreach ($request->file as $key => $file) {
                    Log::debug('$key.$file' . $key . $file);
                    //	$cond_key = 'condition'.$key;
                    //$cond_val = $request->$cond_key;
                    /*$fail_titles_cond = '';
								if($key > 43 && $cond_val != ''){
									$fail_titles_cond = ['name'=>'tender_add_cond['.$key.']','title'=> $cond_val,'show_type' => '', 'required' => ''];
								}*/
                    if ((!in_array($file->getClientmimeType(), self::$acceptable)) && (!empty($file->getClientmimeType()))) {
                        Log::debug('$file->getClientmimeType()' . $file->getClientmimeType());
                        $res['file_errors'][] = 'Invalid file type.';
                        break;
                    }
                    if ($file->getSize() >= 20971520 || $file->getSize() == 0) {
                        $res['file_errors'][] = 'File too large. File must be less than 20 megabytes.';
                        break;
                    }
                    $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/tender'), $filename);
                    //				echo(json_encode($filename));
                    //				echo(json_encode($appID));
                    //	$all_fail_titles = '';
                    /*if (count($fail_titles) > $key){
									$all_fail_titles = $fail_titles[$key]['title'] != '' ? $fail_titles[$key]['title'] : '';
								}
								$all_fail_titles .= $fail_titles_cond != '' ? $fail_titles_cond['title'] : '';*/
                    //Log::debug('$filename'.$filename.'$file->getClientOriginalName()'.$file->getClientOriginalName());
                    $file_data[] = [
                        'tender_id' => $tenderId,
                        'url' => $filename,
                        'file_type' => $tenderId == '' ? 'no' : $file->getClientOriginalExtension(),
                        'file_name' => $file->getClientOriginalName(),
                        'status' => 0,
                        'updated_at' => $fdate,
                    ];
                    DB::table('tenders_files')->insert(
                        $file_data,
                    );
                }
            }
            //echo(json_encode($file_data));


            //update all other files
            foreach ($tenders_files as $tender_file) {
                $last_id = DB::table('tenders_files')->where('id', '=', $tender_file->id)->update(['status' => 1, 'updated_at' => $fdate]);
            }
            // $res["newFileId"] = $newFileId;
            if (isset($file_data[0]['file_name']))
                $res["filename"] = $file_data[0]['file_name'];
        }

        return json_encode($res);
    }

    function markStarApplication($id)
    {

        try {

            $app_dec = AppDecisions::find($id);
            $app_dec->is_star = (int) !$app_dec->is_star;
            $app_dec->save();
            return response(['success' => true]);
        } catch (\Throwable $th) {
            //throw $th;
            return response(['success' => false]);
        }
    }

    function decisionMakerAdd(Request $request, $tenderid)
    {


        try {
            foreach ($request->tender_decision_maker as $key => $dec_maker) {
                # code...
                $maker = new DecisionMaker;

                $maker->tender_id = $tenderid;

                $maker->decision_maker = $dec_maker;

                $maker->save();
            }
            return response(['success' => true]);
        } catch (\Throwable $th) {
            // throw $th;
            return response(['success' => false]);
        }
    }

    function decisionMakerEdit(Request $request, $tenderid)
    {
        $makers = DecisionMaker::where('tender_id', $tenderid)->get();

        return view('utils.decision-maker-edit', compact('makers'))->render();
    }

    function decisionMakerUpdate(Request $request, DecisionMaker $maker)
    {

        try {
            $maker->decision_maker = $request->data;
            $maker->save();
            return response(['success' => true]);
        } catch (\Throwable $th) {
            // throw $th;
            return response(['success' => false]);
        }
    }

    function decisionMakerDelete(Request $request, DecisionMaker $maker)
    {

        try {
            $maker->decision_maker = $request->data;
            $maker->delete();
            return response(['success' => true]);
        } catch (\Throwable $th) {
            // throw $th;
            return response(['success' => false]);
        }
    }

    function saveDecision(Request $request, $tender)
    {
        try {
            $decisionData = $request->except(['_token', 'moth_sign', 'html', 'select_dec', 'appeared']);

            $select_dec = json_encode(array_values($request->select_dec ?? []));

            $decisionData['select_dec'] = $select_dec;

            $td = TenderDecision::where('tender_id', $request->tender_id)->first();

            if ($td) {
                $td->update($decisionData);
            } else {
                $td = TenderDecision::create($decisionData);
            }

            if ($request->moth_sign) {
                foreach ($request->moth_sign as $key => $moth_sign) {
                    $dm = DecisionMaker::find($key);
                    if ($dm) {
                        $dm->signature = $moth_sign;
                        $dm->save();
                    }
                }
            }

            if ($request->appeared) {
                foreach ($request->appeared as $key => $appeared) {
                    $appDecision = AppDecisions::find($key);
                    if ($appDecision) {
                        $appDecision->update([
                            'is_appeared' => $appeared
                        ]);
                    }
                }
            }

            return back()->with('success', 'המסמך נשמר בהצלחה');
        } catch (\Exception $e) {
            \Log::error('saveDecision error: ' . $e->getMessage());
            return back()->with('error', 'שגיאה בשמירת המסמך: ' . $e->getMessage());
        }
    }
	
	


    function tenderBodyImage(Request $request, $tender)
    {
        $tender = Tender::select('body')->where('generated_id', $tender)->first();
        $imgPath = public_path(self::tenderImage($tender->body));
        return response(File::get($imgPath), 200, [
            'Content-Type' => File::mimeType($imgPath)
        ]);
    }

    public static function tenderImage($body)
    {
        // die( config('static_array.bodies')[$body]);
        // print_r(end(config('static_array.bodies')));
        // die( );
        return config('static_array.bodies')[$body] ?? config('static_array.bodies')[array_key_last(config('static_array.bodies'))];
    }

    /**
     * Parse qualifications data from database format
     * Format: "Education and professional requirements#$$#Professional courses and trainings#$$#Professional experience#$$#Additional requirements#$$#Management experience#$$#Yes and no questions"
     * Note: For mandatory test, we now use tender->is_test_required field instead of qualifications string
     */
    private function parseQualifications($qualificationsString, $conditionsString = null, $applicationId = null)
    {
        $qualificationsArray = explode('#$$#', $qualificationsString);

        // Parse conditions to get status for each qualification
        $conditionsArray = [];
        if ($conditionsString) {
            $conditions = explode('!+!+!+!', $conditionsString);

            foreach ($conditions as $condition) {
                if (strpos($condition, '=>') !== false) {
                    list($text, $statusPart) = explode('=>', $condition, 2);

                    // Handle new format with section information: status[section]
                    $status = $statusPart;

                    // if (preg_match('/^(.+)\[doc\d+\]$/', $statusPart, $matches)) {
                    //     $status = $matches[1];
                    // }

                    $conditionsArray[trim($text)] = $status;
                }
            }
        }
        // Check if there are any conditions at all
        $hasAnyConditions = !empty($conditionsArray);

        $educationStatus = $this->getQualificationStatusForSectionSimple($qualificationsArray[0] ?? '', $hasAnyConditions, $conditionsArray, $applicationId, 'education');
        $professionalCoursesStatus = $this->getQualificationStatusForSectionSimple($qualificationsArray[1] ?? '', $hasAnyConditions, $conditionsArray, $applicationId, 'professional_courses');
        $professionalExperienceStatus = $this->getQualificationStatusForSectionSimple($qualificationsArray[2] ?? '', $hasAnyConditions, $conditionsArray, $applicationId, 'professional_experience');
        $additionalRequirementsStatus = $this->getQualificationStatusForSectionSimple($qualificationsArray[3] ?? '', $hasAnyConditions, $conditionsArray, $applicationId, 'additional_requirements');
        $managementExperienceStatus = $this->getQualificationStatusForSectionSimple($qualificationsArray[4] ?? '', $hasAnyConditions, $conditionsArray, $applicationId, 'management_experience');

        return [
            'education' => [
                'text' => $qualificationsArray[0] ?? '',
                'qualification_type' => $educationStatus['qualification_type'] ?? 'לא הוגדר',
                'file_status' => $educationStatus['file_status'] ?? 'לא הוגדר'
            ],
            'professional_courses' => [
                'text' => $qualificationsArray[1] ?? '',
                'qualification_type' => $professionalCoursesStatus['qualification_type'] ?? 'לא הוגדר',
                'file_status' => $professionalCoursesStatus['file_status'] ?? 'לא הוגדר'
            ],
            'professional_experience' => [
                'text' => $qualificationsArray[2] ?? '',
                'qualification_type' => $professionalExperienceStatus['qualification_type'] ?? 'לא הוגדר',
                'file_status' => $professionalExperienceStatus['file_status'] ?? 'לא הוגדר'
            ],
            'additional_requirements' => [
                'text' => $qualificationsArray[3] ?? '',
                'qualification_type' => $additionalRequirementsStatus['qualification_type'] ?? 'לא הוגדר',
                'file_status' => $additionalRequirementsStatus['file_status'] ?? 'לא הוגדר'
            ],
            'management_experience' => [
                'text' => $qualificationsArray[4] ?? '',
                'qualification_type' => $managementExperienceStatus['qualification_type'] ?? 'לא הוגדר',
                'file_status' => $managementExperienceStatus['file_status'] ?? 'לא הוגדר'
            ],
            'mandatory_test' => [
                'text' => $qualificationsArray[5] ?? '',
                'status' => 'חובה',
                'required' => !empty($qualificationsArray[5])
            ]
        ];
    }

    /**
     * Get qualification status from conditions array and file uploads
     */
    private function getQualificationStatusFromConditions($qualificationText, $conditionsArray, $applicationId = null, $qualificationType = null)
    {
        // If qualification text is empty or null, return "לא הוגדר"
        if (empty(trim($qualificationText))) {
            return 'לא הוגדר';
        }

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
            // If qualification text not found in conditions, it means it wasn't added to tender
            return 'לא הוגדר';
        }

        // Check if user has uploaded files for this qualification and their approval status
        $hasUploadedFiles = DB::table('apps_file')
            ->where('app_dec_id', $applicationId)
            ->where('file_name', 'LIKE', '%' . $qualificationText . '%')
            ->exists();

        if ($hasUploadedFiles) {
            // Get all files for this qualification
            $files = DB::table('apps_file')
                ->where('app_dec_id', $applicationId)
                ->where('file_name', 'LIKE', '%' . $qualificationText . '%')
                ->get();

            $hasApproved = false;
            $hasRejected = false;
            $hasPending = false;
            $hasCompleted = false;

            foreach ($files as $file) {
                switch ($file->status) {
                    case '1': // Approved
                        $hasApproved = true;
                        break;
                    case '2': // Rejected
                        $hasRejected = true;
                        break;
                    case '3': // Completed (user uploaded new file after rejection)
                        $hasCompleted = true;
                        break;
                    case '0': // Pending
                    default:
                        $hasPending = true;
                        break;
                }
            }

            // Priority order: Completed > Approved > Rejected > Pending
            if ($hasCompleted) {
                return 'הושלם';
            } elseif ($hasApproved && !$hasRejected && !$hasPending) {
                return 'אושר';
            } elseif ($hasRejected) {
                return 'נדחה';
            } else {
                return 'ממתין לאישור';
            }
        }

        // If no files uploaded yet, return "לא הוגדר" since qualification exists but no files
        return 'לא הוגדר';
    }

    /**
     * Check if a qualification section has radio button selections (not just text)
     */
    private function getQualificationStatusForSectionSimple($qualificationText, $hasAnyConditions, $conditionsArray, $applicationId, $sectionType)
    {
        // Check if there are any conditions with radio button selections for this section
        $hasRadioButtonSelection = false;
        $selectedConditionText = '';
        $selectedStatus = '';

        // NEW APPROACH: Look for conditions with section identifiers first
        foreach ($conditionsArray as $conditionText => $status) {
            // Check if this condition has section information in the new format
            if (preg_match('/^(.+)\[doc(\d+)\]$/', $status, $matches)) {
                $actualStatus = $matches[1];
                $sectionNumber = $matches[2];

                // Map section numbers to section types
                $sectionMap = [
                    '1' => 'education',
                    '2' => 'professional_courses',
                    '3' => 'professional_experience',
                    '4' => 'additional_requirements',
                    '5' => 'management_experience',
                    '6' => 'yes_no_questions'
                ];

                if (isset($sectionMap[$sectionNumber]) && $sectionMap[$sectionNumber] === $sectionType) {
                    // This condition belongs to this section
                    if (in_array($actualStatus, ['required', 'not_required', 'cond_or', 'confirm'])) {
                        $hasRadioButtonSelection = true;
                        $selectedConditionText = $conditionText;
                        $selectedStatus = $actualStatus;
                        break;
                    }
                }
            }
        }

        // FALLBACK: If no section-specific conditions found, try text matching
        if (!$hasRadioButtonSelection && !empty(trim($qualificationText))) {
            foreach ($conditionsArray as $conditionText => $status) {
                // Skip conditions that have section identifiers (already processed above)
                if (preg_match('/^(.+)\[doc\d+\]$/', $status)) {
                    continue;
                }

                // Check if this condition belongs to this section
                // Use more flexible matching - check if any part of the condition text appears in qualification text
                $conditionWords = explode(' ', trim($conditionText));
                $qualificationWords = explode(' ', trim($qualificationText));

                $hasMatch = false;
                // Check if any significant words from condition appear in qualification
                foreach ($conditionWords as $word) {
                    $word = trim($word);
                    if (strlen($word) > 2) { // Only check words longer than 2 characters
                        foreach ($qualificationWords as $qualWord) {
                            if (strpos($qualWord, $word) !== false || strpos($word, $qualWord) !== false) {
                                $hasMatch = true;
                                break 2;
                            }
                        }
                    }
                }

                // Also check direct substring matching as fallback
                if (!$hasMatch) {
                    $hasMatch = (strpos($qualificationText, trim($conditionText)) !== false ||
                                strpos(trim($conditionText), $qualificationText) !== false);
                }

                if ($hasMatch) {
                    // Check if it has a valid radio button selection (not just 'no' which means no selection)
                    if (in_array($status, ['required', 'not_required', 'cond_or', 'confirm'])) {
                        $hasRadioButtonSelection = true;
                        $selectedConditionText = $conditionText;
                        $selectedStatus = $status;
                        break;
                    }
                }
            }
        }

        // If no radio button was selected for this section
        if (!$hasRadioButtonSelection) {
            return [
                'qualification_type' => 'לא הוגדר',
                'file_status' => 'לא הוגדר'
            ];
        }

        // If we have a radio button selection, check file upload status if application ID exists
        if ($applicationId && !empty($selectedConditionText)) {
            // Check if any files were uploaded for this qualification
            $hasUploadedFiles = DB::table('apps_file')
                ->where('app_dec_id', $applicationId)
                ->where('file_name', 'LIKE', '%' . $selectedConditionText . '%')
                ->exists();

            if ($hasUploadedFiles) {
                // Get file status
                $files = DB::table('apps_file')
                    ->where('app_dec_id', $applicationId)
                    ->where('file_name', 'LIKE', '%' . $selectedConditionText . '%')
                    ->get();

                $hasApproved = false;
                $hasRejected = false;
                $hasCompleted = false;

                foreach ($files as $file) {
                    switch ($file->status) {
                        case '1': // Approved
                            $hasApproved = true;
                            break;
                        case '2': // Rejected
                            $hasRejected = true;
                            break;
                        case '3': // Completed
                            $hasCompleted = true;
                            break;
                    }
                }

                $fileStatus = 'ממתין לאישור';
                if ($hasCompleted) {
                    $fileStatus = 'הושלם';
                } elseif ($hasApproved && !$hasRejected) {
                    $fileStatus = 'אושר';
                } elseif ($hasRejected) {
                    $fileStatus = 'נדחה';
                }

                // Determine qualification type based on radio button selection
                $qualificationType = '';
                switch ($selectedStatus) {
                    case 'required':
                        $qualificationType = 'תנאי סף';
                        break;
                    case 'not_required':
                        $qualificationType = 'יתרון';
                        break;
                    case 'cond_or':
                        $qualificationType = 'תנאי סף מסוג או';
                        break;
                    case 'confirm':
                        $qualificationType = 'מאשר/ת שהנני עומד/ת בדרישות אלה';
                        break;
                    default:
                        $qualificationType = 'לא הוגדר';
                }

                return [
                    'qualification_type' => $qualificationType,
                    'file_status' => $fileStatus
                ];
            }
        }

        // Determine qualification type based on radio button selection
        $qualificationType = '';
        switch ($selectedStatus) {
            case 'required':
                $qualificationType = 'תנאי סף';
                break;
            case 'not_required':
                $qualificationType = 'יתרון';
                break;
            case 'cond_or':
                $qualificationType = 'תנאי סף מסוג או';
                break;
            case 'confirm':
                $qualificationType = 'מאשר/ת שהנני עומד/ת בדרישות אלה';
                break;
            default:
                $qualificationType = 'לא הוגדר';
        }

        return [
            'qualification_type' => $qualificationType,
            'file_status' => 'ממתין לאישור'
        ];
    }



    /**
     * Get qualification status based on file uploads and approvals
     */
    private function getQualificationStatus($qualificationText, $qualificationType)
    {
        // dd($qualificationText, $qualificationType,"LL");
        // If qualification text is empty or null, return "לא הוגדר"
        if (empty(trim($qualificationText))) {
            return 'לא הוגדר';
        }

        // Check for advantage/mandatory keywords
        if (stripos($qualificationText, 'יתרון') !== false || stripos($qualificationText, 'advantage') !== false) {
            return 'יתרון';
        } elseif (stripos($qualificationText, 'חובה') !== false || stripos($qualificationText, 'mandatory') !== false || stripos($qualificationText, 'required') !== false) {
            return 'חובה';
        }

        // Default to mandatory if not specified
        return 'חובה';
    }

    /**
     * Get empty qualifications structure when no data exists
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


class TenderListExcelImport extends ExportRTL implements FromView, WithHeadings, WithEvents
{
    private $data;
    private $headings;
    private $list;

    function __construct($list)
    {
        $this->list = $list;
        // $this->headings =
    }

    public function headings(): array
    {
        return ["tender number", "tender name", "department", "tender status", "tender start", "tender finish", "candidate count", "job scope", "tender type"];;
    }

    public function view(): View
    {
        //var_dump($this->data);
        return view('excel.tender', ['list' => $this->list]);
    }
}
