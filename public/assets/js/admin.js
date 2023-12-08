$(document).ready(() => {
  let currentAjaxRequest;

  // View post modal
  $(".view-post").click(function (e) {
    e.preventDefault();

    $(".btn-edit").hide();
    $(".btn-approve, .btn-reject").show();

    var postId = $(this).data("post-id");

    if (currentAjaxRequest) {
      currentAjaxRequest.abort();
    }

    currentAjaxRequest = $.ajax({
      url: root + "/ajaxAdmin",
      method: "POST",
      data: {
        value: null,
        postId: postId,
      },
      success: function (response) {
        fillForm(response.infor_form);
      },
      complete: () => {
        currentAjaxRequest = null;
      },
    });

    $(".btn-approve").one("click", function (e) {
      functionBtn("approve", postId);
    });

    $(".btn-reject").one("click", function (e) {
      functionBtn("reject", postId);
    });
  });

  // View creature modal
  $("#creaturesInfor").on("click", ".view-creature", function (e) {
    e.preventDefault();

    $(".btn-edit").show();
    $(".btn-approve, .btn-reject").hide();

    var scientificName = $(this).data("scientific-name");
    var type = $(this).data("type");

    if (currentAjaxRequest) {
      currentAjaxRequest.abort();
    }

    currentAjaxRequest = $.ajax({
      url: root + "/ajaxAdmin",
      method: "POST",
      data: {
        scientificName: scientificName,
        type: type,
      },
      success: function (response) {
        fillForm(response.creature);
      },
      complete: () => {
        currentAjaxRequest = null;
      },
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
        updatePostsTable(response.table_form);
      },
    });
  });

  // Toggle radio button Animal and Plant
  $('input[name="type"]').change(function () {
    var selectedType = $(this).val().toLowerCase();

    if (currentAjaxRequest) {
      currentAjaxRequest.abort();
    }

    currentAjaxRequest = $.ajax({
      url: root + "/ajaxAdmin",
      method: "POST",
      data: {
        type: selectedType,
      },
      success: function (response) {
        updateCreaturesTable(response.creatures, selectedType);
      },
      complete: () => {
        currentAjaxRequest = null;
      },
    });
  });
});

// Util function
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
            }'>View</a></td>
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
  bodyTable = $("#creaturesInfor").empty();
  if (creatures.length > 0) {
    creatures.forEach((creature) => {
      var newRow = `<tr>
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
