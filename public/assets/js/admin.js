$(document).ready(() => {
  let currentAjaxRequest;
  let type = "Animal";

  $(".btn-add").on("click", function (e) {
    e.preventDefault();

    $(".the-title").text("New " + type);
    var formElements = $('form[name="feedback-form"]').find("input, textarea");

    if (type === "Animal") {
      $("#behavior").show();
    } else {
      $("#behavior").hide();
    }

    $(".btn-approve, .btn-reject, .btn-delete").hide();
    $(".btn-edit")
      .removeClass("edit border-dark text-dark")
      .addClass("border-success text-success");
    $(".btn-edit").html('<i class="fa-solid fa-check pe-2"></i>Save');

    formElements.prop("disabled", false);

    $('form[name="feedback-form"]')
      .off("submit")
      .on("submit", function (e) {
        e.preventDefault();

        let formData = new FormData($(this)[0]);
        formData.append("directory", type.toLowerCase());
        formData.append("query", "insert");

        submitCreature(formData);
        $("#modalInfor").modal("hide");
      });
  });

  // View post modal
  $(".view-post").click(function (e) {
    e.preventDefault();

    let username = $(this).closest("tr").find("td:first-child").text();
    $(".the-title").text("Contributed by " + username);

    $('input[name="image"]').hide();
    $(".btn-edit, .btn-delete").hide();
    $(".btn-approve, .btn-reject").show();

    let postId = $(this).data("post-id");
    let type = $(this).data("post-type");

    handleAjaxRequest(
      "/ajaxAdmin",
      "POST",
      { value: null, postId },
      function (response) {
        fillForm(response.infor_form);
      }
    );

    $(".btn-approve").one("click", function (e) {
      let form = $('form[name="feedback-form"]');
      form.find("input, textarea").prop("disabled", false);

      form.submit();
    });

    $(".btn-reject").one("click", function (e) {
      functionBtn("reject", postId);
    });

    $('form[name="feedback-form"]')
      .off("submit")
      .on("submit", function (e) {
        e.preventDefault();

        let formData = new FormData($(this)[0]);
        formData.append("directory", type.toLowerCase());
        formData.append("query", "insert");

        submitCreature(formData);

        functionBtn("approve", postId);
      });
  });

  // View creature modal
  $("#creaturesInfor")
    .off("click", ".view-creature")
    .on("click", ".view-creature", function (e) {
      e.preventDefault();

      resetModal();

      $('input[name="image"]').hide();
      $(".btn-edit, .btn-delete").show();
      $(".btn-approve, .btn-reject").hide();

      let scientificName = $(this).data("scientific-name");
      let type = $(this).data("type");

      $(".the-title").text(type);

      handleAjaxRequest(
        "/ajaxAdmin",
        "POST",
        { scientificName, type: type.toLowerCase() },
        function (response) {
          fillForm(response.creature);
        }
      );

      $('form[name="feedback-form"]')
        .off("submit")
        .on("submit", function (e) {
          e.preventDefault();

          let formData = new FormData($(this)[0]);
          formData.append("directory", type.toLowerCase());
          formData.append("oldName", scientificName);
          formData.append("query", "update");

          submitCreature(formData);
          $('form[name="feedback-form"]')
            .find("input, textarea")
            .prop("disabled", true);
        });

      $(".btn-delete")
        .off("click")
        .one("click", function () {
          deleteCreature("delete", scientificName, type);
        });
    });

  function functionBtn(value = null, postId) {
    handleAjaxRequest("/ajaxAdmin", "POST", { value, postId }, function () {
      location.reload();
    });
  }

  function deleteCreature(value = null, scientificName, type) {
    handleAjaxRequest(
      "/ajaxAdmin",
      "POST",
      { value, scientificName, creatureType: type },
      function (response) {
        $("#modalInfor").modal("hide");
        updateCreaturesTable(response.creatures, type);

        if (type === "Animal") {
          $(".insights li:eq(2) h3").text(response.total);
        } else {
          $(".insights li:eq(3) h3").text(response.total);
        }
      }
    );
  }

  function submitCreature(formData) {
    if (currentAjaxRequest) {
      currentAjaxRequest.abort();
    }

    currentAjaxRequest = $.ajax({
      url: root + "/ajaxAdmin",
      method: "POST",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      success: function (response) {
        updateCreaturesTable(response.creatures, type);
      },
      error: function (xhr, status, error) {
        console.error("AJAX request failed:", xhr, status, error);
      },
      complete: () => {
        currentAjaxRequest = null;
      },
    });
  }

  // Toggle status form
  $("#statusForm").on("click", "a", function () {
    var selectedValue = $(this).text();
    $("#statusBtn").text(selectedValue);

    handleAjaxRequest(
      "/ajaxAdmin",
      "POST",
      { status: selectedValue.toLowerCase() },
      function (response) {
        updatePostsTable(response.table_form);
      }
    );
  });

  // Toggle radio button Animal and Plant
  $('input[name="type"]')
    .off("change")
    .on("change", function () {
      type = $(this).val();

      handleAjaxRequest(
        "/ajaxAdmin",
        "POST",
        { type: type.toLowerCase() },
        function (response) {
          updateCreaturesTable(response.creatures, type);
        }
      );
    });

  function handleAjaxRequest(url, method, data, successCallback) {
    if (currentAjaxRequest) {
      currentAjaxRequest.abort();
    }

    currentAjaxRequest = $.ajax({
      url: root + url,
      method: method,
      data: data,
      success: successCallback,
      complete: () => {
        currentAjaxRequest = null;
      },
    });
  }
});

