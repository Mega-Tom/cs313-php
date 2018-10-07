$("#clear").click(function(){
    $.post({
        url: "change_cart.php", 
        data: {product: this.value, action: "remove_all"}, 
        success: function(){
            document.location.pathname = "store/index.php";
        }
    });
});

$("#store button").click(function(event){
    $.post({
        url: "change_cart.php",
        data: {index: this.value, action: "remove"}, 
        success: function(){
            $(event.target).parent().remove();
        },
        error: function(){
            alert("You have encounterd an error");
        }
    });
});