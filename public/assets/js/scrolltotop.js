

$(document).on('click', '#toTop', function() {
    $('body,html').animate({scrollTop:0}, 500);
});

$(window).scroll(function() {
    if ($(this).scrollTop() > 638)
        $('#toTop').fadeIn();
    else 
        $('#toTop').fadeOut();
});