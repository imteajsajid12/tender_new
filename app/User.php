<?php

namespace App;

use App\Models\Tender;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//use DB;
//use Auth;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function get_all_users() {
        $Users = DB::table('users')
                ->where([
                    ['id', '!=', 1]
                ])
                ->orderBy('id', 'DESC')->paginate(15);
        foreach ($Users as $key => $User) {
            $user_meta = DB::table('users_meta')
                ->where('user_id', '=', $User->id)
                ->get();
            $data = array();
            foreach ($user_meta as $key => $value) {
                $data[$value->meta_name]  = $value->meta_value;
            }
            $User->meta = $data;
        }
        return $Users;
    }



    public static function get_user($id) {
        $User = DB::table('users')
                ->where('id', '=', $id)
                ->first();
        $user_meta = DB::table('users_meta')
                ->where('user_id', '=', $User->id)
                ->get();
        $data = array();
        foreach ($user_meta as $key => $value) {
            $data[$value->meta_name]  = $value->meta_value;
        }
        $User->meta = $data;

        return $User;
    }

	public static function getCCurrentUser() {
		$user = Auth::user ();
		if (isset($user->name)) return $user->name;

		return $user;
		if ($user)
		return self::get_user($user); else return false;

	}

    public static function check_auth_user_permission($permission){
    	$user = Auth::user();
	    if (empty($user->role)) return false;
	    // echo($user->id);
        $permissions = explode(',', $user->role);

        if(in_array($permission, $permissions)) return true;

        return false;
    }

    public static function check_auth_user_AppPermission($application, $permission){
        $user = Auth::user();
        $permissions = DB::table('users_meta')
                ->where([
                    ['user_id', '=', $user->id],
                    ['meta_name', '=', $application->department.'_'.$application->type],
                ])->first();

        if (empty($permissions)) return false;

        $permissions = explode(',', $permissions->meta_value);

        if(in_array($permission, $permissions)) return true;

        return false;
    }
    public static function check_auth_user_AppPermission2($application, $permission){
    	return true;
        $user = Auth::user();
        $permissions = DB::table('users_meta')
                ->where([
                    ['user_id', '=', $user->id],
                    ['meta_name', '=', $application->department.'_'.$application->type],
                ])->first();

        if (empty($permissions)) return false;

        $permissions = explode(',', $permissions->meta_value);

        if(in_array($permission, $permissions)) return true;

        return false;
    }

    public static function checkedHTML($val, $values ) {

        return in_array($val, $values) ? 'checked="checked"' : "";
    }

    public static function get_checkbox($name, $values, $checkeds, $t = false){
        $html = '';
        foreach ($values as $key => $value) {
            $html .= $t ? "<div>" : "";
            $html .= '<label class="checkbox-control">
                        <input type="checkbox"  name="'.$name.'" value="'.($key+1).'" '. self::checkedHTML($key+1, $checkeds) .'/>
                        <span class="virtual"></span>
                        <span class="text">'.$value.'</span>
                    </label>';
            $html .= $t ? "</div>" : "";
        }
        return $html;
    }

    public static function get_checkboxs_add_users($form_type, $institution_type){
        $html = '<div class="field checkboxes '.$institution_type.'_'.$form_type.' act">';
        $html .= self::get_checkbox('apppermissions['.$institution_type.'_'.$form_type.'][]',  array('אישור/דחייה טופס הבקשה', 'אישור/דחייה מסמכים מצורפים', 'שליחת תשובות', 'ייצאו נתונים לקובץ אקסל'), array(), true);
        $html .= '</div>';
        return $html;
    }

    function tenders(){
        return $this->belongsToMany(Tender::class,'tender_user');
    }


}
