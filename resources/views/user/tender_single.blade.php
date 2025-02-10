@extends('user.layout.master')
@section('title') {{$tender->title}} @endsection
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
        <section class="bg-home" id="home">
            @include('user.layout.banner')
            <!--end container-->
        </section>
        <!-- End Home -->
        <section class="home-jobs-wrapper bg-light">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-lg-9 col-md-8">

                        <div class="tender-details">
                            <div class="tender-detail-title">
                              {{$tender->title}}
                            </div>
                            <div class="tender-detail-desc">
                               {!!$tender->description!!}
                            </div>

                        </div>

                    </div>
                    <div class="col-lg-3 col-md-4">
                        <div class="tender-box">
                            <div class="tender-categories">
                                <div class="categories-header">
                                    Similar Tenders
                                </div>
                                <div class="categories-list">

                                    <div class="tender-list">
                                        @if(count($similar_tenders)!==0)
                                        @foreach($similar_tenders as $similar_tender)
                                        <a href="{{route('tender_details',['tender'=> $similar_tender->slug])}}">
                                            {{$similar_tender->title}}
                                        </a>
                                        @endforeach
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="tender-categories">
                                <div class="categories-header">
                                    Tender Types
                                </div>
                                <div class="categories-list">
                                    <div class="tender-list">
                                        @if(count($tender_types)!==0)
                                        @foreach($tender_types as $tender_type)
                                        <a href="{{route('tender',['type'=>$tender_type->slug])}}">
                                           {{$tender_type->title}}
                                        </a>
                                        @endforeach
                                        @endif
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
    </div>
    </section>


    <!-- START CLIENT -->
    <div class="py-4">
        <div class="container">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="text-center p-3">
                            <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="" data-bs-original-title="Woocommerce">
                                <img src="assets/images/files/citizen.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="swiper-slide">
                        <div class="text-center p-3">
                            <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="" data-bs-original-title="Envato">
                                <img src="assets/images/files/dishhome.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="swiper-slide">
                        <div class="text-center p-3">
                            <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="" data-bs-original-title="Magento">
                                <img src="assets/images/files/kantipur.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="swiper-slide">
                        <div class="text-center p-3">
                            <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="" data-bs-original-title="Wordpress">
                                <img src="assets/images/files/NLIC.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="swiper-slide">
                        <div class="text-center p-3">
                            <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="" data-bs-original-title="Generic">
                                <img src="assets/images/files/prabhu.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="text-center p-3">
                            <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="" data-bs-original-title="Reveal">
                                <img src="assets/images/files/kantipur.jpg" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end container-->
    </div>
    <!-- END CLIENT -->

</div>
@endsection