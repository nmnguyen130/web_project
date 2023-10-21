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

  // Change the login form or signup form
  const loginBtn = document.getElementById("btn-login");
  const signupBtn = document.getElementById("btn-signup");
  const loginForm = document.getElementById("login-form");
  const signupForm = document.getElementById("signup-form");

  signupBtn.addEventListener("click", () => {
    loginForm.classList.add("hidden");
    signupForm.classList.remove("hidden");
  });

  loginBtn.addEventListener("click", () => {
    signupForm.classList.add("hidden");
    loginForm.classList.remove("hidden");
  });
});
