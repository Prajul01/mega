<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TagController extends Controller
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
        $tag = Tag::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.tag.index',['tags'=>$tag, 'status'=>$status]);
    }

    public function tagstatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('tag')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('tag')->where('id', $request->id)->update(['status' => 'inactive']);

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
        $data=new Tag();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no =  tag::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count =  tag::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = tag::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $data->title=$request->title;
        $data->save();
        if ($data) {
            return redirect()->route('admin.tag.index')->with('success', 'Successfully created tag.');

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
        $tag =  Tag::findOrFail(base64_decode($id));
        if ($tag) {
            $status = 'edit';
            return view('admin.tag.index',['tag'=>$tag, 'status'=>$status]);
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
        $tag =  Tag::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);
        if (!isset($request->status)) {
            $tag->status = 'inactive';
        }else{
            $tag->status = $request->status;
        }
        if($tag->title != $request->title){
            $slug =  tag::createSlug($request->title, 0);
          }
          if(isset($slug)){
            if ( $tag->slug != $slug) {
                $oldslug =  $tag->slug;
                $tag->slug = $slug;
            }
        }else{
            $slug =  $tag->slug;
        }
        $tag->slug=$slug;
        $tag->title=$request->title;
        $tag->save();
        if ($tag) {
            return redirect()->route('admin.tag.index')->with('success', 'Successfully updated tag.');

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
        $tag =  Tag::findOrFail($request->id);
        $status = $tag->delete();
        if ($status) {
            return redirect()->route('admin.tag.index')->with('success', 'tag Category successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $tag = new  Tag();
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
            tag::where('id', $item['id'])->update($updateData);
        }
    }
    public function gettagListFromDB()
    {
        $tag = Tag::orderBy('order_no')->get();
        return $tag;
    }
}
