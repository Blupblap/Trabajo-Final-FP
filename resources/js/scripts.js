var town_info = {};
$(document).ready(function () {
  getData();
  $(document).click(function (event) {
    if (!$(event.target).closest($(".building")).length && !$(event.target).closest($("#upgrade_button")).length) {
      $('#building_info').slideUp(300);
      $('#building_info').attr("data-buildingid", "");
    }
  });
});

function getData() {
  $.ajax({
    type: 'GET',
    url: '/ajax/town',
    dataType: "json",
    success: function success(data) {
      town_info = data;
    },
    error: function error(_error) {
      console.log('Error: ' + _error);
    },
    complete: function complete() {
      paint();
    }
  });
}

function paint() {
  paintResources();
  paintBuildings();
}

function paintResources() {
  $("#amount_food").html(town_info.food);
  $("#amount_wood").html(town_info.wood);
  $("#amount_stone").html(town_info.stone);
  $("#amount_gold").html(town_info.gold);
}

function paintBuildings() {
  $(".building").remove();
  town_info.buildings.forEach(function (building) {
    buildingDiv = $(document.createElement("div")).addClass("building").attr("id", building.name.toLowerCase().replace(' ', "_")).attr("data-building-name", building.name).attr("data-id", building.building_level_id).append($(document.createElement("h6")).addClass(building.name.toLowerCase().replace(' ', "_")).text(building.name));
    buildingDiv.attr("data-upgrading", building.upgrade_time_left > 0);
    addEvents(buildingDiv);
    $(".main-game").append(buildingDiv);
  });
}

function addEvents(building) {
  building.hover(function () {
    $(".nametag").text($(this).attr("data-building-name"));
    $(".nametag").show(100);
  }, function () {
    $(".nametag").hide(100);
  });
  building.click(function () {
    if(building.attr("data-upgrading") == "false"){
      showInfo($(this).attr('data-id'));
    }else{
      showMessage("The building is being worked on!");
    }
  });
}

function showInfo(buildingId) {
  var info = $("#building_info");

  if ($(info).attr("data-buildingid") == buildingId) {
    $(info).attr("data-buildingid", "");
    $(info).slideUp(300);
  } else {
    $(info).slideUp(300, function () {
      var buildings = town_info.buildings;
      var building = buildings.find(function (b) {
        return b.building_level_id == buildingId;
      });
      $(info).attr("data-buildingid", buildingId);
      $("#info_name").html(building.name);
      $("#info_level").html(building.level);
      $("#info_power").html(building.power);
      $("#upgrade_level").html(building.level + 1);
      $("#food_cost").html(building.required_food);
      $("#wood_cost").html(building.required_wood);
      $("#stone_cost").html(building.required_stone);
      $("#gold_cost").html(building.required_gold);
      $("#th_req").html(building.level_town_hall);
      $("#construction_duration").html(building.upgrade_duration);
      $(info).slideDown(300);
    });
  }
}

$("#upgrade_button").click(function () {
  var id = $('#building_info').attr("data-buildingid");
  $.ajax({
    type: 'GET',
    url: '/ajax/building/' + id,
    dataType: "json",
    success: function success(data) {
      showMessage(data);
      getData();
    },
    error: function error(_error2) {
      console.log('Error: ' + _error2);
    }
  });
});

function showMessage(data){
  if(data === true){
    $("#popup").css("background-color", "green");
    $("#popup").html("Success!");
  }else{
    $("#popup").css("background-color", "red");
    $("#popup").html("You can't do that!");
  }
  
  $("#popup").show();
  setTimeout(function() { $("#popup").hide(); }, 3000);
}