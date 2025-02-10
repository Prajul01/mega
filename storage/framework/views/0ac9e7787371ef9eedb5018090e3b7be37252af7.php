
<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .new-col-5 {
            gap: 8px
        }

        .new-col-5 .card {
            width: calc(20% - 8px);
        }

        @media only screen and (max-width: 1200px) {
            .new-col-5 .card .icon-in-bg {
                width: 49px;
                height: 49px
            }
        }

        @media only screen and (max-width: 998px) {
            .new-col-5 .card {
                width: calc(33.33% - 8px);
                margin-bottom: 10px !important;
            }
        }

        @media only screen and (max-width: 700px) {
            .new-col-5 .card {
                width: 100%;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row new-col-5 clearfix mt-3">
            <div class="card">
                <div class="body" style="border-radius:20px;">
                    <a href="<?php echo e(route('admin.jobPosting.index', 'megajobs')); ?>" class="full-link"></a>
                    <div class="d-flex align-items-center">
                        <div class="icon-in-bg bg-light rounded-circle"><img
                                src="<?php echo e(asset('frontend/assets/images/target.png')); ?>" style="width:40px;"></div>
                        <div class="ml-4"><span>Mega Jobs</span>
                            <h4 class="mb-0 font-weight-medium"><?php echo e($megajobs); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="body" style="border-radius:20px;">
                    <a href="<?php echo e(route('admin.jobPosting.index', 'premium-jobs')); ?>" class="full-link"></a>
                    <div class="d-flex align-items-center">
                        <div class="icon-in-bg bg-light rounded-circle"><img
                                src="<?php echo e(asset('frontend/assets/images/premium.png')); ?>" style="width:40px;"></div>
                        <div class="ml-4"><span>Premium Jobs</span>
                            <h4 class="mb-0 font-weight-medium"><?php echo e($premiumJobs); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="body" style="border-radius:20px;">
                    <a href="<?php echo e(route('admin.jobPosting.index', 'prime-jobs')); ?>" class="full-link"></a>
                    <div class="d-flex align-items-center">
                        <div class="icon-in-bg bg-light rounded-circle"><img
                                src="<?php echo e(asset('frontend/assets/images/prime-service.png')); ?>" style="width:40px;"></div>
                        <div class="ml-4"><span>Prime Jobs</span>
                            <h4 class="mb-0 font-weight-medium"><?php echo e($primeJobs); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="body" style="border-radius:20px;">
                    <a href="<?php echo e(route('admin.jobPosting.index', 'other-jobs')); ?>" class="full-link"></a>
                    <div class="d-flex align-items-center">
                        <div class="icon-in-bg bg-light rounded-circle"><img
                                src="<?php echo e(asset('storage/setting/favicon/' . $setting->favicon)); ?>" style="width:40px;">
                        </div>
                        <div class="ml-4"><span>Latest Jobs</span>
                            <h4 class="mb-0 font-weight-medium"><?php echo e($normalJobs); ?></h4>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="body" style="border-radius:20px;">
                    <a href="<?php echo e(route('admin.jobPosting.index', 'other-jobs')); ?>" class="full-link"></a>
                    <div class="d-flex align-items-center">
                        <div class="icon-in-bg bg-light rounded-circle"><img
                                src="<?php echo e(asset('storage/setting/favicon/' . $setting->favicon)); ?>" style="width:40px;">
                        </div>
                        <div class="ml-4"><span>Newspaper Jobs</span>
                            <h4 class="mb-0 font-weight-medium"><?php echo e($newspaperCount); ?></h4>
                        </div>
                    </div>
                    
                </div>
            </div>


        </div>
    </div>

    <div class="row clearfix mb-3">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="body" style="border-radius:20px;">
                    <a href="<?php echo e(route('admin.admin-management.index')); ?>" class="full-link"></a>
                    <div class="d-flex align-items-center">
                        <div class="icon-in-bg bg-light rounded-circle"><img
                                src="<?php echo e(asset('frontend/assets/images/premium.png')); ?>" style="width:40px;"></div>
                        <div class="ml-4"><span>Admin</span>
                            <h4 class="mb-0 font-weight-medium"><?php echo e($admins); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="body" style="border-radius:20px;">
                    <a href="<?php echo e(route('admin.adminUsers.index')); ?>" class="full-link"></a>
                    <div class="d-flex align-items-center">
                        <div class="icon-in-bg bg-light rounded-circle text-danger"><i class="fa fa-user fa-2x"></i>
                        </div>
                        <div class="ml-4"><span>Users</span>
                            <h4 class="mb-0 font-weight-medium"><?php echo e($users); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="body" style="border-radius:20px;">
                    <a href="<?php echo e(route('admin.employers.index')); ?>" class="full-link"></a>
                    <div class="d-flex align-items-center">
                        <div class="icon-in-bg bg-light rounded-circle text-danger"><i class="fa fa-handshake-o fa-2x"></i>
                        </div>
                        <div class="ml-4"><span>Employers</span>
                            <h4 class="mb-0 font-weight-medium"><?php echo e($employers); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="body" style="border-radius:20px;">
                    <a href="<?php echo e(route('admin.users.admins.index')); ?>" class="full-link"></a>
                    <div class="d-flex align-items-center">
                        <div class="icon-in-bg bg-light rounded-circle text-danger"><i class="fa fa-users fa-2x"></i>
                        </div>
                        <div class="ml-4"><span>Job Seekers</span>
                            <h4 class="mb-0 font-weight-medium"><?php echo e($jobSeekers); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix mb-3">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="body" style="border-radius:20px;">
                    <a href="<?php echo e(route('admin.employers.index')); ?>" class="full-link"></a>
                    <div class="d-flex align-items-center">
                        <div class="icon-in-bg bg-light rounded-circle text-success"><i class="fa fa-user-plus fa-2x"></i>
                        </div>
                        <div class="ml-4"><span>Verified Employers</span>
                            <h4 class="mb-0 font-weight-medium"><?php echo e($verifiedEmployers); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="body" style="border-radius:20px;">
                    <a href="<?php echo e(route('admin.employers.index')); ?>" class="full-link"></a>
                    <div class="d-flex align-items-center">
                        <div class="icon-in-bg bg-light rounded-circle text-danger"><i class="fa fa-user-times fa-2x"></i>
                        </div>
                        <div class="ml-4"><span>Unverified Users</span>
                            <h4 class="mb-0 font-weight-medium"><?php echo e($unverifiedEmployers); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="body" style="border-radius:20px;">
                    <a href="<?php echo e(route('admin.users.admins.index')); ?>" class="full-link"></a>
                    <div class="d-flex align-items-center">
                        <div class="icon-in-bg bg-light rounded-circle text-success"><i class="fa fa-user-plus fa-2x"></i>
                        </div>
                        <div class="ml-4"><span>Verified Job Seekers</span>
                            <h4 class="mb-0 font-weight-medium"><?php echo e($verifiedJobSeekers); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="body" style="border-radius:20px;">
                    <a href="<?php echo e(route('admin.users.admins.index', ['q' => 'unverified-users'])); ?>" class="full-link"></a>
                    <div class="d-flex align-items-center">
                        <div class="icon-in-bg bg-light rounded-circle text-danger"><i class="fa fa-user-times fa-2x"></i>
                        </div>
                        <div class="ml-4"><span>Unverified Job Seekers</span>
                            <h4 class="mb-0 font-weight-medium"><?php echo e($unverifiedJobSeekers); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body" style="border-radius:20px;">
                    <div class="card-head mb-4">
                        <h4><i class="fa fa-handshake-o text-danger"></i>&nbsp;Job Requests</h4>
                    </div>
                    <div class="table-responsive" style="max-height: 500px;overflow: scroll;">
                        <table class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th class="bg-secondary text-white">#</th>
                                    <th class="bg-secondary text-white">Title</th>
                                    <th class="bg-secondary text-white">Company Name</th>
                                    <th class="bg-secondary text-white">Office Number</th>
                                    <th class="bg-secondary text-white">Status</th>
                                    <th class="bg-secondary text-white">Job Type</th>
                                    <th class="bg-secondary text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $jobRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $jobRequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e(++$key); ?></td>
                                        <td><?php echo e($jobRequest->title); ?></td>
                                        <td><?php echo e($jobRequest->employer->company_name); ?></td>
                                        <td><?php echo e($jobRequest->employer->office_number); ?></td>
                                        <td><span
                                                class="badge badge-<?php echo e($jobRequest->approval == 'approved' ? 'success' : ($jobRequest->approval == 'pending' ? 'primary' : 'danger')); ?>"><?php echo e($jobRequest->approval); ?></span>
                                        </td>
                                        <td><span class="badge badge-success">
                                                <?php if($jobRequest->type == 'prime'): ?>
                                                    Prime Job
                                                <?php elseif($jobRequest->type == 'mega'): ?>
                                                    Megajob
                                                <?php elseif($jobRequest->type == 'premium'): ?>
                                                    Premium Job
                                                <?php else: ?>
                                                    Latest Job
                                                <?php endif; ?>
                                            </span></td>
                                        <td class="d-flex">
                                            <a href="<?php echo e(route('admin.jobRequest.show', $jobRequest->slug)); ?>"
                                                target="_blank" class="btn btn-outline-primary mx-1"><i
                                                    class="fa fa-eye"></i></a>
                                            <?php if($jobRequest->approval != 'approved'): ?>
                                                <button type="button" value="approved" title="Approve"
                                                    data-id="<?php echo e($jobRequest->slug); ?>"
                                                    class="btn job-settings btn-success mx-1"><i
                                                        class="fa fa-check"></i></button>
                                            <?php endif; ?>
                                            <?php if($jobRequest->approval != 'declined'): ?>
                                                <button type="button" value="declined" title="Decline"
                                                    data-id="<?php echo e($jobRequest->slug); ?>"
                                                    class="btn btn-danger job-settings mx-1"><i
                                                        class="fa fa-times"></i></button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan=6 class="text-center">
                                            <h4>There are no job requests</h4>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <?php if(count($jobRequests) > 0): ?>
                            <div class="col-12">
                                <div class="text-center">
                                    <a href="<?php echo e(route('admin.jobRequest.index')); ?>" class="btn btn-success">View
                                        More&nbsp;<i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body" style="border-radius:20px">
                    <div class="card-head mb-4">
                        <h5><i class="fa fa-briefcase text-danger"></i>&nbsp;Industry Jobs</h5>
                    </div>
                    <div class="table-responsive" style="max-height: 500px;overflow: scroll;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-white">#</th>
                                    <th class="bg-dark text-white">Industry</th>
                                    <th class="bg-dark text-white">Job Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $JobIndustries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="bg-light text-black"><?php echo e(++$key); ?></td>
                                        <td class="bg-light text-black"><?php echo e($industry->name); ?></td>
                                        <td class="bg-light text-black"><?php echo e($industry->jobs->count()); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan=3 class="text-center">
                                            <h5>There are no industries to show</h5>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" style="border-radius:20px">
                    <div class="card-head">
                        <h5>Companies</h5>
                    </div>
                    <div class="table-responsive" style="max-height: 500px;overflow: scroll;">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg-secondary text-white">#</th>
                                    <th class="bg-secondary text-white">Name</th>
                                    <th class="bg-secondary text-white">Company Name</th>
                                    <th class="bg-secondary text-white">Office Number</th>
                                    <th class="bg-secondary text-white">phone Number</th>
                                    <th class="bg-secondary text-white">Created At</th>
                                    <th class="bg-secondary text-white">Status</th>
                                    <th class="bg-secondary text-white">Jobs Count</th>
                                </tr>
                            </thead>
                            <tbody data-test="table-body">
                                <?php $i = 0; ?>
                                <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $employer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(++$key); ?></td>
                                        <td><?php echo e($employer->user->name); ?></td>
                                        <td><?php echo e($employer->company_name); ?></td>
                                        <td><?php echo e($employer->office_number); ?></td>
                                        <td><?php echo e($employer->phone_number); ?></td>
                                        <td><?php echo e(date('d M, Y', strtotime($employer->created_at))); ?></td>
                                        <td><span
                                                class="badge badge-<?php echo e($employer->user->suspended ? 'danger' : 'success'); ?>"><?php echo e($employer->user->suspended ? 'Suspended' : 'Active'); ?></span>
                                        </td>
                                        <td class="text-center"><strong><?php echo e($employer->jobs_count); ?></strong></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if(count($jobRequests) > 0): ?>
                            <div class="col-12">
                                <div class="text-center">
                                    <a href="<?php echo e(route('admin.employer.index')); ?>" class="btn btn-success">View
                                        More&nbsp;<i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>