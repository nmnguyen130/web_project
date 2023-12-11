$(document).ready(() => {
  let creatures;

  const storedName = sessionStorage.getItem("name");

  if (storedName) {
    findProvinces(storedName, "animal");
    sessionStorage.removeItem("name");
  }

  $(".search-icon").click(function () {
    clickOnSearch();
  });

  function clickOnSearch() {
    $(".search-bar").toggleClass("bar-show");
    $(".list-result").hide();
    $(".dropdown-text span").text("Choose:");
    if ($(".search-bar").has(".overflow-visible")) {
      $(".search-bar").removeClass("overflow-visible");
      $(".fa-chevron-down").removeClass("rotate-up");
      $(".dropdown-list").removeClass("list-show");
    }
  }

  $(".dropdown").click(function () {
    $(".dropdown-list").toggleClass("list-show");
    $(".fa-chevron-down").toggleClass("rotate-up");
    $(".search-bar").addClass("overflow-visible");
  });

  $(".dropdown-list-item").on("click", function () {
    var selectedItemText = $(this).text();

    $(".dropdown-text span").text(selectedItemText);

    showListResult(selectedItemText.toLowerCase());
  });

  $(".list-result").on("click", "li", function () {
    var scientificName = $(this).data("scientific-name");
    var type = $(this).data("type");

    findProvinces(scientificName, type);
  });

  $("#search-input").on("input", function () {
    var searchText = $(this).val().toLowerCase();

    const filteredCreatures = creatures.filter((creature) =>
      creature.name.toLowerCase().startsWith(searchText)
    );

    updateCreatureList(filteredCreatures);
  });

  function showListResult(selectedItem) {
    $.ajax({
      url: root + "/ajaxMap",
      method: "POST",
      data: {
        selectedItem: selectedItem,
      },
      success: function (response) {
        creatures = response.result;
        updateCreatureList(creatures);
      },
    });
  }

  function updateCreatureList(creatures) {
    let resultList = $(".list-result").empty().show();
    creatures.forEach((creature) => {
      let li = $("<li>")
        .text(`${creature.name} (${creature.scientific_name})`)
        .data("scientific-name", creature.scientific_name)
        .data("type", creature.type);
      resultList.append(li);
    });
  }

  function findProvinces(scientificName, type) {
    $.ajax({
      url: root + "/ajaxMap",
      method: "POST",
      data: {
        searchText: scientificName,
        type: type,
      },
      success: function (response) {
        $(".text-show").addClass("hidden");
        $("#province_name").addClass("hidden");
        $(".card, .btn-container").addClass("hidden");
        $(".card").first().removeClass("hidden");

        updateType(type);
        findAllProvinceBy(response.provinces);
        updateCreatureInformation(response.creature_detail);
        updateProvinceList(response.provinces);

        clickOnSearch();
        $(".search-bar").removeClass("bar-show");
      },
    });
  }
});
