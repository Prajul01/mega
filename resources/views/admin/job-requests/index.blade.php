@extends('admin.layouts.app')
@section('title', 'Job Requests')
@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Job Requests</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Job Requests</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="col-md-12 my-3 mx-0">
                            @if (!is_null(request()->jobs))
                                <a href="{{ route('admin.jobRequest.index') }}" class="btn btn-primary"><i
                                        class="fa fa-hourglass-end"></i>&nbsp;&nbsp;Pending Jobs For Approval</a>
                            @endif

                            @if (request()->jobs != 'approved-jobs')
                                <a href="{{ route('admin.jobRequest.index', ['jobs' => 'approved-jobs']) }}"
                                    class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Approved Jobs</a>
                            @endif

                            @if (request()->jobs != 'declined-jobs')
                                <a href="{{ route('admin.jobRequest.index', ['jobs' => 'declined-jobs']) }}"
                                    class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Declined Jobs</a>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead data-test="datatable-head">
                                    <tr>
                                        <th class="sorting">#</th>
                                        <th class="sorting" aria-controls="DataTable" aria-label="Name">Title
                                        </th>
                                        <th class="sorting">Company Name</th>
                                        <th class="sorting">Office Number</th>
                                        <th>No. of Opening</th>
                                        <th class="sorting">Created At</th>
                                        <th class="sorting">Status</th>
                                        <th class="sorting">Job Type</th>
                                        <th class="">Action</th>
                                    </tr>
                                </thead>
                                <tbody data-test="table-body">
                                    @foreach ($jobs as $key => $job)
                                        <tr>
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
                                            <td><span class="badge badge-success">
                                                    @if ($job->type == 'prime')
                                                        Prime Job
                                                    @elseif($job->type == 'mega')
                                                        Megajob
                                                    @elseif($job->type == 'premium')
                                                        Premium Job
                                                    @else
                                                        Latest Job
                                                    @endif
                                                </span></td>
                                            <td class="d-flex">
                                                <a href="{{ route('admin.jobRequest.show', $job->slug) }}" target="_blank"
                                                    class="btn btn-outline-primary mx-1"><i class="fa fa-eye"></i></a>
                                                @if ($job->approval != 'approved')
                                                    <button type="button" value="approved" title="Approve"
                                                        data-id="{{ $job->slug }}"
                                                        class="btn job-settings btn-success mx-1"><i
                                                            class="fa fa-check"></i></button>
                                                @endif
                                                @if ($job->approval != 'declined')
                                                    <button type="button" value="declined" title="Decline"
                                                        data-id="{{ $job->slug }}"
                                                        class="btn btn-danger job-settings mx-1"><i
                                                            class="fa fa-times"></i></button>
                                                @endif
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
    <script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>

    <script>
        new DataTable('#datatable');
    </script>
@endpush
