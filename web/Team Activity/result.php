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
                echo ": <a href='mailto:" . $_POST["email"] . "?body=" . $_POST["comments"] . "'>";
                echo "email</a>";
                echo "<br>comment: " . $_POST["comments"];
                echo "<br>major: " . $_POST["major"];
            }
        ?>
 
     </section>
    
</body>
</html>
