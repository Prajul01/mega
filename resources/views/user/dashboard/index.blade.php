@extends('user.dashboard.layouts.app')
@section('title', 'Dashboard | Job Seeker')
@section('user_content')
    <div class="card candidate-info shadow-sidebar mt-4 mb-3 mt-lg-0">
        <div class="card-body p-3">
            <div class="profile-summary r-5">
                <div class="row">
                    <div class="col-6 col-md-4">
                        <div class="summary-card blue-light r-5">
                            <div class="summary-info">
                                <div class="summary-num">
                                    {{ $user_apply_job->count() }}
                                </div>
                                <a href="#" class="summary-text">Job Applied</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="summary-card orange-light r-5">
                            <div class="summary-info">
                                <div class="summary-num">
                                    {{ $user_save_job->count() }}
                                </div>
                                <a href="#" class="summary-text">Saved Jobs</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="summary-card green-light r-5">

                            <div class="summary-info">
                                <div class="summary-num">
                                    {{ $user_save_job->count() }}
                                </div>
                                <a href="#" class="summary-text">Favourite Jobs</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="job-summary-tab">
                <ul class="nav nav-pills new-3-nav m-0 mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item pl-0" role="presentation">
                        <button class="nav-link active" id="pills-matching-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-matching" type="button" role="tab" aria-controls="pills-matching"
                            aria-selected="true">Matching Jobs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-recently-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-recently" type="button" role="tab" aria-controls="pills-recently"
                            aria-selected="false">Recently Applied</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-saved-tab" data-bs-toggle="pill" data-bs-target="#pills-saved"
                            type="button" role="tab" aria-controls="pills-saved" aria-selected="false">Saved
                            Jobs</button>
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
                        <!-- <br> -->
                        <div class="text-center my-3">
                            <a href="{{ route('jobs', ['top_jobs' => 'all']) }}"><button name="submit" type="submit"
                                    id="submit" class="btn btn-primary btn-hover">Explore All Jobs </button></a>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="pills-recently" role="tabpanel" aria-labelledby="pills-recently-tab">
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
                                                    class="img-fluid" alt="{{ $job->job->employer->slug }}">
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
                            <a href="{{ route('jobs', ['top_jobs' => 'all']) }}"><button name="submit" type="submit"
                                    id="submit" class="btn btn-primary btn-hover">Explore All Jobs </button></a>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-saved" role="tabpanel" aria-labelledby="pills-saved-tab">
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
                                                    class="img-fluid" alt="{{ $save_job->job->employer->slug }}">
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
                                                <span class="green-light"> {{ $save_job->job->employee_type->title }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-level">
                                                <span class="orange-light">{{ $save_job->job->job_level->title }}</span>
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
                                                <a target="_blank" href="{{ route('job_single', $save_job->job->slug) }}"
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
                            <a href="{{ route('jobs', ['top_jobs' => 'all']) }}"><button name="submit" type="submit"
                                    id="submit" class="btn btn-primary btn-hover">Explore All Jobs </button></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="card candidate-info shadow-sidebar mt-4 mt-lg-0">
        <div class="card-body p-3">
            <div class="category-card-title">
                Jobs By Categories
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card job-Categories-box bg-light border-0">
                        <div class="card-body p-3">
                            <ul class="list-unstyled job-Categories-list mb-0">
                                <li>
                                    <a href="job-list.html" class="primary-link">Accounting
                                        &amp; Finance <span class="badge bg-soft-info float-end">25</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Bank
                                        <span class="badge bg-soft-info float-end">10</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Logistic/Procurement<span
                                            class="badge bg-soft-info float-end">71</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Purchasing
                                        Manager <span class="badge bg-soft-info float-end">40</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Recruitment
                                        Agency <span class="badge bg-soft-info float-end">86</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Education
                                        &amp;
                                        training <span class="badge bg-soft-info float-end">47</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Marketing
                                        &amp;
                                        Advertising
                                        <span class="badge bg-soft-info float-end">47</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Catering
                                        &amp;
                                        Tourism <span class="badge bg-soft-info float-end">47</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-lg-4 mobile-none">
                    <div class="card job-Categories-box bg-light border-0">
                        <div class="card-body p-3">
                            <ul class="list-unstyled job-Categories-list mb-0">
                                <li>
                                    <a href="job-list.html" class="primary-link">Government
                                        <span class="badge bg-soft-info float-end">120</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Manufacturing
                                        <span class="badge bg-soft-info float-end">73</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Hospitality
                                        <span class="badge bg-soft-info float-end">88</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Retail
                                        &amp;
                                        Customer Services
                                        <span class="badge bg-soft-info float-end">10</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Fashion/Vogue/Trend
                                        <span class="badge bg-soft-info float-end">55</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Health Care
                                        <span class="badge bg-soft-info float-end">99</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Manufacturing &amp;
                                        production
                                        <span class="badge bg-soft-info float-end">27</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link"> Trading
                                        Company
                                        <span class="badge bg-soft-info float-end">11</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-lg-4 mobile-none">
                    <div class="card job-Categories-box bg-light border-0">
                        <div class="card-body p-3">
                            <ul class="list-unstyled job-Categories-list mb-0">
                                <li>
                                    <a href="job-list.html" class="primary-link">It /
                                        Software Company <span class="badge bg-soft-info float-end">175</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Logistics /
                                        Transportation
                                        <span class="badge bg-soft-info float-end">60</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Sports
                                        Company
                                        <span class="badge bg-soft-info float-end">42</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Cargo &amp;
                                        Courier
                                        <span class="badge bg-soft-info float-end">30</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">School/College
                                        <span class="badge bg-soft-info float-end">120</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Consulting
                                        /Legal<span class="badge bg-soft-info float-end">88</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link"> E-Commerce
                                        <span class="badge bg-soft-info float-end">04</span></a>
                                </li>
                                <li>
                                    <a href="job-list.html" class="primary-link">Tourism
                                        Industry<span class="badge bg-soft-info float-end">75</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>

        </div>
    </div>
@endsection
