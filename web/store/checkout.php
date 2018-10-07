<?php
    $states = array(
        "ID"=>"Idaho",
        "TX"=>"Texas",
        "UT"=>"Utah"
    )
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
        
        <form action="confirmation.php" method="POST">
            name: <input name="name">
            <br>adderess line 1:<input name="adr1">
            <br>adderess line 2:<input name="adr2">
            <br>state:
            <select name="state">
                <?php
                    foreach($states as $abv => $name){
                        echo "<option value='$abv'>$name</opton>";
                    }
                ?>
            </select>
            <br>city:<input name="city">
            <br>zip code:<input name="zip">
            <br> <input type="submit">
        </form>
        
    </section>
    
    <script src="cart.js"></script>
</body>
</html>