<?php
    session_start();
?>
<html>
<head>
    <title>Stratigo Online</title>
    <link rel="stylesheet" href="style.css">
    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
</head>
<body>

<?php include "header.php"; ?>
    
    <h1 class="center"> Stratigo Online: Signup </h1>
    
    <section id="main">
        
        <form action="postsignup.php" method="post">
            Username: <input type="text" name="username"><br>
            Password: <input type="password" name="password"  id="p1"><br>
            Password: <input type="password" name="password2" id="p2"><br>
            <input type="submit">
        </form>
        <?php if(isSet($_GET["error"]) && $_GET["error"] == "nameused"): ?>
                <p class="error">Username not available!</p>
        <?php endif; ?>
        <?php if(isSet($_GET["error"]) && $_GET["error"] == "nomatch"): ?>
                <p class="error">Passwords do not match!</p>
        <?php endif; ?>
    </section>
    
    <script>
        $("#main form").on("submit", function(){
            if($("#p1").value() != $("#p2").value()){
                $("<span>").text("*").addClass("error").insertAfter($("#p2"));
                return false;
            }
            return true;
        });
    </script>
</body>
</html>
