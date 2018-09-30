<html>
<head>
    <title>Thomas Peck</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1 class="glow"> Thomas Peck </h1>

    <section id="main">
        <h2>Hello World!</h2>
        <p>
        I am Thomas Peck, a computer science student at BYU-Idaho. 
        I do dancing, singing and math.
        I also enjoy board games.
        </p>
        <table class="lights center">
            <tbody>
            <?php 
                for($i = 0; $i < 4; $i++){
                    echo "<tr>";
                    for($j = 0; $j < 4; $j++)
                    {
                        echo "<td><input type='checkbox' id='check$i$j'/>";
                        echo "<label for='check$i$j' /></td>";
                    }
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
        <h2>Other Stuff</h2>
        <p>
        <a href="assignments.php">My assignments for Web engenering II</a>.
        </p>
    </section>
    
</body>
</html>
