@extends('user.dashboard.layouts.app')
@section('title', 'Edit Profile | Job Seeker')
@section('user_content')
    @push('style')
        <!-- Choise Css -->
        <link rel="stylesheet" href="{{ asset('frontend/assets/libs/choices.js/public/assets/styles/choices.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
            integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Swiper Css -->
        <link rel="stylesheet" href="{{ asset('frontend/assets/libs/swiper/swiper-bundle.min.css') }}">
        <link href="{{ asset('frontend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        <!--Custom Css-->
        <link href="{{ asset('frontend/assets/css/custom.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/assets/vendor/dropify/css/dropify.css') }}" rel="stylesheet" type="text/css" />
    @endpush
    <div class="card candidate-info shadow-sidebar mt-4 mb-3 mt-lg-0">
        <div class="card-body p-0 pt-0">
            <div class="job-summary-tab mt-0">
                <ul class="nav nav-pills new-column mb-3 m-0" id="pills-tab" role="tablist">
                    <li class="nav-item pl-0" role="presentation">
                        <button class="nav-link active" id="pills-personal-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-personal" type="button" role="tab" aria-controls="pills-personal"
                            aria-selected="true">Personal Information <span class="text-danger">*</span></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-education-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-education" type="button" role="tab" aria-controls="pills-education"
                            aria-selected="false">Education <span class="text-danger">*</span></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-experience" type="button" role="tab"
                            aria-controls="pills-experience" aria-selected="false">Experience</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-extra-tab" data-bs-toggle="pill" data-bs-target="#pills-extra"
                            type="button" role="tab" aria-controls="pills-extra" aria-selected="false">Additional
                            Field</button>
                    </li>
                </ul>
                <div class="tab-content p-3 pt-0" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-personal" role="tabpanel"
                        aria-labelledby="pills-personal-tab">
                        <div class="personal-info-form">
                            <form method="post"
                                action="{{ isset($job_seeker_personal_info) ? route('user.update_profile', auth()->user()->username) : route('user.storeProfile', auth()->user()->username) }}"
                                class="contact-form mt-4" name="myForm" id="myForm" enctype="multipart/form-data">
                                @csrf
                                @if (isset($job_seeker_personal_info))
                                    @method('put')
                                @endif
                                <input type="hidden" name="personal_information" value="1" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="nameInput" class="form-label">First
                                                    Name <span class="red">*</span></label>
                                                <input type="text" name="first_name" id="name" class="form-control"
                                                    placeholder="Enter your name"
                                                    value="{{ old('first_name') ? old('first_name') : (isset($job_seeker_personal_info) ? $job_seeker_personal_info->first_name : '') }}">
                                                @error('first_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="nameInput" class="form-label">Middle
                                                    Name</label>
                                                <input type="text" name="middle_name" id="name"
                                                    class="form-control" placeholder="Enter your Middle Name"
                                                    value="{{ old('middle_name') ? old('middle_name') : (isset($job_seeker_personal_info) ? $job_seeker_personal_info->middle_name : '') }}">
                                                @error('middle_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Last
                                                    Name<span class="red">*</span></label>
                                                <input type="text" class="form-control" id=""
                                                    name="last_name" placeholder="Enter your Last name"
                                                    value="{{ old('last_name') ? old('last_name') : (isset($job_seeker_personal_info) ? $job_seeker_personal_info->last_name : '') }}">
                                                @error('last_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->

                                    </div>
                                    <?php
                                    if (@$job_seeker_personal_info->profile_pic) {
                                        $url = asset('/storage/job-seeker/' . $job_seeker_personal_info->profile_pic);
                                    } else {
                                        $url = asset('frontend/assets/images/files/spy.png');
                                    }
                                    ?>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Profile Picture<span
                                                    class="red">*</span></label>
                                            <input type="file" name="profile_pic" class="dropify"
                                                data-default-file="{{ $url }}" data-height=200 />
                                            @error('last_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Current Province<span
                                                    class="red">*</span></label>
                                            <select class="form-control" name="current_province"
                                                onChange="district(this)">
                                                <option selected disabled>Select Province</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}"
                                                        {{ old(
                                                            'current_province',
                                                            @$job_seeker_personal_info->current_province ? $job_seeker_personal_info->current_province : '',
                                                        ) == $province->id
                                                            ? 'selected'
                                                            : '' }}>
                                                        {{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('current_province')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <?php
                                    if (@$job_seeker_personal_info->current_province) {
                                        $current_districts = \App\Models\District::where('province_id', $job_seeker_personal_info->current_province)->get();
                                    }

                                    ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Current District<span
                                                    class="red">*</span></label>
                                            <select class="form-control" name="current_district" onchange="city(this)">
                                                <option selected disabled>Select District</option>
                                                @if (@$current_districts)
                                                    @foreach ($current_districts as $district)
                                                        <option value="{{ $district->id }}"
                                                            {{ $job_seeker_personal_info->current_district == $district->id ? 'selected' : '' }}>
                                                            {{ $district->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('current_district')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <?php
                                    if (@$job_seeker_personal_info->current_district) {
                                        $current_city = \App\Models\City::where('district_id', $job_seeker_personal_info->current_district)->get();
                                    }
                                    ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Current City<span
                                                    class="red">*</span></label>
                                            <select class="form-control" name="current_city">
                                                <option selected disabled>Select City</option>
                                                @if (@$current_city)
                                                    @foreach (@$current_city as $city)
                                                        <option value="{{ $city->id }}"
                                                            {{ $city->id == $job_seeker_personal_info->current_city ? 'selected' : '' }}>
                                                            {{ $city->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('current_city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Permanent Province<span
                                                    class="red">*</span></label>
                                            <select class="form-control" name="permanent_province"
                                                id="permanent_province" onchange="district(this)">
                                                <option selected disabled>Select Province</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}"
                                                        {{ old(
                                                            'permanent_province',
                                                            @$job_seeker_personal_info->permanent_province ? $job_seeker_personal_info->current_province : '',
                                                        ) == $province->id
                                                            ? 'selected'
                                                            : '' }}>
                                                        {{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('permanent_province')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <?php
                                    if (@$job_seeker_personal_info->permanent_province) {
                                        $permanent_districts = \App\Models\District::where('province_id', $job_seeker_personal_info->permanent_province)->get();
                                    }
                                    ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Permanent District<span
                                                    class="red">*</span></label>
                                            <select class="form-control" name="permanent_district"
                                                id="permanent_district" onchange="city(this)">
                                                <option selected disabled>Select District</option>
                                                @if (@$permanent_districts)
                                                    @foreach ($permanent_districts as $district)
                                                        <option value="{{ $district->id }}"
                                                            {{ $job_seeker_personal_info->permanent_district == $district->id ? 'selected' : '' }}>
                                                            {{ $district->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('permanent_district')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <?php
                                    if (@$job_seeker_personal_info->permanent_district) {
                                        $permanent_city = \App\Models\City::where('district_id', $job_seeker_personal_info->permanent_district)->get();
                                    }
                                    ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Permanent City<span
                                                    class="red">*</span></label>
                                            <select class="form-control" name="permanent_city" id="permanent_city">
                                                <option selected disabled>Select City</option>
                                                @if (@$permanent_city)
                                                    @foreach ($permanent_city as $city)
                                                        <option value="{{ $city->id }}"
                                                            {{ $city->id == $job_seeker_personal_info->permanent_city ? 'selected' : '' }}>
                                                            {{ $city->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('permanent_city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-12 my-2">
                                        <input type="checkbox" onchange="setCurrentToPermanent()" id="sameAddress"
                                            name="sameAddress"> <label for="sameAddress"> Same
                                            as Current</label>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Date
                                                of Birth<span class="red">*</span></label>
                                            <input type="date" class="form-control" id=""
                                                name="date_of_birth" placeholder="Enter your Date of Birth"
                                                value="{{ old('date_of_birth') ? old('date_of_birth') : (isset($job_seeker_personal_info) ? $job_seeker_personal_info->date_of_birth : '') }}">
                                            @error('date_of_birth')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Gender<span
                                                    class="red">*</span></label>
                                            <select name="gender" id="" class="form-control">
                                                <option value="" selected>--Select--
                                                </option>
                                                <option value="Male"
                                                    {{ old('gender') ? (old('gender') == 'Male' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->gender == 'Male' ? 'selected' : '') : '') }}>
                                                    Male</option>
                                                <option value="Female"
                                                    {{ old('gender') ? (old('gender') == 'Female' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->gender == 'Female' ? 'selected' : '') : '') }}>
                                                    Female</option>
                                                <option value="Other"
                                                    {{ old('gender') ? (old('gender') == 'Other' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->gender == 'Other' ? 'selected' : '') : '') }}>
                                                    Other</option>
                                            </select>
                                            @error('gender')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Mobile Number<span
                                                    class="red">*</span></label>
                                            <input type="text" class="form-control" id=""
                                                name="mobile_number" placeholder="Enter your Mobile Number"
                                                value="{{ old('mobile_number') ? old('mobile_number') : (isset($job_seeker_personal_info) ? $job_seeker_personal_info->mobile_number : '') }}">
                                            @error('mobile_number')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6 col-md-6">
                                        <?php
                                            $preferedJobs = $job_seeker_personal_info->preferedJobs->pluck('id')->toArray();
                                        ?>
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Prefered Job<span
                                                    class="red">*</span></label>
                                            <select name="prefered_job[]" id="preferedJobs" class="form-control" multiple="multiple">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('prefered_job') ? (in_array($category->id,old('prefered_job')) ? 'selected' : '') : (isset($preferedJobs) ? (in_array($category->id, $preferedJobs) ? 'selected' : '') : '') }}>
                                                        {{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('prefered_job')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <?php
                                            $preferedIndustry = $job_seeker_personal_info->preferedIndustry()->pluck('id')->toArray();
                                        ?>
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Prefered Industry<span
                                                    class="red">*</span></label>
                                            <select name="prefered_industry[]" id="preferedIndustry" class="form-control" multiple="multiple">
                                                @foreach ($industry as $data)
                                                    <option value="{{ $data->id }}"
                                                        {{ old('prefered_industry') ? (in_array($category->id,old('prefered_industry'))  ? 'selected' : '') : (isset($preferedIndustry) ? (in_array($data->id, $preferedIndustry) ? 'selected' : '') : '') }}>
                                                        {{ $data->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('prefered_industry')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Do
                                                you have license?<span class="red">*</span></label>
                                            <select name="license" id="" class="form-control">
                                                <option value="" selected>--Select--
                                                </option>

                                                <option value="Yes"
                                                    {{ old('license') ? (old('license') == 'Yes' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->have_license == 'Yes' ? 'selected' : '') : '') }}>
                                                    Yes</option>
                                                <option value="No"
                                                    {{ old('license') ? (old('license') == 'No' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->have_license == 'No' ? 'selected' : '') : '') }}>
                                                    No</option>
                                            </select>
                                            @error('license')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Do
                                                you have vehicle?<span class="red">*</span></label>
                                            <select name="vehicle" id="" class="form-control">
                                                <option value="" selected>--Select--
                                                </option>

                                                <option value="No"
                                                    {{ old('vehicle') ? (old('vehicle') == 'No' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->have_vehicle == 'No' ? 'selected' : '') : '') }}>
                                                    No</option>
                                                <option value="Two Wheeler"
                                                    {{ old('vehicle') ? (old('vehicle') == 'Two Wheeler' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->have_vehicle == 'Two Wheeler' ? 'selected' : '') : '') }}>
                                                    Two Wheeler</option>
                                                <option value="Four Wheeler"
                                                    {{ old('vehicle') ? (old('vehicle') == 'Four Wheeler' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->have_vehicle == 'Four Wheeler' ? 'selected' : '') : '') }}>
                                                    Four Wheeler</option>
                                                <option value="Both"
                                                    {{ old('vehicle') ? (old('vehicle') == 'Both' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->have_vehicle == 'Both' ? 'selected' : '') : '') }}>
                                                    Both</option>
                                            </select>
                                            @error('vehicle')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Maritial Status</label>
                                            <select name="maritial_status" id="" class="form-control">
                                                <option value="" selected>--Select--
                                                </option>

                                                <option value="Unmarried"
                                                    {{ old('maritial_status') ? (old('maritial_status') == 'Unmarried' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->maritial_status == 'Unmarried' ? 'selected' : '') : '') }}>
                                                    Unmarried</option>
                                                <option value="Married"
                                                    {{ old('maritial_status') ? (old('maritial_status') == 'Married' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->maritial_status == 'Married' ? 'selected' : '') : '') }}>
                                                    Married</option>
                                                <option value="Divorced"
                                                    {{ old('maritial_status') ? (old('maritial_status') == 'Divorced' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->maritial_status == 'Divorced' ? 'selected' : '') : '') }}>
                                                    Divorced</option>
                                                <option value="Seperated"
                                                    {{ old('maritial_status') ? (old('maritial_status') == 'Seperated' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->maritial_status == 'Seperated' ? 'selected' : '') : '') }}>
                                                    Seperated</option>
                                                <option value="Widowed"
                                                    {{ old('maritial_status') ? (old('maritial_status') == 'Widowed' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->maritial_status == 'Widowed' ? 'selected' : '') : '') }}>
                                                    Widowed</option>
                                                <option value="Other"
                                                    {{ old('maritial_status') ? (old('maritial_status') == 'Other' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->maritial_status == 'Other' ? 'selected' : '') : '') }}>
                                                    Other</option>
                                            </select>
                                            @error('maritial_status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Looking For</label>
                                            <select name="looking_for" id="" class="form-control">
                                                <option value="" selected>--Select--
                                                </option>
                                                @foreach ($employee_types as $type)
                                                    <option value="{{ $type->id }}"
                                                        {{ old('looking_for') ? (old('looking_for') == $type->id ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->looking_for == $type->id ? 'selected' : '') : '') }}>
                                                        {{ $type->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('looking_for')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Expected Salary (Monthly)</label>
                                            <select name="expected_salary" id="" class="form-control">
                                                <option value="" selected>--Select--
                                                </option>

                                                <option value="Below 10000"
                                                    {{ old('expected_salary') ? (old('expected_salary') == 'Below 10000' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->expected_salary == 'Below 10000' ? 'selected' : '') : '') }}>
                                                    Below 10000</option>
                                                <option value="10,000-20,000"
                                                    {{ old('expected_salary') ? (old('expected_salary') == '10,000-20,000' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->expected_salary == '10,000-20,000' ? 'selected' : '') : '') }}>
                                                    10,000-20,000</option>
                                                <option value="20,000-30,000"
                                                    {{ old('expected_salary') ? (old('expected_salary') == '20,000-30,000' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->expected_salary == '20,000-30,000' ? 'selected' : '') : '') }}>
                                                    20,000-30,000</option>
                                                <option value="30,000-40,000"
                                                    {{ old('expected_salary') ? (old('expected_salary') == '30,000-40,000' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->expected_salary == '30,000-40,000' ? 'selected' : '') : '') }}>
                                                    30,000-40,000
                                                </option>
                                                <option value="40,000-50,000"
                                                    {{ old('expected_salary') ? (old('expected_salary') == '40,000-50,000' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->expected_salary == '40,000-50,000' ? 'selected' : '') : '') }}>
                                                    40,000-50,000</option>
                                                <option value="Above 50,000"
                                                    {{ old('expected_salary') ? (old('expected_salary') == 'Above 50,000' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->expected_salary == 'Above 50,000' ? 'selected' : '') : '') }}>
                                                    Above 50,000
                                                </option>
                                                <option value="Negotiable"
                                                    {{ old('expected_salary') ? (old('expected_salary') == 'Negotiable' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->expected_salary == 'Negotiable' ? 'selected' : '') : '') }}>
                                                    Negotiable
                                                </option>
                                            </select>
                                            @error('expected_salary')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="meassageInput" class="form-label"></label>
                                            Your Career Objective<span class="red">*</span></label>
                                            <textarea class="form-control" id="meassageInput" placeholder="Enter  Your Career Objective" name="career_objective"
                                                id="comments" rows="5">{{ old('career_objective') ? old('career_objective') : (isset($job_seeker_personal_info) ? $job_seeker_personal_info->career_objective : '') }}</textarea>
                                            @error('career_objective')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                                <div class="text-left">
                                    <button type="submit" id="submit" name="submit" class="btn btn-primary">
                                        Save Profile </button>
                                </div>
                            </form>
                            <!--end form-->
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-education" role="tabpanel"
                        aria-labelledby="pills-education-tab">
                        <form
                            action="{{ isset($check_education_info) ? route('user.update_profile', auth()->user()->username) : route('user.storeProfile', auth()->user()->username) }}"
                            class="mt-3" method="post">

                            <input type="hidden" value="2" name="check_education_info" />
                            @csrf
                            @if (isset($check_education_info))
                                @method('put')
                            @endif

                            @php
                                if (isset($check_education_info->education_id)) {
                                    $educations = json_decode($check_education_info->education_id);
                                    $institution = json_decode($check_education_info->institution);
                                    $university = json_decode($check_education_info->university);
                                    $join_year = json_decode($check_education_info->join_year);
                                    $passed_year = json_decode($check_education_info->passed_year);
                                    $currently_study_data = json_decode($check_education_info->currently_study);
                                    $study_field_id = json_decode($check_education_info->study_field_id);
                                }
                            @endphp


                            @if (isset($educations))
                                @foreach ($educations as $k => $edu)
                                    <div class="education-info-body">
                                        <div class="education-info">
                                            <div class="education-heading">
                                                <div class="education-info-title">Education</div>
                                                <div class="btn delete-btn">
                                                    Delete
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Degree
                                                            <span class="red">*</span></label>
                                                        <select class="form-control field-study" name="degree[]">
                                                            <option selected="selected" value="">--select--
                                                            </option>
                                                            @foreach ($education as $e)
                                                                <option value="{{ $e->id }}"
                                                                    {{ $edu == $e->id ? 'selected' : '' }}>
                                                                    {{ $e->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('degree.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Filed
                                                            of Study<span class="red">*</span></label>
                                                        <select class="form-control field-study" name="filed_of_study[]">
                                                            <option selected="selected" value="">--select--</option>
                                                            @foreach ($study_field as $field)
                                                                <option value="{{ $field->id }}"
                                                                    {{ $study_field_id[$k] == $field->id ? 'selected' : '' }}>
                                                                    {{ $field->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('filed_of_study.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Institution <span
                                                                class="red">*</span></label>
                                                        <input type="text" name="institution[]" id="name"
                                                            class="form-control"
                                                            value="{{ old('institution.*') ? old('institution.*') : (isset($institution[$k]) ? $institution[$k] : '') }}">
                                                        @error('institution.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">University/Board
                                                            <span class="red">*</span></label>
                                                        <input type="text" name="board[]" id="name"
                                                            class="form-control"
                                                            value="{{ old('board.*') ? old('board.*') : (isset($university[$k]) ? $university[$k] : '') }}">
                                                        @error('board.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Joined
                                                            Year <span class="red">*</span></label>
                                                        <input type="text" name="joined_year[]" id="name"
                                                            class="form-control"
                                                            value="{{ old('joined_year.*') ? old('joined_year.*') : (isset($join_year[$k]) ? $join_year[$k] : '') }}">
                                                        @error('joined_year.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Passed
                                                            Year</label>
                                                        <input type="text" name="passed_year[]" id="name"
                                                            class="form-control"
                                                            value="{{ old('passed_year.*') ? old('passed_year.*') : (isset($passed_year[$k]) ? ($passed_year[$k] == 'Currently Studying' ? '' : $passed_year[$k]) : '') }}">
                                                        @error('passed_year.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-12">
                                                    <label for="current-{{ $k }}"><input type="checkbox"
                                                            name="currently_study[]" id="current-{{ $k }}"
                                                            value="Currently Studying"
                                                            {{ isset($passed_year[$k]) ? ($passed_year[$k] == 'Currently Studying' ? 'checked' : '') : '' }}>
                                                        I am currently studying here</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="education-info-body">
                                    <div class="education-info">
                                        <div class="education-heading">
                                            <div class="education-info-title">Education</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="nameInput" class="form-label">Degree
                                                        <span class="red">*</span></label>
                                                    <select class="form-control field-study" name="degree[]">
                                                        <option selected="selected" value="">--select--
                                                        </option>

                                                        @foreach ($education as $e)
                                                            <option value="{{ $e->id }}"
                                                                {{ old('degree') ? (old('degree') == $e->id ? 'selected' : '') : '' }}>
                                                                {{ $e->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('degree.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="nameInput" class="form-label">Filed
                                                        of Study<span class="red">*</span></label>
                                                    <select class="form-control field-study" name="filed_of_study[]">
                                                        <option selected="selected" value="">--select--</option>
                                                        @foreach ($study_field as $field)
                                                            <option value="{{ $field->id }}"
                                                                {{ old('filed_of_study') == $field->id ? 'selected' : '' }}>
                                                                {{ $field->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('filed_of_study.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="nameInput" class="form-label">Institution <span
                                                            class="red">*</span></label>
                                                    <input type="text" name="institution[]" id="name"
                                                        class="form-control" value="{{ old('institution.*') }}">
                                                    @error('institution.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="nameInput" class="form-label">University/Board
                                                        <span class="red">*</span></label>
                                                    <input type="text" name="board[]" id="name"
                                                        class="form-control" value="{{ old('board.*') }}">
                                                    @error('board.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="nameInput" class="form-label">Joined
                                                        Year <span class="red">*</span></label>
                                                    <input type="text" name="joined_year[]" id="name"
                                                        class="form-control" value="{{ old('joined_year.*') }}">
                                                    @error('joined_year.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="nameInput" class="form-label">Passed
                                                        Year</label>
                                                    <input type="text" name="passed_year[]" id="name"
                                                        class="form-control" value="{{ old('passed_year.*') }}">
                                                    @error('passed_year.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-12">
                                                <label for="current"><input type="checkbox" name="currently_study[]"
                                                        id="current" value="Currently Studying"
                                                        {{ old('currently_study.*') ? 'checked' : '' }}>
                                                    I am currently studying here</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <hr>
                            <div class="education-footer-btn">
                                <div class="text-left">
                                    <button id="add-more" class="btn btn-outline-danger" type="button">
                                        Add More <span class="icon"><i class="fa-solid fa-plus"></i></span>
                                    </button>
                                </div>
                                <div class="text-right">
                                    <button type="submit" id="submit" name="submit" class="btn btn-primary">
                                        Save Education </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-experience" role="tabpanel"
                        aria-labelledby="pills-experience-tab">
                        <form
                            action="{{ isset($check_experiance_info) ? route('user.update_profile', auth()->user()->username) : route('user.storeProfile', auth()->user()->username) }}"
                            class="mt-3" method="post">
                            <div class="experience-info-body">
                                <div class="education-info">


                                    @csrf
                                    @if (isset($check_experiance_info))
                                        @method('put')
                                    @endif
                                    @php
                                        if (isset($check_experiance_info->position)) {
                                            $position = json_decode($check_experiance_info->position);
                                            $orginazation_name = json_decode($check_experiance_info->organization_name);
                                            $industry = json_decode($check_experiance_info->industry);
                                            $job_level = json_decode($check_experiance_info->job_level);
                                            $left_year = json_decode($check_experiance_info->left_year);
                                            $joined_year = json_decode($check_experiance_info->joined_year);
                                            $roles_and_responsibility = json_decode($check_experiance_info->roles_and_responsibility);
                                        }
                                    @endphp
                                    <input type="hidden" name="check_experiance_info" value="3" />
                                    @if (isset($position))
                                        @foreach ($position as $key => $p)
                                            <div class="education-heading">
                                                <div class="education-info-title">Experience</div>
                                                <div class="btn delete-btn">Delete</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Position
                                                            <span class="red">*</span></label>
                                                        <input type="text" name="position[]" id="name"
                                                            class="form-control"
                                                            value="{{ old('position.*') ? old('position.*') : (isset($p) ? $p : '') }}">
                                                        @error('position.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Organization name
                                                            <span class="red">*</span></label>
                                                        <input type="text" name="organization_name[]" id="name"
                                                            class="form-control"
                                                            value="{{ old('organization_name.*') ? old('organization_name.*') : (isset($orginazation_name[$key]) ? $orginazation_name[$key] : '') }}">
                                                        @error('organization_name.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Industry<span
                                                                class="red">*</span></label>
                                                        <select class="form-control field-industry" name="industry[]">
                                                            <option selected="selected" value="">--select--
                                                            </option>
                                                            @foreach ($company as $com)
                                                                <option value="{{ $com->id }}"
                                                                    {{ $com->id == $industry[$key] ? 'selected' : '' }}>
                                                                    {{ $com->title }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                        @error('industry.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Job Level<span
                                                                class="red">*</span></label>
                                                        <select class="form-control field-industry" name="job_level[]">
                                                            <option selected="selected" value="">--select--
                                                            </option>
                                                            @foreach ($job_levels as $level)
                                                                <option value="{{ $level->id }}"
                                                                    {{ $level->id == $job_level[$key] ? 'selected' : '' }}>
                                                                    {{ $level->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('job_level.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="meassageInput" class="form-label"></label>
                                                        Roles and responsibility<span class="red">*</span></label>
                                                        <textarea class="form-control" id="meassageInput" placeholder="Enter  Your Career Objective" name="comments[]"
                                                            id="comments" rows="5">{{ old('comments.*') ? old('comments.*') : (isset($roles_and_responsibility[$key]) ? $roles_and_responsibility[$key] : '') }}</textarea>
                                                        @error('comments.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Joined
                                                            Year <span class="red">*</span></label>
                                                        <input type="text" name="joined_year[]" id="name"
                                                            class="form-control"
                                                            value="{{ old('joined_year.*') ? old('joined_year.*') : (isset($joined_year[$key]) ? $joined_year[$key] : '') }}">
                                                        @error('joined_year.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Left
                                                            Year <span class="red">*</span></label>
                                                        <input type="text" name="lefted_year[]" id="name"
                                                            class="form-control"
                                                            value="{{ old('lefted_year.*') ? old('lefted_year.*') : (isset($left_year[$key]) ? ($left_year[$key] == 'Currently Working' ? '' : $left_year[$key]) : '') }}">
                                                        @error('lefted_year.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-12">
                                                    <label for="current"><input type="checkbox"
                                                            name="currently_working[]" id="current"
                                                            value="Currently Working"
                                                            {{ isset($left_year[$key]) ? ($left_year[$key] == 'Currently Working' ? 'checked' : '') : '' }}>
                                                        I am currently working here</label>
                                                    @error('current_working.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    @else
                                        <div class="education-info">
                                            <div class="education-heading">
                                                <div class="education-info-title">Experience</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Position
                                                            <span class="red">*</span></label>
                                                        <input type="text" name="position[]" id="name"
                                                            class="form-control" value="{{ old('position.*') }}">
                                                        @error('position.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Organization name
                                                            <span class="red">*</span></label>
                                                        <input type="text" name="organization_name[]" id="name"
                                                            class="form-control"
                                                            value="{{ old('organization_name.*') }}">
                                                        @error('organization_name.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Industry<span
                                                                class="red">*</span></label>
                                                        <select class="form-control field-industry" name="industry[]">
                                                            <option selected="selected" value="">--select--
                                                            </option>
                                                            @foreach ($company as $com)
                                                                <option value="{{ $com->id }}"
                                                                    {{ $com->id == old('industry') ? 'selected' : '' }}>
                                                                    {{ $com->title }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                        @error('industry.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Job Level<span
                                                                class="red">*</span></label>
                                                        <select class="form-control field-industry" name="job_level[]">
                                                            <option selected="selected" value="">--select--
                                                            </option>
                                                            @foreach ($job_levels as $level)
                                                                <option value="{{ $level->id }}"
                                                                    {{ $level->id == old('job_level') ? 'selected' : '' }}>
                                                                    {{ $level->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('job_level.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="meassageInput" class="form-label"></label>
                                                        Roles and responsibility<span class="red">*</span></label>
                                                        <textarea class="form-control" id="meassageInput" placeholder="Enter  Your Career Objective" name="comments[]"
                                                            id="comments" rows="5">{{ old('comments.*') }}</textarea>
                                                        @error('comments.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Joined
                                                            Year <span class="red">*</span></label>
                                                        <input type="text" name="joined_year[]" id="name"
                                                            class="form-control" value="{{ old('joined_year.*') }}">
                                                        @error('joined_year.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Left
                                                            Year <span class="red">*</span></label>
                                                        <input type="text" name="lefted_year[]" id="name"
                                                            class="form-control" value="{{ old('lefted_year.*') }}">
                                                        @error('lefted_year.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-12">
                                                    <label for="current"><input type="checkbox" name="current_working[]"
                                                            id="current" value="Currently Working"
                                                            {{ old('current_working.*') ? 'checked' : '' }}>
                                                        I am currently working here</label>
                                                    @error('current_working.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <hr>
                                </div>
                            </div>

                            <div class="education-footer-btn">
                                <div class="text-left">
                                    <button id="add-experience" name="submit" type="button"
                                        class="btn btn-outline-danger">
                                        Add More <span class="icon"><i class="fa-solid fa-plus"></i></span> </button>
                                </div>
                                <div class="text-right">
                                    <button type="submit" id="submit" name="submit" class="btn btn-primary">
                                        Save Experience </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-extra" role="tabpanel" aria-labelledby="pills-extra-tab">
                        <div class="extra-info-body">

                            <div class="skill-info">
                                <form
                                    action="{{ isset($check_additional_info) ? route('user.update_profile', auth()->user()->username) : route('user.storeProfile', auth()->user()->username) }}"
                                    method="post" class="my-2">
                                    @csrf
                                    @if (isset($check_additional_info))
                                        @method('put')
                                    @endif
                                    <input type="hidden" value="4" name="check_additional_info">
                                    @php
                                        if (isset($check_additional_info->skill)) {
                                            $skill = json_decode($check_additional_info->skill);
                                        }
                                        $s = [];
                                        if (isset($skill)) {
                                            foreach ($skill as $sk) {
                                                array_push($s, $sk);
                                            }
                                        }

                                    @endphp
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="nameInput" class="form-label education-info-title">Skills</label>
                                            <select id="" class="form-control field-industry"
                                                multiple="multiple" name="skill[]">
                                                @foreach ($skills as $skill)
                                                    <option value="{{ $skill->id }}"
                                                        @if (in_array($skill->id, $s)) selected @endif>
                                                        {{ $skill->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('skill.*')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="language-info">
                                        <div class="row">
                                            <div class="col-12">
                                                @php
                                                    $lang = [];
                                                    if (isset($check_additional_info->language)) {
                                                        $language = json_decode($check_additional_info->language);

                                                        foreach ($language as $l) {
                                                            array_push($lang, $l);
                                                        }
                                                    }

                                                @endphp
                                                <label for="nameInput"
                                                    class="form-label education-info-title">Language</label>
                                                <select id="" class="form-control field-industry"
                                                    multiple="multiple" name="language[]">
                                                    @foreach ($languages as $language)
                                                        <option value="{{ $language->id }}"
                                                            @if (in_array($language->id, $lang)) selected @endif>
                                                            {{ $language->title }}</option>
                                                    @endforeach
                                                </select>
                                                @error('language.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    @php
                                        if (isset($job_seeker_training->training_title)) {
                                            $training_title = json_decode($job_seeker_training->training_title);
                                        }
                                        if (isset($job_seeker_training->training_year)) {
                                            $training_year = json_decode($job_seeker_training->training_year);
                                        }
                                        if (isset($job_seeker_training->training_institution)) {
                                            $training_institution = json_decode($job_seeker_training->training_institution);
                                        }
                                    @endphp
                                    @if (isset($training_title))
                                        <div class="education-info shadow-sidebar p-2 r-5 mb-2">
                                            <div class="training-info-body">
                                                @foreach ($training_title as $key => $training)
                                                    <div class="training-info">
                                                        <div class="education-heading">
                                                            <div class="education-info-title mb-0 px-1 pt-2">Training</div>
                                                            <div class="btn delete-btn">Delete</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="nameInput" class="form-label">Title
                                                                    </label>
                                                                    <input type="text" name="traning_title[]"
                                                                        id="name" class="form-control"
                                                                        value="{{ old('traning_title.*', $training) }}">
                                                                    @error('traning_title.*')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="nameInput" class="form-label">
                                                                        Year </label>
                                                                    <input type="text" name="traning_year[]"
                                                                        id="name" class="form-control"
                                                                        value="{{ old('traning_year.*', $training_year[$key]) }}">
                                                                    @error('traning_year.*')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="nameInput" class="form-label">
                                                                        Institution </label>
                                                                    <input type="text" name="institution_name[]"
                                                                        id="name" class="form-control"
                                                                        value="{{ old('institution_name.*', $training_institution[$key]) }}">
                                                                    @error('institution_name.*')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="education-info shadow-sidebar p-2 r-5 mb-2">
                                            <div class="training-info-body">
                                                <div class="training-info">
                                                    <div class="education-heading">
                                                        <div class="education-info-title mb-0 px-1 pt-2">Training</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="nameInput" class="form-label">Title
                                                            </label>
                                                            <input type="text" name="traning_title[]" id="name"
                                                                class="form-control"
                                                                value="{{ old('traning_title.*') }}">
                                                            @error('traning_title.*')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="nameInput" class="form-label">
                                                                Year </label>
                                                            <input type="text" name="traning_year[]" id="name"
                                                                class="form-control"
                                                                value="{{ old('traning_year.*') }}">
                                                            @error('traning_year.*')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="nameInput" class="form-label">
                                                                Institution </label>
                                                            <input type="text" name="institution_name[]"
                                                                id="name" class="form-control"
                                                                value="{{ old('institution_name.*') }}">
                                                            @error('institution_name.*')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="education-footer-btn mt-2">
                                        <div class="text-left">
                                            <button id="add-training" name="submit" type="button"
                                                class="btn btn-outline-danger">
                                                Add More <span class="icon"><i class="fa-solid fa-plus"></i></span>
                                            </button>
                                        </div>
                                    </div>

                                    @php
                                        if (isset($job_seeker_social_networks->social_name)) {
                                            $social_name = json_decode($job_seeker_social_networks->social_name);
                                        }
                                        if (isset($job_seeker_social_networks->social_url)) {
                                            $social_url = json_decode($job_seeker_social_networks->social_url);
                                        }
                                    @endphp
                                    @if (isset($social_name))
                                        <div class="education-info shadow-sidebar p-2 r-5 mb-2">

                                            <div class="social-info-body">
                                                @foreach ($social_name as $key => $social)
                                                    <div class="social-info">
                                                        <div class="education-heading">
                                                            <div class="education-info-title mb-0 px-1 pt-2">Add Social
                                                                Network</div>
                                                            <div class="fs-18"></div>
                                                            <div class="btn delete-btn">Delete</div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="nameInput" class="form-label">Social Media
                                                                    Name
                                                                </label>
                                                                <input type="text" name="social_name[]" id="name"
                                                                    class="form-control"
                                                                    value="{{ old('social_name.*', $social) }}">
                                                                @error('social_name.*')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="nameInput" class="form-label">
                                                                    Profile Url </label>
                                                                <input type="text" name="profile_url[]" id="name"
                                                                    class="form-control"
                                                                    value="{{ old('profile_url.*', $social_url[$key]) }}">
                                                                @error('profile_url.*')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>
                                                @endforeach
                                            </div>

                                        </div>
                                    @else
                                        <div class="education-info shadow-sidebar p-2 r-5 mb-2">
                                            <div class="social-info-body">
                                                <div class="social-info">
                                                    <div class="education-heading">
                                                        <div class="education-info-title mb-0 px-1 pt-2">Add Social
                                                            Network</div>
                                                        <div class="fs-18"></div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="nameInput" class="form-label">Social Media
                                                                    Name
                                                                </label>
                                                                <input type="text" name="social_name[]" id="name"
                                                                    class="form-control" value="">
                                                                @error('social_name.*')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="nameInput" class="form-label">
                                                                    Profile Url </label>
                                                                <input type="text" name="profile_url[]" id="name"
                                                                    class="form-control" value="">
                                                                @error('profile_url.*')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="education-footer-btn mt-2">
                                        <div class="text-left">
                                            <button id="add-social" type="button" name="submit"
                                                class="btn btn-outline-danger">
                                                Add More <span class="icon"><i class="fa-solid fa-plus"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                    @php
                                        if (isset($job_seeker_reference->reference_person)) {
                                            $ref_person = json_decode($job_seeker_reference->reference_person);
                                        }
                                        if (isset($job_seeker_reference->reference_position)) {
                                            $ref_position = json_decode($job_seeker_reference->reference_position);
                                        }
                                        if (isset($job_seeker_reference->reference_email)) {
                                            $ref_email = json_decode($job_seeker_reference->reference_email);
                                        }
                                        if (isset($job_seeker_reference->reference_company)) {
                                            $ref_company = json_decode($job_seeker_reference->reference_company);
                                        }
                                        if (@$job_seeker_reference->reference_mobile) {
                                            $ref_mobile = json_decode($job_seeker_reference->reference_mobile);
                                        }
                                        if (@$job_seeker_reference->reference_phone) {
                                            $ref_phone = json_decode($job_seeker_reference->reference_phone);
                                        }
                                    @endphp
                                    @if (isset($ref_person))
                                        <div class="education-info shadow-sidebar p-2 r-5 mb-2">
                                            <div class="reference-info-body">
                                                <div class="reference-info">
                                                    <div class="education-heading">
                                                        <div class="education-info-title mb-0 px-1 pt-2">Add Reference
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach ($ref_person as $key => $person)
                                                    <div class="reference-info">
                                                        <div class="education-heading" style="float:right;">
                                                            <div class="btn delete-btn">Delete</div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="nameInput" class="form-label">Reference
                                                                        Person
                                                                    </label>
                                                                    <input type="text" name="reference_person_name[]"
                                                                        id="name" class="form-control"
                                                                        value="{{ old('reference_person_name.*', $person) }}">
                                                                    @error('reference_person_name.*')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="nameInput" class="form-label">
                                                                        Position </label>
                                                                    <input type="text" name="position[]"
                                                                        id="name" class="form-control"
                                                                        value="{{ old('position.*', $ref_position[$key]) }}">
                                                                    @error('position.*')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="nameInput" class="form-label">Phone
                                                                    </label>
                                                                    <input type="text" name="phone[]" id="name"
                                                                        class="form-control"
                                                                        value="{{ old('phone.*', @$ref_phone[$key]) }}">
                                                                    @error('phone.*')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="nameInput" class="form-label">
                                                                        Mobile </label>
                                                                    <input type="text" name="mobile[]" id="name"
                                                                        class="form-control"
                                                                        value="{{ old('mobile.*', @$ref_mobile[$key]) }}">
                                                                    @error('mobile.*')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="nameInput" class="form-label">Email
                                                                    </label>
                                                                    <input type="email" name="email[]" id="name"
                                                                        class="form-control"
                                                                        value="{{ old('email.*', $ref_email[$key]) }}">
                                                                    @error('email.*')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="nameInput" class="form-label">
                                                                        Organization Name </label>
                                                                    <input type="text" name="company[]" id="name"
                                                                        class="form-control"
                                                                        value="{{ old('company.*', $ref_company[$key]) }}">
                                                                    @error('company.*')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="education-info shadow-sidebar p-2 r-5 mb-2">
                                            <div class="education-info-title mb-0 px-1 pt-2">Add
                                                Reference
                                            </div>

                                            <div class="reference-info-body">
                                                <div class="reference-info">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="nameInput" class="form-label">Reference
                                                                    Person
                                                                </label>
                                                                <input type="text" name="reference_person_name[]"
                                                                    id="name" class="form-control"
                                                                    value="{{ old('reference_person_name.*') }}">
                                                                @error('reference_person_name.*')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="nameInput" class="form-label">
                                                                    Position </label>
                                                                <input type="text" name="position[]" id="name"
                                                                    class="form-control"
                                                                    value="{{ old('position.*') }}">
                                                                @error('position.*')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="nameInput" class="form-label">Email
                                                                </label>
                                                                <input type="email" name="email[]" id="name"
                                                                    class="form-control" value="{{ old('email.*') }}">
                                                                @error('email.*')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="nameInput" class="form-label">
                                                                    Organization Name </label>
                                                                <input type="text" name="company[]" id="name"
                                                                    class="form-control" value="{{ old('company.*') }}">
                                                                @error('company.*')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="education-footer-btn mt-2">
                                        <div class="text-left">
                                            <button id="add-reference" type="button" name="submit"
                                                class="btn btn-outline-danger">
                                                Add More <span class="icon"><i class="fa-solid fa-plus"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-right mt-2">
                                        <button type="submit" id="submit" name="submit"
                                            class="btn btn-primary">
                                            Save Changes </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 2,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            loop: true,
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 00,
                },
            },
        });

        $('document').ready(function() {
            $('.dropify').dropify();
        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('frontend/assets/js/pages/switcher.init.js') }}"></script>

    <script src="{{ asset('frontend/assets/js/pages/index.init.js') }}"></script>

    <script src="{{ asset('frontend/assets/js/app.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>

    @if (@$k)
        <script>
            var i = {{ $k }};
        </script>
    @endif

    <script>
        window.onload = function() {
            setCurrentToPermanent();
        }
    </script>

    <script>
        $(document).scroll(function() {
            var y = $(this).scrollTop();
            if (y > 300) {
                $('.footer-fixed').addClass("add-sticky");
            } else {
                $('.footer-fixed').removeClass("add-sticky");
            }
        });

        $('.currently_study').click(function() {

        });
        $(".see-more").click(function() {
            $(this).siblings(".checkbox-list").addClass('more-view');
            $(this).siblings(".see-less").removeClass('d-none');
            $(this).addClass('d-none');
        });
        $(".see-less").click(function() {
            $(this).siblings(".checkbox-list").removeClass('more-view');
            $(this).siblings(".see-more").removeClass('d-none');
            $(this).addClass('d-none');
        });

        $(".field-study, .field-industry, #preferedJobs, #preferedIndustry").select2({
            tags: true
        });

        // $(".delete-btn").click(function () {
        //     $(this).closest(".education-info").remove();
        // });

        $("#pills-education").on("click", ".delete-btn", function() {
            $(this).closest(".education-info").remove();
        });

        $("#add-more").click(function() {
            i++;
            $(".education-info-body").append(`<div class="education-info"><div class="education-heading"><div class="education-info-title">Education</div><div class="btn delete-btn">Delete</div></div><div class="row"><div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nameInput"
                                                    class="form-label">Degree
                                                    <span class="red">*</span></label>
                                                <select class="form-control field-study" name="degree[]" required>
                                                    <option selected="selected" value="">--select--
                                                    </option>
                                                   @foreach ($education as $e)
                                                    <option value="{{ $e->id }}">{{ $e->title }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('degree.*')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nameInput"
                                                    class="form-label">Filed
                                                    of Study<span
                                                        class="red">*</span></label>
                                                <select class="form-control field-study" name="filed_of_study[]" required>
                                                    <option selected="selected" value="">--Select--</option>
                                                        @foreach ($study_field as $field)
                                                    <option value="{{ $field->id }}">{{ $field->title }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('filed_of_study.*')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="nameInput"
                                                    class="form-label">Institution <span
                                                        class="red">*</span></label>
                                                <input type="text" name="institution[]" id="name"
                                                    class="form-control" required>
                                                    @error('institution.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="nameInput"
                                                    class="form-label">University/Board
                                                    <span class="red">*</span></label>
                                                <input type="text" name="board[]" id="name"
                                                    class="form-control" required>
                                                    @error('board.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="nameInput"
                                                    class="form-label">Joined
                                                    Year <span class="red">*</span></label>
                                                <input type="text" name="joined_year[]" id="name"
                                                    class="form-control" required>
                                                    @error('joined_year.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="nameInput"
                                                    class="form-label">Passed
                                                    Year </label>
                                                <input type="text" name="passed_year[]" id="name"
                                                    class="form-control">
                                                    @error('passed_year.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                        </div> <div class="col-12">
                                            <label for="current-` + i + `"><input type="checkbox"
                                                    name="currently_study[]" id="current-` + i + `" value="1">
                                                I am currently studying here</label>
                                        </div></div><hr></div>`)
        })

        $("#pills-experience").on("click", ".delete-btn", function() {
            $(this).closest(".education-info").remove();
        });

        $("#add-experience").click(function() {
            $(".experience-info-body").append(
                `<div class="education-info"><div class="education-heading"><div class="education-info-title">Experience</div><div class="btn delete-btn">Delete</div></div> <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nameInput" class="form-label">Position
                                                    <span class="red">*</span></label>
                                                <input type="text" name="position[]" id="name"
                                                    class="form-control">
                                                @error('position.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nameInput" class="form-label">Organization name
                                                    <span class="red">*</span></label>
                                                <input type="text" name="organization_name[]" id="name"
                                                    class="form-control" >
                                                @error('organization_name.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nameInput" class="form-label">Industry<span
                                                        class="red">*</span></label>
                                                <select class="form-control field-industry" name="industry[]">
                                                    <option selected="selected" value="">--select--
                                                    </option>
                                                    @foreach ($company as $com)
                                                        <option value="{{ $com->id }}">{{ $com->title }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                @error('industry.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nameInput" class="form-label">Job Level<span
                                                        class="red">*</span></label>
                                                <select class="form-control field-industry" name="job_level[]">
                                                    <option selected="selected" value="">--select--
                                                    </option>
                                                    @foreach ($job_levels as $level)
                                                        <option value="{{ $level->id }}">{{ $level->title }}</option>
                                                    @endforeach
                                                </select>
                                                @error('job_level.*')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="meassageInput" class="form-label"></label>
                                                Roles and responsibility<span class="red">*</span></label>
                                                <textarea class="form-control" id="meassageInput" placeholder="Enter  Your Career Objective" name="comments[]"
                                                    id="comments" rows="5"></textarea>
                                                    @error('comments.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="nameInput" class="form-label">Joined
                                                    Year <span class="red">*</span></label>
                                                <input type="text" name="joined_year[]" id="name"
                                                    class="form-control" value="">
                                                    @error('joined_year.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="nameInput" class="form-label">Left
                                                    Year <span class="red">*</span></label>
                                                <input type="text" name="lefted_year[]" id="name"
                                                    class="form-control" value="">
                                                    @error('lefted_year.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-12">
                                            <label for="current"><input type="checkbox" name="current_working[]"
                                                    id="current" value="1">
                                                I am currently working here</label>
                                                @error('current_working.*')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div><hr></div>`
            )
        })
        $("#pills-extra").on("click", ".delete-btn", function() {
            $(this).closest(".training-info").remove();
        });
        $("#add-training").click(function() {
            $(".training-info-body").append(
                `<div class="training-info">
                    <div class="education-heading">
                        <div class="fs-18">Training</div>
                        <div class="btn delete-btn">Delete</div>
                        </div>
                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="nameInput" class="form-label">Title
                                                    </label>
                                                    <input type="text" name="traning_title[]" id="name"
                                                        class="form-control">
                                                        @error('traning_title.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="nameInput" class="form-label">
                                                        Year </label>
                                                    <input type="text" name="traning_year[]" id="name"
                                                        class="form-control" >
                                                        @error('traning_year.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="nameInput" class="form-label">
                                                        Institution </label>
                                                    <input type="text" name="institution_name[]" id="name"
                                                        class="form-control" >
                                                        @error('institution_name.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </div>
                                            </div>
                                        </div>
                    </div>
                    `
            )
        })
        $("#pills-extra").on("click", ".delete-btn", function() {
            $(this).closest(".social-info").remove();
        });
        $("#add-social").click(function() {
            $(".social-info-body").append(
                '<div class="social-info"><div class="education-heading"><div class="fs-18">Add Social Network</div><div class="btn delete-btn">Delete</div></div><div class="row"><div class="col-md-6"><div class="mb-3"><label for="nameInput" class="form-label">Social Media Name</label><input type="text" name="social_name[]" id="name" class="form-control" value=""></div></div><div class="col-lg-6"><div class="mb-3"><label for="nameInput" class="form-label">Profile Url </label><input type="text" name="profile_url[]" id="name" class="form-control" value=""></div></div></div></div>'
            )
        })
        $("#pills-extra").on("click", ".delete-btn", function() {
            $(this).closest(".reference-info").remove();
        });
        $("#add-reference").click(function() {
            $(".reference-info-body").append(
                `<div class="reference-info"><div class="education-heading"><div class="fs-18">Reference</div><div class="btn delete-btn">Delete</div></div><div class="row"><div class="col-md-6"><div class="mb-3"><label for="nameInput" class="form-label">Reference Person</label><input type="text" name="reference_person_name[]" id="name" class="form-control" value=""></div></div><div class="col-md-6"><div class="mb-3"><label for="nameInput" class="form-label">Position </label><input type="text" name="position[]" id="name" class="form-control" value=""></div></div><div class="col-md-6"><div class="mb-3"><label for="nameInput" class="form-label">Phone </label><input type="text" name="phone[]" id="name" class="form-control" value=""></div></div><div class="col-md-6"><div class="mb-3"><label for="nameInput" class="form-label">Mobile </label><input type="text" name="mobile[]" id="name" class="form-control" value=""></div></div><div class="col-md-6"><div class="mb-3"><label for="nameInput" class="form-label">Email</label><input type="email" name="email[]" id="name" class="form-control" value=""></div></div><div class="col-md-6"><div class="mb-3"><label for="nameInput"class="form-label">Organization Name </label><input type="text" name="company[]" id="name" class="form-control" value=""></div></div></div><hr></div>`
            )
        })

        $("#menu-dropdown").click(function() {
            $(".mobile-dropdown").toggleClass("menu-toggle");
        })

        function district(e) {
            name = e.name;
            $.get('{{ route('user.district', [auth()->user()->username, '']) }}/' + e.value, function(data, status) {
                if (name == 'current_province') {
                    $("[name ='current_district']").find('option').remove();
                    $("[name ='current_district']").append('<option disabled selected>Select District</option>' +
                        data.html);
                } else if (name == 'permanent_province') {
                    $("[name ='permanent_district']").find('option').remove();
                    $("[name ='permanent_district']").append('<option disabled selected>Select District</option>' +
                        data.html);
                }
            });
        }

        function city(e) {
            name = e.name;
            $.get('{{ route('user.city', [auth()->user()->username, '']) }}/' + e.value, function(data, status) {
                if (name == 'current_district') {
                    $("[name ='current_city']").find('option').remove();
                    $("[name ='current_city']").append('<option disabled selected>Select City</option>' + data
                        .html);
                } else if (name == 'permanent_district') {
                    $("[name ='permanent_city']").find('option').remove();
                    $("[name ='permanent_city']").append('<option disabled selected>Select City</option>' + data
                        .html);
                }
            });
        }
    </script>

    {{-- Current Address to Permanent --}}
    <script>
        function setCurrentToPermanent() {
            value = $('#sameAddress').is(':checked');
            if (value) {
                $('[name = "permanent_province"]').prop('disabled', 'true');
                $('[name = "permanent_district"]').prop('disabled', 'true');
                $('[name = "permanent_city"]').prop('disabled', 'true');
            } else {
                $('#permanent_province').prop('disabled', false);
                $('#permanent_district').prop('disabled', false);
                $('#permanent_city').prop('disabled', false);
            }
        }
    </script>
@endpush
