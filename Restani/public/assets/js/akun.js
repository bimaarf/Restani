$(function () {
    let width = $(window).width()

    if (width <= 575) {
        $('.login-button').removeClass('col-5');
        $('.login-button').removeClass('col-4');
        $('.login-button').removeClass('col-3');
        $('.login-button button').removeClass('float-end');
    } else if (width < 767) {
        $('.login-button').addClass('col-4');
        $('.login-button').removeClass('col-5');
    } else if (width > 767 && width < 886) {
        $('.login-button').removeClass('col-5');
        $('.login-button').removeClass('col-4');
        $('.login-button').addClass('col-3');
    } else {
        $('.login-button').addClass('col-5');
        $('.login-button').removeClass('col-3');
        $('.login-button').removeClass('col-4');
        $('.login-button button').addClass('float-end');
    }



    $(window).resize(function () {
        width = $(window).width()

        if (width <= 575) {
            $('.login-button').removeClass('col-5');
            $('.login-button').removeClass('col-4');
            $('.login-button').removeClass('col-3');
            $('.login-button button').removeClass('float-end');
        } else if (width < 767) {
            $('.login-button').addClass('col-4');
            $('.login-button').removeClass('col-5');
        } else if (width > 767 && width < 886) {
            $('.login-button').removeClass('col-5');
            $('.login-button').removeClass('col-4');
            $('.login-button').addClass('col-3');
        } else {
            $('.login-button').addClass('col-5');
            $('.login-button').removeClass('col-3');
            $('.login-button').removeClass('col-4');
            $('.login-button button').addClass('float-end');
        }
    })
})

const messages = document.getElementsByClassName('message-error')
for (let index = 0; index < messages.length; index++) {
    const message = messages[index];

    if (index != 0) {
        const tinggi = messages[index - 1].clientHeight
        const tinggi2 = message.clientHeight
        message.style.bottom = 20 + (tinggi * index) + "px";
    }
}

$(document).ready(function () {
    setTimeout(function () {
        $('.message-error').addClass('message-hidden')
    }, 4000)
})