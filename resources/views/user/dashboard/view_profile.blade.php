@extends('user.layout.master')
@section('title', 'Profile | Job Seeker')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <!-- START CANDIDATE-DETAILS -->
            <section class="section dashboard-section">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">

                            @include('user.jobseeker.layouts.sidebar')


                        </div><!--end col-->

                        <div class="col-lg-9 col-md-8">
                            <div class="card side-bar shadow-sidebar mb-3">
                                <div class="card-body p-3">
                                    <div class="edit-profile-btn">
                                        <div class="text-left">
                                            <a href="{{ route('user.profile', auth()->user()->username) }}" id="add-more"
                                                name="submit" class="btn btn-outline-danger">
                                                Edit Profile <span class="icon p-2"><i class="fa-solid fa-edit"></i></span>
                                            </a>
                                        </div>
                                        <div class="text-right">
                                            <a href="{{ route('user.download', auth()->user()->username) }}" name="submit"
                                                class="btn btn-primary download-pdf">
                                                Download CV <span class="icon p-2"><i
                                                        class="fa-solid fa-file-pdf"></i></span> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card side-bar shadow-sidebar mb-3">
                                <div class="card-body p-3">
                                    @include('user.dashboard.cv')
                                </div>
                            </div>

                        </div><!--end row-->
                    </div><!--end container-->
            </section>
            <!-- END CANDIDATE-DETAILS -->

        </div>
        <!-- End Page-content -->



    </div>


@endsection
