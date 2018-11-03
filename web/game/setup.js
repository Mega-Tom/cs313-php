function swap(a, b) { //from https://stackoverflow.com/a/19033868/3990897
    a = $(a); b = $(b);
    var tmp = $('<span>').hide();
    a.before(tmp);
    b.before(a);
    tmp.replaceWith(b);
};

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

    $("table.board").swappable({items:"d.mobile"})
    var moblecells = $(".board").find("td.mobile");
    moblecells.draggable({
        containment: '.board',
        cursor: 'move',
        revert: true,
        stack: "td"
        });
    moblecells.droppable( {
        accept: '.board td',
        drop: function(event, ui){
            swap(ui.dragable, this);
        }
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
            if($(this).html() != ""){
                pieceSelected = $(this);
                $(this).addClass("active");
            }
        }
    });
})