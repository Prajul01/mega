<?php $__env->startSection('title'); ?> <?php echo e($tender->title); ?> <?php $__env->stopSection(); ?>
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
        <section class="bg-home" id="home">
            <?php echo $__env->make('user.layout.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--end container-->
        </section>
        <!-- End Home -->
        <section class="home-jobs-wrapper bg-light">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-lg-9 col-md-8">

                        <div class="tender-details">
                            <div class="tender-detail-title">
                              <?php echo e($tender->title); ?>

                            </div>
                            <div class="tender-detail-desc">
                               <?php echo $tender->description; ?>

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
                                        <?php if(count($similar_tenders)!==0): ?>
                                        <?php $__currentLoopData = $similar_tenders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similar_tender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('tender_details',['tender'=> $similar_tender->slug])); ?>">
                                            <?php echo e($similar_tender->title); ?>

                                        </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                            <div class="tender-categories">
                                <div class="categories-header">
                                    Tender Types
                                </div>
                                <div class="categories-list">
                                    <div class="tender-list">
                                        <?php if(count($tender_types)!==0): ?>
                                        <?php $__currentLoopData = $tender_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tender_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('tender',['type'=>$tender_type->slug])); ?>">
                                           <?php echo e($tender_type->title); ?>

                                        </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/tender_single.blade.php ENDPATH**/ ?>