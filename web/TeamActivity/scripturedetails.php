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
            
        foreach ($db->query('SELECT id, book, chapter, verse, content FROM Scriptures WHERE id='.$_GET["id"]) as $row){
                echo "<b> ".$row['book']." ".$row['chapter'].":".$row['verse']. "</b> - ";
                echo '"'. $row['content'] . '"';
        }
    ?>

     </section>
    
</body>
</html>
