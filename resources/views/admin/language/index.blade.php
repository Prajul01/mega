@extends('admin.layouts.app')
@section('title', 'Language Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Language Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Language Management</li>
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
                            @if (request()->routeIs('admin.language.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editlanguage">
                                        <i class="fa fa-plus"></i> Edit Language</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#languages">
                                        <i class="fa fa-list"></i> All Language
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addlanguage">
                                        <i class="fa fa-plus"></i> Add Language</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editlanguage">
                                @include('admin.language.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="languages">
                                @include('admin.language.components.list')
                            </div>
                            <div class="tab-pane" id="addlanguage">
                                @include('admin.language.components.add')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
