@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/sweetalert/sweetalert.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/sweetalert/sweetalert.css') }}" />
@endpush

<div class="card">
    <div class="table-responsive">
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr>
                        <th scope="row">{{ ++$key }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><span class="badge badge-success">{{ $user->getRoleNames()[0] }}</span></td>
                        <td>{{ date('d M, Y', strtotime($user->created_at)) }}</td>
                        <td>
                            <span class="badge badge-{{ !$user->suspended ? 'success' : 'danger' }}">
                                {{ !$user->suspended ? 'Active' : 'Suspended' }}
                            </span>
                        </td>
                        <td style="display:flex;">
                            <a href="{{ route('admin.adminUsers.edit', base64_encode($user->id)) }}"
                                class="btn btn-outline-warning mr-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            @can('user-edit')
                                @if (auth()->user()->id != $user->id)
                                    <form action="{{ route('admin.adminUsers.suspend', base64_encode($user->id)) }}"
                                        method="post" id="suspendForm">
                                        @csrf
                                        <a href="#"
                                            class="btn btn-{{ !$user->suspended ? 'danger' : 'success' }} mr-1"
                                            onclick="COnfirmSuspend()"><i
                                                class="fa fa-user-{{ !$user->suspended ? 'times' : 'plus' }}"></i></a>
                                    </form>
                                @endif
                            @endcan
                            @can('user-delete')
                                <form action="{{ route('admin.adminUsers.destroy', base64_encode($user->id)) }}"
                                    method="post" id="deleteForm">
                                    @csrf
                                    @method('delete')
                                    <a href="#" class="btn btn-outline-danger" onclick="COnfirmDelete()"><i
                                            class="fa fa-trash"></i></a>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        {{-- {{ $users->links('pagination::bootstrap-4') s}} --}}
    </div>
</div>

@push('script')
    <script src="{{ asset('backend/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script>
        new DataTable('#datatable');

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
                    $('#deleteForm').submit();
                    swal("Deleted!", "User has been deleted.", "success");
                } else {
                    swal("Cancelled", "User is safe :)", "error");
                }
            });
        }

        function COnfirmSuspend(elem) {
            swal({
                title: "Are you sure?",
                text: "You will be suspending this user",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $('#suspendForm').submit();
                    swal("Success!", "User status has been changed", "success");
                } else {
                    swal("Cancelled", "User status has not been changed", "error");
                }
            });
        }
    </script>
@endpush