// Util function
function resetModal() {
  let formElements = $('form[name="feedback-form"]').find("input, textarea");

  $(".btn-edit")
    .addClass("edit border-dark text-dark")
    .removeClass("border-success text-success");
  $(".btn-edit").html('<i class="fa-solid fa-wrench pe-2"></i>Edit');

  formElements.prop("disabled", true);
}

function fillForm(inforForm) {
  $('[name="name"]').val(inforForm.name);
  $('[name="scientific_name"]').val(inforForm.scientific_name);

  $('[name="image_path"]').val(inforForm.image);
  $("#img-preview").attr("src", inforForm.image);

  $('[name="province"]').val(inforForm.provinces.join(", "));
  $('[name="characteristic"]').val(inforForm.characteristic);
  if (inforForm.type === "animal") {
    $("#behavior").show();
    $('[name="behavior"]').val(inforForm.behavior);
  } else {
    $("#behavior").hide();
    $('[name="behavior"]').val("");
  }
  $('[name="habitat"]').val(inforForm.habitat);
}

function updatePostsTable(posts) {
  bodyTable = $("#formInfor").empty();
  if (posts.length > 0) {
    posts.forEach((post) => {
      var newRow = `<tr>
            <td>${post.username}</td>
            <td>${post.name}</td>
            <td>${post.submission_date}</td>
            <td><span class='status ${post.status.toLowerCase()}'>${
        post.status
      }</span></td>
            <td><a href='#' class='view-post' data-bs-toggle='modal' data-bs-target='#modalInfor' data-post-id='${
              post.id
            }' data-post-type='${post.type}'>View</a></td>
        </tr>`;

      bodyTable.append(newRow);
    });
  } else {
    var noPostsRow =
      "<tr><td colspan='5' class='text-center'>No posts available</td></tr>";
    bodyTable.html(noPostsRow);
  }
}

function updateCreaturesTable(creatures, type) {
  $(".creature-title").text(type);
  bodyTable = $("#creaturesInfor").empty();
  if (creatures.length > 0) {
    creatures.forEach((creature) => {
      var newRow = `<tr class="position-relative">
          <td class="hidden">${creature.image}</td>
          <td>${creature.name}</td>
          <td>${creature.scientific_name}</td>
          <td>${creature.update_date}</td>
          <td><a href='#' class='view-creature' data-bs-toggle='modal' data-bs-target='#modalInfor' data-type='${type}' data-scientific-name='${creature.scientific_name}'>View</a></td>
      </tr>`;

      bodyTable.append(newRow);
    });
  } else {
    var noPostsRow =
      "<tr><td colspan='5' class='text-center'>No creatures available</td></tr>";
    bodyTable.html(noPostsRow);
  }
}
