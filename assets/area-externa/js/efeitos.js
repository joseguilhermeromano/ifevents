// Floating label headings for the contact form
$(function() {
    $("body").on("input propertychange", ".floating-label-form-group", function(e) {
        $(this).toggleClass("floating-label-form-group-with-value", !! $(e.target).val());
    }).on("focus", ".floating-label-form-group", function() {
        $(this).addClass("floating-label-form-group-with-focus");
    }).on("blur", ".floating-label-form-group", function() {
        $(this).removeClass("floating-label-form-group-with-focus");
    });
});

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
if ($('#back-to-top').length) {
    var scrollTrigger = 500, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 1500);
    });
}
});

jQuery(document).ready(function($) {
    $(".scroll").click(function(event){     
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
    });
});

/* FUNÇÃO UTILIZADA PARA EXIBIR O BALAOZINHO SOBRE O LOGO NO CAROUSEL DE PARCERIAS*/
$(document).ready(function(){
    var timer;
    $("a.thumbnail").hover(function(){
        $("a.thumbnail:hover .balao").hide();
        timer = setTimeout(function(){$(".carousel-inner").addClass('carousel-inner-visible');
             $("a.thumbnail:hover .balao").show();
             $(".media-carousel .carousel-indicators").hide();
            }, 400);
    
          }, function(){
        clearTimeout(timer);
        $(".carousel-inner").removeClass('carousel-inner-visible');
        $(".media-carousel .carousel-indicators").show();
    });
    
});
