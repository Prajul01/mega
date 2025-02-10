@extends('user.layout.master')
@section('title'){{ 'Privacy Policies'}} @endsection
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
<div class="page-content">

    <!-- START HOME -->
    <section class="bg-home inner-page" id="home">
        <div class="bg-overlay"
            style="background-image: url('{{ asset('frontend/assets/images/files/banner1.jpg') }}');"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center text-white mb-5">
                        <h1 class="display-5 mb-3"> Privacy Policies </h1>
                        <p class="fs-17">Mega Job is the perfect platform if you are looking for jobs and
                            also looking for candidates.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--end container-->
    </section>
    <section class="home-jobs-wrapper bg-light">
        <div class="container-fluid custom-container">
            <div class="row position-relative">
                {!!$privacy->description!!}
            </div>
        </div>
    </section>
</div>

@endsection