<?php $__env->startSection('title', 'Social Account | Job Seeker'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content">

        <div class="page-content">
            <!-- START CANDIDATE-DETAILS -->
            <section class="section dashboard-section">
                <div class="container-fluid custom-container">
                    <div class="row">

                        <?php echo $__env->make('user.jobseeker.layouts.profile_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                        <div class="col-lg-9 col-md-8">
                            <div class="card candidate-info new-shadow-sidebar mt-0 mb-3 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="right-side-top-bar">
                                        <div class="right-top-title">
                                            <span class="icon-top">
                                                <i class="fa-solid fa-share-nodes"></i>
                                            </span>
                                            Social Account
                                        </div>
                                    </div>

                                    <div class="right-side-form social-card">
                                        <div class="detail-form-content">
                                            <?php
                                                if (isset($job_seeker_social_networks->social_name)) {
                                                    $social_name = json_decode($job_seeker_social_networks->social_name);
                                                }
                                                if (isset($job_seeker_social_networks->social_url)) {
                                                    $social_url = json_decode($job_seeker_social_networks->social_url);
                                                }
                                            ?>
                                            <form
                                                action="<?php echo e(isset($job_seeker_social_networks) ? route('user.update_social', auth()->user()->username) : route('user.store_social', auth()->user()->username)); ?>"
                                                method="post">
                                                <?php echo csrf_field(); ?>
                                                <?php if(isset($job_seeker_social_networks)): ?>
                                                    <?php echo method_field('put'); ?>
                                                <?php endif; ?>
                                                <?php if(isset($job_seeker_social_networks)): ?>
                                                    <div class="education-info shadow-sidebar p-2 r-5 mb-2">

                                                        <div class="social-info-body">
                                                            <?php $__currentLoopData = $social_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="social-info">
                                                                    <div class="education-heading">
                                                                        <div class="education-info-title mb-0 px-1 pt-2">
                                                                            Social
                                                                            Account</div>
                                                                        <div class="fs-18"></div>
                                                                        <div class="btn delete-btn">Delete</div>
                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput"
                                                                                    class="form-label">Social
                                                                                    Account
                                                                                    Name
                                                                                </label>
                                                                                <input type="text" name="social_name[]"
                                                                                    id="name" class="form-control"
                                                                                    required
                                                                                    value="<?php echo e(old('social_name.*', $social)); ?>">
                                                                                <?php $__errorArgs = ['social_name.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                    <span
                                                                                        class="text-danger"><?php echo e($message); ?></span>
                                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput" class="form-label">
                                                                                    Profile Url </label>
                                                                                <input type="text" name="profile_url[]"
                                                                                    id="name" class="form-control"
                                                                                    required
                                                                                    value="<?php echo e(old('profile_url.*', $social_url[$key])); ?>">
                                                                                <?php $__errorArgs = ['profile_url.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                    <span
                                                                                        class="text-danger"><?php echo e($message); ?></span>
                                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>

                                                    </div>
                                                <?php else: ?>
                                                    <div class="education-info shadow-sidebar p-2 r-5 mb-2">
                                                        <div class="social-info-body">
                                                            <div class="social-info">
                                                                <div class="education-heading">
                                                                    <div class="education-info-title mb-0 px-1 pt-2">Add
                                                                        Social
                                                                        Network</div>
                                                                    <div class="fs-18"></div>

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput" class="form-label">Social
                                                                                Account
                                                                                Name
                                                                            </label>
                                                                            <input type="text" name="social_name[]"
                                                                                id="name" class="form-control" required
                                                                                value="">
                                                                            <?php $__errorArgs = ['social_name.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                <span
                                                                                    class="text-danger"><?php echo e($message); ?></span>
                                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput" class="form-label">
                                                                                Profile Url </label>
                                                                            <input type="text" name="profile_url[]"
                                                                                id="name" class="form-control" required
                                                                                value="">
                                                                            <?php $__errorArgs = ['profile_url.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                <span
                                                                                    class="text-danger"><?php echo e($message); ?></span>
                                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <hr>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="education-footer-btn mt-2">
                                                    <div class="text-left">
                                                        <button id="add-social" type="button" type="button"
                                                            class="btn btn-outline-danger">
                                                            Add More <span class="icon"><i
                                                                    class="fa-solid fa-plus"></i></span>
                                                        </button>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" id="submit" name="submit"
                                                            class="btn btn-primary">
                                                            Save Account </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
        <!-- End Page-content -->
    </div>
    <!-- End Page-content -->

    <!--start back-to-top-->
    <button onclick="topFunction()" id="back-to-top">
        <i class="mdi mdi-arrow-up"></i>
    </button>
    <!--end back-to-top-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/jquery.star-rating-svg.js"></script>

    <script>
        $(document).scroll(function() {
            var y = $(this).scrollTop();
            if (y > 300) {
                $('.footer-fixed').addClass("add-sticky");
            } else {
                $('.footer-fixed').removeClass("add-sticky");
            }
        });


        $(".see-more").click(function() {
            $(this).siblings(".checkbox-list").addClass('more-view');
            $(this).siblings(".see-less").removeClass('d-none');
            $(this).addClass('d-none');
        });
        $(".see-less").click(function() {
            $(this).siblings(".checkbox-list").removeClass('more-view');
            $(this).siblings(".see-more").removeClass('d-none');
            $(this).addClass('d-none');
        });

        $(".field-study, .field-industry").select2({
            tags: true
        });





        $(".social-info-body").on("click", ".delete-btn", function() {
            $(this).closest(".social-info").remove();
        });

        $("#menu-dropdown").click(function() {
            $(".mobile-dropdown").toggleClass("menu-toggle");
        });

        $("#editPreference").click(function() {
            $(this).addClass("d-none");
            $(".right-side-content").addClass("d-none");
            $(".right-side-form").removeClass("d-none");
        });


        $("#add-social").click(function() {
            $(".social-info-body").append(
                ` <div class="social-info">
                                                                <div class="education-heading">
                                                                    <div class="education-info-title mb-0 px-1 pt-2">Add
                                                                        Social
                                                                        Network</div>
                                                                    <div class="fs-18"></div><div class="btn delete-btn">Delete</div>

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput" class="form-label">Social
                                                                                Account
                                                                                Name
                                                                            </label>
                                                                            <input type="text" name="social_name[]"
                                                                                id="name" class="form-control" required
                                                                                value="">
                                                                            <?php $__errorArgs = ['social_name.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                <span
                                                                                    class="text-danger"><?php echo e($message); ?></span>
                                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput" class="form-label">
                                                                                Profile Url </label>
                                                                            <input type="text" name="profile_url[]"
                                                                                id="name" class="form-control" required
                                                                                value="">
                                                                            <?php $__errorArgs = ['profile_url.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                <span
                                                                                    class="text-danger"><?php echo e($message); ?></span>
                                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <hr>
                                                            </div>`
            )
        })

        $(function() {
            $(".my-rating-4").starRating({
                totalStars: 5,
                starShape: 'rounded',
                starSize: 25,
                emptyColor: 'transparent',
                hoverColor: '#ECD59F',
                activeColor: '#FFD700',
                disableAfterRate: false,
                readOnly: false,
                useGradient: false
            });
        });

        $(".profile-icon").on("click", function() {
            $(".mobile-profile-check").toggleClass("profile-check-toggle");
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/jobseeker/seeker-social-account.blade.php ENDPATH**/ ?>