$(function () {

    const myApp = $(window)

    // Dropdown navbar
    const dropdownAction = () => {
        if ($('li.dropdown').hasClass('show')) {
            $('li.dropdown').removeClass('show')
            $('div.dropdown-menu').removeClass('show')
        } else {
            $('li.dropdown').addClass('show')
            $('div.dropdown-menu').addClass('show')
        }
    }

    $('li.dropdown')
        .mouseenter(dropdownAction)
        .click(dropdownAction)
        .mouseleave((dropdownAction));


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


    // Scrolling Effect
    $(myApp).scroll(() => {
        // console.log(myApp.scrollTop())

        // Ganti warna navigation bar
        if (myApp.scrollTop() > 200) {

            $('header').addClass('bg-white shadow')
            $('.nav-toggler div').addClass('bg-dark')
            $('.nav-link').addClass('text-dark')
            $('.logo-img:first-child()').addClass('hidden')
            $('.logo-img:last-child()').removeClass('hidden')
            $('.login a').addClass('btn-outline-dark text-dark')

        } else {
            $('header').removeClass('bg-white shadow')
            $('.nav-toggler div').removeClass('bg-dark')
            $('.nav-link').removeClass('text-dark')
            $('.logo-img:last-child()').addClass('hidden')
            $('.logo-img:first-child()').removeClass('hidden')
            $('.login a').removeClass('btn-outline-dark text-dark')
        }

        // fade in out content
        let tinggiCards = $('.sdcards').height()
        const superContent = $('.sup-title, .image-ame, .super1, .super2, .super3')

        if (myApp.scrollTop() > tinggiCards) {
            // alert('aku ganteng')
            superContent.addClass('scroll-active')
        } else {
            superContent.removeClass('scroll-active')
        }
    })


    // Superiority location
    const sdcards = $('.sdcards')
    const superiority = $('.superiority')
    const everySection = $('.jangkauan, .armada, .hubungi, .footer')
    let sdcardsBottom = sdcards.offset().top + sdcards.height();
    superiority.css({ 'top': sdcardsBottom + 'px' })
    everySection.css({ 'top': superiority.offset().top + 'px' })
    $(myApp).resize(() => {
        let sdcardsBottom = sdcards.offset().top + sdcards.height();
        const superiority = $('.superiority')
        superiority.css({ 'top': sdcardsBottom + 10 + 'px' })
        everySection.css({ 'top': superiority.offset().top + 'px' })
    })

});