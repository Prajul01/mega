<?php $__env->startSection('title', 'Adverisement Content Management'); ?>
<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/dropify/css/dropify.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Applied Users</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="#">Adverisement Content Management</a></li>
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
                                <a class="nav-link show active" data-toggle="tab" href="#categories">
                                    <i class="fa fa-list"></i> All Applicants
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <form action="<?php echo e(route('admin.adContent.update')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="card-body px-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="" class="form-label">
                                            Main Content
                                        </label>
                                        <textarea name="main_content" placeholder="Enter Main Content" class="ckeditor"><?php echo e(old('main_content', @$content->main_content)); ?></textarea>
                                    </div>
                                    <div class="col-md-12 my-4">
                                        <label for="" class="form-label">
                                            Why Megajob?
                                        </label>
                                        <textarea name="why_megajob" placeholder="Enter Main Content" class="ckeditor" required><?php echo e(old('why_megajob', @$content->why_megajob)); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="col-md-12">
                                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;Cancel</a>
                                    <button class="btn btn-success" style="float:right"><i class="fa fa-check"></i>&nbsp;Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/adContent/form.blade.php ENDPATH**/ ?>