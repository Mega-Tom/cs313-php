<?php
    session_start();
    require "dbConnect.php";

    $name = strtolower($_POST["username"]);
    
    $db = get_db();
    
    $q = $db->prepare("select id, password from Player where Playername = :name");
    $q->bindValue(":name", $name, PDO::PARAM_STR);
    $q->execute();
    $result = $q->fetchAll();
    
    if(! isset($result[0])){
        header("Location: login.php?invalid=true");
        die();
    }
    
    if(password_verify($_POST["password"], $result[0]["password"])){
        $_SESSION["user"] = $result[0]["id"];
    }
    
    header("Location: index.php");
?>