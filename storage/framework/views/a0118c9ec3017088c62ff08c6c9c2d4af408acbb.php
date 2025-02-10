<?php $__env->startSection('title', 'Basic Info | Job Seeker'); ?>

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
                                                <i class="fa-regular fa-address-card"></i>

                                            </span>

                                            Basic Inforamtion
                                        </div>
                                        <div class="right-top-button">
                                            <a href="javascript:void(0)" name="submit" id="editPreference"
                                                class="btn btn-primary btn-hover"><span class="icon-top">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </span><span class="mobile-none">Edit Basic Info</span></a>
                                        </div>
                                    </div>

                                    <div
                                        class="right-side-content <?php echo e(isset($job_seeker_personal_info) && @$job_seeker_personal_info->first_name && @$job_seeker_personal_info->mobile_number ? '' : 'd-none'); ?>">
                                        <div class="basic-job-desc">
                                            <?php if(isset($job_seeker_personal_info) &&
                                                    @$job_seeker_personal_info->first_name &&
                                                    @$job_seeker_personal_info->mobile_number): ?>
                                                <div class="detail-show-content">
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Full Name
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <strong><?php echo e($job_seeker_personal_info->first_name); ?>

                                                                <?php echo e($job_seeker_personal_info->middle_name); ?>

                                                                <?php echo e($job_seeker_personal_info->last_name); ?></strong>
                                                        </div>
                                                    </div>
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Display Picture
                                                        </div>
                                                        <?php
                                                        if (@$job_seeker_personal_info->profile_pic) {
                                                            $url = asset('/storage/job-seeker/' . $job_seeker_personal_info->profile_pic);
                                                        } else {
                                                            $url = asset('frontend/assets/images/files/spy.png');
                                                        }
                                                        ?>
                                                        <div class="basic-job-right">
                                                            <div class="dp-image">
                                                                <img src="<?php echo e($url); ?>" alt="Profile picture">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Current Address
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <?php echo e(\App\Models\City::find($job_seeker_personal_info->current_city)->name); ?>,
                                                            <?php echo e(\App\Models\District::find($job_seeker_personal_info->current_district)->name); ?>

                                                        </div>
                                                    </div>
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Permanent Address
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <?php echo e(\App\Models\City::find($job_seeker_personal_info->permanent_city)->name); ?>,
                                                            <?php echo e(\App\Models\District::find($job_seeker_personal_info->permanent_district)->name); ?>

                                                        </div>
                                                    </div>
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Mobile Number
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <?php echo e($job_seeker_personal_info->mobile_number); ?>

                                                        </div>
                                                    </div>
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Gender
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <?php echo e($job_seeker_personal_info->gender); ?>

                                                        </div>
                                                    </div>
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Date of birth
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <?php echo e($job_seeker_personal_info->date_of_birth); ?>

                                                        </div>
                                                    </div>
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Marital Status
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <?php echo e($job_seeker_personal_info->maritial_status); ?>

                                                        </div>
                                                    </div>
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            License
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <?php echo e($job_seeker_personal_info->have_license); ?>

                                                        </div>
                                                    </div>
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Vehicle
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <?php echo e($job_seeker_personal_info->have_vehicle); ?>

                                                        </div>
                                                    </div>
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Nationality
                                                        </div>
                                                        <div class="basic-job-right">
                                                            Nepali
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>

                                    <div
                                        class="right-side-form <?php echo e(isset($job_seeker_personal_info) && @$job_seeker_personal_info->first_name && @$job_seeker_personal_info->mobile_number ? 'd-none' : ''); ?>">
                                        <div class="detail-form-content">
                                            <form
                                                action="<?php echo e(isset($job_seeker_personal_info) ? route('user.update_preference', auth()->user()->username) : route('user.store_preference', auth()->user()->username)); ?>"
                                                class="mt-3" method="post" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <?php if(isset($job_seeker_personal_info)): ?>
                                                    <?php echo method_field('put'); ?>
                                                <?php endif; ?>
                                                <div class="row">


                                                    <div class="col-12 mb-3">
                                                        <?php
                                                        if (@$job_seeker_personal_info->profile_pic) {
                                                            $url = asset('/storage/job-seeker/' . $job_seeker_personal_info->profile_pic);
                                                        } else {
                                                            $url = asset('frontend/assets/images/files/spy.png');
                                                        }
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-8 col-lg-3">
                                                                <div class="dp-holder">
                                                                    <label for="meassageInput" class="form-label">Display
                                                                        Picture</label>
                                                                    <span class="red">*</span></label>
                                                                    <input type="file" name="profile_pic" class="dropify"
                                                                        data-default-file="<?php echo e($url); ?>"
                                                                        data-height="120" />
                                                                    <?php $__errorArgs = ['profile_pic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    <div class="dropify-absolute-icon">
                                                                        <span class="icon">
                                                                            <i class="fa-solid fa-plus"></i>
                                                                        </span>
                                                                        Upload Your Image
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-12">
                                                                <small>[Supporting file format: jpg, png, gif],
                                                                    [Image: 200 x 200]</small>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="nameInput" class="form-label">First
                                                                Name <span class="red">*</span></label>
                                                            <input type="text" name="first_name" id="name"
                                                                class="form-control" placeholder="Enter your name"
                                                                value="<?php echo e(old('first_name') ? old('first_name') : (isset($job_seeker_personal_info) ? $job_seeker_personal_info->first_name : '')); ?>">
                                                            <?php $__errorArgs = ['first_name'];
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
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="nameInput" class="form-label">Middle
                                                                Name</label>
                                                            <input type="text" name="middle_name" id="name"
                                                                class="form-control" placeholder="Enter your Middle Name"
                                                                value="<?php echo e(old('middle_name') ? old('middle_name') : (isset($job_seeker_personal_info) ? $job_seeker_personal_info->middle_name : '')); ?>">
                                                            <?php $__errorArgs = ['middle_name'];
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
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Last
                                                                Name<span class="red">*</span></label>
                                                            <input type="text" class="form-control" id=""
                                                                name="last_name" placeholder="Enter your Last name"
                                                                value="<?php echo e(old('last_name') ? old('last_name') : (isset($job_seeker_personal_info) ? $job_seeker_personal_info->last_name : '')); ?>">
                                                            <?php $__errorArgs = ['last_name'];
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
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Current
                                                                Province<span class="red">*</span></label>
                                                            <select class="form-control" name="current_province"
                                                                onChange="district(this)">
                                                                <option selected disabled>Select Province</option>
                                                                <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($province->id); ?>"
                                                                        <?php echo e(old(
                                                                            'current_province',
                                                                            @$job_seeker_personal_info->current_province ? $job_seeker_personal_info->current_province : '',
                                                                        ) == $province->id
                                                                            ? 'selected'
                                                                            : ''); ?>>
                                                                        <?php echo e($province->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['current_province'];
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
                                                    <?php
                                                    if (@$job_seeker_personal_info->current_province) {
                                                        $current_districts = \App\Models\District::where('province_id', $job_seeker_personal_info->current_province)->get();
                                                    }
                                                    
                                                    ?>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Current
                                                                District<span class="red">*</span></label>
                                                            <select class="form-control" name="current_district"
                                                                onchange="city(this)">
                                                                <option selected disabled>Select District</option>
                                                                <?php if(@$current_districts): ?>
                                                                    <?php $__currentLoopData = $current_districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($district->id); ?>"
                                                                            <?php echo e($job_seeker_personal_info->current_district == $district->id ? 'selected' : ''); ?>>
                                                                            <?php echo e($district->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                            <?php $__errorArgs = ['current_district'];
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
                                                    <?php
                                                    if (@$job_seeker_personal_info->current_district) {
                                                        $current_city = \App\Models\City::where('district_id', $job_seeker_personal_info->current_district)->get();
                                                    }
                                                    ?>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Current City<span
                                                                    class="red">*</span></label>
                                                            <select class="form-control" name="current_city">
                                                                <option selected disabled>Select City</option>
                                                                <?php if(@$current_city): ?>
                                                                    <?php $__currentLoopData = @$current_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($city->id); ?>"
                                                                            <?php echo e($city->id == $job_seeker_personal_info->current_city ? 'selected' : ''); ?>>
                                                                            <?php echo e($city->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                            <?php $__errorArgs = ['current_city'];
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
                                                    <div class="col-md-12 my-2">
                                                        <input type="checkbox" onchange="setCurrentToPermanent()"
                                                            id="sameAddress" name="sameAddress"> <label
                                                            for="sameAddress"> Same
                                                            as Current</label>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Permanent
                                                                Province<span class="red">*</span></label>
                                                            <select class="form-control" name="permanent_province"
                                                                id="permanent_province" onchange="district(this)">
                                                                <option selected disabled>Select Province</option>
                                                                <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($province->id); ?>"
                                                                        <?php echo e(old(
                                                                            'permanent_province',
                                                                            @$job_seeker_personal_info->permanent_province ? $job_seeker_personal_info->current_province : '',
                                                                        ) == $province->id
                                                                            ? 'selected'
                                                                            : ''); ?>>
                                                                        <?php echo e($province->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['permanent_province'];
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
                                                    <?php
                                                    if (@$job_seeker_personal_info->permanent_province) {
                                                        $permanent_districts = \App\Models\District::where('province_id', $job_seeker_personal_info->permanent_province)->get();
                                                    }
                                                    ?>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Permanent
                                                                District<span class="red">*</span></label>
                                                            <select class="form-control" name="permanent_district"
                                                                id="permanent_district" onchange="city(this)">
                                                                <option selected disabled>Select District</option>
                                                                <?php if(@$permanent_districts): ?>
                                                                    <?php $__currentLoopData = $permanent_districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($district->id); ?>"
                                                                            <?php echo e($job_seeker_personal_info->permanent_district == $district->id ? 'selected' : ''); ?>>
                                                                            <?php echo e($district->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                            <?php $__errorArgs = ['permanent_district'];
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
                                                    <?php
                                                    if (@$job_seeker_personal_info->permanent_district) {
                                                        $permanent_city = \App\Models\City::where('district_id', $job_seeker_personal_info->permanent_district)->get();
                                                    }
                                                    ?>
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Permanent City<span
                                                                    class="red">*</span></label>
                                                            <select class="form-control" name="permanent_city"
                                                                id="permanent_city">
                                                                <option selected disabled>Select City</option>
                                                                <?php if(@$permanent_city): ?>
                                                                    <?php $__currentLoopData = $permanent_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($city->id); ?>"
                                                                            <?php echo e($city->id == $job_seeker_personal_info->permanent_city ? 'selected' : ''); ?>>
                                                                            <?php echo e($city->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                            <?php $__errorArgs = ['permanent_city'];
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

                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Date
                                                                of Birth<span class="red">*</span></label>
                                                            <input type="date" class="form-control" id=""
                                                                name="date_of_birth"
                                                                placeholder="Enter your Date of Birth"
                                                                value="<?php echo e(old('date_of_birth') ? old('date_of_birth') : (isset($job_seeker_personal_info) ? $job_seeker_personal_info->date_of_birth : '')); ?>">
                                                            <?php $__errorArgs = ['date_of_birth'];
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
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Gender<span
                                                                    class="red">*</span></label>
                                                            <select name="gender" id="" class="form-control">
                                                                <option value="" selected>--Select--
                                                                </option>
                                                                <option value="Male"
                                                                    <?php echo e(old('gender') ? (old('gender') == 'Male' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->gender == 'Male' ? 'selected' : '') : '')); ?>>
                                                                    Male</option>
                                                                <option value="Female"
                                                                    <?php echo e(old('gender') ? (old('gender') == 'Female' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->gender == 'Female' ? 'selected' : '') : '')); ?>>
                                                                    Female</option>
                                                                <option value="Other"
                                                                    <?php echo e(old('gender') ? (old('gender') == 'Other' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->gender == 'Other' ? 'selected' : '') : '')); ?>>
                                                                    Other</option>
                                                            </select>
                                                            <?php $__errorArgs = ['gender'];
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
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Mobile Number<span
                                                                    class="red">*</span></label>
                                                            <input type="text" class="form-control" id=""
                                                                name="mobile_number"
                                                                placeholder="Enter your Mobile Number"
                                                                value="<?php echo e(old('mobile_number') ? old('mobile_number') : (isset($job_seeker_personal_info) ? $job_seeker_personal_info->mobile_number : '')); ?>">
                                                            <?php $__errorArgs = ['mobile_number'];
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

                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Do
                                                                you have license?<span class="red">*</span></label>
                                                            <select name="license" id="" class="form-control">
                                                                <option value="" selected>--Select--
                                                                </option>

                                                                <option value="Yes"
                                                                    <?php echo e(old('license') ? (old('license') == 'Yes' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->have_license == 'Yes' ? 'selected' : '') : '')); ?>>
                                                                    Yes</option>
                                                                <option value="No"
                                                                    <?php echo e(old('license') ? (old('license') == 'No' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->have_license == 'No' ? 'selected' : '') : '')); ?>>
                                                                    No</option>
                                                            </select>
                                                            <?php $__errorArgs = ['license'];
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
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Do
                                                                you have vehicle?<span class="red">*</span></label>
                                                            <select name="vehicle" id="" class="form-control">
                                                                <option value="" selected>--Select--
                                                                </option>

                                                                <option value="No"
                                                                    <?php echo e(old('vehicle') ? (old('vehicle') == 'No' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->have_vehicle == 'No' ? 'selected' : '') : '')); ?>>
                                                                    No</option>
                                                                <option value="Two Wheeler"
                                                                    <?php echo e(old('vehicle') ? (old('vehicle') == 'Two Wheeler' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->have_vehicle == 'Two Wheeler' ? 'selected' : '') : '')); ?>>
                                                                    Two Wheeler</option>
                                                                <option value="Four Wheeler"
                                                                    <?php echo e(old('vehicle') ? (old('vehicle') == 'Four Wheeler' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->have_vehicle == 'Four Wheeler' ? 'selected' : '') : '')); ?>>
                                                                    Four Wheeler</option>
                                                                <option value="Both (Two Wheeler and Four Wheeler)"
                                                                    <?php echo e(old('vehicle') ? (old('vehicle') == 'Both (Two Wheeler and Four Wheeler)' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->have_vehicle == 'Both (Two Wheeler and Four Wheeler)' ? 'selected' : '') : '')); ?>>
                                                                    Both</option>
                                                            </select>
                                                            <?php $__errorArgs = ['vehicle'];
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
                                                    <div class="col-lg-4 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Maritial
                                                                Status</label>
                                                            <select name="maritial_status" id=""
                                                                class="form-control">
                                                                <option value="" selected>--Select--
                                                                </option>

                                                                <option value="Unmarried"
                                                                    <?php echo e(old('maritial_status') ? (old('maritial_status') == 'Unmarried' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->maritial_status == 'Unmarried' ? 'selected' : '') : '')); ?>>
                                                                    Unmarried</option>
                                                                <option value="Married"
                                                                    <?php echo e(old('maritial_status') ? (old('maritial_status') == 'Married' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->maritial_status == 'Married' ? 'selected' : '') : '')); ?>>
                                                                    Married</option>
                                                                <option value="Divorced"
                                                                    <?php echo e(old('maritial_status') ? (old('maritial_status') == 'Divorced' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->maritial_status == 'Divorced' ? 'selected' : '') : '')); ?>>
                                                                    Divorced</option>
                                                                <option value="Seperated"
                                                                    <?php echo e(old('maritial_status') ? (old('maritial_status') == 'Seperated' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->maritial_status == 'Seperated' ? 'selected' : '') : '')); ?>>
                                                                    Seperated</option>
                                                                <option value="Widowed"
                                                                    <?php echo e(old('maritial_status') ? (old('maritial_status') == 'Widowed' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->maritial_status == 'Widowed' ? 'selected' : '') : '')); ?>>
                                                                    Widowed</option>
                                                                <option value="Other"
                                                                    <?php echo e(old('maritial_status') ? (old('maritial_status') == 'Other' ? 'selected' : '') : (isset($job_seeker_personal_info) ? ($job_seeker_personal_info->maritial_status == 'Other' ? 'selected' : '') : '')); ?>>
                                                                    Other</option>
                                                            </select>
                                                            <?php $__errorArgs = ['maritial_status'];
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


                                                    <hr>
                                                    <div class="col-12">
                                                        <div class="tab-main-footer">
                                                            <button type="submit" name="submit" id="submit"
                                                                class="btn btn-primary btn-hover">Save Changes
                                                            </button>
                                                            <button type="submit" name="submit" id="submit"
                                                                class="btn btn-orange btn-hover">Cancel </button>
                                                        </div>
                                                    </div>

                                                </div><!--end row-->
                                            </form><!--end form-->
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

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.dropify').dropify();

        $(".field-study, .field-industry").select2({
            tags: true
        });


        $("#editPreference").click(function() {
            $(this).addClass("d-none");
            $(".right-side-content").addClass("d-none");
            $(".right-side-form").removeClass("d-none");

        });

        $(".profile-icon").on("click", function() {
            $(".mobile-profile-check").toggleClass("profile-check-toggle");
        });

        function district(e) {
            name = e.name;
            $.get('<?php echo e(route('user.district', [auth()->user()->username, ''])); ?>/' + e.value, function(data, status) {
                if (name == 'current_province') {
                    $("[name ='current_district']").find('option').remove();
                    $("[name ='current_district']").append('<option disabled selected>Select District</option>' +
                        data.html);
                } else if (name == 'permanent_province') {
                    $("[name ='permanent_district']").find('option').remove();
                    $("[name ='permanent_district']").append('<option disabled selected>Select District</option>' +
                        data.html);
                }
            });
        }

        function city(e) {
            name = e.name;
            $.get('<?php echo e(route('user.city', [auth()->user()->username, ''])); ?>/' + e.value, function(data, status) {
                if (name == 'current_district') {
                    $("[name ='current_city']").find('option').remove();
                    $("[name ='current_city']").append('<option disabled selected>Select City</option>' + data
                        .html);
                } else if (name == 'permanent_district') {
                    $("[name ='permanent_city']").find('option').remove();
                    $("[name ='permanent_city']").append('<option disabled selected>Select City</option>' + data
                        .html);
                }
            });
        }
    </script>
    <script>
        function setCurrentToPermanent() {
            value = $('#sameAddress').is(':checked');
            if (value) {
                $('[name = "permanent_province"]').prop('disabled', 'true');
                $('[name = "permanent_district"]').prop('disabled', 'true');
                $('[name = "permanent_city"]').prop('disabled', 'true');
            } else {
                $('#permanent_province').prop('disabled', false);
                $('#permanent_district').prop('disabled', false);
                $('#permanent_city').prop('disabled', false);
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/jobseeker/seeker-basic-info.blade.php ENDPATH**/ ?>