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
                            @if (request()->routeIs('admin.studyfield.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editstudyfield">
                                        <i class="fa fa-plus"></i> Edit StudyField</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#studyfields">
                                        <i class="fa fa-list"></i> All StudyField
                                    </a>
                                </li>
                                @can('education-create')
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addstudyfield">
                                        <i class="fa fa-plus"></i> Add StudyField</a>
                                </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editstudyfield">
                                @include('admin.studyfield.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="studyfields">
                                @include('admin.studyfield.components.list')
                            </div>
                            @can('education-create')
                            <div class="tab-pane" id="addstudyfield">
                                @include('admin.studyfield.components.add')
                            </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
