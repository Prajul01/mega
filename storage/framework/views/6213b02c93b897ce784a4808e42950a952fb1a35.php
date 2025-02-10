<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="<?php echo e(asset('frontend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="https://unicons.iconscout.com/release/v4.0.0/script/monochrome/bundle.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Choice Js -->
<script src="<?php echo e(asset('frontend/assets/libs/choices.js/public/assets/scripts/choices.min.js')); ?>"></script>

<!-- Swiper Js -->
<script src="<?php echo e(asset('frontend/assets/libs/swiper/swiper-bundle.min.js')); ?>"></script>

<!-- Job-list Init Js -->
<script src="<?php echo e(asset('frontend/assets/js/pages/job-list.init.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/assets/js/jquery.fancybox.min.js')); ?>"></script>

<!-- Switcher Js -->
<script src="<?php echo e(asset('frontend/assets/js/pages/switcher.init.js')); ?>"></script>

<script src="<?php echo e(asset('frontend/assets/js/pages/index.init.js')); ?>"></script>

<script src="<?php echo e(asset('frontend/assets/js/app.js')); ?>"></script>
<script src="<?php echo e(asset('backend/assets/vendor/toastr/toastr.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"
    integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?php echo e(asset('backend/assets/vendor/sweetalert/sweetalert.min.js')); ?>"></script>

<script>
    $(".sidebar-close-button").on("click", function() {
        $(".fixed-sidebar").addClass("translate-add");
    })
    $(".sidebar-hidebtn").on("click", function() {
        $(".fixed-sidebar").removeClass("translate-add");
    })
</script>
<script>
    $('.trumbowyg').trumbowyg();
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>

<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 2,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        loop: true,
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 00,
            },
        },
    });

    var swiper = new Swiper(".newSwiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });


    var swiper = new Swiper(".employerSwiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
        },
    });
</script>

<script>
    $(document).scroll(function() {
        var y = $(this).scrollTop();
        if (y > 300) {
            $('.footer-fixed').addClass("add-sticky");
        } else {
            $('.footer-fixed').removeClass("add-sticky");
        }
    });
    $(".eye-btn").on("click", function (event) {
            event.stopPropagation();
            var passwordInput = $(this).siblings(".password-input");
            var eyeBtn = $(this);

            if (passwordInput.attr("type") === "password") {
                eyeBtn.find(".show-eye").removeClass("d-none");
                eyeBtn.find(".hide-eye").addClass("d-none");
                passwordInput.attr("type", "text");

            } else {
                passwordInput.attr("type", "password");
                eyeBtn.find(".show-eye").addClass("d-none");
                eyeBtn.find(".hide-eye").removeClass("d-none");
            }
        });


    $(".dropdown-icon").click(function() {
        $(this).siblings(".row").find(".list-block").toggleClass("show-height");
        $(this).parents(".job-box").toggleClass("new-overflow");
        $(this).parent(".job-div").toggleClass("new-index");
    })
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

    $("#menu-dropdown").click(function() {
        $(".mobile-dropdown").toggleClass("menu-toggle");
    });
    $(".mobile-see-more").on("click", function() {
        $(this).siblings(".col-lg-4").toggleClass("d-block");
        $(".click-show").toggleClass("d-none");
        $(".click-remove").toggleClass("d-none");
        $(".top-icon i").toggleClass("fa-angle-down, fa-angle-up")
    });

    $(document).scroll(function() {
        var y = $(this).scrollTop();
        if (y > 300) {
            $('.blog-share-fixed').addClass("pos-fixed");
        } else {
            $('.blog-share-fixed').removeClass("pos-fixed");
        }
    });
</script>
<?php if(session('status')): ?>
    <script>
        $(function() {
            toastr.success("<?php echo e(session('status')); ?>");
        });
    </script>
<?php endif; ?>
<?php if(session('error')): ?>
    <script>
        $(function() {
            toastr.error("<?php echo e(session('error')); ?>");
        });
    </script>
<?php endif; ?>
<?php if(session('warning')): ?>
    <script>
        $(function() {
            toastr.warning("<?php echo e(session('warning')); ?>");
        });
    </script>
<?php endif; ?>
<?php if($errors->any()): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>
            $(function() {
                toastr.error("<?php echo e($error); ?>");
            });
        </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php echo $__env->yieldContent('script'); ?>
<?php /**PATH /home/megajobn/public_html/resources/views/user/layout/script.blade.php ENDPATH**/ ?>