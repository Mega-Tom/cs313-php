<?php
    session_start();
    
    if($_POST["action"] == "add"){
        $_SESSION["cart"][] = $_POST["product"];
    }else if($_POST["action"] == "remove"){
        array_splice($_SESSION["cart"], $_POST["index"], 1)
    }else if($_POST["action"] == "remove_all"){
        $_SESSION["cart"] = [];
    }
?>