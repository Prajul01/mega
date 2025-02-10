@extends('user.layout.master')
@section('title')
    {{ 'Jobs' }}
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
    <div class="page-content">

        <!-- START HOME -->
        <section class="bg-home" id="home">
            @include('user.layout.banner')
            <!--end container-->
        </section>
        <!-- End Home -->
        <section class="home-jobs-wrapper bg-light">
            <div class="container-fluid custom-container">
                <div class="row position-relative">
                    <div class="col-sm-3 col-lg-3 filter-responsive">

                        <div class="filter-button">
                            <span class="close-icon">
                                <i class="fa-solid fa-xmark">
                                </i>
                            </span>
                        </div>
                        <form id="filterData">
                            <div class="job-filter">
                                @if (count($industries) > 0)
                                    <div class="filter-checkbox">
                                        <h5 class="text-uppercase filter-title">
                                            Prefer Industry
                                        </h5>
                                        <div class="checkbox-list">
                                            @foreach ($industries as $industry)
                                                <div class="filter-list">
                                                    <input type="checkbox" name="industry" value="{{ $industry->id }}"
                                                        id="{{ $industry->slug }}" {{ isset(request()->industry)? (request()->industry == $industry->slug? 'checked': '') : '' }}>
                                                    <label for="{{ $industry->slug }}"> {{ $industry->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="see-more">
                                            See More <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                        <div class="see-less d-none">
                                            See Less <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                @if (count($departments) > 0)
                                    <div class="filter-checkbox">
                                        <h5 class="text-uppercase filter-title">
                                            Prefer Department
                                        </h5>
                                        <div class="checkbox-list">
                                            @foreach ($departments as $department)
                                                <div class="filter-list">
                                                    <input type="checkbox" name="department" value="{{ $department->id }}"
                                                        id="{{ $department->slug }}" {{ isset(request()->department)? (request()->department == $department->slug? 'checked': '') : '' }}>
                                                    <label for="{{ $department->slug }}"> {{ $department->title }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="see-more">
                                            See More <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                        <div class="see-less d-none">
                                            See Less <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                @if (count($locations) > 0)
                                    <div class="filter-checkbox">
                                        <h5 class="text-uppercase filter-title">
                                            Prefer Location
                                        </h5>
                                        <div class="checkbox-list">
                                            @foreach ($locations as $location)
                                                <div class="filter-list">
                                                    <input type="checkbox" name="city" value="{{ $location->id }}"
                                                        id="{{ $location->slug }}">
                                                    <label for="{{ $location->slug }}"> {{ $location->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="see-more">
                                            See More <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                        <div class="see-less d-none">
                                            See Less <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                    </div>
                                @endif

                                @if (count($educations) > 0)
                                    <div class="filter-checkbox">
                                        <h5 class="text-uppercase filter-title">
                                            Education
                                        </h5>
                                        <div class="checkbox-list">
                                            @foreach ($educations as $education)
                                                <div class="filter-list">
                                                    <input type="checkbox" name="education" value="{{ $education->id }}"
                                                        id="{{ $education->slug }}">
                                                    <label for="{{ $education->slug }}"> {{ $education->title }}</label>
                                                </div>
                                            @endforeach

                                        </div>
                                        <div class="see-more">
                                            See More <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                        <div class="see-less d-none">
                                            See Less <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                    </div>
                                @endif

                                @if (count($experiences) > 0)
                                    <div class="filter-checkbox">
                                        <h5 class="text-uppercase filter-title">
                                            Experience
                                        </h5>
                                        <div class="checkbox-list">
                                            @foreach ($experiences as $experience)
                                                <div class="filter-list">
                                                    <input type="checkbox" name="experience" value="{{ $experience->id }}"
                                                        id="{{ $experience->slug }}">
                                                    <label for="{{ $experience->slug }}"> {{ $experience->title }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="see-more">
                                            See More <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                        <div class="see-less d-none">
                                            See Less <span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </span>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6 col-md-8 col-lg-6" id="data">
                        @include('user.layout.job-content')
                    </div>
                    @include('user.layout.rigth-sidebar')
                </div>
            </div>
    </div>
    </section>



    </div>
    <!-- End Page-content -->
@endsection
@section('script')
    <script>
        $('document').ready(function() {
            $('filterData').reset();
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


        $(".close-icon").click(function() {
            $(".filter-responsive").removeClass("filter-translate");
        })
        $(".show-icon").click(function() {
            $(".filter-responsive").addClass("filter-translate");
        })
        $('.filter').click(function() {
            var searchString = window.location.href;
            if (searchString.includes('old') || searchString.includes('latest')) {
                if (searchString.includes('old')) {
                    location.href = searchString.replace('old', this.value);
                } else {
                    location.href = searchString.replace('latest', this.value);
                }
            } else if (searchString.includes('?')) {
                location.href = searchString + '&' + this.value + '=all';
            } else {
                location.href = searchString + '?' + this.value + '=all';
            }

        });
    </script>

    {{-- for filtering data --}}
    <script>
        $('#filterData').on('change', function() {
            var data = $('#filterData').serialize();
            var search = '{{ request()->search ? request()->search : '' }}';
            var department = '{{ request()->department ? request()->department : '' }}';
            var industry = '{{ request()->industry? request()->industry: '' }}'

            $.ajax({
                url: "{{ route('jobFilter') }}",
                method: 'POST',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'data': data,
                    'search': search,
                    'department': department,
                    'industry' : industry,
                },
                beforeSend: function() {
                    $('#data').find('div').remove();
                    $('#data').html('<i class="fas fa-spinner fa-spin"></i>&nbsp;<span>Loading</span>');
                },
                success: function(res) {
                    console.log(res.html);
                    $('#data').html(res.html);
                },
                error: function(xhr) {
                    if (xhr.status == 419) {
                        location.reload(true);
                    }
                    toastr.error('Something went wrong');
                }
            });
        });
    </script>
@endsection
