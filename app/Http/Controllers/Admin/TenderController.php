<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Tender;
use App\Models\TenderType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TenderCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TenderController extends Controller
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
        $tender = Tender::orderBy('order_no')->get();
        $status = 'index';
        $tender_category=TenderCategory::where('status','active')->orderBy('order_no')->get();
        $tender_type=TenderType::where('status','active')->orderBy('order_no')->get();
        $tag=Tag::where('status','active')->orderBy('order_no')->get();
        return view('admin.tender.index',['tenders'=>$tender, 'status'=>$status,'tender_category'=>$tender_category,'tender_type'=>$tender_type,'tags'=>$tag]);
    }

    public function tenderstatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('tender')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('tender')->where('id', $request->id)->update(['status' => 'inactive']);

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
            'sub_title'=>'nullable',
            'tag'=>'nullable',
            'tender_type'=>'required',
            'tender_category'=>'required',
            'deadline_date'=>'required|date',
            'status'=>'nullable| in:active,inactive',
            'feature'=>'nullable|in:0,1',
            'description'=>'nullable',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:5000',
        ]);
        $data=new Tender();
        $path = public_path() . '/storage/tender/';
        $folderPath = 'public/tender/';
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        if (!isset($request->feature)) {
            $data->feature = '0';
        }else{
            $data->feature = $request->feature;
        }
        $data->order_no =  Tender::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count =  Tender::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = Tender::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $data->title=$request->title;
        $data->sub_title=$request->sub_title;
        $data->deadline = $request->deadline_date;
        $data->description=$request->description;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $request->logo->move( $path, $filename);
            $data->logo = $filename;
        }
        $tag_data=array();
        if(isset($request->tag)){
            foreach($request->tag as $tag){
               array_push($tag_data,$tag);
            }
            $data->tags=json_encode($tag_data);
        }
        $data->tender_category_id=$request->tender_category;
        $data->tender_type_id=$request->tender_type;
        $data->save();
        if ($data) {
            return redirect()->route('admin.tender.index')->with('success', 'Successfully created tender.');

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
        $tender =  Tender::findOrFail(base64_decode($id));
        $tag=Tag::where('status','active')->orderBy('order_no')->get();
        $tender_category=TenderCategory::where('status','active')->orderBy('order_no')->get();
        $tender_type=TenderType::where('status','active')->orderBy('order_no')->get();
        if ($tender) {
            $status = 'edit';
            return view('admin.tender.index',['tender'=>$tender, 'status'=>$status,'tags'=>$tag,'tender_category'=>$tender_category,'tender_type'=>$tender_type]);
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
        $tender =  Tender::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);
        if (!isset($request->status)) {
            $tender->status = 'inactive';
        }else{
            $tender->status = $request->status;
        }
        if (!isset($request->feature)) {
            $tender->feature = '0';
        }else{
            $tender->feature= $request->feature;
        }
        if($tender->title != $request->title){
            $slug =  Tender::createSlug($request->title, 0);
          }
          if(isset($slug)){
            if ( $tender->slug != $slug) {
                $oldslug =  $tender->slug;
                $tender->slug = $slug;
            }
        }else{
            $slug =  $tender->slug;
        }
        $path = public_path() . '/storage/tender/';
        $folderPath = 'public/tender/';
        $tender->slug=$slug;
        $tender->title=$request->title;
        $tender->sub_title=$request->sub_title;
        $tender->deadline = $request->deadline_date;
        $tender->description = $request->description;
        if ($request->hasFile('logo')) {
            if (!file_exists($path)) {
                Storage::makeDirectory($folderPath, 0777, true, true);
            }
            $oldImage = $tender->logo;
            $newImage = $request->file('logo');
            $filename = time() . '.' . $newImage->getClientOriginalExtension();
            $request->logo->move( $path, $filename);
            // dd($oldImage);
            if ($oldImage != null):
                Storage::delete($folderPath . $oldImage);
            endif;
            $tender->logo= $filename;
        }
        $tag_data=array();
        if(isset($request->tag)){
            $tender->tags=null;
            foreach($request->tag as $tag){
               array_push($tag_data,$tag);
            }
            $tender->tags=json_encode($tag_data);
        }
        $tender->tender_category_id=$request->tender_category;
        $tender->tender_type_id=$request->tender_type;
        $tender->save();
        if ($tender) {
            return redirect()->route('admin.tender.index')->with('success', 'Successfully updated tender.');

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
        $tender =  Tender::findOrFail($request->id);
        $status = $tender->delete();
        if ($status) {
            return redirect()->route('admin.tender.index')->with('success', 'Tender Category successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $tender = new  Tender();
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
            Tender::where('id', $item['id'])->update($updateData);
        }
    }
    public function gettenderListFromDB()
    {
        $tender = Tender::orderBy('order_no')->get();
        return $tender;
    }
}
