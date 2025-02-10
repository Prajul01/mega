<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TenderCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TenderCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tender-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:tender-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tender-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:tender-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $tender_category = TenderCategory::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.tender_category.index',['tender_categories'=>$tender_category, 'status'=>$status]);
    }

    public function tender_categorystatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('tender_category')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('tender_category')->where('id', $request->id)->update(['status' => 'inactive']);

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
        $data=new TenderCategory();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no =  TenderCategory::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count =  TenderCategory::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = TenderCategory::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $data->title=$request->title;
        $data->save();
        if ($data) {
            return redirect()->route('admin.tender_category.index')->with('success', 'Successfully created tender_category.');

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
        $tender_category =  TenderCategory::findOrFail(base64_decode($id));
        if ($tender_category) {
            $status = 'edit';
            return view('admin.tender_category.index',['tender_category'=>$tender_category, 'status'=>$status]);
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
        $tender_category =  TenderCategory::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);
        if (!isset($request->status)) {
            $tender_category->status = 'inactive';
        }else{
            $tender_category->status = $request->status;
        }
        if($tender_category->title != $request->title){
            $slug =  TenderCategory::createSlug($request->title, 0);
          }
          if(isset($slug)){
            if ( $tender_category->slug != $slug) {
                $oldslug =  $tender_category->slug;
                $tender_category->slug = $slug;
            }
        }else{
            $slug =  $tender_category->slug;
        }
        $tender_category->slug=$slug;
        $tender_category->title=$request->title;
        $tender_category->save();
        if ($tender_category) {
            return redirect()->route('admin.tender_category.index')->with('success', 'Successfully updated tender_category.');

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
        $tender_category =  TenderCategory::findOrFail($request->id);
        $status = $tender_category->delete();
        if ($status) {
            return redirect()->route('admin.tender_category.index')->with('success', 'Tender Category successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $tender_category = new  TenderCategory();
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
            TenderCategory::where('id', $item['id'])->update($updateData);
        }
    }
    public function gettender_categoryListFromDB()
    {
        $tender_category = TenderCategory::orderBy('order_no')->get();
        return $tender_category;
    }
}
