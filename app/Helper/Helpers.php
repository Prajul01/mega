<?php
namespace App\Helper\Helpers;

use App\Models\Job;

class Helper
{
    /**
     * AKA MegaJob
     */
    public static function topJobs($q = null, $order = null)
    {
        $jobs = Job::where([
            'approval' => 'approved',
            'status' => 'active',
            'type' => 'mega',
        ])->with(['employer', 'city', 'skill']);

        if (!is_null($order)) {
            if ($order == 'latest') {
                $jobs = $jobs->latest();
            } else {
                $jobs = $jobs->orderBy('created_at', 'asc');
            }
        }
        if (is_null($q)) {
            $jobs = $jobs->limit(15)->get();
        } else {
            $jobs = $jobs->paginate(6);
        }

        return $jobs;

    }

    /**
     * AKA Premium Jobs
     */
    public static function hotJobs($q = null, $order = null)
    {
        $jobs = Job::where([
            'approval' => 'approved',
            'status' => 'active',
            'type' => 'premium',
        ])->with(['employer', 'city', 'skill']);

        if (!is_null($order)) {
            if ($order == 'latest') {
                $jobs = $jobs->latest();
            } else {
                $jobs = $jobs->orderBy('created_at', 'asc');
            }
        }
        if (is_null($q)) {
            $jobs = $jobs->limit(15)->get();
        } else {
            $jobs = $jobs->paginate(6);
        }

        return $jobs;
    }

    /**
     * checks the authentication of user
     * and supplies the recent jobs accorodingly
     * intercal of jobs must be of 1 week i.e. 7 days
     */
    public static function recentJobs()
    {
        $state = 0;
        $today = today();
        while ($state != 'f') {
            switch ($state) {
                case 0:
                    $state = (auth()->check()) ? 1 : 3;
                    break;

                case 1:
                    $user = auth()->user();
                    if (is_null($user->job_seeker) || empty($user->job_seeler)) {
                        $state = 3;
                        break;
                    }
                    $preferedId = $user->job_seeker->company_category_id;
                    $jobs_count = Job::where('status', 'active')
                        ->where('company_category_id', $preferedId)
                        ->where('type', 'normal')
                        ->latest()
                        ->count();

                    if ($jobs_count > 0) {
                        $state = 2;
                    } else {
                        $state = 3;
                    }
                    break;

                case 2:
                    $jobs = Job::where('status', 'active')
                        ->where('company_category_id', $preferedId)
                        ->withCount('applied_users')
                        ->where('type', 'normal')
                        ->latest()
                        ->with('employer')
                        ->limit(15)->get();

                    $state = 'f';
                    break;

                case 3:
                    $jobs = Job::where('status', 'active')
                        ->latest()
                        ->with('employer')
                        ->limit(15)
                        ->get();

                    $state = 'f';
                    break;

                case 4:
                    break;
            }
        }

        return $jobs;
    }

    /**
     * General Jobs =  any physical job with non-skilled, hands-on tasks, such as cleaning, moving or landscaping.
     * jobs are fetched according to user preference if authenticated
     * if not then all jobs are fetched 
     */
    public static function generalJobs()
    {
        $jobs = Job::where([
            'approval' => 'approved',
            'status' => 'active',
            'type' => 'prime',
        ])->with('employer')->limit(15)->get();

        return $jobs;
    }

    public static function newspaperJobs()
    {
        $state = 0;
        while ($state != 'f') {
            switch ($state) {
                case 0:
                    $state = (auth()->check()) ? 1 : 3;
                    break;

                case 1:
                    $user = auth()->user();
                    if (is_null($user->job_seeker) || empty($user->job_seeler)) {
                        $state = 3;
                        break;
                    }
                    $preferedId = $user->job_seeker->company_category_id;
                    $jobs_count = Job::where('status', 'active')
                        ->where('company_category_id', $preferedId)
                        ->where('job_type', 2)
                        ->count();

                    if ($jobs_count > 0) {
                        $state = 2;
                    } else {
                        $state = 3;
                    }
                    break;

                case 2:
                    $preferedId = $user->job_seeker->company_category_id;
                    $jobs = Job::where('status', 'active')
                        ->where('company_category_id', $preferedId)
                        ->with('employer')
                        ->where('job_type', 2)
                        ->limit(15)->latest()->get();

                    $state = 'f';
                    break;

                case 3:
                    $jobs = Job::where('status', 'active')
                        ->where('job_type', 2)
                        ->with('employer')
                        ->latest()
                        ->limit(15)
                        ->get();

                    $state = 'f';
                    break;

                case 4:
                    break;
            }
        }

        return $jobs;
    }
}