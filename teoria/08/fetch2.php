<?php
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DBO-MySQL - Retrieve Results with Fetch - FETCH_OBJ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>DBO-MySQL - Retrieve Results with Fetch - FETCH_OBJ</h1>
    <a href='../index.html#08mysqlpdo'>Back to the start</a>
    <hr>
    <p>Fetch Mode = FETCH_OBJ</p>
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
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                echo "<tr>";
                // Each $row is an array with 2 alternatives keys (index or name)
                echo "<td>$row->name</td><td>$row->age</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>    
</body>
</html>