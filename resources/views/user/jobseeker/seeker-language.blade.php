@extends('user.layout.master')

@section('title', 'Languages | Job Seeker')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <!-- START CANDIDATE-DETAILS -->
            <section class="section dashboard-section">
                <div class="container-fluid custom-container">
                    <div class="row">

                        @include('user.jobseeker.layouts.profile_sidebar')


                        <div class="col-lg-9 col-md-8">
                            <div class="card candidate-info new-shadow-sidebar mt-0 mb-3 mt-lg-0">
                                <div class="card-body p-3">
                                    <div class="right-side-top-bar">
                                        <div class="right-top-title">
                                            <span class="icon-top">
                                                <i class="fa-solid fa-language"></i>
                                            </span>
                                            Language
                                        </div>
                                    </div>

                                    <div class="right-side-form">
                                        <div class="detail-form-content">
                                            @php
                                                $lang = [];
                                                if (isset($check_additional_info->language)) {
                                                    $language = json_decode($check_additional_info->language);

                                                    foreach ($language as $l) {
                                                        array_push($lang, $l);
                                                    }
                                                }

                                            @endphp
                                            <form
                                                action="{{ isset($check_additional_info) ? route('user.update_language', auth()->user()->username) : route('user.store_language', auth()->user()->username) }}"
                                                class="mt-3" method="post">
                                                @csrf
                                                @if (isset($check_additional_info))
                                                    @method('put')
                                                @endif
                                                <div class="experience-info-body">
                                                    <div class="education-info">
                                                        {{-- <div class="education-heading">
                                                        <div class="education-info-title"></div>
                                                        <div class="btn delete-btn">
                                                            Delete
                                                        </div>
                                                    </div> --}}

                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="nameInput"
                                                                        class="form-label">Language</label>
                                                                    <select id=""
                                                                        class="form-control field-industry" required
                                                                        name="language[]" multiple>
                                                                        @foreach ($languages as $language)
                                                                            <option value="{{ $language->id }}"
                                                                                @if (in_array($language->id, $lang)) selected @endif>
                                                                                {{ $language->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('language.*')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div><!--end col-->
                                                            {{-- <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Reading</label>
                                                                    <div class="my-rating-4" data-rating="5"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Writing</label>
                                                                    <div class="my-rating-4" data-rating="5"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Listening</label>
                                                                    <div class="my-rating-4" data-rating="5"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Speaking</label>
                                                                    <div class="my-rating-4" data-rating="5"></div>
                                                                </div>
                                                            </div> --}}
                                                        </div>

                                                        <hr>
                                                    </div>
                                                </div>

                                                <div class="education-footer-btn">
                                                    {{-- <div class="text-left">
                                                    <button id="add-experience" name="submit"
                                                        class="btn btn-outline-danger">
                                                        Add More <span class="icon"><i
                                                                class="fa-solid fa-plus"></i></span> </button>
                                                </div> --}}
                                                    <div class="text-right">
                                                        <button type="submit" id="submit" name="submit"
                                                            class="btn btn-primary">
                                                            Save Language </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </div>
        <!-- End Page-content -->



    </div>
    <!-- End Page-content -->

    <!--start back-to-top-->
    <button onclick="topFunction()" id="back-to-top">
        <i class="mdi mdi-arrow-up"></i>
    </button>
    <!--end back-to-top-->


@endsection
@section('style')
    <link href="{{ asset('frontend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/star-rating-svg.css') }}">

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('frontend/assets/js/jquery.star-rating-svg.js') }}"></script>

    <script>
        $(".field-study, .field-industry").select2({
            tags: true
        });


        $(".detail-form-content").on("click", ".delete-btn", function() {
            $(this).closest(".education-info").remove();
        });

        $("#add-experience").click(function() {
            $(".experience-info-body").append(
                ' <div class="education-info"><div class="education-heading"><div class="education-info-title"></div><div class="btn delete-btn">Delete</div></div><form action="" class="mt-3"><div class="row"><div class="col-lg-12"><div class="mb-3"><label="nameInput" class="form-label">Language</label><select name="" id="" class="form-control"><option value="" selected>--Select--</option><option value="">English</option><option value="">Nepali</option><option value="">Indian</option><option value="">Chinese</option></select></div></div><!--end col--><div class="col-lg-3"><div class="mb-3"><label class="form-label">Reading</label><div class="my-rating-4" data-rating="5"></div></div></div><div class="col-lg-3"><div class="mb-3"><label class="form-label">Writing</label><div class="my-rating-4" data-rating="5"></div></div></div><div class="col-lg-3"><div class="mb-3"><label class="form-label">Listening</label><div class="my-rating-4" data-rating="5"></div></div></div><div class="col-lg-3"><div class="mb-3"><label class="form-label">Speaking</label><div class="my-rating-4" data-rating="5"></div></div></div></div></form><hr></div>'
            );
            $(".my-rating-4").starRating({
                totalStars: 5,
                starShape: 'rounded',
                starSize: 25,
                emptyColor: 'transparent',
                hoverColor: '#ECD59F',
                activeColor: '#FFD700',
                disableAfterRate: false,
                readOnly: false,
                useGradient: false
            });
        });

        $(document).ready(function() {
            $(".my-rating-4").starRating({
                totalStars: 5,
                starShape: 'rounded',
                starSize: 25,
                emptyColor: 'transparent',
                hoverColor: '#ECD59F',
                activeColor: '#FFD700',
                disableAfterRate: false,
                readOnly: false,
                useGradient: false
            });
        });

        $(".profile-icon").on("click", function() {
            $(".mobile-profile-check").toggleClass("profile-check-toggle");
        });
    </script>
@endsection
