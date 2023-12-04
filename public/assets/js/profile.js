// Dropdown in form
var wrapper = $(".wrapper");
var selectBtn = wrapper.find(".select-btn");
var searchInput = wrapper.find("input");
var creatureList = wrapper.find(".options");

selectBtn.on("click", () => {
  wrapper.toggleClass("active");
});

searchInput.on("input", () => {
  const searchTerm = searchInput.val().toLowerCase();
  const filteredCreatures = creatures.filter((creature) =>
    creature.name.toLowerCase().startsWith(searchTerm)
  );

  updateCreatureList(filteredCreatures);
});

creatureList.on("click", "li", function () {
  const clickedCreatureName = $(this).text();

  selectBtn.find("span").text(clickedCreatureName);

  const clickedCreatureId = $(this).data("id");

  getInforCreature(clickedCreatureId);

  wrapper.toggleClass("active");
});

function updateCreatureList(creatures) {
  creatureList.empty();
  creatures.forEach((creature) => {
    let li = `<li data-id="${creature.id}">${creature.name} (${creature.scientific_name})</li>`;
    creatureList.append(li);
  });
}

// Ajax Profile
let currentAjaxRequest;

const getInforCreature = (id) => {
  if (currentAjaxRequest) {
    currentAjaxRequest.abort();
  }

  currentAjaxRequest = $.ajax({
    url: root + "/ajaxprofile",
    method: "POST",
    data: {
      id: id,
    },
    success: (response) => {
      $(".form-information").addClass("active");

      updateInforForm(response.infor_creature);
    },
    complete: () => {
      currentAjaxRequest = null;
    },
  });
};

const updateInforForm = (creatureInfo) => {
  const submissionDate = new Date(creatureInfo.submission_date);
  const formattedSubmissionDate = `${submissionDate.getDate()}/${
    submissionDate.getMonth() + 1
  }/${submissionDate.getFullYear()}`;
  $(".form-information .row:eq(0) .col:eq(0) input").val(
    "Ngày " + formattedSubmissionDate
  );

  $(".form-information .row:eq(0) .col:eq(1) input").val(
    getStatusDisplay(creatureInfo.status)
  );

  $("input[name='province']").val(creatureInfo.provinces.join(", "));

  $("textarea[name='characteristic']").val(creatureInfo.characteristic);

  if (creatureInfo.type === "animal") {
    $("textarea[name='behavior']").val(creatureInfo.behavior);
    $("#behavior").show();
  } else {
    $("#behavior").hide();
  }

  $("textarea[name='habitat']").val(creatureInfo.habitat);
};

const getStatusDisplay = (status) => {
  switch (status) {
    case "pending":
      return "Đang chờ phê duyệt";
    case "approved":
      return "Đã chấp nhận";
    case "rejected":
      return "Từ chối";
    default:
      return status;
  }
};
