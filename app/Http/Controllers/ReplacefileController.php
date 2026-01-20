<?php

namespace App\Http\Controllers;
//use DB;
use App\Forms;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReplacefileController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Request $request,$file)
	{
		//	echo('11');
		//exit();
		$fileid = base64_decode($file,true);
		// echo($file."<br>");
		//  echo($fileid);
		//  exit();
		if (!$fileid) {
			return response(view('error.404'), 404);
		}
		// echo($file);

		$file = DB::table('apps_file')->where('id', '=', $fileid)->first();
		// echo(json_encode($file));
		$statuses=Forms::getFFF();
		if (!empty($file) ) {
			$filename_0=explode('^^', $file->file_name)[0];
			$filename=explode('^^', $file->file_name)[1];
			$filetitle=isset($statuses[$filename])?$statuses[$filename]:'';
			return view('replacefile',[
				'file' => $file,
				'filetitle'=>$filetitle,
				'filename_0'=>$filename_0,
				'statuses'=>$statuses,
				'pageTitle'=>'העלאת מסמך חדש',
			]);
		}else{
			return response(view('error.404'), 404);
		}

	}






	public function replace(Request $request){
		if ( $request->fileID && $request->hasFile('file') ){
			$resulte = array( );
			$newfile = $request->file('file');
			$acceptable = array(
				'application/pdf',
				'image/jpeg',
				'image/jpg',
				'image/gif',
				'image/png',
				'image/jpe',
				'image/tiff',
				'image/bmp',
				'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				'application/msword'
			);
			if((!in_array($newfile->getClientmimeType(), $acceptable)) && (!empty($newfile->getClientmimeType()))) {
				$resulte['error'] = 'סוג קובץ לא תקין.';
				return json_encode($resulte);
			}
			$file = DB::table('apps_file')->where('id', '=', $request->fileID)->first();
			$url = public_path('upload')."\\".$file->url;
			if( file_exists($url) ){
				unlink($url);
			}
			$newname = $newfile->getClientOriginalName();
			$newfilename = uniqid().'_'.time() . '.' . $newfile->getClientOriginalExtension();

			$newfile->move(public_path('upload'), $newfilename);
			$res = DB::table('apps_file')
				->where('id', $request->fileID)
				->update(['url' => $newfilename, 'file_name'=> $newname.'^^'.explode('^^', $file->file_name)[1], 'status' => 3]);
			$file = DB::table ('apps_file')->where ('id', '=', $request->fileID)->first ();
			if ($file->type != 'pdf') {
				$file_arr = explode ('^^', $file->file_name);
				if (isset($file_arr[1])) {
					$file_name = $file_arr[1];
				} else {
					$file_name = $file->file_name;
				}
			} else {
				$file_name = $file->file_name;
			}
			$formsTable = Forms::getFFF ();
			$logText = ' מסמך לצירוף '. (isset($formsTable[$file_name]) ? $formsTable[$file_name] : $file_name) .' הושלם על ידי המועמד ';
			DB::table ('apps_logs')->insert ([
				['app_id' => $file->app_id, 'description' => $logText]
			]);
			$resulte['text'] = 'הקובץ השתנה בהצלחה ';
			$resulte['file_name'] = $newname;
			return json_encode($resulte);
		}else{
			$resulte['error'] = 'error';
			return json_encode($resulte);
		}
	}
}
