<?php

namespace App;

use App\Models\AppDecisions;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
//use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Services\EncryptionService;
//use PDF;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Carbon\Carbon;
use Jurosh\PDFMerge\PDFMerger;
use Imagick;

class Applications extends Model
{
    public static $status_arr = array('ממתין לטיפול', 'ממתין למסמכים', 'ממתין לאישור מסמך חדש', 'ממתין לאישור תקציבן', 'ממתין לאישור גזבר/סגן גזבר', 'ממתין לאישור משאבי אנוש', 'אושר', 'נדחה');

    public static $instypes = array('school' => 'בתי ספר', 'childrengarden' => 'גני ילדים', 'initial' => 'חינוך יסודי', 'high' => 'חינוך על יסודי', 'hr' => 'משאבי אנוש');


    public static $status_arr1 = array(
        "All" => "הכל",
        "New" => "ממתין לטיפול",
        'newfiles' => 'ממתין למסמכים', // Waiting for files !
        "Waiting for files" => 'ממתין לאישור מסמך חדש', //waiting for approve new file !
        "Waiting" => 'ממתין לאישור עמידה בתנאי סף',
        "Interview" => 'עבר תנאי סף ממתין לזימון',
        "Committee" => 'ממתין למכרז',
        'Rejected due to conditions' => 'נדחה שלב א\'',
        'Accepted' => 'אושר',
        'Rejected' => 'נדחה',
        'RejUser' => 'פניה שנעצרה',
        'canceled' => 'פנייה שנעצרה'
    );


    public static function delete_app($request)
    {
        //exit;
        if (empty($request->id)) {
            return;
        }
        $id = $request->id;
        $dec = DB::table('app_decisions')->where('id', '=', $id)->first();
        if ($dec->id && $dec->p5_id) {
            //$applicationsArr = ['p5_id'=>$dec->p5_id];

            /*$files = DB::table ('apps_file')
				->whereRaw ('app_id in (?,?,?)', [$dec->p1_id, $dec->p2_id, $dec->p3_id])
				->get ();

		foreach ($files as $key => $file) {
            $url = public_path('upload/').$file->url;
            if( file_exists($url) ){
                unlink($url);
            }
        }

		$apps_meta = DB::table ('apps_meta')
				->whereRaw ('app_id in (?,?,?) and meta_name like "metaJson"', [$dec->p1_id, $dec->p2_id, $dec->p3_id])
				->get ();

		$applications = DB::table ('applications')
				->whereRaw ('id in (?,?,?)', [$dec->p1_id, $dec->p2_id, $dec->p3_id])
				->get ();*/




            //	DB::table('apps_logs')->where('app_id', '=', $page_app_id)->delete()


            $files = DB::table('apps_file')
                ->where([
                    ['app_id', '=', $dec->p5_id],
                ])->get('url');

            $files = DB::table('apps_file')
                ->whereRaw('app_id in (?)', [$dec->p5_id])
                ->get('url');

            foreach ($files as $key => $file) {

                $url = public_path('upload/') . $file->url;
                if (file_exists($url)) {
                    unlink($url);
                }
            }
            DB::table('apps_file')->where('app_id', '=', $dec->p5_id)->delete();


            $apps_meta = DB::table('apps_meta')
                ->whereRaw('app_id = (?) and meta_name like "metaJson"', $dec->p5_id)
                ->delete();
            DB::table('applications')->where('id', '=', $dec->p5_id)->delete();




            DB::table('apps_meta')
                ->whereRaw('(app_id = ?) AND (meta_name LIKE "%email_msg%" OR meta_name LIKE "%email_msg_interview%" OR meta_name LIKE "%interview_email%" OR meta_name LIKE "%email_msg_test%" OR meta_name LIKE "%committee_email%" OR meta_name LIKE "%committee_date%" OR meta_name LIKE "%email_msg_gotit%")', $dec->id)
                ->delete();

            DB::table('apps_logs')->where('app_id', '=', $dec->id)->delete();

            DB::table('app_decisions')->where('id', '=', $dec->id)->delete();

            return 'success';
        } else {
            return 'Application not found';
        }
    }



    public static function get_all_meta($id)
    {
        if ($id) {
            $app_meta = DB::table('apps_meta')
                ->where('app_id', '=', $id)
                ->get();
            $data = array();
            foreach ($app_meta as $key => $value) {
                $data[$value->meta_name]  = $value->meta_value;
            }
            return $data;
        }
        return false;
    }

    public static function get_meta_value($app_id, $meta_name)
    {
        $meta_value = DB::table('apps_meta')
            ->where([
                ['app_id', '=', $app_id],
                ['meta_name', '=', $meta_name],
            ])->first();
        return $meta_value ? $meta_value?->meta_value : '';
    }

    public static function get_files_by_type($app_id, $type = array())
    {
        if ($app_id && !empty($type)) {
            $files = DB::table('apps_file')
                ->where([
                    ['app_id', '=', $app_id],
                    ['type', '=', $type],
                ])->get();
            return $files;
        }
        return false;
    }
    public static function get_file($app_id, $type)
    {
        if ($app_id && !empty($type)) {
            $files = DB::table('apps_file')
                ->where([
                    ['app_id', '=', $app_id],
                    ['type', '=', $type],
                ])
                ->get();
            return $files;
        }
        return false;
    }

    public static function get_file_byAppID($app_id)
    {
        if ($app_id && !empty($app_id)) {
            $files = DB::table('apps_file')
                ->where([
                    ['app_id', '=', $app_id],
                    ['type', '!=', 'pdf'],
                    ['type', '!=', 'erur']
                ])
                ->get();
            return $files;
        }
        return false;
    }

    public static function get_pdf_file($app_id)
    {
        if ($app_id) {
            $files = DB::table('apps_file')
                ->where([
                    ['app_id', '=', $app_id],
                    ['type', '=', 'pdf'],
                ])->first();
            return $files;
        }
        return false;
    }
    public static function getformfile($app_id)
    {
        if ($app_id) {
            $files = DB::table('apps_file')
                ->where([
                    ['app_id', '=', $app_id],
                    ['type', '=', 'pdf'],
                    ['file_name', '=', 'form.pdf'],
                ])->get();
            return $files;
        }
        return false;
    }

