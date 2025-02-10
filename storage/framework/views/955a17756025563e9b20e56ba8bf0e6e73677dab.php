<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/nestable/jquery-nestable.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/sweetalert/sweetalert.css')); ?>"/>
<?php $__env->stopSection(); ?>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="tab-content mt-0">
            <div class="tab-pane show active" id="Pages">
                <div class="card">
                    <?php if(count($advertisement)>0): ?>
                    <div class="body mt-0">
                        <div class="dd nestable-with-handle" id="nestable">
                            <ol class="dd-list">
                                <?php $__currentLoopData = $advertisement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="dd-item dd3-item image-none" data-id="<?php echo e($ad->id); ?>">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content">
                                        <small>
                                            &nbsp;&nbsp;&nbsp;
                                            <b> <?php echo e($ad->title); ?></b> | <i style="font-size: 10px;" class="<?php echo e($ad->display == 1 ? 'badge badge-primary' : 'badge badge-danger'); ?>">  <?php echo e($ad->display == 1 ? 'Displayed' : 'Not Display'); ?></i> | <i style="font-size: 10px;" class="badge badge-primary"><?php if($ad->type=='1'): ?> Main Banner <?php elseif($ad->type=='2'): ?> SideBar Video <?php else: ?> SideBar Image <?php endif; ?></i> </i>
                                        </small>
                                        <span class="content-right">

                                            <a href="<?php echo e(route('admin.advertisement.edit',base64_encode($ad->id))); ?>"
                                                class="btn btn-sm btn-outline-primary" title="Edit"><i
                                                    class="fa fa-edit"></i></a>

                                            <a href="#delete" data-toggle="modal" data-id="1"
                                                id="delete1"
                                                class="btn btn-sm btn-outline-danger delete"
                                                onclick="COnfirmDelete('<?php echo e($ad->id); ?>')" data-id="<?php echo e($ad->id); ?>"> <i
                                                    class="fa fa-trash"></i>
                                            </a>
                                        </span>
                                    </div>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ol>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="body my-2">
                        <div class="text-center">
                            <h3>Data not Found!!</h3>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('backend/assets/vendor/nestable/jquery.nestable.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/html/assets/js/pages/ui/sortable-nestable.js')); ?>"></script>
    <script>
        $("#nestable").nestable();
    </script>
    <script src="<?php echo e(asset('backend/assets/vendor/sweetalert/sweetalert.min.js')); ?>"></script>
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
            }, function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        method: "POST",
                        url: '<?php echo e(route("admin.advertisement.destroy")); ?>',
                        data: {
                            '_token' : '<?php echo e(csrf_token()); ?>',
                            'id' : id
                        },
                        success:function(res)
                        {
                             swal({
                                    title: "Deleted",
                                    text: "advertisement has been deleted!",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#28a745",
                                    confirmButtonText: "Okay",
                                    closeOnConfirm: false,
                                    closeOnCancel: false
                                }, function (isConfirm) {
                                    if(isConfirm)
                                    {
                                        location.reload();
                                    }
                                }
                            );
                        },
                        error:function(data)
                        {
                            // toastr.error("Sorry Something Went Wrong!!");
                        }

                    })
                } else {
                    swal("Cancelled", "Your advertisement is safe :)", "error");
                }
            });
        }
    </script>
     <script>
        $(document).ready(function() {
            var updateOutput = function(e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                $.ajax({
                    method: "POST",
                    url: "<?php echo e(route('admin.advertisement.order')); ?>",
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
<?php $__env->stopSection(); ?>
<?php /**PATH /home/megajobn/public_html/resources/views/admin/advertisement/components/list.blade.php ENDPATH**/ ?>