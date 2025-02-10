<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CompanyCategory;
use App\Models\CompanyOwnerShip;
use App\Models\CompanySize;
use App\Models\Country;
use App\Models\CropImg;
use App\Models\District;
use App\Models\Education;
use App\Models\EmployeeType;
use App\Models\Employer;
use App\Models\Experience;
use App\Models\Job;
use App\Models\JobLevel;
use App\Models\JobSeekerAdditionalField;
use App\Models\JobSeekerEducation;
use App\Models\JobSeekerPersonalInformation;
use App\Models\Province;
use App\Models\Skill;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Storage;
use View;
use Dompdf\Dompdf;

class DashboardController extends Controller
{
    /**
     * @return employer data, Job details according to status
     *
     * @return void
     */
    public function index()
    {
        $employer = auth()->user()->employer;

        //gets jobs
        $activeJobs = Job::where(['status' => 'active', 'approval' => 'approved'])->orderby('created_at')->where('user_id', auth()->user()->id)->with(['employer', 'job_level', 'applied_users'])->limit(5)->get();
        $pendingJobs = Job::where(['status' => 'active', 'approval' => 'pending'])->orderby('created_at')->where('user_id', auth()->user()->id)->with(['employer', 'job_level', 'applied_users'])->limit(5)->get();
        $expiredJobs = Job::where(['status' => 'expired', 'approval' => 'approved'])->orderby('created_at')->where('user_id', auth()->user()->id)->with(['employer', 'job_level', 'applied_users'])->limit(5)->get();

        //counts jobs
        $activeCount = Job::where([
            'approval' => 'approved',
            'status' => 'active',
        ])->orderby('created_at')->where('user_id', auth()->user()->id)->count();
        $pendingCount = Job::where([
            'approval' => 'pending',
            'status' => 'active',
        ])->orderby('created_at')->where('user_id', auth()->user()->id)->count();
        $draftCount = Job::where([
            'approval' => null,
            'status' => 'pending'
        ])->orderby('created_at')->where('user_id', auth()->user()->id)->count();
        $expiredCount = Job::where(['status' => 'expired', 'approval' => 'approved'])->orderby('created_at')->where('user_id', auth()->user()->id)->count();

        $employer = auth()->user()->employer;
        if (isset(auth()->user()->employer->logo)) {
            $url = asset('storage/employer/logo' . auth()->user()->employer->logo);
        } else {
            $url = asset('frontend/assets/images/files/company-logo.png');
        }

        if (@$employer->city->name == @$employer->district->name) {
            $address = @$employer->city->name;
        } else {
            $address = @$employer->city->name . ', ' . @$employer->district->name;
        }

        $complete = 0;
        if (@$employer) {
            $complete += 50;
            $basic = true;
            if (@$employer->contact_persons_information) {
                $complete += 25;
                $contact = true;
            }

            if (@$employer->tiktok_url) {
                $complete += 5;
            }

            if (@$employer->facebook_url) {
                $complete += 5;
            }

            if (@$employer->youtube_url) {
                $complete += 5;
            }

            if (@$employer->instagram_url) {
                $complete += 5;
            }

            if (@$employer->linkedIn_url) {
                $complete += 5;
            }
        }

        $email = $employer->emails->where('is_primary', 1)->first()->email;

        return view(
            'employer.dashboard',
            compact(
                'employer',
                'activeJobs',
                'activeCount',
                'draftCount',
                'expiredJobs',
                'expiredCount',
                'pendingJobs',
                'pendingCount',
                'url',
                'address',
                'complete',
                'email'
            )
        );
    }