    public static function get_all_files($app_id)
    {
        if ($app_id) {
            $files = DB::table('apps_file')
                ->where([
                    ['app_id', '=', $app_id]
                ])->get();
            return $files;
        }
        return false;
    }
    public static function get_all_fileswoforms($app_id)
    {
        if ($app_id) {
            $files = DB::table('apps_file')
                ->where([
                    ['app_id', '=', $app_id],
                ])->get();

            // Decrypt file_name and filter out 'form.pdf' of type 'pdf'
            $encryptionService = app(\App\Services\EncryptionService::class);
            $filtered = [];
            foreach ($files as $f) {
                $decryptedName = $encryptionService->decrypt($f->file_name);
                if (!($decryptedName === 'form.pdf' && $f->type === 'pdf')) {
                    $f->file_name = $decryptedName;
                    $filtered[] = $f;
                }
            }
            return collect($filtered);
        }
        return false;
    }
    public static function get_apps_data($app_id)
    {
        if ($app_id) {
            $all_meta = self::get_all_meta($app_id);
            $first = DB::table('apps_meta');
            //            $app = DB::table('applications')
            //                 ->join('apps_meta', 'applications.id', 'apps_meta.app_id')
            //                // ->select('applications.*', 'apps_meta.*','apps_file.*')
            //                ->where('applications.id', $app_id)
            //                ->get();
            $app = DB::select(DB::raw("SELECT app.id,app_meta.meta_name,app_meta.meta_value AS applic FROM applications app
                                    INNER JOIN apps_meta app_meta ON app.id=app_meta.app_id
                WHERE app.id = 61"));
            return $app;
        }
    }
    public static function update_app_status_byFileid($id, $status)
    {
        $file = DB::table('apps_file')->where('id', '=', $id)->first();
        if ($file->app_id) {
            DB::table('applications')
                ->where('id', $file->app_id)
                ->update(['status' => $status]);
        }
    }
    public static function update_app_status_byId($id, $status)
    {
        if ($id) {
            DB::table('applications')
                ->where('id', $id)
                ->update(['status' => $status]);
        }
    }
    public static function get_all_file_status($id)
    {
        $file = DB::table('apps_file')->where('id', '=', $id)->first();
        if ($file->app_id) {
            $files = DB::table('apps_file')
                ->where('app_id', '=', $file->app_id)
                ->get();
            foreach ($files as $file) {
                if ($file->status != 1) {
                    return false;
                }
            }
        } else {
            return false;
        }
        return true;
    }

    public static function erur_files_statuses($id)
    {
        $files = DB::table('apps_file')
            ->where([
                ['app_id', '=', $id],
                ['type', '=', 'erur']
            ])->get();
        if (empty($files)) return false;

        foreach ($files as $file) {
            if ($file->status != 1) {
                return false;
            }
        }
        return true;
    }

    public static function get_json($app_id, $key)
    {
        $metaJson = unserialize(self::get_meta_value($app_id, 'metaJson'));
        if (isset($metaJson[$key])) {
            return $metaJson[$key];
        } else {
            return '';
        }
    }
    public static function get_status($status = '')
    {
        $status_array = self::$status_arr;
        if (!empty($status_array[$status])) {
            return $status_array[$status];
        } else {
            return $status;
        }
    }

    public static function get_status1($status = '')
    {
        $status_array = self::$status_arr1;
        if (!empty($status_array[$status])) {
            return $status_array[$status];
        } else {
            return $status;
        }
    }

    public static function get_export_headings($form_id = 0)
    {
        $user = auth()->user();
        $form_id = self::show_export(true);
        $headings = [
            [0],
            [
                "year" => "לשנה\"ל",
                "pn1+pf1" => "הורה1:",
                "identity_number" => "מספר זהות:",
                "mobile_phone1_select+mobile_phone1" => "נייד:",
                "addres1+addres11+addres12" => "כתובת:",
                "pn2+pf2" => "הורה2:",
                "id_number2" => "מספר זהות:",
                "mobile_phone2_select+mobile_phone2" => "נייד:",
                "addres2+addres21+addres22" => "כתובת:",
                "num_children" => "מס’ הילדים עבורם אבקש אישור לימודי חוץ:",
                "cn1+cf1" => "ילד/ה 1:",
                "id1" => "מספר זהות:",
                "date_birth1" => "תאריך לידה:",
                "frametype1" => "סוג מסגרת:",
                "educational_framework1" => "מסגרת חינוכית:",
                "grade1" => "כיתה:",
                "current1" => "שם מוסד לימודים נוכחי:",
                "abroad_certificat1" => "מבקשים לקבל אישור לימודי חוץ לבית הספר :",
                "auth_nam1" => "שם הרשות:",
                "cn2+cf2" => "ילד/ה 2:",
                "id2" => "מספר זהות:",
                "date_birth2" => "תאריך לידה:",
                "frametype2" => "סוג מסגרת:",
                "educational_framework2" => "מסגרת חינוכית:",
                "grade2" => "כיתה:",
                "current2" => "שם מוסד לימודים נוכחי:",
                "abroad_certificat2" => "מבקשים לקבל אישור לימודי חוץ לבית הספר :",
                "auth_nam2" => "שם הרשות:",
                "cn3+cf3" => "ילד/ה 3:",
                "id3" => "מספר זהות:",
                "date_birth3" => "תאריך לידה:",
                "frametype3" => "סוג מסגרת:",
                "educational_framework3" => "מסגרת חינוכית:",
                "grade3" => "כיתה:",
                "current3" => "שם מוסד לימודים נוכחי:",
                "abroad_certificat3" => "מבקשים לקבל אישור לימודי חוץ לבית הספר :",
                "auth_nam3" => "שם הרשות:",
                "cn4+cf4" => "ילד/ה 4:",
                "id4" => "מספר זהות:",
                "date_birth4" => "תאריך לידה:",
                "frametype4" => "סוג מסגרת:",
                "educational_framework4" => "מסגרת חינוכית:",
                "grade4" => "כיתה:",
                "current4" => "שם מוסד לימודים נוכחי:",
                "abroad_certificat4" => "מבקשים לקבל אישור לימודי חוץ לבית הספר :",
                "auth_nam4" => "שם הרשות:",
                "cn5+cf5" => "ילד/ה 5:",
                "id5" => "מספר זהות:",
                "date_birth5" => "תאריך לידה:",
                "frametype5" => "סוג מסגרת:",
                "educational_framework5" => "מסגרת חינוכית:",
                "grade5" => "כיתה:",
                "current5" => "שם מוסד לימודים נוכחי:",
                "abroad_certificat5" => "מבקשים לקבל אישור לימודי חוץ לבית הספר :",
                "auth_nam5" => "שם הרשות:",
                "cn6+cf6" => "ילד/ה 6:",
                "id6" => "מספר זהות:",
                "date_birth6" => "תאריך לידה:",
                "frametype6" => "סוג מסגרת:",
                "educational_framework6" => "מסגרת חינוכית:",
                "grade6" => "כיתה:",
                "current6" => "שם מוסד לימודים נוכחי:",
                "abroad_certificat6" => "מבקשים לקבל אישור לימודי חוץ לבית הספר :",
                "auth_nam6" => "שם הרשות:",
                "cn7+cf7" => "ילד/ה 7:",
                "id7" => "מספר זהות:",
                "date_birth7" => "תאריך לידה:",
                "frametype7" => "סוג מסגרת:",
                "educational_framework7" => "מסגרת חינוכית:",
                "grade7" => "כיתה:",
                "current7" => "שם מוסד לימודים נוכחי:",
                "abroad_certificat7" => "מבקשים לקבל אישור לימודי חוץ לבית הספר :",
                "auth_nam7" => "שם הרשות:",
                "cn8+cf8" => "ילד/ה 8:",
                "id8" => "מספר זהות:",
                "date_birth8" => "תאריך לידה:",
                "frametype8" => "סוג מסגרת:",
                "educational_framework8" => "מסגרת חינוכית:",
                "grade8" => "כיתה:",
                "current8" => "שם מוסד לימודים נוכחי:",
                "abroad_certificat8" => "מבקשים לקבל אישור לימודי חוץ לבית הספר :",
                "auth_nam8" => "שם הרשות:",
                "cn9+cf9" => "ילד/ה 9:",
                "id9" => "מספר זהות:",
                "date_birth9" => "תאריך לידה:",
                "frametype9" => "סוג מסגרת:",
                "educational_framework9" => "מסגרת חינוכית:",
                "grade9" => "כיתה:",
                "current9" => "שם מוסד לימודים נוכחי:",
                "abroad_certificat9" => "מבקשים לקבל אישור לימודי חוץ לבית הספר :",
                "auth_nam9" => "שם הרשות:",
                "cn10+cf10" => "ילד/ה 10:",
                "id10" => "מספר זהות:",
                "date_birth10" => "תאריך לידה:",
                "frametype10" => "סוג מסגרת:",
                "educational_framework10" => "מסגרת חינוכית:",
                "grade10" => "כיתה:",
                "current10" => "שם מוסד לימודים נוכחי:",
                "abroad_certificat10" => "מבקשים לקבל אישור לימודי חוץ לבית הספר :",
                "auth_nam10" => "שם הרשות:",
                "single_parent" => "הורה יחידני/ת",
                "un1+uf1" => "1. אני הח\"מ ",
                "id_numberu" => "מספר זהות:",
                "irequest" => "לבקשתי",
                "un2+uf2" => "עבור הקטין",
                "id_numberu2" => "מספר זהות",
                "for_studies" => "ללימודים",
                "the_stream" => "בזרם",
                "add1+add11+add12" => "2. הנני מצהיר/ה כי כתובת מגורי הינה:",
                "add2+add21+add22" => "וכתובת ההורה הנוסף הינה:",
                "un3+uf3" => "לחינוכו במשותף עם ",
                "id_numberu3" => "מספר זהות",
                "add3+add31+add32" => "כתובת",
                "mobile_phone3_select+mobile_phone3" => "נייד:",
                "email" => "הורה 1:",
                "email2" => "הורה 2:"
            ],
            [
                "pn1+pf1" => "הורה1:",
                "id_number1" => "מספר זהות:",
                "mobile_phone1_select+mobile_phone1" => "נייד:",
                "addres1+addres11+addres12" => "כתובת:",
                "pn2+pf2" => "הורה2:",
                "id_number2" => "מספר זהות:",
                "mobile_phone2_select+mobile_phone2" => "נייד:",
                "addres2+addres21+addres22" => "כתובת:",
                "request_cancellation" => "מבקשים לקבל ביטול רישום מתאריך לשנת הלימודים:",
                "disposal" => "לרשות:",
                "num_children" => "מס’ הילדים עבורם אבקש את ביטול הרישום הינו",
                "cn1+cf1" => "ילד/ה 1:",
                "id1" => "מספר זהות:",
                "date_birth1" => "תאריך לידה:",
                "frametype1" => "סוג מסגרת:",
                "educational_framework1" => "מסגרת חינוכית:",
                "grade1" => "כיתה:",
                "current1" => "שם מוסד לימודים נוכחי:",
                "cn2+cf2" => "ילד/ה 2:",
                "id2" => "מספר זהות:",
                "date_birth2" => "תאריך לידה:",
                "frametype2" => "סוג מסגרת:",
                "educational_framework2" => "מסגרת חינוכית:",
                "grade2" => "כיתה:",
                "current2" => "שם מוסד לימודים נוכחי:",
                "cn3+cf3" => "ילד/ה 3:",
                "id3" => "מספר זהות:",
                "date_birth3" => "תאריך לידה:",
                "frametype3" => "סוג מסגרת:",
                "educational_framework3" => "מסגרת חינוכית:",
                "grade3" => "כיתה:",
                "current3" => "שם מוסד לימודים נוכחי:",
                "cn4+cf4" => "ילד/ה 4:",
                "id4" => "מספר זהות:",
                "date_birth4" => "תאריך לידה:",
                "frametype4" => "סוג מסגרת:",
                "educational_framework4" => "מסגרת חינוכית:",
                "grade4" => "כיתה:",
                "current4" => "שם מוסד לימודים נוכחי:",
                "cn5+cf5" => "ילד/ה 5:",
                "id5" => "מספר זהות:",
                "date_birth5" => "תאריך לידה:",
                "frametype5" => "סוג מסגרת:",
                "educational_framework5" => "מסגרת חינוכית:",
                "grade5" => "כיתה:",
                "current5" => "שם מוסד לימודים נוכחי:",
                "cn6+cf6" => "ילד/ה 6:",
                "id6" => "מספר זהות:",
                "date_birth6" => "תאריך לידה:",
                "frametype6" => "סוג מסגרת:",
                "educational_framework6" => "מסגרת חינוכית:",
                "grade6" => "כיתה:",
                "current6" => "שם מוסד לימודים נוכחי:",
                "cn7+cf7" => "ילד/ה 7:",
                "id7" => "מספר זהות:",
                "date_birth7" => "תאריך לידה:",
                "frametype7" => "סוג מסגרת:",
                "educational_framework7" => "מסגרת חינוכית:",
                "grade7" => "כיתה:",
                "current7" => "שם מוסד לימודים נוכחי:",
                "cn8+cf8" => "ילד/ה 8:",
                "id8" => "מספר זהות:",
                "date_birth8" => "תאריך לידה:",
                "frametype8" => "סוג מסגרת:",
                "educational_framework8" => "מסגרת חינוכית:",
                "grade8" => "כיתה:",
                "current8" => "שם מוסד לימודים נוכחי:",
                "cn9+cf9" => "ילד/ה 9:",
                "id9" => "מספר זהות:",
                "date_birth9" => "תאריך לידה:",
                "frametype9" => "סוג מסגרת:",
                "educational_framework9" => "מסגרת חינוכית:",
                "grade9" => "כיתה:",
                "current9" => "שם מוסד לימודים נוכחי:",
                "cn10+cf10" => "ילד/ה 10:",
                "id10" => "מספר זהות:",
                "date_birth10" => "תאריך לידה:",
                "frametype10" => "סוג מסגרת:",
                "educational_framework10" => "מסגרת חינוכית:",
                "grade10" => "כיתה:",
                "current10" => "שם מוסד לימודים נוכחי:",
                "apartment_locality" => "מעבר דירה ליישוב אחר",
                "newaddres" => "כתובתנו החדשה:",
                "street_number" => "רחוב מספר:",
                "locality" => "יישוב:",
                "apartment_locality" => "",
                "departing_-country" => "עזיבת הארץ מתאריך:",
                "apartment_locality" => "מעבר למוסד פרטי",
                "apartment_locality" => "אחר",
                "single_parent" => "הורה יחידני/ת",
                "un1+uf1" => "1. אני הח\"מ ",
                "id_numberu" => "מספר זהות:",
                "irequest" => "לבקשתי",
                "un2+uf2" => "עבור הקטין",
                "id_numberu2" => "מספר זהות",
                "for_studies" => "ללימודים",
                "the_stream" => "בזרם",
                "add1+add11+add12" => "2. הנני מצהיר/ה כי כתובת מגורי הינה:",
                "add2+add21+add22" => "וכתובת ההורה הנוסף הינה:",
                "un3+uf3" => "לחינוכו במשותף עם ",
                "id_numberu3" => "מספר זהות",
                "add3+add31+add32" => "כתובת",
                "mobile_phone3_select+mobile_phone3" => "נייד:",
                "email" => "הורה 1:",
                "email2" => "הורה 2:"
            ],
            [
                "year" => "לשנה\"ל",
                "pn1+pf1" => "הורה1:",
                "id_number1" => "מספר זהות:",
                "mobile_phone1_select+mobile_phone1" => "נייד:",
                "addres1+addres11+addres12" => "כתובת:",
                "pn2+pf2" => "הורה2:",
                "id_number2" => "מספר זהות:",
                "mobile_phone2_select+mobile_phone2" => "נייד:",
                "addres2+addres21+addres22" => "כתובת:",
                "num_children" => "מס’ הילדים עבורם אבקש את ההעברה הינו",
                "cn1+cf1" => "ילד/ה 1:",
                "id1" => "מספר זהות:",
                "educational_framework1" => "מסגרת חינוכית:",
                "frametype1" => "סוג מסגרת:",
                "grade_to1" => "מכיתה:",
                "current1" => "מבי\"ס:",
                "grade1" => "לכיתה:",
                "current11" => "לבי\"ס:",
                "cn2+cf2" => "ילד/ה 2:",
                "id2" => "מספר זהות:",
                "educational_framework2" => "מסגרת חינוכית:",
                "frametype2" => "סוג מסגרת:",
                "grade_to2" => "מכיתה:",
                "current2" => "מבי\"ס:",
                "grade2" => "לכיתה:",
                "current12" => "לבי\"ס:",
                "cn3+cf3" => "ילד/ה 3:",
                "id3" => "מספר זהות:",
                "educational_framework3" => "מסגרת חינוכית:",
                "frametype3" => "סוג מסגרת:",
                "grade_to3" => "מכיתה:",
                "current3" => "מבי\"ס:",
                "grade3" => "לכיתה:",
                "current13" => "לבי\"ס:",
                "cn4+cf4" => "ילד/ה 4:",
                "id4" => "מספר זהות:",
                "educational_framework4" => "מסגרת חינוכית:",
                "frametype4" => "סוג מסגרת:",
                "grade_to4" => "מכיתה:",
                "current4" => "מבי\"ס:",
                "grade4" => "לכיתה:",
                "current14" => "לבי\"ס:",
                "cn5+cf5" => "ילד/ה 5:",
                "id5" => "מספר זהות:",
                "educational_framework5" => "מסגרת חינוכית:",
                "frametype5" => "סוג מסגרת:",
                "grade_to5" => "מכיתה:",
                "current5" => "מבי\"ס:",
                "grade5" => "לכיתה:",
                "current15" => "לבי\"ס:",
                "cn6+cf6" => "ילד/ה 6:",
                "id6" => "מספר זהות:",
                "educational_framework6" => "מסגרת חינוכית:",
                "frametype6" => "סוג מסגרת:",
                "grade_to6" => "מכיתה:",
                "current6" => "מבי\"ס:",
                "grade6" => "לכיתה:",
                "current16" => "לבי\"ס:",
                "cn7+cf7" => "ילד/ה 7:",
                "id7" => "מספר זהות:",
                "educational_framework7" => "מסגרת חינוכית:",
                "frametype7" => "סוג מסגרת:",
                "grade_to7" => "מכיתה:",
                "current7" => "מבי\"ס:",
                "grade7" => "לכיתה:",
                "current17" => "לבי\"ס:",
                "cn8+cf8" => "ילד/ה 8:",
                "id8" => "מספר זהות:",
                "educational_framework8" => "מסגרת חינוכית:",
                "frametype8" => "סוג מסגרת:",
                "grade_to8" => "מכיתה:",
                "current8" => "מבי\"ס:",
                "grade8" => "לכיתה:",
                "current18" => "לבי\"ס:",
                "cn9+cf9" => "ילד/ה 9:",
                "id9" => "מספר זהות:",
                "educational_framework9" => "מסגרת חינוכית:",
                "frametype9" => "סוג מסגרת:",
                "grade_to9" => "מכיתה:",
                "current9" => "מבי\"ס:",
                "grade9" => "לכיתה:",
                "current19" => "לבי\"ס:",
                "cn10+cf10" => "ילד/ה 10:",
                "id10" => "מספר זהות:",
                "educational_framework10" => "מסגרת חינוכית:",
                "frametype10" => "סוג מסגרת:",
                "grade_to10" => "מכיתה:",
                "current10" => "מבי\"ס:",
                "grade10" => "לכיתה:",
                "current110" => "לבי\"ס:",
                "reasons" => "הנימוקים להעברה: נא לסמן V",
                "reasons9_remarks" => "סמן להזנת סיבה אחרת  הערות",
                "single_parent" => "הורה יחידני/ת",
                "un1+uf1" => "1. אני הח\"מ ",
                "id_numberu" => "מספר זהות:",
                "irequest" => "לבקשתי",
                "un2+uf2" => "עבור הקטין",
                "id_numberu2" => "מספר זהות",
                "for_studies" => "ללימודים",
                "the_stream" => "בזרם",
                "add1+add11+add12" => "2. הנני מצהיר/ה כי כתובת מגורי הינה:",
                "add2+add21+add22" => "וכתובת ההורה הנוסף הינה:",
                "un3+uf3" => "לחינוכו במשותף עם ",
                "id_numberu3" => "מספר זהות",
                "add3+add31+add32" => "כתובת",
                "mobile_phone3_select+mobile_phone3" => "נייד:",
                "email" => "הורה 1:",
                "email2" => "הורה 2:"
            ],
            [
                "pn1+pf1" => "הורה1:",
                "id_number1" => "מספר זהות:",
                "mobile_phone1_select+mobile_phone1" => "נייד:",
                "Caddress11+Caddress21+Caddress1" => "כתובת נוכחית:",
                "Faddress11+Faddress21+Faddress1" => "כתובת עתידית:",
                "expect_new_address1" => "צפי מעבר לכתובת חדשה:",
                "immigrant1" => "האם הינך עולה חדש?",
                "date_increase1" => "תאריך עלייה:",
                "country_birth1" => "ארץ לידה:",
                "marital_status1" => "מצב משפחתי:",
                "pn2+pf2" => "הורה1:",
                "id_number2" => "מספר זהות:",
                "mobile_phone2_select+mobile_phone2" => "נייד:",
                "Caddress12+Caddress22+Caddress2" => "כתובת נוכחית:",
                "Faddress12+Faddress22+Faddress2" => "כתובת עתידית:",
                "expect_new_address2" => "צפי מעבר לכתובת חדשה:",
                "immigrant2" => "האם הינך עולה חדש?",
                "date_increase2" => "תאריך עלייה:",
                "country_birth2" => "ארץ לידה:",
                "marital_status2" => "מצב משפחתי:",
                "num_children" => "מס’ הילדים עבורם אבקש את ההעברה הינו",
                "child_immigrant1" => "ילד/ה 1: האם הילד/ה עולה חדש?כןלא",
                "child_date_increase1" => "תאריך עלייה:",
                "child_country_birth1" => "ארץ לידה:",
                "pn1+pf1" => "שם הילד:",
                "id_number1" => "מספר זהות:",
                "A_birth1" => "ת. לידה:",
                "frametype1" => "סוג מסגרת:",
                "educational_framework1" => "מסגרת חינוכית:",
                "grade1" => "כיתה:",
                "educational_framework11" => "זרם:",
                "d_birth1" => "מבקש לרשום את הילד הנ\"ל מתאריך:",
                "xzname1" => "לשנה\"ל:",
                "current1+current11" => "לאחד מהמוסדות הבאים:",
                "child_immigrant2" => "ילד/ה 2: האם הילד/ה עולה חדש?כןלא",
                "child_date_increase2" => "תאריך עלייה:",
                "child_country_birth2" => "ארץ לידה:",
                "pn2+pf2" => "שם הילד:",
                "id_number2" => "מספר זהות:",
                "A_birth2" => "ת. לידה:",
                "frametype2" => "סוג מסגרת:",
                "educational_framework2" => "מסגרת חינוכית:",
                "grade2" => "כיתה:",
                "educational_framework21" => "זרם:",
                "d_birth2" => "מבקש לרשום את הילד הנ\"ל מתאריך:",
                "xzname2" => "לשנה\"ל:",
                "current2+current21" => "לאחד מהמוסדות הבאים:",
                "child_immigrant3" => "ילד/ה 3: האם הילד/ה עולה חדש?כןלא",
                "child_date_increase3" => "תאריך עלייה:",
                "child_country_birth3" => "ארץ לידה:",
                "pn3+pf3" => "שם הילד:",
                "id_number3" => "מספר זהות:",
                "A_birth3" => "ת. לידה:",
                "frametype3" => "סוג מסגרת:",
                "educational_framework3" => "מסגרת חינוכית:",
                "grade3" => "כיתה:",
                "educational_framework31" => "זרם:",
                "d_birth3" => "מבקש לרשום את הילד הנ\"ל מתאריך:",
                "xzname3" => "לשנה\"ל:",
                "current3+current31" => "לאחד מהמוסדות הבאים:",
                "child_immigrant4" => "ילד/ה 4: האם הילד/ה עולה חדש?כןלא",
                "child_date_increase4" => "תאריך עלייה:",
                "child_country_birth4" => "ארץ לידה:",
                "pn4+pf4" => "שם הילד:",
                "id_number4" => "מספר זהות:",
                "A_birth4" => "ת. לידה:",
                "frametype4" => "סוג מסגרת:",
                "educational_framework4" => "מסגרת חינוכית:",
                "grade4" => "כיתה:",
                "educational_framework41" => "זרם:",
                "d_birth4" => "מבקש לרשום את הילד הנ\"ל מתאריך:",
                "xzname4" => "לשנה\"ל:",
                "current4+current41" => "לאחד מהמוסדות הבאים:",
                "child_immigrant5" => "ילד/ה 5: האם הילד/ה עולה חדש?כןלא",
                "child_date_increase5" => "תאריך עלייה:",
                "child_country_birth5" => "ארץ לידה:",
                "pn5+pf5" => "שם הילד:",
                "id_number5" => "מספר זהות:",
                "A_birth5" => "ת. לידה:",
                "frametype5" => "סוג מסגרת:",
                "educational_framework5" => "מסגרת חינוכית:",
                "grade5" => "כיתה:",
                "educational_framework51" => "זרם:",
                "d_birth5" => "מבקש לרשום את הילד הנ\"ל מתאריך:",
                "xzname5" => "לשנה\"ל:",
                "current5+current51" => "לאחד מהמוסדות הבאים:",
                "child_immigrant6" => "ילד/ה 6: האם הילד/ה עולה חדש?כןלא",
                "child_date_increase6" => "תאריך עלייה:",
                "child_country_birth6" => "ארץ לידה:",
                "pn6+pf6" => "שם הילד:",
                "id_number6" => "מספר זהות:",
                "A_birth6" => "ת. לידה:",
                "frametype6" => "סוג מסגרת:",
                "educational_framework6" => "מסגרת חינוכית:",
                "grade6" => "כיתה:",
                "educational_framework61" => "זרם:",
                "d_birth6" => "מבקש לרשום את הילד הנ\"ל מתאריך:",
                "xzname6" => "לשנה\"ל:",
                "current6+current61" => "לאחד מהמוסדות הבאים:",
                "child_immigrant7" => "ילד/ה 7: האם הילד/ה עולה חדש?כןלא",
                "child_date_increase7" => "תאריך עלייה:",
                "child_country_birth7" => "ארץ לידה:",
                "pn7+pf7" => "שם הילד:",
                "id_number7" => "מספר זהות:",
                "A_birth7" => "ת. לידה:",
                "frametype7" => "סוג מסגרת:",
                "educational_framework7" => "מסגרת חינוכית:",
                "grade7" => "כיתה:",
                "educational_framework71" => "זרם:",
                "d_birth7" => "מבקש לרשום את הילד הנ\"ל מתאריך:",
                "xzname7" => "לשנה\"ל:",
                "current7+current71" => "לאחד מהמוסדות הבאים:",
                "child_immigrant8" => "ילד/ה 8: האם הילד/ה עולה חדש?כןלא",
                "child_date_increase8" => "תאריך עלייה:",
                "child_country_birth8" => "ארץ לידה:",
                "pn8+pf8" => "שם הילד:",
                "id_number8" => "מספר זהות:",
                "A_birth8" => "ת. לידה:",
                "frametype8" => "סוג מסגרת:",
                "educational_framework8" => "מסגרת חינוכית:",
                "grade8" => "כיתה:",
                "educational_framework81" => "זרם:",
                "d_birth8" => "מבקש לרשום את הילד הנ\"ל מתאריך:",
                "xzname8" => "לשנה\"ל:",
                "current8+current81" => "לאחד מהמוסדות הבאים:",
                "child_immigrant9" => "ילד/ה 9: האם הילד/ה עולה חדש?כןלא",
                "child_date_increase9" => "תאריך עלייה:",
                "child_country_birth9" => "ארץ לידה:",
                "pn9+pf9" => "שם הילד:",
                "id_number9" => "מספר זהות:",
                "A_birth9" => "ת. לידה:",
                "frametype9" => "סוג מסגרת:",
                "educational_framework9" => "מסגרת חינוכית:",
                "grade9" => "כיתה:",
                "educational_framework91" => "זרם:",
                "d_birth9" => "מבקש לרשום את הילד הנ\"ל מתאריך:",
                "xzname9" => "לשנה\"ל:",
                "current9+current91" => "לאחד מהמוסדות הבאים:",
                "child_immigrant10" => "ילד/ה 10: האם הילד/ה עולה חדש?כןלא",
                "child_date_increase10" => "תאריך עלייה:",
                "child_country_birth10" => "ארץ לידה:",
                "pn10+pf10" => "שם הילד:",
                "id_number10" => "מספר זהות:",
                "A_birth10" => "ת. לידה:",
                "frametype10" => "סוג מסגרת:",
                "educational_framework10" => "מסגרת חינוכית:",
                "grade10" => "כיתה:",
                "educational_framework101" => "זרם:",
                "d_birth10" => "מבקש לרשום את הילד הנ\"ל מתאריך:",
                "xzname10" => "לשנה\"ל:",
                "current10+current101" => "לאחד מהמוסדות הבאים:",
                "accessibility_required" => "האם נדרשת נגישות?",
                "accessibility_required_detail" => "האם נדרשת נגישות? נא פרט",
                "sensitivity" => "האם ישנה רגישות?",
                "sensitivity_detail" => "האם ישנה רגישות? נא פרט",
                "single_parent" => "הורה יחידני/ת",
                "un1+uf1" => "1. אני הח\"מ ",
                "id_numberu" => "מספר זהות:",
                "irequest" => "לבקשתי",
                "un2+uf2" => "עבור הקטין",
                "id_numberu2" => "מספר זהות",
                "for_studies" => "ללימודים",
                "the_stream" => "בזרם",
                "add1+add11+add12" => "2. הנני מצהיר/ה כי כתובת מגורי הינה:",
                "add2+add21+add22" => "וכתובת ההורה הנוסף הינה:",
                "un3+uf3" => "לחינוכו במשותף עם ",
                "id_numberu3" => "מספר זהות",
                "add3+add31+add32" => "כתובת",
                "mobile_phone3_select+mobile_phone3" => "נייד:",
                "email" => "הורה 1:",
                "email2" => "הורה 2:"
            ]
        ];
        if ($form_id && !empty($headings[$form_id])) {
            return $headings[$form_id];
        } else {
            return '';
        }
    }


    public static function replace_file($request)
    {
        if ($request->fileID && $request->hasFile('file')) {
            $resulte = array();
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
            if ((!in_array($newfile->getClientmimeType(), $acceptable)) && (!empty($newfile->getClientmimeType()))) {
                $resulte['error'] = 'סוג קובץ לא תקין.';
                return json_encode($resulte);
            }
            $file = DB::table('apps_file')->where('id', '=', $request->fileID)->first();
            $url = public_path('upload') . "\\" . $file->url;
            if (file_exists($url)) {
                unlink($url);
            }
            $newname = $newfile->getClientOriginalName();
            $newfilename = explode(".", $file->url)[0] . '.' . $newfile->getClientOriginalExtension();

            $newfile->move(public_path('upload'), $newfilename);
            $res = DB::table('apps_file')
                ->where('id', $request->fileID)
                ->update(['url' => $newfilename, 'file_name' => $newname, 'status' => 1]);
            $resulte['text'] = 'הקובץ השתנה בהצלחה ';
            $resulte['url'] = $newfilename;
            $resulte['file_name'] = $newname;
            return json_encode($resulte);
        } else {
            $resulte['error'] = 'error';
            return json_encode($resulte);
        }
    }

    public static function check_rows_status($id, $rowscount)
    {
        if (empty($id) || empty($rowscount)) return false;

        for ($i = 1; $i <= $rowscount; $i++) {
            $row = DB::table('apps_meta')->where([
                ['app_id', '=', $id],
                ['meta_name', '=', 'children' . $i],
            ])->first();

            if (empty($row))  return false;
        }

        return true;
    }

    public static function saverow($request)
    {
        $resulte = array();
        if ($request->app_id && $request->save_meta) {
            DB::table('apps_meta')->insert([
                ['app_id' => $request->app_id, 'meta_name' => $request->save_meta, 'meta_value' => 1]
            ]);
            $metas = json_decode($request->metas);
            $metaJson = unserialize(self::get_meta_value($request->app_id, 'metaJson'));
            foreach ($metas as $key => $value) {
                $metaJson[$key] = $value;
            }
            $metaJson = serialize($metaJson);
            DB::table('apps_meta')
                ->where([
                    ['app_id', '=', $request->app_id],
                    ['meta_name', '=', 'metaJson'],
                ])
                ->update(['meta_value' => $metaJson]);
            $resulte['text']  = 'success';
        } else {
            $resulte['error']  = 'אירעה שגיאה. רענן את הדף ונסה שוב';
        }
        return json_encode($resulte);
    }

    public static function sendmail($to, $body, $veiw, $attach = '', $subject = '', $tendername = '')
    {
        Mail::to($to)->send(new SendMailable($body, array($attach), $veiw, 'מכרז למשרת ' . $tendername . ' - מועצה מקומית קריית ארבע חברון'));
        // Mail::to('tali@merchavim.org.il')->send(new SendMailable($body, $attach, $veiw, $subject));
        // Mail::to('hadatm@merchavim.org.il')->send(new SendMailable($body, $attach, $veiw, $subject));
    }

    public static function get_user_forms($id)
    {
        $forms = DB::table('forms')->where([
            ['status', '=', '1'],
        ])->get();
        $ids = array();
        foreach ($forms as $key => $form) {
            $type = $form->type;
            $departments = explode(',', $form->department);
            foreach ($departments as $key => $department) {
                $m = DB::table('users_meta')->where([
                    ['user_id', '=', $id],
                    ['meta_name', '=', $department . '_' . $type],
                ])->first();
                if (!empty($m) && $m->meta_value != "") {
                    array_push($ids, $form->id);
                    break;
                }
            }
        }
        return $ids;
    }



    public static function app_submenu_html()
    {
        $html = '';
        $user = auth()->user();
        $form_ids = self::get_user_forms($user->id);
        if (empty($form_ids)) return false;

        $type = null;

        if (!empty($_GET['form-type']) && $_GET['form-type'] != 'all') {
            $type = $_GET['form-type'];
        }

        $forms = DB::table('forms')
            ->where([['status', '=', '1']])
            ->whereIn('id', $form_ids)
            ->get();
        $form_types = $forms->pluck('name', 'type')->toArray();
        if (!empty($form_types)) {
            $type_text = !empty($type) && !empty($form_types[$type]) ? $form_types[$type] : 'הכל';
            $type_key = !empty($type) && !empty($form_types[$type]) ? $type : 'all';

            $html .= '<div class="btn-group type_form_group filter-app">';
            $html .= '<a class="dropdown-toggle btn-select" data-toggle="dropdown" href="#"  data-name="form-type" data-val="' . $type_key . '">שם הטופס:<span class="caret">' . $type_text . '</span></a><ul class="dropdown-menu">';
            $html .= '<li class="dropdown-item"><a href="#" data-val="all">הכל</a></li>';
            foreach ($form_types as $key => $form_type) {
                $html .= '<li class="dropdown-item"><a href="#" data-val="' . $key . '">' . $form_type . '</a></li>';
            }
            $html .= '</ul></div>';
        }


        $institutions = $forms->when(!empty($type), function ($query) use ($type) {
            return $query->where('type', $type);
        })->groupBy('department')->toArray();
        $instypes = array();
        foreach ($institutions as $key => $value) {
            $keys = explode(',', $key);
            $instypes = array_merge($keys, $instypes);
        }
        $instypes = array_unique($instypes);

        $institution = 'all';
        $institution_text = 'הכל';
        if (!empty($_GET['institution-type']) && $_GET['institution-type'] != 'all' && !empty(self::$instypes[$_GET['institution-type']])) {
            $institution = $_GET['institution-type'];
            $institution_text = self::$instypes[$_GET['institution-type']];
        }

        $html .= '<div class="btn-group type_form_group filter-app">';
        $html .= '<a class="dropdown-toggle btn-select" data-toggle="dropdown" href="#"  data-name="institution-type" data-val="' . $institution . '">סוג המוסד:<span class="caret">' . $institution_text . '</span></a><ul class="dropdown-menu">';
        $html .= '<li class="dropdown-item"><a href="#" data-val="all">הכל</a></li>';
        foreach ($instypes as $key => $it) {
            $html .= '<li class="dropdown-item"><a href="#" data-val="' . $it . '">' . self::$instypes[$it] . '</a></li>';
        }
        $html .= '</ul></div>';


        if (isset($_GET['daterange']) && !empty($_GET['daterange']) && isset($_GET['label'])) {
            $activedate = $_GET['label'];
            $daterange = $_GET['daterange'];
        } else {
            $activedate = 'הכל ';
            $daterange = '01/01/2019-' . date("m/d/Y", time() + 86400);
        }
        $html .= '<div class="btn-group type_form_group filter-app"><a class="dropdown-toggle btn-select " href="#" id="date_range" data-label="' . $activedate . '" data-name="daterange" data-val="' . $daterange . '">בין תאריכים: <span class="caret">' . $activedate . '</span></a></div>';

        $daterange = explode("-", $daterange);
        $from = isset($daterange[0]) ? $daterange[0] : date("m/d/Y", time() + 86400);
        $to = isset($daterange[1]) ? $daterange[1] : date("m/d/Y", time() + 86400);
        $html .= '<script type="text/javascript"> var startd = "' . $from . '"; var endd = "' . $to . '"; </script>';

        $statuses = self::$status_arr;
        if (!empty($_GET['status'])) {
            $activestatus = !empty($statuses[$_GET['status']]) ? $statuses[$_GET['status']] : 'הכל';
            $act = $_GET['status'];
        } else {
            $activestatus = 'הכל';
            $act = '';
        }
        $html .= '<div class="btn-group type_form_group filter-app">';
        $html .= '<a class="dropdown-toggle btn-select" data-toggle="dropdown" href="#"  data-name="status" data-val="' . $act . '">סטטוס: <span class="caret">' . $activestatus . '</span></a><ul class="dropdown-menu">';
        $html .= '<li class="dropdown-item"><a href="#" data-val="">הכל</a></li>';
        foreach ($statuses as $key => $status) {
            $html .= '<li class="dropdown-item"><a href="#" data-val="' . $key . '">' . $status . '</a></li>';
        }
        $html .= '</ul></div>';
        $html .= '<a id="search" href="#"  class="paginate"><img src="' . url('/') . '/img/s.png"> <span>חיפוש  </span>
                  <form class="search" metod="get" >
                    <div class="input-group">
                        <div class="form-group has-feedback has-clear">
                          <input type="text" name="q" class="form-control" id="search-imput" placeholder="אנא הזינו מילה/מספר פניה לחיפוש" value="';
        $html .= isset($_GET['q']) ? $_GET['q'] : "";
        $html .= '">
                          <span class="form-control-clear form-control-feedback hidden">X</span>
                        </div>
                      </div>
                  </form>
                </a>';
        if (self::show_export()) {
            $html .= '<div class="btn-group type_form_group export-app">';
            $html .= '<a class="dropdown-toggle btn-select" data-toggle="dropdown" href="#"><img src="' . asset('img/exp.png') . '"> יצוא הנתונים לאקסל</a><ul class="dropdown-menu">';
            $u = explode('?', Request::fullUrl())[1];
            $html .= '<li class="dropdown-item"><a href="export?' . $u . '" data-id="">יצאו כללי</a></li>';
            $html .= '<li class="dropdown-item"><a href="#" data-id="">יצאו לטובת תפעולית</a></li>';
            $html .= '</ul></div>';
        }
        return $html;
    }
    public static function show_export($get = false)
    {
        if (!empty($_GET['form-type']) && $_GET['form-type'] != 'all') {
            $type = $_GET['form-type'];
        } else {
            return false;
        }
        if (!empty($_GET['institution-type']) && $_GET['institution-type'] != 'all') {
            $institution = $_GET['institution-type'];
        } else {
            return false;
        }
        $ids = DB::table('forms')->where([
            ['type', '=', $type],
        ])->pluck('id')->toArray();
        if (count($ids) == 1) {
            $application = DB::table('applications')->where([['type', '=', $type], ['department', '=', $institution]])->first();
            if (!empty($application)) {
                if ($get) {
                    $ch = User::check_auth_user_AppPermission($application, 4);
                    if ($ch) {
                        return $ids[0];
                    }
                } else {
                    return User::check_auth_user_AppPermission($application, 4);
                }
            }
        }
        return false;
    }

    public static function get_search_applications($form_ids, $q)
    {
        $applications = Applications::where('sender', 'like', '%' . $q . '%')->orWhere('id', 'like', '%' . $q . '%')->whereIn('form_id', $form_ids)->orderBy('id', 'DESC')->paginate(15);
        $applications->count = Applications::whereIn('form_id', $form_ids)->where('sender', 'like', '%' . $q . '%')->orWhere('id', 'like', '%' . $q . '%')->count();
        return $applications;
    }

    public static function get_show_forms_ids()
    {
        return array();
    }

    public static function app_forms_name($form_id)
    {

        $form = DB::table('forms')->where([
            ['id', '=', $form_id],
        ])->first();
        if (empty($form))  return '';

        return $form->name;
    }

    public static function get_all_applications()
    {
        $user = auth()->user();
        $form_ids = self::get_user_forms($user->id);
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            return  self::get_search_applications($form_ids, $_GET['q']);
        }

        $type = null;
        $institution = null;
        if (!empty($_GET['institution-type']) && $_GET['institution-type'] != 'all') {
            $institution = $_GET['institution-type'];
        }

        if (!empty($_GET['form-type']) && $_GET['form-type'] != 'all') {
            $type = $_GET['form-type'];
        }

        if (isset($_GET['status']) && $_GET['status'] != '') {
            $status = array($_GET['status']);
        } else {
            $status = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11);
        }

        if (isset($_GET['daterange']) && $_GET['daterange'] != '') {
            $daterange = $_GET['daterange'];
        } else {
            $daterange = '01/01/2019-' . date("m/d/Y", time() + 86400);
        }
        $daterange = explode("-", $daterange);
        $from = isset($daterange[0]) ? date("Y-m-d", strtotime($daterange[0])) : date("Y-m-d", time() + 86400);
        $to = isset($daterange[1]) ? date("Y-m-d", strtotime($daterange[1])) : date("Y-m-d", time() + 86400);

        $applications = DB::table('applications')->whereBetween('send_date', [new Carbon($from), new Carbon($to)])
            ->when(!empty($institution), function ($query) use ($institution) {
                return $query->where('department', $institution);
            })
            ->when(!empty($type), function ($query) use ($type) {
                return $query->where('type', $type);
            })
            ->whereIn('form_id', $form_ids)
            ->whereIn('status', $status)
            ->orderBy('id', 'DESC')->paginate(15);
        $applications->count = $applications->total();

        return $applications;
    }
    public static function get_export_data()
    {
        $applications = self::get_all_applications();
        $data = [];
        if (empty($applications))  return $data;

        foreach ($applications as $kp => $app) {
            $fields = Applications::get_export_headings();
            $appdata = [];
            foreach ($fields as $key => $value) {
                $keys = explode('+', $key);
                $val = '';
                foreach ($keys as $value) {
                    $v = Applications::get_json($app->id, $value);
                    if (is_array($v)) {
                        $v = implode(",", $v);
                    }
                    if ($v == 'yes') {
                        $v = 'כן';
                    } elseif ($v == 'no') {
                        $v = 'לא';
                    }
                    if ($v == 'norm') {
                        $v = 'חינוך רגיל';
                    } elseif ($v == 'spec') {
                        $v = 'חינוך מיוחד';
                    }
                    $val .= $v . ' ';
                }
                array_push($appdata, $val);
            }
            $data[$kp] = $appdata;
        }
        return $data;
    }

