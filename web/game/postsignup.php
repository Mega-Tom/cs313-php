<?php
    session_start();
    require "dbConnect.php";
    $db = get_db();

    $name = strtolower($_POST["username"]);
    $pass = strtolower($_POST["password"]);
    $hash = password_hash($pass, PASSWORD_BCRYPT);
    
    
    
    $q = $db->prepare("select id FROM Player WHERE playername = :name");
    $q->bindValue(":name", $name, PDO::PARAM_STR);
    $q->execute();
    $result = $q->fetchAll();
    if(isset($result[0])){
        header("Location: signup.php?invalid=true");
        die();
    }
    
    $q = $db->prepare("INSERT INTO Player (playername, password) VALUES  (:name, :hash)");
    $q->bindValue(":name", $name, PDO::PARAM_STR);
    $q->bindValue(":hash", $hash, PDO::PARAM_STR);
    $q->execute();
    
    
    header("Location: login.php");