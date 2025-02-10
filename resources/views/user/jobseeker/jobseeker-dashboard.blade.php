@extends('user.layout.master')
@section('title', 'Dashboard - Job Seeker')
@section('content')

    <div class="main-content">

        <div class="page-content">
            <!-- START CANDIDATE-DETAILS -->
            <section class="section dashboard-section">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">

                            @include('user.jobseeker.layouts.sidebar')


                        </div><!--end col-->

                        <div class="col-lg-9 col-md-8">
                            <div class="card candidate-info new-shadow-sidebar mt-4 mb-3 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="profile-summary r-5">
                                        <div class="row">
                                            <div class="col-6 col-md-6 col-lg-3">
                                                <div class="summary-card blue-light r-5">
                                                    <div class="summary-info">
                                                        <div class="summary-num">
                                                            {{ $user_apply_job->count() }}
                                                        </div>
                                                        <a href="{{ route('user.apply_job', auth()->user()->username) }}"
                                                            class="summary-text">Job
                                                            Applied</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6 col-lg-3">
                                                <div class="summary-card orange-light r-5">
                                                    <div class="summary-info">
                                                        <div class="summary-num">
                                                            {{ $profile_visits }}
                                                        </div>
                                                        <a href="{{ route('user.profile_visit', auth()->user()->username) }}"
                                                            class="summary-text">Profile
                                                            Visits
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6 col-lg-3">
                                                <div class="summary-card green-light r-5">

                                                    <div class="summary-info">
                                                        <div class="summary-num">
                                                            {{ $user_save_job->count() }}

                                                        </div>
                                                        <a href="{{ route('user.save_job', auth()->user()->username) }}"
                                                            class="summary-text">Saved
                                                            Jobs</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6 col-lg-3">
                                                <div class="summary-card red-light r-5">

                                                    <div class="summary-info">
                                                        <div class="summary-num">
                                                            {{ $download_cvs }}
                                                        </div>
                                                        <a href="{{ route('user.download_cv', auth()->user()->username) }}"
                                                            class="summary-text">CV
                                                            Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="job-summary-tab">
                                        <ul class="nav nav-pills new-3-nav m-0 mb-3" id="pills-tab" role="tablist">
                                            <li class="nav-item pl-0" role="presentation">
                                                <button class="nav-link active" id="pills-matching-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-matching" type="button"
                                                    role="tab" aria-controls="pills-matching" aria-selected="true">
                                                    Matching Jobs
                                                    <span class="number-right orange">
                                                        {{ $similar_job->count() }}
                                                    </span>
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-recently-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-recently" type="button" role="tab"
                                                    aria-controls="pills-recently" aria-selected="false">
                                                    Recently Applied
                                                    <span class="number-right green">
                                                        {{ $user_apply_job->count() }}
                                                    </span>
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-saved-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-saved" type="button" role="tab"
                                                    aria-controls="pills-saved" aria-selected="false">
                                                    Saved
                                                    Jobs
                                                    <span class="number-right orange">
                                                        {{ $user_save_job->count() }}
                                                    </span>
                                                </button>
                                            </li>

                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-matching" role="tabpanel"
                                                aria-labelledby="pills-matching-tab">
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
                                                                            class="img-fluid"
                                                                            alt="{{ $job->employer->slug }}">
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
                                                                        <span
                                                                            class="green-light">{{ $job->employee_type->title }}</span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-level">
                                                                        <span
                                                                            class="orange-light">{{ $job->job_level->title }}</span>
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
                                                                        <a target="_blank"
                                                                            href="{{ route('job_single', $job->slug) }}"
                                                                            class="btn btn-border">
                                                                            View Detail
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </table>
                                                </div>
                                                <!-- <br> -->
                                                <div class="text-center my-3">
                                                    <a href="{{ route('user.similar_job', auth()->user()->username) }}"
                                                        name="submit" id="submit"
                                                        class="btn btn-primary btn-hover">Explore All Jobs </a>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="pills-recently" role="tabpanel"
                                                aria-labelledby="pills-recently-tab">
                                                <div class="table-responsive">
                                                    <table class="job-table">
                                                        <tr class="table-row">
                                                            <th>Company</th>
                                                            <th>Job Position</th>
                                                            <th>Job Type</th>
                                                            <th>Job Level</th>
                                                            <th>Deadline</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        @foreach ($user_apply_job as $job)
                                                            <tr class="table-row">
                                                                <td>
                                                                    <div class="company-logo">
                                                                        <img src="{{ asset('storage/employer/logo' . $job->job->employer->logo) }}"
                                                                            class="img-fluid"
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
                                                                        <span
                                                                            class="green-light">{{ $job->job->employee_type->title }}</span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-level">
                                                                        <span
                                                                            class="orange-light">{{ $job->job->job_level->title }}</span>
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
                                                                        <a href="{{ route('job_single', $job->job->slug) }}"
                                                                            class="btn btn-border">
                                                                            View Detail
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                                <!-- <br> -->
                                                <div class="text-center my-3">
                                                    <a href="{{ route('user.apply_job', auth()->user()->username) }}"
                                                        name="submit" id="submit"
                                                        class="btn btn-primary btn-hover">Explore All
                                                        Jobs </a>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-saved" role="tabpanel"
                                                aria-labelledby="pills-saved-tab">
                                                <div class="table-responsive">
                                                    <table class="job-table">
                                                        <tr class="table-row">
                                                            <th>Company</th>
                                                            <th>Job Position</th>
                                                            <th>Job Type</th>
                                                            <th>Job Level</th>
                                                            <th>Deadline</th>
                                                            <th>Action</th>
                                                            <th width="35px">
                                                            </th>
                                                        </tr>
                                                        @foreach ($user_save_job as $save_job)
                                                            <tr class="table-row">
                                                                <td>
                                                                    <div class="company-logo">
                                                                        <img src="{{ asset('storage/employer/logo' . $save_job->job->employer->logo) }}"
                                                                            class="img-fluid"
                                                                            alt="{{ $save_job->job->employer->slug }}">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-detail">
                                                                        <div class="job-post">
                                                                            {{ $save_job->job->title }}
                                                                        </div>
                                                                        <div class="job-by">
                                                                            {{ $save_job->job->company_name }}
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-type">
                                                                        <span class="green-light">
                                                                            {{ $save_job->job->employee_type->title }}</span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-level">
                                                                        <span
                                                                            class="orange-light">{{ $save_job->job->job_level->title }}</span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="deadline">
                                                                        <?php
                                                                        $currentDateTime = \Carbon\Carbon::now();
                                                                        $endDate = \Carbon\Carbon::parse($save_job->job->expiry_date);
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
                                                                        <a target="_blank"
                                                                            href="{{ route('job_single', $save_job->job->slug) }}"
                                                                            class="btn btn-border">
                                                                            View Detail
                                                                        </a>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                                <!-- <br> -->
                                                <div class="text-center my-3">
                                                    <a href="{{ route('user.save_job', auth()->user()->username) }}"
                                                        name="submit" id="submit"
                                                        class="btn btn-primary btn-hover">Explore All
                                                        Jobs </a>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div><!--end card-->
                            </div><!--end col-->
                            @include('user.jobseeker.layouts.categories')


                        </div><!--end row-->
                    </div><!--end container-->
            </section>
            <!-- END CANDIDATE-DETAILS -->

        </div>
        <!-- End Page-content -->



    </div>
    <!-- End Page-content -->
@endsection
