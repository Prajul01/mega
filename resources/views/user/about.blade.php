@extends('user.layout.master')
@section('title'){{ 'About' }} @endsection
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

            <!-- START HOME -->
            <section class="bg-home inner-page" id="home">
                <div class="bg-overlay" style="background-image: url('frontend/assets/images/files/banner1.jpg');"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center text-white mb-5">
                                <h1 class="display-5 mb-3">About Us</h1>
                                <p class="fs-17">Find jobs, create trackable resumes and enrich your applications.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            @if (isset($about))
                <!-- START ABOUT -->
                <section class="about-section section overflow-hidden">
                    <div class="container-fluid custom-container">
                        <div class="row align-items-center g-0">
                            <div class="col-lg-6">
                                <div class="who-we me-lg-5">
                                    <h6 class="sub-title color-orange">{{ $about->who_we_are_heading }}</h6>
                                    <h2 class="title mb-4">{{ $about->who_we_are_title }}</h2>

                                    <p class="text-muted">{!! $about->who_we_are_description !!}
                                    </p>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="about-img mt-4 mt-lg-0">
                                    <img src="{{ asset('storage/about/' . $about->who_we_are_image) }}" alt=""
                                        class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="about-section section bg-gray overflow-hidden">
                    <div class="container-fluid custom-container">
                        <div class="row align-items-center g-0">
                            <div class="col-lg-6 order-2 order-md-2 order-lg-1">
                                <div class="about-img mt-4 mt-lg-0">
                                    <img src="{{ asset('storage/about/' . $about->what_we_do_image) }}" alt=""
                                        class="img-fluid rounded">
                                </div>
                            </div>
                            <div class="col-lg-6 order-1 order-md-1 order-lg-2">
                                <div class="who-we what-we">
                                    <h6 class="sub-title color-orange">{{ $about->what_we_do_heading }}</h6>
                                    <h2 class="title mb-4">{{ $about->what_we_do_title }}</h2>

                                    <p class="text-muted">{!! $about->what_we_do_description !!}</p>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>


                <!-- START feature -->
                <section class="vision-mission-section section">
                    <div class="container-fluid custom-container">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mt-4 pt-2 jQueryEqualHeight">
                                <div class="about-feature p-3 rounded-3">
                                    <div class="featrue-icon flex-shrink-0">
                                        <img src="{{ asset('storage/about/' . $about->section_1_image) }}" alt="">
                                    </div>
                                    <div class="company-desc text-center">
                                        <h6 class="fs-22 mb-2">{{ $about->section_1_title }}</h6>
                                        <p>
                                            {!! $about->section_1_description !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mt-4 pt-2 jQueryEqualHeight">
                                <div class="about-feature p-3 rounded-3">
                                    <div class="featrue-icon flex-shrink-0">
                                        <img src="{{ asset('storage/about/' . $about->section_2_image) }}" alt="">
                                    </div>
                                    <div class="company-desc text-center">
                                        <h6 class="fs-22 mb-2">{{ $about->section_2_title }}</h6>
                                        <p>
                                            {!! $about->section_2_description !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mt-4 pt-2 jQueryEqualHeight">
                                <div class="about-feature p-3 rounded-3">
                                    <div class="featrue-icon flex-shrink-0">
                                        <img src="{{ asset('storage/about/' . $about->section_3_image) }}" alt="">
                                    </div>
                                    <div class="company-desc text-center">
                                        <h6 class="fs-22 mb-2">{{ $about->section_3_title }}</h6>
                                        <p>
                                            {!! $about->section_3_description !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

        </div>
    </div>
@endsection
