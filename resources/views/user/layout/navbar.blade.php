<div id="header" class="fixed-top sticky">
    <header class="">
        <div class="container-fluid custom-container">
            <div class="header-top">
                <a class="navbar-brand text-dark fw-bold me-auto" href="{{ route('index') }}">
                    <img src="{{ asset('storage/setting/logo/' . $setting->logo) }}" height="60" alt=""
                        class="logo-dark" />
                    <img src="{{ asset('storage/setting/logo/' . $setting->logo) }}" height="60" alt=""
                        class="logo-light" />
                </a>
                <div class="adverties">
                    <span class="new-size">Are you recruiting?</span> &nbsp;
                    <a href="{{ route('advertise.index') }}" name="submit" id="submit"
                        class="btn btn-orange btn-hover">Advertise
                        Now</a>
                </div>
            </div>
        </div>
    </header>
    <!--Navbar Start-->
    <nav class="navbar navbar-expand-lg @if (!request()->is('advertise/*'))  @endif" id="navbar">
        <div class="container-fluid custom-container">
            <div class="nav-toggler">
                <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-5 navbar-center">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('index') }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-hover">
                        <a class="nav-link" href="javascript:void(0)" id="pagesdoropdown" role="button"
                            data-bs-toggle="dropdown">
                            Explore Jobs
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-center"
                            aria-labelledby="pagesdoropdown">
                            <div class="row">

                                {{-- @php
                                 $navCategories = App\Models\CompanyCategory::with('jobs')
                                     ->where('status', 'active')
                                     ->orderBy('order_no')
                                     ->get();
                             @endphp
                             @foreach ($navCategories->chunk(3) as $categoryChunk)
                                 <div class="row">
                                     @foreach ($categoryChunk as $category)
                                         <div class="col-lg-4">
                                             <div>
                                                 <a href="{{ route('jobs', ['category' => $category->slug]) }}"
                                                     class="dropdown-item">
                                                     {{ $category->title }} ({{ $category->jobs->count() }})
                                                 </a>
                                             </div>
                                         </div>
                                     @endforeach
                                 </div>
                             @endforeach --}}
                                @php
                                    $nvIndustries = App\Models\Industry::where('status', 'active')
                                        ->orderBy('order_no')
                                        ->with(['jobs', 'employers.jobs'])
                                        ->get();
                                @endphp
                                @foreach ($nvIndustries->sortByDesc(function ($industry) {
            return $industry->jobs->count();
        })->chunk(3) as $key => $industry)
                                    <div class="row">
                                        @foreach ($industry as $item)
                                            <div class="col-lg-4">
                                                <div>
                                                    <a href="{{ route('jobs', ['industry' => $item->slug]) }}"
                                                        class="dropdown-item">
                                                        {{ $item->name }} ({{ $item->jobs->count() }})
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                                <!--end col-->
                            </div>
                        </div>
                    </li>
                    {{-- <li class="nav-item ">
                     <a class="nav-link" href="{{route('advertise.banner-job')}}">
                         Advertise with us
                     </a>
                 </li> --}}



                    <li class="nav-item dropdown dropdown-hover new-dropdown position-relative">
                        <a class="nav-link" href="javascript:void(0)" id="jobsdropdown" role="button"
                            data-bs-toggle="dropdown">
                            FAQs <div class="arrow-down"></div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="jobsdropdown">
                            <li><a class="dropdown-item" href="{{ route('faq', ['faq' => 'job_seeker']) }}">Job
                                    Seeker</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('faq', ['faq' => 'employer']) }}">Employeer</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('about') }}">
                            About Us
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('blog') }}">
                            Blogs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                    </li>

                    <li class="nav-item dropdown dropdown-hover new-dropdown position-relative">
                        <a class="nav-link" href="javascript:void(0)" id="jobsdropdown" role="button"
                           data-bs-toggle="dropdown">
                            Training <div class="arrow-down"></div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="jobsdropdown">
                            <li><a class="dropdown-item" href="{{ route('training') }}">Event Calender</a>

                            <li><a class="dropdown-item" href="{{ route('training') }}">Events</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!--end navbar-nav-->
            </div>
            <!--end navabar-collapse-->
            <ul class="header-menu list-inline d-flex align-items-center mb-0">
                @guest
                    <li class="list-inline-item dropdown me-2">
                        <a href="javascript:void(0)" class="btn btn-orange position-relative" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="fa fa-user mobile-none"></i><span
                                class="mobile-none">&nbsp;&nbsp;</span><span class="desktop-only">Sign
                                In</span>
                            <span class="mobile-only">Jobseeker Portal</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end p-0" aria-labelledby="notification">
                            <div class="auth-content card-body px-3 py-2 h-100">
                                <div class="w-100">
                                    <div class="text-left mb-2">
                                        <p class=""><strong>Login with your email account.</strong></p>
                                    </div>
                                    <form action="{{ route('users.login') }}" method="post" class="auth-form">
                                        <div class="mb-3">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <label for="usernameInput" class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" id="usernameInput"
                                                placeholder="Enter your username" required="">
                                            <div class="mb-3 position-relative">
                                                <label for="passwordInputs" class="form-label">Password</label>
                                                <input type="password" name="password"
                                                    class="form-control password-input" id="passwordInputs"
                                                    placeholder="Enter your password" required="">
                                                <div class="eye-btn">
                                                    <span class="show-eye d-none">
                                                        <i class="fa-solid fa-eye"></i></span>
                                                    <span class="hide-eye">
                                                        <i class="fa-solid fa-eye-slash"></i></span>
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary btn-hover w-100">Sign
                                                        In</button>
                                                </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a href="{{ route('googleLogin') }}"
                                            class="btn btn-outline-secondary btn-hover w-100"><i
                                                class="fa-brands fa-google"></i> &nbsp;Log In with
                                            Google</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-inline-item dropdown extra-padding-right d-none d-sm-inline-block">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#signupModal"
                            class="btn btn btn-outline-white position-relative"><i
                                class="mdi mdi-login"></i>&nbsp;<span>Register CV</span> </a>
                    </li>
                    <li class="list-inline-item employer-btn">
                        <a href="javascript:void(0)" class="zone-a position-relative" data-bs-toggle="dropdown"
                            aria-expanded="false">&nbsp;<span class="desktop-only">Empolyer Zone</span>
                            <span class="mobile-only">Employer Portal</span>
                            <div class="arrow-down"></div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end p-0" aria-labelledby="notification">
                            <div class="auth-content card-body px-3 py-2 h-100">
                                <div class="w-100">
                                    <ul class="employee-zone">
                                        <li class="nav-item border-bottom">
                                            <a class="nav-link"
                                                href="{{ auth()->check() ? route('employers.post-a-job') : route('employers.login') }}">
                                                Post A Job
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link" href="{{ route('employers.login') }}">
                                                Employer Login
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @else
                    @if (auth()->user()->hasRole('job-seeker'))
                        @include('user.dashboard.layouts.right-menu')
                    @elseif (auth()->user()->hasRole('employer'))
                        @include('employer.layouts.right-menu')
                    @else
                        <ul class="header-menu list-inline d-flex align-items-center mb-0">
                            <li class="list-inline-item dropdown">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-white"><i
                                        class="fa fa-user"></i>&nbsp;Dashboard</a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" id="logout">
                                    @csrf
                                </form>
                                <button class="btn btn-outline-white" onclick="logout()">Logout</button>
                            </li>
                        </ul>
                    @endif
                    {{-- <li class="list-inline-item dropdown extra-padding-right">
                        <a href="{{ auth()->user()->hasRole('employer')? route('employers.index'): (auth()->user()->hasRole('job-seeker')? route('user.dashboard', auth()->user()->username): route('admin.dashboard')) }}"
                            data-bs-target="#signupModal" class="btn btn btn-orange position-relative"><i
                                class="fa fa-user"></i>&nbsp;&nbsp;<span>Dashboard</span> </a>
                    </li>
                    <li class="list-inline-item dropdown extra-padding-right">
                        <form
                            action="{{ request()->routeIs('employers.*') ? route('employers.logout') : route('logout') }}"
                            method="POST">
                            @csrf
                            <button class="btn btn btn-outline-white position-relative"><i
                                    class="mdi mdi-logout"></i>&nbsp;&nbsp;<span>Log Out</span> </button>
                        </form>
                    </li> --}}
                    @endif
                </ul>
                <!--end header-menu-->
            </div>
            <!--end container-->
        </nav>
        <!-- Navbar End -->
    </div>
    <!-- START SIGN-UP MODAL -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <div class="position-absolute end-0 top-0 px-3 py-2">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="auth-content">
                        <div class="w-100">
                            <div class="text-center mb-4">
                                <h5>Sign Up</h5>
                                <p class="text-muted">Sign Up and get access to all the features of Jobs</p>
                            </div>
                            <form action="{{ route('users.signUp') }}" class="auth-form" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <span id="message" class></span>
                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="Enter your username">
                                </div>
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="emailInput"
                                        placeholder="Enter your email">
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="passwordInputi" class="form-label">Password</label>
                                    <input type="password" class="form-control password-input" name="password"
                                        id="passwordInputi" placeholder="Password">
                                    <div class="eye-btn">
                                        <span class="show-eye d-none">
                                            <i class="fa-solid fa-eye"></i></span>
                                        <span class="hide-eye">
                                            <i class="fa-solid fa-eye-slash"></i></span>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="form-check"><input class="form-check-input" type="checkbox"
                                            id="flexCheckDefault" name="accept">
                                        <label class="form-check-label" for="flexCheckDefault">I agree to the <a
                                                href="{{ route('terms') }}"
                                                class="text-primary form-text text-decoration-underline">Terms and
                                                conditions</a></label>
                                    </div>
                                </div>
                                @if (config('services.recaptcha.site_key'))
                                    <div class="g-recaptcha mb-2"
                                        data-sitekey="{{ config('services.recaptcha.site_key') }}">
                                    </div>
                                @endif
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <a href="{{ route('googleLogin') }}"
                                        class="btn btn-outline-secondary btn-hover w-100"><i
                                            class="fa-brands fa-google"></i> &nbsp;&nbsp;Log In with
                                        Google</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end modal-body-->
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>
    <!-- END SIGN-UP MODAL -->
    <!-- START Login-UP MODAL -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <div class="position-absolute end-0 top-0 px-3 py-2">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="auth-content">
                        <div class="w-100">
                            <div class="text-center mb-4">
                                <h5>Log In</h5>
                                <p class="text-muted">Log In and get access to all the features of Jobcy</p>
                            </div>
