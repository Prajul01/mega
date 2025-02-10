 @php
     $job_seeker_personal_info = App\Models\JobSeekerPersonalInformation::where('user_id', auth()->user()->id)->first() ?? null;
     $check_additional_info = App\Models\JobSeekerAdditionalField::where('user_id', auth()->user()->id)->first() ?? null;
     $educationInfoCheck = App\Models\JobSeekerEducation::where('user_id', auth()->user()->id)->exists();
     $trainingInfoCheck = App\Models\JobSeekerTraining::where('user_id', auth()->user()->id)->exists();
     $experienceInfoCheck = App\Models\JobSeekerExperience::where('user_id', auth()->user()->id)->exists();
     $additional_socialCheck = App\Models\JobSeekerSocialNetwork::where('user_id', auth()->user()->id)->exists();
     $additional_referenceCheck = App\Models\JobSeekerReference::where('user_id', auth()->user()->id)->exists();
     $preferanceCheck = $job_seeker_personal_info != null && @$check_additional_info->skill != null && @$job_seeker_personal_info->preferedJobs->first() != null ? 1 : 0;
     $basicInfoCheck = $job_seeker_personal_info != null && $job_seeker_personal_info->mobile_number !== null && $job_seeker_personal_info->profile_pic !== null ? 1 : 0;
     $educationCheck = $educationInfoCheck == true ? 1 : 0;
     $trainingCheck = $trainingInfoCheck == true ? 1 : 0;
     $experienceCheck = $experienceInfoCheck == true ? 1 : 0;
     $languageCheck = @$check_additional_info->language != null ? 1 : 0;
     $socialCheck = $additional_socialCheck == true ? 1 : 0;
     $referanceCheck = $additional_referenceCheck == true ? 1 : 0;
     
     $totalCompleteProfile = 0;
     if (@$job_seeker_personal_info != null) {
         $totalCompleteProfile += 20;
     }
     
     if (@$job_seeker_personal_info->mobile_number != null) {
         $totalCompleteProfile += 10;
     }
     
     if (@$job_seeker_personal_info->profile_pic != null) {
         $totalCompleteProfile += 5;
     }
     
     if (@$check_additional_info->skill != null) {
         $totalCompleteProfile += 5;
     }
     
     if (@$job_seeker_personal_info) {
         if (@$job_seeker_personal_info->preferedJobs->first() != null) {
             $totalCompleteProfile += 15;
         }
     }
     
     if (@$job_seeker_personal_info->career_objective !== null) {
         $totalCompleteProfile += 5;
     }
     
     if ($educationInfoCheck == true) {
         $totalCompleteProfile += 10;
     }
     if ($trainingInfoCheck == true) {
         $totalCompleteProfile += 5;
     }
     if (@$check_additional_info->language != null) {
         $totalCompleteProfile += 5;
     }
     
     if ($experienceInfoCheck == true) {
         $totalCompleteProfile += 10;
     }
     if ($additional_socialCheck == true) {
         $totalCompleteProfile += 5;
     }
     
     if ($additional_referenceCheck == true) {
         $totalCompleteProfile += 5;
     }
     
 @endphp
 <div class="col-12">
     <div class="card candidate-info new-shadow-sidebar mt-0 mb-2 mt-lg-0">
         <div class="card-body p-3">
             <div class="meta-active-top">
                 <div class="left-side-top">
                     <span class="icon-top"><i class="fa-solid fa-user-pen"></i></span>
                     <span>Edit Profile</span>
                 </div>
                 <div class="right-side-top">
                     <a href="{{ route('user.dashboard', auth()->user()->username) }}" name="submit" id="submit"
                         class="btn btn-outline-danger"><span class="icon-top">
                             <i class="fa-regular fa-id-card"></i>
                         </span> Preview Profile </a>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="col-lg-3 col-md-4">
     <div class="sticky-sidebar">
         <div class="card side-bar new-shadow-sidebar mb-3">
             <div class="card-body p-3">
                 <div class="candidate-profile mb-3">
                     <div class="candiadte-img">
                         <?php
                         if (!is_null(auth()->user()->job_seeker)) {
                             $profile_pic = auth()->user()->job_seeker->profile_pic;
                             if (!is_null($profile_pic)) {
                                 $url = asset('/storage/job-seeker/' . $profile_pic);
                             } else {
                                 $url = asset('frontend/assets/images/files/spy.png');
                             }
                         } else {
                             $url = asset('frontend/assets/images/files/spy.png');
                         }
                         ?>
                         <img src="{{ $url }}" alt="" class="avatar-lg rounded-circle">
                     </div>
                     <div class="candidate-detail">
                         @php
                             $user_profile = App\Models\JobSeekerPersonalInformation::where('user_id', auth()->user()->id)->first();
                             
                         @endphp

                         <h6 class="fs-18 mb-0 candidate-name">{{ @$user_profile->first_name }}
                             {{ @$user_profile->middle_name }} {{ @$user_profile->last_name }}</h6>
                         <div class="profile-status">
                             Profile Completeness: {{ $totalCompleteProfile }}%
                         </div>

                         <div class="conti progress-bar-wrapper">
                             <progress id="progress-bar" min="1" max="100"
                                 value="{{ $totalCompleteProfile }}"></progress>
                         </div>
                     </div>
                 </div>
                 <div class="format-small-title">
                     Complete Your Profile
                 </div>
                 <div class="format-title mobile-flex-title">
                     <span class="profile-icon">
                         <span class="mobile-none">Fill</span>
                         <span class="mobile-only">Check</span>
                         all the required information
                         to apply job. <span class="mobile-profile-icon top-icon">
                             <i class="fa-solid fa-angle-down"></i>
                         </span>
                     </span>
                 </div>
                 <hr>
                 <div class="complete-check profile-check mobile-profile-check mt-0">
                     <div class="row">
                         <div class="col-md-12">
                             <a href="{{ route('user.profile', auth()->user()->username) }}"
                                 class="icon-detail-candidate {{ request()->routeIs('user.profile', auth()->user()->username) ? 'active-section' : '' }}">
                                 <div class="icon-section">
                                     <i class="fa-solid fa-briefcase"></i>
                                 </div>
                                 <div class="detail-section">
                                     <div class="detail-info">
                                         Job Preference
                                         <span class="check-{{ $preferanceCheck == 1 ? 'good' : 'bad' }}">
                                             <i
                                                 class="fa-solid fa-circle-{{ $preferanceCheck == 1 ? 'check' : 'exclamation' }}"></i>
                                         </span>
                                     </div>
                                 </div>
                             </a>
                         </div>
                         <div class="col-md-12">
                             <a href="{{ route('user.basic_info', auth()->user()->username) }}"
                                 class="icon-detail-candidate {{ request()->routeIs('user.basic_info', auth()->user()->username) ? 'active-section' : '' }}">
                                 <div class="icon-section">
                                     <i class="fa-regular fa-address-card"></i>
                                 </div>
                                 <div class="detail-section">
                                     <div class="detail-info">
                                         Basic Information
                                         <span class="check-{{ $basicInfoCheck == 1 ? 'good' : 'bad' }}">
                                             <i
                                                 class="fa-solid fa-circle-{{ $basicInfoCheck == 1 ? 'check' : 'exclamation' }} "></i>
                                         </span>
                                     </div>
                                 </div>
                             </a>
                         </div>
                         <div class="col-md-12">
                             <a href="{{ route('user.education', auth()->user()->username) }}"
                                 class="icon-detail-candidate  {{ request()->routeIs('user.education', auth()->user()->username) ? 'active-section' : '' }}">
                                 <div class="icon-section">
                                     <i class="fa-solid fa-graduation-cap"></i>
                                 </div>
                                 <div class="detail-section">
                                     <div class="detail-info">
                                         Education
                                         <span class="check-{{ $educationCheck == 1 ? 'good' : 'bad' }}">
                                             <i
                                                 class="fa-solid fa-circle-{{ $educationCheck == 1 ? 'check' : 'exclamation' }}"></i>
                                         </span>
                                     </div>
                                 </div>
                             </a>
                         </div>
                         <div class="col-md-12">
                             <a href="{{ route('user.training', auth()->user()->username) }}"
                                 class="icon-detail-candidate {{ request()->routeIs('user.training', auth()->user()->username) ? 'active-section' : '' }}">
                                 <div class="icon-section">
                                     <i class="fa-solid fa-person-chalkboard"></i>
                                 </div>
                                 <div class="detail-section">
                                     <div class="detail-info">
                                         Training
                                         <span class="check-{{ $trainingCheck == 1 ? 'good' : 'bad' }}">
                                             <i
                                                 class="fa-solid fa-circle-{{ $trainingCheck == 1 ? 'check' : 'exclamation' }}"></i>
                                         </span>
                                     </div>
                                 </div>
                             </a>
                         </div>
                         <div class="col-md-12">
                             <a href="{{ route('user.experience', auth()->user()->username) }}"
                                 class="icon-detail-candidate {{ request()->routeIs('user.experience', auth()->user()->username) ? 'active-section' : '' }}">
                                 <div class="icon-section">
                                     <i class="fa-solid fa-building-flag"></i>
                                 </div>
                                 <div class="detail-section">
                                     <div class="detail-info">
                                         Work Experience
                                         <span class="check-{{ $experienceCheck == 1 ? 'good' : 'bad' }}">
                                             <i
                                                 class="fa-solid fa-circle-{{ $experienceCheck == 1 ? 'check' : 'exclamation' }}"></i>
                                         </span>
                                     </div>
                                 </div>
                             </a>
                         </div>
                         <div class="col-md-12">
                             <a href="{{ route('user.language', auth()->user()->username) }}"
                                 class="icon-detail-candidate {{ request()->routeIs('user.language', auth()->user()->username) ? 'active-section' : '' }}">
                                 <div class="icon-section">
                                     <i class="fa-solid fa-language"></i>
                                 </div>
                                 <div class="detail-section">
                                     <div class="detail-info">
                                         Language
                                         <span class="check-{{ $languageCheck == 1 ? 'good' : 'bad' }}">
                                             <i
                                                 class="fa-solid fa-circle-{{ $languageCheck == 1 ? 'check' : 'exclamation' }}"></i>
                                         </span>
                                     </div>
                                 </div>
                             </a>
                         </div>
                         <div class="col-md-12">
                             <a href="{{ route('user.socialAccount', auth()->user()->username) }}"
                                 class="icon-detail-candidate {{ request()->routeIs('user.socialAccount', auth()->user()->username) ? 'active-section' : '' }}">
                                 <div class="icon-section">
                                     <i class="fa-solid fa-share-nodes"></i>
                                 </div>
                                 <div class="detail-section">
                                     <div class="detail-info">
                                         Social Account
                                         <span class="check-{{ $socialCheck == 1 ? 'good' : 'bad' }}">
                                             <i
                                                 class="fa-solid fa-circle-{{ $socialCheck == 1 ? 'check' : 'exclamation' }}"></i>
                                         </span>
                                     </div>
                                 </div>
                             </a>
                         </div>
                         <div class="col-md-12">
                             <a href="{{ route('user.reference', auth()->user()->username) }}"
                                 class="icon-detail-candidate {{ request()->routeIs('user.reference', auth()->user()->username) ? 'active-section' : '' }}">
                                 <div class="icon-section">
                                     <i class="fa-solid fa-user-group"></i>
                                 </div>
                                 <div class="detail-section">
                                     <div class="detail-info">
                                         Reference
                                         <span class="check-{{ $referanceCheck == 1 ? 'good' : 'bad' }}">
                                             <i
                                                 class="fa-solid fa-circle-{{ $referanceCheck == 1 ? 'check' : 'exclamation' }}"></i>
                                         </span>
                                     </div>
                                 </div>
                             </a>
                         </div>
                         {{-- <div class="col-md-12">
                             <a href="{{ route('user.otherInfo', auth()->user()->username) }}"
                                 class="icon-detail-candidate {{ request()->routeIs('user.otherInfo', auth()->user()->username) ? 'active-section' : '' }}">
                                 <div class="icon-section">
                                     <i class="fa-solid fa-user-group"></i>
                                 </div>
                                 <div class="detail-section">
                                     <div class="detail-info">
                                         Other Inforamtion
                                         <span class="check-good">
                                             <i class="fa-solid fa-circle-check"></i>
                                         </span>
                                     </div>
                                 </div>
                             </a>
                         </div> --}}
                     </div>
                 </div>


             </div>
         </div>
     </div>
 </div>
