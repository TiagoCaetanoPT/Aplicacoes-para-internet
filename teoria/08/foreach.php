<?php
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DBO-MySQL - Retrieve Results with Forach</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>DBO-MySQL - Retrieve Results with Forach</h1>
    <a href='../index.html#08mysqlpdo'>Back to the start</a>
    <hr>
    <table>
        <thead></thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
            </tr>
        <tbody>
            <?php
            $pdo = dbConn();
            $stmt = $pdo->prepare('SELECT name, age FROM users');
            $stmt->execute();
            foreach ($stmt as $row) {
                echo "<tr>";
                echo "<td>$row[name]</td><td>$row[age]</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>    
</body>
</html>