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

$(document).ready(function(){
    var timer;
     // $(".carousel-inner").addClass('carousel-inner-visible');
    $("a.thumbnail").hover(function(){
        $("a.thumbnail:hover .balao").hide();
        timer = setTimeout(function(){$(".carousel-inner").addClass('carousel-inner-visible');
             $("a.thumbnail:hover .balao").show();
            }, 400);
    
          }, function(){
        clearTimeout(timer);
        $(".carousel-inner").removeClass('carousel-inner-visible');
    });
    
});

function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

$(document).ready(function(){
    var div = getUrlVars()["div"];
    div = "#" + div;
    $('html,body').animate({scrollTop:$(div).offset().top},1000);
    console.log(div);
});


//  $(".button-fill").hover(function () {
//     $(this).children(".button-inside").addClass('full');
// }, function() {
//   $(this).children(".button-inside").removeClass('full');
// });

// Highlight the top nav as scrolling occurs
//$('body').scrollspy({
//    target: '.navbar-fixed-top'
//});
