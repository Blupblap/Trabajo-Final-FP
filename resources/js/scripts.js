var town_info;
const ERROR_DEFAULT = $("#game_alert").attr("data-default-error");
const FREQUENCY_RESOURCES_UPDATE = 60000;

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if ($(".main-game").length) {
        getData();

        $(document).click(function (event) {
            if (!$(event.target).closest($(".building")).length) {
                $('#building_info').slideUp(300);
                $('#building_info').attr("data-buildingid", "");
            }
        });


        $("#upgrade_button").click(function () {
            upgradeBuilding($('#building_info').attr("data-buildingid"));
        });
    }
});

function getData() {
    $.ajax({
        type: 'GET',
        url: '/ajax/town',
        dataType: "json",
        success: function (data) {
            town_info = data;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showMessage('Error: ' + textStatus + '. ' + errorThrown);
        },
        complete: function () {
            if (!town_info || !town_info.buildings || !town_info.buildings.length) { return }
            paint();
            animateResources();
        }
    });
}

function animateResources() {
    setInterval(() => {
        town_info.buildings.forEach(building => {
            town_info.food += building.food_per_minute;
            town_info.wood += building.wood_per_minute;
            town_info.stone += building.stone_per_minute;
            town_info.gold += building.gold_per_minute;
        });
        paintResources();
    }, FREQUENCY_RESOURCES_UPDATE);
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

    town_info.buildings.forEach(building => {
        buildingDiv = $(document.createElement("div"))
            .addClass("building")
            .attr("id", building.name.toLowerCase().replace(' ', "_"))
            .attr("data-building-name", building.name)
            .attr("data-id", building.building_level_id)
            .attr("data-upgrading", building.upgrade_time_left > 0)
            .append($(document.createElement("h6"))
                .addClass(building.name.toLowerCase().replace(' ', "_"))
                .text(building.name)
            );
        addEvents(buildingDiv);

        $(".main-game").append(buildingDiv)
    });
}

function addEvents(building) {
    building.hover(function () {
        $(".nametag").text($(this).attr("data-building-name")).show(100);
    }, function () {
        $(".nametag").hide(100);
    });
    building.click(function () {
        toggleBuildingInfo($(this).attr('data-id'));
    });
}

function toggleBuildingInfo(buildingId) {
    if ($("#building_info").attr("data-buildingid") == buildingId) {
        hideBuildingInfo();
        return;
    }

    showBuildingInfo(buildingId);
}

function showBuildingInfo(buildingId) {
    $("#building_info").slideUp(300, function () {
        const building = town_info.buildings.find(b => b.building_level_id == buildingId);

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

        $(this).attr("data-buildingid", buildingId).slideDown(300);
    });
}

function hideBuildingInfo() {
    $("#building_info").attr("data-buildingid", "").slideUp(300);
}

function upgradeBuilding(id) {
    if (town_info.buildings.find(building => building.building_level_id == id).upgrade_time_left > 0) {
        showMessage();
        return;
    }
    const url = '/ajax/building';
    const dataToSend = { 'building_level_id': id };
    $.ajax({
        type: 'PUT',
        url: url,
        data: dataToSend,
        dataType: 'json',
        success: function (data) {
            if (data.error) {
                showMessage(data.error);
                return;
            }
            town_info = data;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showMessage('Error: ' + textStatus + '; ' + errorThrown);
        },
        complete: function () {
            if (!town_info || !town_info.buildings || !town_info.buildings.length) { return }
            paint();
        }
    });
}

function showMessage(msg = ERROR_DEFAULT, isError = true) {
    $("#game_alert")
        .html(msg)
        .addClass(isError ? "alert-danger" : "alert-success")
        .fadeIn();

    setTimeout(() => $("#game_alert").fadeOut(), 3000);
}