<?php
if (request()->routeIs('*.adminUsers.*')) {
    $url = route('admin.adminUsers.store');
} else {
    $url = route('admin.admin-management.store');
}
?>
<form method="post" action="<?php echo e($url); ?>" autofocus="off">
    <?php echo csrf_field(); ?>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="min-width: 100px; background-color: #e1e8ed">
                            <i class="fa fa-text-width"></i> &nbsp; Name
                        </span>
                    </div>
                    <input type="text" name="name" class="form-control" aria-label="Default"
                        aria-describedby="inputGroup-sizing-default" required placeholder="eg: John Doe">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="min-width: 100px; background-color: #e1e8ed">
                            <i class="fa fa-envelope"></i> &nbsp;Email
                        </span>
                    </div>
                    <input type="email" name="email" class="form-control" autocomplete="new-email"
                        aria-label="Default" aria-describedby="inputGroup-sizing-default" required
                        placeholder="eg: hello@example.com">
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="min-width: 100px; background-color: #e1e8ed">
                            <i class="fa fa-lock"></i> &nbsp;Password
                        </span>
                    </div>
                    <input type="password" name="password" class="form-control" aria-label="Default"
                        autocomplete="new-password" aria-describedby="inputGroup-sizing-default" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="min-width: 100px; background-color: #e1e8ed">
                            <i class="fa fa-lock"></i> &nbsp;Re-Type Password
                        </span>
                    </div>
                    <input type="password" name="password_confirmation" class="form-control" aria-label="Default"
                        aria-describedby="inputGroup-sizing-default">
                </div>
            </div>
            <?php if(request()->routeIs('*.adminUsers.*')): ?>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="min-width: 100px; background-color: #e1e8ed">
                                <i class="fa fa-user"></i> &nbsp;Role
                            </span>
                        </div>
                        <select name="role" class="form-control">
                            <option selected disabled>--Select Role--</option>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>
    <div class="card-footer">

        <a href="<?php echo e(redirect()->back()); ?>" class="btn btn-outline-danger">CANCEL</a>

        <button type="submit" style="float: right;" class="btn btn-outline-success"> Save</button>


    </div>
</form>
<?php /**PATH /home/megajobn/public_html/resources/views/admin/users/components/add.blade.php ENDPATH**/ ?>