<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\CropImg;
use App\Models\Trainning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainningController extends Controller
{
    public function index()
    {
        $training = Trainning::all();
        $status = 'index';
        return view('admin.training.index', compact('training', 'status'));
    }

    public function store(Request $request)
    {
        $data=Trainning::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'date'=>$request->date,
        ]);
        if (isset($data)) {
            return redirect()
                ->back()
                ->with('status', 'Training created successfully!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Something went Wrong!');
        }

    }


    public function edit($id)
    {

        $training = Trainning::findOrFail($id);


        $status = 'edit';
        return view('admin.training.index')
            ->with('ad', $training)
            ->with('status', $status);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'date'=>'required',
        ]);
        $ad = Trainning::findOrFail($id);
        $ad->name = $request->name;
        $ad->description = $request->description;
        $ad->date = $request->date;





        $ad->save();

        return redirect()
            ->route('admin.training.index')
            ->with('status', 'Training Updated successfully!');
    }
    public function destroy(Request $request)
    {
        $ad = Trainning::findOrFail($request->id);



        $ad->delete();
    }
}
