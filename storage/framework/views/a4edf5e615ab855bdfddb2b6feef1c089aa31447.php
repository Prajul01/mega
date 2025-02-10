
<?php $__env->startSection('title', 'Step Procedure Management'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Step Procedure Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Step Procedure Management</li>
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
                            <li class="nav-item">
                                <a class="nav-link show active" data-toggle="tab" href="#">
                                    <i class="fa fa-plus"></i> Advertisement Type</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="bg-secondary text-white" style="width:10%;">#</th>
                                        <th class="bg-secondary text-white" style="width:80%;">Advetisement Type</th>
                                        <th class="bg-secondary text-white" style="width:10%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th><?php echo e(++$key); ?></th>
                                            <th><?php echo e(ucwords(str_replace('-', ' ', $step->posting_type))); ?></th>
                                            <th><a href="<?php echo e(route('admin.steps.subIndex', base64_encode($step->id))); ?>" class="btn btn-outline-primary"><i class="fa fa-eye"></i></a></th>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/stepProcedure/index.blade.php ENDPATH**/ ?>