 <!--<div class="bg-overlay no-overlay row">-->
 <!--   <div class="col-lg-8 banner1">-->
 <!--       <div class="new-overlay">-->
 <!--           <div class="bg-overlay"-->
 <!--               style="background-image: url('{{asset('frontend/assets/images/files/banner1.jpg')}}');">-->
 <!--           </div>-->
 <!--       </div>-->
 <!--   </div>-->

 <!--   <div class="col-lg-4 hero-video">-->
 <!--       <div class="new-overlay">-->
 <!--           <div class="image-single">-->
 <!--               <a data-fancybox="" href="assets/images/video1.mp4">-->
 <!--                   <img src="{{asset('frontend/assets/images/video-banner.png')}}" class="img-fluid">-->
 <!--               </a>-->
 <!--               <a data-fancybox="" id="play-video" class="video-play-button"-->
 <!--                   href="{{asset('frontend/assets/video/video1.mp4')}}">-->
 <!--                   <span></span>-->
 <!--               </a>-->
 <!--           </div>-->
 <!--       </div>-->
 <!--   </div>-->
 <div class="swiper newSwiper">
    <div class="swiper-wrapper">
        <?php
            $banners = \App\Models\Slider::where('display', 1)->orderBy('order_no')->get();
        ?>
        @foreach($banners as $banner)
        <div class="swiper-slide">
            <div class="sliderLanding-image">
                <img src="{{asset('storage/slider/' . $banner->image)}}" class="img-fluid" alt="">
            </div>
        </div>
        @endforeach
    </div>
</div>
 <div class="landing-abs-content">
    <div class="text-center text-white mb-2 landing-text-content">
        <h1 class="hero-text">Find a Job. Today
        <!--<span class="orange-color fw-bold">10,000+</span>Open Jobs.-->
        </h1>
        <!--<p class="fs-18 hero-text1 mobile-none">Find jobs, create trackable resumes and enrich your-->
        <!--    applications.-->
        <!--</p>-->
    </div>
    <div class="registration-form slider-search-form">
        <form action="{{ route('jobs') }}" method="get">
            <div class="form-container-flex">
                <div class="filter-search-form filter-border mt-lg-0">
                    <i class="uil uil-briefcase-alt"></i>
                   <input type="search" name="search" value="{{ old('search', request()->search) }}" id="job-title"
                             class="form-control filter-input-box" placeholder="Job, Company name...">
                </div>
                <div class="filter-search-form filter-border mt-lg-0">
                    <i class="uil uil-clipboard-notes"></i>
                    <select class="form-select new-padding-select" data-trigger name="industry" aria-label="Default select example">
                     @php
                         $searchCategories = App\Models\Industry::with('jobs')
                             ->where('status', 'active')
                             ->orderBy('order_no')
                             ->get();
                     @endphp
                     <option value="" selected> Any Industry </option>
                     @foreach ($searchCategories as $category)
                         <option value="{{ $category->slug }}"
                             {{ old('industry',(isset(request()->industry)? request()->industry: '') ) == $category->slug ? 'selected' : '' }}> {{ $category->name }}
                         </option>
                     @endforeach

                    </select>
                </div>
                <div class="filter-search-form filter-border mt-lg-0">
                    <i class="uil uil-clipboard-notes"></i>
                    <select class="form-select new-padding-select" data-trigger name="department" aria-label="Default select example">
                     @php
                         $searchCategories = App\Models\CompanyCategory::with('jobs')
                             ->where('status', 'active')
                             ->orderBy('order_no')
                             ->get();
                     @endphp
                     <option value="" selected> Any Department </option>
                     @foreach ($searchCategories as $category)
                         <option value="{{ $category->slug }}"
                             {{  old('department',(isset(request()->department)? request()->department: '') == $category->slug? 'selected': '' ) }}> {{ $category->title }}
                         </option>
                     @endforeach

                    </select>
                </div>
                <div class="search-job-button h-100">
                    <button class="btn btn-danger submit-btn w-100" type="submit"><i
                            class="uil uil-search"></i> Find Job</button>
                </div>
            </div>
        </form>
    </div><!--end container-->
</div>
<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>
<!--</div>-->
{{-- <div class="container">
     <div class="row">
         <div class="col-lg-8">
             <div class="text-start text-white">
                 <h1 class="hero-text">Search Between More Then <span class="orange-color fw-bold">10,000+</span>
                     Open Jobs.</h1>
                 <p class="fs-16 hero-text1">Find jobs, create trackable resumes and enrich your applications.
                 </p>
             </div>
         </div>
         <!--end col-->
     </div>

     <form action="{{ route('jobs') }}" method="get">
         <div class="col-lg-6 registration-form">
             <div class="row g-0">
                 <div class="col-lg-12">
                     <div class="filter-search-form filter-border mt-3 mb-2 mt-lg-0">
                         <i class="uil uil-briefcase-alt"></i>
                         <input type="search" name="search" value="{{ old('search') }}" id="job-title"
                             class="form-control filter-input-box" placeholder="Job, Company name...">
                     </div>
                 </div>
                 <!--end col-->
                 <div class="col-lg-12">
                     <div class="filter-search-form filter-border mt-3 mt-lg-0">
                         <i class="uil uil-clipboard-notes"></i>
                         <select class="form-select new-padding-select" data-trigger name="category" aria-label="Default select example">
                             @php
                                 $searchCategories = App\Models\CompanyCategory::with('jobs')
                                     ->where('status', 'active')
                                     ->orderBy('order_no')
                                     ->get();
                             @endphp
                             <option disabled selected> --Select Category-- </option>
                             @foreach ($searchCategories as $category)
                                 <option value="{{ $category->slug }}"
                                     {{ old('category') == $category->slug ? 'selected' : '' }}> {{ $category->title }}
                                 </option>
                             @endforeach

                         </select>
                     </div>
                 </div>
                 <!--end col-->
                 <div class="col-lg-3">
                     <div class="mt-3 mt-lg-0 h-100">
                         <button class="btn btn-danger submit-btn w-100 h-100 new-radius" type="submit"><i
                                 class="uil uil-search me-1"></i> Find Job</button>
                     </div>
                 </div>
                 <!--end col-->
             </div>
         </div>
         <!--end container-->
     </form>

 </div> --}}
