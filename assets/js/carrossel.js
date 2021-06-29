const swiper = new Swiper('.swiper-container', {
    
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2.2,
            spaceBetween: 40,
        },
        1366: {
            slidesPerView: 3.2,
            spaceBetween: 20,
        },
        1920: {
            slidesPerView: 4.2,
            spaceBetween: 20,
        }
    },

     // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: {
        el: '.swiper-pagination',
    },

});

