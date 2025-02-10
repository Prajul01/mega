<?php
    $tenders = App\Models\Tender::where('status', 'active')
        ->orderBy('order_no')
        ->limit(4)
        ->get();
    $careers = App\Models\Career::where('status', 'active')
        ->orderBy('order_no')
        ->limit(4)
        ->get();
    $advertisement_video = App\Models\Advertisement::where('display', '1')
                    ->where('type', '2')
                    ->inRandomOrder()
                    ->first();
     if($advertisement_video){
       $advertisement_video->views= $advertisement_video->views+1;
       $advertisement_video->save();
    }
 $advertisement_gif_image = App\Models\Advertisement::where('display', '1')
->where('type', '3')
->inRandomOrder()
->first();
 if($advertisement_gif_image){
       $advertisement_gif_image->views= $advertisement_gif_image->views+1;
       $advertisement_gif_image->save();
    }
?>
<div class="col-sm-3 col-md-4 col-lg-3">
    <div class="side-box">
        <?php if(isset($advertisement_video)): ?>
        <div class="hero-video mb-3">
            <div class="new-overlay">
                 <?php
                 preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $advertisement_video->url, $match);
                   $video_id = $match[1];
                 ?>
                <div class="image-single">
                    <a data-fancybox="" href="<?php echo e($advertisement_video->url); ?>">
                        <img src="https://img.youtube.com/vi/<?php echo $video_id ?>/maxresdefault.jpg" class="img-fluid">
                    </a>
                    <a data-fancybox="" id="play-video" class="video-play-button"
                        href="<?php echo e($advertisement_video->url); ?>">
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="sidebox-wrap">
            <div class="sidebox-title">
                <p>News &amp; Announcement</p>
            </div>
            <div class="sidebox-content">
                <ul>
                    <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <p>
                            <a href="<?php echo e(route('newsAndAnnouncement.single', $data->slug)); ?>"><i class="fa fa-plus"></i><?php echo e($data->title); ?></a>
                        </p>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <p class="px-2 d-block text-end">
                            <a href="<?php echo e(route('newsAndAnnouncement')); ?>">
                                View All
                            </a>
                        </p>
                    </li>
                </ul>
            </div>
        </div>

        <div class="sidebox-wrap">
            <div class="sidebox-title">
                <p>Recent Tenders</p>
            </div>
            <?php if(count($tenders) > 0): ?>
                <div class="sidebox-content">
                    <ul class="recent-tender">
                        <?php $__currentLoopData = $tenders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <p>
                                    <a href="<?php echo e(route('tender_details', ['tender' => $tender->slug])); ?>"
                                        class="flex-link">
                                        <img src="<?php echo e(asset('/storage/tender/' . $tender->logo)); ?>" class="img-fluid"
                                            alt="<?php echo e(Str::limit($tender->title,50, '...')); ?>">
                                        <?php echo e(Str::limit($tender->title, 50, '...')); ?>

                                    </a>
                                </p>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <li>
                            <p class="px-2 d-block text-end">
                                <a href="<?php echo e(route('tender', ['tender' => $tender->slug])); ?>">
                                    View All Tenders
                                </a>
                            </p>
                        </li>

                        <div class="clearfix"></div>

                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <?php if(isset($advertisement_gif_image)): ?>
        <div class="a-break mb-2">
            <a href="<?php echo e($advertisement_gif_image->link??'#'); ?>">
            <img src="<?php echo e(asset('storage/advertisement/'.$advertisement_gif_image->image)); ?>" alt="<?php echo e($advertisement_gif_image->title); ?>"
                class="img-fluid">
            </a>
        </div>
        <?php endif; ?>
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
                                    <a href="<?php echo e(route('career-details', ['career' => $career->slug])); ?>" class="flex-link"><i class="fa-solid fa-star"></i>
                                            
                                        <img src="<?php echo e(asset('storage/career/' . $career->image)); ?>"
                                        class="img-thumbnail" alt="" width="50px" height="50px">
                                            
                                        <?php echo e(Str::limit($career->title, 65, '..')); ?>

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
<?php /**PATH /home/megajobn/public_html/resources/views/user/layout/rigth-sidebar.blade.php ENDPATH**/ ?>