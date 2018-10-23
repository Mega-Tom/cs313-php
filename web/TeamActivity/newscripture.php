<?php
    require "dbconnect.php";
?>

<html>
<head>
    <title>New Scripture</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1 class="glow"> Add Scripture Resources </h1>

    <section id="main">
    
        <form action="insertscripture.php" method="post">
            Book: <input type="text" name="book"> <br>
            Chapter: <input type="text" name="chapter"> <br>
            verse: <input type="text" name="verse"> <br>
            content: <textarea name="book"></textarea> <br>
            <?php
            
            $q = 'SELECT name, id FROM Topics';
            
            foreach ($db->query($q) as $row)
            {
                $id = $row["id"];
                echo $row["name"] . ": ";
                echo "<input type='checkbox' name='topic[]' value='$id' />";
                echo '<br/>';
            }
            
            ?>
            <input type="submit">
        </form>
        
        <br/>
        

     </section>
    
</body>
</html>
