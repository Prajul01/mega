@extends('admin.layouts.app')
@section('title', 'Report Issued Management')
@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Report Issued Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Report Issued Management</li>
                        </ol>
                    </nav>
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
                                        <th class="sorting">#</th>
                                        <th >Subject</th>
                                        <th class="sorting">Name</th>
                                        <th>Email</th>
                                        <th>Phone No.</th>
                                        <th>Read Status</th>
                                        <th class="sorting">Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody data-test="table-body">
                                    @foreach ($reports as $key => $report)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $report->subject }}</td>
                                            <td>{{ $report->name }}</td>
                                            <td>{{ $report->email }}</td>
                                            <td>{{ $report->phone_no }}</td>
                                            <td><span class="badge badge-{{ $report->read? 'success': 'danger' }}">{{ $report->read? 'Read': 'Not Read' }}</span></td>
                                            <td>{{ date('d M, Y', strtotime($report->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('admin.reports.show', base64_encode($report->id)) }}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
