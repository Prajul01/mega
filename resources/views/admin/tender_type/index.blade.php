@extends('admin.layouts.app')
@section('title', 'Tender Type Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Tender Type Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tender Type Management</li>
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
                            @if (request()->routeIs('admin.tender_type.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#edittender_type">
                                        <i class="fa fa-plus"></i> Edit Tender Type</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#tender_type">
                                        <i class="fa fa-list"></i> All Tender Type
                                    </a>
                                </li>
                                @can('tender-create')
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#addtender_type">
                                            <i class="fa fa-plus"></i> Add Tender Type</a>
                                    </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="edittender_type">
                                @include('admin.tender_type.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="tender_type">
                                @include('admin.tender_type.components.list')
                            </div>
                            @can('tender-create')
                                <div class="tab-pane" id="addtender_type">
                                    @include('admin.tender_type.components.add')
                                </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
