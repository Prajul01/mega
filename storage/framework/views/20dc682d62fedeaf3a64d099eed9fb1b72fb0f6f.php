<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/dropify/css/dropify.min.css')); ?>">
<?php $__env->stopPush(); ?>
<form method="POST" action="<?php echo e(route('admin.sliders.update', base64_encode($slider->id))); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="body">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Title</span>
                    </div>
                    <input type="text" class="form-control" name="title"
                           placeholder="Title" value="<?php echo e($slider->title); ?>"
                           aria-label="Title"
                           aria-describedby="basic-addon1" required>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="display" value="1"
                                                              <?php if($slider->display ==1): ?> checked <?php endif; ?>></span>
                    </div>
                    <input type="text" class="form-control" value="Display Status" disabled>
                </div>
            </div>
           <div class="col-md-6">
                <div class="alert alert-warning">
                    Best Image Size 1420 X 450  PX.
                </div>
            </div>
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Image</span>
                    </div>
                    <input type="file" name="image" data-default-file="<?php echo e(asset('storage/slider/'.$slider->image)); ?>"
                           class="dropify">
                </div>
            </div>

            <div class="col-md-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Slider Url (Optional)</span>
                    </div>
                    <input type="text" class="form-control" name="redirect_url"
                           placeholder="Slider Url" value="<?php echo e($slider->redirect_url); ?>"
                           aria-label="Link"
                           aria-describedby="basic-addon1">
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
    <script src="<?php echo e(asset('backend/html/assets/js/pages/forms/dropify.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/megajobn/public_html/resources/views/admin/sliders/components/edit.blade.php ENDPATH**/ ?>