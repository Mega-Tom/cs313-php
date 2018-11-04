<?php
session_start();
require "_stratego.php";

$db = get_db();

$positions = $_POST["positions"];
$gameid = $_POST["game"];
$youid = $_SESSION["user"];

if(array_count_values($positions) != PIECE_SET){throw new Exception("invalid setup");}

$q = $db->prepare("select state, player2id, fliped from GameDouble where id = :gameid and player1id = :you");
$q->bindValue(":gameid", $gameid, PDO::PARAM_INT);
$q->bindValue(":you", $youid, PDO::PARAM_INT);
$q->execute();

$results = $q->fetchAll();

if(! isset($results[0])){throw new Exception("No game found");}

$results = $results[0];
$old_state = $results["state"];
$opponentid = $results["player2id"];
$fliped = $results["fliped"];

$offset = $fliped ? 41 : 1;

if($old_state == 'two_setup'){
    $new_state = 'playing';
}
elseif($old_state == 'no_setup'){
    $new_state = $fliped ? 'two_setup' : 'one_setup';
}
else {
    throw new Exception("You already setup! state:$old_state, fliped:$fliped");
}

$query_string = "UPDATE Game SET ";

foreach($positions as $i => $value){
    $oi = $offset + $i;
    $query_string .= "initalSetup[$oi] = $value, ";
}

$query_string .= "state = '$new_state' WHERE id = :gameid";
$q = $db->prepare($query_string);
$q->bindValue(":gameid", $gameid, PDO::PARAM_INT);
$q->execute();