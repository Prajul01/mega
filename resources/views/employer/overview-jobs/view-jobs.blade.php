<?php
$employer = auth()->user()->employer;
if (isset(auth()->user()->employer->logo)) {
    $url = asset('storage/employer/logo' . auth()->user()->employer->logo);
} else {
    $url = asset('frontend/assets/images/files/company-logo.png');
}

if (@$employer->city->name == @$employer->district->name) {
    $address = @$employer->city->name;
} else {
    $address = @$employer->city->name . ', ' . @$employer->district->name;
}
$complete = 0;
if (@$employer) {
    $complete += 50;
    $basic = true;
    if (@$employer->contact_persons_information) {
        $complete += 25;
        $contact = true;
    }

    if (@$employer->tiktok_url) {
        $complete += 5;
    }

    if (@$employer->facebook_url) {
        $complete += 5;
    }

    if (@$employer->youtube_url) {
        $complete += 5;
    }

    if (@$employer->instagram_url) {
        $complete += 5;
    }

    if (@$employer->linkedIn_url) {
        $complete += 5;
    }
}
?>
@extends('user.layout.master')
@section('title', auth()->user()->employer->company_name)
@section('content')
    <?php
    $employer = auth()->user()->employer;
    if (isset(auth()->user()->employer->logo)) {
        $url = asset('storage/employer/logo' . auth()->user()->employer->logo);
    } else {
        $url = asset('frontend/assets/images/files/company-logo.png');
    }
    ?>
    <div class="page-content">
        <!-- START CANDIDATE-DETAILS -->
        <section class="section dashboard-section">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-lg-9  column-top">
                        <div class="top-hire">
                            <div class="flexed-det">
                                <div class="img-logo no-shadow">
                                    <img src="{{ $url }}" alt="{{ $employer->company_name }}" class="img-fluid">
                                </div>
                                <div class="img-details">
                                    <h2>{{ $job->title }}</h2>
                                    <h6>{{ $employer->company_name }}</h6>
                                    <h4> <i class="fa-solid fa-location-dot"></i>
                                        <?php
                                        if (@$employer->city->name == @$employer->district->name) {
                                            $address = @$employer->city->name;
                                        } else {
                                            $address = @$employer->city->name . ', ' . @$employer->district->name;
                                        }
                                        ?>
                                        {{ $address }}
                                    </h4>
                                </div>
                            </div>
                            <hr>

                            @if ($job->status != 'expired')
                                <div class="expire">
                                    <?php
                                    $currentDateTime = \Carbon\Carbon::now();
                                    $endDate = \Carbon\Carbon::parse($job->expiry_date);
                                    $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                        'parts' => 2,
                                        'short' => false,
                                        'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                    ]);
                                    ?>
                                    <i class="fa-regular fa-clock"></i>
                                    <strong>Deadline: {{ $timeLeft }} Left</strong>
                                </div>
                            @else
                                <div class="expire d-flex">
                                    <i class="fa-regular fa-clock"></i>
                                    <?php
                                    $currentDateTime = \Carbon\Carbon::now();
                                    $endDate = \Carbon\Carbon::parse($job->expiry_date);
                                    $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                        'parts' => 2,
                                        'short' => false,
                                        'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                    ]);
                                    ?>
                                    <h5>{{ $timeLeft }} Left</h5>
                                </div>
                            @endif
                        </div>


                        <div class="hiring-body">
                            <div class="job-single-heading">
                                <div class="job-single-title">{{ $job->title }}</div>
                            </div>
                            <!-- <h4>Junior HR Officer</h4> -->
                            <div class="job-single-basic">
                                <div class="single-basic-wrapper">
                                    <div class="basic-job-title">
                                        Basic Information
                                    </div>
                                    <div class="basic-job-desc">
                                        <div class="basic-job-list">
                                            <div class="basic-job-left">
                                                Job industry
                                            </div>
                                            <div class="basic-job-right">
                                                {{ $job->categories->industry->name }}
                                            </div>
                                        </div>
                                        <div class="basic-job-list">
                                            <div class="basic-job-left">
                                                Job Category
                                            </div>
                                            <div class="basic-job-right">
                                                {{ $job->categories->title }}
                                            </div>
                                        </div>
                                        <div class="basic-job-list">
                                            <div class="basic-job-left">
                                                Job Level
                                            </div>
                                            <div class="basic-job-right">
                                                {{ $job->job_level->title }}
                                            </div>
                                        </div>
                                        <div class="basic-job-list">
                                            <div class="basic-job-left">
                                                No. of Vacancy/s
                                            </div>
                                            <div class="basic-job-right">
                                                [{{ $job->no_of_opening }}]
                                            </div>
                                        </div>
                                        <div class="basic-job-list">
                                            <div class="basic-job-left">
                                                Employment Type
                                            </div>
                                            <div class="basic-job-right">
                                                {{ @$job->employee_type->title }}
                                            </div>
                                        </div>
                                        <div class="basic-job-list">
                                            <div class="basic-job-left">
                                                Job Location
                                            </div>
                                            <div class="basic-job-right">
                                                <?php
                                                if (@$job->city->name == @$job->district->name) {
                                                    $address = @$job->city->name;
                                                } else {
                                                    $address = @$job->city->name . ', ' . @$job->district->name;
                                                }
                                                ?>
                                                {{ $address }}
                                            </div>
                                        </div>
                                        <div class="basic-job-list">
                                            <div class="basic-job-left">
                                                Offered Salary
                                            </div>
                                            <div class="basic-job-right">
                                                {{ ucwords($job->salary_range) }}
                                            </div>
                                        </div>
                                        <div class="basic-job-list">
                                            <div class="basic-job-left">
                                                Apply Before (Deadline)
                                            </div>
                                            <div class="basic-job-right">
                                                {{ date('M d, Y', strtotime($job->expiry_date)) }}
                                                ({{ $timeLeft }} from now)
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-basic-wrapper">
                                    <div class="basic-job-title">
                                        Job Specification
                                    </div>
                                    <div class="basic-job-desc">
                                        <div class="basic-job-list">
                                            <div class="basic-job-left">
                                                Education Level
                                            </div>
                                            <div class="basic-job-right">
                                                {{ $job->education->title }}
                                            </div>
                                        </div>
                                        <div class="basic-job-list">
                                            <div class="basic-job-left">
                                                Experience Required
                                            </div>
                                            <div class="basic-job-right">
                                                {{ $job->experience->title }}
                                            </div>
                                        </div>
                                        <div class="basic-job-list">
                                            <div class="basic-job-left">
                                                Professional Skill Required
                                            </div>
                                            <div class="basic-job-right">
                                                <div class="skill-require-wrapper">
                                                    @foreach ($job->skill as $skill)
                                                        <span class="require-wrapper">
                                                            {{ $skill->title }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-basic-wrapper">
                                    <div class="basic-job-title">
                                        Other Specifications
                                    </div>
                                    <div class="job-basic-specification">
                                        {!! nl2br(strip_tags($job->job_specification)) !!}
                                    </div>

                                </div>
                                <div class="single-basic-wrapper">
                                    <div class="basic-job-title">
                                        Job Description
                                    </div>
                                    <div class="job-basic-specification">
                                        {!! nl2br(strip_tags($job->job_description)) !!}
                                    </div>

                                </div>


                                <div class="single-basic-wrapper">
                                    <div class="basic-job-image">
                                        <img src="assets/images/files/hiring-banner.png" class="img-fluid" alt="">
                                    </div>
                                </div>

                                <div class="job-single-footer">
                                    <div class="social-share">
                                        Share in:
                                        <ul class="job-social">
                                            <li class="facebook"><a
                                                    href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}"
                                                    class="" target="_blank">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a></li>
                                            <li class="twitter"><a
                                                    href="https://twitter.com/intent/tweet?text={{ $job->title }}&url={{ url()->full() }}"
                                                    class="" target="_blank">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a></li>
                                            <li class="linkedin"><a
                                                    href="http://www.linkedin.com/shareArticle?mini=true&url={{ url()->full() }}"
                                                    class="" target="_blank">
                                                    <i class="fa-brands fa-linkedin-in"></i>
                                                </a></li>
                                            <li class="reddit"><a
                                                    href="https://www.reddit.com/submit?url={{ url()->full() }}"
                                                    class="" target="_blank">
                                                    <i class="fa-brands fa-reddit-alien"></i>
                                                </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->

                    <div class="step-side col-lg-3">
                        <div class="same-job-box">
                            <div class="sidebox-wrap">
                                <div class="padding-x">
                                    <a href="#" class="d-block btn btn-outline-danger my-2">
                                        <span class="top-icon">
                                            <i class="fa-solid fa-circle-plus"></i>
                                        </span>&nbsp;
                                        Post a Job
                                    </a>
                                    <div class="small-logo ">
                                        <div class="img-logo no-shadow">
                                            <img src="{{ $url }}" alt="" class="image-size">
                                        </div>
                                        <div class="img-details">
                                            <h2>{{ $employer->company_name }}</h2>
                                            <h4>{{ $employer->category->title }}</h4>
                                        </div>
                                    </div>
                                    <div class="small-logo small-l">
                                        <div class="img-logo">
                                            <h5>Profile Completeness {{ $complete }}%</h5>
                                            <div class="progress-div">
                                                <div class="progress" role="progressbar" aria-label="Warning example"
                                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-warning"
                                                        style="width:{{ $complete }}%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="img-details text-end">
                                            <a href="{{ route('employers.index') }}"
                                                class="btn btn-secondary dropdown-toggle btnborder" id="dropdownMenua1"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                View Profile
                                            </a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="sidebox-wrap">
                                <div class="sidebox-title">
                                    <p>
                                        <span class="top-icon"><i class="fa-solid fa-chart-simple"></i></span>&nbsp;
                                        Job Overview
                                    </p>
                                </div>
                                <div class="spaces p-3  ">
                                    <div class="row">
                                        <div class="small-logo col-lg-6 center-content">
                                            <div class="num1">
                                                <h5>{{ $job->applied_users->count() }}</h5>
                                                <h6>Job Applied</h6>
                                            </div>
                                        </div>
                                        <div class="small-logo col-lg-6  center-content">
                                            <div class="num2">
                                                <h5>{{ $job->view_count }}</h5>
                                                <h6>Job Viewed</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="a-break mb-2">
                                <img src="./assets/images/files/RBB_bank_AD_990x338.gif" alt=""
                                    class="img-fluid">
                            </div>
                            {{-- <div class="sidebox-wrap">
                                    <div class="sidebox-title">
                                        <p>Similar Jobs</p>
                                    </div>
                                    <div class="categories-list">
                                        <ul class="same-company-job">
                                            <li>
                                                <a href="job-single.html" class="flex-link">
                                                    <img src="assets/images/files/sqlogo3.png" class="img-fluid"
                                                        alt="">
                                                    <div class="job-detail">
                                                        <span class="job-title">Online English Tutor</span>
                                                        <span class="job-company">
                                                            Engo
                                                        </span>
                                                        <span class="job-deadline">
                                                            Deadline: 4 Days, 5 hours
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="job-single.html" class="flex-link">
                                                    <img src="assets/images/files/sqlogo2.png" class="img-fluid"
                                                        alt="">
                                                    <div class="job-detail">
                                                        <span class="job-title">Primary Grade Teacher</span>
                                                        <span class="job-company">
                                                            AIP Education
                                                        </span>
                                                        <span class="job-deadline">
                                                            Deadline: 4 Days, 5 hours
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="job-single.html" class="flex-link">
                                                    <img src="assets/images/files/sqlogo1.png" class="img-fluid"
                                                        alt="">
                                                    <div class="job-detail">
                                                        <span class="job-title">Secondary School Teachers</span>
                                                        <span class="job-company">
                                                            AIP Education
                                                        </span>
                                                        <span class="job-deadline">
                                                            Deadline: 4 Days, 5 hours
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="job-single.html" class="flex-link">
                                                    <img src="assets/images/files/sqlogo4.png" class="img-fluid"
                                                        alt="">
                                                    <div class="job-detail">
                                                        <span class="job-title">Middle School Teachers</span>
                                                        <span class="job-company">
                                                            AIP Education
                                                        </span>
                                                        <span class="job-deadline">
                                                            Deadline: 4 Days, 5 hours
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="job-single.html" class="flex-link">
                                                    <img src="assets/images/files/sqlogo5.png" class="img-fluid"
                                                        alt="">
                                                    <div class="job-detail">
                                                        <span class="job-title">Middle School Teachers</span>
                                                        <span class="job-company">
                                                            AIP Education
                                                        </span>
                                                        <span class="job-deadline">
                                                            Deadline: 4 Days, 5 hours
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>
                                            <div class="clearfix"></div>

                                        </ul>
                                    </div>
                                </div> --}}
                            <div class="a-break mb-2">
                                <img src="{{ asset('/frontend/assets/images/files/machapuchree-bank_k8S0FE3TWD.gif') }}"
                                    alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </section>
        <!-- END CANDIDATE-DETAILS -->

    </div>
@endsection
