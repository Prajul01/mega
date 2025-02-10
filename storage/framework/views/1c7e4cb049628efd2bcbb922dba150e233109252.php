<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/dropify/css/dropify.min.css')); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php $__env->stopPush(); ?>
<form method="POST" action="<?php echo e(route('admin.employer.store')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="body">
        <div class="row">
            <div class="col-md-9 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Company Name</span>
                    </div>
                    <input type="text" class="form-control" name="company_name" placeholder="Company Name" aria-label=""
                        aria-describedby="basic-addon1" value="<?php echo e(old('company_name')); ?>" required>
                </div>
                <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="status" value="active"
                                checked></span>
                    </div>
                    <input type="text" class="form-control" value="Display Status" disabled>
                </div>
                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
          
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Phone Number</span>
                    </div>
                    <input type="text" class="form-control" name="phone_number" placeholder="Phone Number" aria-label=""
                        aria-describedby="basic-addon1" value="<?php echo e(old('phone_number')); ?>">
                </div>
                <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Office Number</span>
                    </div>
                    <input type="text" class="form-control" name="office_number" placeholder="Office Number" aria-label=""
                        aria-describedby="basic-addon1" value="<?php echo e(old('office_number')); ?>">
                </div>
                <?php $__errorArgs = ['office_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Company Logo</span>
                    </div> 
                    <input type="file" name="company_logo" class="dropify" data-default-file="<?php echo e(old('company_logo')); ?>">
                </div>
                <?php $__errorArgs = ['company_logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="alert alert-warning mt-1">
                    Best Image Size 1200 X 600 PX.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Image</span>
                    </div>
                    <input type="file" name="image" class="dropify" data-default-file="<?php echo e(old('image')); ?>">
                </div>
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="alert alert-warning mt-1">
                    Best Image Size 1200 X 600 PX.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Email</span>
                    </div>
                    <input type="text" class="form-control" name="email" placeholder="Email" aria-label=""
                        aria-describedby="basic-addon1" value="<?php echo e(old('email')); ?>">
                </div>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Address</span>
                    </div>
                    <input type="text" class="form-control" name="address" placeholder="Address" aria-label=""
                        aria-describedby="basic-addon1" value="<?php echo e(old('address')); ?>">
                </div>
                <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Expiery Date</span>
                    </div>
                    <input type="date" class="form-control" name="expiry_date" placeholder="Expiry Date" id="date" aria-label=""
                        aria-describedby="basic-addon1" value="<?php echo e(old('expiry_date')); ?>">
                </div>
                <?php $__errorArgs = ['expiry_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><input type="checkbox" name="is_verify" value="1"
                                checked></span>
                    </div>
                    <input type="text" class="form-control" value="Is Company Verified!" disabled>
                </div>
                <?php $__errorArgs = ['is_verify'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Company Owner Ships</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="company_owner_ship">
                        <option selected disabled value="">Select Company Owner Ships</option>
                        <?php $__currentLoopData = $company_owner_ships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company_owner_ship): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($company_owner_ship->id); ?>" <?php echo e(old('company_owner_ship')==$company_owner_ship->id?'selected':''); ?>><?php echo e($company_owner_ship->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                </div>
                <?php $__errorArgs = ['company_owner_ship'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Company Size</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="company_size">
                        <option selected disabled value="">Select Company Size</option>
                        <?php $__currentLoopData = $company_sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company_size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($company_size->id); ?>" <?php echo e(old('company_size')==$company_size->id?'selected':''); ?>><?php echo e($company_size->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                </div>
                <?php $__errorArgs = ['company_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select User</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="user">
                        <option selected disabled value="">Select User</option>
                        
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>" <?php echo e(old('user')==$user->id?'selected':''); ?>><?php echo e($user->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                </div>
                <?php $__errorArgs = ['user'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Company Category</span>
                    </div>
                    <select class="form-select form-control" aria-label="Default select example" name="company_category">
                        <option selected disabled value="">Select Company Category</option>
                        <?php $__currentLoopData = $company_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($company_category->id); ?>" <?php echo e(old('company_category')==$company_category->id?'selected':''); ?>><?php echo e($company_category->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                </div>
                <?php $__errorArgs = ['company_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Company Website Url</span>
                    </div>
                    <textarea class="form-control" name="company_website" placeholder="Company Website Url" aria-label=""
                        aria-describedby="basic-addon1"><?php echo e(old('company_website')); ?></textarea>
                </div>
                <?php $__errorArgs = ['company_website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Company Description</span>
                    </div>
                    <textarea class="form-control" id="ckeditor" name="company_description" placeholder="Company description" rows="6" aria-label=""
                        aria-describedby="basic-addon1"><?php echo e(old("company_description")); ?></textarea>
                </div>
                <?php $__errorArgs = ['company_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Additional Information</span>
                    </div>
                    <textarea class="form-control" id="ckeditor1" name="additional_info" placeholder="Additional Information" rows="6" aria-label=""
                        aria-describedby="basic-addon1"><?php echo e(old("additional_info")); ?></textarea>
                </div>
                <?php $__errorArgs = ['additional_info'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-header">
                    <h2>Address</h2>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Country</span>
                    </div>
                    <select class="form-select form-control country" aria-label="Default select example" name="country">
                        <option selected disabled value="">Select Country</option>
                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($country->id); ?>" <?php echo e(old('country')==$country->id?'selected':''); ?>><?php echo e($country->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                </div>
                <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select Province</span>
                    </div>
                    <select class="form-select form-control province-list" id="province" aria-label="Default select example" name="province">
                        
                      </select>
                </div>
                <?php $__errorArgs = ['province'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select District</span>
                    </div>
                    <select class="form-select form-control district-list" aria-label="Default select example" name="district" id="district">
                       
                        
                      </select>
                </div>
                <?php $__errorArgs = ['province'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Select City</span>
                    </div>
                    <select class="form-select form-control city-list" aria-label="Default select example" name="city">
                        
                      </select>
                </div>
                <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
           
         
           
           
          
            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-header">
                    <h2>Contact Personal Information</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <div class="row mb-2 border p-2 mx-2">
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Name</span>
                            </div>
                            <input type="text" class="form-control" name="personal_name[]" placeholder="Personal Name" required/>
                        </div>
                        <?php $__errorArgs = ['personal_name.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Email</span>
                            </div>
                            <input type="text" class="form-control" name="personal_email[]" placeholder="Personal Email" required/>
                        </div>
                        <?php $__errorArgs = ['personal_email.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Designation</span>
                            </div>
                            <input type="text" class="form-control" name="personal_designation[]" placeholder="Personal Designation" required/>
                        </div>
                        <?php $__errorArgs = ['personal_designation.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Phone Number</span>
                            </div>
                            <input type="text" class="form-control" name="personal_phone[]" placeholder="Personal Phone" required/>
                        </div>
                        <?php $__errorArgs = ['personal_phone.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="additional_personal_info">

                </div>
                <div class="col-12">
                    <button type="button" class="btn btn-primary add-personal-info">Add More <i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h2>Social link</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <?php
                    $socialLinks = ['tiktok', 'linkedIn', 'youtube', 'instagram', 'facebook']
                ?>
                <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $inputName = $social . '_url';
                ?>
                <div class="row mb-2">
                    <div class="col-md-3">
                        <input class="form-control" value="<?php echo e(ucfirst($social)); ?> URL" disabled />
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Link</span>
                            </div>
                            <input type="text" class="form-control" name="<?php echo e($inputName); ?>" placeholder="<?php echo e(ucfirst($social)); ?> URL" required/>
                        </div>
                        <?php $__errorArgs = [$inputName];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
        </div>
    </div>
   
    <div class="card-footer">
        <a href="<?php echo e(route('admin.employer.index')); ?>" class="btn btn-danger">Cancel</a>
        <button style="float: right" type="submit" class="btn btn-success">Save</button>
    </div>
</form>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('backend/assets/vendor/dropify/js/dropify.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/html/assets/js/pages/forms/dropify.js')); ?>"></script>
    <script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
    <script src="<?php echo e(asset('backend/assets/vendor/select2/dist/js/select2.js')); ?>"></script>
    <script>
        $(document).on('click', '#remove', function() {
            $(this).closest(".varient").remove();
        });
    </script>
      <script>
        $(".add-personal-info").click(function() {
            $(".additional_personal_info").append(
              `  <div class="row mb-2 personal border p-2 mx-2">
                <div class="col-md-12 float-right my-2"><span id="remove_personal" class="remove btn btn-outline-danger"><i class="fa fa-trash"></i></span> </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Name</span>
                            </div>
                            <input type="text" class="form-control" name="personal_name[]" required/>
                        </div>
                        <?php $__errorArgs = ['personal_name.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Email</span>
                            </div>
                            <input type="text" class="form-control" name="personal_email[]" required/>
                        </div>
                        <?php $__errorArgs = ['personal_email.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Designation</span>
                            </div>
                            <input type="text" class="form-control" name="personal_designation[]" required/>
                        </div>
                        <?php $__errorArgs = ['personal_designation.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Phone Number</span>
                            </div>
                            <input type="text" class="form-control" name="personal_phone[]" required/>
                        </div>
                        <?php $__errorArgs = ['personal_phone.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>`
            )
        });
        $(document).on('click', '#remove_personal', function() {
            $(this).closest(".personal").remove();
        });
    </script>
    <script>
        var editor_config = {
            toolbar: [{
                    name: 'document',
                    groups: ['mode', 'document', 'doctools']
                   
                },
                {
                    name: 'clipboard',
                    groups: ['clipboard', 'undo'],
                    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                },
                {
                    name: 'editing',
                    groups: ['find', 'selection', 'spellchecker'],
                    items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                },
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup'],
                    items: ['Bold', 'Italic', 'Underline', '-',
                        'RemoveFormat'
                    ]
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', '-', 'JustifyLeft',
                        'JustifyCenter', 'JustifyRight', 'JustifyBlock',
                    ]
                },
                {
                    name: 'links',
                    items: ['Link']
                },
                '/',
                {
                    name: 'styles',
                    items: ['Styles', 'Format', 'Font', 'FontSize']
                },
                {
                    name: 'colors',
                    items: ['TextColor']
                },
            ],
            width: ['100%']
        };
        CKEDITOR.replace('ckeditor', editor_config);
        CKEDITOR.replace('ckeditor1', editor_config);
    </script>
    <script>
        $(document).ready(function() {
            $('.multiple-cat').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".country").on('blur', function() {
                var _country_id = $(this).val();
                $.ajax({
                    url: "<?php echo e(url('admin/employer-management/provincelist')); ?>/" + _country_id,
                    dataType: 'json',
                    beforeSend: function() {
                        $(".province-list").html(
                            '<option selected diaslable>--- Select Province ---</option>');
                    },
                    success: function(data) {
                        var _html = '';
                        $.each(data.response, function(index, row) {
                            _html += '<option value="' + row.id + '">' + row.name +
                                '</option>';
                        });
                        $(".province-list").html(_html);
                    }
                });

            });
        });
        </script>
         <script>
            $(document).ready(function() {
                $("#province").on('blur', function() {
                    var _district_id = $(this).val();
                    $.ajax({
                        url: "<?php echo e(url('admin/employer-management/districtlist')); ?>/" + _district_id,
                        dataType: 'json',
                        beforeSend: function() {
                            $(".district-list").html(
                                '<option selected diaslable>--- Select District ---</option>');
                        },
                        success: function(data) {
                            var _html = '';
                            $.each(data.response, function(index, row) {
                                _html += '<option value="' + row.id + '">' + row.name +
                                    '</option>';
                            });
                            $(".district-list").html(_html);
                        }
                    });
    
                });
            });
            </script>
             <script>
                $(document).ready(function() {
                    $("#district").on('blur', function() {
                        var _city_id = $(this).val();
                        $.ajax({
                            url: "<?php echo e(url('admin/employer-management/citylist')); ?>/" + _city_id,
                            dataType: 'json',
                            beforeSend: function() {
                                $(".city-list").html(
                                    '<option selected diaslable>--- Select City ---</option>');
                            },
                            success: function(data) {
                                var _html = '';
                                $.each(data.response, function(index, row) {
                                    _html += '<option value="' + row.id + '">' + row.name +
                                        '</option>';
                                });
                                $(".city-list").html(_html);
                            }
                        });
        
                    });
                });
                </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/megajobn/public_html/resources/views/admin/employer/components/add.blade.php ENDPATH**/ ?>