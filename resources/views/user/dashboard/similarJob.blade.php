@extends('user.dashboard.layouts.app')
@section('title', 'Similar Jobs | Job Seeker')
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
                            <th>Deadline</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($similar_job as $job)
                            <tr class="table-row">
                                <td>
                                    <div class="company-logo">
                                        <img src="{{ asset('storage/employer/logo' . $job->employer->logo) }}"
                                            class="img-fluid" alt="{{ $job->employer->slug }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="job-detail">
                                        <div class="job-post">
                                            {{ $job->title }}
                                        </div>
                                        <div class="job-by">
                                            {{ $job->company_name }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="job-type">
                                        <span class="green-light">{{ $job->employee_type->title }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="job-level">
                                        <span class="orange-light">{{ $job->job_level->title }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="deadline">
                                        <?php
                                        $currentDateTime = \Carbon\Carbon::now();
                                        $endDate = \Carbon\Carbon::parse($job->expiry_date);
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
                                    <div class="job-detail">
                                        <a target="_blank" href="{{ route('job_single', $job->slug) }}"
                                            class="btn btn-border">
                                            View Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
@endsection
