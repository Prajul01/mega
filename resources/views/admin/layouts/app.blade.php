<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Admin Panel - @yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ $setting->favicon ? asset('storage/setting/favicon/' . $setting->favicon) : '' }}"
        type="image/png" />
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/animate-css/vivify.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/sweetalert/sweetalert.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/toastr/toastr.css') }}" />

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('backend/html/assets/css/site.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/colors.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/ui/trumbowyg.min.css"
        integrity="sha512-Fm8kRNVGCBZn0sPmwJbVXlqfJmPC13zRsMElZenX6v721g/H7OukJd8XzDEBRQ2FSATK8xNF9UYvzsCtUpfeJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--find-->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/dropify/css/dropify.min.css') }}">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <style>
        .full-link {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
    </style>
    @stack('style')

</head>

<body class="theme-cyan font-montserrat light_version mini_sidebar">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
            <div class="bar4"></div>
            <div class="bar5"></div>
        </div>
    </div>

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <div id="wrapper">

        <nav class="navbar top-navbar">
            <div class="container-fluid">

                <div class="navbar-left">
                    <div class="navbar-btn">
                        <button type="button" class="btn-toggle-offcanvas"><i
                                class="lnr lnr-menu fa fa-bars"></i></button>
                    </div>

                </div>

                <div class="navbar-right">
                    <div id="navbar-menu">
                        <ul class="nav navbar-nav">
                            <li>
                                <a title="" data-toggle="tooltip" data-placement="top" class="icon-menu"
                                    href="{{ url('/') }}" target="_blank" data-original-title="Visit Site"><i
                                        class="icon-globe text-blue"></i> </a>
                            </li>
                            &nbsp;|&nbsp;
                            <li>
                                <a title="" data-toggle="tooltip" data-placement="top" class="icon-menu"
                                    id="nav-logout" data-original-title="Log Out"><i
                                        class="icon-power text-red"></i></a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>


        <div id="left-sidebar" class="sidebar  ">
            <div class="navbar-brand">
                <a href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('storage/setting/favicon/' . $setting->favicon) }}" alt=""
                        class="img-fluid logo">
                    <span>{{ $setting->site_title }}</span>
                </a>
                <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right hide-lg">
                    <i class="lnr lnr-menu icon-close"></i>
                </button>
            </div>
            <div class="sidebar-scroll">
                <div class="user-account">
                    <div class="user_div">
                        <img src="{{ asset('storage/setting/favicon/' . $setting->favicon) }}" class="user-photo"
                            alt="User Profile Picture">
                        <span>Welcome, <br> {{ auth()->user()->name }}</span>
                    </div>
                </div>
                <nav id="left-sidebar-nav" class="sidebar-nav">
                    <ul id="main-menu" class="metismenu">
                        <li class="header"><b>Dashboard</b></li>

                        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}" data-toggle="tooltip" data-placement="right"
                                title="User Dashboard">
                                <i class="icon-speedometer"></i><span>Dashboard</span>
                            </a>
                        </li>
                        @can('site-list')
                            <li class="header"><b>Site Management</b></li>

                            <li class="{{ request()->routeIs('admin.setting.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.setting.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Site Info ">
                                    <i class="icon-screen-desktop"></i><span>Site Info </span>
                                </a>
                            </li>
                        @endcan

                        @can('role-list')
                            <li class="header"><b>Role Management</b></li>
                            <li class="{{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.roles.index') }}" data-toggle="tooltip" data-placement="right"
                                    title="Roles">
                                    <i class="fa fa-users"></i><span>Roles </span>
                                </a>
                            </li>
                        @endcan
                        @role('super-admin')
                            <li class="header"><b>Admin Management</b></li>
                            <li class="{{ request()->routeIs('admin.admin-management.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.admin-management.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Admin">
                                    <i class="fa fa-user"></i><span>Admin </span>
                                </a>
                            </li>
                        @endrole
                        @can('user-list')
                            <li class="header"><b>User Management</b></li>
                            <li class="{{ request()->routeIs('admin.adminUsers.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.adminUsers.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Users">
                                    <i class="fa fa-user"></i><span>Users Admin</span>
                                </a>
                            </li>
                        @endcan
                        @can('employer-list')
                            <li class="header"><b>Employer Management</b></li>
                            <li class="{{ request()->routeIs('admin.employers.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.employers.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Employers">
                                    <i class="fa fa-users"></i><span>Employers </span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('admin.employer.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.employer.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Employer Details">
                                    <i class="fa fa-list"></i><span>Employer Details</span>
                                </a>
                            </li>
                        @endcan

                        @can('user-list')
                            <li class="header"><b>Job Seeker Management</b></li>

                            <li class="{{ request()->routeIs('admin.users.admins.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.users.admins.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Job Seeker">
                                    <i class="fa fa-users"></i><span>Job Seekers</span>
                                </a>
                            </li>
                        @endcan

                        @can('job-list')
                            <li class="header"><b>Job Management</b></li>
                            <li class="{{ request()->routeIs('admin.job-management.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.job.index') }}" data-toggle="tooltip" data-placement="right"
                                    title="Jobs">
                                    <i class="fa fa-suitcase"></i><span>Jobs</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.jobRequest.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.jobRequest.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Job Requests">
                                    <i class="fa fa-handshake-o"></i><span>Job Requests</span>
                                </a>
                            </li>
                            <li class=""><a aria-current="page" class="has-arrow active"><i
                                        class="icon-home"></i><span>Job Post Management</span></a>
                                <ul
                                    class="collapse collapse collapse collapse collapse collapse collapse {{ request()->routeIs('admin.jobPosting.*') ? 'in' : '' }}">
                                    <li class=""><a
                                            href="{{ route('admin.jobPosting.index', 'megajobs') }}"><span>Megajobs</span></a>
                                    </li>
                                    <li class=""><a
                                            href="{{ route('admin.jobPosting.index', 'premium-jobs') }}"><span>Premium
                                                Jobs</span></a></li>
                                    <li class=""><a
                                            href="{{ route('admin.jobPosting.index', 'prime-jobs') }}"><span>Prime
                                                Jobs</span></a></li>
                                    <li class=""><a
                                            href="{{ route('admin.jobPosting.index', 'other-jobs') }}"><span>Other
                                                Jobs</span></a></li>
                                </ul>
                            </li>
                        @endcan
                        @can('job-list')
                            <li class="header"><b>Job Parameter Management</b></li>
                            <li class="{{ request()->routeIs('admin.skill.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.skill.index') }}" data-toggle="tooltip" data-placement="right"
                                    title="Skills">
                                    <i class="fa fa-cogs"></i><span> Skills</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.employee_type.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.employee_type.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Employee Type">
                                    <i class="fa fa-users"></i><span> Employee Type</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.language.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.language.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Language">
                                    <i class="fa fa-language"></i><span> Language</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.JobLevel.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.JobLevel.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Job Level">
                                    <i class="fa fa-shopping-basket"></i><span> Job Level</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.experience.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.experience.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Experience">
                                    <i class="fa fa-history"></i><span>Experience</span>
                                </a>
                            </li>
                        @endcan


                        @can('company-list')
                            <li class="header"><b>Company Management</b></li>
                            <li class="{{ request()->routeIs('admin.industry.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.industry.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Industries">
                                    <i class="icon-layers"></i><span>Industries</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.company_category.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.company_category.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Departments">
                                    <i class="icon-layers"></i><span>Departments</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('admin.company_ownership.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.company_ownership.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Company Ownership">
                                    <i class="icon-badge"></i><span>Company Ownership</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.company_size.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.company_size.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Company Size">
                                    <i class="fa fa-users"></i><span>Company Size</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.vehicle.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.vehicle.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Vehicle">
                                    <i class="fa fa-motorcycle"></i><span>Vehicle</span>
                                </a>
                            </li>
                        @endcan
                        @can('education-list')
                            <li class="header"><b>Education Management</b></li>
                            <li class="{{ request()->routeIs('admin.education.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.education.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Education">
                                    <i class="fa fa-graduation-cap"></i><span> Education</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.studyfield.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.studyfield.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Study Fields">
                                    <i class="fa fa-graduation-cap"></i><span>Study Fields</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.studysubject.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.studysubject.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Study Subject">
                                    <i class="fa fa-graduation-cap"></i><span>Study Subject</span>
                                </a>
                            </li>
                        @endcan
                        @can('location-list')
                            <li class="header"><b>Location Management</b></li>
                            <li class="{{ request()->routeIs('admin.district.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.district.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Districts">
                                    <i class="fa fa-area-chart"></i><span>Districts</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.city.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.city.index') }}" data-toggle="tooltip" data-placement="right"
                                    title="Cities">
                                    <i class="fa fa-building"></i><span>Cities</span>
                                </a>
                            </li>
                        @endcan

                        @can('tender-list')
                            <li class="header"><b>Tender Management</b></li>
                            <li class="{{ request()->routeIs('admin.tender_type.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.tender_type.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Tender Type">
                                    <i class="fa fa-file"></i><span>Tender Type</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.tender_category.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.tender_category.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Tender Category">
                                    <i class="fa fa-suitcase"></i><span>Tender Category</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.tender.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.tender.index') }}" data-toggle="tooltip" data-placement="right"
                                    title="Tender">
                                    <i class="fa fa-gavel"></i><span>Tender</span>
                                </a>
                            </li>
                        @endcan

                        @can('content-list')
                            <li class="header"><b>Tag Management</b></li>
                            <li class="{{ request()->routeIs('admin.tag.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.tag.index') }}" data-toggle="tooltip" data-placement="right"
                                    title="Tag">
                                    <i class="fa fa-tag"></i><span>Tag</span>
                                </a>
                            </li>
                        @endcan

                        @can('report-list')
                            <li class="header"><b>Report Issued</b></li>
                            <li class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.reports.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Issued Reports">
                                    <i class="fa fa-flag"></i><span>Issued Reports</span>
                                </a>
                            </li>
                        @endcan

                        @can('career-list')
                            <li class="header"><b>Career Management</b></li>
                            <li class="{{ request()->routeIs('admin.career.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.career.index') }}" data-toggle="tooltip" data-placement="right"
                                    title="Career">
                                    <i class="fa fa-graduation-cap"></i><span>Career</span>
                                </a>
                            </li>
                        @endcan

                        <li class="header"><b>Advetisement & Posting Planner</b></li>
                        <li class="{{ request()->routeIs('admin.dayPackages.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.dayPackages.index') }}" data-toggle="tooltip"
                                data-placement="right" title="DAy8 Packages">
                                <i class="fa fa-clock-o"></i><span>Day Packages</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.dayPackages.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.steps.index') }}" data-toggle="tooltip" data-placement="right"
                                title="Step Procedures">
                                <i class="fa fa-tasks"></i><span>Step Procedures</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.adBanner.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.adBanner.index') }}" data-toggle="tooltip"
                                data-placement="right" title="Banner">
                                <i class="fa fa-image"></i><span>Banner</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.pricing.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.pricing.mainIndex') }}" data-toggle="tooltip"
                                data-placement="right" title="Pricing Management">
                                <i class="fa fa-usd"></i><span>Pricing Management</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.staffs.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.staffs.index') }}" data-toggle="tooltip"
                                data-placement="right" title="Support Staff Info">
                                <i class="fa fa-users"></i><span>Support Staff Info</span>
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('admin.adContent.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.adContent.index') }}" data-toggle="tooltip"
                                data-placement="right" title="Content Management">
                                <i class="fa fa-edit"></i><span>Content Management</span>
                            </a>
                        </li>

                        @can('content-list')
                            <li class="header"><b>Content Management</b></li>
                             <li class="{{ request()->routeIs('admin.training.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.training.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Training">
                                    <i class="fa fa-image"></i><span>Trainning Management</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('admin.advertisement.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.advertisement.index') }}" data-toggle="tooltip"
                                   data-placement="right" title="Advertisement">
                                    <i class="fa fa-image"></i><span>Advertisement Management</span>
                                </a>
                            </li>


                            <li class="{{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.sliders.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Slider">
                                    <i class="fa fa-image"></i><span>Slider</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.about.index') }}" data-toggle="tooltip" data-placement="right"
                                    title="About">
                                    <i class="fa fa-info"></i><span>About </span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.blog.index') }}" data-toggle="tooltip" data-placement="right"
                                    title="Blog">
                                    <i class="fa fa-rss"></i><span>Blog </span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.faq.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.faq.index') }}" data-toggle="tooltip" data-placement="right"
                                    title="FAQ">
                                    <i class="fa fa-question-circle"></i><span>FAQ </span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.concern.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.concern.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Area of Concerns">
                                    <i class="fa fa-file"></i><span>Area of Concerns</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.news.index') }}" data-toggle="tooltip" data-placement="right"
                                    title="News And Announcement">
                                    <i class="fa fa-newspaper-o"></i><span>News And Announcement</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.terms.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.terms.index') }}" data-toggle="tooltip" data-placement="right"
                                    title="Terms And Condition">
                                    <i class="fa fa-gavel"></i><span>Terms And Condition </span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.privacy.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.privacy.index') }}" data-toggle="tooltip"
                                    data-placement="right" title="Privacy Polocies">
                                    <i class="fa fa-lock"></i><span> Privacy Policies</span>
                                </a>
                            </li>
                        @endcan

                        <li>
                            <a href="javascript:void();" type="button" title="logout" id="side-logout">
                                <i class="icon-power text-red"></i><span>Logout</span>
                            </a>
                        </li>
                        <br>
                        <br>
                    </ul>
                </nav>
            </div>
        </div>

        <div id="main-content">
            @yield('content')
        </div>

        <div class="modal fade" id="declined_message" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Declined Message</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Declined Message</label><br>
                        <small>*Please mention the reason for disapproval</small>
                        <textarea name="declined_message" class="form-control trumbowyg"
                            placeholder="Please mention the reason for disapproval" style="height:250px"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary mx-2" id="decline" onclick="disapprove()"
                            data-id=""><i class="fa fa-times"></i>
                            Decline</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Javascript -->
    <script src="{{ asset('backend/html/assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('backend/html/assets/bundles/vendorscripts.bundle.js') }}"></script>
    <script src="{{ asset('backend/html/assets/bundles/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('backend/assets/js/custom.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/toastr/toastr.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/dropify/js/dropify.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"
        integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="{{ asset('backend/js/pages/forms/dropify.js') }}"></script> --}}
    @if (session('status'))
        <script>
            $(function() {
                toastr.success("{{ session('status') }}");
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            $(function() {
                toastr.error("{{ session('error') }}");
            });
        </script>
    @endif
    @if (session('warning'))
        <script>
            $(function() {
                toastr.warning("{{ session('warning') }}");
            });
        </script>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $key => $error)
            <script>
                $(function() {
                    toastr.error("{{ $error }}");
                });
            </script>
        @endforeach
    @endif
    <script>
        $('document').ready(function() {
            $('.trumbowyg').trumbowyg();
        });
        $("#nav-logout").click(function(e) {
            e.preventDefault()
            swal({
                    title: "Are You Sure!",
                    text: "Would you like to log out from the system?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                },
                function(isConfirm) {
                    if (isConfirm) {
                        document.getElementById('logout-form').submit();
                    }
                })
        });

        $("#side-logout").click(function(e) {
            e.preventDefault()
            swal({
                    title: "Are You Sure!",
                    text: "Would you like to log out from the system?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                },
                function(isConfirm) {
                    if (isConfirm) {
                        document.getElementById('logout-form').submit();
                    }
                })
        });
    </script>
    <script>
        $(".job-settings").on('click', function() {
            var value = this.value;
            var slug = $(this).attr('data-id');
            swal({
                title: "Are you sure?",
                text: '',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    if (value == 'declined') {
                        $('#decline').attr('data-id', slug)
                        $('#declined_message').modal('show');
                    } else if (value == 'approved') {
                        postStatus(slug, value);
                    }
                }
            });

        });

        function disapprove() {
            approval = 'declined';
            message = $("textarea[name='declined_message']").val();
            slug = $('#decline').attr('data-id');
            postStatus(slug, approval, message);
        }

        function postStatus(slug, value, message = null) {
            console.log(slug);
            $.ajax({
                method: 'POST',
                url: "{{ route('admin.jobRequest.changeStatus', '') }}/" + slug,
                data: {
                    '_token': "{{ csrf_token() }}",
                    'approval': value,
                    'message': message,
                },
                success: function(res) {
                    toastr.success(res)
                    sleep(1000);
                    location.reload(true);
                },
                error: function(xhr) {
                    if (xhr.status == 404 || xhr.status == 422) {
                        toastr.error(xhr.responseText);
                    }
                }
            })
        }

        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
    </script>
    @stack('script')
</body>

</html>
