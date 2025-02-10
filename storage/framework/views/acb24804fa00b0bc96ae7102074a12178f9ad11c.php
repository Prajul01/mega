<?php
if (request()->routeIs('admin.employers.create')) {
    $flag = 1;
    $url = route('admin.employers.store');
} else {
    $flag = 0;
    $url = route('admin.employers.update', $user->username);
}
?>

<?php $__env->startSection('title', ($flag == 1 ? 'Create' : 'Edit') . ' Employer'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12">
                    <?php if(request()->routeIs('admin.admins.index')): ?>
                        <h1>Admin Management</h1>
                    <?php else: ?>
                        <h1>User Management</h1>
                    <?php endif; ?>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo e($flag == 1 ? 'Create' : 'Update'); ?>

                                Employer</li>
                        </ol>
                    </nav>
                </div>
                <div class="col">
                    <a href="<?php echo e(route('admin.employers.index')); ?>" class="btn btn-primary" style="float:right;"><i
                            class="fa fa-angle-double-left"></i>&nbsp;Go Back</a>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="card">
                <div class="head">
                    <h5><?php echo e($flag == 1 ? 'Create' : 'Update'); ?>&nbsp;Employer</h5>
                </div>
                <div class="body">
                    <form action="<?php echo e($url); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php if(!$flag): ?>
                            <?php echo method_field('PUT'); ?>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter Name" value="<?php echo e(old('name') ? old('name') : @$user->name); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email_address">Email Address</label>
                                    <input type="text" class="form-control" name="email" id="email_address"
                                        placeholder="Enter email address"
                                        value="<?php echo e(old('email') ? old('email') : @$user->email); ?>"
                                        <?php echo e(!$flag ? 'disabled' : ''); ?>>
                                </div>
                            </div>
                            <?php if($flag): ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" id="username"
                                            placeholder="Enter username"
                                            value="<?php echo e(old('username') ? old('username') : @$user->username); ?>">
                                        <span class id="message" style="margin-top:10px!important; display: none;"></span>
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                            <?php endif; ?>
                            <?php if($flag): ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            aria-describedby="emailHelp" placeholder="Enter password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password"
                                            id="confirm_password" placeholder="Enter password again">
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            aria-describedby="emailHelp" placeholder="Enter password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-warning">
                                        Leave Blank If you don't change Password .
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger">Cancel</a>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-success" style="float:right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        $('#username').on('change', function() {
            var username = $('#username').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '<?php echo e(route('admin.employers.validateUsername')); ?>',
                data: {
                    'username': username,
                },
                success: function(data) {
                    if (data['valid'] == 1) {
                        $('#message').removeAttr('class');
                        $('#message').attr('class', 'text-success');
                        $('#message').html('This Username is valid');
                        $('#message').attr('style',
                            'margin-top:5px !important; display:block !important;');
                    }

                    if (data['valid'] == 0) {
                        $('#message').removeAttr('class');
                        $('#message').attr('class', 'text-danger');
                        $('#message').html(
                            'This Username already exists! You can try <span class="btn btn-sm btn-success" id="n-name" onclick="changeUsername(this)">' +
                            data['suggestions'] + '</span>');
                        $('#message').attr('style',
                            'margin-top:5px !important;display:block !important;');
                    }
                }
            });
        });

        function changeUsername(data) {
            var name = $('#n-name').text()
            $('#username').val(name);
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/admin/employerUser/form.blade.php ENDPATH**/ ?>