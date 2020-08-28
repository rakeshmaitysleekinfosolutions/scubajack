
!function ($) {
    "use strict";
    $(document).ready(function () {
        if( $.cookie('splashscreen') == null || $.cookie('splashscreen') == '') { // Here you are checking if cookie is existing if not you are showing a splash screen and set a cookie
            //$(".splash-screen").fadeIn();
            $(".splash-screen").css('display', 'block');
        } else {
            $(".splash-screen").css('display', 'none');
        }
        $("#splashscreen").click(function (e) {
            $(".splash-screen").fadeOut(2000);
            //$.cookie("splashscreen", 1, { expires : 10 }); // cookie is valid for 10 days
        });
    });
}(window.jQuery);
