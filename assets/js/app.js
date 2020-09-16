

// function setSplashScreen() {
//     if( $.cookie('splashscreen') == null || $.cookie('splashscreen') == '') { // Here you are checking if cookie is existing if not you are showing a splash screen and set a cookie
//         //$(".splash-screen").fadeIn();
//         $(".splash-screen").css('display', 'block');
//     } else {
//         $(".splash-screen").css('display', 'none');
//     }
//
// }
// function deleteSplashScreen(key) {
//     document.cookie = key + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
// }

$( document ).ready(function() {
    var headerVideolinkDiv = $('.headerVideoLink');
    if(headerVideolinkDiv.length != 0) {
        headerVideolinkDiv.magnificPopup({
            type:'inline',
            midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
        })
    }
}).on('click', '.headerVideoLink', function() {
    var headerVideolinkDiv = $('.headerVideoLink');
    if($(this).length != 0) {
        var subscriberId = $(this).attr('data-subscriberId');
        $.ajax({
            type: "POST",
            url: $(this).attr('data-url'),
            dataType: "json",
            data: {
                subscriberId: subscriberId
            },
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            cache: false,
            success: function (data) {
                if (!data['success']) {
                    setTimeout(function() {
                        location.href = data['redirect'];
                    },3000);
                } else {
                    setTimeout(function() {
                        headerVideolinkDiv.magnificPopup({
                            type:'inline',
                            midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
                        })
                        $.LoadingOverlay("hide");
                    },3000);
                }
            },error: function (err) {
                console.log(err);
            }
        });
    }
});




var map = document.querySelector('#map');
var paths = map.querySelectorAll('.map__image a');


if(NodeList.prototype.forEach == undefined) {
    NodeList.prototype.forEach = function (callback) {
        [].forEach().call(this, callback);
    }
}
paths.forEach(function (path) {
    path.addEventListener('click', function (e) {
        e.preventDefault();
        var countryIso             = $(this).attr('data-iso');
        var subscriberId    = $(this).attr('data-subscriberid');

        var formData = new FormData();
        formData.append('userId', subscriberId);
        formData.append('countryIso', countryIso);

        $.ajax({
            type: "POST",
            url: $(this).attr('data-url'),
            dataType: "json",
            data: {
                subscriberId: subscriberId
            },
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            cache: false,
            success: function (res) {
                if (res['success']) {
                    stampToPassport({data: formData});

                } else {
                    setTimeout(function() {
                        location.href = myLabel.viewplans;
                    },3000);
                }
            },error: function (err) {
                console.log(err);
            }
        });

        function stampToPassport(options) {
            fetch(myLabel.stampToPassport, {
                method: 'post',
                body: options.data
            }).then(function(response) {
                return response.json();
            }).then(function (data) {
                var success = data.success;
                if(success) {
                    console.log(success);
                    setTimeout(function() {
                        location.href = data.redirect;
                    },3000);
                } else {
                    setTimeout(function() {
                        location.href = data.redirect;
                    },3000);
                }

            });
        }

    })
})
