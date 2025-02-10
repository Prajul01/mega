<?php $__env->startSection('title'); ?><?php echo e('Faq'); ?> <?php $__env->stopSection(); ?>
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
            <div class="bg-overlay" style="background-image: url('<?php echo e(asset('frontend/assets/images/files/banner1.jpg')); ?>');"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center text-white mb-5">
                            <h1 class="display-5 mb-3">FAQ</h1>
                            <p class="fs-17">Mega Job is the perfect platform if you are looking for jobs and
                                also looking for candidates.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- End Home -->
        <!-- START FAQ-PAGE -->
        <?php if(count($faqs)>0): ?>
        <section class="section">
            <div class="container-fluid custom-container">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-4">
                        <ul class="faq-menu nav nav-fill nav-pills new-nav-tab" id="pills-tab" role="tablist">
                            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?php if($key==0): ?>active <?php endif; ?>" id="general-tab" data-bs-toggle="pill"
                                    data-bs-target="#generalTab<?php echo e($key); ?>" type="button" role="tab"
                                    aria-controls="generalTab" aria-selected="true">
                                  <?php echo e($faq->title); ?>

                                </button>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                   
                    <div class="col-lg-9 col-md-8">
                        <div class="tab-content" id="pills-tabContent">
                            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php 
                                $datas=json_decode($faq->sub_title);
                                $datas1=json_decode($faq->description);
                            ?>
                            <?php if(count($datas)>0): ?>
                            <div class="tab-pane fade show <?php if($key==0): ?>active <?php endif; ?>" id="generalTab<?php echo e($key); ?>" role="tabpanel"
                                aria-labelledby="general-tab">
                                <div class="col-lg-12">
                                    <div class="accordion accordion-flush faq-box" id="general">
                                        <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="accordion-item border-0">
                                            <h2 class="accordion-header" id="generalOne">
                                                <button class="accordion-button <?php if($k>0): ?> collapsed <?php endif; ?>" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#general-<?php echo e($k); ?>"
                                                    aria-expanded="true" aria-controls="general-one">
                                                    <?php echo e($data); ?>

                                                </button>
                                            </h2>
                                            <div id="general-<?php echo e($k); ?>" class="accordion-collapse collapse <?php if($k==0): ?> show <?php endif; ?>"
                                                aria-labelledby="generalOne" data-bs-parent="#general">
                                                <div class="accordion-body">
                                                    <?php echo e($datas1[$key]??''); ?>

                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div><!--end general-tab-->
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                      
                    </div>
                  
                </div>
            </div>
        </section>
        <?php endif; ?>
        <!-- END FAQ-PAGE -->
        <!-- START APPLY MODAL -->
        <div class="modal fade" id="applyNow" tabindex="-1" aria-labelledby="applyNow" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-5">
                        <div class="text-center mb-4">
                            <h5 class="modal-title" id="staticBackdropLabel">Apply For This Job</h5>
                        </div>
                        <div class="position-absolute end-0 top-0 p-3">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="mb-3">
                            <label for="nameControlInput" class="form-label">Name</label>
                            <input type="text" class="form-control" id="nameControlInput"
                                placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label for="emailControlInput2" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="emailControlInput2"
                                placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="messageControlTextarea" class="form-label">Message</label>
                            <textarea class="form-control" id="messageControlTextarea" rows="4"
                                placeholder="Enter your message"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="inputGroupFile01">Resume Upload</label>
                            <input type="file" class="form-control" id="inputGroupFile01">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Application</button>
                    </div>
                </div>
            </div>
        </div><!-- END APPLY MODAL -->

    </div>
    <!-- End Page-content --> 
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/faq.blade.php ENDPATH**/ ?>