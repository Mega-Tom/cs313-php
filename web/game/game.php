<?php
    session_start();
    require "_stratego.php";
    
    $gameid = $_GET["id"];
    $playerid = $_SESSION["user"];
    
    $player = get_player($gameid, $playerid);
    $current = current_player($gameid);
    
    if(!$player)
    {
        error_log("GAME: user:".$playerid." cannot accses game:".$gameid);
        http_response_code(403);
        include('error.php'); 
        die();
    }
    if(!$current)
    {
        if(preg_match("/setup$/", gamestate($gameid))){
            header("Location: setup.php?id=$gameid");
            die();
        }
        if(preg_match("/won$/", gamestate($gameid))){
            include("error.php");
            die();
        }
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
    
    <?php if($current == $player): ?>
        <h3>Your turn:</h3>
    <?php else: ?>
        <h3>Wating for your opponent...</h3>
    <?php endif; ?>
    
    <table class="board"><tbody>
<?php
    $game = run_game($gameid);
    
    foreach($game->captured_pieces[BLUE] as $value -> $amount)
    {
        echo "<span class='blue piece'> $value </span> X $amount";
    }
    
    foreach($game->board as $y => $row)
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
    foreach($game->captured_pieces[RED] as $value -> $amount)
    {
        echo "<span class='red piece'> $value </span> X $amount";
    }
?>
    </tbody></table>
    </section>
<?php if($current == $player): ?>
    <script src="game.js" type="text/javascript"></script>
<?php endif; ?>
</body>
</html>

