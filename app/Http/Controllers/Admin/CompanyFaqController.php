<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyFaq as faq;

class CompanyFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = faq::where('display', 1)->orderBy('order_no')->get();
        $status = 'index';

        return view('admin.companyFaq.index', compact('faqs', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $data = new faq;
        $data->question = $request->question;
        $data->answer = $request->answer;
        $data->order_no = faq::max('order_no') + 1;
        $data->display = $request->display ? 1 : 0;
        $data->save();

        return back()->with('status', 'FAQ has been added');
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
        $faq = faq::find(base64_decode($id));
        if (is_null($faq) || empty($faq)) {
            return back()->with('error', 'FAQ not found');
        }

        $status = 'edit';

        return view('admin.companyFaq.index', compact('faq', 'status'));
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
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $data = faq::find(base64_decode($id));
        
        if (is_null($data) || empty($data)) {
            return back()->with('error', 'FAQ not found');
        }

        $data->question = $request->question;
        $data->answer = $request->answer;
        $data->order_no = faq::max('order_no') + 1;
        $data->display = $request->display ? 1 : 0;
        $data->save();

        return to_route('admin.companyFAQ.index')->with('status', 'FAQ has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = faq::find($request->id);
        $data->delete();

        return back()->with('status', 'FAQ has been delete');
    }
}