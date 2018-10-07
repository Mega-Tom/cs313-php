<?php
    session_start();
    
    require "good.php";
    
    if(! isset($_SESSION["cart"])){
        $_SESSION["cart"] = array();
    }
    $cart = $_SESSION["cart"];
    
    $adr1 = htmlchars($_POST["adr1"]);
    $adr2 = htmlchars($_POST["adr2"]);
    $city = htmlchars($_POST["city"]);
    $state = htmlchars($_POST["state"]);
    $zip = htmlchars($_POST["zip"]);
?>
<html>
<head>
    <title>Cart</title>
    <link rel="stylesheet" href="../style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

    
    <h1 class="center glow"> Confirmation </h1>
    
    <section id="main">
        
        <ul id="store">
        <?php
            $total = 0;
            foreach($cart as $id => $item){
                echo "<li>";
                $goods[$item]->display();
                echo "</li>";
                $total += $item->price;
            }
        ?>
        </ul>
        <?php
            echo money_format('<h4>$%i</h4>', $total);
            echo '<div class="address">';
            echo "$name <br>";
            echo "$adr1 <br>";
            if($adr2){
                echo "$adr2 <br>";
            }
            echo "$city, $state $zip<br>";
            echo "</div>";
        ?>
    </section>
    
    <script src="cart.js"></script>
</body>
</html>