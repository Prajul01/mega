<?php

namespace App\Http\Controllers\Admin;

use App\Models\Experience;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ExperienceController extends Controller
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
        $experiences = Experience::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.experience.index',['experiences'=>$experiences, 'status'=>$status]);
    }

    public function experienceStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('experiences')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('experiences')->where('id', $request->id)->update(['status' => 'inactive']);

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
        $data=new Experience();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no = Experience::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = Experience::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug =Experience::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $data->title=$request->title;
        $data->save();
        if ($data) {
            return redirect()->route('admin.experience.index')->with('success', 'Successfully created experience.');

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
        $experience = Experience::findOrFail(base64_decode($id));
        if ($experience) {
            $status = 'edit';
            return view('admin.experience.index',['experience'=>$experience, 'status'=>$status]);
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
        $experience = Experience::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);
        if (!isset($request->status)) {
            $experience->status = 'inactive';
        }else{
            $experience->status = $request->status;
        }
        if($experience->title != $request->title){
            $slug = Experience::createSlug($request->title, 0);
          }
          if(isset($slug)){
            if ( $experience->slug != $slug) {
                $oldslug =  $experience->slug;
                $experience->slug = $slug;
            }
        }else{
            $slug =  $experience->slug;
        }
        $experience->slug=$slug;
        $experience->title=$request->title;
        $experience->save();
        if ($experience) {
            return redirect()->route('admin.experience.index')->with('success', 'Successfully updated experience.');

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
        $experience = Experience::findOrFail($request->id);
        $status = $experience->delete();
        if ($status) {
            return redirect()->route('admin.experience.index')->with('success', 'experience successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $experience = new Experience();
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
            Experience::where('id', $item['id'])->update($updateData);
        }
    }
    public function getexperienceListFromDB()
    {
        $experiences = Experience::orderBy('order_no')->get();
        return $experiences;
    }
}
