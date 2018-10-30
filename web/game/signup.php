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
    
    <h1 class="center"> Stratigo Online: Signup </h1>
    
    <section id="main">
    <table class="board"><tbody>
        
        <form action="postsignup.php" method="post">
            Username: <input type="text" name="username"><br>
            Password: <input type="password" name="password"><br>
            Password: <input type="password" name="password2"><br>
            <input type="submit">
        </form>
        <?php if(isSet($_GET["invalid"]) && $_GET["invalid"] = "nameused"): ?>
                <p class="error">Username not available!</p>
        <?php endif; ?>
        <?php if(isSet($_GET["invalid"]) && $_GET["invalid"] = "nomatch"): ?>
                <p class="error">Passwords do not match!</p>
        <?php endif; ?>
    </tbody></table>
    </section>
    
</body>
</html>

