@extends('admin.layouts.app')
@section('title', 'Users Management')
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Applied Users</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.job.index') }}">Jobs</a></li>
                            <li class="breadcrumb-item">{{ $job->title }}</li>
                            <li class="breadcrumb-item active" aria-current="page">Users Management</li>
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
                            {{-- @if(request()->routeIs('admin.users.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editcategory">
                                        <i class="fa fa-plus"></i> Edit User</a>
                                </li>
                            @else --}}
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#categories">
                                        <i class="fa fa-list"></i> All Applicants
                                    </a>
                                </li>
                                {{-- @if(!request()->routeIs('admin.users.customer.*'))
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addcategory">
                                        <i class="fa fa-plus"></i> Add User</a>
                                </li>
                                @endif --}}
                            {{-- @endif --}}
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        {{-- @if(request()->routeIs('admin.users.edit'))
                            <div class="tab-pane active show" id="editcategory">
                                @include('admin.users.components.edit')
                            </div>
                        @else --}}
                            <div class="tab-pane active show" id="categories">
                                @include('admin.appliedUsers.components.list')
                            </div>
                            {{-- <div class="tab-pane" id="addcategory">
                                @include('admin.users.components.add')
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