<!--                            <form action="{{ route('users.login') }}" method="POST" class="auth-form">-->
<!--                                @csrf-->
<!--                                <div class="mb-3">-->
<!--                                    <label for="usernameInput" class="form-label">Username</label>-->
<!--                                    <input type="text" name="username" class="form-control" id="usernameInput"-->
<!--                                        placeholder="Enter your username">-->
<!---->
<!--                                </div>-->
<!--                                <div class="mb-3">-->
<!--                                    <label for="passwordInput" class="form-label">Password</label>-->
<!--                                    <input type="password" name="password" class="form-control" id="passwordInput"-->
<!--                                        placeholder="Password">-->
<!--                                </div>-->
<!--                                <div class="mb-4">-->
<!--                                    <div class="form-check">-->
<!--                                        <a href="#" class="float-start">Forgot-->
<!--                                            Password?</a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="text-center">-->
<!--                                    <button type="submit" class="btn btn-primary w-100">Log In</button>-->
<!--                                </div>-->
<!--                                <hr>-->
<!--                                <div class="text-center">-->
<!--                                    <a href="{{ route('googleLogin') }}"-->
<!--                                        class="btn btn-outline-secondary btn-hover w-100"><i-->
<!--                                            class="fa-brands fa-google"></i> &nbsp;&nbsp;Log In with-->
<!--                                        Google</a>-->
<!--                                </div>-->
<!--                            </form>-->
                        </div>
                    </div>
                </div>
                <!--end modal-body-->
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>
    <!-- END LOGIN-UP MODAL -->
