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
        
        foreach ($db->query('SELECT book, chapter, verse, id FROM Scriptures') as     $row)
        {
            if(!isset($_GET["book"]) || $row['book'] == $_GET["book"]){
                echo '<a href="scripturedetails.php?id='.$row["id"].'"> '.
                    $row['book']." ".$row['chapter'].":".$row['verse']. "</a>";
                echo '<br/><br/>';
            }
        }
        ?>

     </section>
    
</body>
</html>
