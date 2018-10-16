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
        
        if(isset($_GET["book"])){
            foreach ($db->query('SELECT book, chapter, verse, content FROM Scriptures') as     $row)
            {
                if($row['book'] == $_GET["book"]){
                      echo "<b> ".$row['book']." ".$row['chapter'].":".$row['verse']. "</b> - ";
                      echo '"'. $row['content'] . '"';
                      echo '<br/><br/>';
              }
            }
        }
        else
        {
            foreach ($db->query('SELECT book, chapter, verse, content FROM Scriptures') as $row)
            {
              echo "<b> ".$row['book']." ".$row['chapter'].":".$row['verse']. "</b> - ";
              echo '"'. $row['content'] . '"';
              echo '<br/><br/>';
            }
            }
        ?>

     </section>
    
</body>
</html>
