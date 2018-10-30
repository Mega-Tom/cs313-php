<?php
    session_start();
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
    <table class="board"><tbody>
        
        <form action="postsignup.php" method="post">
            Username: <input type="text" name="username"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit">
        </form>
    </tbody></table>
    </section>
    
</body>
</html>

