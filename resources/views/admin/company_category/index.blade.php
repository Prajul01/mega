@extends('admin.layouts.app')
@section('title', 'Department Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Department Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Department Management</li>
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
                            @if (request()->routeIs('admin.company_category.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editcompany_category">
                                        <i class="fa fa-plus"></i> Edit Department</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#company_categorys">
                                        <i class="fa fa-list"></i> All Department
                                    </a>
                                </li>
                                @can('company-create')
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addcompany_category">
                                        <i class="fa fa-plus"></i> Add Department</a>
                                </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editcompany_category">
                                @include('admin.company_category.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="company_categorys">
                                @include('admin.company_category.components.list')
                            </div>
                            @can('company-create')
                            <div class="tab-pane" id="addcompany_category">
                                @include('admin.company_category.components.add')
                            </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
