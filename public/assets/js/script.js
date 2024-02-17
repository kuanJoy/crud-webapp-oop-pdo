const swiper = new Swiper('.swiper-container', {
    slidesPerView: 2,
    spaceBetween: 30,
    direction: 'horizontal',
    loop: true,
});

// Добавляем обработчик клика на следующий слайд
swiper.on('click', function () {
    swiper.slideNext();
});