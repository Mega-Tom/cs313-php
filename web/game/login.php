<html>
<head>
    <title>Stratigo Online: log in</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php require "header.php"; ?>
    
    <h1 class="center"> Stratigo Online </h1>
    
    <section id="main">
        <form action="postlogin.php" method="post">
            Username: <input type="text" name="username"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit">
        </form> 
        <?php if(isSet($_GET["invalid"])): ?>
                <p class="error">Incorect username or password!</p>
        <?php endif; ?>
    </section>
    
</body>
</html>