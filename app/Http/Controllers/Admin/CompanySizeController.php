<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use App\Models\CompanySize;
use DB;
use Illuminate\Http\Request;

class CompanySizeController extends Controller
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
        $company_sizes = CompanySize::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.company_size.index',['company_sizes'=>$company_sizes, 'status'=>$status]);
    }

    public function company_sizeStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('company_sizes')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('company_sizes')->where('id', $request->id)->update(['status' => 'inactive']);

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
        $data=new CompanySize();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no = CompanySize::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = CompanySize::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug =CompanySize::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $data->title=$request->title;
        $data->save();
        if ($data) {
            return redirect()->route('admin.company_size.index')->with('success', 'Successfully created company size.');

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
        $company_size = CompanySize::findOrFail(base64_decode($id));
        if ($company_size) {
            $status = 'edit';
            return view('admin.company_size.index',['company_size'=>$company_size, 'status'=>$status]);
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
        $company_size = CompanySize::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);
        if (!isset($request->status)) {
            $company_size->status = 'inactive';
        }else{
            $company_size->status = $request->status;
        }
        if($company_size->title != $request->title){
            $slug = CompanySize::createSlug($request->title, 0);
          }
          if(isset($slug)){
            if ( $company_size->slug != $slug) {
                $oldslug =  $company_size->slug;
                $company_size->slug = $slug;
            }
        }else{
            $slug =  $company_size->slug;
        }
        $company_size->slug=$slug;
        $company_size->title=$request->title;
        $company_size->save();
        if ($company_size) {
            return redirect()->route('admin.company_size.index')->with('success', 'Successfully updated company size.');

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
        $company_size = CompanySize::findOrFail($request->id);
        $status = $company_size->delete();
        if ($status) {
            return redirect()->route('admin.company_size.index')->with('success', 'company_size successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

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
            CompanySize::where('id', $item['id'])->update($updateData);
        }
    }
    public function getcompany_sizeListFromDB()
    {
        $company_sizes = CompanySize::orderBy('order_no')->get();
        return $company_sizes;
    }
}
