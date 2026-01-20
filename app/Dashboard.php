<?php

namespace App;
//use DB;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Auth;
//use App\ApplicationsV2;

class Dashboard extends Model
{
	public static function get_reports(){
		$user = auth()->user();
        $form_ids = Applications::get_user_forms( $user->id );
        if(empty($form_ids)) return false;

        $forms = DB::table('forms')->where([['status', '=', '1']])->whereIn('id', $form_ids )->get();
        $Applications = Applications::whereIn('form_id', $form_ids )->get(['form_id','department','type','id','status']);

        return array($forms, $Applications);  
	}

	public static function search($array, $search_list, $count = false) { 
   
    	$result = array(); 
  
	    foreach ($array as $key => $value) { 
	        foreach ($search_list as $k => $v) { 
	            if (!isset($value->$k) || $value->$k != $v) 
	            { 
	                continue 2; 
	            } 
	        } 
	        $result[] = $value; 
	    }  
	    if ($count) {
	    	return count($result);
	    }
	    return $result; 
	}

}