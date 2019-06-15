<?php
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DBO-MySQL - Prepared Statement 3</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>DBO-MySQL - Prepared Statement 3</h1>
    <a href='../index.html#08mysqlpdo'>Back to the start</a>
    <hr>
    <p>Prepared Statement with a parameter (:age - named parameter).</p>
    <p>It will display all users that are less than 30 years old.</p>

    <table>
        <thead></thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
            </tr>
        <tbody>
            <?php
            $pdo = dbConn();
            $stmt = $pdo->prepare('SELECT name, age FROM users where age < :age');
            $stmt->execute(["age" => 30]);    // named parameter "age" = 30      (age < 30)
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