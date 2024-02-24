// SWIPER BANNER CONFIGURATION
const swiper = new Swiper(".banner", {
  slidesPerView: 2,
  spaceBetween: 30,
  direction: "horizontal",
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

const swHashtags = new Swiper(".hashtags", {
  slidesPerView: "auto",
  spaceBetween: 10,
  loop: true,
  autoplay: {
    delay: 1500,
    disableOnInteraction: false,
  },
  speed: 800
});


// CKEDITOR
ClassicEditor.create(document.querySelector("#content"), {
  ckfinder: {
    uploadUrl: "fileupload.php",
  },
})
  .then((editor) => {
    console.log(editor);
  })
  .catch((error) => {
    console.error(error);
  });
