
<?php $__env->startSection('title', 'about Management'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>About Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About Management</li>
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
                            <?php if(!request()->routeIs('admin.about.index')): ?>
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editabout">
                                        <i class="fa fa-plus"></i> Edit about</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link show" href="<?php echo e(route('admin.about.index')); ?>">
                                        <i class="fa fa-arrow-left"></i> Go Back
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#abouts">
                                        <i class="fa fa-list"></i> About Page
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        <?php if($status == 'edit'): ?>
                            <div class="tab-pane active show" id="editabout">
                                <?php echo $__env->make('admin.about.components.who_we_are', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php elseif($status == 'edit1'): ?>
                            <?php echo $__env->make('admin.about.components.what_we_do', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php elseif($status == 'edit2'): ?>
                            <?php echo $__env->make('admin.about.components.feature', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php else: ?>
                            <div class="tab-pane active show" id="abouts">
                                <?php echo $__env->make('admin.about.components.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/about/index.blade.php ENDPATH**/ ?>