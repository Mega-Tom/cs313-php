$.ui.contains = $.contains; // hack nessisary for external library to work with newer jQuery

$(function(){
    $("table.board").swappable({items:"d.mobile", cursorAt:{top:-5}}})
})