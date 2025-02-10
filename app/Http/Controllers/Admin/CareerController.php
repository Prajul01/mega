<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Career;
use App\Models\CropImg;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:career-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:career-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:career-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:career-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $careers = Career::orderBy('order_no')->get();
        $status = 'index';
        $tag=Tag::where('status','active')->orderBy('order_no')->get();
        return view('admin.career.index',['careers'=>$careers, 'status'=>$status,'tags'=>$tag]);
    }

    public function careerStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('careers')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('careers')->where('id', $request->id)->update(['status' => 'inactive']);

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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5000',
            'description' => 'required',
            'status'=>'nullable| in:active,inactive',
            'author'=>'nullable|max:255',
        ]);
        $data=new career();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no = Career::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = Career::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug =Career::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $path = public_path() . '/storage/career/';
        $folderPath = 'public/career/';
        if (!file_exists($path)) {
            Storage::makeDirectory($folderPath, 0777, true, true);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            CropImg::resize_crop_images(1200, 600, $image, $folderPath . '/' . $filename);
            CropImg::resize_crop_images(800, 500, $image, $folderPath . '/thumb_' . $filename);

            $data->image = $filename;
        }
        $tag_data=array();
        if(isset($request->tag)){
            foreach($request->tag as $tag){
               array_push($tag_data,$tag);
            }
            $data->tags=json_encode($tag_data);
        }
       $data->title=$request->title;
       $data->description=$request->description;
       $data->author=$request->author;
       $data->save();
        if ($data) {
            return redirect()->route('admin.career.index')->with('success', 'Successfully created career.');

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
        $career = Career::findOrFail(base64_decode($id));
        $tag=Tag::where('status','active')->orderBy('order_no')->get();
        if ($career) {
            $status = 'edit';
            return view('admin.career.index',['career'=>$career, 'status'=>$status,'tags'=>$tag]);
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
        $career = Career::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
            'status' => 'nullable|in:active,inactive',
            'description' => 'required',
            'author'=>'nullable|max:255',
        ]);
        if (!isset($request->status)) {
            $career->status = 'inactive';
        }else{
            $career->status = $request->status;
        }

        $path = public_path() . '/storage/career/';
        $folderPath = 'public/career/';

        if ($request->hasFile('image')) {
            if (!file_exists($path)) {
                Storage::makeDirectory($folderPath, 0777, true, true);
            }
            $oldImage = $career->image;
            $newImage = $request->file('image');
            $filename = time() . '.' . $newImage->getClientOriginalExtension();
            CropImg::resize_crop_images(1200, 600, $newImage, $folderPath . '/' . $filename);
            CropImg::resize_crop_images(800, 500, $newImage, $folderPath . '/thumb_' . $filename);
            // dd($oldImage);
            if ($oldImage != null):
                Storage::delete($folderPath . $oldImage);
                Storage::delete($folderPath . '/' . $oldImage);
            endif;
            $career->image = $filename;
        }
        if($career->title != $request->title){
            $slug = Career::createSlug($request->title, 0);
          }
          if(isset($slug)){
            if ( $career->slug != $slug) {
                $oldslug =  $career->slug;
                $career->slug = $slug;
            }
        }else{
            $slug =  $career->slug;
        }
        $tag_data=array();
        if(isset($request->tag)){
            $career->tags=null;
            foreach($request->tag as $tag){
               array_push($tag_data,$tag);
            }
            $career->tags=json_encode($tag_data);
        }
        $career->slug=$slug;
        $career->title=$request->title;
        $career->description=$request->description;
        $career->author=$request->author;
        $career->save();
        if ($career) {
            return redirect()->route('admin.career.index')->with('success', 'Successfully updated career.');

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
        $career = career::findOrFail($request->id);
        if ($career != null) {
            //deleting exiting image
            Storage::delete('public/career/' . $career->image);
            Storage::delete('public/career/thumb_' . $career->image);
        }

        $status = $career->delete();
        if ($status) {
            return redirect()->route('admin.career.index')->with('success', 'career successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $career = new career();
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
            Career::where('id', $item['id'])->update($updateData);
        }
    }
    public function getcareerListFromDB()
    {
        $careers = Career::orderBy('order_no')->get();
        return $careers;
    }
}
