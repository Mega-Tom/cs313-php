<?php
    session_start();
    require "dbConnect.php";

    $you = $_SESSION["user"];
    $opponent_nmae = $_POST["username"];
    
    $db = get_db();
    
    $q = $db->prepare("select id from Player where Playername = :name");
    $q->bindValue(":name", $opponent_nmae, PDO::PARAM_STR);
    $q->execute();
    $result = $q->fetchAll();
    if(! isset($result[0])){
        header("Location: challenge.php?invalid=true");
        die();
    }
    $them = $result[0]["id"];
    
    $q = $db->prepare("insert into Request (challengerId, challengedId) values (:you, :them)");
    $q->bindValue(":you", $you, PDO::PARAM_INT);
    $q->bindValue(":them", $them, PDO::PARAM_INT);
    $q->execute();
    
    header("Location: index.php");
?>