var town_info;
var ranking;
var resourcesInterval = null;
var upgradeTimers = [];
const ERROR_DEFAULT = $("#game_alert").attr("data-default-error");
const FREQUENCY_RESOURCES_UPDATE = 60000;

$(document).ajaxStart(function () {
    $("#loading").css("display", "block");
});
$(document).ajaxComplete(function () {
    $("#loading").css("display", "none");
});

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if ($("#main-game").length) {
        getTownData();

        $('#building_info').on('hide.bs.modal', function (e) {
            $(this).attr("data-buildingid", "");
        })

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
    clearUpgradeTimers();
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
    town_info.buildings.forEach(building => {
        let buildingDiv = $(document.createElement("div"))
            .addClass("building")
            .attr("id", building.name.toLowerCase().replace(' ', "_"))
            .attr("data-building-name", building.name)
            .attr("data-id", building.building_level_id)
            .attr("data-upgrading", building.upgrade_time_left > 0)
            .css('background-image', 'url(../images/buildings/' + building.sprite + ')');

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
        showBuildingInfo(parseInt($(this).attr('data-id')));
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

function showBuildingInfo(buildingId) {
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
    $('#next_level').css("display", building.has_next ? "block" : "none");

    $('#time_left').html(formatTime(building.upgrade_time_left));
    $('#time_left_container').css("display", building.upgrade_time_left > 0 ? "inline" : "none");

    $('#upgrade_button').attr("disabled", !building.has_next || building.upgrade_time_left > 0);

    $("#building_info").attr("data-buildingid", buildingId).modal('show');
}

function hideBuildingInfo() {
    $("#building_info").modal('hide');
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
    hideBuildingInfo();
    clearUpgradeTimers();
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
            paintRanking();
        }
    });
}

function paintRanking() {
    let tableContent = $("#ranking table>tbody");
    ranking.forEach(function (user, index) {
        let row = $(document.createElement("tr"))
            .append($(document.createElement("th"))
                .attr("scope", "row")
                .text(index + 1)
            )
            .append($(document.createElement("td"))
                .text(user.name)
            )
            .append($(document.createElement("td"))
                .text(user.town_name)
            )
            .append($(document.createElement("td"))
                .text(user.score)
            );
        tableContent.append(row);
    });
}