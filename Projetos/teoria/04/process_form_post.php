<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Process form: post method</title>
</head>
<body>
    <h1>Process form: post method</h1>
    <a href='../index.html#04forms'>Back to the start</a>
    <hr>
    <h3>Values inputted by the User</h3>
    <?php
    echo "<p>First name: ".$_POST["firstName"]."</p>\n";
    echo "<p>Age: ".$_POST["age"]."</p>\n";
    var_dump($_SERVER);
    ?>
</body>
</html>