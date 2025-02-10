<?php

namespace App\Http\Controllers\Admin;

use App\Models\CropImg;
use App\Models\Education;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Storage;

class EducationController extends Controller
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
        $educations = Education::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.education.index', ['educations' => $educations, 'status' => $status]);
    }

    public function educationStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('educations')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('educations')->where('id', $request->id)->update(['status' => 'inactive']);

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
            'status' => 'nullable| in:active,inactive',
            'image' => 'bail|required|image|mimes:png,jg,jpeg',
        ]);

        $data = new Education();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        } else {
            $data->status = $request->status;
        }

        $data->order_no = Education::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = Education::where('slug', $slug)->count();

        if ($slug_count > 0) {
            $slug = Education::createSlug($request->title, 0);
        }

        $path = public_path() . '/storage/education' ;
        $folderPath = 'public/education';

        if(!file_exists($path)){
            Storage::makeDirectory($folderPath, 0755, true, true);
            chmod($path, 0755);
        }

        $data->slug = $slug;
        $data->title = $request->title;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $slug . '.' . $file->extension();

            CropImg::resize_crop_images(65,65, $file, $filename);
            $data->image = $filename;
        }

        $data->save();
        if ($data) {
            return redirect()->route('admin.education.index')->with('success', 'Successfully created education.');

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
        $education = Education::findOrFail(base64_decode($id));
        if ($education) {
            $status = 'edit';
            return view('admin.education.index', ['education' => $education, 'status' => $status]);
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
        $education = Education::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'status' => 'nullable|in:active,inactive',
            'description' => 'nullable',
            'image' => 'bail|nullable|image|mimes:png,jpg,jpeg'
        ]);
        if (!isset($request->status)) {
            $education->status = 'inactive';
        } else {
            $education->status = $request->status;
        }
        if (strtolower($education->title) != strtolower($request->title)) {
            $slug = Education::createSlug($request->title, 0);
        }
        if (isset($slug)) {
            if ($education->slug != $slug) {
                $oldslug = $education->slug;
                $education->slug = $slug;
            }
        } else {
            $slug = $education->slug;
        }

        $path = public_path() . '/storage/education';
        $folderPath = 'public/education';

        if(!file_exists($path)){
            Storage::makeDirectory($folderPath, 0755, true, true);
            chmod($path, 0755);
        }

        $education->slug = $slug;
        $education->title = $request->title;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $slug . '.' . $file->extension();

            CropImg::resize_crop_images(65,65, $file, $folderPath . '/' .$filename);
            $education->image = $filename;
        }
        $education->save();
        if ($education) {
            return redirect()->route('admin.education.index')->with('success', 'Successfully updated education.');

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
        $education = Education::findOrFail($request->id);
        Storage::delete('public/education/' . $education->image);
        $status = $education->delete();
        if ($status) {
            return redirect()->route('admin.education.index')->with('success', 'education successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $education = new Education();
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
            Education::where('id', $item['id'])->update($updateData);
        }
    }
    public function geteducationListFromDB()
    {
        $educations = Education::orderBy('order_no')->get();
        return $educations;
    }
}