@extends('admin.layouts.app')
@section('title', 'Education Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Education Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Education Management</li>
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
                            @if (request()->routeIs('admin.education.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editeducation">
                                        <i class="fa fa-plus"></i> Edit Education</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#educations">
                                        <i class="fa fa-list"></i> All Education
                                    </a>
                                </li>
                                @can('education-create')
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addeducation">
                                        <i class="fa fa-plus"></i> Add Education</a>
                                </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editeducation">
                                @include('admin.education.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="educations">
                                @include('admin.education.components.list')
                            </div>
                            @can('education-create')
                            <div class="tab-pane" id="addeducation">
                                @include('admin.education.components.add')
                            </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
