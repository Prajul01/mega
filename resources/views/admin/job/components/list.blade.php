@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/nestable/jquery-nestable.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/sweetalert/sweetalert.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
@endpush
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered">
                <thead data-test="datatable-head">
                    <tr>
                        <th class="sorting">#</th>
                        <th class="sorting" aria-controls="DataTable" aria-label="Title">Job</th>
                        <th class="sorting">Company Name</th>
                        <th>Office Number</th>
                        <th class="sorting">Status</th>
                        <th class="sorting">No. of Applicant</th>
                        <th class="sorting">Posting time</th>
                        <th class="sorting">Created At</th>
                        <th class="">Action</th>
                    </tr>
                </thead>
                <tbody data-test="table-body">
                    <?php $i = 0; ?>
                    @foreach ($jobs as $key => $job)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td> @can('employer-list')
                                    <a href="{{ route('admin.job.appliedUsers.index', $job->slug) }}"style="font-weight:bolder;"
                                        target="_blank">
                                    @endcan {{ $job->title }}
                                    @can('employer-list')
                                    </a>
                                @endcan
                            </td>
                            <td>{{ $job->employer->company_name }}</td>
                            <td>{{ $job->employer->office_number }}</td>
                            <td>
                                <span
                                    class="{{ $job->status == 'active' ? 'badge badge-primary' : 'badge badge-danger' }}">{{ $job->status == 'active' ? 'Displayed' : 'Not Display' }}</span>
                            </td>
                            <td class="text-center">
                                @can('employer-list')
                                    <a href="{{ route('admin.job.appliedUsers.index', $job->slug) }}"style="font-weight:bolder;"
                                        target="_blank">
                                    @endcan {{ $job->applied_users->count() }}
                                    @can('employer-list')
                                    </a>
                                @endcan
                            </td>
                            <td>{{ date('d M, y', strtotime($job->start_date)) . ' - ' . date('d M, Y', strtotime($job->expiry_date)) }}
                            </td>
                            <td>{{ date('d M, Y', strtotime($job->created_at)) }}</td>
                            <td class="d-flex">
                                @can('employer-edit')
                                    <a href="{{ route('admin.job.edit', base64_encode($job->id)) }}"
                                        class="btn btn-sm btn-outline-info" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan
                                @can('employer-delete')
                                    &nbsp;
                                    <button type="button" onclick="COnfirmDelete('{{ $job->id }}')"
                                        data-id="{{ $job->id }}" class="btn btn-sm btn-outline-danger">
                                        <i class="fa fa-trash"></i></button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('script')
    <script src="{{ asset('backend/assets/vendor/nestable/jquery.nestable.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend/vendor/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        new DataTable('#datatable');
    </script>
    <script>
        function COnfirmDelete(elem) {
            var id = elem;
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        method: "POST",
                        url: '{{ route('admin.job.destroy') }}',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'id': id
                        },
                        success: function(res) {
                            swal({
                                title: "Deleted",
                                text: "job has been deleted!",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#28a745",
                                confirmButtonText: "Okay",
                                closeOnConfirm: false,
                                closeOnCancel: false
                            }, function(isConfirm) {
                                if (isConfirm) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(data) {
                            // toastr.error("Sorry Something Went Wrong!!");
                        }

                    })
                } else {
                    swal("Cancelled", "Your job is safe :)", "error");
                }
            });
        }
    </script>
@endpush
