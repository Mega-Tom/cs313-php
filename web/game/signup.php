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
        <form action="signup.php" method="post">
            Username: <input type="text" name="username"><br>
            Password: <input type="password" name="password"><br>
            E-Mail:   <input type="email" name="email"><br>
        </form>
    </tbody></table>
    </section>
    
</body>
</html>

