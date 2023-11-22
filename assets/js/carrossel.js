const swiper = new Swiper('.swiper-container', {
    
    breakpoints: {
        540: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        640: {
            slidesPerView: 2.5,
            spaceBetween: 20,
        },
        910: {
            slidesPerView: 3.2,
            spaceBetween: 20,
        },
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

