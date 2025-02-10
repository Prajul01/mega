<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsAndAnnouncement as News;
use App\Models\CropImg;
use Str;
use Storage;

class NewsAndAnnouncementController extends Controller
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
        $newsAndAnnouncement = News::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.news_and_announcement.index',['newsAndAnnouncement'=>$newsAndAnnouncement, 'status'=>$status]);
    }

    public function blogStatus(Request $request)
    {
        if ($request->mode == 'true') {
            News::findOrFail($request->id)->update(['status' => 'active']);
        } else {
            News::findOrFail($request->id)->update(['status' => 'inactive']);
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
            'compnay_name'=>'nullable|max:255',
        ]);
        $data=new News();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no = News::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = News::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug =News::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $path = public_path() . '/storage/news_and_announcement/';
        $folderPath = 'public/news_and_announcement/';
        if (!file_exists($path)) {
            Storage::makeDirectory($folderPath, 0755, true, true);
            chmod($path, 0755);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->extension();

            CropImg::resize_crop_images(1200, 600, $image, $folderPath . '/' . $filename);
            CropImg::resize_crop_images(800, 500, $image, $folderPath . '/thumb_' . $filename);

            $data->image = $filename;
        }

       $data->title=$request->title;
       $data->description=$request->description;
       $data->author=$request->author;
       $data->company_name=$request->company_name;
       $data->save();
        if ($data) {
            return redirect()->route('admin.news.index')->with('success', 'Successfully created blog.');

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
        $newsAndAnnouncement = News::findOrFail(base64_decode($id));
        if ($newsAndAnnouncement) {
            $status = 'edit';
            return view('admin.news_and_announcement.index',['blog'=>$newsAndAnnouncement, 'status'=>$status]);
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
        $newsAndAnnouncement = News::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
            'status' => 'nullable|in:active,inactive',
            'description' => 'required',
            'author'=>'nullable|max:255',
            'compnay_name'=>'nullable|max:255',
        ]);
        if (!isset($request->status)) {
            $newsAndAnnouncement->status = 'inactive';
        }else{
            $newsAndAnnouncement->status = $request->status;
        }

        $path = public_path() . '/storage/news_and_announcement/';
        $folderPath = 'public/news_and_announcement/';

        if ($request->hasFile('image')) {
            if (!file_exists($path)) {
                Storage::makeDirectory($folderPath, 0755, true, true);
            }
            $oldImage = $newsAndAnnouncement->image;
            $newImage = $request->file('image');
            $filename = time() . '.' . $newImage->extension();
            CropImg::resize_crop_images(1200, 600, $newImage, $folderPath . '/' . $filename);
            CropImg::resize_crop_images(800, 500, $newImage, $folderPath . '/thumb_' . $filename);
            // dd($oldImage);
            if ($oldImage != null):
                Storage::delete($folderPath . $oldImage);
                Storage::delete($folderPath . '/' . $oldImage);
            endif;
            $newsAndAnnouncement->image = $filename;
        }
        if($newsAndAnnouncement->title != $request->title){
            $slug = News::createSlug($request->title, 0);
          }
          if(isset($slug)){
            if ( $newsAndAnnouncement->slug != $slug) {
                $oldslug =  $newsAndAnnouncement->slug;
                $newsAndAnnouncement->slug = $slug;
            }
        }else{
            $slug =  $newsAndAnnouncement->slug;
        }
        $newsAndAnnouncement->slug=$slug;
        $newsAndAnnouncement->title=$request->title;
        $newsAndAnnouncement->description=$request->description;
        $newsAndAnnouncement->author=$request->author;
        $newsAndAnnouncement->company_name=$request->company_name;
        $newsAndAnnouncement->save();
        if ($newsAndAnnouncement) {
            return redirect()->route('admin.news.index')->with('success', 'Successfully updated blog.');

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
        $newsAndAnnouncement = News::findOrFail($request->id);
        if ($newsAndAnnouncement != null) {
            //deleting exiting image
            Storage::delete('public/news_and_announcement/' . $newsAndAnnouncement->image);
            Storage::delete('public/news_and_announcement/thumb_' . $newsAndAnnouncement->image);
        }

        $status = $newsAndAnnouncement->delete();
        if ($status) {
            return redirect()->route('admin.blog.index')->with('success', 'blog successfully deleted.');
        } else {
            return back()->with('error', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $newsAndAnnouncement = new News;
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
            News::where('id', $item['id'])->update($updateData);
        }
    }
    public function getblogListFromDB()
    {
        $newsAndAnnouncement = News::orderBy('order_no')->get();
        return $newsAndAnnouncement;
    }
}