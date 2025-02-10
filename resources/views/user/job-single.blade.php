@extends('user.layout.master')
@section('title')
    {{ $job->title }}
@endsection
@section('seo_section')
    <meta name="description" content="{{ isset($setting) ? $setting->og_description : '' }}">
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $job->title }}">
    <meta property="og:description" content="{{ isset($setting) ? $setting->og_description : '' }}">
    <meta property="og:image"
        content="{{ isset($setting) ? asset('storage/setting/og-image/' . $setting->og_image) : '' }}">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ env('APP_URL') }}">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $job->title }}">
    <meta name="twitter:description" content="{{ isset($setting) ? $setting->og_description : '' }}">
    <meta name="twitter:image"
        content="{{ isset($setting) ? asset('storage/setting/og-image/' . $setting->og_image) : '' }}">
@endsection
@section('content')
    <?php
    /**
     * checks if the user is authenticated or not and
     * check if the user has saved this job or not
     */
    if (auth()->check()) {
        $appliedJobs = auth()->user()->applied_jobs;
        $savedJobs = auth()->user()->saved_jobs;
    
        //checks if the user has applied fo r this job or not
        if (count($appliedJobs) == 0) {
            $authFlag = 0;
        } else {
            foreach ($appliedJobs as $data) {
                if ($data->id == $job->id) {
                    $authFlag = 1;
                    break;
                } else {
                    $authFlag = 0;
                }
            }
        }
    
        //checks if the user has saved this job or not
        if (count($savedJobs) == 0) {
            $saveFlag = 0;
        } else {
            foreach ($savedJobs as $saved) {
                if ($saved->id == $job->id) {
                    $saveFlag = 1;
                    break;
                } else {
                    $saveFlag = 0;
                }
            }
        }
    } else {
        $authFlag = 0;
        $saveFlag = 0;
    }
    ?>
    <div class="page-content no-banner" style="padding-top: 0;">
        <section class="home-jobs-wrapper job-single-wrapper bg-light" style="margin-top: 0;">
            <div class="container-fluid custom-container">
                <div class="row">
                    @can('job-list', 'job-create', 'job-update', 'job-delete')
                        <div class="col-sm-12 col-md-8 col-lg-9 my-2">
                            <div class="card p-3">
                                <div class="body">
                                    @if ($job->approval != 'pending')
                                        <small>Did you change your mind?</small><br>
                                        Job Current Status:
                                        <button
                                            class="btn btn-sm btn-{{ $job->approval == 'approved' ? 'success' : 'danger' }}"
                                            disabled>{{ Str::ucfirst($job->approval) }}</button>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="exampleInputEmail1" class="form-label">Job Settings:</label>
                                        </div>
                                        <div class="col-md-8">
                                            @if ($job->approval != 'declined')
                                                <button type="button" class="btn btn-danger mx-1 job-settings" value="declined"
                                                    style="float:right;"><i class="fa fa-times"></i>&nbsp;&nbsp;Decline</button>
                                            @endif
                                            @if ($job->approval != 'approved')
                                                <button type="button" class="btn btn-success mx-2 job-settings"
                                                    value="approved" style="float:right"><i
                                                        class="fa fa-check"></i>&nbsp;&nbsp;Approve</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan
                    <div class="col-sm-12 col-md-8 col-lg-9">
                        <div class="job-single-hiring">
                            <div class="hiring-heading">
                                <div class="hiring-banner">
                                    <?php
                                    if (@$job->banner) {
                                        $banner = asset('/storage/job/' . $job->slug . '/' . $job->banner);
                                    } else {
                                        $banner = asset('frontend/assets/images/files/hiring-banner.png');
                                    }
                                    ?>
                                    <img src="{{ $banner }}" class="img-fluid" alt="{{ $job->title }}">
                                    <div class="company-aboslute-logo">
                                        <img src="{{ asset('storage/employer/logo' . $job->employer->logo) }}"
                                            alt="{{ $job->employer->company_name }}" title="" style="">
                                    </div>
                                </div>
                                <div class="profile-summary-heading company-profile-heading">
                                    <div class="user-basic-info">
                                        <div class="user-name">
                                            {{ $job->employer->company_name }}
                                        </div>
                                        <div class="company-industry">
                                            {{ $job->employer->category->title }}
                                        </div>
                                        @if (@$job->employer->settings->ownership)
                                            <div class="company-type">
                                                <strong
                                                    class="blue-light px-2">{{ $job->employer->ower_ship->title }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @if (@$job->employer->settings->summary)
                                    <div class="hiring-company-desc">
                                        {!! $job->employer->company_description !!}
                                    </div>
                                @endif

                            </div>
                            <hr>

                            <div class="hiring-body">
                                <div class="job-single-heading">
                                    <div class="job-single-title">{{ $job->title }}</div>
                                    
                                   @php
                                        $currentDateTime = \Carbon\Carbon::now();
                                        $endDate = \Carbon\Carbon::parse($job->expiry_date);
                                    
                                        if ($currentDateTime->gt($endDate)) {
                                            $timeLeft = 'Expired';
                                        } else {
                                            $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                                'parts' => 2,
                                                'short' => false,
                                                'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                            ]);
                                        }
                                    @endphp
                                    <div class="job-single-heading-desc">
                                        Apply Before: {{ $timeLeft }}
                                    </div>
                                </div>
                                <div class="job-single-basic">
                                    <div class="single-basic-wrapper">
                                        <div class="basic-job-title">
                                            Basic Information
                                        </div>
                                        <div class="basic-job-desc">
                                            <div class="basic-job-list">
                                                <div class="basic-job-left">
                                                    Job Category
                                                </div>
                                                <div class="basic-job-right">
                                                    {{ $job->categories->title }}
                                                </div>
                                            </div>
                                            <div class="basic-job-list">
                                                <div class="basic-job-left">
                                                    Job Level
                                                </div>
                                                <div class="basic-job-right">
                                                    {{ $job->job_level->title }}
                                                </div>
                                            </div>
                                            <div class="basic-job-list">
                                                <div class="basic-job-left">
                                                    No. of Vacancy/s
                                                </div>
                                                <div class="basic-job-right">
                                                    [{{ $job->no_of_opening }}]
                                                </div>
                                            </div>
                                            <div class="basic-job-list">
                                                <div class="basic-job-left">
                                                    Employment Type
                                                </div>
                                                <div class="basic-job-right">
                                                    {{ $job->employee_type->title ?? '' }}
                                                </div>
                                            </div>
                                            <div class="basic-job-list">
                                                <div class="basic-job-left">
                                                    Job Location
                                                </div>
                                                <div class="basic-job-right">
                                                    {{ $job->city->name }}, {{ $job->district->name }}
                                                </div>
                                            </div>
                                            <div class="basic-job-list">
                                                <div class="basic-job-left">
                                                    Offered Salary
                                                </div>
                                                <div class="basic-job-right">
                                                    {{ $job->salary_range ?? 'Negotiable' }}
                                                </div>
                                            </div>
                                            <div class="basic-job-list">
                                                <div class="basic-job-left">
                                                    Apply Before (Deadline)
                                                </div>
                                                <div class="basic-job-right">
                                                    {{ date('M d, Y', strtotime($job->expiry_date)) }}
                                                    ({{ $timeLeft }} from now)
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     @if($job->job_description != null)

                                    <div class="single-basic-wrapper">
                                        <div class="basic-job-title">
                                            Job Description
                                        </div>
                                        <div class="job-basic-specification">
                                            {!! $job->job_description !!}
                                        </div>

                                    </div>
                                    @endif
                                    <div class="single-basic-wrapper">
                                        <div class="basic-job-title">
                                            Job Specification
                                        </div>
                                        <div class="basic-job-desc">
                                            <div class="basic-job-list">
                                                <div class="basic-job-left">
                                                    Education Level
                                                </div>
                                                <div class="basic-job-right">
                                                    {{ @$job->education->title }}
                                                </div>
                                            </div>
                                            <div class="basic-job-list">
                                                <div class="basic-job-left">
                                                    Experience Required
                                                </div>
                                                <div class="basic-job-right">
                                                    More than or equals to {{ @$job->experience->title }} years
                                                </div>
                                            </div>
                                            <div class="basic-job-list">
                                                <div class="basic-job-left">
                                                    Professional Skill Required
                                                </div>
                                                <div class="basic-job-right">
                                                    <div class="skill-require-wrapper">
                                                        @foreach ($job->skill as $skill)
                                                            <div class="require-wrapper">
                                                                {{ $skill->title }}
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if($job->job_specification != null)
                                    <div class="single-basic-wrapper">
                                        <div class="basic-job-title">
                                            Other Specifications
                                        </div>
                                        <div class="job-basic-specification">
                                            {!! $job->job_specification !!}
                                        </div>

                                    </div>
                                    @endif
                                   
                                    
                                    @if($job->newspaper_image != null)

                                     <div class="single-basic-wrapper">
                                        <div class="basic-job-image">
                                            <img src="{{ asset('storage/job/' . $job->slug . '/newspaper_image/' . $job->newspaper_image) }}"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div> 
                                    @endif
                                    <div class="job-single-footer">
                                       @php
    use Carbon\Carbon;

    $applyFlag = 0;
    $applyCheck = false;
    $authFlag = false; // Assuming $authFlag is a variable in your code context
    $saveFlag = false; // Assuming $saveFlag is a variable in your code context
    $currentDateTime = Carbon::now();
    $endDate = Carbon::parse($job->expiry_date);
    $isExpired = $currentDateTime->gt($endDate);

    if (auth()->check()) {
        if (auth()->user()->admin) {
            $applyFlag = 1;
        }
        if (auth()->user()->job_seeker != null) {
            $applyCheck = true;
        }
    }
@endphp

@if (!$applyFlag && !$isExpired)
    <div class="single-footer-button">
        <div class="apply-button">
            @if (!$authFlag)
                @if($applyCheck)
                    <button name="submit" type="submit" id="submit" class="btn btn-primary btn-hover apply-job-btn">
                        <span class="apply">Apply Now</span>
                    </button>
                    <button type="button" class="btn btn-primary btn-hover applied d-none" disabled>
                        <i class="fa fa-check"></i>&nbsp;Applied
                    </button>
                @else
                    <a href="{{ auth()->user() != null ? route('user.basic_info', auth()->user()->username) : '#' }}" class="btn btn-primary btn-hover apply-job-btn">
                        <span>Apply Now</span>
                    </a>
                @endif
            @elseif($authFlag == 1)
                <button type="button" class="btn btn-primary btn-hover" disabled>
                    <i class="fa fa-check"></i>&nbsp;Applied
                </button>
            @else
                <button name="submit" type="submit" id="submit" class="btn btn-primary btn-hover apply-job-btn">
                    <span class="apply">Apply Now</span>
                </button>
            @endif
        </div>
        @if (!$saveFlag)
            <div class="save-button">
                <button class="btn btn-outline-danger position-relative">
                    <i class="fa-regular fa-star"></i>&nbsp;&nbsp;<span>Save Job</span>
                </button>
            </div>
        @else
            <div class="save-button">
                <button class="btn btn-outline-danger position-relative">
                    <i class="fa-regular fa-star"></i>&nbsp;&nbsp;<span>Saved Job</span>
                </button>
            </div>
        @endif
    </div>
@else
    <p>Application period has ended or you do not have the necessary permissions to apply.</p>
@endif


                                        <div class="social-share">
                                            <!-- ShareThis BEGIN -->
                                            <div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
                                            <ul class="job-social">
                                                <li class="facebook"><a
                                                        href="https://www.facebook.com/sharer/sharer.php?u={{ url()->full() }}"
                                                        class="" target="_blank">
                                                        <i class="fa-brands fa-facebook-f"></i>
                                                    </a></li>
                                                <li class="twitter"><a
                                                        href="https://twitter.com/intent/tweet?text={{ $job->title }}&url={{ url()->full() }}"
                                                        class="" target="_blank">
                                                        <i class="fa-brands fa-twitter"></i>
                                                    </a></li>
                                                <li class="linkedin"><a
                                                        href="http://www.linkedin.com/shareArticle?mini=true&url={{ url()->full() }}"
                                                        class="" target="_blank">
                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                    </a></li>
                                                {{-- <li class="reddit"><a
                                                        href="https://www.reddit.com/submit?url={{ url()->full() }}"
                                                        class="" target="_blank">
                                                        <i class="fa-brands fa-reddit-alien"></i>
                                                    </a></li> --}}
                                            </ul>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-3">
                        <div class="same-job-box">
                            <div class="sidebox-wrap">
                                <div class="sidebox-title">
                                    <p>More Jobs By this Company</p>
                                </div>
                                <div class="categories-list">
                                    <ul class="same-company-job">
                                        @foreach ($company_jobs as $data)
                                            <li>
                                                <a href="{{ route('job_single', $data->slug) }}" class="flex-link">
                                                    <img src="{{ asset('storage/employer/logo' . $data->employer->logo) }}"
                                                        class="img-fluid" width="50px"
                                                        alt=" {{ $data->employer->company_name }}">
                                                    <div class="job-detail">
                                                        <span class="job-title">{{ $data->title }}</span>
                                                        <span class="job-company">
                                                            {{ $data->employer->company_name }}
                                                        </span>
                                                        <span class="job-deadline">
                                                            @php
                                                                $currentDateTime = \Carbon\Carbon::now();
                                                                $endDate = \Carbon\Carbon::parse($data->expiry_date);
                                                                $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                                                    'parts' => 2,
                                                                    'short' => false,
                                                                    'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                                                ]);
                                                            @endphp

                                                            Deadline: {{ $timeLeft }}
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach


                                        <div class="clearfix"></div>

                                    </ul>
                                </div>
                            </div>
                            <div class="a-break mb-2">
                                <img src="{{ asset('frontend/assets/images/files/RBB_bank_AD_990x338.gif') }}"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="sidebox-wrap">
                                <div class="sidebox-title">
                                    <p>Similar Jobs</p>
                                </div>
                                <div class="categories-list">
                                    <ul class="same-company-job">
                                        @foreach ($similer_jobs as $data)
                                            <li>
                                                <a href="{{ route('job_single', $data->slug) }}" class="flex-link">
                                                    <img src="{{ asset('storage/employer/logo' . $data->employer->logo) }}"
                                                        class="img-fluid" width="50px"
                                                        alt=" {{ $data->employer->company_name }}">
                                                    <div class="job-detail">
                                                        <span class="job-title">{{ $data->title }}</span>
                                                        <span class="job-company">
                                                            {{ $data->employer->company_name }}
                                                        </span>
                                                        <span class="job-deadline">
                                                            @php
                                                                $currentDateTime = \Carbon\Carbon::now();
                                                                $endDate = \Carbon\Carbon::parse($data->expiry_date);
                                                                $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                                                    'parts' => 2,
                                                                    'short' => false,
                                                                    'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                                                ]);
                                                            @endphp

                                                            Deadline: {{ $timeLeft }}
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                        <div class="clearfix"></div>

                                    </ul>
                                </div>
                            </div>
                            <div class="a-break mb-2">
                                <img src="{{ asset('frontend/assets/images/files/machapuchree-bank_k8S0FE3TWD.gif') }}"
                                    alt="image" class="img-fluid">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="cover-letter" tabindex="-1" aria-labelledby="cover-letterLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('applyJob', $job->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cover-letterLabel">Apply For {{ $job->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input class="form-control" name="cover_letter" type="file" accept=".pdf,.doc" />
                        <span class="text-danger">*</span><small>Upload cover letter to apply for {{ $job->title }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            style="margin-right:10px;">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @can('job-list', 'job-create', 'job-update', 'job-delete')
        <div class="modal fade" id="declined_message" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Declined Message</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label>Declined Message</label><br>
                        <small>*Please mention the reason for disapproval</small>
                        <textarea name="declined_message" class="form-control trumbowyg"
                            placeholder="Please mention the reason for disapproval" style="height:250px"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary mx-2" onclick="disapprove()"><i
                                class="fa fa-times"></i> Decline</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('script')
    {{-- <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=644101d1c1f1cd00199ca71e&product=sop'
        async='async'></script> --}}
    @if ($saveFlag)
        <script>
            $(document).ready(function() {
                $('.save-button button').prop('disabled', true);
                $('.save-button button').html('<i class="fa fa-check"></i>&nbsp;<span>Saved</span>');
            });
        </script>
    @endif
   
    <script>
        $(".apply-job-btn").click(function() {
            flag = '{{ isset(auth()->user()->id) ? true : false }}';
            
            if (flag == true) {
                
                
                if ('{{ $job->cover_letter }}' == 1) {
                    $('#cover-letter').modal('show');
                } else {
                    apply();
                }
            } else {
                $('#loginModal').modal('show');
            }
        });

        function apply() {
            flag = '{{ isset(auth()->user()->id) ?true : false }}';
            if (flag == true) {
                
                $(".apply").html('<i class="fas fa-spinner fa-spin"></i>');
               
                $.ajax({
                    type: 'POST',
                    url: '{{ route('applyJob', $job->slug) }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: "{{ auth()->check() ? 'USRR-' . base64_encode(auth()->user()->id) : '' }}"
                    },
                    success: function(res) {

                        status = res.status;
                        message = res.message;

                        if (status == 200) {
                            $(".apply").html("Applied");
                            $('.apply-job-btn').attr('disabled', true);
                            toastr.success(message);
                        } else if (status == 404) {
                            $(".apply").html('Apply Now');
                            toastr.error(message);
                        } else if (status == 409) {
                            $(".apply").html('Apply Now');
                            toastr.error(message);
                        } else if (status == 403) {
                            $(".apply").html('Apply Now');
                            toastr.warning(message);
                            setTimeout(function () {
                                   window.location.href = res.route;
                            }, 1000);
                        }
                    },
                    error: function(res) {
                         $(".apply").html('Apply Now');
                       toastr.warning(JSON.parse(res.responseText).message);
                    }
                })
            } else {
                $('#loginModal').modal('show');
            }
        }

        {{-- $(".apply-job-btn").click(function() {
            flag = '{{ isset(auth()->user()->id) ? 'true' : 'false' }}';
            if (flag === 'true') {
                $(".apply").html('<i class="fas fa-spinner fa-spin"></i>');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('applyJob') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        job_id: '{{ base64_encode($job->id) }}',
                        user_id: "{{ auth()->check() ? 'USRR-' . base64_encode(auth()->user()->id) : '' }}"
                    },
                    success: function(res) {

                        status = res.status;
                        message = res.message;

                        if (status == 200) {
                            $(".apply").toggleClass("d-none");
                            $(".applied").toggleClass("d-none");
                            $('.apply-button').toggleClass("d-none");
                            $(".withdraw-button").removeClass("d-none");
                            toastr.success(message);
                        } else if (status == 404) {
                            $(".apply").html('Apply Now');
                            toastr.error(message);
                        } else if (status == 409) {
                            $(".apply").html('Apply Now');
                            toastr.error(message);
                        } else if (status == 403) {
                            $(".apply").html('Apply Now');
                             toastr.warning(message);
                            setTimeout(function () {
                                   window.location.href = res.route;
                            }, 1000);
                        }
                    },
                    error: function(res) {
                        alert(res.responseText);
                    }
                })
            } else {
                $('#loginModal').modal('show');
            }


        })
        $(".withdraw-job-btn").click(function() {
            $('.withdraw-button button').html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                method: 'POST',
                url: "{{ route('withdrawJob') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    job_id: "{{ base64_encode($job->id) }}",
                    user_id: "{{ auth()->check() ? 'USRR-' . base64_encode(auth()->user()->id) : '' }}",
                },
                success: function(res) {
                    status = res.status;
                    message = res.message;

                    if (status == 200) {
                        $(".apply").toggleClass("d-none");
                        $('.apply').html('<span class="apply">Apply Now </span>');
                        $(".applied").toggleClass("d-none");
                        $('.apply-button').removeClass('d-none');
                        $(".withdraw-button").addClass("d-none");
                        toastr.success(message);
                    }

                    if (status == 404) {
                        toastr.error(message);
                    }
                },
                error: function(data) {
                    alert(data.responseText);
                }

            })
        }); --}}

        $('.save-button button').click(function() {

            flag = '{{ isset(auth()->user()->id) ? 'true' : 'false' }}';
            if (flag === 'true') {
                $('.save-button button ').html('<i class="fas fa-spinner fa-spin"></i>&nbsp;<span>Saving</span>');

                $.ajax({
                    method: 'POST',
                    url: "{{ route('saveJob') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        job_id: '{{ base64_encode($job->id) }}',
                        user_id: "{{ auth()->check() ? 'USRR-' . base64_encode(auth()->user()->id) : '' }}",
                    },
                    success: function(res) {
                        status = res.status;
                        message = res.message;

                        if (status == 200) {
                            $('.save-button button').prop('disabled', true);
                            $('.save-button button').html(
                                '<i class="fa fa-check"></i>&nbsp;<span>Saved</span>');
                            toastr.success(message);
                        }

                        if (status == 409) {
                            $('.save-button button').html(
                                '<i class="fa-regular fa-star"></i>&nbsp;&nbsp;<span>Save Job</span>'
                            );
                            toastr.error(message);
                        }

                        if (status == 404) {
                            $('.save-button button').html(
                                '<i class="fa-regular fa-star"></i>&nbsp;&nbsp;<span>Save Job</span>'
                            );
                            toastr.error(message);
                        }

                        if (status == 403) {
                            $('.save-button button').html(
                                '<i class="fa-regular fa-star"></i>&nbsp;&nbsp;<span>Save Job</span>'
                            );
                            toastr.warning(message);
                            setTimeout(function () {
                                   window.location.href = res.route;
                            }, 1000);
                        }
                    },
                    error: function(res) {
                        $('.save-button button').html(
                            '<i class="fa-regular fa-star"></i>&nbsp;&nbsp;<span>Save Job</span>');
                        alert(res.responseText);
                    }
                });
            } else {
                $('#loginModal').modal('show');
            }

        });
    </script>


    @can('job-list', 'job-create', 'job-update', 'job-delete')
        <script>
            $(".job-settings").on('click', function() {
                var value = this.value;
                swal({
                    title: "Are you sure?",
                    text: "You will be logging out",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#dc3545",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function(isConfirm) {
                    if (isConfirm) {
                        if (value == 'declined') {
                            $('#declined_message').modal('show');
                        } else if (value == 'approved') {
                            postStatus(value);
                        }
                    }
                });

            });

            function disapprove() {
                approval = 'declined';
                message = $("textarea[name='declined_message']").val();
                postStatus(approval, message);
            }

            function swalFunction(value, message = null) {

            }

            function postStatus(value, message = null) {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('admin.jobRequest.changeStatus', $job->slug) }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'approval': value,
                        'message': message,
                    },
                    success: function(res) {
                        toastr.success(res)
                        sleep(1000);
                        location.reload(true);
                    },
                    error: function(xhr) {
                        if (xhr.status == 404 || xhr.status == 422) {
                            toastr.error(xhr.responseText);
                        }
                    }
                })
            }

            function sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            }
        </script>
    @endcan
@endsection
