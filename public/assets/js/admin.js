$(document).ready(() => {
  let currentAjaxRequest;

  // View post modal
  $(".view-post").click(function (e) {
    e.preventDefault();

    var postId = $(this).data("post-id");

    $.ajax({
      url: root + "/ajaxAdmin",
      method: "POST",
      data: {
        value: null,
        postId: postId,
      },
      success: function (response) {
        fillForm(response.infor_form);
      },
    });

    $(".btn-approve").one("click", function (e) {
      functionBtn("approve", postId);
    });

    $(".btn-reject").one("click", function (e) {
      functionBtn("reject", postId);
    });
  });

  function functionBtn(value = null, postId) {
    if (currentAjaxRequest) {
      currentAjaxRequest.abort();
    }

    currentAjaxRequest = $.ajax({
      url: root + "/ajaxAdmin",
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

  // Toggle status form
  $("#statusForm").on("click", "a", function () {
    var selectedValue = $(this).text();
    $("#statusBtn").text(selectedValue);

    $.ajax({
      url: root + "/ajaxAdmin",
      method: "POST",
      data: {
        status: selectedValue.toLowerCase(),
      },
      success: function (response) {
        posts = response.table_form;

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
            }'>View</a></td>
        </tr>`;

            bodyTable.append(newRow);
          });
        } else {
          var noPostsRow =
            "<tr><td colspan='5' class='text-center'>No posts available</td></tr>";
          bodyTable.html(noPostsRow);
        }
      },
    });
  });

  // Toggle radio button Animal and Plant
  $('input[name="type"]').change(function () {
    var selectedType = $(this).val().toLowerCase();

    $.ajax({
      url: root + "/ajaxAdmin",
      method: "POST",
      data: {
        type: selectedType,
      },
      success: function (response) {
        creatures = response.creatures;

        bodyTable = $("#creaturesInfor").empty();
        if (creatures.length > 0) {
          creatures.forEach((creature) => {
            var newRow = `<tr>
            <td>${creature.name}</td>
            <td>${creature.scientific_name}</td>
            <td>${creature.update_date}</td>
            <td><a href='#' class='view-post' data-bs-toggle='modal' data-bs-target='#modalInfor' data-post-id='${creature.id}'>View</a></td>
        </tr>`;

            bodyTable.append(newRow);
          });
        } else {
          var noPostsRow =
            "<tr><td colspan='5' class='text-center'>No creatures available</td></tr>";
          bodyTable.html(noPostsRow);
        }
      },
    });
  });
});
