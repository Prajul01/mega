<?php

namespace App\Http\Controllers\Admin;

use App\Models\StudyField;
use Illuminate\Support\Str;
use App\Models\StudySubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StudySubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:education-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:education-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:education-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:education-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $studysubjects=StudySubject::orderBy('order_no')->get();
        $studyfields=StudyField::where('status','active')->orderBy('order_no')->get();
        $status = 'index';
        return view('admin.studysubject.index',['studysubjects'=>$studysubjects,'studyfields'=>$studyfields, 'status'=>$status]);
    }

    public function studysubjectStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('studysubjects')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('studysubjects')->where('id', $request->id)->update(['status' => 'inactive']);

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
            'studyfield' => 'required',
            'status'=>'nullable| in:active,inactive',
        ]);
        $data=new studysubject();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no = studysubject::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = studysubject::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug =studysubject::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $data->title=$request->title;
        $data->study_field_id = $request->studyfield;
        $data->save();
        if ($data) {
            return redirect()->route('admin.studysubject.index')->with('success', 'Successfully created studysubject.');

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
        $studysubject = StudySubject::findOrFail(base64_decode($id));
        $studyfields=StudyField::where('status','active')->orderBy('order_no')->get();
        if ($studysubject) {
            $status = 'edit';
            return view('admin.studysubject.index',['studysubject'=>$studysubject, 'status'=>$status,'studyfields'=>$studyfields]);
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
        $studysubject = studysubject::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'status' => 'nullable|in:active,inactive',
            'studyfield' => 'required',
        ]);
        if (!isset($request->status)) {
            $studysubject->status = 'inactive';
        }else{
            $studysubject->status = $request->status;
        }
        if($studysubject->title != $request->title){
            $slug = studysubject::createSlug($request->title, 0);
          }
          if(isset($slug)){
            if ( $studysubject->slug != $slug) {
                $oldslug =  $studysubject->slug;
                $studysubject->slug = $slug;
            }
        }else{
            $slug =  $studysubject->slug;
        }
        $studysubject->slug=$slug;
        $studysubject->title=$request->title;
        $studysubject->study_field_id = $request->studyfield;
        $studysubject->save();
        if ($studysubject) {
            return redirect()->route('admin.studysubject.index')->with('success', 'Successfully updated studysubject.');

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
        $studysubject = studysubject::findOrFail($request->id);
        $status = $studysubject->delete();
        if ($status) {
            return redirect()->route('admin.studysubject.index')->with('success', 'studysubject successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $studysubject = new studysubject();
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
            studysubject::where('id', $item['id'])->update($updateData);
        }
    }
    public function getstudysubjectListFromDB()
    {
        $studysubjects = studysubject::orderBy('order_no')->get();
        return $studysubjects;
    }
}
