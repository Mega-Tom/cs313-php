<?php
    session_start();
    $_SESSION["user"] = 1;
    require "dbConnect.php";
?>
<html>
<head>
    <title>Stratigo Online</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php require "header.php"; ?>
    
    <h1 class="center"> Stratigo Online </h1>
    
    <section id="main">
        
<?php 
    if(isset($_SESSION["user"])){
        $db = get_db();
        $q = $db->prepare(
            'SELECT p.playername "opponent", g.id "game" FROM GameDouble g ' .
                'JOIN player p ON player2Id = player.id ' .
                'WHERE player1Id = :player'
            );
        $q->bind(":player", $_SESSION["user"]);
        $q->execute();
        
        echo "<h2> Games: </h2>";
        echo "<ul>";
        foreach($q->fetchAll() as $row){
            $game = $row["game"];
            $opponent = $row["opponent"];
            echo "<li><a href='game.php?id=$game'> vs $opponent </a></li>";
        }
        echo "</ul>";
    }
?>
    </section>
    
</body>
</html>
