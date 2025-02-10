<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/dropify/css/dropify.min.css')); ?>">
<?php $__env->stopPush(); ?>
<form method="POST" action="<?php echo e(route('admin.dayPackages.store')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="body">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Package Name</span>
                    </div>
                    <input type="text" class="form-control" name="package_name" placeholder="Package name" aria-label="Package Name"
                        aria-describedby="basic-addon1" required>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="<?php echo e(route('admin.sliders.index')); ?>" class="btn btn-danger">Cancel</a>
        <button style="float: right" type="submit" name="submit" class="btn btn-success" value="save">Save</button>
    </div>
</form>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('backend/assets/vendor/dropify/js/dropify.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/pages/forms/dropify.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/megajobn/public_html/resources/views/admin/dayPackages/components/add.blade.php ENDPATH**/ ?>