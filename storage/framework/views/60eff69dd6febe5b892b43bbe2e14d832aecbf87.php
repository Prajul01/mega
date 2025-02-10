<?php $__env->startSection('title', $setting->meta_title); ?>
<?php $__env->startSection('seo_section'); ?>
    <meta name="description" content="<?php echo e(isset($setting) ? $setting->meta_description : ''); ?>">
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e(isset($setting) ? $setting->og_title : ''); ?>">
    <meta property="og:description" content="<?php echo e(isset($setting) ? $setting->og_description : ''); ?>">
    <meta property="og:image"
        content="<?php echo e(isset($setting) ? asset('storage/setting/og-image/' . $setting->og_image) : ''); ?>">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:url" content="<?php echo e(url()->current()); ?>">
    <meta name="twitter:title" content="<?php echo e(isset($setting) ? $setting->og_title : ''); ?>">
    <meta name="twitter:description" content="<?php echo e(isset($setting) ? $setting->og_description : ''); ?>">
    <meta name="twitter:image"
        content="<?php echo e(isset($setting) ? asset('storage/setting/og-image/' . $setting->og_image) : ''); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="page-content new-padding-page">
        <!-- START HOME -->
        <section class="hero-banner" id="home">
            <?php echo $__env->make('user.layout.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                            <?php $__currentLoopData = $industry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $industryChunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-4 col-md-6 <?php echo e($key > 4 ? 'mobile-none' : ''); ?>">
                                    <div class="card job-Categories-box bg-light border-0">
                                        <div class="card-body px-3 py-2">
                                            <ul class="list-unstyled job-Categories-list mb-0">
                                                <?php $__currentLoopData = $industryChunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <a href="<?php echo e(route('jobs', ['industry' => $industry->slug])); ?>"
                                                            class="primary-link"><?php echo e($industry->name); ?>


                                                            <span
                                                                class="badge bg-soft-info float-end"><?php echo e($industry->jobs->count()); ?></span></a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($industry->count() > 5): ?>
                                <div class="mobile-see-more">
                                    <span class="click-show">See</span> <span class="click-remove d-none">Remove</span>
                                    More Industry (<?php echo e($industry->count()); ?>)
                                    <span class="top-icon">
                                        <i class="fa-solid fa-angle-down"></i>
                                    </span>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="company-job" role="tabpanel" aria-labelledby="company-job-tab">
                        <br>
                        <div class="row">
                            <?php $__currentLoopData = $employers->chunk(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $employersChunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-4 col-md-6 <?php echo e($key > 4 ? 'mobile-none' : ''); ?>">
                                    <div class="card job-Categories-box bg-light border-0">
                                        <div class="card-body px-3 py-2">

                                            <ul class="list-unstyled job-Categories-list mb-0">
                                                <?php $__currentLoopData = $employersChunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <a href="<?php echo e(route('jobs', ['company' => $employer->slug])); ?>"
                                                            class="primary-link"><?php echo e($employer->company_name); ?><span
                                                                class="badge bg-soft-info float-end"><?php echo e($employer->jobs->count()); ?></span></a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($employer->count() > 5): ?>
                                <div class="mobile-see-more">
                                    <span class="click-show">See</span> <span class="click-remove d-none">Remove</span>
                                    More Industry (<?php echo e($employer->count()); ?>)
                                    <span class="top-icon">
                                        <i class="fa-solid fa-angle-down"></i>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!--end freelancer-tab-->
                    <div class="tab-pane fade" id="location-job" role="tabpanel" aria-labelledby="location-job-tab">
                        <br>
                        <div class="row">

                            <?php $__currentLoopData = $locations->chunk(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $locationChunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-4 col-md-6 <?php echo e($key > 4 ? 'mobile-none' : ''); ?>">
                                    <div class="card job-Categories-box bg-light border-0">
                                        <div class="card-body px-3 py-2">
                                            <ul class="list-unstyled job-Categories-list mb-0">
                                                <?php $__currentLoopData = $locationChunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <a href="<?php echo e(route('jobs', ['location' => $location->slug])); ?>"
                                                            class="primary-link"><?php echo e($location->name); ?>

                                                            <span
                                                                class="badge bg-soft-info float-end"><?php echo e($location->jobs->count()); ?></span></a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($locations->count() > 5): ?>
                                <div class="mobile-see-more">
                                    <span class="click-show">See</span> <span class="click-remove d-none">Remove</span>
                                    More Industry (<?php echo e($locations->count()); ?>)
                                    <span class="top-icon">
                                        <i class="fa-solid fa-angle-down"></i>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <!--end col-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="skill-job" role="tabpanel" aria-labelledby="skill-job-tab">
                        <br>
                        <div class="row">
                            <?php $__currentLoopData = $categories->chunk(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $categoryChunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-4 col-md-6 <?php echo e($key > 4 ? 'mobile-none' : ''); ?>">
                                    <div class="card job-Categories-box bg-light border-0">
                                        <div class="card-body px-3 py-2">
                                            <ul class="list-unstyled job-Categories-list mb-0">
                                                <?php $__currentLoopData = $categoryChunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <a href="<?php echo e(route('jobs', ['category' => $category->slug])); ?>"
                                                            class="primary-link"><?php echo e($category->title); ?>

                                                            <span
                                                                class="badge bg-soft-info float-end"><?php echo e($category->jobs->count()); ?></span></a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($categories->count() > 5): ?>
                                <div class="mobile-see-more">
                                    <span class="click-show">See</span> <span class="click-remove d-none">Remove</span>
                                    More Industry (<?php echo e($categories->count()); ?>)
                                    <span class="top-icon">
                                        <i class="fa-solid fa-angle-down"></i>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </section>



        <section class="home-jobs-wrapper bg-light">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-9">
                        <?php if(count($top_jobs) > 0): ?>
                            <div class="section-title text-start mb-3 pb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="title">
                                        <small class="icon-image-title">
                                            <img src="<?php echo e(asset('frontend/assets/images/target.png')); ?>">
                                        </small>
                                        <span class="main-job-type">
                                            Mega Jobs
                                        </span>
                                    </h4>
                                    <a href="<?php echo e(route('jobs', ['q' => 'megajobs'])); ?>" name="submit" type="submit"
                                        id="submit" class="btn btn-primary btn-hover mobile-none">View
                                        All
                                        Mega Jobs <i class="uil uil-message ms-1"></i></a>
                                </div>
                                <p class="text-muted mb-1">Explore from some of the most popular jobs in the
                                    country.</p>
                                <hr>
                                <div class="row job-box-wrapper mb-2">
                                    <?php $__currentLoopData = $top_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="job-box card mt-2">
                                                <div class="px-3 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-3">
                                                            <div class="company-logo-wrapper">
                                                                <a href="<?php echo e(route('employer_detail', $job->employer->slug)); ?>"
                                                                    class="btn-trigger" data-bs-toggle="tooltip"
                                                                    title="View Company">
                                                                    <img src="<?php echo e(asset('storage/employer/logo' . $job->employer->logo)); ?>"
                                                                        alt="<?php echo e($job->employer->company_name); ?>"
                                                                        class="img-fluid rounded-3">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="mt-3 mt-lg-0 job-lineclamp">
                                                                <h5 class="fs-16 mb-1 job-title-home text"><a
                                                                        href="<?php echo e(route('employer_detail', $job->employer->slug)); ?>"
                                                                        class="text-dark">
                                                                        <?php echo e($job->employer->company_name); ?> </a>
                                                                </h5>
                                                                <ul class="list-inline mb-0">
                                                                    <li class="list-inline-item">
                                                                        <p class="text-muted fs-13 mb-0">
                                                                            <a href="<?php echo e(route('job_single', $job->slug)); ?>"
                                                                                class="btn-trigger job-desc-home text"
                                                                                data-bs-toggle="tooltip" title="View Job"
                                                                                class="text-dark">
                                                                                <?php echo e($job->title); ?>

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
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <div class="col-12">
                                        <a href="<?php echo e(route('jobs', ['top_jobs' => 'all'])); ?>" name="submit"
                                            type="submit" id="submit"
                                            class="btn btn-primary btn-hover mobile-only">View
                                            All
                                            Mega Jobs <i class="uil uil-message ms-1"></i></a>
                                    </div>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php
                          $advertisement = App\Models\Advertisement::where('display', '1')
                            ->where('type', '1')
                            ->inRandomOrder()
                            ->first();
                         if($advertisement){
                           $advertisement->views= $advertisement->views+1;
                           $advertisement->save();
                         }
                       
                        ?>
                        <?php if(isset($advertisement)): ?>
                        <div class="banner-wrapper">
                            <img src="<?php echo e(asset('storage/advertisement/'.$advertisement->image)); ?>" class="img-fluid" alt="<?php echo e($advertisement->title); ?>">
                        </div>
                        <?php endif; ?>



                        <?php if(count($hot_jobs) > 0): ?>
                            <div class="section-title text-start mb-3 pb-2">
                                <div class="d-flex align-items-center justify-content-between main-title-flex">
                                    <h4 class="title">
                                        <small class="icon-image-title">
                                            <img src="<?php echo e(asset('frontend/assets/images/premium.png')); ?>">
                                        </small>
                                        <span class="main-job-type">
                                            Premium Jobs
                                        </span>
                                    </h4>
                                    <a href="<?php echo e(route('jobs', ['hot_jobs' => 'all'])); ?>" name="submit" type="submit"
                                        id="submit" class="btn btn-primary btn-hover mobile-none">View
                                        All
                                        Premium Jobs <i class="uil uil-message ms-1"></i></a>
                                </div>
                                <p class="text-muted mb-1">Explore from some of the most popular jobs in the
                                    country.</p>
                                <hr>
                                <div class="row job-box-wrapper mb-2">
                                    <?php $__currentLoopData = $hot_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="job-box card mt-2">
                                                <div class="px-3 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-3">
                                                            <div class="company-logo-wrapper">
                                                                <a href="<?php echo e(route('employer_detail', $job->employer->slug)); ?>"
                                                                    class="btn-trigger" data-bs-toggle="tooltip"
                                                                    title="View Company"><img
                                                                        src="<?php echo e(asset('storage/employer/logo' . $job->employer->logo)); ?>"
                                                                        alt="<?php echo e($job->employer->company_name); ?>"
                                                                        class="img-fluid rounded-3">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="mt-3 mt-lg-0 job-lineclamp">
                                                                <h5 class="fs-16 mb-1 job-title-home text"><a
                                                                        href="<?php echo e(route('job_single', $job->slug)); ?>"
                                                                        class="text-dark">
                                                                        <?php echo e($job->employer->company_name); ?> </a>
                                                                </h5>
                                                                <ul class="list-inline mb-0">
                                                                    <li class="list-inline-item">
                                                                        <p class="text-muted fs-16 mb-0">
                                                                            <a href="<?php echo e(route('job_single', $job->slug)); ?>"
                                                                                class="btn-trigger job-desc-home text"
                                                                                data-bs-toggle="tooltip" title="View Job"
                                                                                class="text-dark">
                                                                                <?php echo e($job->title); ?>

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
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-12">
                                        <a href="<?php echo e(route('jobs', ['hot_jobs' => 'all'])); ?>" name="submit"
                                            type="submit" id="submit"
                                            class="btn btn-primary btn-hover mobile-only">View
                                            All
                                            Premium Jobs <i class="uil uil-message ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(count($top_jobs) > 0): ?>
                            <div class="section-title text-start mb-3 pb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="title">
                                        <small class="icon-image-title">
                                            <img src="<?php echo e(asset('frontend/assets/images/prime-service.png')); ?>">
                                        </small>
                                        <span class="main-job-type">
                                            Prime Jobs
                                        </span>
                                    </h4>
                                    <a href="<?php echo e(route('jobs', ['q' => 'prime-jobs'])); ?>" name="submit" type="submit"
                                        id="submit" class="btn btn-primary btn-hover mobile-none">View
                                        All
                                        prime Jobs <i class="uil uil-message ms-1"></i></a>
                                </div>
                                <p class="text-muted mb-1">Explore from some of the most popular jobs in the
                                    country.</p>
                                <hr>
                                <div class="row job-box-wrapper mb-2">
                                    <?php $__currentLoopData = $general_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="job-box card mt-2">
                                                <div class="px-3 py-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-3">
                                                            <div class="company-logo-wrapper">
                                                                <a href="<?php echo e(route('employer_detail', $job->employer->slug)); ?>"
                                                                    class="btn-trigger" data-bs-toggle="tooltip"
                                                                    title="View Company">
                                                                    <img src="<?php echo e(asset('storage/employer/logo' . $job->employer->logo)); ?>"
                                                                        alt="<?php echo e($job->employer->company_name); ?>"
                                                                        class="img-fluid rounded-3">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="mt-3 mt-lg-0 job-lineclamp">
                                                                <h5 class="fs-16 mb-1 job-title-home text"><a
                                                                        href="<?php echo e(route('employer_detail', $job->employer->slug)); ?>"
                                                                        class="text-dark">
                                                                        <?php echo e($job->employer->company_name); ?> </a>
                                                                </h5>
                                                                <ul class="list-inline mb-0">
                                                                    <li class="list-inline-item">
                                                                        <p class="text-muted fs-13 mb-0">
                                                                            <a href="<?php echo e(route('job_single', $job->slug)); ?>"
                                                                                class="btn-trigger job-desc-home text"
                                                                                data-bs-toggle="tooltip" title="View Job"
                                                                                class="text-dark">
                                                                                <?php echo e($job->title); ?>

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
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <div class="col-12">
                                        <a href="<?php echo e(route('jobs', ['general_jobs' => 'all'])); ?>" name="submit"
                                            type="submit" id="submit"
                                            class="btn btn-primary btn-hover mobile-only">View
                                            All
                                            Prime Jobs <i class="uil uil-message ms-1"></i></a>
                                    </div>

                                </div>
                            </div>
                        <?php endif; ?>


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
                                                <?php $__currentLoopData = $recent_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="job-box card mt-2">
                                                            <div class="px-3 py-2">
                                                                <div class="row align-items-center">
                                                                    <div class="col-3">
                                                                        <div class="company-logo-wrapper">
                                                                            <a href="<?php echo e(route('employer_detail', $job->employer->slug)); ?>"
                                                                                class="btn-trigger"
                                                                                data-bs-toggle="tooltip"
                                                                                title="View Company"><img
                                                                                    src="<?php echo e(asset('storage/employer/logo' . $job->employer->logo)); ?>"
                                                                                    alt="<?php echo e($job->employer->company_name); ?>"
                                                                                    class="img-fluid rounded-3">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <div class="mt-3 mt-lg-0 job-lineclamp">
                                                                            <h5 class="fs-16 mb-1 job-title-home text"><a
                                                                                    href="<?php echo e(route('job_single', $job->slug)); ?>"
                                                                                    class="text-dark">
                                                                                    <?php echo e($job->employer->company_name); ?> </a>
                                                                            </h5>
                                                                            <ul class="list-inline mb-0">
                                                                                <li class="list-inline-item">
                                                                                    <p class="text-muted fs-16 mb-0">
                                                                                        <a href="<?php echo e(route('job_single', $job->slug)); ?>"
                                                                                            class="btn-trigger job-desc-home text"
                                                                                            data-bs-toggle="tooltip"
                                                                                            title="View Job"
                                                                                            class="text-dark">
                                                                                            <?php echo e($job->title); ?>

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
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <a href="<?php echo e(route('jobs', ['recent_jobs' => 'all'])); ?>" name="submit"
                                                    type="submit" id="submit" class="btn btn-primary btn-hover">View
                                                    All Latest Jobs <i class="uil uil-message ms-1"></i></a>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="tab-pane fade" id="part-time" role="tabpanel"
                                            aria-labelledby="part-time-tab">
                                            <div class="row job-box-wrapper">
                                                <?php $__currentLoopData = $newspaper_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="job-box card mt-2">
                                                            <div class="px-3 py-2">
                                                                <div class="row align-items-center">
                                                                    <div class="col-3">
                                                                        <div class="company-logo-wrapper">
                                                                            <a href="<?php echo e(route('employer_detail', $job->employer->slug)); ?>"
                                                                                class="btn-trigger"
                                                                                data-bs-toggle="tooltip"
                                                                                title="View Company"><img
                                                                                    src="<?php echo e(asset('storage/employer/logo' . $job->employer->logo)); ?>"
                                                                                    alt="<?php echo e($job->employer->company_name); ?>"
                                                                                    class="img-fluid rounded-3">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-9">
                                                                        <div class="mt-3 mt-lg-0 job-lineclamp">
                                                                            <h5 class="fs-16 mb-1 job-title-home text"><a
                                                                                    href="<?php echo e(route('job_single', $job->slug)); ?>"
                                                                                    class="text-dark">
                                                                                    <?php echo e($job->employer->company_name); ?> </a>
                                                                            </h5>
                                                                            <ul class="list-inline mb-0">
                                                                                <li class="list-inline-item">
                                                                                    <p class="text-muted fs-16 mb-0">
                                                                                        <a href="<?php echo e(route('job_single', $job->slug)); ?>"
                                                                                            class="btn-trigger job-desc-home text"
                                                                                            data-bs-toggle="tooltip"
                                                                                            title="View Job"
                                                                                            class="text-dark">
                                                                                            <?php echo e($job->title); ?>

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
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <a href="<?php echo e(route('jobs', ['newspaper_jobs' => 'all'])); ?>" name="submit"
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
                        
                    </div>
                    <?php echo $__env->make('user.layout.rigth-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                        <?php $__currentLoopData = $industries->sortByDesc(function ($industry) {
            return $industry->jobs->count();
        }); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($industry->jobs->count() > 0): ?>
                                <div class="col-md-4 col-lg-3">
                                    <div class="hiring-company">
                                        <a href="<?php echo e(route('jobs', ['industry' => $industry->slug])); ?>"
                                            class="full-link"></a>
                                        <div class="hiring-company-info">
                                            <div class="hiring-company-name">
                                                <?php echo e(Str::limit($industry->name, 20, '...')); ?> <span class="title-icon">
                                                    <i class="fa fa-chevron-right"></i>
                                                </span>
                                            </div>
                                            <div class="hiring-company-job">
                                                <?php echo e($industry->jobs->count()); ?> Jobs Opening
                                            </div>
                                        </div>

                                        <div class="hiring-company-logos">
                                            <?php $__currentLoopData = $industry->employers->sortByDesc(function ($employer) {
                return $employer->jobs->count();
            })->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="company-logo"><img
                                                        src="<?php echo e(asset('storage/employer/logo' . $employer->logo)); ?>"
                                                        class="img-fluid" alt="<?php echo e($employer->company_name); ?>"></div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>

                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        

                    </div>

                </div>
            </div>
            <div class="py-3 hiring-top-company">
                <div class="container">
                    <div class="hiring-top-title">
                        What is your Qualification?
                    </div>

                    <div class="qualification-wrapper justify-content-center">
                        <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="qualification-card text-center">
                                <a href="<?php echo e(route('jobs', ['education' => $education->slug])); ?>" class="full-link"></a>
                                <div class="card-icon">
                                    <img src="<?php echo e(asset('storage/education/' . $education->image)); ?>" class="img-fluid"
                                        alt="<?php echo e($education->title); ?>">
                                </div>
                                <div class="card-content">
                                    <div class="card-title">
                                        <?php
                                        $title = Ucfirst($education->title);
                                        $title = str_replace('th', '<sup>th</sup>', $title);
                                        $title = str_replace(' / ', ' /', $title);
                                        ?>
                                        <?php echo $title; ?>

                                    </div>
                                    <div class="card-subcontent">
                                        <div class="card-num">
                                            <?php echo e($education->job->count()); ?> + <small> Vacancies</small>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- START CLIENT -->
        
        <!-- END CLIENT -->
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/index.blade.php ENDPATH**/ ?>