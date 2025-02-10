<?php $__env->startSection('title'); ?>
    <?php echo e($blog->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('seo_section'); ?>
    <meta name="description" content="<?php echo e(isset($setting) ? $setting->og_description : ''); ?>">
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo e($blog->title); ?>">
    <meta property="og:description" content="<?php echo Str::limit($blog->description, 50); ?>">
    <meta property="og:image" content="<?php echo e(asset('storage/blog/' . $blog->image)); ?>">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:url" content="<?php echo e(url()->current()); ?>">
    <meta name="twitter:title" content="<?php echo e($blog->title); ?>">
    <meta name="twitter:description" content="<?php echo Str::limit($blog->description, 50); ?>">
    <meta name="twitter:image" content="<?php echo e(asset('storage/blog/' . $blog->image)); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
    <style>
        span.tag{
            padding: 3px 5px;
            background:#2776b6;
            color: white;
            display: inline-block;
            margin-right: 5px;
            border-radius: 4px;
            font-size: 13px;
            margin-bottom:  5px;
        }
        span.view{
            display: inline-block;
            margin-right: 18px;
        }
        span.metas{
            display: block;
            margin-bottom: 15px;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <div class="page-content">
            <!-- START HOME -->
            <section class="bg-home inner-page" id="home">
                <div class="bg-overlay"
                    style="background-image: url(<?php echo e(asset('frontend/assets/images/files/banner1.jpg')); ?>);"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center text-white mb-5">
                                <h1 class="display-5 mb-3"> Our Blogs / <?php echo e($blog->title); ?> </h1>
                                <p class="fs-17">Mega Job Nepal is the perfect platform if you are looking for jobs and
                                    also looking for candidates.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end container-->
            </section>
            <section class="home-jobs-wrapper bg-light">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <div class="col-lg-9 col-md-8">
                            <div class="row">
                                <div class="blog-post">
                                    <div class="blog-single-image">
                                        <img src="<?php echo e(asset('storage/blog/' . $blog->image)); ?>" class="img-fluid"
                                            alt="<?php echo e($blog->title); ?>">
                                    </div>
                                    <div class="blog-post-info">
                                        <ul class="list-inline mb-0 mt-2 text-muted">
                                            <li class="list-inline-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="my-2">
                                                        <a href="blog-author.html" class="primary-link">
                                                            <?php if(isset($blog->author)): ?>
                                                                <h6 class="mb-0">By <?php echo e($blog->author); ?></h6>
                                                            <?php endif; ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-inline-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="uil uil-calendar-alt"></i>
                                                    </div>
                                                    <div class="ms-2">
                                                        <p class="mb-0"> <?php echo e($blog->created_at->toFormattedDateString()); ?>

                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="mt-0">
                                            <h5 class="blog-single-title"><?php echo e($blog->title); ?></h5>
                                            <span class="metas">
                                                <span class="view">
                                                    <i class="fa-solid fa-eye"></i>&nbsp;<?php echo e($blog->view_count); ?>

                                                </span>
                                                &nbsp;&nbsp;
                                                        <?php if($blog->tags != null): ?>

                                                <?php $__empty_1 = true; $__currentLoopData = json_decode($blog->tags); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>  
                                                <span class="tag">
                                                    <i class="fa-solid fa-bookmark"></i>
                                                    <?php echo e($tag); ?>

                                                </span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                            </span>
                                            <p class="text-muted">
                                                <?php echo $blog->description; ?>

                                            </p>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end row-->
                        </div>

                        <div class="col-lg-3 col-md-4">
                            <div class="side-box">
                                <?php if(count($related_blogs) !== 0): ?>
                                    <div class="sidebox-wrap">
                                        <div class="sidebox-title">
                                            <p>Related Blogs</p>
                                        </div>
                                        <div class="categories-list">
                                            <ul class="same-company-job">
                                                <?php $__currentLoopData = $related_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related_blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <a href="<?php echo e(route('blog_single', ['slug' => $related_blog->slug])); ?>"
                                                            class="flex-link">
                                                            <img src="<?php echo e(asset('storage/blog/thumb_' . $related_blog->image)); ?>"
                                                                class="img-fluid" alt="">
                                                            <div class="job-detail">
                                                                <span class="job-title"><?php echo e($related_blog->title); ?></span>
                                                                <?php if(isset($related_blog->company_name)): ?>
                                                                    <span class="job-company">
                                                                        <?php echo e($related_blog->company_name); ?>

                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                                <div class="clearfix"></div>

                                            </ul>
                                        </div>
                                    </div>
                                <?php endif; ?>
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
                                                                    class="fa fa-chevron-right"></i><?php echo e($career->title); ?></a>
                                                        </p>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
        </div>
        </section>


        <div class="blog-share-fixed pos-fixed">
            <div class="blog-share-title">
                Mega Official Blog <span class="blog-main-title">- <?php echo e($blog->title); ?></span>
            </div>
            <div class="blog-share-sections social-share">
                <div class="sharethis-inline-share-buttons"></div>

            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megajobn/public_html/resources/views/user/blog-single.blade.php ENDPATH**/ ?>