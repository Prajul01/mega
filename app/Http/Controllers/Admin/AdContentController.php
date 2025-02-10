<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdverisementContent as Content;
use Illuminate\Http\Request;

class AdContentController extends Controller
{
    public function index(){
        $content = Content::find(1);
        return view('admin.adContent.form', compact('content'));
    }

    public function update(Request $request){
        $request->validate([
            'main_content' => 'required',
            'why_megajob' => 'required',
        ]);

        $content = Content::findOrFail(1);
        $content->main_content = $request->main_content;
        $content->why_megajob = $request->why_megajob;
        $content->update();

        return back()->with('status', 'Content has been updated');
    }
}
