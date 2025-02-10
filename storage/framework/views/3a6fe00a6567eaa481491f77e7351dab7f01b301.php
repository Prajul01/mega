<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/dropify/css/dropify.min.css')); ?>">
<?php $__env->stopPush(); ?>
<form method="POST" action="<?php echo e(route('admin.faq.store')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Title</span>
                    </div>
                    <input type="text" class="form-control" name="title" placeholder="Title" aria-label="Title"
                        aria-describedby="basic-addon1" value="<?php echo e(old('title')); ?>" required>
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
           
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Type</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="faq_type">
                        <option selected disabled value="">Select Type</option>
                        <option value="job_seeker" <?php echo e(old('faq_type')=="job_seeker"?'selected':''); ?>>Job Seeker</option>
                        <option value="employer" <?php echo e(old('faq_type')=="employer"?'selected':''); ?>>Employeer</option>
                      </select>
                </div>
                <?php $__errorArgs = ['faq_type'];
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
                                checked></span>
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
           <div class="col-md-12">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h5>FAQ Descriptions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row varient-add">
                            <div class="col-md-5 border m-3">
                                <div class="row">
                                    <div class="col-md-11 mt-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Question</span>
                                            </div>
                                            <textarea class="form-control" name="sub_title[]" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-11 mt-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Answer</span>
                                            </div>
                                            <textarea class="form-control" name="description[]" rows="6" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-12">
                            <div class="add-more-btn">
                                <button type="button" class="btn btn-success btn__bordered btn__hover2 add-varient">Add More +</button>
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
           </div>
           


        </div>
    </div>
    <div class="card-footer">
        <a href="<?php echo e(route('admin.blog.index')); ?>" class="btn btn-danger">Cancel</a>
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
    <script>
        $(".add-varient").click(function() {
            $(".varient-add").append(
                `<div  class="varient col-md-5 border m-3"><div class="row">
                            <div class=" m-3">
                                <div class="row">
                                    <div class="col-md-11 mt-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Question</span>
                                            </div>
                                            <textarea class="form-control" name="sub_title[]" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-1"><button class="btn btn-danger remove" type="button"><i class="fa fa-trash"></i></button></div>
                                    <div class="col-md-11 mt-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Answer</span>
                                            </div>
                                            <textarea class="form-control" name="description[]" rows="6"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div>`
        )});

        $(document).on('click', '.remove', function() {
            $(this).closest(".varient").remove();
        });
        </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/megajobn/public_html/resources/views/admin/faq/components/add.blade.php ENDPATH**/ ?>