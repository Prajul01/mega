   @php
       $job_seeker_personal_info = App\Models\JobSeekerPersonalInformation::where('user_id', auth()->user()->id)->first() ?? null;
       $check_additional_info = App\Models\JobSeekerAdditionalField::where('user_id', auth()->user()->id)->first() ?? null;
       $educationInfoCheck = App\Models\JobSeekerEducation::where('user_id', auth()->user()->id)->exists();
       $trainingInfoCheck = App\Models\JobSeekerTraining::where('user_id', auth()->user()->id)->exists();
       $experienceInfoCheck = App\Models\JobSeekerExperience::where('user_id', auth()->user()->id)->exists();
       $additional_socialCheck = App\Models\JobSeekerSocialNetwork::where('user_id', auth()->user()->id)->exists();
       $additional_referenceCheck = App\Models\JobSeekerReference::where('user_id', auth()->user()->id)->exists();
       
       $totalCompleteProfile = 0;
       if ($job_seeker_personal_info != null) {
           $totalCompleteProfile += 20;
       }
       
       if ($job_seeker_personal_info->mobile_number != null) {
           $totalCompleteProfile += 10;
       }
       
       if ($job_seeker_personal_info->profile_pic != null) {
           $totalCompleteProfile += 5;
       }
       
       if (@$check_additional_info->skill != null) {
           $totalCompleteProfile += 5;
       }
       
       if ($job_seeker_personal_info->preferedJobs->first() != null) {
           $totalCompleteProfile += 15;
       }
       
       if ($job_seeker_personal_info->career_objective !== null) {
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
   <div class="sticky-sidebar">
       <div class="card side-bar new-shadow-sidebar mb-3">
           <div class="card-body p-3">
               <div class="candidate-profile">
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

                       <h6 class="fs-18 mb-0 candidate-name">{{ $user_profile->first_name }}
                           {{ $user_profile->middle_name }} {{ $user_profile->last_name }}</h6>
                       <div class="profile-status">
                           Profile Completeness: {{ $totalCompleteProfile }}%
                       </div>

                       <div class="conti progress-bar-wrapper">
                           <progress id="progress-bar" min="1" max="100"
                               value="{{ $totalCompleteProfile }}"></progress>
                       </div>
                   </div>
               </div>

               <div class="candidate-detail-sidebar">
                   @if ($user_profile->current_city != null)
                       <div class="icon-detail-candidate">
                           <div class="icon-section">
                               <i class="fa-solid fa-house-chimney"></i>
                           </div>
                           <div class="detail-section">
                               <div class="detail-title">
                                   Current Address
                               </div>
                               <div class="detail-info">
                                   {{ \App\Models\City::find($user_profile->current_city)->name }},
                                   {{ \App\Models\District::find($user_profile->current_district)->name }}
                               </div>
                           </div>
                       </div>
                   @endif
                   @if ($user_profile->date_of_birth != null)
                       <div class="icon-detail-candidate">
                           <div class="icon-section">
                               <i class="fa-solid fa-calendar-days"></i>
                           </div>
                           <div class="detail-section">
                               <div class="detail-title">
                                   DOB
                               </div>
                               <div class="detail-info">
                                   {{ $user_profile->date_of_birth }}
                               </div>
                           </div>
                       </div>
                   @endif
                   @if ($user_profile->expected_salary != null)
                       <div class="icon-detail-candidate">
                           <div class="icon-section">
                               <i class="fa-solid fa-money-bill"></i>
                           </div>
                           <div class="detail-section">
                               <div class="detail-title">
                                   Expected Salary
                               </div>
                               <div class="detail-info">
                                   NRs. {{ $user_profile->expected_salary }}
                               </div>
                           </div>
                       </div>
                   @endif
                   <?php
                   $preferedJobs = $user_profile->preferedJobs->pluck('title')->toArray();
                   if (isset($preferedJobs)) {
                       $preferedJobsList = implode(', ', $preferedJobs);
                   }
                   ?>
                   @if (isset($preferedJobs))
                       <div class="icon-detail-candidate">
                           <div class="icon-section">
                               <i class="fa-regular fa-id-card"></i>
                           </div>
                           <div class="detail-section">
                               <div class="detail-title">
                                   Prefered Job Category
                               </div>

                               <div class="detail-info">
                                   {{ isset($preferedJobs) ? $preferedJobsList : '' }}
                               </div>
                           </div>
                       </div>
                   @endif
                   @if ($user_profile->current_city != null)
                       <div class="icon-detail-candidate">
                           <div class="icon-section">
                               <i class="fa-solid fa-business-time"></i>
                           </div>
                           <div class="detail-section">
                               <div class="detail-title">
                                   Prefered Job Location
                               </div>
                               <div class="detail-info">
                                   {{ \App\Models\City::find($user_profile->current_city)->name }}
                               </div>
                           </div>
                       </div>
                   @endif
                   @if ($totalCompleteProfile > 45)
                       <div class="icon-detail-candidate">
                           <div class="icon-section">
                               <i class="fa-solid fa-file-pdf"></i>
                           </div>
                           <div class="detail-section">
                               <a href="{{ route('user.download', auth()->user()->username) }}">
                                   Convert my profile into resume in <strong>PDF</strong>
                                   format
                               </a>
                           </div>
                       </div>
                       <div class="icon-detail-candidate">
                           <div class="icon-section">
                               <i class="fa-regular fa-eye"></i>
                           </div>
                           <div class="detail-section">
                               <a href="{{ route('user.view_profile', auth()->user()->username) }}">
                                   View my profile as an employer <strong>PDF</strong>
                                   format
                               </a>
                           </div>

                       </div>
                   @endif

               </div>



           </div>
       </div>

   </div>
