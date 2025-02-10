<?php $__env->startSection('title'); ?><?php echo e('Terms And Conditions'); ?> <?php $__env->stopSection(); ?>
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

<div class="page-content">

    <!-- START HOME -->
    <section class="bg-home inner-page" id="home">
        <div class="bg-overlay"
            style="background-image: url('<?php echo e(asset('frontend/assets/images/files/banner1.jpg')); ?>');"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center text-white mb-5">
                        <h1 class="display-5 mb-3"> Terms And Conditions </h1>
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
                <?php echo $terms->description; ?>

            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/terms.blade.php ENDPATH**/ ?>