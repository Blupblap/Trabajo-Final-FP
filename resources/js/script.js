var buildings = $(".building");
var nametags = $(".nametag");
var currentInfo;
var previousCurrentInfo;

//Interactions at clicking and hovering over buildings
$(buildings).each(function(i){
    $("#"+buildings[i].id).hover(function () {
        $("#"+nametags[i].id).toggle("200");
        console.log("temporal");
    })
    $("#"+buildings[i].id).click(function () {
        console.log("pulsado temporal");
        currentInfo = buildings[i].id;
        showInfo(currentInfo);
    })
});


$(document).click(function (event) {
    if (!$(event.target).closest($(".building")).length
    ){
        $('.slide').slideUp("200");
        previousCurrentInfo = null;
    }
});

//Function that adds info to the info box
function showInfo(currentInfo){
    if(previousCurrentInfo == currentInfo){
        $(".slide").hide("200");
        previousCurrentInfo = null;
    }else{
        $(".slide").slideUp("200" , function(){

            //Div cwontent
            $("#buildingname").html(currentInfo);
    
    
            $(".slide").show("200");
            previousCurrentInfo = currentInfo;
        });
    }
    
}