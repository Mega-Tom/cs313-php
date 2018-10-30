<?php
    session_start();
    require "dbConnect.php";
    $db = get_db();

    $name = strtolower($_POST["username"]);
    $pass = strtolower($_POST["password"]);
    $pass2 = strtolower($_POST["password2"]);
    $hash = password_hash($pass, PASSWORD_BCRYPT);
    
    if($pass != $pass2){
        header("Location: signup.php?invalid=nomatch");
        die();
    }
    
    
    $q = $db->prepare("select id FROM Player WHERE playername = :name");
    $q->bindValue(":name", $name, PDO::PARAM_STR);
    $q->execute();
    $result = $q->fetchAll();
    if(isset($result[0])){
        header("Location: signup.php?invalid=nameused");
        die();
    }
    
    $q = $db->prepare("INSERT INTO Player (playername, password) VALUES  (:name, :hash)");
    $q->bindValue(":name", $name, PDO::PARAM_STR);
    $q->bindValue(":hash", $hash, PDO::PARAM_STR);
    $q->execute();
    
    
    header("Location: login.php");