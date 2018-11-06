function in_range(x1, y1, x2, y2) {
    if(x1 == x2){
        return y2 == y1 + 1 || y2 == y1 - 1;
    }
    else if(y1 == y2){
        return x2 == x1 + 1 || x2 == x1 - 1;
    }
    return false;
}

$(function(){

    $(".board tr").each(function(y, row){
        $(row).children().each(function(x, cell){
            $(cell).data("x", x).data("y", y);
        });
    });
    
    var pieceSelected = false;
    $(".board").on("click", "td", function(){
        if(pieceSelected){
            var fx = pieceSelected.data("x"),
                fy = pieceSelected.data("y"),
                tx = $(this).data("x"),
                ty = $(this).data("y");
            if(in_range(fx, fy, tx, ty)){
                $.ajax("move.php", {
                    method: "POST",
                    data: {
                        from: fx + 10 * fy,
                        to:   tx + 10 * ty,
                        game: new URL(window.location.href).searchParams.get("id")
                    },
                    success: function(){
                        location.reload();
                    },
                    error: function(){
                        alert("move invalid!");
                        pieceSelected.removeClass("active");
                        pieceSelected = false;
                    }
                });
            }
            else{
                pieceSelected.removeClass("active");
                pieceSelected = false;
            }
        }
        else{
            if($(this).html() != "" && $(this).html() != "Q" && $(this).html() != "F"){
                pieceSelected = $(this);
                $(this).addClass("active");
            }
        }
    });
})