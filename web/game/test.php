<?php
    session_start();
    require "dbConnect.php";
?>
<html>
<head>
    <title>Stratigo Online</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "header.php"; ?>
    
    <h1 class="center"> Stratigo Online </h1>
    
    <section id="main">
<?php
    $db = get_db();
    $q = $db->prepare("SELECT numbers[1:8] FROM test");
    $q->Execute();
    
    foreach($q->fetchAll() as $k => $v) {
        echo "$k => ";
        var_dump($v);
        echo "<br>";
    }
?>
    </section>
    
</body>
</html>

