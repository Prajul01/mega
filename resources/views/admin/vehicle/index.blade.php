@extends('admin.layouts.app')
@section('title', 'Vehicle Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Vehicle Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">vehicle Management</li>
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
                            @if (request()->routeIs('admin.vehicle.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editvehicle">
                                        <i class="fa fa-plus"></i> Edit vehicle</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#vehicles">
                                        <i class="fa fa-list"></i> All vehicle
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addvehicle">
                                        <i class="fa fa-plus"></i> Add vehicle</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editvehicle">
                                @include('admin.vehicle.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="vehicles">
                                @include('admin.vehicle.components.list')
                            </div>
                            <div class="tab-pane" id="addvehicle">
                                @include('admin.vehicle.components.add')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
