<?php
if (request()->routeIs('admin.employers.create')) {
    $flag = 1;
    $url = route('admin.employers.store');
} else {
    $flag = 0;
    $url = route('admin.employers.update', $user->username);
}
?>
@extends('admin.layouts.app')
@section('title', ($flag == 1? 'Create' : 'Edit') . ' Employer')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-12 col-sm-12">
                @if(request()->routeIs('admin.admins.index'))
                <h1>Admin Management</h1>
                @else
                <h1>User Management</h1>
                @endif
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $flag == 1? 'Create': 'Update' }} Employer</li>
                    </ol>
                </nav>
            </div>
            <div class="col">
                <a href="{{ route('admin.employers.index') }}" class="btn btn-primary" style="float:right;"><i class="fa fa-angle-double-left"></i>&nbsp;Go Back</a>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="card">
            <div class="head">
                <h5>{{ $flag == 1? 'Create' : 'Update' }}&nbsp;Employer</h5>
            </div>
            <div class="body">
                <form action="{{ $url }}" method="POST">
                    @csrf
                    @if(!$flag)
                    @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ old('name')? old('name') : @$user->name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_address">Email Address</label>
                                <input type="text" class="form-control" name="email" id="email_address" placeholder="Enter email address" value="{{ old('email')? old('email') : @$user->email }}" {{ !$flag? 'disabled': '' }}>
                            </div>
                        </div>
                        @if($flag)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value="{{ old('username')? old('username') : @$user->username }}">
                                <span class id="message" style="margin-top:10px!important; display: none;"></span>
                            </div>
                        </div>
                        <div class="col-md-6"></div>

                        @endif
                        @if($flag)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" aria-describedby="emailHelp" placeholder="Enter password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Enter password again">
                            </div>
                        </div>
                        @else
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" aria-describedby="emailHelp" placeholder="Enter password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-warning">
                                Leave Blank If you don't change Password .
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-success" style="float:right">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $('#username').on('change', function() {
        var username = $('#username').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: '{{ route("admin.employers.validateUsername") }}',
            data: {
                'username' : username,
            },
            success: function(data) {
                if(data['valid'] == 1)
                {
                    $('#message').removeAttr('class');
                    $('#message').attr('class', 'text-success');
                    $('#message').html('This Username is valid');
                    $('#message').attr('style', 'margin-top:5px !important; display:block !important;');
                }

                if(data['valid'] == 0)
                {
                    $('#message').removeAttr('class');
                    $('#message').attr('class', 'text-danger');
                    $('#message').html('This Username already exists! You can try <span class="btn btn-sm btn-success">' + data['suggestions'] + '</span>');
                    $('#message').attr('style', 'margin-top:5px !important;display:block !important;');
                }
            }
        });
    });
</script>
@endpush