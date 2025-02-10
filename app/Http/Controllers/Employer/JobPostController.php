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
use App\Models\Experience;
use App\Models\Job;
use App\Models\JobLevel;
use App\Models\JobSkill;
use App\Models\License;
use App\Models\Province;
use App\Models\Skill;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobPostController extends Controller
{
    /**
     * View response from the job seeker of a job
     */
    public function viewApplied($slug)
    {

        $filter = request()->filter ?? 'apply_user';
        if ($filter == 'pending') {
            $job = Job::where('slug', $slug)->with([
                'pending_applicants.job_seeker',
                'pending_applicants.job_seeker_education',
            ])->first();

            if (is_null($job)) {
                return redirect()->route('employers.index');
            }
            $users = $job->pending_applicants;

        } elseif ($filter == 'accepted') {
            $job = Job::where('slug', $slug)->with([
                'accepted_applicants.job_seeker',
                'accepted_applicants.job_seeker_education',
            ])->first();

            if (is_null($job)) {
                return redirect()->route('employers.index');
            }
            $users = $job->accepted_applicants;

        } elseif ($filter == 'declined') {
            $job = Job::where('slug', $slug)->with([
                'declined_applicants.job_seeker',
                'declined_applicants.job_seeker_education',
            ])->first();

            if (is_null($job)) {
                return redirect()->route('employers.index');
            }
            $users = $job->declined_applicants;

        } else {
            $job = Job::where('slug', $slug)->with([
                'applied_users.job_seeker',
                'applied_users.job_seeker_education',
            ])->first();

            if (is_null($job)) {
                return redirect()->route('employers.index');
            }
            $users = $job->applied_users;

        }

        return view('employer.overview-jobs.jobDetail', compact('job', 'users'));
    }

    /**
     * Posts a job
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        if ($request->submit == 'post') {
            $post = $this->PostAJob($request);
        } elseif ($request->submit == 'draft') {
            $draft = $this->PostAJob($request, 1);
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
        // dd($post);

        if (@$draft == 1) {
            return redirect()->route('employers.index')->with('status', 'Job Sent To Draft');
        } elseif (@$post == 1) {
            return redirect()->route('employers.index')->with('status', 'Job Post Succesfully');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    public function articleStore(Request $request)
    {
        if ($request->submit == 'post') {
            $post = $this->PostAJob($request, 0, 1);
        } elseif ($request->submit == 'draft') {
            $draft = $this->PostAJob($request, 1, 1);
        } else {

            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
        if (@$draft == 1) {
            return redirect()->route('employers.index')->with('status', 'Job Sent To Draft');
        } elseif (@$post == 1) {
            return redirect()->route('employers.index')->with('status', 'Job Post Succesfully');
        } else {
            if (\Session::has('error')) {
                return redirect()->back()->with('error', \Session::get('error'));
            }
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    public function PostAJob($request, $pending = 0, $article = 0)
    {
        $this->validate($request, [
            'job_title' => 'required',
            'no_of_opening' => 'required|numeric',
            'category' => 'required',
            'job_type' => 'required',
            'job_level' => 'required',
            'desired_candidate' => 'required',
            'education_level' => 'required',
            'experience_year' => 'required',
            'province' => 'required|not_in:0',
            'districts' => 'required|not_in:0',
            'city' => 'required|not_in:0',
            'salary_pay' => 'required',
            'salary_range' => 'required',
            'license' => 'required',
            //array
            'job_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        if ($article == 0) {
            $this->validate($request, [
                'job_description' => 'nullable',
                'job_specification' => 'required',
            ]);
        } else if ($article == 1) {
            $this->validate($request, [
                'newspaper_article' => 'required | image | mimes:jpg,jpeg,png',
            ]);
        } else {
            return false;
        }

        $job = new Job;
        $today = Carbon::today();
        $slug = Job::createSlug($request->job_title, 'id');

        $job->title = $request->job_title;
        $job->no_of_opening = $request->no_of_opening;
        $job->job_post_from = auth()->user()->employer->company_name;
        $job->slug = $slug;
        $job->desired_candidate = $request->desired_candidate;
        $job->type = $request->job_type;
        $job->pay_type = $request->salary_pay;
        $job->salary_range = $request->salary_range;
        $job->start_date = $request->post_on;
        $job->expiry_date = $request->expires_on;
        $job->status = $pending ? 'pending' : 'active';
        $job->cover_letter = @$request->cover_letter ? 1 : 0;
        if ($job->status == 'active') {
            $job->approval = 'pending';
        }
        $job->featured = 1;
        $job->country_id = 1;
        $job->order_no = Job::max('order_no') + 1;
        $job->job_level_id = base64_decode($request->job_level);
        $job->education_id = base64_decode($request->education_level);
        $job->experience_id = base64_decode($request->experience_year);
        $job->user_id = auth()->id();
        $job->employer_id = auth()->user()->employer->id;
        $job->province_id = base64_decode($request->province);
        $job->company_category_id = $request->category == 0 ? 0 : base64_decode($request->category);

        //checking if the district lies in the respective province or not
        $districtFlag = $this->validateDistrict($job->province_id, $request->districts);

        if ($districtFlag) {
            $job->district_id = $request->districts;
        } else {
            return false;
        }

        $job->city_id = $request->city;

        // upload of banner image
        if ($request->hasFile('job_banner')) {

            //path for the images and file to save
            $path = public_path() . '/storage/job/' . $slug;
            $folderPath = 'public/job/' . $slug;

            if (!file_exists($path)) {
                Storage::makeDirectory($folderPath, 0755, true, true);
                chmod($path, 0755);
            }

            $file = $request->file('job_banner');
            $filename = time() . '.' . $file->extension();

            CropImg::resize_crop_images(1400, 300, $file, $folderPath . '/' . $filename);
            CropImg::resize_crop_images(300, 200, $file, $folderPath . '/thumb_' . $filename);

            $job->banner = $filename;
        }

        // job_type is the way the user is send data
        // if the user is sending data with newspaper article or not
        // where, 1 = Job
        //         2= Newspaper job
        if ($article == 0) {
            //need to arange
            $job->job_description = $request->job_description;
            $job->job_specification = $request->job_specification;
            $job->job_type = 1;

        } elseif ($article == 1) {
            $job->job_type = 1;

            if ($request->hasFile('newspaper_article')) {

                //path for the images and file to save
                $path = public_path() . '/storage/job/' . $slug;
                $folderPath = 'public/job/' . $slug;

                if (!file_exists($path)) {
                    Storage::makeDirectory($folderPath, 0755, true, true);
                    chmod($path, 0755);
                }

                $file = $request->file('newspaper_article');
                $fileName = time() . '.' . $file->extension();

                Storage::putFileAs($folderPath . '/newspaper_image/', $file, $fileName);
                $job->newspaper_image = $fileName;
            }
        } else {
            return false;
        }

        $job->save();

        $licenseFlag = $this->validateLicense($request->license, $job->id); //check if the licence is valid or not
        if (!$licenseFlag) {
            $job->license = 0;
        }
        // dd($request->skills);

        // if ($request->skills) {
        //     $skillFlag = $this->skillValidate($request->skills);
        //     if ($skillFlag) {
        //         $job->skill()->attach($request->skills);
        //     } else {
        //         $job->delete();
        //         \Session::put('error', 'Invalid skill');
        //         return false;
        //     }
        // }
        // $job->skill()->detach();
        $job->skill()->attach($job->skills);

        $job->update();

        return true;
    }

    private function validateDistrict($province, $district)
    {
        $district = District::where('province_id', $province)->where('id', $district)->first();

        if ($district != null) {
            return true;
        }

        return false;
    }

    private function validateLicense($license, $job_id)
    {
        if (in_array('0', $license)) {
            return false;
        } else {
            foreach ($license as $licen) {
                $data = new License();
                $data->vehicle_id = $licen;
                $data->job_id = $job_id;
                $data->save();
            }
        }

        return true;
    }

    private function skillValidate($skills)
    {

        foreach ($skills as $data) {
            if (!is_int((int) $data)) {
                return false;
            }
        }

        return true;
    }

    /**
     * edit posts
     */
    public function edit($slug)
    {
        $job = Job::where('slug', $slug)->first();
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

        if ($job == []) {
            return redirect()->back()->with('error', 'Job post not found');
        }

        $selectedDistricts = District::where('province_id', $job->province_id)->get();
        $selectedCities = City::where('district_id', $job->district_id)->get();

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
                'provinces',
                'job',
                'selectedDistricts',
                'selectedCities',
            )
        );
    }

    /**
     * updating a post
     */
    public function update(Request $request, $slug)
    {
        // dd($request);
        $this->validate($request, [
            'job_title' => 'required',
            'no_of_opening' => 'required|numeric',
            'category' => 'required',
            'job_type' => 'required',
            'job_level' => 'required',
            'desired_candidate' => 'required',
            'education_level' => 'required',
            'experience_year' => 'required',
            'province' => 'required|not_in:0',
            'districts' => 'required|not_in:0',
            'city' => 'required|not_in:0',
            'salary_pay' => 'required',
            'salary_range' => 'required',
            'employeeType' => 'required|exists:employee_types,slug',
            'license' => 'required',
            //array
            'skills' => 'required',
            //array
            'job_description' => 'nullable',
            'job_specification' => 'required',
            'job_banner' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
        ]);

        $job = Job::where('slug', $slug)->first();
        if ($job == []) {
            return redirect()->back()->with('error', '404: POST NOT FOUND');
        }

        $today = Carbon::today();

        if (strtolower($request->title) == strtolower($job->title)) {
            $slug = Job::createSlug($request->job_title, 'id');
            $oldSlug = $job->slug;
            Storage::move('public/job/' . $oldSlug, 'public/job/' . $slug);
        } else {
            $slug = $job->slug;
        }

        $job->title = $request->job_title;
        $job->no_of_opening = $request->no_of_opening;
        $job->job_post_from = auth()->user()->employer->company_name;
        $job->slug = $slug;
        $job->desired_candidate = $request->desired_candidate;
        $job->pay_type = $request->salary_pay;
        $job->salary_range = $request->salary_range;
        $job->start_date = $request->post_on;
        $job->expiry_date = $request->expires_on;
        $job->featured = 1;
        $job->country_id = 1;
        $job->type = $request->job_type;
        $job->job_level_id = base64_decode($request->job_level);
        $job->education_id = base64_decode($request->education_level);
        $job->experience_id = base64_decode($request->experience_year);
        $job->user_id = auth()->user()->id;
        $job->employee_type_id = EmployeeType::where('slug', $request->employeeType)->first()->id;
        $job->cover_letter = @$request->cover_letter ? 1 : 0;
        $job->employer_id = auth()->user()->employer->id;
        $job->province_id = base64_decode($request->province);
        $job->company_category_id = $request->category == 0 ? 0 : base64_decode($request->category);

        //checking if the district lies in the respective province or not
        $districtFlag = $this->validateDistrict($job->province_id, $request->districts);
        // dd($districtFlag);
        if ($districtFlag) {
            $job->district_id = $request->districts;
        } else {
            return redirect()->back()->with('error', 'District does not lies in respective province');
        }

        $job->city_id = $request->city;

        // upload of banner image
        if ($request->hasFile('job_banner')) {

            //path for the images and file to save
            $path = public_path() . '/storage/job/' . $slug;
            $folderPath = 'public/job/' . $slug;

            if (!file_exists($path)) {
                Storage::makeDirectory($folderPath, 0755, true, true);
                chmod($path, 0755);
            }

            $file = $request->file('job_banner');
            $filename = time() . '.' . $file->extension();
            $oldFile = $job->banner;

            CropImg::resize_crop_images(1400, 300, $file, $folderPath . '/' . $filename);
            CropImg::resize_crop_images(300, 200, $file, $folderPath . '/thumb_' . $filename);

            Storage::delete($folderPath . '/' . $oldFile);
            Storage::delete($folderPath . '/thumb_' . $oldFile);

            $job->banner = $filename;
        }

        // job_type is the way the user is send data
        // if the user is sending data with newspaper article or not
        // where, 1 = General Job
        //         2= Newspaper job
        $job->job_type = 1;

        //need to arange
        $job->job_description = $request->job_description;
        $job->job_specification = $request->job_specification;

        if (count($job->vehicles) > 0) {
            License::where('job_id', $job->id)->delete();
        }
        $job->skill()->detach();
        $job->skill()->attach($request->skills);
        $licenseFlag = $this->validateLicense($request->license, $job->id); //check if the licence is valid or not
        if (!$licenseFlag) {
            $job->license = 0;
        }

        $job->save();

        return redirect()->route('employers.jobs.view', $job->slug)->with('status', $job->title . ' has been edited');
    }

    /*
     * Delete Job Post
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'slug' => 'required',
        ]);

        $job = Job::where('slug', $request->slug)->first();
        if ($job == []) {
            return response()->json(
                array(
                    'status' => 404,
                    'message' => 'Job not found',
                )
            );
        }

        $path = public_path('storage/job/' . $job->banner);
        if (file_exists($path)) {
            Storage::delete('public/job/' . $job->banner);
        }

        $job->delete();

        return response()->json(
            array(
                'status' => 200,
                'message' => 'Job Deleted Successfully',
            )
        );
    }
}