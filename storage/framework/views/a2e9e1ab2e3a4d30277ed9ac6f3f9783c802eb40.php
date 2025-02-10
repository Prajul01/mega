<?php
/**
 * Created On : PhpStorm
 * Project Name: byabasayi
 * Author Name: Subas Nyaupane
 * Author Email: mail.subasnyaupane@gmail.com
 * Author Url : https://subasnyaupane.github.io/
 * Date: 26/May/2021
 */
?>

<?php $__env->startSection('title', 'Edit Role  '); ?>
<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/DataTables/datatables.min.css')); ?>">
    <style>
        .wrapper .page-wrap .main-content .page-header .page-header-title i {
            width: 50px !important;
            height: 50px !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-check bg-blue"></i>
                        <div class="d-inline">
                            <h5>Edit Role & Permission</h5>
                            <span>Something here</span>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('admin.dashboard')); ?>"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('admin.roles.index')); ?>">Role & Permission</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <form class="forms-sample" method="post" action="<?php echo e(route('admin.roles.update',$role->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-2 mr-sm-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Name
                                            </div>
                                        </div>
                                        <input type="text" value="<?php echo e($role->name); ?>" class="form-control" name="name" placeholder="Role Name">
                                    </div>
                                </div>
                            </div>
                            <div class=" row">
                                <div class="col-md-12">
                                    <ul class="list-group ">
                                        <div class="row">
                                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-header"><?php echo e(ucfirst($key)); ?></div>
                                                            <div class="row">
                                                                <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    $parts = explode('-', $permission->name);
                                                                ?>
                                                                
                                                                <div class="col-md-3 mb-2">
                                                                    <li class="list-group-item d-flex list-group-item-action justify-content-between align-items-center">
                                                                        <?php echo e(ucfirst(end($parts))); ?>

                                                                        <span class="mb-4">
                                                                            <input class="form-check-input permission" <?php if(in_array($permission->id, $rolePermissions)): ?> checked <?php endif; ?> type="checkbox" name="permission[]" value="<?php echo e($permission->id); ?>">
                                                                        </span>
                                                                    </li>
                                                                </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo e(route('admin.roles.index')); ?>" class="btn btn-danger mr-2">Cancel</a>
                            <button style="float: right" type="submit" class="btn btn-success mr-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/roles/edit.blade.php ENDPATH**/ ?>