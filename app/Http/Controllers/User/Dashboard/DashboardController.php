<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CompanyCategory;
use App\Models\District;
use App\Models\Education;
use App\Models\EmployeeType;
use App\Models\Industry;
use App\Models\Job;
use App\Models\JobLevel;
use App\Models\JobSeekerAdditionalField;
use App\Models\JobSeekerEducation;
use App\Models\JobSeekerExperience;
use App\Models\JobSeekerPersonalInformation;
use App\Models\JobSeekerReference;
use App\Models\JobSeekerSocialNetwork;
use App\Models\JobSeekerTraining;
use App\Models\Language;
use App\Models\Province;
use App\Models\Skill;
use App\Models\StudyField;
use App\Models\UserAppliesJob;
use App\Models\UserSavesJobs;
use Dompdf\Dompdf;
use View;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user_saves_jobs = UserSavesJobs::where('user_id', auth()->user()->id)->with(['job.employer', 'job.employee_type', 'job.job_level'])->get();
        $user_apply_jobs = UserAppliesJob::where('user_id', auth()->user()->id)->with(['job.employer', 'job.employee_type', 'job.job_level'])->get();
        $user_profile = JobSeekerPersonalInformation::where('user_id', auth()->user()->id)->first();
        $download_cvs = UserAppliesJob::where(['user_id' => auth()->user()->id, 'is_download' => 1])->count();
        $profile_visits = UserAppliesJob::where(['user_id' => auth()->user()->id, 'is_seen' => 1])->count();

        if (isset($user_profile)) {
            $similar_job = Job::where('company_category_id', $user_profile->preferred_job)
                ->with(['employer', 'employee_type', 'job_level'])
                ->get();
        } else {
            return view('user.jobseeker.seeker-preference');
        }
        // return $user_apply_jobs;
        return view('user.jobseeker.jobseeker-dashboard', ['download_cvs' => $download_cvs, 'profile_visits' => $profile_visits, 'user_apply_job' => $user_apply_jobs, 'user_save_job' => $user_saves_jobs, 'similar_job' => $similar_job ?? []]);

    }

    public function profileStatus()
    {
        $user_saves_jobs = UserSavesJobs::where('user_id', auth()->user()->id)->with(['job.employer', 'job.employee_type', 'job.job_level'])->get();
        $user_apply_jobs = UserAppliesJob::where('user_id', auth()->user()->id)->with(['job.employer', 'job.employee_type', 'job.job_level'])->get();
        $download_cvs = UserAppliesJob::where(['user_id' => auth()->user()->id, 'is_download' => 1])->with(['job.employer', 'job.employee_type', 'job.job_level'])->get();
        $profile_visits = UserAppliesJob::where(['user_id' => auth()->user()->id, 'is_seen' => 1])->with(['job.employer', 'job.employee_type', 'job.job_level'])->get();

        return view('user.jobseeker.seeker-statistics', compact('user_saves_jobs', 'user_apply_jobs', 'download_cvs', 'profile_visits'));

    }
    public function setting()
    {
        return view('user.jobseeker.seeker-setting');

    }

    public function editProfile()
    {
        $user_id = auth()->user()->id;
        $data = [
            'employee_types' => EmployeeType::where('status', 'active')->orderBy('order_no')->get(),
            'categories' => CompanyCategory::where('status', 'active')->orderBy('order_no')->get(),
            'industry' => Industry::where('status', 'active')->orderBy('order_no')->get(),
            'job_seeker_personal_info' => JobSeekerPersonalInformation::where('user_id', $user_id)->first(),
            'check_education_info' => JobSeekerEducation::where('user_id', $user_id)->first(),
            'check_experiance_info' => JobSeekerExperience::where('user_id', $user_id)->first(),
            'check_additional_info' => JobSeekerAdditionalField::where('user_id', $user_id)->first(),
            'skills' => Skill::where('status', 'active')->orderBy('order_no')->get(),
            'languages' => Language::where('status', 'active')->orderBy('order_no')->get(),
            'education' => Education::where('status', 'active')->orderBy('order_no')->get(),
            'study_field' => StudyField::where('status', 'active')->orderBy('order_no')->get(),
            'company' => CompanyCategory::where('status', 'active')->orderBy('order_no')->get(),
            'job_levels' => JobLevel::where('status', 'active')->orderBy('order_no')->get(),
            'job_seeker_training' => JobSeekerTraining::where('user_id', $user_id)->first(),
            'job_seeker_social_networks' => JobSeekerSocialNetwork::where('user_id', $user_id)->first(),
            'job_seeker_reference' => JobSeekerReference::where('user_id', $user_id)->first(),
        ];
        $provinces = Province::all();
        return view('user.dashboard.edit_profile', $data)->with('provinces', $provinces);
    }

    public function savejob()
    {
        $user_saves_jobs = UserSavesJobs::where('user_id', auth()->user()->id)->with(['job.employer', 'job.employee_type', 'job.job_level'])->get();

        return view('user.jobseeker.seeker-savedJob', ['user_saves_jobs' => $user_saves_jobs]);
    }

    public function applyJobProfileVisit()
    {
        $profile_visits = UserAppliesJob::where(['user_id' => auth()->user()->id, 'is_seen' => 1])->with(['job.employer', 'job.employee_type', 'job.job_level'])->get();
        return view('user.jobseeker.seeker-profile-visit', ['profile_visits' => $profile_visits]);
    }
    public function applyDownloadCv()
    {
        $download_cvs = UserAppliesJob::where(['user_id' => auth()->user()->id, 'is_download' => 1])->with(['job.employer', 'job.employee_type', 'job.job_level'])->get();
        return view('user.jobseeker.seeker-download-cv', ['download_cvs' => $download_cvs]);
    }
    public function applyjob()
    {
        $user_apply_jobs = UserAppliesJob::where('user_id', auth()->user()->id)->with(['job.employer', 'job.employee_type', 'job.job_level'])->get();
        return view('user.jobseeker.seeker-appliedJob', ['user_apply_job' => $user_apply_jobs]);
    }
    public function similarjob()
    {
        $user_profile = JobSeekerPersonalInformation::where('user_id', auth()->user()->id)->first();
        if (isset($user_profile)) {
            $similar_job = Job::where('company_category_id', $user_profile->preferred_job)
                ->with(['employer', 'employee_type', 'job_level'])
                ->get();
            return view('user.jobseeker.seeker-sililar_Job', ['similar_job' => $similar_job]);
        }
        return redirect()->route('user.profile', auth()->user()->username)->with('info', 'Please Updated preffered Job from your profile Setting!!');
    }

    public function viewprofile()
    {
        $user_id = auth()->user()->id;
        $job_seeker_personal_info = JobSeekerPersonalInformation::where('user_id', $user_id)->first();
        $job_seeker_education_info = JobSeekerEducation::where('user_id', $user_id)->first();
        $additional_field = JobSeekerAdditionalField::where('user_id', $user_id)->first();
        //$job_seeker_training_info=JobSeekerTrainingInformation::where('user_id',$user_id)->first();
        return view('user.dashboard.view_profile', ['job_seeker_personal_info' => $job_seeker_personal_info, 'job_seeker_education_info' => $job_seeker_education_info, 'additional_field' => $additional_field]);
    }
    public function create_pdf()
    {
        $user_id = auth()->user()->id;
        $data['job_seeker_personal_info'] = JobSeekerPersonalInformation::where('user_id', $user_id)->first();
        $data['job_seeker_education_info'] = JobSeekerEducation::where('user_id', $user_id)->first();
        $data['additional_field'] = JobSeekerAdditionalField::where('user_id', $user_id)->first();
        // return view('user.dashboard.cv', $data);

        $viewhtml = View::make('user.dashboard.cv', $data)->render();
        $name_of_pdf = auth()->user()->username . '.pdf';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($viewhtml);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($name_of_pdf);
    }

    public function district($username, $id)
    {
        $districts = District::where('province_id', $id)->orderBy('order_no')->get();

        $html = '';

        if (count($districts) > 0) {
            foreach ($districts as $district) {
                $html .= ('<option value="' . $district->id . '">' . Ucfirst($district->name) . '</option>');
            }

            return response()->json([
                'status' => 200,
                'html' => $html,
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'No Districts',
        ], 404);

    }

    public function city($username, $id)
    {
        $cities = City::where('district_id', $id)->orderBy('order_no')->get();

        $html = '';

        if (count($cities) > 0) {
            foreach ($cities as $city) {
                $html .= ('<option value="' . $city->id . '">' . Ucfirst($city->name) . '</option>');
            }

            return response()->json([
                'status' => 200,
                'html' => $html,
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => 'No Cities',
        ], 404);

    }
}
