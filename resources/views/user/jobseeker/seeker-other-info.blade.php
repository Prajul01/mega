@extends('user.layout.master')

@section('title', 'Other Information | Job Seeker')

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
                                                <i class="fa-regular fa-file-lines"></i>
                                            </span>
                                            Other Information
                                        </div>
                                    </div>

                                    <div class="right-side-content pt-0">
                                        <ul class="list-choices">
                                            <li class="choice-li">
                                                <div class="content-choice">
                                                    <span>Profile Searchable</span> <small>All the
                                                        registered employer
                                                        can
                                                        see your full profile</small>
                                                </div>
                                                <div class="btn-container">
                                                    <label class="switch btn-color-mode-switch">
                                                        <input value="1" id="color_mode" name="color_mode"
                                                            type="checkbox">
                                                        <label class="btn-color-mode-switch-inner" data-off="NO"
                                                            data-on="YES" for="color_mode"></label>
                                                    </label>

                                                </div>
                                            </li>
                                            <li class="choice-li">
                                                <div class="content-choice">
                                                    Are you willing to travel outside of your residing location
                                                    during the job ?
                                                </div>
                                                <div class="btn-container">
                                                    <label class="switch btn-color-mode-switch">
                                                        <input value="1" id="color_mode2" name="color_mode"
                                                            type="checkbox">
                                                        <label class="btn-color-mode-switch-inner" data-off="NO"
                                                            data-on="YES" for="color_mode2"></label>
                                                    </label>

                                                </div>
                                            </li>

                                            <li class="choice-li">
                                                <div class="content-choice">
                                                    <span>Profile Searchable</span> <small>All the
                                                        registered employer
                                                        can
                                                        see your full profile</small>
                                                </div>
                                                <div class="btn-container">
                                                    <label class="switch btn-color-mode-switch">
                                                        <input value="1" id="color_mode" name="color_mode"
                                                            type="checkbox">
                                                        <label class="btn-color-mode-switch-inner" data-off="NO"
                                                            data-on="YES" for="color_mode"></label>
                                                    </label>

                                                </div>
                                            </li>
                                            <li class="choice-li">
                                                <div class="content-choice">
                                                    <span>Actively Seeking Job</span> <small>Boost your
                                                        visibility to over 40,000 + employers searching the
                                                        megajob database</small>
                                                </div>
                                                <div class="btn-container">
                                                    <label class="switch btn-color-mode-switch">
                                                        <input value="1" id="color_mode3" name="color_mode"
                                                            type="checkbox">
                                                        <label class="btn-color-mode-switch-inner" data-off="NO"
                                                            data-on="YES" for="color_mode3"></label>
                                                    </label>

                                                </div>
                                            </li>
                                            <li class="choice-li">
                                                <div class="content-choice">
                                                    <span>Actively Seeking Job</span> <small>Boost your
                                                        visibility to over 40,000 + employers searching the
                                                        megajob database</small>
                                                </div>
                                                <div class="btn-container">
                                                    <label class="switch btn-color-mode-switch">
                                                        <input value="1" id="color_mode4" name="color_mode"
                                                            type="checkbox">
                                                        <label class="btn-color-mode-switch-inner" data-off="NO"
                                                            data-on="YES" for="color_mode4"></label>
                                                    </label>

                                                </div>
                                            </li>
                                            <li class="choice-li">
                                                <div class="content-choice">
                                                    <span>Actively Seeking Job</span> <small>Boost your
                                                        visibility to over 40,000 + employers searching the
                                                        megajob database</small>
                                                </div>
                                                <div class="btn-container">
                                                    <label class="switch btn-color-mode-switch">
                                                        <input value="1" id="color_mode5" name="color_mode"
                                                            type="checkbox">
                                                        <label class="btn-color-mode-switch-inner" data-off="NO"
                                                            data-on="YES" for="color_mode5"></label>
                                                    </label>

                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-main-footer">
                                        <button type="submit" name="submit" id="submit"
                                            class="btn btn-primary btn-hover">Save Changes
                                        </button>
                                        <button type="submit" name="submit" id="submit"
                                            class="btn btn-orange btn-hover">Cancel </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
        <!-- End Page-content -->



        <div class="modal fade" id="applyNow" tabindex="-1" aria-labelledby="applyNow" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-5">
                        <div class="text-center mb-4">
                            <h5 class="modal-title" id="staticBackdropLabel">Apply For This Job</h5>
                        </div>
                        <div class="position-absolute end-0 top-0 p-3">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="mb-3">
                            <label for="nameControlInput" class="form-label">Name</label>
                            <input type="text" class="form-control" id="nameControlInput"
                                placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label for="emailControlInput2" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="emailControlInput2"
                                placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="messageControlTextarea" class="form-label">Message</label>
                            <textarea class="form-control" id="messageControlTextarea" rows="4" placeholder="Enter your message"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="inputGroupFile01">Resume Upload</label>
                            <input type="file" class="form-control" id="inputGroupFile01">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Application</button>
                    </div>
                </div>
            </div>
        </div><!-- END APPLY MODAL -->

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

        $(".field-study, .field-industry").select2({
            tags: true
        });

        // $(".delete-btn").click(function () {
        //     $(this).closest(".education-info").remove();
        // });

        $("#menu-dropdown").click(function() {
            $(".mobile-dropdown").toggleClass("menu-toggle");
        });

        $("#editPreference").click(function() {
            $(this).addClass("d-none");
            $(".right-side-content").addClass("d-none");
            $(".right-side-form").removeClass("d-none");
        });

        $(".detail-form-content").on("click", ".delete-btn", function() {
            $(this).closest(".training-info").remove();
        });
        $("#add-training").click(function() {
            $(".training-info-body").append(
                '<div class="training-info"><div class="education-heading"><div class="fs-18">Add Training</div><div class="btn delete-btn">Delete</div></div><form action="" class="mt-3"><div class="row"><div class="col-md-6"><div class="mb-3"><label for="nameInput" class="form-label">Title<span class="red">*</span></label><input type="text" name="name" id="name" class="form-control" value=""></div></div><div class="col-lg-6"><div class="mb-3"><label for="nameInput" class="form-label">Year <span class="red">*</span></label><input type="text" name="name" id="name" class="form-control" value=""></div></div><div class="col-lg-12"><div class="mb-3"><label for="nameInput" class="form-label">Institution <span class="red">*</span></label><input type="text" name="name" id="name" class="form-control" value=""></div></div></div></form><hr></div>'
            )
        });
        $(".profile-icon").on("click", function() {
            $(".mobile-profile-check").toggleClass("profile-check-toggle");
        });
    </script>

@endsection
