

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
        var iso = $(this).attr('data-iso');
        console.log($(this).attr('data-subscriberId'));
        $.ajax({
            type: "POST",
            url: $(this).attr('data-url'),
            dataType: "json",
            data: {
                subscriberId: $(this).attr('data-subscriberId')
            },
            beforeSend: function() {
                $.LoadingOverlay("show");
            },
            cache: false,
            success: function (res) {
                console.log(res);
                if (!res['success']) {
                    setTimeout(function() {
                        console.log(myLabel.baseUrl + iso + '/explore');
                        //location.href = data['redirect'];
                    },3000);
                } else {
                    setTimeout(function() {
                      //  console.log(myLabel.baseUrl + iso + '/explore');
                        //window.location.href = myLabel.baseUrl + iso + '/explore';
                    },3000);
                }
            },error: function (err) {
                console.log(err);
            }
        });

    })
})
