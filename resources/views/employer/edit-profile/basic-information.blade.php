<?php
$employer = auth()->user()->employer;
if (isset(auth()->user()->employer->logo)) {
    $url = asset('storage/employer/logo' . auth()->user()->employer->logo);
} else {
    $url = asset('frontend/assets/images/files/company-logo.png');
}
?>
@extends('employer.edit-profile.layouts.app')
@section('title', 'Basic Information')
@section('dashboard_content')
    <div class="col-lg-9 col-md-8">
        <div class="card candidate-info new-shadow-sidebar mt-2 mb-3 mt-lg-0">
            <div class="card-body p-3">
                <div class="right-side-top-bar">
                    <div class="right-top-title">
                        <span class="icon-top">
                            <i class="fa-regular fa-address-card"></i>

                        </span>

                        Basic Information
                    </div>
                    <div class="right-top-button">
                        <a href="javascript:void(0)" name="submit" id="editPreference"
                            class="btn btn-primary btn-hover"><span class="icon-top">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </span><span class="mobile-none">Edit Basic Info</span></a>
                    </div>
                </div>

                <div class="right-side-content">
                    <div class="basic-job-desc">
                        <div class="detail-show-content">
                            <div class="basic-job-list">
                                <div class="basic-job-left">
                                    Full Name
                                </div>
                                <div class="basic-job-right">
                                    <strong>{{ $employer->company_name }}</strong>
                                    @if ($employer->is_varify)
                                        <span class="verified"><i class="fa-regular fa-circle-check"></i>
                                            Verified</span>
                                    @endif
                                </div>
                            </div>
                            <div class="basic-job-list">
                                <div class="basic-job-left">
                                    Display Picture
                                </div>
                                <div class="basic-job-right">
                                    <div class="dp-image">
                                        <img src="{{ $url }}" alt="{{ $employer->company_name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="basic-job-list">
                                <div class="basic-job-left">
                                    Address
                                </div>
                                <div class="basic-job-right">
                                    <?php
                                    if (@$employer->city->name == @$employer->district->name) {
                                        $address = @$employer->city->name;
                                    } else {
                                        $address = @$employer->city->name . ', ' . @$employer->district->name;
                                    }
                                    ?>
                                    {{ $address }}
                                </div>
                            </div>
                            <div class="basic-job-list">
                                <div class="basic-job-left">
                                    Mobile Number
                                </div>
                                <div class="basic-job-right">
                                    {{ @$employer->office_number ? $employer->office_number : '' }}
                                    {{ @$employer->mobile_number ? ', ' . $employer->mobile_number : '' }}
                                </div>
                            </div>
                            <div class="basic-job-list">
                                <div class="basic-job-left">
                                    Organization Ownership
                                </div>
                                <div class="basic-job-right">
                                    {{ @$employer->ower_ship->title }}
                                </div>
                            </div>
                            <div class="basic-job-list">
                                <div class="basic-job-left">
                                    Organization Type
                                </div>
                                <div class="basic-job-right">
                                    {{ @$employer->category->title }}
                                </div>
                            </div>
                            <div class="basic-job-list">
                                <div class="basic-job-left">
                                    Size of Organization
                                </div>
                                <div class="basic-job-right">
                                    {{ @$employer->company_size->title }} employees
                                </div>
                            </div>
                            <div class="basic-job-list">
                                <div class="basic-job-left">
                                    Company Email
                                </div>
                                <div class="basic-job-right">
                                    {{ $employer->emails->where('is_primary')->first()->email }}
                                </div>
                            </div>
                            <div class="basic-job-list">
                                <div class="basic-job-left">
                                    Company Website
                                </div>
                                <div class="basic-job-right">
                                    <a href="{{ @$employer->company_website ?? '#' }}"
                                        target="_blank">{{ $employer->company_website }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="right-side-form d-none">
                    <div class="personal-info-form">
                        <form method="post" action="{{ route('employers.editProfile.profileDetails') }}"
                            onsubmit="return validateForm()" class="contact-form mt-4" name="myForm" id="myForm"
                            enctype="multipart/form-data">
                            @csrf
                            <span id="error-msg"></span>
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="company-logo">
                                        <label for="" class="form-label">Current
                                            Logo</label>
                                        <div class="form-control text-center">
                                            <img src="{{ $url }}" class="img-fluid" alt="Company Logo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="company-logo">
                                        <label for="" class="form-label">Update
                                            Logo</label>
                                        <input type="file" class="form-control" id="" name="logo"
                                            placeholder="Website URL">
                                        <small>[Supporting file format: jpg, jpeg, png]</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nameInput" class="form-label">Company
                                            Name <span class="red">*</span></label>
                                        <input type="text" name="company_name" id="name" class="form-control"
                                            value="{{ old('company_name', @$employer->company_name) }}">
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Company
                                            Category</label>
                                        <select name="category" id="" class="form-control field-industry">
                                            <option value="" disabled>--Select--</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ base64_encode($category->id) }}"
                                                    {{ $category->id == old('category', @$employer->category->id) ? 'selected' : '' }}>
                                                    {{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Address<span
                                                class="red">*</span></label>
                                        <input type="text" class="form-control" id="" name="address"
                                            value="{{ old('address', @$employer->address) }}">
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Office
                                            Number<span class="red">*</span></label>
                                        <input type="text" class="form-control" id="" name="office_number"
                                            value="{{ old('office_number', @$employer->office_number) }}">

                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Mobile
                                            Number<span class="red">*</span></label>
                                        <input type="text" class="form-control" id="" name="mobile_number"
                                            value="{{ old('mobile_number', @$employer->phone_number) }}">

                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Owner
                                            Ship<span class="red">*</span></label>
                                        <select name="ownership" id="" class="form-control">
                                            <option value="" disabled>--Select--
                                            </option>
                                            @foreach ($ownerShip as $data)
                                                <option value="{{ base64_encode('$data->id') }}"
                                                    {{ $data->id == old('ownership', @$employer->company_owner_ship_id) ? 'selected' : '' }}>
                                                    {{ $data->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Size
                                            Of Organization<span class="red">*</span></label>
                                        <select name="size_of_company" id="" class="form-control">
                                            <option value="">--Select--
                                            </option>
                                            @foreach ($sizes as $size)
                                                <option value="{{ base64_encode($size->id) }}"
                                                    {{ $size->id == old('size_of_company', @$employer->company_size_id) ? 'selected' : '' }}>
                                                    {{ $size->title }} Employees</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Company
                                            Website<span class="red">*</span></label>
                                        <input type="text" class="form-control" id="" name="company_website"
                                            placeholder="Website URL"
                                            value="{{ old('company_website', @$employer->company_website) }}">

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="meassageInput" class="form-label"></label>
                                        Company Short Intro<span class="red">*</span></label>
                                        <textarea class="form-control trumbowyg" id="meassageInput" placeholder="Enter  Your Career Objective"
                                            name="company_description" id="comments" rows="5">{{ old('company_description', @$employer->company_description) }}</textarea>

                                    </div>
                                </div><!--end col-->

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="meassageInput" class="form-label"></label>
                                        Services<span class="red">*</span></label>
                                        <textarea class="form-control trumbowyg" id="meassageInput" placeholder="Enter  Your Career Objective"
                                            name="services" id="comments" rows="5">{{ old('services', @$employer->services) }}</textarea>

                                    </div>
                                </div><!--end col-->

                            </div><!--end row-->
                            <div class="text-left">
                                <button type="submit" id="submit" name="submit" class="btn btn-primary">
                                    Save Profile </button>
                            </div>
                        </form><!--end form-->
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
