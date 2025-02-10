@extends('user.layout.master')
@section('title')Career Tips @endsection
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
            <div class="bg-overlay" style="background-image: url({{ asset('frontend/assets/images/files/banner1.jpg') }});"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center text-white mb-5">
                            <h1 class="display-5 mb-3"> Career Tips </h1>
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
                    @foreach ($careers as $career)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card blog-grid-box">
                            <img src="{{asset('storage/career/thumb_'.$career->image)}}" alt="" class="img-fluid">
                            <div class="card-body">
                                <ul class="list-inline d-flex justify-content-between mb-1">
                                    <li class="list-inline-item">
                                        <p class="text-muted mb-0"><a href="{{route('career-details',['career'=>$career->slug])}}"
                                                class="text-muted fw-medium">{{$career->author}}</a> - {{$career->created_at->toFormattedDateString()}}</p>
                                    </li>
                                </ul>
                                <a href="{{route('career-details',['career'=>$career->slug])}}" class="primary-link">
                                    <h6 class="fs-22">{{$career->title}}</h6>
                                </a>
                                <div>
                                    <a href="{{route('career-details',['career'=>$career->slug])}}" class="form-text">Read More
                                        <i class="uil uil-angle-right-b"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </section>

    </div>
    <!-- End Page-content -->
</div>

@endsection
