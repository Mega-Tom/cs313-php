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
    
        <a href="search.php">
            Search...
        </a>
    
        <?php
        
        $q = 'SELECT book, chapter, verse, id FROM Scriptures';
        
        if(isset($_GET["book"])) $q = $q . " where book like '%" . $_GET["book"] . "%'";
        
        foreach ($db->query($q) as  $row)
        {
                echo '<a href="scripturedetails.php?id='.$row["id"].'"> '.
                    $row['book']." ".$row['chapter'].":".$row['verse']. "</a>";
                echo '<br/><br/>';
        }
        ?>

     </section>
    
</body>
</html>
