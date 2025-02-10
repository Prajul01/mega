<?php
$employer = auth()->user()->employer;
?>

<?php $__env->startSection('title', $employer->company_name); ?>
<?php $__env->startSection('dashboard_content'); ?>
    <div class="card new-shadow-sidebar">
        <div class="card-body padding-card-body">
            <div class="description-box top2-description1 pt-0">
                <div class="col-lg-12">
                    <h4 class="tab-main-title">
                        <span class="tab-icon">
                            <i class="fa-solid fa-file-lines"></i>
                        </span> &nbsp;
                        Summary
                    </h4>
                </div>
                <div class="col-lg-12">
                    <?=$employer->company_description?>
                </div>
            </div>
            <div class="description-box top2-description2">
                <div class="col-lg-12">
                    <h4 class="tab-main-title">
                        <span class="tab-icon"><i class="fa-solid fa-gear"></i></span> &nbsp;
                        Services
                    </h4>
                </div>
                <div class="col-lg-12 points-list">
                    <?=$employer->services?>
                </div>
            </div>
            <div class="description-box top2-description2">
                <div class="col-lg-12">
                    <h4 class="tab-main-title">
                        <span class="tab-icon">
                            <i class="fa-solid fa-id-card-clip"></i>
                        </span> &nbsp;
                        Contacts
                    </h4>
                </div>
                <div class="row">
                    <?php if(@$employer->contact_persons_information): ?>
                        <?php
                        $infos = json_decode(@$employer->contact_persons_information);
                        $name = $infos->name;
                        $email = $infos->email;
                        $designation = $infos->designation;
                        $mobile = $infos->number;
                        
                        $count = count($name);
                        ?>
                        <?php for($i = 0; $i < $count; $i++): ?>
                            <div class="col-lg-6">
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
                                            <a href="mailto:<?php echo e($email[$i]); ?>"><?php echo e($email[$i]); ?></a>
                                        </p>
                                        <p>
                                            <span class="top-icon">
                                                <i class="fa-solid fa-phone"></i> :&nbsp;
                                            </span>
                                            <a href="tel:<?php echo e($mobile[$i]); ?>"><?php echo e($mobile[$i]); ?></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    <?php else: ?>
                        <div class="col-md-12">
                            <div class="contact-person-info text-center">
                                No Contacts Available
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employer.overview-jobs.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/employer/overview-jobs/overview.blade.php ENDPATH**/ ?>