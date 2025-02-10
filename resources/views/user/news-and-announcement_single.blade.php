@extends('user.layout.master')
@section('title')
    {{ $data->title }}
@endsection
@section('seo_section')
    <meta name="description" content="{{ isset($setting) ? $setting->og_description : '' }}">
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:description" content="{!! Str::limit($data->description, 50) !!}">
    <meta property="og:image" content="{{ asset('storage/blog/' . $data->image) }}">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ env('APP_URL') }}">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $data->title }}">
    <meta name="twitter:description" content="{!! Str::limit($data->description, 50) !!}">
    <meta name="twitter:image" content="{{ asset('storage/blog/' . $data->image) }}">
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <!-- START HOME -->
            <section class="bg-home inner-page" id="home">
                <div class="bg-overlay"
                    style="background-image: url({{ asset('storage/news_and_announcement/' . $data->image) }});"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center text-white mb-5">
                                <h1 class="display-5 mb-3"> {{ $data->title }} </h1>
                                {{-- <p class="fs-17">Mega Job is the perfect platform if you are looking for jobs and
                                    also looking for candidates.
                                </p> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!--end container-->
            </section>
            <section class="home-jobs-wrapper bg-light">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <div class="col-lg-9 col-md-8">
                            <div class="row">
                                <div class="blog-post">
                                    {{-- <div class="blog-single-image">
                                        <img src="{{ asset('storage/news_and_announcement/' . $data->image) }}" class="img-fluid"
                                            alt="{{ $data->title }}">
                                    </div> --}}
                                    <div class="blog-post-info">
                                        <ul class="list-inline mb-0 mt-2 text-muted">
                                            <li class="list-inline-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="my-2">
                                                        <a href="javascript::void(0)" class="primary-link">
                                                            @if (isset($data->author))
                                                                <h6 class="mb-0">By {{ $data->author }}</h6>
                                                            @endif
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-inline-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="uil uil-calendar-alt"></i>
                                                    </div>
                                                    <div class="ms-2">
                                                        <p class="mb-0"> {{ $data->created_at->toFormattedDateString() }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="mt-0">
                                            {{-- <h5 class="blog-single-title">{{ $data->title }}</h5> --}}
                                            <p class="text-muted">
                                                {!! $data->description !!}
                                            </p>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end row-->
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="side-box">
                                <div class="sidebox-wrap">
                                    <div class="sidebox-title">
                                        <p>Related News And Announcements</p>
                                    </div>
                                    @if (count($related_news) !== 0)
                                        <div class="categories-list">
                                            <ul class="same-company-job">
                                                @foreach ($related_news as $related_data)
                                                    <li>
                                                        <a href="{{ route('newsAndAnnouncement.single', $related_data->slug) }}"
                                                            class="flex-link">
                                                            <img src="{{ asset('storage/news_and_announcement/' . $related_data->image) }}"
                                                                class="img-fluid" alt="">
                                                            <div class="job-detail">
                                                                <span class="job-title">{{ $related_data->title }}</span>
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


            <div class="blog-share-fixed pos-fixed">
                <div class="blog-share-title">
                    Mega Official News And Announcements <span class="blog-main-title">- {{ $data->title }}</span>
                </div>
                <div class="blog-share-sections social-share">
                    {{-- <div class="share-title">
                        Share This <span class="share-icon">
                            <i class="fa fa-share-square"></i>
                        </span>
                    </div> --}}

                    {{-- <ul class="job-social">
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
                    </ul> --}}
                    <!-- ShareThis BEGIN -->
                    <div class="sharethis-inline-share-buttons"></div>
                    <!-- ShareThis END -->
                </div>

            </div>
        </div>
    </div>
@endsection
