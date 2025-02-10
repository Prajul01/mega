<?php
$title = ucwords(str_replace('-', ' ', request()->type));
$type = request()->type;
$allowed = ['active-jobs'];
if (in_array($type, $allowed)) {
    $allow = true;
} else {
    $allow = false;
}
?>
@extends('employer.overview-jobs.layouts.app')
@section('title', $title)
@section('dashboard_content')
    <div class="card candidate-info new-shadow-sidebar job-manage-section mt-4 mb-3 mt-lg-0">
        <div class="card-body p-3 px-0 pt-0">
            <div class="job-summary-tab mt-0">
                <ul class="new-column nav nav-pills new-3-nav mb-3 m-0" id="pills-tab" role="tablist">
                    <li class="nav-item pl-0" role="presentation">
                        <a href="{{ route('employers.jobs.index', ['type' => 'active-jobs']) }}"
                            class="nav-link {{ request()->type == 'active-jobs' ? 'active' : '' }}"><i
                                class="fa-regular fa-circle-check"></i>
                            Active Jobs ({{ $activeJobs }})</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('employers.jobs.index', ['type' => 'pending-jobs']) }}"
                            class="nav-link {{ request()->type == 'pending-jobs' ? 'active' : '' }}"><i
                                class="fa-solid fa-hourglass-half"></i>
                            Pending Jobs ({{ $pendingJobs }})</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('employers.jobs.index', ['type' => 'drafted-jobs']) }}"
                            class="nav-link {{ request()->type == 'drafted-jobs' ? 'active' : '' }}"><i
                                class="fa-solid fa-table-list"></i>
                            Drafted Jobs ({{ $draftedJobs }})</a>
                    </li>

                    <li class="nav-item pr-0" role="presentation">
                        <a href="{{ route('employers.jobs.index', ['type' => 'denied-jobs']) }}"
                            class="nav-link {{ request()->type == 'denied-jobs' ? 'active' : '' }}"><i
                                class="fa-regular fa-circle-xmark"></i> Denied Jobs
                            ({{ $deniedJobs }})</a>
                    </li>
                    <li class="nav-item pr-0" role="presentation">
                        <a href="{{ route('employers.jobs.index', ['type' => 'expired-jobs']) }}"
                            class="nav-link {{ request()->type == 'expired-jobs' ? 'active' : '' }}"><i
                                class="fa-solid fa-circle-exclamation"></i> Expired Jobs
                            ({{ $expiredJobs }})</a>
                    </li>

                </ul>
                <div class="tab-content  px-3" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                        aria-labelledby="pills-profile-tab">
                        <div class="personal-info-form">
                            <div class="card candidate-info shadow-sidebar mt-0 mb-3 mt-lg-0">
                                <div class="card-body p-0">
                                    <div class="job-summary-tab mt-0">
                                        <div class="table-responsive">
                                            <table class="job-table">
                                                <tr class="table-row">
                                                    <th>Job Position</th>
                                                    <th>Job Posting</th>
                                                    <th>Job Type</th>
                                                    <th>Job Level</th>
                                                    <th>Job Seats</th>
                                                    @if ($allow)
                                                        <th>Deadline</th>
                                                        <th>Applied By</th>
                                                    @endif
                                                    @if (request()->type == 'expired-jobs')
                                                        <th>Expires On</th>
                                                    @endif
                                                    @if (request()->type == 'denied-jobs')
                                                        <th>Reason for Disapproval</th>
                                                    @endif
                                                    <th>Action</th>
                                                </tr>
                                                @forelse ($jobs as $job)
                                                    <tr class="table-row">

                                                        <td>
                                                            <div class="job-detail">
                                                                <div class="job-post">
                                                                    {{ $job->title }}
                                                                </div>
                                                                <div class="job-by">
                                                                    {{ auth()->user()->employer->company_name }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="job-type">
                                                                <span class="green-light">
                                                                    {{ $job->type == 'normal' ? 'Other' : Str::ucfirst($job->type) }}
                                                                    {{ $job->type !== 'megajobs' ? 'Jobs' : '' }}
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="job-type">
                                                                <span
                                                                    class="green-light">{{ @$job->employee_type->title }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="job-level">
                                                                <span
                                                                    class="orange-light">{{ $job->job_level->title }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ $job->no_of_opening }} seats
                                                        </td>
                                                        @if ($allow)
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
                                                                {{ $job->applied_users->count() }}
                                                            </td>
                                                        @endif
                                                        @if (request()->type == 'expired-jobs')
                                                            <td>{{ date('d M, Y', strtotime($job->expiry_date)) }}</td>
                                                        @endif
                                                        @if (request()->type == 'denied-jobs')
                                                            <td><a href="#"
                                                                    onclick="message(`{!! $job->declined_reason !!}`)">
                                                                    {{ Str::limit($job->declined_reason, 20) }}</a></td>
                                                        @endif
                                                        <td>
                                                            <div class="job-detail">
                                                                <button class="btn btn-secondary dropdown-toggle btnborder"
                                                                    type="button" id="dropdownMenuButton1"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Action <i class="fa-solid fa-chevron-down"></i>
                                                                </button>
                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuButton1">
                                                                    <li><a class="dropdown-item"
                                                                            href="{{ route('employers.jobs.edit', $job->slug) }}">
                                                                            <i class="fa-solid fa-file-pen"></i>
                                                                            Edit Detail</a></li>
                                                                    @if (request()->type == 'active-jobs' || request()->type == 'expired-jobs')
                                                                        <li><a class="dropdown-item"
                                                                                href="{{ route('employers.jobs.viewApplied', $job->slug) }}">
                                                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                                                View Detail</a></li>
                                                                    @endif
                                                                    <li><a class="dropdown-item"
                                                                            href="{{ route('employers.jobs.view', $job->slug) }}"
                                                                            target="_blank"> <i
                                                                                class="fa-solid fa-magnifying-glass"></i>
                                                                            Preview Job</a></li>
                                                                    <li><a class="dropdown-item" href="#"
                                                                            onclick="ConfirmDelete('{{ $job->slug }}')"><i
                                                                                class="fa-solid fa-trash-can"></i>
                                                                            Delete Job </a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr class="table-row">
                                                        <td>
                                                            <h5>No {{ strtolower($title) }} to show</h5>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>
                                </div><!--end card-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (request()->type == 'denied-jobs')
        <div class="modal fade" id="showMessage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Reason For Disapproval</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="reasonForDisaaproval">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('script')
    <script>
        function message(data) {
            $('#reasonForDisaaproval').append(data);
            $('#showMessage').modal('show');
        }

        function ConfirmDelete(slug) {
            swal({
                title: "Are you sure?",
                text: "You will deleteing this post from the system",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        method: 'POST',
                        url: "{{ route('employers.jobs.delete') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            slug: slug,
                        },
                        success: function(res) {
                            status = res.status;
                            message = res.message;

                            if (status == 200) {
                                swal({
                                    title: "Deleted",
                                    text: message,
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#28a745",
                                    confirmButtonText: "Okay",
                                    closeOnConfirm: false,
                                    closeOnCancel: false
                                }, function(isConfirm) {
                                    if (isConfirm) {
                                        window.reload();
                                    }
                                });
                            } else {
                                swal("Error", status + ' : ' + message, "error");
                            }
                        },
                        error: function(data) {
                            alert(data.responsetxt);
                        }
                    })
                } else {
                    swal("Cancelled", "Your post is safe :)", "error");
                }
            });
        }
    </script>
@endpush
