<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\District;
use App\Models\Province;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CityController extends Controller
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
        $citys = City::orderBy('order_no')->get();
        $status = 'index';
        $district=District::where('status','active')->orderBy('order_no')->get();
        return view('admin.city.index',['citys'=>$citys, 'status'=>$status,'districts'=>$district]);
    }

    public function cityStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('cities')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('cities')->where('id', $request->id)->update(['status' => 'inactive']);

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
            'city_name' => 'required',
            'district_name' => 'required',
            'status'=>'nullable| in:active,inactive',
        ]);
        $data=new City();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no = City::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = City::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug =City::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $data->name=$request->city_name;
        $data->district_id=$request->district_name;
        $data->save();
        if ($data) {
            return redirect()->route('admin.city.index')->with('success', 'Successfully created City.');

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
        $city = City::findOrFail(base64_decode($id));
        $district=District::where('status','active')->orderBy('order_no')->get();
        if ($city) {
            $status = 'edit';
            return view('admin.city.index',['city'=>$city, 'status'=>$status,'districts'=>$district]);
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
        $city = City::findOrFail(base64_decode($id));
        $this->validate($request, [
            'city_name' => 'required',
            'district_name' => 'required',
            'status'=>'nullable| in:active,inactive',
        ]);
        if (!isset($request->status)) {
            $city->status = 'inactive';
        }else{
            $city->status = $request->status;
        }
        if($city->name != $request->city_name){
            $slug = City::createSlug($request->city_name, 0);
          }
          if(isset($slug)){
            if ( $city->slug != $slug) {
                $oldslug =  $city->slug;
                $city->slug = $slug;
            }
        }else{
            $slug =  $city->slug;
        }
        $city->slug=$slug;
        $city->name=$request->city_name;
        $city->district_id=$request->district_name;
        $city->save();
        if ($city) {
            return redirect()->route('admin.city.index')->with('success', 'Successfully updated city.');

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
        $city = City::findOrFail($request->id);
        $status = $city->delete();
        if ($status) {
            return redirect()->route('admin.city.index')->with('success', 'city successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $city = new City();
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
            city::where('id', $item['id'])->update($updateData);
        }
    }
    public function getcityListFromDB()
    {
        $citys = City::orderBy('order_no')->get();
        return $citys;
    }
}
