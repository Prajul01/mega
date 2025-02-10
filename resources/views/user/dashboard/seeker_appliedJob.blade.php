@extends('user.dashboard.layouts.app')
@section('title', 'Applied Jobs | Job Seeker')
@section('user_content')
    <div class="card candidate-info shadow-sidebar mt-4 mb-3 mt-lg-0">
        <div class="card-body p-0">
            <div class="job-summary-tab mt-0">
                <div class="table-responsive">
                    <table class="job-table">
                        <tr class="table-row">
                            <th>Company</th>
                            <th>Job Position</th>
                            <th>Job Type</th>
                            <th>Job Level</th>
                            <th>Applied Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($user_apply_job as $job)
                            <tr class="table-row">
                                <td>
                                    <div class="company-logo">
                                        <img src="{{ asset('storage/employer/logo' . $job->job->employer->logo) }}" class="img-fluid"
                                            alt="{{ $job->job->employer->slug }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="job-detail">
                                        <div class="job-post">
                                            {{ $job->job->title }}
                                        </div>
                                        <div class="job-by">
                                            {{ $job->job->company_name }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="job-type">
                                        <span class="green-light">{{ $job->job->employee_type->title }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="job-level">
                                        <span class="orange-light">{{ $job->job->job_level->title }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="deadline">
                                        <?php
                                        $currentDateTime = \Carbon\Carbon::now();
                                        $endDate = \Carbon\Carbon::parse($job->job->expiry_date);
                                        $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                            'parts' => 2,
                                            'short' => false,
                                            'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                        ]);
                                        ?>
                                        {{ $timeLeft }} Left
                                    </div>
                                </td>
                                <td>
                                    <div class="job-status">
                                        <span class="blue-light">
                                            Applied
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="job-detail">
                                        <a href="{{ route('job_single', $job->job->slug) }}" class="btn btn-border">
                                            View Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div><!--end card-->
    </div><!--end col-->
@endsection
