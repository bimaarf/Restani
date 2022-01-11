$(function () {
    // Mobile Navigation Bar
    $('.nav-toggler').click(function () {
        if ($('.navbar').hasClass('nav-active')) {
            $('.navbar').removeClass('nav-active')
            $('.nav-toggler').removeClass('toggler')
            $('.navbar li').css({ 'animation': '' })
            $('.login').css({ 'animation': '' })
        } else {
            $('.navbar').addClass('nav-active')
            $('.login').addClass('nav-active')
            $('.nav-toggler').addClass('toggler')
            $('.navbar li').css({ 'animation': 'navLinkFade 0.5s ease forwards 0.3s' })
            $('.login').css({ 'animation': 'navLinkFade 0.5s ease forwards 0.3s' })
        }
    })
})