<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Echarts\Chart;
use App\Applications;
use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;
class AppChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public static $CustomOptions = [
            'title' => [
                'text' => 'כמות הפניות ',
                'textStyle' =>[
                    'fontFamily' => "'Open Sans Hebrew', sans-serif",
                    'color' => '#5e7b89',
                    'fontSize' => '14',
                    'fontWeight' => 'normal',
                ],
                'x' => 'right',
                'y' => '55',
                'padding' => [0, 50,0]
            ],
            'legend' => [
                'x' => 'right',
                'align' =>'right',
                'textStyle' =>[
                    'fontFamily' => "'Open Sans Hebrew', sans-serif",
                    'color' => '#5e7b89',
                    'fontSize' => '16'
                ],
                'padding' => [10,20,10,10],
                'itemGap' => 20,
                'itemWidth' => 20,
                'itemHeight' => 10,
            ],
            'icon' => 'pin',
            'animation' => false,
            'grid' => [
                'left' => '2%',
                'right' => '1%',
                'bottom' => '2%',
                'containLabel' => true,
            ],
            'xAxis' => [
                'type' => 'category',
                'boundaryGap' => false,
                'position' => 'right',
                'splitLine' => [
                    'show' => false
                ],
                'axisLine'=>[
                    'lineStyle'=>[
                        'color'=>'#acacac',
                        'fontSize'=>20
                    ]
                ],
                'nameTextStyle'=>[
                    'color'=>'#acacac',
                    'fontSize'=>20
                ],
            ],
            'yAxis' => [
                'type' => 'value',
                'position' => 'right',
                'splitLine' => [
                    'show' => false
                ],
                'axisLine'=>[
                    'lineStyle'=>[
                        'color'=>'#acacac',
                        'fontSize'=>20
                    ]
                ],
                'nameTextStyle'=>[
                    'color'=>'#acacac',
                    'fontSize'=>20
                ],
            ],
            'tooltip' => [
                'show' => true, // or false, depending on what you want.
                'trigger' => 'axis'
            ]
        ];
    public static $ChartColor =  [
    	'nrr'=>'#d33fee',
    	'taf'=>'#005489',
    	'unregister'=>'#00d491',
    	'fsa'=>'#cf9200',
    ];   
    public function __construct()
    {
        parent::__construct();
    }

    public static function get_departments(){
    	$user = auth()->user();
        $form_ids = Applications::get_user_forms( $user->id );
        $forms = DB::table('forms')
                ->where([['status', '=', '1']])
                ->whereIn('id', $form_ids )
                ->get(['id','department'])->groupBy('department')->toArray();
        if(empty($forms))  return false;         
        $departments = array();       
        foreach ($forms as $key => $value) {
            $keys = explode(',', $key);
            $departments = array_merge($departments,$keys);
        }  
        $departments = array_unique($departments);  
        if(empty($departments))  return false; 

        return $departments;
    }

    public static function get_reports($department){
		$user = auth()->user();
        $form_ids = Applications::get_user_forms( $user->id );
        $Applications = DB::table('applications')->where('department',$department)->whereIn('form_id', $form_ids )->get(['form_id','type','id','status','send_date']);
        foreach ($Applications as $key => $Application) {
        	$Application->send_date = date('m/Y', strtotime($Application->send_date));
        }
        return $Applications;  
	}

	public static function get_chart_date(){
		$yms = array();
		$now = date('Y-m');
		for($x = 0; $x <= 11; $x++) {
		    $ym = date('m/Y', strtotime($now . " -$x month"));
		    $yms[] = $ym;
		    if ($ym == '11/2019') break;
		}
		return $yms;
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
	public static function get_chart_res($formtype, $forms){
		$value = array();
		$dates = self::get_chart_date();
		foreach ($dates as $key => $d) {
			$value[] = self::search($forms ,array('type' => $formtype, 'send_date' => $d  ), true);
		}
		return $value;
	}
	public static function get_appChart($departments){
		$app = self::get_reports($departments);
		if(empty($app)) return false;
        $appChart = new AppChart;
        $options = self::$CustomOptions;
        $appChart->options($options);
        $appChart->labels(AppChart::get_chart_date());
        $formtypes = $app->pluck('form_id','type')->toArray();
        if(empty($formtypes)) return false;
        
        foreach ($formtypes as $key => $value) {
        	$form = DB::table('forms')->where('id', $value )->first('name');
        	$appChart->dataset($form->name, 'line', AppChart::get_chart_res($key, $app))->color(self::$ChartColor[$key]);
        } 
        return $appChart;    
	}
}
