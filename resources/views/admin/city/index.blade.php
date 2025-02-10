@extends('admin.layouts.app')
@section('title', 'city Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>City Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">City Management</li>
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
                            @if (request()->routeIs('admin.city.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editcity">
                                        <i class="fa fa-plus"></i> Edit City</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#citys">
                                        <i class="fa fa-list"></i> All City
                                    </a>
                                </li>
                                @can('location-create')
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addcity">
                                        <i class="fa fa-plus"></i> Add City</a>
                                </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editcity">
                                @include('admin.city.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="citys">
                                @include('admin.city.components.list')
                            </div>
                            @can('location-create')
                            <div class="tab-pane" id="addcity">
                                @include('admin.city.components.add')
                            </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
