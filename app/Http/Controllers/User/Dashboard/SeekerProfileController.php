<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CompanyCategory;
use App\Models\CropImg;
use App\Models\Education;
use App\Models\EmployeeType;
use App\Models\Industry;
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
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use View;

class SeekerProfileController extends Controller
{

    /**************************************************************************************
     * IN CASE OF CHANGE IN function storePreference() or the code is not working accoroding to 
     * you PLEASE CHECK App\Http\Middleware\CheckJobSeeker.php for further details.     * 
     *************************************************************************************/

    private $user_id;

    public function __construct()
    {
        $this->user_id = Auth::id();
    }

    public function changeSetting(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        try {
            $name = $request->name;
            $user->$name = $user->$name == 1 ? 0 : 1; // Toggle the boolean attribute
            $user->save();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating user.']);
        }

    }

    public function account_Deactivated()
    {
        $this->validate(request(), [
            'password' => 'required',
        ]);
        if (Hash::check(request()->password, auth()->user()->password)) {

            if (request()->deactivate) {
                $user = User::where('id', auth()->user()->id)->first();
                $user->is_deactivated = $user->is_deactivated == 1 ? 0 : 1;
                $user->save();
                session()->flush();
                Auth::logout();
                return redirect('/')->with('status', 'Your Change Status successfully');

            } elseif (request()->delete == 1) {
                $job_seeker_personal_info = JobSeekerPersonalInformation::where('user_id', auth()->user()->id)->first();
                if ($job_seeker_personal_info) {
                    if ($job_seeker_personal_info->profile_pic) {
                        Storage::delete('public/job-seeker/' . $job_seeker_personal_info->profile_pic);
                    }
                    $job_seeker_personal_info->delete();
                }

                $check_additional_info = JobSeekerAdditionalField::where('user_id', auth()->user()->id)->first();
                if ($check_additional_info) {
                    $check_additional_info->delete();
                }
                $educationInfoCheck = JobSeekerEducation::where('user_id', auth()->user()->id)->first();
                if ($educationInfoCheck) {
                    $educationInfoCheck->delete();
                }
                $trainingInfoCheck = JobSeekerTraining::where('user_id', auth()->user()->id)->first();
                if ($trainingInfoCheck) {
                    $trainingInfoCheck->delete();
                }
                $experienceInfoCheck = JobSeekerExperience::where('user_id', auth()->user()->id)->first();
                if ($experienceInfoCheck) {
                    $experienceInfoCheck->delete();
                }
                $additional_socialCheck = JobSeekerSocialNetwork::where('user_id', auth()->user()->id)->first();
                if ($additional_socialCheck) {
                    $additional_socialCheck->delete();
                }
                $additional_referenceCheck = JobSeekerReference::where('user_id', auth()->user()->id)->first();
                if ($additional_referenceCheck) {
                    $additional_referenceCheck->delete();
                }
                $user = User::where('id', auth()->user()->id)->first();
                if ($user) {
                    $user->delete();
                }
                session()->flush();
                Auth::logout();
                return redirect('/')->with('status', 'Your Account Has Delete successfully');

            }
        } else {
            return back()->with('error', 'Wrong Password.');

        }
        return back()->with('error', 'Something Wrong.');

    }

