<?php

namespace App\Http\Controllers\Admin;

use App\Models\Privacy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrivacyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:content-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:content-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:content-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:content-delete', ['only' => ['destroy']]);
    }
    public function index(){
        $privacy=Privacy::firstOrFail();
        return view('admin.privacy.index',['privacy'=>$privacy]);
    }

    public function update(Request $request){
        $request->validate([
          'description'=>'required',
        ]);
        $privacy=Privacy::firstOrFail();
        $privacy->description=$request->description;
        $privacy->save();
        if($privacy){
            return back()->with('status','Privacy Policies Updated!!');
        }
    }
}
