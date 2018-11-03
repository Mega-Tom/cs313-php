<?php
    session_start();
    require "dbConnect.php";
    
    $request = $_GET["id"];
    
    $db = get_db();
    $q = $db->prepare('SELECT you.playername "you", them.playername "them", you.id FROM Request r ' . 
                      'JOIN Player you ON you.id = r.challengedID '.
                      'JOIN Player them ON them.id = r.challengerID '.
                      'WHERE r.id = :id');
    $q->bindValue(":id", $request);
    $q->execute();
    
    $results = $q->fetchAll();
    
    if(! isSet($results[0])){
        include "error.php";
        die();
    }
    
    $results = $results[0];
    
    if($results["id"] != $_SESSION["user"]){
        include "error.php";
        die();
    }
    
    $you = $results["you"];
    $opp = $result["them"];
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
        <h2><?php echo $you; ?>, you have a request from: <?php echo $opp; ?></h2>
        <form action="postrequest.php" method="post" class="inline">
            <input type="hidden" name="request" value="<?php echo $request; ?>">
            <input type="hidden" name="accept" value="true">
            <input type="submit" value="accept">
        </form>
        <form action="postrequest.php" method="post" class="inline">
            <input type="hidden" name="request" value="<?php echo $request; ?>">
            <input type="hidden" name="accept" value="false">
            <input type="submit" value="reject">
        </form>
    </section>

    
</body>
</html>
