$(document).ready(() => {
  let currentAjaxRequest;

  $(".view-post").click(function (e) {
    e.preventDefault();

    var postId = $(this).data("post-id");

    $.ajax({
      url: root + "/ajaxadmin",
      method: "POST",
      data: {
        value: null,
        postId: postId,
      },
      success: function (data) {
        fillForm(data.infor_form);
      },
    });

    $(".btn-approve").click(function (e) {
      functionBtn("approve", postId);
    });
  });

  $(".btn-edit").click(function (e) {
    console.log("edit");
  });

  $(".btn-delete").click(function (e) {
    console.log("delete");
  });

  function functionBtn(value = null, postId) {
    if (currentAjaxRequest) {
      currentAjaxRequest.abort();
    }

    currentAjaxRequest = $.ajax({
      url: root + "/ajaxadmin",
      method: "POST",
      data: {
        value: value,
        postId: postId,
      },
      success: function () {
        location.reload();
      },
      complete: () => {
        currentAjaxRequest = null;
      },
    });
  }

  function fillForm(inforForm) {
    $('[name="name"]').val(inforForm.name);
    $('[name="scientific_name"]').val(inforForm.scientific_name);
    $('[name="image_url"]').val(inforForm.image_url);
    $('[name="characteristic"]').val(inforForm.characteristic);
    if (inforForm.type === "animal") {
      $("#behavior").show();
      $('[name="behavior"]').val(inforForm.behavior);
    } else {
      $("#behavior").hide();
    }
    $('[name="habitat"]').val(inforForm.habitat);
  }
});
