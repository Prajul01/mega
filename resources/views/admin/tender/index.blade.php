@extends('admin.layouts.app')
@section('title', 'Tender Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Tender Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tender Management</li>
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
                            @if (request()->routeIs('admin.tender.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#edittender">
                                        <i class="fa fa-plus"></i> Edit Tender </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#tender">
                                        <i class="fa fa-list"></i> All Tender
                                    </a>
                                </li>
                                @can('tender-create')
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#addtender">
                                            <i class="fa fa-plus"></i> Add Tender</a>
                                    </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="edittender">
                                @include('admin.tender.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="tender">
                                @include('admin.tender.components.list')
                            </div>
                            @can('tender-create')
                                <div class="tab-pane" id="addtender">
                                    @include('admin.tender.components.add')
                                </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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
