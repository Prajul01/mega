<?php
if (request()->routeIs('employers.postAJob')) {
    $flag = 1;
} else {
    $flag = 0;
}
?>
<?php $__env->startSection('title', ($flag ? 'Post' : 'Edit') . ' A Job'); ?>
<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/dropify/css/dropify.css')); ?>">
    <style>
        .d-flex {
            display: flex;
        }

        .align-items-center {
            align-items: center;
        }

        .ml-4 {
            margin-left: 1.5rem;
        }

        .label-flex {
            width: 100%;
            padding: 22px 12px;
            border-radius: 20px;
            cursor: pointer;
        }

        .new-body {
            background-color: #fff;
            border: 1px solid #eaeaea;
            margin-bottom: 25px;
        }



        .new-body input[type="radio"]:checked+label {
            background-color: #2776b6;
            color: #fff;

        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('dashboard_content'); ?>
    <div class="card candidate-info new-shadow-sidebar mt-0 mb-3 mt-lg-0">
        <div class="card-body p-0">
            <div class="job-summary-tab mt-0">
                <div class="postjob-title">
                    <?php echo e(($flag ? 'Post' : 'Edit') . ' A Job'); ?>

                </div>
                <div class="postjob-info-form px-3 pb-3">
                    <?php
                    if (@$flag) {
                        $url = route('employers.post-a-job');
                    } else {
                        $url = route('employers.edit-a-post', $job->slug);
                    }
                    ?>
                    <form method="post" action="<?php echo e($url); ?>" onsubmit="return validateForm()"
                        class="contact-form mt-4" name="myForm" id="myForm" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <span id="error-msg"></span>
                        <div class="row">
                            <div class="col-12">
                                <strong>Select Job Type <span class="red">*</span></strong>
                            </div>
                            <div class="col-md-3">
                                <div class="new-body" style="border-radius:20px;">
                                    <input type="radio" id="mega" name="job_type" value="mega" <?php echo e(old('job_type', @$job->type) == 'mega'? 'checked': ''); ?> hidden>
                                    <label class="d-flex align-items-center label-flex" for="mega">
                                        <div class="icon-in-bg bg-light rounded-circle">
                                            <img src="https://megajobnepal.com/frontend/assets/images/target.png"
                                                style="width:40px;">
                                        </div>
                                        <div class="ml-4"><span>Mega Jobs</span>

                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="new-body" style="border-radius:20px;">
                                    <input type="radio" id="premium" name="job_type" value="premium" <?php echo e(old('job_type', @$job->type) == 'premium'? 'checked': ''); ?> hidden>
                                    <label class="d-flex align-items-center label-flex" for="premium">
                                        <div class="icon-in-bg bg-light rounded-circle">
                                            <img src="https://megajobnepal.com/frontend/assets/images/premium.png"
                                                style="width:40px;">
                                        </div>
                                        <div class="ml-4"><span>Premium Jobs</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="new-body" style="border-radius:20px;">
                                    <input type="radio" id="prime" name="job_type" value="prime" <?php echo e(old('job_type', @$job->type) == 'prime'? 'checked': ''); ?> hidden>
                                    <label class="d-flex align-items-center label-flex" for="prime">
                                        <div class="icon-in-bg bg-light rounded-circle">
                                            <img src="https://megajobnepal.com/frontend/assets/images/prime-service.png"
                                                style="width:40px;">
                                        </div>
                                        <div class="ml-4"><span>Prime Jobs</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="new-body" style="border-radius:20px;">
                                    <input type="radio" id="latest" name="job_type" value="normal" <?php echo e(old('job_type', @$job->type) == 'normal'? 'checked': ''); ?> hidden>
                                    <label class="d-flex align-items-center label-flex" for="latest">
                                        <div class="icon-in-bg bg-light rounded-circle">
                                            <img src="<?php echo e(asset('/storage/setting/favicon/' . $setting->favicon)); ?>"
                                                style="width:40px;">
                                        </div>
                                        <div class="ml-4"><span>Latest Jobs</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nameInput" class="form-label">Job Title<span class="red">*</span></label>
                                    <input type="text" name="job_title" id="name" class="form-control"
                                        placeholder="Job Title"
                                        value="<?php echo e(old('job_title') ? old('job_title') : @$job->title); ?>">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">No. of
                                        Openings</label>
                                    <input type="number" name="no_of_opening" id="name" class="form-control"
                                        min="1"
                                        value="<?php echo e(old('no_of_opening') ? old('no_of_opening') : @$job->no_of_opening); ?>">

                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Choose
                                        Category<span class="red">*</span></label>
                                    <select name="category" id="" class="form-control field-industry">
                                        <option value="" <?php echo e(@$flag ? 'selected' : ''); ?>>--Select--
                                        </option>
                                        <?php $__currentLoopData = $company_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(base64_encode($category->id)); ?>"
                                                <?php echo e(old('category', base64_encode(@$job->company_category_id) == base64_encode($category->id)) ? 'selected' : ''); ?>>
                                                <?php echo e($category->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Job
                                        Level<span class="red">*</span></label>

                                    <select name="job_level" id="" class="form-control">
                                        <option disabled <?php echo e(@$flag ? 'selected' : ''); ?>>--Select Job Level--</option>
                                        <?php $__currentLoopData = $job_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(base64_encode($level->id)); ?>"
                                                <?php echo e(old('job_level') ? (old('job_level') == $level->id ? 'selected' : '') : (@$job->job_level_id == $level->id ? 'selected' : '')); ?>>
                                                <?php echo e($level->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Post on<span
                                            class="red">*</span></label>
                                    <input type="date" class="form-control" name="post_on"
                                        value="<?php echo e(date('Y-m-d', strtotime(old('post_on', @$job->start_date) ? old('post_on', @$job->start_date) : today()))); ?>">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Expires on<span
                                            class="red">*</span></label>
                                    <input type="date" class="form-control" name="expires_on"
                                        value="<?php echo e(date('Y-m-d', strtotime(old('expires_on', @$job->expiry_date) ? old('expires_on', @$job->expiry_date) : today()->addDays(15)))); ?>">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Desired
                                        Candidate<span class="red">*</span></label>
                                    <select name="desired_candidate" id="" class="form-control">
                                        <option value="" <?php echo e(@$flag ? 'selected' : ''); ?>>Select your desired
                                            Candidated
                                        </option>
                                        <option value="male"
                                            <?php echo e(old('desired_candidate') ? (old('desired_candidate') == 'male' ? 'selected' : '') : (@$job->desired_candidate == 'male' ? 'selected' : '')); ?>>
                                            Male</option>
                                        <option value="female"
                                            <?php echo e(old('desired_candidate') ? (old('desired_candidate') == 'female' ? 'selected' : '') : (@$job->desired_candidate == 'female' ? 'selected' : '')); ?>>
                                            Female</option>
                                        <option value="others   "
                                            <?php echo e(old('desired_candidate') ? (old('desired_candidate') == 'others' ? 'selected' : '') : (@$job->desired_candidate == 'others' ? 'selected' : '')); ?>>
                                            Both</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Education
                                        Level<span class="red">*</span></label>
                                    <select name="education_level" class="form-control field-study">
                                        <option disabled <?php echo e(@$flag ? 'selected' : ''); ?>>--Select Education level--</option>
                                        <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(base64_encode($education->id)); ?>"
                                                <?php echo e(old('education_level') ? (old('education_level') == $education->id ? 'selected' : '') : (@$job->education_id == $education->id ? 'selected' : '')); ?>>
                                                <?php echo e($education->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Experience
                                        Year<span class="red">*</span></label>
                                    <select name="experience_year" class="form-control field-study">
                                        <option disabled>-- Choose Experience --</option>
                                        <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(base64_encode($experience->id)); ?>"
                                                <?php echo e(old('experience_year', @$job->experience_id) == $experience->id ? 'selected' : ''); ?>>
                                                <?php echo e($experience->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Province<span
                                            class="red">*</span></label>
                                    <select name="province" id="province" class="form-control field-study"
                                        onchange="provinceSelect(this)">
                                        <option value="0" <?php echo e(@$flag ? 'selected' : ''); ?>>--Select Province--
                                        </option>
                                        <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(base64_encode($province->id)); ?>"
                                                <?php echo e(old('province') ? (old('province') == $province->id ? 'selected' : '') : (@$job->province_id == $province->id ? 'selected' : '')); ?>>
                                                <?php echo e($province->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Districts<span
                                            class="red">*</span></label>
                                    <select name="districts" id="districts" class="form-control field-study"
                                        onchange="districtSelect(this)">
                                        <option value="0" <?php echo e(@$flag ? 'selected' : ''); ?>>--Select District--</option>
                                        <?php if(!@$flag): ?>
                                            <?php $__currentLoopData = $selectedDistricts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($district->id); ?>"
                                                    <?php echo e(old('district') ? (old('district') == $district->id ? 'selected' : '') : (@$job->district_id == $district->id ? 'selected' : '')); ?>>
                                                    <?php echo e($district->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">City/
                                        Tole<span class="red">*</span></label>
                                    <select name="city" id="city" class="form-control field-study">
                                        <option value="0" selected>--Select City--</option>
                                        <?php if(!@$flag): ?>
                                            <?php $__currentLoopData = $selectedCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($city->id); ?>"
                                                    <?php echo e(old('city') ? (old('city') == $city->id ? 'selected' : '') : (@$job->city_id == $city->id ? 'selected' : '')); ?>>
                                                    <?php echo e($city->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Employee Type<span
                                            class="red">*</span></label>
                                    <select name="employeeType" class="form-control field-study">
                                        <option value="0" selected>--Select Employee Type--</option>
                                        <?php $__currentLoopData = $employeeType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($data->slug); ?>"
                                                <?php echo e(old('employeeType', @$job->employee_type->slug) == $data->slug ? 'selected' : ''); ?>>
                                                <?php echo e($data->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-6 mb-2">
                                <label for="emailInput" class="form-label">Salary Pay<span
                                        class="red">*</span></label>
                                <select name="salary_pay" id="" class="form-control field-study">
                                    <?php
                                    $pay_array = ['monthly', 'yearly'];
                                    ?>
                                    <option disabled <?php echo e(@$flag ? 'selected' : ''); ?>>--Select Pay Type--</option>
                                    <?php $__currentLoopData = $pay_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="monthly"
                                            <?php echo e(old('salary_pay') ? (old('salary_pay') == $data ? 'selected' : '') : (@$job->pay_type == $data ? 'selected' : '')); ?>>
                                            <?php echo e(ucfirst($data)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Salary
                                        Range<span class="red">*</span></label>
                                    <select name="salary_range" id="" class="form-control field-study">
                                        <option value="" <?php echo e(@$flag ? 'selected' : ''); ?>>--Salary Range--
                                        </option>
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
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">License<span
                                            class="red">*</span></label>
                                    <select name="license[]" id="" class="form-control field-study"
                                        multiple="multiple">
                                        <option value="0" <?php echo e(@$job->license != null ? 'selected' : ''); ?>>No</option>
                                        <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            if (!@$flag) {
                                                foreach ($job->vehicles as $data) {
                                                    if ($data->vehicle_id == $vehicle->id) {
                                                        $licFlag = 1;
                                                        break;
                                                    } else {
                                                        $licFlag = 0;
                                                    }
                                                }
                                            }
                                            
                                            ?>
                                            <option value="<?php echo e($vehicle->id); ?>" <?php echo e(@$licFlag ? 'selected' : ''); ?>>
                                                <?php echo e($vehicle->title); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Skills<span
                                            class="red">*</span></label>
                                    <?php
                                    if (@$job) {
                                        $hasSkills = $job
                                            ->skill()
                                            ->pluck('id')
                                            ->toArray();
                                    }
                                    ?>
                                    <select name="skills[]" id="" class="form-control field-study"
                                        multiple="multiple">
                                        <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($skill->id); ?>"
                                                <?php if(@$hasSkills): ?> <?php echo e(in_array($skill->id, $hasSkills) ? 'selected' : ''); ?> <?php endif; ?>>
                                                <?php echo e($skill->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="meassageInput" class="form-label"></label>
                                    Job Description<span class="red">*</span></label>
                                    <textarea class="form-control trumbowyg" id="meassageInput" placeholder="Enter  Your Career Objective"
                                        name="job_description" id="comments" rows="5"><?php echo e(!@$flag ? (old('job_description') ? old('job_description') : @$job->job_description) : ''); ?></textarea>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="meassageInput" class="form-label"></label>
                                    Job Specification<span class="red">*</span></label>
                                    <textarea class="form-control trumbowyg" id="meassageInput" placeholder="Enter  Your Career Objective"
                                        name="job_specification" id="comments"><?php echo e(!@$flag ? (old('job_specification') ? old('job_specification') : @$job->job_description) : ''); ?></textarea>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="meassageInput" class="form-label"></label>
                                    Job Banner<span class="red">*</span></label>
                                    <?php
                                        if (!@$flag) {
                                            $job_banner = public_path('/storage/job/' . $job->slug . '/' . $job->banner);
                                        }
                                    ?>
                                    <input type="file" name="job_banner" class="dropify" data-height="150"
                                        data-default-file="<?php echo e(!@$flag
                                            ? (file_exists($job_banner)
                                                ? asset('storage/job/' . $job->slug . '/' . $job->banner)
                                                : asset('frontend/assets/images/files/hiring-banner.png'))
                                            : ''); ?>" />
                                    <small>[Supporting file format: jpg, png, gif],
                                        [Image: 1400 x 300]</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Is cover letter necessary?<span
                                            class="red">*</span></label>
                                    <div class="btn-container mt-2">
                                        <label class="switch btn-color-mode-switch">
                                            <input value="1" id="color_mode2" type="checkbox" name="cover_letter"
                                                <?php echo e(@$job->cover_letter ? 'checked' : ''); ?>>
                                            <label class="btn-color-mode-switch-inner" data-off="NO" data-on="YES"
                                                for="color_mode2"></label>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                        </div>
                        <!--end row-->
                        <div class="job-post-footer my-3">
                            <?php if(@$flag): ?>
                                <div class="text-left">
                                    <button type="submit" id="submit" name="submit" class="btn btn-outline-danger"
                                        value="draft">
                                        Save As Draft </button>
                                </div>
                                <div class="text-left">
                                    <button type="submit" id="submit" name="submit" class="btn btn-primary"
                                        value="post">
                                        Post Job </button>
                                </div>
                            <?php else: ?>
                                <div class="text-left">
                                    <button type="submit" id="submit" name="update" class="btn btn-primary"
                                        value="draft">
                                        <i class="fa fa-upload"></i> &nbsp;Update </button>
                                </div>
                                <div class="text-left">
                                    <a href="<?php echo e(route('employers.index')); ?>" id="submit"
                                        class="btn btn-outline-danger" value="post"><i class="fa fa-times"></i>&nbsp;
                                        Cancel </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>
                    <!--end form-->
                </div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo e(asset('backend/assets/vendor/dropify/js/dropify.js')); ?>"></script>
    <script>
        $('.dropify').dropify();
        $(".field-study, .field-industry").select2({
            tags: true
        });

        function provinceSelect(data) {
            $('#districts').find('option').remove();
            $('#districts').append('<option value="0" selected>--Select District--</option>');
            $id = data.value;
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('employers.provinceSelect')); ?>",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    id: $id,
                },
                success: function(response) {
                    var districts = response.districts;

                    var count = Object.keys(response.districts).length;

                    for ($i = 0; $i < count; $i++) {
                        $('#districts').append('<option value="' + districts[$i].id + '">' + districts[$i]
                            .name + '</option>');
                    }
                    console.log(count);
                },
                error: function() {

                }
            });

        }

        function districtSelect(data) {
            $('#city').find('option').remove();
            $('#city').append('<option value="0" selected>--Select City--</option>');
            $id = data.value;
            $.ajax({
                method: "POST",
                url: "<?php echo e(route('employers.citySelect')); ?>",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    id: $id,
                },
                success: function(response) {
                    var city = response.cities;

                    var count = Object.keys(response.cities).length;

                    for ($i = 0; $i < count; $i++) {
                        $('#city').append('<option value="' + city[$i].id + '">' + city[$i].name + '</option>');
                    }
                    console.log(count);
                },
                error: function() {

                }
            });

        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('employer.overview-jobs.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/employer/overview-jobs/jobPost.blade.php ENDPATH**/ ?>