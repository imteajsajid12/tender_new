<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Applications;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Exports\FormsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Jurosh\PDFMerge\PDFMerger;
use ZipArchive;
use Imagick;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class ApplicationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index() {
		Storage::disk('public')->delete('images/loader.gif');
        $applications = Applications::get_all_applications();
		return view('applications',[
            'applications' => $applications,
            'submenu' => Applications::app_submenu_html( ),
            'pageTitle' => 'פניות'
        ]);
    }
    public function singleapp($id) {
    	//var_dump($id);
        $user = auth()->user();
        $role  = Applications::get_user_forms( $user->id );
        $application = Applications::find($id);
	    //echo('<br/>');
	   // echo('!!');
	   // var_dump($role);
       // echo('<br/>');
        //var_dump($application->form_id);
       // echo('!!');

      //  if($application && in_array($application->form_id, $role) ){
            $apps_meta  = Applications::get_all_meta($id);
            $application->pdf_file = Applications::get_pdf_file($id);
            $application->apps_meta = $apps_meta;
            $application->st = $application->status;
            $application->status = Applications::get_status($application->status);
            $application->files = Applications::get_file_byAppID($id);
            if($application->st > 2){
                $application->appusers = Applications::user_inappp_html( $id );
            }
            if ($application->st > 5) {
                $application->erur_files = Applications::get_files_by_type($id, 'erur');
            }

            return view('singleApp.application-single',[
                'application' => $application,
                'pageTitle' => 'פניות'
            ]);

       /* }else{

            return view('singleApp.application-none',[
                    'application' => $application,
                    'pageTitle' => 'None'
            ]);
        }*/
    }

    public function ajax(Request $request, $type){
        $user = auth()->user();
        switch ($type) {
            case 'approve-file':
                    $res = Applications::approve_file($request);
                    echo $res;
                break;
            case 'cancel-file':
                    $res = Applications::cancel_file($request);
                    echo $res;
                break;
			case 'update-file':
                    $res = Applications::update_file($request);
                    echo $res;
                break;
            case 'send-all-mails':
                    $res = Applications::send_all_mails($request);
                    echo $res;
                break;
            case 'show-log':
                    $res = Applications::get_app_logs($request);
                    echo $res;
                break;
            case 'add-user-inappp':
                    $res = Applications::add_user_inappp($request);
                    echo $res;
                break;
            case 'remove-user-inappp':
                    $res = Applications::remove_user_inappp($request);
                    echo $res;
                break;
				case 'add-user-outapp':
                    $res = Applications::add_user_outapp($request);
                    echo $res;
                break;
				case 'remove-user-outapp':
                    $res = Applications::remove_user_outapp($request);
                    echo $res;
                break;
            case 'actions-form':
                    $res = Applications::actions_form($request);
                    echo $res;
                break;
            case 'saverow':
                $res = Applications::saverow($request);
                echo $res;
                break;
			case 'email-to-user':
                $res = Applications::email_to_user($request);
				if ($res == 'error'){
					$meta_data[] = ['app_id' => $request->id, 'meta_name' => 'email_msg', 'meta_value' => 'אירעה שגיאה בשליחת מייל'];
					\App\Forms::insert_meta($meta_data);
				} 
				return $res;
			case 'cvmail':
				return $this->cv_marge($request->tenderid);
				
			case 'send-all-decision':
				$res = Applications::send_all_decision($request);
				if ($res == 'error'){
					$meta_data[] = ['app_id' => $request->id, 'meta_name' => 'email_msg', 'meta_value' => 'אירעה שגיאה בשליחת מייל'];
					\App\Forms::insert_meta($meta_data);
				} 
				return $res;
            default:
               echo "no type";
        }
    }

	public function generate_pdf(Request $request, $url) {
		$resulte = array();
		$form = \App\Forms::where([
			['url', '=', $url],
			['status', '=', '1'],
		])->first();
		empty($form) ? $resulte['error'] = 'אירעה שגיאה לא צפויה, אנא רענן את הדף ונסה שוב עכשיו או אחר כך.' : $resulte = Applications::generate_pdf($request, $form);
		return json_encode($resulte);
	}
	
    public function downloadZip($id)
    {
        $zip = new ZipArchive;
        $fileName = date('Y').$id.'files.zip';
        //Storage::deleteDirectory(public_path('upload/zip'));
        if ($zip->open(public_path('upload/zip/'.$fileName), ZipArchive::CREATE) === TRUE)
        {
            $files = DB::table('apps_file')
               ->where( 'app_id', '=', $id )
               ->get();
            $filespath = public_path('upload');

            foreach ($files as $key => $file) {
                $name = basename($file->url);
                $zip->addFile($filespath.'/'.$file->url, $name);
            }

            $zip->close();
        }

        return response()->download(public_path('upload/zip/'.$fileName))->deleteFileAfterSend(true);

    }

    public function export()
    {
        return Excel::download(new FormsExport, 'export.xlsx');
    }

    public function delete_app(Request $request)
    {
        $res = Applications::delete_app($request);
        echo $res;
    }
	
	public static function get_app_data(Request $request){
		$app_id = $request->app_id;
		$pdf = $request->pdf;
		//var_dump('$pdf:'.$pdf);
		$file_meta = DB::table('apps_meta')->where([
			['app_id', '=', $app_id],
			['meta_value', '=', $pdf]
		])->first();
		//var_dump('$file_meta->id'.$file_meta->id);
		$id = $file_meta->id - 1;
		$app = DB::table('apps_meta')->where([
			['id', '=', $id],
			['meta_name', '=', 'data']
		])->first();
		//var_dump('$app->meta_value'.$app->meta_value);
	    if(empty($app->meta_value))  return 'error';
	    return $app->meta_value;
    }
	
	public function tapp2 (Request $request) {
		$id = $request->id;
		$file = DB::table ('apps_file')
			->where ('id', '=', $id)
			->first ();
		if (!$file) return exit();
		if ($file->url) {
			$filenameh = public_path ('upload/' . str_replace ('.pdf', '.html', $file->url));
			$filenamef = public_path ('upload/' . str_replace ('.pdf', '.json', $file->url));
			if (file_exists ($filenameh) && file_exists ($filenamef)) {
				$html = file_get_contents ($filenameh);
				$form = json_decode (file_get_contents ($filenamef));
		
			header ("Content-type: application/vnd.ms-word");
				header ("Content-Disposition: attachment;Filename=document_name.doc");
				return View ('pdf.form', [
					'formhtml' => $html,
					'form' => $form,
				]);
			}
		}
	}
	
	public function cv_marge ($did) {
		Log::debug('start==$did'.$did);
		$tender = DB::table('tenders_applications')->select()->where('generated_id', '=', $did)->orderby('id', 'desc')->get();	
		//Log::debug(count($tender));
		$filespath = public_path ('upload');
		$marge_file = 'file.pdf';
		$marge_file_path = public_path ('/'.$marge_file);
		$marge_file_img = 'file_img.pdf';
		$marge_file_img_path = public_path ('/'.$marge_file_img);
		$marge_file_doc = 'file_doc.pdf';
		$marge_file_doc_path = public_path ('/'.$marge_file_doc);									
		if (file_exists($marge_file_path)) {
			unlink($marge_file_path);
		}
		if (file_exists($marge_file_img_path)){
			unlink($marge_file_img_path);
		}
		if (file_exists($marge_file_doc_path)){
			//unlink($marge_file_doc_path);
		}
		$images = array();
		$pdf = new PDFMerger();
		$did_arr = explode('-', $did);
		//Log::debug(json_encode($did_arr));
		if (!empty($did_arr[1])){
			$meta_value = DB::table('apps_meta')
					->where([
						['app_id', '=', $did_arr[1]],
						['meta_name', '=', 'upload_admin_file']
					])
					->first();
			if (isset($meta_value?->meta_value)){
				$pdf->addPDF($filespath . '/admin/' . $meta_value->meta_value, 'all');
			}
			foreach ($tender as $key => $t){
				//Log::debug('$t->id.$key'.$key.$t->id);
				//Log::debug('$t->p5_id.$key'.$key.$t->p5_id);
				$approve_value = '';			
				$approve_value = Applications::get_meta_value($t->id, 'email_msg_committee_approve');
				if ($approve_value != ''){
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
						if ($file_1 != '' && $file_1 == 'קורות חיים' && ($t->app_status == 'Interview' || $t->app_status == 'Accepted') && $approve_value != '') {
							Log::debug('$file_name'.$file_name);
							$is_download = true;
							Log::debug('BBB=$file_1'.$file_1.'==='.$t->id.'==='.$t->p5_id);
							if( file_exists($filespath . '/' . $file->url) ){
								if (strpos($file->url, 'jpg') || strpos($file->url, 'png') || strpos($file->url, 'jpeg')){
									array_push($images, $filespath . '/' . $file->url);
								}
								else if (strpos($file->url, 'docx') || strpos($file->url, 'doc') !== false) {
									$myfile = fopen($filespath . '/' . $file->url, "rb") or die("Unable to open file!");
									$txt = '%PDF-1.7'.PHP_EOL.'stream'.PHP_EOL.fread($myfile,filesize($filespath . '/' . $file->url)).PHP_EOL.'endstream'.PHP_EOL.'xref'.PHP_EOL.'0 2'.PHP_EOL.'0000000000 65535 f'.PHP_EOL.'0000000009 00000 n'.PHP_EOL.'startxref'.PHP_EOL.filesize($filespath . '/' . $file->url).PHP_EOL.'%%EOF';
									fwrite($myfile, $txt);
									fclose($myfile);
									
									$myfile1 = fopen($marge_file_doc_path, "wb") or die("Unable to open file!");
									fwrite($myfile1, $txt);//
									$pdf->addPDF($marge_file_doc_path, 'all');
									fclose($myfile1);
									//header ("Content-type: application/octet-stream");
									//header ("Content-Disposition: attachment;Filename=document_name.doc");
									/*
									$word = new COM("Word.Application") or die ("Could not initialise Object.");
									// set it to 1 to see the MS Word window (the actual opening of the document)
									$word->Visible = 0;
									// recommend to set to 0, disables alerts like "Do you want MS Word to be the default .. etc"
									$word->DisplayAlerts = 0;
									// open the word 2007-2013 document 
									$word->Documents->Open($file->url);
									// save it as word 2003
									$word->ActiveDocument->SaveAs('newdocument.doc');
									// convert word 2007-2013 to PDF
									$word->ActiveDocument->ExportAsFixedFormat($marge_file_doc_path, 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
									// quit the Word process
									$word->Quit(false);
									// clean up
									unset($word);
									*/
								} 
								else {
									//Log::debug('addPDF'.$file->url);
									$pdf->addPDF($filespath . '/' . $file->url, 'all');
								}
							} 
							if (file_exists($filespath . '/admin/' . $file->url)) {
								//Log::debug('admin:'. $file->url);
								//if (strpos($file->url, 'docx') || strpos($file->url, 'doc') !== false) {
								//header ("Content-type: application/vnd.ms-word");
								//header ("Content-Disposition: attachment;Filename=document_name.doc");
								//} else {
								$pdf->addPDF($filespath . '/admin/' . $file->url, 'all');
								//}
							}
						}
					}								
				}			
			}
		}
		if (isset($is_download)){
			if(count($images) > 0){
				$pdf1 = new Imagick($images);
				$pdf1->setImageFormat('pdf');
				$pdf1->writeImages($marge_file_img_path, true);
			}			
			
			$to = explode(',', env('ADMIN_EMAILS'));
			$files = array();
			if (file_exists($marge_file_path)){
				array_push($marge_file_path);
			}
			if (file_exists($marge_file_img_path)){
				array_push($files, $marge_file_img_path);
				$pdf->addPDF($marge_file_img_path);
			}
			if (file_exists($marge_file_doc_path)){
				array_push($files, $marge_file_doc_path);
				$pdf->addPDF($marge_file_doc_path);
			}
			$pdf->merge('file', $marge_file_path);
			//Mail::to($to)->send(new SendMailable('ראה קורות חיים מצורפים 😊', $files, 'app', 'משאבי אנוש - עיריית רמת גן'));
			Applications::sendmail($to, 'ראה קורות חיים מצורפים 😊', 'app', $marge_file_path, 'משאבי אנוש - עיריית מעלה אדומים');
			return 'מייל נשלח בהצלחה';
		} else {
			return 'מייל לא נשלח';
		}
	}
	
		
	
	
}
