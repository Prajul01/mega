@extends('admin.layouts.app')
@section('title', 'Blog Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Blog Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog Management</li>
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
                            @if (request()->routeIs('admin.blog.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editblog">
                                        <i class="fa fa-plus"></i> Edit Blog</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#blogs">
                                        <i class="fa fa-list"></i> All Blog
                                    </a>
                                </li>
                                @can('content-create')
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addblog">
                                        <i class="fa fa-plus"></i> Add Blog</a>
                                </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editblog">
                                @include('admin.blog.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="blogs">
                                @include('admin.blog.components.list')
                            </div>
                            @can('content-create')
                            <div class="tab-pane" id="addblog">
                                @include('admin.blog.components.add')
                            </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
