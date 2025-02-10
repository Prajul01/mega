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
                    @if (request()->routeIs('admin.admins.index'))
                        <h1>Admin Management</h1>
                    @else
                        <h1>User Management</h1>
                    @endif
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users Management</li>
                        </ol>
                    </nav>
                </div>
                @if (@$unverified_count)
                    <form action="" post="get">
                        <button class="btn btn-danger m-3" style="font-size:20px" name="q"
                            value="unverified-users">Unverified Users: {{ $unverified_count }}</span></button>
                    </form>
                @endif
                @if (@$verified_count)
                    <a href="{{ route('admin.users.admins.index') }}" class="btn btn-success m-3"
                        style="font-size:20px">Verified Users: {{ $verified_count }}</a>
                @endif
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs">
                            @if (request()->routeIs('admin.users.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editcategory">
                                        <i class="fa fa-plus"></i> Edit User</a>
                                </li>
                            @elseif(request()->routeIs('admin.users.show'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#categories">
                                        @ {{ $user->username }}
                                    </a>
                                </li>
                                <li class="ml-2 nav-item">
                                    <a class="btn btn-primary" href="{{ url()->previous() }}">
                                        <i class="fa fa-angle-double-left"></i> Go Back
                                    </a>
                                </li>
                                <li class="ml-auto">
                                    <button id="downloadBtn" class="btn btn-primary">Download PDF</button>
                                </li>
                            @elseif(request()->routeIs('admin.users.admins.index'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#categories">
                                        <i class="fa fa-list"></i> All User
                                    </a>
                                </li>

                                @if (!request()->routeIs('admin.users.customer.*'))
                                    <li class="nav-item">
                                        <a class="nav-link"r data-toggle="tab" href="#addJobseeker">
                                            <i class="fa fa-plus"></i> Add User</a>
                                    </li>
                                @endif
                            @elseif(request()->routeIs('admin.admin-management.index'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#categories">
                                        <i class="fa fa-list"></i> All Admins
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" data-toggle="tab" href="#addadmin">
                                        <i class="fa fa-plus"></i> Add Admin
                                    </a>
                                </li>
                            @elseif(request()->routeIs('admin.adminUsers.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" href="#">
                                        <i class="fa fa-list"></i> Edit User
                                    </a>
                                </li>
                            @elseif(request()->routeIs('admin.adminUsers.index'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#categories">
                                        <i class="fa fa-list"></i> All Users
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" data-toggle="tab" href="#addAdminUsers">
                                        <i class="fa fa-plus"></i> Add Users
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if (request()->routeIs('admin.users.edit'))
                            @can('user-edit')
                                <div class="tab-pane active show" id="editcategory">
                                    @include('admin.users.components.edit')
                                </div>
                            @endcan
                        @elseif(request()->routeIs('admin.users.show'))
                            @can('user-list')
                                <div class="tab-pane active show" id="showcategories">
                                    @include('admin.users.components.show')
                                </div>
                            @endcan
                        @elseif(request()->routeIs('admin.users.admins.index'))
                            @can('user-list')
                                <div class="tab-pane active show" id="categories">
                                    @include('admin.users.components.list')
                                </div>
                            @endcan
                            @can('user-create')
                                <div class="tab-pane" id="addJobseeker">
                                    @include('admin.users.components.add')
                                </div>
                            @endcan
                        @elseif(request()->routeIs('admin.admin-management.index'))
                            @can('user-list')
                                <div class="tab-pane active show" id="categories">
                                    @include('admin.users.components.adminList')
                                </div>
                            @endcan
                            @can('user-create')
                                <div class="tab-pane" id="addadmin">
                                    @include('admin.users.components.add')
                                </div>
                            @endcan
                        @elseif(request()->routeIs('admin.admin-management.edit'))
                            @can('user-edit')
                                <div class="tab-pane active show" id="editcategory">
                                    @include('admin.users.components.edit')
                                </div>
                            @endcan
                        @elseif(request()->routeIs('admin.adminUsers.index'))
                            @can('user-list')
                                <div class="tab-pane active show" id="categories">
                                    @include('admin.users.components.userList')
                                </div>
                            @endcan
                            @can('user-create')
                                <div class="tab-pane" id="addAdminUsers">
                                    @include('admin.users.components.add')
                                </div>
                            @endcan
                        @elseif(request()->routeIs('*.adminUsers.edit'))
                            @can('user-edit')
                                <div class="tab-pane active show" id="editcategory">
                                    @include('admin.users.components.edit')
                                </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
