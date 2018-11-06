<?php
    session_start();
    require "dbConnect.php";
    require "_stratego.php";

    $you = $_SESSION["user"];
    $request = $_POST["request"];
    
    $db = get_db();
    
    $q = $db->prepare("SELECT challengerId FROM Request WHERE id = :request AND challengedId = :you");
    $q->bindValue(":request", $request, PDO::PARAM_INT);
    $q->bindValue(":you", $you, PDO::PARAM_INT);
    $q->execute();
    $result = $q->fetchAll();
    if(! isset($result[0])){
        header("Location: error.php");
        die();
    }
    $them = $result[0]["challengerid"];
    
    if($_POST["accept"]){
        $setup = '{' . random_valid_start_position().implode(',') . '}';
    
        $q = $db->prepare("INSERT INTO Game (player1Id, player2Id, state, initalSetup) VALUES (:you, :them, 'no_setup', :setup) RETURNING id");
        $q->bindValue(":you", $you, PDO::PARAM_INT);
        $q->bindValue(":them", $them, PDO::PARAM_INT);
        $q->bindValue(":setup", $setup, PDO::PARAM_str);
        $q->execute();
        $result = $q->fetchAll();
        
        if(! isset($result[0])){
            throw new Exception("Did not insert into database");
        }
        
        $gameid = $result[0]["id"];
        
        $q = $db->prepare("DELETE FROM Request WHERE id = :request");
        $q->bindValue(":request", $request, PDO::PARAM_INT);
        $q->execute();
        
        header("Location: setup.php?id=$gameid");
    }
    else
    {
        $q = $db->prepare("DELETE FROM Request WHERE id = :request");
        $q->bindValue(":request", $request, PDO::PARAM_INT);
        $q->execute();
        
        header("Location: index.php");
    }
