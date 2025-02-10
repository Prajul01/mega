<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.language.index',['languages'=>$languages, 'status'=>$status]);
    }

    public function languageStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('languages')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('languages')->where('id', $request->id)->update(['status' => 'inactive']);

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
        $data=new Language();
        if (!isset($request->status)) {
            $data->status = 'inactive';
        }else{
            $data->status = $request->status;
        }
        $data->order_no = Language::max('order_no') + 1;
        $slug = Str::slug($request->title);
        $slug_count = Language::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug =Language::createSlug($request->title, 0);
        }
        $data->slug = $slug;
        $data->title=$request->title;
        $data->save();
        if ($data) {
            return redirect()->route('admin.language.index')->with('success', 'Successfully created language.');

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
        $language = Language::findOrFail(base64_decode($id));
        if ($language) {
            $status = 'edit';
            return view('admin.language.index',['language'=>$language, 'status'=>$status]);
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
        $language = language::findOrFail(base64_decode($id));
        $this->validate($request, [
            'title' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);
        if (!isset($request->status)) {
            $language->status = 'inactive';
        }else{
            $language->status = $request->status;
        }
        if($language->title != $request->title){
            $slug = Language::createSlug($request->title, 0);
          }
          if(isset($slug)){
            if ( $language->slug != $slug) {
                $oldslug =  $language->slug;
                $language->slug = $slug;
            }
        }else{
            $slug =  $language->slug;
        }
        $language->slug=$slug;
        $language->title=$request->title;
        $language->save();
        if ($language) {
            return redirect()->route('admin.language.index')->with('success', 'Successfully updated language.');

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
        $language = Language::findOrFail($request->id);
        $status = $language->delete();
        if ($status) {
            return redirect()->route('admin.language.index')->with('success', 'language successfully deleted.');
        } else {
            return back()->with('erroe', 'Something Wrong!');
        }

    }
    public function set_order(Request $request)
    {

        $language = new Language();
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
            Language::where('id', $item['id'])->update($updateData);
        }
    }
    public function getlanguageListFromDB()
    {
        $languages = Language::orderBy('order_no')->get();
        return $languages;
    }
}
