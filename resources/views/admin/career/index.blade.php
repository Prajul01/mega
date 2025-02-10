@extends('admin.layouts.app')
@section('title', 'Career Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Career Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Career Management</li>
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
                            @if (request()->routeIs('admin.career.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editcareer">
                                        <i class="fa fa-plus"></i> Edit career</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#careers">
                                        <i class="fa fa-list"></i> All career
                                    </a>
                                </li>
                                @can('career-create')
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#addcareer">
                                            <i class="fa fa-plus"></i> Add career</a>
                                    </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editcareer">
                                @include('admin.career.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="careers">
                                @include('admin.career.components.list')
                            </div>
                            @can('career-create')
                                <div class="tab-pane" id="addcareer">
                                    @include('admin.career.components.add')
                                </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
