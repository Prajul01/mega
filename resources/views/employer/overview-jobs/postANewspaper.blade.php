@extends('employer.overview-jobs.layouts.app')<?php
if (request()->routeIs('employers.postANewspaper')) {
    $flag = 1;
} else {
    $flag = 0;
}
?>
@section('title', ($flag ? 'Post' : 'Edit') . ' A Job')
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.css') }}">
@endpush
@section('dashboard_content')
    <div class="card candidate-info shadow-sidebar mt-0 mb-3 mt-lg-0">
        <div class="card-body p-0">
            <div class="job-summary-tab mt-0">
                <div class="postjob-title">
                    Post A New Job
                </div>
                <div class="postjob-info-form px-3 pb-3">
                    <?php
                        if(@$flag)
                        {
                            $url = route('employers.post-a-newspaper');
                        }else{
                            $url = route('employers.edit-a-newspaper', $job->slug);
                        }
                    ?>
                    <form method="post" action="{{ $url }}" onsubmit="return validateForm()"
                        class="contact-form mt-4" name="myForm" id="myForm" enctype="multipart/form-data">
                        @csrf
                        <span id="error-msg"></span>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nameInput" class="form-label">Job Title<span class="red">*</span></label>
                                    <input type="text" name="job_title" id="name" class="form-control"
                                        placeholder="Job Title"
                                        value="{{ old('job_title') ? old('job_title') : @$job->title }}">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">No. of
                                        Openings</label>
                                    <input type="number" name="no_of_opening" id="name" class="form-control"
                                        min="1"
                                        value="{{ old('no_of_opening') ? old('no_of_opening') : @$job->no_of_opening }}">

                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Choose
                                        Category<span class="red">*</span></label>
                                    <select name="category" id="" class="form-control field-industry">
                                        <option value="" {{ @$flag ? 'selected' : '' }}>--Select--
                                        </option>
                                        @foreach ($company_category as $category)
                                            <option value="{{ base64_encode($category->id) }}"
                                                {{ old('category') ? (old('category') == $category->id ? 'selected' : '') : (@$job->company_category_id == $category->id ? 'selected' : '') }}>
                                                {{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Job Post
                                        From<span class="red">*</span></label>
                                    <input type="text" class="form-control" id="" name="job_post" placeholder=""
                                        value="{{ old('job_post') ? old('job_post') : @$job->job_post_from }}">
                                </div>
                            </div> --}}
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Job
                                        Level<span class="red">*</span></label>

                                    <select name="job_level" id="" class="form-control">
                                        <option disabled {{ @$flag ? 'selected' : '' }}>--Select Job Level--</option>
                                        @foreach ($job_levels as $level)
                                            <option value="{{ base64_encode($level->id) }}"
                                                {{ old('job_level') ? (old('job_level') == $level->id ? 'selected' : '') : (@$job->job_level_id == $level->id ? 'selected' : '') }}>
                                                {{ $level->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Post on<span class="red">*</span></label>
                                    <input type="date" class="form-control" name="post_on"
                                        value="{{ date('Y-m-d', strtotime(old('post_on', @$job->start_date) ? old('post_on', @$job->start_date) : today())) }}">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Expires on<span
                                            class="red">*</span></label>
                                    <input type="date" class="form-control" name="expires_on"
                                        value="{{ date('Y-m-d', strtotime(old('expires_on', @$job->expiry_date) ? old('expires_on', @$job->expiry_date) : today()->addDays(15))) }}">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Desired
                                        Candidate<span class="red">*</span></label>
                                    <select name="desired_candidate" id="" class="form-control">
                                        <option value="" {{ @$flag ? 'selected' : '' }}>Select your desired
                                            Candidated
                                        </option>
                                        <option value="0"
                                            {{ old('desired_candidate') ? (old('desired_candidate') == 0 ? 'selected' : '') : (@$job->desired_candidate == 0 ? 'selected' : '') }}>
                                            Male</option>
                                        <option value="1"
                                            {{ old('desired_candidate') ? (old('desired_candidate') == 1 ? 'selected' : '') : (@$job->desired_candidate == 1 ? 'selected' : '') }}>
                                            Female</option>
                                        <option value="2"
                                            {{ old('desired_candidate') ? (old('desired_candidate') == 2 ? 'selected' : '') : (@$job->desired_candidate == 2 ? 'selected' : '') }}>
                                            Both</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Education
                                        Level<span class="red">*</span></label>
                                    <select name="education_level" class="form-control field-study">
                                        <option disabled {{ @$flag ? 'selected' : '' }}>--Select Education level--</option>
                                        @foreach ($educations as $education)
                                            <option value="{{ base64_encode($education->id) }}"
                                                {{ old('education_level') ? (old('education_level') == $education->id ? 'selected' : '') : (@$job->education_id == $education->id ? 'selected' : '') }}>
                                                {{ $education->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Experience
                                        Year<span class="red">*</span></label>
                                    <select name="experience_year" class="form-control field-study">
                                        <option selected>-- Choose Experience --</option>
                                        @foreach ($experiences as $experience)
                                            <option value="{{ base64_encode($experience->id) }}"
                                                {{ old('experience_year') ? (old('experience_year') == $education->id ? 'selected' : '') : (@$job->experience_id == $education->id ? 'selected' : '') }}>
                                                {{ $experience->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Province<span
                                            class="red">*</span></label>
                                    <select name="province" id="province" class="form-control field-study"
                                        onchange="provinceSelect(this)">
                                        <option value="0" {{ @$flag ? 'selected' : '' }}>--Select Province--
                                        </option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ base64_encode($province->id) }}"
                                                {{ old('province') ? (old('province') == $province->id ? 'selected' : '') : (@$job->province_id == $province->id ? 'selected' : '') }}>
                                                {{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Districts<span
                                            class="red">*</span></label>
                                    <select name="districts" id="districts" class="form-control field-study"
                                        onchange="districtSelect(this)">
                                        <option value="0" {{ @$flag ? 'selected' : '' }}>--Select District--</option>
                                        @if (!@$flag)
                                            @foreach ($selectedDistricts as $district)
                                                <option value="{{ $district->id }}"
                                                    {{ old('district') ? (old('district') == $district->id ? 'selected' : '') : (@$job->district_id == $district->id ? 'selected' : '') }}>
                                                    {{ $district->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">City/
                                        Tole<span class="red">*</span></label>
                                    <select name="city" id="city" class="form-control field-study">
                                        <option value="0" selected>--Select City--</option>
                                        @if (!@$flag)
                                            @foreach ($selectedCities as $city)
                                                <option value="{{ $city->id }}"
                                                    {{ old('city') ? (old('city') == $city->id ? 'selected' : '') : (@$job->city_id == $city->id ? 'selected' : '') }}>
                                                    {{ $city->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-6"></div>
                            <!-- <div class="col-6 col-sm-3 col-md-2">
                                    <label for="emailInput" class="form-label">Salary<span class="red">*</span></label>
                                    <select name="" id="" class="form-control field-study">
                                        <option value="">NRs.</option>
                                        <option value="">USD</option>
                                    </select>
                                </div> -->
                            <div class="col-6 col-sm-4 col-md-4 col-md-2 mb-2">
                                <label for="emailInput" class="form-label">Salary Pay<span
                                        class="red">*</span></label>
                                <select name="salary_pay" id="" class="form-control field-study">
                                    <?php
                                    $pay_array = ['monthly', 'yearly'];
                                    ?>
                                    <option disabled {{ @$flag ? 'selected' : '' }}>--Select Pay Type--</option>
                                    @foreach ($pay_array as $data)
                                        <option value="monthly"
                                            {{ old('salary_pay') ? (old('salary_pay') == $data ? 'selected' : '') : (@$job->pay_type == $data ? 'selected' : '') }}>
                                            {{ ucfirst($data) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Salary
                                        Range<span class="red">*</span></label>
                                    <select name="salary_range" id="" class="form-control field-study">
                                        <option value="" {{ @$flag ? 'selected' : '' }}>--Salary Range--
                                        </option>
                                        <?php
                                        $salary_array = ['10,000-20,000', '20,000-30,000', '30,000-40,000', '40,000-50,000', '50,000-60,000', '60,000-70,000', 'more than 70,000'];
                                        ?>
                                        @foreach ($salary_array as $data)
                                            <option value="{{ $data }}"
                                                {{ old('salary_range') ? (old('salary_range') == $data ? 'selected' : '') : (@$job->salary_range == $data ? 'selected' : '') }}>
                                                {{ $data }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">License<span
                                            class="red">*</span></label>
                                    <select name="license[]" id="" class="form-control field-study"
                                        multiple="multiple">
                                        <option value="0" {{ @$job->license != null ? 'selected' : '' }}>No</option>
                                        @foreach ($vehicles as $vehicle)
                                            <?php
                                            if(!@$flag)
                                            {
                                                foreach ($job->vehicles as $data) {
                                                    if($data->vehicle_id == $vehicle->id)
                                                    {
                                                        $licFlag = 1;
                                                        break;
                                                    }else{
                                                        $licFlag = 0;
                                                    }
                                                }
                                            }

                                            ?>
                                            <option value="{{ $vehicle->id }}" {{ @$licFlag? 'selected': '' }}>
                                                {{ $vehicle->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Skills<span
                                            class="red">*</span></label>
                                    <select name="skills[]" id="" class="form-control field-study"
                                        multiple="multiple">
                                        @foreach ($skills as $skill)
                                        <?php
                                        if(!@$flag){
                                            foreach($job->job_skills($job->id) as $skilldata)
                                            {
                                                if($skilldata->skill_id == $skill->id)
                                                {
                                                    $skillFlag = 1;
                                                    break;
                                                }else{
                                                    $skillFlag = 0;
                                                }
                                            }
                                        }
                                        ?>
                                            <option value="{{ $skill->id }}" {{ @$skillFlag? 'selected': '' }}>{{ $skill->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="meassageInput" class="form-label"></label>
                                    Newspaper Article<span class="red">*</span></label>
                                    @php
                                    if(!@$flag)
                                    {
                                    $job_banner = public_path('/storage/job/' . $job->slug . '/news_' . $job->banner);
                                    }
                                @endphp
                                    <input type="file" name="newspaper_article" class="dropify" data-height="150" data-default-file="{{ !@$flag? (
                                            file_exists($job_banner) ?
                                            asset('storage/job/' . $job->slug . '/' . $job->banner)
                                          : asset('frontend/assets/images/files/hiring-banner.png')
                                          )
                                           : '' }}" required />
                                    <small>[Supporting file format: jpg, png, gif],
                                        [Image: 1200 x 600]</small>
                                </div>
                            </div>
                            <!--end col-->
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="meassageInput" class="form-label"></label>
                                    Job Banner<span class="red">*</span></label>
                                    @php
                                    if(!@$flag)
                                    {
                                    $job_banner = public_path('/storage/job/' . $job->slug . '/' . $job->banner);
                                    }
                                @endphp
                                    <input type="file" name="job_banner" class="dropify" data-height="150" data-default-file="{{ !@$flag? (
                                            file_exists($job_banner) ?
                                            asset('storage/job/' . $job->slug . '/' . $job->banner)
                                          : asset('frontend/assets/images/files/hiring-banner.png')
                                          )
                                           : '' }}"/>
                                    <small>[Supporting file format: jpg, png, gif],
                                        [Image: 1400 x 300]</small>
                                </div>
                            </div>
                            <!--end col-->

                        </div>
                        <!--end row-->
                        <div class="job-post-footer">
                            @if(@$flag)

                                <div class="text-left">
                                    <button type="submit" id="submit" name="submit" class="btn btn-outline-danger"
                                        value="draft">
                                        Save As Draft </button>
                                </div>
                                <div class="text-left">
                                    <button type="submit" id="submit" name="submit" class="btn btn-primary"
                                        value="post">
                                        Post Job </button>
                                </div>

                            @else

                                <div class="text-left">
                                    <button type="submit" id="submit" name="update" class="btn btn-primary"
                                        value="draft">
                                        <i class="fa fa-upload"></i> &nbsp;Update </button>
                                </div>
                                <div class="text-left">
                                    <a href="{{ route('employers.index') }}" id="submit" class="btn btn-outline-danger"
                                        value="post"><i class="fa fa-times"></i>&nbsp; Cancel </a>
                                </div>

                            @endif
                        </div>
                    </form>
                    <!--end form-->
                </div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>
    <script>
        $('.dropify').dropify();
        $(".field-study, .field-industry").select2({
            tags: true
        });

        function provinceSelect(data) {
            $('#districts').find('option').remove();
            $('#districts').append('<option value="0" selected>--Select District--</option>');
            $id = data.value;
            $.ajax({
                method: "POST",
                url: "{{ route('employers.provinceSelect') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $id,
                },
                success: function(response) {
                    var districts = response.districts;

                    var count = Object.keys(response.districts).length;

                    for ($i = 0; $i < count; $i++) {
                        $('#districts').append('<option value="' + districts[$i].id + '">' + districts[$i]
                            .name + '</option>');
                    }
                    console.log(count);
                },
                error: function() {

                }
            });

        }

        function districtSelect(data) {
            $('#city').find('option').remove();
            $('#city').append('<option value="0" selected>--Select City--</option>');
            $id = data.value;
            $.ajax({
                method: "POST",
                url: "{{ route('employers.citySelect') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $id,
                },
                success: function(response) {
                    var city = response.cities;

                    var count = Object.keys(response.cities).length;

                    for ($i = 0; $i < count; $i++) {
                        $('#city').append('<option value="' + city[$i].id + '">' + city[$i].name + '</option>');
                    }
                    console.log(count);
                },
                error: function() {

                }
            });

        }
    </script>
@endpush
