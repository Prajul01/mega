<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\District;
use App\Models\Province;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:location-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:location-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:location-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:location-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $districts = District::orderBy('order_no')->get();
        $status = 'index';
        $province=Province::where('status','active')->get();
        return view('admin.district.index',['districts'=>$districts, 'status'=>$status,'provinces'=>$province]);
    }

    public function districtStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('districts')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('districts')->where('id', $request->id)->update(['status' => 'inactive']);

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
        $this->validate($request, [
            'district_name' => 'required',
            'province_name' => 'required',
            'status'=>'nullable| in:active,inactive',
        ]);
        $data=new District();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no = District::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = District::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug =District::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $data->name=$request->district_name;
        $data->province_id=$request->province_name;
        $data->save();
        if ($data) {
            return redirect()->route('admin.district.index')->with('success', 'Successfully created district.');

        } else {
            return back()->with('error', 'Something went wrong!');
        }
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
        $district = District::findOrFail(base64_decode($id));
        if ($district) {
            $status = 'edit';
            $provinces=Province::where('status','active')->orderBy('order_no')->get();
            return view('admin.district.index',['district'=>$district, 'status'=>$status,'provinces'=>$provinces]);
        } else {
            return back()->with('error', 'Data not Found.');
        }
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
        $district = District::findOrFail(base64_decode($id));
        $this->validate($request, [
            'district_name' => 'required',
            'status' => 'nullable|in:active,inactive',
            'province_name' => 'nullable',
        ]);
        if (!isset($request->status)) {
            $district->status = 'inactive';
        }else{
            $district->status = $request->status;
        }
        if($district->name != $request->district_name){
            $slug = District::createSlug($request->district_name, 0);
          }
          if(isset($slug)){
            if ( $district->slug != $slug) {
                $oldslug =  $district->slug;
                $district->slug = $slug;
            }
        }else{
            $slug =  $district->slug;
        }
        $district->slug=$slug;
        $district->name=$request->district_name;
        $district->province_id=$request->province_name;
        $district->save();
        if ($district) {
            return redirect()->route('admin.district.index')->with('success', 'Successfully updated district.');

        } else {
            return back()->with('error', 'Something went wrong!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $district = District::findOrFail($request->id);
        $status = $district->delete();
        if ($status) {
            return redirect()->route('admin.district.index')->with('success', 'district successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $district = new District();
        $list_order = $request['list_order'];

        $this->saveList($list_order);
        $data = array('status' => 'success');
        echo json_encode($data);
        exit;
    }

    public function saveList($list, &$m_order = 0)
    {
        foreach ($list as $item) {
            $m_order++;
            $updateData = array("order_no" => $m_order);
            district::where('id', $item['id'])->update($updateData);
        }
    }
    public function getdistrictListFromDB()
    {
        $districts = district::orderBy('order_no')->get();
        return $districts;
    }
}
