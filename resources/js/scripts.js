var town_info;
var ranking;
var resourcesInterval = null;
var upgradeTimers = [];
const ERROR_DEFAULT = $("#game_alert").attr("data-default-error");
const FREQUENCY_RESOURCES_UPDATE = 60000;

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if ($("#main-game").length) {
        getTownData();

        $(document).click(function (event) {
            if (!$(event.target).closest($(".building")).length) {
                $('#building_info').slideUp(300);
                $('#building_info').attr("data-buildingid", "");
            }
        });

        $("#upgrade_button").click(function () {
            let id = $('#building_info').attr("data-buildingid");
            if ($('.building[data-id="' + id + '"]').attr('data-upgrading') === 'true') {
                showMessage();
                return;
            }

            upgradeBuilding(id);
        });
    }

    if ($("#ranking").length) {
        getRankingData();
    }
});

function getTownData() {
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
            paintTown();
        }
    });
}

function paintTown() {
    if (!town_info || !town_info.buildings || !town_info.buildings.length) { return }
    paintResources();
    paintBuildings();
    animateResources();
}

function paintResources() {
    $("#amount_food").html(town_info.food);
    $("#amount_wood").html(town_info.wood);
    $("#amount_stone").html(town_info.stone);
    $("#amount_gold").html(town_info.gold);
}

function paintBuildings() {
    $(".building").remove();
    clearUpgradeTimers();
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

        $("#main-game").append(buildingDiv)
        setUpgradeTimer(building);
    });
}

function clearUpgradeTimers() {
    upgradeTimers.forEach(interval => {
        clearInterval(interval);
    });
    upgradeTimers = [];
}

function setUpgradeTimer(building) {
    if (building.upgrade_time_left <= 0) {
        return;
    }

    let timer = setInterval(() => {
        building.upgrade_time_left -= building.upgrade_time_left > 0 ? 1 : 0;
        let info_building_id = parseInt($('#building_info').attr("data-buildingid"));

        if (info_building_id === building.building_level_id) {
            $('#time_left').html(formatTime(building.upgrade_time_left));
        }
        if (building.upgrade_time_left === 0) {
            if (info_building_id === building.building_level_id) {
                hideBuildingInfo();
            }
            getTownData();
            clearInterval(timer);
        }

    }, 1000);
    upgradeTimers.push(timer);
}

function addEvents(building) {
    building.hover(function () {
        $(".nametag").text($(this).attr("data-building-name")).show(100);
    }, function () {
        $(".nametag").hide(100);
    });
    building.click(function () {
        toggleBuildingInfo(parseInt($(this).attr('data-id')));
    });
}

function animateResources() {
    clearInterval(resourcesInterval);
    resourcesInterval = setInterval(() => {
        town_info.buildings.forEach(building => {
            town_info.food += building.food_per_minute;
            town_info.wood += building.wood_per_minute;
            town_info.stone += building.stone_per_minute;
            town_info.gold += building.gold_per_minute;
        });
        paintResources();
    }, FREQUENCY_RESOURCES_UPDATE);
}

function toggleBuildingInfo(buildingId) {
    if (parseInt($("#building_info").attr("data-buildingid")) === buildingId) {
        hideBuildingInfo();
        return;
    }

    showBuildingInfo(buildingId);
}

function showBuildingInfo(buildingId) {
    $("#building_info").slideUp(300, function () {
        const building = town_info.buildings.find(b => b.building_level_id === buildingId);

        $("#info_name").html(building.name);
        $("#info_level").html(building.level);
        $("#food_per_minute").html(building.food_per_minute);
        $("#wood_per_minute").html(building.wood_per_minute);
        $("#stone_per_minute").html(building.stone_per_minute);
        $("#gold_per_minute").html(building.gold_per_minute);
        $("#info_power").html(building.power);

        $("#food_cost").html(building.required_food);
        $("#wood_cost").html(building.required_wood);
        $("#stone_cost").html(building.required_stone);
        $("#gold_cost").html(building.required_gold);
        $("#th_req").html(building.level_town_hall);
        $("#construction_duration").html(formatTime(building.upgrade_duration * 60));
        $('#next_level').css("display", building.has_next > 0 ? "block" : "none");

        $('#time_left').html(formatTime(building.upgrade_time_left));
        $('#time_left_container').css("display", building.upgrade_time_left > 0 ? "inline" : "none");

        $('#upgrade_button').attr("disabled", building.upgrade_time_left > 0);

        $(this).attr("data-buildingid", buildingId).slideDown(300);
    });
}

function hideBuildingInfo() {
    $("#building_info").attr("data-buildingid", "").slideUp(300);
}

function formatTime(timeSeconds) {
    let seconds = timeSeconds % 60;
    let secondsString = seconds > 0 ? (seconds + "s") : "";

    let minutes = (timeSeconds - seconds) / 60;
    let minutesString = minutes % 60 > 0 ? ((minutes % 60) + "min") : "";

    let hours = (minutes - (minutes % 60)) / 60;
    let hoursString = hours > 0 ? (hours + "h") : "";

    return hoursString + " " + minutesString + " " + secondsString;
}

function upgradeBuilding(id) {
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
            paintTown();
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

function getRankingData() {
    $.ajax({
        type: 'GET',
        url: '/ajax/ranking',
        dataType: "json",
        success: function (data) {
            ranking = data;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showMessage('Error: ' + textStatus + '. ' + errorThrown);
        },
        complete: function () {
            console.log(ranking);
        }
    });
}