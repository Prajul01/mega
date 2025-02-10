<?php

namespace App\Http\Controllers\Admin;

use App\Models\Term;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermsController extends Controller
{

    public function __construct(){
        $this->middleware('permission:content-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:content-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:content-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:content-delete', ['only' => ['destroy']]);
    }
    public function index(){
        $term=Term::firstOrFail();
        return view('admin.terms.index',['term'=>$term]);
    }

    public function update(Request $request){
        $request->validate([
          'description'=>'required',
        ]);
        $term=Term::firstOrFail();
        $term->description=$request->description;
        $term->save();
        if($term){
            return back()->with('status','Terms And Condition Updated!!');
        }
    }
}
