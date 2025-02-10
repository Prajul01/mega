@extends('admin.layouts.app')
@section('title', 'Tender Category Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Tender Category Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tender Category Management</li>
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
                            @if (request()->routeIs('admin.tender_category.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#edittender_category">
                                        <i class="fa fa-plus"></i> Edit Tender Category</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#tender_category">
                                        <i class="fa fa-list"></i> All Tender Category
                                    </a>
                                </li>
                                @can('tender-create')
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#addtender_category">
                                            <i class="fa fa-plus"></i> Add Tender Category</a>
                                    </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="edittender_category">
                                @include('admin.tender_category.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="tender_category">
                                @include('admin.tender_category.components.list')
                            </div>
                            @can('tender-create')
                            <div class="tab-pane" id="addtender_category">
                                @include('admin.tender_category.components.add')
                            </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
