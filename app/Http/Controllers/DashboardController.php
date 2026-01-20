<?php

namespace App\Http\Controllers;
use App\Dashboard;
use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }

    public function index() {
        Storage::disk('public')->delete('images/loader.gif');
        $reports = Dashboard::get_reports();

        if(!$reports) return view('content-none',['pageTitle' => 'לוח מחוונים']);

        return view('Dashboard',[
            'pageTitle' => 'לוח מחוונים',
            'reports' => $reports
        ]);
    }
}
