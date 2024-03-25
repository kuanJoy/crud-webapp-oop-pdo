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
  plugins: "anchor autolink charmap codesample emoticons image link lists media searchreplace table textcolor visualblocks wordcount linkchecker",
  toolbar: "fontsize fontselect fontsizeselect undo redo | formatselect | bold italic underline strikethrough | link image media | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | emoticons charmap | removeformat | forecolor backcolor",
  menubar: false,
  textcolor_map: [
    "000000", "Black",
    "993300", "Burnt orange",
    "333300", "Dark olive",
    "003300", "Dark green",
    "003366", "Dark azure",
    "000080", "Navy Blue",
    "333399", "Indigo",
    "333333", "Very dark gray",
    "800000", "Maroon",
    "FF6600", "Orange",
    "808000", "Olive",
    "008000", "Green",
    "008080", "Teal",
    "0000FF", "Blue",
    "666699", "Grayish blue",
    "808080", "Gray",
    "FF0000", "Red",
    "FF9900", "Amber",
    "99CC00", "Yellow green",
    "339966", "Sea green",
    "33CCCC", "Turquoise",
    "3366FF", "Royal blue",
    "800080", "Purple",
    "999999", "Medium gray",
    "FF00FF", "Magenta",
    "FFCC00", "Gold",
    "FFFF00", "Yellow",
    "00FF00", "Lime",
    "00FFFF", "Aqua",
    "00CCFF", "Sky blue",
    "993366", "Red violet",
    "FFFFFF", "White",
    "FF99CC", "Pink",
    "FFCC99", "Peach",
    "FFFF99", "Light yellow",
    "CCFFCC", "Pale green",
    "CCFFFF", "Pale cyan",
    "99CCFF", "Light sky blue",
    "CC99FF", "Plum"
  ],
  theme_advanced_font_sizes: "10px,12px,14px,16px,24px",
  font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt'

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

