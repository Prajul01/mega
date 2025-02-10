<?php
if (isset(auth()->user()->employer->logo)) {
    $url = asset('storage/employer/logo' . auth()->user()->employer->logo);
} else {
    $url = asset('frontend/assets/images/files/company-logo.png');
}
?>
<ul class="header-menu list-inline d-flex align-items-center mb-0">
    <li class="list-inline-item dropdown">
        <a href="javascript:void(0)" class="header-item" id="userdropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo e($url); ?>" alt="mdo" width="35" height="35" class="rounded-circle me-1" style="object-fit:cover;"
                alt="company_logo">
            <span class="fw-medium">
                <span class="mobile-none"><?php echo e(auth()->user()->employer->company_name); ?></span> <span class="top-icon">
                    <i class="fa-solid fa-angle-down"></i>
                </span>
            </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown">
            <li><a class="dropdown-item" href="<?php echo e(route('employers.overview')); ?>">Overview</a></li>
            <li><a class="dropdown-item" href="<?php echo e(route('employers.index')); ?>">Org. Profile</a></li>
            <li><a class="dropdown-item" href="<?php echo e(route('employers.editProfile.index')); ?>">Edit Profile</a></li>
            <li><a class="dropdown-item" href="<?php echo e(route('employers.jobs.index', ['type' => 'active-jobs'])); ?>">Manage
                    Jobs</a></li>
            <li><a class="dropdown-item" href="<?php echo e(route('employers.settings.accountSettings')); ?>">Settings</a></li>
            <form action="<?php echo e(route('employers.logout')); ?>" method="POST" id="logout">
                <?php echo csrf_field(); ?>
            </form>
            <li><a class="dropdown-item" href="#" onclick="logout()">Logout</a></li>
        </ul>
    </li>
    <li class="list-inline-item dropdown">
        <a href="javascript:void(0)" class="btn btn-outline-white" id="userdropdown"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-briefcase"></i> Post a Job
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown">
            <li><a class="dropdown-item" href="<?php echo e(route('employers.postAJob')); ?>">Regular Job</a></li>
            <li><a class="dropdown-item" href="<?php echo e(route('employers.postANewspaper')); ?>">Newspaper Job</a></li>
        </ul>
    </li>
</ul>
<?php /**PATH /home/megajobn/public_html/resources/views/employer/layouts/right-menu.blade.php ENDPATH**/ ?>