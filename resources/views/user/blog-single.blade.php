@extends('user.layout.master')
@section('title')
    {{ $blog->title }}
@endsection
@section('seo_section')
    <meta name="description" content="{{ isset($setting) ? $setting->og_description : '' }}">
    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $blog->title }}">
    <meta property="og:description" content="{!! Str::limit($blog->description, 50) !!}">
    <meta property="og:image" content="{{ asset('storage/blog/' . $blog->image) }}">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ env('APP_URL') }}">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $blog->title }}">
    <meta name="twitter:description" content="{!! Str::limit($blog->description, 50) !!}">
    <meta name="twitter:image" content="{{ asset('storage/blog/' . $blog->image) }}">
@endsection
@push('style')
    <style>
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
            margin-bottom: 15px;
        }
    </style>
@endpush
@section('content')
    <div class="main-content">
        <div class="page-content">
            <!-- START HOME -->
            <section class="bg-home inner-page" id="home">
                <div class="bg-overlay"
                    style="background-image: url({{ asset('frontend/assets/images/files/banner1.jpg') }});"></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center text-white mb-5">
                                <h1 class="display-5 mb-3"> Our Blogs / {{ $blog->title }} </h1>
                                <p class="fs-17">Mega Job Nepal is the perfect platform if you are looking for jobs and
                                    also looking for candidates.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end container-->
            </section>
            <section class="home-jobs-wrapper bg-light">
                <div class="container-fluid custom-container">
                    <div class="row">
                        <div class="col-lg-9 col-md-8">
                            <div class="row">
                                <div class="blog-post">
                                    <div class="blog-single-image">
                                        <img src="{{ asset('storage/blog/' . $blog->image) }}" class="img-fluid"
                                            alt="{{ $blog->title }}">
                                    </div>
                                    <div class="blog-post-info">
                                        <ul class="list-inline mb-0 mt-2 text-muted">
                                            <li class="list-inline-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="my-2">
                                                        <a href="blog-author.html" class="primary-link">
                                                            @if (isset($blog->author))
                                                                <h6 class="mb-0">By {{ $blog->author }}</h6>
                                                            @endif
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-inline-item">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <i class="uil uil-calendar-alt"></i>
                                                    </div>
                                                    <div class="ms-2">
                                                        <p class="mb-0"> {{ $blog->created_at->toFormattedDateString() }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="mt-0">
                                            <h5 class="blog-single-title">{{ $blog->title }}</h5>
                                            <span class="metas">
                                                <span class="view">
                                                    <i class="fa-solid fa-eye"></i>&nbsp;{{ $blog->view_count }}
                                                </span>
                                                &nbsp;&nbsp;
                                                        @if($blog->tags != null)

                                                @forelse(json_decode($blog->tags) as $tag)  
                                                <span class="tag">
                                                    <i class="fa-solid fa-bookmark"></i>
                                                    {{ $tag }}
                                                </span>
                                                @empty
                                                @endforelse
                                                @endif
                                            </span>
                                            <p class="text-muted">
                                                {!! $blog->description !!}
                                            </p>
                                            {{--  <div class="social-share">

                                                <div class="share-title">
                                                    Share This Blog :
                                                </div>

                                                <ul class="job-social">
                                                    <li class="facebook"><a href="" class="">
                                                            <i class="fa-brands fa-facebook-f"></i>
                                                        </a></li>
                                                    <li class="insta"><a href="" class="">
                                                            <i class="fa-brands fa-instagram"></i>
                                                        </a></li>
                                                    <li class="twitter"><a href="" class="">
                                                            <i class="fa-brands fa-twitter"></i>
                                                        </a></li>
                                                    <li class="linkedin"><a href="" class="">
                                                            <i class="fa-brands fa-linkedin-in"></i>
                                                        </a></li>
                                                </ul>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end row-->
                        </div>

                        <div class="col-lg-3 col-md-4">
                            <div class="side-box">
                                @if (count($related_blogs) !== 0)
                                    <div class="sidebox-wrap">
                                        <div class="sidebox-title">
                                            <p>Related Blogs</p>
                                        </div>
                                        <div class="categories-list">
                                            <ul class="same-company-job">
                                                @foreach ($related_blogs as $related_blog)
                                                    <li>
                                                        <a href="{{ route('blog_single', ['slug' => $related_blog->slug]) }}"
                                                            class="flex-link">
                                                            <img src="{{ asset('storage/blog/thumb_' . $related_blog->image) }}"
                                                                class="img-fluid" alt="">
                                                            <div class="job-detail">
                                                                <span class="job-title">{{ $related_blog->title }}</span>
                                                                @if (isset($related_blog->company_name))
                                                                    <span class="job-company">
                                                                        {{ $related_blog->company_name }}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach



                                                <div class="clearfix"></div>

                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                <div class="a-break mb-2">
                                    <img src="{{ asset('frontend/assets/images/files/machapuchree-bank_k8S0FE3TWD.gif') }}"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="sidebox-wrap">
                                    <div class="sidebox-title">
                                        <p>Career Tips</p>
                                    </div>
                                    @if (count($careers) > 0)
                                        <div class="sidebox-content">
                                            <ul>
                                                @foreach ($careers as $career)
                                                    <li>
                                                        <p>
                                                            <a
                                                                href="{{ route('career-details', ['career' => $career->slug]) }}"><i
                                                                    class="fa fa-chevron-right"></i>{{ $career->title }}</a>
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
        </div>
        </section>


        <div class="blog-share-fixed pos-fixed">
            <div class="blog-share-title">
                Mega Official Blog <span class="blog-main-title">- {{ $blog->title }}</span>
            </div>
            <div class="blog-share-sections social-share">
                <div class="sharethis-inline-share-buttons"></div>

            </div>

        </div>

    </div>
@endsection
