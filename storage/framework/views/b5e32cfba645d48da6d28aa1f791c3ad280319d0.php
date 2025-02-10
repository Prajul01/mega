
<?php $__env->startSection('title', 'Employer Management'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Employer Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Employer Management</li>
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
                            <?php if(request()->routeIs('admin.employer.edit')): ?>
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#editEmployer">
                                        <i class="fa fa-plus"></i> Edit Employer</a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#Employers">
                                        <i class="fa fa-list"></i> All Employer
                                    </a>
                                </li>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employer-create')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#addEmployer">
                                            <i class="fa fa-plus"></i> Add Employer</a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="tab-content mt-8">
                        <?php if($status == 'edit'): ?>
                            <div class="tab-pane active show" id="editEmployer">
                                <?php echo $__env->make('admin.employer.components.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php else: ?>
                            <div class="tab-pane active show" id="Employers">
                                <?php echo $__env->make('admin.employer.components.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('employer-create')): ?>
                                <div class="tab-pane" id="addEmployer">
                                    <?php echo $__env->make('admin.employer.components.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/employer/index.blade.php ENDPATH**/ ?>