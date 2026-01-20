<?php


function issetLineOrArray($line, $name, $pos)
    {
    	if (!isset($line) || !isset($name) || !isset($line[$name])) return '';
    	$data=$line[$name];

    	if (!isset($data)) return '';
    	if (gettype($data)==="string") return $data;
	    if (gettype($data)==="array")
	    	{
	    		//&&
			   // ?$data["educ_institution_name"]
                if (isset($data[$pos])) return $data[$pos];
		    }
		    return '';

    }
function issetLang($line,$name,$i)
{
	return '';
}
    function issetLine($data)
    {
//isset($line["firstname"])?$line["firstname"]:''
        return isset($data)?$data:'';
    }

    function issetFirst($data,$i)
        {
        	if (!isset($data) || $i!==0) return '';
        	return $data;
        }

function issetDataFirst($line, $name, $i)
{
	if (!isset($line) || !isset($name) || !isset($line[$name])) return '';
	$data=$line[$name];

	if (!isset($data) || $i!==0) return '';
	return $data;
}

function issetChkFirst($line, $name, $i) {
	if (!isset($line) || !isset($name) || !isset($line[$name])) return '';
	$data=$line[$name];

	if (!isset($data) || $i!==0) return '';
	return $data;
}
?>
<table border="0">
    <tr>
    <td></td>
    <td></td>
        <td>
            שם פרטי
        </td>
    <td>שם משפחה	</td>
    <td>מספר פלאפון	</td>
    <td>מספר טלפון	</td>
    <td>דוא”ל</td>
    <td></td>
<td>מכרז</td>
        <td>שם פרטי + שם משפחה</td>
<td>שם משפחה קודם</td>
        <td>מספר ת.ז</td>
        <td>כתובת דוא"ל</td>
        <td>מספר טלפון נייד</td>
        <td>מספר טלפון נוסף</td>
        <td>עיר מגורים</td>
        <td>רחוב</td>
        <td>מספר בית</td>
        <td>מספר דירה</td>
        <td></td>
        <td>כתובת למשלוח דואר שונה מכתובת המגורים</td>
        <td>השפה</td>
        <td>קריאה</td>
        <td>כתיבה</td>
        <td>דיבור</td>
        <td>השכלה יסודית</td>
        <td>השכלה תיכונית</td>
        <td>השכלה גבוהה</td>
        <td> השכלה יסודית שם המוסד</td>
        <td>שם הישוב של המוסד</td>
        <td>מספר שנות לימוד</td>
        <td>שנת סיום</td>
        <td>המקצוע העיקרי</td>
        <td>התואר / התעודה</td>
        <td> השכלה תיכונית שם המוסד</td>
        <td>שם הישוב של המוסד</td>
        <td>מספר שנות לימוד</td>
        <td>שנת סיום</td>
        <td>המקצוע העיקרי</td>
        <td>התואר / התעודה</td>

        <td> תואר נוסף שם המוסד</td>
        <td>שם הישוב של המוסד</td>
        <td>מספר שנות לימוד</td>
        <td>שנת סיום</td>
        <td>המקצוע העיקרי</td>
        <td>התואר / התעודה</td>
        <td> השכלה גבוהה שם המוסד</td>
        <td>שם הישוב של המוסד</td>
        <td>מספר שנות לימוד</td>
        <td>שנת סיום</td>
        <td>המקצוע העיקרי</td>
        <td>התואר / התעודה</td>

        <td>שם הקורס / השתלמות</td>
        <td>תאריך סיום</td>
        <td>מסגרת לימודים</td>
        <td>אנא צרף תעודה רלוונטית</td>

        <td>מקום עבודה</td>
        <td>תאריך תחילת עבודה</td>
        <td>תאריך סיום עבודה</td>
        <td>תיאור תפקיד</td>
        <td>הסיבה להפסקת עבודה</td>
        <td>שם פרטי + שם משפחה</td>
