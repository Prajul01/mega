@extends('admin.layouts.app')
@section('title', 'Experience Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Experience Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Experience Management</li>
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
                            @if (request()->routeIs('admin.experience.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editexperience">
                                        <i class="fa fa-plus"></i> Edit Experience</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#experiences">
                                        <i class="fa fa-list"></i> All Experience
                                    </a>
                                </li>
                                @can('job-create')
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addexperience">
                                        <i class="fa fa-plus"></i> Add Experience</a>
                                </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editexperience">
                                @include('admin.experience.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="experiences">
                                @include('admin.experience.components.list')
                            </div>
                            @can('job-create')
                            <div class="tab-pane" id="addexperience">
                                @include('admin.experience.components.add')
                            </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
