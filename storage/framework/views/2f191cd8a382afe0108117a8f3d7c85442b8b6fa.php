<?php $__env->startSection('title'); ?>
    <?php echo e('Blogs'); ?>

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
                                <h1 class="display-5 mb-3"> News And Announcements </h1>
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
                                <?php $__empty_1 = true; $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <div class="card blog-grid-box">
                                            <img src="<?php echo e(asset('storage/news_and_announcement/thumb_' . $data->image)); ?>"
                                                alt="<?php echo e($data->title); ?>" class="img-fluid">
                                            <div class="card-body">
                                                <ul class="list-inline d-flex justify-content-between mb-1">
                                                    <li class="list-inline-item">
                                                        <p class="text-muted mb-0"><a href="blog-author.html"
                                                                class="text-muted fw-medium"><?php echo e($data->author); ?></a> -
                                                            <?php echo e($data->created_at->toFormattedDateString()); ?></p>
                                                    </li>
                                                </ul>
                                                <a href="<?php echo e(route('newsAndAnnouncement.single', ['slug' => $data->slug])); ?>"
                                                    class="primary-link">
                                                    <h6 class="fs-22"><?php echo e($data->title); ?></h6>
                                                </a>
                                                <div>
                                                    <a href="<?php echo e(route('newsAndAnnouncement.single', ['slug' => $data->slug])); ?>"
                                                        class="form-text">Read More
                                                        <i class="uil uil-angle-right-b"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <div class="card blog-grid-box">
                                            <div class="card-body">
                                                No news and announcements to show
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>


                            </div>
                            <!--end row-->

                        </div>
                        <?php echo $__env->make('user.layout.rigth-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>

                </div>
            </section>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/news-and-announcement.blade.php ENDPATH**/ ?>