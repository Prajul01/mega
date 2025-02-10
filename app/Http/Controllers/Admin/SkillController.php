<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skill;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{

    public function __construct(){
        $this->middleware('permission:job-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:job-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:job-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:job-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $skills = Skill::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.skill.index',['skills'=>$skills, 'status'=>$status]);
    }

    public function skillStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('skills')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('skills')->where('id', $request->id)->update(['status' => 'inactive']);

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
            'description' => 'nullable',
            'status'=>'nullable| in:active,inactive',
        ]);
        $data=new Skill();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no = Skill::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = Skill::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug =Skill::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $data->title=$request->title;
        $data->description=$request->description;
        $data->save();
        if ($data) {
            return redirect()->route('admin.skill.index')->with('success', 'Successfully created skill.');

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
        $skill = Skill::findOrFail(base64_decode($id));
        if ($skill) {
            $status = 'edit';
            return view('admin.skill.index',['skill'=>$skill, 'status'=>$status]);
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
        $skill = skill::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'status' => 'nullable|in:active,inactive',
            'description' => 'nullable',
        ]);
        if (!isset($request->status)) {
            $skill->status = 'inactive';
        }else{
            $skill->status = $request->status;
        }
        if($skill->title != $request->title){
            $slug = Skill::createSlug($request->title, 0);
          }
          if(isset($slug)){
            if ( $skill->slug != $slug) {
                $oldslug =  $skill->slug;
                $skill->slug = $slug;
            }
        }else{
            $slug =  $skill->slug;
        }
        $skill->slug=$slug;
        $skill->title=$request->title;
        $skill->description=$request->description;
        $skill->save();
        if ($skill) {
            return redirect()->route('admin.skill.index')->with('success', 'Successfully updated skill.');

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
        $skill = Skill::findOrFail($request->id);
        $status = $skill->delete();
        if ($status) {
            return redirect()->route('admin.skill.index')->with('success', 'skill successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $skill = new Skill();
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
            Skill::where('id', $item['id'])->update($updateData);
        }
    }
    public function getskillListFromDB()
    {
        $skills = Skill::orderBy('order_no')->get();
        return $skills;
    }
}
