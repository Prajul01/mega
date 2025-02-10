<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class JobPostingController extends Controller
{
    /*
    |   PHP: 8.1
    |    use php 8.1 to run the command below without errors
    |
    |   The job can be posted in 4 ways
    |   I) in **Megajobs** section
    |   II) in **premium job** section
    |   III) in **prime jobs** section
    |   IV) in normal jobs => recent jobs
    */

    private $currentType;

    /**
     * get type in form of link and 
     * fetches jobs accordingly
     * if the type is null then all normal jobs are fetched
     */
    public function index($type = null)
    {
        [$jobs, $type] = match ($type) {
            'megajobs' => [$this->indexMega(), 'Megajobs'],
            'premium-jobs' => [$this->indexPremium(), 'Premium Jobs'],
            'prime-jobs' => [$this->indexPrime(), 'Prime Jobs'],
            'other-jobs', null => [$this->indexNormal(), 'Latest Jobs'],
            default => abort(403),
        };

        $exceptIds = $this->idsToNeglate($jobs);
        $otherJobs = Job::whereNotIn('id', $exceptIds)->where('approval', '<>', 'declined')->where('status', 'active')->with('employer')->get()->chunk(30);

        return view('admin.jobPosting.index', compact('jobs', 'type', 'otherJobs'));
    }

    /**
     * gets all the job for addition to the required job type
     * 
     */
    private function idsToNeglate($jobs)
    {
        $ids = [];
        foreach ($jobs as $data) {
            foreach ($data->pluck('id')->toArray() as $id) {
                array_push($ids, $id);
            }
        }
        return $ids;
    }

    /**
     * fetches all the megajobs
     */
    private function indexMega()
    {
        $jobs = Job::where('type', 'mega')->orderBy('title')->where('approval', '<>', 'declined')->where('status', 'active')->with('employer')->get()->chunk(30);
        return $jobs;
    }

    /**
     * fetches all premiumjobs
     */
    private function indexPremium()
    {
        $jobs = Job::where('type', 'premium')->orderBy('title')->where('approval', '<>', 'declined')->where('status', 'active')->with('employer')->get()->chunk(30);
        return $jobs;
    }

    /**
     * fetches all prime jobs
     */
    private function indexPrime()
    {
        $jobs = Job::where('type', 'prime')->orderBy('title')->where('approval', '<>', 'declined')->where('status', 'active')->with('employer')->get()->chunk(30);
        return $jobs;
    }

    /**
     * fetches all normaljobs
     */

    private function indexNormal()
    {
        $jobs = Job::where('type', 'normal')->orderBy('title')->where('approval', '<>', 'declined')->where('status', 'active')->with('employer')->get()->chunk(30);
        return $jobs;
    }

    /******************* To post the jobs in respective feild **************/

    /**
     * post the jobs to the required $type
     * if array of slug is requested then function postArrayJobs() is called
     * else function postSingleJob() is called
     */
    public function postjobs($type, Request $request)
    {
        $request->validate([
            'action' => 'bail|required_if:action_from,bulk',
        ], [
            'action.required_if' => 'Action is not selected',
        ]);

        if (@$request->action == 'remove') {
            $this->currentType = 'normal';
        } else {
            $types = ['mega', 'premium', 'prime', 'normal'];
            if (!in_array($this->getCurrentType($type), $types)) {
                return $this->getCurrentType($type);
            }
            $this->currentType = $this->getCurrentType($type);

        }

        if (is_array($request->job_slug)) {
            $result = $this->postArrayJobs($request);
        } else {
            $result = $this->postSingleJob($request);
        }

        return $result;
    }

    /**
     * post a job to requested posting section
     */
    private function postSingleJob($request)
    {
        $request->validate([
            'job_slug' => 'bail|required|exists:jobs,slug'
        ]);
        try {
            $job = Job::where('slug', $request->job_slug)->first();
            $job->type = $this->currentType;
            $job->update();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('status', $job->title . ' has been added to respective posting');
    }

    /**
     * post multiple jobs to requested posting section
     */
    private function postArrayJobs($request)
    {
        $request->validate([
            'job_slug/*' => 'bail|required|exists:jobs,slug',
        ]);

        try {
            $jobs = Job::whereIn('slug', $request->job_slug)->get();
            foreach ($jobs as $job) {
                $job->type = $this->currentType;
                $job->update();
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('status', 'Jobs has been posted to respective posting');
    }

    /**
     * conversion of the type 
     * to favor data in DB 
     * ***  TO PREVENT FROM DATA TRUNCATED IN MYSQL ***
     */

    private function getCurrentType($type)
    {
        return match ($type) {
            'megajobs' => 'mega',
            'premium-jobs' => 'premium',
            'prime-jobs' => 'prime',
            'other-jobs' => 'normal',
            null => back()->with('error', 'Somethng went wrong'),
            default => back()->with('error', 'Somethng went wrong'),
        };
    }
}