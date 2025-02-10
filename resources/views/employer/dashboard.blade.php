@extends('employer.layouts.app')
@section('dashboard_content')
    <div class="card candidate-info shadow-sidebar mt-4 mb-3 mt-lg-0">
        <div class="card-body p-3">
            <div class="profile-summary r-5">
                <div class="row">
                    <div class="col-md-3 col-6">
                        <div class="summary-card blue-light r-5">
                            <div class="summary-info">
                                <div class="summary-num">
                                    {{ $activeCount }}
                                </div>
                                <a href="{{ route('employers.jobs.index', ['type' => 'active-jobs']) }}"
                                    class="summary-text">Active Jobs</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="summary-card purple-light r-5">
                            <div class="summary-info">
                                <div class="summary-num">
                                    {{ $pendingCount }}
                                </div>
                                <a href="{{ route('employers.jobs.index', ['type' => 'pending-jobs']) }}"
                                    class="summary-text">Pending Jobs</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="summary-card orange-light r-5">
                            <div class="summary-info">
                                <div class="summary-num">
                                    {{ $draftCount }}
                                </div>
                                <a href="{{ route('employers.jobs.index', ['type' => 'drafted-jobs']) }}"
                                    class="summary-text">Draft Jobs</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="summary-card green-light r-5">

                            <div class="summary-info">
                                <div class="summary-num">
                                    {{ $expiredCount }}
                                </div>
                                <a href="{{ route('employers.jobs.index', ['type' => 'expired-jobs']) }}"
                                    class="summary-text">Expired Jobs</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="job-summary-tab">
                <ul class="new-3-nav nav nav-pills m-0 mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item pl-0" role="presentation">
                        <button class="nav-link active" id="pills-active-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-active" type="button" role="tab" aria-controls="pills-active"
                            aria-selected="true">Active Jobs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-pending-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-pending" type="button" role="tab" aria-controls="pills-pending"
                            aria-selected="false">Pending Jobs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-expired-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-expired" type="button" role="tab" aria-controls="pills-expired"
                            aria-selected="false">Expired
                            Jobs</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-active" role="tabpanel"
                        aria-labelledby="pills-active-tab">
                        <div class="table-responsive">
                            <table class="job-table">
                                <tr class="table-row">
                                    <th>Job Position</th>
                                    <th>Job Posting</th>
                                    <th>Job Type</th>
                                    <th>Job Level</th>
                                    <th>Job Seats</th>
                                    <th>Deadline</th>
                                    <th>Applied By</th>
                                    <th>Action</th>
                                </tr>
                                @forelse ($activeJobs as $activeJob)
                                    <tr class=" table-row">
                                        <td>
                                            <div class="job-detail">
                                                <div class="job-post">
                                                    {{ $activeJob->title }}
                                                </div>
                                                <div class="job-by">
                                                    {{ $activeJob->employer->company_name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-type">
                                                <span class="green-light">
                                                    {{ $activeJob->type == 'normal' ? 'Other' : Str::ucfirst($activeJob->type) }}
                                                    {{ $activeJob->type !== 'megajobs' ? 'Jobs' : '' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-type">
                                                <span class="green-light">Full Time</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-level">
                                                <span class="orange-light">{{ $activeJob->job_level->title }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $activeJob->no_of_opening }} seats
                                        </td>
                                        <td>
                                            <div class="deadline">
                                                <?php
                                                $currentDateTime = \Carbon\Carbon::now();
                                                $endDate = \Carbon\Carbon::parse($activeJob->expiry_date);
                                                $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                                    'parts' => 2,
                                                    'short' => false,
                                                    'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                                ]);
                                                ?>
                                                {{ $timeLeft }} Left
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            {{ count($activeJob->applied_users) }}
                                        </td>
                                        <td>
                                            <div class="job-detail">
                                                <button class="btn btn-secondary dropdown-toggle btnborder" type="button"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Action <i class="fa-solid fa-chevron-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('employers.jobs.edit', $activeJob->slug) }}">
                                                            <i class="fa-solid fa-file-pen"></i>
                                                            Edit Detail</a></li>
                                                    @if (request()->type == 'active-jobs' || request()->type == 'expired-jobs')
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('employers.jobs.viewApplied', $activeJob->slug) }}">
                                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                                View Detail</a></li>
                                                    @endif
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('employers.jobs.view', $activeJob->slug) }}"
                                                            target="_blank"> <i class="fa-solid fa-magnifying-glass"></i>
                                                            Preview Job</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="ConfirmDelete('{{ $activeJob->slug }}')"><i
                                                                class="fa-solid fa-trash-can"></i>
                                                            Delete Job </a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <td class="text-center p-3" colspan=7>
                                        <h4>No Expired Jobs</h4>
                                    </td>
                                @endforelse
                            </table>
                        </div>
                        <!-- <br> -->
                        <div class="text-center my-3">
                            <a href="{{ route('employers.jobs.index', ['type' => 'active-jobs']) }}" type="submit"
                                id="submit" class="btn btn-primary btn-hover">Explore All Jobs </a>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="pills-pending" role="tabpanel" aria-labelledby="pills-pending-tab">
                        <div class="table-responsive">
                            <table class="job-table">
                                <tr class="table-row">
                                    <th>Job Position</th>
                                    <th>Job Posting</th>
                                    <th>Job Type</th>
                                    <th>Job Level</th>
                                    <th>Job Seats</th>
                                    <th>Deadline</th>
                                    <th>Applied By</th>
                                    <th>Action</th>
                                </tr>
                                @forelse ($pendingJobs as $pendingJob)
                                    <tr class=" table-row">
                                        <td>
                                            <div class="job-detail">
                                                <div class="job-post">
                                                    {{ $pendingJob->title }}
                                                </div>
                                                <div class="job-by">
                                                    {{ $pendingJob->employer->company_name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-type">
                                                <span class="green-light">
                                                    {{ $pendingJob->type == 'normal' ? 'Other' : Str::ucfirst($pendingJob->type) }}
                                                    {{ $pendingJob->type !== 'megajobs' ? 'Jobs' : '' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-type">
                                                <span class="green-light">Full Time</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-level">
                                                <span class="orange-light">{{ $pendingJob->job_level->title }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $pendingJob->no_of_opening }} seats
                                        </td>
                                        <td>
                                            <div class="deadline">
                                                <?php
                                                $currentDateTime = \Carbon\Carbon::now();
                                                $endDate = \Carbon\Carbon::parse($pendingJob->expiry_date);
                                                $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                                    'parts' => 2,
                                                    'short' => false,
                                                    'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                                ]);
                                                ?>
                                                {{ $timeLeft }} Left
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            {{ count($pendingJob->applied_users) }}
                                        </td>
                                        <td>
                                            <div class="job-detail">
                                                <button class="btn btn-secondary dropdown-toggle btnborder" type="button"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Action <i class="fa-solid fa-chevron-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('employers.jobs.edit', $pendingJob->slug) }}">
                                                            <i class="fa-solid fa-file-pen"></i>
                                                            Edit Detail</a></li>
                                                    @if (request()->type == 'active-jobs' || request()->type == 'expired-jobs')
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('employers.jobs.viewApplied', $pendingJob->slug) }}">
                                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                                View Detail</a></li>
                                                    @endif
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('employers.jobs.view', $pendingJob->slug) }}"
                                                            target="_blank"> <i class="fa-solid fa-magnifying-glass"></i>
                                                            Preview Job</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="ConfirmDelete('{{ $pendingJob->slug }}')"><i
                                                                class="fa-solid fa-trash-can"></i>
                                                            Delete Job </a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <td class="text-center p-3" colspan=7>
                                        <h4>No Expired Jobs</h4>
                                    </td>
                                @endforelse
                            </table>
                        </div>
                        <!-- <br> -->
                        <div class="text-center my-3">
                            <a href="{{ route('employers.jobs.index', ['type' => 'pending-jobs']) }}" type="submit"
                                id="submit" class="btn btn-primary btn-hover">Explore All Jobs </a>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-expired" role="tabpanel" aria-labelledby="pills-expired-tab">
                        <div class="table-responsive">
                            <table class="job-table">
                                <tr class="table-row">
                                    <th>Job Position</th>
                                    <th>Job Posting</th>
                                    <th>Job Type</th>
                                    <th>Job Level</th>
                                    <th>Job Seats</th>
                                    <th>Deadline</th>
                                    <th>Applied By</th>
                                    <th>Action</th>
                                </tr>
                                @forelse ($expiredJobs as $expiredJob)
                                    <tr class=" table-row">
                                        <td>
                                            <div class="job-detail">
                                                <div class="job-post">
                                                    {{ $expiredJob->title }}
                                                </div>
                                                <div class="job-by">
                                                    {{ $expiredJob->employer->company_name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-type">
                                                <span class="green-light">
                                                    {{ $expiredJob->type == 'normal' ? 'Other' : Str::ucfirst($expiredJob->type) }}
                                                    {{ $expiredJob->type !== 'megajobs' ? 'Jobs' : '' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-type">
                                                <span class="green-light">Full Time</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-level">
                                                <span class="orange-light">{{ $expiredJob->job_level->title }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $expiredJob->no_of_opening }} seats
                                        </td>
                                        <td>
                                            <div class="deadline">
                                                <?php
                                                $currentDateTime = \Carbon\Carbon::now();
                                                $endDate = \Carbon\Carbon::parse($expiredJob->expiry_date);
                                                $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                                    'parts' => 2,
                                                    'short' => false,
                                                    'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                                ]);
                                                ?>
                                                {{ $timeLeft }} Left
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            {{ count($expiredJob->applied_users) }}
                                        </td>
                                        <td>
                                            <div class="job-detail">
                                                <button class="btn btn-secondary dropdown-toggle btnborder" type="button"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Action <i class="fa-solid fa-chevron-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('employers.jobs.edit', $expiredJob->slug) }}">
                                                            <i class="fa-solid fa-file-pen"></i>
                                                            Edit Detail</a></li>
                                                    @if (request()->type == 'active-jobs' || request()->type == 'expired-jobs')
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('employers.jobs.viewApplied', $expiredJob->slug) }}">
                                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                                View Detail</a></li>
                                                    @endif
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('employers.jobs.view', $expiredJob->slug) }}"
                                                            target="_blank"> <i class="fa-solid fa-magnifying-glass"></i>
                                                            Preview Job</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="ConfirmDelete('{{ $expiredJob->slug }}')"><i
                                                                class="fa-solid fa-trash-can"></i>
                                                            Delete Job </a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <td class="text-center p-3" colspan=7>
                                        <h4>No Expired Jobs</h4>
                                    </td>
                                @endforelse
                            </table>
                        </div>
                        <!-- <br> -->
                        <div class="text-center my-3">
                            <a href="{{ route('employers.jobs.index', ['type' => 'expired-jobs']) }}" type="submit"
                                id="submit" class="btn btn-primary btn-hover">Explore All Jobs </a>
                        </div>

                    </div>
                </div>
            </div>
        </div><!--end card-->
    </div><!--end col-->
@endsection
