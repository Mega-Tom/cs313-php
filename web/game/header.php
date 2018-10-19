
    
    <header>
        <a href="index.php">home</a>
        <?php
        if(isset($_SESSION["user"])){
            echo '<a href="logout.php">log out</a>';
        }
        else{
            echo '<a href="login.php">log in</a>';
            echo '<a href="signup.php">sign up</a>';
        }
        ?>
    </header>