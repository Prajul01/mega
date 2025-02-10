@extends('user.layout.master')
@section('title')
    {{ $employee->company_name }}
@endsection
@section('seo_section')
    <meta name="description" content="{{ isset($setting) ? $setting->og_description : '' }}">
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ isset($setting) ? $setting->og_title : '' }}">
    <meta property="og:description" content="{{ isset($setting) ? $setting->og_description : '' }}">
    <meta property="og:image"
        content="{{ isset($setting) ? asset('storage/setting/og-image/' . $setting->og_image) : '' }}">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ env('APP_URL') }}">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ isset($setting) ? $setting->og_title : '' }}">
    <meta name="twitter:description" content="{{ isset($setting) ? $setting->og_description : '' }}">
    <meta name="twitter:image"
        content="{{ isset($setting) ? asset('storage/setting/og-image/' . $setting->og_image) : '' }}">
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <!-- START CANDIDATE-DETAILS -->
            <section class="section dashboard-section">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-lg-9">
                            <div class="card candidate-info shadow-sidebar mt-4 mb-3 mt-lg-0">
                                <div class="hiring-banner">
                                    <img src="{{ asset('storage/employer/' . $employee->image) }}" class="img-fluid"
                                        alt="hiring-banner">
                                </div>
                                <div class="card-body p-3">
                                    <div class="user-profile-summary">
                                        <div class="profile-summary-heading company-profile-heading">
                                            <div class="company-img">
                                                <img src="{{ asset('storage/employer/logo' . $employee->logo) }}"
                                                    alt="{{ $employee->company_name }} logo" class="img-thumbnail">
                                            </div>
                                            <div class="user-basic-info">
                                                <div class="user-name">
                                                    {{ $employee->company_name }}
                                                </div>
                                                <div class="company-industry">
                                                    {{ $employee->category->title }}
                                                </div>
                                                @if (@$employee->settings->ownership)
                                                    <div class="company-type">
                                                        <strong
                                                            class="blue-light px-2">{{ $employee->ower_ship->title }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        @if (@$employee->settings->summary)
                                            <div class="profile-summary-body">
                                                <div class="education-summary-title">
                                                    <span class="icon">
                                                        <i class="fa-solid fa-briefcase"></i>
                                                    </span> Company Description
                                                </div>
                                                <div class="education-summary-body">
                                                    <div class="company-about-desc">
                                                        {!! strip_tags($employee->company_description) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="profile-summary-table">
                                            <div class="single-basic-wrapper">
                                                <div class="basic-job-desc">
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Organization Ownership
                                                        </div>
                                                        <div class="basic-job-right">
                                                            {{ $employee->ower_ship->title }}
                                                        </div>
                                                    </div>
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Organization Type
                                                        </div>
                                                        <div class="basic-job-right">
                                                            {{ $employee->category->title }}
                                                        </div>
                                                    </div>
                                                    @if (@$employee->settings->size)
                                                        <div class="basic-job-list">
                                                            <div class="basic-job-left">
                                                                Size of Organization
                                                            </div>
                                                            <div class="basic-job-right">

                                                                {{ $employee->company_size->title }} employees
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Company Email
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <?php
                                                            $emails = $employee
                                                                ->emails()
                                                                ->orderBy('is_primary', 'desc')
                                                                ->get();
                                                            ?>
                                                            @foreach ($emails as $email)
                                                                [<a
                                                                    href="mailto:{{ $email->email }}">{{ $email->email }}</a>]
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @if (@$employee->settings->address)
                                                        <div class="basic-job-list">
                                                            <div class="basic-job-left">
                                                                Address
                                                            </div>
                                                            <div class="basic-job-right">
                                                                <?php
                                                                if (@$employer->city->name == @$employer->district->name) {
                                                                    $address = $employee->city->name;
                                                                } else {
                                                                    $address = $employee->city->name . ', ' . @$employer->district->name;
                                                                }
                                                                ?>
                                                                {{ $address }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (@$employee->office_number)
                                                        <div class="basic-job-list">
                                                            <div class="basic-job-left">
                                                                Office Number

                                                            </div>
                                                            <div class="basic-job-right">
                                                                <a
                                                                    href="tel:{{ $employee->office_number }}">{{ $employee->office_number }}</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (@$employee->phone_number)
                                                        <div class="basic-job-list">
                                                            <div class="basic-job-left">
                                                                Phone Number
                                                            </div>
                                                            <div class="basic-job-right">
                                                                <a
                                                                    href="tel:{{ $employee->phone_number }}">{{ $employee->phone_number }}</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (@$employee->settings->website)
                                                        <div class="basic-job-list">
                                                            <div class="basic-job-left">
                                                                Website
                                                            </div>
                                                            <div class="basic-job-right">
                                                                <a href="{{ $employee->company_website }}"
                                                                    target="_blank">{{ $employee->company_website }}</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if (@$employee->settings->social_accounts)
                                                        <div class="basic-job-list">
                                                            <div class="basic-job-left">
                                                                Social Account

                                                            </div>
                                                            <div class="basic-job-right">
                                                                <div class="social-share">
                                                                    <ul class="job-social pl-0">
                                                                        @if (@$employee->facebook_url)
                                                                            <li class="facebook"><a
                                                                                    href="{{ $employee->facebook_url }}"
                                                                                    class="">
                                                                                    <i class="fa-brands fa-facebook-f"></i>
                                                                                </a></li>
                                                                        @endif
                                                                        @if (@$employee->instagram_url)
                                                                            <li class="insta"><a
                                                                                    href="{{ $employee->instagram_url }}"
                                                                                    class="">
                                                                                    <i class="fa-brands fa-instagram"></i>
                                                                                </a></li>
                                                                        @endif
                                                                        @if (@$employee->youtube_url)
                                                                            <li class="twitter"><a href=""
                                                                                    class="{{ $employee->yoututbe_url }}">
                                                                                    <i class="fa-brands fa-youtube"></i>
                                                                                </a></li>
                                                                        @endif
                                                                        @if (@$employee->linkedIn_url)
                                                                            <li class="linkedin"><a
                                                                                    href="{{ $employee->linkedIn_url }}"
                                                                                    class="">
                                                                                    <i
                                                                                        class="fa-brands fa-linkedin-in"></i>
                                                                                </a></li>
                                                                        @endif
                                                                        @if (@$employee->tiktok_url)
                                                                            <li class="reddit"><a
                                                                                    href="{{ $employee->tiktok_url }}"
                                                                                    class="">
                                                                                    <i class="fa-brands fa-tiktok"></i>
                                                                                </a></li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @if (@$employee->settings->services)
                                                <div class="profile-summary-body my-3">
                                                    <div class="education-summary-title">
                                                        <span class="icon">
                                                            <i class="fa-solid fa-briefcase"></i>
                                                        </span> Services
                                                    </div>

                                                    <div class="education-summary-body">
                                                        <div class="company-about-desc">
                                                            {!! $employee->services !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (@$employee->contact_persons_information)
                                                <div class="row company-contact-person">
                                                    <div class="col-lg-12">
                                                        <h4 class="tab-main-title">
                                                            <span class="tab-icon">
                                                                <i class="fa-solid fa-id-card-clip"></i>
                                                            </span> &nbsp;
                                                            Contact Persons
                                                        </h4>
                                                    </div>
                                                    <?php
                                                    $infos = json_decode(@$employee->contact_persons_information);
                                                    $name = @$infos->names ? $infos->names : (@$infos->name ? $infos->name : []);
                                                    $email = @$infos->emails ? $infos->emails : (@$infos->email ? $infos->email : []);
                                                    $designation = $infos->designation;
                                                    $mobile = @$infos->number ? $infos->number : (@$infos->mobile ? $infos->mobile : []);
                                                    
                                                    $count = count($name);
                                                    ?>
                                                    @for ($i = 0; $i < $count; $i++)
                                                        <div class="col-lg-4 col-md-6">
                                                            <div class="contact-person-info">
                                                                <p class="contact-name">{{ $name[$i] }}</p>
                                                                <div class="ending-content-gradient-box">
                                                                    <p>
                                                                        <span class="top-icon">
                                                                            <i class="fa-solid fa-briefcase"></i> :&nbsp;
                                                                        </span>
                                                                        {{ $designation[$i] }}
                                                                    </p>
                                                                    <p>
                                                                        <span class="top-icon">
                                                                            <i class="fa-solid fa-envelope"></i> :&nbsp;
                                                                        </span>
                                                                        <a
                                                                            href="mailto:{{ $email[$i] }}">{{ $email[$i] }}</a>
                                                                    </p>
                                                                    <p>
                                                                        <span class="top-icon">
                                                                            <i class="fa-solid fa-phone"></i> :&nbsp;
                                                                        </span>
                                                                        <a
                                                                            href="tel:{{ $mobile[$i] }}">{{ $mobile[$i] }}</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="side-box">
                                <div class="sidebox-wrap">
                                    <div class="sidebox-title">
                                        <p>Urgent Job Vacancies</p>
                                    </div>
                                    @if (count($urgent_jobs) > 0)
                                        <div class="sidebox-content">
                                            <ul>
                                                @foreach ($urgent_jobs as $job)
                                                    <li>
                                                        <p>
                                                            <a href="{{ route('job_single', $job->slug) }}"><i
                                                                    class="fa fa-plus"></i>{{ $job->title }}
                                                                - <small>{{ $job->employer->company_name }}</small></a>
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                                <div class="a-break mb-2">
                                    <img src="{{ asset('frontend/assets/images/files/machapuchree-bank_k8S0FE3TWD.gif') }}"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="sidebox-wrap">
                                    <div class="sidebox-title">
                                        <p>Career Tips</p>
                                    </div>
                                    @if (count($careers) > 0)
                                        <div class="sidebox-content">
                                            <ul>
                                                @foreach ($careers as $career)
                                                    <li>
                                                        <p>
                                                            <a
                                                                href="{{ route('career-details', ['career' => $career->slug]) }}"><i
                                                                    class="fa fa-chevron-right"></i>
                                                                {{ $career->title }}
                                                            </a>
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div><!--end container-->
                </div>
            </section>

            @if (count($employee->jobs) > 0)
                <section class="company-job-section-new">
                    <div class="container-fluid custom-container">
                        <div class="row job-box-wrapper mb-2">
                            @foreach ($employee->jobs as $job)
                                <div class="col-lg-6">
                                    <div class="job-box card mt-2">
                                        <div class="p-3 pb-2">
                                            <div class="job-list-card">
                                                <div class="company-image">
                                                    <a href="https://megajob.ktmrush.com/employer/detail/tech-central-1"><img
                                                            src="{{ asset('storage/employer/logo' . $job->employer->logo) }}"
                                                            alt="Tech central" width="83px"
                                                            class="img-fluid rounded-3"></a>
                                                </div>
                                                <div class="job-desc-company">
                                                    <div class="mt-3 mt-lg-0">
                                                        <h5 class="fs-18 mb-0"><a
                                                                href="https://megajob.ktmrush.com/job/montana-ware"
                                                                class="text-dark">
                                                                {{ $job->title }}</a>
                                                        </h5>
                                                        <p class="fs-14 mb-0">
                                                            <a href="https://megajob.ktmrush.com/employer/detail/tech-central-1"
                                                                class="text-dark">
                                                                {{ $job->employer->company_name }}
                                                            </a>
                                                        </p>
                                                    </div>
                                                    <div class="job-main-info d-block">
                                                        <div class="location">
                                                            <span class="icon">
                                                                <i class="fa-solid fa-location-dot fs-13"></i>
                                                            </span>
                                                            <span class="fs-14">
                                                                <?php
                                                                if (@$employer->city->name == @$employer->district->name) {
                                                                    $address = $employee->city->name;
                                                                } else {
                                                                    $address = $employee->city->name . ', ' . @$employer->district->name;
                                                                }
                                                                ?>
                                                                {{ $address }}</span>
                                                        </div>

                                                        <div class="job-single-company-detail text">
                                                            {!! $job->job_description !!}
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="list-card-bottom">
                                                <div class="time-span">
                                                    @if (@$job->expiry_date)
                                                        <span class="icon">
                                                            <i class="fa-regular fa-clock"></i>
                                                        </span>
                                                        <?php
                                                        $currentDateTime = \Carbon\Carbon::now();
                                                        $endDate = \Carbon\Carbon::parse($job->expiry_date);
                                                        $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                                            'parts' => 2,
                                                            'short' => false,
                                                            'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                                        ]);
                                                        ?>
                                                        {{ $timeLeft }} Left
                                                    @endif
                                                </div>
                                                <div class="apply-btn">
                                                    <a href="{{ route('job_single', $job->slug) }}"
                                                        class="btn btn-orange">View Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </section>
            @endif

            <!-- END CANDIDATE-DETAILS -->

        </div>
        <!-- End Page-content -->
    </div>
@endsection
