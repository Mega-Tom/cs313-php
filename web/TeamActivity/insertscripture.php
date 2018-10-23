<?php
    require "dbconnect.php";
    
        
        $book = $_POST["book"];
        $chapter = $_POST["chapter"];
        $verse = $_POST["verse"];
        $content = $_POST["content"];
        
        $q = 'INSERT INTO Scriptures (book, chapter, verse, content) VALUES (:book, :chapter, :verse, :content)';
        
        $statment = $db->prepare($q);
        $statment->bindValue(":book", $book, PDO::PARAM_STR);
        $statment->bindValue(":chapter", $chapter, PDO::PARAM_INT);
        $statment->bindValue(":verse", $verse, PDO::PARAM_INT);
        $statment->bindValue(":content", $content, PDO::PARAM_STR);
        $statment->execute();
        header('Location: scripture.php');
?>
