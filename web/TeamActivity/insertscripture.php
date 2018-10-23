<?php
    require "dbconnect.php";
    
        
        $book = $_POST["book"];
        $chapter = $_POST["chapter"];
        $verse = $_POST["verse"];
        $content = $_POST["content"];
        
        $q = 'INSERT INTO Scriptures (book, chapter, verse, content) VALUES (:book, :chapter, :verse, :content)';
        
        $statment = $db->prepare($q);
        $statment->bindValues(":book", $book, PDO::PARAM_STR);
        $statment->bindValues(":chapter", $chapter, PDO::PARAM_INT);
        $statment->bindValues(":verse", $verse, PDO::PARAM_INT);
        $statment->bindValues(":content", $content, PDO::PARAM_STR);
        $statment->execute();
        header('Location: scripture.php');
?>
