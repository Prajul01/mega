<?php $__env->startSection('title', 'Training | Job Seeker'); ?>

<?php $__env->startSection('content'); ?>

    <div class="main-content">

        <div class="page-content">
            <!-- START CANDIDATE-DETAILS -->
            <section class="section dashboard-section">
                <div class="container-fluid custom-container">
                    <div class="row">

                        <?php echo $__env->make('user.jobseeker.layouts.profile_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <div class="col-lg-9 col-md-8">
                            <?php
                                if (isset($job_seeker_training->training_title)) {
                                    $training_title = json_decode($job_seeker_training->training_title);
                                }
                                if (isset($job_seeker_training->training_year)) {
                                    $training_year = json_decode($job_seeker_training->training_year);
                                }
                                if (isset($job_seeker_training->training_institution)) {
                                    $training_institution = json_decode($job_seeker_training->training_institution);
                                }
                            ?>

                            <div class="card candidate-info new-shadow-sidebar mt-0 mb-3 mt-lg-0">
                                <form
                                    action="<?php echo e(isset($training_title) ? route('user.update_training', auth()->user()->username) : route('user.store_training', auth()->user()->username)); ?>"
                                    method="post" class="mt-3">
                                    <?php echo csrf_field(); ?>
                                    <?php if(isset($training_title)): ?>
                                        <?php echo method_field('put'); ?>
                                    <?php endif; ?>
                                    <div class="card-body p-3">
                                        <div class="right-side-top-bar">
                                            <div class="right-top-title">
                                                <span class="icon-top">
                                                    <i class="fa-solid fa-person-chalkboard"></i>
                                                </span>
                                                Training
                                            </div>
                                        </div>

                                        <div class="right-side-form">
                                            <div class="detail-form-content">
                                                <?php if(isset($training_title)): ?>

                                                    <div class="training-info-body">
                                                        <?php $__currentLoopData = $training_title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $training): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="training-info">
                                                                <div class="education-heading">
                                                                    <div class="education-info-title mb-0 px-1 pt-2">
                                                                    </div>
                                                                    <div class="btn delete-btn">Delete</div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput" class="form-label">Title
                                                                                <span class="text-danger">*</span>
                                                                            </label>
                                                                            <input type="text" name="traning_title[]"
                                                                                id="name" class="form-control"
                                                                                value="<?php echo e(old('traning_title.*', $training)); ?>"
                                                                                required>
                                                                            <?php $__errorArgs = ['traning_title.*'];
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
                                                                                Year <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" name="traning_year[]"
                                                                                id="name" class="form-control"
                                                                                value="<?php echo e(old('traning_year.*', $training_year[$key])); ?>"
                                                                                required>
                                                                            <?php $__errorArgs = ['traning_year.*'];
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
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput" class="form-label">
                                                                                Institution <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" name="institution_name[]"
                                                                                id="name" class="form-control"
                                                                                value="<?php echo e(old('institution_name.*', $training_institution[$key])); ?>"
                                                                                required>
                                                                            <?php $__errorArgs = ['institution_name.*'];
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
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="training-info-body">
                                                        <div class="training-info">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="nameInput" class="form-label">Title
                                                                            <span class="text-danger">*</span>
                                                                        </label>
                                                                        <input type="text" name="traning_title[]"
                                                                            id="name" class="form-control required"
                                                                            value="<?php echo e(old('traning_title.*')); ?>" required>
                                                                        <?php $__errorArgs = ['traning_title.*'];
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
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="nameInput" class="form-label">
                                                                            Year <span class="text-danger">*</span></label>
                                                                        <input type="text" name="traning_year[]"
                                                                            id="name" class="form-control"
                                                                            value="<?php echo e(old('traning_year.*')); ?>" required>
                                                                        <?php $__errorArgs = ['traning_year.*'];
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
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label for="nameInput" class="form-label">
                                                                            Institution <span class="text-danger">*</span>
                                                                        </label>
                                                                        <input type="text" name="institution_name[]"
                                                                            id="name" class="form-control"
                                                                            value="<?php echo e(old('institution_name.*')); ?>"
                                                                            required>
                                                                        <?php $__errorArgs = ['institution_name.*'];
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
                                                <?php endif; ?>

                                                <div class="education-footer-btn">
                                                    <div class="text-left">
                                                        <a href="javascript:void(0)" id="add-training" name="submit"
                                                            class="btn btn-outline-danger">
                                                            Add More <span class="icon"><i
                                                                    class="fa-solid fa-plus"></i></span>
                                                        </a>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" id="submit" name="submit"
                                                            class="btn btn-primary">
                                                            Save Training </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
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



<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(".field-study, .field-industry").select2({
            tags: true
        });

        // $(".delete-btn").click(function () {
        //     $(this).closest(".education-info").remove();
        // });

        $("#menu-dropdown").click(function() {
            $(".mobile-dropdown").toggleClass("menu-toggle");
        });

        $("#editPreference").click(function() {
            $(this).addClass("d-none");
            $(".right-side-content").addClass("d-none");
            $(".right-side-form").removeClass("d-none");
        });

        $(".detail-form-content").on("click", ".delete-btn", function() {
            $(this).closest(".training-info").remove();
        });
        $("#add-training").click(function() {
            $(".training-info-body").append(
                `<div class="training-info">
                <div class="education-heading">
                <div class="fs-18">Add Training</div>
                <div class="btn delete-btn">Delete</div>
                </div>
                 <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="nameInput" class="form-label">Title <span class="text-danger">*</span>
                                                                        </label>
                                                                        <input type="text" name="traning_title[]"
                                                                            id="name" class="form-control"
                                                                            value="<?php echo e(old('traning_title.*')); ?>" required>
                                                                        <?php $__errorArgs = ['traning_title.*'];
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
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label for="nameInput" class="form-label">
                                                                            Year <span class="text-danger">*</span></label>
                                                                        <input type="text" name="traning_year[]"
                                                                            id="name" class="form-control"
                                                                            value="<?php echo e(old('traning_year.*')); ?>" required>
                                                                        <?php $__errorArgs = ['traning_year.*'];
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
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="mb-3">
                                                                        <label for="nameInput" class="form-label">
                                                                            Institution <span class="text-danger">*</span></label>
                                                                        <input type="text" name="institution_name[]"
                                                                            id="name" class="form-control"
                                                                            value="<?php echo e(old('institution_name.*')); ?>" required>
                                                                        <?php $__errorArgs = ['institution_name.*'];
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
                                                            <hr><hr></div>`
            )
        });
        $(".profile-icon").on("click", function() {
            $(".mobile-profile-check").toggleClass("profile-check-toggle");
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/jobseeker/seeker-training.blade.php ENDPATH**/ ?>