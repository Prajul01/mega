<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployerAccountSetting as Setting;
use App\Models\EmployerEmail as Emails;
use Hash;

class EmployerSettingController extends Controller
{

    public function pages($page = null){
        $result = match($page){
            null, => $this->pageSettings(),
            'change-emails' => $this->changeEmail(),
            'change-password' => $this->changePassword(),
            'deactivate-account' => $this->deactivationAccount(),
            default => to_route('employers.settings.accountSettings'),
        };

        return $result;
    }

    /****************************** FOR COMPANY PAGE SETTINGS *********************************/
    public function pageSettings(){
        $settings = Setting::where('employer_id', auth()->user()->employer->id)->first();
        $active = 1;
    
        return view('employer.account-settings.settings', compact('settings','active'));
    }

    private function createSettingRow():void{
        $setting = new Setting;
        $setting->employer_id = auth()->user()->employer->id;
        $setting->save();
    }  
    
    public function updatePageSettings(Request $request){
        $settings = Setting::where('employer_id', auth()->user()->employer->id)->first();
        if(is_null($settings) || empty($settings)){
            $settings = $this->createSettingRow();
        }

        $settings->profile = $request->profile ? 1: 0;
        $settings->ownership = $request->ownership ? 1: 0;
        $settings->size = $request->size ? 1: 0;
        $settings->summary = $request->summary ? 1: 0;
        $settings->address = $request->address ? 1: 0;
        $settings->website = $request->website ? 1: 0;
        $settings->services = $request->services ? 1: 0;
        $settings->social_accounts = $request->social_accounts ? 1: 0;

        $settings->update();

        return back()->with('status', 'Account settings has been updated');
    }

    /********************************** For Email ************************************/
    public function changeEmail(){
        $emails = Emails::where('employer_id', auth()->user()->employer->id)->orderBy('is_primary', 'desc')->get();
        $active = 2;

        return view('employer.account-settings.change-email', compact('emails', 'active'));
    }

    public function editDeleteEmail(Request $request){
        $request->validate([
            'email' => 'required',
            'submit' => 'required|in:primary,remove'
        ]);

        $email = Emails::find(base64_decode($request->email));
        if(is_null($email) || empty($email)){
            return back()->with('error', 'Email Not Found');
        }

        match($request->submit){
            'primary' => $this->setPrimary($email),
            'remove' => $this->removeEmail($email)
        };

        return back()->with('status', 'Action was successful');
    }

    public function addEmail(Request $request){
        $request->validate([
            'email' => 'required|unique:employer_emails,email'
        ]);

        $email = new Emails;
        $email->email = $request->email;
        $email->email_verified_at = now();
        $email->employer_id = auth()->user()->employer->id;
        $email->save();

        return back()->with('status', 'New Email has been added');
    }

    private function setPrimary($email):void{
        $other_primary = Emails::where('employer_id', $email->employer_id)->where('is_primary', 1)->first();

        if(!is_null($other_primary) || !empty($other_primary)){
            $other_primary->is_primary = 0;
            $other_primary->update();
        }

        $email->is_primary = 1;
        $email->update();
    }

    private function removeEmail($email):void{
        if($email->is_primary){
            $others = Emails::where('employer_id', $email->employer_id)->where('id', '!=', $email->id)->inRandomOrder()->first();
            $others->is_primary = 1;
            $others->udpate();
            $email->is_primary = 0;
            $others->update();
        }
        $email->delete();
    }

    /******************* For Password Change**********************/
    public function changePassword(){
        $active = 3;
        return view('employer.account-settings.change-password', compact('active'));
    }

    /**
     * updates password of authenticated employer
     */

     public function changePasswordPost(Request $request)
     {
         // dd($request);
         $this->validate($request, [
             'old_password' => 'required',
             'confirm_password' => 'required',
             'password' => 'required|same:confirm_password',
         ]);
 
         if (Hash::check($request->old_password, auth()->user()->password)) {
             $user = auth()->user();
             $user->password = Hash::make($request->password);
             $user->update();
 
             return redirect()->back()->with('status', 'Password changed successfully');
         }
 
         return back()->with('error', 'Old password is incorrect');
     }

    /****************For Deactivation and Deletion of account***************/

     public function deactivationAccount(){
        $active = 4;
        return view('employer.account-settings.deactivation-account', compact('active'));
     }

    public function postDeactivate(Request $request){
        $request->validate([
            'action' => 'bail|required|in:deactivate,delete,activate',
            'password' => 'required',
        ]);

        if(Hash::check($request->password, auth()->user()->password)){
            $result = match($request->action){
                'deactivate' => $this->deactivateAccount(),
                'delete' => $this->deleteEmployer(),
                'activate' => $this->activate()
            };
    
            return $result;
        }

        return back()->with('error', 'Password entered is incorrect');
    }
    
    private function deactivateAccount(){
        auth()->user()->is_deactivated = 1;
        auth()->user()->update();
        auth()->logout();
        return to_route('employers.login')->with('warning', 'Account has been deactivated');
    }

    private function deleteEmployer(){
        $user = auth()->user();
        auth()->logout();
        $user->delete();
        return to_route('employers.login')->with('status', 'Accout has been deleted');        
    }

    private function activate(){
        auth()->user()->is_deactivated = 0;
        auth()->user()->update();

        return to_route('employers.index')->with('status', 'Account has been activated');
    }
}