<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Mail\AppliedStatus;
use App\Models\UserAppliesJob;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use Mail;

class SendEmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'status' => 'required|integer|between:0,1',
        ]);

        $user = User::findOrFail($request->user_id);
        $job = Job::findOrFail($request->job_id);


        if ($user == [] || $user == null || $job == [] || $job == null) {
            return response()->json(
                array(
                    'status' => 404,
                    'message' => 'Data not found!',
                )
            );
        }

        $job->applied_users()->updateExistingPivot($user, ['status' => $request->status]);
        if (@$request->message) {
            $details = [
                'applicant_name' => $user->job_seeker->first_name . ' ' . ($user->job_seeker->middle_name ?? $user->job_seeker->middle_name . ' ') . $user->job_seeker->last_name,
                'status' => $request->status,
                'company_name' => $job->employer->company_name,
                'company_email' => $job->employer->email,
                'company_address' => $job->employer->address,
                'company_contact' => $job->employer->office_number . $job->employer->phone_number ?? ', ' . $job->employer->phone_number,
                'message' => $request->message,
            ];

            Mail::to($user->email)->send(new AppliedStatus($details));
        }

        return response()->json(
            array(
                'status' => 200,
                'bool' => $request->status,
                'message' => $request->status == 1 ? 'The applicant was accepted' : 'The applicant was declined',
            )
        );
    }

    public function sendBulkEmail(Request $request, $slug)
    {
        // dd($request);
        $this->validate($request, [
            'users' => 'required',
            'status' => 'required|string:accept,decline',
        ]);

        $user_ids = $request->users;
        $job = Job::where('slug', $slug)->first();

        if ($job == null || $job == []) {
            return redirect()->back()->with('error', 'Job Not Found');
        }

        $status = $request->status == 'accept'? 1 : 0;

        foreach ($user_ids as $id) {
            $user = User::find($id);

            if ($user == null || $user == []) {
                return redirect()->back()->with('error', 'User Not Found');
            }

            $job->applied_users()->updateExistingPivot($user, ['status' => $status]);

            if (@$request->message) {
                $details = [
                    'applicant_name' => $user->job_seeker->first_name . ' ' . ($user->job_seeker->middle_name ?? $user->job_seeker->middle_name . ' ') . $user->job_seeker->last_name,
                    'status' => $status,
                    'company_name' => $job->employer->company_name,
                    'company_email' => $job->employer->email,
                    'company_address' => $job->employer->address,
                    'company_contact' => $job->employer->office_number . $job->employer->phone_number ?? ', ' . $job->employer->phone_number,
                    'message' => $request->message,
                ];

                Mail::to($user->email)->send(new AppliedStatus($details));
            }
        }

        return redirect()->back()->with('status', 'Applicant has been ' . $status? 'accepted' : 'declined');
    }
}