
    
    <header>
        <a href="index.php">home</a>
        <?php if(isset($_SESSION["user"])): ?>
            <a href="logout.php">log out</a>
            <a href="challenge.php">issue challenge</a>
        <?php else: ?>
            <a href="login.php">log in</a>
            <a href="signup.php">sign up</a>
        <?php endif; ?>
    </header>