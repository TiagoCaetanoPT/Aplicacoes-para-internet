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
    <h1>Exercise 3</h1>
    <p>Go to <a href="index.html">index</a></p>
    <hr>
    <form action="php03.php" method="get">
        <div>
            <label>Lines</label>
            <input type="text" value="<?=$lines ?>" name="linhas">
        </div>
        <div>
            <label>Columns</label>
            <input type="text" value="<?=$cols ?>" name="colunas">
        </div>
        <div>
            <label>Operation</label>
            <select name="operation" id="operation">
                <option value="*" <?= $operation == "*"?"selected":"" ?>>Multiplication</option>
                <option value="+"<?= $operation == "+"?"selected":"" ?>>Addition</option>
                <option value="/"<?= $operation == "/"?"selected":"" ?>>Division</option>
                <option value="-"<?= $operation == "-"?"selected":"" ?>>Subtraction</option>
            </select>
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
    <hr>
    <ul class="shortcuts">
        <li><a href="php03.php?linhas=4&colunas=4">4 x 4</a></li>
        <li><a href="php03.php?linhas=5&colunas=10">5 x 10</a></li>
        <li><a href="php03.php?linhas=10&colunas=10">10 x 10</a></li>
    </ul>
    <hr>

</body>
</html>
