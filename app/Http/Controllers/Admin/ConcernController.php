<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AreaOfConcern as Concern;

class ConcernController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $concerns = Concern::orderBy('order_no')->get();
        $status = 'index';
        return view('admin.concern.index', compact('concerns', 'status'));
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
        // dd($request);
        $request->validate([
            'concern' => 'required',
        ]);

        $concern = new Concern;
        $concern->concern = $request->concern;
        $concern->display = $request->display? 1: 0;
        $concern->order_no = Concern::max('order_no') + 1;
        $concern->save();

        return back()->with($concern->concern . ' has been added');
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
        $concern = Concern::find(base64_decode($id));
        if(is_null($concern) || empty($concern)){
            return back()->with('error', 'Requested Concern Not Found');
        }
        $status = 'edit';

        return view('admin.concern.index', compact('concern', 'status'));
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
            'concern' => 'required',
        ]);

        $concern = Concern::find(base64_decode($id));

        if(is_null($concern) || empty($concern)){
            return  back()->with('error', 'Requested Concern not found');
        }

        $concern->concern = $request->concern;
        $concern->display = $request->display? 1: 0;

        $concern->update();

        return to_route('admin.concern.index')->with('status', $concern->concern . ' has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $concern = Concern::find($request->id);
        if(is_null($concern) || empty($concern)){
            return response()->json('Requested concern not found', 404);
        }

        $concern->delete();

        return 'success';
    }

    public function set_order(Request $request)
    {
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
            Concern::where('id', $item['id'])->update($updateData);
        }
    }
}
