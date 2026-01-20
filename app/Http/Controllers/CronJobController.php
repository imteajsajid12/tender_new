<?php

namespace App\Http\Controllers;

use App\Applications;
use App\Models\AppDecisions;
use App\Models\TenderFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CronJobController extends Controller
{
    // canceled file email after two day

    function __construct(){
        
    }

    function tenderFileCanceledMailA2D(){
        $canceled_mail = DB::table('apps_file')
        ->whereNotNull('canceled_at')
        ->where('status',2)
        ->where('canceled_at' , '<=',now()->subMinutes(5))
        // ->ddRawSql()
        ->get();

        $email_count = 0;
        foreach ($canceled_mail as $key => $app) {
            $tc = new TendersController();
            if(DB::table('applications')->where('id', '=', $app->app_id)->exists()){
                $tc->cancel_file2($app->app_id,$app->id,'Two day have passed, but still you didn\'t submit your reject file. Please resubmit it.');
                $email_count++;
            }
            
        }
        echo $email_count." mail has been sent";

        // File::append(public_path('upload/test_cron.txt'),"\n[".now()."] (tenderFileCanceledMailA2D) ".$email_count." mail has been sent");
    }

    function reSentInvitationAll(Request $request){
        // 2nd invitation
        $applications = AppDecisions::
        whereNotNull('last_committee_invitation_send')
        ->where('last_committee_invitation_send','<=' , now()->subMinutes(5))
        ->whereNull('committee_invitation_approved_time')
        ->whereNot('invitation_rejected_by_user',1)
        ->get();
        foreach ($applications as $key => $app) {
            print_r($this->reSent2ndInvitation($request,$app->id));
        }

        echo '<br>------------------------------------------------- <br>';


        // 1st invitation

        $applications = AppDecisions::
        whereNotNull('last_interview_invitation_send')
        ->where('last_interview_invitation_send','<=' , now()->subMinutes(5))
        ->whereNull('approved_interview_time')
        ->whereNot('invitation_rejected_by_user',1)
        ->whereNull('approved_interview_place')->get();
        foreach ($applications as $key => $app) {
            print_r($this->reSent1stInvitation($request,$app->id));
        }

        // File::append(public_path('upload/test_cron.txt'),"\n[".now()."] (reSentInvitationAll) ".$applications->count()." Invitation has been sent");

    }

    function reSent2ndInvitation(Request $request, $app_id = null){
        $app = AppDecisions::find($app_id);
        if(!$app->approved_committee_time){
            return response([
                'error' => true,
                'message' => 'Send the 2nd invitation from admin panel first!',
                'application_id' => $app_id
            ]);
        }
        $request->merge([
            'type' => 'committee',
            'committee' => 'ועדת בחינה',
            'id' => $app_id,
            'appid' => $app_id,
            'committee_date' => now()->parse($app->approved_committee_time)->format('d m, Y'),
            'committee_time' => now()->parse($app->approved_committee_time)->format('H:i'),
            'committee_place' => $app->committee_selected_place,
            'resend' => true
        ]);

        $res = Applications::email_to_user($request);
        if ($res == 'error'){
            $meta_data[] = ['app_id' => $request->id, 'meta_name' => 'email_msg', 'meta_value' => 'אירעה שגיאה בשליחת מייל'];
            \App\Forms::insert_meta($meta_data);
        } 
        return $res;
    }


    function reSent1stInvitation(Request $request, $app_id = null){
        $app = AppDecisions::find($app_id);
        if(!$app->last_interview_invitation_send){
            return response([
                'error' => true,
                'message' => 'Send the first invitation from admin panel',
                'application_id' => $app_id
            ]);
        }
        $request->merge([
            'type' => 'test',
            'id' => $app_id,
            'appid' => $app_id,
            'test_date' => json_decode($app->selected_interview_time),
            'test_time' => '',
            'test_place' => json_decode($app->selected_interview_place),
        ]);

        $res = Applications::email_to_user($request);
        if ($res == 'error'){
            $meta_data[] = ['app_id' => $request->id, 'meta_name' => 'email_msg', 'meta_value' => 'אירעה שגיאה בשליחת מייל'];
            \App\Forms::insert_meta($meta_data);
        } 
        return $res;
    }
}
