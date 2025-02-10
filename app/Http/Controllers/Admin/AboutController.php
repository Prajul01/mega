<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use App\Models\CropImg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:content-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:content-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:content-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:content-delete', ['only' => ['destroy']]);
    }
    public function index()
    {

        return view('admin.about.index', ['about' => About::first(), 'status' => 'index']);
    }

    public function first_form()
    {
        return view('admin.about.index', ['about' => About::first(), 'status' => 'edit']);
    }
    public function second_form()
    {
        return view('admin.about.index', ['about' => About::first(), 'status' => 'edit1']);
    }
    public function third_form()
    {
        return view('admin.about.index', ['about' => About::first(), 'status' => 'edit2']);
    }
    public function update(Request $request)
    {
        $about = About::firstOrFail();
        if (isset($request->who_we_are)) {
            $this->validate($request, [
                'who_we_are_heading' => 'required',
                'who_we_are_title' => 'required|string|max:255',
                'who_we_are_description' => 'required',
                'who_we_are_image' => 'required|image|max:5000|mimes:jpg,png',
            ]);
            $about->who_we_are_title = $request->who_we_are_title;
            $about->who_we_are_description = $request->who_we_are_description;
            $path = public_path() . '/storage/about/';
            $folderPath = 'public/about/';
            if (!file_exists($path)) {
                Storage::makeDirectory($folderPath, 0777, true, true);
            }
            if ($request->hasFile('who_we_are_image')) {
                $oldImage = $about->who_we_are_image;
                $newimage = $request->file('who_we_are_image');
                $filename = time() . '.' . $newimage->getClientOriginalExtension();
                CropImg::resize_crop_images(1000, 700, $newimage, $folderPath . '/' . $filename);
                if ($oldImage != null):
                    Storage::delete($folderPath . $oldImage);
                    Storage::delete($folderPath . '/' . $oldImage);
                endif;
                $about->who_we_are_image = $filename;
            }
            $about->who_we_are_heading = $request->who_we_are_heading;
        }
        if (isset($request->what_we_do)) {
            $this->validate($request, [
                'what_we_do_heading' => 'required',
                'what_we_do_title' => 'required|string|max:255',
                'what_we_do_description' => 'required',
                'what_we_do_image' => 'required|image|max:5000|mimes:jpg,png',
            ]);
            $about->what_we_do_heading = $request->what_we_do_heading;
            $about->what_we_do_title = $request->what_we_do_title;
            $about->what_we_do_description = $request->what_we_do_description;
            $path = public_path() . '/storage/about/';
            $folderPath = 'public/about/';
            if (!file_exists($path)) {
                Storage::makeDirectory($folderPath, 0777, true, true);
            }
            if ($request->hasFile('what_we_do_image')) {
                $oldImage = $about->who_we_are_image;
                $newimage = $request->file('what_we_do_image');
                $filename = time() . '.' . $newimage->getClientOriginalExtension();
                CropImg::resize_crop_images(1000, 700, $newimage, $folderPath . '/' . $filename);
                if ($oldImage != null):
                    Storage::delete($folderPath . $oldImage);
                    Storage::delete($folderPath . '/' . $oldImage);
                endif;
                $about->what_we_do_image = $filename;
            }
        }

        if (isset($request->feature)) {
            $this->validate($request, [
                'feature_heading' => 'required|string|max:255',
                'feature_1_title' => 'required',
                'feature_1_description' => 'required',
                'feature_1_image' => 'nullable|mimes:jpeg,png,jpg,svg|max:5000',
                'feature_2_title' => 'required',
                'feature_2_description' => 'required',
                'feature_2_image' => 'nullable|mimes:jpeg,png,jpg,svg|max:5000',
                'feature_3_title' => 'required',
                'feature_3_description' => 'required',
                'feature_3_image' => 'nullable|mimes:jpeg,png,jpg,svg|max:5000',
            ]);
            $about->feature_heading = $request->feature_heading;
            $path = public_path() . '/storage/about/';
            $folderPath = 'public/about/';
            if (!file_exists($path)) {
                Storage::makeDirectory($folderPath, 0777, true, true);
            }
            if (isset($request->feature_1_image)) {
                $oldImage = $about->section_1_image;
                $image = $request->feature_1_image;
                $data = $image->getClientOriginalExtension();
                $filename = rand(111111111, 999999999) . '.' . $data;
                if ($data == 'svg') {
                    $image->move($path, $filename);
                } else {
                    CropImg::resize_crop_images(75, 75, $image, $folderPath . '/' . $filename);
                }
                if ($oldImage != null):
                    Storage::delete($folderPath . $oldImage);
                    Storage::delete($folderPath . '/' . $oldImage);
                endif;
                $about->section_1_image = $filename;
            }
            if (isset($request->feature_2_image)) {
                $oldImage = $about->section_2_image;
                $image = $request->feature_2_image;
                $data = $image->getClientOriginalExtension();
                $filename = rand(111111111, 999999999) . '.' . $data;
                if ($data == 'svg') {
                    $image->move($path, $filename);
                } else {
                    CropImg::resize_crop_images(75, 75, $image, $folderPath . '/' . $filename);
                }
                if ($oldImage != null):
                    Storage::delete($folderPath . $oldImage);
                    Storage::delete($folderPath . '/' . $oldImage);
                endif;
                $about->section_2_image = $filename;
            }
            if (isset($request->feature_3_image)) {
                $oldImage = $about->section_3_image;
                $image = $request->feature_3_image;
                $data = $image->getClientOriginalExtension();
                $filename = rand(111111111, 999999999) . '.' . $data;
                if ($data == 'svg') {
                    $image->move($path, $filename);
                } else {
                    CropImg::resize_crop_images(75, 75, $image, $folderPath . '/' . $filename);
                }
                if ($oldImage != null):
                    Storage::delete($folderPath . $oldImage);
                    Storage::delete($folderPath . '/' . $oldImage);
                endif;
                $about->section_3_image = $filename;
            }
            $about->section_1_title = $request->feature_1_title;
            $about->section_1_description = $request->feature_1_description;
            $about->section_2_title = $request->feature_2_title;
            $about->section_2_description = $request->feature_2_description;
            $about->section_3_title = $request->feature_3_title;
            $about->section_3_description = $request->feature_3_description;
        }
        $about->update();
        if ($about) {
            return redirect()->route('admin.about.index')->with('success', 'Successfully updated about.');

        } else {
            return back()->with('error', 'Something went wrong!');
        }

    }
}