    public static function api_answer_mail($id)
    {
        if ($id) {
            $app = DB::table('applications')->where('id', '=', $id)->first();
            $fail_name = uniqid() . '_' . time();
            $sender = explode(' ', $app->sender);
            $sender = $sender[0];
            $pdf = PDF::loadView('pdf.pdfview_forms_answer', [
                'send_date' => date('d/m/Y', strtotime($app->send_date)),
                'sender' => $sender,
                'formid' => date('Y') . '-' . $app->id,
                'formname' => self::app_forms_name($app->form_id),
                'app_dec' => AppDecisions::find($id)
            ])->setPaper('A4')->setOrientation('portrait');
            $filename = public_path('upload/admin/' . $fail_name . '.pdf');
            $pdf->save($filename);
            $to = $app->email;
            $body = '<h3>תודה על פנייתכם, מצ"ב:</h3>
                    <ol>
                        <li>טופס הבקשה שמילאתם.</li>
                        <li>מסמך ממחלקת חינוך. </li>
                    </ol><br><br>
                    ברכה, <br>
                    מחלקת חינוך.';
            $formpdf = Applications::get_pdf_file($id);
            $formpdfurl = asset('upload/' . $formpdf->url);
            $files = array($filename, $formpdfurl);
            if (file_exists($filename)) {
                Mail::to($to)->send(new SendMailable($body, $files, 'app', 'מנהל החינוך - מועצה איזורית לכיש'));
                return 'success';
            }
        } else {
            return 'error';
        }
    }

