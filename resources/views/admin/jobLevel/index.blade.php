@extends('admin.layouts.app')
@section('title', 'JobLevel Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>JobLevel Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">JobLevel Management</li>
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
                            @if (request()->routeIs('admin.joblevel.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editJobLevel">
                                        <i class="fa fa-plus"></i> Edit JobLevel</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#JobLevels">
                                        <i class="fa fa-list"></i> All JobLevel
                                    </a>
                                </li>
                                @can('job-create')
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addJobLevel">
                                        <i class="fa fa-plus"></i> Add JobLevel</a>
                                </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editJobLevel">
                                @include('admin.jobLevel.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="JobLevels">
                                @include('admin.jobLevel.components.list')
                            </div>
                            @can('job-create')
                            <div class="tab-pane" id="addJobLevel">
                                @include('admin.jobLevel.components.add')
                            </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
