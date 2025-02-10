<?php $__env->startSection('title'); ?>
    <?php echo e($data->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seo_section'); ?>
    <meta name="description" content="<?php echo e(isset($setting) ? $setting->og_description : ''); ?>">
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e($data->title); ?>">
    <meta property="og:description" content="<?php echo Str::limit($data->description, 50); ?>">
    <meta property="og:image" content="<?php echo e(asset('storage/blog/' . $data->image)); ?>">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:url" content="<?php echo e(url()->current()); ?>">
    <meta name="twitter:title" content="<?php echo e($data->title); ?>">
    <meta name="twitter:description" content="<?php echo Str::limit($data->description, 50); ?>">
    <meta name="twitter:image" content="<?php echo e(asset('storage/blog/' . $data->image)); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <div class="page-content">
            <!-- START HOME -->
            <section class="bg-home inner-page" id="home">
                <div class="bg-overlay"
                    style="background-image: url(<?php echo e(asset('storage/news_and_announcement/' . $data->image)); ?>);"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center text-white mb-5">
                                <h1 class="display-5 mb-3"> <?php echo e($data->title); ?> </h1>
                                
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
                                    
                                    <div class="blog-post-info">
                                        <ul class="list-inline mb-0 mt-2 text-muted">
                                            <li class="list-inline-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="my-2">
                                                        <a href="javascript::void(0)" class="primary-link">
                                                            <?php if(isset($data->author)): ?>
                                                                <h6 class="mb-0">By <?php echo e($data->author); ?></h6>
                                                            <?php endif; ?>
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
                                                        <p class="mb-0"> <?php echo e($data->created_at->toFormattedDateString()); ?>

                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="mt-0">
                                            
                                            <p class="text-muted">
                                                <?php echo $data->description; ?>

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
                                    <?php if(count($related_news) !== 0): ?>
                                        <div class="categories-list">
                                            <ul class="same-company-job">
                                                <?php $__currentLoopData = $related_news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <a href="<?php echo e(route('newsAndAnnouncement.single', $related_data->slug)); ?>"
                                                            class="flex-link">
                                                            <img src="<?php echo e(asset('storage/news_and_announcement/' . $related_data->image)); ?>"
                                                                class="img-fluid" alt="">
                                                            <div class="job-detail">
                                                                <span class="job-title"><?php echo e($related_data->title); ?></span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <div class="clearfix"></div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="a-break mb-2">
                                    <img src="<?php echo e(asset('frontend/assets/images/files/machapuchree-bank_k8S0FE3TWD.gif')); ?>"
                                        alt="" class="img-fluid">
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </section>


            <div class="blog-share-fixed pos-fixed">
                <div class="blog-share-title">
                    Mega Official News And Announcements <span class="blog-main-title">- <?php echo e($data->title); ?></span>
                </div>
                <div class="blog-share-sections social-share">
                    

                    
                    <!-- ShareThis BEGIN -->
                    <div class="sharethis-inline-share-buttons"></div>
                    <!-- ShareThis END -->
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/news-and-announcement_single.blade.php ENDPATH**/ ?>