    /**
     * Send email with all attachments for page5 form submissions
     *
     * @param int $app_id Application ID
     * @return string success|error
     */
    public static function api_answer_mail_page5($app_id)
    {
        if (!$app_id) {
            return 'error';
        }

        try {
            // Get application details
            $app = DB::table('applications')->where('id', '=', $app_id)->first();
            if (!$app) {
                return 'error';
            }

            // Get application decision details for tender information
            $app_decision = DB::table('app_decisions')->where('p5_id', '=', $app_id)->first();
            if (!$app_decision) {
                return 'error';
            }

            // Get tender information
            $tender = DB::table('tenders')->where('generated_id', '=', $app_decision->tenderval)->first();
            $tender_name = $tender ? $tender->tname : 'מכרז';

            // Prepare email content
            $to = $app->email;
            $applicant_name = $app_decision->applicant_name ?? $app->sender;

            // Collect all files for this application
            $attachments = [];

            // Get the form PDF
            $form_pdf = self::get_pdf_file($app_id);
            if ($form_pdf && file_exists(public_path('upload/' . $form_pdf->url))) {
                $attachments[] = public_path('upload/' . $form_pdf->url);
            }

            // Get all uploaded files (excluding form PDFs)
            $uploaded_files = self::get_file_byAppID($app_id);
            $attachment_count = $uploaded_files ? count($uploaded_files) : 0;

            // Render the email template
            $body = view('emails.page5_submission', [
                'applicant_name' => $applicant_name,
                'tender_name' => $tender_name,
                'attachment_count' => $attachment_count,
                'organization_name' => $tender->body ?? 'מועצה מקומית קריית ארבע חברון',
                // 'organization_logo' => $tender->body_image ?? 'img/logo-b.png'
                'organization_logo' => url('/img/logo-b.png')
            ])->render();
            if ($uploaded_files) {
                foreach ($uploaded_files as $file) {
                    $file_path = public_path('upload/' . $file->url);
                    if (file_exists($file_path)) {
                        $attachments[] = $file_path;
                    }
                }
            }

            // Send email with all attachments
            if (!empty($attachments)) {
                $subject = 'אישור קבלת מועמדות למכרז: ' . $tender_name;
                Mail::to($to)->send(new \App\Mail\SendMailable($body, $attachments, 'app', $subject));

                // Log the email sending
                $meta_data = [
                    ['app_id' => $app_id, 'meta_name' => 'email_sent_page5', 'meta_value' => 'מייל עם קבצים נשלח בהצלחה בתאריך ' . date('Y-m-d H:i:s')]
                ];
                \App\Forms::insert_meta($meta_data);

                return 'success';
            } else {
                return 'error - no files found';
            }
        } catch (\Exception $e) {
            // Log the error
            \Illuminate\Support\Facades\Log::error('Page5 mail sending failed: ' . $e->getMessage(), [
                'app_id' => $app_id,
                'trace' => $e->getTraceAsString()
            ]);
            return 'error';
        }
    }

