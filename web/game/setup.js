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
})