// SWIPER BANNER CONFIGURATION

const swiper = new Swiper(".mySwiper", {
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  loop: true,
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
