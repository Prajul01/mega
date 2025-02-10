@extends('user.layout.master')

@section('title', 'Referance | Job Seeker')

@section('content')
    <div class="main-content">

        <div class="main-content">

            <div class="page-content">
                <!-- START CANDIDATE-DETAILS -->
                <section class="section dashboard-section">
                    <div class="container-fluid custom-container">
                        <div class="row">

                            @include('user.jobseeker.layouts.profile_sidebar')

                            <div class="col-lg-9 col-md-8">

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
                                    //  if (@$job_seeker_reference->reference_mobile) {
                                    //   $ref_mobile = json_decode($job_seeker_reference->reference_mobile);
                                    // }
                                    // if (@$job_seeker_reference->reference_phone) {
                                    //     $ref_phone = json_decode($job_seeker_reference->reference_phone);
                                    // }
                                @endphp
                                <div class="card candidate-info new-shadow-sidebar mt-0 mb-3 mt-lg-0">
                                    <div class="card-body p-3">
                                        <div class="right-side-top-bar">
                                            <div class="right-top-title">
                                                <span class="icon-top">
                                                    <i class="fa-solid fa-user-group"></i>
                                                </span>
                                                Reference
                                            </div>
                                        </div>

                                        <div class="right-side-form">
                                            <form
                                                action="{{ isset($job_seeker_reference) ? route('user.update_referance', auth()->user()->username) : route('user.store_referance', auth()->user()->username) }}"
                                                method="post">
                                                @csrf
                                                @if (isset($job_seeker_reference))
                                                    @method('put')
                                                @endif
                                                <div class="detail-form-content">

                                                    @if (isset($ref_person))
                                                        <div class="education-info">
                                                            <div class="reference-info-body">
                                                                @foreach ($ref_person as $key => $person)
                                                                    <div class="reference-info">
                                                                        <div class="education-heading">
                                                                            <div class="fs-18">Reference</div>
                                                                            <div class="btn delete-btn">Delete</div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label for="nameInput"
                                                                                        class="form-label">Reference
                                                                                        Person
                                                                                    </label>
                                                                                    <input type="text"
                                                                                        name="reference_person_name[]"
                                                                                        id="name" class="form-control"
                                                                                        value="{{ old('reference_person_name.*', $person) }}"
                                                                                        required>
                                                                                    @error('reference_person_name.*')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label for="nameInput"
                                                                                        class="form-label">
                                                                                        Position </label>
                                                                                    <input type="text" name="position[]"
                                                                                        id="name" class="form-control"
                                                                                        value="{{ old('position.*', $ref_position[$key]) }}"
                                                                                        required>
                                                                                    @error('position.*')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label for="nameInput"
                                                                                        class="form-label">Email
                                                                                    </label>
                                                                                    <input type="email" name="email[]"
                                                                                        id="name" class="form-control"
                                                                                        value="{{ old('email.*', $ref_email[$key]) }}"
                                                                                        required>
                                                                                    @error('email.*')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label for="nameInput"
                                                                                        class="form-label">
                                                                                        Organization Name </label>
                                                                                    <input type="text" name="company[]"
                                                                                        id="name" class="form-control"
                                                                                        value="{{ old('company.*', $ref_company[$key]) }}"
                                                                                        required>
                                                                                    @error('company.*')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <hr>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="education-info">
                                                            <div class="education-info-title mb-0 px-1 pt-2">Add
                                                                Reference
                                                            </div>

                                                            <div class="reference-info-body">
                                                                <div class="reference-info">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput"
                                                                                    class="form-label">Reference
                                                                                    Person
                                                                                </label>
                                                                                <input type="text"
                                                                                    name="reference_person_name[]"
                                                                                    id="name" class="form-control"
                                                                                    value="{{ old('reference_person_name.*') }}"
                                                                                    required>
                                                                                @error('reference_person_name.*')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput" class="form-label">
                                                                                    Position </label>
                                                                                <input type="text" name="position[]"
                                                                                    id="name" class="form-control"
                                                                                    value="{{ old('position.*') }}"
                                                                                    required>
                                                                                @error('position.*')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput"
                                                                                    class="form-label">Email
                                                                                </label>
                                                                                <input type="email" name="email[]"
                                                                                    id="name" class="form-control"
                                                                                    value="{{ old('email.*') }}" required>
                                                                                @error('email.*')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput" class="form-label">
                                                                                    Organization Name </label>
                                                                                <input type="text" name="company[]"
                                                                                    id="name" class="form-control"
                                                                                    value="{{ old('company.*') }}"
                                                                                    required>
                                                                                @error('company.*')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <hr>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="education-footer-btn">
                                                        <div class="text-left">
                                                            <button id="add-reference" type="button"
                                                                class="btn btn-outline-danger">
                                                                Add More <span class="icon"><i
                                                                        class="fa-solid fa-plus"></i></span>
                                                            </button>
                                                        </div>
                                                        <div class="text-right">
                                                            <button type="submit" id="submit" name="submit"
                                                                class="btn btn-primary">
                                                                Save Experience </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
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
    </div>
    <!-- end main content-->

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

        $(".delete-btn").click(function() {
            $(this).closest(".reference-info").remove();
        });

        $("#menu-dropdown").click(function() {
            $(".mobile-dropdown").toggleClass("menu-toggle");
        });

        $("#editPreference").click(function() {
            $(this).addClass("d-none");
            $(".right-side-content").addClass("d-none");
            $(".right-side-form").removeClass("d-none");
        });


        function initializeStarRating(element) {
            element.find(".my-rating-4").starRating({
                totalStars: 5,
                starShape: 'rounded',
                starSize: 25,
                emptyColor: 'transparent',
                hoverColor: '#ECD59F',
                activeColor: '#FFD700',
                disableAfterRate: false,
                readOnly: false,
                useGradient: false
            });
        }

        $("#add-reference").click(function() {
            $(".reference-info-body").append(
                `<div class="reference-info"><div class="education-heading"><div class="fs-18">Reference</div><div class="btn delete-btn">Delete</div></div><div class="row">
                <div class="col-md-6"><div class="mb-3"><label for="nameInput" class="form-label">Reference Person</label><input type="text" name="reference_person_name[]" id="name" class="form-control" value="" required></div></div>
                <div class="col-md-6"><div class="mb-3"><label for="nameInput" class="form-label">Position </label><input type="text" name="position[]" id="name" class="form-control" value="" required></div></div>
                 <div class="col-md-6"><div class="mb-3"><label for="nameInput" class="form-label">Email</label><input type="email" name="email[]" id="name" class="form-control" value="" required></div></div><div class="col-md-6"><div class="mb-3"><label for="nameInput"class="form-label">Organization Name </label><input type="text" name="company[]" id="name" class="form-control" value="" required></div></div></div><hr></div>`
            )
        })

        $(".profile-icon").on("click", function() {
            $(".mobile-profile-check").toggleClass("profile-check-toggle");
        });
    </script>

@endsection
