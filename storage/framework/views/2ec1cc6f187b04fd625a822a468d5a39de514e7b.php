<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e($setting->site_title); ?></title>
    <?php echo $__env->yieldContent('seo_section'); ?>
    <?php echo $__env->make('user.layout.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/vendor/sweetalert/sweetalert.css')); ?>" />
    <?php echo $__env->yieldPushContent('style'); ?>
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
        <?php echo $__env->make('user.layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="main-content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- End Page-content -->

        <?php echo $__env->make('user.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                    <a href="tel:<?php echo e($setting->phone); ?>">
                        Call <?php echo e($setting->phone); ?>

                    </a><br>
                </div>
            </div>

            <div class="sidebar-button">
                <div class="title-small">
                    Receive applications today
                </div>
                <div class="title-button">
                    <a href="<?php echo e(route('advertise.banner-job')); ?>" name="submit" id="submit"
                        class="btn btn-orange btn-hover">Advertise Now</a>
                </div>


                

            </div>

            <div class="arrow"></div>

        </div>

    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <?php echo $__env->make('user.layout.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('script'); ?>
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
    <script src="<?php echo e(asset('/frontend/assets/js/jquery-equal-height.min.js')); ?>"></script>
    <?php if(auth()->check()): ?>
        <?php if(auth()->user()->hasRole('employer')): ?>
            <?php if(auth()->user()->suspended == 1): ?>
                <?php auth()->logout(); ?>
                <script>
                    $(function() {
                        swal({
                            title: "Account Suspended",
                            text: "Your account has been suspended.\n Please contact us in : " +
                                '<?php echo e($setting->site_email); ?>',
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
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

    <script>
        $('#username').on('change', function() {
            var username = $('#username').val();
            $.ajax({
                type: 'post',
                url: '<?php echo e(route('users.validate')); ?>',
                data: {
                    '_token': '<?php echo e(csrf_token()); ?>',
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
<?php /**PATH /home/megajobn/public_html/resources/views/user/layout/master.blade.php ENDPATH**/ ?>