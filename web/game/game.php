<?php
    session_start();
    require "_stratego.php";
    
    $player = get_player($_SESSION["user"], $_GET["id"]);
    if(!$player)
    {
        http_response_code(403);
        include('error.php'); 
        die();
    }
?>
<html>
<head>
    <title>Stratigo Online</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "header.php"; ?>
    
    <h1 class="center"> Stratigo Online </h1>
    
    <section id="main">
    <table class="board"><tbody>
<?php
    $board = board_position($_GET["id"]);
    foreach($board as $y => $row)
    {
        echo "<tr>";
        foreach($row as $x => $piece)
        {
            echo("<td>");
            if($piece)
            {
                if($piece->owner == $player)
                    echo($piece->value);
                else
                    echo("?");
            }
            echo("</td>");
        }
        echo "</tr>";
    }
?>
    </tbody></table>
    </section>
    
</body>
</html>

