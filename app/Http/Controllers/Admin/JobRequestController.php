<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Mail\JobRequestStatus;
use Mail;

class JobRequestController extends Controller
{
    public function index()
    {
        if (request()->jobs) {
            if (request()->jobs == 'declined-jobs') {
                $jobs = Job::where([
                    'approval' => 'declined',
                ])->with('employer')->latest()->get();
                return view('admin.job-requests.index', compact('jobs'));
            } else if (request()->jobs == 'approved-jobs') {
                $jobs = Job::where([
                    'approval' => 'approved',
                ])->with('employer')->latest()->get();
                return view('admin.job-requests.index', compact('jobs'));
            } else {
                return to_route('admin.jobRequest.index');
            }
        }

        $jobs = Job::where([
            'approval' => 'pending',
            'status' => 'active',
        ])->with('employer')->latest()->get();


        return view('admin.job-requests.index', compact('jobs'));
    }

    public function show($slug)
    {

        $temp = new \App\Http\Controllers\User\FrontendController;
        $view = $temp->job_single($slug);
        return $view;
    }

    public function changeStatus($slug, Request $request)
    {
        $request->validate([
            'approval' => 'bail|in:approved,declined',
            'message' => 'required_if:approval,declined',
        ]);
        $job = Job::where('slug', $slug)->first();
        if (is_null($job) || empty($job)) {
            return response()->json('404 : Job Not Found', 404);
        }

        $job->approval = $request->approval;
        $job->declined_reason = $request->message;
        $job->update();

        if ($job->approval == 'approved') {
            $message = "The job has been approved";
        } else {
            $message = "The job has been declined";
        }
        $email = $job->employer->emails->where('is_primary', 1)->first();

        $details = [
            'company_name' => $job->employer->company_name,
            'job' => $job->name,
            'approval' => $job->approval,
            'url' => route('employers.jobs.view', $job->slug),
        ];
        Mail::to('test@test.com')->send(new JobRequestStatus($details));
        return response()->json($message);
    }
//    public function destroy($slug)
//    {
//        $job = Job::where('slug', $slug)->first();
//
//        if (!$job) {
//            return response()->json(['error' => 'Job not found'], 404);
//        }
//
//        $job->status='active'();
//        return response()->json(['success' => 'Job has been deleted successfully.'], 200);
//    }
    public function destroy($slug)
    {
        $job = Job::where('slug', $slug)->first();

        if (!$job) {
            return response()->json(['error' => 'Job not found'], 404);
        }

        $job->status = 'deleted';
        $job->save();

        return response()->json(['success' => 'Job status updated successfully.'], 200);
    }



}
