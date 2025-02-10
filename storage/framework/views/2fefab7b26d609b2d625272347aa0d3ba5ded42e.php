<?php $__env->startSection('content'); ?>
    <?php
    $concerns = App\Models\AreaOfConcern::where('display',1)
        ->orderBy('order_no')
        ->get();
    ?>
    <div class="page-content">
        <!-- START HOME -->
        <section class="bg-home inner-page" id="home">
            <div class="bg-overlay" style="background-image: url('<?php echo e(asset('frontend/assets/images/files/banner1.jpg')); ?>');">
            </div>
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
                    <div class="col-lg-8 offset-lg-2">
                        <div class="section-title bg-white mt-4 contact-form-wrapper new-form-wrapper mt-lg-0">
                            <h3 class="title">
                                Report a Problem</h3>
                            <p class="text-muted"> If
                                you wish to know more about our services or if you need our help in any matter,
                                please fill in the form below and we will revert to the specified email address
                                in 48 hours.</p>
                            <form method="post" action="<?php echo e(route('issueReported')); ?>" onsubmit="return validateForm()"
                                class="contact-form mt-4" name="myForm" id="myForm">
                                <?php echo csrf_field(); ?>
                                <span id="error-msg"></span>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nameInput" class="form-label">Name</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Enter your name" value="<?php echo e(old('name')); ?>" required>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="emaiol" name="email"
                                                placeholder="Enter your email" value="<?php echo e(old('email')); ?>" required>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nameInput" class="form-label">Phone Number</label>
                                            <input type="tel" name="phone_no" id="phone_no" class="form-control"
                                                placeholder="Enter your Number" value="<?php echo e(old('phone_no')); ?>" required>
                                        </div>
                                    </div><!--end col-->


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="subjectInput" class="form-label">Subject</label>
                                            <input type="text" class="form-control" id="subjectInput" name="subject"
                                                id="subject" placeholder="Enter your subject" value="<?php echo e(old('subject')); ?>" required>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Area of Concern:</label>
                                            <select name="area_of_concern" id="" class="form-control" required>
                                                <option value="" selected disabled>Select Any Available Option
                                                </option>
                                                <?php $__currentLoopData = $concerns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $concern): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e(base64_encode($concern->id)); ?>" <?php echo e(old('area_of_concern') == base64_encode($concern->id)? 'selected': ''); ?>>
                                                        <?php echo e($concern->concern); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="meassageInput" class="form-label">Details of
                                                Concern:</label>
                                            <textarea class="form-control" id="meassageInput" placeholder="Enter your message" name="details" id="details"
                                                rows="5" required><?php echo e(old('details')); ?></textarea>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                                <div class="text-left">
                                    <button type="submit" id="submit" name="submit" class="btn btn-primary">
                                        Submit Report <i class="uil uil-message ms-1"></i></button>
                                </div>
                            </form><!--end form-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/report-issue.blade.php ENDPATH**/ ?>