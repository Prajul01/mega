@extends('employer.overview-jobs.layouts.app')
@section('title', 'Applicants in ' . $job->title)
@section('dashboard_content')
    <div class="card candidate-info shadow-sidebar mt-0 mb-3 mt-lg-0">
        <div class="card-body p-0">
            <form action="{{ route('employers.jobs.viewApplied', $job->slug) }}" method="GET" id="filterForm">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <?php
                        $filters = ['all', 'accepted', 'declined', 'pending'];
                        
                        if (request()->filter) {
                            $query = request()->filter;
                        }
                        
                        ?>
                        <div class="row m-2">
                            <div class="col-md-8">
                                <select class="form-control" name="filter" required>
                                    <option disabled>--Filter--</option>
                                    @foreach ($filters as $filter)
                                        <option value="{{ $filter }}"
                                            {{ isset($query) ? ($filter == $query ? 'selected' : '') : '' }}>
                                            {{ Str::ucfirst($filter) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-danger" onclick="dataFilter()"><span
                                        style="display:flex"><i class="fa fa-filter"></i>&nbsp;Filter</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form action="{{ route('employers.sendBulkEmail', $job->slug) }}" method="post" id="formId">
                @csrf
                <div class="employer-job-heading">
                    <div class="title-employer-single">
                        {{ $job->title }}
                    </div>
                    <div class="deadline-employer-single">
                        {{ date('d-m-Y', strtotime($job->created_at)) }}
                    </div><br>
                    <div class="deadline-employer-single" style="display:flex;">
                        <select class="form-control" name="status" required>
                            <option selected disabled>Bulk Actions</option>
                            <option value="accept">Accept Selected</option>
                            <option value="decline">Reject Selected</option>
                        </select>
                        <button type="button" class="btn btn-danger mx-1" onclick="ConfirmationAction()">Apply</button>
                    </div>
                </div>
                <div class="job-summary-tab mt-0">
                    <div class="table-responsive">
                        <table class="job-table">
                            <tr class="table-row">
                                <th></th>
                                <th>Name</th>
                                <th>Highest Edu</th>
                                <th>Mobile number</th>
                                <th>Email</th>
                                {{-- <th>Experience</th> --}}
                                <th>Applied On</th>
                                <th>Action</th>
                                @if ($job->cover_letter)
                                    <th>C.L</th>
                                @endif
                                <th>CV</th>
                            </tr>
                            @if (count($users) > 0)
                                @foreach ($users as $key => $user)
                                    <?php
                                    $user_status = $user->applied_job_status($job->id, $user->id);
                                    ?>
                                    <tr class="table-row">
                                        <td>
                                            @if ($user_status == 'N/A')
                                                <input type="checkbox" name="users[]" id="user-select"
                                                    value="{{ $user->id }}">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="user-name">
                                                <a href="{{ route('employers.viewUser', [$job->slug, $user->username]) }}" target="_blank">
                                                    {{ $user->job_seeker->first_name }}
                                                    {{ $user->job_seeker->middle_name ?? $user->job_seeker->middle_name . ' ' }}{{ $user->job_seeker->last_name }}
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="edu">
                                                {{ $user->highest_education() }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="address">
                                                {{ $user->job_seeker->mobile_number }}
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ $user->email ?? null }}">{{ $user->email ?? null }}</a>
                                        </td>
                                        {{-- <td>
                                            3 years
                                        </td> --}}
                                        @php
                                            $applied_job_user_detail = $user->applied_job_user_detail($job->id, $user->id);
                                        @endphp
                                        <td>
                                            <div class="deadline">
                                                {{ date('Y-m-d', strtotime($applied_job_user_detail->created_at)) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-detail" id="x-{{ $key }}">
                                                @if ($user_status == 'accept')
                                                    <button type="button" class="btn btn-border" disabled>
                                                        Accepted
                                                    </button>
                                                @elseif($user_status == 'decline')
                                                    <button type="button" class="btn btn-border btn-outline-danger"
                                                        disabled>
                                                        Declined
                                                    </button>
                                                @elseif($user_status == 'N/A')
                                                    <button type="button" class="btn btn-border"
                                                        onclick="ConfirmationAction(1,'{{ $key }}','{{ $user->id }}')">
                                                        Accept
                                                    </button>
                                                    <button type="button" class="btn btn-border btn-outline-danger"
                                                        onclick="ConfirmationAction(0, '{{ $key }}','{{ $user->id }}')">
                                                        Decline
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                        @if ($job->cover_letter)
                                            <td>
                                                <a download="{{ $applied_job_user_detail->cover_letter }}"
                                                    href="{{ asset('storage/job-seeker/cover_letters/' . $applied_job_user_detail->cover_letter) }}"><i
                                                        class="fa-solid fa-download"></i></a>
                                            </td>
                                        @endif

                                        <td>
                                            <span class="icon">
                                                <a href="{{ route('employers.downloadCV', [$user->username, $job->slug]) }}"><i
                                                        class="fa-solid fa-download"></i></a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="8" class="text-center" style="height:100px"><strong>
                                        <h4>There are no applicants</h4>
                                    </strong></td>
                            @endif
                        </table>
                    </div>
                </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    <div class="modal fade" tabindex="-1" id="email-message">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Email Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="user" />
                    <input type="hidden" id="status" />
                    <label>Type Your message to send to the applicants</label>
                    <textarea class="form-control" name="message" style="height:200px" id="message">{{ old('message') ?? old('message') }}</textarea>
                    <span class="text-danger" id="error"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="send-button" data-id=''
                        onclick="send(this)">Send</button>
                </div>
            </div>
        </div>
    </div>

    </form>
    <script>
        function dataFilter() {
            $('#filterForm').submit();
        }

        function ConfirmationAction($status = '', $key = null, $id = null) {
            swal({
                title: "Are you sure?",
                text: "You will changing this post's status",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    if ($key == null && $id == null) {
                        $('#email-message').modal('show');
                    } else {
                        $('#status').val($status);
                        $('#user').val($id);
                        $('#send-button').attr('data-id', $key);
                        $('#email-message').modal('show');
                    }
                }
            })
        }

        function send(data) {
            swal({
                title: "Are you sure?",
                text: "You will be sending mail to the respective applicant",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    message = $('textarea').val();
                    // if (message == null || message == '') {
                    //     $('textarea').css('border-color', 'red');
                    //     $('#error').html('Message is required');
                    // } else {
                    user_id = $('#user').val();
                    status = $('#status').val();
                    if ((user_id == '' || user_id == null) && (status == '' || status == null)) {
                        bulk_status = $("[name = 'status']").val();
                        if (bulk_status == null) {
                            $('#email-message').modal('hide');
                            toastr.error('select bulk action');
                        } else {
                            $('#formId').submit();
                        }
                    } else {
                        row = $(data).attr('data-id');
                        div_previous_value = $('#x-' + row).find('button');
                        $('#x-' + row).find('button').remove();
                        $('#x-' + row).append(
                            '<button type="button" class="btn btn-border"><i class="fa-solid fa-spinner fa-spin"></i></button>'
                        );

                        $.ajax({
                            url: "{{ route('employers.sendEmail') }}",
                            method: "POST",

                            data: {
                                _token: '{{ csrf_token() }}',
                                user_id: user_id,
                                job_id: '{{ $job->id }}',
                                status: status,
                                message: $("[name = 'message']").val()
                            },
                            success: function(res) {
                                status = res.status;
                                message = res.message;

                                if (status == 200) {
                                    if (res.bool == 1) {
                                        $class = 'btn btn-border'
                                        $bool = 'Accepted';
                                    } else {
                                        $class = 'btn btn-border btn-outline-danger'
                                        $bool = 'Declined';
                                    }
                                    $('#x-' + row).find('button').remove();
                                    $('#x-' + row).append('<button type="button" class="' + $class +
                                        '">' + $bool + '</button>')

                                    $('#email-message').modal('hide');
                                    toastr.success(message);
                                    $('input').val('');
                                    $('textarea').val('');
                                } else {
                                    toastr.error(status + ' : ' + message);
                                }
                            },
                            error: function(response) {
                                revertBack(row);
                                if (response.status === 422) {
                                    var errors = response.responseJSON.errors;
                                    Object.keys(errors).forEach(function(field) {
                                        toastr.error(errors[field][0]);
                                    });
                                } else {
                                    alert('The error is =>\n' + response.responseText);

                                }
                            }
                        });
                    }
                    // }
                } else {
                    revertBack(row);
                }
            });
        }

        function revertBack(row) {
            $('#x-' + row).find('button').remove();
            $('#x-' + row).append(div_previous_value);
        }
    </script>
@endsection
@push('script')
@endpush
