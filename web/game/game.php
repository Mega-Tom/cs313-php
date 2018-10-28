<?php
    session_start();
    require "_stratego.php";
    
    $gameid = $_GET["id"];
    $playerid = $_SESSION["user"];
    
    $player = get_player($gameid, $playerid);
    
    if(!$player)
    {
        error_log("GAME: user:".$playerid." cannot accses game:".$gameid);
        http_response_code(403);
        include('error.php'); 
        die();
    }
?>
<html>
<head>
    <title>Stratigo Online</title>
    <link rel="stylesheet" href="style.css">
    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
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
            echo("<td");
            if($piece)
            {
                echo(" class=" . ($piece->owner == RED ? '"red"':'"blue"') . ">");
                if($piece->owner == $player)
                    echo($piece->str());
            }
            else
            {
               echo(">");
            }
            echo("</td>");
        }
        echo "</tr>";
    }
?>
    </tbody></table>
    </section>
<?php if(current_player($gameid) == $player): ?>
    <script src="game.js" type="text/javascript"></script>
<?php 
    else: 
        error_log("GAME: current player:".current_player($gameid)."  active player:".$player);
    endif; 
?>
</body>
</html>

