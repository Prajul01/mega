<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/nestable/jquery-nestable.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/sweetalert/sweetalert.css')); ?>" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
<?php $__env->stopPush(); ?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered">
                <thead data-test="datatable-head">
                    <tr>
                        <th class="sorting">#</th>
                        <th class="sorting" aria-controls="DataTable" aria-label="Title">Job</th>
                        <th class="sorting">Company Name</th>
                        <th>Office Number</th>
                        <th class="sorting">Status</th>
                        <th class="sorting">No. of Applicant</th>
                        <th class="sorting">Posting time</th>
                        <th class="sorting">Created At</th>
                        <th class="">Action</th>
                    </tr>
                </thead>
                <tbody data-test="table-body">
                    <?php $i = 0; ?>
                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(++$key); ?></td>
                            <td> <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employer-list')): ?>
                                    <a href="<?php echo e(route('admin.job.appliedUsers.index', $job->slug)); ?>"style="font-weight:bolder;"
                                        target="_blank">
                                    <?php endif; ?> <?php echo e($job->title); ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employer-list')): ?>
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($job->employer->company_name); ?></td>
                            <td><?php echo e($job->employer->office_number); ?></td>
                            <td>
                                <span
                                    class="<?php echo e($job->status == 'active' ? 'badge badge-primary' : 'badge badge-danger'); ?>"><?php echo e($job->status == 'active' ? 'Displayed' : 'Not Display'); ?></span>
                            </td>
                            <td class="text-center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employer-list')): ?>
                                    <a href="<?php echo e(route('admin.job.appliedUsers.index', $job->slug)); ?>"style="font-weight:bolder;"
                                        target="_blank">
                                    <?php endif; ?> <?php echo e($job->applied_users->count()); ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employer-list')): ?>
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e(date('d M, y', strtotime($job->start_date)) . ' - ' . date('d M, Y', strtotime($job->expiry_date))); ?>

                            </td>
                            <td><?php echo e(date('d M, Y', strtotime($job->created_at))); ?></td>
                            <td class="d-flex">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employer-edit')): ?>
                                    <a href="<?php echo e(route('admin.job.edit', base64_encode($job->id))); ?>"
                                        class="btn btn-sm btn-outline-info" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employer-delete')): ?>
                                    &nbsp;
                                    <button type="button" onclick="COnfirmDelete('<?php echo e($job->id); ?>')"
                                        data-id="<?php echo e($job->id); ?>" class="btn btn-sm btn-outline-danger">
                                        <i class="fa fa-trash"></i></button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('backend/assets/vendor/nestable/jquery.nestable.js')); ?>"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo e(asset('backend/vendor/sweetalert/sweetalert.min.js')); ?>"></script>

    <script>
        new DataTable('#datatable');
    </script>
    <script>
        function COnfirmDelete(elem) {
            var id = elem;
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        method: "POST",
                        url: '<?php echo e(route('admin.job.destroy')); ?>',
                        data: {
                            '_token': '<?php echo e(csrf_token()); ?>',
                            'id': id
                        },
                        success: function(res) {
                            swal({
                                title: "Deleted",
                                text: "job has been deleted!",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#28a745",
                                confirmButtonText: "Okay",
                                closeOnConfirm: false,
                                closeOnCancel: false
                            }, function(isConfirm) {
                                if (isConfirm) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(data) {
                            // toastr.error("Sorry Something Went Wrong!!");
                        }

                    })
                } else {
                    swal("Cancelled", "Your job is safe :)", "error");
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/megajobn/public_html/resources/views/admin/job/components/list.blade.php ENDPATH**/ ?>