<?php
    session_start();
    
    require "good.php";
    
    if(! isset($_SESSION["cart"])){
        $_SESSION["cart"] = array();
    }
?>
<html>
<head>
    <title>Shopping</title>
    <link rel="stylesheet" href="../style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

    
    <h1 class="center glow"> Store </h1>
    
    <section id="main">
        <p>
            What woluld you like to buy?
        </p>
        <ul id="store">
        <?php
            foreach($goods as $id => $good){
                echo "<li>";
                $good->display();
                echo "\n<button value='$id'>Buy</button>\n";
                echo "</li>";
            }
        ?>
        </ul>
    </section>
    
    <script src="shopping.js"></script>
</body>
</html>
