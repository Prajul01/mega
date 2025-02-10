<form method="POST" action="<?php echo e(route('admin.company_category.update', base64_encode($company_category->id))); ?>"
    enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Title</span>
                    </div>
                    <input type="text" class="form-control" name="title" placeholder="Title"
                        value="<?php echo e(old('title', $company_category->title)); ?>" aria-label="Title"
                        aria-describedby="basic-addon1" required>
                </div>
                <?php $__errorArgs = ['title'];
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
            <div class="col-md-4 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Industry</span>
                    </div>
                    <select name="industry_id" class="form-control" id="">
                        <option value="" selected disabled> --Select Industry-- </option>
                        <?php $__currentLoopData = App\Models\Industry::where('status', 'active')->select('id', 'name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($industry->id); ?>"
                                <?php echo e(old('industry_id', $company_category->industry_id) == $industry->id ? 'selected' : ''); ?>>
                                <?php echo e($industry->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php $__errorArgs = ['industry_id'];
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
            <div class="col-md-2 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="status" value="active"
                                <?php if($company_category->status == 'active'): ?> checked <?php endif; ?>></span>
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
        <a href="<?php echo e(route('admin.company_category.index')); ?>" class="btn btn-danger">Cancel</a>
        <button style="float: right" type="submit" class="btn btn-success">Save</button>
    </div>
</form>
<?php /**PATH /home/megajobn/public_html/resources/views/admin/company_category/components/edit.blade.php ENDPATH**/ ?>