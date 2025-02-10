@extends('admin.layouts.app')
@section('title', 'Step Procedure Management')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Step Procedure Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Step Procedure Management</li>
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
                                    <i class="fa fa-plus"></i> Advertisement Steps Type</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link show" href="{{ route('admin.steps.index') }}">
                                    <i class="fa fa-arrow-left"></i> Go back</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="bg-secondary text-white" style="width:10%;">#</th>
                                        <th class="bg-secondary text-white" style="width:80%;">Advetisement Steps</th>
                                        <th class="bg-secondary text-white" style="width:10%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 1; $i<=3; $i++ )
                                        <tr>
                                            <th>{{ $i }}</th>
                                            <th>Step {{ $i }}</th>
                                            <th><a href="{{ route('admin.steps.edit', ['id' => base64_encode($step->id), 'steps' => 'step-' . $i]) }}" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a></th>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
