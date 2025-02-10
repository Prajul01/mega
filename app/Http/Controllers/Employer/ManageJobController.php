<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;

class ManageJobController extends Controller
{
    public function index(Request $request)
    {
        if (!@$request->type) {
            $request->type = 'active-jobs';
        }

        $jobs['jobs'] = $this->filterJobs($request->type)->get();

        $jobs['activeJobs'] = $this->filterJobs('active-jobs')->count();
        $jobs['pendingJobs'] = $this->filterJobs('pending-jobs')->count();
        $jobs['draftedJobs'] = $this->filterJobs('drafted-jobs')->count();
    $jobs['deniedJobs'] = $this->filterJobs('denied-jobs')->count();
        $jobs['expiredJobs'] = $this->filterJobs('expired-jobs')->count();

        return view('employer.overview-jobs.manage-jobs', $jobs);
    }

    public function filterJobs($type)
    {
        $jobs = Job::query();
        switch ($type) {
            case 'active-jobs':
                $jobs = $jobs->where([
                    'approval' => 'approved',
                    'status' => 'active',
                    'user_id' => auth()->id()
                ]);
                break;

            case 'pending-jobs':
                $jobs = $jobs->where([
                    'approval' => 'pending',
                    'status' => 'active',
                    'user_id' => auth()->id()
                ]);
                break;

            case 'drafted-jobs':
                $jobs = $jobs->where([
                    'approval' => null,
                    'status' => 'pending',
                    'user_id' => auth()->id()
                ]);
                break;

            case 'denied-jobs':
                $jobs = $jobs->where([
                    'user_id' => auth()->id(),
                    'approval' => 'declined',
                ]);
                break;

            case 'expired-jobs':
                $jobs = $jobs->where([
                    'approval' => 'approved',
                    'status' => 'expired',
                    'user_id' => auth()->id()
                ]);
                break;
        }

        return $jobs->with('job_level')->with('employee_type')->with('applied_users');
    }

    /**
     * view job for update or deletion
     */
    public function viewJob($slug)
    {
        $job = Job::where('slug', $slug)->first();

        if (is_null($job)) {
            return redirect()->route('employers.index');
        }

        return view('employer.overview-jobs.view-jobs', compact('job'));
    }
}