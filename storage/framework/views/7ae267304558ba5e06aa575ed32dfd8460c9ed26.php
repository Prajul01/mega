<?php $__env->startSection('title'); ?>Career Tips <?php $__env->stopSection(); ?>
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
            <div class="bg-overlay" style="background-image: url(<?php echo e(asset('frontend/assets/images/files/banner1.jpg')); ?>);"></div>
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
                    <?php $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card blog-grid-box">
                            <img src="<?php echo e(asset('storage/career/thumb_'.$career->image)); ?>" alt="" class="img-fluid">
                            <div class="card-body">
                                <ul class="list-inline d-flex justify-content-between mb-1">
                                    <li class="list-inline-item">
                                        <p class="text-muted mb-0"><a href="<?php echo e(route('career-details',['career'=>$career->slug])); ?>"
                                                class="text-muted fw-medium"><?php echo e($career->author); ?></a> - <?php echo e($career->created_at->toFormattedDateString()); ?></p>
                                    </li>
                                </ul>
                                <a href="<?php echo e(route('career-details',['career'=>$career->slug])); ?>" class="primary-link">
                                    <h6 class="fs-22"><?php echo e($career->title); ?></h6>
                                </a>
                                <div>
                                    <a href="<?php echo e(route('career-details',['career'=>$career->slug])); ?>" class="form-text">Read More
                                        <i class="uil uil-angle-right-b"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>
        </section>

    </div>
    <!-- End Page-content -->
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/career_tips.blade.php ENDPATH**/ ?>