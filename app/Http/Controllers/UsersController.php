<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Services\EncryptionService;
//use Auth;
//use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
//use DB;
class UsersController extends Controller
{
    private $user;
    private EncryptionService $encryptionService;
    public $userdata = array(
        'department'=>array(
            'education' => 'חינוך'
        )
    );
    public function __construct(User $user, EncryptionService $encryptionService)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->encryptionService = $encryptionService;
    }

    public function index()
    {
    //Here is a Collection of all our users.
        $users = \App\User::get_all_users();

        // Get security logs for the security log tab
        $securityLogs = $this->getSecurityLogs();

        return view('users.index',[
            'pageTitle'=>'Users',
            'user'=>Auth::user(),
            'users' => $users,
            'userdata' => $this->userdata,
            'securityLogs' => $securityLogs
        ]);
    }

    /**
     * Get security logs for display
     */
    private function getSecurityLogs()
    {
        $securityLogPath = storage_path('logs/security');
        $logs = [];

        if (File::isDirectory($securityLogPath)) {
            $monthDirs = File::directories($securityLogPath);

            foreach ($monthDirs as $monthDir) {
                $month = basename($monthDir);
                $files = File::files($monthDir);

                foreach ($files as $file) {
                    $logs[] = [
                        'month' => $month,
                        'date' => pathinfo($file->getFilename(), PATHINFO_FILENAME),
                        'filename' => $file->getFilename(),
                        'size' => $file->getSize(),
                        'modified' => date('Y-m-d H:i:s', $file->getMTime()),
                    ];
                }
            }

            usort($logs, fn($a, $b) => strcmp($b['date'], $a['date']));
        }

        return $logs;
    }

    public function create_user(Request $request){
        $name = $request->name.' '.$request->fname;
        $validator = $this->validator($request);
        $res = array('errors'=>false);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $res['errors'] = $errors->all();
        }else{
            $password = $request->user_type == "1" ? Hash::make($request->password) : Hash::make(Str::random(8));
            $permissions = isset($request->permissions) ? implode(',', $request->permissions) : "";

            // Encrypt name and email before storing
            $encryptedName = $this->encryptionService->encrypt($name);
            $encryptedEmail = $this->encryptionService->encrypt($request->email);

            $id = User::insertGetId(
                    [
                        'name' => $encryptedName,
                        'email' => $encryptedEmail,
                        'role' => $permissions,
                        'password'=> $password,
                        'created_at' => date('Y-m-d h:i:j'),
                        'updated_at' => date('Y-m-d h:i:j'),
                        'status' => $request->user_type,
                        'encryption_key_slot' => $this->encryptionService->getCurrentKeySlot()
                    ]
                );
            if($id){
                DB::table('users_meta')->insert([
                        ['user_id' => $id, 'meta_name'=> 'department','meta_value' => $request->department],
                        ['user_id' => $id, 'meta_name'=> 'user_role','meta_value' => $request->user_role],
                ]);
                $AppPermissions = $request->apppermissions;
                if (!empty($AppPermissions)) {
                    foreach ($AppPermissions as $key => $AppPermission) {
                        if (!empty($AppPermission)) {
                            $AppPermission = implode(',', $AppPermission);
                            DB::table('users_meta')->insert([
                                    ['user_id' => $id, 'meta_name' => $key, 'meta_value' => $AppPermission],
                                ]);
                        }
                    }
                }
                $res['s']="<h2 style='text-align: center; margin-top: 30px; color: #4cae4c;'>המשתמש נוסף בהצלחה</h2>";
            }else{
                $res['errors'][] = 'אירעה שגיאה. רענן את הדף ונסה שוב.';
            }
        }
        return json_encode( $res );
    }

    protected function validator(Request $request){
        if ($request->user_type == "1") {
            return Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:8|confirmed',
                'user_type' => 'required',
                'department' => 'required',
                'user_role' => 'required',
            ]);
        }else{
            return Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'user_type' => 'required',
                'department' => 'required',
                'user_role' => 'required',
            ]);
        }

    }
    public function get_edit_area(Request $request, $id){

        $this->userdata['forms'] = DB::table('forms')->where([['status', '=', '1']])->get(['type','name','department']);
        return view('users.edit-area',[
                'user'=> User::get_user( $id ),
                'userdata' => $this->userdata,
                'errors' => '',
                'form_type' => ''
        ]);
    }
    public function get_add_area(Request $request){
        return view('users.create-form',[
            'pageTitle'=>'Users',
            'user'=>Auth::user(),
            'forms' => DB::table('forms')->where([['status', '=', '1']])->get(['type','name','department'])
        ]);
    }

    public function edit_user(Request $request, $id){
        $form_type = $request->form_types;
        $errors = '';
        $apppermissions_html= '';
        if (empty($form_type) || empty($id)) return 'אירעה שגיאה. רענן את הדף ונסה שוב.';
        if ($form_type == 1) {
           $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'fname' => 'required|max:255',
                'department' => 'required',
                'user_role' => 'required',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
            }else{
                $name = $request->name.' '.$request->fname;
                // Encrypt name before storing
                $encryptedName = $this->encryptionService->encrypt($name);
                DB::table('users')->where('id', $id)->update([
                    'name' => $encryptedName,
                    'encryption_key_slot' => $this->encryptionService->getCurrentKeySlot()
                ]);
                DB::table('users_meta')
                ->where([
                    ['user_id', '=', $id],
                    ['meta_name', '=', 'department'],
                ])->update(['meta_value' => $request->department]);
                DB::table('users_meta')
                ->where([
                    ['user_id', '=', $id],
                    ['meta_name', '=', 'user_role'],
                ])->update(['meta_value' => $request->user_role]);
            }
        }elseif($form_type == 2){
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:255',
                'password' => 'required|min:8|confirmed',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
            }else{
                $password = Hash::make($request->password);
                // Encrypt email before storing
                $encryptedEmail = $this->encryptionService->encrypt($request->email);
                DB::table('users')->where('id', $id)->update([
                    'password' => $password,
                    'email' => $encryptedEmail,
                    'status' => 1,
                    'encryption_key_slot' => $this->encryptionService->getCurrentKeySlot()
                ]);
            }
        }elseif($form_type == 3){
            $permissions = isset($request->permissions) ? implode(',', $request->permissions) : "";
           var_dump($permissions);
            // $req= DB::table('users')->where('id', $id)->update(['status' => 1,'role' => $permissions])->toSql();
           // echo($req);
            DB::table('users')->where('id', $id)->update(['status' => 1,'role' => $permissions]);
            /*if (!empty($request->form_type) &&  !empty($request->institution_type) && $request->form_type != "בחירת טופס") {
                $apppermissions = isset($request->apppermissions) ? implode(',', $request->apppermissions) : "";
                $m = DB::table('users_meta')->where([
                        ['user_id', '=', $id],
                        ['meta_name', '=', $request->institution_type.'_'.$request->form_type],
                    ])->first();
                if (empty($m)) {
                    DB::table('users_meta')->insert([
                        ['user_id' => $id, 'meta_name' => $request->institution_type.'_'.$request->form_type, 'meta_value' => $apppermissions],
                    ]);
                }else{
                    DB::table('users_meta')
                    ->where([
                        ['user_id', '=', $id],
                        ['meta_name', '=', $request->institution_type.'_'.$request->form_type],
                    ])->update(['meta_value' => $apppermissions]);
                }
                $apppermissions_html = $this->get_apppermissions_html($request, $id);
                $ins_type = array($request->form_type,$request->institution_type);
            }*/
        }elseif($form_type == 4){
            $status = isset($request->user_type) ? 1 : 0;
            DB::table('users')->where('id', $id)->update(['status' => $status]);
        }

        $this->userdata['forms'] = DB::table('forms')->where([['status', '=', '1']])->get(['type','name','department']);
        return view('users.edit-area',[
                'user'=> User::get_user( $id ),
                'userdata' => $this->userdata,
                'errors' => $errors,
                'form_type' => $form_type,
                'apppermissions_html'=> $apppermissions_html,
                'ins_type' => isset($ins_type) ? $ins_type : ""
        ]);
    }

    public function autocomplete(Request $request)
    {

        $data = User::select("name","id")
                ->where([
                    ["name","LIKE","{$request->text}%"],
                ])->get();
        return response()->json($data);

    }

    public function findUsersByTxt(Request $request)
    {
    //	var_dump($request);
    	//$res=DB::table('users')->whereRaw("name like '%".." %'");
	    $sql = DB::table('users')->select(['id', 'name'])->Where('name', 'like', '%' . $request->name . '%')->toSql();
	   // echo($request->name );
	   // echo($sql);
	    $res = DB::table('users')->select(['id', 'name'])->Where('name', 'like', '%' . $request->name . '%')->get();
	    return $res;


    }

    public function get_apppermissions_html(Request $request, $id){
        $form_type = $request->form_type;
        $institution_type = $request->institution_type;
        if (empty($form_type) || empty($institution_type)) return ' ';

        if($id != 0){
            $apppermissions = DB::table('users_meta')
                    ->where([
                        ['user_id', '=', $id],
                        ['meta_name', '=', $institution_type.'_'.$form_type ],
                    ])->first();

            $checkeds =  !empty($apppermissions->meta_value) ? explode(',', $apppermissions->meta_value) : array();

            $html = User::get_checkbox("apppermissions[]", array('אישור/דחייה טופס הבקשה', 'אישור/דחייה מסמכים מצורפים', 'שליחת תשובות', 'ייצאו נתונים לקובץ אקסל'), $checkeds);
        }else{
            $html = User::get_checkboxs_add_users($form_type, $institution_type);
        }
        return $html;
    }
}
