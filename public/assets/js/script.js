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

// ADD INPUTS FOR HASHTAG
function addHashtagInput() {
  var container = document.querySelector('.hashtags-inputs');

  var inputWrapper = document.createElement('div');
  inputWrapper.classList.add('input-wrapper');

  var input = document.createElement('input');
  input.type = 'text';
  input.name = 'hashtags[]';
  input.className = 'input-box-hashtag';
  input.placeholder = 'Введите хештег';

  inputWrapper.appendChild(input);

  container.appendChild(inputWrapper);
}

function removeLastHashtagInput() {
  var container = document.querySelector('.hashtags-inputs');

  var lastInputWrapper = container.lastElementChild;

  if (lastInputWrapper && lastInputWrapper.classList.contains('input-wrapper')) {
    container.removeChild(lastInputWrapper);
  }
}

//



