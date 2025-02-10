@extends('admin.layouts.app')
@section('title', 'about Management')
@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>About Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About Management</li>
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
                            @if (!request()->routeIs('admin.about.index'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editabout">
                                        <i class="fa fa-plus"></i> Edit about</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" href="{{ route('admin.about.index') }}">
                                        <i class="fa fa-arrow-left"></i> Go Back
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#abouts">
                                        <i class="fa fa-list"></i> About Page
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editabout">
                                @include('admin.about.components.who_we_are')
                            </div>
                        @elseif($status == 'edit1')
                            @include('admin.about.components.what_we_do')
                        @elseif($status == 'edit2')
                            @include('admin.about.components.feature')
                        @else
                            <div class="tab-pane active show" id="abouts">
                                @include('admin.about.components.list')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
