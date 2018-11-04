$.ui.contains = $.contains; // hack nessisary for external library to work with newer jQuery

var game_id = new URL(window.location.href).searchParams.get("id");

function textToVal(text){
    if(+text){
        return +text;
    }
    return {B:-1, F:-2, S:0}[text];
};

$(function(){
    $("table.board").swappable({
        items:"td.mobile",
        cursorAt:{top:-5}
    });
    $("#submit").click(function(){
        var positions = $("table.board tr").map(function(y, row){
            return $(row).children(".mobile").map(function(x, cell){
                return $(cell).text();
            }).get();
        }).get().flat().map(textToVal);
        $.ajax("postsetup.php", {
            method: "POST",
            data: {
                "positions[]": positions,
                game: game_id
            },
            success: function(){
                window.location = "game?id=" + game_id;
            },
            error: function(){
                alert("Error submitting move!");
            }
        })
    });
});