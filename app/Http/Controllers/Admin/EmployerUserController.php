<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyCategory;
use App\Models\Employer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Str;
use Auth;

class EmployerUserController extends Controller
{
    /**
     * Check which role is accesing this controller
     *
     * @return void
     */

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
        $users = User::orderBy('name')->role('employer')->get();
        return view('admin.employerUser.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CompanyCategory::orderBy('order_no')->get();

        return view('admin.employerUser.form', compact('categories'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|same:confirm_password',
        ]);


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->username = $request->username;
        $user->save();
        $user->assignRole(2);

        if (Auth::user()->hasRole('super-admin')) {
            return redirect()->route('admin.employers.index')->with('status', $request->username . ' has been added as employer');
        }

        return "Hello There employer, Work Has Been Done";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user->username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $categories = CompanyCategory::orderBy('order_no')->get();
        return view('admin.employerUser.form', compact('user', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);


        $user = User::where('username', $username)->firstOrFail();
        $user->name = $request->name;
        if($request->password)
        {
            $user->password = Hash::make($request->password);
        }
        $user->update();

        if (Auth::user()->hasRole('super-admin')) {
            return redirect()->route('admin.employers.index')->with('status', $user->username . ' has been updated');
        }

        return "Hello There employer, Work Has Been Done";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find(base64_decode($id));
        if(@$user->employer){
            foreach($user->employer->jobs as $job){
                $job->skill()->detach();
            }
        }
        $user->delete();

        return back()->with('status', 'Employer has been removed');
    }

    /**
     * Suspends the employer for acting suspeciously
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function suspended(Request $request, $username)
    {
        // dd($request);
        $user = User::where('id', $username)->firstOrFail();
        $user->suspended = $user->suspended == 1? 0 : 1;
        $user->update();

        return back();
    }

    /**
     * check if the username exists or not
     */
    public function usernameValidate(Request $request)
    {
        $username = $request->username;
        
        if (User::where('username', '=', $username)->exists()) {
            $uniqueUserName = $username . '-' . Str::lower(Str::random(4));
            $username = $this->generateUserName($uniqueUserName);
        } else {
            return response()->json(array('status' => 200, 'valid' => 1));
        }

        return response()->json(array(
            'status' => 200,
            'valid' => 0,
            'suggestions' => $username
        ));
    }

    public function generateUserName($name)
    {
        $username = Str::lower(Str::slug($name));
        return $username;
    }
}
