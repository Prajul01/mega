<form method="POST" action="<?php echo e(route('admin.advertisement.store')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="card m-1">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-text-width"></i> &nbsp; Title
                            </span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo e(old('title')); ?>" name="title"
                            placeholder="advertisement Title" required/>

                    </div>
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>


                <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" name="display" value="1" checked>
                            </div>
                        </div>
                        <input type="button " class="form-control bg-indigo text-muted" value="Display" disabled>
                    </div>
                    <?php $__errorArgs = ['display'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
               
                <div class="col-md-6 mt-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-arrow-up"></i> &nbsp; Type
                            </span>
                        </div>
                        <select class="form-select form-control" aria-label="Default select example" name="type" id="type">
                            <option selected disabled>Select Ads Type</option>
                            <option value="1" <?php echo e(old('type')=='1'?'selected':''); ?>>Main Banner</option>
                            <option value="2" <?php echo e(old('type')=='2'?'selected':''); ?>>Side Bar Video</option>
                            <option value="3" <?php echo e(old('type')=='3'?'selected':''); ?>>Side Bar Image</option>
                          </select>  
                    <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                </div>
               
            </div>
        </div>
    </div>
    <div class="card image" >
        <div class="card-header">
            <label class="title mb-0" style="font-size: 12px;">
                <b>Images</b>
            </label>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-image fa-lg"></i> &nbsp;
                                Image
                            </span>
                        </div>
                        <input type="file" name="image" class="bg-primary text-white form-control dropify" value="<?php echo e(old('image')); ?>">
                    </div>
                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div style="font-size: 12px; color: gray;">
                        <small><strong>Recommended Image</strong></small><br>
                        <small class="big">Resolution : <strong>1500px X
                                300px</strong></small><br>
                        <small class="big">Accept : <strong>png,jpg,jpeg</strong></small><br>
                        <small class="small">Resolution : <strong>300px X
                            150px</strong></small><br>
                        <small class="small">Accept : <strong>png,jpg,jpeg,gif</strong></small><br>
                        <small>File Size : <strong>Smaller than or Equal to 9MB
                                ( ≤ 9MB)</strong></small>
                    </div>


                </div>
                  <div class="col-md-12 mt-2 link">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-link"></i> &nbsp; link
                            </span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo e(old('link')); ?>" name="link"
                            placeholder="enter link"/>

                    </div>
                    <?php $__errorArgs = ['link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

               
            </div>
        </div>
    </div>
    <div class="card url">
        <div class="card-header">
            <label class="title mb-0" style="font-size: 12px;">
                <b>Advertisement Youtube Url</b>
            </label>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mt-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-link"></i> &nbsp; Url (Youtube link)
                            </span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo e(old('url')); ?>" name="url"
                            placeholder="enter url"/>

                    </div>
                    <?php $__errorArgs = ['url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
          </div>
        </div>
    </div>
        
    

    <div class="clearfix"></div>
    <div class="row sticky-bottom">
        <div class="col-md-12 text-right">
            <a href="<?php echo e(route('admin.advertisement.index')); ?>" class="btn btn-danger btn-sm">Cancel</a>

            <button type="submit" class="btn btn-primary btn-lg">
                Save Change
            </button>
        </div>
    </div>
</form>


<?php /**PATH /home/megajobn/public_html/resources/views/admin/advertisement/components/add.blade.php ENDPATH**/ ?>