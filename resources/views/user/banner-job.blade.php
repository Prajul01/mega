@extends('user.layout.master')
@section('title', 'Advertisement Plans')
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
    <div class="main">
        <section class="advertise" style="background-color: #fff;">
            <div class="container online-ads">
                <div class="row">
                    <div class="col-lg-8 m-auto hero-banner mb-4">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('frontend/assets/images/icon-1.png') }}" alt="" />
                            <h6 class="d-inline">Online Advertisement</h6>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <?= $content->main_content ?>
                    </div>
                    <div class="col-lg-6">
                        <img class="w-100" src="{{ asset('frontend/assets/images/mega-display.png') }}" class="img-fluid"
                            alt="">
                    </div>
                </div>
            </div>

        </section>

        <!--why megajob-->
        <section>
            <div class="whymj pb-4">
                <div class="container mb-4">
                    <div class="row ">
                        <div class="col-lg-12 mt-5 whyus m-auto">
                            <h6 class="text-light text-center">Why Megajob?</h6>
                        </div>
                    </div>
                    <div class="row whyus2">
                        <div class="col-lg-12 text-light text-justify my-3">
                            {!! $content->why_megajob !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--AVAILABLE SIZE & PLACE-->
        <section>
            <div class="container my-5">
                <div class="row">
                    <div class="col-lg-8 m-auto">
                        <h2 class="text-center">AVAILABLE SIZE & PLACE</h2>
                    </div>
                </div>
                <div class="row availability">
                    <div class="col-lg-4">
                        <div class="size-header text-center">
                            <h6>Home Page</h6>
                        </div>
                        <div class="size-text text-center blue-border">
                            <strong>
                                <p>Flash Banner</p>
                            </strong>
                            <p>Place: Ad. will be displayed in center</p>
                            <p>Size: 1500 * 300 pixel</p>
                            <strong>
                                <p>Right-Side Banner</p>
                            </strong>
                            <p>Place: Ad. will be displayed in right sidebar</p>
                            <p> Size: 300 * 150 pixel</p>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="size-header2">
                            <h6 class="text-center">Job Detail Page</h6>
                        </div>
                        <div class="row m-0">
                            <div class="col-lg-6 text-center size-text2 orange-border">
                                <strong>
                                    <p>Banner-Right Side A</p>
                                </strong>
                                <p>Place: Ad. will be displayed in right sidebar</p>
                                <p>Size: 300 * 150 pixel</p>
                                <strong>
                                    <p>Banner-Right Side B</p>
                                </strong>
                                <p>Place: Ad. will be displayed in right sidebar bottom</p>
                                <p>Size: 300 * 250 pixel</p>
                            </div>
                            <div class="col-lg-6 text-center size-text2 orange-border" style="border-left: none;">
                                <strong>
                                    <p>Banner-Right Side A</p>
                                </strong>
                                <p>Place: Ad. will be displayed in right sidebar</p>
                                <p>Size: 300 * 150 pixel</p>
                                <strong>
                                    <p>Banner-Right Side B</p>
                                </strong>
                                <p>Place: Ad. will be displayed in right sidebar bottom</p>
                                <p>Size: 300 * 250 pixel</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--our services-->
        <section>
            <div class="ourservices">
                <div class="container my-4">
                    <div class="row ">
                        <div class="col-lg-8 mt-4 our-text m-auto">
                            <h6 class="text-light text-center">Our Services</h6>
                        </div>
                    </div>
                    <div class="row pt-2 pb-3">
                        <div class="col-lg-3 text-center py-4">
                            <div class="overflow">
                                <div class="tjobs">
                                    <img src="{{ asset('frontend/assets/images/target.png') }}" alt="">
                                    <h6 class="my-3">Megajob</br> Services</h6>
                                    <a href="{{ route('advertise.top-job') }}">View Details</a>
                                </div>
                            </div>


                        </div>
                        <div class="col-lg-3 text-center py-4">
                            <div class="overflow">
                                <div class="tjobs">
                                    <img src="{{ asset('frontend/assets/images/premium.png') }}" alt="">
                                    <h6 class="my-3">Premium jobs</br> Services</h6>
                                    <a href="{{ route('advertise.hot-job') }}">View Details</a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3 text-center py-4">
                            <div class="overflow">
                                <div class="tjobs">
                                    <img src="{{ asset('frontend/assets/images/prime-service.png') }}" alt="">
                                    <h6 class="my-3">Prime Job</br> Services</h6>
                                    <a href="{{ route('advertise.feature-job') }}">View Details</a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3 text-center py-4">
                            <div class="overflow">

                                <div class="tjobs">
                                    <img src="{{ asset('frontend/assets/images/top-service.png') }}" alt="">
                                    <h6 class="my-3">Advertisment</br> Services</h6>
                                    <a href="{{ route('advertise.banner-job') }}">View Details</a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <?php
        $supportStaffs = \App\Models\SupportStaff::where('display', '1')
            ->orderBy('order_no')
            ->get();
        ?>
        @if (count($supportStaffs) > 0)
            <section>
                <div class="touch" style="background: none;">
                    <div class="container">
                        <div class="row ">
                            <div class="col-lg-8 mt-5 m-auto">
                                <h3 class="text-center">Get in Touch</h3>
                                <h5 class="text-center">with our Client Relation Executive</h5>
                            </div>
                        </div>
                        <div class="row my-3">
                            @foreach ($supportStaffs as $staff)
                                <div class="col-lg-4 d-flex touch-text py-4">
                                    <img class="rounded-img"
                                        src="{{ asset('/storage/supportStaff/' . $staff->profile_pic) }}" alt="">
                                    <div class="justify-content-center align-self-center">
                                        <h6 class="">{{ $staff->name }}</h6>
                                        <h6><a href="tel:{{ $staff->phone_no }}" class="text-dark">+977 {{ $staff->phone_no }}</a></h6>
                                        <h6><a href="mailto:{{ $staff->email }}" class="text-dark">{{ $staff->email }}</a></h6>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!--maps-->
        <section>
            <div>
                <iframe
                    src="{{ $setting->googlemap_url }}"
                    width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

    </div>

@endsection
