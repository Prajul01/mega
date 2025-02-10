<?php $__env->startSection('title', 'Saved Jobs | Job Seeker'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content">

        <div class="page-content">
            <!-- START CANDIDATE-DETAILS -->
            <section class="section dashboard-section">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="sticky-sidebar">
                                <div class="card candidate-info new-shadow-sidebar mt-4 mb-2 mt-lg-0">
                                    <div class="card-body p-3">
                                        <div class="active-search">
                                            <a href="<?php echo e(route('user.dashboard', auth()->user()->username)); ?>"
                                                class="">
                                                <span class="icon">
                                                    <i class="fa-solid fa-house"></i>
                                                </span> &nbsp;
                                                Home /
                                            </a>

                                            <a href="javascript:void(0)" class="color-black">
                                                 Saved Job
                                            </a>

                                        </div>
                                    </div>
                                </div>
                                <?php echo $__env->make('user.jobseeker.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>


                        </div><!--end col-->

                        <div class="col-lg-9 col-md-8">
                             <div class="card candidate-info new-shadow-sidebar mt-4 mb-3 mt-lg-0">
                                <div class="card-body p-0">
                                    <div class="job-summary-tab mt-0">
                                        <div class="table-responsive">
                                            <table class="job-table">
                                                <tr class="table-row">
                                                    <th>Company</th>
                                                    <th>Job Position</th>
                                                    <th>Job Type</th>
                                                    <th>Job Level</th>
                                                    <th>Applied Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>

                                                <?php $__currentLoopData = $user_saves_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="table-row">
                                                        <td>
                                                            <div class="company-logo">
                                                                <img src="<?php echo e(asset('storage/employer/logo' . $job->job->employer->logo)); ?>"
                                                                    class="img-fluid" alt="<?php echo e($job->job->employer->slug); ?>">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="job-detail">
                                                                <div class="job-post">
                                                                    <?php echo e($job->job->title); ?>

                                                                </div>
                                                                <div class="job-by">
                                                                    <?php echo e($job->job->company_name); ?>

                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="job-type">
                                                                <span
                                                                    class="green-light"><?php echo e($job->job->employee_type->title); ?></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="job-level">
                                                                <span
                                                                    class="orange-light"><?php echo e($job->job->job_level->title); ?></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="deadline">
                                                                <?php
                                                                $currentDateTime = \Carbon\Carbon::now();
                                                                $endDate = \Carbon\Carbon::parse($job->job->expiry_date);
                                                                $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                                                    'parts' => 2,
                                                                    'short' => false,
                                                                    'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                                                ]);
                                                                ?>
                                                                <?php echo e($timeLeft); ?> Left
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="job-status">
                                                                <span class="blue-light">
                                                                    Applied
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="job-detail">
                                                                <a href="<?php echo e(route('job_single', $job->job->slug)); ?>"
                                                                    class="btn btn-border">
                                                                    View Detail
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </table>
                                        </div>
                                    </div>
                                </div><!--end card-->
                            </div><!--end col-->

                        </div><!--end row-->
                    </div><!--end container-->
            </section>
            <!-- END CANDIDATE-DETAILS -->

        </div>
        <!-- End Page-content -->




    </div>
    <!-- End Page-content -->

    <!--start back-to-top-->
    <button onclick="topFunction()" id="back-to-top">
        <i class="mdi mdi-arrow-up"></i>
    </button>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).scroll(function() {
            var y = $(this).scrollTop();
            if (y > 300) {
                $('.footer-fixed').addClass("add-sticky");
            } else {
                $('.footer-fixed').removeClass("add-sticky");
            }
        });


        $(".see-more").click(function() {
            $(this).siblings(".checkbox-list").addClass('more-view');
            $(this).siblings(".see-less").removeClass('d-none');
            $(this).addClass('d-none');
        });
        $(".see-less").click(function() {
            $(this).siblings(".checkbox-list").removeClass('more-view');
            $(this).siblings(".see-more").removeClass('d-none');
            $(this).addClass('d-none');
        });

        $(".remove-job").click(function() {
            $(this).closest('.table-row').remove();
        })

        $("#menu-dropdown").click(function() {
            $(".mobile-dropdown").toggleClass("menu-toggle");
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/jobseeker/seeker-savedJob.blade.php ENDPATH**/ ?>