    public function changePassword(Request $request)
    {

        $this->validate($request, [
            'old_password' => 'required',
            'confirm_password' => 'required',
            'password' => 'required|same:confirm_password',
        ]);

        if (Hash::check($request->old_password, auth()->user()->password)) {
            $user = auth()->user();
            $user->password = Hash::make($request->password);
            $user->update();
            session()->flush();
            Auth::logout();
            return redirect()->back()->with('status', 'Password changed successfully');
        }

        return back()->with('error', 'Old password is incorrect');
    }
    public function profile()
    {
        $data = [
            'employee_types' => EmployeeType::where('status', 'active')->orderBy('order_no')->get(),
            'categories' => CompanyCategory::where('status', 'active')->orderBy('order_no')->get(),
            'industry' => Industry::where('status', 'active')->orderBy('order_no')->get(),
            'job_seeker_personal_info' => JobSeekerPersonalInformation::where('user_id', $this->user_id ?? auth()->user()->id)->first(),
            'check_additional_info' => JobSeekerAdditionalField::where('user_id', $this->user_id ?? auth()->user()->id)->first(),
            'skills' => Skill::where('status', 'active')->orderBy('order_no')->get(),

        ];
        return view('user.jobseeker.seeker-preference', $data);

    }
    public function storePreference(Request $request)
    {

        if ($request->preferance == 1) {
            $request->validate([
                'prefered_job.*' => 'required',
                'prefered_industry.*' => 'required',
                'skill.*' => 'required',
                'looking_for' => 'required',
                'expected_salary' => 'required',
                'career_objective' => 'required',
            ]);
            if ($request->skill) {
                $additional_field = JobSeekerAdditionalField::where('user_id', $this->user_id ?? auth()->user()->id)->first();
                if (!$additional_field) {
                    $additional_field = new JobSeekerAdditionalField();
                }
                $additional_field->skill = [];
                $skill_data = array();
                foreach ($request->skill as $skill) {
                    array_push($skill_data, $skill);
                }

                $additional_field->skill = json_encode($skill_data);
                $additional_field->user_id = $this->user_id ?? auth()->user()->id;
                $additional_field->save();
            }
            $personal_info = new JobSeekerPersonalInformation();
            $personal_info->looking_for = $request->looking_for;
            $personal_info->expected_salary = $request->expected_salary;
            $personal_info->career_objective = $request->career_objective;
            $personal_info->user_id = $this->user_id ?? auth()->user()->id;
            $personal_info->save();
            $personal_info->preferedJobs()->detach();
            $personal_info->preferedIndustry()->detach();
            $personal_info->preferedJobs()->attach($request->prefered_job);
            $personal_info->preferedIndustry()->attach($request->prefered_industry);

            if (isset($personal_info)) {
                return back()->with('status', 'Personal Information is Saved successfully!!');
            } else {
                return back()->with('error', 'Something Went Wrong!!');
            }
        } else {

            $request->validate([
                'first_name' => 'required',
                'middle_name' => 'nullable',
                'last_name' => 'required',
                'current_province' => 'required',
                'current_district' => 'required',
                'current_city' => 'required',
                'permanent_province' => 'required_if:sameAddress,off',
                'permanent_district' => 'required_if:sameAddress,off',
                'permanent_city' => 'required_if:sameAddress,off',
                'date_of_birth' => 'required',
                'gender' => 'required',
                'mobile_number' => 'required',
                'license' => 'required',
                'vehicle' => 'required',
                'maritial_status' => 'nullable',
            ]);

            $path = public_path() . '/storage/job-seeker/';
            $folderPath = 'public/job-seeker';

            if (!file_exists($path)) {
                Storage::makeDirectory($folderPath, 0755, true, true);
                chmod($path, 0755);
            }

            $personal_info = new JobSeekerPersonalInformation();
            $personal_info->first_name = $request->first_name;
            $personal_info->middle_name = $request->middle_name;
            $personal_info->last_name = $request->last_name;

            $personal_info->current_province = $request->current_province;
            $personal_info->current_district = $request->current_district;
            $personal_info->current_city = $request->current_city;

            if ($request->sameAddress) {
                $personal_info->permanent_province = $request->current_province;
                $personal_info->permanent_district = $request->current_district;
                $personal_info->permanent_city = $request->current_city;
            } else {
                $personal_info->permanent_province = $request->permanent_province;
                $personal_info->permanent_district = $request->permanent_district;
                $personal_info->permanent_city = $request->permanent_city;
            }

            $personal_info->date_of_birth = $request->date_of_birth;
            $personal_info->gender = $request->gender;
            $personal_info->mobile_number = $request->mobile_number;
            $personal_info->have_license = $request->license;
            $personal_info->have_vehicle = $request->vehicle;
            $personal_info->maritial_status = $request->maritial_status;
            $personal_info->user_id = $this->user_id ?? auth()->user()->id ?? auth()->user()->id;
            $personal_info->employee_type_id = $request->employee;
            if ($request->hasFile('profile_pic')) {
                $file = $request->file('profile_pic');
                $filename = auth()->user()->username . '.' . $file->extension();

                CropImg::resize_crop_images(512, 512, $file, $folderPath . '/' . $filename);

                $personal_info->profile_pic = $filename;
            }
            // return  $personal_info;

            $personal_info->save();

            return redirect()->route('user.profile', auth()->user()->username)->with('status', 'Personal Information is Saved successfully!!');

        }
        return back()->with('error', 'Something Went Wrong!!');

    }
    public function updatePreference(Request $request)
    {
        if ($request->preferance == 1) {
            $request->validate([
                'prefered_job.*' => 'required',
                'prefered_industry.*' => 'required',
                'skill.*' => 'required',
                'looking_for' => 'required',
                'expected_salary' => 'required',
                'career_objective' => 'required',
            ]);
            if ($request->skill) {
                $additional_field = JobSeekerAdditionalField::where('user_id', $this->user_id ?? auth()->user()->id)->first();
                if (!$additional_field) {
                    $additional_field = new JobSeekerAdditionalField();
                }
                $additional_field->skill = [];
                $skill_data = array();
                foreach ($request->skill as $skill) {
                    array_push($skill_data, $skill);
                }

                $additional_field->skill = json_encode($skill_data);
                $additional_field->user_id = $this->user_id ?? auth()->user()->id;
                $additional_field->save();
            }
            $personal_info = JobSeekerPersonalInformation::where('user_id', $this->user_id ?? auth()->user()->id)->first();
            $personal_info->looking_for = $request->looking_for;
            $personal_info->expected_salary = $request->expected_salary;
            $personal_info->career_objective = $request->career_objective;
            $personal_info->user_id = $this->user_id ?? auth()->user()->id;

            $personal_info->update();
            $personal_info->preferedJobs()->detach();
            $personal_info->preferedIndustry()->detach();
            $personal_info->preferedJobs()->attach($request->prefered_job);
            $personal_info->preferedIndustry()->attach($request->prefered_industry);
            return back()->with('status', 'Personal Information is Saved successfully!!');
        } else {
            $request->validate([
                'first_name' => 'required',
                'middle_name' => 'nullable',
                'last_name' => 'required',
                'current_province' => 'required',
                'current_district' => 'required',
                'current_city' => 'required',
                'permanent_province' => 'required_if:sameAddress,off',
                'permanent_district' => 'required_if:sameAddress,off',
                'permanent_city' => 'required_if:sameAddress,off',
                'date_of_birth' => 'required',
                'gender' => 'required',
                'mobile_number' => 'required',

                'license' => 'required',
                'vehicle' => 'required',
                'maritial_status' => 'nullable',

            ]);
            $personal_info = JobSeekerPersonalInformation::where('user_id', $this->user_id ?? auth()->user()->id)->first();
            $path = public_path() . '/storage/job-seeker/';
            $folderPath = 'public/job-seeker';

            if (!file_exists($path)) {
                Storage::makeDirectory($folderPath, 0755, true, true);
                chmod($path, 0755);
            }

            $personal_info = auth()->user()->job_seeker;
            $personal_info->first_name = $request->first_name;
            $personal_info->middle_name = $request->middle_name;
            $personal_info->last_name = $request->last_name;

            $personal_info->current_province = $request->current_province;
            $personal_info->current_district = $request->current_district;
            $personal_info->current_city = $request->current_city;
            if ($request->sameAddress) {
                $personal_info->permanent_province = $request->current_province;
                $personal_info->permanent_district = $request->current_district;
                $personal_info->permanent_city = $request->current_city;
            } else {
                $personal_info->permanent_province = $request->permanent_province;
                $personal_info->permanent_district = $request->permanent_district;
                $personal_info->permanent_city = $request->permanent_city;
            }

            $personal_info->date_of_birth = $request->date_of_birth;
            $personal_info->gender = $request->gender;
            $personal_info->mobile_number = $request->mobile_number;
            $personal_info->have_license = $request->license;
            $personal_info->have_vehicle = $request->vehicle;
            $personal_info->maritial_status = $request->maritial_status;

            $personal_info->user_id = $this->user_id ?? auth()->user()->id;
            if ($request->profile_pic) {
                $file = $request->file('profile_pic');
                $filename = auth()->user()->username . '.' . $file->extension();
                if (@$personal_info->profile_pic) {
                    Storage::delete($folderPath . '/' . $personal_info->profile_pic);
                }

                CropImg::resize_crop_images(512, 512, $file, $folderPath . '/' . $filename);

                $personal_info->profile_pic = $filename;
            }

            $personal_info->update();
            return back()->with('status', 'Personal Information Update successfully!!');

        }

    }
    public function basicInfo()
    {

        $data = [
            'job_seeker_personal_info' => JobSeekerPersonalInformation::where('user_id', $this->user_id ?? auth()->user()->id)->first(),
            'provinces' => Province::where('status', 'active')->get(),
        ];
        return view('user.jobseeker.seeker-basic-info', $data);
    }

