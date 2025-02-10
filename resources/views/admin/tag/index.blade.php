@extends('admin.layouts.app')
@section('title', 'Tag Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Tag Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tag Management</li>
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
                            @if (request()->routeIs('admin.tag.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#edittender_type">
                                        <i class="fa fa-plus"></i> Edit Tag</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#tender_type">
                                        <i class="fa fa-list"></i> All Tags
                                    </a>
                                </li>
                                @can('tender-create')
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#addtender_type">
                                            <i class="fa fa-plus"></i> Add Tag</a>
                                    </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="edittender_type">
                                @include('admin.tag.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="tender_type">
                                @include('admin.tag.components.list')
                            </div>
                            @can('tender-create')
                                <div class="tab-pane" id="addtender_type">
                                    @include('admin.tag.components.add')
                                </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
