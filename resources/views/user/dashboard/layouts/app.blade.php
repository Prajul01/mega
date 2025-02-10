@extends('user.layout.master')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <!-- START CANDIDATE-DETAILS -->
            <section class="section dashboard-section">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="sticky-sidebar">
                                <div class="card side-bar shadow-sidebar mb-3">
                                    <div class="card-body p-3">
                                        <div class="candidate-profile">
                                            <div class="candiadte-img">
                                                <?php
                                                if (!is_null(auth()->user()->job_seeker)) {
                                                    $profile_pic = auth()->user()->job_seeker->profile_pic;
                                                    if (!is_null($profile_pic)) {
                                                        $url = asset('/storage/job-seeker/' . $profile_pic);
                                                    } else {
                                                        $url = asset('frontend/assets/images/files/spy.png');
                                                    }
                                                } else {
                                                    $url = asset('frontend/assets/images/files/spy.png');
                                                }
                                                ?>
                                                <img src="{{ $url }}" alt=""
                                                    class="avatar-lg rounded-circle">
                                            </div>
                                            <div class="candidate-detail">
                                                <h6 class="fs-18 mb-0 candidate-name">{{ auth()->user()->name }}</h6>
                                                <a href="mailto:{{ auth()->user()->email }}"
                                                    class="candidate-mail mb-0">{{ auth()->user()->email }}</a>
                                                <div class="view-profile"><a
                                                        href="{{ route('user.view_profile', auth()->user()->username) }}">View
                                                        Profile</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sidebar-postjob">
                                    <button id="menu-dropdown"
                                        class="btn btn-outline-danger position-relative text-left w-100 mb-3 desktop-none"><i
                                            class="fa-solid fa-chevron-down"></i>&nbsp;&nbsp;<span>Menu</span></button>
                                </div>
                                <div class="card side-bar shadow-sidebar mobile-dropdown">
                                    <div class="card-body p-3">
                                        <div class="tab-link-wrapper">
                                            <div class="tab-link">
                                                <a href="{{ route('user.dashboard', auth()->user()->username) }}"
                                                    class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                                                    <span class="icon-tab">
                                                        <img src="{{ asset('frontend/assets/images/files/dashboard.svg') }}"
                                                            alt="">
                                                    </span>
                                                    <span class="text-tab">
                                                        Dashboard
                                                    </span>
                                                </a>
                                                <a href="{{ route('user.editProfile', auth()->user()->username) }}"
                                                    class="{{ request()->routeIs('user.editProfile') ? 'active' : '' }}">
                                                    <span class="icon-tab">
                                                        <img src="{{ asset('frontend/assets/images/files/profile-edit.svg') }}"
                                                            alt="">
                                                    </span>
                                                    <span class="text-tab">
                                                        Edit Profile
                                                    </span>
                                                </a>
                                                <a href="{{ route('user.save_job', auth()->user()->username) }}"
                                                    class="{{ request()->routeIs('user.save_job') ? 'active' : '' }}">
                                                    <span class="icon-tab large-icon">
                                                        <img src="{{ asset('frontend/assets/images/files/saved.svg') }}"
                                                            alt="">
                                                    </span>
                                                    <span class="text-tab">
                                                        Saved Jobs
                                                    </span>
                                                </a>
                                                <a href="{{ route('user.apply_job', auth()->user()->username) }}"
                                                    class="{{ request()->routeIs('user.apply_job') ? 'active' : '' }}">
                                                    <span class="icon-tab">
                                                        <img src="{{ asset('frontend/assets/images/files/applied.svg') }}"
                                                            alt="">
                                                    </span>
                                                    <span class="text-tab">
                                                        Applied Jobs
                                                    </span>
                                                </a>
                                                <a href="{{ route('user.similar_job', auth()->user()->username) }}"
                                                    class="{{ request()->routeIs('user.similar_job') ? 'active' : '' }}">
                                                    <span class="icon-tab">
                                                        <img src="{{ asset('frontend/assets/images/files/search.svg') }}"
                                                            alt="">
                                                    </span>
                                                    <span class="text-tab">
                                                        Similar Jobs
                                                    </span>
                                                </a>
                                                <a href="{{ route('user.create_pdf', auth()->user()->username) }}">
                                                    <span class="icon-tab">
                                                        <img src="{{ asset('frontend/assets/images/files/download.svg') }}"
                                                            alt="">
                                                    </span>
                                                    <span class="text-tab">
                                                        Download Resume
                                                    </span>
                                                </a>
                                                {{-- <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                                <span class="icon-tab">

                                                </span>
                                                <span class="text-tab">
                                                    Log Out
                                                </span>
                                            </a> --}}
                                                <form action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" style="width:100%;outline:none;border:none">
                                                        <span class="icon-tab">
                                                            <img src="{{ asset('frontend/assets/images/files/logout.svg') }}"
                                                                alt="">
                                                        </span>
                                                        <span class="text-tab">Log Out</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="a-break m-2 mobile-none">
                                    <img src="{{ asset('frontend/assets/images/files/RBB_bank_AD_990x338.gif') }}"
                                        alt="" class="img-fluid">
                                </div>
                            </div>


                        </div>
                        <!--end col-->

                        <div class="col-lg-9 col-md-8">
                            @yield('user_content')
                        </div>
                        <!--end row-->
                    </div>
                    <!--end container-->
            </section>
            <!-- END CANDIDATE-DETAILS -->

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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="mb-3">
                            <label for="nameControlInput" class="form-label">Name</label>
                            <input type="text" class="form-control" id="nameControlInput" placeholder="Enter your name">
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
@endsection
