<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __construct()
    {   
        $this->middleware('isAdmin');
    }
    
    public function index()
    {
        return view('admin.reports');
    }
    
    public function reports(Request $request)
    {
        \App\Jobs\JobReport::dispatchNow($request);
        return redirect()->back();
    }
}
