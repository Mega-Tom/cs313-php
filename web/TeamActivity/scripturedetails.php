<?php
    require "dbconnect.php";
?>

<html>
<head>
    <title>Scripture details</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1 class="glow"> Scripture details </h1>

    <section id="main">
    
    <?php
            
        foreach ($db->query('SELECT id, content FROM Scriptures') as $row){
            if($_GET["id"] == $row["id"])
                echo $row["content"];
        }
    ?>

     </section>
    
</body>
</html>
