@extends('admin.layouts.app')
@section('title', 'Faq Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Company FAQ Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">FAQ Management</li>
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
                            @if (request()->routeIs('admin.faq.edit'))
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editfaq">
                                        <i class="fa fa-plus"></i> Edit Faq</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#faqs">
                                        <i class="fa fa-list"></i> All Faq
                                    </a>
                                </li>
                                @can('content-create')
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addfaq">
                                        <i class="fa fa-plus"></i> Add Faq</a>
                                </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        @if ($status == 'edit')
                            <div class="tab-pane active show" id="editfaq">
                                @include('admin.companyFaq.components.edit')
                            </div>
                        @else
                            <div class="tab-pane active show" id="faqs">
                                @include('admin.companyFaq.components.list')
                            </div>
                            @can('content-create')
                            <div class="tab-pane" id="addfaq">
                                @include('admin.companyFaq.components.add')
                            </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
