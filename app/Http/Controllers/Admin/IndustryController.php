<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IndustryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:job-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:job-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:job-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:job-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $industries = Industry::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.industry.index', ['industries' => $industries, 'status' => $status]);
    }

    public function industriestatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('industries')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('industries')->where('id', $request->id)->update(['status' => 'inactive']);

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
            'name' => 'required',
            'status' => 'nullable| in:active,inactive',
        ]);
        $data = new Industry();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        } else {
            $data->status = $request->status;
        }
        $data->order_no = Industry::max('order_no') + 1;
        $slug = Str::slug($request->name);
        $slug_count = Industry::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = industry::createSlug($request->name, 0);
        }
        $data->slug = $slug;
        $data->name = $request->name;
        $data->save();
        if ($data) {
            return redirect()->route('admin.industry.index')->with('success', 'Successfully created industry.');

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
        $industry = Industry::findOrFail(base64_decode($id));
        if ($industry) {
            $status = 'edit';
            return view('admin.industry.index', ['industry' => $industry, 'status' => $status]);
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
        $industry = Industry::findOrFail(base64_decode($id));
        $this->validate($request, [
            'name' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);
        if (!isset($request->status)) {
            $industry->status = 'inactive';
        } else {
            $industry->status = $request->status;
        }
        if ($industry->name != $request->name) {
            $slug = Industry::createSlug($request->name, 0);
        }
        if (isset($slug)) {
            if ($industry->slug != $slug) {
                $oldslug = $industry->slug;
                $industry->slug = $slug;
            }
        } else {
            $slug = $industry->slug;
        }
        $industry->slug = $slug;
        $industry->name = $request->name;
        $industry->save();
        if ($industry) {
            return redirect()->route('admin.industry.index')->with('success', 'Successfully updated industry.');

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
        $industry = Industry::findOrFail($request->id);
        $status = $industry->delete();
        if ($status) {
            return redirect()->route('admin.industry.index')->with('success', 'industry successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $industry = new industry();
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
            Industry::where('id', $item['id'])->update($updateData);
        }
    }
    public function getindustryListFromDB()
    {
        $industries = Industry::orderBy('order_no')->get();
        return $industries;
    }
}
