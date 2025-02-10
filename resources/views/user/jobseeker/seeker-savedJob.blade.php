@extends('user.layout.master')
@section('title', 'Saved Jobs | Job Seeker')

@section('content')
    <div class="main-content">

        <div class="page-content">
            <!-- START CANDIDATE-DETAILS -->
            <section class="section dashboard-section">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="sticky-sidebar">
                                <div class="card candidate-info new-shadow-sidebar mt-4 mb-2 mt-lg-0">
                                    <div class="card-body p-3">
                                        <div class="active-search">
                                            <a href="{{ route('user.dashboard', auth()->user()->username) }}"
                                                class="">
                                                <span class="icon">
                                                    <i class="fa-solid fa-house"></i>
                                                </span> &nbsp;
                                                Home /
                                            </a>

                                            <a href="javascript:void(0)" class="color-black">
                                                 Saved Job
                                            </a>

                                        </div>
                                    </div>
                                </div>
                                @include('user.jobseeker.layouts.sidebar')
                            </div>


                        </div><!--end col-->

                        <div class="col-lg-9 col-md-8">
                             <div class="card candidate-info new-shadow-sidebar mt-4 mb-3 mt-lg-0">
                                <div class="card-body p-0">
                                    <div class="job-summary-tab mt-0">
                                        <div class="table-responsive">
                                            <table class="job-table">
                                                <tr class="table-row">
                                                    <th>Company</th>
                                                    <th>Job Position</th>
                                                    <th>Job Type</th>
                                                    <th>Job Level</th>
                                                    <th>Applied Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>

                                                @foreach ($user_saves_jobs as $job)
                                                    <tr class="table-row">
                                                        <td>
                                                            <div class="company-logo">
                                                                <img src="{{ asset('storage/employer/logo' . $job->job->employer->logo) }}"
                                                                    class="img-fluid" alt="{{ $job->job->employer->slug }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="job-detail">
                                                                <div class="job-post">
                                                                    {{ $job->job->title }}
                                                                </div>
                                                                <div class="job-by">
                                                                    {{ $job->job->company_name }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="job-type">
                                                                <span
                                                                    class="green-light">{{ $job->job->employee_type->title }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="job-level">
                                                                <span
                                                                    class="orange-light">{{ $job->job->job_level->title }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="deadline">
                                                                <?php
                                                                $currentDateTime = \Carbon\Carbon::now();
                                                                $endDate = \Carbon\Carbon::parse($job->job->expiry_date);
                                                                $timeLeft = $endDate->diffForHumans($currentDateTime, [
                                                                    'parts' => 2,
                                                                    'short' => false,
                                                                    'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                                                                ]);
                                                                ?>
                                                                {{ $timeLeft }} Left
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="job-status">
                                                                <span class="blue-light">
                                                                    Applied
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="job-detail">
                                                                <a href="{{ route('job_single', $job->job->slug) }}"
                                                                    class="btn btn-border">
                                                                    View Detail
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div><!--end card-->
                            </div><!--end col-->

                        </div><!--end row-->
                    </div><!--end container-->
            </section>
            <!-- END CANDIDATE-DETAILS -->

        </div>
        <!-- End Page-content -->




    </div>
    <!-- End Page-content -->

    <!--start back-to-top-->
    <button onclick="topFunction()" id="back-to-top">
        <i class="mdi mdi-arrow-up"></i>
    </button>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).scroll(function() {
            var y = $(this).scrollTop();
            if (y > 300) {
                $('.footer-fixed').addClass("add-sticky");
            } else {
                $('.footer-fixed').removeClass("add-sticky");
            }
        });


        $(".see-more").click(function() {
            $(this).siblings(".checkbox-list").addClass('more-view');
            $(this).siblings(".see-less").removeClass('d-none');
            $(this).addClass('d-none');
        });
        $(".see-less").click(function() {
            $(this).siblings(".checkbox-list").removeClass('more-view');
            $(this).siblings(".see-more").removeClass('d-none');
            $(this).addClass('d-none');
        });

        $(".remove-job").click(function() {
            $(this).closest('.table-row').remove();
        })

        $("#menu-dropdown").click(function() {
            $(".mobile-dropdown").toggleClass("menu-toggle");
        })
    </script>
@endsection
