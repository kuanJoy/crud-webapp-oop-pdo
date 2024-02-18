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

ClassicEditor
    .create(document.querySelector('#content'), {
        ckfinder: {
            uploadUrl: 'fileupload.php'
        }
    })
    .then(editor => {
        console.log(editor);
    })
    .catch(error => {
        console.error(error);
    });