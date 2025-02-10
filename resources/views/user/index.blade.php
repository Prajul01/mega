@extends('user.layout.master')
@section('title', $setting->meta_title)
@section('seo_section')
    <meta name="description" content="{{ isset($setting) ? $setting->meta_description : '' }}">
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
    <div class="page-content new-padding-page">
        <!-- START HOME -->
        <section class="hero-banner" id="home">
            @include('user.layout.banner')
            <!--end container-->
        </section>
        <!-- End Home -->

        <section class="job-categories landing-negative">
            <div class="container">
                <ul class="job-list-menu nav nav-pills nav-justified flex-column flex-sm-row mb-4" id="pills-tab"
                    role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="industry-job-tab" data-bs-toggle="pill"
                            data-bs-target="#industry-job" type="button" role="tab" aria-controls="industry-job"
                            aria-selected="true">Industry</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="company-job-tab" data-bs-toggle="pill" data-bs-target="#company-job"
                            type="button" role="tab" aria-controls="company-job" aria-selected="false">Company</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="skill-job-tab" data-bs-toggle="pill" data-bs-target="#skill-job"
                            type="button" role="tab" aria-controls="skill-job" aria-selected="false">Department
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="location-job-tab" data-bs-toggle="pill" data-bs-target="#location-job"
                            type="button" role="tab" aria-controls="location-job" aria-selected="false">Location
                        </button>
                    </li>

                </ul>
            </div>
        </section>

        <section class="job-categories landing-negative no-negative bg-gray">
            <div class="container">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="industry-job" role="tabpanel"
                        aria-labelledby="industry-job-tab">
                        <br>
                        <div class="row">
                            <?php
                            $industry = $industries
                                ->sortByDesc(function ($industryChunk) {
                                    return $industryChunk->jobs->count();
                                })
                                ->chunk(1);
                            ?>
                            @foreach ($industry as $key => $industryChunk)
                                <div class="col-lg-4 col-md-6 {{ $key > 4 ? 'mobile-none' : '' }}">
                                    <div class="card job-Categories-box bg-light border-0">
                                        <div class="card-body px-3 py-2">
                                            <ul class="list-unstyled job-Categories-list mb-0">
                                                @foreach ($industryChunk as $industry)
                                                    <li>
                                                        <a href="{{ route('jobs', ['industry' => $industry->slug]) }}"
                                                            class="primary-link">{{ $industry->name }}

                                                            <span
                                                                class="badge bg-soft-info float-end">{{ $industry->jobs->count() }}</span></a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if ($industry->count() > 5)
                                <div class="mobile-see-more">
                                    <span class="click-show">See</span> <span class="click-remove d-none">Remove</span>
                                    More Industry ({{ $industry->count() }})
                                    <span class="top-icon">
                                        <i class="fa-solid fa-angle-down"></i>
                                    </span>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="tab-pane fade" id="company-job" role="tabpanel" aria-labelledby="company-job-tab">
                        <br>
                        <div class="row">
                            @foreach ($employers->chunk(1) as $key => $employersChunk)
                                <div class="col-lg-4 col-md-6 {{ $key > 4 ? 'mobile-none' : '' }}">
                                    <div class="card job-Categories-box bg-light border-0">
                                        <div class="card-body px-3 py-2">

                                            <ul class="list-unstyled job-Categories-list mb-0">
                                                @foreach ($employersChunk as $employer)
                                                    <li>
                                                        <a href="{{ route('jobs', ['company' => $employer->slug]) }}"
                                                            class="primary-link">{{ $employer->company_name }}<span
                                                                class="badge bg-soft-info float-end">{{ $employer->jobs->count() }}</span></a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if ($employer->count() > 5)
                                <div class="mobile-see-more">
                                    <span class="click-show">See</span> <span class="click-remove d-none">Remove</span>
                                    More Industry ({{ $employer->count() }})
                                    <span class="top-icon">
                                        <i class="fa-solid fa-angle-down"></i>
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!--end freelancer-tab-->
                    <div class="tab-pane fade" id="location-job" role="tabpanel" aria-labelledby="location-job-tab">
                        <br>
                        <div class="row">

                            @foreach ($locations->chunk(1) as $key => $locationChunk)
                                <div class="col-lg-4 col-md-6 {{ $key > 4 ? 'mobile-none' : '' }}">
                                    <div class="card job-Categories-box bg-light border-0">
                                        <div class="card-body px-3 py-2">
                                            <ul class="list-unstyled job-Categories-list mb-0">
                                                @foreach ($locationChunk as $location)
                                                    <li>
                                                        <a href="{{ route('jobs', ['location' => $location->slug]) }}"
                                                            class="primary-link">{{ $location->name }}
                                                            <span
                                                                class="badge bg-soft-info float-end">{{ $location->jobs->count() }}</span></a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if ($locations->count() > 5)
                                <div class="mobile-see-more">
                                    <span class="click-show">See</span> <span class="click-remove d-none">Remove</span>
                                    More Industry ({{ $locations->count() }})
                                    <span class="top-icon">
                                        <i class="fa-solid fa-angle-down"></i>
                                    </span>
                                </div>
                            @endif

                            <!--end col-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="skill-job" role="tabpanel" aria-labelledby="skill-job-tab">
                        <br>
                        <div class="row">
                            @foreach ($categories->chunk(1) as $key => $categoryChunk)
                                <div class="col-lg-4 col-md-6 {{ $key > 4 ? 'mobile-none' : '' }}">
                                    <div class="card job-Categories-box bg-light border-0">
                                        <div class="card-body px-3 py-2">
                                            <ul class="list-unstyled job-Categories-list mb-0">
                                                @foreach ($categoryChunk as $category)
                                                    <li>
                                                        <a href="{{ route('jobs', ['category' => $category->slug]) }}"
                                                            class="primary-link">{{ $category->title }}
                                                            <span
                                                                class="badge bg-soft-info float-end">{{ $category->jobs->count() }}</span></a>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if ($categories->count() > 5)
                                <div class="mobile-see-more">
                                    <span class="click-show">See</span> <span class="click-remove d-none">Remove</span>
                                    More Industry ({{ $categories->count() }})
                                    <span class="top-icon">
                                        <i class="fa-solid fa-angle-down"></i>
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </section>



        <section class="home-jobs-wrapper bg-light">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-9">
                        @if (count($top_jobs) > 0)
                            <div class="section-title text-start mb-3 pb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="title">
                                        <small class="icon-image-title">
                                            <img src="{{ asset('frontend/assets/images/target.png') }}">
                                        </small>
                                        <span class="main-job-type">
                                            Mega Jobs
                                        </span>
                                    </h4>
                                    <a href="{{ route('jobs', ['q' => 'megajobs']) }}" name="submit" type="submit"
                                        id="submit" class="btn btn-primary btn-hover mobile-none">View
                                        All
                                        Mega Jobs <i class="uil uil-message ms-1"></i></a>
                                </div>
                                <p class="text-muted mb-1">Explore from some of the most popular jobs in the
                                    country.</p>
                                <hr>
                                <div class="row job-box-wrapper mb-2">
                                    @foreach ($top_jobs as $job)
                                        <div class="col-lg-4 col-md-6">
                                            <div class="job-box card mt-2">
                                                <div class="px-3 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-3">
                                                            <div class="company-logo-wrapper">
                                                                <a href="{{ route('employer_detail', $job->employer->slug) }}"
                                                                    class="btn-trigger" data-bs-toggle="tooltip"
                                                                    title="View Company">
                                                                    <img src="{{ asset('storage/employer/logo' . $job->employer->logo) }}"
                                                                        alt="{{ $job->employer->company_name }}"
                                                                        class="img-fluid rounded-3">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="mt-3 mt-lg-0 job-lineclamp">
                                                                <h5 class="fs-16 mb-1 job-title-home text"><a
                                                                        href="{{ route('employer_detail', $job->employer->slug) }}"
                                                                        class="text-dark">
                                                                        {{ $job->employer->company_name }} </a>
                                                                </h5>
                                                                <ul class="list-inline mb-0">
                                                                    <li class="list-inline-item">
                                                                        <p class="text-muted fs-13 mb-0">
                                                                            <a href="{{ route('job_single', $job->slug) }}"
                                                                                class="btn-trigger job-desc-home text"
                                                                                data-bs-toggle="tooltip" title="View Job"
                                                                                class="text-dark">
                                                                                {{ $job->title }}
                                                                            </a>
                                                                        </p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="col-12">
                                        <a href="{{ route('jobs', ['top_jobs' => 'all']) }}" name="submit"
                                            type="submit" id="submit"
                                            class="btn btn-primary btn-hover mobile-only">View
                                            All
                                            Mega Jobs <i class="uil uil-message ms-1"></i></a>
                                    </div>

                                </div>
                            </div>
                        @endif
                        @php
                          $advertisement = App\Models\Advertisement::where('display', '1')
                            ->where('type', '1')
                            ->inRandomOrder()
                            ->first();
                         if($advertisement){
                           $advertisement->views= $advertisement->views+1;
                           $advertisement->save();
                         }
                       
                        @endphp
                        @if(isset($advertisement))
                        <div class="banner-wrapper">
                            <img src="{{asset('storage/advertisement/'.$advertisement->image)}}" class="img-fluid" alt="{{$advertisement->title}}">
                        </div>
                        @endif



                        @if (count($hot_jobs) > 0)
                            <div class="section-title text-start mb-3 pb-2">
                                <div class="d-flex align-items-center justify-content-between main-title-flex">
                                    <h4 class="title">
                                        <small class="icon-image-title">
                                            <img src="{{ asset('frontend/assets/images/premium.png') }}">
                                        </small>
                                        <span class="main-job-type">
                                            Premium Jobs
                                        </span>
                                    </h4>
                                    <a href="{{ route('jobs', ['hot_jobs' => 'all']) }}" name="submit" type="submit"
                                        id="submit" class="btn btn-primary btn-hover mobile-none">View
                                        All
                                        Premium Jobs <i class="uil uil-message ms-1"></i></a>
                                </div>
                                <p class="text-muted mb-1">Explore from some of the most popular jobs in the
                                    country.</p>
                                <hr>
                                <div class="row job-box-wrapper mb-2">
                                    @foreach ($hot_jobs as $job)
                                        <div class="col-lg-4 col-md-6">
                                            <div class="job-box card mt-2">
                                                <div class="px-3 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-3">
                                                            <div class="company-logo-wrapper">
                                                                <a href="{{ route('employer_detail', $job->employer->slug) }}"
                                                                    class="btn-trigger" data-bs-toggle="tooltip"
                                                                    title="View Company"><img
                                                                        src="{{ asset('storage/employer/logo' . $job->employer->logo) }}"
                                                                        alt="{{ $job->employer->company_name }}"
                                                                        class="img-fluid rounded-3">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="mt-3 mt-lg-0 job-lineclamp">
                                                                <h5 class="fs-16 mb-1 job-title-home text"><a
                                                                        href="{{ route('job_single', $job->slug) }}"
                                                                        class="text-dark">
                                                                        {{ $job->employer->company_name }} </a>
                                                                </h5>
                                                                <ul class="list-inline mb-0">
                                                                    <li class="list-inline-item">
                                                                        <p class="text-muted fs-16 mb-0">
                                                                            <a href="{{ route('job_single', $job->slug) }}"
                                                                                class="btn-trigger job-desc-home text"
                                                                                data-bs-toggle="tooltip" title="View Job"
                                                                                class="text-dark">
                                                                                {{ $job->title }}
                                                                            </a>
                                                                        </p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-12">
                                        <a href="{{ route('jobs', ['hot_jobs' => 'all']) }}" name="submit"
                                            type="submit" id="submit"
                                            class="btn btn-primary btn-hover mobile-only">View
                                            All
                                            Premium Jobs <i class="uil uil-message ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (count($top_jobs) > 0)
                            <div class="section-title text-start mb-3 pb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="title">
                                        <small class="icon-image-title">
                                            <img src="{{ asset('frontend/assets/images/prime-service.png') }}">
                                        </small>
                                        <span class="main-job-type">
                                            Prime Jobs
                                        </span>
                                    </h4>
                                    <a href="{{ route('jobs', ['q' => 'prime-jobs']) }}" name="submit" type="submit"
                                        id="submit" class="btn btn-primary btn-hover mobile-none">View
                                        All
                                        prime Jobs <i class="uil uil-message ms-1"></i></a>
                                </div>
                                <p class="text-muted mb-1">Explore from some of the most popular jobs in the
                                    country.</p>
                                <hr>
                                <div class="row job-box-wrapper mb-2">
                                    @foreach ($general_jobs as $job)
                                        <div class="col-lg-4 col-md-6">
                                            <div class="job-box card mt-2">
                                                <div class="px-3 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-3">
                                                            <div class="company-logo-wrapper">
                                                                <a href="{{ route('employer_detail', $job->employer->slug) }}"
                                                                    class="btn-trigger" data-bs-toggle="tooltip"
                                                                    title="View Company">
                                                                    <img src="{{ asset('storage/employer/logo' . $job->employer->logo) }}"
                                                                        alt="{{ $job->employer->company_name }}"
                                                                        class="img-fluid rounded-3">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="mt-3 mt-lg-0 job-lineclamp">
                                                                <h5 class="fs-16 mb-1 job-title-home text"><a
                                                                        href="{{ route('employer_detail', $job->employer->slug) }}"
                                                                        class="text-dark">
                                                                        {{ $job->employer->company_name }} </a>
                                                                </h5>
                                                                <ul class="list-inline mb-0">
                                                                    <li class="list-inline-item">
                                                                        <p class="text-muted fs-13 mb-0">
                                                                            <a href="{{ route('job_single', $job->slug) }}"
                                                                                class="btn-trigger job-desc-home text"
                                                                                data-bs-toggle="tooltip" title="View Job"
                                                                                class="text-dark">
                                                                                {{ $job->title }}
                                                                            </a>
                                                                        </p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="col-12">
                                        <a href="{{ route('jobs', ['general_jobs' => 'all']) }}" name="submit"
                                            type="submit" id="submit"
                                            class="btn btn-primary btn-hover mobile-only">View
                                            All
                                            Prime Jobs <i class="uil uil-message ms-1"></i></a>
                                    </div>

                                </div>
                            </div>
                        @endif


                        <div class="section-title">
                            <div class="row justify-content-center mb-2">
                                <div class="col-lg-12">
                                    <ul class="job-list-menu nav nav-pills nav-justified flex-column mobile-big-text flex-sm-row mb-3"
                                        id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="recent-jobs-tab" data-bs-toggle="pill"
                                                data-bs-target="#recent-jobs" type="button" role="tab"
                                                aria-controls="recent-jobs" aria-selected="true">Latest
                                                Jobs</button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="part-time-tab" data-bs-toggle="pill"
                                                data-bs-target="#part-time" type="button" role="tab"
                                                aria-controls="part-time" aria-selected="false">Newspaper
                                                Jobs</button>
                                        </li>
                                    </ul>
                                </div>
                                <!--end col-->
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active " id="recent-jobs" role="tabpanel"
                                            aria-labelledby="recent-jobs-tab">
                                            <div class="row job-box-wrapper">
                                                @foreach ($recent_jobs as $job)
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="job-box card mt-2">
                                                            <div class="px-3 py-2">
                                                                <div class="row align-items-center">
                                                                    <div class="col-3">
                                                                        <div class="company-logo-wrapper">
                                                                            <a href="{{ route('employer_detail', $job->employer->slug) }}"
                                                                                class="btn-trigger"
                                                                                data-bs-toggle="tooltip"
                                                                                title="View Company"><img
                                                                                    src="{{ asset('storage/employer/logo' . $job->employer->logo) }}"
                                                                                    alt="{{ $job->employer->company_name }}"
                                                                                    class="img-fluid rounded-3">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <div class="mt-3 mt-lg-0 job-lineclamp">
                                                                            <h5 class="fs-16 mb-1 job-title-home text"><a
                                                                                    href="{{ route('job_single', $job->slug) }}"
                                                                                    class="text-dark">
                                                                                    {{ $job->employer->company_name }} </a>
                                                                            </h5>
                                                                            <ul class="list-inline mb-0">
                                                                                <li class="list-inline-item">
                                                                                    <p class="text-muted fs-16 mb-0">
                                                                                        <a href="{{ route('job_single', $job->slug) }}"
                                                                                            class="btn-trigger job-desc-home text"
                                                                                            data-bs-toggle="tooltip"
                                                                                            title="View Job"
                                                                                            class="text-dark">
                                                                                            {{ $job->title }}
                                                                                        </a>
                                                                                    </p>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <a href="{{ route('jobs', ['recent_jobs' => 'all']) }}" name="submit"
                                                    type="submit" id="submit" class="btn btn-primary btn-hover">View
                                                    All Latest Jobs <i class="uil uil-message ms-1"></i></a>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="tab-pane fade" id="part-time" role="tabpanel"
                                            aria-labelledby="part-time-tab">
                                            <div class="row job-box-wrapper">
                                                @foreach ($newspaper_jobs as $job)
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="job-box card mt-2">
                                                            <div class="px-3 py-2">
                                                                <div class="row align-items-center">
                                                                    <div class="col-3">
                                                                        <div class="company-logo-wrapper">
                                                                            <a href="{{ route('employer_detail', $job->employer->slug) }}"
                                                                                class="btn-trigger"
                                                                                data-bs-toggle="tooltip"
                                                                                title="View Company"><img
                                                                                    src="{{ asset('storage/employer/logo' . $job->employer->logo) }}"
                                                                                    alt="{{ $job->employer->company_name }}"
                                                                                    class="img-fluid rounded-3">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <div class="mt-3 mt-lg-0 job-lineclamp">
                                                                            <h5 class="fs-16 mb-1 job-title-home text"><a
                                                                                    href="{{ route('job_single', $job->slug) }}"
                                                                                    class="text-dark">
                                                                                    {{ $job->employer->company_name }} </a>
                                                                            </h5>
                                                                            <ul class="list-inline mb-0">
                                                                                <li class="list-inline-item">
                                                                                    <p class="text-muted fs-16 mb-0">
                                                                                        <a href="{{ route('job_single', $job->slug) }}"
                                                                                            class="btn-trigger job-desc-home text"
                                                                                            data-bs-toggle="tooltip"
                                                                                            title="View Job"
                                                                                            class="text-dark">
                                                                                            {{ $job->title }}
                                                                                        </a>
                                                                                    </p>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <!--end col-->
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <a href="{{ route('jobs', ['newspaper_jobs' => 'all']) }}" name="submit"
                                                    type="submit" id="submit" class="btn btn-primary btn-hover">View
                                                    All Newspaper Jobs
                                                    <i class="uil uil-message ms-1"></i></a>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <section class="section jobs-live">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <div class="text-center mb-4">
                                            <p class="badge bg-warning fs-14 mb-2">Jobs Live Today</p>
                                            <h4 class="title"><strong>Browse Job By Categories</strong></h4>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <ul class="job-list-menu nav nav-pills nav-justified flex-column flex-sm-row mb-4"
                                            id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="industry-job-tab"
                                                    data-bs-toggle="pill" data-bs-target="#industry-job" type="button"
                                                    role="tab" aria-controls="industry-job"
                                                    aria-selected="true">Industry</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="company-job-tab" data-bs-toggle="pill"
                                                    data-bs-target="#company-job" type="button" role="tab"
                                                    aria-controls="company-job" aria-selected="false">Company</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="location-job-tab" data-bs-toggle="pill"
                                                    data-bs-target="#location-job" type="button" role="tab"
                                                    aria-controls="location-job" aria-selected="false">Locations
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="skill-job-tab" data-bs-toggle="pill"
                                                    data-bs-target="#skill-job" type="button" role="tab"
                                                    aria-controls="skill-job" aria-selected="false">Skills
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--end col-->
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="industry-job" role="tabpanel"
                                                aria-labelledby="industry-job-tab">
                                                <br>
                                                <div class="row">
                                                    @foreach ($categories->chunk(3) as $key => $categoryChunk)
                                                        <div class="col-lg-4 col-md-6 {{ $key != 0 ? 'mobile-none' : '' }}">
                                                            <div class="card job-Categories-box bg-light border-0">
                                                                <div class="card-body px-3 py-2">
                                                                    <ul class="list-unstyled job-Categories-list mb-0">
                                                                        @foreach ($categoryChunk as $category)
                                                                            <li>
                                                                                <a href="{{ route('jobs', ['category' => $category->slug]) }}"
                                                                                    class="primary-link">{{ $category->title }}
                                                                                    <span
                                                                                        class="badge bg-soft-info float-end">{{ $category->jobs->count() }}</span></a>
                                                                            </li>
                                                                        @endforeach

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <a href="{{ route('jobs', ['industries']) }}" id="submit"
                                                        class="btn btn-primary btn-hover">Jobs by Industries
                                                        <i class="uil uil-message ms-1"></i></a>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="company-job" role="tabpanel"
                                                aria-labelledby="company-job-tab">
                                                <br>
                                                <div class="row">
                                                    @foreach ($employers->chunk(3) as $employersChunk)
                                                        <div class="col-lg-4 col-md-6">
                                                            <div class="card job-Categories-box bg-light border-0">
                                                                <div class="card-body px-3 py-2">

                                                                    <ul class="list-unstyled job-Categories-list mb-0">
                                                                        @foreach ($employersChunk as $employer)
                                                                            <li>
                                                                                <a href="{{ route('jobs', ['company' => $employer->slug]) }}"
                                                                                    class="primary-link">{{ $employer->company_name }}<span
                                                                                        class="badge bg-soft-info float-end">{{ $employer->jobs->count() }}</span></a>
                                                                            </li>
                                                                        @endforeach

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <a href="{{ route('jobs', ['companies']) }}" id="submit"
                                                        class="btn btn-primary btn-hover">Jobs by Company
                                                        <i class="uil uil-message ms-1"></i></a>
                                                </div>
                                            </div>
                                            <!--end freelancer-tab-->
                                            <div class="tab-pane fade" id="location-job" role="tabpanel"
                                                aria-labelledby="location-job-tab">
                                                <br>
                                                <div class="row">

                                                    @foreach ($locations->chunk(3) as $key => $locationChunk)
                                                        <div class="col-lg-4 col-md-6 {{ $key != 0 ? 'mobile-none' : '' }}">
                                                            <div class="card job-Categories-box bg-light border-0">
                                                                <div class="card-body px-3 py-2">
                                                                    <ul class="list-unstyled job-Categories-list mb-0">
                                                                        @foreach ($locationChunk as $location)
                                                                            <li>
                                                                                <a href="{{ route('jobs', ['location' => $location->slug]) }}"
                                                                                    class="primary-link">{{ $location->name }}
                                                                                    <span
                                                                                        class="badge bg-soft-info float-end">{{ $location->jobs->count() }}</span></a>
                                                                            </li>
                                                                        @endforeach

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                    <!--end col-->
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <a href="{{ route('jobs', ['locations']) }}" id="submit"
                                                        class="btn btn-primary btn-hover">Jobs by Location <i
                                                            class="uil uil-message ms-1"></i></a>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="skill-job" role="tabpanel"
                                                aria-labelledby="skill-job-tab">
                                                <br>
                                                <div class="row">
                                                    @foreach ($skills->chunk(3) as $key => $skillChunk)
                                                        <div class="col-lg-4 col-md-6 {{ $key != 0 ? 'mobile-none' : '' }}">
                                                            <div class="card job-Categories-box bg-light border-0">
                                                                <div class="card-body px-3 py-2">
                                                                    <ul class="list-unstyled job-Categories-list mb-0">
                                                                        @foreach ($skillChunk as $skill)
                                                                            <li>
                                                                                <a href="{{ route('jobs', ['skill' => $skill->slug]) }}"
                                                                                    class="primary-link">{{ $skill->title }}
                                                                                    <span
                                                                                        class="badge bg-soft-info float-end">{{ $skill->jobs->count() }}</span></a>
                                                                            </li>
                                                                        @endforeach

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <a href="{{ route('jobs', ['skills']) }}" id="submit"
                                                        class="btn btn-primary btn-hover">Jobs by Skills <i
                                                            class="uil uil-message ms-1"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end container-->
                        </section>  --}}
                    </div>
                    @include('user.layout.rigth-sidebar')
                </div>
            </div>
        </section>



        <section class="bg-light py-5" style="background-color: #fff !important;">
            <div class="py-3 hiring-top-company">
                <div class="container">
                    <div class="hiring-top-title">
                        Top companies hiring now
                    </div>

                    <div class="row">
                        @foreach ($industries->sortByDesc(function ($industry) {
            return $industry->jobs->count();
        }) as $industry)
                            @if ($industry->jobs->count() > 0)
                                <div class="col-md-4 col-lg-3">
                                    <div class="hiring-company">
                                        <a href="{{ route('jobs', ['industry' => $industry->slug]) }}"
                                            class="full-link"></a>
                                        <div class="hiring-company-info">
                                            <div class="hiring-company-name">
                                                {{ Str::limit($industry->name, 20, '...') }} <span class="title-icon">
                                                    <i class="fa fa-chevron-right"></i>
                                                </span>
                                            </div>
                                            <div class="hiring-company-job">
                                                {{ $industry->jobs->count() }} Jobs Opening
                                            </div>
                                        </div>

                                        <div class="hiring-company-logos">
                                            @foreach ($industry->employers->sortByDesc(function ($employer) {
                return $employer->jobs->count();
            })->take(4) as $employer)
                                                <div class="company-logo"><img
                                                        src="{{ asset('storage/employer/logo' . $employer->logo) }}"
                                                        class="img-fluid" alt="{{ $employer->company_name }}"></div>
                                            @endforeach

                                        </div>

                                    </div>
                                </div>
                            @endif
                        @endforeach

                        {{-- <div class="col-md-4 col-lg-3">
                        <div class="hiring-company">
                            <a href="#" class="full-link"></a>
                            <div class="hiring-company-info">
                                <div class="hiring-company-name">
                                    GEMS School <span class="title-icon">
                                        <i class="fa fa-chevron-right"></i>
                                    </span>
                                </div>
                                <div class="hiring-company-job">
                                    19 Jobs Opening
                                </div>
                            </div>

                            <div class="hiring-company-logos">
                                <div class="company-logo"><img src="frontend/assets/images/files/sqlogo1.png"
                                        class="img-fluid" alt=""></div>
                                <div class="company-logo"><img src="frontend/assets/images/files/sqlogo2.png"
                                        class="img-fluid" alt=""></div>
                                <div class="company-logo"><img src="frontend/assets/images/files/sqlogo3.png"
                                        class="img-fluid" alt=""></div>
                                <div class="company-logo"><img src="frontend/assets/images/files/sqlogo4.png"
                                        class="img-fluid" alt=""></div>
                            </div>

                        </div>
                    </div> --}}

                    </div>

                </div>
            </div>
            <div class="py-3 hiring-top-company">
                <div class="container">
                    <div class="hiring-top-title">
                        What is your Qualification?
                    </div>

                    <div class="qualification-wrapper justify-content-center">
                        @foreach ($educations as $education)
                            <div class="qualification-card text-center">
                                <a href="{{ route('jobs', ['education' => $education->slug]) }}" class="full-link"></a>
                                <div class="card-icon">
                                    <img src="{{ asset('storage/education/' . $education->image) }}" class="img-fluid"
                                        alt="{{ $education->title }}">
                                </div>
                                <div class="card-content">
                                    <div class="card-title">
                                        <?php
                                        $title = Ucfirst($education->title);
                                        $title = str_replace('th', '<sup>th</sup>', $title);
                                        $title = str_replace(' / ', ' /', $title);
                                        ?>
                                        {!! $title !!}
                                    </div>
                                    <div class="card-subcontent">
                                        <div class="card-num">
                                            {{ $education->job->count() }} + <small> Vacancies</small>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- START CLIENT -->
        {{--  @include('user.layout.employers') --}}
        <!-- END CLIENT -->
    @endsection
