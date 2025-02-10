
<?php $__env->startSection('title', 'Employer Management'); ?>
<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <form action="<?php echo e(route('admin.jobPosting.postJobs', str_replace(' ', '-', strtolower($type)))); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-md-12 col-sm-12">
                        <h1><?php echo e($type); ?></h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                                <li class="breadcrumb-item" aria-current="page">Job Posting Management</li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo e($type); ?></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col my-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9 d-flex">
                                        <?php
                                        $bulkOptions = ['megajobs', 'premium jobs', 'general jobs', 'Latest Jobs'];
                                        ?>
                                        <select class="form-control" name="action" style="width:25%;" required>
                                            <option selected disabled>--Select Action--</option>
                                            <option value="remove">Remove From <?php echo e($type); ?></option>
                                            <?php $__currentLoopData = $bulkOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(strtolower($type) != $option): ?>
                                                    <option value="<?php echo e($option); ?>">Post to <?php echo e(ucwords($option)); ?>

                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <button class="btn btn-secondary" name="action_from" value="bulk">
                                            Apply
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary adder" style="float:right;"><i
                                                class="fa fa-plus"></i>&nbsp;Post Job as
                                            <?php echo e($type); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead data-test="datatable-head">
                                        <tr>
                                            <th></th>
                                            <th class="sorting">#</th>
                                            <th class="sorting" aria-controls="DataTable" aria-label="Name">Title
                                            </th>
                                            <th class="sorting">Company Name</th>
                                            <th class="sorting">Office Number</th>
                                            <th>No. of Opening</th>
                                            <th class="sorting">Created At</th>
                                            <th class="sorting">Status</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody data-test="table-body">
                                        <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunked): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $chunked; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><input class="form-cotrol" type="checkbox" name="job_slug[]"
                                                            value="<?php echo e($job->slug); ?>"></td>
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
                                                    <td class="d-flex">
                                                        <a href="<?php echo e(route('admin.jobRequest.show', $job->slug)); ?>"
                                                            target="_blank" class="btn btn-outline-primary mx-1">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <?php if(strtolower($type) != 'Latest Jobs'): ?>
                                                            <button class="btn btn-outline-danger" name="job_slug"
                                                                value="<?php echo e($job->slug); ?>"><i
                                                                    class="fa fa-times"></i></button>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="post_to" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Declined Message</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('admin.jobPosting.postJobs', str_replace(' ', '-', strtolower($type)))); ?>"
                        method="POST" id="postingForm">
                        <?php echo csrf_field(); ?>
                        <div class="table-responsive">
                            <table id="otherTable" class="table table-striped table-bordered">
                                <thead data-test="datatable-head">
                                    <tr>
                                        <th></th>
                                        <th class="sorting">#</th>
                                        <th class="sorting" aria-controls="DataTable" aria-label="Name">Title
                                        </th>
                                        <th class="sorting">Company Name</th>
                                        <th class="sorting">Created At</th>
                                        <th class="sorting">Status</th>
                                        <th class="">Action</th>
                                    </tr>
                                </thead>
                                <tbody data-test="table-body">
                                    <?php $__currentLoopData = $otherJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunked): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $chunked; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><input class="form-cotrol" type="checkbox" name="job_slug[]"
                                                        value="<?php echo e($job->slug); ?>"></td>
                                                <td><?php echo e(++$key); ?></td>
                                                <td><span title="<?php echo e($job->title); ?>"
                                                        style="cursor:pointer;"><?php echo e(Str::limit($job->title, 28, '...')); ?></span>
                                                </td>
                                                <td><?php echo e($job->employer->company_name); ?></td>
                                                <td><?php echo e(date('Y-m-d', strtotime($job->created_at))); ?></td>
                                                <td><span
                                                        class="badge badge-<?php echo e($job->approval == 'approved' ? 'success' : ($job->approval == 'pending' ? 'primary' : 'danger')); ?>"><?php echo e($job->approval); ?></span>
                                                </td>
                                                <td class="d-flex">
                                                    <a href="<?php echo e(route('admin.jobRequest.show', $job->slug)); ?>"
                                                        target="_blank" class="btn btn-outline-primary mx-1">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <button class="btn btn-outline-success mx-1" name="job_slug"
                                                        value="<?php echo e($job->slug); ?>">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success mx-2" onclick="confirmToAdd('<?php echo e($type); ?>')"><i
                            class="fa fa-plus"></i>Add</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script>
        new DataTable('#datatable');
        new DataTable('#otherTable');


        $('.adder').click(function() {
            $('#post_to').modal('show');
        });

        function confirmToAdd(status) {


            swal({
                title: "Are you sure?",
                text: "The job will be posted to " + status,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes, post it!",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $('#postingForm').submit();
                } else {
                    swal("Cancelled", "Process has been canceled", "error");
                }
            });
        }

        function verifycOnfirm(data, status) {
            swal({
                title: "Are you sure?",
                text: "This will change the status to " + status,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes, " + status + " it!",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    swal({
                        title: status.toUpperCase(),
                        text: "This user is now " + status,
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#28a745",
                        confirmButtonText: "Okay",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    });
                    $(data).closest('form').submit();
                } else {
                    swal("Cancelled", "Process has been canceled", "error");
                }
            });
        }

        function COnfirmDelete(elem) {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this User!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    jQuery(elem).closest("form").submit();

                    swal("Deleted!", "Your User has been deleted.", "success");
                } else {
                    swal("Cancelled", "Your User is safe :)", "error");
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/jobPosting/index.blade.php ENDPATH**/ ?>