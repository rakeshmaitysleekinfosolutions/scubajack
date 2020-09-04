!function ($) {
    "use strict";
    var $frm = $("#frm"),
        validate = ($.fn.validate !== undefined);
    var $btn = $("#btn");

    if ($frm.length > 0 && validate) {
        $frm.validate({
            rules:{
                firstname: {
                    required: true,
                },
                lastname: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    alphanumeric: true,
                    nowhitespace: true
                },
                confirm: {
                    alphanumeric: true,
                    nowhitespace: true,
                    equalTo: password
                }
            },
            submitHandler: function (form) {
                $.ajax({
                    type: "POST",
                    url: $(form).attr('action'),
                    dataType: "json",
                    data: $(form).serialize(),
                    beforeSend: function(){
                        $btn.button('loading');
                    },
                    success: function (json) {

                        if (json['error']) {
                            //$('#button-register').button('reset');

                            if (json['error']['warning']) {
                                $('#my-container .frm').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                            }
                            //var i;

                            for (var i in json['error']) {
                                var element = $('#input-' + i.replace('_', '-'));
                                //console.log(element);
                                if ($(element).parent().hasClass('input-group')) {
                                    $(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
                                } else {
                                    $(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
                                }
                            }

                            // Highlight any found errors
                            $('.text-danger').parent().addClass('has-error');
                        }
                        if (json['success']) {
                            $('#my-container > .frm').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i>  ' + json['success'] + '</div>');
                            $btn.button('reset');
                        }
                    }
                });

                return false; // required to block normal submit since you used ajax
            }

        });
    }
}(window.jQuery);