    public function education()
    {

        $data = [
            'education' => Education::where('status', 'active')->orderBy('order_no')->get(),
            'check_education_info' => JobSeekerEducation::where('user_id', $this->user_id ?? auth()->user()->id)->first(),
            'study_field' => StudyField::where('status', 'active')->orderBy('order_no')->get(),
        ];
        return view('user.jobseeker.seeker-education', $data);
    }
    public function storeEducation(Request $request)
    {
        $request->validate([
            'degree.*' => 'required',
            'filed_of_study.*' => 'required',
            'institution.*' => 'required',
            'board.*' => 'required',
            'joined_year.*' => 'required|numeric',
            'passed_year.*' => 'nullable|numeric',
            'currently_study.*' => 'nullable|in:Currently Studying',
        ]);
        $education = new JobSeekerEducation();
        $education_data = array();
        $study_field_data = array();
        $institution_data = array();
        $university_data = array();
        $join_year_data = array();
        $passed_year_data = array();
        $currently_study_data = array();
        foreach ($request->degree as $key => $degree) {
            array_push($education_data, $degree);
            array_push($study_field_data, $request->filed_of_study[$key]);
            array_push($institution_data, $request->institution[$key]);
            array_push($university_data, $request->board[$key]);
            array_push($join_year_data, $request->joined_year[$key]);
            array_push($passed_year_data, isset($request->currently_study[$key]) ? $request->currently_study[$key] : (isset($request->passed_year[$key]) ? $request->passed_year[$key] : ""));
        }
        $education->education_id = json_encode($education_data);
        $education->study_field_id = json_encode($study_field_data);
        $education->institution = json_encode($institution_data);
        $education->university = json_encode($university_data);
        $education->join_year = json_encode($join_year_data);
        $education->passed_year = json_encode($passed_year_data);
        $education->user_id = $this->user_id ?? auth()->user()->id;
        $education->save();
        if (isset($education)) {
            return back()->with('status', 'Education information is Saved successfully!!');
        } else {
            return back()->with('error', 'Something Went Wrong!!');
        }
    }
    public function updateEducation(Request $request)
    {
        $request->validate([
            'degree.*' => 'required',
            'filed_of_study.*' => 'required',
            'institution.*' => 'required',
            'board.*' => 'required',
            'joined_year.*' => 'required|numeric',
            'passed_year.*' => 'nullable|numeric',
            'currently_study.*' => 'nullable',
        ]);
        $education = JobSeekerEducation::where('user_id', $this->user_id ?? auth()->user()->id)->first();
        $education->education_id = null;
        $education->study_field_id = null;
        $education->institution = null;
        $education->university = null;
        $education->join_year = null;
        $education->passed_year = null;
        $education_data = array();
        $study_field_data = array();
        $institution_data = array();
        $university_data = array();
        $join_year_data = array();
        $passed_year_data = array();

        foreach ($request->degree as $key => $degree) {
            array_push($education_data, $degree);
            array_push($study_field_data, $request->filed_of_study[$key]);
            array_push($institution_data, $request->institution[$key]);
            array_push($university_data, $request->board[$key]);
            array_push($join_year_data, $request->joined_year[$key]);
            array_push($passed_year_data, (is_null($request->passed_year[$key]) ? 'Currently Studying' : $request->passed_year[$key]));
        }
        $education->education_id = json_encode($education_data);
        $education->study_field_id = json_encode($study_field_data);
        $education->institution = json_encode($institution_data);
        $education->university = json_encode($university_data);
        $education->join_year = json_encode($join_year_data);
        $education->passed_year = json_encode($passed_year_data);
        $education->user_id = $this->user_id ?? auth()->user()->id;
        $education->save();
        if (isset($education)) {
            return back()->with('status', 'Education information is Saved successfully!!');
        } else {
            return back()->with('error', 'Something Went Wrong!!');
        }

    }
    public function training()
    {

        $data = [
            'job_seeker_training' => JobSeekerTraining::where('user_id', $this->user_id ?? auth()->user()->id)->first(),
        ];
        return view('user.jobseeker.seeker-training', $data);
    }
    public function storeTraining(Request $request)
    {
        $this->validate($request, [
            'traning_title' => ['required', 'array'],
            'traning_title.*' => ['required', 'string', 'max:500'],

            'traning_year' => ['required', 'array'],
            'traning_year.*' => ['required', 'numeric', 'digits:4'],

            'institution_name' => ['required', 'array'],
            'institution_name.*' => ['required', 'string', 'max:500'],
        ]);

        $additional_traning = new JobSeekerTraining();
        $traning_title_data = array();
        $traning_year_data = array();
        $institution_name_data = array();
        foreach ($request->traning_title as $traning_title) {
            array_push($traning_title_data, $traning_title);
        }
        foreach ($request->traning_year as $traning_year) {
            array_push($traning_year_data, $traning_year);
        }
        foreach ($request->institution_name as $institution) {
            array_push($institution_name_data, $institution);
        }
        $additional_traning->training_title = json_encode($traning_title_data);
        $additional_traning->training_year = json_encode($traning_year_data);
        $additional_traning->training_institution = json_encode($institution_name_data);
        $additional_traning->user_id = $this->user_id ?? auth()->user()->id;
        $additional_traning->save();
        return back()->with('status', 'Successfully Created.');

    }
    public function updateTraining(Request $request)
    {
        $additional_traning = JobSeekerTraining::where('user_id', $this->user_id ?? auth()->user()->id)->first();
        if ($request->traning_title == [] || $request->traning_title == null) {
            $additional_traning->delete();
            return back()->with('status', 'Successfully Update.');

        }
        $this->validate($request, [
            'traning_title' => ['required', 'array'],
            'traning_title.*' => ['required', 'string', 'max:500'],

            'traning_year' => ['required', 'array'],
            'traning_year.*' => ['required', 'numeric', 'digits:4'],

            'institution_name' => ['required', 'array'],
            'institution_name.*' => ['required', 'string', 'max:500'],
        ]);

        $additional_traning->training_title = [];
        $additional_traning->training_year = [];
        $additional_traning->training_institution = [];
        $traning_title_data = array();
        $traning_year_data = array();
        $institution_name_data = array();
        foreach ($request->traning_title as $traning_title) {
            array_push($traning_title_data, $traning_title);
        }
        foreach ($request->traning_year as $traning_year) {
            array_push($traning_year_data, $traning_year);
        }
        foreach ($request->institution_name as $institution) {
            array_push($institution_name_data, $institution);
        }
        $additional_traning->training_title = json_encode($traning_title_data);
        $additional_traning->training_year = json_encode($traning_year_data);
        $additional_traning->training_institution = json_encode($institution_name_data);
        $additional_traning->user_id = $this->user_id ?? auth()->user()->id;
        $additional_traning->save();
        return back()->with('status', 'Successfully Update.');

    }

