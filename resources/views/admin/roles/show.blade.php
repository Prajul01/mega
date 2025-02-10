<?php
/**
 * Created On : PhpStorm
 * Project Name: byabasayi
 * Author Name: Subas Nyaupane
 * Author Email: mail.subasnyaupane@gmail.com
 * Author Url : https://subasnyaupane.github.io/
 * Date: 26/May/2021
 */
?>

@extends('admin.layouts.app')
@section('title', 'View Role & Permission')
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/DataTables/datatables.min.css') }}">
    <style>
        .wrapper .page-wrap .main-content .page-header .page-header-title i {
            width: 50px !important;
            height: 50px !important;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-check bg-blue"></i>
                        <div class="d-inline">
                            <h5>View Role & Permission</h5>
                            <span>Something here</span>
                        </div>
                    </div>
                    {{--                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm"> <i--}}
                    {{--                            class="ik ik-plus"></i> Add New </a>--}}
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.roles.index') }}">Role & Permission</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">View</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Name
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $role->name }}" name="name"
                                           placeholder="Role Name" disabled>
                                </div>
                            </div>
                            @foreach($rolePermissions as $key => $value)

                                @php
                                    $parts = explode('-', $value->name);
                                    $parts = implode(' ', $parts);
                                @endphp

                                <div class="col-md-3 mb-2">
                                    <li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center">
                                        {{ ucwords($parts) }}
                                    </li>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
