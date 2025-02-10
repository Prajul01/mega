<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CompanyCategory;
use App\Models\CompanyOwnerShip;
use App\Models\CompanySize;
use Storage;

class EditProfileController extends Controller
{
    /**
     * For Basic Information
     */
    public function index()
    {
        $employer = auth()->user()->employer;
        $categories = CompanyCategory::where('status', 'active')->orderBy('order_no')->get();
        $ownerShip = CompanyOwnerShip::where('status', 'active')->orderBy('order_no')->get();
        $sizes = CompanySize::where('status', 'active')->orderBy('order_no')->get();

        return view('employer.edit-profile.basic-information', compact('employer', 'categories', 'ownerShip', 'sizes'));
    }

    /**
     * updated the details of authenticated employer
     */
    public function updateProfile(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'company_name' => 'required',
            'category' => 'required',
            'address' => 'required',
            'office_number' => 'required',
            'mobile_number' => 'required',
            'ownership' => 'required',
            'size_of_company' => 'required',
            'company_website' => 'required|url',
            'company_description' => 'required',
        ]);

        $employer = auth()->user()->employer;

        if (!is_null($employer) || !empty($employer)) {
            if ($request->title != $employer->title) {
                $slug = Employer::createSlug($request->company_name);
            } else {
                $slug = $employer->slug;
            }
        } else {
            $employer = new Employer;
            $employer->user_id = auth()->user()->id;
            $slug = Employer::createSlug($request->company_name);
        }

        $path = public_path() . '/storage/employer';
        $folderPath = 'public/employer';

        if (!file_exists($path)) {
            Storage::makeDirectory($folderPath, 0755, true, true);
            chmod($path, 0755);
        }

        $employer->company_name = $request->company_name;
        $employer->company_category_id = base64_decode($request->category);
        $employer->address = $request->address;
        $employer->slug = $slug;
        $employer->office_number = $request->office_number;
        $employer->phone_number = $request->mobile_number;
        $employer->company_size_id = base64_decode($request->size_of_company);
        $employer->company_website = $request->company_website;
        $employer->company_description = $request->company_description;
        $employer->services = $request->services;
        if ($request->hasFile('logo')) {
            $this->validate($request, [
                'logo' => 'required|image|mimes:png,jpg,gif',
            ]);

            $file = $request->file('logo');
            $fileName = time() . '.' . $file->extension();

            Storage::putFileAs($folderPath, $file, 'logo' . $fileName);

            if (@$employer->logo) {
                Storage::delete($folderPath . $employer->logo);
            }

            $employer->logo = $fileName;
        }
        $employer->save();

        return redirect()->back()->with('status', 'Your profile has been updated');
    }

    /**
     * For Social Accounts
     */
    public function socialLink()
    {
        $employer = auth()->user()->employer;

        return view('employer.edit-profile.social-links', compact('employer'));
    }

    /**
     * Post handler for social accounts
     */

    public function postSocialLinks(Request $request)
    {

        $request->validate([
            'facebook_url' => 'bail|nullable|url',
            'instagram_url' => 'bail|nullable|url',
            'youtube_url' => 'bail|nullable|url',
            'linkedIn_url' => 'bail|nullable|url',
            'tiktok_url' => 'bail|nullable|url',
        ]);

        $employer = auth()->user()->employer;

        $employer->facebook_url = $request->facebook_url;
        $employer->instagram_url = $request->instagram_url;
        $employer->youtube_url = $request->youtube_url;
        $employer->linkedIn_url = $request->linkedIn_url;
        $employer->tiktok_url = $request->tiktok_url;

        $employer->update();

        return back()->with('status', 'Social Links has been updated');
    }

    /**
     * Basic Contact Settings
     */
    public function contactPerson(){
        return view('employer.edit-profile.contact-person');
    }

    /**
     * Updates Contact information of employers
     *
     * @param Request $request
     * @return void
     */
    public function updateContact(Request $request)
    {
        if (!$request->contact_name && !$request->contact_email && !$request->contact_designation && !$request->contact_mobile) {
            $employer = auth()->user()->employer;
            $employer->contact_persons_information = null;
            $employer->update();

            return redirect()->back()->with('error', 'Data has been deleted');
        }

        $countName = count($request->contact_name);
        $countEmail = count($request->contact_email);
        $countDesignation = count($request->contact_designation);
        $countMobile = count($request->contact_mobile);

        if ($countName == $countEmail && $countName == $countDesignation && $countName == $countMobile) {

            $employer = auth()->user()->employer;

            $name = [];
            $email = [];
            $designation = [];
            $mobile = [];

            for ($i = 0; $i < $countName; $i++) {
                array_push($name, $request->contact_name[$i]);
                array_push($email, $request->contact_email[$i]);
                array_push($designation, $request->contact_designation[$i]);
                array_push($mobile, $request->contact_mobile[$i]);
            }

            $contact_information = json_encode(
                array(
                    'name' => $name,
                    'email' => $email,
                    'designation' => $designation,
                    'number' => $mobile,
                )
            );

            $employer->contact_persons_information = $contact_information;
            $employer->update();
        } else {
            return redirect()->back()->with('error', 'Please enter complete informations');
        }

        return redirect()->back()->with('stauts', 'Contact Information Updated');
    }
}