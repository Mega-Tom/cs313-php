<?php
    session_start();
    if(! isSet($_SESSION["user"]))
    {
        
        http_response_code(403);
        include("error.php");
        die();
    }
?>
<html>
<head>
    <title>Stratigo Online</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "header.php"; ?>
    
    <h1 class="center"> Stratigo Online </h1>
    
    <section id="main">
        <form action="postchallenge.php" method="post">
            Who would you like to chalenge? <input type="text" name="username"><br>
            <input type="submit">
        </form>
        <?php 
            if(isSet($_GET["invalid"]))
                echo("<p>That player does not exist!</p>")
        ?>
    </section>
    
</body>
</html>

