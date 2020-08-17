!function ($) {
    "use strict";
    var $frmSignIn = $("#frmSignIn"),validate = ($.fn.validate !== undefined);
		if ($frmSignIn.length > 0 && validate) {
            $frmSignIn.validate({
                rules:{
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        nowhitespace: true
                    }
                },
                submitHandler: function (form) {
					$.ajax({
                        type: "POST",
                        url: $(form).attr('action'),
                        dataType: "json",
                        data: $(form).serialize(),
                        success: function (json) {
                                
                                if (json['error']) {
                                    if (json['error']['warning']) {
                                        $('#my-container > .signin-form').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '</div>');
                                    }
                                }
                                if (json['success']) {
                                    $('#my-container > .signin-form').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i>  ' + json['success'] + '</div>');
                                    //document.getElementById("frmSignIn").reset();
                                    setTimeout(function() {
                                        location.href = json['redirect'];
                                    },1000);
                                }
                            
                        }
                    });
					
					return false; // required to block normal submit since you used ajax
				}
                
            });
        }
}(window.jQuery);

