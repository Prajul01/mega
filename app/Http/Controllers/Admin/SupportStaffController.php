<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CropImg;
use Storage;
use App\Models\SupportStaff as Staff;

class SupportStaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::where('display', 1)->orderBy('order_no')->get();
        $status = 'index';
        return view('admin.supportStaff.index', compact('staffs', 'status'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_no' => 'required|numeric',
            'email' => 'required|email',
            'profile_pic' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $path = public_path() . '/storage/supportStaff';
        $folderPath = 'public/supportStaff';

        if (!file_exists($path)) {
            Storage::makeDirectory($folderPath, 0755);
            Chmod($path, 0755);
        }

        $staff = new Staff;
        $staff->name = $request->name;
        $staff->phone_no = $request->phone_no;
        $staff->email = $request->email;
        $staff->display = $request->display ? 1 : 0;
        $staff->order_no = Staff::max('order_no') + 1;

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $fileName = time() . '.' . $file->extension();

            CropImg::resize_crop_images('400', '375', $file, $folderPath . '/'. $fileName);
            $staff->profile_pic = $fileName;
        }
        $staff->save();
        return back()->with('status', 'Support Staff has been added');
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail(base64_decode($id));
        $status = 'edit';

        return view('admin.supportStaff.index', compact('staff', 'status'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_no' => 'required|numeric',
            'email' => 'required|email',
            'profile_pic' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        $path = public_path() . '/storage/supportStaff';
        $folderPath = 'public/supportStaff';

        if (!file_exists($path)) {
            Storage::makeDirectory($folderPath, 0755);
            Chmod($path, 0755);
        }


        $staff = Staff::findOrFail(base64_decode($id));
        $staff->name = $request->name;
        $staff->phone_no = $request->phone_no;
        $staff->email = $request->email;
        $staff->display = $request->display ? 1 : 0;
        $staff->order_no = Staff::max('order_no') + 1;

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $fileName = time() . '.' . $file->extension();

            CropImg::resize_crop_images('400', '375', $file, $folderPath . '/'. $fileName);
            Storage::delete($folderPath . '/' . $staff->profile_pic);
            $staff->profile_pic = $fileName;
        }
        $staff->update();

        return to_route('admin.staffs.index')->with('status', 'Support Staff has been updated');

    }

    public function destroy(Request $request)
    {
        $staff = Staff::findOrFail(base64_decode($request->id));

        Storage::delete('public/supportStaff/' . $staff->profile_pic);

        $staff->delete();

        return back()->with('status', 'Support staff has been deleted');
    }

    public function set_order(Request $request)
    {
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
            Staff::where('id', $item['id'])->update($updateData);
        }
    }
}