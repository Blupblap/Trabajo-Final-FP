var town_info = {};

$(document).ready(function () {
    if ($(".main-game").length) {
        getData();

        $(document).click(function (event) {
            if (!$(event.target).closest($(".building")).length) {
                $('#building_info').slideUp(300);
                $('#building_info').attr("data-buildingid", "");
            }
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
            animateResources();
        },
        error: function (error) {
            console.log('Error: ' + error);
        },
        complete: function () {
            paint();
        }
    });
}

function animateResources() {
    if (!town_info.buildings) { return }

    setInterval(() => {
        town_info.buildings.forEach(building => {
            town_info.food += building.food_per_minute;
            town_info.wood += building.wood_per_minute;
            town_info.stone += building.stone_per_minute;
            town_info.gold += building.gold_per_minute;
        });
        paintResources();
    }, 60000);
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
    if (!town_info.buildings) { return }
    
    town_info.buildings.forEach(building => {
        buildingDiv = $(document.createElement("div"))
            .addClass("building")
            .attr("id", building.name.toLowerCase().replace(' ', "_"))
            .attr("data-building-name", building.name)
            .attr("data-id", building.building_level_id)
            .append($(document.createElement("h6"))
                .addClass(building.name.toLowerCase().replace(' ', "_"))
                .text(building.name)
            );

        addEvents(buildingDiv);

        $(".main-game").append(buildingDiv)
    });
}

function addEvents(building) {
    building.hover(
        function () {
            $(".nametag").text($(this).attr("data-building-name"));
            $(".nametag").show(100);
        },
        function () {
            $(".nametag").hide(100);
        }
    );

    building.click(function () {
        showInfo($(this).attr('data-id'));
    });
}

function showInfo(buildingId) {
    let info = $("#building_info");

    if ($(info).attr("data-buildingid") == buildingId) {
        $(info).attr("data-buildingid", "");
        $(info).slideUp(300);

    } else {
        $(info).slideUp(300, function () {
            var buildings = town_info.buildings;
            let building = buildings.find(b => b.building_level_id == buildingId);

            $(info).attr("data-buildingid", buildingId);
            $("#info_name").html(building.name);
            $("#info_level").html(building.level);
            $("#info_power").html(building.power);

            $("#upgrade_level").html((building.level) + 1);
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
