var town_info = {};

$(document).ready(function () {
    paint();
});

function paint(){
    paintResources();
    paintBuildings();
}

function paintResources(){
    $("#amount_food").html(town_info.food);
    $("#amount_wood").html(town_info.wood);
    $("#amount_stone").html(town_info.stone);
    $("#amount_gold").html(town_info.gold);
}

function paintBuildings(){
    getData();
}

function getData(){
    $.ajax({
        type: 'GET',
        url: '/ajax/town',
        dataType: "json",
        success: function (data) {
            town_info = data;     
        },
        error: function(error) {
            console.log('Error: ' + error);
        },
        complete: function(data) {
            //Creation of the initial divs
            town_info.buildings.forEach(element => {      
                $(".main-game").append('<div class="building" id='+element.name.toLowerCase().replace(' ',"_")+' data-element-name='+element.name+' data-id='+element.building_level_id+'><h6 class='+element.name.toLowerCase().replace(' ',"_")+'>'+ element.name +'</h3></div>')
            });
            
            addEvents();
        }
    });
}

function addEvents(){
    $(".building").each(function () {
        $(this).hover(  
            function () {
                $(".nametag").text($(this).attr("data-element-name"));
                $(".nametag").show(100);
            },
            function(){
                $(".nametag").hide(100);
            }
        );

        $(this).click(function () {
            showInfo($(this).attr('data-id'));
        });
    });
    //When clicking outside of a div, hide the info box
    $(document).click(function (event) {
        if (!$(event.target).closest($(".building")).length) {
            $('#building_info').slideUp(300);
            $('#building_info').attr("data-buildingid", "");
        }
    });  
}

//Function that adds info to the info box
function showInfo(buildingId) {
    let info = $("#building_info");

    if ($(info).attr("data-buildingid") == buildingId) {
        $(info).attr("data-buildingid", "");
        $(info).slideUp(300);

    } else {
        $(info).slideUp(300, function () {
            //Write info inside of the div
            var buildings = town_info.buildings;
            let building = buildings.find(b => b.building_level_id == buildingId);
            $(info).attr("data-buildingid", buildingId);
            $("#info_name").html(building.name);
            $("#info_level").html(building.level);
            $("#info_power").html(building.power);

            $("#upgrade_level").html((building.level)+1);
            $("#food_cost").html(building.required_food);
            $("#wood_cost").html(building.required_wood);
            $("#stone_cost").html(building.required_stone);
            $("#gold_cost").html(building.required_gold);
            $("#th_req").html(building.level_town_hall);
            $("#construction_duration").html(building.upgrade_duration);
            //Show the div finally
            $(info).slideDown(300);
        });
    }
}
