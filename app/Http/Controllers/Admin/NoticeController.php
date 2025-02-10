<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    //pdf
    public function index()
    {
        $notices = Notice::all();
        $status = 'index';
        return view('admin.notice.index',['notices'=>$notices, 'status'=>$status]);
    }

    public function noticeStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('notices')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('notices')->where('id', $request->id)->update(['status' => 'inactive']);

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
            'file' => 'required|mimes:pdf',
            'status'=>'nullable| in:active,inactive',
        ]);
        $data=new Notice();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no = Notice::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = Notice::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug =Notice::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $path = public_path() . '/storage/notice/';
        $folderPath = 'public/notice/';
        if (!file_exists($path)) {
            Storage::makeDirectory($folderPath, 0777, true, true);
        }
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $filename);
            $data->file = $filename;
        }
       $data->title=$request->title;
       $data->save();
        if ($data) {
            return redirect()->route('admin.notice.index')->with('success', 'Successfully created Notice.');

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
        $notice = Notice::findOrFail(base64_decode($id));
        if ($notice) {
            $status = 'edit';
            return view('admin.notice.index',['notice'=>$notice, 'status'=>$status]);
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
        $notice = Notice::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'file' => 'nullable|mimes:pdf',
            'status' => 'nullable|in:active,inactive',
        ]);
        if (!isset($request->status)) {
            $notice->status = 'inactive';
        }else{
            $notice->status = $request->status;
        }

        $path = public_path() . '/storage/notice/';
        $folderPath = 'public/notice/';
        if (!file_exists($path)) {
            Storage::makeDirectory($folderPath, 0777, true, true);
        }
        if ($request->hasFile('file')) {
            $oldFile = $notice->image;
            $newFile = $request->file('file');
            $filename = time() . '.' . $newFile->getClientOriginalExtension();
            $newFile->move($path, $filename);
            $notice->file = $filename;
            // dd($oldImage);
            if ($oldFile != null):
                Storage::delete($folderPath . $oldFile);
                Storage::delete($folderPath . '/' . $oldFile);
            endif;
        }
        if($notice->title != $request->title){
            $slug = Notice::createSlug($request->title, 0);
          }
          if(isset($slug)){
            if ( $notice->slug != $slug) {
                $oldslug =  $notice->slug;
                $notice->slug = $slug;
            }
        }else{
            $slug =  $notice->slug;
        }
        $notice->slug=$slug;
        $notice->title=$request->title;
        $notice->save();
        if ($notice) {
            return redirect()->route('admin.notice.index')->with('success', 'Successfully updated notice.');

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
        $notice = Notice::findOrFail($request->id);
        if ($notice != null) {
            //deleting exiting image
            Storage::delete('public/notice/' . $notice->file);
        }
        $status = $notice->delete();
        if ($status) {
            return redirect()->route('admin.notice.index')->with('success', 'notice successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $notice = new notice();
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
            notice::where('id', $item['id'])->update($updateData);
        }
    }
    public function getnoticeListFromDB()
    {
        $notices = Notice::orderBy('order_no')->get();
        return $notices;
    }
}
