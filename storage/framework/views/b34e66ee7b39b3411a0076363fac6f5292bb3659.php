<?php $__env->startSection('title'); ?>
    <?php echo e($employee->company_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seo_section'); ?>
    <meta name="description" content="<?php echo e(isset($setting) ? $setting->og_description : ''); ?>">
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e(isset($setting) ? $setting->og_title : ''); ?>">
    <meta property="og:description" content="<?php echo e(isset($setting) ? $setting->og_description : ''); ?>">
    <meta property="og:image"
        content="<?php echo e(isset($setting) ? asset('storage/setting/og-image/' . $setting->og_image) : ''); ?>">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:url" content="<?php echo e(url()->current()); ?>">
    <meta name="twitter:title" content="<?php echo e(isset($setting) ? $setting->og_title : ''); ?>">
    <meta name="twitter:description" content="<?php echo e(isset($setting) ? $setting->og_description : ''); ?>">
    <meta name="twitter:image"
        content="<?php echo e(isset($setting) ? asset('storage/setting/og-image/' . $setting->og_image) : ''); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <div class="page-content">
            <!-- START CANDIDATE-DETAILS -->
            <section class="section dashboard-section">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-lg-9">
                            <div class="card candidate-info shadow-sidebar mt-4 mb-3 mt-lg-0">
                                <div class="hiring-banner">
                                    <img src="<?php echo e(asset('storage/employer/' . $employee->image)); ?>" class="img-fluid"
                                        alt="hiring-banner">
                                </div>
                                <div class="card-body p-3">
                                    <div class="user-profile-summary">
                                        <div class="profile-summary-heading company-profile-heading">
                                            <div class="company-img">
                                                <img src="<?php echo e(asset('storage/employer/logo' . $employee->logo)); ?>"
                                                    alt="<?php echo e($employee->company_name); ?> logo" class="img-thumbnail">
                                            </div>
                                            <div class="user-basic-info">
                                                <div class="user-name">
                                                    <?php echo e($employee->company_name); ?>

                                                </div>
                                                <div class="company-industry">
                                                    <?php echo e($employee->category->title); ?>

                                                </div>
                                                <?php if(@$employee->settings->ownership): ?>
                                                    <div class="company-type">
                                                        <strong
                                                            class="blue-light px-2"><?php echo e($employee->ower_ship->title); ?></strong>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <?php if(@$employee->settings->summary): ?>
                                            <div class="profile-summary-body">
                                                <div class="education-summary-title">
                                                    <span class="icon">
                                                        <i class="fa-solid fa-briefcase"></i>
                                                    </span> Company Description
                                                </div>
                                                <div class="education-summary-body">
                                                    <div class="company-about-desc">
                                                        <?php echo strip_tags($employee->company_description); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="profile-summary-table">
                                            <div class="single-basic-wrapper">
                                                <div class="basic-job-desc">
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Organization Ownership
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <?php echo e($employee->ower_ship->title); ?>

                                                        </div>
                                                    </div>
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Organization Type
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <?php echo e($employee->category->title); ?>

                                                        </div>
                                                    </div>
                                                    <?php if(@$employee->settings->size): ?>
                                                        <div class="basic-job-list">
                                                            <div class="basic-job-left">
                                                                Size of Organization
                                                            </div>
                                                            <div class="basic-job-right">

                                                                <?php echo e($employee->company_size->title); ?> employees
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="basic-job-list">
                                                        <div class="basic-job-left">
                                                            Company Email
                                                        </div>
                                                        <div class="basic-job-right">
                                                            <?php
                                                            $emails = $employee
                                                                ->emails()
                                                                ->orderBy('is_primary', 'desc')
                                                                ->get();
                                                            ?>
                                                            <?php $__currentLoopData = $emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                [<a
                                                                    href="mailto:<?php echo e($email->email); ?>"><?php echo e($email->email); ?></a>]
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                    <?php if(@$employee->settings->address): ?>
                                                        <div class="basic-job-list">
                                                            <div class="basic-job-left">
                                                                Address
                                                            </div>
                                                            <div class="basic-job-right">
                                                                <?php
                                                                if (@$employer->city->name == @$employer->district->name) {
                                                                    $address = $employee->city->name;
                                                                } else {
                                                                    $address = $employee->city->name . ', ' . @$employer->district->name;
                                                                }
                                                                ?>
                                                                <?php echo e($address); ?>

                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(@$employee->office_number): ?>
                                                        <div class="basic-job-list">
                                                            <div class="basic-job-left">
                                                                Office Number

                                                            </div>
                                                            <div class="basic-job-right">
                                                                <a
                                                                    href="tel:<?php echo e($employee->office_number); ?>"><?php echo e($employee->office_number); ?></a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(@$employee->phone_number): ?>
                                                        <div class="basic-job-list">
                                                            <div class="basic-job-left">
                                                                Phone Number
                                                            </div>
                                                            <div class="basic-job-right">
                                                                <a
                                                                    href="tel:<?php echo e($employee->phone_number); ?>"><?php echo e($employee->phone_number); ?></a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(@$employee->settings->website): ?>
                                                        <div class="basic-job-list">
                                                            <div class="basic-job-left">
                                                                Website
                                                            </div>
                                                            <div class="basic-job-right">
                                                                <a href="<?php echo e($employee->company_website); ?>"
                                                                    target="_blank"><?php echo e($employee->company_website); ?></a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(@$employee->settings->social_accounts): ?>
                                                        <div class="basic-job-list">
                                                            <div class="basic-job-left">
                                                                Social Account

                                                            </div>
                                                            <div class="basic-job-right">
                                                                <div class="social-share">
                                                                    <ul class="job-social pl-0">
                                                                        <?php if(@$employee->facebook_url): ?>
                                                                            <li class="facebook"><a
                                                                                    href="<?php echo e($employee->facebook_url); ?>"
                                                                                    class="">
                                                                                    <i class="fa-brands fa-facebook-f"></i>
                                                                                </a></li>
                                                                        <?php endif; ?>
                                                                        <?php if(@$employee->instagram_url): ?>
                                                                            <li class="insta"><a
                                                                                    href="<?php echo e($employee->instagram_url); ?>"
                                                                                    class="">
                                                                                    <i class="fa-brands fa-instagram"></i>
                                                                                </a></li>
                                                                        <?php endif; ?>
                                                                        <?php if(@$employee->youtube_url): ?>
                                                                            <li class="twitter"><a href=""
                                                                                    class="<?php echo e($employee->yoututbe_url); ?>">
                                                                                    <i class="fa-brands fa-youtube"></i>
                                                                                </a></li>
                                                                        <?php endif; ?>
                                                                        <?php if(@$employee->linkedIn_url): ?>
                                                                            <li class="linkedin"><a
                                                                                    href="<?php echo e($employee->linkedIn_url); ?>"
                                                                                    class="">
                                                                                    <i
                                                                                        class="fa-brands fa-linkedin-in"></i>
                                                                                </a></li>
                                                                        <?php endif; ?>
                                                                        <?php if(@$employee->tiktok_url): ?>
                                                                            <li class="reddit"><a
                                                                                    href="<?php echo e($employee->tiktok_url); ?>"
                                                                                    class="">
                                                                                    <i class="fa-brands fa-tiktok"></i>
                                                                                </a></li>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php if(@$employee->settings->services): ?>
                                                <div class="profile-summary-body my-3">
                                                    <div class="education-summary-title">
                                                        <span class="icon">
                                                            <i class="fa-solid fa-briefcase"></i>
                                                        </span> Services
                                                    </div>

                                                    <div class="education-summary-body">
                                                        <div class="company-about-desc">
                                                            <?php echo $employee->services; ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if(@$employee->contact_persons_information): ?>
                                                <div class="row company-contact-person">
                                                    <div class="col-lg-12">
                                                        <h4 class="tab-main-title">
                                                            <span class="tab-icon">
                                                                <i class="fa-solid fa-id-card-clip"></i>
                                                            </span> &nbsp;
                                                            Contact Persons
                                                        </h4>
                                                    </div>
                                                    <?php
                                                    $infos = json_decode(@$employee->contact_persons_information);
                                                    $name = @$infos->names ? $infos->names : (@$infos->name ? $infos->name : []);
                                                    $email = @$infos->emails ? $infos->emails : (@$infos->email ? $infos->email : []);
                                                    $designation = $infos->designation;
                                                    $mobile = @$infos->number ? $infos->number : (@$infos->mobile ? $infos->mobile : []);
                                                    
                                                    $count = count($name);
                                                    ?>
                                                    <?php for($i = 0; $i < $count; $i++): ?>
                                                        <div class="col-lg-4 col-md-6">
                                                            <div class="contact-person-info">
                                                                <p class="contact-name"><?php echo e($name[$i]); ?></p>
                                                                <div class="ending-content-gradient-box">
                                                                    <p>
                                                                        <span class="top-icon">
                                                                            <i class="fa-solid fa-briefcase"></i> :&nbsp;
                                                                        </span>
                                                                        <?php echo e($designation[$i]); ?>

                                                                    </p>
                                                                    <p>
                                                                        <span class="top-icon">
                                                                            <i class="fa-solid fa-envelope"></i> :&nbsp;
                                                                        </span>
                                                                        <a
                                                                            href="mailto:<?php echo e($email[$i]); ?>"><?php echo e($email[$i]); ?></a>
                                                                    </p>
                                                                    <p>
                                                                        <span class="top-icon">
                                                                            <i class="fa-solid fa-phone"></i> :&nbsp;
                                                                        </span>
                                                                        <a
                                                                            href="tel:<?php echo e($mobile[$i]); ?>"><?php echo e($mobile[$i]); ?></a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endfor; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="side-box">
                                <div class="sidebox-wrap">
                                    <div class="sidebox-title">
                                        <p>Urgent Job Vacancies</p>
                                    </div>
                                    <?php if(count($urgent_jobs) > 0): ?>
                                        <div class="sidebox-content">
                                            <ul>
                                                <?php $__currentLoopData = $urgent_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <p>
                                                            <a href="<?php echo e(route('job_single', $job->slug)); ?>"><i
                                                                    class="fa fa-plus"></i><?php echo e($job->title); ?>

                                                                - <small><?php echo e($job->employer->company_name); ?></small></a>
                                                        </p>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="a-break mb-2">
                                    <img src="<?php echo e(asset('frontend/assets/images/files/machapuchree-bank_k8S0FE3TWD.gif')); ?>"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="sidebox-wrap">
                                    <div class="sidebox-title">
                                        <p>Career Tips</p>
                                    </div>
                                    <?php if(count($careers) > 0): ?>
                                        <div class="sidebox-content">
                                            <ul>
                                                <?php $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <p>
                                                            <a
                                                                href="<?php echo e(route('career-details', ['career' => $career->slug])); ?>"><i
                                                                    class="fa fa-chevron-right"></i>
                                                                <?php echo e($career->title); ?>

                                                            </a>
                                                        </p>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div><!--end container-->
                </div>
            </section>

            <?php if(count($employee->jobs) > 0): ?>
                <section class="company-job-section-new">
                    <div class="container-fluid custom-container">
                        <div class="row job-box-wrapper mb-2">
                            <?php $__currentLoopData = $employee->jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-6">
                                    <div class="job-box card mt-2">
                                        <div class="p-3 pb-2">
                                            <div class="job-list-card">
                                                <div class="company-image">
                                                    <a href="https://megajob.ktmrush.com/employer/detail/tech-central-1"><img
                                                            src="<?php echo e(asset('storage/employer/logo' . $job->employer->logo)); ?>"
                                                            alt="Tech central" width="83px"
                                                            class="img-fluid rounded-3"></a>
                                                </div>
                                                <div class="job-desc-company">
                                                    <div class="mt-3 mt-lg-0">
                                                        <h5 class="fs-18 mb-0"><a
                                                                href="https://megajob.ktmrush.com/job/montana-ware"
                                                                class="text-dark">
                                                                <?php echo e($job->title); ?></a>
                                                        </h5>
                                                        <p class="fs-14 mb-0">
                                                            <a href="https://megajob.ktmrush.com/employer/detail/tech-central-1"
                                                                class="text-dark">
                                                                <?php echo e($job->employer->company_name); ?>

                                                            </a>
                                                        </p>
                                                    </div>
                                                    <div class="job-main-info d-block">
                                                        <div class="location">
                                                            <span class="icon">
                                                                <i class="fa-solid fa-location-dot fs-13"></i>
                                                            </span>
                                                            <span class="fs-14">
                                                                <?php
                                                                if (@$employer->city->name == @$employer->district->name) {
                                                                    $address = $employee->city->name;
                                                                } else {
                                                                    $address = $employee->city->name . ', ' . @$employer->district->name;
                                                                }
                                                                ?>
                                                                <?php echo e($address); ?></span>
                                                        </div>

                                                        <div class="job-single-company-detail text">
                                                            <?php echo $job->job_description; ?>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="list-card-bottom">
                                                <div class="time-span">
                                                    <?php if(@$job->expiry_date): ?>
                                                        <span class="icon">
                                                            <i class="fa-regular fa-clock"></i>
                                                        </span>
                                                        <?php
                                                        $currentDateTime = \Carbon\Carbon::now();
                                                        $endDate = \Carbon\Carbon::parse($job->expiry_date);
                                                        $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                                            'parts' => 2,
                                                            'short' => false,
                                                            'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                                        ]);
                                                        ?>
                                                        <?php echo e($timeLeft); ?> Left
                                                    <?php endif; ?>
                                                </div>
                                                <div class="apply-btn">
                                                    <a href="<?php echo e(route('job_single', $job->slug)); ?>"
                                                        class="btn btn-orange">View Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>
                </section>
            <?php endif; ?>

            <!-- END CANDIDATE-DETAILS -->

        </div>
        <!-- End Page-content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/employer-detail.blade.php ENDPATH**/ ?>