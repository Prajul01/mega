@extends('admin.layouts.app')
@section('title', 'Day Packages Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Day Packages Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Day Packages Management</li>
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
                            @if (request()->routeIs('admin.sliders.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editcategory">
                                        <i class="fa fa-plus"></i> Edit Day Packages</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#categories">
                                        <i class="fa fa-list"></i> All Day Packages
                                    </a>
                                </li>
                                @can('site-create')
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#addcategory">
                                            <i class="fa fa-plus"></i> Add Day Packages</a>
                                    </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editcategory">
                                @include('admin.dayPackages.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="categories">
                                @include('admin.dayPackages.components.list')
                            </div>
                            @can('site-create')
                            <div class="tab-pane" id="addcategory">
                                @include('admin.dayPackages.components.add')
                            </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>
    <script src="{{ asset('backend/html/assets/js/pages/forms/dropify.js') }}"></script>
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
@endpush