    /**
     * Filters the jobs categories accourding to slug
     * check if the status has been manipulated or not
     *
     * @param [type] $status
     * @return void
     */
    public function filterIndex($status = null)
    {
        // dd('here');
        if ($status != null) {
            $temp = explode('-', $status);
            $status = $temp[0];

            if ($status == "active" || $status == "pending" || $status == "draft" || $status == "expired") {
                $jobs = Job::where('status', $status)->orderby('created_at')->where('user_id', auth()->user()->id)->get();

                switch ($status) {
                    case "active":
                        $flag = 1;
                        break;

                    case "pending":
                        $flag = 2;
                        break;

                    case "draft":
                        $flag = 3;
                        break;

                    case "expired":
                        $flag = 4;
                        break;

                    default:
                        return redirect()->route('employers.index')->with('error', 'Somthing Went Wrong');
                }

                return view('employer.jobsDetails', compact('jobs', 'flag'));
            } else {
                return redirect()->route('index');
            }
        }

        return redirect()->route('employers.index')->with('error', 'Something went wrong');
    }

    /**
     * @returns edit page to update profile details of the authenticated employer
     */

    public function editProfile()
    {
        $employer = auth()->user()->employer;
        $categories = CompanyCategory::where('status', 'active')->orderBy('order_no')->get();
        $ownerShip = CompanyOwnerShip::where('status', 'active')->orderBy('order_no')->get();
        $sizes = CompanySize::where('status', 'active')->orderBy('order_no')->get();

        return view('employer.editProfile', compact('employer', 'categories', 'ownerShip', 'sizes'));
    }

    /**
     * add Social Link of authenticated employer
     *
     * @param Request $request
     * @return void
     */
    public function addSocialLinks(Request $request)
    {
        // dd($request);
        if (!$request->social_media_link && !$request->social_media_link) {
            $employer = auth()->user()->employer;
            $employer->social_information = null;
            $employer->update();

            return redirect()->back()->with('error', 'Data has been deleted');
        }

        $employer = auth()->user()->employer;

        $count = count($request->social_media_name);

        $name = [];
        $link = [];

        for ($i = 0; $i < $count; $i++) {
            if ($request->social_media_name[$i] != null) {
                array_push($name, $request->social_media_name[$i]);
            } else {
                return redirect()->back()->with('error', 'Data submitted incomplete');
            }

            if ($request->$request->social_media_link[$i] != null) {
                array_push($link, $request->social_media_link[$i]);
            } else {
                return redirect()->back()->with('error', 'Data submitted incomplete');
            }
        }

        $social_media = json_encode(
            array(
                'name' => $name,
                'link' => $link,
            )
        );

        // dd($social_media);
        $employer->social_information = $social_media;
        $employer->update();

        return redirect()->back()->with('status', 'Social Medial Links Updated');
    }

    public function postAJob()
    {
        $country = Country::where('status', 'active')->orderBy('order_no')->get();
        $company_category = CompanyCategory::where('status', 'active')->orderBy('order_no')->get();
        $company_ownership = CompanyOwnerShip::where('status', 'active')->orderBy('order_no')->get();
        $company_size = CompanySize::where('status', 'active')->orderBy('order_no')->get();
        $job_levels = JobLevel::where('status', 'active')->orderBy('order_no')->get();
        $educations = Education::where('status', 'active')->orderBy('order_no')->get();
        $experiences = Experience::where('status', 'active')->orderBy('order_no')->get();
        $vehicles = Vehicle::where('status', 'active')->orderBy('order_no')->get();
        $employeeType = EmployeeType::where('status', 'active')->orderBy('order_no')->get();
        $skills = Skill::where('status', 'active')->orderBy('order_no')->get();
        $provinces = Province::where('status', 'active')->orderBy('order_no')->get();

        return view(
            'employer.overview-jobs.jobPost',
            compact(
                'country',
                'company_category',
                'company_ownership',
                'company_size',
                'job_levels',
                'educations',
                'experiences',
                'vehicles',
                'employeeType',
                'skills',
                'provinces'
            )
        );
    }

