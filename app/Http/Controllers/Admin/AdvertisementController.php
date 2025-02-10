<?php

namespace App\Http\Controllers\Admin;

use App\Models\CropImg;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    public function index()
    {
        $advertisement = Advertisement::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.advertisement.index', compact('advertisement', 'status'));
    }
    public function store(Request $request)
    {
         $pattern = "/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/|v\/)|youtu\.be\/)([\w\-]{11})(?:\S+)?$/";
        $request->validate([
            'title' => 'required|max:255',
            'url' => ['nullable' , 'regex:'.$pattern , 'url'],
            'type' => 'required',
            'link'=>'nullable|url',
        ]);

        $ad = new Advertisement();
        $slug = Advertisement::createSlug($request->title, 'id', 0);
        $ad->slug = $slug;
        $ad->order_no = Advertisement::max('order_no') + 1;
        $ad->title = $request->title;
        $ad->url = $request->url;
        $ad->link = $request->link;
        $ad->type = $request->type;
        $ad->display = $request->display ? '1' : '0';

        $path = public_path() . '/storage/advertisement/';
        $folderPath = 'public/advertisement/';

        if (!file_exists($path)) {
            Storage::makeDirectory($folderPath, 0755, true, true);
            chmod($path, 0755);
        }
        if($request->type==3){
            $request->validate([
                'image' => 'required|mimes:jpg,png,jpeg,gif|max:10000',
            ]);
        }else if($request->type==1){
            $request->validate([
                'image' => 'required|mimes:jpg,png,jpeg|max:10000',
            ]);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            if($request->type==3){
                if ($image->getClientOriginalExtension() === 'gif') {
                    Storage::put($folderPath . $filename, file_get_contents($image));
                } else {
                    CropImg::resize_crop_images(300, 150, $image, $folderPath . '/' . $filename);
                }
            }else if($request->type==1){
                CropImg::resize_crop_images(1500, 300, $image, $folderPath . '/' . $filename); 
            }
            $ad->image = $filename;
        }

        $ad->save();

        if (isset($ad)) {
            return redirect()
                ->back()
                ->with('status', 'Advertisement created successfully!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Something went Wrong!');
        }
    }
    public function edit($id)
    {
        $ad = Advertisement::findOrFail(base64_decode($id));
        $status = 'edit';
        return view('admin.advertisement.index')
            ->with('ad', $ad)
            ->with('status', $status);
    }
    public function update(Request $request, $id)
    {
      $pattern = "/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/|v\/)|youtu\.be\/)([\w\-]{11})(?:\S+)?$/";
        $request->validate([
            'title' => 'required|max:255',
            'url' =>  ['nullable' , 'regex:'.$pattern , 'url'],
            'type' => 'required',
            'link'=>'nullable|url',
        ]);
        $ad = Advertisement::findOrFail(base64_decode($id));
        if ($request->title != $ad->title) {
            $slug = Advertisement::createSlug($request->title, 'id', 0);
            $oldSlug = $ad->slug;
        } else {
            $slug = $ad->slug;
        }
        $ad->title = $request->title;
        $ad->url = $request->url;
        $ad->link = $request->link;
        $ad->type = $request->type;
        $ad->slug = $slug;
        $ad->display = $request->display ? 1 : 0;

        $path = public_path() . '/storage/advertisement/';
        $folderPath = 'public/advertisement/';
        if (!file_exists($path)) {
            Storage::makeDirectory($folderPath, 0755, true, true);
            chmod($path, 0755);
        }
        if($request->type==3){
            $request->validate([
                'image' => 'mimes:jpg,png,jpeg,gif|max:10000',
            ]);
        }else if($request->type==1){
           
            $request->validate([
                'image' => 'mimes:jpg,png,jpeg|max:10000',
            ]);
            
        }
      
        if ($request->hasFile('image')) {
            $oldImage = $ad->image;
            $newImage = $request->file('image');
            $filename = time() . '.' . $newImage->getClientOriginalExtension();
            if($request->type==3){
                if ($newImage->getClientOriginalExtension() === 'gif') {
                    Storage::put($folderPath . $filename, file_get_contents($newImage));
                } else {
                    CropImg::resize_crop_images(300, 150, $newImage, $folderPath . '/' . $filename);
                }
            }else if($request->type==1){
                CropImg::resize_crop_images(1500, 300, $newImage, $folderPath . '/' . $filename); 
            }

            if ($oldImage != null):
                Storage::delete($folderPath . '/' . $oldImage);
            endif;

            $ad->image = $filename;
        }

        $ad->save();

        return redirect()
            ->route('admin.advertisement.index')
            ->with('status', 'Advertisement Updated successfully!');
    }
    public function destroy(Request $request)
    {
        $ad = Advertisement::findOrFail($request->id);

        if ($ad != null) {
            //deleting exiting logo
            Storage::delete('public/advertisement/' . $ad->image);
        }

        $ad->delete();
    }

    public function set_order(Request $request)
    {
        $ad = new Advertisement();
        $list_order = $request['list_order'];

        $this->saveList($list_order);
        $data = ['status' => 'success'];
        echo json_encode($data);
        exit();
    }

    public function saveList($list, &$m_order = 0)
    {
        foreach ($list as $item) {
            $m_order++;
            $updateData = ['order_no' => $m_order];
            Advertisement::where('id', $item['id'])->update($updateData);
        }
    }
}
