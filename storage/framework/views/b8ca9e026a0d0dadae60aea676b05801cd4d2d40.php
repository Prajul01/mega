<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/sweetalert/sweetalert.css')); ?>" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/sweetalert/sweetalert.css')); ?>" />
<?php $__env->stopPush(); ?>

<div class="card">
    <div class="table-responsive">
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th scope="row"><?php echo e(++$key); ?></th>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><?php echo e(date('d M, Y', strtotime($user->created_at))); ?></td>
                        <td>
                            <span class="badge badge-<?php echo e(!$user->suspended ? 'success' : 'danger'); ?>">
                                <?php echo e(!$user->suspended ? 'Active' : 'Suspended'); ?>

                            </span>
                        </td>
                        <td style="display:flex;">
                            <a href="<?php echo e(route('admin.admin-management.edit', base64_encode($user->id))); ?>"
                                class="btn btn-outline-warning mr-1">
                                <i class="fa fa-edit"></i>
                            </a>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-edit')): ?>
                                <?php if(auth()->user()->id != $user->id): ?>
                                    <form action="<?php echo e(route('admin.admin-management.suspend', base64_encode($user->id))); ?>"
                                        method="post" id="suspendForm">
                                        <?php echo csrf_field(); ?>
                                        <a href="#"
                                            class="btn btn-<?php echo e(!$user->suspended ? 'danger' : 'success'); ?> mr-1"
                                            onclick="COnfirmSuspend()"><i
                                                class="fa fa-user-<?php echo e(!$user->suspended ? 'times' : 'plus'); ?>"></i></a>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-delete')): ?>
                                <form action="<?php echo e(route('admin.admin-management.destroy', base64_encode($user->id))); ?>"
                                    method="post" id="deleteForm">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('delete'); ?>
                                    <a href="#" class="btn btn-outline-danger" onclick="COnfirmDelete()"><i
                                            class="fa fa-trash"></i></a>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>

        </table>
        
    </div>
</div>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('backend/assets/vendor/sweetalert/sweetalert.min.js')); ?>"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script>
        new DataTable('#datatable');

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
                    $('#deleteForm').submit();
                    swal("Deleted!", "User has been deleted.", "success");
                } else {
                    swal("Cancelled", "User is safe :)", "error");
                }
            });
        }

        function COnfirmSuspend(elem) {
            swal({
                title: "Are you sure?",
                text: "You will be suspending this user",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $('#suspendForm').submit();
                    swal("Success!", "User status has been changed", "success");
                } else {
                    swal("Cancelled", "User status has not been changed", "error");
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/megajobn/public_html/resources/views/admin/users/components/adminList.blade.php ENDPATH**/ ?>