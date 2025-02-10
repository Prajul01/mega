<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DayPackage;

class DayPackageController extends Controller
{
    public function index(){
        $packages = DayPackage::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.dayPackages.index', compact('packages', 'status'));
    }
    
    public function store(Request $request){
        $request->validate([
            'package_name' => 'required',
        ]);

        $package = new DayPackage;
        $package->days = $request->package_name;
        $package->order_no = DayPackage::max('order_no') + 1;
        $package->save();

        return back()->with('status', 'Package Added Successfully');
    }

    public function edit($id){
        $package = DayPackage::find(base64_decode($id));
        if(is_null($package) || empty($package)){
            return back()->with('error', 'Package not found');
        }
        $status = 'edit';
        return view('admin.dayPackages.index', compact('package', 'status'));
    }

    public function update($id, Request $request){
        $request->validate([
            'package_name' => 'required',
        ]);

        $package = DayPackage::find(base64_decode($id));
        if(is_null($package) || empty($package)){
            return back()->with('error', 'Package not found');
        }
        $package->days = $request->package_name;
        $package->update();   
        
        return to_route('admin.dayPackages.index')->with('status', 'Package Update Successfully');
    }

    public function destroy(Request $request){
        DayPackage::destroy(base64_decode($request->id));

        return back()->with('status', 'Package has been deleted');
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
            DayPackage::where('id', $item['id'])->update($updateData);
        }
    }

}
