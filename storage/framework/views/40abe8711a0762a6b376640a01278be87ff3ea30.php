<?php $__env->startSection('title', 'Profile Status | Job Seeker'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content">

        <div class="page-content">
            <!-- START CANDIDATE-DETAILS -->
            <section class="section dashboard-section">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <?php echo $__env->make('user.jobseeker.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        </div><!--end col-->

                        <div class="col-lg-9 col-md-8">
                            <div class="card candidate-info new-shadow-sidebar mt-4 mb-3 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="profile-summary r-5">
                                        <div class="row">
                                            <div class="col-6 col-md-6 col-lg-3">
                                                <div class="summary-card blue-light r-5">
                                                    <div class="summary-info">
                                                        <div class="summary-num">
                                                            <?php echo e($user_apply_jobs->count()); ?>

                                                        </div>
                                                        <a href="<?php echo e(route('user.apply_job', auth()->user()->username)); ?>"
                                                            class="summary-text">Job
                                                            Applied</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6 col-lg-3">
                                                <div class="summary-card orange-light r-5">
                                                    <div class="summary-info">
                                                        <div class="summary-num">
                                                            <?php echo e($profile_visits->count()); ?>

                                                        </div>
                                                        <a href="<?php echo e(route('user.profile_visit', auth()->user()->username)); ?>"
                                                            class="summary-text">Profile
                                                            Visits
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6 col-lg-3">
                                                <div class="summary-card green-light r-5">

                                                    <div class="summary-info">
                                                        <div class="summary-num">
                                                            <?php echo e($user_saves_jobs->count()); ?>

                                                        </div>
                                                        <a href="<?php echo e(route('user.save_job', auth()->user()->username)); ?>"
                                                            class="summary-text">Saved
                                                            Jobs</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6 col-lg-3">
                                                <div class="summary-card red-light r-5">

                                                    <div class="summary-info">
                                                        <div class="summary-num">
                                                            <?php echo e($download_cvs->count()); ?>

                                                        </div>
                                                        <a href="<?php echo e(route('user.download_cv', auth()->user()->username)); ?>"
                                                            class="summary-text">CV
                                                            Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card candidate-info new-shadow-sidebar statistics-nav mt-0 mb-3 mt-lg-0">
                                <div class="card-body p-0">
                                    <div class="job-summary-tab mt-0">
                                        <ul class="nav nav-pills new-3-nav m-0 mb-3" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="pills-recently-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-recently" type="button"
                                                    role="tab" aria-controls="pills-recently" aria-selected="false">
                                                    Jobs Applied
                                                    <span class="number-right green">
                                                        <?php echo e($user_apply_jobs->count()); ?>

                                                    </span>
                                                </button>
                                            </li>
                                            <li class="nav-item pl-0" role="presentation">
                                                <button class="nav-link" id="pills-matching-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-matching" type="button" role="tab"
                                                    aria-controls="pills-matching" aria-selected="true">
                                                    Profile Visits
                                                    <span class="number-right orange">
                                                        <?php echo e($profile_visits->count()); ?>

                                                    </span>
                                                </button>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-saved-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-saved" type="button" role="tab"
                                                    aria-controls="pills-saved" aria-selected="false">
                                                    Saved
                                                    Jobs
                                                    <span class="number-right green">
                                                        <?php echo e($user_saves_jobs->count()); ?>

                                                    </span>
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-cv-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-cv" type="button" role="tab"
                                                    aria-controls="pills-cv" aria-selected="false">
                                                    CV
                                                    Downloads

                                                    <span class="number-right orange">
                                                        <?php echo e($download_cvs->count()); ?>

                                                    </span>
                                                </button>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-recently" role="tabpanel"
                                                aria-labelledby="pills-recently-tab">
                                                <div class="table-responsive">
                                                    <table class="job-table">
                                                        <tr class="table-row">
                                                            <th>Company</th>
                                                            <th>Job Position</th>
                                                            <th>Job Type</th>
                                                            <th>Job Level</th>
                                                            <th>Deadline</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        <?php $__currentLoopData = $user_apply_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <div class="company-logo">
                                                                        <img src="<?php echo e(asset('storage/employer/logo' . $job->job->employer->logo)); ?>"
                                                                            class="img-fluid"
                                                                            alt="<?php echo e($job->job->employer->slug); ?>">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-detail">
                                                                        <div class="job-post">
                                                                            <?php echo e($job->job->title); ?>

                                                                        </div>
                                                                        <div class="job-by">
                                                                            <?php echo e($job->job->company_name); ?>

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-type">
                                                                        <span
                                                                            class="green-light"><?php echo e($job->job->employee_type->title); ?></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-level">
                                                                        <span
                                                                            class="orange-light"><?php echo e($job->job->job_level->title); ?></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="deadline">
                                                                        <?php
                                                                        $currentDateTime = \Carbon\Carbon::now();
                                                                        $endDate = \Carbon\Carbon::parse($job->job->expiry_date);
                                                                        $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                                                            'parts' => 2,
                                                                            'short' => false,
                                                                            'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                                                        ]);
                                                                        ?>
                                                                        <?php echo e($timeLeft); ?> Left
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-status">
                                                                        <span class="blue-light">
                                                                            Applied
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-detail">
                                                                        <a href="<?php echo e(route('job_single', $job->job->slug)); ?>"
                                                                            class="btn btn-border">
                                                                            View Detail
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </table>
                                                </div>
                                                <!-- <br> -->
                                                <div class="text-center my-3">
                                                    <a href="<?php echo e(route('user.apply_job', auth()->user()->username)); ?>"
                                                        name="submit" id="submit"
                                                        class="btn btn-primary btn-hover">Explore All
                                                        Jobs </a>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-matching" role="tabpanel"
                                                aria-labelledby="pills-matching-tab">
                                                <div class="table-responsive">
                                                    <table class="job-table">
                                                        <tr class="table-row">
                                                            <th>Company</th>
                                                            <th>Job Position</th>
                                                            <th>Job Type</th>
                                                            <th>Job Level</th>
                                                            <th>Applied Date</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        <?php $__currentLoopData = $profile_visits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <div class="company-logo">
                                                                        <img src="<?php echo e(asset('storage/employer/logo' . $job->job->employer->logo)); ?>"
                                                                            class="img-fluid"
                                                                            alt="<?php echo e($job->job->employer->slug); ?>">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-detail">
                                                                        <div class="job-post">
                                                                            <?php echo e($job->job->title); ?>

                                                                        </div>
                                                                        <div class="job-by">
                                                                            <?php echo e($job->job->company_name); ?>

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-type">
                                                                        <span
                                                                            class="green-light"><?php echo e($job->job->employee_type->title); ?></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-level">
                                                                        <span
                                                                            class="orange-light"><?php echo e($job->job->job_level->title); ?></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="deadline">
                                                                        <?php echo e($job->created_at); ?>

                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-status">
                                                                        <span class="green-light">
                                                                            Screen
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-detail">
                                                                        <a href="<?php echo e(route('job_single', $job->job->slug)); ?>"
                                                                            class="btn btn-border">
                                                                            View Detail
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </table>
                                                </div>
                                                <!-- <br> -->
                                                <div class="text-center my-3">
                                                    <a href="<?php echo e(route('user.profile_visit', auth()->user()->username)); ?>"
                                                        name="submit" id="submit"
                                                        class="btn btn-primary btn-hover">Explore All Jobs </a>
                                                </div>

                                            </div>

                                            <div class="tab-pane fade" id="pills-saved" role="tabpanel"
                                                aria-labelledby="pills-saved-tab">
                                                <div class="table-responsive">
                                                    <table class="job-table">
                                                        <tr class="table-row">
                                                            <th>Company</th>
                                                            <th>Job Position</th>
                                                            <th>Job Type</th>
                                                            <th>Job Level</th>
                                                            <th>Deadline</th>
                                                            <th>Action</th>
                                                            <th width="35px">
                                                            </th>
                                                        </tr>
                                                        <?php $__currentLoopData = $user_saves_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $save_job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <div class="company-logo">
                                                                        <img src="<?php echo e(asset('storage/employer/logo' . $save_job->job->employer->logo)); ?>"
                                                                            class="img-fluid"
                                                                            alt="<?php echo e($save_job->job->employer->slug); ?>">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-detail">
                                                                        <div class="job-post">
                                                                            <?php echo e($save_job->job->title); ?>

                                                                        </div>
                                                                        <div class="job-by">
                                                                            <?php echo e($save_job->job->company_name); ?>

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-type">
                                                                        <span class="green-light">
                                                                            <?php echo e($save_job->job->employee_type->title); ?></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-level">
                                                                        <span
                                                                            class="orange-light"><?php echo e($save_job->job->job_level->title); ?></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="deadline">
                                                                        <?php
                                                                        $currentDateTime = \Carbon\Carbon::now();
                                                                        $endDate = \Carbon\Carbon::parse($save_job->job->expiry_date);
                                                                        $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                                                            'parts' => 2,
                                                                            'short' => false,
                                                                            'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                                                        ]);
                                                                        ?>
                                                                        <?php echo e($timeLeft); ?> Left
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-detail">
                                                                        <a target="_blank"
                                                                            href="<?php echo e(route('job_single', $save_job->job->slug)); ?>"
                                                                            class="btn btn-border">
                                                                            View Detail
                                                                        </a>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </table>
                                                </div>
                                                <!-- <br> -->
                                                <div class="text-center my-3">
                                                    <a href="<?php echo e(route('user.save_job', auth()->user()->username)); ?>"
                                                        name="submit" id="submit"
                                                        class="btn btn-primary btn-hover">Explore All
                                                        Jobs </a>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="pills-cv" role="tabpanel"
                                                aria-labelledby="pills-cv-tab">
                                                <div class="table-responsive">
                                                    <table class="job-table">
                                                        <tr class="table-row">
                                                            <th>Company</th>
                                                            <th>Job Position</th>
                                                            <th>Job Type</th>
                                                            <th>Job Level</th>
                                                            <th>Applied Date</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        <?php $__currentLoopData = $download_cvs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr class="table-row">
                                                                <td>
                                                                    <div class="company-logo">
                                                                        <img src="<?php echo e(asset('storage/employer/logo' . $job->job->employer->logo)); ?>"
                                                                            class="img-fluid"
                                                                            alt="<?php echo e($job->job->employer->slug); ?>">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-detail">
                                                                        <div class="job-post">
                                                                            <?php echo e($job->job->title); ?>

                                                                        </div>
                                                                        <div class="job-by">
                                                                            <?php echo e($job->job->company_name); ?>

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-type">
                                                                        <span
                                                                            class="green-light"><?php echo e($job->job->employee_type->title); ?></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-level">
                                                                        <span
                                                                            class="orange-light"><?php echo e($job->job->job_level->title); ?></span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="deadline">
                                                                        <?php echo e($job->created_at); ?>

                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-status">
                                                                        <span class="green-light">
                                                                            Download
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="job-detail">
                                                                        <a href="<?php echo e(route('job_single', $job->job->slug)); ?>"
                                                                            class="btn btn-border">
                                                                            View Detail
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </table>
                                                </div>
                                                <!-- <br> -->
                                                <div class="text-center my-3">
                                                    <a href="<?php echo e(route('user.download_cv', auth()->user()->username)); ?>"
                                                        name="submit" id="submit"
                                                        class="btn btn-primary btn-hover">Explore All
                                                        Jobs </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div><!--end card-->
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end container-->
            </section>
            <!-- END CANDIDATE-DETAILS -->

        </div>
        <!-- End Page-content -->




        <!--start back-to-top-->
        <button onclick="topFunction()" id="back-to-top">
            <i class="mdi mdi-arrow-up"></i>
        </button>



    <?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/jobseeker/seeker-statistics.blade.php ENDPATH**/ ?>