<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\CropImg;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
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
        $blogs = Blog::orderBy('order_no')->get();
        $tags = Tag::where('status', 'active')->orderBy('order_no')->get();
        $status = 'index';
        return view('admin.blog.index', ['blogs' => $blogs, 'tags' => $tags, 'status' => $status]);
    }

    public function blogStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('blogs')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('blogs')->where('id', $request->id)->update(['status' => 'inactive']);

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
            'status' => 'nullable| in:active,inactive',
            'author' => 'nullable|max:255',
            'compnay_name' => 'nullable|max:255',
            'tag' => 'nullable',
        ]);
        $data = new Blog();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        } else {
            $data->status = $request->status;
        }
        $data->order_no = Blog::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = Blog::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = Blog::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $path = public_path() . '/storage/blog/';
        $folderPath = 'public/blog/';
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

        if (@$request->tag) {
            $temp = [];
            foreach ($request->tag as $tag) {
                
                array_push($temp, $tag);
            }
            $data->tags = json_encode($temp);
        }

        $data->title = $request->title;
        $data->description = $request->description;
        $data->author = $request->author;
        $data->company_name = $request->company_name;
        $data->save();
        if ($data) {
            return redirect()->route('admin.blog.index')->with('success', 'Successfully created blog.');

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
        $blog = Blog::findOrFail(base64_decode($id));
        $tags = Tag::where('status', 'active')->orderBy('order_no')->get();

        if ($blog) {
            $status = 'edit';
            return view('admin.blog.index', ['blog' => $blog, 'tags' => $tags, 'status' => $status]);
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
        $blog = Blog::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
            'status' => 'nullable|in:active,inactive',
            'description' => 'required',
            'author' => 'nullable|max:255',
            'compnay_name' => 'nullable|max:255',
            'tag' => 'nullable'
        ]);
        if (!isset($request->status)) {
            $blog->status = 'inactive';
        } else {
            $blog->status = $request->status;
        }

        $path = public_path() . '/storage/blog/';
        $folderPath = 'public/blog/';

        if ($request->hasFile('image')) {
            if (!file_exists($path)) {
                Storage::makeDirectory($folderPath, 0777, true, true);
            }
            $oldImage = $blog->image;
            $newImage = $request->file('image');
            $filename = time() . '.' . $newImage->getClientOriginalExtension();
            CropImg::resize_crop_images(1200, 600, $image, $folderPath . '/' . $filename);
            CropImg::resize_crop_images(800, 500, $image, $folderPath . '/thumb_' . $filename);
            // dd($oldImage);
            if ($oldImage != null):
                Storage::delete($folderPath . $oldImage);
                Storage::delete($folderPath . '/' . $oldImage);
            endif;
            $blog->image = $filename;
        }
        if ($blog->title != $request->title) {
            $slug = Blog::createSlug($request->title, 0);
        }
        if (isset($slug)) {
            if ($blog->slug != $slug) {
                $oldslug = $blog->slug;
                $blog->slug = $slug;
            }
        } else {
            $slug = $blog->slug;
        }
        $blog->slug = $slug;
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->author = $request->author;
        $blog->company_name = $request->company_name;

        if (@$request->tag) {
            $temp = [];
            foreach ($request->tag as $tag) {
                
                array_push($temp, $tag);
            }
            $blog->tags = json_encode($temp);
        }

        $blog->save();
        if ($blog) {
            return redirect()->route('admin.blog.index')->with('success', 'Successfully updated blog.');

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
        $blog = Blog::findOrFail($request->id);
        if ($blog != null) {
            //deleting exiting image
            Storage::delete('public/blog/' . $blog->image);
            Storage::delete('public/blog/thumb_' . $blog->image);
        }

        $status = $blog->delete();
        if ($status) {
            return redirect()->route('admin.blog.index')->with('success', 'blog successfully deleted.');
        } else {
            return back()->with('error', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $blog = new Blog();
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
            Blog::where('id', $item['id'])->update($updateData);
        }
    }
    public function getblogListFromDB()
    {
        $blogs = Blog::orderBy('order_no')->get();
        return $blogs;
    }
}