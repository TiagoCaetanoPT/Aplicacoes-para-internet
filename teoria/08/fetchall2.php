<?php
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DBO-MySQL - Retrieve Results with FetchAll</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>DBO-MySQL - Retrieve Results with FetchAll</h1>
    <a href='../index.html#08mysqlpdo'>Back to the start</a>
    <hr>
    <?php
    $pdo = dbConn();
    $stmt = $pdo->prepare('SELECT name, age FROM users');
    $stmt->execute();
    $result = $stmt->fetchAll();
    var_dump($result);
    ?>
</body>
</html>