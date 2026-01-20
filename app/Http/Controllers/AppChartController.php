<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\AppChart;
use DB;
class AppChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        if(!$departments = AppChart::get_departments()) return view('content-none',['pageTitle' => 'לוח מחוונים']);
        
        if(!$appChart = AppChart::get_appChart($departments[0])) return view('content-none',['pageTitle' => 'לוח מחוונים']); 

        return view('app-chart', [ 'appChart' => $appChart, 'departments'=>$departments, 'pageTitle' => '' ] );
    }

    public function get_chart(Request $request, $departments){

        if(!$appChart = AppChart::get_appChart($departments)){ 
            return '<h2 style="direction: rtl; width: max-content; background: #fff; color: red; margin: 2em auto; padding: 1em 2em; -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.13); box-shadow: 0 1px 3px rgba(0,0,0,0.13); ">לא מצא נתונים להצגה</h2>';
        }
        $res = $appChart->container();
        $res .=  $appChart->script();
        $res.='<script type="text/javascript">'.$appChart->id.'_load() </script>';
        return $res;
    }
}