    public static function app_status_edit_ajaxfile($id)
    {
        $noP = 0;
        $newD = 0;
        if ($id) {
            $files = DB::table('apps_file')
                ->where([
                    ['app_id', '=', $id],
                    ['type', '!=', 'erur']
                ])->get();
            foreach ($files as $file) {
                if ($file->status == 2 || $file->status == 4) {
                    Applications::update_app_status_byId($id, 1);
                    return false;
                }
                if ($file->status == 3) {
                    $newD++;
                }
                if ($file->status == 0) {
                    $noP++;
                }
            }
        } else {
            return false;
        }
        if ($newD > 0) {
            Applications::update_app_status_byId($file->app_id, 2);
            return false;
        }
        if ($noP == 0) {
            Applications::update_app_status_byId($file->app_id, 3);
        } else {
            Applications::update_app_status_byId($file->app_id, 0);
        }
    }

    public static function approve_file($request)
    {
        if ($request->fileID) {
            $user = \App\User::getCCurrentUser();
            DB::table('apps_file')
                ->where('id', $request->fileID)
                ->update(['status' => 1]);
            $file = DB::table('apps_file')->where('id', '=', $request->fileID)->first();
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
                $description = 'מסמך לצירוף ' . $file_name . ' אושר על ידי' . $user;
                DB::table('apps_logs')->insert([
                    ['app_id' => $request->appid, 'description' => $description]
                ]);
            }
            if ($file->type != 'erur') {
                self::app_status_edit_ajaxfile($request->appid);
            }
            return 'success';
        } else {
            return 'error';
        }
    }

    public static function cancel_file($request)
    {
        if ($request->fileID && $request->appid) {
            $user = auth()->user();
            $fileID = $request->fileID;
            if ($request->fileID == 'newfile') {
                $encryptionService = app(EncryptionService::class);
                $fileID = DB::table('apps_file')->insertGetId([
                    'app_id' => $request->appid,
                    'url' => $encryptionService->encrypt('empty.txt'),
                    'type' => 'newfile',
                    'file_name' => $encryptionService->encrypt(' ^^מסמך אחר'),
                    'status' => 4,
                    'encryption_key_slot' => $encryptionService->getCurrentKeySlot()
                ]);
            } else {
                DB::table('apps_file')
                    ->where('id', $fileID)
                    ->update(['status' => 2]);
            }
            $file = DB::table('apps_file')->where('id', '=', $fileID)->first();
            if (empty($file))  return 'error' . $fileID;
            $app = DB::table('applications')->where('id', '=', $file->app_id)->first();
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
            $body = '<div style="color:#111;margin-bottom: 15px;">' . $request->msg;
            if ($file->type != 'pdf') {
                $body .= '<p style="margin: 5px 0;">למייל זה מצורף קישור להעלאת מסמך  ' . $file_name . ' שנמצא לא תקין בבדיקתינו, נא לחצו על הקישור שמופיע מטה והעלו את המסמך התקין.';
                $body .= '<a href="' . url('/') . '/replacefile/' . base64_encode($fileID) . '/">להחליף<a></p>';

                $description = 'מסמך לצירוף ' . $file_name . 'נדחה';
                if (!empty($request->msg)) {
                    $description .= '<br>סיבת הדחייה:' . $request->msg;
                }
                DB::table('apps_logs')->insert([
                    ['app_id' => $request->appid, 'description' => $description]
                ]);
            } else {
                $description = 'טופס הבקשה נדחה על ידי ' . $user;
                if (!empty($request->msg)) {
                    $description .= '<br>סיבת הדחייה:' . $request->msg;
                }
                DB::table('apps_logs')->insert([
                    ['app_id' => $request->appid, 'description' => $description]
                ]);
            }
            $body .= '</div>';
            $metamail = self::get_meta_value($file->app_id, 'metamail');
            if (empty($metamail)) {
                DB::table('apps_meta')->insert([
                    ['app_id' => $file->app_id, 'meta_name' => 'metamail', 'meta_value' => $body]
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
            if ($file->type != 'erur') {
                self::app_status_edit_ajaxfile($request->appid);
            }
            return 'success';
        } else {
            return 'error 2';
        }
    }

    public static function update_file($request)
    {
        $app_id = $request->appid;
        $metaJson = unserialize(self::get_meta_value($app_id, 'metaJson'));
        $budget_item = isset($request->budget_item) ? $request->budget_item : '';
        $budget_remarks = isset($request->budget_remarks) ? $request->budget_remarks : '';
        $budget_manager = isset($request->budget_manager) ? $request->budget_manager : '';
        $treasurer = isset($request->treasurer) ? $request->treasurer : '';
        $hr = isset($request->hr) ? $request->hr : '';
        $hr_date = isset($request->hr_date) ? $request->hr_date : '';
        if ($budget_manager != '') {
            DB::table('apps_meta')->insert([
                ['app_id' => $app_id, 'meta_name' => 'budget_item', 'meta_value' => $budget_item],
            ]);
            DB::table('apps_meta')->insert([
                ['app_id' => $app_id, 'meta_name' => 'budget_remarks', 'meta_value' => $budget_remarks],
            ]);
            DB::table('apps_meta')->insert([
                ['app_id' => $app_id, 'meta_name' => 'budget_manager', 'meta_value' => $budget_manager],
            ]);
            $status = 4;
        }
        if ($treasurer != '') {
            DB::table('apps_meta')->insert([
                ['app_id' => $app_id, 'meta_name' => 'treasurer', 'meta_value' => $treasurer],
            ]);
            $status = 5;
        }
        if ($hr != '' && $hr_date != '') {
            DB::table('apps_meta')->insert([
                ['app_id' => $app_id, 'meta_name' => 'hr', 'meta_value' => $hr],
            ]);
            DB::table('apps_meta')->insert([
                ['app_id' => $app_id, 'meta_name' => 'hr_date', 'meta_value' => $hr_date],
            ]);
            $status = 6;
        }
        $update_meta_name = 'update_pdf';
        $pdf_name = uniqid() . '_' . time();
        $pdfpath = public_path('upload/admin/' . $pdf_name . '.pdf');
        $pdf = PDF::loadView('pdf.pdfview_form8_hrta', [
            'metaJson' => $metaJson,
            'budget_item' => $budget_item,
            'budget_remarks' => $budget_remarks,
            'budget_manager' => $budget_manager,
            'treasurer' => $treasurer,
            'hr' => $hr,
            'hr_date' => $hr_date
        ])->setPaper('A4')->setOrientation('portrait');
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 5000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        $pdf->setOption('margin-top', 10);
        $pdf->setOption('margin-bottom', 10);
        $pdf->setOption('margin-left', 10);
        $pdf->setOption('margin-right', 10);
        $pdf->save($pdfpath);
        if (file_exists($pdfpath)) {
            DB::table('apps_logs')->insert([
                ['app_id' => $request->appid, 'description' => 'טופס הבקשה עודכן']
            ]);
            DB::table('apps_meta')->insert([
                ['app_id' => $app_id, 'meta_name' => $update_meta_name, 'meta_value' => $pdf_name . '.pdf'],
            ]);
            DB::table('applications')->where('id', $app_id)->update(['status' => $status]);
            //Applications::sendmail($to, $body, 'app', $filepath,'');
            return 'success';
        } else {
            return 'error';
        }
    }

    public static function send_all_mails($request)
    {
        $id = $request->appid;
        $app = DB::table('applications')->where('id', '=', $id)->first();
        if (empty($app))  return 'error';
        $metamail = Applications::get_meta_value($id, 'metamail');
        if (empty($metamail)) {
            return "אין מידע שניתן לשלוח בדואר";
        } else {
            $to = $app->email;
            Applications::sendmail($to, $metamail, 'app');
            DB::table('apps_meta')
                ->where([
                    ['app_id', '=', $id],
                    ['meta_name', '=', 'metamail'],
                ])->delete();
            return "לענות על שליחת הצלחה";
        }
    }


    public static function get_app_logs($request)
    {
        if ($request->ID) {
            $html = '';
            // $app = DB::table('applications')->where('id', '=', $request->ID)->first();
            $app = DB::table('app_decisions')->where('id', '=', $request->ID)->first();
            if (empty($app))  return 'error';
            //Log::debug('$request->ID:'.$request->ID.'$request->appid:'.$request->appid);
            $logs = DB::table('apps_logs')
                ->where('app_id', $request->ID)
                //->orWhere('app_id', $request->appid)
                ->orderBy('id', 'DESC')
                ->get();
            if (!empty($logs)) {
                foreach ($logs as $key => $log) {
                    $html .= '<p><span>' . date('d.m.Y h:i', strtotime($log->l_date)) . '</span><span>' . $log->description . '</span></p>';
                }
            }
            $html .= '<p><span>' . date('d.m.Y h:i', strtotime($app->crdate)) . '</span><span>טופס הבקשה התקבל</span></p>';
            return $html;
        } else {
            return 'error';
        }
    }

    public static function add_user_inappp($request)
    {
        $id = $request->id;
        $app_id = $request->app_id;
        $m = DB::table('apps_meta')->where([
            ['app_id', '=', $app_id],
            ['meta_name', '=', 'app_users'],
        ])->first();
        if (empty($m)) {
            DB::table('apps_meta')->insert([
                ['app_id' => $app_id, 'meta_name' => 'app_users', 'meta_value' => $id],
            ]);
        } else {
            $ids = explode(',', $m->meta_value);
            if (!in_array($id, $ids)) {
                DB::table('apps_meta')
                    ->where([
                        ['app_id', '=', $app_id],
                        ['meta_name', '=', 'app_users'],
                    ])
                    ->update(['meta_value' => $m->meta_value . ',' . $id]);
            }
        }
        $User = User::select("name")->where('id', $id)->first();
        $user = \App\User::getCCurrentUser();
        $description = 'נוסף נעמן לקבלת העתקים של תשובות  ' . $User->name . ' על ידי ' . $user;
        DB::table('apps_logs')->insert([
            ['app_id' => $app_id, 'description' => $description]
        ]);
        return self::user_inappp_html($app_id);
    }

    public static function user_inappp_html($app_id, $a = false)
    {
        $userdata = array(
            'department' => array(
                'education' => 'חינוך'
            )
        );
        $m = DB::table('apps_meta')->where([
            ['app_id', '=', $app_id],
            ['meta_name', '=', 'app_users'],
        ])->first();
        if (!empty($m)) {
            $ids = explode(',', $m->meta_value);
            $Users = User::select("name", "id")->whereIn('id', $ids)->get();
            $html = '';
            foreach ($Users as $key => $User) {
                $role = DB::table('users_meta')
                    ->where([
                        ['user_id', '=', $User->id],
                        ['meta_name', '=', 'user_role'],
                    ])->first();
                if (!empty($role) && !empty($role->meta_value)) {
                    $rol = '-' . $role->meta_value;
                } else {
                    $rol = '';
                }
                $h = !$a ? '<a href="#" class="remove_user_inappp" data-id="' . $User->id . '">X</a>' : '';
                $html .= '<div>' . $h . $User->name . $rol . '</div>';
            }
            return $html;
        }
        return false;
    }
    public static function remove_user_inappp($request)
    {
        $id = $request->id;
        $app_id = $request->app_id;
        $m = DB::table('apps_meta')->where([
            ['app_id', '=', $app_id],
            ['meta_name', '=', 'app_users'],
        ])->first();
        if (!empty($m)) {
            $ids = explode(',', $m->meta_value);
            if (($key = array_search($id, $ids)) !== false) {
                unset($ids[$key]);
                $ids = implode(",", $ids);
                DB::table('apps_meta')
                    ->where([
                        ['app_id', '=', $app_id],
                        ['meta_name', '=', 'app_users'],
                    ])
                    ->update(['meta_value' => $ids]);
            }
        }
        return self::user_inappp_html($app_id);
    }

    public static function get_erur_url($app)
    {

        $form = DB::table('forms')->where([
            ['id', '=', $app->form_id],
        ])->first();
        if (empty($form)) return '#';

        $url = url('/') . '/' . $form->url . '/erur/' . base64_encode($app->id);

        return $url;
    }

    public static function send_form3($request, $app, $to)
    {
        $app_id = $request->appid;
        $data = array();
        $type = !empty($request->type) ? $request->type : '1';
        if ($type == "decline") {
            $status = $app->status == 8 ? 10 : 5;
            $description = 'הבקשה נדחה ';
            $type = 2;
            $data['option'] = $request->option;
            $data['date'] = $request->msg;
            $data['erur_url'] = self::get_erur_url($app);
        } else {
            $status = $app->status == 8 ? 9 : 4;
            $description = "הבקשה אושרה עם התחייבות";
        }
        $answer_meta_name = $app->status == 8 ? 'answer_pdf_2' : 'answer_pdf';
        $fail_name = uniqid() . '_' . time();
        $metaJson = unserialize(self::get_meta_value($app->id, 'metaJson'));
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
        $footerHtml = view()->make('pdf.footer')->render();
        $headerHtml = view()->make('pdf.header')->render();
        $pdf = PDF::loadView('pdf.pdfview_form' . $app->form_id . '_' . $type, [
            'send_date' => date('d/m/Y', strtotime($app->send_date)),
            'metaJson' => $metaJson,
            'data' => $data,
            'app' => $app,
            'users' => self::user_inappp_html($app_id, true) . ' ' . self::user_outapp_html($app_id, true)
        ])->setPaper('A4')->setOrientation('portrait');
        $pdf->setOption('header-html', $headerHtml);
        $pdf->setOption('footer-html', $footerHtml);
        $pdf->setOption('margin-top', 50);
        $pdf->setOption('margin-left', 10);
        $pdf->setOption('margin-right', 10);
        $filepath = public_path('upload/admin/' . $fail_name . '.pdf');
        $pdf->save($filepath);
        $body = '';
        if (file_exists($filepath)) {
            DB::table('apps_logs')->insert([
                ['app_id' => $app_id, 'description' => $description]
            ]);
            DB::table('apps_meta')->insert([
                ['app_id' => $app_id, 'meta_name' => $answer_meta_name, 'meta_value' => $fail_name . '.pdf'],
            ]);
            DB::table('applications')->where('id', $app_id)->update(['status' => $status]);
            Applications::sendmail($to, $body, 'app', $filepath, '');
            return 'success';
        } else {
            return 'error';
        }
    }
    public static function find_dep_csv($filename, $text)
    {
        $result = false;
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                if ($data[0] == $text) {
                    $result = $data;
                    break;
                }
            }
            fclose($handle);
        }
        return $result;
    }
    public static function actions_form($request)
    {
        $app_id = $request->appid;
        if (empty($app_id))  return 'error1';
        $type = !empty($request->type) ? $request->type : '1';
        $app = DB::table('applications')->where('id', '=', $app_id)->first();
        if (empty($app))  return 'error2';
        $to[] = $app->email;
        $m = DB::table('apps_meta')->where([
            ['app_id', '=', $app_id],
            ['meta_name', '=', 'app_users'],
        ])->first();
        if (!empty($m)) {
            $ids = explode(',', $m->meta_value);
            $Users = User::select("email")->whereIn('id', $ids)->get();
            foreach ($Users as $key => $User) {
                $to[] = $User->email;
            }
        }
        if ($app->form_id == 3) {
            return  self::send_form3($request, $app, $to);
        } elseif ($type == "decline") {
            DB::table('applications')
                ->where('id', $app_id)
                ->update(['status' => 5]);
            $body = $request->msg;
            $description = 'הבקשה נדחה <br> :סיבת הדחייה  ' . $request->msg;
            DB::table('apps_logs')->insert([
                ['app_id' => $app_id, 'description' => $description]
            ]);
            Applications::sendmail($to, $body, 'app', '', '');
            return 'success';
        } else {
            if ($type == 2) {
                $status = 7;
                $description = " הבקשה אושרה בלי התחייבות";
                DB::table('apps_logs')->insert([
                    ['app_id' => $app_id, 'description' => $description]
                ]);
            } else {
                if ($app->form_id == 1) {
                    $status = 6;
                } else {
                    $status = 4;
                }
                $description = "הבקשה אושרה עם התחייבות";
                DB::table('apps_logs')->insert([
                    ['app_id' => $app_id, 'description' => $description]
                ]);
            }
            $fail_name = uniqid() . '_' . time();
            $metaJson = unserialize(Applications::get_meta_value($app_id, 'metaJson'));
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
            $footerHtml = view()->make('pdf.footer')->render();
            $headerHtml = view()->make('pdf.header')->render();
            if ($app->form_id == 4) {
                $metaJson['departmentdetails'] = self::find_dep_csv(public_path('DepartmentDetails_' . $app->department . '.csv'), $request->msg);
            }
            $pdf = PDF::loadView('pdf.pdfview_form' . $app->form_id . '_' . $app->department . $type, [
                'send_date' => date('d/m/Y', strtotime($app->send_date)),
                'metaJson' => $metaJson,
                'msg' => $request->msg,
                'app' => $app,
                'users' => self::user_inappp_html($app_id, true) . ' ' . self::user_outapp_html($app_id, true)
            ])->setPaper('A4')->setOrientation('portrait');
            $pdf->setOption('header-html', $headerHtml);
            $pdf->setOption('footer-html', $footerHtml);
            $pdf->setOption('margin-top', 50);
            // $pdf->setOption('margin-bottom',10);
            $pdf->setOption('margin-left', 10);
            $pdf->setOption('margin-right', 10);
            $filepath = public_path('upload/admin/' . $fail_name . '.pdf');
            $pdf->save($filepath);
            $body = $request->msg;
            if (file_exists($filepath)) {
                DB::table('apps_meta')->insert([
                    ['app_id' => $app_id, 'meta_name' => 'answer_pdf', 'meta_value' => $fail_name . '.pdf'],
                ]);
                DB::table('applications')->where('id', $app_id)->update(['status' => $status]);
                Applications::sendmail($to, $body, 'app', $filepath, '');
                return 'success';
            } else {
                return 'error';
            }
        }
    }

    public static function email_to_user($request)
    {


        $app_id = $request->appid;
        if (empty($app_id) && $request->type != 'cvmail')  return 'error1';
        $type = !empty($request->type) ? $request->type : '1';
        Log::debug('$app_id: ' . $app_id);
        $decisions = DB::table('app_decisions')->where(["id" => $request->id])->first();
        $app = DB::table('applications')->where('id', '=', $decisions->p5_id)->first();
        if (empty($app) && $request->type != 'cvmail')  return 'error2';
        $user = \App\User::getCCurrentUser();
        $logText = '';
        $to[] = $app->email;
        Log::debug('$id: ' . $request->id);
        Log::debug('Email: ' . $app->email);

        $tender = DB::table('tenders')->where(["generated_id" => $decisions->tenderval])->first();


        $date = $request->type . '_date';
        $time = $request->type . '_time' ?? '';
        $place = $request->type . '_place';
        $msg = $request->type . '_msg';

        // if ($type == 'committee'){
        //     $allDec = AppDecisions::where('tenderval',$decisions->tenderval)->whereNotNull('approved_interview_place')->whereNotNull('approved_interview_time')->whereNotNull('invitation_accept_time')->get();

        //     try {
        //         foreach ($allDec as $key => $app_dec) {
        //             $request1 = $request->merge([
        //                 'appid' => $app_dec->id,
        //                 'id' => $app_dec->id,
        //             ]);
        //             self::email_to_user1($request1);
        //         }
        //         return "success";
        //     } catch (\Throwable $th) {
        //         //throw $th;
        //         return "error";
        //     }
        // }

        if ($type == 'interview') {
            $body = 'שלום,<br>מצ״ב זימון לראיון ראשוני.';
            $logText = ' נשלח למועמד זימון לראיון ראשוני על ידי ' . $user;
        }
        if ($type == 'test') {
            $body = 'שלום,<br>מצ״ב זימון לבחינה בכתב.';
            $logText = ' נשלח למועמד זימון לבחינה בכתב על ידי ' . $user;

            if (is_array($request->$date) and count($request->$date) > 0) {

                $request->$date = collect($request->$date)->map(function ($v, $k) {
                    return now()->parse($v)->format('d/m/Y') . ' 08:00';
                });
                $request_date = json_encode($request->$date);
            }

            if (is_array($request->$place) and count($request->$place) > 0) {
                $request_place = json_encode($request->$place);
            }

            // $app->selected_inview_time = $request->$date;
            AppDecisions::find($request->id)->update(['selected_interview_time' => $request_date, 'selected_interview_place' => $request_place, 'last_interview_invitation_send' => now()]);
        }
        if ($type == 'committee') {
            $body = 'שלום,<br>מצ״ב זימון לועדת בחינה.';
            $logText = ' נשלח למועמד זימון לועדת בחינה על ידי ' . $user;



            AppDecisions::find($request->id)->update([
                'approved_committee_time' =>  Carbon::createFromFormat('d m, Y H:i', $request->$date . ' ' . $request->$time),
                'last_committee_invitation_send' => now(),
                'committee_selected_place' => $request->$place
            ]);

            $request->$date = Carbon::createFromFormat('d m, Y H:i', $request->$date . ' ' . $request->$time)->format('d.m.Y');
        }
        if ($type == 'gotit') {
            $body = 'שלום,<br>מצ״ב זימון לאחר זכיה במכרז.';
            $logText = ' נשלח למועמד זימון לאחר זכיה במכרז על ידי ' . $user;
        }
        DB::table('apps_logs')->insert([

            //['app_id' => $app_id, 'description' => $logText]
            ['app_id' => $request->id, 'description' => $logText]
        ]);

        try {
            $pdf = PDF::loadView('pdf.pdfview_email' . $app->form_id . '_' . $type, [
                'send_date' => date('d/m/Y', strtotime($app->send_date)),
                'full_name' => $decisions->applicant_name,
                'tendername' => $tender->tname,
                'decId' => $request->id,
                'date' => is_array($request->$date) ? collect($request->$date)->join(', ', ' or ') : $request->$date,
                'time' => is_array($request->$time) ? collect($request->$time)->join(', ', ' or ') : $request->$time,
                'place' => is_array($request->$place) ? collect($request->$place)->join(', ', ' or ') : $request->$place,
                'test_info' => [
                    'date' => $request->$date,
                    'place' => $request->$place
                ],
                'msg' => $request->$msg,
                'app' => $app,
                'users' => self::user_inappp_html($app_id, true) . ' ' . self::user_outapp_html($app_id, true),
                'email' => $decisions->email,
                'request' => $request,
                'app_dec' => $decisions
            ])->setPaper('A4')->setOrientation('portrait');
            $pdf->setOption('margin-left', 10);
            $pdf->setOption('margin-right', 10);

            $fail_name = uniqid() . '_' . time();
            $filepath = public_path('upload/admin/' . $fail_name . '.pdf');
            $pdf->save($filepath);
        } catch (\Throwable $th) {
            // throw $th;
            // Log::error("view error ");
            // Log::error($decisions);
        }

            if (file_exists($filepath)) {
            $answer_meta_name = $request->type . '_email';
            DB::table('apps_meta')->insert([
                ['app_id' => $request->id, 'meta_name' => $answer_meta_name, 'meta_value' => $fail_name . '.pdf'],
            ]);
            $encryptionService = app(EncryptionService::class);
            DB::table('apps_file')->insert([
                [
                    'app_id' => $app_id,
                    'url' => $encryptionService->encrypt($fail_name . '.pdf'),
                    'type' => 'pdf',
                    'file_name' => $encryptionService->encrypt($answer_meta_name),
                    'status' => '1',
                    'encryption_key_slot' => $encryptionService->getCurrentKeySlot()
                ],
            ]);
            //DB::table('applications')->where('id', $app_id)->update(['status' => $status]);
            Applications::sendmail($to, $body, 'app', $filepath, 'משאבי אנוש - עריית רמלה', $tender->tname);
            if ($type == 'interview') {
                $meta_data[] = ['app_id' => $request->id, 'meta_name' => 'email_msg_interview', 'meta_value' => 'מייל זימון לראיון נשלח בהצלחה'];
            }
            if ($type == 'test') {
                $meta_data[] = ['app_id' => $request->id, 'meta_name' => 'email_msg_test', 'meta_value' => 'מייל זימון לבחינה בכתב נשלח בהצלחה'];
            }
            if ($type == 'committee') {
                $meta_data[] = ['app_id' => $request->id, 'meta_name' => 'email_msg_committee', 'meta_value' => 'מייל זימון לועדת בחינה נשלח בהצלחה'];
                $meta_data[] = ['app_id' => $request->id, 'meta_name' => 'committee_date', 'meta_value' => $request->$date];

                DB::table('app_decisions')->where('id', '=', $request->id)->update(['decision_' . $type => 1]);
            }
            if ($type == 'gotit') {
                $meta_data[] = ['app_id' => $request->id, 'meta_name' => 'email_msg_gotit', 'meta_value' => 'מייל זימון לאחר זכיה במכרז נשלח בהצלחה'];
            }
            \App\Forms::insert_meta($meta_data);
            return 'success';
        } else {
            return 'error';
        }
    }

    public static function email_to_user1($request)
    {
        $app_id = $request->appid;
        if (empty($app_id) && $request->type != 'cvmail')  return 'error1';
        $type = !empty($request->type) ? $request->type : '1';
        Log::debug('$app_id: ' . $app_id);
        $app = DB::table('applications')->where('id', '=', $app_id)->first();
        if (empty($app) && $request->type != 'cvmail')  return 'error2';
        $user = \App\User::getCCurrentUser();
        $logText = '';
        $to[] = $app->email;
        Log::debug('$id: ' . $request->id);
        $decisions = DB::table('app_decisions')->where(["id" => $request->id])->first();
        $tender = DB::table('tenders')->where(["generated_id" => $decisions->tenderval])->first();

        $date = $request->type . '_date';
        $time = $request->type . '_time' ?? '';
        $place = $request->type . '_place';
        $msg = $request->type . '_msg';

        if ($type == 'interview') {
            $body = 'שלום,<br>מצ״ב זימון לראיון ראשוני.';
            $logText = ' נשלח למועמד זימון לראיון ראשוני על ידי ' . $user;
        }
        if ($type == 'test') {
            $body = 'שלום,<br>מצ״ב זימון לבחינה בכתב.';
            $logText = ' נשלח למועמד זימון לבחינה בכתב על ידי ' . $user;

            if (is_array($request->$date) and count($request->$date) > 0) {
                $request_date = json_encode($request->$date);
            }

            if (is_array($request->$place) and count($request->$place) > 0) {
                $request_place = json_encode($request->$place);
            }

            // $app->selected_inview_time = $request->$date;
            AppDecisions::find($request->id)->update(['selected_interview_time' => $request_date, 'selected_interview_place' => $request_place, 'last_invitation_send' => now()]);
        }
        if ($type == 'committee') {
            $body = 'שלום,<br>מצ״ב זימון לועדת בחינה.';
            $logText = ' נשלח למועמד זימון לועדת בחינה על ידי ' . $user;
        }
        if ($type == 'gotit') {
            $body = 'שלום,<br>מצ״ב זימון לאחר זכיה במכרז.';
            $logText = ' נשלח למועמד זימון לאחר זכיה במכרז על ידי ' . $user;
        }
        DB::table('apps_logs')->insert([

            //['app_id' => $app_id, 'description' => $logText]
            ['app_id' => $request->id, 'description' => $logText]
        ]);

        try {
            $pdf = PDF::loadView('pdf.pdfview_email' . $app->form_id . '_' . $type, [
                'send_date' => date('d/m/Y', strtotime($app->send_date)),
                'full_name' => $decisions->applicant_name,
                'tendername' => $tender->tname,
                'decId' => $request->id,
                'date' => is_array($request->$date) ? collect($request->$date)->join(', ', ' or ') : $request->$date,
                'time' => is_array($request->$time) ? collect($request->$time)->join(', ', ' or ') : $request->$time,
                'place' => is_array($request->$place) ? collect($request->$place)->join(', ', ' or ') : $request->$place,
                'test_info' => [
                    'date' => $request->$date,
                    'place' => $request->$place
                ],
                'msg' => $request->$msg,
                'app' => $app,
                'users' => self::user_inappp_html($app_id, true) . ' ' . self::user_outapp_html($app_id, true),
                'email' => $decisions->email,
                'request' => $request,
                'app_dec' => $decisions
            ])->setPaper('A4')->setOrientation('portrait');
            $pdf->setOption('margin-left', 10);
            $pdf->setOption('margin-right', 10);

            $fail_name = uniqid() . '_' . time();
            $filepath = public_path('upload/admin/' . $fail_name . '.pdf');
            $pdf->save($filepath);
        } catch (\Throwable $th) {
            // throw $th;
        }

        if (file_exists($filepath)) {
            $answer_meta_name = $request->type . '_email';
            DB::table('apps_meta')->insert([
                ['app_id' => $request->id, 'meta_name' => $answer_meta_name, 'meta_value' => $fail_name . '.pdf'],
            ]);
            $encryptionService = app(EncryptionService::class);
            DB::table('apps_file')->insert([
                [
                    'app_id' => $app_id,
                    'url' => $encryptionService->encrypt($fail_name . '.pdf'),
                    'type' => 'pdf',
                    'file_name' => $encryptionService->encrypt($answer_meta_name),
                    'status' => '1',
                    'encryption_key_slot' => $encryptionService->getCurrentKeySlot()
                ],
            ]);
            //DB::table('applications')->where('id', $app_id)->update(['status' => $status]);
            Applications::sendmail($to, $body, 'app', $filepath, 'משאבי אנוש - עריית רמלה', $tender->tname);
            if ($type == 'interview') {
                $meta_data[] = ['app_id' => $request->id, 'meta_name' => 'email_msg_interview', 'meta_value' => 'מייל זימון לראיון נשלח בהצלחה'];
            }
            if ($type == 'test') {
                $meta_data[] = ['app_id' => $request->id, 'meta_name' => 'email_msg_test', 'meta_value' => 'מייל זימון לבחינה בכתב נשלח בהצלחה'];
            }
            if ($type == 'committee') {
                $meta_data[] = ['app_id' => $request->id, 'meta_name' => 'email_msg_committee', 'meta_value' => 'מייל זימון לועדת בחינה נשלח בהצלחה'];
                $meta_data[] = ['app_id' => $request->id, 'meta_name' => 'committee_date', 'meta_value' => $request->$date];

                DB::table('app_decisions')->where('id', '=', $request->id)->update(['decision_' . $type => 1]);
            }
            if ($type == 'gotit') {
                $meta_data[] = ['app_id' => $request->id, 'meta_name' => 'email_msg_gotit', 'meta_value' => 'מייל זימון לאחר זכיה במכרז נשלח בהצלחה'];
            }
            \App\Forms::insert_meta($meta_data);
            return 'success';
        } else {
            return 'error';
        }
    }

    public static function generate_pdf($request, $form)
    {
        $error['error'] = 'אירעה שגיאה לא צפויה, אנא רענן את הדף ונסה שוב עכשיו או אחר כך.';
        $tid = $request->tenderid;
        if (empty($tid)) {
            return $error;
        }
        $res = array();

        if (!empty($request->codename) && $request->codename > 0 && isset($request->pdf)) {
            $appID = $request->codename;
            $pdf = $request->pdf;
            DB::table('apps_meta')->where([['app_id', '=', $appID], ['meta_name', '=', 'data']])->update(['meta_value' => $request->data_val]);
            DB::table('apps_file')->where([
                ['app_id', '=', $appID],
                ['type', '=', 'protocol.pdf'],
                ['url', '=', $pdf]
            ])->delete();
        }
        $pdf_name = uniqid() . '_' . time();
        $html = public_path('upload/' . $pdf_name . '.html');
        $html_j = public_path('upload/' . $pdf_name . '.json');
        file_put_contents($html, $request->html);
        file_put_contents($html_j, json_encode($form));
        $pdfpath = public_path('upload/' . $pdf_name . '.pdf');

        $filenameh = public_path('upload/' . str_replace('.pdf', '.html', $pdf_name . '.pdf'));
        $filenamef = public_path('upload/' . str_replace('.pdf', '.json', $pdf_name . '.pdf'));
        if (file_exists($filenameh) && file_exists($filenamef)) {
            $html = file_get_contents($filenameh);
            $form = json_decode(file_get_contents($filenamef));
            $pdf = PDF::loadView('pdf.form', [
                'formhtml' => $html,
                'form' => $form,
            ])->setPaper('A4')->setOrientation('portrait');
        }
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 5000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        $pdf->setOption('margin-top', 10);
        $pdf->setOption('margin-bottom', 0);
        $pdf->setOption('margin-left', 0);
        $pdf->setOption('margin-right', 0);
        $pdf->save($pdfpath);
        $file_name = '';
        if ($form->id == 6) {
            $file_name = 'זכרון-דברים מיום ' . date('d/m/Y');
            $type = 'zichron-devarim.pdf';
        }
        if ($form->id == 7) {
            $file_name = 'פרוטוקול מיום ' . date('d/m/Y');
            $type = 'protocol.pdf';
        }
        $file_data[] = [
            'app_id' => $tid,
            'url' => $pdf_name . '.pdf',
            'type' => $type,
            'file_name' => $file_name,
            'status' => '0'
        ];
        \App\Forms::insert_file($file_data);
        $meta_data = [
            ['app_id' => $tid, 'meta_name' => 'data', 'meta_value' => $request->data_val],
            ['app_id' => $tid, 'meta_name' => 'protocol_file', 'meta_value' => $pdf_name . '.pdf']
        ];
        \App\Forms::insert_meta($meta_data);
        $res['pdfname'] = $pdf_name;
        $res['tenderid'] = $tid;
        return $res;
    }

    public static function app_forms_url($form_id)
    {
        $form = DB::table('forms')->where([
            ['id', '=', $form_id],
        ])->first();
        if (empty($form))  return '';
        return $form->url;
    }

    public static function upload_file($request)
    {
        $appID = $request->applicationid;
        $res = array();
        if ($request->hasFile('file') && !empty($request->file)) {
            $res['file_errors'] = array();
            $file = $request->file;
            if ((!in_array($file->getClientmimeType(), \App\Forms::$acceptable)) && (!empty($file->getClientmimeType()))) {
                return $res['file_errors'][] = 'Invalid file type.';
                //break;
            }
            if ($file->getSize() >= 20971520 || $file->getSize() == 0) {
                return $res['file_errors'][] = 'File too large. File must be less than 2 megabytes.';
                //break;
            }
            $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/admin/'), $filename);
            $file_data[] = [
                'app_id' => $appID,
                'url' => $filename,
                'type' => 'no',
                'file_name' => $file->getClientOriginalName(),
                'status' => '0'
            ];
            \App\Forms::insert_file($file_data);
            $meta_data = [
                ['app_id' => $appID, 'meta_name' => 'upload_admin_file', 'meta_value' => $filename]
            ];
            \App\Forms::insert_meta($meta_data);
            $res['filename'] = $filename;
            $res['appID'] = $appID;
        }
        return json_encode($res);
    }

    public static function cancel_tender($id)
    {
        $decisions = DB::table('app_decisions')->where(["id" => $id])->first();
        $tender = DB::table('tenders')->where(["generated_id" => $decisions->tenderval])->first();
        $sender = $decisions->email;
        $arr["decision_2"] = 1;
        $arr["decision_2_comment"] = 'מועמד דחה צפיות שכר';

        $arr["invitation_rejected_by_user"] = 1;
        $arr["decision_rejectedbyuser"] = 1;

        if (request()->get('src') == 'second-invitation') {
            $arr['2nd_invitation_rejected'] = 1;
        }


        $logText = 'מועמד דחה ציפיות שכר';
        DB::table('apps_logs')->insert([
            ['app_id' => $id, 'description' => $logText]
        ]);
        $rss = DB::table('app_decisions')->where('id', '=', $id)->update($arr);
        $pdf = PDF::loadView('pdf.pdfview_reject0b', [
            'full_name' => $decisions->applicant_name,
            'tendername' => $tender->tname,
            'tenderval' => $decisions->tenderval,
            'email' => $decisions->email
        ])->setPaper('A4')->setOrientation('portrait');
        $pdf->setOption('margin-left', 10);
        $pdf->setOption('margin-right', 10);
        $fail_name = uniqid() . '_' . time();
        $filename = public_path('upload/admin/' . $fail_name . '.pdf');
        $pdf->save($filename);
        $body = '<h3>תודה על פנייתכם, מצ"ב:</h3>
                    <ol>
                        <li>טופס הבקשה שמילאתם.</li>
                        <li>מסמך מנהל משאבי אנוש. </li>
                    </ol><br><br>
                    ברכה, <br>
                    מנהל משאבי אנוש';
        $to[] = $sender;
        $m = DB::table('apps_meta')->where([
            ['app_id', '=', $id],
            ['meta_name', '=', 'app_users'],
        ])->first();
        if (!empty($m)) {
            $ids = explode(',', $m->meta_value);
            $Users = \App\User::select("email")->whereIn('id', $ids)->get();
            foreach ($Users as $key => $User) {
                $to[] = $User->email;
            }
        }
        $files = array($filename);


            if (file_exists($filename)) {
            Mail::to($to)->send(new SendMailable($body, $files, 'app', 'מכרז למשרת ' . $tender->tname . ' - מועצה מקומית קריית ארבע חברון'));
            $meta_data[] = ['app_id' => $id, 'meta_name' => 'email_msg', 'meta_value' => 'מייל נשלח בהצלחה'];
            \App\Forms::insert_meta($meta_data);
            $encryptionService = app(EncryptionService::class);
            $fileID = DB::table('apps_file')->insertGetId([
                'app_id' => $decisions->p5_id,
                'url' => $encryptionService->encrypt($fail_name . ".pdf"),
                'type' => 'pdf',
                'file_name' => $encryptionService->encrypt('decisionreject0b.pdf'),
                'status' => 1,
                'encryption_key_slot' => $encryptionService->getCurrentKeySlot()
            ]);
        } else {
            return 'error';
        }
        return 'success';
    }

    public static function send_all_decision($request)
    {
        $view = $request->view;
        if (empty($view)) {
            $res = ["res" => "nok", "error" => "view is empty"];
            return json_encode($res);
        }
        //Log::debug('$request->app_ids'.json_encode($request->app_ids));
        $app_ids = $request->app_ids;
        if (empty($app_ids)) {
            $res = ["res" => "nok", "error" => "app_ids is empty"];
            return json_encode($res);
        }
        $committee_meetings = $request->committee_meetings;
        $committee_meeting_data = $request->committee_meeting_data;
        $app_ids_arr = explode(',', $app_ids);
        if (count($app_ids_arr) > 0) {
            try {
                foreach ($app_ids_arr as $id) {
                    //Log::debug('$id'.$id);
                    $decision = DB::table('app_decisions')->where(["id" => $id])->first();
                    $tender = DB::table('tenders')->where(["generated_id" => $decision->tenderval])->first();
                    $apps_meta  = Applications::get_all_meta($id);
                    $p5 = $decision->p5_id;
                    $view_name = "decision" . $view . ".pdf";
                    Log::debug('$p5' . $p5);
                    Log::debug('$view_name' . $view_name);
                    /*
					$decfile = DB::table('apps_file')->where([
						["file_name", "=", $view_name],
						["app_id", "=", $p5]
					])->first();
					*/
                    $to = $decision->email;
                    //Log::debug('$to'.$to);
                    $body = 'מצורף מכתב מאגף משאבי אנוש עיריית מעלה אדומים.';
                    $user = \App\User::getCCurrentUser();
                    $data = [
                        'send_date' => date('d/m/Y'),
                        'sender' => $to,
                        'tenderval' => $decision->tenderval,
                        'comment_text_reject_value' => '',
                        'comment' => '',
                        'decision_1' => '',
                        'decision_2' => '',
                        'decision_3' => '',
                        'decision_4' => '',
                        'p5_id' => $decision->p5_id,
                        'formid' => date('Y') . '-' . $decision->id,
                        'decId' => $decision->id,
                        'users' => Applications::user_inappp_html($decision->id, true) . ' ' . self::user_outapp_html($id, true),
                        'full_name' => $decision->applicant_name,
                        'tendername' => $tender->tname,
                        'committee_date' => isset($apps_meta['committee_date']) ? $apps_meta['committee_date'] : '',
                        'email' => $decision->email,
                        'committee_meetings' => $committee_meetings,
                        'committee_meeting_data' => $committee_meeting_data,
                        'logText' => 'מייל מרוכז נשלח על ידי ' . $user
                    ];
                    $pdf = PDF::loadView('pdf.pdfview_' . $view, $data)->setPaper('A4')->setOrientation('portrait');
                    $pdf->setOption('margin-left', 10);
                    $pdf->setOption('margin-right', 10);
                    $fail_name = uniqid() . '_' . time();
                    if ($view == "committee") {
                        $filename = public_path('upload/' . $fail_name . '.pdf');
                    } else {
                        $filename = public_path('upload/admin/' . $fail_name . '.pdf');
                    }
                    $pdf->save($filename);
                    $files = array($filename);
                    if (file_exists($filename)) {
                        Mail::to($to)->send(new SendMailable($body, $files, 'app', 'מכרז למשרת ' . $tender->tname . ' - מועצה מקומית קריית ארבע חברון'));
                        $meta_data[] = ['app_id' => $id, 'meta_name' => 'email_msg', 'meta_value' => 'מייל נשלח בהצלחה'];
                        \App\Forms::insert_meta($meta_data);
                        $encryptionService = app(EncryptionService::class);
                        if ($view == "committee") {
                            $meta_data[] = ['app_id' => $id, 'meta_name' => 'committee', 'meta_value' => $committee_meetings . "@#$#@" . $committee_meeting_data];
                            \App\Forms::insert_meta($meta_data);
                            $fileID = DB::table('apps_file')->insertGetId([
                                'app_id' => $data["p5_id"],
                                'url' => $encryptionService->encrypt($fail_name . ".pdf"),
                                'type' => 'no',
                                'file_name' => $encryptionService->encrypt($decision->applicant_name . '@הַזמָנָה^^הַזמָנָה'),
                                'status' => 0,
                                'encryption_key_slot' => $encryptionService->getCurrentKeySlot()
                            ]);
                        } else {
                            $fileID = DB::table('apps_file')->insertGetId([
                                'app_id' => $data["p5_id"],
                                'url' => $encryptionService->encrypt($fail_name . ".pdf"),
                                'type' => 'pdf',
                                'file_name' => $encryptionService->encrypt('decision' . $view . '.pdf'),
                                'status' => 1,
                                'encryption_key_slot' => $encryptionService->getCurrentKeySlot()
                            ]);
                        }

                        DB::table('apps_logs')->insert([['app_id' => $id, 'description' => $data["logText"]]]);
                    } else {
                        $res = ["res" => "nok", "error" => "error from else"];
                        return json_encode($res);
                    }
                }
            } catch (\Exception $e) {
                $res = ["res" => "nok", "error" => $e->getMessage()];
                return json_encode($res);
            }
            $res = ["res" => "ok", "message" => "מייל נשלח בהצלחה"];
            return json_encode($res);
        } else {
            $res = ["res" => "nok", "error" => "data is empty"];
            return json_encode($res);
        }
    }

    public static function add_user_outapp($request)
    {
        $name = $request->name;
        $role = $request->role;
        $email = $request->email;
        $app_id = $request->app_id;
        $m = DB::table('apps_meta')->where([
            ['app_id', '=', $app_id],
            ['meta_name', '=', 'app_outer_users'],
        ])->first();
        if (empty($m)) {
            DB::table('apps_meta')->insert([
                ['app_id' => $app_id, 'meta_name' => 'app_outer_users', 'meta_value' => $name . ',' . $role . ',' . $email . ';'],
            ]);
        } else {
            $details = explode(',', $m->meta_value);
            if (!in_array($name, $details) && !in_array($role, $details) && !in_array($email, $details)) {
                DB::table('apps_meta')
                    ->where([
                        ['app_id', '=', $app_id],
                        ['meta_name', '=', 'app_outer_users'],
                    ])
                    ->update(['meta_value' => $m->meta_value . $name . ',' . $role . ',' . $email . ';']);
            }
        }
        $description = 'נוסף נעמן לקבלת העתקים של תשובות  ' . $name;
        DB::table('apps_logs')->insert([
            ['app_id' => $app_id, 'description' => $description]
        ]);
        return self::user_outapp_html($app_id);
    }

    public static function user_outapp_html($app_id, $a = false)
    {
        $m = DB::table('apps_meta')->where([
            ['app_id', '=', $app_id],
            ['meta_name', '=', 'app_outer_users'],
        ])->first();
        if (!empty($m)) {
            $outers = explode(';', $m->meta_value);
            $html = '';
            foreach ($outers as $key => $User) {
                $details = explode(',', $User);
                $length = count($details);
                if ($length > 1) {
                    $rol = $details[0] . '-' . $details[1];
                    $h = !$a && $User != '' ? '<a href="#" class="remove_user_outapp" data-name="' . $User . '">X</a>' : '';
                    $html .= '<div>' . $h . $rol . '</div>';
                }
            }
            return $html;
        }
        return false;
    }
    public static function remove_user_outapp($request)
    {
        $name = $request->name;
        $app_id = $request->app_id;
        $m = DB::table('apps_meta')->where([
            ['app_id', '=', $app_id],
            ['meta_name', '=', 'app_outer_users'],
        ])->first();
        if (!empty($m)) {
            $outers = explode(';', $m->meta_value);
            if (($key = array_search($name, $outers)) !== false) {
                unset($outers[$key]);
                $outers = implode(";", $outers);
                DB::table('apps_meta')
                    ->where([
                        ['app_id', '=', $app_id],
                        ['meta_name', '=', 'app_outer_users'],
                    ])
                    ->update(['meta_value' => $outers]);
            }
        }
        return self::user_outapp_html($app_id);
    }
}
