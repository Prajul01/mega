@extends('admin.layouts.app')
@section('title', 'News And Announcement Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>News And Announcement Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">News And Announcement Management</li>
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
                            @if (request()->routeIs('admin.news.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editblog">
                                        <i class="fa fa-plus"></i> Edit News And Announcement</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#blogs">
                                        <i class="fa fa-list"></i> All News And Announcement
                                    </a>
                                </li>
                                @can('content-create')
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addblog">
                                        <i class="fa fa-plus"></i> Add News And Announcement</a>
                                </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editblog">
                                @include('admin.news_and_announcement.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="blogs">
                                @include('admin.news_and_announcement.components.list')
                            </div>
                            @can('content-create')
                            <div class="tab-pane" id="addblog">
                                @include('admin.news_and_announcement.components.add')
                            </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
