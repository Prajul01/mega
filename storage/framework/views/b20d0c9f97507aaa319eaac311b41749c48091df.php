
<?php $__env->startSection('title', 'Users Management'); ?>
<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/dropify/css/dropify.min.css')); ?>">
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
                            <li class="breadcrumb-item active" aria-current="page">Users Management</li>
                        </ol>
                    </nav>
                </div>
                <?php if(@$unverified_count): ?>
                    <form action="" post="get">
                        <button class="btn btn-danger m-3" style="font-size:20px" name="q"
                            value="unverified-users">Unverified Users: <?php echo e($unverified_count); ?></span></button>
                    </form>
                <?php endif; ?>
                <?php if(@$verified_count): ?>
                    <a href="<?php echo e(route('admin.users.admins.index')); ?>" class="btn btn-success m-3"
                        style="font-size:20px">Verified Users: <?php echo e($verified_count); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs">
                            <?php if(request()->routeIs('admin.users.edit')): ?>
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editcategory">
                                        <i class="fa fa-plus"></i> Edit User</a>
                                </li>
                            <?php elseif(request()->routeIs('admin.users.show')): ?>
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#categories">
                                        @ <?php echo e($user->username); ?>

                                    </a>
                                </li>
                                <li class="ml-2 nav-item">
                                    <a class="btn btn-primary" href="<?php echo e(url()->previous()); ?>">
                                        <i class="fa fa-angle-double-left"></i> Go Back
                                    </a>
                                </li>
                                <li class="ml-auto">
                                    <button id="downloadBtn" class="btn btn-primary">Download PDF</button>
                                </li>
                            <?php elseif(request()->routeIs('admin.users.admins.index')): ?>
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#categories">
                                        <i class="fa fa-list"></i> All User
                                    </a>
                                </li>

                                <?php if(!request()->routeIs('admin.users.customer.*')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link"r data-toggle="tab" href="#addJobseeker">
                                            <i class="fa fa-plus"></i> Add User</a>
                                    </li>
                                <?php endif; ?>
                            <?php elseif(request()->routeIs('admin.admin-management.index')): ?>
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#categories">
                                        <i class="fa fa-list"></i> All Admins
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" data-toggle="tab" href="#addadmin">
                                        <i class="fa fa-plus"></i> Add Admin
                                    </a>
                                </li>
                            <?php elseif(request()->routeIs('admin.adminUsers.edit')): ?>
                                <li class="nav-item">
                                    <a class="nav-link show active" href="#">
                                        <i class="fa fa-list"></i> Edit User
                                    </a>
                                </li>
                            <?php elseif(request()->routeIs('admin.adminUsers.index')): ?>
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#categories">
                                        <i class="fa fa-list"></i> All Users
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" data-toggle="tab" href="#addAdminUsers">
                                        <i class="fa fa-plus"></i> Add Users
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        <?php if(request()->routeIs('admin.users.edit')): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-edit')): ?>
                                <div class="tab-pane active show" id="editcategory">
                                    <?php echo $__env->make('admin.users.components.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                        <?php elseif(request()->routeIs('admin.users.show')): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-list')): ?>
                                <div class="tab-pane active show" id="showcategories">
                                    <?php echo $__env->make('admin.users.components.show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                        <?php elseif(request()->routeIs('admin.users.admins.index')): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-list')): ?>
                                <div class="tab-pane active show" id="categories">
                                    <?php echo $__env->make('admin.users.components.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-create')): ?>
                                <div class="tab-pane" id="addJobseeker">
                                    <?php echo $__env->make('admin.users.components.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                        <?php elseif(request()->routeIs('admin.admin-management.index')): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-list')): ?>
                                <div class="tab-pane active show" id="categories">
                                    <?php echo $__env->make('admin.users.components.adminList', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-create')): ?>
                                <div class="tab-pane" id="addadmin">
                                    <?php echo $__env->make('admin.users.components.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                        <?php elseif(request()->routeIs('admin.admin-management.edit')): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-edit')): ?>
                                <div class="tab-pane active show" id="editcategory">
                                    <?php echo $__env->make('admin.users.components.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                        <?php elseif(request()->routeIs('admin.adminUsers.index')): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-list')): ?>
                                <div class="tab-pane active show" id="categories">
                                    <?php echo $__env->make('admin.users.components.userList', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-create')): ?>
                                <div class="tab-pane" id="addAdminUsers">
                                    <?php echo $__env->make('admin.users.components.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                        <?php elseif(request()->routeIs('*.adminUsers.edit')): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-edit')): ?>
                                <div class="tab-pane active show" id="editcategory">
                                    <?php echo $__env->make('admin.users.components.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/users/index.blade.php ENDPATH**/ ?>