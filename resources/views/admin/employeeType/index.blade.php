@extends('admin.layouts.app')
@section('title', 'Employee Type Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Employee Type Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Employee Type Management</li>
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
                            @if (request()->routeIs('admin.employee_type.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editemployee_type">
                                        <i class="fa fa-plus"></i> Edit Employee Type</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#employee_types">
                                        <i class="fa fa-list"></i> All Employee Type
                                    </a>
                                </li>
                                @can('job-create')
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addemployee_type">
                                        <i class="fa fa-plus"></i> Add Employee Type</a>
                                </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editemployee_type">
                                @include('admin.employeeType.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="employee_types">
                                @include('admin.employeeType.components.list')
                            </div>
                            @can('job-create')
                            <div class="tab-pane" id="addemployee_type">
                                @include('admin.employeeType.components.add')
                            </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
