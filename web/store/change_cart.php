<?php
    session_start();
    
    if($_POST["action"] == "add")
    {
        $_SESSION["cart"][] = $_POST["product"];
    }
    else if($_POST["action"] == "remove")
    {
        print gettype($_POST["index"]);
        array_splice($_SESSION["cart"], $_POST["index"], 1);
    }
    else if($_POST["action"] == "remove_all")
    {
        $_SESSION["cart"] = [];
    }
?>
