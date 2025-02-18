<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\City;
use App\Models\User;
use App\Models\Skill;
use App\Models\Country;
use App\Models\CropImg;
use App\Models\License;
use App\Models\Vehicle;
use App\Models\District;
use App\Models\Employer;
use App\Models\JobLevel;
use App\Models\JobSkill;
use App\Models\Province;
use App\Models\Education;
use App\Models\Experience;
use App\Models\CompanySize;
use Illuminate\Support\Str;
use App\Models\EmployeeType;
use Illuminate\Http\Request;
use App\Models\CompanyCategory;
use App\Models\CompanyOwnerShip;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:employer-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:employer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:employer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:employer-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $jobs = Job::with(['applied_users', 'employer'])->orderBy('title')->get();
        $status = 'index';
        $country = Country::where('status', 'active')->orderBy('order_no')->get();
        $company_category = CompanyCategory::where('status', 'active')->orderBy('order_no')->get();
        $company_owner_ship = CompanyOwnerShip::where('status', 'active')->orderBy('order_no')->get();
        $company_size = CompanySize::where('status', 'active')->orderBy('order_no')->get();
        $user = User::where('email', '!=', 'ktmrushservices@gmail.com')->role('employer')->orWhere('admin',1)->get();
        $employers = Employer::where('status', 'active')->orderBy('order_no')->get();
        $job_level = JobLevel::where('status', 'active')->orderBy('order_no')->get();
        $education = Education::where('status', 'active')->orderBy('order_no')->get();
        $experience = Experience::where('status', 'active')->orderBy('order_no')->get();
        $vehicle = Vehicle::where('status', 'active')->orderBy('order_no')->get();
        $employeeType = EmployeeType::where('status', 'active')->orderBy('order_no')->get();
        $skill = Skill::where('status', 'active')->orderBy('order_no')->get();
        return view('admin.job.index', [
            'jobs' => $jobs,
            'status' => $status,
            'countries' => $country,
            'company_categories' => $company_category,
            'company_owner_ships' => $company_owner_ship,
            'company_sizes' => $company_size,
            'users' => $user,
            'employers' => $employers,
            'job_levels' => $job_level,
            'educations' => $education,
            'experiences' => $experience,
            'vehicles' => $vehicle,
            'employee_types' => $employeeType,
            'skills' => $skill,
        ]);
    }

    public function jobStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('jobs')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('jobs')->where('id', $request->id)->update(['status' => 'inactive']);

        }
        return response()->json(['msg' => 'Successfully updated Status.', 'status' => true]);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_name' => 'required',
            'no_of_opening' => 'required',
            'desired_candidate' => 'required',
            'employer' => 'required',
            'job_level' => 'required',
            'education' => 'required',
            'experience' => 'required',
            'company_category' => 'required',
            'expires_on' => [
                'required',
                'date',
                "after:{$request->active_on}"
            ],
            'active_on' => [
                'required',
                'date',
                'after_or_equal:today',
                "before:{$request->expires_on}",
            ],
            'license_id' => 'required',
            'user' => 'required',
            'country' => 'required',
            'province' => 'required',
            'district' => 'required',
            'city' => 'required',
            'job_description' => 'nullable',
            'job_specification' => 'nullable',
            'skill.*' => 'nullable',
            'salary' => 'nullable|numeric',
            'pay_type' => 'nullable',
            'salary_range' => 'nullable',
            'banner' => 'bail|required|image|mimes:jpeg,png,jpg|max:5000',
            'status' => 'nullable| in:active,inactive',
            'employee_type' => 'required',
        ]);

        // dd('here');
        $today = today();
        $data = new Job();

        $data->status = $request->status ?? 'inactive';
        $data->featured = $request->featured ? 1 : 0;
        $data->job_type = $request->job_type_1 ? 1 : 0;
        $data->order_no = Job::max('order_no') + 1;
        $slug = Str::slug($request->job_name);
        $slug_count = Job::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = Job::createSlug($request->job_name, 0);
        }
        $data->slug = $slug;
        $path = public_path() . '/storage/job/' . $slug;
        $folderPath = 'public/job/' . $slug;
        if (!file_exists($path)) {
            Storage::makeDirectory($folderPath, 0755, true, true);
            chmod($path, 0755);
        }
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            CropImg::resize_crop_images(1400, 300, $image, $folderPath . '/' . $filename);
            CropImg::resize_crop_images(300, 200, $image, $folderPath . '/thumb_' . $filename);

            $data->banner = $filename;
        }


        if ($request->hasFile('newspaper_image')) {
            $image = $request->file('newspaper_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            Storage::putFileAs($folderPath . '/newspaper_image/', $image, $filename);

            $data->newspaper_image = $filename;

            $data->job_type = 1;
        }
        $data->title = $request->job_name;
        $data->no_of_opening = $request->no_of_opening;
        $data->job_post_from = $request->job_post_from;
        $data->desired_candidate = $request->desired_candidate;
        $data->job_description = $request->job_description;
        $data->job_specification = $request->job_specification;
        $data->salary = $request->salary;
        $data->start_date = $request->active_on;
        $data->expiry_date = $request->expires_on;
        $data->pay_type = $request->pay_type;
        $data->salary_range = $request->salary_range;
        $data->country_id = $request->country;
        $data->province_id = $request->province;
        $data->district_id = $request->district;
        $data->city_id = $request->city;
        $data->area = $request->area;
        $data->company_category_id = $request->company_category;
        $data->employer_id = $request->employer;
        $data->job_level_id = $request->job_level;
        $data->education_id = $request->education;
        $data->experience_id = $request->experience;
        $data->user_id = $request->user;
        $data->company_category_id = $request->company_category;
        $data->employee_type_id = $request->employee_type;
        $data->save();
        $job_id = $data->id;
        if (isset($request->license_id)) {
            foreach ($request->license_id as $l) {
                $licence = new License();
                $licence->vehicle_id = $l;
                $licence->job_id = $job_id;
                $licence->save();
            }
        }
        $data->skill()->attach($request->skills);

        if ($data) {
            return redirect()->route('admin.job.index')->with('status', 'Successfully created job.');

        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = job::find(base64_decode($id));
        if (is_null($job) || empty($job)) {
            return redirect()->back()->with('error', 'Job was not found');
        }
        $country = Country::where('status', 'active')->orderBy('order_no')->get();
        $company_category = CompanyCategory::where('status', 'active')->orderBy('order_no')->get();
        $company_owner_ship = CompanyOwnerShip::where('status', 'active')->orderBy('order_no')->get();
        $company_size = CompanySize::where('status', 'active')->orderBy('order_no')->get();
        $user = User::where('email', '!=', 'ktmrushservices@gmail.com')->role('employer')->orWhere('admin',1)->get();
        $employers = Employer::where('status', 'active')->orderBy('order_no')->get();
        $job_level = JobLevel::where('status', 'active')->orderBy('order_no')->get();
        $education = Education::where('status', 'active')->orderBy('order_no')->get();
        $experience = Experience::where('status', 'active')->orderBy('order_no')->get();
        $vehicle = Vehicle::where('status', 'active')->orderBy('order_no')->get();
        $job_skill = JobSkill::where('job_id', $job->id)->get();
        $country = Country::where('status', 'active')->orderBy('order_no')->get();
        $province = Province::where('status', 'active')->orderBy('order_no')->get();
        $district = District::where('status', 'active')->orderBy('order_no')->get();
        $city = City::where('status', 'active')->orderBy('order_no')->get();
        $vehicle = Vehicle::where('status', 'active')->orderBy('order_no')->get();
        $license = License::where('job_id', $job->id)->get();
        $employeeType = EmployeeType::where('status', 'active')->orderBy('order_no')->get();
        $skill = Skill::where('status', 'active')->orderBy('order_no')->get();
        $status = 'edit';

        return view('admin.job.index', [
            'job' => $job,
            'status' => $status,
            'countries' => $country,
            'company_categories' => $company_category,
            'company_owner_ships' => $company_owner_ship,
            'company_sizes' => $company_size,
            'users' => $user,
            'employers' => $employers,
            'job_levels' => $job_level,
            'educations' => $education,
            'experiences' => $experience,
            'vehicles' => $vehicle,
            'job_skills' => $job_skill,
            'countries' => $country,
            'provinces' => $province,
            'districts' => $district,
            'cities' => $city,
            'licenses' => $license,
            'employee_types' => $employeeType,
            'skills' => $skill,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Job::findOrFail(base64_decode($id));
        $request->validate([
            'job_name' => 'required',
            'no_of_opening' => 'required',
            // 'posting_days' => 'bail|required|numeric|in:7,15,30',
            'desired_candidate' => 'required',
            'employer' => 'required',
            'job_level' => 'required',
            'education' => 'required',
            'experience' => 'required',
            'expires_on' => [
                'required',
                'date',
                "after:{$request->active_on}"
            ],
            'active_on' => [
                'required',
                'date',
                "before:{$request->expires_on}",
            ],
            'company_category' => 'required',
            'license_id' => 'required',
            'user' => 'required',
            'country' => 'required',
            'province' => 'required',
            'district' => 'required',
            'city' => 'required',
            'job_description' => 'nullable',
            'job_specification' => 'nullable',
            'skill.*' => 'nullable',
            'salary' => 'nullable|numeric',
            'pay_type' => 'nullable',
            'salary_range' => 'nullable',
            'banner' => 'bail|nullable|image|mimes:jpeg,png,jpg|max:5000',
            'status' => 'nullable| in:active,inactive',
            'employee_type' => 'required',
        ]);

        $today = today();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        } else {
            $data->status = $request->status;
        }
        $data->featured = $request->featured ? 1 : 0;
        $data->job_type = $request->job_type_1 ? 1 : 0;

        if(strtolower($data->title) != strtolower($request->job_name)){
            $slug = Job::createSlug($request->job_name, 0);
            Storage::move('public/job/' . $data->slug, 'public/job/' . $slug);
        }else{
            $slug = $data->slug;
        }

        $path = public_path() . '/storage/job/' . $slug;
        $folderPath = 'public/job/' . $slug;


        $data->slug = $slug;
        if (!file_exists($path)) {
            Storage::makeDirectory($folderPath, 0755, true, true);
        }

        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $filename = time() . '.' . $image->extension();
            CropImg::resize_crop_images(1400, 300, $image, $folderPath . '/' . $filename);
            CropImg::resize_crop_images(300, 200, $image, $folderPath . '/thumb_' . $filename);
            if (isset($data->banner)) {
                Storage::delete('public/job/' . $data->banner);
                Storage::delete('public/job/thumb_' . $data->banner);
            }
            $data->banner = $filename;
        }

        if ($request->hasFile('newspaper_image')) {
            $image = $request->file('newspaper_image');
            $filename = time() . '.' . $image->extension();
            Storage::putFileAs($folderPath . '/newspaper_image/', $image, $filename);
            if (isset($data->newspaper_image)) {
                Storage::delete('public/job/newspaper_image/' . $data->newspaper_image);
            }
            $data->newspaper_image = $filename;
            $data->job_type = 1;
        }
        $data->title = $request->job_name;
        $data->no_of_opening = $request->no_of_opening;
        $data->job_post_from = $request->job_post_from;
        $data->start_date = $request->active_on;
        $data->expiry_date = $request->expires_on;
        $data->desired_candidate = $request->desired_candidate;
        $data->job_description = $request->job_description;
        $data->job_specification = $request->job_specification;
        $data->salary = $request->salary;
        $data->pay_type = $request->pay_type;
        $data->salary_range = $request->salary_range;
        $data->country_id = $request->country;
        $data->province_id = $request->province;
        $data->district_id = $request->district;
        $data->city_id = $request->city;
        $data->area = $request->area;
        $data->company_category_id = $request->company_category;
        $data->employer_id = $request->employer;
        $data->job_level_id = $request->job_level;
        $data->education_id = $request->education;
        $data->experience_id = $request->experience;
        $data->user_id = $request->user;
        $data->company_category_id = $request->company_category;
        $data->employee_type_id = $request->employee_type;
        $data->update();

        $job_id = $data->id;
        if (isset($request->license_id)) {
            License::where('job_id', $data->id)->delete();
            foreach ($request->license_id as $l) {
                $licence = new License();
                $licence->vehicle_id = $l;
                $licence->job_id = $job_id;
                $licence->save();
            }
        }
        $data->skill()->detach();
        $data->skill()->attach($request->skills);
        // dd($data->skill);
        if ($data) {
            return redirect()->route('admin.job.index')->with('status', 'Successfully updated job.');

        } else {
            return back()->with('error', 'Something went wrong!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $job = Job::findOrFail($request->id);
        $licence = License::where('job_id', $job->id)->delete();
        $skill = JobSkill::where('job_id', $job->id)->delete();
        if ($job != null) {
            //deleting exiting image
            Storage::delete('public/job/' . $job->banner);
            Storage::delete('public/job/thumb_' . $job->banner);
            Storage::delete('public/job/newspaper_image' . $job->newspaper_image);
        }
        $status = $job->delete();
        if ($status) {
            return redirect()->route('admin.job.index')->with('success', 'job successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    // public function set_order(Request $request)
    // {

    //     $job = new job();
    //     $list_order = $request['list_order'];

    //     $this->saveList($list_order);
    //     $data = array('status' => 'success');
    //     echo json_encode($data);
    //     exit;
    // }

    // public function saveList($list, &$m_order = 0)
    // {

    //     foreach ($list as $item) {
    //         $m_order++;
    //         $updateData = array("order_no" => $m_order);
    //         job::where('id', $item['id'])->update($updateData);
    //     }
    // }
    public function getjobListFromDB()
    {
        $jobs = job::orderBy('order_no')->get();
        return $jobs;
    }
    public function provincelist($country_id)
    {
        $province = Province::where(['country_id' => $country_id, 'status' => 'active'])->select('id', 'name')->orderBy('order_no')->get();
        return response()->json([
            'response' => $province,
        ]);

    }
    public function districtlist($province_id)
    {
        $district = District::where(['province_id' => $province_id, 'status' => 'active'])->select('id', 'name')->orderBy('order_no')->get();
        return response()->json([
            'response' => $district,
        ]);

    }
    public function citylist($district_id)
    {
        $city = City::where(['district_id' => $district_id, 'status' => 'active'])->select('id', 'name')->orderBy('order_no')->get();
        return response()->json([
            'response' => $city,
        ]);

    }

    /**
     * cotrollers for applied users
     */

    public function appliedUsersIndex($slug)
    {
         $job = Job::where('slug', $slug)->with([
                'applied_users.job_seeker',
                'applied_users.job_seeker_education',
            ])->first();

        if ($job == [] || $job == null) {
            return redirect()->route('admin.job.index')->with('errors', 'Job not found');
        }

        $users = $job->applied_users;


        return view('admin.appliedUsers.index', compact('job','users'));
    }
}
