<?php
$title = ucwords(str_replace('-', ' ', request()->type));
$type = request()->type;
$allowed = ['active-jobs'];
if (in_array($type, $allowed)) {
    $allow = true;
} else {
    $allow = false;
}
?>

<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('dashboard_content'); ?>
    <div class="card candidate-info new-shadow-sidebar job-manage-section mt-4 mb-3 mt-lg-0">
        <div class="card-body p-3 px-0 pt-0">
            <div class="job-summary-tab mt-0">
                <ul class="new-column nav nav-pills new-3-nav mb-3 m-0" id="pills-tab" role="tablist">
                    <li class="nav-item pl-0" role="presentation">
                        <a href="<?php echo e(route('employers.jobs.index', ['type' => 'active-jobs'])); ?>"
                            class="nav-link <?php echo e(request()->type == 'active-jobs' ? 'active' : ''); ?>"><i
                                class="fa-regular fa-circle-check"></i>
                            Active Jobs (<?php echo e($activeJobs); ?>)</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="<?php echo e(route('employers.jobs.index', ['type' => 'pending-jobs'])); ?>"
                            class="nav-link <?php echo e(request()->type == 'pending-jobs' ? 'active' : ''); ?>"><i
                                class="fa-solid fa-hourglass-half"></i>
                            Pending Jobs (<?php echo e($pendingJobs); ?>)</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="<?php echo e(route('employers.jobs.index', ['type' => 'drafted-jobs'])); ?>"
                            class="nav-link <?php echo e(request()->type == 'drafted-jobs' ? 'active' : ''); ?>"><i
                                class="fa-solid fa-table-list"></i>
                            Drafted Jobs (<?php echo e($draftedJobs); ?>)</a>
                    </li>

                    <li class="nav-item pr-0" role="presentation">
                        <a href="<?php echo e(route('employers.jobs.index', ['type' => 'denied-jobs'])); ?>"
                            class="nav-link <?php echo e(request()->type == 'denied-jobs' ? 'active' : ''); ?>"><i
                                class="fa-regular fa-circle-xmark"></i> Denied Jobs
                            (<?php echo e($deniedJobs); ?>)</a>
                    </li>
                    <li class="nav-item pr-0" role="presentation">
                        <a href="<?php echo e(route('employers.jobs.index', ['type' => 'expired-jobs'])); ?>"
                            class="nav-link <?php echo e(request()->type == 'expired-jobs' ? 'active' : ''); ?>"><i
                                class="fa-solid fa-circle-exclamation"></i> Expired Jobs
                            (<?php echo e($expiredJobs); ?>)</a>
                    </li>

                </ul>
                <div class="tab-content  px-3" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                        aria-labelledby="pills-profile-tab">
                        <div class="personal-info-form">
                            <div class="card candidate-info shadow-sidebar mt-0 mb-3 mt-lg-0">
                                <div class="card-body p-0">
                                    <div class="job-summary-tab mt-0">
                                        <div class="table-responsive">
                                            <table class="job-table">
                                                <tr class="table-row">
                                                    <th>Job Position</th>
                                                    <th>Job Posting</th>
                                                    <th>Job Type</th>
                                                    <th>Job Level</th>
                                                    <th>Job Seats</th>
                                                    <?php if($allow): ?>
                                                        <th>Deadline</th>
                                                        <th>Applied By</th>
                                                    <?php endif; ?>
                                                    <?php if(request()->type == 'expired-jobs'): ?>
                                                        <th>Expires On</th>
                                                    <?php endif; ?>
                                                    <?php if(request()->type == 'denied-jobs'): ?>
                                                        <th>Reason for Disapproval</th>
                                                    <?php endif; ?>
                                                    <th>Action</th>
                                                </tr>
                                                <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr class="table-row">

                                                        <td>
                                                            <div class="job-detail">
                                                                <div class="job-post">
                                                                    <?php echo e($job->title); ?>

                                                                </div>
                                                                <div class="job-by">
                                                                    <?php echo e(auth()->user()->employer->company_name); ?>

                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="job-type">
                                                                <span class="green-light">
                                                                    <?php echo e($job->type == 'normal' ? 'Other' : Str::ucfirst($job->type)); ?>

                                                                    <?php echo e($job->type !== 'megajobs' ? 'Jobs' : ''); ?>

                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="job-type">
                                                                <span
                                                                    class="green-light"><?php echo e(@$job->employee_type->title); ?></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="job-level">
                                                                <span
                                                                    class="orange-light"><?php echo e($job->job_level->title); ?></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?php echo e($job->no_of_opening); ?> seats
                                                        </td>
                                                        <?php if($allow): ?>
                                                            <td>
                                                                <div class="deadline">
                                                                    <?php
                                                                    $currentDateTime = \Carbon\Carbon::now();
                                                                    $endDate = \Carbon\Carbon::parse($job->expiry_date);
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
                                                                <?php echo e($job->applied_users->count()); ?>

                                                            </td>
                                                        <?php endif; ?>
                                                        <?php if(request()->type == 'expired-jobs'): ?>
                                                            <td><?php echo e(date('d M, Y', strtotime($job->expiry_date))); ?></td>
                                                        <?php endif; ?>
                                                        <?php if(request()->type == 'denied-jobs'): ?>
                                                            <td><a href="#"
                                                                    onclick="message(`<?php echo $job->declined_reason; ?>`)">
                                                                    <?php echo e(Str::limit($job->declined_reason, 20)); ?></a></td>
                                                        <?php endif; ?>
                                                        <td>
                                                            <div class="job-detail">
                                                                <button class="btn btn-secondary dropdown-toggle btnborder"
                                                                    type="button" id="dropdownMenuButton1"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Action <i class="fa-solid fa-chevron-down"></i>
                                                                </button>
                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuButton1">
                                                                    <li><a class="dropdown-item"
                                                                            href="<?php echo e(route('employers.jobs.edit', $job->slug)); ?>">
                                                                            <i class="fa-solid fa-file-pen"></i>
                                                                            Edit Detail</a></li>
                                                                    <?php if(request()->type == 'active-jobs' || request()->type == 'expired-jobs'): ?>
                                                                        <li><a class="dropdown-item"
                                                                                href="<?php echo e(route('employers.jobs.viewApplied', $job->slug)); ?>">
                                                                                <i class="fa-solid fa-magnifying-glass"></i>
                                                                                View Detail</a></li>
                                                                    <?php endif; ?>
                                                                    <li><a class="dropdown-item"
                                                                            href="<?php echo e(route('employers.jobs.view', $job->slug)); ?>"
                                                                            target="_blank"> <i
                                                                                class="fa-solid fa-magnifying-glass"></i>
                                                                            Preview Job</a></li>
                                                                    <li><a class="dropdown-item" href="#"
                                                                            onclick="ConfirmDelete('<?php echo e($job->slug); ?>')"><i
                                                                                class="fa-solid fa-trash-can"></i>
                                                                            Delete Job </a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr class="table-row">
                                                        <td>
                                                            <h5>No <?php echo e(strtolower($title)); ?> to show</h5>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </table>
                                        </div>
                                    </div>
                                </div><!--end card-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(request()->type == 'denied-jobs'): ?>
        <div class="modal fade" id="showMessage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Reason For Disapproval</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="reasonForDisaaproval">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        function message(data) {
            $('#reasonForDisaaproval').append(data);
            $('#showMessage').modal('show');
        }

        function ConfirmDelete(slug) {
            swal({
                title: "Are you sure?",
                text: "You will deleteing this post from the system",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        method: 'POST',
                        url: "<?php echo e(route('employers.jobs.delete')); ?>",
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            slug: slug,
                        },
                        success: function(res) {
                            status = res.status;
                            message = res.message;

                            if (status == 200) {
                                swal({
                                    title: "Deleted",
                                    text: message,
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#28a745",
                                    confirmButtonText: "Okay",
                                    closeOnConfirm: false,
                                    closeOnCancel: false
                                }, function(isConfirm) {
                                    if (isConfirm) {
                                        window.reload();
                                    }
                                });
                            } else {
                                swal("Error", status + ' : ' + message, "error");
                            }
                        },
                        error: function(data) {
                            alert(data.responsetxt);
                        }
                    })
                } else {
                    swal("Cancelled", "Your post is safe :)", "error");
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('employer.overview-jobs.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/employer/overview-jobs/manage-jobs.blade.php ENDPATH**/ ?>