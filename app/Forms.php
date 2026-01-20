<?php

namespace App;

use App\Http\Controllers\TendersController;
use App\Mail\SendMailable;
use App\Models\AppDecisions;
use App\Models\Tender;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
//use PDF;
//use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Forms extends Model
{
	public static function getFF()
	{
		//echo('call');
		//echo (json_encode(self::$form_files));
		return self::$form_files;
	}


	public static function getFFF()
	{
		$formFileNames = [];
		$formsNA = self::getFF();
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
		return $formFileNames;
	}

	public static $acceptable = array('application/pdf', 'image/jpeg', 'image/jpg', 'image/gif', 'image/png', 'image/jpe', 'image/tiff', 'image/bmp', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword', 'application/octet-stream', '.doc', '.docx');

	public static $form_files = [
		'1' => [
			['name' => 'diploma', 'title' => ' תעודת סיום תואר', 'show_type' => '', 'required' => ''],
			['name' => 'block1', 'title' => ' מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => 'required'],
			['name' => 'data_d', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'CV', 'title' => 'קורות חיים', 'show_type' => '', 'required' => ''],
			['name' => 'conditions_0', 'title' => 'תנאי סף', 'show_type' => '', 'required' => ''],
			['name' => 'conditions_1', 'title' => 'תנאי סף', 'show_type' => '', 'required' => ''],
			['name' => 'conditions_2', 'title' => 'תנאי סף', 'show_type' => '', 'required' => ''],
			['name' => 'conditions_3', 'title' => 'תנאי סף', 'show_type' => '', 'required' => ''],
			['name' => 'conditions_4', 'title' => 'תנאי סף', 'show_type' => '', 'required' => ''],
			['name' => 'conditions_5', 'title' => 'תנאי סף', 'show_type' => '', 'required' => ''],
			['name' => 'conditions_6', 'title' => 'תנאי סף', 'show_type' => '', 'required' => ''],

			['name' => 'conditions_7', 'title' => 'תנאי סף', 'show_type' => '', 'required' => ''],
			['name' => 'conditions_8', 'title' => 'תנאי סף', 'show_type' => '', 'required' => ''],
			['name' => 'conditions_9', 'title' => 'תנאי סף', 'show_type' => '', 'required' => ''],
			['name' => 'data_d1', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d2', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d3', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d4', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d5', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d6', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d7', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d8', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d9', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d10', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
		],
		'2' => [
			['name' => 'ת.ז וספח של הורה 1', 'show_type' => '', 'required' => 'required'],
			['name' => 'ת.ז וספח של הורה 2', 'show_type' => 'guardian_minor1||guardian_minor2', 'required' => ''],
			['name' => 'מכתב מהאחראי הנוסף', 'show_type' => 'guardian_minor1||guardian_minor2', 'required' => ''],
			['name' => 'פסק דין שמראה על אפוטרופוס', 'show_type' => 'guardian_minor1||guardian_minor2||guardian_minor3||guardian_minor4', 'required' => ''],
		],
		'3' => [
			['name' => 'file1', 'title' => ' מסמך רלוונטי (ילדי אתיופיה)', 'show_type' => '', 'required' => 'required'],
			//['name' => 'ת.ז וספח של הורה 2', 'show_type' => 'guardian_minor1||guardian_minor2', 'required' => ''],
			//['name' => 'מכתב מהאחראי הנוסף', 'show_type' => 'guardian_minor1||guardian_minor2', 'required' => ''],
			//	['name' => 'פסק דין שמראה על אפוטרופוס', 'show_type' => 'guardian_minor1||guardian_minor2||guardian_minor3||guardian_minor4', 'required' => ''],
		],
		'4' => [
			['name' => 'ת.ז וספח של הורה 1', 'show_type' => '', 'required' => 'required'],
			['name' => 'ת.ז וספח של הורה 2', 'show_type' => 'guardian_minor1||guardian_minor2', 'required' => ''],
			['name' => 'חוזה רכישה/ שכירות חדש', 'show_type' => '', 'required' => 'required'],
			['name' => 'טופס גריעה/ ביטול רישום מהאגף החינוך בעיר בה התגוררתם', 'show_type' => '', 'required' => 'required'],
			['name' => 'אישור מגורים ממזכירות היישוב', 'show_type' => '', 'required' => 'required'],
			['name' => 'מכתב מהאחראי הנוסף', 'show_type' => 'guardian_minor1||guardian_minor2', 'required' => ''],
			['name' => 'פסק דין שמראה על אפוטרופוס', 'show_type' => 'guardian_minor3||guardian_minor4', 'required' => ''],
			['name' => 'תעודת עולה ילד 1', 'show_type' => 'child_immigrant_yes1', 'required' => ''],
			['name' => 'תעודת עולה הורה 1', 'show_type' => 'child_immigrant_yes1', 'required' => ''],
			['name' => 'תעודת עולה הורה 2', 'show_type' => 'child_immigrant_yes1', 'required' => ''],
		],
		'5' => [
			['name' => 'block11', 'title' => ' מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => 'required'],
			['name' => 'data_d', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'CV', 'title' => 'קורות חיים', 'show_type' => '', 'required' => 'required'],
			['name' => 'tender_cond[0]', 'title' => 'תעודה המעידה על מספר שנות לימוד', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[1]', 'title' => 'תעודת בגרות', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[2]', 'title' => 'טכנאי', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[3]', 'title' => 'הנדסאי', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[4]', 'title' => 'לבורנט', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[5]', 'title' => 'תעודת הוראה', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[6]', 'title' => 'תואר ראשון', 'show_type' => '', 'required' => ''],
			//10
			['name' => 'tender_cond[7]', 'title' => 'תואר שני', 'show_type' => '', 'required' => ''],

			['name' => 'tender_cond[8]', 'title' => 'תעודת סמיכות לרבנות ("יורה יורה")', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[9]', 'title' => 'אישור לימודים מישיבה גבוהה או מכולל', 'show_type' => '', 'required' => ''],
			['name' => 'data_d1', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d2', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d3', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d4', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d5', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d6', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d7', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			//20
			['name' => 'data_d8', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d9', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d10', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d11', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => 'required'],
			['name' => 'data_d12', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d13', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d14', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d15', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d16', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d17', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			//30
			['name' => 'data_d18', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],

			['name' => 'data_d19', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d20', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d21', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d22', 'title' => 'רשיון נהיגה', 'show_type' => '', 'required' => ''],
			['name' => 'block1', 'title' => ' מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block2', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block3', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block4', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block5', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			//40
			['name' => 'block6', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block7', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block8', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block9', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block10', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d23', 'title' => 'נסיון ניהולי', 'show_type' => '', 'required' => ''],
			['name' => 'data_d24', 'title' => 'נסיון ניהולי', 'show_type' => '', 'required' => ''],
			['name' => 'data_d25', 'title' => 'נסיון ניהולי', 'show_type' => '', 'required' => ''],
			['name' => 'data_d26', 'title' => 'נסיון ניהולי', 'show_type' => '', 'required' => ''],
			['name' => 'data_d27', 'title' => 'נסיון ניהולי', 'show_type' => '', 'required' => ''],
			//50
			['name' => 'data_d28', 'title' => 'נסיון ניהולי', 'show_type' => '', 'required' => ''],

			['name' => 'data_d29', 'title' => 'נסיון ניהולי', 'show_type' => '', 'required' => ''],
			['name' => 'data_d30', 'title' => 'נסיון ניהולי', 'show_type' => '', 'required' => ''],
			['name' => 'data_d31', 'title' => 'נסיון ניהולי', 'show_type' => '', 'required' => ''],
			['name' => 'data_d32', 'title' => 'נסיון ניהולי', 'show_type' => '', 'required' => ''],
			//55
			['name' => 'data_d33', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d34', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d35', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d36', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d37', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			//60
			['name' => 'data_d38', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],

			['name' => 'data_d39', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d40', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d41', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d42', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d43', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d44', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d45', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d46', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d47', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			//70
			['name' => 'data_d48', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],

			['name' => 'data_d49', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d50', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d51', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d52', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d53', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d54', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d55', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d56', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			//80
			['name' => 'data_d57', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],

			['name' => 'data_d58', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d59', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d60', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d61', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d62', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d63', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d64', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d65', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],

			['name' => 'data_d66', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			//90
			['name' => 'data_d67', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d68', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d69', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d70', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d71', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d77', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d73', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d74', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d75', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],

			['name' => 'data_d76', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			//100
			['name' => 'data_d77', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d78', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d79', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d80', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d81', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d82', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d83', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d84', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d85', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],

			['name' => 'data_d86', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			//110
			['name' => 'data_d87', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d88', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d89', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d90', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d91', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d92', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d93', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d94', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d95', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],

			['name' => 'data_d96', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			//120
			['name' => 'data_d97', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d98', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d99', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d100', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d101', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d102', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d103', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d104', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d105', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],

			['name' => 'data_d106', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			//130
			['name' => 'data_d107', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d108', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d109', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d110', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d111', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d112', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d113', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d114', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d115', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],

			['name' => 'data_d116', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],

			['name' => 'data_d117', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			//140
			['name' => 'data_d118', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d119', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d120', 'title' => 'אישור העסקה', 'show_type' => '', 'required' => ''],
			//143
			['name' => 'block11', 'title' => ' מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block12', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block13', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block14', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block15', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block16', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			//150
			['name' => 'block17', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block18', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block19', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block20', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			//154
			['name' => 'block21', 'title' => ' מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block22', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block23', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block24', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block25', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block26', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			//160
			['name' => 'block27', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block28', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block29', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block40', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block41', 'title' => ' מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block42', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block43', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block44', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block45', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block46', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			//170
			['name' => 'block47', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block48', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block49', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block50', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block51', 'title' => ' מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block52', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block53', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block54', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block55', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block56', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			//180
			['name' => 'block57', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block58', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block59', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block60', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block61', 'title' => ' מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block62', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block63', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block64', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block65', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block66', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			//190
			['name' => 'block67', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block68', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block69', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block70', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block71', 'title' => ' מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block72', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block73', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block74', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block75', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block76', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			//200
			['name' => 'block77', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block78', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block79', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block80', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block81', 'title' => ' מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block82', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block83', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block84', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block85', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block86', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			//210
			['name' => 'block87', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block88', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block89', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block90', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block91', 'title' => ' מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block92', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block93', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block94', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block95', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block96', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			//220
			['name' => 'block97', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block98', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block99', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block100', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block101', 'title' => ' מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block102', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block103', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block104', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block105', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block106', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],

			['name' => 'block107', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			//230
			['name' => 'block108', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block109', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			['name' => 'block110', 'title' => 'מסמך רלוונטי (קורסים והשתלמויות)', 'show_type' => '', 'required' => ''],
			//233
			['name' => 'data_d23', 'title' => 'רשיון נהיגה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d24', 'title' => 'רשיון נהיגה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d25', 'title' => 'רשיון נהיגה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d26', 'title' => 'רשיון נהיגה', 'show_type' => '', 'required' => ''],

			['name' => 'data_d27', 'title' => 'רשיון נהיגה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d28', 'title' => 'רשיון נהיגה', 'show_type' => '', 'required' => ''],

			['name' => 'data_d29', 'title' => 'רשיון נהיגה', 'show_type' => '', 'required' => ''],
			//240
			['name' => 'data_d30', 'title' => 'רשיון נהיגה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d31', 'title' => 'רשיון נהיגה', 'show_type' => '', 'required' => ''],
			['name' => 'data_d32', 'title' => 'רשיון נהיגה', 'show_type' => '', 'required' => ''],
			//243
			['name' => 'data_d11', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d12', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d13', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d14', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d15', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d16', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			//250
			['name' => 'data_d17', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d18', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d19', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d20', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d21', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d22', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d23', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d24', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d25', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d26', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			//260
			['name' => 'data_d27', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d28', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d29', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d30', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d31', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d32', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d33', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d34', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d35', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d36', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			//270
			['name' => 'data_d37', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d38', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d39', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d40', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d41', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d42', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d43', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d44', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d45', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d46', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			//280
			['name' => 'data_d47', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d48', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d49', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d50', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d51', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d52', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d53', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d54', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d55', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d56', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			//290
			['name' => 'data_d57', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d58', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d59', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d60', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d61', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d62', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d63', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d64', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d65', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d66', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			//300
			['name' => 'data_d67', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d68', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d69', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d70', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d71', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d72', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d73', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d74', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d75', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d76', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d77', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			//310
			['name' => 'data_d78', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d79', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d80', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d81', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d82', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d83', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d84', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d85', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d86', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d87', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			//320
			['name' => 'data_d88', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d89', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d90', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d91', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d92', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d93', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d94', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d95', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d96', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],

			['name' => 'data_d97', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			//330
			['name' => 'data_d98', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d99', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			['name' => 'data_d100', 'title' => 'מסמך רלוונטי (ממליצים)', 'show_type' => '', 'required' => ''],
			//333
			['name' => 'CV1', 'title' => 'קורות חיים', 'show_type' => '', 'required' => 'required'],
			['name' => 'CV2', 'title' => 'קורות חיים', 'show_type' => '', 'required' => ''],
			['name' => 'CV3', 'title' => 'קורות חיים', 'show_type' => '', 'required' => ''],
			['name' => 'CV4', 'title' => 'קורות חיים', 'show_type' => '', 'required' => ''],

			['name' => 'CV5', 'title' => 'קורות חיים', 'show_type' => '', 'required' => ''],
			['name' => 'CV6', 'title' => 'קורות חיים', 'show_type' => '', 'required' => ''],

			['name' => 'CV7', 'title' => 'קורות חיים', 'show_type' => '', 'required' => ''],
			//340
			['name' => 'CV8', 'title' => 'קורות חיים', 'show_type' => '', 'required' => ''],
			['name' => 'CV9', 'title' => 'קורות חיים', 'show_type' => '', 'required' => ''],
			['name' => 'CV10', 'title' => 'קורות חיים', 'show_type' => '', 'required' => ''],

			//343
			['name' => 'tender_cond[4]', 'title' => 'רישיון מהנדסים/אדריכלים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[5]', 'title' => 'רישיו ןמהנדסים/אדריכלים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[6]', 'title' => 'רישיו ןמהנדסים/אדריכלים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[7]', 'title' => 'רישיון מהנדסים/אדריכלים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[8]', 'title' => 'רישיון מהנדסים/אדריכלים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[9]', 'title' => 'רישיון מהנדסים/אדריכלים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[10]', 'title' => 'רישיון מהנדסים/אדריכלים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[11]', 'title' => 'רישיון מהנדסים/אדריכלים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[12]', 'title' => 'רישיון מהנדסים/אדריכלים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[13]', 'title' => 'רישיון מהנדסים/אדריכלים', 'show_type' => '', 'required' => ''],

			//353
			['name' => 'tender_cond[14]', 'title' => 'רישיון טכנאים/הנדסאים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[15]', 'title' => 'רישיון טכנאים/הנדסאים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[16]', 'title' => 'רישיון טכנאים/הנדסאים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[17]', 'title' => 'רישיון טכנאים/הנדסאים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[18]', 'title' => 'רישיו ןטכנאים/הנדסאים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[19]', 'title' => 'רישיון טכנאים/הנדסאים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[20]', 'title' => 'רישיון טכנאים/הנדסאים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[21]', 'title' => 'רישיון טכנאים/הנדסאים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[22]', 'title' => 'רישיון טכנאים/הנדסאים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[23]', 'title' => 'רישיון טכנאים/הנדסאים', 'show_type' => '', 'required' => ''],

			//363
			['name' => 'tender_cond[14]', 'title' => 'רישיון עובדים סוציאליים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[15]', 'title' => 'רישיון עובדים סוציאליים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[16]', 'title' => 'רישיון עובדים סוציאליים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[17]', 'title' => 'רישיון עובדים סוציאליים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[18]', 'title' => 'רישיון עובדים סוציאליים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[19]', 'title' => 'רישיון עובדים סוציאליים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[20]', 'title' => 'רישיון עובדים סוציאליים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[21]', 'title' => 'רישיון עובדים סוציאליים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[22]', 'title' => 'רישיון עובדים סוציאליים', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[23]', 'title' => 'רישיון עובדים סוציאליים', 'show_type' => '', 'required' => ''],

			//373
			['name' => 'tender_cond[24]', 'title' => 'רישיון עריכת דין', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[25]', 'title' => 'רישיון עריכת דין', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[26]', 'title' => 'רישיון עריכת דין', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[27]', 'title' => 'רישיון עריכת דין', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[28]', 'title' => 'רישיון עריכת דין', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[29]', 'title' => 'רישיון עריכת דין', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[30]', 'title' => 'רישיון עריכת דין', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[31]', 'title' => 'רישיון עריכת דין', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[32]', 'title' => 'רישיון עריכת דין', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[33]', 'title' => 'רישיון עריכת דין', 'show_type' => '', 'required' => ''],

			//383
			['name' => 'tender_cond[34]', 'title' => 'רישיון ראיית חשבון', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[35]', 'title' => 'רישיון ראיית חשבון', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[36]', 'title' => 'רישיון ראיית חשבון', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[37]', 'title' => 'רישיון ראיית חשבון', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[38]', 'title' => 'רישיון ראיית חשבון', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[39]', 'title' => 'רישיון ראיית חשבון', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[40]', 'title' => 'רישיון ראיית חשבון', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[41]', 'title' => 'רישיון ראיית חשבון', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[42]', 'title' => 'רישיון ראיית חשבון', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[43]', 'title' => 'רישיון ראיית חשבון', 'show_type' => '', 'required' => ''],

			//393
			['name' => 'tender_cond[44]', 'title' => 'רישיון אחיות', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[45]', 'title' => 'רישיון אחיות', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[46]', 'title' => 'רישיון אחיות', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[47]', 'title' => 'רישיון אחיות', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[48]', 'title' => 'רישיון אחיות', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[49]', 'title' => 'רישיון אחיות', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[50]', 'title' => 'רישיון אחיות', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[51]', 'title' => 'רישיון אחיות', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[52]', 'title' => 'רישיון אחיות', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[53]', 'title' => 'רישיון אחיות', 'show_type' => '', 'required' => ''],

			//403
			['name' => 'tender_cond[54]', 'title' => 'רישיון רפואה', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[55]', 'title' => 'רישיון רפואה', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[56]', 'title' => 'רישיון רפואה', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[57]', 'title' => 'רישיון רפואה', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[58]', 'title' => 'רישיון רפואה', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[59]', 'title' => 'רישיון רפואה', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[60]', 'title' => 'רישיון רפואה', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[61]', 'title' => 'רישיון רפואה', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[62]', 'title' => 'רישיון רפואה', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[63]', 'title' => 'רישיון רפואה', 'show_type' => '', 'required' => ''],

			//413
			['name' => 'tender_cond[64]', 'title' => 'תעודת רישיון אחר', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[65]', 'title' => 'תעודת רישיון אחר', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[66]', 'title' => 'תעודת רישיון אחר', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[67]', 'title' => 'תעודת רישיון אחר', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[68]', 'title' => 'תעודת רישיון אחר', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[69]', 'title' => 'תעודת רישיון אחר', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[70]', 'title' => 'תעודת רישיון אחר', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[71]', 'title' => 'תעודת רישיון אחר', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[72]', 'title' => 'תעודת רישיון אחר', 'show_type' => '', 'required' => ''],
			['name' => 'tender_cond[73]', 'title' => 'תעודת רישיון אחר', 'show_type' => '', 'required' => ''],

			// Military service file uploads
			['name' => 'military_1', 'title' => 'מסמך שירות לאומי/צבאי', 'show_type' => '', 'required' => ''],
			['name' => 'military_2', 'title' => 'מסמך שירות לאומי/צבאי', 'show_type' => '', 'required' => ''],
			['name' => 'military_3', 'title' => 'מסמך שירות לאומי/צבאי', 'show_type' => '', 'required' => ''],
			['name' => 'military_4', 'title' => 'מסמך שירות לאומי/צבאי', 'show_type' => '', 'required' => ''],
			['name' => 'military_5', 'title' => 'מסמך שירות לאומי/צבאי', 'show_type' => '', 'required' => ''],

		],
		'8' => [
			['name' => 'תיאור התפקיד', 'show_type' => 'job_description_attached', 'required' => '']
		]
	];

	public static function get_app($id)
	{
		$app = DB::table('applications')
			->where('id', '=', $id)
			->first();
		return $app;
	}

	public static function updateInsertDecisions($decisionNumId, $form_type, $request_email, $request_name, $request_id_tz, $appID, $tid, $request, $additional_text = null)
	{
		$data = [];
		if ($form_type === "page1") $data["p1_id"] = $appID;
		if ($form_type === "page2") $data["p2_id"] = $appID;
		if ($form_type === "page3") $data["p3_id"] = $appID;
		if ($form_type === "page5") $data["p5_id"] = $appID;

		if ($decisionNumId) {
			DB::table('app_decisions')->where('id', $decisionNumId)->update($data);
			return $decisionNumId;
		} else {
			$data["tenderval"] = $tid;
			$data["email"] = $request_email;
			$data["applicant_name"] = $request_name;
			$data["id_tz"] = $request_id_tz;
			$data["additional_text"] = $additional_text;
			$tender = Tender::where('generated_id', $request->tenderid)->first();
			$data['has_salary'] = $tender->has_salary;
			$data['tender_number'] = $tender->tender_number;
			if ($tender->has_salary) {
				//
				if ($tender->salary) {
					$data['accept_salary'] = $request->accept_salary == 'yes' ? 1 : 0;
				} else {
					$data['salary'] = $request->salary ?? 0;
				}
			}



			$data['tender_body'] = $tender->body;
			$data['tender_body_image'] = TendersController::tenderImage($tender->body);


			$last_id = DB::table('app_decisions')->insertGetId($data);
			DB::table('app_decisions')->where(['id' => $last_id]);
			return $last_id;
		}
	}

	public static function insert_app($insert_data = array())
	{
		if (!empty($insert_data)) {
			$id = DB::table('applications')->insertGetId(
				$insert_data
			);
			return $id;
		}
		return false;
	}

	public static function insert_meta($meta_data = array())
	{
		if (isset($meta_data) && !empty($meta_data)) {
			DB::table('apps_meta')->insert(
				$meta_data
			);
		}
	}

	public static function insert_file($file_data = array())
	{
		if (isset($file_data) && !empty($file_data)) {
			try {
				DB::table('apps_file')->insert(
					$file_data
				);
			} catch (\Throwable $th) {
				// Log the error for debugging
				Log::error('Error inserting file data', [
					'error' => $th->getMessage(),
					'file_data_count' => count($file_data),
					'first_file' => $file_data[0] ?? null
				]);
			}
		}
	}

	public static function add_app11($request, $form, $app_id)
	{
		Log::info('Starting add_app function', ['app_id' => $app_id]);

		$error['error'] = 'אירעה שגיאה לא צפויה, אנא רענן את הדף ונסה שוב עכשיו או אחר כך.';
		$tid = $request->tenderid;
		$decisionNumId = $request->decisionId;

		Log::debug('Request parameters', [
			'tenderid' => $tid,
			'decisionId' => $decisionNumId,
			'app_id' => $app_id
		]);

		if ($app_id != '') {
			Log::debug('Decoding app_id');
			$appID = base64_decode($app_id, true);
			if (!$appID) {
				Log::error('Failed to decode app_id', ['app_id' => $app_id]);
				return $error;
			}
			Log::debug('Successfully decoded app_id', ['decoded_id' => $appID]);
		}

		$res = array();
		$base_name = uniqid() . '_' . time();
		$pdf_name = $base_name . '_new';
		$pdf_name_old = $base_name . '_old';
		$decid = 0;

		Log::debug('Generated PDF names', [
			'pdf_name' => $pdf_name,
			'pdf_name_old' => $pdf_name_old
		]);

		if (!isset($appID)) {
			Log::debug('Creating new application record');
			$app_data = [
				'sender' => $request->pn1 . ' ' . $request->pf1,
				'form_id' => $form->id,
				'email' => $request->email,
				'type' => $form->type,
				'department' => $form->id != 8 ? $request->frametype1 : $form->department
			];

			if (isset($tid)) {
				$app_data["tenderval"] = $tid;
				Log::debug('Added tender ID to app_data', ['tenderid' => $tid]);
			}

			$appID = self::insert_app($app_data);
			Log::debug('Application inserted', ['app_id' => $appID]);

			if (isset($decisionNumId)) {
				Log::debug('Updating/inserting decision with existing ID', ['decisionNumId' => $decisionNumId]);
				$decid = self::updateInsertDecisions($decisionNumId, $form->type, $request->email, $request->firstname . " " . $request->lastname, $request->id_tz, $appID, $tid, $request);
			} else {
				Log::debug('Creating new decision record');
				$decid = self::updateInsertDecisions(0, $form->type, $request->email, $request->firstname . " " . $request->lastname, $request->id_tz, $appID, $tid, $request);
			}

			Log::debug('Decision ID', ['decid' => $decid]);

			if (!$appID) {
				Log::error('Failed to insert application');
				return $error;
			}
		} else {
			Log::debug('Updating existing application status', ['app_id' => $appID]);
			DB::table('applications')->where('id', $appID)->update(['status' => '8']);
		}

		$app_dec = AppDecisions::find($decid);
		Log::debug('AppDecisions record', ['app_dec' => $app_dec ? $app_dec->toArray() : null]);

		$app_dec->applicant_name = $applicant_name = $request->firstname . '_' . $request->lastname;
		$pdf_name .= '_' . Str::slug($app_dec->applicant_name, '_') . '@' . $appID;
		$pdfpath = public_path('upload/' . $pdf_name . '.pdf');

		Log::debug('Attempting to generate new PDF', [
			'pdf_name' => $pdf_name,
			'pdf_path' => $pdfpath,
			'view_data' => ['request' => $request]
		]);

		try {
			Log::debug('Loading PDF view');
			$pdf = PDF::loadView('pdf.form-new', [
				'request' => $request
			])->setPaper('A4')->setOrientation('portrait');

			Log::debug('Setting PDF options');
			$pdf->setOption('enable-javascript', true);
			$pdf->setOption('javascript-delay', 5000);
			$pdf->setOption('enable-smart-shrinking', true);
			$pdf->setOption('no-stop-slow-scripts', true);
			$pdf->setOption('margin-top', 10);
			$pdf->setOption('margin-bottom', 0);
			$pdf->setOption('margin-left', 0);
			$pdf->setOption('margin-right', 0);

			Log::debug('Saving PDF to: ' . $pdfpath);
			$pdf->save($pdfpath);

			if (file_exists($pdfpath)) {
				Log::info('PDF successfully generated and saved', [
					'path' => $pdfpath,
					'size' => filesize($pdfpath)
				]);
			} else {
				Log::error('PDF file not found after generation attempt', ['path' => $pdfpath]);
			}
		} catch (\Throwable $th) {
			Log::error('PDF generation failed', [
				'error' => $th->getMessage(),
				'trace' => $th->getTraceAsString()
			]);
		}

		$file_data[] = [
			'app_id' => $appID,
			'url' => $pdf_name . '.pdf',
			'type' => $app_id == '' ? 'pdf' : 'erur',
			'file_name' => $app_id == '' ? 'form.pdf' : 'form.pdf^^form.pdf',
			'app_dec_id' => $app_dec->id,
			'status' => '0',
			'is_cv' => 0,
			'input_field_name' => null,
			'input_field_label' => null
		];

		// Old PDF generation
		$pdf_name_old .= '_' . Str::slug($app_dec->applicant_name, '_') . '@' . $appID;
		$pdfpathold = public_path('upload/' . $pdf_name_old . '.pdf');

		Log::debug('Attempting to generate old PDF', [
			'pdf_name' => $pdf_name_old,
			'pdf_path' => $pdfpathold
		]);

		try {
			$pdfold = PDF::loadView('pdf.form', [
				'formhtml' => $request->html,
				'form' => $form,
				'app_dec' => $app_dec
			])->setPaper('A4')->setOrientation('portrait');

			$pdfold->setOption('enable-javascript', true);
			$pdfold->setOption('javascript-delay', 5000);
			$pdfold->setOption('enable-smart-shrinking', true);
			$pdfold->setOption('no-stop-slow-scripts', true);
			$pdfold->setOption('margin-top', 10);
			$pdfold->setOption('margin-bottom', 0);
			$pdfold->setOption('margin-left', 0);
			$pdfold->setOption('margin-right', 0);

			Log::debug('Saving old PDF to: ' . $pdfpathold);
			$pdfold->save($pdfpathold);

			if (file_exists($pdfpathold)) {
				Log::info('Old PDF successfully generated and saved', [
					'path' => $pdfpathold,
					'size' => filesize($pdfpathold)
				]);
			} else {
				Log::error('Old PDF file not found after generation attempt', ['path' => $pdfpathold]);
			}
		} catch (\Throwable $th) {
			Log::error('Old PDF generation failed', [
				'error' => $th->getMessage(),
				'trace' => $th->getTraceAsString()
			]);
		}

		// ... rest of the file handling code ...

		Log::debug('Inserting file data', ['file_data_count' => count($file_data)]);
		self::insert_file($file_data);

		$metaJson = $request->except(['educ_image', 'diplopma_high_image', 'diploma_type']);
		$metaJson['file'] = '';
		$metaJson['html'] = '';

		Log::debug('Preparing meta data', ['metaJson' => $metaJson]);
		$meta_data = [
			['app_id' => $appID, 'meta_name' => $app_id == '' ? 'metaJson' : 'metaJson_erur', 'meta_value' => serialize($metaJson)],
		];

		self::insert_meta($meta_data);

		$res['pdfname'] = $pdf_name;
		$res['decisionId'] = $decid;

		Log::info('add_app function completed successfully', ['result' => $res]);
		return $res;
	}


	public static function add_app($request, $form, $app_id)
	{
		$error['error'] = 'אירעה שגיאה לא צפויה, אנא רענן את הדף ונסה שוב עכשיו או אחר כך.';
		$tid = $request->tenderid;
		$decisionNumId = $request->decisionId;
		if ($app_id != '') {
			$appID = base64_decode($app_id, true);
			if (!$appID) {
				return $error;
			}
		}
		$res = array();
		// $pdf_name = uniqid() . '_' . time();
		// $pdf_name_old = uniqid() . '_' . time();

		$base_name = uniqid() . '_' . time();
		$pdf_name = $base_name . '_new';
		$pdf_name_old = $base_name . '_old';

		$decid = 0;

		if (!isset($appID)) {
			$app_data = [
				'sender' => $request->pn1 . ' ' . $request->pf1,
				'form_id' => $form->id,
				'email' => $request->email,
				'type' => $form->type,
				'department' => $form->id != 8 ? $request->frametype1 : $form->department
			];
			if (isset($tid)) $app_data["tenderval"] = $tid;
			//vr_dump('111');
			$appID = self::insert_app($app_data);
			// dd($appID);
			// var_dump('222');

			if (isset($decisionNumId)) {
				$decid = self::updateInsertDecisions($decisionNumId, $form->type, $request->email, $request->firstname . " " . $request->lastname, $request->id_tz, $appID, $tid, $request, $request->form5_additional_text);
			} else {
				$decid = self::updateInsertDecisions(0, $form->type, $request->email, $request->firstname . " " . $request->lastname, $request->id_tz, $appID, $tid, $request, $request->form5_additional_text);
			}

			if (!$appID) {
				return $error;
			}
		} else {
			DB::table('applications')->where('id', $appID)->update(['status' => '8']);
		}

		$app_dec = AppDecisions::find($decid);
		$app_dec->applicant_name = $applicant_name = $request->firstname . '_' . $request->lastname;


		$pdf_name .= '_' . Str::slug($app_dec->applicant_name, '_') . '@' . $appID;

		$pdfpath = public_path('upload/' . $pdf_name . '.pdf');
		//$pdfpath = public_path($pdf_name . '.pdf');
		//$pdfpath = 'C:/Users/Owner/Automas/laravel/httpdocs/public/upload/' . $pdf_name . '.pdf';

		try {
			$pdf = PDF::loadView('pdf.form-new', [
				'request' => $request
				//'app_dec' => $app_dec
			])->setPaper('A4')->setOrientation('portrait');
			$pdf->setOption('enable-javascript', true);
			$pdf->setOption('javascript-delay', 5000);
			$pdf->setOption('enable-smart-shrinking', true);
			$pdf->setOption('no-stop-slow-scripts', true);
			$pdf->setOption('margin-top', 10);
			$pdf->setOption('margin-bottom', 0);
			$pdf->setOption('margin-left', 0);
			$pdf->setOption('margin-right', 0);

			$pdf->save($pdfpath);
		} catch (\Throwable $th) {
			//throw $th;
            Log::debug('pdf error');
			Log::debug(json_encode($th));
		}

		$file_data[] = [
			'app_id' => $appID,
			'url' => $pdf_name . '.pdf',
			'type' => $app_id == '' ? 'pdf' : 'erur',
			'file_name' => $app_id == '' ? 'form.pdf' : 'form.pdf^^form.pdf',
			'app_dec_id' => $app_dec->id,
			'status' => '0',
			'is_cv' => 0,
			'input_field_name' => null,
			'input_field_label' => null
		];


		$pdf_name_old .= '_' . Str::slug($app_dec->applicant_name, '_') . '@' . $appID;

		$pdfpathold = public_path('upload/' . $pdf_name_old . '.pdf');

		try {
			$pdfold = PDF::loadView('pdf.form', [
				'formhtml' => $request->html,
				'form' => $form,
				'app_dec' => $app_dec
			])->setPaper('A4')->setOrientation('portrait');
			$pdfold->setOption('enable-javascript', true);
			$pdfold->setOption('javascript-delay', 5000);
			$pdfold->setOption('enable-smart-shrinking', true);
			$pdfold->setOption('no-stop-slow-scripts', true);
			$pdfold->setOption('margin-top', 10);
			$pdfold->setOption('margin-bottom', 0);
			$pdfold->setOption('margin-left', 0);
			$pdfold->setOption('margin-right', 0);

			$pdfold->save($pdfpathold);
		} catch (\Throwable $th) {
			//throw $th;
            Log::debug('pdfold error');
			Log::debug(json_encode($th));
		}

		$file_data[] = [
			'app_id' => $appID,
			'url' => $pdf_name_old . '.pdf',
			'type' => $app_id == '' ? 'pdf' : 'erur',
			'file_name' => $app_id == '' ? 'form.pdf' : 'form.pdf^^form.pdf',
			'app_dec_id' => $app_dec->id,
			'status' => '0',
			'is_cv' => 0,
			'input_field_name' => null,
			'input_field_label' => null
		];
		//var_dump($request);
		//var_dump($request->files);

		//	var_dump($request->hasFile('file')?"da":'net');
		//	var_dump($request->hasFile('file')?"da":'net');



		if ($request->hasFile('educ_image') || $request->hasFile('diplopma_high_image') || $request->hasFile('diploma_type')) {
			$__image = $__image_type = [];
			if ($request->hasFile('educ_image')) {
				$__image[] = $request->educ_image;
				$__image_type[] = 'השכלה על תיכונית';
			}
			if ($request->hasFile('diplopma_high_image')) {
				$__image[] = $request->diplopma_high_image;
				$__image_type[] = 'השכלה גבוהה';
			}
			if ($request->hasFile('diploma_type')) {
				$__image[] = $request->diploma_type;
				$__image_type[] = 'השכלה תיכונית';
			}

			foreach ($__image as $key => $file) {
				$file = $file[0];
				if ((!in_array($file->getClientmimeType(), self::$acceptable)) && (!empty($file->getClientmimeType()))) {
					Log::debug('$file->getClientmimeType()' . $file->getClientmimeType());
					$res['file_errors'][] = 'Invalid file type.';
					break;
				}
				if ($file->getSize() >= 20971520 || $file->getSize() == 0) {
					$res['file_errors'][] = 'File too large. File must be less than 20 megabytes.';
					break;
				}
				$filename = makeFileName($app_dec->applicant_name ?? $applicant_name, $__image_type[$key], $file->getClientOriginalExtension());
				$file->move(public_path('upload'), $filename);

				// Determine qualification section for tracking
				$qualificationSection = 'additional_files'; // Default
				$imageType = $__image_type[$key];

				// Check if this is an Additional requirements file
				if (strpos($imageType, 'דרישות נוספות') !== false || strpos($imageType, 'נוספות') !== false) {
					$qualificationSection = 'additional_requirements';
				} elseif (strpos($imageType, 'השכלה') !== false || strpos($imageType, 'תעודת') !== false || strpos($imageType, 'תואר') !== false) {
					$qualificationSection = 'education';
				} elseif (strpos($imageType, 'ניהול') !== false || strpos($imageType, 'ניהולי') !== false) {
					$qualificationSection = 'management_experience';
				} elseif (strpos($imageType, 'ניסיון') !== false || strpos($imageType, 'העסקה') !== false) {
					$qualificationSection = 'professional_experience';
				} elseif (strpos($imageType, 'קורסים') !== false || strpos($imageType, 'השתלמויות') !== false) {
					$qualificationSection = 'professional_courses';
				}

				$file_data[] = [
					'app_id' => $appID,
					'url' => $filename,
					'type' => $app_id == '' ? 'no' : 'erur',
					'file_name' => $file->getClientOriginalName() . '^^' . $imageType . '^^' . $qualificationSection,
					'app_dec_id' => $app_dec->id,
					'status' => '0',
					'is_cv' => 0,
					'input_field_name' => $qualificationSection,
					'input_field_label' => $imageType
				];
			}
		}


		if ($request->hasFile('file') && !empty($request->file)) {
			// var_dump('upload!');
			$res['file_errors'] = array();
			$fail_titles = self::$form_files[$form->id];
			$fail_titles_cond = array();
			Log::debug('$request->file' . json_encode($request->file));
			foreach ($request->file as $key => $file) {
				Log::debug('$key.$file' . $key . $file);
				$cond_key = 'condition' . $key;
				$cond_val = $request->$cond_key;
				$fail_titles_cond = '';
				if ($key > 43 && $cond_val != '') {
					$fail_titles_cond = ['name' => 'tender_add_cond[' . $key . ']', 'title' => $cond_val, 'show_type' => '', 'required' => ''];
				}
				if ((!in_array($file->getClientmimeType(), self::$acceptable)) && (!empty($file->getClientmimeType()))) {
					Log::debug('$file->getClientmimeType()' . $file->getClientmimeType());
					$res['file_errors'][] = 'Invalid file type.';
					break;
				}
				if ($file->getSize() >= 20971520 || $file->getSize() == 0) {
					$res['file_errors'][] = 'File too large. File must be less than 20 megabytes.';
					break;
				}



				// echo(json_encode($filename));
				// echo(json_encode($appID));
				$all_fail_titles = '';
				$file_key_name = $key; // Store the actual key name (e.g., 'military_1')

				// For military service files and other named keys, use the key directly
				if (is_string($key)) {
					// Find the file definition by key name
					$file_definition = null;
					foreach ($fail_titles as $index => $file_def) {
						if ($file_def['name'] === $key) {
							$file_definition = $file_def;
							break;
						}
					}

					// If not found and it's a military service file, use default title
					if (!$file_definition && strpos($key, 'military_') === 0) {
						$all_fail_titles = 'מסמך שירות לאומי/צבאי';
					} elseif ($file_definition) {
						$all_fail_titles = $file_definition['title'] != '' ? $file_definition['title'] : '';
					}
				} else {
					// For numeric keys, use the old logic
					if (count($fail_titles) > $key) {
						$all_fail_titles = $fail_titles[$key]['title'] != '' ? $fail_titles[$key]['title'] : '';
					}
				}

				$all_fail_titles .= $fail_titles_cond != '' ? $fail_titles_cond['title'] : '';
				//Log::debug('$filename'.$filename.'$file->getClientOriginalName()'.$file->getClientOriginalName());

				// Debug logging for military service files
				if (strpos($key, 'military_') === 0) {
					Log::debug('Processing military service file', [
						'key' => $key,
						'title' => $all_fail_titles,
						'original_name' => $file->getClientOriginalName()
					]);
				}

				$filename = makeFileName(($app_dec->applicant_name ?? $applicant_name), $all_fail_titles, $file->getClientOriginalExtension());

				$file->move(public_path('upload'), $filename);
                // Log::debug('File moved to ' . $filename. '^^' . $file_key_name);
				// Determine qualification section based on file title and key
				$qualification_section = 'additional_files'; // Default

				// Check by key range first (only for numeric keys)
				if (is_numeric($key)) {
					$numericKey = (int)$key;
					if ($numericKey == 333 || $numericKey == 2 || $all_fail_titles == 'קורות חיים') {
						$qualification_section = 'cv';
					} elseif ($numericKey >= 3 && $numericKey <= 9) {
						// tender_cond[0-9] - Education files
						$qualification_section = 'education';
					} elseif ($numericKey >= 35 && $numericKey <= 44) {
						// block1-block10 - Professional courses
						$qualification_section = 'professional_courses';
					} elseif ($numericKey >= 45 && $numericKey <= 54) {
						// data_d23-data_d32 - Management experience
						$qualification_section = 'management_experience';
					} elseif (($numericKey >= 23 && $numericKey <= 34) || ($numericKey >= 55 && $numericKey <= 74)) {
						// data_d11-data_d22, data_d33-data_d52 - Professional experience (אישור העסקה)
						$qualification_section = 'professional_experience';
					}
				}

				// If still default, check by title keywords (works for both numeric and string keys)
				if ($qualification_section === 'additional_files') {
					if (strpos($all_fail_titles, 'מבחן') !== false) {
						$qualification_section = 'mandatory_test';
					} elseif (strpos($all_fail_titles, 'ניהולי') !== false || strpos($all_fail_titles, 'נסיון ניהולי') !== false || strpos($all_fail_titles, 'ניסיון ניהולי') !== false) {
						$qualification_section = 'management_experience';
					} elseif (strpos($all_fail_titles, 'קורסים') !== false || strpos($all_fail_titles, 'השתלמויות') !== false || strpos($all_fail_titles, 'קורס') !== false) {
						$qualification_section = 'professional_courses';
					} elseif (strpos($all_fail_titles, 'ניסיון מקצועי') !== false || strpos($all_fail_titles, 'העסקה') !== false || strpos($all_fail_titles, 'אישור העסקה') !== false || strpos($all_fail_titles, 'ניסיון') !== false) {
						$qualification_section = 'professional_experience';
					} elseif (strpos($all_fail_titles, 'תעודת') !== false || strpos($all_fail_titles, 'תואר') !== false || strpos($all_fail_titles, 'בגרות') !== false || strpos($all_fail_titles, 'טכנאי') !== false || strpos($all_fail_titles, 'הנדסאי') !== false || strpos($all_fail_titles, 'לבורנט') !== false || strpos($all_fail_titles, 'הוראה') !== false || strpos($all_fail_titles, 'סמיכות') !== false || strpos($all_fail_titles, 'ישיבה') !== false || strpos($all_fail_titles, 'השכלה') !== false) {
						$qualification_section = 'education';
					} elseif (strpos($all_fail_titles, 'דרישות נוספות') !== false || strpos($all_fail_titles, 'רשיון') !== false || strpos($all_fail_titles, 'נוספות') !== false) {
						$qualification_section = 'additional_requirements';
					}
				}

				$file_data[] = [
					'app_id' => $appID,
					'url' => $filename,
					'app_dec_id' => $app_dec->id,
					'type' => $app_id == '' ? 'no' : 'erur',
					'file_name' => ($app_dec->applicant_name ?? $applicant_name) . '@' . $all_fail_titles . '#' . $file->getClientOriginalName() . '^^' . $all_fail_titles . '^^' . $qualification_section,
					'status' => '0',
					'is_cv' => $key == 333 ? 1 : 0,
					'input_field_name' => $qualification_section,
					'input_field_label' => $all_fail_titles
				];
			}
		}
		// echo(json_encode($file_data));



		self::insert_file($file_data);
		$metaJson = $request->except(['educ_image', 'diplopma_high_image', 'diploma_type']);
		$metaJson['file'] = '';
		$metaJson['html'] = '';
		$meta_data = [
			['app_id' => $appID, 'meta_name' => $app_id == '' ? 'metaJson' : 'metaJson_erur', 'meta_value' => serialize($metaJson)],
		];
		
		
		
		// Save yes/no questions data (שאלות כן ולא)
		if ($request->has('condition_question') && is_array($request->condition_question)) {
			$yesNoData = [];
			$questions = $request->condition_question;
			$answers = $request->condition_answer ?? [];
			$texts = $request->condition_answer_text ?? [];

			foreach ($questions as $index => $question) {
				if (!empty($question)) {
					$answer = isset($answers[$index]) ? ($answers[$index] == 1 ? 'כן' : 'לא') : 'לא';
					$answerText = isset($texts[$index]) ? $texts[$index] : '';

					$yesNoData[] = [
						'question' => $question,
						'answer' => $answer,
						'answer_value' => isset($answers[$index]) ? $answers[$index] : 0,
						'text' => $answerText
					];
				}
			}

			if (!empty($yesNoData)) {
				$meta_data[] = ['app_id' => $appID, 'meta_name' => 'yes_no_questions', 'meta_value' => serialize($yesNoData)];
			}
		}


		if ($app_id == '') {
			//            $meta_data[]  =   ['app_id' => $appID, 'meta_name' => 'identity_number', 'meta_value' => $metaJson['identity_number']];
			// Send email with attachments for page5 forms
			if ($form->type === 'page5') {
				\App\Applications::api_answer_mail_page5($appID);
			}
		}
		self::insert_meta($meta_data);
		$res['pdfname'] = $pdf_name;
		$res['decisionId'] = $decid;
		return $res;
	}

	public static function check_status($pass_id)
	{
		$res = array();
		$applications = DB::table('apps_meta')
			->leftJoin('applications', function ($join) {
				$join->on('applications.id', '=', 'apps_meta.app_id');
			})
			->where([['apps_meta.meta_name', '=', 'identity_number'], ['apps_meta.meta_value', '=', $pass_id]])
			->get(['applications.*']);

		if (empty($applications) || count($applications) == 0) {
			$res['data'] = '<h3 class="empty-res">אין תוצאות לתצוגה  </h3><button class="btn btn-success cansel-request">בדיקת סטטוס של פניה אחרת</button>';
		} else {
			$res['data'] = '';
			foreach ($applications as $key => $app) {
				$res['data'] = '<div class="response__item">
                <h4 class="item__name">אגך החינוך</h4>
                <div class="item__options">
                    <div class="option">
                        <label>מס’ פניה</label>
                        ' . date("Y", strtotime($app->send_date)) . '-' . $app->id . '
                    </div>
                    <div class="option">
                        <label>שם הטופס:</label>
                        ' . \App\Applications::app_forms_name($app->form_id) . '
                    </div>
                    <div class="option">
                        <label>תאריך פניה</label>
                        ' . date('d/m/Y', strtotime($app->send_date)) . '
                    </div>
                    <div class="option">
                        <label>סטטוס פניה - </label>
                        ' . \App\Applications::get_status($app->status) . '
                    </div>';
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
				}
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
		return $res;
	}

	public static function add_app_level_b($request, $form, $app_id)
	{
		$error['error'] = 'אירעה שגיאה לא צפויה, אנא רענן את הדף ונסה שוב עכשיו או אחר כך.';
		if ($app_id != '') {
			$appID = base64_decode($app_id, true);
			if (!$appID) {
				return $error;
			}
		}

		if (isset($request->data_val)) {
			//	$appID=$request->codename;
			DB::table('applications')->where('id', $appID)->update(['data2' => $request->data_val]);
			DB::table('apps_file')->where('app_id', $appID)->where('type', 'level_b_pdf')->delete();
			//			       Log::debug(json_encode($appID));
		}



		$res = array();
		//$pdf_name=uniqid().'_'.time();
		$pdf_name = '101' . '_' . time();
		$pdfpath = public_path('upload/' . $pdf_name . '.pdf');
		$html = public_path('upload/' . $pdf_name . '.html');
		$html_j = public_path('upload/' . $pdf_name . '.json');
		file_put_contents($html, $request->html);
		file_put_contents($html_j, json_encode($form));
		$pdf = PDF::loadView('pdf.101', [
			'formhtml' => $request->html,
			'form' => $form,
		])->setPaper('A4');
		$pdf->setOption('enable-javascript', true);
		$pdf->setOption('javascript-delay', 5000);
		$pdf->setOption('enable-smart-shrinking', true);
		$pdf->setOption('no-stop-slow-scripts', true);
		$pdf->setOption('margin-top', 10);
		$pdf->setOption('margin-bottom', 0);
		$pdf->setOption('margin-left', 0);
		$pdf->setOption('margin-right', 0);
		//				Log::debug(json_encode($pdfpath));

		$pdf->save($pdfpath);
		//		Log::debug(json_encode($request->html));
		$file_data[] = [
			'app_id' => $appID,
			'url' => $pdf_name . '.pdf',
			'type' => 'level_b_pdf',
			'file_name' => 'form.pdf^^form.pdf',
			'status' => '0',
			'input_field_name' => null,
			'input_field_label' => null
		];
		if ($request->hasFile('file') && !empty($request->file)) {
			$res['file_errors'] = array();
			$fail_titles = $app_id == '' ? self::$form_files[$form->id] : [
				['name' => 'אישור נכות 100%', 'show_type' => 'bottom2', 'required' => ''],
				['name' => 'אישור תושב', 'show_type' => 'bottom3', 'required' => ''],
				['name' => 'פסק דין', 'show_type' => 'bottom9', 'required' => ''],
				['name' => 'צילום תעודת שחרור', 'show_type' => 'bottom11', 'required' => ''],
				['name' => 'הצהרה בטופס 118', 'show_type' => 'bottom12', 'required' => ''],
				['name' => 'הצהרה בטופס 119', 'show_type' => 'bottom13', 'required' => ''],
				['name' => 'הוכחה לחוסר הכנסה', 'show_type' => 'bottom14', 'required' => '']
			];
			foreach ($request->file as $key => $file) {
				if ((!in_array($file->getClientmimeType(), self::$acceptable)) && (!empty($file->getClientmimeType()))) {
					$res['file_errors'][] = 'Invalid file type.';
					break;
				}
				if ($file->getSize() >= 20971520 || $file->getSize() == 0) {
					$res['file_errors'][] = 'File too large. File must be less than 20 megabytes.';
					break;
				}
				$filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
				$file->move(public_path('upload'), $filename);
				$file_data[] = [
					'app_id' => $appID,
					'url' => $filename,
					'type' => 'level_b_no',
					'file_name' => $file->getClientOriginalName() . '^^' . $fail_titles[$key]['name'],
					'status' => '0',
					'input_field_name' => null,
					'input_field_label' => $fail_titles[$key]['name'] ?? null
				];
			}
		}
		self::insert_file($file_data);
		DB::table('applications')->where('id', $appID)->update(['status' => '7']);
		$metaJson = $request->all();
		$metaJson['file'] = '';
		$metaJson['html'] = '';
		$meta_data = [
			['app_id' => $appID, 'meta_name' => 'metaJson_level_b', 'meta_value' => serialize($metaJson)],
		];
		\App\Applications::api_answer_mail_level_b($appID);

		self::insert_meta($meta_data);
		$res['pdfname'] = $pdf_name;
		return $res;
	}
}
