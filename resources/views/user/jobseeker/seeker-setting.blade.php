@extends('user.layout.master')

@section('title', 'Setting | Job Seeker')

@section('content')
    <div class="main-content">

        <div class="page-content">
            <!-- START CANDIDATE-DETAILS -->
            <section class="section dashboard-section">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <!-- <div class="col-12">
                                                                                                                                                                                                                                                                                                            <div class="card candidate-info new-shadow-sidebar mt-4 mb-2 mt-lg-0">
                                                                                                                                                                                                                                                                                                                <div class="card-body p-3">
                                                                                                                                                                                                                                                                                                                    <div class="meta-active-date">
                                                                                                                                                                                                                                                                                                                        <small>Account Settings</small>
                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                        </div> -->
                        <div class="col-lg-3 col-md-4">
                            <div class="sticky-sidebar">
                                <div class="card candidate-info new-shadow-sidebar mb-2 mt-lg-0">
                                    <div class="card-body p-3">
                                        <div class="icon-detail-candidate mb-0">
                                            <div class="icon-section">
                                                <i class="fa-solid fa-house-chimney"></i>
                                            </div>
                                            <div class="detail-section mobile-flex d-block">
                                                <div class="detail-info">
                                                    Account Settings
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card side-bar new-shadow-sidebar statistics-nav mb-3">
                                    <div class="card-body p-3">
                                        <div class="candidate-detail-sidebar mt-0">
                                            <div class="nav nav-pills" id="v-pills-tab" role="tablist"
                                                aria-orientation="vertical">
                                                <div class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-home" role="tab"
                                                    aria-controls="v-pills-home" aria-selected="true">
                                                    <div class="icon-detail-candidate link-setting">
                                                        <div class="icon-section">
                                                            <i class="fa-solid fa-user-shield"></i>
                                                        </div>
                                                        <div class="detail-section setting-section">
                                                            <span class="detail-info icons-only">
                                                                Privacy Setting
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-profile" role=" tab"
                                                    aria-controls="v-pills-profile" aria-selected="false">
                                                    <div class="icon-detail-candidate link-setting">
                                                        <div class="icon-section">
                                                            <i class="fa-regular fa-envelope"></i>
                                                        </div>
                                                        <div class="detail-section">
                                                            <span class="detail-info icons-only">
                                                                Change Email
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-messages" role="tab"
                                                    aria-controls="v-pills-messages" aria-selected="false">
                                                    <div class="icon-detail-candidate link-setting">
                                                        <div class="icon-section">
                                                            <i class="fa-solid fa-key"></i>
                                                        </div>
                                                        <div class="detail-section setting-section">
                                                            <span class="detail-info icons-only">
                                                                Change Password
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-settings" role="tab"
                                                    aria-controls="v-pills-settings" aria-selected="false">
                                                    <div class="icon-detail-candidate link-setting">
                                                        <div class="icon-section">
                                                            <i class="fa-solid fa-share-nodes"></i>
                                                        </div>
                                                        <div class="detail-section setting-section">
                                                            <span class="detail-info">
                                                                Social Accounts
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="nav-link" id="v-pills-deactivate-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-deactivate" role="tab"
                                                    aria-controls="v-pills-deactivate" aria-selected="false">
                                                    <div class="icon-detail-candidate link-setting">
                                                        <div class="icon-section">
                                                            <i class="fa-solid fa-circle-user"></i>
                                                        </div>
                                                        <div class="detail-section setting-section">
                                                            <div class="detail-info icons-only">
                                                                Deactivate Account
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8">
                            <div class="card candidate-info new-shadow-sidebar statistics-nav mt-0 mb-3 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">
                                            <div class="tab-main-title">
                                                <span class="tab-icon">
                                                    <i class="fa-solid fa-user-shield"></i>
                                                </span> &nbsp;
                                                Privacy Setting
                                            </div>

                                            <div class="tab-main-content">

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
                                                                <input value="Profile Searchable"
                                                                    id="job_sekeer_profile_searchable"
                                                                    name="job_sekeer_profile_searchable" type="checkbox"
                                                                    class="change_status"
                                                                    {{ auth()->user()->job_sekeer_profile_searchable == 1 ? 'checked' : '' }}>
                                                                <label class="btn-color-mode-switch-inner" data-off="NO"
                                                                    data-on="YES"
                                                                    for="job_sekeer_profile_searchable"></label>
                                                            </label>

                                                        </div>
                                                    </li>
                                                    <li class="choice-li">
                                                        <div class="content-choice">
                                                            <span>Actively Seeking Job</span> <small>Boost your
                                                                visibility to employers searching the
                                                                megajob database</small>
                                                        </div>
                                                        <div class="btn-container">
                                                            <label class="switch btn-color-mode-switch">
                                                                <input value="Actively Seeking Job"
                                                                    id="job_sekeer_seeking_job"
                                                                    name="job_sekeer_seeking_job" type="checkbox"
                                                                    class="change_status"
                                                                    {{ auth()->user()->job_sekeer_seeking_job == 1 ? 'checked' : '' }}>
                                                                <label class="btn-color-mode-switch-inner" data-off="NO"
                                                                    data-on="YES" for="job_sekeer_seeking_job"></label>
                                                            </label>

                                                        </div>
                                                    </li>
                                                    <li class="choice-li">
                                                        <div class="content-choice">
                                                            <span>Profile confidential</span> <small>Only those employer can
                                                                view your full profile for whom you have applied the
                                                                job</small>
                                                        </div>
                                                        <div class="btn-container">
                                                            <label class="switch btn-color-mode-switch">
                                                                <input value="Profile confidential"
                                                                    id="job_sekeer_profile_confidential"
                                                                    name="job_sekeer_profile_confidential" type="checkbox"
                                                                    class="change_status"
                                                                    {{ auth()->user()->job_sekeer_profile_confidential == 1 ? 'checked' : '' }}>
                                                                <label class="btn-color-mode-switch-inner" data-off="NO"
                                                                    data-on="YES"
                                                                    for="job_sekeer_profile_confidential"></label>
                                                            </label>

                                                        </div>
                                                    </li>
                                                    <li class="choice-li">
                                                        <div class="content-choice">
                                                            <span>Would you like to get job alerts in your email?</span>
                                                            <small>This will keep you alert of new jobs available.</small>
                                                        </div>
                                                        <div class="btn-container">
                                                            <label class="switch btn-color-mode-switch">
                                                                <input value="Email Alert" id="job_sekeer_job_alert"
                                                                    class="change_status" name="job_sekeer_job_alert"
                                                                    type="checkbox"
                                                                    {{ auth()->user()->job_sekeer_job_alert == 1 ? 'checked' : '' }}>
                                                                <label class="btn-color-mode-switch-inner" data-off="NO"
                                                                    data-on="YES" for="job_sekeer_job_alert"></label>
                                                            </label>

                                                        </div>
                                                    </li>

                                                </ul>

                                            </div>
                                            {{-- <hr>



                                            <div class="tab-main-footer">
                                                <button type="submit" name="submit" id="submit"
                                                    class="btn btn-primary btn-hover">Save Changes </button>
                                                <button type="submit" name="submit" id="submit"
                                                    class="btn btn-orange btn-hover">Cancel </button>
                                            </div> --}}

                                        </div>
                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                            aria-labelledby="v-pills-profile-tab">
                                            <div class="tab-main-title">
                                                <span class="tab-icon">
                                                    <i class="fa-regular fa-envelope"></i>
                                                </span> &nbsp;
                                                Change Email Address
                                            </div>

                                            <div class="tab-main-content">

                                                <form method="post" onsubmit="return validateForm()"
                                                    class="contact-form mt-4" name="myForm" id="myForm">
                                                    <span id="error-msg"></span>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="emailInput" class="form-label">
                                                                    Email</label>
                                                                <input type="email" class="form-control" id="emaiol"
                                                                    name="email" placeholder="Enter your new email">
                                                            </div>
                                                        </div><!--end col-->
                                                    </div>
                                                </form>
                                            </div>
                                            <hr>
                                            <div class="tab-main-footer">
                                                <button type="submit" name="submit" id="submit"
                                                    class="btn btn-primary btn-hover">Save Changes </button>
                                                <button type="submit" name="submit" id="submit"
                                                    class="btn btn-orange btn-hover">Cancel </button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                            aria-labelledby="v-pills-messages-tab">
                                            <div class="tab-main-title">
                                                <span class="tab-icon">
                                                    <i class="fa-solid fa-key"></i>
                                                </span> &nbsp;
                                                Change Password
                                            </div>
                                            <form action="{{ route('user.change_password', auth()->user()->username) }}"
                                                method="post" class="contact-form mt-4" name="myForm" id="myForm">
                                                <div class="tab-main-content">

                                                    <span id="error-msg"></span>
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="mb-3 position-relative">
                                                                <label for="nameInput" class="form-label">Current
                                                                    Password</label>

                                                                {{-- <a href="#" class="float-forget">Forgot
                                                                    Password?</a> --}}

                                                                <input type="password" name="old_password" id="name"
                                                                    class="form-control"
                                                                    placeholder="Enter your current password">
                                                                <div class="eye-btn">
                                                    <span class="show-eye d-none">
                                                        <i class="fa-solid fa-eye"></i></span>
                                                    <span class="hide-eye">
                                                        <i class="fa-solid fa-eye-slash"></i></span>
                                                </div>
                                                            </div>
                                                        </div><!--end col-->
                                                        <div class="col-md-6">
                                                            <div class="mb-3 position-relative">
                                                                <label for="passwordInput" class="form-label">New
                                                                    Password</label>
                                                                <input type="password" class="form-control"
                                                                    id="emaiol" name="password"
                                                                    placeholder="Enter your new password">
                                                                <div class="eye-btn">
                                                    <span class="show-eye d-none">
                                                        <i class="fa-solid fa-eye"></i></span>
                                                    <span class="hide-eye">
                                                        <i class="fa-solid fa-eye-slash"></i></span>
                                                </div>
                                                            </div>
                                                        </div><!--end col-->
                                                        <div class="col-md-6">
                                                            <div class="mb-3 position-relative">
                                                                <label for="passwordInput" class="form-label">Confirm
                                                                    Password</label>
                                                                <input type="password" class="form-control"
                                                                    id="emaiol" name="confirm_password"
                                                                    placeholder="Enter your new password">
                                                                <div class="eye-btn">
                                                    <span class="show-eye d-none">
                                                        <i class="fa-solid fa-eye"></i></span>
                                                    <span class="hide-eye">
                                                        <i class="fa-solid fa-eye-slash"></i></span>
                                                </div>
                                                            </div>
                                                        </div><!--end col-->
                                                    </div>

                                                </div>
                                                <hr>
                                                <div class="tab-main-footer">
                                                    <button type="submit" name="submit" id="submit"
                                                        class="btn btn-primary btn-hover">Save Changes </button>
                                                    <button type="submit" name="submit" id="submit"
                                                        class="btn btn-orange btn-hover">Cancel </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                            aria-labelledby="v-pills-settings-tab">
                                            <div class="tab-main-title">
                                                <span class="tab-icon">
                                                    <i class="fa-solid fa-share-nodes"></i>
                                                </span> &nbsp;
                                                Social Accounts
                                            </div>
                                            <div class="tab-main-content social-card">

                                                <div class="tab-content-message">

                                                    <div class="main-content-message">
                                                        Add or remove accounts from this Accounts Center. Removing
                                                        an account will also remove any profiles managed by that
                                                        account.
                                                    </div>

                                                </div>


                                                <div class="social-sites">
                                                    <div class="site-wrapper">
                                                        <div class="site-text">
                                                            <span class="site-logo facebook">
                                                                <i class="fa-brands fa-square-facebook"></i>
                                                            </span>
                                                            Facebook
                                                        </div>
                                                        <div class="site-add">
                                                            <a href="#"
                                                                class="btn btn-border btn-white white-btn-shadow">
                                                                Add
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="site-wrapper connected">
                                                        <div class="site-main-info">
                                                            <div class="user-site-name">
                                                                John Doe
                                                            </div>
                                                            <div class="site-text">
                                                                <span class="site-logo google">
                                                                    <img src="./assets/images/google.png"
                                                                        class="img-fluid" alt="">
                                                                </span>
                                                                Google
                                                            </div>
                                                        </div>
                                                        <div class="site-add">
                                                            <a href="#"
                                                                class="btn btn-border btn-white white-btn-shadow">
                                                                Remove
                                                            </a>
                                                        </div>
                                                    </div>



                                                </div>



                                            </div>
                                            <hr>
                                            <div class="tab-main-footer">
                                                <button type="submit" name="submit" id="submit"
                                                    class="btn btn-primary btn-hover">Save Changes </button>
                                                <button type="submit" name="submit" id="submit"
                                                    class="btn btn-orange btn-hover">Cancel </button>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-deactivate" role="tabpanel"
                                            aria-labelledby="v-pills-deactivate-tab">
                                            <div class="tab-main-title">
                                                <span class="tab-icon">
                                                    <i class="fa-solid fa-circle-user"></i>
                                                </span> &nbsp;
                                                Deactivate Account
                                            </div>

                                            <div class="tab-main-content social-card">
                                                <form
                                                    action="{{ route('user.account_deactivated', auth()->user()->username) }}"
                                                    method="POST" class="mt-4" id="formD">
                                                    @csrf

                                                    <span id="error-msg"></span>
                                                    <label for="permanent" class="flex-label">
                                                        <div class="message">
                                                            @if (auth()->user()->is_deactivated == 0)
                                                                <span> Deactivating your account is temporary.</span>
                                                                Your
                                                                account and main profile will be deactivated and your
                                                                name
                                                                and photos will be removed from most things you've
                                                                shared.
                                                            @else
                                                                <span> Again reactive my account.</span>
                                                            @endif
                                                        </div>
                                                        <input type="radio" id="permanent" name="deactivate">

                                                    </label>
                                                    <label for="temporary" class="flex-label">
                                                        <div class="message">
                                                            <span>Deleting your account is permanent.</span> When
                                                            you delete your
                                                            megajob account, you won't be able to retrieve the
                                                            content
                                                            or information you've shared on megajob. Your main
                                                            profile and all of your messages will also be deleted.
                                                        </div>
                                                        <input type="radio" id="temporary" name="delete"
                                                            value="1">
                                                    </label>
                                            </div>
                                            <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Password
                                                                Confirmation</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label>Enter your password for confirmation:</label>
                                                            <input type="password" name="password" class="form-control"
                                                                placeholder="Enter Your Password" />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="" class="btn btn-primary mx-2">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>

                                            <hr>
                                            <div class="tab-main-footer">
                                                <a href="#" class="btn btn-primary btn-hover"
                                                    onclick="deactivate()">Submit</a>

                                                <button type="button" name="submit" id="submit"
                                                    class="btn btn-orange btn-hover">Cancel </button>
                                            </div>

                                        </div>
                                    </div>
                                </div><!--end card-->
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end container-->
            </section>
            <!-- END CANDIDATE-DETAILS -->

        </div>
        <!-- End Page-content -->




    </div>
    <!-- End Page-content -->

    <!--start back-to-top-->
    <button onclick="topFunction()" id="back-to-top">
        <i class="mdi mdi-arrow-up"></i>
    </button>
    <!--end back-to-top-->



@endsection

@section('script')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

    <script>
        function deactivate() {
            swal({
                title: "Are you sure?",
                text: "You will be your account not show the on megajob.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    $('#passwordModal').modal('show');
                }
            });
        }
        $(document).ready(function() {
            // Listen for a change event on the checkbox
            $('.change_status').change(function() {
                const name = $(this).attr('name'); // Get the user ID from data attribute
                const value = $(this).attr('value');
                // Send an Ajax request to update the user's job_sekeer_seeking_job value
                $.ajax({
                    url: '{{ route('user.change_setting', auth()->user()->username) }}', // Correct URL format
                    method: 'Get',
                    data: {
                        name: name,
                    },
                    success: function(response) {
                        // Update the checkbox state based on the server response
                        if (response.success == true) {
                            $(function() {
                                toastr.success(value + " Change Setting Successfully");
                            });
                        } else {
                            $(function() {
                                toastr.error(value + " Error updating user Setting");
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        $(function() {
                            toastr.error("Somthing wrong. please try later.");
                        });
                    }
                });
            });
        });
    </script>
    <!-- Include SweetAlert2 -->







@endsection
