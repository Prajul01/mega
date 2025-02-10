<?php $__env->startSection('title', 'Experience | Job Seeker'); ?>

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
                                                <i class="fa-solid fa-building-flag"></i>
                                            </span>
                                            Work Experience
                                        </div>
                                    </div>
                                    <div class="right-side-form">
                                        <div class="detail-form-content">
                                            <form
                                                action="<?php echo e(isset($check_experiance_info) ? route('user.update_experiance', auth()->user()->username) : route('user.store_experiance', auth()->user()->username)); ?>"
                                                class="mt-3" method="post">

                                                <div class="experience-info-body">
                                                    <div class="education-info">
                                                        <?php echo csrf_field(); ?>
                                                        <?php if(isset($check_experiance_info)): ?>
                                                            <?php echo method_field('put'); ?>
                                                        <?php endif; ?>
                                                        <?php
                                                            if (isset($check_experiance_info->position)) {
                                                                $position = json_decode($check_experiance_info->position);
                                                                $orginazation_name = json_decode($check_experiance_info->organization_name);
                                                                $industry = json_decode($check_experiance_info->industry);
                                                                $job_level = json_decode($check_experiance_info->job_level);
                                                                $left_year = json_decode($check_experiance_info->left_year);
                                                                $joined_year = json_decode($check_experiance_info->joined_year);
                                                                $roles_and_responsibility = json_decode($check_experiance_info->roles_and_responsibility);
                                                            }
                                                        ?>
                                                        <input type="hidden" name="check_experiance_info" value="3" />
                                                        <?php if(isset($position)): ?>
                                                            <?php $__currentLoopData = $position; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="education-info">

                                                                    <div class="education-heading">
                                                                        <div class="education-info-title">Experience</div>
                                                                        <div class="btn delete-btn">Delete</div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput"
                                                                                    class="form-label">Position
                                                                                    <span class="red">*</span></label>
                                                                                <input type="text" name="position[]"
                                                                                    id="name" class="form-control"
                                                                                    value="<?php echo e(old('position.*') ? old('position.*') : (isset($p) ? $p : '')); ?>">
                                                                                <?php $__errorArgs = ['position.*'];
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
                                                                        <!--end col-->
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput"
                                                                                    class="form-label">Organization name
                                                                                    <span class="red">*</span></label>
                                                                                <input type="text"
                                                                                    name="organization_name[]"
                                                                                    id="name" class="form-control"
                                                                                    value="<?php echo e(old('organization_name.*') ? old('organization_name.*') : (isset($orginazation_name[$key]) ? $orginazation_name[$key] : '')); ?>">
                                                                                <?php $__errorArgs = ['organization_name.*'];
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
                                                                        <!--end col-->
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput"
                                                                                    class="form-label">Industry<span
                                                                                        class="red">*</span></label>
                                                                                <select class="form-control field-industry"
                                                                                    name="industry[]">
                                                                                    <option selected="selected"
                                                                                        value="">
                                                                                        --select--
                                                                                    </option>
                                                                                    <?php $__currentLoopData = $company; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $com): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <option value="<?php echo e($com->id); ?>"
                                                                                            <?php echo e($com->id == $industry[$key] ? 'selected' : ''); ?>>
                                                                                            <?php echo e($com->title); ?>

                                                                                        </option>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                                                </select>
                                                                                <?php $__errorArgs = ['industry.*'];
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
                                                                        <!--end col-->
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput"
                                                                                    class="form-label">Job
                                                                                    Level<span
                                                                                        class="red">*</span></label>
                                                                                <select class="form-control field-industry"
                                                                                    name="job_level[]">
                                                                                    <option selected="selected"
                                                                                        value="">
                                                                                        --select--
                                                                                    </option>
                                                                                    <?php $__currentLoopData = $job_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <option value="<?php echo e($level->id); ?>"
                                                                                            <?php echo e($level->id == $job_level[$key] ? 'selected' : ''); ?>>
                                                                                            <?php echo e($level->title); ?></option>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </select>
                                                                                <?php $__errorArgs = ['job_level.*'];
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
                                                                        <!--end col-->
                                                                        <div class="col-lg-12">
                                                                            <div class="mb-3">
                                                                                <label for="meassageInput"
                                                                                    class="form-label"></label>
                                                                                Roles and responsibility<span
                                                                                    class="red">*</span></label>
                                                                                <textarea class="form-control" id="meassageInput" placeholder="Enter  Your Career Objective" name="comments[]"
                                                                                    id="comments" rows="5"><?php echo e(old('comments.*') ? old('comments.*') : (isset($roles_and_responsibility[$key]) ? $roles_and_responsibility[$key] : '')); ?></textarea>
                                                                                <?php $__errorArgs = ['comments.*'];
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
                                                                        <!--end col-->
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput"
                                                                                    class="form-label">Joined
                                                                                    Year <span
                                                                                        class="red">*</span></label>
                                                                                <input type="text" name="joined_year[]"
                                                                                    id="name" class="form-control"
                                                                                    value="<?php echo e(old('joined_year.*') ? old('joined_year.*') : (isset($joined_year[$key]) ? $joined_year[$key] : '')); ?>">
                                                                                <?php $__errorArgs = ['joined_year.*'];
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
                                                                        <!--end col-->
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="nameInput"
                                                                                    class="form-label">Left
                                                                                    Year <span
                                                                                        class="red">*</span></label>
                                                                                <input type="text" name="lefted_year[]"
                                                                                    id="name" class="form-control"
                                                                                    value="<?php echo e(old('lefted_year.*') ? old('lefted_year.*') : (isset($left_year[$key]) ? ($left_year[$key] == 'Currently Working' ? '' : $left_year[$key]) : '')); ?>">
                                                                                <?php $__errorArgs = ['lefted_year.*'];
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
                                                                        <!--end col-->
                                                                        <div class="col-12">
                                                                            <label for="current"><input type="checkbox"
                                                                                    name="currently_working[]"
                                                                                    id="current"
                                                                                    value="Currently Working"
                                                                                    <?php echo e(isset($left_year[$key]) ? ($left_year[$key] == 'Currently Working' ? 'checked' : '') : ''); ?>>
                                                                                I am currently working here</label>
                                                                            <?php $__errorArgs = ['current_working.*'];
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
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                            <div class="education-info">
                                                                <div class="education-heading">
                                                                    <div class="education-info-title">Experience</div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput"
                                                                                class="form-label">Position
                                                                                <span class="red">*</span></label>
                                                                            <input type="text" name="position[]"
                                                                                id="name" class="form-control"
                                                                                value="<?php echo e(old('position.*')); ?>">
                                                                            <?php $__errorArgs = ['position.*'];
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
                                                                    <!--end col-->
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput"
                                                                                class="form-label">Organization name
                                                                                <span class="red">*</span></label>
                                                                            <input type="text"
                                                                                name="organization_name[]" id="name"
                                                                                class="form-control"
                                                                                value="<?php echo e(old('organization_name.*')); ?>">
                                                                            <?php $__errorArgs = ['organization_name.*'];
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
                                                                    <!--end col-->
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput"
                                                                                class="form-label">Industry<span
                                                                                    class="red">*</span></label>
                                                                            <select class="form-control field-industry"
                                                                                name="industry[]">
                                                                                <option selected="selected"
                                                                                    value="">--select--
                                                                                </option>
                                                                                <?php $__currentLoopData = $company; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $com): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <option value="<?php echo e($com->id); ?>"
                                                                                        <?php echo e($com->id == old('industry') ? 'selected' : ''); ?>>
                                                                                        <?php echo e($com->title); ?>

                                                                                    </option>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                                            </select>
                                                                            <?php $__errorArgs = ['industry.*'];
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
                                                                    <!--end col-->
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput" class="form-label">Job
                                                                                Level<span class="red">*</span></label>
                                                                            <select class="form-control field-industry"
                                                                                name="job_level[]">
                                                                                <option selected="selected"
                                                                                    value="">--select--
                                                                                </option>
                                                                                <?php $__currentLoopData = $job_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <option value="<?php echo e($level->id); ?>"
                                                                                        <?php echo e($level->id == old('job_level') ? 'selected' : ''); ?>>
                                                                                        <?php echo e($level->title); ?></option>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </select>
                                                                            <?php $__errorArgs = ['job_level.*'];
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
                                                                    <!--end col-->
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3">
                                                                            <label for="meassageInput"
                                                                                class="form-label"></label>
                                                                            Roles and responsibility<span
                                                                                class="red">*</span></label>
                                                                            <textarea class="form-control" id="meassageInput" placeholder="Enter  Your Career Objective" name="comments[]"
                                                                                id="comments" rows="5"><?php echo e(old('comments.*')); ?></textarea>
                                                                            <?php $__errorArgs = ['comments.*'];
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
                                                                    <!--end col-->
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput"
                                                                                class="form-label">Joined
                                                                                Year <span class="red">*</span></label>
                                                                            <input type="text" name="joined_year[]"
                                                                                id="name" class="form-control"
                                                                                value="<?php echo e(old('joined_year.*')); ?>">
                                                                            <?php $__errorArgs = ['joined_year.*'];
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
                                                                    <!--end col-->
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="nameInput" class="form-label">Left
                                                                                Year <span class="red">*</span></label>
                                                                            <input type="text" name="lefted_year[]"
                                                                                id="name" class="form-control"
                                                                                value="<?php echo e(old('lefted_year.*')); ?>">
                                                                            <?php $__errorArgs = ['lefted_year.*'];
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
                                                                    <!--end col-->
                                                                    <div class="col-12">
                                                                        <label for="current"><input type="checkbox"
                                                                                name="current_working[]" id="current"
                                                                                value="Currently Working"
                                                                                <?php echo e(old('current_working.*') ? 'checked' : ''); ?>>
                                                                            I am currently working here</label>
                                                                        <?php $__errorArgs = ['current_working.*'];
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
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="education-footer-btn">
                                                    <div class="text-left">
                                                        <button id="add-experience" type="button"
                                                            class="btn btn-outline-danger">
                                                            Add More <span class="icon"><i
                                                                    class="fa-solid fa-plus"></i></span> </button>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" id="submit" name="submit"
                                                            class="btn btn-primary">
                                                            Save Experience </button>
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

        



        $("#menu-dropdown").click(function() {
            $(".mobile-dropdown").toggleClass("menu-toggle");
        });

        $("#editPreference").click(function() {
            $(this).addClass("d-none");
            $(".right-side-content").addClass("d-none");
            $(".right-side-form").removeClass("d-none");
        });

        $(".experience-info-body").on("click", ".delete-btn", function() {
            $(this).closest(".education-info").remove();
        });

        $("#add-experience").click(function() {
            $(".experience-info-body").append(
                `<div class="education-info"><div class="education-heading"><div class="education-info-title">Experience</div><div class="btn delete-btn">Delete</div></div> <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nameInput" class="form-label">Position
                                                    <span class="red">*</span></label>
                                                <input type="text" name="position[]" id="name"
                                                    class="form-control">
                                                <?php $__errorArgs = ['position.*'];
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
                                        <!--end col-->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nameInput" class="form-label">Organization name
                                                    <span class="red">*</span></label>
                                                <input type="text" name="organization_name[]" id="name"
                                                    class="form-control" >
                                                <?php $__errorArgs = ['organization_name.*'];
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
                                        <!--end col-->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nameInput" class="form-label">Industry<span
                                                        class="red">*</span></label>
                                                <select class="form-control field-industry" name="industry[]">
                                                    <option selected="selected" value="">--select--
                                                    </option>
                                                    <?php $__currentLoopData = $company; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $com): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($com->id); ?>"><?php echo e($com->title); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </select>
                                                <?php $__errorArgs = ['industry.*'];
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
                                        <!--end col-->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nameInput" class="form-label">Job Level<span
                                                        class="red">*</span></label>
                                                <select class="form-control field-industry" name="job_level[]">
                                                    <option selected="selected" value="">--select--
                                                    </option>
                                                    <?php $__currentLoopData = $job_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($level->id); ?>"><?php echo e($level->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['job_level.*'];
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
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="meassageInput" class="form-label"></label>
                                                Roles and responsibility<span class="red">*</span></label>
                                                <textarea class="form-control" id="meassageInput" placeholder="Enter  Your Career Objective" name="comments[]"
                                                    id="comments" rows="5"></textarea>
                                                    <?php $__errorArgs = ['comments.*'];
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
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="nameInput" class="form-label">Joined
                                                    Year <span class="red">*</span></label>
                                                <input type="text" name="joined_year[]" id="name"
                                                    class="form-control" value="">
                                                    <?php $__errorArgs = ['joined_year.*'];
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
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="nameInput" class="form-label">Left
                                                    Year <span class="red">*</span></label>
                                                <input type="text" name="lefted_year[]" id="name"
                                                    class="form-control" value="">
                                                    <?php $__errorArgs = ['lefted_year.*'];
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
                                        <!--end col-->
                                        <div class="col-12">
                                            <label for="current"><input type="checkbox" name="current_working[]"
                                                    id="current" value="1">
                                                I am currently working here</label>
                                                <?php $__errorArgs = ['current_working.*'];
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
                                    </div><hr></div>`
            )
        })

        $(".profile-icon").on("click", function() {
            $(".mobile-profile-check").toggleClass("profile-check-toggle");
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/jobseeker/seeker-experience.blade.php ENDPATH**/ ?>