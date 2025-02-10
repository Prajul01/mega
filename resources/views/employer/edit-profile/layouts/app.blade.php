@extends('user.layout.master')
@section('content')
    <?php
    $employer = auth()->user()->employer;
    $complete = 0;
    if (@$employer) {
        $complete += 50;
        $basic = true;
        if (@$employer->contact_persons_information) {
            $complete += 25;
            $contact = true;
        }
    
        if (@$employer->tiktok_url) {
            $complete += 5;
        }
    
        if (@$employer->facebook_url) {
            $complete += 5;
        }
    
        if (@$employer->youtube_url) {
            $complete += 5;
        }
    
        if (@$employer->instagram_url) {
            $complete += 5;
        }
    
        if (@$employer->linkedIn_url) {
            $complete += 5;
        }
    }
    
    // dd($employer);
    
    ?>
    <section class="section dashboard-section">
        <div class="container-fluid custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="card candidate-info new-shadow-sidebar mt-0 mb-2 mt-lg-0">
                        <div class="card-body p-3">
                            <div class="meta-active-top">
                                <div class="left-side-top">
                                    <span class="icon-top"><i class="fa-solid fa-user-pen"></i></span>
                                    <span>Edit Profile</span>
                                </div>
                                <div class="right-side-top">
                                    <a href="{{ route('employers.index') }}" name="submit" id="submit"
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
                        <div class="card side-bar new-shadow-sidebar mb-2">
                            <div class="card-body p-3">
                                <div class="candidate-profile">
                                    <div class="candiadte-img">
                                        <img src="{{ $url }}" alt="" class="avatar-lg">
                                    </div>
                                    <div class="candidate-detail">
                                        <h6 class="fs-18 mb-0 candidate-name">{{ $employer->company_name }}</h6>
                                        <h6 class="mb-0 company-skill">{{ $employer->category->title }}</h6>
                                        <div class="profile-status">
                                            Profile Completeness: {{ $complete }}%
                                        </div>

                                        <div class="conti progress-bar-wrapper">
                                            <progress id="progress-bar" min="1" max="100"
                                                value="{{ $complete }}"></progress>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card side-bar new-shadow-sidebar mb-3">
                            <div class="card-body p-0">
                                <div class="complete-check profile-check mt-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{ route('employers.editProfile.index') }}"
                                                class="icon-detail-candidate {{ request()->routeIs('employers.editProfile.index') ? 'active-section' : '' }}">
                                                <div class="icon-section">
                                                    <i class="fa-regular fa-address-card"></i>
                                                </div>
                                                <div class="detail-section">
                                                    <div class="detail-info">
                                                        Basic Information
                                                        @if (@$basic)
                                                            <span class="check-good">
                                                                <i class="fa-solid fa-circle-check"></i>
                                                            </span>
                                                        @else
                                                            <span class="check-bad">
                                                                <i class="fa-solid fa-circle-exclamation"></i>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="{{ route('employers.editProfile.contact-person') }}"
                                                class="icon-detail-candidate">
                                                <div
                                                    class="icon-section {{ request()->routeIs('employers.editProfile.contact-person') ? 'active-section' : '' }}">
                                                    <i class="fa-solid fa-graduation-cap"></i>
                                                </div>
                                                <div class="detail-section">
                                                    <div class="detail-info">
                                                        Contact Person
                                                        @if (@$contact)
                                                            <span class="check-good">
                                                                <i class="fa-solid fa-circle-check"></i>
                                                            </span>
                                                        @else
                                                            <span class="check-bad">
                                                                <i class="fa-solid fa-circle-exclamation"></i>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="{{ route('employers.editProfile.social-links') }}"
                                                class="icon-detail-candidate {{ request()->routeIs('employers.editProfile.social-links') ? 'active-section' : '' }}">
                                                <div class="icon-section">
                                                    <i class="fa-solid fa-building-flag"></i>
                                                </div>
                                                <div class="detail-section">
                                                    <div class="detail-info">
                                                        Social Link
                                                        @if ($complete > 75)
                                                            <span class="check-good">
                                                                <i class="fa-solid fa-circle-check"></i>
                                                            </span>
                                                        @else
                                                            <span class="check-bad">
                                                                <i class="fa-solid fa-circle-exclamation"></i>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @yield('dashboard_content')
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        $("#editPreference").click(function() {
            $(this).addClass("d-none");
            $(".right-side-content").addClass("d-none");
            $(".right-side-form").removeClass("d-none");
        })
    </script>
@endpush