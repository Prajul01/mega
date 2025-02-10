<?php

namespace App\Http\Controllers\Admin;

use App\Models\Education;
use App\Models\StudyField;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StudyFieldController extends Controller
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
        $studyfields = StudyField::orderBy('order_no')->get();
        $education=Education::where('status','active')->orderBy('order_no')->get();
        $status = 'index';
        return view('admin.studyfield.index',['studyfields'=>$studyfields, 'status'=>$status,'educations'=>$education]);
    }

    public function studyfieldStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('studyfields')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('studyfields')->where('id', $request->id)->update(['status' => 'inactive']);

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
            'education' => 'required',
            'status'=>'nullable| in:active,inactive',
        ]);
        $data=new StudyField();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no = StudyField::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = StudyField::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug =StudyField::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $data->title=$request->title;
        $data->education_id = $request->education;
        $data->save();
        if ($data) {
            return redirect()->route('admin.studyfield.index')->with('success', 'Successfully created studyfield.');

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
        $studyfield = StudyField::findOrFail(base64_decode($id));
        $education=Education::where('status','active')->orderBy('order_no')->get();
        if ($studyfield) {
            $status = 'edit';
            return view('admin.studyfield.index',['studyfield'=>$studyfield, 'status'=>$status,'educations'=>$education]);
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
        $studyfield = StudyField::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'status' => 'nullable|in:active,inactive',
            'education'=>'required',
        ]);
        if (!isset($request->status)) {
            $studyfield->status = 'inactive';
        }else{
            $studyfield->status = $request->status;
        }
        if($studyfield->title != $request->title){
            $slug = StudyField::createSlug($request->title, 0);
          }
          if(isset($slug)){
            if ( $studyfield->slug != $slug) {
                $oldslug =  $studyfield->slug;
                $studyfield->slug = $slug;
            }
        }else{
            $slug =  $studyfield->slug;
        }
        $studyfield->slug=$slug;
        $studyfield->title=$request->title;
        $studyfield->education_id = $request->education;
        $studyfield->save();
        if ($studyfield) {
            return redirect()->route('admin.studyfield.index')->with('success', 'Successfully updated studyfield.');

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
        $studyfield = StudyField::findOrFail($request->id);
        $status = $studyfield->delete();
        if ($status) {
            return redirect()->route('admin.studyfield.index')->with('success', 'studyfield successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $studyfield = new StudyField();
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
            StudyField::where('id', $item['id'])->update($updateData);
        }
    }
    public function getstudyfieldListFromDB()
    {
        $studyfields = StudyField::orderBy('order_no')->get();
        return $studyfields;
    }
}
