@extends('admin.layouts.app')
@section('title', 'Employer Management')
@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    @if (request()->routeIs('admin.admins.index'))
                        <h1>Admin Management</h1>
                    @else
                        <h1>User Management</h1>
                    @endif
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Employer Management</li>
                        </ol>
                    </nav>
                </div>
                @can('user-create')
                    <div class="col">
                        <a href="{{ route('admin.employers.create') }}" class="btn btn-primary" style="float:right;"><i
                                class="fa fa-plus"></i>&nbsp;Create Employer</a>
                    </div>
                @endcan
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
                                    <th class="sorting" aria-controls="DataTable" aria-label="Name">Name
                                    </th>
                                    <th class="sorting">Company Name</th>
                                    <th class="sorting">Username</th>
                                    <th>Office Number</th>
                                    <th class="sorting">Created At</th>
                                    <th class="sorting">Status</th>
                                    <th class="">Action</th>
                                </tr>
                                </thead>
                                <tbody data-test="table-body">
                                    <?php $i = 0; ?>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td></td>
{{--                                        <td>{{ $user->username }}</td>--}}
                                        <td>phne no</td>
{{--                                        <td>{{ date('d M, Y', strtotime($user->created_at)) }}</td>--}}
                                        <td><spazn
                                                class="badge badge-{{ $user->suspended ? 'danger' : 'success' }}">{{ $user->suspended ? 'Suspended' : 'Active' }}</spazn>
                                        </td>
{{--                                        <td class="d-flex">--}}
{{--                                            @can('user-edit')--}}
{{--                                                <form action="{{ route('admin.employers.suspended', $user->id) }}"--}}
{{--                                                      method="POST">--}}
{{--                                                    @csrf--}}
{{--                                                    <button type="button"--}}
{{--                                                            class="btn btn-{{ $user->suspended ? 'success' : 'danger' }}"--}}
{{--                                                            name="suspended"--}}
{{--                                                            onclick="verifycOnfirm(this, '{{ $user->suspended == 1 ? 'active' : 'suspend' }}')">--}}
{{--                                                        <i class="fa fa-user-times"></i>--}}
{{--                                                    </button>--}}
{{--                                                </form>&nbsp;--}}
{{--                                                <a href="{{ route('admin.employers.edit', $user->username) }}"--}}
{{--                                                   class="btn btn-outline-warning" title="Edit"><i--}}
{{--                                                        class="fa fa-edit"></i></a>&nbsp;--}}
{{--                                            @endcan--}}
{{--                                            @can('user-delete')--}}
{{--                                                <form--}}
{{--                                                    action="{{ route('admin.employers.delete', base64_encode($user->id)) }}"--}}
{{--                                                    method="POST">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    <button type="button" onclick="COnfirmDelete(this)"--}}
{{--                                                            class="btn btn-outline-danger">--}}
{{--                                                        <i class="fa fa-trash"></i></button>--}}
{{--                                                </form>--}}
{{--                                            @endcan--}}
{{--                                        </td>--}}
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
