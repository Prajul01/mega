<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Str;

class AuthController extends Controller
{
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

    public function register(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'accept' => 'required',
            'g-recaptcha-response' => new \App\Rules\GoogleRecaptcha,
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->name = 'Job Seeker';
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->suspended = 0;
        $user->save();

        $user->assignRole('3');
        auth()->login($user);   

        return redirect()->back()->with('status', 'Sign up was successfull');
    }
}
