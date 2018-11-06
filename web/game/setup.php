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
    
    $state = gamestate($gameid);
    
    if(!($state == 'one_setup' && $player == BLUE ||
         $state == 'two_setup' && $player == RED  ||
         $state ==  'no_setup'))
    {
        error_log("GAME: cannot setup in progress game:".$gameid);
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
    <script
      src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
      integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
      crossorigin="anonymous"></script>
    <script src="https://storage.googleapis.com/google-code-archive-downloads/v2/code.google.com/jquery-swapable/jquery.ui.swappable.js"></script>
</head>
<body>

<?php include "header.php"; ?>
    
    <h1 class="center"> Stratigo Online </h1>
    
    <section id="main">
    
    <h3>Drag and drop pieces to change setup</h3>
    
    <table class="board"><tbody>
<?php
    $game = run_game($gameid);
    $board = $game->board;
    
    $yourclass = ($player == RED) ? '"red mobile"':'"blue mobile"';
    $theirclass = ($player == RED) ? '"blue"':'"red"';
    
    foreach($board as $y => $row)
    {
        echo "<tr>";
        foreach($row as $x => $piece)
        {
            echo("<td");
            if($piece)
            {
                echo(" class=" . ($piece->owner == $player ? $yourclass: $theirclass).">");
                if($piece->owner == $player){
                    echo($piece->str());
                }
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
    <button id="submit">Submit setup</button>
    </section>
    <script src="setup.js" type="text/javascript"></script></body>
</html>

