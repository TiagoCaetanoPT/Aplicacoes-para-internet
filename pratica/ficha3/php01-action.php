<?php
    $lines = ($_GET["linhas"]??'')?:10;
    $cols = ($_GET["colunas"]??'')?:10;
    require_once('html_helpers.php');
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP: Numbers tables | WS #3 | AINET</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>

    <body>
        <h1>Numbers Table</h1>
        <?= times_table_view($lines, $cols) ?>
    </body>
</html>
