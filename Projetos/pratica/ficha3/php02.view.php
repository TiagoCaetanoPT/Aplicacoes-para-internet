<?php
    require_once('html_helpers.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP Forms: Submit to same file | WS #3 | AINET</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Exercise 2</h1>
    <p>Go to <a href="index.html">index</a></p>
    <hr>
    <form action="php02.php" method="get">
        <div>
            <label>Lines</label>
            <input type="text" name="linhas">
        </div>
        <div>
            <label>Columns</label>
            <input type="text" name="colunas">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
    <hr>
    <ul class="shortcuts">
        <li><a href="php02.php?linhas=4&colunas=4">4 x 4</a></li>
        <li><a href="php02.php?linhas=5&colunas=10">5 x 10</a></li>
        <li><a href="php02.php?linhas=10&colunas=10">10 x 10</a></li>
    </ul>
    <hr>
    
    <!-- XXXXX Add php code to "draw" (call times_table_view) the numbers table -->
</body>
</html>
