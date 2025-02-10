@extends('user.layout.master')
@section('title', 'Welcome to Employer Portal')
@section('content')
    <div class="page-content">

        <!-- START SIGN-IN -->
        <section class="bg-auth">
            <div class="container-fluid custom-container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12">
                        <div class="card auth-box no-shadow">
                            <div class="row g-0">
                                <div class="col-lg-6 tab-none text-center">
                                    <div class="card-body p-4">
                                        <!-- <a href="index.html">
                                                                            <img src="assets/images/logo-light.png" alt="" class="logo-light">
                                                                            <img src="assets/images/logo-dark.png" alt="" class="logo-dark">
                                                                        </a> -->
                                        <div class="mt-5">
                                            <img src="{{ asset('frontend/assets/images/files/login-megajob.png') }}"
                                                alt="" class="img-fluid">
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-6 col-md-10 offset-md-1 offset-lg-0">
                                    <div class="auth-content card-body p-5 py-4 h-100 text-white">
                                        <div class="w-100">
                                            <div class="text-center mb-4">
                                                <h5 class="welcome-heading">Welcome Back !</h5>
                                                <p class="text-white-70">Sign in to continue as a Employer to
                                                    Megajob.</p>
                                            </div>
                                            <?php
                                            if (request()->redirect_to) {
                                                $url = route('employers.securelogin', ['redirect_to' => request()->redirect_to]);
                                            } else {
                                                $url = route('employers.securelogin');
                                            }
                                            ?>
                                            <form action="{{ $url }}" method="POST" class="auth-form">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="usernameInput" class="form-label text-white">Username /
                                                        Email</label>
                                                    <input type="text" name="username" class="form-control"
                                                        id="usernameInput" placeholder="Enter your username / email"
                                                        required>
                                                </div>
                                                <div class="mb-3 position-relative">
                                                    <label for="passwordInput"
                                                        class="form-label text-white">Password</label>
                                                    <input type="password" name="password"
                                                        class="form-control password-input" id="passwordInput"
                                                        placeholder="Enter your password" required>
                                                    <div class="eye-btn">
                                                        <span class="show-eye d-none">
                                                            <i class="fa-solid fa-eye"></i></span>
                                                        <span class="hide-eye">
                                                            <i class="fa-solid fa-eye-slash"></i></span>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="form-check"><input class="form-check-input" name="remember"
                                                            type="checkbox" id="flexCheckDefault">
                                                        <a href="{{ route('employers.forget.password.get') }}"
                                                            class="float-end text-white">Forgot Password?</a>
                                                        <label class="form-check-label text-white"
                                                            for="flexCheckDefault">Remember me</label>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-white btn-hover w-100">Sign
                                                        In</button>
                                                </div>
                                            </form>
                                            <div class="mt-4 text-center">
                                                <p class="mb-0">Don't have an account ? <a
                                                        href="{{ route('employers.signup') }}"
                                                        class="fw-medium text-white text-decoration-underline">
                                                        Sign Up </a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end auth-box-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </section>
        <!-- END SIGN-IN -->

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
                        <input type="email" class="form-control" id="emailControlInput2" placeholder="Enter your email">
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
@endsection
