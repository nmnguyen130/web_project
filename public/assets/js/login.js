document.addEventListener("DOMContentLoaded", () => {
  // Show and hide the password
  const btnShowHide = document.querySelectorAll(".eye-icon");

  btnShowHide.forEach((eyeIcon) => {
    const passwordField = eyeIcon.parentElement.querySelector(".pwd");

    function checkInputValue() {
      if (passwordField.value.trim() === "") {
        eyeIcon.classList.add("hidden");
      } else {
        eyeIcon.classList.remove("hidden");
      }
    }

    eyeIcon.addEventListener("click", () => {
      if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon
          .querySelector(".fa-solid")
          .classList.replace("fa-eye-slash", "fa-eye");
      } else {
        passwordField.type = "password";
        eyeIcon
          .querySelector(".fa-solid")
          .classList.replace("fa-eye", "fa-eye-slash");
      }
    });

    passwordField.addEventListener("input", checkInputValue);
    checkInputValue();
  });
});
