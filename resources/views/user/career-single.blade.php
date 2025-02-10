@extends('user.layout.master')
@section('title')
    {{ $career->title }}
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
            <!-- START HOME -->
            <section class="bg-home inner-page" id="home">
                <div class="bg-overlay"
                    style="background-image: url('{{ asset('frontend/assets/images/files/banner1.jpg') }}');"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center text-white mb-5">
                                <h1 class="display-5 mb-3"> Career Tip Single </h1>
                                <p class="fs-17">Mega Job is the perfect platform if you are looking for jobs and
                                    also looking for candidates.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end container-->
            </section>
            <!-- End Home -->
            <section class="home-jobs-wrapper bg-light">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <div class="col-lg-9 col-md-8">
                            <div class="row">
                                <div class="blog-post">
                                    <div class="blog-single-image">
                                        <img src="{{ asset('storage/career/' . $career->image) }}" class="img-fluid"
                                            alt="Blog Single">
                                    </div>
                                    <div class="blog-post-info">
                                        <ul class="list-inline mb-0 mt-3 text-muted">
                                            <li class="list-inline-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="my-2">
                                                        @if (isset($career->author))
                                                            <a href="javascript:void(0)" class="primary-link">
                                                                <h6 class="mb-0">By {{ $career->author }}</h6>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-inline-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="uil uil-calendar-alt"></i>
                                                    </div>
                                                    <div class="ms-2">
                                                        <p class="mb-0">
                                                            {{ $career->created_at->toFormattedDateString() }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="mt-0">
                                            <h5 class="blog-single-title">{{ $career->title }}</h5>
                                            <p class="text-muted">
                                                {!! $career->description !!}
                                            </p>
                                            @if (Count($tags) !== 0)
                                                <div class="d-flex align-items-center mb-4">
                                                    <div class="flex-shrink-0">
                                                        <b>Tags:</b>
                                                    </div>

                                                    <div class="flex-grow-1 ms-2">
                                                        @foreach ($tags as $tag)
                                                            <a href="{{ route('career-tips', ['tags' => $tag->title]) }}"
                                                                class="badge bg-soft-success mt-1 fs-14">{{ $tag->title }}</a>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div><!--end row-->
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="side-box">
                                <div class="sidebox-wrap">
                                    <div class="sidebox-title">
                                        <p>Related Career Tips</p>
                                    </div>
                                    @if (count($related_careers) !== 0)
                                        <div class="categories-list">
                                            <ul class="same-company-job">
                                                @foreach ($related_careers as $related_career)
                                                    <li>
                                                        <a href="{{ route('career-details', $related_career->slug) }}"
                                                            class="flex-link">
                                                            <img src="{{ asset('storage/career/' . $related_career->image) }}"
                                                                class="img-fluid" alt="">
                                                            <div class="job-detail">
                                                                <span class="job-title">{{ $related_career->title }}</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <div class="clearfix"></div>
                                                @endforeach

                                            </ul>
                                        </div>
                                    @endif
                                </div>

                                <div class="a-break mb-2">
                                    <img src="{{ asset('frontend/assets/images/files/machapuchree-bank_k8S0FE3TWD.gif') }}"
                                        alt="" class="img-fluid">
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </section>
            {{-- <div class="blog-share-fixed pos-fixed">
                <div class="blog-share-title">
                    Mega Official Career Tips <span class="blog-main-title">- {{ $career->title }}</span>
                </div>
                <div class="blog-share-sections social-share">
                    <div class="share-title">
                        Share This <span class="share-icon">
                            <i class="fa fa-share-square"></i>
                        </span>
                    </div>

                    <ul class="job-social">
                        <li class="facebook"><a href="" class="">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a></li>
                        <li class="insta"><a href="" class="">
                                <i class="fa-brands fa-instagram"></i>
                            </a></li>
                        <li class="twitter"><a href="" class="">
                                <i class="fa-brands fa-twitter"></i>
                            </a></li>
                        <li class="linkedin"><a href="" class="">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a></li>
                    </ul>
                    <!-- ShareThis BEGIN -->
                    <div class="sharethis-inline-share-buttons"></div>
                    <!-- ShareThis END -->
                </div>

            </div> --}}
        </div>
    </div>
@endsection
