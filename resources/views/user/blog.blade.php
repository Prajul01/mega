@extends('user.layout.master')
@section('title')
    {{ 'Blogs' }}
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
@push('style')
    <style>
        .blog-flex-section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .date-blog {
            background-color: orange;
            text-align: center;
            padding: 10px;
            border-radius: 8px;
            height: 105px;
            width: 80px;
            color: #fff;
        }

        .date-num {
            font-size: 28px;
            font-weight: 700;
        }

        .date-detail {
            line-height: 1.2;
        }

        .blog-detail-section {
            width: calc(100% - 100px);
            padding-right: 10px;
            text-align: justify;
        }

        .blog-detail-section p {
            font-size: 15px;
        }

        span.tag{
            padding: 3px 5px;
            background:#2776b6;
            color: white;
            display: inline-block;
            margin-right: 5px;
            border-radius: 4px;
            font-size: 13px;
            margin-bottom:  5px;
        }
        span.view{
            display: inline-block;
            margin-right: 18px;
        }
        span.metas{
            display: block;
        }

        @media only screen and (max-width: 700px) {
            .date-blog {
                padding: 8px 5px;
                height: 80px;
            }

            .blog-flex-section {
                /* flex-direction: column; */
            }

            .blog-detail-section {
                /* width: 100%; */
                gap: 5px;
            }

            .date-num {
                font-size: 24px;
                font-weight: 700;
            }

            .blog-detail-section .fs-22 {
                font-size: 18px !important;
            }
        }
    </style>
@endpush
@section('content')
    <?php
    function getimage($blog)
    {
        $data = '<div class="col-lg-5 mb-4"><div class="card blog-grid-box"><img src="' . asset('storage/blog/' . $blog->image) . '" alt="' . $blog->title . '"class="img-fluid"></div></div>';
        return $data;
    }
    
    function getContent($blog)
    {
        $data = '';
        if($blog->tags != null){
        foreach (json_decode($blog->tags) as $tag) {
            $data .= '<span class="tag"><i class="fa-solid fa-bookmark"></i> ' . $tag . '</span>';
        }}
        return '
                <div class="col-lg-7">
                    <div class="blog-flex-section">
                        <div class="date-blog">
                            <div class="date-num">
                                ' .
            date('d', strtotime($blog->created_at)) .
            '
                            </div>
                            <div class="date-detail">
                                ' .
            date('M', strtotime($blog->created_at)) .
            '
                                <span class="mobile-inline">' .
            date('Y', strtotime($blog->created_at)) .
            '</span>
                            </div>
                        </div>
                        <div class="blog-detail-section">
                            <ul class="list-inline d-flex justify-content-between mb-1">
                                <li class="list-inline-item">
                                    <p class="text-muted mb-0"><a href="#"
                                            class="text-muted fw-medium">' .
            $blog->author .
            '</a>&nbsp;
                                    </p>
                                </li>
                            </ul>
                            <a href="' .
            route('blog_single', ['slug' => $blog->slug]) .
            '" class="primary-link">
                                <h6 class="fs-22">Smartest Applications for Business</h6>
                            </a>
                            <p>
                                ' .
            $blog->title .
            '
                            </p>
                            <div>
                                <a href="' .
            route('blog_single', ['slug' => $blog->slug]) .
            '" class="form-text">Read More
                                    <i class="uil uil-angle-right-b"></i></a>
                            </div>
                            <span class="metas">
                                <span class="view">
                                    <i class="fa-solid fa-eye"></i>&nbsp;' .
            $blog->view_count .
            '</span>' . $data.
            '
                            </span>
                        </div>
                    </div>
                </div>
                ';
    }
    ?>
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
                                <h1 class="display-5 mb-3"> Our Blogs </h1>
                                <p class="fs-17">Mega Job is the perfect platform if you are looking for jobs and
                                    also looking for candidates.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end container-->
            </section>
            <!-- End Home -->

            <section class="home-jobs-wrapper bg-light">
                <div class="container-fluid custom-container">
                    <div class="row">
                        @if (count($blogs) !== 0) 
                        <div class="col-lg-9 col-md-8">
                            @foreach($blogs as $key => $blog)
                                <div class="row mb-3">
                                    @if ($key % 2 == 0)
                                        {!! getImage($blog) . getContent($blog) !!}
                                    @else
                                        {!! getContent($blog) . getImage($blog) !!}
                                    @endif
                                </div><!--end row-->
                           <hr>
                            <br>
                            @endforeach
                            
                          {{--  <div class="row mb-3">
                                <div class="col-lg-7 order-2 order-md-2 order-lg-1">
                                    <div class="blog-flex-section">
                                        <div class="date-blog">
                                            <div class="date-num">
                                                11
                                            </div>
                                            <div class="date-detail">
                                                Jun
                                                <span class="mobile-inline">2023</span>
                                            </div>
                                        </div>
                                        <div class="blog-detail-section">
                                            <ul class="list-inline d-flex justify-content-between mb-1">
                                                <li class="list-inline-item">
                                                    <p class="text-muted mb-0"><a href="blog-author.html"
                                                            class="text-muted fw-medium">Alice Mellor</a>&nbsp;



                                                    </p>
                                                </li>
                                            </ul>
                                            <a href="blog-single.html" class="primary-link">
                                                <h6 class="fs-22">Smartest Applications for Business</h6>
                                            </a>
                                            <p>
                                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe
                                                suscipit sit nostrum illo aut eligendi? Et hic laudantium
                                                voluptas suscipit? Facere, nisi veniam vitae earum porro dolorum
                                                numquam voluptates in ab rerum, sed deleniti neque vero eos
                                            </p>
                                            <div>
                                                <a href="blog-single.html" class="form-text">Read More
                                                    <i class="uil uil-angle-right-b"></i></a>
                                            </div>
                                            <span class="metas">
                                                <span class="view">
                                                    <i class="fa-solid fa-eye"></i>&nbsp;45
                                                </span>
                                                &nbsp;&nbsp;
                                                <span class="tag">
                                                    <i class="fa-solid fa-bookmark"></i>
                                                    Digital Marketing
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 order-1 order-md-1 order-lg-2 mb-4">
                                    <div class="card blog-grid-box">
                                        <img src="assets/images/files/blog-single-2.png" alt="" class="img-fluid">

                                    </div>


                                </div>
                            </div><!--end row--> --}}
                        </div>
                        @endif
                        @include('user.layout.rigth-sidebar')

                    </div>

                </div>
        </div>
        </section>

        <!-- START APPLY MODAL -->
        <div class="modal fade" id="applyNow" tabindex="-1" aria-labelledby="applyNow" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-5">
                        <div class="text-center mb-4">
                            <h5 class="modal-title" id="staticBackdropLabel">Apply For This Job</h5>
                        </div>
                        <div class="position-absolute end-0 top-0 p-3">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="mb-3">
                            <label for="nameControlInput" class="form-label">Name</label>
                            <input type="text" class="form-control" id="nameControlInput" placeholder="Enter your name">
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
@endsection
