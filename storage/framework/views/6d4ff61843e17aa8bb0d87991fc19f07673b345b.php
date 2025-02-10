<?php $__env->startSection('title', 'Job Requests'); ?>
<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Job Requests</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Job Requests</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="col-md-12 my-3 mx-0">
                            <?php if(!is_null(request()->jobs)): ?>
                                <a href="<?php echo e(route('admin.jobRequest.index')); ?>" class="btn btn-primary"><i
                                        class="fa fa-hourglass-end"></i>&nbsp;&nbsp;Pending Jobs For Approval</a>
                            <?php endif; ?>

                            <?php if(request()->jobs != 'approved-jobs'): ?>
                                <a href="<?php echo e(route('admin.jobRequest.index', ['jobs' => 'approved-jobs'])); ?>"
                                    class="btn btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Approved Jobs</a>
                            <?php endif; ?>

                            <?php if(request()->jobs != 'declined-jobs'): ?>
                                <a href="<?php echo e(route('admin.jobRequest.index', ['jobs' => 'declined-jobs'])); ?>"
                                    class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Declined Jobs</a>
                            <?php endif; ?>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead data-test="datatable-head">
                                    <tr>
                                        <th class="sorting">#</th>
                                        <th class="sorting" aria-controls="DataTable" aria-label="Name">Title
                                        </th>
                                        <th class="sorting">Company Name</th>
                                        <th class="sorting">Office Number</th>
                                        <th>No. of Opening</th>
                                        <th class="sorting">Created At</th>
                                        <th class="sorting">Status</th>
                                        <th class="sorting">Job Type</th>
                                        <th class="">Action</th>
                                    </tr>
                                </thead>
                                <tbody data-test="table-body">
                                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(++$key); ?></td>
                                            <td><span title="<?php echo e($job->title); ?>"
                                                    style="cursor:pointer;"><?php echo e(Str::limit($job->title, 28, '...')); ?></span>
                                            </td>
                                            <td><?php echo e($job->employer->company_name); ?></td>
                                            <td><?php echo e($job->employer->office_number); ?></td>
                                            <td class="text-center"><?php echo e($job->no_of_opening); ?></td>
                                            <td><?php echo e(date('Y-m-d', strtotime($job->created_at))); ?></td>
                                            <td><span
                                                    class="badge badge-<?php echo e($job->approval == 'approved' ? 'success' : ($job->approval == 'pending' ? 'primary' : 'danger')); ?>"><?php echo e($job->approval); ?></span>
                                            </td>
                                            <td><span class="badge badge-success">
                                                    <?php if($job->type == 'prime'): ?>
                                                        Prime Job
                                                    <?php elseif($job->type == 'mega'): ?>
                                                        Megajob
                                                    <?php elseif($job->type == 'premium'): ?>
                                                        Premium Job
                                                    <?php else: ?>
                                                        Latest Job
                                                    <?php endif; ?>
                                                </span></td>
                                            <td class="d-flex">
                                                <a href="<?php echo e(route('admin.jobRequest.show', $job->slug)); ?>" target="_blank"
                                                    class="btn btn-outline-primary mx-1"><i class="fa fa-eye"></i></a>
                                                <?php if($job->approval != 'approved'): ?>
                                                    <button type="button" value="approved" title="Approve"
                                                        data-id="<?php echo e($job->slug); ?>"
                                                        class="btn job-settings btn-success mx-1"><i
                                                            class="fa fa-check"></i></button>
                                                <?php endif; ?>
                                                <?php if($job->approval != 'declined'): ?>
                                                    <button type="button" value="declined" title="Decline"
                                                        data-id="<?php echo e($job->slug); ?>"
                                                        class="btn btn-danger job-settings mx-1"><i
                                                            class="fa fa-times"></i></button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>

    <script>
        new DataTable('#datatable');
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/job-requests/index.blade.php ENDPATH**/ ?>