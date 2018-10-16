<?php
    session_start();
    
    require "good.php";
    
    if(! isset($_SESSION["cart"])){
        $_SESSION["cart"] = array();
    }
    $cart = $_SESSION["cart"];
    
    $name = htmlspecialchars($_POST["name"]);
    $adr1 = htmlspecialchars($_POST["adr1"]);
    $adr2 = htmlspecialchars($_POST["adr2"]);
    $city = htmlspecialchars($_POST["city"]);
    $state= htmlspecialchars($_POST["state"]);
    $zip  = htmlspecialchars($_POST["zip"]);
?>
<html>
<head>
    <title>Confirmation</title>
    <link rel="stylesheet" href="../style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

    
    <h1 class="center glow"> Confirmation </h1>
    
    <section id="main">
        <ul id="store">
        <?php
            $total = 0;
            foreach($cart as $item){
                echo "<li>";
                $goods[$item]->display();
                echo "</li>";
                $total += $goods[$item]->price;
            }
        ?>
        </ul>
        <?php
            echo money_format('<h4>For a total price of: $%i</h4>', $total);
            echo "<p>Will be shipped to:</p>";
            echo '<div class="address">';
            echo "$name <br>";
            echo "$adr1 <br>";
            if($adr2){
                echo "$adr2 <br>";
            }
            echo "$city, $state $zip<br>";
            echo "</div>";
        ?>
        <a href="index.php">Back to shop</a>
    </section>
    
    <script src="cart.js"></script>
</body>
</html>