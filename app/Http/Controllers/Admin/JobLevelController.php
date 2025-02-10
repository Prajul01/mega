<?php

namespace App\Http\Controllers\Admin;

use App\Models\JobLevel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class JobLevelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:job-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:job-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:job-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:job-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $JobLevels = JobLevel::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.jobLevel.index',['joblevels'=>$JobLevels, 'status'=>$status]);
    }

    public function JobLevelStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('job_levels')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('job_levels')->where('id', $request->id)->update(['status' => 'inactive']);

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
        $data=new JobLevel();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no = JobLevel::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = JobLevel::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug =JobLevel::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $data->title=$request->title;
        $data->save();
        if ($data) {
            return redirect()->route('admin.JobLevel.index')->with('success', 'Successfully created JobLevel.');

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
        $JobLevel = JobLevel::findOrFail(base64_decode($id));
        if ($JobLevel) {
            $status = 'edit';
            return view('admin.jobLevel.index',['JobLevel'=>$JobLevel, 'status'=>$status]);
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
        $JobLevel = JobLevel::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);
        if (!isset($request->status)) {
            $JobLevel->status = 'inactive';
        }else{
            $JobLevel->status = $request->status;
        }
        if($JobLevel->title != $request->title){
            $slug = JobLevel::createSlug($request->title, 0);
          }
          if(isset($slug)){
            if ( $JobLevel->slug != $slug) {
                $oldslug =  $JobLevel->slug;
                $JobLevel->slug = $slug;
            }
        }else{
            $slug =  $JobLevel->slug;
        }
        $JobLevel->slug=$slug;
        $JobLevel->title=$request->title;
        $JobLevel->save();
        if ($JobLevel) {
            return redirect()->route('admin.JobLevel.index')->with('success', 'Successfully updated JobLevel.');

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
        $JobLevel = JobLevel::findOrFail($request->id);
        $status = $JobLevel->delete();
        if ($status) {
            return redirect()->route('admin.JobLevel.index')->with('success', 'JobLevel successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $JobLevel = new JobLevel();
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
            JobLevel::where('id', $item['id'])->update($updateData);
        }
    }
    public function getJobLevelListFromDB()
    {
        $JobLevels = JobLevel::orderBy('order_no')->get();
        return $JobLevels;
    }
}
