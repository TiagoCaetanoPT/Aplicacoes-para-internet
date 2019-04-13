<?php
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DBO-MySQL - Prepared Statement 2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>DBO-MySQL - Prepared Statement 2</h1>
    <a href='../index.html#08mysqlpdo'>Back to the start</a>
    <hr>
    <p>Prepared Statement with a parameter (? - order parameter).</p>
    <p>It will display all users that are 30 or more years old.</p>

    <table>
        <thead></thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
            </tr>
        <tbody>
            <?php
            $pdo = dbConn();
            $stmt = $pdo->prepare('SELECT name, age FROM users where age >= ?');
            $stmt->execute([30]);  // first parameter = 30      (age >= 30)
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>$row[name]</td><td>$row[age]</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>    
</body>
</html>