<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/dropify/css/dropify.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/select2/dist/css/select2.css')); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php $__env->stopPush(); ?>
<form method="POST" action="<?php echo e(route('admin.job.update', base64_encode($job->id))); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Job Name</span>
                    </div>
                    <input type="text" class="form-control" name="job_name" placeholder="Job Name" aria-label=""
                        aria-describedby="basic-addon1" value="<?php echo e(old('job_name', $job->title)); ?>" required>
                </div>
                <?php $__errorArgs = ['job_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="featured" value="1"
                                <?php echo e($job->featured == 1 ? 'checked' : ''); ?>></span>
                    </div>
                    <input type="text" class="form-control" value="Featured" disabled>
                </div>
                <?php $__errorArgs = ['featured'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="status" value="active"
                                <?php echo e($job->status == 'active' ? 'checked' : ''); ?>></span>
                    </div>
                    <input type="text" class="form-control" value="Display Status" disabled>
                </div>
                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">No Of Opening</span>
                    </div>
                    <input type="number" class="form-control" name="no_of_opening" placeholder="No Of Opening"
                        aria-label="" aria-describedby="basic-addon1"
                        value="<?php echo e(old('no_of_opening', $job->no_of_opening)); ?>">
                </div>
                <?php $__errorArgs = ['no_of_opening'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
           
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Desired Candidate</span>
                    </div>
                    <select class="form-control" name="desired_candidate">
                        <option disabled>--Select Desired Candidate</option>
                        <option value="male" <?php echo e($job->desired_candidate == 'male'? 'selected': ''); ?>>Male</option>
                        <option value="female" <?php echo e($job->desired_candidate == 'female'? 'selected': ''); ?>>Female</option>
                        <option value="others" <?php echo e($job->desired_candidate == 'others'? 'selected': ''); ?>>Others</option>
                        <option value="both" <?php echo e($job->desired_candidate == 'both'? 'selected': ''); ?>>Both</option>
                    </select>
                </div>
                <?php $__errorArgs = ['desired_candidate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Post on</span>
                    </div>
                    <input type="date" class="form-control" name="active_on"
                        value="<?php echo e(old('active_on', $job->start_date)); ?>">
                </div>
                <?php $__errorArgs = ['active_on'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Expires on</span>
                    </div>
                    <input type="date" class="form-control" name="expires_on"
                        value="<?php echo e(old('expires_on',$job->expiry_date )); ?>">
                </div>
                <?php $__errorArgs = ['expires_on'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Employer</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="employer">
                        <option selected disabled>Select Employer</option>
                        <?php $__currentLoopData = $employers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($employe->id); ?>"
                                <?php echo e($job->employer_id == $employe->id ? 'selected' : ''); ?>>
                                <?php echo e($employe->company_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php $__errorArgs = ['employer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select User</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="user">
                        <option selected disabled value="">Select User</option>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($user->id); ?>" <?php echo e($job->user_id == $user->id ? 'selected' : ''); ?>>
                                <?php echo e($user->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php $__errorArgs = ['user'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Job Level</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="job_level">
                        <option selected disabled value="">Select Job Level</option>
                        <?php $__currentLoopData = $job_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job_level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($job_level->id); ?>"
                                <?php echo e($job->job_level_id == $job_level->id ? 'selected' : ''); ?>><?php echo e($job_level->title); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php $__errorArgs = ['employer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Education</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="education">
                        <option selected disabled value="">Select Education</option>
                        <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($education->id); ?>"
                                <?php echo e($job->education_id == $education->id ? 'selected' : ''); ?>><?php echo e($education->title); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php $__errorArgs = ['education'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Experience</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="experience">
                        <option selected disabled value="">Select Experience</option>
                        <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($experience->id); ?>"
                                <?php echo e($job->experience_id == $experience->id ? 'selected' : ''); ?>>
                                <?php echo e($experience->title); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php $__errorArgs = ['experience'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Company Category</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example"
                        name="company_category">
                        <option selected disabled value="">Select Company Category</option>
                        <?php $__currentLoopData = $company_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($company_category->id); ?>"
                                <?php echo e($job->company_category_id == $company_category->id ? 'selected' : ''); ?>>
                                <?php echo e($company_category->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php $__errorArgs = ['company_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Employee Type</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example"
                        name="employee_type">
                        <option selected disabled value="">Select Company Category</option>
                        <?php $__currentLoopData = $employee_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($employee_type->id); ?>"
                                <?php echo e($job->employee_type_id == $employee_type->id ? 'selected' : ''); ?>>
                                <?php echo e($employee_type->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php $__errorArgs = ['company_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" disabled checked></span>
                    </div>
                    <input type="text" class="form-control"
                        value="<?php echo e($job->job_type == 1 ? 'Newspaper Job' : 'General Job'); ?>" disabled>
                </div>
                <?php $__errorArgs = ['job_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <input type="hidden" name="job_type" value="<?php echo e($job->job_type); ?>">
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select License</span>
                        <?php
                            $data = [];
                            $v_id = $job->vehicles;
                            foreach ($licenses as $l) {
                                array_push($data, $l->vehicle_id);
                            }
                        ?>
                    </div>
                    <select class="multiple-cat form-control" name="license_id[]" multiple="multiple">
                        <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($vehicle->id); ?>" <?php if(in_array($vehicle->id, $data)): ?> selected <?php endif; ?>>
                                <?php echo e($vehicle->title); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>
                </div>
                <?php $__errorArgs = ['company_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <?php if($job->job_type == 0): ?>
                <div class="col-md-6 mb-3 jobDesc-info">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Job Description</span>
                        </div>
                        <textarea class="form-control" id="ckeditor" name="job_description" placeholder="Job description" rows="6"
                            aria-label="" aria-describedby="basic-addon1"><?php echo e(old('job_description', $job->job_description)); ?></textarea>
                    </div>
                    <?php $__errorArgs = ['job_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-6 mb-3 jobDesc-info">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Job Specification</span>
                        </div>
                        <textarea class="form-control" id="ckeditor1" name="job_specification" placeholder="Job Specification"
                            rows="6" aria-label="" aria-describedby="basic-addon1"><?php echo e(old('job_specification', $job->job_specification)); ?></textarea>
                    </div>
                    <?php $__errorArgs = ['job_specification'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            <?php else: ?>
           
                <div class="col-md-12 mb-3 newspaper-image">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Newspaper Image</span>
                        </div>
                        <input type="file" name="newspaper_image" class="dropify"
                            data-default-file="<?php echo e(old('newspaper_image', asset('storage/job/' . $job->slug . '/newspaper_image/' . $job->newspaper_image))); ?>">
                    </div>
                    <?php $__errorArgs = ['newspaper_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    
                </div>
            <?php endif; ?>
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Job Banner</span>
                    </div>
                    <input type="file" name="banner" class="dropify"
                        data-default-file="<?php echo e(old('banner', asset('storage/job/' . $job->slug . '/' . $job->banner))); ?>">
                </div>
                <?php $__errorArgs = ['banner'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="alert alert-warning mt-1">
                    Best Image Size 1200 X 600 PX.
                </div>
            </div>
            <div class="col-md-12 mb-1">
                <div class="card">
                    <div class="card-header">
                        <h2>Skills</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12 my-3">
                <?php
                $skill_ids = [];
                foreach ($job->skill as $skill) {
                    array_push($skill_ids, $skill->id);
                }
                ?>
                <select class="js-example-basic-multiple" name="skills[]" multiple="multiple">
                    <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        if (in_array($skill->id, $skill_ids)) {
                            $flag = 1;
                        } else {
                            $flag = 0;
                        }
                        ?>
                        <option value="<?php echo e($skill->id); ?>" <?php if($flag == 1): ?> selected <?php endif; ?>>
                            <?php echo e($skill->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['skill'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Offered Salary</h2>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Pay Type</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="pay_type">
                        <option selected disabled value="">Select Pay Type</option>
                        <option value="monthly"<?php echo e($job->pay_type == 'monthly' ? 'selected' : ''); ?>>Monthly</option>
                        <option value="weekly" <?php echo e($job->pay_type == 'weekly' ? 'selected' : ''); ?>>Weekly</option>
                    </select>
                </div>
                <?php $__errorArgs = ['pay_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Salary Range</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="salary_range">
                        <?php
                        $salary_array = ['Negotiable', '10,000-20,000', '20,000-30,000', '30,000-40,000', '40,000-50,000', '50,000-60,000', '60,000-70,000', 'more than 70,000'];
                        ?>
                        <?php $__currentLoopData = $salary_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($data); ?>"
                                <?php echo e(old('salary_range') ? (old('salary_range') == $data ? 'selected' : '') : (@$job->salary_range == $data ? 'selected' : '')); ?>>
                                <?php echo e($data); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php $__errorArgs = ['company_owner_ship'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            

            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-header">
                        <h2>Address</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Country</span>
                    </div>
                    <select class="form-select form-control country" aria-label="Default select example"
                        name="country">
                        <option selected disabled value="">Select Country</option>
                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($country->id); ?>"
                                <?php echo e($job->country_id == $country->id ? 'selected' : ''); ?>>
                                <?php echo e($country->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Province</span>
                    </div>
                    <select class="form-select form-control province-list" id="province"
                        aria-label="Default select example" name="province">
                        <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($province->id); ?>"
                                <?php echo e($province->id == $job->province_id ? 'selected' : ''); ?>>
                                <?php echo e($province->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php $__errorArgs = ['province'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select District</span>
                    </div>
                    <select class="form-select form-control district-list" aria-label="Default select example"
                        name="district" id="district">
                        <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($district->id); ?>"
                                <?php echo e($job->district_id == $district->id ? 'selected' : ''); ?>>
                                <?php echo e($district->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php $__errorArgs = ['province'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select City</span>
                    </div>
                    <select class="form-select form-control city-list" aria-label="Default select example"
                        name="city">
                        <option selected disabled value="">Select City</option>
                        <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($city->id); ?>" <?php echo e($job->city_id == $city->id ? 'selected' : ''); ?>>
                                <?php echo e($city->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
        </div>

        <div class="card-footer">
            <a href="<?php echo e(route('admin.job.index')); ?>" class="btn btn-danger">Cancel</a>
            <button style="float: right" type="submit" class="btn btn-success">Save</button>
        </div>
</form>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('backend/assets/vendor/dropify/js/dropify.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/html/assets/js/pages/forms/dropify.js')); ?>"></script>
    <script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
    <script src="<?php echo e(asset('backend/assets/vendor/select2/dist/js/select2.js')); ?>"></script>
    <script>
        $(document).on('click', '#remove', function() {
            $(this).closest(".varient").remove();
        });
    </script>
    <script>
        $(".add-personal-info").click(function() {
            $(".additional_personal_info").append(
                `  <div class="row mb-2 personal border p-2 mx-2">
                <div class="col-md-12 float-right my-2"><span id="remove_personal" class="remove btn btn-outline-danger"><i class="fa fa-trash"></i></span> </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Name</span>
                            </div>
                            <input type="text" class="form-control" name="personal_name[]" required/>
                        </div>
                        <?php $__errorArgs = ['personal_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Email</span>
                            </div>
                            <input type="text" class="form-control" name="personal_email[]" required/>
                        </div>
                        <?php $__errorArgs = ['personal_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Designation</span>
                            </div>
                            <input type="text" class="form-control" name="personal_designation[]" required/>
                        </div>
                        <?php $__errorArgs = ['personal_designation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Phone Number</span>
                            </div>
                            <input type="text" class="form-control" name="personal_phone[]" required/>
                        </div>
                        <?php $__errorArgs = ['personal_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>`
            )
        });
        $(document).on('click', '#remove_personal', function() {
            $(this).closest(".personal").remove();
        });
    </script>
    <script>
        var editor_config = {
            toolbar: [{
                    name: 'document',
                    groups: ['mode', 'document', 'doctools']

                },
                {
                    name: 'clipboard',
                    groups: ['clipboard', 'undo'],
                    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                },
                {
                    name: 'editing',
                    groups: ['find', 'selection', 'spellchecker'],
                    items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                },
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup'],
                    items: ['Bold', 'Italic', 'Underline', '-',
                        'RemoveFormat'
                    ]
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', '-', 'JustifyLeft',
                        'JustifyCenter', 'JustifyRight', 'JustifyBlock',
                    ]
                },
                {
                    name: 'links',
                    items: ['Link']
                },
                '/',
                {
                    name: 'styles',
                    items: ['Styles', 'Format', 'Font', 'FontSize']
                },
                {
                    name: 'colors',
                    items: ['TextColor']
                },
            ],
            width: ['100%']
        };
        CKEDITOR.replace('ckeditor', editor_config);
        CKEDITOR.replace('ckeditor1', editor_config);
    </script>
    <script>
        $(document).ready(function() {
            $('.multiple-cat').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".country").on('blur', function() {
                var _country_id = $(this).val();
                $.ajax({
                    url: "<?php echo e(url('admin/job-management/provincelist')); ?>/" + _country_id,
                    dataType: 'json',
                    beforeSend: function() {
                        $(".province-list").html(
                            '<option selected diaslable>--- Select Province ---</option>');
                    },
                    success: function(data) {
                        var _html = '';
                        $.each(data.response, function(index, row) {
                            _html += '<option value="' + row.id + '">' + row.name +
                                '</option>';
                        });
                        $(".province-list").html(_html);
                    }
                });

            });
        });
    </script>
    <script src="<?php echo e(asset('backend/assets/vendor/select2/dist/js/select2.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $("#province").on('blur', function() {
                var _district_id = $(this).val();
                $.ajax({
                    url: "<?php echo e(url('admin/job-management/districtlist')); ?>/" + _district_id,
                    dataType: 'json',
                    beforeSend: function() {
                        $(".district-list").html(
                            '<option selected diaslable>--- Select District ---</option>');
                    },
                    success: function(data) {
                        var _html = '';
                        $.each(data.response, function(index, row) {
                            _html += '<option value="' + row.id + '">' + row.name +
                                '</option>';
                        });
                        $(".district-list").html(_html);
                    }
                });

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#district").on('blur', function() {
                var _city_id = $(this).val();
                $.ajax({
                    url: "<?php echo e(url('admin/job-management/citylist')); ?>/" + _city_id,
                    dataType: 'json',
                    beforeSend: function() {
                        $(".city-list").html(
                            '<option selected diaslable>--- Select City ---</option>');
                    },
                    success: function(data) {
                        var _html = '';
                        $.each(data.response, function(index, row) {
                            _html += '<option value="' + row.id + '">' + row.name +
                                '</option>';
                        });
                        $(".city-list").html(_html);
                    }
                });

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.multiple-cat').select2();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/megajobn/public_html/resources/views/admin/job/components/edit.blade.php ENDPATH**/ ?>