<?php $__env->startSection('title'); ?>
    <?php echo e('Jobs'); ?>

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
    <div class="page-content">

        <!-- START HOME -->
        <section class="bg-home" id="home">
            <?php echo $__env->make('user.layout.banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--end container-->
        </section>
        <!-- End Home -->
        <section class="home-jobs-wrapper bg-light">
            <div class="container-fluid custom-container">
                <div class="row position-relative">
                    <div class="col-sm-3 col-lg-3 filter-responsive">

                        <div class="filter-button">
                            <span class="close-icon">
                                <i class="fa-solid fa-xmark">
                                </i>
                            </span>
                        </div>
                        <form id="filterData">
                            <div class="job-filter">
                                <?php if(count($industries) > 0): ?>
                                    <div class="filter-checkbox">
                                        <h5 class="text-uppercase filter-title">
                                            Prefer Industry
                                        </h5>
                                        <div class="checkbox-list">
                                            <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="filter-list">
                                                    <input type="checkbox" name="industry" value="<?php echo e($industry->id); ?>"
                                                        id="<?php echo e($industry->slug); ?>" <?php echo e(isset(request()->industry)? (request()->industry == $industry->slug? 'checked': '') : ''); ?>>
                                                    <label for="<?php echo e($industry->slug); ?>"> <?php echo e($industry->name); ?></label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="see-more">
                                            See More <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                        <div class="see-less d-none">
                                            See Less <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if(count($departments) > 0): ?>
                                    <div class="filter-checkbox">
                                        <h5 class="text-uppercase filter-title">
                                            Prefer Department
                                        </h5>
                                        <div class="checkbox-list">
                                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="filter-list">
                                                    <input type="checkbox" name="department" value="<?php echo e($department->id); ?>"
                                                        id="<?php echo e($department->slug); ?>" <?php echo e(isset(request()->department)? (request()->department == $department->slug? 'checked': '') : ''); ?>>
                                                    <label for="<?php echo e($department->slug); ?>"> <?php echo e($department->title); ?></label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="see-more">
                                            See More <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                        <div class="see-less d-none">
                                            See Less <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if(count($locations) > 0): ?>
                                    <div class="filter-checkbox">
                                        <h5 class="text-uppercase filter-title">
                                            Prefer Location
                                        </h5>
                                        <div class="checkbox-list">
                                            <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="filter-list">
                                                    <input type="checkbox" name="city" value="<?php echo e($location->id); ?>"
                                                        id="<?php echo e($location->slug); ?>">
                                                    <label for="<?php echo e($location->slug); ?>"> <?php echo e($location->name); ?></label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="see-more">
                                            See More <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                        <div class="see-less d-none">
                                            See Less <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if(count($educations) > 0): ?>
                                    <div class="filter-checkbox">
                                        <h5 class="text-uppercase filter-title">
                                            Education
                                        </h5>
                                        <div class="checkbox-list">
                                            <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="filter-list">
                                                    <input type="checkbox" name="education" value="<?php echo e($education->id); ?>"
                                                        id="<?php echo e($education->slug); ?>">
                                                    <label for="<?php echo e($education->slug); ?>"> <?php echo e($education->title); ?></label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>
                                        <div class="see-more">
                                            See More <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                        <div class="see-less d-none">
                                            See Less <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if(count($experiences) > 0): ?>
                                    <div class="filter-checkbox">
                                        <h5 class="text-uppercase filter-title">
                                            Experience
                                        </h5>
                                        <div class="checkbox-list">
                                            <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="filter-list">
                                                    <input type="checkbox" name="experience" value="<?php echo e($experience->id); ?>"
                                                        id="<?php echo e($experience->slug); ?>">
                                                    <label for="<?php echo e($experience->slug); ?>"> <?php echo e($experience->title); ?></label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="see-more">
                                            See More <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                        <div class="see-less d-none">
                                            See Less <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6 col-md-8 col-lg-6" id="data">
                        <?php echo $__env->make('user.layout.job-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <?php echo $__env->make('user.layout.rigth-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
    </div>
    </section>



    </div>
    <!-- End Page-content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $('document').ready(function() {
            $('filterData').reset();
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


        $(".close-icon").click(function() {
            $(".filter-responsive").removeClass("filter-translate");
        })
        $(".show-icon").click(function() {
            $(".filter-responsive").addClass("filter-translate");
        })
        $('.filter').click(function() {
            var searchString = window.location.href;
            if (searchString.includes('old') || searchString.includes('latest')) {
                if (searchString.includes('old')) {
                    location.href = searchString.replace('old', this.value);
                } else {
                    location.href = searchString.replace('latest', this.value);
                }
            } else if (searchString.includes('?')) {
                location.href = searchString + '&' + this.value + '=all';
            } else {
                location.href = searchString + '?' + this.value + '=all';
            }

        });
    </script>

    
    <script>
        $('#filterData').on('change', function() {
            var data = $('#filterData').serialize();
            var search = '<?php echo e(request()->search ? request()->search : ''); ?>';
            var department = '<?php echo e(request()->department ? request()->department : ''); ?>';
            var industry = '<?php echo e(request()->industry? request()->industry: ''); ?>'

            $.ajax({
                url: "<?php echo e(route('jobFilter')); ?>",
                method: 'POST',
                data: {
                    '_token': "<?php echo e(csrf_token()); ?>",
                    'data': data,
                    'search': search,
                    'department': department,
                    'industry' : industry,
                },
                beforeSend: function() {
                    $('#data').find('div').remove();
                    $('#data').html('<i class="fas fa-spinner fa-spin"></i>&nbsp;<span>Loading</span>');
                },
                success: function(res) {
                    console.log(res.html);
                    $('#data').html(res.html);
                },
                error: function(xhr) {
                    if (xhr.status == 419) {
                        location.reload(true);
                    }
                    toastr.error('Something went wrong');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/jobs.blade.php ENDPATH**/ ?>