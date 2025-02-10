
<?php $__env->startSection('title', 'Employer Management'); ?>
<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <?php if(request()->routeIs('admin.admins.index')): ?>
                        <h1>Admin Management</h1>
                    <?php else: ?>
                        <h1>User Management</h1>
                    <?php endif; ?>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Employer Management</li>
                        </ol>
                    </nav>
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-create')): ?>
                    <div class="col">
                        <a href="<?php echo e(route('admin.employers.create')); ?>" class="btn btn-primary" style="float:right;"><i
                                class="fa fa-plus"></i>&nbsp;Create Employer</a>
                    </div>
                <?php endif; ?>
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
                                        <th class="sorting">#</th>
                                        <th class="sorting" aria-controls="DataTable" aria-label="Name">Name
                                        </th>
                                        <th class="sorting">Company Name</th>
                                        <th class="sorting">Username</th>
                                        <th>Office Number</th>
                                        <th class="sorting">Created At</th>
                                        <th class="sorting">Status</th>
                                        <th class="">Action</th>
                                    </tr>
                                </thead>
                                <tbody data-test="table-body">
                                    <?php $i = 0; ?>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(++$key); ?></td>
                                            <td><?php echo e($user->name); ?></td>
                                            <td></td>
                                            <td><?php echo e($user->username); ?></td>
                                            <td>phne no</td>
                                            <td><?php echo e(date('d M, Y', strtotime($user->created_at))); ?></td>
                                            <td><span
                                                    class="badge badge-<?php echo e($user->suspended ? 'danger' : 'success'); ?>"><?php echo e($user->suspended ? 'Suspended' : 'Active'); ?></span>
                                            </td>
                                            <td class="d-flex">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-edit')): ?>
                                                    <form action="<?php echo e(route('admin.employers.suspended', $user->id)); ?>"
                                                        method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <button type="button"
                                                            class="btn btn-<?php echo e($user->suspended ? 'success' : 'danger'); ?>"
                                                            name="suspended"
                                                            onclick="verifycOnfirm(this, '<?php echo e($user->suspended == 1 ? 'active' : 'suspend'); ?>')">
                                                            <i class="fa fa-user-times"></i>
                                                        </button>
                                                    </form>&nbsp;
                                                    <a href="<?php echo e(route('admin.employers.edit', $user->username)); ?>"
                                                        class="btn btn-outline-warning" title="Edit"><i
                                                            class="fa fa-edit"></i></a>&nbsp;
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-delete')): ?>
                                                    <form
                                                        action="<?php echo e(route('admin.employers.delete', base64_encode($user->id))); ?>"
                                                        method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="button" onclick="COnfirmDelete(this)"
                                                            class="btn btn-outline-danger">
                                                            <i class="fa fa-trash"></i></button>
                                                    </form>
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
    <script>
        new DataTable('#datatable');

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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/employerUser/index.blade.php ENDPATH**/ ?>