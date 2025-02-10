@extends('admin.layouts.app')
@section('title', 'Roles & Permission Management')
@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
    <style>
        .wrapper .page-wrap .main-content .page-header .page-header-title i {
            width: 50px !important;
            height: 50px !important;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Roles & Permission Management</h1>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Role Management</li>
                        </ol>
                    </nav>
                </div>
                @can('user-create')
                    <div class="col">
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary" style="float:right;"><i
                                class="fa fa-plus"></i>&nbsp;Add Role</a>
                    </div>
                @endcan
            </div>
        </div>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive p-3">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Permission Assigned</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $role->name }}</td>
                                                <td class="col">
                                                    <div class="d-flex flex-wrap">
                                                        @foreach ($role->permissions as $permission)
                                                            <small
                                                                class="badge badge-secondary mb-1">{{ $permission->name }}</small>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="col">
                                                    <div class="list-actions">
                                                        @can('role-list')
                                                            <a href="{{ route('admin.roles.show', $role->id) }}"
                                                                class="btn btn-icon btn-primary"><i class="fa fa-eye"></i></a>
                                                        @endcan
                                                        @can('role-edit')
                                                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                                class="btn btn-icon btn-info"><i class="fa fa-edit"></i></a>
                                                        @endcan
                                                        @can('role-delete')
                                                            <a href="#delete" data-toggle="modal"
                                                                class="btn btn-icon btn-danger"
                                                                onclick="delete_role('{{ base64_encode($role->id) }}')"><i
                                                                    class="fa fa-trash"></i></a>
                                                        @endcan
                                                    </div>
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

        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Delete Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-white">
                        <p>Are you Sure...!!</p>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                        <a href="" class="btn btn-round btn-primary">Delete</a>
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
            (function($) {
                'use strict';
                $(document).ready(function() {
                    var dTable = $('#myAdvancedTable').DataTable({

                        order: [],
                        lengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                        ],
                        responsive: false,
                        scroller: {
                            loadingIndicator: false
                        },
                        pagingType: "full_numbers",
                        dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
                        buttons: [{
                                extend: 'copy',
                                className: 'btn-sm btn-info',
                                title: 'Permissions',
                                header: false,
                                footer: true,
                                exportOptions: {
                                    // columns: ':visible'
                                }
                            },
                            {
                                extend: 'csv',
                                className: 'btn-sm btn-success',
                                title: 'Permissions',
                                header: false,
                                footer: true,
                                exportOptions: {
                                    // columns: ':visible'
                                }
                            },
                            {
                                extend: 'excel',
                                className: 'btn-sm btn-warning',
                                title: 'Permissions',
                                header: false,
                                footer: true,
                                exportOptions: {
                                    // columns: ':visible',
                                }
                            },
                            {
                                extend: 'pdf',
                                className: 'btn-sm btn-primary',
                                title: 'Permissions',
                                pageSize: 'A2',
                                header: false,
                                footer: true,
                                exportOptions: {
                                    // columns: ':visible'
                                }
                            },
                            {
                                extend: 'print',
                                className: 'btn-sm btn-default',
                                title: 'Permissions',
                                // orientation:'landscape',
                                pageSize: 'A2',
                                header: true,
                                footer: false,
                                orientation: 'landscape',
                                exportOptions: {
                                    // columns: ':visible',
                                    stripHtml: false
                                }
                            }
                        ]
                    });

                });

            })(jQuery);
        </script>
        <script>
            function delete_role(id) {
                console.log('im here');
                var conn = './role/delete/' + id;
                $('#delete a').attr("href", conn);
            }
        </script>
    @endpush
