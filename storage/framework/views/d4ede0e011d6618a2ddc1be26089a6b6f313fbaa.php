<?php $__env->startSection('title'); ?>
    <?php echo e($career->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seo_section'); ?>
    <meta name="description" content="<?php echo e(isset($setting) ? $setting->og_description : ''); ?>">
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

    <div class="main-content">
        <div class="page-content">
            <!-- START HOME -->
            <section class="bg-home inner-page" id="home">
                <div class="bg-overlay"
                    style="background-image: url('<?php echo e(asset('frontend/assets/images/files/banner1.jpg')); ?>');"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center text-white mb-5">
                                <h1 class="display-5 mb-3"> Career Tip Single </h1>
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
                        <div class="col-lg-9 col-md-8">
                            <div class="row">
                                <div class="blog-post">
                                    <div class="blog-single-image">
                                        <img src="<?php echo e(asset('storage/career/' . $career->image)); ?>" class="img-fluid"
                                            alt="Blog Single">
                                    </div>
                                    <div class="blog-post-info">
                                        <ul class="list-inline mb-0 mt-3 text-muted">
                                            <li class="list-inline-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="my-2">
                                                        <?php if(isset($career->author)): ?>
                                                            <a href="javascript:void(0)" class="primary-link">
                                                                <h6 class="mb-0">By <?php echo e($career->author); ?></h6>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-inline-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="uil uil-calendar-alt"></i>
                                                    </div>
                                                    <div class="ms-2">
                                                        <p class="mb-0">
                                                            <?php echo e($career->created_at->toFormattedDateString()); ?></p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="mt-0">
                                            <h5 class="blog-single-title"><?php echo e($career->title); ?></h5>
                                            <p class="text-muted">
                                                <?php echo $career->description; ?>

                                            </p>
                                            <?php if(Count($tags) !== 0): ?>
                                                <div class="d-flex align-items-center mb-4">
                                                    <div class="flex-shrink-0">
                                                        <b>Tags:</b>
                                                    </div>

                                                    <div class="flex-grow-1 ms-2">
                                                        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <a href="<?php echo e(route('career-tips', ['tags' => $tag->title])); ?>"
                                                                class="badge bg-soft-success mt-1 fs-14"><?php echo e($tag->title); ?></a>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>

                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            </div><!--end row-->
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <div class="side-box">
                                <div class="sidebox-wrap">
                                    <div class="sidebox-title">
                                        <p>Related Career Tips</p>
                                    </div>
                                    <?php if(count($related_careers) !== 0): ?>
                                        <div class="categories-list">
                                            <ul class="same-company-job">
                                                <?php $__currentLoopData = $related_careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <a href="<?php echo e(route('career-details', $related_career->slug)); ?>"
                                                            class="flex-link">
                                                            <img src="<?php echo e(asset('storage/career/' . $related_career->image)); ?>"
                                                                class="img-fluid" alt="">
                                                            <div class="job-detail">
                                                                <span class="job-title"><?php echo e($related_career->title); ?></span>
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
            
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/career-single.blade.php ENDPATH**/ ?>