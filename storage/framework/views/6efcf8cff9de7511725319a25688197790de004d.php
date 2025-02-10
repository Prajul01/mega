 <div class="card candidate-info new-shadow-sidebar mt-4 mt-lg-0">
     <div class="card-body p-3">
         <div class="category-card-title">
             Jobs By Categories
         </div>
         <?php
             $categories = App\Models\CompanyCategory::with('jobs')
                 ->where('status', 'active')
                 ->orderBy('order_no')
                 ->get();

         ?>
         <div class="row">
             <?php $__currentLoopData = $categories->chunk(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $categoryChunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <div class="col-lg-4 <?php echo e($key != 0 ? 'mobile-none' : ''); ?>">
                     <div class="card job-Categories-box bg-light border-0">
                         <div class="card-body p-2">
                             <ul class="list-unstyled job-Categories-list mb-0">
                                 <?php $__currentLoopData = $categoryChunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <li>
                                         <a href="<?php echo e(route('jobs', ['category' => $category->slug])); ?>" target="_blank"
                                             class="primary-link"><?php echo e($category->title); ?>

                                             <span
                                                 class="badge bg-soft-info float-end"><?php echo e($category->jobs->count()); ?></span>
                                         </a>
                                     </li>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </ul>
                         </div>
                     </div>
                 </div>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>

     </div>
 </div>
<?php /**PATH /home/megajobn/public_html/resources/views/user/jobseeker/layouts/categories.blade.php ENDPATH**/ ?>