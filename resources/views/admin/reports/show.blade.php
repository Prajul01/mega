@extends('admin.layouts.app')
@section('title', 'Report Issued Management')
@push('style')
    <style>
       .border {
            width: 100%;
            min-height:200px;
        }

        table tr {
            padding: 100px !important;
        }
    </style>
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
    </div>

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-primary"><i
                            class="fa fa-angle-double-left"></i>&nbsp;Go Back</a>

                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="row m-2 p-2">
                                <div class="col-md-12 my-2">
                                    <div>
                                        <h5>{{ Str::ucfirst($report->details) }}</h5>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="row  text-center">
                                        <div class="col-md-4 d-flex" style="align-items:center">
                                            <label class="mr-2">Name:</label>
                                            <input class="form-control" value="{{ $report->name }}" disabled>
                                        </div>
                                        <div class="col-md-4 d-flex" style="align-items:center">
                                            <label class="mr-2">Email:</label>
                                            <a href="mailto:{{ $report->email }}">{{ $report->email }}</a>
                                        </div>
                                        <div class="col-md-4 d-flex" style="align-items:center">
                                            <label class="mr-2">Phone No.:</label>
                                            <a href="tel:{{ $report->phone_no }}">{{ $report->phone_no }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 d-flex mb-3 mt-2">
                                    <label class="mr-2">
                                        Area of Concern:
                                    </label>
                                    <span class="btn btn-success">{{ $report->concern->concern }}</span>
                                </div>
                                <div class="col-md-12">
                                    <h6>Message:</h6>
                                </div>
                                <div class="col-md-12 border" >
                                    {{ nl2br(strip_tags($report->details)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
