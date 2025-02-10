<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CropImg;
use App\Models\Showroom;
use File;
use Illuminate\Http\Request;
use Storage;

class ShowroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('web');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $showrooms = Showroom::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.showrooms.index', compact('showrooms', 'status'));
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
        $showroom = new Showroom();
        $showroom->order_no = Showroom::max('order_no') + 1;
        $showroom->location = $request->location;
        $showroom->name = $request->name;
        $showroom->address = $request->address;
        $showroom->tel_phone = $request->tel_phone;
        $showroom->phone = $request->phone;
        $showroom->email = $request->email;
        $showroom->description = $request->description;
        $showroom->display = $request->display;

        $path = public_path() . '/storage/showroom/';
        $folderPath = 'public/showroom/';
        if (!file_exists($path)) {
            Storage::makeDirectory($folderPath, 0777, true, true);
        }

        // dd(file_exists($path));

        if ($request->hasFile('image')) {
            // 1540 × 720
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            CropImg::resize_crop_images(1200, 540, $image, $folderPath . '/' . $filename);
            CropImg::resize_crop_images(300, 200, $image, $folderPath . '/thumb_' . $filename);

            $showroom->image = $filename;
        }

        $showroom->save();

        return redirect()->back()->with('status', 'showroom created successfully!');
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
        $showroom = Showroom::findOrFail(base64_decode($id));
        $status = 'edit';
        return view('admin.showrooms.index')->with('showroom', $showroom)->with('status', $status);
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
        $showroom = Showroom::findOrFail(base64_decode($id));
        $showroom->location = $request->location;
        $showroom->name = $request->name;
        $showroom->address = $request->address;
        $showroom->tel_phone = $request->tel_phone;
        $showroom->phone = $request->phone;
        $showroom->email = $request->email;
        $showroom->description = $request->description;
        $showroom->display = $request->display;

        $path = public_path() . '/storage/showroom/';
        $folderPath = 'public/showroom/';

        if ($request->hasFile('image')) {
            if (!file_exists($path)) {
                Storage::makeDirectory($folderPath, 0777, true, true);
            }

            $oldImage = $showroom->image;
            $newImage = $request->file('image');
            $filename = time() . '.' . $newImage->getClientOriginalExtension();

            CropImg::resize_crop_images(1200, 540, $newImage, $folderPath . '/' . $filename);
            CropImg::resize_crop_images(300, 200, $newImage, $folderPath . '/thumb_' . $filename);

            // dd($oldImage);
            if ($oldImage != null):
                Storage::delete($folderPath . $oldImage);
                Storage::delete($folderPath . '/' . $oldImage);
            endif;

            $showroom->image = $filename;

        }

        $showroom->save();

        return redirect()->route('admin.showrooms.index')->with('status', 'showroom Updated successfully!');

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
        $oldImage = Showroom::findOrFail($request->id);

        if ($oldImage != null) {
            //deleting exiting logo
            Storage::delete('public/showroom/' . $oldImage->image);
            Storage::delete('public/showroom/thumb_' . $oldImage->image);
            // dd('here');
        }

        $oldImage->delete();

        // return redirect()->back()->with('status', 'showroom has been deleted!');
    }

    public function set_order(Request $request)
    {

        $showroom = new Showroom();
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
            Showroom::where('id', $item['id'])->update($updateData);
        }
    }
}
