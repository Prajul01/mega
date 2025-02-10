@extends('admin.layouts.app')
@section('title', 'Employer Management')
@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
@endpush
@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.jobPosting.postJobs', str_replace(' ', '-', strtolower($type))) }}" method="POST">
            @csrf
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12">
                        <h1>{{ $type }}</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Job Posting Management</li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $type }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col my-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9 d-flex">
                                        <?php
                                        $bulkOptions = ['megajobs', 'premium jobs', 'general jobs', 'Latest Jobs'];
                                        ?>
                                        <select class="form-control" name="action" style="width:25%;" required>
                                            <option selected disabled>--Select Action--</option>
                                            <option value="remove">Remove From {{ $type }}</option>
                                            @foreach ($bulkOptions as $option)
                                                @if (strtolower($type) != $option)
                                                    <option value="{{ $option }}">Post to {{ ucwords($option) }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <button class="btn btn-secondary" name="action_from" value="bulk">
                                            Apply
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary adder" style="float:right;"><i
                                                class="fa fa-plus"></i>&nbsp;Post Job as
                                            {{ $type }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead data-test="datatable-head">
                                        <tr>
                                            <th></th>
                                            <th class="sorting">#</th>
                                            <th class="sorting" aria-controls="DataTable" aria-label="Name">Title
                                            </th>
                                            <th class="sorting">Company Name</th>
                                            <th class="sorting">Office Number</th>
                                            <th>No. of Opening</th>
                                            <th class="sorting">Created At</th>
                                            <th class="sorting">Status</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody data-test="table-body">
                                        @foreach ($jobs as $chunked)
                                            @foreach ($chunked as $key => $job)
                                                <tr>
                                                    <td><input class="form-cotrol" type="checkbox" name="job_slug[]"
                                                            value="{{ $job->slug }}"></td>
                                                    <td>{{ ++$key }}</td>
                                                    <td><span title="{{ $job->title }}"
                                                            style="cursor:pointer;">{{ Str::limit($job->title, 28, '...') }}</span>
                                                    </td>
                                                    <td>{{ $job->employer->company_name }}</td>
                                                    <td>{{ $job->employer->office_number }}</td>
                                                    <td class="text-center">{{ $job->no_of_opening }}</td>
                                                    <td>{{ date('Y-m-d', strtotime($job->created_at)) }}</td>
                                                    <td><span
                                                            class="badge badge-{{ $job->approval == 'approved' ? 'success' : ($job->approval == 'pending' ? 'primary' : 'danger') }}">{{ $job->approval }}</span>
                                                    </td>
                                                    <td class="d-flex">
                                                        <a href="{{ route('admin.jobRequest.show', $job->slug) }}"
                                                            target="_blank" class="btn btn-outline-primary mx-1">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        @if (strtolower($type) != 'Latest Jobs')
                                                            <button class="btn btn-outline-danger" name="job_slug"
                                                                value="{{ $job->slug }}"><i
                                                                    class="fa fa-times"></i></button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="post_to" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Declined Message</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.jobPosting.postJobs', str_replace(' ', '-', strtolower($type))) }}"
                        method="POST" id="postingForm">
                        @csrf
                        <div class="table-responsive">
                            <table id="otherTable" class="table table-striped table-bordered">
                                <thead data-test="datatable-head">
                                    <tr>
                                        <th></th>
                                        <th class="sorting">#</th>
                                        <th class="sorting" aria-controls="DataTable" aria-label="Name">Title
                                        </th>
                                        <th class="sorting">Company Name</th>
                                        <th class="sorting">Created At</th>
                                        <th class="sorting">Status</th>
                                        <th class="">Action</th>
                                    </tr>
                                </thead>
                                <tbody data-test="table-body">
                                    @foreach ($otherJobs as $chunked)
                                        @foreach ($chunked as $key => $job)
                                            <tr>
                                                <td><input class="form-cotrol" type="checkbox" name="job_slug[]"
                                                        value="{{ $job->slug }}"></td>
                                                <td>{{ ++$key }}</td>
                                                <td><span title="{{ $job->title }}"
                                                        style="cursor:pointer;">{{ Str::limit($job->title, 28, '...') }}</span>
                                                </td>
                                                <td>{{ $job->employer->company_name }}</td>
                                                <td>{{ date('Y-m-d', strtotime($job->created_at)) }}</td>
                                                <td><span
                                                        class="badge badge-{{ $job->approval == 'approved' ? 'success' : ($job->approval == 'pending' ? 'primary' : 'danger') }}">{{ $job->approval }}</span>
                                                </td>
                                                <td class="d-flex">
                                                    <a href="{{ route('admin.jobRequest.show', $job->slug) }}"
                                                        target="_blank" class="btn btn-outline-primary mx-1">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <button class="btn btn-outline-success mx-1" name="job_slug"
                                                        value="{{ $job->slug }}">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success mx-2" onclick="confirmToAdd('{{ $type }}')"><i
                            class="fa fa-plus"></i>Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script>
        new DataTable('#datatable');
        new DataTable('#otherTable');


        $('.adder').click(function() {
            $('#post_to').modal('show');
        });

        function confirmToAdd(status) {


            swal({
                title: "Are you sure?",
                text: "The job will be posted to " + status,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes, post it!",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $('#postingForm').submit();
                } else {
                    swal("Cancelled", "Process has been canceled", "error");
                }
            });
        }

        function verifycOnfirm(data, status) {
            swal({
                title: "Are you sure?",
                text: "This will change the status to " + status,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes, " + status + " it!",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    swal({
                        title: status.toUpperCase(),
                        text: "This user is now " + status,
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#28a745",
                        confirmButtonText: "Okay",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    });
                    $(data).closest('form').submit();
                } else {
                    swal("Cancelled", "Process has been canceled", "error");
                }
            });
        }

        function COnfirmDelete(elem) {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this User!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    jQuery(elem).closest("form").submit();

                    swal("Deleted!", "Your User has been deleted.", "success");
                } else {
                    swal("Cancelled", "Your User is safe :)", "error");
                }
            });
        }
    </script>
@endpush
