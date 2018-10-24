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
    $query_string = "SELECT numbers[1]";
    for($i = 2; $i <= 4; $i++) {
        $query_string = $query_string . ",numbers[$i]";
    }
    $query_string = $query_string." FROM test";
    $q = $db->prepare($query_string);
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

