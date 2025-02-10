@extends('user.layout.master')
@section('title', $employer->company_name)
@section('content')
    <div class="page-content">
        <!-- START CANDIDATE-DETAILS -->
        <section class="section dashboard-section">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 column-top">
                        <div class="card side-bar new-shadow-sidebar">
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
                                <hr class="my-4">
                                <div class="paragraph-top">
                                    {{ Str::limit(nl2br(strip_tags($employer->company_description)), 60, '...') }}
                                    <div class="read-more">
                                        <a href="{{ route('employers.overview') }}"> Read More</a>
                                    </div>
                                </div>
                                <hr class="my-3">
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
                                                <a href="tel:{{ $employer->office_number }}">{{ $employer->office_number }}</a>
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

                    <div class="col-lg-9 col-md-8">
                        @yield('dashboard_content')
                    </div><!--end row-->
                </div><!--end container-->
        </section>
        <!-- END CANDIDATE-DETAILS -->

    </div>
    <!-- End Page-content -->
    <!-- Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Log Out</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you really want to log out !!!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-small btn-outline-danger"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-small btn-primary" onclick="logoutconfirm()">Log Out</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function logoutconfirm() {
            $('#logout').submit();
        }
    </script>
@endpush
