$("#clear").click(function(){
    $.post({
        url: "change_cart.php", 
        data: {product: this.value, action: "remove_all"}, 
        success: function(){
            document.location.pathname = "store/index.php";
        }
    });
});

$("#store button").click(function(){
    $.post({
        url: "change_cart.php",
        data: {product: this.value, action: "remove"}, 
        success: function(){
            alert("Item removed from cart");
            $(this).parent().parent().remove();
        },
        error: function(){
            alert("You have encounterd an error");
        }
    });
});