@extends('admin.layouts.app')
@section('title', 'Notice Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Notice Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Notice Management</li>
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
                            @if (request()->routeIs('admin.notice.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editnotice">
                                        <i class="fa fa-plus"></i> Edit Notice</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#notices">
                                        <i class="fa fa-list"></i> All Notice
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addnotice">
                                        <i class="fa fa-plus"></i> Add Notice</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editnotice">
                                @include('admin.notice.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="notices">
                                @include('admin.notice.components.list')
                            </div>
                            <div class="tab-pane" id="addnotice">
                                @include('admin.notice.components.add')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
