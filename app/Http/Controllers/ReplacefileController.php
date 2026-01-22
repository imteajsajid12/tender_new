<?php

namespace App\Http\Controllers;
//use DB;
use App\Forms;
use App\Services\EncryptionService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReplacefileController extends Controller
{
	/**
	 * @var EncryptionService
	 */
	protected $encryptionService;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(EncryptionService $encryptionService)
	{
		$this->encryptionService = $encryptionService;
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
			// Decrypt file_name for display
			$decryptedFileName = $this->encryptionService->decrypt($file->file_name);
			$filename_0=explode('^^', $decryptedFileName)[0];
			$filename=explode('^^', $decryptedFileName)[1] ?? $decryptedFileName;
			$filetitle=isset($statuses[$filename])?$statuses[$filename]:'';

			// Create a modified file object with decrypted values for the view
			$file->file_name = $decryptedFileName;
			$file->url = $this->encryptionService->decrypt($file->url);

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

			// Decrypt url to get actual file path for deletion
			$decryptedUrl = $this->encryptionService->decrypt($file->url);
			$url = public_path('upload')."\\".$decryptedUrl;
			if( file_exists($url) ){
				unlink($url);
			}
			$newname = $newfile->getClientOriginalName();
			$newfilename = uniqid().'_'.time() . '.' . $newfile->getClientOriginalExtension();

			$newfile->move(public_path('upload'), $newfilename);

			// Decrypt existing file_name to get the label part
			$decryptedFileName = $this->encryptionService->decrypt($file->file_name);
			$fileNameParts = explode('^^', $decryptedFileName);
			$newFileNameValue = $newname.'^^'.($fileNameParts[1] ?? '');

			// Encrypt the new values before updating
			$encryptedUrl = $this->encryptionService->encrypt($newfilename);
			$encryptedFileName = $this->encryptionService->encrypt($newFileNameValue);

			$res = DB::table('apps_file')
				->where('id', $request->fileID)
				->update([
					'url' => $encryptedUrl,
					'file_name' => $encryptedFileName,
					'status' => 3,
					'encryption_key_slot' => $this->encryptionService->getCurrentKeySlot()
				]);
			$file = DB::table ('apps_file')->where ('id', '=', $request->fileID)->first ();

			// Decrypt file_name for processing
			$decryptedFileName = $this->encryptionService->decrypt($file->file_name);
			if ($file->type != 'pdf') {
				$file_arr = explode ('^^', $decryptedFileName);
				if (isset($file_arr[1])) {
					$file_name = $file_arr[1];
				} else {
					$file_name = $decryptedFileName;
				}
			} else {
				$file_name = $decryptedFileName;
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
