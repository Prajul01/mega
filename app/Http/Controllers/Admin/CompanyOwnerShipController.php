<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CompanyOwnerShip;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
class CompanyOwnerShipController extends Controller
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
        $company_ownerships = CompanyOwnerShip::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.company_ownership.index',['company_ownerships'=>$company_ownerships, 'status'=>$status]);
    }

    public function company_ownershipStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('company_owner_ships')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('company_owner_ships')->where('id', $request->id)->update(['status' => 'inactive']);

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
        $data=new CompanyOwnerShip();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no = CompanyOwnerShip::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = CompanyOwnerShip::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug =CompanyOwnerShip::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $data->title=$request->title;
        $data->save();
        if ($data) {
            return redirect()->route('admin.company_ownership.index')->with('success', 'Successfully created company ownership.');

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
        $company_ownership = CompanyOwnerShip::findOrFail(base64_decode($id));
        if ($company_ownership) {
            $status = 'edit';
            return view('admin.company_ownership.index',['company_ownership'=>$company_ownership, 'status'=>$status]);
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
        $company_ownership = CompanyOwnerShip::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);
        if (!isset($request->status)) {
            $company_ownership->status = 'inactive';
        }else{
            $company_ownership->status = $request->status;
        }
        if($company_ownership->title != $request->title){
            $slug = CompanyOwnerShip::createSlug($request->title, 0);
          }
          if(isset($slug)){
            if ( $company_ownership->slug != $slug) {
                $oldslug =  $company_ownership->slug;
                $company_ownership->slug = $slug;
            }
        }else{
            $slug =  $company_ownership->slug;
        }
        $company_ownership->slug=$slug;
        $company_ownership->title=$request->title;
        $company_ownership->save();
        if ($company_ownership) {
            return redirect()->route('admin.company_ownership.index')->with('success', 'Successfully updated company ownership.');

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
        $company_ownership = CompanyOwnerShip::findOrFail($request->id);
        $status = $company_ownership->delete();
        if ($status) {
            return redirect()->route('admin.company_ownership.index')->with('success', 'Company Ownership successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $company_ownership = new company_ownership();
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
            CompanyOwnerShip::where('id', $item['id'])->update($updateData);
        }
    }
    public function getcompany_ownershipListFromDB()
    {
        $company_ownerships = CompanyOwnerShip::orderBy('order_no')->get();
        return $company_ownerships;
    }
}
