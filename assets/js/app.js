

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
    $('.headerVideoLink').magnificPopup({
        type:'inline',
        midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
    });

});