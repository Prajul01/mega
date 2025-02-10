@extends('admin.layouts.app')
@section('title', 'Study Field Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Study Field Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Study Field Management</li>
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
                            @if (request()->routeIs('admin.studysubject.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editstudysubject">
                                        <i class="fa fa-plus"></i> Edit studysubject</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#studysubjects">
                                        <i class="fa fa-list"></i> All studysubject
                                    </a>
                                </li>
                                @can('education-create')
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addstudysubject">
                                        <i class="fa fa-plus"></i> Add Study Subject</a>
                                </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editstudysubject">
                                @include('admin.studysubject.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="studysubjects">
                                @include('admin.studysubject.components.list')
                            </div>
                            @can('education-create')
                            <div class="tab-pane" id="addstudysubject">
                                @include('admin.studysubject.components.add')
                            </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
