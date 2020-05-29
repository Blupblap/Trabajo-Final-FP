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
            let id = $('#building_info').attr("data-buildingid");
            if ($('.building[data-id="' + id + '"]').attr('data-upgrading') === 'true') {
                showMessage();
                return;
            }

            upgradeBuilding(id);
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
        $("#food_per_minute").html(building.food_per_minute);
        $("#wood_per_minute").html(building.wood_per_minute);
        $("#stone_per_minute").html(building.stone_per_minute);
        $("#gold_per_minute").html(building.gold_per_minute);
        $("#info_power").html(building.power);

        if (building.has_next) {
            $('#next_level').show();
            $("#food_cost").html(building.required_food);
            $("#wood_cost").html(building.required_wood);
            $("#stone_cost").html(building.required_stone);
            $("#gold_cost").html(building.required_gold);
            $("#th_req").html(building.level_town_hall);
            $("#construction_duration").html(formatTime(building.upgrade_duration * 60));
        } else {
            $('#next_level').hide();
        }

        if (building.upgrade_time_left > 0) {
            $('#time_left_container').show();
            $('#time_left').html(formatTime(building.upgrade_time_left));
        } else {
            $('#time_left_container').hide();
        }

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