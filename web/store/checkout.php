<?php
    $states = array(
        "AL"=>"Alabama", "AK"=>"Alaska", "AZ"=>"Arizona", "AR"=>"Arkansas", "CA"=>"California",
        "CO"=>"Colorado", "CT"=>"Connecticut", "DE"=>"Delaware", "FL"=>"Florida", "GA"=>"Georgia",
        "HI"=>"Hawaii", "ID"=>"Idaho", "IL"=>"Illinois", "IN"=>"Indiana", "IA"=>"Iowa",
        "KS"=>"Kansas", "KY"=>"Kentucky", "LA"=>"Louisiana", "ME"=>"Maine", "MD"=>"Maryland",
        "MA"=>"Massachusetts", "MI"=>"Michigan", "MN"=>"Minnesota", "MS"=>"Mississippi",
        "MO"=>"Missouri", "MT"=>"Montana", "NE"=>"Nebraska", "NV"=>"Nevada", "NH"=>"New Hampshire",
        "NJ"=>"New Jersey", "NM"=>"New Mexico", "NY"=>"New York", "NC"=>"North Carolina",
        "ND"=>"North Dakota", "OH"=>"Ohio", "OK"=>"Oklahoma", "OR"=>"Oregon", "PA"=>"Pennsylvania",
        "RI"=>"Rhode Island", "SC"=>"South Carolina", "SD"=>"South Dakota", "TN"=>"Tennessee", 
        "TX"=>"Texas", "UT"=>"Utah", "VT"=>"Vermont", "VA"=>"Virginia", "WA"=>"Washington",
        "WV"=>"West Virginia", "WI"=>"Wisconsin", "WY"=>"Wyoming"
    )
?>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="../style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

    
    <h1 class="center glow"> Checkout </h1>
    
    <section id="main">
    
        <div class="center nav">
            <a href="index.php">Back to shop</a>
            <a href="checkout.php">Checkout</a>
            <a href="#" id="clear">Clear cart</a>
        </div>
        
        <h2>Enter shipping information:</h2>
        
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