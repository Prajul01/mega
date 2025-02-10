@extends('admin.layouts.app')
@section('title', 'Step Procedure Management')
@section('content')
<?php
    $request = request() != null? request() : null;
?>
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
                    <form action="{{ route('admin.pricing.store', base64_encode($step->id)) }}" method="post">
                        @csrf
                        <div class="card-header">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.pricing.index', base64_encode($step->id)) }}">
                                        <i class="fa fa-angle-double-left"></i>
                                        {{ ucwords(str_replace('-', ' ', $step->posting_type)) }}</a>
                                </li>
                                <li><a class="nav-link active" href="#">
                                        <i class="fa fa-plus"></i>&nbsp;Add Pricing</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="form-label"><strong>No of Days</strong></label>
                                    <input type="number" name="no_of_days" id="" class="form-control" value="{{ old('no_of_days', @$request->no_of_days) }}"
                                        placeholder="Enter No. of days">
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label"><strong>Packages</strong></label>
                                    <select name="day_package" id="" class="form-control">
                                        <option value="" {{ !@$request? 'selected': ''}}disabled>--Select Package--</option>
                                        @forelse($days as $day)
                                            <option value="{{ base64_encode($day->id) }}" {{ old('day_package', @$request->package) == base64_encode($day->id)? 'selected': '' }}>{{ $day->days }}</option>
                                        @empty
                                            <option disabled>No Packages can be found</option>
                                        @endforelse
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="" class="form-label"><strong>Price</strong></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa fa-usd"></i></span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="price" aria-label="price" name="price"
                                            aria-describedby="basic-addon1" value="{{ old('price', @$request->price) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label"><strong>Action</strong></label><br>
                                    <button class="btn btn-success"><i class="fa fa-check"></i>&nbsp;Submit</button>
                                    <a href="{{ route('admin.pricing.index', base64_encode($step->id)) }}"
                                        class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
