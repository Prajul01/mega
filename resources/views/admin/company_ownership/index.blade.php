@extends('admin.layouts.app')
@section('title', 'Company Ownership Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Company Ownership Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Company Ownership Management</li>
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
                            @if (request()->routeIs('admin.company_ownership.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editcompany_ownership">
                                        <i class="fa fa-plus"></i> Edit Company Ownership</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#company_ownerships">
                                        <i class="fa fa-list"></i> All Company Ownership
                                    </a>
                                </li>
                                @can('company-create')
                                <li class="nav-item">
                                        <i class="fa fa-plus"></i> Add Company Ownership</a>
                                </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editcompany_ownership">
                                @include('admin.company_ownership.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="company_ownerships">
                                @include('admin.company_ownership.components.list')
                            </div>
                            @can('company-create')
                            <div class="tab-pane" id="addcompany_ownership">
                                @include('admin.company_ownership.components.add')
                            </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
