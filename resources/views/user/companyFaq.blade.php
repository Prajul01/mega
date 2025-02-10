@extends('user.layout.master')
@section('title')
    {{ 'Faq' }}
@endsection
@section('seo_section')
    <meta name="description" content="{{ isset($setting) ? $setting->og_description : '' }}">
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ isset($setting) ? $setting->og_title : '' }}">
    <meta property="og:description" content="{{ isset($setting) ? $setting->og_description : '' }}">
    <meta property="og:image"
        content="{{ isset($setting) ? asset('storage/setting/og-image/' . $setting->og_image) : '' }}">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ env('APP_URL') }}">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ isset($setting) ? $setting->og_title : '' }}">
    <meta name="twitter:description" content="{{ isset($setting) ? $setting->og_description : '' }}">
    <meta name="twitter:image"
        content="{{ isset($setting) ? asset('storage/setting/og-image/' . $setting->og_image) : '' }}">
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <!-- START HOME -->
            <section class="bg-home inner-page" id="home">
                <div class="bg-overlay"
                    style="background-image: url('{{ asset('frontend/assets/images/files/banner1.jpg') }}');"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center text-white mb-5">
                                <h1 class="display-5 mb-3">FAQ</h1>
                                <p class="fs-17">Mega Job is the perfect platform if you are looking for jobs and
                                    also looking for candidates.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!-- End Home -->
            <!-- START FAQ-PAGE -->
            <section class="section">
                <div class="container-fluid custom-container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-md-8 offset-lg-1 card new-shadow-sidebar">
                            @forelse ($faqs as $key => $faq)
                                <div class="col-lg-12">
                                    <div class="accordion accordion-flush faq-box" id="general">
                                        <div class="accordion-item border-0">
                                            <h2 class="accordion-header px-0" id="generalOne">
                                                <button
                                                    class="accordion-button @if ($key > 0) collapsed @endif"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#general-{{ $key }}" aria-expanded="true"
                                                    aria-controls="general-one">
                                                    {{ $faq->question }}
                                                </button>
                                            </h2>
                                            <div id="general-{{ $key }}"
                                                class="accordion-collapse collapse @if ($key == 0) show @endif"
                                                aria-labelledby="generalOne" data-bs-parent="#general">
                                                <div class="accordion-body">
                                                    {{ $faq->answer }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-lg-12">
                                    <div class="accordion accordion-flush faq-box" id="general">
                                        <div class="accordion-item border-0 p-3">
                                            <h3>No FAQs to show</h3>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>
            <!-- END FAQ-PAGE -->
            <!-- START APPLY MODAL -->
            <div class="modal fade" id="applyNow" tabindex="-1" aria-labelledby="applyNow" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body p-5">
                            <div class="text-center mb-4">
                                <h5 class="modal-title" id="staticBackdropLabel">Apply For This Job</h5>
                            </div>
                            <div class="position-absolute end-0 top-0 p-3">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="mb-3">
                                <label for="nameControlInput" class="form-label">Name</label>
                                <input type="text" class="form-control" id="nameControlInput"
                                    placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label for="emailControlInput2" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="emailControlInput2"
                                    placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label for="messageControlTextarea" class="form-label">Message</label>
                                <textarea class="form-control" id="messageControlTextarea" rows="4" placeholder="Enter your message"></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="inputGroupFile01">Resume Upload</label>
                                <input type="file" class="form-control" id="inputGroupFile01">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Send Application</button>
                        </div>
                    </div>
                </div>
            </div><!-- END APPLY MODAL -->

        </div>
        <!-- End Page-content -->
    </div>
@endsection
