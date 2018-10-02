<html>
<head>
    <title>Thomas Peck</title>
    <link rel="../stylesheet" href="style.css">
</head>
<body>

    <h1 class="glow"> Enter information </h1>

    <section id="main">
 
        <form action="result.php" method="post">
            Name:   <input type="text"  name="name"><br>
            E-mail: <input type="email" name="email"><br>
            Major:  <br>
            <input type="Radio" name="major" value="CS">  Computer Science<br>
            <input type="Radio" name="major" value="WDD"> Web Design & Dev<br>
            <input type="Radio" name="major" value="CIT"> Computer IT<br>
            <input type="Radio" name="major" value="CE">  Computer Engenering<br>
            Comment: <textarea name="comments"></textarea><br>
            <input type="submit">
        </form>
 
     </section>
    
</body>
</html>
