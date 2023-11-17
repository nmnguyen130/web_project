var currentAjaxRequest;

const btnMore = $("#more-btn");
var listNumber = 6;
var creatureList;
var listNumberMax;
var currentCreature = {};
var creatureContainer = $("#creature-list").empty();

function sendData(provinceName) {
  if (currentAjaxRequest) {
    currentAjaxRequest.abort();
  }

  currentAjaxRequest = $.ajax({
    url: root + "/ajax",
    method: "POST",
    data: {
      provinceName: provinceName,
      type: "getCreatureOfProvince",
    },
    success: function (response) {
      $(".text-show").addClass("hidden");
      $(".card").removeClass("hidden");
      $(".btn-container").removeClass("hidden");
      btnMore.addClass("hidden");

      var creatureInfo = response.animal_info;
      currentCreature = {
        image_url: creatureInfo.image_url,
        name: creatureInfo.name,
        scientific_name: creatureInfo.scientific_name,
      };

      $("#image").attr("src", creatureInfo.image_url);
      $("#province_name").text(provinceName);
      $("#name").text(
        creatureInfo.name +
          " (tên khoa học: " +
          creatureInfo.scientific_name +
          ")"
      );
      $("#characteristic").html(
        "<b>Đặc điểm: </b>" + creatureInfo.characteristic
      );
      $("#behavior").html("<b>Tập tính: </b>" + creatureInfo.behavior);
      $("#habitat").html("<b>Môi trường sống: </b>" + creatureInfo.habitat);

      // Update Province has Animal
      var provinceHasAnimal = response.animal_province;

      var provinceListHTML = "<b>Có thể tìm thấy ở: </b>";
      for (var i = 0; i < provinceHasAnimal.length; i++) {
        provinceListHTML +=
          "<a href='#' class='province-link'>" +
          provinceHasAnimal[i].name +
          "</a>";
        if (i < provinceHasAnimal.length - 1) {
          provinceListHTML += ", ";
        }
      }
      $("#province_list").html(provinceListHTML);

      $("#province_list")
        .off("click", ".province-link")
        .on("click", ".province-link", function (e) {
          var provinceValue = $(this).text();

          zoomToProvince(provinceValue);
          sendData(provinceValue);
        });

      // Add others animal of current province
      $("#list-title").text("Những sinh vật khác thuộc " + provinceName + ":");

      creatureList = response.animal_list;
      creatureContainer.empty();

      listNumberMax = creatureList.length;
      listNumber = 6;
      listNumber = listNumberMax > listNumber ? listNumber : listNumberMax;

      for (var i = 0; i < listNumber; i++) {
        createCreatureCard(creatureList[i], creatureContainer);
      }

      if (listNumberMax > listNumber) {
        btnMore.removeClass("hidden");
      }
    },
    complete: function () {
      currentAjaxRequest = null;
    },
  });
}

function createCreatureCard(creature, creatureContainer) {
  var colDiv = $("<div>").addClass("col");

  var cardDiv = $("<div>").addClass("card bg-dark text-white");
  var img = $("<img>")
    .addClass("card-img")
    .attr("src", creature.image_url)
    .attr("alt", creature.name);
  var cardOverlayDiv = $("<div>").addClass("card-img-overlay");
  var title = $("<h6>")
    .addClass("card-title")
    .text(creature.name + " (" + creature.scientific_name + ")");

  cardOverlayDiv.append(title);
  cardDiv.append(img).append(cardOverlayDiv);

  var animalLink = $("<a>")
    .attr("href", "#")
    .addClass("link")
    .append(cardDiv)
    .click(() => {
      getDetailCreature(creature.scientific_name);

      colDiv.remove();
    });

  colDiv.append(animalLink);

  creatureContainer.append(colDiv);
}

function getDetailCreature(scientific_name) {
  $.ajax({
    url: root + "/ajax",
    method: "POST",
    data: {
      scientificName: scientific_name,
      type: "getDetailCreature",
    },
    success: function (response) {
      // Add the current creature into card
      createCreatureCard(currentCreature, creatureContainer);

      var creatureInfo = response.animal_detail;

      currentCreature = {
        image_url: creatureInfo.image_url,
        name: creatureInfo.name,
        scientific_name: creatureInfo.scientific_name,
      };

      $("#image").attr("src", creatureInfo.image_url);
      $("#name").text(
        creatureInfo.name +
          " (tên khoa học: " +
          creatureInfo.scientific_name +
          ")"
      );
      $("#characteristic").html(
        "<b>Đặc điểm: </b>" + creatureInfo.characteristic
      );
      $("#behavior").html("<b>Tập tính: </b>" + creatureInfo.behavior);
      $("#habitat").html("<b>Môi trường sống: </b>" + creatureInfo.habitat);
    },
  });
}

// Button Show more Creature
btnMore.click(() => {
  var creatureContainer = $("#creature-list");

  for (var i = listNumber; i < listNumberMax; i++) {
    createCreatureCard(creatureList[i], creatureContainer);
  }

  btnMore.addClass("hidden");
});
