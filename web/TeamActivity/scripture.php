<?php
    require "dbconnect.php";
?>

<html>
<head>
    <title>Thomas Peck</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1 class="glow"> Scripture Resources </h1>

    <section id="main">
        <?php
        
        foreach ($db->query('SELECT book, chapter, verse, content FROM Scriptures') as $row)
        {
          echo "<b> ".$row['book']." ".$row['chapter'].":".$row['verse']. "</b> - ";
          echo '"'. $row['content'] . '"';
          echo '<br/>';
        }
        
        ?>

     </section>
    
</body>
</html>
