@extends('admin.layouts.app')
@section('title', 'skill Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Skill Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Skill Management</li>
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
                            @if (request()->routeIs('admin.skill.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editskill">
                                        <i class="fa fa-plus"></i> Edit skill</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#skills">
                                        <i class="fa fa-list"></i> All skill
                                    </a>
                                </li>
                                @can('job-create')
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addskill">
                                        <i class="fa fa-plus"></i> Add skill</a>
                                </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editskill">
                                @include('admin.skill.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="skills">
                                @include('admin.skill.components.list')
                            </div>
                            @can('job-create')
                            <div class="tab-pane" id="addskill">
                                @include('admin.skill.components.add')
                            </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
