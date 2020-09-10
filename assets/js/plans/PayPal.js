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
            success: function (json) {
                console.log(json);
                if (json['success']) {
                    setTimeout(function() {
                        location.href = json['redirect'];
                    },1000);
                }
            }
        });
    });
}(window.jQuery);

