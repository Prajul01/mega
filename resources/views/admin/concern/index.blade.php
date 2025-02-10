@extends('admin.layouts.app')
@section('title', 'Concern Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Concern Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Concern Management</li>
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
                            @if (request()->routeIs('admin.concern.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editconcern">
                                        <i class="fa fa-plus"></i> Edit Concern</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#concerns">
                                        <i class="fa fa-list"></i> All Concern
                                    </a>
                                </li>
                                @can('content-create')
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addconcern">
                                        <i class="fa fa-plus"></i> Add Concern</a>
                                </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editconcern">
                                @include('admin.concern.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="concerns">
                                @include('admin.concern.components.list')
                            </div>
                            @can('content-create')
                            <div class="tab-pane" id="addconcern">
                                @include('admin.concern.components.add')
                            </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
