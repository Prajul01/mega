<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Employer;
use App\Models\CompanyCategory;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function employerSignup(Request $request)
    {
        $this->validate($request, [
            'organization_name' => 'required',
            'organization_industry' => 'required',
            'contact_person_name' => 'required',
            'company_address' => 'required',
            'email' => 'required|email|unique:users',
            'office_contact' => 'required|numeric',
            'mobile_number' => 'required|numeric',
            'username' => 'required|unique:users',
            'password' => 'required|same:confirm_password',
            'g-recaptcha-response' => new \App\Rules\GoogleRecaptcha,
        ]);

        if (!$request->terms) {
            return back()->with('error', 'Please accept our terms and conditions and privacy policy');
        }


        $employer = new Employer;
        $employerUser = new User;

        $employerUser->email = $request->email;
        $employerUser->name = $request->contact_person_name;
        $employerUser->password = Hash::make($request->password);
        $employerUser->suspended = 0;
        $employerUser->username = $request->username;
        $employerUser->save();
        $employerUser->assignRole(2);

        $employer->company_name = $request->organization_name;
        $employer->slug = Employer::createSlug($request->organization_name);
        $employer->office_number = $request->office_contact;
        $employer->phone_number = $request->mobile_number;
        $employer->address = $request->company_address;
        $employer->company_category_id = CompanyCategory::where('slug', $request->organization_industry)->firstOrFail()->id;
        $employer->status = 'active';
        $employer->user_id = $employerUser->id;
        $employer->save();

        $email = new \App\Models\EmployerEmail;
        $email->employer_id = $employer->id;
        $email->email = $request->email;
        $email->email_verified_at = now();
        $email->is_primary = 1;
        $email->save();

        auth()->attempt(['email' => $request->email, 'password' => $request->password]);

        return redirect()->route('employers.index')->with('Thank you for signing up');
    }
}