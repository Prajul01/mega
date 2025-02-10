<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ $setting->site_title }}</title>
    @yield('seo_section')
    @include('user.layout.head')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/sweetalert/sweetalert.css') }}" />
    @stack('style')
    <style>
        .ad-wrapper {
            margin: 15px 0;
        }

        .text {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* number of lines to show */
            line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .job-lineclamp .text {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            /* number of lines to show */
            line-clamp: 1;
            -webkit-box-orient: vertical;
        }
    </style>


</head>

<body>

    <!-- Begin page -->
    <div>
        @include('user.layout.navbar')

        <div class="main-content">
            @yield('content')
        </div>
        <!-- End Page-content -->

        @include('user.layout.footer')
        <!--start back-to-top-->
        <button onclick="topFunction()" id="back-to-top">
            <i class="mdi mdi-arrow-up"></i>
        </button>
        <!--end back-to-top-->
    </div>
    <!-- end main content-->


    <div class="fixed-sidebar translate-add">
        <div class="sidebar-hidebtn">
            Recruiting?
        </div>

        <div class="sidebar-content">

            <div class="sidebar-close-button">
                <i class="fa-solid fa-xmark"></i>
            </div>

            <div class="sidebar-header">
                <div class="title-heading">
                    Hire fast. Hire smart.
                </div>
                <div class="title-small">
                    Target the best talent near you
                </div>
                <div class="title-call">
                    <a href="tel:{{ $setting->phone }}">
                        Call {{ $setting->phone }}
                    </a><br>
                </div>
            </div>

            <div class="sidebar-button">
                <div class="title-small">
                    Receive applications today
                </div>
                <div class="title-button">
                    <a href="{{ route('advertise.banner-job') }}" name="submit" id="submit"
                        class="btn btn-orange btn-hover">Advertise Now</a>
                </div>


                {{-- <div class="title-quote">
                    <i>"Advertising with Totaljobs was simple, fast and stress-free."</i>
                </div>

                <div class="title-star">
                    <span class="star">&nbsp;</span>
                    <span class="star">&nbsp;</span>
                    <span class="star">&nbsp;</span>
                    <span class="star">&nbsp;</span>
                    <span class="star">&nbsp;</span>
                </div> --}}

            </div>

            <div class="arrow"></div>

        </div>

    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    @include('user.layout.script')
    @stack('script')
    <script>
        $(window).resize(function() {
            $('.jQueryEqualHeight').jQueryEqualHeight('.service-card .service-body');
            $('.jQueryEqualHeight').jQueryEqualHeight('.service-card .service-title');
            $('.jQueryEqualHeight').jQueryEqualHeight('.service-card .service-body .service-text');
            $('.jQueryEqualHeight').jQueryEqualHeight('.service-card');
        });
        $(window).on('load', function(event) {
            $('.jQueryEqualHeight').jQueryEqualHeight('.service-card .service-title');
            $('.jQueryEqualHeight').jQueryEqualHeight('.service-card .service-body');
            $('.jQueryEqualHeight').jQueryEqualHeight('.service-card .service-body .service-text');
            $('.jQueryEqualHeight').jQueryEqualHeight('.service-card');
        });
    </script>
    <script src="{{ asset('/frontend/assets/js/jquery-equal-height.min.js') }}"></script>
    @if (auth()->check())
        @if (auth()->user()->hasRole('employer'))
            @if (auth()->user()->suspended == 1)
                <?php auth()->logout(); ?>
                <script>
                    $(function() {
                        swal({
                            title: "Account Suspended",
                            text: "Your account has been suspended.\n Please contact us in : " +
                                '{{ $setting->site_email }}',
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#dc3545",
                            confirmButtonText: "Close",
                            closeOnConfirm: false
                        }, function(isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });
                    });
                </script>
            @endif
        @endif
    @endif

    <script>
        $('#username').on('change', function() {
            var username = $('#username').val();
            $.ajax({
                type: 'post',
                url: '{{ route('users.validate') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'username': username,
                },
                success: function(data) {
                    if (data['valid'] == 1) {
                        $('#message').removeAttr('class');
                        $('#message').attr('class', 'text-success');
                        $('#message').html('This Username is valid');
                        $('#message').attr('style',
                            'margin-top:5px !important; display:block !important;');
                        $('#username').attr('style', 'border-color: green;')
                    }

                    if (data['valid'] == 0) {
                        $('#message').removeAttr('class');
                        $('#message').attr('class', 'text-danger');
                        $('#message').html(
                            'This Username already exists! You can try <span class="btn btn-sm btn-success">' +
                            data['suggestions'] + '</span>');
                        $('#message').attr('style',
                            'margin-top:5px !important;display:block !important;');
                        $('#username').attr('style', 'border-color: red;')

                    }
                }
            });
        });
    </script>
    <script>
        function logout() {
            swal({
                title: "Are you sure?",
                text: "You will be logging out",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function(isConfirm) {
                if (isConfirm) {
                    $('#logout').submit();
                }
            });
        }
    </script>
</body>

</html>
