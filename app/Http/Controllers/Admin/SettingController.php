<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CropImg;
use App\Models\SiteSetting;
use File;
use Illuminate\Http\Request;
use Storage;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
        $this->middleware('permission:site-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:site-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:site-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:site-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $setting = SiteSetting::findOrFail(1);
        return view('admin.setting.form', compact('setting'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'site_title' => 'required | max:255',
            'site_email' => 'required',
            'phone' => 'required|max:13',
        ]);

        $setting = SiteSetting::findOrFail(1);
        $setting->site_title = $request->site_title;
        $setting->site_email = $request->site_email;
        $setting->facebook_url = $request->facebook_url;
        $setting->instagram_url = $request->instagram_url;
        $setting->twitter_url = $request->twitter_url;
        $setting->youtube_url = $request->youtube_url;
        $setting->linkedin_url = $request->linkedin_url;
        $setting->phone = $request->phone;
        $setting->mobile = $request->mobile;
        $setting->address = $request->address;
        $setting->googlemap_url = $request->google_map_url;
        // Meta And OG 
        $setting->og_title = $request->og_title;
        $setting->meta_title = $request->meta_title;
        if (@$request->og_content) {
            $request->validate([
                'og_content' => 'string|max:160',
            ]);
            $setting->og_description = $request->og_description;
        }
        if (@$request->meta_description) {
            $request->validate([
                'meta_description' => 'string|max:160',
            ]);
            $setting->meta_description = $request->meta_description;
        }
        //end

        // Files uploads
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $filename = time() . '.' . $logo->getClientOriginalExtension();
            $oldlogo = $setting->logo;
            $validatedData = $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg|max:1000',
            ]);

            Storage::putFileAs('public/setting/logo/', $logo, $filename);

            $setting->logo = $filename;

            CropImg::resize_crop_images(200, 200, $logo, "public/setting/logo/thumb_" . $filename);

            if ($oldlogo != null) {
                //deleting exiting logo
                Storage::delete('public/setting/logo/' . $oldlogo);
                Storage::delete('public/setting/logo/thumb_' . $oldlogo);
            }
        }

        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');
            $filename = time() . '.' . $favicon->getClientOriginalExtension();
            $oldfavicon = $setting->favicon;
            $validatedData = $request->validate([
                'favicon' => 'image|mimes:jpeg,png,jpg|max:1000',
            ]);

            Storage::putFileAs('public/setting/favicon/', $favicon, $filename);

            $setting->favicon = $filename;

            CropImg::resize_crop_images(200, 200, $favicon, "public/setting/favicon/thumb_" . $filename);

            if ($oldfavicon != null) {
                //deleting exiting favicon
                Storage::delete('public/setting/favicon/' . $oldfavicon);
                Storage::delete('public/setting/favicon/thumb_' . $oldfavicon);
            }
        }

        if ($request->hasFile('og_image')) {
            $og_image = $request->file('og_image');
            $filename = time() . '.' . $og_image->getClientOriginalExtension();
            $oldog_image = $setting->og_image;
            $validatedData = $request->validate([
                'og_image' => 'image|mimes:jpeg,png,jpg|max:1000',
            ]);

            Storage::putFileAs('public/setting/og-image/', $og_image, $filename);

            $setting->og_image = $filename;
            $setting->meta_image = $filename;

            CropImg::resize_crop_images(200, 200, $og_image, "public/setting/og-image/thumb_" . $filename);

            if ($oldog_image != null) {
                //deleting exiting og_image
                Storage::delete('public/setting/og-image/' . $oldog_image);
                Storage::delete('public/setting/og-image/thumb_' . $oldog_image);
            }
        }

        $setting->save();

        return redirect()->route('admin.setting.index')->with('status', 'Setting has been updated');
    }
}