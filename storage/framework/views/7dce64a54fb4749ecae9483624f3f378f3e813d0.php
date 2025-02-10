<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/nestable/jquery-nestable.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/sweetalert/sweetalert.css')); ?>" />
<?php $__env->stopPush(); ?>
<div class="card">
    <div class="dd" id="nestable">
        <ol class="dd-list has-header">
            <li class="dd-item dd3-item list-item">
                <div class="dd-handle dd3-handle"></div>
                <div class="custom-handle-flex">
                    <div class="icon-image-name">
                        <div>
                            <h6 class=" mb-0">
                                <?php echo e($about->who_we_are_heading); ?>

                            </h6>
                        </div>
                    </div>
                    <div style="display: flex">
                        <a href="<?php echo e(route('admin.about.first_form')); ?>" class="btn btn-sm btn-outline-info"
                            title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>
                    </div>
                </div>
            </li>
            <li class="dd-item dd3-item list-item">
                <div class="dd-handle dd3-handle"></div>
                <div class="custom-handle-flex">
                    <div class="icon-image-name">
                        <div>
                            <h6 class=" mb-0">
                                <?php echo e($about->what_we_do_heading); ?>

                            </h6>
                        </div>
                    </div>
                    <div style="display: flex">
                        <a href="<?php echo e(route('admin.about.second_form')); ?>" class="btn btn-sm btn-outline-info"
                            title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>
                    </div>
                </div>
            </li>
            <li class="dd-item dd3-item list-item">
                <div class="dd-handle dd3-handle"></div>
                <div class="custom-handle-flex">
                    <div class="icon-image-name">
                        <div>
                            <h6 class=" mb-0">
                                <?php echo e($about->feature_heading); ?>

                            </h6>
                        </div>
                    </div>
                    <div style="display: flex">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('content-edit')): ?>
                            <a href="<?php echo e(route('admin.about.third_form')); ?>" class="btn btn-sm btn-outline-info"
                                title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </li>
        </ol>

    </div>
</div>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('backend/assets/vendor/nestable/jquery.nestable.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/megajobn/public_html/resources/views/admin/about/components/list.blade.php ENDPATH**/ ?>