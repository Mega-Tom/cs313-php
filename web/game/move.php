<?php
session_start();

if(! isSet($_SESSION["user"]))
{
    http_response_code(403);
    die();
}

require("_stratego.php");

$db = get_db();

$q = $db->prepare('select player1id, player2id, (select count(*) from move where gameid = game.id) as "count" from game where id = :gameid');
$q->bindValue(":gameid", $_POST["game"], PDO::PARAM_INT);
$q->execute();
$result = $q->fetchALL();

if(! isSet($result[0]))
{
    http_response_code(404); //nonexistent game
    die();
}
$seq = $result[0]["count"] + 1;

$next_color = array(RED, BLUE)[$seq % 2];
$next_player_id = array(RED => $result[0]["player1id"], BLUE => $result[0]["player2id"])[$next_color];

if($_SESSION["user"] != $next_player_id)
{
    error_log("GAME: user:".$_SESSION["user"]." cannot move for user:".$next_player_id);
    http_response_code(403);
    die();
}


$game = run_game($gameid);
try{
    $game->do_move($_POST["from"], $_POST["to"], $seq);
}catch(Exception $e) {
    error_log("GAME: ".$e->getMessage());
    http_response_code(400);
    die();
}

$q = $db->prepare("insert into move(fromsquare,tosquare,seq,gameid) values (:from, :to, :seq, :game)");
$q->bindValue(":from", $_POST["from"], PDO::PARAM_INT);
$q->bindValue(":to", $_POST["to"], PDO::PARAM_INT);
$q->bindValue(":seq", $seq, PDO::PARAM_INT);
$q->bindValue(":game", $_POST["game"], PDO::PARAM_INT);
$q->execute();

if($game->get_winner()){
    $state = $next_color == RED ? 'one_won' : 'two_won' ;
    $q = $db->prepare("UPDATE Game set state = :state WHERE id = :game");
    
    $q->bindValue(":state", $state, PDO::PARAM_STR);
    $q->bindValue(":game", $_POST["game"], PDO::PARAM_INT);
    $q->execute();
}