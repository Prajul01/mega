<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanyCategoryController extends Controller
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
        $company_categorys = CompanyCategory::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.company_category.index', ['company_categorys' => $company_categorys, 'status' => $status]);
    }

    public function company_categoryStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('company_categories')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('company_categories')->where('id', $request->id)->update(['status' => 'inactive']);

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
            'industry_id' => 'required|exists:industries,id',

            'status' => 'nullable| in:active,inactive',
        ]);
        $data = new CompanyCategory();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        } else {
            $data->status = $request->status;
        }
        $data->order_no = CompanyCategory::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = CompanyCategory::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = CompanyCategory::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $data->title = $request->title;
        $data->industry_id = $request->industry_id;

        $data->save();
        if ($data) {
            return redirect()->route('admin.company_category.index')->with('success', 'Successfully created company_category.');

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
        $company_category = CompanyCategory::findOrFail(base64_decode($id));
        if ($company_category) {
            $status = 'edit';
            return view('admin.company_category.index', ['company_category' => $company_category, 'status' => $status]);
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
        $company_category = CompanyCategory::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'industry_id' => 'required|exists:industries,id',
            'status' => 'nullable|in:active,inactive',
        ]);
        if (!isset($request->status)) {
            $company_category->status = 'inactive';
        } else {
            $company_category->status = $request->status;
        }
        if ($company_category->title != $request->title) {
            $slug = CompanyCategory::createSlug($request->title, 0);
        }
        if (isset($slug)) {
            if ($company_category->slug != $slug) {
                $oldslug = $company_category->slug;
                $company_category->slug = $slug;
            }
        } else {
            $slug = $company_category->slug;
        }
        $company_category->slug = $slug;
        $company_category->title = $request->title;
        $company_category->industry_id = $request->industry_id;
        $company_category->save();
        if ($company_category) {
            return redirect()->route('admin.company_category.index')->with('success', 'Successfully updated company_category.');

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
        $company_category = CompanyCategory::findOrFail($request->id);
        $status = $company_category->delete();
        if ($status) {
            return redirect()->route('admin.company_category.index')->with('success', 'company_category successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $company_category = new company_category();
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
            CompanyCategory::where('id', $item['id'])->update($updateData);
        }
    }
    public function getcompany_categoryListFromDB()
    {
        $company_categorys = CompanyCategory::orderBy('order_no')->get();
        return $company_categorys;
    }
}
