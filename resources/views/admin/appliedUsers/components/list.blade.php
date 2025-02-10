@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/sweetalert/sweetalert.css') }}" />
@endpush

<div class="card">
    <div class="table-responsive">
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    @if (@$users)
                        <th scope="col">Name</th>
                    @endif
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    @if (@$users)
                        <th scope="col">Contact</th>
                    @endif
                    <th>Applied On</th>
                     @if ($job->cover_letter)
                                    <th>C.L</th>
                                @endif
                              {{--   <th>CV</th> --}}
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (@$users)
                    @if (count(@$users) == 0)
                        <td colspan="7">
                            <div class="card">
                                <div class="card-body text-center">
                                    No Data Found
                                </div>
                            </div>
                        </td>
                    @endif
                    @foreach ($users as $key => $user)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->job_seeker->mobile_number }}</td>
                            @php
                                            $applied_job_user_detail = $user->applied_job_user_detail($job->id, $user->id);
                                        @endphp
                                        <td>
                                             {{ date('Y-m-d', strtotime($applied_job_user_detail->created_at)) }}
                                        </td>
                                        @if ($job->cover_letter)
                                            <td>
                                                <a download="{{ $applied_job_user_detail->cover_letter }}"
                                                    href="{{ asset('storage/job-seeker/cover_letters/' . $applied_job_user_detail->cover_letter) }}"><i
                                                        class="fa fa-download"></i></a>
                                            </td>
                                        @endif

                                       {{-- <td>
                                            <span class="icon">
                                                <a href="{{ route('employers.downloadCV', [$user->username, $job->slug]) }}"><i
                                                        class="fa fa-download"></i></a>
                                            </span>
                                        </td>--}}
                            <td style="display:flex;">
                                @can('user-edit')
                                   
                                    <a href="{{ route('admin.users.show', $user->username) }}"
                                        class="btn btn-outline-primary mx-1"><i class="fa fa-eye"></i></a>
                                @endcan
                               
                            </td>
                        </tr>
                    @endforeach
                @else
                    @if (@$unverified_users)
                        @foreach ($unverified_users as $key => $user)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ date('d M, Y', strtotime($user->created_at)) }}</td>
                                <td>
                                    <span class="badge badge-{{ !$user->suspended ? 'success' : 'danger' }}">
                                        {{ !$user->suspended ? 'Active' : 'Suspended' }}
                                    </span>
                                </td>
                                <td style="display:flex;">
                                    @can('user-edit')
                                        <form action="{{ route('admin.users.suspend', $user->username) }}" method="post"
                                            id="suspendForm">
                                            @csrf
                                            <a href="#"
                                                class="btn btn-{{ !$user->suspended ? 'danger' : 'success' }} mr-1"
                                                onclick="COnfirmSuspend()"><i
                                                    class="fa fa-user-{{ !$user->suspended ? 'times' : 'plus' }}"></i></a>
                                        </form>
                                    @endcan
                                    @can('user-delete')
                                        <form action="{{ route('admin.users.destroy', base64_encode($user->id)) }}"
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
                    @endif
                @endif

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
