    <div class="shows-result">
        <div class="results-list">
            Showing <span class="numbers"> <?php echo e($jobs->firstItem()); ?> - <?php echo e($jobs->lastItem()); ?> job of
                <?php echo e($jobs->total()); ?> vacancy/s </span>

        </div>
        <div class="result-date">
            <div class="filter-show-btn">
                <span class="show-icon">
                    <i class="fa-solid fa-filter"></i>
                </span>
            </div>
            <div class="dropdown">
                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Short By: (Date)
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><button type="" class="dropdown-item filter" value="latest">Latest
                            Post</button></li>
                    <li><button class="dropdown-item filter" value="old">Oldest
                            Post</button></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="jobs-list">
        <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="job-box card mt-2">
                <div class="p-2 pb-2">
                    <div class="job-list-card">
                        <div class="company-image">
                            <a href="<?php echo e(route('employer_detail', $job->employer->slug)); ?>"><img
                                    src="<?php echo e(asset('storage/employer/logo' . $job->employer->logo)); ?>"
                                    alt="<?php echo e($job->employer->company_name); ?>" width="83px"
                                    class="img-fluid rounded-3"></a>
                        </div>
                        <div class="job-desc-company">
                            <div class="mt-3 mt-lg-0">
                                <h5 class="fs-18 mb-0"><a href="<?php echo e(route('job_single', $job->slug)); ?>"
                                        class="text-dark">
                                        <?php echo e($job->title); ?></a>
                                </h5>
                                <p class="fs-14 mb-1">
                                    <a href="<?php echo e(route('employer_detail', $job->employer->slug)); ?>" class="text-dark">
                                        <?php echo e($job->employer->company_name); ?>

                                    </a>
                                </p>
                            </div>
                            <div class="job-main-info">
                                <div class="location">
                                    <span class="icon">
                                        <i class="fa-solid fa-location-dot fs-13"></i>
                                    </span>
                                    <span class="fs-14"><?php echo e($job->city->name); ?></span>
                                </div>
                            </div>
                            <div class="job-key-skills">
                                <div class="skills-info">
                                    <span class="icon">
                                        <i class="fa-regular fa-lightbulb fs-13"></i>
                                    </span>
                                    Key Skills:
                                </div>

                                <div class="skills-lists">
                                    <?php if(!is_null($job->skill) || !empty($job->skill)): ?>
                                        <?php $__currentLoopData = $job->skill; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="list-skill">
                                                <?php echo e($skill->title); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="list-card-bottom">
                        <div class="time-span">
                            <span class="icon">
                                <i class="fa-regular fa-clock"></i>
                            </span>
                            <?php
                                        $currentDateTime = \Carbon\Carbon::now();
                                        $endDate = \Carbon\Carbon::parse($job->expiry_date);
                                    
                                        if ($currentDateTime->gt($endDate)) {
                                            $timeLeft = 'Expired';
                                        } else {
                                            $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                                'parts' => 2,
                                                'short' => false,
                                                'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                            ]);
                                        }
                                    ?>
                            <?php echo e($timeLeft); ?> Left

                        </div>
                        <div class="apply-btn">
                            <a href="<?php echo e(route('job_single', $job->slug)); ?>" class="btn btn-outline">Apply
                                Now</a>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="no-result-found">
                <h2>No Result Found.</h2>
            </div>
        <?php endif; ?>
        <div class="pagination-wrapper">
            <?php echo e($jobs->links('pagination::bootstrap-5')); ?>

        </div>
    </div><?php /**PATH /home/megajobn/public_html/resources/views/user/layout/job-content.blade.php ENDPATH**/ ?>