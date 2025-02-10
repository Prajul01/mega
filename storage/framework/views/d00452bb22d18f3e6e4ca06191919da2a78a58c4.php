<form method="POST" action="<?php echo e(route('admin.concern.store')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="body">
        <div class="row">
            <div class="col-md-9 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Concern</span>
                    </div>
                    <input type="text" class="form-control" name="concern" placeholder="Concern" aria-label="concern"
                        aria-describedby="basic-addon1" value="<?php echo e(old('concern')); ?>" required>
                </div>
                <?php $__errorArgs = ['concern'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="display"
                                <?php echo e(old('display')? (old('display')? 'checked': ''): 'checked'); ?>></span>
                    </div>
                    <input type="text" class="form-control" value="Display Status" disabled>
                </div>
                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="<?php echo e(route('admin.education.index')); ?>" class="btn btn-danger">Cancel</a>
        <button style="float: right" type="submit" class="btn btn-success">Save</button>
    </div>
</form>
<?php /**PATH /home/megajobn/public_html/resources/views/admin/concern/components/add.blade.php ENDPATH**/ ?>