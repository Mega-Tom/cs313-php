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
                echo $_POST["name"];
            }
        ?>
 
     </section>
    
</body>
</html>
