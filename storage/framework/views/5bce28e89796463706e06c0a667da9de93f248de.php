<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/nestable/jquery-nestable.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/sweetalert/sweetalert.css')); ?>" />
<?php $__env->stopPush(); ?>
<div class="card">
    <div class="dd" id="nestable">
        <ol class="dd-list has-header">
            <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="dd-item dd3-item list-item" data-id="<?php echo e($education->id); ?>">
                    <div class="dd-handle dd3-handle"></div>
                    <div class="custom-handle-flex">
                        <div class="icon-image-name">
                            <div style="display: flex; align-items:center;">
                                <img src="<?php echo e(asset('/storage/education/' . $education->image)); ?>" alt="<?php echo e($education->title); ?>" class="img-thumbnail mr-2" style="width:40px;">
                                <h6 class=" mb-0">
                                    <?php echo e($education->title); ?> | <small
                                        class="<?php echo e($education->status == 'active' ? 'badge badge-primary' : 'badge badge-danger'); ?>"><?php echo e($education->status == 'active' ? 'Displayed' : 'Not Display'); ?></small>
                                </h6>
                            </div>
                        </div>
                        <div style="display: flex">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('education-edit')): ?>
                                <a href="<?php echo e(route('admin.education.edit', base64_encode($education->id))); ?>"
                                    class="btn btn-sm btn-outline-info" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('education-delete')): ?>
                                &nbsp;
                                <button type="button" onclick="COnfirmDelete('<?php echo e($education->id); ?>')"
                                    data-id="<?php echo e($education->id); ?>" class="btn btn-sm btn-outline-danger">
                                    <i class="fa fa-trash"></i></button>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>

    </div>
</div>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('backend/assets/vendor/nestable/jquery.nestable.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            var updateOutput = function(e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                $.ajax({
                    method: "POST",
                    url: "<?php echo e(route('admin.education.order')); ?>",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        list_order: list.nestable('serialize'),
                        table: "categories"
                    },
                    success: function(response) {
                        // console.log("success");
                        // console.log("response " + response);
                        var obj = jQuery.parseJSON(response);
                        if (obj.status == 'success') {
                            toastr.success("Content Sorted Successfully");
                        }
                        if (obj.status == 'error') {
                            toastr.error("Sorry Something Went Wrong!!");
                        };

                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    toastr.error("Something Went Wrong!");
                });
            };

            $('#nestable').nestable({
                group: 1,
                maxDepth: 1,
            }).on('change', updateOutput);
        });
    </script>
    <script src="<?php echo e(asset('backend/vendor/sweetalert/sweetalert.min.js')); ?>"></script>
    <script>
        function COnfirmDelete(elem) {
            var id = elem;
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        method: "POST",
                        url: '<?php echo e(route('admin.education.destroy')); ?>',
                        data: {
                            '_token': '<?php echo e(csrf_token()); ?>',
                            'id': id
                        },
                        success: function(res) {
                            swal({
                                title: "Deleted",
                                text: "Education has been deleted!",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#28a745",
                                confirmButtonText: "Okay",
                                closeOnConfirm: false,
                                closeOnCancel: false
                            }, function(isConfirm) {
                                if (isConfirm) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(data) {
                            // toastr.error("Sorry Something Went Wrong!!");
                        }

                    })
                } else {
                    swal("Cancelled", "Your education is safe :)", "error");
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/megajobn/public_html/resources/views/admin/education/components/list.blade.php ENDPATH**/ ?>