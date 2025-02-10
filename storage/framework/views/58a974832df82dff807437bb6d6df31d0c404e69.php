
<?php $__env->startSection('title', 'Blog Management'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Blog Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog Management</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs">
                            <?php if(request()->routeIs('admin.blog.edit')): ?>
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editblog">
                                        <i class="fa fa-plus"></i> Edit Blog</a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#blogs">
                                        <i class="fa fa-list"></i> All Blog
                                    </a>
                                </li>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('content-create')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addblog">
                                        <i class="fa fa-plus"></i> Add Blog</a>
                                </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        <?php if($status == 'edit'): ?>
                            <div class="tab-pane active show" id="editblog">
                                <?php echo $__env->make('admin.blog.components.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php else: ?>
                            <div class="tab-pane active show" id="blogs">
                                <?php echo $__env->make('admin.blog.components.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('content-create')): ?>
                            <div class="tab-pane" id="addblog">
                                <?php echo $__env->make('admin.blog.components.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/blog/index.blade.php ENDPATH**/ ?>