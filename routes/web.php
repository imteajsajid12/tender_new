<?php

use App\Http\Controllers\CronJobController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\TendersController;
use App\Http\Controllers\AppChartController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReplacefileController;
use App\Http\Middleware\CheckPermissions;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/approve/{id?}', [FormController::class, 'approve']);
Route::get('/cancel/{id?}', [FormController::class, 'cancel']);
Route::get('/approve-interview/{id?}', [FormController::class, 'approve_interview']);
Route::get('/approve-test/{id?}', [FormController::class, 'approve_test']);
Route::get('/approve-committee/{id?}', [FormController::class, 'approve_committee']);
Route::get('/approve-gotit/{id?}', [FormController::class, 'approve_gotit']);
Route::get('/testcheck/{app_id}', [FormController::class, 'checkApp']);
Route::get('/protocol-table', [FormController::class, 'protocolTable']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::get('/', 'Autdoh\LoginController@showLoginForm')->name('login');

Route::match(['get', 'post'], '/', function () {
	//echo('TEST!');
	//	return view('error.404');
});
Route::post('/check-status/check', [TendersController::class, 'check_status']);

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Two-Factor Authentication Routes
|--------------------------------------------------------------------------
|
| These routes handle the 2FA OTP verification flow.
| After successful login, users are redirected to verify OTP.
|
*/
Route::prefix('2fa')->name('2fa.')->group(function () {
    Route::get('/verify', [\App\Http\Controllers\Auth\TwoFactorController::class, 'showVerifyForm'])
        ->name('verify');

    Route::post('/verify', [\App\Http\Controllers\Auth\TwoFactorController::class, 'verify'])
        ->name('verify.submit');

    Route::post('/resend', [\App\Http\Controllers\Auth\TwoFactorController::class, 'resend'])
        ->name('resend');

    Route::get('/cancel', [\App\Http\Controllers\Auth\TwoFactorController::class, 'cancel'])
        ->name('cancel');
});

Route::get('/replacefile/{file}', [ReplacefileController::class, 'index']);

//Route::get('/replacefile/{file}/', array('middleware' => 'cors', 'uses' => 'ReplacefileController@index'));
Route::post('/replacefile',  [ReplacefileController::class, 'replace']);
//Route::post ('/replacefile', array ('middleware' => 'cors', 'uses' => [ReplacefileController::class,'replace'] ));
Route::get('/tenders/debugdecision/{decisionId?}/{decision?}', [TendersController::class, 'debugDecision']);

Route::prefix('admin')->middleware('auth')->group(function () {

	//	Route::get('/', 'DashboardController@index' );
	Route::get('/', [TendersController::class, 'list'])->middleware('auth');
	Route::get('/tender/excel-download', [TendersController::class, 'listExcelDownload'])->name('tenderListExcelDownload');

	Route::get('/tapp2/{id}', [ApplicationController::class, 'tapp2']);
	Route::get('/showapps/{formurl}', [TendersController::class, 'showapps']);
	Route::get('/getappdata/{app_id}/{pdf}', [ApplicationController::class, 'get_app_data']);
	Route::get('/chart', [AppChartController::class, 'index']);
	Route::post('/chart/get/{departments}', [AppChartController::class, 'get_chart']);
	Route::get('/export', [ApplicationController::class, 'export']);
	Route::get('/exportTenders/{tenderId?}', [TendersController::class, 'exportRegular']);
	Route::get('/exportSpec/{tenderId?}', [TendersController::class, 'exportSpec']);
	Route::get('/exportTenderStatus', [TendersController::class, 'exportTenderStatus']);
	Route::get('/exportTenderStatusBrunch', [TendersController::class, 'exportTenderStatusBrunch']);
	Route::get('/exportCandidateDetails/{tenderId}', [TendersController::class, 'exportTenderStatusBrunch']);
	Route::get('/exportTenderSorted/{tenderId}', [TendersController::class, 'exportTenderSorted']);
	Route::post('/delete_app', [ApplicationController::class, 'delete_app']);
	Route::post('/ajax/{type}', [ApplicationController::class, 'ajax']);
	Route::get('/apps', [ApplicationController::class, 'index']);
	Route::post('/send-committee-email', [TendersController::class, 'sendCommitteeEmail']);
	Route::post('/generate_pdf/{url}', [ApplicationController::class, 'generate_pdf']);
	Route::get('/clear-cache', function () {
		Artisan::call('cache:clear');
		return "Cache is cleared";
	});
	Route::post('/tenders/approve-file', [TendersController::class, 'approveFile']);
	Route::post('/tenders/addfile/{tenderId}', [TendersController::class, 'uploadFile'])->name('tenderFileupload');
	Route::get('/tenders/delete-file/{fileID}', [TendersController::class, 'delete_tender_file'])->name('tenderFileDelete');
	Route::get('/tenders/export', [TendersController::class, 'export']);
	Route::get('/tenders/cvfiledownload/{tenderid?}', [TendersController::class, 'cvDownloadZip']);

	Route::post('/adduserdecision', [TendersController::class, 'adduserdecision']);
	Route::post('/deluserdecision', [TendersController::class, 'deluserdecision']);
	Route::post('/tenders/cancelfile', [TendersController::class, 'cancel_file']);
	Route::post('/reqadd/{decisionId}', [TendersController::class, 'reqAdd_file']);
	Route::post('/upload-file/{applicationid?}', [TendersController::class, 'upload_file']);
	Route::post('/upload-test-file/{applicationid}', [TendersController::class, 'upload_test_file']);
	Route::post('/delete-test-file/{fileid}', [TendersController::class, 'delete_test_file']);
	Route::post('/tenders/create', [TendersController::class, 'create']);
	Route::post('/tenders/gettenderdata/{tenderid}', [TendersController::class, 'getTenderDataAjax']);
	Route::post('/tenders/updatetender/{id}', [TendersController::class, 'updateTender']);
	Route::post('/tenders/list', [TendersController::class, 'list']);
	Route::get('/tenders/{filter?}', [TendersController::class, 'list']);
	Route::get('/tenderlogs/{id}', [TendersController::class, 'getlog']);
	Route::get('/ttenderlogs/{id}', [TendersController::class, 'getTenderLog']);
	Route::post('/findusers', [UsersController::class, 'findUsersByTxt']);

	Route::post('/add/tenderlog/{id}', [TendersController::class, 'addTenderLog'])->name('addTenderLog');


	//Route::get('/tenders/requests/{tenderid}', 'TendersController@requests');
	//Route::get('/tenders/requests', 'TendersController@Allrequests');
	Route::get('/tenders/requestsorted/{sort}/{tenderid?}', [TendersController::class, 'requestssorted']);
	Route::get('/tenders/application/{applicationid}', [TendersController::class, 'viewapplication']);

	Route::post('/tender-decision/{tender}/store', [TendersController::class, 'saveDecision'])->name('saveDecision');

	// change test result

	Route::post('/tenders/stepBackDecision', [TendersController::class, 'stepBackDecision']);
	//Route::post ('/tenders/stepbacksecond', [TendersController::class,'stepBackSecond']);

	Route::post('/tenders/application/test-result/change/{applicationid}', [TendersController::class, 'changeTestResult'])->name('tender-application.changeTestResult');
	Route::post('/tenders/application/test-result/grade-save/{applicationid}', [TendersController::class, 'gradeSave'])->name('tender-application.gradeSave');
	Route::post('/tenders/application/{applicationid}/start', [TendersController::class, 'markStarApplication'])->name('tender-application.start');

	Route::post('/tenders/getnewid', [TendersController::class, 'getNewTenderId']);
	Route::post('/tenders/stop/{tenderid}', [TendersController::class, 'stopTender'])->name('stopTender');
	Route::post('/tenders/continue/{tenderid}', [TendersController::class, 'continueTender']);
	Route::post('/tenders/dub/{tenderid}', [TendersController::class, 'dubTender']);
	Route::post('/tenders/del/{tenderid}', [TendersController::class, 'delTender']);
	Route::post('/tenders/save/{tenderid}', [TendersController::class, 'saveTender']);
	Route::post('/tenders/decision/{decisionId?}/{decision?}', [TendersController::class, 'sendDecision']);
	Route::get('/tenders/decision/{decisionId?}/{decision?}', [TendersController::class, 'sendDecision']);

	Route::post('/tenders/decision-maker/add/{tenderId}', [TendersController::class, 'decisionMakerAdd'])->name('decisionMakerAdd');

	Route::get('/tenders/decision-maker/edit/{tenderId}', [TendersController::class, 'decisionMakerEdit'])->name('decisionMakerEdit');
	Route::post('/tenders/decision-maker/update/{maker}', [TendersController::class, 'decisionMakerUpdate'])->name('decisionMakerUpdate');
	Route::post('/tenders/decision-maker/delete/{maker}', [TendersController::class, 'decisionMakerDelete'])->name('decisionMakerDelete');




	Route::get('/apps/{app}', [ApplicationController::class, 'singleapp']);
	Route::get('/apps/{app}/file-download', [ApplicationController::class, 'downloadZip']);
	Route::get('/tenders/{did}/file-download', [TendersController::class, 'downloadZip']);

	Route::post('/tenders/{did}/file-send/custom-mail', [TendersController::class, 'customMailFileSend'])->name('customMailFileSend');


	Route::group(['prefix' => 'users'], function () {
		Route::get('/', [UsersController::class, 'index']);
		Route::get('/autocomplete_users', [UsersController::class, 'autocomplete']);
		Route::post('/get-create-user-form', [UsersController::class, 'get_add_area']);
		Route::post('/create-user', [UsersController::class, 'create_user']);
		Route::post('/edit-area/{id}', [UsersController::class, 'get_edit_area']);
		Route::post('/edit-user/{id}', [UsersController::class, 'edit_user']);
		Route::post('/edit-user/{id}/get-apppermissions-html', [UsersController::class, 'get_apppermissions_html']);
	})->middleware(CheckPermissions::class);
	Route::prefix('template')->name('template.')->group(function () {
		Route::get('/', [TemplateController::class, 'index'])->name('list');

		// duplicate
		Route::get('/duplicate/{template}', [TemplateController::class, 'edit'])->name('duplicate.create');
		Route::post('/duplicate/{template}/create', [TemplateController::class, 'duplicate'])->name('duplicate.store');
		Route::get('{template}/download', [TemplateController::class, 'download'])->name('download');
		Route::get('{template}/view', [TemplateController::class, 'view'])->name('view');
		Route::get('{template}/delete', [TemplateController::class, 'delete'])->name('delete');

		Route::get('{template}', [TemplateController::class, 'edit'])->name('edit');
		Route::post('{template}/update', [TemplateController::class, 'update'])->name('update');
	});
});

/*Route::get('/clear', function () {

    Artisan::call('route:clear');

});
Route::get('/email', function () {

    Mail::to('sbuckler123@gmail.com')->send(new SendMailable('test',array(),'app','test'));
    return response()->json(['message' => 'Email sent successfully.']);

});*/

Route::get('/check-status', function () {
	return view('forms.check-status', [
		'pageTitle' => 'בדיקת מצב הפניה',
	]);
});
Route::get('/not-active', function () {
	return view('forms.not-active', [
		'pageTitle' => 'בדיקת מצב הפניה',
	]);
});
Route::post('/check-status/stop-app/{id}', [TendersController::class, 'check_status_stop']);

Route::get('/cron/tender-file-reject-mail-notification', [CronJobController::class, 'tenderFileCanceledMailA2D']);
Route::get('/cron/resend-invitation', [CronJobController::class, 'reSentInvitationAll']);
Route::get('/cron/resend-invitation/{app_id?}', [CronJobController::class, 'reSentInvitation']);


// Route
Route::get('/{formurl}/{id?}', [FormController::class, 'index']);
#Route::post('/{formurl}/{iddd?}/create','FormController@create');
Route::post('/{formurl}/create', [FormController::class, 'create']);
Route::get('/{formurl}/erur/{id}', [FormController::class, 'erur']);
Route::post('/{formurl}/erur/{id}/create', [FormController::class, 'create']);
Route::get('/{formurl}/success/{decisionId}', [TendersController::class, 'success_add_app']);
Route::get('/{formurl}/erur/{id}/success/{filename}', [FormController::class, 'success_add_app_erur']);

Route::post('/{formurl}/level_b/{id}/create', [FormController::class, 'create_level_b']);
Route::get('/{formurl}/level_b/{id}/success/{filename}/{employer_type}', [FormController::class, 'success_add_app_level_b']);
Route::get('/{formurl}/level_b/{id}', [FormController::class, 'level_b']);
