@extends('admin.layouts.app')
@section('title', 'Step Procedure Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Pricing Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pricing Management</li>
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
                            <li class="nav-item">
                                <a class="nav-link show active" data-toggle="tab" href="#">
                                    <i class="fa fa-plus"></i> Advertisement Type</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="bg-secondary text-white" style="width:10%;">#</th>
                                        <th class="bg-secondary text-white" style="width:80%;">Advetisement Type</th>
                                        <th class="bg-secondary text-white" style="width:10%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($steps as $key => $step)
                                        <tr>
                                            <th>{{ ++$key }}</th>
                                            <th>{{ ucwords(str_replace('-', ' ', $step->posting_type)) }}</th>
                                            <th>
                                                <a href="{{ route('admin.pricing.index', base64_encode($step->id)) }}" class="btn btn-success">
                                                    <i class="fa fa-usd"></i>
                                                </a>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
