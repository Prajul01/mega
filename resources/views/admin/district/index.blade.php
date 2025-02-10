@extends('admin.layouts.app')
@section('title', 'District Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>District Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">District Management</li>
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
                            @if (request()->routeIs('admin.district.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editdistrict">
                                        <i class="fa fa-plus"></i> Edit District</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#districts">
                                        <i class="fa fa-list"></i> All District
                                    </a>
                                </li>
                                @can('location-create')
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#adddistrict">
                                            <i class="fa fa-plus"></i> Add District</a>
                                    </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editdistrict">
                                @include('admin.district.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="districts">
                                @include('admin.district.components.list')
                            </div>
                            @can('location-create')
                                <div class="tab-pane" id="adddistrict">
                                    @include('admin.district.components.add')
                                </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
