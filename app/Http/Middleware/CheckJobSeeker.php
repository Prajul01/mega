<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckJobSeeker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (auth()->user()->suspended == 1) {
            return back()->with('warning', 'You have been suspended.\nPlease contact MegaJob');
        }
        if (auth()->user()->is_deactivated == 1) {
            return redirect()->route('user.setting', auth()->user()->username)->with('warning', 'You have been Deactive.\nPlease contact MegaJob');
        }
        if (!$this->checkUser()) {
            return redirect()->route('user.basic_info', auth()->user()->username)->with('warning', 'Please complete your details to continue');
        }
        return $next($request);
    }

    /**
     * Checks the table `job_seeker_personal_information` 
     * is the basic information is entered by users 
     * IN CASE OF ADDITION OF FIELD IN BASIC INFORMATION OR JOB PREFERENCE OF JOB SEEKER
     * PLEASE STUDY THE CODE BELOW AND
     * CHANGE ACCORDINGLY
     */
    private function checkUser(): bool
    {
        $user = auth()->user();
        $i = 0;
        
        if(is_null($user->job_seeker)){
            return false;
        }
        foreach ($user->job_seeker->getAttributes() as $data) {
            if (is_null($data)) {
                $i++;
            }
        }

        if ($i > 7) {
            return false;
        }

        return true;
    }
}