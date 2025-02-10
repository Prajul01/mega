<?php $__env->startSection('title', 'Profile | Job Seeker'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content">

        <div class="page-content">
            <!-- START CANDIDATE-DETAILS -->
            <section class="section dashboard-section">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <?php echo $__env->make('user.jobseeker.layouts.profile_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <div class="col-lg-9 col-md-8">
                            <div class="card candidate-info new-shadow-sidebar mt-4 mb-3 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="right-side-top-bar">
                                        <div class="right-top-title">
                                            <span class="icon-top">
                                                <i class="fa-solid fa-briefcase"></i>
                                            </span>

                                            Job Preference
                                        </div>
                                        <div class="right-top-button">
                                            <a href="javascript:void(0)" name="submit" id="editPreference"
                                                class="btn btn-primary btn-hover"><span class="icon-top">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </span><span class="mobile-none">Edit career & Objectives</span></a>
                                        </div>
                                    </div>
                                    <?php
                                    $preferedJobs = isset($job_seeker_personal_info) ? $job_seeker_personal_info->preferedJobs->pluck('id')->toArray() : [];
                                    ?>
                                    <div
                                        class="right-side-content <?php echo e(isset($job_seeker_personal_info) && $preferedJobs != [] ? '' : 'd-none'); ?>">

                                        <div class="side-content-title">
                                            Career Objectives Summary
                                        </div>
                                        
                                        <?php if(isset($job_seeker_personal_info) && $preferedJobs): ?>
                                            <div class="side-content-info">
                                                <?php echo $job_seeker_personal_info->career_objective; ?>

                                            </div>


                                            <div class="basic-job-desc">
                                                <div class="detail-show-content">
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Job Categories:
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <?php
                                                                $items = $job_seeker_personal_info->preferedJobs->pluck('title')->toArray();
                                                            ?>
                                                            <?php echo e(implode(', ', $items)); ?>

                                                        </div>
                                                    </div>
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Preferred Industries
                                                        </div>
                                                        <?php
                                                            $industries = $job_seeker_personal_info
                                                                ->preferedIndustry()
                                                                ->pluck('name')
                                                                ->toArray();
                                                        ?>
                                                        <div class="basic-job-right">
                                                            <?php echo e(implode(', ', $industries)); ?>

                                                        </div>
                                                    </div>
                                                    
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Looking For
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <?php echo e($job_seeker_personal_info->employee_type($job_seeker_personal_info->looking_for)->title); ?>

                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Skills
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <div class="skill-require-wrapper">
                                                                <?php
                                                                $skill_title = \App\Models\Skill::whereIn('id', json_decode($check_additional_info->skill))
                                                                    ->get(['title'])
                                                                    ->toArray();
                                                                ?>
                                                                <?php $__currentLoopData = $skill_title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <span class="require-wrapper">
                                                                        <?php echo e($skill['title']); ?>

                                                                    </span>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Expected Salary
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <?php echo e($job_seeker_personal_info->expected_salary); ?> /Monthly
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div
                                        class="right-side-form <?php echo e(isset($job_seeker_personal_info) && $preferedJobs != [] ? 'd-none' : ''); ?>">
                                        <div class="detail-form-content">

                                            <form
                                                action="<?php echo e(isset($job_seeker_personal_info) ? route('user.update_preference', auth()->user()->username) : route('user.store_preference', auth()->user()->username)); ?>"
                                                class="mt-3" method="post">
                                                <?php echo csrf_field(); ?>
                                                <?php if(isset($job_seeker_personal_info)): ?>
                                                    <?php echo method_field('put'); ?>
                                                <?php endif; ?>
                                                <input name="preferance" value="1" type="hidden" />
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">

                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Prefered Job<span
                                                                    class="red">*</span></label>
                                                            <select name="prefered_job[]" id="preferedJobs" required
                                                                class="form-control field-industry" multiple="multiple">
                                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($category->id); ?>"
                                                                        <?php echo e(old('prefered_job') ? (in_array($category->id, old('prefered_job')) ? 'selected' : '') : (isset($preferedJobs) ? (in_array($category->id, $preferedJobs) ? 'selected' : '') : '')); ?>>
                                                                        <?php echo e($category->title); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['prefered_job'];
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
                                                    <div class="col-lg-12 col-md-12">
                                                        <?php
                                                        $preferedIndustry = isset($job_seeker_personal_info)
                                                            ? $job_seeker_personal_info
                                                                ->preferedIndustry()
                                                                ->pluck('id')
                                                                ->toArray()
                                                            : [];
                                                        ?>
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Prefered
                                                                Industry<span class="red">*</span></label>
                                                            <select name="prefered_industry[]" id="preferedIndustry" required
                                                                class="form-control field-industry" multiple="multiple">
                                                                <?php $__currentLoopData = $industry; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($data->id); ?>"
                                                                        <?php echo e(old('prefered_industry') ? (in_array($category->id, old('prefered_industry')) ? 'selected' : '') : (isset($preferedIndustry) ? (in_array($data->id, $preferedIndustry) ? 'selected' : '') : '')); ?>>
                                                                        <?php echo e($data->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['prefered_industry'];
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

                                                    

                                                    <div class="col-md-12">
                                                        <?php
                                                            if (isset($check_additional_info->skill)) {
                                                                $skill = json_decode($check_additional_info->skill);
                                                            }
                                                            $s = [];
                                                            if (isset($skill)) {
                                                                foreach ($skill as $sk) {
                                                                    array_push($s, $sk);
                                                                }
                                                            }

                                                        ?>
                                                        <div class="mb-3">
                                                            <label for="nameInput" class="form-label">Skills <span
                                                                    class="red">*</span></label>
                                                            <select id="" class="form-control field-industry" required
                                                                multiple="multiple" name="skill[]">
                                                                <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($skill->id); ?>"
                                                                        <?php if(in_array($skill->id, $s)): ?> selected <?php endif; ?>>
                                                                        <?php echo e($skill->title); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['skill.*'];
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
                                                    
                                                    
                                                    <!--end col-->
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Looking For <span
                                                                    class="red">*</span></label>
                                                            <select name="looking_for" id="" class="form-control" required>
                                                                <option value="" selected>--Select--
                                                                </option>
                                                                <?php $__currentLoopData = $employee_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($type->id); ?>"
                                                                        <?php echo e(old('looking_for') ? (old('looking_for') == $type->id ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->looking_for == $type->id ? 'selected' : '') : '')); ?>>
                                                                        <?php echo e($type->title); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['looking_for'];
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
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Expected Salary
                                                                (Monthly) <span
                                                                    class="red">*</span></label>
                                                            <select name="expected_salary" id="" required
                                                                class="form-control">
                                                                <option value="" selected>--Select--
                                                                </option>

                                                                <option value="Below 10000"
                                                                    <?php echo e(old('expected_salary') ? (old('expected_salary') == 'Below 10000' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->expected_salary == 'Below 10000' ? 'selected' : '') : '')); ?>>
                                                                    Below 10000</option>
                                                                <option value="10,000-20,000"
                                                                    <?php echo e(old('expected_salary') ? (old('expected_salary') == '10,000-20,000' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->expected_salary == '10,000-20,000' ? 'selected' : '') : '')); ?>>
                                                                    10,000-20,000</option>
                                                                <option value="20,000-30,000"
                                                                    <?php echo e(old('expected_salary') ? (old('expected_salary') == '20,000-30,000' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->expected_salary == '20,000-30,000' ? 'selected' : '') : '')); ?>>
                                                                    20,000-30,000</option>
                                                                <option value="30,000-40,000"
                                                                    <?php echo e(old('expected_salary') ? (old('expected_salary') == '30,000-40,000' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->expected_salary == '30,000-40,000' ? 'selected' : '') : '')); ?>>
                                                                    30,000-40,000
                                                                </option>
                                                                <option value="40,000-50,000"
                                                                    <?php echo e(old('expected_salary') ? (old('expected_salary') == '40,000-50,000' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->expected_salary == '40,000-50,000' ? 'selected' : '') : '')); ?>>
                                                                    40,000-50,000</option>
                                                                <option value="Above 50,000"
                                                                    <?php echo e(old('expected_salary') ? (old('expected_salary') == 'Above 50,000' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->expected_salary == 'Above 50,000' ? 'selected' : '') : '')); ?>>
                                                                    Above 50,000
                                                                </option>
                                                                <option value="Negotiable"
                                                                    <?php echo e(old('expected_salary') ? (old('expected_salary') == 'Negotiable' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->expected_salary == 'Negotiable' ? 'selected' : '') : '')); ?>>
                                                                    Negotiable
                                                                </option>
                                                            </select>
                                                            <?php $__errorArgs = ['expected_salary'];
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
                                                            <label for="meassageInput" class="form-label"></label>
                                                            Career Objectives<span class="red">*</span></label>
                                                            <textarea class="form-control trumbowyg" id="meassageInput" placeholder="Enter  Your Career Objective" name="career_objective"
                                                                id="trumbowyg" rows="5" required><?php echo e(old('career_objective') ? old('career_objective') : (isset($job_seeker_personal_info) ? $job_seeker_personal_info->career_objective : '')); ?></textarea>
                                                            <?php $__errorArgs = ['career_objective'];
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

                                                    <hr>
                                                    <div class="col-12">
                                                        <div class="tab-main-footer">
                                                            <button type="submit" name="submit" id="submit"
                                                                class="btn btn-primary btn-hover">Save Changes
                                                            </button>

                                                            <button type="reset" name="submit" id="submit"
                                                                class="btn btn-orange btn-hover">Cancel </button>
                                                        </div>
                                                    </div>
                                                </div>



                                            </form>
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


<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        $(".profile-icon").on("click", function() {
            $(".mobile-profile-check").toggleClass("profile-check-toggle");
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/jobseeker/seeker-preference.blade.php ENDPATH**/ ?>