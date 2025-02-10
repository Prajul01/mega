<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/sweetalert/sweetalert.css')); ?>" />
<?php $__env->stopPush(); ?>

<div class="card">
    <div class="table-responsive">
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <?php if(@$users): ?>
                        <th scope="col">Name</th>
                    <?php endif; ?>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <?php if(@$users): ?>
                        <th scope="col">Contact</th>
                    <?php endif; ?>
                    <th scope="col">Created At</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(@$users): ?>
                    <?php if(count(@$users) == 0): ?>
                        <td colspan="7">
                            <div class="card">
                                <div class="card-body text-center">
                                    No Data Found
                                </div>
                            </div>
                        </td>
                    <?php endif; ?>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e(++$key); ?></th>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->username); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td><?php echo e($user->job_seeker->mobile_number); ?></td>
                            <td><?php echo e(date('d M, Y', strtotime($user->created_at))); ?></td>
                            <td>
                                <span class="badge badge-<?php echo e(!$user->suspended ? 'success' : 'danger'); ?>">
                                    <?php echo e(!$user->suspended ? 'Active' : 'Suspended'); ?>

                                </span>
                            </td>
                            <td style="display:flex;">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-edit')): ?>
                                    <?php if($user->id != auth()->id()): ?>
                                        <form action="<?php echo e(route('admin.users.suspend', $user->username)); ?>" method="post"
                                            id="suspendForm">
                                            <?php echo csrf_field(); ?>
                                            <a href="#"
                                                class="btn btn-outline-<?php echo e(!$user->suspended ? 'danger' : 'success'); ?> ml-1"
                                                onclick="COnfirmSuspend()"><i
                                                    class="fa fa-user-<?php echo e(!$user->suspended ? 'times' : 'plus'); ?>"></i></a>
                                        </form>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('admin.users.show', $user->username)); ?>"
                                        class="btn btn-outline-primary mx-1"><i class="fa fa-eye"></i></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-delete')): ?>
                                    <form action="<?php echo e(route('admin.users.destroy', base64_encode($user->id))); ?>"
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
                <?php else: ?>
                    <?php if(@$unverified_users): ?>
                        <?php $__currentLoopData = $unverified_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(++$key); ?></td>
                                <td><?php echo e($user->username); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td><?php echo e(date('d M, Y', strtotime($user->created_at))); ?></td>
                                <td>
                                    <span class="badge badge-<?php echo e(!$user->suspended ? 'success' : 'danger'); ?>">
                                        <?php echo e(!$user->suspended ? 'Active' : 'Suspended'); ?>

                                    </span>
                                </td>
                                <td style="display:flex;">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-edit')): ?>
                                        <form action="<?php echo e(route('admin.users.suspend', $user->username)); ?>" method="post"
                                            id="suspendForm">
                                            <?php echo csrf_field(); ?>
                                            <a href="#"
                                                class="btn btn-<?php echo e(!$user->suspended ? 'danger' : 'success'); ?> mr-1"
                                                onclick="COnfirmSuspend()"><i
                                                    class="fa fa-user-<?php echo e(!$user->suspended ? 'times' : 'plus'); ?>"></i></a>
                                        </form>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-delete')): ?>
                                        <form action="<?php echo e(route('admin.users.destroy', base64_encode($user->id))); ?>"
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
                    <?php endif; ?>
                <?php endif; ?>

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
<?php /**PATH /home/megajobn/public_html/resources/views/admin/users/components/list.blade.php ENDPATH**/ ?>