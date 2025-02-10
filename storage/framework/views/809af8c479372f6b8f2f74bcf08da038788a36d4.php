<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/dropify/css/dropify.min.css')); ?>">
<?php $__env->stopPush(); ?>
<form method="POST" action="<?php echo e(route('admin.industry.update', base64_encode($industry->id))); ?>"
    enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="body">
        <div class="row">
            <div class="col-md-9 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Industry Name</span>
                    </div>
                    <input type="text" class="form-control" name="name" placeholder="Industry Name"
                        value="<?php echo e(old('name', $industry->name)); ?>" aria-label="Title"
                        aria-describedby="basic-addon1" required>
                </div>
                <?php $__errorArgs = ['name'];
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
                        <span class="input-group-text"><input type="checkbox" name="status" value="active"
                                <?php if($industry->status == 'active'): ?> checked <?php endif; ?>></span>
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
        <a href="<?php echo e(route('admin.industry.index')); ?>" class="btn btn-danger">Cancel</a>
        <button style="float: right" type="submit" class="btn btn-success">Save</button>
    </div>
</form>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('backend/assets/vendor/dropify/js/dropify.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/html/assets/js/pages/forms/dropify.js')); ?>"></script>
    <script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
    <script src="<?php echo e(asset('backend/assets/vendor/select2/dist/js/select2.js')); ?>"></script>
    <script>
        var editor_config = {
            toolbar: [{
                    name: 'document',
                    groups: ['mode', 'document', 'doctools']

                },
                {
                    name: 'clipboard',
                    groups: ['clipboard', 'undo'],
                    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                },
                {
                    name: 'editing',
                    groups: ['find', 'selection', 'spellchecker'],
                    items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                },
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup'],
                    items: ['Bold', 'Italic', 'Underline', '-',
                        'RemoveFormat'
                    ]
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', '-', 'JustifyLeft',
                        'JustifyCenter', 'JustifyRight', 'JustifyBlock',
                    ]
                },
                {
                    name: 'links',
                    items: ['Link']
                },
                '/',
                {
                    name: 'styles',
                    items: ['Styles', 'Format', 'Font', 'FontSize']
                },
                {
                    name: 'colors',
                    items: ['TextColor']
                },
            ],
            width: ['100%']
        };
        CKEDITOR.replace('ckeditor', editor_config);
    </script>
    <script>
        $(document).ready(function() {
            $('.multiple-cat').select2();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/megajobn/public_html/resources/views/admin/industry/components/edit.blade.php ENDPATH**/ ?>