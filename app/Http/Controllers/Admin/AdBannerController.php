<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StepProcedure as Step;
use Storage;

class AdBannerController extends Controller
{
    public function index()
    {
        $steps = Step::all();

        return view('admin.adBanner.index', compact('steps'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'banner' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $step = Step::find(base64_decode($id));
        if (is_null($step) || empty($step)) {
            return back()->with('error', 'Step procedure not found');
        }

        $path = public_path() . '/storage/adBanner';
        $folderPath = 'public/adBanner';
        if (!file_exists($path)) {
            Storage::makeDirectory($folderPath, 0755, true, true);
            chmod($path, 0755);
        }

        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $fileName = time() . '.' . $image->extension();
            Storage::putFileAs($folderPath, $image, $fileName);
            if (@$step->banner) {
                Storage::delete($folderPath . '/' . $step->banner);
            }

            $step->banner = $fileName;
        }
        $step->update();

        return back()->with('status', 'Banner has been updated');
    }
}