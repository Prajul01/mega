<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use App\Models\Industry;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['megajobs'] = Job::where([
            'type' => 'mega',
            'approval' => 'approved',
            'status' => 'active'
        ])->count();

        $data['premiumJobs'] = Job::where([
            'type' => 'premium',
            'approval' => 'approved',
            'status' => 'active'
        ])->count();


        $data['primeJobs'] = Job::where([
            'type' => 'general',
            'approval' => 'approved',
            'status' => 'active'
        ])->count();

        $data['normalJobs'] = Job::where([
            'type' => 'normal',
            'approval' => 'approved',
            'status' => 'active',
            'job_type' => 1
        ])->count();
//        $data['newspaperCount'] = Job::where([
//            'approval' =>'approved',
//            'status' => 'active',
//            'newspaper_image' is not null,
//        ])->count();
//        $data['newspaperCount'] = Job::where([
//            'approval' => 'approved',
//            'status' => 'active',
//        ])->whereNotNull('newspaper_image')->count();
        $data['newspaperCount'] = Job::where([
            'approval' => 'approved',
            'status' => 'active',
        ])->whereNotNull('newspaper_image')->count();
//        dd($data['newspaperCount']);

        $data['unverifiedJobSeekers'] = User::role('job-seeker')->doesnthave('job_seeker')->count();
        $data['verifiedJobSeekers'] = User::role('job-seeker')->has('job_seeker')->count();
        $data['unverifiedEmployers'] = User::role('employer')->doesnthave('employer')->count();
        $data['verifiedEmployers'] = User::role('employer')->has('employer')->count();


        $data['admins'] = User::where('admin', 1)->where('email', '!=', 'ktmrushservices@gmail.com')->role('super-admin')->count();
        $data['users'] = User::where('admin', 1)->whereDoesntHave('roles', fn($q) => $q->where('name', 'super-admin'))->count();
        $data['employers'] = User::where('admin', 0)->role('employer')->count();
        $data['jobSeekers'] = User::where('admin', 0)->role('job-seeker')->count();

        $data['companies'] = \App\Models\Employer::withCount('jobs')->with('user')->orderBy('jobs_count', 'desc')->limit(10)->get();

        $data['jobRequests'] = Job::where([
                    'approval' => 'pending',
                    'status' => 'active',
                ])->with('employer')->latest()->limit(10)->get();

        $data['JobIndustries'] = Industry::where('status', 'active')->orderBy('order_no')->with('jobs')->get();

        return view('admin.dashboard', $data);
    }
}
