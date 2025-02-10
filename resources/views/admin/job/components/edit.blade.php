@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/select2/dist/css/select2.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
<form method="POST" action="{{ route('admin.job.update', base64_encode($job->id)) }}" enctype="multipart/form-data">
    @csrf
    <div class="body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Job Name</span>
                    </div>
                    <input type="text" class="form-control" name="job_name" placeholder="Job Name" aria-label=""
                        aria-describedby="basic-addon1" value="{{ old('job_name', $job->title) }}" required>
                </div>
                @error('job_name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="featured" value="1"
                                {{ $job->featured == 1 ? 'checked' : '' }}></span>
                    </div>
                    <input type="text" class="form-control" value="Featured" disabled>
                </div>
                @error('featured')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="status" value="active"
                                {{ $job->status == 'active' ? 'checked' : '' }}></span>
                    </div>
                    <input type="text" class="form-control" value="Display Status" disabled>
                </div>
                @error('status')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">No Of Opening</span>
                    </div>
                    <input type="number" class="form-control" name="no_of_opening" placeholder="No Of Opening"
                        aria-label="" aria-describedby="basic-addon1"
                        value="{{ old('no_of_opening', $job->no_of_opening) }}">
                </div>
                @error('no_of_opening')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
           {{-- <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Posting Days</span>
                    </div>
                    <select class="form-control" name="posting_days">
                        <option disabled>--Select Posting Days--</option>
                        <option value="7" {{ $job->posting_days <= 7? 'selected':'' }}>7 Days</option>
                        <option value="15" {{ $job->posting_days <= 30 && $job->posting_days >= 15? 'selected':'' }}>15 Days</option>
                        <option value="30" {{ $job->posting_days >= 30? 'selected':'' }}>30 Days</option>
                    </select>
                </div>
                @error('posting_days')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div> --}}
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Desired Candidate</span>
                    </div>
                    <select class="form-control" name="desired_candidate">
                        <option disabled>--Select Desired Candidate</option>
                        <option value="male" {{ $job->desired_candidate == 'male'? 'selected': '' }}>Male</option>
                        <option value="female" {{ $job->desired_candidate == 'female'? 'selected': '' }}>Female</option>
                        <option value="others" {{ $job->desired_candidate == 'others'? 'selected': '' }}>Others</option>
                        <option value="both" {{ $job->desired_candidate == 'both'? 'selected': '' }}>Both</option>
                    </select>
                </div>
                @error('desired_candidate')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Post on</span>
                    </div>
                    <input type="date" class="form-control" name="active_on"
                        value="{{ old('active_on', $job->start_date) }}">
                </div>
                @error('active_on')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Expires on</span>
                    </div>
                    <input type="date" class="form-control" name="expires_on"
                        value="{{ old('expires_on',$job->expiry_date ) }}">
                </div>
                @error('expires_on')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Employer</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="employer">
                        <option selected disabled>Select Employer</option>
                        @foreach ($employers as $employe)
                            <option value="{{ $employe->id }}"
                                {{ $job->employer_id == $employe->id ? 'selected' : '' }}>
                                {{ $employe->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('employer')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select User</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="user">
                        <option selected disabled value="">Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $job->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('user')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Job Level</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="job_level">
                        <option selected disabled value="">Select Job Level</option>
                        @foreach ($job_levels as $job_level)
                            <option value="{{ $job_level->id }}"
                                {{ $job->job_level_id == $job_level->id ? 'selected' : '' }}>{{ $job_level->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('employer')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Education</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="education">
                        <option selected disabled value="">Select Education</option>
                        @foreach ($educations as $education)
                            <option value="{{ $education->id }}"
                                {{ $job->education_id == $education->id ? 'selected' : '' }}>{{ $education->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('education')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Experience</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="experience">
                        <option selected disabled value="">Select Experience</option>
                        @foreach ($experiences as $experience)
                            <option value="{{ $experience->id }}"
                                {{ $job->experience_id == $experience->id ? 'selected' : '' }}>
                                {{ $experience->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('experience')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Company Category</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example"
                        name="company_category">
                        <option selected disabled value="">Select Company Category</option>
                        @foreach ($company_categories as $company_category)
                            <option value="{{ $company_category->id }}"
                                {{ $job->company_category_id == $company_category->id ? 'selected' : '' }}>
                                {{ $company_category->title }}</option>
                        @endforeach
                    </select>
                </div>
                @error('company_category')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Employee Type</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example"
                        name="employee_type">
                        <option selected disabled value="">Select Company Category</option>
                        @foreach ($employee_types as $employee_type)
                            <option value="{{ $employee_type->id }}"
                                {{ $job->employee_type_id == $employee_type->id ? 'selected' : '' }}>
                                {{ $employee_type->title }}</option>
                        @endforeach
                    </select>
                </div>
                @error('company_category')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            {{-- <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="job_type" id="generalJob"
                                value="0" {{ $job->job_type == 0 ? 'checked' : '' }}></span>
                    </div>
                    <input type="text" class="form-control" value="General Job" disabled>
                </div>
                @error('job_type')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="job_type_1" id="newspaperJob"
                                value="1" {{ $job->job_type == 1 ? 'checked' : '' }}></span>
                    </div>
                    <input type="text" class="form-control" value="Newspaper Job" disabled>
                </div>
                @error('job_type')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div> --}}
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" disabled checked></span>
                    </div>
                    <input type="text" class="form-control"
                        value="{{ $job->job_type == 1 ? 'Newspaper Job' : 'General Job' }}" disabled>
                </div>
                @error('job_type')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <input type="hidden" name="job_type" value="{{ $job->job_type }}">
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select License</span>
                        @php
                            $data = [];
                            $v_id = $job->vehicles;
                            foreach ($licenses as $l) {
                                array_push($data, $l->vehicle_id);
                            }
                        @endphp
                    </div>
                    <select class="multiple-cat form-control" name="license_id[]" multiple="multiple">
                        @foreach ($vehicles as $key => $vehicle)
                            <option value="{{ $vehicle->id }}" @if (in_array($vehicle->id, $data)) selected @endif>
                                {{ $vehicle->title }}
                            </option>
                        @endforeach

                    </select>
                </div>
                @error('company_category')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            
            @if ($job->job_type == 0)
                <div class="col-md-6 mb-3 jobDesc-info">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Job Description</span>
                        </div>
                        <textarea class="form-control" id="ckeditor" name="job_description" placeholder="Job description" rows="6"
                            aria-label="" aria-describedby="basic-addon1">{{ old('job_description', $job->job_description) }}</textarea>
                    </div>
                    @error('job_description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3 jobDesc-info">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Job Specification</span>
                        </div>
                        <textarea class="form-control" id="ckeditor1" name="job_specification" placeholder="Job Specification"
                            rows="6" aria-label="" aria-describedby="basic-addon1">{{ old('job_specification', $job->job_specification) }}</textarea>
                    </div>
                    @error('job_specification')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            @else
           
                <div class="col-md-12 mb-3 newspaper-image">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Newspaper Image</span>
                        </div>
                        <input type="file" name="newspaper_image" class="dropify"
                            data-default-file="{{ old('newspaper_image', asset('storage/job/' . $job->slug . '/newspaper_image/' . $job->newspaper_image)) }}">
                    </div>
                    @error('newspaper_image')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    {{-- <div class="alert alert-warning mt-1">
                    Best Image Size 1200 X 600 PX.
                </div> --}}
                </div>
            @endif
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Job Banner</span>
                    </div>
                    <input type="file" name="banner" class="dropify"
                        data-default-file="{{ old('banner', asset('storage/job/' . $job->slug . '/' . $job->banner)) }}">
                </div>
                @error('banner')
                    <span class="error">{{ $message }}</span>
                @enderror
                <div class="alert alert-warning mt-1">
                    Best Image Size 1200 X 600 PX.
                </div>
            </div>
            <div class="col-md-12 mb-1">
                <div class="card">
                    <div class="card-header">
                        <h2>Skills</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12 my-3">
                <?php
                $skill_ids = [];
                foreach ($job->skill as $skill) {
                    array_push($skill_ids, $skill->id);
                }
                ?>
                <select class="js-example-basic-multiple" name="skills[]" multiple="multiple">
                    @foreach ($skills as $skill)
                        <?php
                        if (in_array($skill->id, $skill_ids)) {
                            $flag = 1;
                        } else {
                            $flag = 0;
                        }
                        ?>
                        <option value="{{ $skill->id }}" @if ($flag == 1) selected @endif>
                            {{ $skill->title }}</option>
                    @endforeach
                </select>
                @error('skill')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Offered Salary</h2>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Salary</span>
                    </div>
                    <input type="text" class="form-control" name="salary" placeholder="Salary" aria-label=""
                        aria-describedby="basic-addon1" value="{{ old('salary', $job->salary) }}">
                </div> 
                @error('salary')
                    <span class="error">{{ $message }}</span>
                @enderror 
            </div> --}}
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Pay Type</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="pay_type">
                        <option selected disabled value="">Select Pay Type</option>
                        <option value="monthly"{{ $job->pay_type == 'monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="weekly" {{ $job->pay_type == 'weekly' ? 'selected' : '' }}>Weekly</option>
                    </select>
                </div>
                @error('pay_type')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Salary Range</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="salary_range">
                        <?php
                        $salary_array = ['Negotiable', '10,000-20,000', '20,000-30,000', '30,000-40,000', '40,000-50,000', '50,000-60,000', '60,000-70,000', 'more than 70,000'];
                        ?>
                        @foreach ($salary_array as $data)
                            <option value="{{ $data }}"
                                {{ old('salary_range') ? (old('salary_range') == $data ? 'selected' : '') : (@$job->salary_range == $data ? 'selected' : '') }}>
                                {{ $data }}</option>
                        @endforeach
                    </select>
                </div>
                @error('company_owner_ship')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            {{-- <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Image</span>
                    </div>
                    <input type="file" name="image" class="dropify" data-default-file="{{ old('image') }}">
                </div>
                @error('image')
                <span class="error">{{$message}}</span>
                @enderror
                <div class="alert alert-warning mt-1">
                    Best Image Size 1200 X 600 PX.
                </div>
            </div> --}}

            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-header">
                        <h2>Address</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Country</span>
                    </div>
                    <select class="form-select form-control country" aria-label="Default select example"
                        name="country">
                        <option selected disabled value="">Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ $job->country_id == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('country')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Province</span>
                    </div>
                    <select class="form-select form-control province-list" id="province"
                        aria-label="Default select example" name="province">
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}"
                                {{ $province->id == $job->province_id ? 'selected' : '' }}>
                                {{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('province')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select District</span>
                    </div>
                    <select class="form-select form-control district-list" aria-label="Default select example"
                        name="district" id="district">
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}"
                                {{ $job->district_id == $district->id ? 'selected' : '' }}>
                                {{ $district->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('province')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select City</span>
                    </div>
                    <select class="form-select form-control city-list" aria-label="Default select example"
                        name="city">
                        <option selected disabled value="">Select City</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ $job->city_id == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('city')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            
        </div>

        <div class="card-footer">
            <a href="{{ route('admin.job.index') }}" class="btn btn-danger">Cancel</a>
            <button style="float: right" type="submit" class="btn btn-success">Save</button>
        </div>
</form>
@push('script')
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>
    <script src="{{ asset('backend/html/assets/js/pages/forms/dropify.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
    <script src="{{ asset('backend/assets/vendor/select2/dist/js/select2.js') }}"></script>
    <script>
        $(document).on('click', '#remove', function() {
            $(this).closest(".varient").remove();
        });
    </script>
    <script>
        $(".add-personal-info").click(function() {
            $(".additional_personal_info").append(
                `  <div class="row mb-2 personal border p-2 mx-2">
                <div class="col-md-12 float-right my-2"><span id="remove_personal" class="remove btn btn-outline-danger"><i class="fa fa-trash"></i></span> </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Name</span>
                            </div>
                            <input type="text" class="form-control" name="personal_name[]" required/>
                        </div>
                        @error('personal_name')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Email</span>
                            </div>
                            <input type="text" class="form-control" name="personal_email[]" required/>
                        </div>
                        @error('personal_email')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Designation</span>
                            </div>
                            <input type="text" class="form-control" name="personal_designation[]" required/>
                        </div>
                        @error('personal_designation')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Phone Number</span>
                            </div>
                            <input type="text" class="form-control" name="personal_phone[]" required/>
                        </div>
                        @error('personal_phone')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>`
            )
        });
        $(document).on('click', '#remove_personal', function() {
            $(this).closest(".personal").remove();
        });
    </script>
    <script>
        var editor_config = {
            toolbar: [{
                    name: 'document',
                    groups: ['mode', 'document', 'doctools']

                },
                {
                    name: 'clipboard',
                    groups: ['clipboard', 'undo'],
                    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                },
                {
                    name: 'editing',
                    groups: ['find', 'selection', 'spellchecker'],
                    items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                },
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup'],
                    items: ['Bold', 'Italic', 'Underline', '-',
                        'RemoveFormat'
                    ]
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', '-', 'JustifyLeft',
                        'JustifyCenter', 'JustifyRight', 'JustifyBlock',
                    ]
                },
                {
                    name: 'links',
                    items: ['Link']
                },
                '/',
                {
                    name: 'styles',
                    items: ['Styles', 'Format', 'Font', 'FontSize']
                },
                {
                    name: 'colors',
                    items: ['TextColor']
                },
            ],
            width: ['100%']
        };
        CKEDITOR.replace('ckeditor', editor_config);
        CKEDITOR.replace('ckeditor1', editor_config);
    </script>
    <script>
        $(document).ready(function() {
            $('.multiple-cat').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".country").on('blur', function() {
                var _country_id = $(this).val();
                $.ajax({
                    url: "{{ url('admin/job-management/provincelist') }}/" + _country_id,
                    dataType: 'json',
                    beforeSend: function() {
                        $(".province-list").html(
                            '<option selected diaslable>--- Select Province ---</option>');
                    },
                    success: function(data) {
                        var _html = '';
                        $.each(data.response, function(index, row) {
                            _html += '<option value="' + row.id + '">' + row.name +
                                '</option>';
                        });
                        $(".province-list").html(_html);
                    }
                });

            });
        });
    </script>
    <script src="{{ asset('backend/assets/vendor/select2/dist/js/select2.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#province").on('blur', function() {
                var _district_id = $(this).val();
                $.ajax({
                    url: "{{ url('admin/job-management/districtlist') }}/" + _district_id,
                    dataType: 'json',
                    beforeSend: function() {
                        $(".district-list").html(
                            '<option selected diaslable>--- Select District ---</option>');
                    },
                    success: function(data) {
                        var _html = '';
                        $.each(data.response, function(index, row) {
                            _html += '<option value="' + row.id + '">' + row.name +
                                '</option>';
                        });
                        $(".district-list").html(_html);
                    }
                });

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#district").on('blur', function() {
                var _city_id = $(this).val();
                $.ajax({
                    url: "{{ url('admin/job-management/citylist') }}/" + _city_id,
                    dataType: 'json',
                    beforeSend: function() {
                        $(".city-list").html(
                            '<option selected diaslable>--- Select City ---</option>');
                    },
                    success: function(data) {
                        var _html = '';
                        $.each(data.response, function(index, row) {
                            _html += '<option value="' + row.id + '">' + row.name +
                                '</option>';
                        });
                        $(".city-list").html(_html);
                    }
                });

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.multiple-cat').select2();
        });
    </script>
@endpush
