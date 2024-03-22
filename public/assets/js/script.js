// SWIPER BANNER CONFIGURATION

const swiper = new Swiper(".mySwiper", {
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  loop: true,
  speed: 800,
});


// ========================= Hamburger =========================
const hamburger = document.querySelector(".hamburger--slider");
const navCollapse = document.querySelector(".nav-collapse");
hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("is-active");
  navCollapse.classList.toggle("is-active");
});

// TinyMC
tinymce.init({
  selector: "textarea",
  plugins:
    "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss",
  toolbar:
    "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat",
  tinycomments_mode: "embedded",
  tinycomments_author: "Author name",
  mergetags_list: [
    { value: "First.Name", title: "First Name" },
    { value: "Email", title: "Email" },
  ],
  ai_request: (request, respondWith) =>
    respondWith.string(() =>
      Promise.reject("See docs to implement AI Assistant")
    ),
});

// ADD INPUTS FOR HASHTAG
function addHashtagInput() {
  var container = document.querySelector(".hashtags-inputs");

  var inputWrapper = document.createElement("div");
  inputWrapper.classList.add("input-wrapper");

  var input = document.createElement("input");
  input.type = "text";
  input.name = "hashtags[]";
  input.className = "input-box-hashtag";
  input.placeholder = "Введите хештег";

  inputWrapper.appendChild(input);

  container.appendChild(inputWrapper);
}

function removeLastHashtagInput() {
  var container = document.querySelector(".hashtags-inputs");

  var lastInputWrapper = container.lastElementChild;

  if (
    lastInputWrapper &&
    lastInputWrapper.classList.contains("input-wrapper")
  ) {
    container.removeChild(lastInputWrapper);
  }
}

// CONFIRM DELETE
function showConfirmation() {
  var confirmed = confirm("Подтвердите удаление!");
  return confirmed;
}

