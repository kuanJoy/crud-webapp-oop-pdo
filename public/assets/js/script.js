const swiper = new Swiper(".swiper-container", {
  slidesPerView: 2,
  spaceBetween: 30,
  direction: "horizontal",
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

// swiper.on("click", function () {
//   swiper.slideNext();
// });

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
