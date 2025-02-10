<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CropImg;
use App\Models\Slider;
use File;
use Illuminate\Http\Request;
use Storage;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware('web');
        $this->middleware('permission:site-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:site-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:site-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:site-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.sliders.index', compact('sliders', 'status'));
    }
    public function status(Request $request)
    {
        if ($request->mode == 'true') {
            Slider::where('id', $request->id)->update(['display' => '1']);
        } else {
            Slider::where('id', $request->id)->update(['display' => '0']);
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
        // dd($request);
        $slider = new Slider();
        $slider->order_no = Slider::max('order_no') + 1;
        $slider->title = $request->title;
        $slider->redirect_url = $request->redirect_url;
        $slider->display = $request->display? 1: 0;

        $path = public_path() . '/storage/slider/';
        $folderPath = 'public/slider/';
        if (!file_exists($path)) {
            Storage::makeDirectory($folderPath, 0777, true, true);
        }

        // dd(file_exists($path));

        if ($request->hasFile('image')) {
            // 1540 × 720
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            CropImg::resize_crop_images(1540, 720, $image, $folderPath . '/' . $filename);
            CropImg::resize_crop_images(300, 200, $image, $folderPath . '/thumb_' . $filename);

            $slider->image = $filename;
        }

        $slider->save();

        return redirect()->back()->with('status', 'Slider created successfully!');
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
        // dd($id);
        $slider = Slider::findOrFail(base64_decode($id));
        $status = 'edit';
        return view('admin.sliders.index')->with('slider', $slider)->with('status', $status);
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
        // dd($request);
        $slider = Slider::findOrFail(base64_decode($id));
        $slider->title = $request->title;
        $slider->display = $request->display? 1: 0;

        $path = public_path() . '/storage/slider/';
        $folderPath = 'public/slider/';

        if ($request->hasFile('image')) {
            if (!file_exists($path)) {
                Storage::makeDirectory($folderPath, 0777, true, true);
            }

            $oldImage = $slider->image;
            $newImage = $request->file('image');
            $filename = time() . '.' . $newImage->getClientOriginalExtension();

            CropImg::resize_crop_images(1540, 720, $newImage, $folderPath . '/' . $filename);
            CropImg::resize_crop_images(300, 200, $newImage, $folderPath . '/thumb_' . $filename);

            // dd($oldImage);
            if ($oldImage != null):
                Storage::delete($folderPath . $oldImage);
                Storage::delete($folderPath . '/' . $oldImage);
            endif;

            $slider->image = $filename;

        }

        $slider->save();

        return redirect()->route('admin.sliders.index')->with('status', 'Slider Updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($request);
        $oldImage = Slider::findOrFail($request->id);

        if ($oldImage != null) {
            //deleting exiting logo
            Storage::delete('public/slider/' . $oldImage->image);
            Storage::delete('public/slider/thumb_' . $oldImage->image);
            // dd('here');
        }

        $oldImage->delete();

        // return redirect()->back()->with('status', 'Slider has been deleted!');
    }

    public function set_order(Request $request)
    {

        $slider = new Slider();
        $list_order = $request['list_order'];

        $this->saveList($list_order);
        $data = array('status' => 'success');
        echo json_encode($data);
        exit;
    }

    public function saveList($list, $parent_id = 0, $child = 0, &$m_order = 0)
    {

        foreach ($list as $item) {
            $m_order++;
            $updateData = array("order_no" => $m_order);
            Slider::where('id', $item['id'])->update($updateData);
        }
    }
}
