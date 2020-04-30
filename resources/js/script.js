var buildings = $(".building");
var currentInfo;
var previousCurrentInfo;

//Interactions at clicking and hovering over buildings
$(buildings).each(function(i){
    $("#"+buildings[i].id).hover(function () {
        //$("#"+popups[i].id).slideToggle("fast");
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
    }
});

//Function that adds info to the info box
function showInfo(currentInfo){
    if(previousCurrentInfo == currentInfo){
        $(".slide").hide("200");
    }else{
        $(".slide").hide("200" , function(){

            //Div content
            $("#buildingname").html(currentInfo);
    
    
            $(".slide").show("200");
            previousCurrentInfo = currentInfo;
        });
    }
    
}