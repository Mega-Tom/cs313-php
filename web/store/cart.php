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
        <?php
            foreach($cart as $item){
                $goods[$item]->display();
            }
        ?>
    </section>
    
    <script src="shopping.js"></script>
</body>
</html>
