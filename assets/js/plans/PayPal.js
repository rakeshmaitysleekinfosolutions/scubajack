!function ($) {
    "use strict";
    $(document).on('click', '#processToPayPal', function (e) {
        var planId = $('#planId').val();
        console.log(planId);
        $.ajax({
            type: "POST",
            url: myLabel.paypal,
            data: {
                planId: planId
            },
            cache: false,
            success: function (res) {
               console.log(res);
            }
        });
    });
}(window.jQuery);

