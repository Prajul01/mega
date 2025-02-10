<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('admin', 1)->whereDoesnthave('roles', fn($q) => $q->whereIn('name', ['super-admin', 'employer', 'job-seeker']))->get();
        $roles = Role::whereNotIn('name', ['super-admin', 'job-seeker', 'employer'])->get();
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|same:password_confirmation',
            'role' => 'required|exists:roles,id|not_in:1,2,3'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->admin = 1;
        $status = $user->save();

        if ($status) {
            $user->assignRole($request->role);
        }

        return back()->with('status', 'User Created Successfully');
    }

    public function edit($id)
    {
        $user = User::find(base64_decode($id));
        $roles = Role::whereNotIn('name', ['super-admin', 'employer', 'job-seeker'])->get();

        return view('admin.users.index', compact('user', 'roles'));
    }

    public function update($id, Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . base64_decode($id) . ',id',
            'password' => 'nullable',
            'role' => 'required|exists:roles,id|not_in:1,2,3'
        ]);

        $user = User::find(base64_decode($id));
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $status = $user->update();

        if ($status) {
            if ($user->roles()->count() > 0) {
                $user->removeRole($user->roles[0]->name);
            }
            $user->assignRole($request->role);
        }

        return to_route('admin.adminUsers.index')->with('stauts', 'User has been edited');

    }

    public function destroy($id)
    {
        $user = user::find(base64_decode($id));
        if (is_null($user) || empty($user)) {
            return back()->with('error', 'User not found');
        }

        return back()->with('status', 'User has been deleted');
    }

    public function suspended($id)
    {
        $user = User::find(base64_decode($id));
        if (is_null($user) || empty($user)) {
            return back()->with('error', 'User not found');
        }
        $user->suspended = $user->suspended == 1 ? 0 : 1;
        $user->update();

        return back()->with('status', 'Suspend status has been changed');
    }
}