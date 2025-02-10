<?php $__env->startSection('dashboard_content'); ?>
    <div class="card candidate-info shadow-sidebar mt-4 mb-3 mt-lg-0">
        <div class="card-body p-3">
            <div class="profile-summary r-5">
                <div class="row">
                    <div class="col-md-3 col-6">
                        <div class="summary-card blue-light r-5">
                            <div class="summary-info">
                                <div class="summary-num">
                                    <?php echo e($activeCount); ?>

                                </div>
                                <a href="<?php echo e(route('employers.jobs.index', ['type' => 'active-jobs'])); ?>"
                                    class="summary-text">Active Jobs</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="summary-card purple-light r-5">
                            <div class="summary-info">
                                <div class="summary-num">
                                    <?php echo e($pendingCount); ?>

                                </div>
                                <a href="<?php echo e(route('employers.jobs.index', ['type' => 'pending-jobs'])); ?>"
                                    class="summary-text">Pending Jobs</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="summary-card orange-light r-5">
                            <div class="summary-info">
                                <div class="summary-num">
                                    <?php echo e($draftCount); ?>

                                </div>
                                <a href="<?php echo e(route('employers.jobs.index', ['type' => 'drafted-jobs'])); ?>"
                                    class="summary-text">Draft Jobs</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="summary-card green-light r-5">

                            <div class="summary-info">
                                <div class="summary-num">
                                    <?php echo e($expiredCount); ?>

                                </div>
                                <a href="<?php echo e(route('employers.jobs.index', ['type' => 'expired-jobs'])); ?>"
                                    class="summary-text">Expired Jobs</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="job-summary-tab">
                <ul class="new-3-nav nav nav-pills m-0 mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item pl-0" role="presentation">
                        <button class="nav-link active" id="pills-active-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-active" type="button" role="tab" aria-controls="pills-active"
                            aria-selected="true">Active Jobs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-pending-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-pending" type="button" role="tab" aria-controls="pills-pending"
                            aria-selected="false">Pending Jobs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-expired-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-expired" type="button" role="tab" aria-controls="pills-expired"
                            aria-selected="false">Expired
                            Jobs</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-active" role="tabpanel"
                        aria-labelledby="pills-active-tab">
                        <div class="table-responsive">
                            <table class="job-table">
                                <tr class="table-row">
                                    <th>Job Position</th>
                                    <th>Job Posting</th>
                                    <th>Job Type</th>
                                    <th>Job Level</th>
                                    <th>Job Seats</th>
                                    <th>Deadline</th>
                                    <th>Applied By</th>
                                    <th>Action</th>
                                </tr>
                                <?php $__empty_1 = true; $__currentLoopData = $activeJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activeJob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class=" table-row">
                                        <td>
                                            <div class="job-detail">
                                                <div class="job-post">
                                                    <?php echo e($activeJob->title); ?>

                                                </div>
                                                <div class="job-by">
                                                    <?php echo e($activeJob->employer->company_name); ?>

                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-type">
                                                <span class="green-light">
                                                    <?php echo e($activeJob->type == 'normal' ? 'Other' : Str::ucfirst($activeJob->type)); ?>

                                                    <?php echo e($activeJob->type !== 'megajobs' ? 'Jobs' : ''); ?>

                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-type">
                                                <span class="green-light">Full Time</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-level">
                                                <span class="orange-light"><?php echo e($activeJob->job_level->title); ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo e($activeJob->no_of_opening); ?> seats
                                        </td>
                                        <td>
                                            <div class="deadline">
                                                <?php
                                                $currentDateTime = \Carbon\Carbon::now();
                                                $endDate = \Carbon\Carbon::parse($activeJob->expiry_date);
                                                $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                                    'parts' => 2,
                                                    'short' => false,
                                                    'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                                ]);
                                                ?>
                                                <?php echo e($timeLeft); ?> Left
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <?php echo e(count($activeJob->applied_users)); ?>

                                        </td>
                                        <td>
                                            <div class="job-detail">
                                                <button class="btn btn-secondary dropdown-toggle btnborder" type="button"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Action <i class="fa-solid fa-chevron-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item"
                                                            href="<?php echo e(route('employers.jobs.edit', $activeJob->slug)); ?>">
                                                            <i class="fa-solid fa-file-pen"></i>
                                                            Edit Detail</a></li>
                                                    <?php if(request()->type == 'active-jobs' || request()->type == 'expired-jobs'): ?>
                                                        <li><a class="dropdown-item"
                                                                href="<?php echo e(route('employers.jobs.viewApplied', $activeJob->slug)); ?>">
                                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                                View Detail</a></li>
                                                    <?php endif; ?>
                                                    <li><a class="dropdown-item"
                                                            href="<?php echo e(route('employers.jobs.view', $activeJob->slug)); ?>"
                                                            target="_blank"> <i class="fa-solid fa-magnifying-glass"></i>
                                                            Preview Job</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="ConfirmDelete('<?php echo e($activeJob->slug); ?>')"><i
                                                                class="fa-solid fa-trash-can"></i>
                                                            Delete Job </a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <td class="text-center p-3" colspan=7>
                                        <h4>No Expired Jobs</h4>
                                    </td>
                                <?php endif; ?>
                            </table>
                        </div>
                        <!-- <br> -->
                        <div class="text-center my-3">
                            <a href="<?php echo e(route('employers.jobs.index', ['type' => 'active-jobs'])); ?>" type="submit"
                                id="submit" class="btn btn-primary btn-hover">Explore All Jobs </a>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="pills-pending" role="tabpanel" aria-labelledby="pills-pending-tab">
                        <div class="table-responsive">
                            <table class="job-table">
                                <tr class="table-row">
                                    <th>Job Position</th>
                                    <th>Job Posting</th>
                                    <th>Job Type</th>
                                    <th>Job Level</th>
                                    <th>Job Seats</th>
                                    <th>Deadline</th>
                                    <th>Applied By</th>
                                    <th>Action</th>
                                </tr>
                                <?php $__empty_1 = true; $__currentLoopData = $pendingJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pendingJob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class=" table-row">
                                        <td>
                                            <div class="job-detail">
                                                <div class="job-post">
                                                    <?php echo e($pendingJob->title); ?>

                                                </div>
                                                <div class="job-by">
                                                    <?php echo e($pendingJob->employer->company_name); ?>

                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-type">
                                                <span class="green-light">
                                                    <?php echo e($pendingJob->type == 'normal' ? 'Other' : Str::ucfirst($pendingJob->type)); ?>

                                                    <?php echo e($pendingJob->type !== 'megajobs' ? 'Jobs' : ''); ?>

                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-type">
                                                <span class="green-light">Full Time</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-level">
                                                <span class="orange-light"><?php echo e($pendingJob->job_level->title); ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo e($pendingJob->no_of_opening); ?> seats
                                        </td>
                                        <td>
                                            <div class="deadline">
                                                <?php
                                                $currentDateTime = \Carbon\Carbon::now();
                                                $endDate = \Carbon\Carbon::parse($pendingJob->expiry_date);
                                                $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                                    'parts' => 2,
                                                    'short' => false,
                                                    'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                                ]);
                                                ?>
                                                <?php echo e($timeLeft); ?> Left
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <?php echo e(count($pendingJob->applied_users)); ?>

                                        </td>
                                        <td>
                                            <div class="job-detail">
                                                <button class="btn btn-secondary dropdown-toggle btnborder" type="button"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Action <i class="fa-solid fa-chevron-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item"
                                                            href="<?php echo e(route('employers.jobs.edit', $pendingJob->slug)); ?>">
                                                            <i class="fa-solid fa-file-pen"></i>
                                                            Edit Detail</a></li>
                                                    <?php if(request()->type == 'active-jobs' || request()->type == 'expired-jobs'): ?>
                                                        <li><a class="dropdown-item"
                                                                href="<?php echo e(route('employers.jobs.viewApplied', $pendingJob->slug)); ?>">
                                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                                View Detail</a></li>
                                                    <?php endif; ?>
                                                    <li><a class="dropdown-item"
                                                            href="<?php echo e(route('employers.jobs.view', $pendingJob->slug)); ?>"
                                                            target="_blank"> <i class="fa-solid fa-magnifying-glass"></i>
                                                            Preview Job</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="ConfirmDelete('<?php echo e($pendingJob->slug); ?>')"><i
                                                                class="fa-solid fa-trash-can"></i>
                                                            Delete Job </a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <td class="text-center p-3" colspan=7>
                                        <h4>No Expired Jobs</h4>
                                    </td>
                                <?php endif; ?>
                            </table>
                        </div>
                        <!-- <br> -->
                        <div class="text-center my-3">
                            <a href="<?php echo e(route('employers.jobs.index', ['type' => 'pending-jobs'])); ?>" type="submit"
                                id="submit" class="btn btn-primary btn-hover">Explore All Jobs </a>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-expired" role="tabpanel" aria-labelledby="pills-expired-tab">
                        <div class="table-responsive">
                            <table class="job-table">
                                <tr class="table-row">
                                    <th>Job Position</th>
                                    <th>Job Posting</th>
                                    <th>Job Type</th>
                                    <th>Job Level</th>
                                    <th>Job Seats</th>
                                    <th>Deadline</th>
                                    <th>Applied By</th>
                                    <th>Action</th>
                                </tr>
                                <?php $__empty_1 = true; $__currentLoopData = $expiredJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expiredJob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class=" table-row">
                                        <td>
                                            <div class="job-detail">
                                                <div class="job-post">
                                                    <?php echo e($expiredJob->title); ?>

                                                </div>
                                                <div class="job-by">
                                                    <?php echo e($expiredJob->employer->company_name); ?>

                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-type">
                                                <span class="green-light">
                                                    <?php echo e($expiredJob->type == 'normal' ? 'Other' : Str::ucfirst($expiredJob->type)); ?>

                                                    <?php echo e($expiredJob->type !== 'megajobs' ? 'Jobs' : ''); ?>

                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-type">
                                                <span class="green-light">Full Time</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="job-level">
                                                <span class="orange-light"><?php echo e($expiredJob->job_level->title); ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo e($expiredJob->no_of_opening); ?> seats
                                        </td>
                                        <td>
                                            <div class="deadline">
                                                <?php
                                                $currentDateTime = \Carbon\Carbon::now();
                                                $endDate = \Carbon\Carbon::parse($expiredJob->expiry_date);
                                                $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                                    'parts' => 2,
                                                    'short' => false,
                                                    'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                                ]);
                                                ?>
                                                <?php echo e($timeLeft); ?> Left
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <?php echo e(count($expiredJob->applied_users)); ?>

                                        </td>
                                        <td>
                                            <div class="job-detail">
                                                <button class="btn btn-secondary dropdown-toggle btnborder" type="button"
                                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Action <i class="fa-solid fa-chevron-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item"
                                                            href="<?php echo e(route('employers.jobs.edit', $expiredJob->slug)); ?>">
                                                            <i class="fa-solid fa-file-pen"></i>
                                                            Edit Detail</a></li>
                                                    <?php if(request()->type == 'active-jobs' || request()->type == 'expired-jobs'): ?>
                                                        <li><a class="dropdown-item"
                                                                href="<?php echo e(route('employers.jobs.viewApplied', $expiredJob->slug)); ?>">
                                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                                View Detail</a></li>
                                                    <?php endif; ?>
                                                    <li><a class="dropdown-item"
                                                            href="<?php echo e(route('employers.jobs.view', $expiredJob->slug)); ?>"
                                                            target="_blank"> <i class="fa-solid fa-magnifying-glass"></i>
                                                            Preview Job</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="ConfirmDelete('<?php echo e($expiredJob->slug); ?>')"><i
                                                                class="fa-solid fa-trash-can"></i>
                                                            Delete Job </a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <td class="text-center p-3" colspan=7>
                                        <h4>No Expired Jobs</h4>
                                    </td>
                                <?php endif; ?>
                            </table>
                        </div>
                        <!-- <br> -->
                        <div class="text-center my-3">
                            <a href="<?php echo e(route('employers.jobs.index', ['type' => 'expired-jobs'])); ?>" type="submit"
                                id="submit" class="btn btn-primary btn-hover">Explore All Jobs </a>
                        </div>

                    </div>
                </div>
            </div>
        </div><!--end card-->
    </div><!--end col-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employer.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/employer/dashboard.blade.php ENDPATH**/ ?>