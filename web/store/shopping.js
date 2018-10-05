$("#store button").click(function(){
    $.post({
        url: "change_cart.php",
        data: {action: "add", product: this.value}, 
        success: function(){
            alert("Item Sucsefully added to cart");
        },
        error: function(){
            alert("You have encounterd an error");
        }
    });
    
});