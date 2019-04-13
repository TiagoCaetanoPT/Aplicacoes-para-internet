<?php
    header("Refresh: 2");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Header: Refresh Self</title>
</head>
<body>
    <h1>Header: Refresh Self</h1>
    <a href='../index.html#07headerscookiessessions'>Back to the start</a>
    <hr>
    <p>This page will automatically refresh every two seconds</p>
    <p>Current time = <?= date('H:i:s') ?> </p>   
</body>
</html>