<td>תפקיד / מקצוע</td>
<td>מספר נייד / מספר טלפון</td>
        <td>נושא</td>
        <td>הסיבה להפסקת עבודה</td>
        <td>מצהיר/ה בזאת כי</td>
        <td>שם פרטי</td>
        <td>שם משפחה</td>
        <td>מספר ת.ז</td>
        <td>יחס קרבה</td>
        <td>שם היחידה</td>
        <td>תיאור התפקיד</td>
        <td>אנא פרט</td>
        <td></td>
        <td></td>
        <td></td>
        <td>אני או אחד מהוריי נולדנו באתיופיה</td>
        <td>אני אדם עם מגבלות כמשמעו בצו ההרחבה לעידוד והגברת תעסוקה של אנשים עם מוגבלות</td>
        <td>אנא תאר את המוגבלות</td>
    </tr>
    @foreach ($arr as $line)
        @for ($i=0;$i<$line["max_arr_lines"];$i++)

        <tr><td>{{$line["max_arr_lines"]}}</td>
                <td>{{$line["tenderval"]}}</td>
            <td>{{issetFirst($line["firstname"],$i)}}</td>



            <td>{{issetDataFirst($line,"email",$i)}}</td>
            <td>{{issetDataFirst($line,"tender_type",$i)}}</td>

            <td>{{issetDataFirst($line,"personal_lastname",$i)}}</td>
            <td>{{issetDataFirst($line,"id_tz",$i)}}</td>
            <td>{{issetDataFirst($line,"personal_email",$i)}}</td>
            <td>{{issetDataFirst($line,"personal_phone",$i)}}</td>
            <td>{{issetDataFirst($line,"personal_phone_1",$i)}}</td>
            <td>{{issetDataFirst($line,"personal_city",$i)}}</td>
            <td>{{issetDataFirst($line,"personal_street",$i)}}</td>
            <td>{{issetDataFirst($line,"personal_house",$i)}}</td>
            <td>{{issetDataFirst($line,"personal_flat",$i)}}</td>

            <td>{{issetDataFirst($line,"personal_postal_address",$i)}}</td>
            <td>{{issetDataFirst($line,"postalblock",$i)}}</td>

            <td>{{issetLang($line,"i",$i)}}</td>
            <td>{{issetLang($line,"read",$i)}}</td>
            <td>{{issetLang($line,"write",$i)}}</td>
            <td>{{issetLang($line,"speak",$i)}}</td>


            <td>{{issetChkFirst($line,"educ_kind_low",$i)}}</td>
            <td>{{issetChkFirst($line,"educ_kind_school",$i)}}</td>
            <td>{{issetChkFirst($line,"educ_kind_high",$i)}}</td>


            <td>{{issetLineOrArray($line,"educ_institution_name",$i)}}</td>
            <td>{{issetLineOrArray($line,"educ_institution_name_name",$i)}}</td>
            <td>{{issetLineOrArray($line,"educ_institution_years_years",$i)}}</td>
            <td>{{issetLineOrArray($line,"educ_last_year",$i)}}</td>

            <td>{{issetLineOrArray($line,"educ_main_profession",$i)}}</td>
            <td>{{issetLineOrArray($line,"educ_diploma",$i)}}</td>
            <td>{{issetLineOrArray($line,"educ_school_name",$i)}}</td>
            <td>{{issetLineOrArray($line,"educ_school_namename",$i)}}</td>
            <td>{{issetLineOrArray($line,"educ_school_years",$i)}}</td>
            <td>{{issetLineOrArray($line,"educ_school_endyear",$i)}}</td>
            <td>{{issetLineOrArray($line,"educ_school_profession",$i)}}</td>
            <td>{{issetLineOrArray($line,"educ_school_duploma",$i)}}</td>

            <td>{{issetLineOrArray($line,"heduc_name",$i)}}</td>
            <td>{{issetLineOrArray($line,"heduc_namename",$i)}}</td>
            <td>{{issetLineOrArray($line,"heduc_school_years",$i)}}</td>
            <td>{{issetLineOrArray($line,"heduc_school_endyear",$i)}}</td>
            <td>{{issetLineOrArray($line,"heduc_school_profession",$i)}}</td>
            <td>{{issetLineOrArray($line,"heduc_school_duploma",$i)}}</td>

            <td>{{issetLineOrArray($line,"add_educ_name",$i)}}</td>
            <td>{{issetLineOrArray($line,"add_educ_finish",$i)}}</td>
            <td>{{issetLineOrArray($line,"add_educ_desc",$i)}}</td>

            <td>{{issetLineOrArray($line,"exp_position",$i)}}</td>
            <td>{{issetLineOrArray($line,"expe_start",$i)}}</td>
            <td>{{issetLineOrArray($line,"exp_finish",$i)}}</td>
            <td>{{issetLineOrArray($line,"exp_descr",$i)}}</td>
            <td>{{issetLineOrArray($line,"exp_reasontocomplete",$i)}}</td>

            <td>{{issetLineOrArray($line,"recomendations_name_z",$i)}}</td>
            <td>{{issetLineOrArray($line,"recomendations_role_0",$i)}}</td>
            <td>{{issetLineOrArray($line,"recomendations_mobile_phone1_select_z",$i)}}</td>
            <td>{{issetLineOrArray($line,"recomendations_phone_z",$i)}}</td>

            <td>{{issetLineOrArray($line,"add_data",$i)}}</td>
            <td>{{issetLineOrArray($line,"add_reason",$i)}}</td>

            <td>{{issetChkFirst($line,"if_relatives",$i)}}</td>

            <td>{{issetLineOrArray($line,"relative_firstname",$i)}}</td>
            <td>{{issetLineOrArray($line,"relative_lastname",$i)}}</td>
            <td>{{issetLineOrArray($line,"relative_id_tz",$i)}}</td>
            <td>{{issetLineOrArray($line,"relative_distance",$i)}}</td>
            <td>{{issetLineOrArray($line,"relative_name_d",$i)}}</td>
            <td>{{issetLineOrArray($line,"relative_name_d1",$i)}}</td>
            <td>{{issetLineOrArray($line,"relative_descrt",$i)}}</td>
            <td>{{issetLineOrArray($line,"relative_confirm1",$i)}}</td>
            <td>{{issetLineOrArray($line,"relative_confirm2",$i)}}</td>
            <td>{{issetLineOrArray($line,"relative_confirm3",$i)}}</td>

            <td>{{issetLineOrArray($line,"form3_ch1",$i)}}</td>
            <td>{{issetLineOrArray($line,"form3_ch2",$i)}}</td>
            <td>{{issetLineOrArray($line,"form3_ch3",$i)}}</td>
            <td>{{issetLineOrArray($line,"form3_ch4",$i)}}</td>

            <td>{{issetLineOrArray($line,"form3_text",$i)}}</td>



        </tr>
            @endfor
    @endforeach

</table>
