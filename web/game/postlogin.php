<?php
    session_start();
    require "dbConnect.php";

    $nmae = $_POST["username"];
    
    $db = get_db();
    
    $q = $db->prepare("select id from Player where Playername = :name");
    $q->bindValue(":name", $nmae, PDO::PARAM_STR);
    $q->execute();
    $result = $q->fetchAll();
    if(! $result[0]){
        header("Location: login.php?invalid=true");
        die();
    }
    $_SESSION["user"] = $result[0]["id"];
    
    header("Location: index.php");
?>