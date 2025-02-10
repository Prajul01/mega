@extends('user.layout.master')

@section('title', 'Experience | Job Seeker')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <!-- START CANDIDATE-DETAILS -->
            <section class="section dashboard-section">
                <div class="container-fluid custom-container">
                    <div class="row">

                        @include('user.jobseeker.layouts.profile_sidebar')

                        <div class="col-lg-9 col-md-8">
                            <div class="card candidate-info new-shadow-sidebar mt-0 mb-3 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="right-side-top-bar">
                                        <div class="right-top-title">
                                            <span class="icon-top">
                                                <i class="fa-solid fa-building-flag"></i>
                                            </span>
                                            Work Experience
                                        </div>
                                    </div>
                                    <div class="right-side-form">
                                        <div class="detail-form-content">
                                            <form
                                                action="{{ isset($check_experiance_info) ? route('user.update_experiance', auth()->user()->username) : route('user.store_experiance', auth()->user()->username) }}"
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
                                                                <div class="education-info">

                                                                    <div class="education-heading">
                                                                        <div class="education-info-title">Experience</div>
                                                                        <div class="btn delete-btn">Delete</div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput"
                                                                                    class="form-label">Position
                                                                                    <span class="red">*</span></label>
                                                                                <input type="text" name="position[]"
                                                                                    id="name" class="form-control"
                                                                                    value="{{ old('position.*') ? old('position.*') : (isset($p) ? $p : '') }}">
                                                                                @error('position.*')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <!--end col-->
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput"
                                                                                    class="form-label">Organization name
                                                                                    <span class="red">*</span></label>
                                                                                <input type="text"
                                                                                    name="organization_name[]"
                                                                                    id="name" class="form-control"
                                                                                    value="{{ old('organization_name.*') ? old('organization_name.*') : (isset($orginazation_name[$key]) ? $orginazation_name[$key] : '') }}">
                                                                                @error('organization_name.*')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <!--end col-->
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput"
                                                                                    class="form-label">Industry<span
                                                                                        class="red">*</span></label>
                                                                                <select class="form-control field-industry"
                                                                                    name="industry[]">
                                                                                    <option selected="selected"
                                                                                        value="">
                                                                                        --select--
                                                                                    </option>
                                                                                    @foreach ($company as $com)
                                                                                        <option value="{{ $com->id }}"
                                                                                            {{ $com->id == $industry[$key] ? 'selected' : '' }}>
                                                                                            {{ $com->title }}
                                                                                        </option>
                                                                                    @endforeach

                                                                                </select>
                                                                                @error('industry.*')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <!--end col-->
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput"
                                                                                    class="form-label">Job
                                                                                    Level<span
                                                                                        class="red">*</span></label>
                                                                                <select class="form-control field-industry"
                                                                                    name="job_level[]">
                                                                                    <option selected="selected"
                                                                                        value="">
                                                                                        --select--
                                                                                    </option>
                                                                                    @foreach ($job_levels as $level)
                                                                                        <option value="{{ $level->id }}"
                                                                                            {{ $level->id == $job_level[$key] ? 'selected' : '' }}>
                                                                                            {{ $level->title }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('job_level.*')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <!--end col-->
                                                                        <div class="col-lg-12">
                                                                            <div class="mb-3">
                                                                                <label for="meassageInput"
                                                                                    class="form-label"></label>
                                                                                Roles and responsibility<span
                                                                                    class="red">*</span></label>
                                                                                <textarea class="form-control" id="meassageInput" placeholder="Enter  Your Career Objective" name="comments[]"
                                                                                    id="comments" rows="5">{{ old('comments.*') ? old('comments.*') : (isset($roles_and_responsibility[$key]) ? $roles_and_responsibility[$key] : '') }}</textarea>
                                                                                @error('comments.*')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <!--end col-->
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput"
                                                                                    class="form-label">Joined
                                                                                    Year <span
                                                                                        class="red">*</span></label>
                                                                                <input type="text" name="joined_year[]"
                                                                                    id="name" class="form-control"
                                                                                    value="{{ old('joined_year.*') ? old('joined_year.*') : (isset($joined_year[$key]) ? $joined_year[$key] : '') }}">
                                                                                @error('joined_year.*')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <!--end col-->
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput"
                                                                                    class="form-label">Left
                                                                                    Year <span
                                                                                        class="red">*</span></label>
                                                                                <input type="text" name="lefted_year[]"
                                                                                    id="name" class="form-control"
                                                                                    value="{{ old('lefted_year.*') ? old('lefted_year.*') : (isset($left_year[$key]) ? ($left_year[$key] == 'Currently Working' ? '' : $left_year[$key]) : '') }}">
                                                                                @error('lefted_year.*')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <!--end col-->
                                                                        <div class="col-12">
                                                                            <label for="current"><input type="checkbox"
                                                                                    name="currently_working[]"
                                                                                    id="current"
                                                                                    value="Currently Working"
                                                                                    {{ isset($left_year[$key]) ? ($left_year[$key] == 'Currently Working' ? 'checked' : '') : '' }}>
                                                                                I am currently working here</label>
                                                                            @error('current_working.*')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
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
                                                                            <label for="nameInput"
                                                                                class="form-label">Position
                                                                                <span class="red">*</span></label>
                                                                            <input type="text" name="position[]"
                                                                                id="name" class="form-control"
                                                                                value="{{ old('position.*') }}">
                                                                            @error('position.*')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput"
                                                                                class="form-label">Organization name
                                                                                <span class="red">*</span></label>
                                                                            <input type="text"
                                                                                name="organization_name[]" id="name"
                                                                                class="form-control"
                                                                                value="{{ old('organization_name.*') }}">
                                                                            @error('organization_name.*')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput"
                                                                                class="form-label">Industry<span
                                                                                    class="red">*</span></label>
                                                                            <select class="form-control field-industry"
                                                                                name="industry[]">
                                                                                <option selected="selected"
                                                                                    value="">--select--
                                                                                </option>
                                                                                @foreach ($company as $com)
                                                                                    <option value="{{ $com->id }}"
                                                                                        {{ $com->id == old('industry') ? 'selected' : '' }}>
                                                                                        {{ $com->title }}
                                                                                    </option>
                                                                                @endforeach

                                                                            </select>
                                                                            @error('industry.*')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput" class="form-label">Job
                                                                                Level<span class="red">*</span></label>
                                                                            <select class="form-control field-industry"
                                                                                name="job_level[]">
                                                                                <option selected="selected"
                                                                                    value="">--select--
                                                                                </option>
                                                                                @foreach ($job_levels as $level)
                                                                                    <option value="{{ $level->id }}"
                                                                                        {{ $level->id == old('job_level') ? 'selected' : '' }}>
                                                                                        {{ $level->title }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('job_level.*')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3">
                                                                            <label for="meassageInput"
                                                                                class="form-label"></label>
                                                                            Roles and responsibility<span
                                                                                class="red">*</span></label>
                                                                            <textarea class="form-control" id="meassageInput" placeholder="Enter  Your Career Objective" name="comments[]"
                                                                                id="comments" rows="5">{{ old('comments.*') }}</textarea>
                                                                            @error('comments.*')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput"
                                                                                class="form-label">Joined
                                                                                Year <span class="red">*</span></label>
                                                                            <input type="text" name="joined_year[]"
                                                                                id="name" class="form-control"
                                                                                value="{{ old('joined_year.*') }}">
                                                                            @error('joined_year.*')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput" class="form-label">Left
                                                                                Year <span class="red">*</span></label>
                                                                            <input type="text" name="lefted_year[]"
                                                                                id="name" class="form-control"
                                                                                value="{{ old('lefted_year.*') }}">
                                                                            @error('lefted_year.*')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-12">
                                                                        <label for="current"><input type="checkbox"
                                                                                name="current_working[]" id="current"
                                                                                value="Currently Working"
                                                                                {{ old('current_working.*') ? 'checked' : '' }}>
                                                                            I am currently working here</label>
                                                                        @error('current_working.*')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="education-footer-btn">
                                                    <div class="text-left">
                                                        <button id="add-experience" type="button"
                                                            class="btn btn-outline-danger">
                                                            Add More <span class="icon"><i
                                                                    class="fa-solid fa-plus"></i></span> </button>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" id="submit" name="submit"
                                                            class="btn btn-primary">
                                                            Save Experience </button>
                                                    </div>
                                                </div>
                                            </form>


                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
        <!-- End Page-content -->

    </div>
    <!-- End Page-content -->

    <!--start back-to-top-->
    <button onclick="topFunction()" id="back-to-top">
        <i class="mdi mdi-arrow-up"></i>
    </button>
    <!--end back-to-top-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).scroll(function() {
            var y = $(this).scrollTop();
            if (y > 300) {
                $('.footer-fixed').addClass("add-sticky");
            } else {
                $('.footer-fixed').removeClass("add-sticky");
            }
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

        {{-- $(".field-study, .field-industry").select2({
            tags: true
        }); --}}



        $("#menu-dropdown").click(function() {
            $(".mobile-dropdown").toggleClass("menu-toggle");
        });

        $("#editPreference").click(function() {
            $(this).addClass("d-none");
            $(".right-side-content").addClass("d-none");
            $(".right-side-form").removeClass("d-none");
        });

        $(".experience-info-body").on("click", ".delete-btn", function() {
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

        $(".profile-icon").on("click", function() {
            $(".mobile-profile-check").toggleClass("profile-check-toggle");
        });
    </script>

@endsection
