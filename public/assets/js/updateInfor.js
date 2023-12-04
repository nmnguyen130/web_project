let currentAjaxRequest;

const btnMore = $("#more-btn");
const creatureContainer = $("#creature-list").empty();
let type = "animal";
let provinceName;

let listNumber = 6;
let creatureList = [];
let listNumberMax;
let currentCreature = {};

const updateType = (newType) => {
  type = newType;
};

const sendData = (province, creatureType = type) => {
  if (currentAjaxRequest) {
    currentAjaxRequest.abort();
  }

  currentAjaxRequest = $.ajax({
    url: root + "/ajaxmap",
    method: "POST",
    data: {
      provinceName: province,
      functionType: "getCreatureOfProvince",
      creatureType,
    },
    success: (response) => {
      $(".text-show").addClass("hidden");
      $("#province_name").removeClass("hidden");
      $(".card, .btn-container").removeClass("hidden");
      btnMore.addClass("hidden");

      provinceName = province;

      updateCreatureInformation(response.creature_info);
      updateProvinceList(response.creature_province);

      listTitle = creatureType === "animal" ? "động vật" : "thực vật";
      $("#list-title").text(`Những ${listTitle} khác thuộc ${provinceName}:`);
      updateCreatureList(response.creature_list);
    },
    complete: () => {
      currentAjaxRequest = null;
    },
  });
};

const getDetailCreature = (scientific_name, creatureType = type) => {
  if (currentAjaxRequest) {
    currentAjaxRequest.abort();
  }

  currentAjaxRequest = $.ajax({
    url: root + "/ajaxmap",
    method: "POST",
    data: {
      scientificName: scientific_name,
      functionType: "getDetailCreature",
      creatureType,
    },
    success: (response) => {
      createCreatureCard(currentCreature, creatureContainer);

      var creatureInfo = response.creature_detail;

      updateCreatureInformation(creatureInfo);
    },
    error: function (xhr, status, error) {
      console.error("Error in getDetailCreature:", status, error);
    },
    complete: () => {
      currentAjaxRequest = null;
    },
  });
};

const updateCreatureInformation = (creatureInfo) => {
  currentCreature = {
    image_url: creatureInfo.image_url,
    name: creatureInfo.name,
    scientific_name: creatureInfo.scientific_name,
  };

  $("#image").attr("src", creatureInfo.image_url);
  $("#province_name, #name").text(provinceName);
  $("#name").html(
    `${creatureInfo.name} (tên khoa học: ${creatureInfo.scientific_name})`
  );
  $("#characteristic").html(`<b>Đặc điểm: </b>${creatureInfo.characteristic}`);
  if (type === "animal") {
    $("#behavior").html(`<b>Tập tính: </b>${creatureInfo.behavior}`);
  } else {
    $("#behavior").html("");
  }
  $("#habitat").html(`<b>Môi trường sống: </b>${creatureInfo.habitat}`);
};

const updateProvinceList = (provinceHasCreature) => {
  const provinceListHTML = provinceHasCreature
    .map((province) => `<a href='#' class='province-link'>${province.name}</a>`)
    .join(", ");

  $("#province_list").html(`<b>Có thể tìm thấy ở: </b>${provinceListHTML}`);

  $("#province_list")
    .off("click", ".province-link")
    .on("click", ".province-link", (e) => {
      const provinceValue = $(e.target).text();
      zoomToProvince(provinceValue);
      sendData(provinceValue);
    });
};

const updateCreatureList = (creatures) => {
  creatureList = creatures;
  creatureContainer.empty();

  listNumberMax = Math.min(creatureList.length, listNumber);

  for (let i = 0; i < listNumberMax; i++) {
    createCreatureCard(creatureList[i], creatureContainer);
  }

  if (listNumberMax < creatureList.length) {
    btnMore.removeClass("hidden");
  }
};

const createCreatureCard = (creature, container) => {
  const colDiv = $("<div>").addClass("col");
  const cardDiv = $("<div>").addClass("card bg-dark text-white");
  const img = $("<img>")
    .addClass("card-img")
    .attr("src", creature.image_url)
    .attr("alt", creature.name);
  const cardOverlayDiv = $("<div>").addClass("card-img-overlay");
  const title = $("<h6>")
    .addClass("card-title")
    .text(`${creature.name} (${creature.scientific_name})`);

  cardOverlayDiv.append(title);
  cardDiv.append(img).append(cardOverlayDiv);

  const animalLink = $("<a>")
    .attr("href", "#")
    .addClass("link")
    .append(cardDiv)
    .click(() => {
      getDetailCreature(creature.scientific_name);
      colDiv.remove();
    });

  colDiv.append(animalLink);
  container.append(colDiv);
};

// Button Show more Creature
btnMore.click(() => {
  if (creatureList.length > listNumberMax) {
    for (let i = listNumberMax; i < creatureList.length; i++) {
      createCreatureCard(creatureList[i], creatureContainer);
    }

    btnMore.addClass("hidden");
  }
});

// Button change Animal OR Plant
$(".btn-container").on("click", ".custom-btn", function () {
  var $this = $(this);
  type = $this.text().trim().toLowerCase() === "động vật" ? "animal" : "plant";

  if ($this.hasClass("btn-primary")) {
    $(".custom-btn").toggleClass("btn-primary btn-secondary");

    sendData(provinceName, type);
  }
});
