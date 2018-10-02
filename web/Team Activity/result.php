<html>
<head>
    <title>Thomas Peck</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1 class="glow"> Result </h1>

    <section id="main">
    
        <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo "Hello " . $_POST["name"];
                echo "<a href='mailto:" . $_POST["email"] . "?body=" . $_POST["comments"] . "'>";
                echo " email you</a>";
                echo "<br>" . $_POST["comments"];
                echo "<br>" . $_POST["major"];
            }
        ?>
 
     </section>
    
</body>
</html>
