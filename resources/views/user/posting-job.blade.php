@extends('user.layout.master')
@section('title', $step->posting_type == 'advertisement' ? 'Advertise Here' : 'Post your jobs in ' .
    ucwords(str_replace('-', ' ', $step->posting_type)))
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
    <style>
        .bg-blue {
            background: #2776b6 !important;
        }

        .bg-green {
            background: #048565 !important;
        }

        .bg-orange {
            background: #ed5a37 !important;
        }

        .bg-yellow {
            background: #f7cc53 !important;
            ;
        }
    </style>
    <div class="page-content">
        <div class="main">
            <section class="advertise">
                <div>
                    <img class="w-100" src="{{ asset('/storage/adBanner/' . $step->banner) }}"
                        alt="{{ ucwords(str_replace('-', ' ', $step->posting_type)) }}">
                </div>
            </section>

            <!--why megajob-->
            <!--why megajob-->
            <section class="py-4 pb-2">
                <div class="container my-4">
                    <div class="row">
                        <?php
                        $step1 = json_decode($step->step1);
                        $step2 = json_decode($step->step2);
                        $step3 = json_decode($step->step3);
                        ?>
                        <div class="col-lg-4 jQueryEqualHeight">
                            <div class="steps service-card">
                                <div class="first service-title">
                                    <h6>Step 1</h6>
                                </div>
                                <div class="service-body">
                                    <h6 class="new-title">{{ $step1->heading }} </h6>
                                    {!! $step1->description !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 jQueryEqualHeight">
                            <div class="steps service-card">
                                <div class="second service-title">
                                    <h6>Step 2</h6>
                                </div>
                                <div class="service-body">
                                    <h6 class="new-title">{{ $step2->heading }}</h6>
                                    {!! $step2->description !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 jQueryEqualHeight">
                            <div class="steps service-card">
                                <div class="third service-title">
                                    <h6>Step 3</h6>
                                </div>
                                <div class="service-body">
                                    <h6 class="new-title">{{ $step3->heading }}</h6>
                                    {!! $step3->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



            <!--Pricing Details-->
            @if (count($pricing) > 0)
                <section>
                    <div class="container price my-4">
                        <div class="row">
                            <div class="col-lg-12 m-auto price-header">
                                <h6 class="new-title-large text-center">Pricing Details</h6>
                            </div>
                        </div>
                        <div class="row justify-content-center text-center my-3 mt-0">
                            <div class="col-lg-2 col-md-3 p-0 mobile-none">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="bg-primary text-light" scope="col">No of Job Positions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($pricing as $key => $data)
                                            <tr>
                                                <td class="{{ $i % 2 == 0 ? 'table-primary' : '' }}" scope="row">
                                                    {{ $key }}</td>
                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <?php
                            $bgClasses = ['blue', 'green', 'yellow', 'orange'];
                            $iteration = 0;
                            ?>
                            @foreach ($days as $day)
                                @if ($day->prices->count() > 0)
                                    <div class="col-lg-2 col-md-3 p-0">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="bg-{{ $bgClasses[$iteration % count($bgClasses)] }} text-light"
                                                        scope="col">{{ $day->days }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($pricing as $key => $price)
                                                    @foreach ($price as $data)
                                                        <?php $flag = false; ?>
                                                        @if ($day->id == $data->day_package_id)
                                                            <tr>
                                                                <td class="{{ $i % 2 == 0 ? 'table-primary' : '' }}"
                                                                    scope="row">
                                                                    <span class="mobile-only">No. of Job Position
                                                                        {{ $key }}.</span>
                                                                    NRS {{ number_format($data->price) }}
                                                                </td>
                                                            </tr>
                                                        @break

                                                    @else
                                                        <?php $flag = true; ?>
                                                    @endif
                                                @endforeach
                                                @if (@$flag)
                                                    <tr>
                                                        <td class="{{ $i % 2 == 0 ? 'table-primary' : '' }}"
                                                            scope="row">
                                                            <span class="mobile-only">No. of Job Position
                                                                {{ $key }}.</span>
                                                            -
                                                        </td>
                                                    </tr>
                                                @endif
                                                <?php $i++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            <?php $iteration++; ?>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        <section>
            <div class="ourservices">
                <div class="container mt-4">
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

        <!--get in touch-->
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
                                        src="{{ asset('/storage/supportStaff/' . $staff->profile_pic) }}"
                                        alt="">
                                    <div class="justify-content-center align-self-center">
                                        <h6 class="">{{ $staff->name }}</h6>
                                        <h6><a href="tel:{{ $staff->phone_no }}" class="text-dark">+977
                                                {{ $staff->phone_no }}</a></h6>
                                        <h6><a href="mailto:{{ $staff->email }}"
                                                class="text-dark">{{ $staff->email }}</a></h6>
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
                <iframe src="{{ $setting->googlemap_url }}" width="100%" height="380" style="border:0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

    </div>
@endsection
