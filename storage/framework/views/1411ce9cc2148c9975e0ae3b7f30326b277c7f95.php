<?php $__env->startSection('title', 'Roles & Permission Management'); ?>
<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
    <style>
        .wrapper .page-wrap .main-content .page-header .page-header-title i {
            width: 50px !important;
            height: 50px !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <h1>Roles & Permission Management</h1>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Role Management</li>
                        </ol>
                    </nav>
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-create')): ?>
                    <div class="col">
                        <a href="<?php echo e(route('admin.roles.create')); ?>" class="btn btn-primary" style="float:right;"><i
                                class="fa fa-plus"></i>&nbsp;Add Role</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive p-3">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Permission Assigned</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($role->name); ?></td>
                                                <td class="col">
                                                    <div class="d-flex flex-wrap">
                                                        <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <small
                                                                class="badge badge-secondary mb-1"><?php echo e($permission->name); ?></small>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </td>
                                                <td class="col">
                                                    <div class="list-actions">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-list')): ?>
                                                            <a href="<?php echo e(route('admin.roles.show', $role->id)); ?>"
                                                                class="btn btn-icon btn-primary"><i class="fa fa-eye"></i></a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-edit')): ?>
                                                            <a href="<?php echo e(route('admin.roles.edit', $role->id)); ?>"
                                                                class="btn btn-icon btn-info"><i class="fa fa-edit"></i></a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-delete')): ?>
                                                            <a href="#delete" data-toggle="modal"
                                                                class="btn btn-icon btn-danger"
                                                                onclick="delete_role('<?php echo e(base64_encode($role->id)); ?>')"><i
                                                                    class="fa fa-trash"></i></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
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

        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Delete Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-white">
                        <p>Are you Sure...!!</p>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                        <a href="" class="btn btn-round btn-primary">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('script'); ?>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
        <script>
            new DataTable('#datatable');
            (function($) {
                'use strict';
                $(document).ready(function() {
                    var dTable = $('#myAdvancedTable').DataTable({

                        order: [],
                        lengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                        ],
                        responsive: false,
                        scroller: {
                            loadingIndicator: false
                        },
                        pagingType: "full_numbers",
                        dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
                        buttons: [{
                                extend: 'copy',
                                className: 'btn-sm btn-info',
                                title: 'Permissions',
                                header: false,
                                footer: true,
                                exportOptions: {
                                    // columns: ':visible'
                                }
                            },
                            {
                                extend: 'csv',
                                className: 'btn-sm btn-success',
                                title: 'Permissions',
                                header: false,
                                footer: true,
                                exportOptions: {
                                    // columns: ':visible'
                                }
                            },
                            {
                                extend: 'excel',
                                className: 'btn-sm btn-warning',
                                title: 'Permissions',
                                header: false,
                                footer: true,
                                exportOptions: {
                                    // columns: ':visible',
                                }
                            },
                            {
                                extend: 'pdf',
                                className: 'btn-sm btn-primary',
                                title: 'Permissions',
                                pageSize: 'A2',
                                header: false,
                                footer: true,
                                exportOptions: {
                                    // columns: ':visible'
                                }
                            },
                            {
                                extend: 'print',
                                className: 'btn-sm btn-default',
                                title: 'Permissions',
                                // orientation:'landscape',
                                pageSize: 'A2',
                                header: true,
                                footer: false,
                                orientation: 'landscape',
                                exportOptions: {
                                    // columns: ':visible',
                                    stripHtml: false
                                }
                            }
                        ]
                    });

                });

            })(jQuery);
        </script>
        <script>
            function delete_role(id) {
                console.log('im here');
                var conn = './role/delete/' + id;
                $('#delete a').attr("href", conn);
            }
        </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/roles/index.blade.php ENDPATH**/ ?>