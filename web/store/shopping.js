$("#store button").click(function(){
    $.post("buy.php", {product: this.value}, function(){
        alert("You bought it!");
    });
    
});