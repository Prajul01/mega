
<?php $__env->startSection('title', 'Advertisement Management'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-12 col-sm-12">
                <h1>Advertisement Management</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Advertisement Management</li>
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
                        <?php if(request()->routeIs('admin.advertisement.edit')): ?>
                            <li class="nav-item">
                                <a class="nav-link show active" data-toggle="tab" href="#editad">
                                    <i class="fa fa-plus"></i> Edit Advertisement</a>
                            </li>
                            <li class="nav-item ml-auto">
                                <a class="nav-link show active" href="<?php echo e(route('admin.advertisement.index')); ?>">
                                    <i class="icon-arrow-left"></i>&nbsp;Go back</a>
                            </li>
                        
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link show active" data-toggle="tab" href="#advertisement">
                                    <i class="fa fa-list"></i> All Advertisement
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#addad">
                                    <i class="fa fa-plus"></i> Add Advertisement</a>
                            <li>
                            
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="tab-content">
                    <?php if($status == 'edit'): ?>
                        <div class="tab-pane active show" id="editad">
                            <?php echo $__env->make('admin.advertisement.components.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php else: ?>
                        <div class="tab-pane active show" id="advertisement">
                            <?php echo $__env->make('admin.advertisement.components.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="tab-pane" id="addad">
                            <?php echo $__env->make('admin.advertisement.components.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('backend/assets/vendor/dropify/js/dropify.js')); ?>"></script>
<script src="<?php echo e(asset('backend/html/assets/js/pages/forms/dropify.js')); ?>"></script>
<script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
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



$('#type').on('change', function() {
    var selectedValue = $('#type option:selected').val();

    if (selectedValue === '1' || selectedValue === '3') {
        $('.image').show();
        $('.url').hide();
        if(selectedValue === '3'){
        $('.small').show();
        $('.big').hide();
        $('.link').show();
    }else{
        $('.small').hide();
        $('.big').show();
    }
    } else {
        $('.image').hide();
        $('.url').show();
         $('.link').hide();
    }
});

$(document).ready(function() {
    var selectedValue = $('#type option:selected').val();

if (selectedValue === '1' || selectedValue === '3') {
    $('.image').show();
    $('.url').hide();
    if(selectedValue === '3'){
        $('.small').show();
        $('.big').hide();
        $('.link').show();
    }else{
        $('.small').hide();
        $('.big').show();
    }
} else if(selectedValue === '2') {
    $('.image').hide();
    $('.url').show();
}else{
    $('.image').hide();
   $('.url').hide();
   $('.link').hide();
}
});
    </script>
<?php echo $__env->yieldContent('script'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/dropify/css/dropify.min.css')); ?>">
    <?php echo $__env->yieldContent('style'); ?>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/advertisement/index.blade.php ENDPATH**/ ?>