    public function experience()
    {
        $data = [
            'check_experiance_info' => JobSeekerExperience::where('user_id', $this->user_id ?? auth()->user()->id)->first(),
            'company' => CompanyCategory::where('status', 'active')->orderBy('order_no')->get(),
            'job_levels' => JobLevel::where('status', 'active')->orderBy('order_no')->get(),
            'skills' => Skill::where('status', 'active')->orderBy('order_no')->get(),
        ];
        return view('user.jobseeker.seeker-experience', $data);
    }
    public function storeExperience(Request $request)
    {
        $request->validate([
            'position.*' => 'required',
            'organization_name.*' => 'required',
            'industry.*' => 'required',
            'job_level.*' => 'required',
            'comments.*' => 'required',
            'joined_year.*' => 'required|numeric',
            'lefted_year.*' => 'nullable|numeric',
        ]);
        $organization_name_data = array();
        $industry_data = array();
        $job_level_data = array();
        $comment_data = array();
        $joined_year_data = array();
        $lefted_year_data = array();
        $position_data = array();
        $experiance = new JobSeekerExperience();
        foreach ($request->position as $key => $position) {
            array_push($position_data, $position);
            array_push($organization_name_data, $request->organization_name[$key]);
            array_push($comment_data, $request->comments[$key]);
            array_push($joined_year_data, $request->joined_year[$key]);
            array_push($lefted_year_data, isset($request->currently_working[$key]) ? $request->currently_working[$key] : (isset($request->lefted_year[$key]) ? $request->lefted_year[$key] : ""));
            array_push($industry_data, $request->industry[$key]);
            array_push($job_level_data, $request->job_level[$key]);
        }
        $experiance->position = json_encode($position_data);
        $experiance->organization_name = json_encode($organization_name_data);
        $experiance->industry = json_encode($industry_data);
        $experiance->job_level = json_encode($job_level_data);
        $experiance->roles_and_responsibility = json_encode($comment_data);
        $experiance->joined_year = json_encode($joined_year_data);
        $experiance->left_year = json_encode($lefted_year_data);
        $experiance->user_id = $this->user_id ?? auth()->user()->id;
        $experiance->save();
        if (isset($experiance)) {
            return back()->with('status', 'Experiance Saved Successfully.');
        } else {
            return back()->with('error', 'Something Went Wrong!!');
        }

    }
    public function updateExperience(Request $request)
    {
        $experiance = JobSeekerExperience::where('user_id', $this->user_id ?? auth()->user()->id)->first();

        if ($request->position == [] || $request->position == null) {
            $experiance->delete();
            return back()->with('status', 'Experiance Update Successfully.');

        }

        $request->validate([
            'position.*' => 'required',
            'organization_name.*' => 'required',
            'industry.*' => 'required',
            'job_level.*' => 'required',
            'comments.*' => 'required',
            'joined_year.*' => 'required',
            'lefted_year.*' => 'nullable|numeric',
        ]);
        $experiance->position = [];
        $experiance->organization_name = [];
        $experiance->industry = [];
        $experiance->job_level = [];
        $experiance->roles_and_responsibility = [];
        $experiance->joined_year = [];
        $experiance->left_year = [];
        $organization_name_data = array();
        $industry_data = array();
        $job_level_data = array();
        $comment_data = array();
        $joined_year_data = array();
        $lefted_year_data = array();
        $position_data = array();
        foreach ($request->position as $key => $position) {
            array_push($position_data, $position);
            array_push($organization_name_data, $request->organization_name[$key]);
            array_push($comment_data, $request->comments[$key]);
            array_push($joined_year_data, $request->joined_year[$key]);
            array_push($lefted_year_data, isset($request->currently_working[$key]) ? $request->currently_working[$key] : (isset($request->lefted_year[$key]) ? $request->lefted_year[$key] : ""));
            array_push($industry_data, $request->industry[$key]);
            array_push($job_level_data, $request->job_level[$key]);
        }
        $experiance->position = json_encode($position_data);
        $experiance->organization_name = json_encode($organization_name_data);
        $experiance->industry = json_encode($industry_data);
        $experiance->job_level = json_encode($job_level_data);
        $experiance->roles_and_responsibility = json_encode($comment_data);
        $experiance->joined_year = json_encode($joined_year_data);
        $experiance->left_year = json_encode($lefted_year_data);
        $experiance->save();
        if (isset($experiance)) {
            return back()->with('status', 'Experiance Update Successfully.');
        } else {
            return back()->with('error', 'Something Went Wrong!!');
        }

    }
    public function language()
    {

        $data = [
            'check_additional_info' => JobSeekerAdditionalField::where('user_id', $this->user_id ?? auth()->user()->id)->first(),
            'languages' => Language::where('status', 'active')->orderBy('order_no')->get(),

        ];
        return view('user.jobseeker.seeker-language', $data);
    }
    public function storeLanguage(Request $request)
    {
        $request->validate([
            'language.*' => 'required',
        ]);
        $additional_field = new JobSeekerAdditionalField();
        $language_data = array();

        foreach ($request->language as $language) {
            array_push($language_data, $language);
        }
        $additional_field->language = json_encode($language_data);
        $additional_field->user_id = $this->user_id ?? auth()->user()->id;
        $additional_field->save();
        return back()->with('status', 'Language Created Successfully.');

    }
    public function updateLanguage(Request $request)
    {
        $request->validate([
            'language.*' => 'required',
        ]);
        $additional_field = JobSeekerAdditionalField::where('user_id', $this->user_id ?? auth()->user()->id)->first();
        $additional_field->language = [];
        $language_data = array();

        foreach ($request->language as $language) {
            array_push($language_data, $language);
        }
        $additional_field->language = json_encode($language_data);
        $additional_field->user_id = $this->user_id ?? auth()->user()->id;
        $additional_field->save();
        return back()->with('status', 'Languages Update Successfully.');

    }
    public function socialAccount()
    {

        $data = [
            'job_seeker_social_networks' => JobSeekerSocialNetwork::where('user_id', $this->user_id ?? auth()->user()->id)->first(),
        ];
        return view('user.jobseeker.seeker-social-account', $data);
    }
    public function storeSocial(Request $request)
    {
        $request->validate([
            'social_name.*' => 'required',
            'profile_url.*' => 'required|url',
        ]);
        $additional_social = new JobSeekerSocialNetwork();
        $social_name_data = array();
        $profile_url_data = array();
        foreach ($request->social_name as $social) {
            array_push($social_name_data, $social);
        }
        foreach ($request->profile_url as $url) {
            array_push($profile_url_data, $url);
        }
        $additional_social->social_name = json_encode($social_name_data);
        $additional_social->social_url = json_encode($profile_url_data);
        $additional_social->user_id = $this->user_id ?? auth()->user()->id;
        $additional_social->save();
        return back()->with('status', 'Social Account Store Successfully.');

    }
    public function updateSocial(Request $request)
    {

        $additional_social = JobSeekerSocialNetwork::where('user_id', $this->user_id ?? auth()->user()->id)->first();
        if ($request->social_name == [] || $request->social_name == null) {
            $additional_social->delete();
            return back()->with('status', 'Social Update Successfully.');
        }
        $request->validate([
            'social_name.*' => 'required',
            'profile_url.*' => 'required|url',
        ]);
        $additional_social->social_name = [];
        $additional_social->social_url = [];
        $social_name_data = array();
        $profile_url_data = array();
        foreach ($request->social_name as $social) {
            array_push($social_name_data, $social);
        }
        foreach ($request->profile_url as $url) {
            array_push($profile_url_data, $url);
        }
        $additional_social->social_name = json_encode($social_name_data);
        $additional_social->social_url = json_encode($profile_url_data);
        $additional_social->user_id = $this->user_id ?? auth()->user()->id;
        $additional_social->save();
        return back()->with('status', 'Social Account Update Successfully.');

    }
    public function reference()
    {

        $data = [
            'job_seeker_reference' => JobSeekerReference::where('user_id', $this->user_id ?? auth()->user()->id)->first(),

        ];
        return view('user.jobseeker.seeker-reference', $data);
    }
    public function storeReferance(Request $request)
    {
        $request->validate([
            'reference_person_name.*' => 'nullable',
            'position.*' => 'nullable',
            'email.*' => 'nullable',
            'company.*' => 'nullable',
        ]);
        $additional_reference = new JobSeekerReference();
        $reference_person_name_data = array();
        $position_data = array();
        $email_data = array();
        $company_data = array();
        // $ref_phone = [];
        // $ref_mobile = [];
        foreach ($request->reference_person_name as $person) {
            array_push($reference_person_name_data, $person);
        }
        foreach ($request->position as $position) {
            array_push($position_data, $position);
        }
        foreach ($request->email as $email) {
            array_push($email_data, $email);
        }
        foreach ($request->company as $company) {
            array_push($company_data, $company);
        }
        // foreach ($request->phone as $phone) {
        //     array_push($ref_phone, $phone);
        // }
        // foreach ($request->mobile as $mobile) {
        //     array_push($ref_mobile, $mobile);
        // }
        $additional_reference->reference_person = json_encode($reference_person_name_data);
        $additional_reference->reference_position = json_encode($position_data);
        $additional_reference->reference_email = json_encode($email_data);
        $additional_reference->user_id = $this->user_id ?? auth()->user()->id;
        $additional_reference->reference_company = json_encode($company_data);
        // $additional_reference->reference_phone = json_encode($ref_phone);
        // $additional_reference->reference_mobile = json_encode($ref_mobile);
        $additional_reference->save();
        return back()->with('status', 'Reference Store Successfully.');

    }
    public function updateReferance(Request $request)
    {
        $additional_reference = JobSeekerReference::where('user_id', $this->user_id ?? auth()->user()->id)->first();

        if ($request->reference_person_name == [] || $request->position == null) {
            $additional_reference->delete();
            return back()->with('status', 'Experiance Update Successfully.');

        }
        $request->validate([
            'reference_person_name.*' => 'nullable',
            'position.*' => 'nullable',
            'email.*' => 'nullable',
            'company.*' => 'nullable',
        ]);
        $additional_reference->reference_person = [];
        $additional_reference->reference_position = [];
        $additional_reference->reference_email = [];
        $reference_person_name_data = array();
        $position_data = array();
        $email_data = array();
        $company_data = array();
        // $ref_phone = [];
        // $ref_mobile = [];
        foreach ($request->reference_person_name as $person) {
            array_push($reference_person_name_data, $person);
        }
        foreach ($request->position as $position) {
            array_push($position_data, $position);
        }
        foreach ($request->email as $email) {
            array_push($email_data, $email);
        }
        foreach ($request->company as $company) {
            array_push($company_data, $company);
        }
        // foreach ($request->phone as $phone) {
        //     array_push($ref_phone, $phone);
        // }
        // foreach ($request->mobile as $mobile) {
        //     array_push($ref_mobile, $mobile);
        // }
        $additional_reference->reference_person = json_encode($reference_person_name_data);
        $additional_reference->reference_position = json_encode($position_data);
        $additional_reference->reference_email = json_encode($email_data);
        $additional_reference->user_id = $this->user_id ?? auth()->user()->id;
        $additional_reference->reference_company = json_encode($company_data);
        // $additional_reference->reference_phone = json_encode($ref_phone);
        // $additional_reference->reference_mobile = json_encode($ref_mobile);
        $additional_reference->save();
        return back()->with('status', 'Reference Update Successfully.');

    }
    public function otherInfo()
    {

        $data = [
            'job_seeker_social_networks' => JobSeekerSocialNetwork::where('user_id', $this->user_id ?? auth()->user()->id)->first(),

        ];
        return view('user.jobseeker.seeker-other-info');
    }

}