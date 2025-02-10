<?php $__env->startSection('title', 'Department Management'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Department Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Department Management</li>
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
                            <?php if(request()->routeIs('admin.company_category.edit')): ?>
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editcompany_category">
                                        <i class="fa fa-plus"></i> Edit Department</a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#company_categorys">
                                        <i class="fa fa-list"></i> All Department
                                    </a>
                                </li>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('company-create')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#addcompany_category">
                                        <i class="fa fa-plus"></i> Add Department</a>
                                </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        <?php if($status == 'edit'): ?>
                            <div class="tab-pane active show" id="editcompany_category">
                                <?php echo $__env->make('admin.company_category.components.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php else: ?>
                            <div class="tab-pane active show" id="company_categorys">
                                <?php echo $__env->make('admin.company_category.components.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('company-create')): ?>
                            <div class="tab-pane" id="addcompany_category">
                                <?php echo $__env->make('admin.company_category.components.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/company_category/index.blade.php ENDPATH**/ ?>