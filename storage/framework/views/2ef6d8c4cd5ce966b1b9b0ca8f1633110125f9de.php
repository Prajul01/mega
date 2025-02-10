
<?php $__env->startSection('title', 'Tender Management'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Tender Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tender Management</li>
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
                            <?php if(request()->routeIs('admin.tender.edit')): ?>
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#edittender">
                                        <i class="fa fa-plus"></i> Edit Tender </a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#tender">
                                        <i class="fa fa-list"></i> All Tender
                                    </a>
                                </li>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tender-create')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#addtender">
                                            <i class="fa fa-plus"></i> Add Tender</a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        <?php if($status == 'edit'): ?>
                            <div class="tab-pane active show" id="edittender">
                                <?php echo $__env->make('admin.tender.components.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php else: ?>
                            <div class="tab-pane active show" id="tender">
                                <?php echo $__env->make('admin.tender.components.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tender-create')): ?>
                                <div class="tab-pane" id="addtender">
                                    <?php echo $__env->make('admin.tender.components.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get the date input element
        var dateInput = document.getElementById("date");

        // Set the minimum date allowed to today's date
        dateInput.min = new Date().toISOString().split('T')[0];

        // Add an event listener to the date input to update the minimum date if necessary
        dateInput.addEventListener("change", function() {
            var selectedDate = new Date(this.value);
            var today = new Date();
            if (selectedDate < today) {
                this.value = "";
                this.min = today.toISOString().split('T')[0];
                alert("Please select a future date.");
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/tender/index.blade.php ENDPATH**/ ?>