    public function newspaper()
    {
        $country = Country::where('status', 'active')->orderBy('order_no')->get();
        $company_category = CompanyCategory::where('status', 'active')->orderBy('order_no')->get();
        $company_ownership = CompanyOwnerShip::where('status', 'active')->orderBy('order_no')->get();
        $company_size = CompanySize::where('status', 'active')->orderBy('order_no')->get();
        $job_levels = JobLevel::where('status', 'active')->orderBy('order_no')->get();
        $educations = Education::where('status', 'active')->orderBy('order_no')->get();
        $experiences = Experience::where('status', 'active')->orderBy('order_no')->get();
        $vehicles = Vehicle::where('status', 'active')->orderBy('order_no')->get();
        $employeeType = EmployeeType::where('status', 'active')->orderBy('order_no')->get();
        $skills = Skill::where('status', 'active')->orderBy('order_no')->get();
        $provinces = Province::where('status', 'active')->orderBy('order_no')->get();

        return view(
            'employer.overview-jobs.postANewspaper',
            compact(
                'country',
                'company_category',
                'company_ownership',
                'company_size',
                'job_levels',
                'educations',
                'experiences',
                'vehicles',
                'employeeType',
                'skills',
                'provinces'
            )
        );
    }

    public function fetchDistrict(Request $request)
    {
        $districts = District::where('province_id', base64_decode($request->id))->orderBy('order_no')->get();

        return response()->json(array('districts' => $districts));
    }

    public function fetchCity(Request $request)
    {
        $cities = City::where('district_id', $request->id)->orderBy('order_no')->get();

        return response()->json(array('cities' => $cities));
    }

    public function changeStatus(Request $request)
    {
        $job = Job::where('slug', $request->slug)->first();

        if ($job == []) {
            return response()
                ->json(
                    array(
                        'status' => 404,
                        'message' => 'JOB NOT FOUND',
                    )
                );
        }

        if ($job->status == 'active') {
            $job->status = 'pending';
            $job->update();
            $flag = 1;
            $message = "Post has been unpublished";
        } elseif ($job->status == 'pending') {
            $job->status = 'active';
            $job->update();
            $flag = 1;
            $message = "Post has been published";
        } else {
            $flag = 0;
        }

        if ($flag) {
            return response()
                ->json(
                    array(
                        'status' => 200,
                        'message' => $message,
                    )
                );
        } else {
            return response()
                ->json(
                    array(
                        'status' => 500,
                        'message' => 'Server Error: Something went Wrong',
                        'message2' => 'If this error continues, please contact us',
                    )
                );
        }
    }

    /**
     * Viewing user and 
     * incrementing the profile view in user side
     */

    public function viewUser($slug, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $user_id = $user->id;
        $job_seeker_personal_info = JobSeekerPersonalInformation::where('user_id', $user_id)->first();
        $job_seeker_education_info = JobSeekerEducation::where('user_id', $user_id)->first();
        $additional_field = JobSeekerAdditionalField::where('user_id', $user_id)->first();

        $job = Job::where('slug', $slug)->firstOrFail();
        $user->applied_jobs()->updateExistingPivot($job, ['is_seen' => 1]);

        return view(
            'employer.viewProfile',
            compact(
                'job_seeker_personal_info',
                'job_seeker_education_info',
                'additional_field'
            )
        );
    }

    public function downloadPdf($username, $slug)
    {

        $user = User::where('username', $username)->firstOrFail();
        $user_id = $user->id;
        $data['job_seeker_personal_info'] = JobSeekerPersonalInformation::where('user_id', $user_id)->first();
        $data['job_seeker_education_info'] = JobSeekerEducation::where('user_id', $user_id)->first();
        $data['additional_field'] = JobSeekerAdditionalField::where('user_id', $user_id)->first();
        $job = Job::where('slug', $slug)->first();
        $user->applied_jobs()->updateExistingPivot($job, ['is_download' => 1]);      

        $viewhtml = View::make('user.dashboard.cv', $data)->render();
        $dompdf = new Dompdf();
        $dompdf->setPaper('A4', 'portrait');
        $name_of_pdf = $user->username . '.pdf';
        $dompdf->loadHtml($viewhtml);
        $dompdf->render();
        $dompdf->stream($name_of_pdf);
    }
}