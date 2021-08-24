$(document).ready(function(){
        $(function() {
            var navbar = $(".navbar");
            $(window).scroll(function() {
                var scroll = $(window).scrollTop();
                resizeNavBar(navbar, scroll);
            });
        });

    var navbar = $(".navbar");
    var scroll = $(window).scrollTop();
    resizeNavBar(navbar, scroll);
});

function resizeNavBar(navbar, scroll) {
    if (scroll >= 20) {
        navbar.removeClass("pt-lg-5").removeClass("pl-lg-5");
        $('.navbar').css('background-color', '#000');
    } else {
        navbar.addClass("pt-lg-5").addClass("pl-lg-5");
        $('.navbar').css('background-color', 'transparent');
    }
}