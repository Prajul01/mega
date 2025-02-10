@extends('user.layout.master')
@section('title'){{ 'Feature Job'}} @endsection
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
      
        <div class="main">
            <section class="advertise">
                <div>
                    <img class="w-100" src="{{ asset('frontend/assets/images/prime-advertisement.jpg') }}" alt="">
                </div>
            </section>
    
            <!--why megajob-->
                               <section class="py-4 pb-2">
                        <div class="container my-4">
                            <div class="row">
                                <div class="col-lg-4 jQueryEqualHeight">
                                    <div class="steps service-card">
                                        <div class="first service-title">
                                            <h6>Step 1</h6>
                                        </div>
                                        <div class="service-body">
                                            <h6 class="new-title">Register and Post Job</h6>
                                            <p>Start by creating an account and providing detailed job information,
                                                including the job description, your organization's logo, and a brief
                                                description of your company.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 jQueryEqualHeight">
                                    <div class="steps service-card">
                                        <div class="second service-title">
                                            <h6>Step 2</h6>
                                        </div>
                                        <div class="service-body">
                                            <h6 class="new-title">Exclusive Page: </h6>
                                            <p>
                                                After registration, you'll get a customized page that
                                                highlights your brand with your logo and colors.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 jQueryEqualHeight">
                                    <div class="steps service-card">
                                        <div class="third service-title">
                                            <h6>Step 3</h6>
                                        </div>
                                        <div class="service-body">
                                            <h6 class="new-title">Payment and Listing:</h6>
                                            <p> Pay in advance to feature your job prominently in
                                                the Golden Job section. Once paid, you can start receiving applications
                                                and access applicant profiles.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>



                    <!--Pricing Details-->
                    <section>
                        <div class="container price my-4">
                            <div class="row">
                                <div class="col-lg-12 m-auto price-header">
                                    <h6 class="new-title-large text-center">Pricing Details</h6>
                                </div>
                            </div>
                            <div class="row text-center my-3 mt-0">
                                <div class="col-lg-3 col-md-3 p-0 mobile-none">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="bg-primary text-light" scope="col">No of Job Positions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">1</td>
                                            </tr>
                                            <tr>
                                                <td class="table-primary" scope="row">2</td>
                                            </tr>
                                            <tr>
                                                <td scope="row">3</td>
                                            </tr>
                                            <tr>
                                                <td class="table-primary" scope="row">4</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="col-lg-3 col-md-3 p-0">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="bg-warning text-light" scope="col">31+9 Days Display</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row"> <span class="mobile-only">No. of Job Position 1.</span>
                                                    NRS 19,700</td>
                                            </tr>
                                            <tr>
                                                <td class="table-primary" scope="row"> <span class="mobile-only">No. of
                                                        Job Position 2.</span> NRS 25,200</td>
                                            </tr>
                                            <tr>
                                                <td scope="row"> <span class="mobile-only">No. of Job Position 3.</span>
                                                    NRS 29,500</td>
                                            </tr>
                                            <tr>
                                                <td class="table-primary" scope="row"> <span class="mobile-only">No. of
                                                        Job Position 4.</span> NRS 34,000</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="col-lg-3 col-md-3 p-0">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="bg-info text-light" scope="col">18+6 Days Display</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row"> <span class="mobile-only">
                                                        No. of Job Position 1.
                                                    </span> NRS 6,500</td>
                                            </tr>
                                            <tr>
                                                <td class="table-primary" scope="row"> <span class="mobile-only">
                                                        No. of Job Position 2.
                                                    </span> NRS 12,500</td>
                                            </tr>
                                            <tr>
                                                <td scope="row"> <span class="mobile-only">
                                                        No. of Job Position 3.
                                                    </span> NRS 18,000</td>
                                            </tr>
                                            <tr>
                                                <td class="table-primary" scope="row"> <span class="mobile-only">
                                                        No. of Job Position 4.
                                                    </span> NRS 22,100</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="col-lg-3 col-md-3 p-0">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="bg-success text-light" scope="col">7+5 Days Display</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row"> <span class="mobile-only">No. of Job Position 1.</span>
                                                    NRS 4,100</td>
                                            </tr>
                                            <tr>
                                                <td class="table-primary" scope="row"> <span class="mobile-only">No. of
                                                        Job Position 2.</span> NRS 7,500</td>
                                            </tr>
                                            <tr>
                                                <td scope="row"> <span class="mobile-only">No. of Job Position 3.</span>
                                                    NRS 9,000</td>
                                            </tr>
                                            <tr>
                                                <td class="table-primary" scope="row"> <span class="mobile-only">No. of
                                                        Job Position 4.</span> NRS 11,200</td>
                                            </tr>
                                        </tbody>
                                    </table>

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
                                <a href="{{route('advertise.top-job')}}">View Details</a>
                            </div>
                        </div>
                       
                       
                    </div>
                    <div class="col-lg-3 text-center py-4">
                        <div class="overflow">
                        <div class="tjobs">
                            <img src="{{ asset('frontend/assets/images/premium.png') }}" alt="">
                            <h6 class="my-3">Premium jobs</br> Services</h6>
                            <a href="{{route('advertise.hot-job')}}">View Details</a>
                        </div>
                    </div>
                       
                    </div>
                    <div class="col-lg-3 text-center py-4">
                        <div class="overflow">
                        <div class="tjobs">
                            <img src="{{ asset('frontend/assets/images/prime-service.png') }}" alt="">
                            <h6 class="my-3">Prime Job</br> Services</h6>
                            <a href="{{route('advertise.feature-job')}}">View Details</a>
                        </div>
                    </div>
                        
                    </div>
                    <div class="col-lg-3 text-center py-4">
                        <div class="overflow">

                        <div class="tjobs">
                            <img src="{{ asset('frontend/assets/images/top-service.png') }}" alt="">
                            <h6 class="my-3">Advertisment</br> Services</h6>
                            <a href="{{route('advertise.banner-job')}}">View Details</a>
                        </div>
                    </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </section>
    
            <!--trust-->
            <section>
                <div class="container">
                    <div class="row my-5">
                        <div class="col-lg-8 trust-header m-auto">
                            <h6 class="text-center">Trusted by thousands of</br>
                                Organization just like yours.</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
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
                        </div>
                    </div>
                </div>
            </section>
    
            <!--get in touch-->
         {{--   <section>
                <div class="touch">
                    <div class="container mt-4">
                        <div class="row ">
                            <div class="col-lg-8 mt-5 m-auto">
                                <h3 class="text-light text-center">Get in Touch</h3>
                                <h5 class="text-light text-center">with our Client Relation Executive</h5>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-lg-4 d-flex touch-text">
                                <img class="rounded-img"
                                    src="https://merojob.com/media/uploads/profile-pics/39b6d83f-17c2-4d85-9615-5dffb01b9440.jpg"
                                    alt="">
                                <div class="justify-content-center align-self-center">
                                    <h6 class="text-light">Sachin Shrestha</h6>
                                    <h6><a href="tel:123-456-7890">+977 9802718391</a></h6>
                                    <h6><a href="mailto:email@example.com">sachinshrestha121@gamil.com</a></h6>
                                </div>
    
                            </div>
                            <div class="col-lg-4 d-flex touch-text">
                                <img class="rounded-img"
                                    src="https://merojob.com/media/uploads/profile-pics/cd225b64-4513-43c7-a34b-ae2e564fcb45.png"
                                    alt="">
                                <div class="justify-content-center align-self-center">
                                    <h6 class="text-light">Kushagra Tamrakar</h6>
                                    <h6><a href="tel:123-456-7890">+977 9803718391</a></h6>
                                    <h6><a href="mailto:email@example.com">KushagraTamrakar@gamil.com</a></h6>
                                </div>
    
                            </div>
                            <div class="col-lg-4 d-flex touch-text">
                                <img class="rounded-img"
                                    src="https://merojob.com/media/uploads/profile-pics/388aa068-6d5f-4dc4-8473-c0c6a926874c.jpg"
                                    alt="">
                                <div class="justify-content-center align-self-center">
                                    <h6 class="text-light">Anamika Poudel</h6>
                                    <h6><a href="tel:123-456-7890">+977 9802908391</a></h6>
                                    <h6><a href="mailto:email@example.com">AnamikaPoudel@gamil.com</a></h6>
                                </div>
    
                            </div>
                        </div>
                        <div class="row py-4">
                            <div class="col-lg-4 d-flex touch-text">
                                <img class="rounded-img"
                                    src="https://merojob.com/media/uploads/profile-pics/e8542a1e-5c54-4e29-a02e-2d0017e32ca3.png"
                                    alt="">
                                <div class="justify-content-center align-self-center">
                                    <h6 class="text-light">Bhuwan Subedi</h6>
                                    <h6><a href="tel:123-456-7890">+977 9802718311</a></h6>
                                    <h6><a href="mailto:email@example.com">BhuwanSubedi@gamil.com</a></h6>
                                </div>
    
                            </div>
                            <div class="col-lg-4 d-flex touch-text">
                                <img class="rounded-img"
                                    src="https://merojob.com/media/uploads/profile-pics/654e3e7d-2b05-47bf-b2cc-5e358abc5349.png"
                                    alt="">
                                <div class="justify-content-center align-self-center">
                                    <h6 class="text-light">Rabina Basnet</h6>
                                    <h6><a href="tel:123-456-7890">+977 9802718341</a></h6>
                                    <h6><a href="mailto:email@example.com">RabinaBasnet@gamil.com</a></h6>
                                </div>
    
                            </div>
                            <div class="col-lg-4 d-flex touch-text">
                                <img class="rounded-img"
                                    src="https://merojob.com/media/uploads/profile-pics/1d2ca619-ebe5-4a3b-b10e-03a85ea45dd1.jpg"
                                    alt="">
                                <div class="justify-content-center align-self-center">
                                    <h6 class="text-light">Nisha Subedi</h6>
                                    <h6><a href="tel:123-456-7890">+977 98027180091</a></h6>
                                    <h6><a href="mailto:email@example.com">NishaSubedi@gamil.com</a></h6>
                                </div>
    
                            </div>
                        </div>
                    </div>
                </div>
            </section>  --}}
    
            <!--maps-->
            <section>
                <div>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14128.005405703296!2d85.32395955!3d27.71724455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2snp!4v1681894763028!5m2!1sen!2snp"
                        width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </section>
    
        </div>
 

@endsection
