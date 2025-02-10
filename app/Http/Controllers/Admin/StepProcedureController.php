<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StepProcedure as Step;
use Storage;

class StepProcedureController extends Controller
{
    public function index()
    {
        $steps = Step::all();

        return view('admin.stepProcedure.index', compact('steps'));
    }

    public function subIndex($id){  
        $step = Step::findOrFail(base64_decode($id));
        return view('admin.stepProcedure.subIndex', compact('step'));
    }

    public function edit($id, $steps)
    {
        $step = Step::find(base64_decode($id));
        if (is_null($step) || empty($step)) {
            return back()->with('error', 'Step procedure not found');
        }

        $stepNo = explode('-',$steps)[1];
        return view('admin.stepProcedure.edit', compact('step', 'stepNo'));
    }

    public function update($id, Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'step' => 'required|in:1,2,3',
            // 'banner' => 'requierd|image|mimes:png,jpg,jpeg',
        ]);

        $step = Step::find(base64_decode($id));
        if (is_null($step) || empty($step)) {
            return back()->with('error', 'Step procedure not found');
        }

        $path = public_path() . '/storage/step_procedure';
        $folderPath = 'public/step_procedure';
        if(!file_exists($path)){
            Storage::makeDirectory($folderPath, 0755, true, true);
            chmod($path, 0755);
        }

        $data = json_encode([
            'heading' => $request->title,
            'description' => $request->description
        ]);

        $steps = 'step' . $request->step;

        $step->$steps = $data;

        if($request->hasFile('banner')){
            $image = $request->file('banner');
            $fileName = time() . '.' . $image->extension();
            Storage::putFileAs($folderPath, $image, $fileName);
        }
        $step->update();


        return to_route('admin.steps.subIndex', $id)->with('status', 'Step Procedure has been updated');
    }
}