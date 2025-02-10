 <!--<div class="bg-overlay no-overlay row">-->
 <!--   <div class="col-lg-8 banner1">-->
 <!--       <div class="new-overlay">-->
 <!--           <div class="bg-overlay"-->
 <!--               style="background-image: url('<?php echo e(asset('frontend/assets/images/files/banner1.jpg')); ?>');">-->
 <!--           </div>-->
 <!--       </div>-->
 <!--   </div>-->

 <!--   <div class="col-lg-4 hero-video">-->
 <!--       <div class="new-overlay">-->
 <!--           <div class="image-single">-->
 <!--               <a data-fancybox="" href="assets/images/video1.mp4">-->
 <!--                   <img src="<?php echo e(asset('frontend/assets/images/video-banner.png')); ?>" class="img-fluid">-->
 <!--               </a>-->
 <!--               <a data-fancybox="" id="play-video" class="video-play-button"-->
 <!--                   href="<?php echo e(asset('frontend/assets/video/video1.mp4')); ?>">-->
 <!--                   <span></span>-->
 <!--               </a>-->
 <!--           </div>-->
 <!--       </div>-->
 <!--   </div>-->
 <div class="swiper newSwiper">
    <div class="swiper-wrapper">
        <?php
            $banners = \App\Models\Slider::where('display', 1)->orderBy('order_no')->get();
        ?>
        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="swiper-slide">
            <div class="sliderLanding-image">
                <img src="<?php echo e(asset('storage/slider/' . $banner->image)); ?>" class="img-fluid" alt="">
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
 <div class="landing-abs-content">
    <div class="text-center text-white mb-2 landing-text-content">
        <h1 class="hero-text">Find a Job. Today
        <!--<span class="orange-color fw-bold">10,000+</span>Open Jobs.-->
        </h1>
        <!--<p class="fs-18 hero-text1 mobile-none">Find jobs, create trackable resumes and enrich your-->
        <!--    applications.-->
        <!--</p>-->
    </div>
    <div class="registration-form slider-search-form">
        <form action="<?php echo e(route('jobs')); ?>" method="get">
            <div class="form-container-flex">
                <div class="filter-search-form filter-border mt-lg-0">
                    <i class="uil uil-briefcase-alt"></i>
                   <input type="search" name="search" value="<?php echo e(old('search', request()->search)); ?>" id="job-title"
                             class="form-control filter-input-box" placeholder="Job, Company name...">
                </div>
                <div class="filter-search-form filter-border mt-lg-0">
                    <i class="uil uil-clipboard-notes"></i>
                    <select class="form-select new-padding-select" data-trigger name="industry" aria-label="Default select example">
                     <?php
                         $searchCategories = App\Models\Industry::with('jobs')
                             ->where('status', 'active')
                             ->orderBy('order_no')
                             ->get();
                     ?>
                     <option value="" selected> Any Industry </option>
                     <?php $__currentLoopData = $searchCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($category->slug); ?>"
                             <?php echo e(old('industry',(isset(request()->industry)? request()->industry: '') ) == $category->slug ? 'selected' : ''); ?>> <?php echo e($category->name); ?>

                         </option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>
                </div>
                <div class="filter-search-form filter-border mt-lg-0">
                    <i class="uil uil-clipboard-notes"></i>
                    <select class="form-select new-padding-select" data-trigger name="department" aria-label="Default select example">
                     <?php
                         $searchCategories = App\Models\CompanyCategory::with('jobs')
                             ->where('status', 'active')
                             ->orderBy('order_no')
                             ->get();
                     ?>
                     <option value="" selected> Any Department </option>
                     <?php $__currentLoopData = $searchCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($category->slug); ?>"
                             <?php echo e(old('department',(isset(request()->department)? request()->department: '') == $category->slug? 'selected': '' )); ?>> <?php echo e($category->title); ?>

                         </option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>
                </div>
                <div class="search-job-button h-100">
                    <button class="btn btn-danger submit-btn w-100" type="submit"><i
                            class="uil uil-search"></i> Find Job</button>
                </div>
            </div>
        </form>
    </div><!--end container-->
</div>
<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>
<!--</div>-->

<?php /**PATH /home/megajobn/public_html/resources/views/user/layout/banner.blade.php ENDPATH**/ ?>