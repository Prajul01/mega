<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Hash;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:user-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::role('super-admin')->where('email', '!=', 'ktmrushservices@gmail.com')->paginate(20);

        return view('admin.users.index', compact('users'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:password_confirmation',
        ]);

        $user = new User;
        $user->admin = 1;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->assignRole('1');

        return redirect()->back()->with('status', $user->name . ' has been added as ADMIN');
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
        $user = User::find(base64_decode($id));
        if (is_null($user) || empty($user)) {
            return redirect()->back()->with('error', 'NO ADMIN WAS FOUND');
        }

        return view('admin.users.index', compact('user'));
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
        // dd($request);
        $request->validate([
            'name' => 'required',
        ]);

        $user = User::find(base64_decode($id));
        if (is_null($user) || empty($user)) {
            return redirect()->back()->with('error', 'NO ADMIN WAS FOUND');
        }

        $user->name = $request->name;

        if ($user->email != $request->email) {
            $request->validate([
                'email' => 'required|email|unique:users'
            ]);
            $user->email = $request->email;
        }

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->update();

        return to_route('admin.admin-management.index')->with('status', $user->name . ' has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find(base64_decode($id));
        

        if (is_null($user) || empty($user)) {
            return redirect()->back()->with('error', 'NO ADMIN WAS FOUND');
        }
       if(auth()->user()->id == $user->id){
        return redirect()->back()->with('error', 'You are login, please try other account.');

        }
        $user->delete();

        return to_route('admin.admin-mangement.index')->with('status', 'Admin was deleted');
    }

    public function suspend($id)
    {
        $user = User::find(base64_decode($id));

        if (is_null($user) || empty($user)) {
            return redirect()->back()->with('error', 'NO ADMIN WAS FOUND');
        }

        $user->suspended = $user->suspended == 0 ? 1 : 0;
        $user->save();

        return redirect()->back()->with('status', 'Admin status has been changed');
    }
}