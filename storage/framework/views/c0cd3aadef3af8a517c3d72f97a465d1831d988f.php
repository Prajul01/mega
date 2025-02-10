<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/nestable/jquery-nestable.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/sweetalert/sweetalert.css')); ?>" />
<?php $__env->stopPush(); ?>
<div class="card">
    <div class="dd" id="nestable">
        <ol class="dd-list has-header">
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="dd-item dd3-item list-item" data-id="<?php echo e($slider->id); ?>">
                    <div class="dd-handle dd3-handle"></div>
                    <div class="custom-handle-flex">
                        <div class="icon-image-name">
                            <div>
                                <h6 class=" mb-0">
                                    <?php echo e($slider->title); ?> | <small
                                        class="<?php echo e($slider->display == 1 ? 'badge badge-primary' : 'badge badge-danger'); ?>"><?php echo e($slider->display == 1 ? 'Displayed' : 'Not Display'); ?>

                                    </small>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    <label class="switch">
                                        <input type="checkbox" name="toogle" value="<?php echo e($slider->id); ?>"
                                            data-toggle="switchbutton" <?php echo e($slider->display == '1' ? 'checked' : ''); ?>

                                            data-onlabel="1" data-offlabel="0" data-size="sm" data-onstyle="success"
                                            data-offstyle="danger" <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('site-edit')): ?> disabled <?php endif; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </h6>

                            </div>
                        </div>
                        <div style="display: flex">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('site-edit')): ?>
                                <a href="<?php echo e(route('admin.sliders.edit', base64_encode($slider->id))); ?>"
                                    class="btn btn-sm btn-outline-info" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('site-delete')): ?>
                                &nbsp;
                                <button type="button" onclick="COnfirmDelete('<?php echo e($slider->id); ?>')"
                                    data-id="<?php echo e($slider->id); ?>" class="btn btn-sm btn-outline-danger"><i
                                        class="fa fa-trash"></i></button>
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
                    url: "<?php echo e(route('admin.sliders.order')); ?>",
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
        $('input[name=toogle]').change(function() {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            // alert(mode);
            $.ajax({
                url: "<?php echo e(route('admin.sliders.status')); ?>",
                type: "POST",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    mode: mode,
                    id: id,
                },
                success: function(response) {
                    // console.log(response.status);
                    if (response.status) {
                        swal({
                            title: "Good job!",
                            text: response.msg,
                            icon: "success",
                            button: "OK!",
                        });
                    } else {
                        alert('Please try again!');
                    }
                }

            })

        });

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
                        url: '<?php echo e(route('admin.sliders.destroy')); ?>',
                        data: {
                            '_token': '<?php echo e(csrf_token()); ?>',
                            'id': id
                        },
                        success: function(res) {
                            swal({
                                title: "Deleted",
                                text: "Slider has been deleted!",
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
                    swal("Cancelled", "Your slider is safe :)", "error");
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/megajobn/public_html/resources/views/admin/sliders/components/list.blade.php ENDPATH**/ ?>