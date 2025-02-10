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
                    <form action="{{ route('admin.steps.update', base64_encode($step->id)) }}" method="POST">
                        @csrf
                        @method('PUT')
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
                            <?php
                            $no = 'step' . $stepNo;
                            $Step = json_decode($step->$no);
                            $title = $Step->heading;
                            $description = $Step->description;
                            ?>
                            @csrf
                            <div class="col-md-12 mb-3">
                                <label for="" class="form-label">Title</label>
                                <input type="text" class="form-control" placeholder="Title" name="title"
                                    value="{{ old('title', @$title) }}">
                            </div>

                            <div class="col-md-12">
                                <label for="" class="form-label">Title</label>
                                <textarea class="form-control ckeditor" placeholder="Description" rows=15 name="description">{{ old('description', @$description) }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-md-12">
                                <a href="{{ route('admin.steps.subIndex', ['id' => base64_encode($step->id), 'steps' => 'step-' . $stepNo]) }}"
                                    class="btn btn-danger"><i class="fa fa-time"></i>&nbsp;Cancel</a>
                                <button class="btn btn-success" style="float:right;" name="step"
                                    value="{{ $stepNo }}"><i class="fa fa-arrow-up"></i>&nbsp;Update</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
@endpush
