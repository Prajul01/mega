@extends('user.layout.master')

@section('title', 'Education | Job Seeker')

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
                                                <i class="fa-solid fa-user-graduate"></i>
                                            </span>
                                            Education Infomation
                                        </div>
                                    </div>

                                    <div class="right-side-form">
                                        <div class="detail-form-content">

                                            {{-- <div class="education-heading">
                                                        <div class="education-info-title">Add Degree</div>
                                                        <div class="btn delete-btn">
                                                            Delete
                                                        </div>
                                                    </div> --}}
                                            <form
                                                action="{{ isset($check_education_info) ? route('user.update_education', auth()->user()->username) : route('user.store_education', auth()->user()->username) }}"
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
                                                    <div class="education-info-body">

                                                        @foreach ($educations as $k => $edu)
                                                            <div class="education-info">
                                                                <div class="education-heading">
                                                                    <div class="education-info-title">Education
                                                                    </div>
                                                                    <div class="btn delete-btn">
                                                                        Delete
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput" class="form-label">Degree
                                                                                <span class="red">*</span></label>
                                                                            <select class="form-control field-study"
                                                                                name="degree[]" required>
                                                                                <option selected="selected" value="">
                                                                                    --select--
                                                                                </option>
                                                                                @foreach ($education as $e)
                                                                                    <option value="{{ $e->id }}"
                                                                                        {{ $edu == $e->id ? 'selected' : '' }}>
                                                                                        {{ $e->title }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('degree.*')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput" class="form-label">Filed
                                                                                of Study<span
                                                                                    class="red">*</span></label>
                                                                            <select class="form-control field-study" required
                                                                                name="filed_of_study[]">
                                                                                <option selected="selected" value="">
                                                                                    --select--
                                                                                </option>
                                                                                @foreach ($study_field as $field)
                                                                                    <option value="{{ $field->id }}"
                                                                                        {{ $study_field_id[$k] == $field->id ? 'selected' : '' }}>
                                                                                        {{ $field->title }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('filed_of_study.*')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput"
                                                                                class="form-label">Institution <span
                                                                                    class="red">*</span></label>
                                                                            <input type="text" name="institution[]" required
                                                                                id="name" class="form-control"
                                                                                value="{{ old('institution.*') ? old('institution.*') : (isset($institution[$k]) ? $institution[$k] : '') }}">
                                                                            @error('institution.*')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput"
                                                                                class="form-label">University/Board
                                                                                <span class="red">*</span></label>
                                                                            <input type="text" name="board[]" required
                                                                                id="name" class="form-control"
                                                                                value="{{ old('board.*') ? old('board.*') : (isset($university[$k]) ? $university[$k] : '') }}">
                                                                            @error('board.*')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput" class="form-label">Joined
                                                                                Year <span class="red">*</span></label>
                                                                            <input type="text" name="joined_year[]" required
                                                                                id="name" class="form-control"
                                                                                value="{{ old('joined_year.*') ? old('joined_year.*') : (isset($join_year[$k]) ? $join_year[$k] : '') }}">
                                                                            @error('joined_year.*')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput" class="form-label">Passed
                                                                                Year</label>
                                                                            <input type="text" name="passed_year[]"
                                                                                id="name" class="form-control"
                                                                                value="{{ old('passed_year.*') ? old('passed_year.*') : (isset($passed_year[$k]) ? ($passed_year[$k] == 'Currently Studying' ? '' : $passed_year[$k]) : '') }}">
                                                                            @error('passed_year.*')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                    <div class="col-12">
                                                                        <label for="current-{{ $k }}"><input
                                                                                type="checkbox" name="currently_study[]"
                                                                                id="current-{{ $k }}"
                                                                                value="Currently Studying"
                                                                                {{ isset($passed_year[$k]) ? ($passed_year[$k] == 'Currently Studying' ? 'checked' : '') : '' }}>
                                                                            I am currently studying here</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
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
                                                                        <select class="form-control field-study"
                                                                            name="degree[]" required>
                                                                            <option selected="selected" value="">
                                                                                --select--
                                                                            </option>

                                                                            @foreach ($education as $e)
                                                                                <option value="{{ $e->id }}"
                                                                                    {{ old('degree') ? (old('degree') == $e->id ? 'selected' : '') : '' }}>
                                                                                    {{ $e->title }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('degree.*')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="nameInput" class="form-label">Filed
                                                                            of Study<span class="red">*</span></label>
                                                                        <select class="form-control field-study"
                                                                            name="filed_of_study[]" required>
                                                                            <option selected="selected" value="">
                                                                                --select--</option>
                                                                            @foreach ($study_field as $field)
                                                                                <option value="{{ $field->id }}"
                                                                                    {{ old('filed_of_study') == $field->id ? 'selected' : '' }}>
                                                                                    {{ $field->title }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('filed_of_study.*')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="nameInput"
                                                                            class="form-label">Institution <span
                                                                                class="red">*</span></label>
                                                                        <input type="text" name="institution[]"
                                                                            id="name" class="form-control"
                                                                            value="{{ old('institution.*') }}" required>
                                                                        @error('institution.*')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="nameInput"
                                                                            class="form-label">University/Board
                                                                            <span class="red">*</span></label>
                                                                        <input type="text" name="board[]"
                                                                            id="name" class="form-control"
                                                                            value="{{ old('board.*') }}" required>
                                                                        @error('board.*')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="nameInput" class="form-label">Joined
                                                                            Year <span class="red">*</span></label>
                                                                        <input type="text" name="joined_year[]"
                                                                            id="name" class="form-control"
                                                                            value="{{ old('joined_year.*') }}" required>
                                                                        @error('joined_year.*')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="nameInput" class="form-label">Passed
                                                                            Year</label>
                                                                        <input type="text" name="passed_year[]"
                                                                            id="name" class="form-control"
                                                                            value="{{ old('passed_year.*') }}">
                                                                        @error('passed_year.*')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-12">
                                                                    <label for="current"><input type="checkbox"
                                                                            name="currently_study[]" id="current"
                                                                            value="Currently Studying"
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
                                                        <button id="add-more" class="btn btn-outline-danger"
                                                            type="button">
                                                            Add More <span class="icon"><i
                                                                    class="fa-solid fa-plus"></i></span>
                                                        </button>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" id="submit" name="submit"
                                                            class="btn btn-primary">
                                                            Save Education </button>
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

        $(".field-study, .field-industry").select2({
            tags: true
        });


        $("#menu-dropdown").click(function() {
            $(".mobile-dropdown").toggleClass("menu-toggle");
        });

        $("#editPreference").click(function() {
            $(this).addClass("d-none");
            $(".right-side-content").addClass("d-none");
            $(".right-side-form").removeClass("d-none");
        });



      $(".education-info-body").on("click", ".delete-btn", function() {
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

        $(".profile-icon").on("click", function() {
            $(".mobile-profile-check").toggleClass("profile-check-toggle");
        });
    </script>

@endsection
