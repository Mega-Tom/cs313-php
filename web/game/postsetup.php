<?php
session_start();
require "_stratego.php";

if(array_count_values($positions) != PIECE_SET){throw new Exception("invalid setup");}

$db = get_db();

$positions = $_POST["positions"];
$gameid = $_POST["game"];
$youid = $_SESSION["user"];

$q = $db->prepare("select state, player2id, fliped from GameDouble where id = :gameid and player1id = :you");
$q->bind_value(":gameid", $gameid, PDO::PARAM_INT);
$q->bind_value(":you", $youid, PDO::PARAM_INT);
$q->execute();

$results = $q.fetchAll();

if(! isset($results[0])){throw new Exception("No game found");}

$old_state = $results["state"];
$opponentid = $results["player2id"];
$fliped = $results["fliped"];

$offset = $fliped ? 40 : 0;

if($old_state == 'one_setup' && $fliped){
    $new_state = 'playing';
}
elseif($old_state == 'two_setup' && !$fliped){
    $new_state = 'playing';
}
elseif($old_state == 'no_setup'){
    $new_state = $fliped ? 'two_setup' : 'one_setup';
}
else {
    throw new Exception("You already setup!");
}

$query_string = "UPDATE Game SET ";

foreach($positions as $i => $value){
    $oi = $offset + $i;
    $query_string .= "initalSetup[$oi] = $value, ";
}

$query_string .= "state = '$new_state' WHERE id = :gameid";
$q = $db->prepare($query_string);
$q->bind_value(":gameid", $gameid, PDO::PARAM_INT);
$q->execute();