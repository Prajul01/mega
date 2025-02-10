
<?php $__env->startSection('title', 'Step Procedure Management'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Banner Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Banner Management</li>
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
                                <a class="nav-link show active" data-toggle="tab" href="#">
                                    <i class="fa fa-plus"></i> Advertisement Type</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="bg-secondary text-white" style="width:10%;">#</th>
                                        <th class="bg-secondary text-white" style="width:80%;">Advetisement Type</th>
                                        <th class="bg-secondary text-white" style="width:10%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th><?php echo e(++$key); ?></th>
                                            <th><?php echo e(ucwords(str_replace('-', ' ', $step->posting_type))); ?></th>
                                            <th>
                                                <button type="button" class="btn btn-outline-success mx-1"
                                                    onclick="viewBanner('<?php echo e(asset('storage/adBanner/' . $step->banner)); ?>')">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-primary"
                                                    onclick="editBanner('<?php echo e(base64_encode($step->id)); ?>')">
                                                    <i class="fa fa-image"></i>
                                                </button>
                                            </th>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="viewBanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" class="img-thumbnail" style="width: 1200px; object-fit:cover;" id="viewer">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uploadBanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST" id="editForm" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col">
                            <label for="" class="form-label">Upload Banner</label>
                            <input type="file" class="form-control" name="banner">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        function viewBanner($image) {

            $('#viewer').attr('src', $image);
            $('#viewBanner').modal('show');
        }

        function editBanner($step) {
            $action = "<?php echo e(route('admin.adBanner.update', '')); ?>/" + $step;
            $('#editForm').attr('action', $action);
            $('input[name="banner"]').val('');
            $('#uploadBanner').modal('show');
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/adBanner/index.blade.php ENDPATH**/ ?>