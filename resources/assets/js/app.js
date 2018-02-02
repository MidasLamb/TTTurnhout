
function toggleDetails(caller){
    var row = $(caller).closest(".details-row");
    var menu = row.find(".menu");
    row.find(".match-extra-details").each(function(){
        if($(this).is(":visible")){
        $(this).slideUp();
        menu.fadeOut(400, function(){
            menu.removeClass("glyphicon-menu-up");
            menu.addClass("glyphicon-menu-down")
            menu.fadeIn(400); 
        });
        
        } else {
        $(this).slideDown();
        menu.fadeOut(400, function(){
            menu.removeClass("glyphicon-menu-down");
            menu.addClass("glyphicon-menu-up")
            menu.fadeIn(400); 
        });
        }
    });
}

$(document).ready(function(){
    setTimeout(() => {
        $(".match-extra-details").each(function(){
        $(this).slideUp();
    });
    }, 1000);

});