var town_info = {
    'resources': {
        'food': 0,
        'wood': 0,
        'stone': 0,
        'gold': 0
    },
    'buildings': []
};

$(document).ready(function () {
    
    $.ajax({
        type: 'GET',
        url: '/ajax/town',
        dataType: "json",
        headers: {
            'Access-Control-Allow-Origin': '*',
          },
        success: function (data) {
            console.log(data.food);
            town_info.resources.food = data.food;
            town_info.resources.wood = data.wood;
            town_info.resources.stone = data.stone;
            town_info.resources.gold = data.gold; 
            console.log(town_info.resources);

            data.buildings.forEach(element => {
                
                town_info.buildings.push({
                    'id': element.building_level_id,
                    'name': element.name,
                    'level': element.level,
                    'power': element.power,
                    'food': element.required_food,
                    'wood':  element.required_wood,
                    'stone': element.required_stone,
                    'gold': element.required_gold,
                    'town_hall': element.level_down_hall,
                    'duration': element.update_duration,
                    'sprite': element.sprite
                });
                
                $(".main-game").append('<div class="building" id='+element.name.toLowerCase().replace(' ',"_")+' element-name='+element.name+' data-id='+element.building_level_id+'><h6 class='+element.name.toLowerCase().replace(' ',"_")+'>'+ element.name +'</h3></div>')

            });

            //Interactions at clicking and hovering over buildings
            $(".building").each(function (index) {
                $(this).hover(  
                    function () {
                        $(".nametag").text($(this).attr("element-name"));
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

            $(document).click(function (event) {
                if (!$(event.target).closest($(".building")).length) {
                    $('#building_info').slideUp(300);
                    $('#building_info').attr("data-buildingid", "");
                }
            });
            
            console.log(town_info.buildings);
            paint();
        },
        error: function(error) {
            console.log('Error: ' + error);
        }
    });

});

//Function that adds info to the info box
function showInfo(buildingId) {
    let info = $("#building_info");

    if ($(info).attr("data-buildingid") == buildingId) {
        $(info).attr("data-buildingid", "");
        $(info).slideUp(300);

    } else {
        $(info).slideUp(300, function () {
            //Aqui cambiar info
            var array = town_info.buildings;
            var x = array.findIndex(x => x.id == buildingId);
            console.log(x);
            $(info).attr("data-buildingid", buildingId);
            $("#info_name").html(array[x].name);
            $("#info_level").html(array[x].level);
            $("#info_power").html(array[x].power);

            $("#upgrade_level").html((array[x].level)+1);
            $("#food_cost").html(array[x].food);
            $("#wood_cost").html(array[x].wood);
            $("#stone_cost").html(array[x].stone);
            $("#gold_cost").html(array[x].gold);
            $("#th_req").html(array[x].town_hall);
            $("#construction_duration").html(array[x].duration);

            $(info).slideDown(300);
        });
    }
}

function paint(){
    paintResources();
}

function paintResources(){
    console.log(town_info.resources.food);
    $("#amount_food").html(town_info.resources.food);
    $("#amount_wood").html(town_info.resources.wood);
    $("#amount_stone").html(town_info.resources.stone);
    $("#amount_gold").html(town_info.resources.gold);
}