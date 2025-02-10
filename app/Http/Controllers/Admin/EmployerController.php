<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CompanyCategory;
use App\Models\CompanyOwnerShip;
use App\Models\CompanySize;
use App\Models\Country;
use App\Models\CropImg;
use App\Models\District;
use App\Models\Employer;
use App\Models\EmployerEmail;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployerController extends Controller
{

    public function __construc()
    {
        $this->middleware('permission:employer-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:employer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:employer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:employer-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $employers = Employer::orderBy('order_no')->get();
        $status = 'index';
        $country = Country::where('status', 'active')->orderBy('order_no')->get();
        $province = Province::where('status', 'active')->orderBy('order_no')->get();
        $district = District::where('status', 'active')->orderBy('order_no')->get();
        $city = City::where('status', 'active')->orderBy('order_no')->get();
        $company_category = CompanyCategory::where('status', 'active')->orderBy('order_no')->get();
        $company_owner_ship = CompanyOwnerShip::where('status', 'active')->orderBy('order_no')->get();
        $company_size = CompanySize::where('status', 'active')->orderBy('order_no')->get();
        $users = User::where('email', '!=', 'ktmrushservices@gmail.com')->role('employer')->orWhere('admin', 1)->get();

        return view('admin.employer.index', [
            'employers' => $employers,
            'status' => $status,
            'countries' => $country,
            'provinces' => $province,
            'districts' => $district,
            'cities' => $city,
            'company_categories' => $company_category,
            'company_owner_ships' => $company_owner_ship,
            'company_sizes' => $company_size,
            'users' => $users,
        ]);
    }

    public function employerStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('employers')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('employers')->where('id', $request->id)->update(['status' => 'inactive']);
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
        // dd($request->all());
        $request->validate([
            'company_name' => 'required',
            "email" => 'required|email',
            'phone_number' => 'required | min:9 |max:14',
            'office_number' => 'required | min:9 |max:14',
            'address' => 'required | max:30',
            'expiry_date' => 'required',
            'company_website' => 'required |url',
            'company_description' => 'required',
            'additional_info' => 'nullable',
            'country' => 'required',
            'province' => 'required',
            'district' => 'required',
            'city' => 'required',
            'personal_name.*' => 'required',
            'personal_email.*' => 'required|email',
            'personal_designation.*' => 'required',
            'personal_phone.*' => 'required',
            'tiktok_url' => 'nullable|url',
            'linkedIn_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5000',
            'status' => 'nullable| in:active,inactive',
            'is_verify' => 'nullable',
            'company_logo' => 'required|image|mimes:jpeg,png,jpg|max:5000',
            'user' => 'required',
            'company_size' => 'required',
            'company_owner_ship' => 'required',
            'company_category' => 'required',
        ]);
        $data = new Employer();
        $data->status = $request->status ? 'active' : 'inactive';
        $data->is_varify = $request->is_verify ? '1' : '0';
        $data->order_no = Employer::max('order_no') + 1;
        $slug = Str::slug($request->company_name);
        $slug_count = Employer::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = Employer::createSlug($request->company_name, 0);
        }
        $data->slug = $slug;

        $path = public_path() . '/storage/employer/';
        $folderPath = 'public/employer/';
        if (!file_exists($path)) {
            Storage::makeDirectory($folderPath, 0777, true, true);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            CropImg::resize_crop_images(1200, 600, $image, $folderPath . '/' . $filename);
            CropImg::resize_crop_images(800, 500, $image, $folderPath . '/thumb_' . $filename);

            $data->image = $filename;
        }
        if ($request->hasFile('company_logo')) {
            $image = $request->file('company_logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            // CropImg::resize_crop_images(1200, 600, $image, $folderPath . '/logo' . $filename);
            Storage::putFileAs($folderPath, $image, '/logo' . $filename);
            $data->logo = $filename;
        }

        $personal_name = array();
        $personal_email = array();
        $personal_designation = array();
        $personal_number = array();
        if (isset($request->personal_name)) {
            $data->contact_persons_information = null;
            foreach ($request->personal_name as $key => $name) {
                array_push($personal_name, $name);
                array_push($personal_email, $request->personal_email[$key]);
                array_push($personal_designation, $request->personal_designation[$key]);
                array_push($personal_number, $request->personal_phone[$key]);
            }
            $data->contact_persons_information = json_encode(['name' => $personal_name, 'email' => $personal_email, 'designation' => $personal_designation, 'number' => $personal_number]);

        }
        $social_name = array();

        $data->phone_number = $request->phone_number;
        $data->office_number = $request->office_number;
        $data->company_website = $request->company_website;
        $data->company_name = $request->company_name;
        $data->company_description = $request->company_description;
        $data->address = $request->address;
        $data->country_id = $request->country;
        $data->province_id = $request->province;
        $data->district_id = $request->district;
        $data->city_id = $request->city;
        $data->company_category_id = $request->company_category;
        $data->company_owner_ship_id = $request->company_owner_ship;
        $data->company_size_id = $request->company_size;
        $data->user_id = $request->user;
        $data->expiry_date = $request->expiry_date;
        $data->tiktok_url = $request->tiktok_url;
        $data->facebook_url = $request->facebook_url;
        $data->linkedIn_url = $request->linkedIn_url;
        $data->instagram_url = $request->instagram_url;
        $data->youtube_url = $request->youtube_url;
        $data->save();

        $email = new \App\Models\EmployerEmail;
        $email->employer_id = $data->id;
        $email->email = $request->email;
        $email->email_verified_at = now();
        $email->is_primary = 1;
        $email->save();

        if ($data) {
            return redirect()->route('admin.employer.index')->with('success', 'Successfully created employer.');

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
        $employer = Employer::findOrFail(base64_decode($id));
        $country = Country::where('status', 'active')->orderBy('order_no')->get();
        $province = Province::where('status', 'active')->orderBy('order_no')->get();
        $district = District::where('status', 'active')->orderBy('order_no')->get();
        $city = City::where('status', 'active')->orderBy('order_no')->get();
        $company_category = CompanyCategory::where('status', 'active')->orderBy('order_no')->get();
        $company_owner_ship = CompanyOwnerShip::where('status', 'active')->orderBy('order_no')->get();
        $company_size = CompanySize::where('status', 'active')->orderBy('order_no')->get();
        $user = User::where('email', '!=', 'ktmrushservices@gmail.com')->role('employer')->orWhere('admin', 1)->get();
        if ($employer) {
            $status = 'edit';
            return view('admin.employer.index', [
                'employer' => $employer,
                'status' => $status,
                'countries' => $country,
                'provinces' => $province,
                'districts' => $district,
                'cities' => $city,
                'company_categories' => $company_category,
                'company_owner_ships' => $company_owner_ship,
                'company_sizes' => $company_size,
                'users' => $user
            ]);
        } else {
            return back()->with('error', 'Data not Found.');
        }
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
        $data = Employer::findOrFail(base64_decode($id));
        $request->validate([
            'company_name' => 'required',
            "email" => 'required|email',
            'phone_number' => 'required | min:9 |max:14',
            'office_number' => 'required | min:9 |max:14',
            'address' => 'required | max:30',
            'expiry_date' => 'required',
            'company_website' => 'required |url',
            'company_description' => 'required',
            'additional_info' => 'nullable',
            'country' => 'required',
            'province' => 'required',
            'district' => 'required',
            'city' => 'required',
            'personal_name.*' => 'required',
            'personal_email.*' => 'required|email',
            'personal_designation.*' => 'required',
            'personal_phone.*' => 'required',
            'tiktok_url' => 'nullable|url',
            'linkedIn_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'image' => 'image|mimes:jpeg,png,jpg|max:5000',
            'status' => 'nullable| in:active,inactive',
            'is_verify' => 'nullable',
            'company_logo' => 'image|mimes:jpeg,png,jpg|max:5000',
            'user' => 'required',
            'company_size' => 'required',
            'company_owner_ship' => 'required',
            'company_category' => 'required',
        ]);
        if (!isset($request->status)) {
            $data->status = 'inactive';
        } else {
            $data->status = $request->status;
        }
        if (!isset($request->is_verify)) {
            $data->is_varify = '0';
        } else {
            $data->is_varify = $request->is_verify;
        }
        $slug = Str::slug($request->company_name);
        $slug_count = Employer::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = Employer::createSlug($request->company_name, 0);
        }
        $data->slug = $slug;
        $path = public_path() . '/storage/employer/';
        $folderPath = 'public/employer/';
        if (!file_exists($path)) {
            Storage::makeDirectory($folderPath, 0777, true, true);
        }
        if ($request->hasFile('image')) {
            $oldimage = $data->image;
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            CropImg::resize_crop_images(1200, 600, $image, $folderPath . '/' . $filename);
            CropImg::resize_crop_images(800, 500, $image, $folderPath . '/thumb_' . $filename);

            $data->image = $filename;
            Storage::delete('public/employer/' . $oldimage);
            Storage::delete('public/employer/thumb_' . $oldimage);
        }
        if ($request->hasFile('company_logo')) {
            $oldimage = $data->logo;
            $image = $request->file('company_logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            // CropImg::resize_crop_images(1200, 600, $image, $folderPath . '/logo' . $filename);
            Storage::putFileAs($folderPath, $image, '/logo' . $filename);
            $data->logo = $filename;
            Storage::delete('public/employer/logo' . $oldimage);
        }
        $personal_name = array();
        $personal_email = array();
        $personal_designation = array();
        $personal_number = array();
        if (isset($request->personal_name)) {
            $data->contact_persons_information = null;
            foreach ($request->personal_name as $key => $name) {
                array_push($personal_name, $name);
                array_push($personal_email, $request->personal_email[$key]);
                array_push($personal_designation, $request->personal_designation[$key]);
                array_push($personal_number, $request->personal_phone[$key]);
            }
            $data->contact_persons_information = json_encode(['name' => $personal_name, 'email' => $personal_email, 'designation' => $personal_designation, 'number' => $personal_number]);

        }
       
        $email = $data->emails()->where('is_primary', 1)->first();
        $email->email = $request->email;
        $email->update();
        $data->phone_number = $request->phone_number;
        $data->office_number = $request->office_number;
        $data->company_website = $request->company_website;
        $data->company_name = $request->company_name;
        $data->company_description = $request->company_description;
        $data->services = $request->services;
        $data->address = $request->address;
        $data->country_id = $request->country;
        $data->province_id = $request->province;
        $data->district_id = $request->district;
        $data->city_id = $request->city;
        $data->company_category_id = $request->company_category;
        $data->company_owner_ship_id = $request->company_owner_ship;
        $data->company_size_id = $request->company_size;
        $data->user_id = $request->user;
        $data->expiry_date = $request->expiry_date;
        $data->tiktok_url = $request->tiktok_url;
        $data->facebook_url = $request->facebook_url;
        $data->linkedIn_url = $request->linkedIn_url;
        $data->instagram_url = $request->instagram_url;
        $data->youtube_url = $request->youtube_url;
        $data->save();
        if ($data) {
            return redirect()->route('admin.employer.index')->with('success', 'Successfully updated employer.');

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
        $employer = Employer::findOrFail($request->id);
        if ($employer != null) {
            //deleting exiting image
            Storage::delete('public/employer/' . $employer->image);
            Storage::delete('public/employer/thumb_' . $employer->image);
            Storage::delete('public/employer/logo' . $employer->logo);
        }
        $status = $employer->delete();
        if ($status) {
            return redirect()->route('admin.employer.index')->with('success', 'Employer successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $employer = new Employer();
        $list_order = $request['list_order'];

        $this->saveList($list_order);
        $data = array('status' => 'success');
        echo json_encode($data);
        exit;
    }

    public function saveList($list, &$m_order = 0)
    {

        foreach ($list as $item) {
            $m_order++;
            $updateData = array("order_no" => $m_order);
            Employer::where('id', $item['id'])->update($updateData);
        }
    }
    public function getemployerListFromDB()
    {
        $employers = Employer::orderBy('order_no')->get();
        return $employers;
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
}