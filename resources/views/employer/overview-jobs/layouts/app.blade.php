@extends('user.layout.master')
@section('content')
    <?php
    $employer = auth()->user()->employer;
    if (isset(auth()->user()->employer->logo)) {
        $url = asset('storage/employer/logo' . auth()->user()->employer->logo);
    } else {
        $url = asset('frontend/assets/images/files/company-logo.png');
    }
    
    if (@$employer->city->name == @$employer->district->name) {
        $address = @$employer->city->name;
    } else {
        $address = @$employer->city->name . ', ' . @$employer->district->name;
    }
    
    $email = $employer->emails->where('is_primary', 1)->first()->email;
    
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
    
    ?>
    <section class="padding-for-header">
        <div class="container-fluid custom-container">
            <section class="top-section">
                <div class="row left-top-row">
                    <div class="col-lg-3 col-md-4">
                        <div class="sticky-sidebar recuiter-sticky">
                            <div class="card side-bar new-shadow-sidebar mb-2">
                                <div class="card-body p-3">
                                    <div class="edit-icon-recuiter">
                                        <a href="{{ route('employers.editProfile.index') }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </div>
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
                            <div class="card new-shadow-sidebar statistics-nav mt-0 mb-3 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="candidate-detail-sidebar new-margin-sidebar">
                                        <div class="icon-detail-candidate">
                                            <div class="icon-section">
                                                <i class="fa-solid fa-building"></i>
                                            </div>
                                            <div class="detail-section">
                                                <div class="detail-title">
                                                    Location
                                                </div>
                                                <div class="detail-info">
                                                    {{ $address }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="icon-detail-candidate">
                                            <div class="icon-section">
                                                <i class="fa-solid fa-envelope"></i>
                                            </div>
                                            <div class="detail-section">
                                                <div class="detail-title">
                                                    Email Address
                                                </div>
                                                <div class="detail-info">
                                                    <a href="mailto:{{ $email }}">{{ $email }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="icon-detail-candidate">
                                            <div class="icon-section">
                                                <i class="fa-solid fa-phone"></i>
                                            </div>
                                            <div class="detail-section">
                                                <div class="detail-title">
                                                    Contact Number
                                                </div>
                                                <div class="detail-info">
                                                    <a
                                                        href="tel:{{ $employer->office_number }}">{{ $employer->office_number }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="icon-detail-candidate">
                                            <div class="icon-section">
                                                <i class="fa-solid fa-earth-europe"></i>
                                            </div>
                                            <div class="detail-section">
                                                <div class="detail-title">
                                                    Company Type
                                                </div>
                                                <div class="detail-info">
                                                    {{ @$employer->ower_ship->title }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="icon-detail-candidate">
                                            <div class="icon-section">
                                                <i class="fa-solid fa-users-gear"></i>
                                            </div>
                                            <div class="detail-section">
                                                <div class="detail-title">
                                                    Employee Number
                                                </div>
                                                <div class="detail-info">
                                                    {{ @$employer->company_size->title }} Employees
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="recuiter-social-site">
                                        <div class="recuiter-social-title">
                                            <span>Social Media</span>
                                        </div>
                                        <div class="social-site-flex icon-margin">
                                            @if (@$employer->website)
                                                <i class="fa-solid fa-globe"></i>
                                            @endif
                                            @if (@$employer->facebook_url)
                                                <i class="fa-brands fa-facebook"></i>
                                            @endif
                                            @if (@$employer->linkedIn_url)
                                                <i class="fa-brands fa-linkedin"></i>
                                            @endif
                                            @if (@$employer->instagram_url)
                                                <i class="fa-brands fa-instagram"></i>
                                            @endif
                                            @if (@$employer->yoututbe_url)
                                                <i class="fa-brands fa-youtube"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 left-side-background">
                        @yield('dashboard_content')
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection
