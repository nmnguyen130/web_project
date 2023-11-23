$(document).ready(function () {
  // Show and hide the password
  const btnShowHide = $(".eye-icon");

  btnShowHide.each(function () {
    const eyeIcon = $(this);
    const passwordField = eyeIcon.parent().find(".pwd");

    function checkInputValue() {
      if (passwordField.val().trim() === "") {
        eyeIcon.addClass("hidden");
      } else {
        eyeIcon.removeClass("hidden");
      }
    }

    eyeIcon.on("click", function () {
      if (passwordField.attr("type") === "password") {
        passwordField.attr("type", "text");
        eyeIcon
          .find(".fa-solid")
          .removeClass("fa-eye-slash")
          .addClass("fa-eye");
      } else {
        passwordField.attr("type", "password");
        eyeIcon
          .find(".fa-solid")
          .removeClass("fa-eye")
          .addClass("fa-eye-slash");
      }
    });

    passwordField.on("input", checkInputValue);
    checkInputValue();
  });

  // Check confirm pass
  $("#confirmPass").on("input", function () {
    checkPassMatch();
  });

  function checkPassMatch() {
    var newPass = $("#newPass").val();
    var confirmPass = $("#confirmPass").val();
    var confirmError = $("#confirmError");
    var signupBtn = $("#signup-btn");

    if (newPass === confirmPass) {
      confirmError.text("");
      signupBtn.prop("disabled", false);
    } else {
      confirmError.text("Mật khẩu không trùng khớp!");
      signupBtn.prop("disabled", true);
    }
  }
});
