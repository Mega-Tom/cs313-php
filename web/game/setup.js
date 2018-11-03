$.ui.contains = $.contains; // hack nessisary for external library to work with newer jQuery

$(function(){
    $("table.board").swappable({items:"td.mobile", cursorAt:{top:-5}});
})