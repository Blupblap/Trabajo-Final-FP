var town_info = {
    'resources': {
        'food': 0,
        'wood': 0,
        'stone': 0,
        'gold': 0
    },
    'buildings': [
        {
            'id': 1,
            'name': '',
            'level': 0,
            'power': 10,
            'food': 100,
            'wood': 100,
            'stone': 0,
            'gold': 0,
            'town_hall': 2,
            'duration': 1000
        }
    ]
};

$(document).ready(function () {
    //Interactions at clicking and hovering over buildings
    $(".building").each(function (index) {
        $(this).hover(function () {
            $(".nametag").text($(this).children(".building_name").text());
            $(".nametag").toggle(100);
        });

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

    //Ajax 
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

            $(info).attr("data-buildingid", buildingId);
            $(info).slideDown(300);
        });
    }
}