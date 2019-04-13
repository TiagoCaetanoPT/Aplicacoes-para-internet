<?php
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DBO-MySQL - Retrieve Results All Fetch Modes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>DBO-MySQL - Retrieve Results All Fetch Modes</h1>
    <a href='../index.html#08mysqlpdo'>Back to the start</a>
    <hr>
    <p><strong>One Row</strong> retrieved using different Fetch Modes</p>
    <?php
    $pdo = dbConn();
    $stmt = $pdo->prepare('SELECT name, age FROM users');
    $stmt->execute();
    echo "<hr><h3>PDO::FETCH_BOTH (default mode)</h3>";
    $row = $stmt->fetch();
    var_dump($row);
    echo "<hr><h3>PDO::FETCH_NUM</h3>";
    $row = $stmt->fetch(PDO::FETCH_NUM);
    var_dump($row);
    echo "<hr><h3>PDO::FETCH_ASSOC</h3>";
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($row);
    echo "<hr><h3>PDO::FETCH_OBJ</h3>";
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    var_dump($row);
    echo "<hr><h3>PDO::FETCH_LAZY</h3>";
    $row = $stmt->fetch(PDO::FETCH_LAZY);
    var_dump($row);

    ?>
</body>
</html>