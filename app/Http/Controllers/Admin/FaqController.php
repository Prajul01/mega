<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Models\CropImg;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FaqController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:content-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:content-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:content-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:content-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $faqs = Faq::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.faq.index',['faqs'=>$faqs, 'status'=>$status]);
    }

    public function faqStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('faqs')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('faqs')->where('id', $request->id)->update(['status' => 'inactive']);

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
            'faq_type'=>'required | in:employeer,job_seeker',
            'status'=>'nullable| in:active,inactive',
            'sub_title'=>'required',
            'description'=>'required',
        ]);
        $data=new faq();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no = faq::max('order_no') + 1;
        $sub_title=array();$description=array();
        if(isset($request->sub_title)){
            // $about->sub_title=null;
            // $about->description=null;
            foreach($request->sub_title as $key=>$title){
                array_push($sub_title,$title);
                array_push($description,$request->description[$key]);
            }
            $data->sub_title=json_encode($sub_title);
            $data->description=json_encode($description);
        }
        $data->faq_type=$request->faq_type;
       $data->title=$request->title;
       $data->save();
        if ($data) {
            return redirect()->route('admin.faq.index')->with('status', 'Successfully created Faq.');

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
        $faq = Faq::findOrFail(base64_decode($id));
        if ($faq) {
            $status = 'edit';
            return view('admin.faq.index',['faq'=>$faq, 'status'=>$status]);
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
        $faq = Faq::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'status' => 'nullable|in:active,inactive',
            'description' => 'required',
            'faq_type'=>'required | in:employeer,job_seeker',
            'sub_title'=>'required',
        ]);
        $faq->title=$request->title;
        if (!isset($request->status)) {
            $faq->status = 'inactive';
        }else{
            $faq->status = $request->status;
        }
        $sub_title=array();$description=array();
        if(isset($request->sub_title)){
            $faq->sub_title=null;
            $faq->description=null;
            foreach($request->sub_title as $key=>$title){
                array_push($sub_title,$title);
                array_push($description,$request->description[$key]);
            }
            $faq->sub_title=json_encode($sub_title);
            $faq->description=json_encode($description);
        }
        $faq->faq_type=$request->faq_type;
        $faq->save();
        if ($faq) {
            return redirect()->route('admin.faq.index')->with('status', 'Successfully updated faq.');
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
        $faq = faq::findOrFail($request->id);
        if ($faq != null) {
            //deleting exiting image
            Storage::delete('public/faq/' . $faq->image);
            Storage::delete('public/faq/thumb_' . $faq->image);
        }

        $status = $faq->delete();
        if ($status) {
            return redirect()->route('admin.faq.index')->with('status', 'faq successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $faq = new faq();
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
            faq::where('id', $item['id'])->update($updateData);
        }
    }
    public function getfaqListFromDB()
    {
        $faqs = faq::orderBy('order_no')->get();
        return $faqs;
    }

    public function delete_data($key,$id){
        $faq=Faq::findOrFail(base64_decode($id));
        $desc=json_decode( $faq->description);
        $title=json_decode($faq->sub_title);
        unset($desc[$key]);
        unset($title[$key]);
        $d=array_values($desc);
        $t=array_values($title);
        $new_data_desc=json_encode($d);
        $new_data_title=json_encode($t);
        $faq->description=$new_data_desc;
        $faq->sub_title=$new_data_title;
        $faq->save();
        return back()->with('status','Faq sub Data has been deleted!!');
    }
}
