<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IssuedReport as Report;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::orderBy('read', 'desc')->latest()->get();

        return view('admin.reports.index', compact('reports'));
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Report::find(base64_decode($id));
        if(is_null($report) || empty($report)){
            return back()->with('error', 'Requested Report not found');
        }

        $report->read = 1;
        $report->update();
        
        return view('admin.reports.show', compact('report'));
    }
}
