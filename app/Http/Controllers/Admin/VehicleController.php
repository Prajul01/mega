<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:company-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:company-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:company-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:company-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
    * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.vehicle.index',['vehicles'=>$vehicles, 'status'=>$status]);
    }

    public function vehicleStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('vehicles')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('vehicles')->where('id', $request->id)->update(['status' => 'inactive']);

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
            'title' => 'required',
            'status'=>'nullable| in:active,inactive',
        ]);
        $data=new Vehicle();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no = Vehicle::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = Vehicle::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug =Vehicle::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $data->title=$request->title;
        $data->save();
        if ($data) {
            return redirect()->route('admin.vehicle.index')->with('success', 'Successfully created vehicle.');

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
        $vehicle = Vehicle::findOrFail(base64_decode($id));
        if ($vehicle) {
            $status = 'edit';
            return view('admin.vehicle.index',['vehicle'=>$vehicle, 'status'=>$status]);
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
        $vehicle = Vehicle::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);
        if (!isset($request->status)) {
            $vehicle->status = 'inactive';
        }else{
            $vehicle->status = $request->status;
        }
        if($vehicle->title != $request->title){
            $slug = Vehicle::createSlug($request->title, 0);
          }
          if(isset($slug)){
            if ( $vehicle->slug != $slug) {
                $oldslug =  $vehicle->slug;
                $vehicle->slug = $slug;
            }
        }else{
            $slug =  $vehicle->slug;
        }
        $vehicle->slug=$slug;
        $vehicle->title=$request->title;
        $vehicle->save();
        if ($vehicle) {
            return redirect()->route('admin.vehicle.index')->with('success', 'Successfully updated vehicle.');

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
        $vehicle = Vehicle::findOrFail($request->id);
        $status = $vehicle->delete();
        if ($status) {
            return redirect()->route('admin.vehicle.index')->with('success', 'vehicle successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $vehicle = new vehicle();
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
            Vehicle::where('id', $item['id'])->update($updateData);
        }
    }
    public function getvehicleListFromDB()
    {
        $vehicles = Vehicle::orderBy('order_no')->get();
        return $vehicles;
    }
}
