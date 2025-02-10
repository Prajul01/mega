@extends('user.layout.master')
@section('content')
    <div class="page-content">
        <!-- START CANDIDATE-DETAILS -->
        <section class="section dashboard-section">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div class="sticky-sidebar">
                            <div class="card candidate-info new-shadow-sidebar mt-0 mb-2 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="icon-detail-candidate mb-0">
                                        <div class="icon-section">
                                            <i class="fa-solid fa-house-chimney"></i>
                                        </div>
                                        <div class="detail-section">
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
                                            <div class="nav-link {{ $active == 1 ? 'active' : '' }}">
                                                <a href="{{ route('employers.settings.accountSettings') }}">
                                                    <div class="icon-detail-candidate link-setting">
                                                        <div class="icon-section">
                                                            <i class="fa-solid fa-screwdriver-wrench"></i>
                                                        </div>
                                                        <div class="detail-section icons-only">
                                                            <span class="detail-info">
                                                                Company Page Settings
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="nav-link {{ $active == 2 ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('employers.settings.accountSettings', 'change-emails') }}">
                                                    <div class="icon-detail-candidate link-setting">
                                                        <div class="icon-section">
                                                            <i class="fa-regular fa-envelope"></i>
                                                        </div>
                                                        <div class="detail-section icons-only">
                                                            <span class="detail-info">
                                                                Change Email
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a>

                                            </div>
                                            <div class="nav-link {{ $active == 3 ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('employers.settings.accountSettings', 'change-password') }}">
                                                    <div class="icon-detail-candidate link-setting">
                                                        <div class="icon-section">
                                                            <i class="fa-solid fa-key"></i>
                                                        </div>
                                                        <div class="detail-section icons-only">
                                                            <span class="detail-info">
                                                                Change Password
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="nav-link {{ $active == 4 ? 'active' : '' }}">
                                                <a href="{{ route('employers.settings.accountSettings', 'deactivate-account') }}">
                                                    <div class="icon-detail-candidate link-setting">
                                                        <div class="icon-section">
                                                            <i class="fa-solid fa-circle-user"></i>
                                                        </div>
                                                        <div class="detail-section icons-only">
                                                            <div class="detail-info">
                                                                Deactivate Account
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            {{-- <div class="nav-link {{ $active == 4?'active': '' }}" id="v-pills-settings-tab" data-bs-toggle="pill"
                                                data-bs-target="#v-pills-settings" role="tab"
                                                aria-controls="v-pills-settings" aria-selected="false">
                                                <div class="icon-detail-candidate link-setting">
                                                    <div class="icon-section">
                                                        <i class="fa-solid fa-reply"></i>
                                                    </div>
                                                    <div class="detail-section icons-only">
                                                        <span class="detail-info">
                                                            Auto Responder
                                                        </span>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="card candidate-info new-shadow-sidebar statistics-nav mt-0 mb-3 mt-lg-0">
                            <div class="card-body p-3">
                                @yield('dashboard-content')

                                {{-- 
                                <div class="tab-pane  fade" id="v-pills-messages" role="tabpanel"
                                    aria-labelledby="v-pills-messages-tab">
                                    <div class="tab-main-title">
                                        <span class="tab-icon">
                                            <i class="fa-solid fa-key"></i>
                                        </span> &nbsp;
                                        Change Password
                                    </div>
                                    <div class="tab-main-content">
                                        <form method="post" onsubmit="return validateForm()" class="contact-form mt-4"
                                            name="myForm" id="myForm">
                                            <span id="error-msg"></span>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="nameInput" class="form-label">Current
                                                            Password</label>

                                                        <a href="#" class="float-forget">Forgot
                                                            Password?</a>

                                                        <input type="password" name="name" id="name"
                                                            class="form-control" placeholder="Enter your new password">
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="passwordInput" class="form-label">New
                                                            Password</label>
                                                        <input type="password" class="form-control" id="emaiol"
                                                            name="password" placeholder="Enter your new password">
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="passwordInput" class="form-label">Confirm
                                                            Password</label>
                                                        <input type="password" class="form-control" id="emaiol"
                                                            name="password" placeholder="Enter your new password">
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
                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                    aria-labelledby="v-pills-settings-tab">
                                    <div class="tab-main-title">
                                        <span class="tab-icon">
                                            <i class="fa-solid fa-reply"></i>
                                        </span> &nbsp;
                                        Auto Responder
                                    </div>
                                    <div class="tab-main-content social-card">

                                        <div class="tab-content-message">

                                            <div class="main-content-message message-respond">
                                                Add or remove accounts from this Accounts Center. Removing
                                                an account will also remove any profiles managed by that
                                                account. I understand that you're looking for assistance
                                                with adding or removing accounts from an "Accounts Center,"
                                                and that removing an account will also remove any profiles
                                                managed by that account. However, it seems like you might be
                                                referring to a specific software, platform, or application,
                                                but you haven't provided its name. Could you please provide
                                                more context or specify the name of the software or platform
                                                you're working with? This will help me provide you with
                                                accurate instructions or information.
                                            </div>
                                            <div class="mt-4 d-flex justify-content-between">
                                                <p>Enable/Disable default response</p>
                                                <div class="btn-container">
                                                    <label class="switch btn-color-mode-switch">
                                                        <input value="1" id="color_mode3" name="color_mode"
                                                            type="checkbox">
                                                        <label class="btn-color-mode-switch-inner" data-off="NO"
                                                            data-on="YES" for="color_mode3"></label>
                                                    </label>

                                                </div>
                                            </div>
                                            <hr>
                                            <h5 class="customize-job-title">Customize Jobs AutoResponse</h5>
                                            <hr>
                                            <ul class="list-choices customize-choice-flex">
                                                <li class="choice-li">
                                                    <div class="content-choice">
                                                        <span>Quality Assurance</span>
                                                    </div>
                                                    <button type="submit" name="submit" id="submit"
                                                        class="btn btn-primary btn-hover btn-small">View</button>
                                                </li>
                                                <li class="choice-li">
                                                    <div class="content-choice">
                                                        <span>Copy of Quality Assurance</span>
                                                    </div>
                                                    <button type="submit" name="submit" id="submit"
                                                        class="btn btn-primary btn-hover btn-small">View</button>
                                                </li>
                                                <li class="choice-li">
                                                    <div class="content-choice">
                                                        <span>Graphic Designer</span>
                                                    </div>
                                                    <button type="submit" name="submit" id="submit"
                                                        class="btn btn-primary btn-hover btn-small">View</button>
                                                </li>
                                                <li class="choice-li">
                                                    <div class="content-choice">
                                                        <span>Copy of Graphic Designer</span>
                                                    </div>
                                                    <button type="submit" name="submit" id="submit"
                                                        class="btn btn-primary btn-hover btn-small">View</button>
                                                </li>
                                            </ul>

                                        </div>


                                        <!-- <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group mb-4">
                                                                                    <label class="form-label"
                                                                                        for="facebook-url">Facebook
                                                                                    </label>
                                                                                    <div class="form-control-wrap">
                                                                                        <div class="absolute-icon facebook">
                                                                                            <i class="fab fa-facebook-f"></i>
                                                                                        </div>
                                                                                        <input type="text" class="form-control"
                                                                                            id="facebook-url"
                                                                                            placeholder="Input placeholder">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <div class="form-group mb-4">
                                                                                    <label class="form-label"
                                                                                        for="instagram-url">Instagram
                                                                                    </label>
                                                                                    <div class="form-control-wrap">
                                                                                        <div class="absolute-icon insta">
                                                                                            <i class="fab fa-instagram"></i>
                                                                                        </div>
                                                                                        <input type="text" class="form-control"
                                                                                            id="instagram-url"
                                                                                            placeholder="Input placeholder">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group mb-4">
                                                                                    <label class="form-label" for="youtube-url">Youtube
                                                                                    </label>
                                                                                    <div class="form-control-wrap">
                                                                                        <div class="absolute-icon youtube">
                                                                                            <i class="fab fa-youtube"></i>
                                                                                        </div>
                                                                                        <input type="text" class="form-control"
                                                                                            id="youtube-url"
                                                                                            placeholder="Input placeholder">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group mb-4">
                                                                                    <label class="form-label"
                                                                                        for="linkedin-url">Linkedin
                                                                                    </label>
                                                                                    <div class="form-control-wrap">
                                                                                        <div class="absolute-icon linkedin">
                                                                                            <i class="fab fa-linkedin-in"></i>
                                                                                        </div>
                                                                                        <input type="text" class="form-control"
                                                                                            id="linkedin-url"
                                                                                            placeholder="Input placeholder">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <div class="form-group mb-4">
                                                                                    <label class="form-label" for="tktok-url">Tiktok
                                                                                    </label>
                                                                                    <div class="form-control-wrap">
                                                                                        <div class="absolute-icon tiktok">
                                                                                            <i class="fab fa-tiktok"></i>
                                                                                        </div>
                                                                                        <input type="text" class="form-control"
                                                                                            id="tktok-url"
                                                                                            placeholder="Input placeholder">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <div class="form-group mb-4">
                                                                                    <label class="form-label"
                                                                                        for="whatsapp-url">Whatsapp
                                                                                    </label>
                                                                                    <div class="form-control-wrap">
                                                                                        <div class="absolute-icon whatsapp">
                                                                                            <i class="fab fa-whatsapp"></i>
                                                                                        </div>
                                                                                        <input type="text" class="form-control"
                                                                                            id="whatsapp-url"
                                                                                            placeholder="Input placeholder">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-sm-6">
                                                                                <div class="form-group mb-4">
                                                                                    <label class="form-label" for="viber-url">Viber
                                                                                    </label>
                                                                                    <div class="form-control-wrap">
                                                                                        <div class="absolute-icon viber">
                                                                                            <i class="fab fa-viber"></i>
                                                                                        </div>
                                                                                        <input type="text" class="form-control"
                                                                                            id="viber-url"
                                                                                            placeholder="Input placeholder">
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                        </div> -->
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
                                    <!-- <h5> Deactivating your MegaJob Account</h5> -->

                                    <div class="tab-main-content social-card">
                                        <form method="post" onsubmit="return validateForm()" class="contact-form mt-4"
                                            name="myForm" id="myForm">
                                            <span id="error-msg"></span>
                                            <label for="permanent" class="flex-label">
                                                <div class="message">
                                                    <span>Deactivating your account is temporary.</span>
                                                    Your
                                                    account and main profile will be deactivated and your
                                                    name
                                                    and photos will be removed from most things you've
                                                    shared.
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
                                                <input type="radio" id="temporary" name="deactivate">
                                            </label>
                                            <!-- <label class="my-2" for="">Reasons</label>
                                                                        <input type="text" class="form-control"> -->
                                        </form>
                                    </div>
                                    <hr>
                                    <div class="tab-main-footer">
                                        <button type="submit" name="submit" id="submit"
                                            class="btn btn-primary btn-hover">Continue </button>
                                        <button type="submit" name="submit" id="submit"
                                            class="btn btn-orange btn-hover">Cancel </button>
                                    </div>
                                </div> --}}
                            </div>
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->

        </section>
        <!-- END CANDIDATE-DETAILS -->
    </div>
@endsection
