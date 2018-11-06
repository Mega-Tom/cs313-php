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
    
    $state = gamestate($gameid);
    if($state == 'one_setup' && $player == BLUE ||
       $state == 'two_setup' && $player == RED  ||
       $state == 'no_setup')
    {
        header("Location: setup.php?id=$gameid");
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
    
    <?php if($state == 'playing' && $current == $player): ?>
        <h3>Your turn:</h3>
    <?php elseif($state == 'one_won' && $player == RED || $state == 'two_won' && $player == BLUE): ?>
        <h3>You won!</h3>
    <?php elseif($state == 'two_won' && $player == RED || $state == 'one_won' && $player == BLUE): ?>
        <h3>You lost!</h3>
    <?php else: ?>
        <h3>Wating for your opponent...</h3>
    <?php endif; ?>
    
<?php
    $game = run_game($gameid);
    foreach($game->captured_pieces[BLUE] as $value => $amount)
    {
        echo "<span class='blue piece'> $value </span> X $amount";
    }
?>
    <table class="board"><tbody>
<?php
    
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
?>
    </tbody></table>
<?php
    foreach($game->captured_pieces[RED] as $value => $amount)
    {
        echo "<span class='red piece'>$value </span> X $amount";
    }
?>
    </section>
<?php if($state == 'playing' && $current == $player): ?>
    <script src="game.js" type="text/javascript"></script>
<?php endif; ?>
</body>
</html>
