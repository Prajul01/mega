<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
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
        if (is_null(request()->q)) {
            $users = User::role('job-seeker')->has('job_seeker')->with('job_seeker')->latest()->get();
            $unverified_count = User::role('job-seeker')->doesnthave('job_seeker')->count();

            return view('admin.users.index', compact('users', 'unverified_count'));
        }

        if (request()->q == 'unverified-users') {
            $unverified_users = User::role('job-seeker')->doesnthave('job_seeker')->with('job_seeker')->latest()->get();
            $verified_count = User::role('job-seeker')->has('job_seeker')->count();

            return view('admin.users.index', compact('unverified_users', 'verified_count'));
        }

        return redirect()->back()->with('error', '500 : SERVER ERROR');
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

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|same:password_confirmation'
        ]);
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return redirect()->route('admin.users.admins.index')->with('status', 'User Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $user = User::where('username', $username)->first();
        // dd($user->job_seeker->company_category);

        if(is_null($user) && is_empty($user))
        {
            return redirect()->back()->with('error', 'User Not Found');
        }

        return view('admin.users.index', compact('user'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail(base64_decode($id));

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
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $user = User::findOrFail(base64_decode($id));
        $user->name = $request->name;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()
            ->route('admin.users.admins.index')
            ->with('status', 'User edited Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail(base64_decode($id));
        $user->delete();

        return redirect()->back()
            ->with('status', 'User Deleted Successfully');
    }

    public function suspended($username)
    {
        $user = User::where('username', $username)->first();

        if(is_null($user))
        {
            return redirect()->back()->with('error', 'User not found');
        }

        $user->suspended = $user->suspended == 0? 1: 0;
        $user->save();
        return redirect()->back()->with('status', 'User status has been updated');

    }
}