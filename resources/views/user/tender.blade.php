@extends('user.layout.master')
@section('title'){{ 'Tender'}} @endsection
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
                    <div class="col-lg-3 col-md-4">
                        <div class="tender-box">
                            <div class="tender-categories">
                                <div class="categories-header">
                                    Tender Categories
                                </div>
                                <div class="categories-list">
                                    {{-- <div class="total-tender">
                                        All Tender (15)
                                    </div> --}}

                                    <div class="tender-list">
                                        @if(count($tender_categories)!==0)
                                            @foreach($tender_categories as $category)
                                            <a href="{{route('tender',['category'=>$category->slug])}}">
                                            {{$category->title}} ({{$category->tenders->count()}})
                                            </a>
                                            @endforeach
                                        @endif
                                        {{-- <a href="#">
                                            Machinery and Equipment (2)
                                        </a>
                                        <a href="#">
                                            Rental Services (3)
                                        </a>
                                        <a href="#">
                                            Consulting (2)
                                        </a> --}}
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
                                        @foreach($tender_types as $type)
                                        <a href="{{route('tender',['type'=>$type->slug])}}">
                                            {{$type->title}} ({{$type->tenders->count()}})
                                        </a>
                                        @endforeach
                                        @endif
                                        {{-- <a href="#">
                                            Expression of Interest (2)
                                        </a>
                                        <a href="#">
                                            Request for Quotation (3)
                                        </a>
                                        <a href="#">
                                            Invitation for Bids (2)
                                        </a> --}}
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-8">
                        <div class="tender-result">
                            <div class="results-list">
                                All Tenders 
                            </div>
                        </div>
                        <div class="jobs-list">
                            @foreach($tenders as $tender)
                            <div class="job-box card mt-3">
                                <div class="p-3 pb-2">
                                    <div class="row align-items-center">
                                        <div class="col-lg-2">
                                            <div class="company-image">
                                                <a href="{{route('tender_details',['tender'=>$tender->slug])}}"><img
                                                        src="{{asset('storage/tender/'.$tender->logo)}}" alt=""
                                                        class="img-fluid rounded-3"></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="job-desc-company">
                                                <div class="mt-3 mt-lg-0 tender-heading">
                                                    <h5 class="fs-20 mb-0"><a href="{{route('tender_details',['tender'=>$tender->slug])}}">
                                                            {{$tender->title}}</a>
                                                    </h5>
                                                    <p class="fs-16 mb-3">
                                                        <a href="{{route('tender_details',['tender'=>$tender->slug])}}" class="text-dark">
                                                           {{$tender->sub_title}}
                                                        </a>
                                                    </p>
                                                </div>
                                                <div class="tender-main-info">
                                                    <div class="tender-info">
                                                        <div class="tender-label">
                                                            Category :
                                                        </div>
                                                        <div class="tender-desc">
                                                            {{$tender->tender_categories->title}}
                                                        </div>
                                                    </div>
                                                    <div class="tender-info">
                                                        <div class="tender-label">
                                                            Publish Date :
                                                        </div>
                                                        <div class="tender-desc">
                                                           {{$tender->created_at->format("F j, Y")}}
                                                        </div>
                                                    </div>
                                                    <div class="tender-info">
                                                        <div class="tender-label">
                                                            Deadline :
                                                        </div>
                                                        <div class="tender-desc">
                                                          {{date("F j, Y",strtotime($tender->deadline))}}
                                                        </div>
                                                    </div>
                                                    <div class="tender-info">
                                                        <div class="tender-label">
                                                            Views :
                                                        </div>
                                                        <div class="tender-desc">
                                                            {{$tender->view}}
                                                        </div>
                                                    </div>
                                                    @php
                                                    $tags=json_decode($tender->tags);
                                                   @endphp
                                                   @if(isset($tags))
                                                    <div class="tender-info">
                                                        <div class="tender-label">
                                                            Tags :
                                                        </div>
                                                        @foreach($tags as $tag)
                                                        <div class="tender-desc org-bg">
                                                           {{$tag}}
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="side-box tab-none">
                            <div class="sidebox-wrap">
                                <div class="sidebox-title">
                                    <p>Top Employers</p>
                                </div>
                                <div class="sidebox-content">
                                    <ul class="logo-list">
                                        <li>
                                            <a href="#">
                                                <img class="img-fluid" src="./assets/images/files/kantipur.jpg"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img class="img-fluid" src="./assets/images/files/prabhu.jpg"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img class="img-fluid" src="./assets/images/files/citizen.jpg"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img class="img-fluid" src="./assets/images/files/dishhome.jpg"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img class="img-fluid" src="./assets/images/files/kantipur.jpg"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img class="img-fluid" src="./assets/images/files/prabhu.jpg"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img class="img-fluid" src="./assets/images/files/citizen.jpg"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img class="img-fluid" src="./assets/images/files/dishhome.jpg"
                                                    alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebox-wrap">
                                <div class="sidebox-title">
                                    <p>Recent Tenders</p>
                                </div>
                                <div class="sidebox-content">
                                    <ul class="recent-tender">
                                        @if(count($recent_tenders)>0)
                                            @foreach($recent_tenders as $recent_tender)
                                            <li>
                                                <p>
                                                    <a href="{{route('tender_details',['tender'=>$recent_tender->slug])}}" class="flex-link">
                                                        <img src="{{asset('storage/tender/'.$recent_tender->logo)}}"
                                                            class="img-fluid" alt="">
                                                          {{$recent_tender->title}}
                                                    </a>
                                                </p>
                                            </li>
                                            @endforeach
                                        @endif
                                        <li>
                                            <p class="px-2 d-block text-end">
                                                <a href="{{route('tender',['tender'=>'all'])}}">
                                                    View All Tenders
                                                </a>
                                            </p>
                                        </li>

                                        <div class="clearfix"></div>

                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
    </div>
    </section>



    <!-- START PROCESS -->
    <!-- <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title me-5">
                        <h3 class="title">How It Works</h3>
                        <p class="text-muted">Post a job to tell us about your project. We'll quickly match
                            you with the
                            right freelancers.</p>
                        <div class="process-menu nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                                aria-selected="true">
                                <div class="d-flex">
                                    <div class="number flex-shrink-0">
                                        1
                                    </div>
                                    <div class="flex-grow-1 text-start ms-3">
                                        <h5 class="fs-18">Register an account</h5>
                                        <p class="text-muted mb-0">Due to its widespread use as filler text
                                            for layouts, non-readability
                                            is of great importance.</p>
                                    </div>
                                </div>
                            </a>
                            <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                aria-selected="false">
                                <div class="d-flex">
                                    <div class="number flex-shrink-0">
                                        2
                                    </div>
                                    <div class="flex-grow-1 text-start ms-3">
                                        <h5 class="fs-18">Find your job</h5>
                                        <p class="text-muted mb-0">There are many variations of passages of
                                            avaibookmark-label, but the majority
                                            alteration in some form.</p>
                                    </div>
                                </div>
                            </a>
                            <a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                                aria-selected="false">
                                <div class=" d-flex">
                                    <div class="number flex-shrink-0">
                                        3
                                    </div>
                                    <div class="flex-grow-1 text-start ms-3">
                                        <h5 class="fs-18">Apply for job</h5>
                                        <p class="text-muted mb-0">It is a long established fact that a
                                            reader will be distracted by the
                                            readable content of a page.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <img src="assets/images/process-01.png" alt="" class="img-fluid">
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">
                            <img src="assets/images/process-02.png" alt="" class="img-fluid">
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                            aria-labelledby="v-pills-messages-tab">
                            <img src="assets/images/process-03.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- END PROCESS -->

    <!-- START TESTIMONIAL -->
    <!--<section class="section">-->
    <!--    <div class="container">-->
    <!--        <div class="row justify-content-center">-->
    <!--            <div class="col-lg-6">-->
    <!--                <div class="section-title text-center mb-4 pb-2">-->
    <!--                    <h3 class="title mb-0">Successful Placements</h3>-->

    <!--                </div>-->
    <!--            </div>-->

    <!--        </div>-->

    <!--        <div class="row justify-content-center">-->
    <!--            <div class="col-lg-9">-->
    <!--                <div class="swiper testimonialSlider pb-5">-->
    <!--                    <div class="swiper-wrapper">-->
    <!--                        <div class="swiper-slide">-->
    <!--                            <div class="card testi-box">-->
    <!--                                <div class="card-body">-->

    <!--                                    <p class="testi-content lead text-muted mb-4">" Very well thought-->
    <!--                                        out and articulate communication.-->
    <!--                                        Clear milestones, deadlines and fast work. Patience. Infinite-->
    <!--                                        patience. No-->
    <!--                                        shortcuts. Even if the client is being careless. "</p>-->
    <!--                                    <h5 class="mb-0">Jeffrey Montgomery</h5>-->
    <!--                                    <p class="text-muted mb-0">Product Manager</p>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="swiper-slide">-->
    <!--                            <div class="card testi-box">-->
    <!--                                <div class="card-body">-->

    <!--                                    <p class="testi-content lead text-muted mb-4">" Very well thought-->
    <!--                                        out and articulate communication.-->
    <!--                                        Clear milestones, deadlines and fast work. Patience. Infinite-->
    <!--                                        patience. No-->
    <!--                                        shortcuts. Even if the client is being careless. "</p>-->
    <!--                                    <h5 class="mb-0">Rebecca Swartz</h5>-->
    <!--                                    <p class="text-muted mb-0">Creative Designer</p>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="swiper-slide">-->
    <!--                            <div class="card testi-box">-->
    <!--                                <div class="card-body">-->

    <!--                                    <p class="testi-content lead text-muted mb-4">" Very well thought-->
    <!--                                        out and articulate communication.-->
    <!--                                        Clear milestones, deadlines and fast work. Patience. Infinite-->
    <!--                                        patience. No-->
    <!--                                        shortcuts. Even if the client is being careless. "</p>-->
    <!--                                    <h5 class="mb-0">Charles Dickens</h5>-->
    <!--                                    <p class="text-muted mb-0">Store Assistant</p>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->

    <!--                    <div class="swiper-pagination"></div>-->
    <!--                </div>-->

    <!--            </div>-->

    <!--        </div>-->

    <!--    </div>-->
    <!--</section>-->
    <!-- END TESTIMONIAL -->


    <!-- START CLIENT -->
    <div class="py-3">
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

    <!-- START APPLY MODAL -->
    <div class="modal fade" id="applyNow" tabindex="-1" aria-labelledby="applyNow" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <div class="text-center mb-4">
                        <h5 class="modal-title" id="staticBackdropLabel">Apply For This Job</h5>
                    </div>
                    <div class="position-absolute end-0 top-0 p-3">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="mb-3">
                        <label for="nameControlInput" class="form-label">Name</label>
                        <input type="text" class="form-control" id="nameControlInput"
                            placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="emailControlInput2" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="emailControlInput2"
                            placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="messageControlTextarea" class="form-label">Message</label>
                        <textarea class="form-control" id="messageControlTextarea" rows="4"
                            placeholder="Enter your message"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="inputGroupFile01">Resume Upload</label>
                        <input type="file" class="form-control" id="inputGroupFile01">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Application</button>
                </div>
            </div>
        </div>
    </div><!-- END APPLY MODAL -->

</div>

@endsection