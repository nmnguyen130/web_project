const header = document.querySelector("header");

window.addEventListener("scroll", function () {
  if (this.window.scrollY >= this.window.innerHeight) {
    header.classList.add("active");
  } else {
    header.classList.remove("active");
  }
});
