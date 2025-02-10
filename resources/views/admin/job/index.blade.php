@extends('admin.layouts.app')
@section('title', 'job Management')
@section('content')
    <style>
        .select2 {
            width: 100% !important;
        }
    </style>
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Job Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Job Management</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs">
                            @if (request()->routeIs('admin.job.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editjob">
                                        <i class="fa fa-plus"></i> Edit job</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#jobs">
                                        <i class="fa fa-list"></i> All job
                                    </a>
                                </li>
                                @can('employer-create')
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#addjob">
                                            <i class="fa fa-plus"></i> Add job</a>
                                    </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editjob">
                                @include('admin.job.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="jobs">
                                @include('admin.job.components.list')
                            </div>
                            @can('employer-create')
                                <div class="tab-pane" id="addjob">
                                    @include('admin.job.components.add')
                                </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
        // Get the date input element
        var dateInput = document.getElementById("date");

        // Set the minimum date allowed to today's date
        dateInput.min = new Date().toISOString().split('T')[0];

        // Add an event listener to the date input to update the minimum date if necessary
        dateInput.addEventListener("change", function() {
            var selectedDate = new Date(this.value);
            var today = new Date();
            if (selectedDate < today) {
                this.value = "";
                this.min = today.toISOString().split('T')[0];
                alert("Please select a future date.");
            }
        });
    </script>
@endsection
