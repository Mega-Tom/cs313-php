<?php
    session_start();
    
    require "good.php";
    
    if(! isset($_SESSION["cart"])){
        $_SESSION["cart"] = array();
    }
    $cart = $_SESSION["cart"];
?>
<html>
<head>
    <title>Cart</title>
    <link rel="stylesheet" href="../style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

    
    <h1 class="center glow"> Cart </h1>
    
    <section id="main">
    
        <div class="center nav">
            <a href="index.php">Back to shop</a>
            <a href="checkout.php">Checkout</a>
            <a href="#" id="clear">Clear cart</a>
        </div>
        
        <ul id="store">
        <?php
            foreach($cart as $id => $item){
                echo "<li>";
                $goods[$item]->display();
                echo "\n<button value='$id'>Remove</button>\n";
                echo "</li>";
            }
        ?>
        </ul>
    </section>
    
    <script src="cart.js"></script>
</body>
</html>
