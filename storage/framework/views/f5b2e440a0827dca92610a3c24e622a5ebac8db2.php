<?php $__env->startSection('title', 'Languages | Job Seeker'); ?>

<?php $__env->startSection('content'); ?>

    <div class="main-content">

        <div class="page-content">
            <!-- START CANDIDATE-DETAILS -->
            <section class="section dashboard-section">
                <div class="container-fluid custom-container">
                    <div class="row">

                        <?php echo $__env->make('user.jobseeker.layouts.profile_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                        <div class="col-lg-9 col-md-8">
                            <div class="card candidate-info new-shadow-sidebar mt-0 mb-3 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="right-side-top-bar">
                                        <div class="right-top-title">
                                            <span class="icon-top">
                                                <i class="fa-solid fa-language"></i>
                                            </span>
                                            Language
                                        </div>
                                    </div>

                                    <div class="right-side-form">
                                        <div class="detail-form-content">
                                            <?php
                                                $lang = [];
                                                if (isset($check_additional_info->language)) {
                                                    $language = json_decode($check_additional_info->language);

                                                    foreach ($language as $l) {
                                                        array_push($lang, $l);
                                                    }
                                                }

                                            ?>
                                            <form
                                                action="<?php echo e(isset($check_additional_info) ? route('user.update_language', auth()->user()->username) : route('user.store_language', auth()->user()->username)); ?>"
                                                class="mt-3" method="post">
                                                <?php echo csrf_field(); ?>
                                                <?php if(isset($check_additional_info)): ?>
                                                    <?php echo method_field('put'); ?>
                                                <?php endif; ?>
                                                <div class="experience-info-body">
                                                    <div class="education-info">
                                                        

                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="nameInput"
                                                                        class="form-label">Language</label>
                                                                    <select id=""
                                                                        class="form-control field-industry" required
                                                                        name="language[]" multiple>
                                                                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($language->id); ?>"
                                                                                <?php if(in_array($language->id, $lang)): ?> selected <?php endif; ?>>
                                                                                <?php echo e($language->title); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                    <?php $__errorArgs = ['language.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </div>
                                                            </div><!--end col-->
                                                            
                                                        </div>

                                                        <hr>
                                                    </div>
                                                </div>

                                                <div class="education-footer-btn">
                                                    
                                                    <div class="text-right">
                                                        <button type="submit" id="submit" name="submit"
                                                            class="btn btn-primary">
                                                            Save Language </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
        <!-- End Page-content -->



    </div>
    <!-- End Page-content -->

    <!--start back-to-top-->
    <button onclick="topFunction()" id="back-to-top">
        <i class="mdi mdi-arrow-up"></i>
    </button>
    <!--end back-to-top-->


<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link href="<?php echo e(asset('frontend/assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/star-rating-svg.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo e(asset('frontend/assets/js/jquery.star-rating-svg.js')); ?>"></script>

    <script>
        $(".field-study, .field-industry").select2({
            tags: true
        });


        $(".detail-form-content").on("click", ".delete-btn", function() {
            $(this).closest(".education-info").remove();
        });

        $("#add-experience").click(function() {
            $(".experience-info-body").append(
                ' <div class="education-info"><div class="education-heading"><div class="education-info-title"></div><div class="btn delete-btn">Delete</div></div><form action="" class="mt-3"><div class="row"><div class="col-lg-12"><div class="mb-3"><label="nameInput" class="form-label">Language</label><select name="" id="" class="form-control"><option value="" selected>--Select--</option><option value="">English</option><option value="">Nepali</option><option value="">Indian</option><option value="">Chinese</option></select></div></div><!--end col--><div class="col-lg-3"><div class="mb-3"><label class="form-label">Reading</label><div class="my-rating-4" data-rating="5"></div></div></div><div class="col-lg-3"><div class="mb-3"><label class="form-label">Writing</label><div class="my-rating-4" data-rating="5"></div></div></div><div class="col-lg-3"><div class="mb-3"><label class="form-label">Listening</label><div class="my-rating-4" data-rating="5"></div></div></div><div class="col-lg-3"><div class="mb-3"><label class="form-label">Speaking</label><div class="my-rating-4" data-rating="5"></div></div></div></div></form><hr></div>'
            );
            $(".my-rating-4").starRating({
                totalStars: 5,
                starShape: 'rounded',
                starSize: 25,
                emptyColor: 'transparent',
                hoverColor: '#ECD59F',
                activeColor: '#FFD700',
                disableAfterRate: false,
                readOnly: false,
                useGradient: false
            });
        });

        $(document).ready(function() {
            $(".my-rating-4").starRating({
                totalStars: 5,
                starShape: 'rounded',
                starSize: 25,
                emptyColor: 'transparent',
                hoverColor: '#ECD59F',
                activeColor: '#FFD700',
                disableAfterRate: false,
                readOnly: false,
                useGradient: false
            });
        });

        $(".profile-icon").on("click", function() {
            $(".mobile-profile-check").toggleClass("profile-check-toggle");
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/jobseeker/seeker-language.blade.php ENDPATH**/ ?>