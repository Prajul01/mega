<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\EmployeeType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeTypeController extends Controller
{

    public function __construct(){
        $this->middleware('permission:job-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:job-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:job-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:job-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $employee_types = EmployeeType::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.employeeType.index',['employee_types'=>$employee_types, 'status'=>$status]);
    }

    public function employee_typeStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('employee_types')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('employee_types')->where('id', $request->id)->update(['status' => 'inactive']);

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
        $data=new EmployeeType();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no = EmployeeType::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = EmployeeType::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug =EmployeeType::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $data->title=$request->title;
        $data->save();
        if ($data) {
            return redirect()->route('admin.employee_type.index')->with('success', 'Successfully created employee_type.');

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
        $employee_type = EmployeeType::findOrFail(base64_decode($id));
        if ($employee_type) {
            $status = 'edit';
            return view('admin.employeeType.index',['employee_type'=>$employee_type, 'status'=>$status]);
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
        $employee_type = EmployeeType::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);
        if (!isset($request->status)) {
            $employee_type->status = 'inactive';
        }else{
            $employee_type->status = $request->status;
        }
        if($employee_type->title != $request->title){
            $slug = EmployeeType::createSlug($request->title, 0);
          }
          if(isset($slug)){
            if ( $employee_type->slug != $slug) {
                $oldslug =  $employee_type->slug;
                $employee_type->slug = $slug;
            }
        }else{
            $slug =  $employee_type->slug;
        }
        $employee_type->slug=$slug;
        $employee_type->title=$request->title;
        $employee_type->save();
        if ($employee_type) {
            return redirect()->route('admin.employee_type.index')->with('success', 'Successfully updated employee_type.');

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
        $employee_type = EmployeeType::findOrFail($request->id);
        $status = $employee_type->delete();
        if ($status) {
            return redirect()->route('admin.employee_type.index')->with('success', 'employee_type successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $employee_type = new EmployeeType();
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
            EmployeeType::where('id', $item['id'])->update($updateData);
        }
    }
    public function getemployee_typeListFromDB()
    {
        $employee_types = EmployeeType::orderBy('order_no')->get();
        return $employee_types;
    }
}
