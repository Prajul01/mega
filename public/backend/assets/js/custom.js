// light version js
$(document).ready(function () {
    //To switch the dark mode checkbox off everytime this page loads
    $(".custom-switch .lv-btn").prop("checked", false);
    $(".custom-switch .lv-btn").on("change", function () {
        if (this.checked) {
            //$('body').addClass('light_version');
            $("body").removeClass("light_version");
        } else {
            $("body").addClass("light_version");
        }
    });
});

$(window).resize(function () {
    if ($(window).width() < 1200) {
        $("body").removeClass("mini_sidebar");
        $(".sidebar").removeClass("mini_sidebar_on");
    } else {
        $("body").addClass("mini_sidebar");
        $(".sidebar").addClass("mini_sidebar_on");
        $(".btn-toggle-offcanvas").click(function () {
            $("body").toggleClass("mini_sidebar");
            $(".sidebar").toggleClass("mini_sidebar_on");
        });
    }
});

$("#newspaperJob").on("change", function () {
    if ($("#newspaperJob").is(":checked")) {
        $(".newspaper-image").removeClass("display-no");
        $(".jobDesc-info").addClass("display-no");
        $("#generalJob").prop("checked", false);
    }
});
$("#generalJob").on("change", function () {
    if ($("#newspaperJob").is(":checked")) {
        $(".newspaper-image").addClass("display-no");
        $(".jobDesc-info").removeClass("display-no");
        $("#newspaperJob").prop("checked", false);
    }
});

$("#non-nestables").nestable({
    maxDepth: 1,
});
