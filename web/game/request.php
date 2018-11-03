<?php
    session_start();
    require "dbConnect.php";
    
    $request = $_GET["id"];
    
    $db = get_db();
    $q = $db->prepare("SELECT  FROM Request r JOIN Player p ON p.id = r.challengedID where r.id = :id");
    $q->bindValue(":id", $request);
    $q->execute();
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
        <form action="postrequest.php" method="post">
            <input type="hidden" name="request" value="<?php echo $request; ?>">
            <input type="hidden" name="accept" value="true">
            <input type="submit" value="accept">
        </form>
        <form action="postrequest.php" method="post">
            <input type="hidden" name="request" value="<?php echo $request; ?>">
            <input type="hidden" name="accept" value="false">
            <input type="submit" value="reject">
        </form>
    </section>

    
</body>
</html>
