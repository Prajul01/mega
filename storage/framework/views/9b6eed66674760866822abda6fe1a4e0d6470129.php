<?php $__env->startSection('title'); ?>
    <?php echo e('Contact Us'); ?>

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
                                <h1 class="display-5 mb-3"> Contact Us </h1>
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
                        <div class="col-lg-8">
                            <div class="section-title bg-white mt-4 contact-form-wrapper mt-lg-0">
                                <h3 class="title">Get in touch</h3>
                                <p class="text-muted">Start working with Jobcy that can provide everything you need
                                    to generate
                                    awareness, drive traffic, connect.</p>
                                <form method="post" class="contact-form mt-4" name="myForm" id="myForm"
                                    action="<?php echo e(route('contact.store')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="nameInput" class="form-label">Full Name</label>
                                                <input type="text" name="full_name" id="name"
                                                    value="<?php echo e(old('full_name')); ?>" class="form-control"
                                                    placeholder="Enter your full name">
                                                <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="nameInput" class="form-label">Phone Number</label>
                                                <input type="text" name="phone_number" value="<?php echo e(old('phone_number')); ?>"
                                                    id="name" class="form-control" placeholder="Enter your Number">
                                                <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="emailInput" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Enter your email" value="<?php echo e(old('email')); ?>">
                                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="subjectInput" class="form-label">Subject</label>
                                                <input type="text" class="form-control" id="subjectInput" name="subject"
                                                    id="subject" value="<?php echo e(old('subject')); ?>"
                                                    placeholder="Enter your subject">
                                                <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="meassageInput" class="form-label">Your Message</label>
                                                <textarea class="form-control" id="meassageInput" placeholder="Enter your message" name="message" id="comments"
                                                    rows="5"><?php echo e(old('message')); ?></textarea>
                                                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                    <?php if(config('services.recaptcha.site_key')): ?>
                                        <div class="g-recaptcha mb-2"
                                            data-sitekey="<?php echo e(config('services.recaptcha.site_key')); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="text-left">
                                        <button type="submit" id="submit" class="btn btn-primary">
                                            Send Message <i class="uil uil-message ms-1"></i></button>
                                    </div>
                                </form><!--end form-->
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-4">
                            <div class="contact-info">

                                <div class="contact-info-heading">
                                    <div class="contact-info-title">
                                        Contact Information
                                    </div>
                                    <div class="contact-info-desc">
                                        Start working with Jobcy that can provide everything you need to generate
                                        awareness, drive traffic, connect.
                                    </div>
                                </div>


                                <div class="contact-detail">
                                    <div class="contact-icon">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <div class="contact-link">
                                        <div class="link-title">
                                            Email Address
                                        </div>

                                        <div class="link-link">
                                            <a href="mailto: <?php echo e(isset($setting->site_email) ? $setting->site_email : ''); ?>">
                                                <?php echo e(isset($setting->site_email) ? $setting->site_email : ''); ?>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="contact-detail">
                                    <div class="contact-icon">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <div class="contact-link">
                                        <div class="link-title">
                                            Phone Numebr
                                        </div>

                                        <div class="link-link">
                                            <a href="tel: <?php echo e(isset($setting->mobile) ? $setting->mobile : ''); ?>">
                                                <?php echo e(isset($setting->mobile) ? $setting->mobile : ''); ?>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="contact-detail">
                                    <div class="contact-icon">
                                        <i class="fa-solid fa-location-dot"></i>

                                    </div>
                                    <div class="contact-link">
                                        <div class="link-title">
                                            Location
                                        </div>

                                        <div class="link-link">
                                            <a href="javascript:void(0)" target="_blank">
                                                <?php echo e(isset($setting->address) ? $setting->address : ''); ?>

                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="social-link">
                                    <div class="social-link-title">
                                        Follow Us On :
                                    </div>
                                    <ul class="footer-social-menu list-inline mb-0">
                                        <li class="list-inline-item facebook"><a target="_blank"
                                                href="<?php echo e(isset($setting->facebook_url) ? $setting->facebook_url : ''); ?>"><i
                                                    class="uil uil-facebook-f"></i></a>
                                        </li>
                                        <li class="list-inline-item linkedin"><a target="_blank"
                                                href="<?php echo e(isset($setting->linkedin_url) ? $setting->linkedin_url : ''); ?>"><i
                                                    class="uil uil-linkedin"></i></a>
                                        </li>
                                        <li class="list-inline-item instagram"><a target="_blank"
                                                href="<?php echo e(isset($setting->instagram_url) ? $setting->instagram_url : ''); ?>"><i
                                                    class="uil uil-instagram"></i></a>
                                        </li>
                                        <li class="list-inline-item twitter"><a target="_blank"
                                                href="<?php echo e(isset($setting->twitter_url) ? $setting->twitter_url : ''); ?>"><i
                                                    class="uil uil-twitter"></i></a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="map">
                <iframe
                    src="<?php echo e(isset($setting->googlemap_url) ? $setting->googlemap_url : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6509157.364974411!2d-123.79641389801948!3d37.193115265681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb9fe5f285e3d%3A0x8b5109a227086f55!2sCalifornia%2C%20USA!5e0!3m2!1sen!2sin!4v1628684675253!5m2!1sen!2sin'); ?>"
                    height="470" style="border:0;width: 100%;" allowfullscreen="" loading="lazy"></iframe>
            </div>


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
                                <textarea class="form-control" id="messageControlTextarea" rows="4" placeholder="Enter your message"></textarea>
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

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/contact.blade.php ENDPATH**/ ?>