<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Process form: get method</title>
</head>
<body>
    <h1>Process form: get method</h1>
    <a href='../index.html#04forms'>Back to the start</a>
    <hr>
    <h3>Values inputted by the User</h3>
    <?php
    echo "<p>First name: ".$_GET["firstName"]."</p>\n";
    echo "<p>Age: ".$_GET["age"]."</p>\n";
    ?>
</body>
</html>
