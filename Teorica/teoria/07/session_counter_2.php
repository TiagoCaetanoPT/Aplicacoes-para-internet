<?php
  session_start();
  $counter = $_SESSION['counter'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session: Counter 2</title>
</head>
<body>
    <h1>Session: Counter 2</h1>
    <a href='../index.html#07headerscookiessessions'>Back to the start</a>
    <hr>
    <p>This page will use a session variable to access the counter, but will not update its value</p>
    <p>Couter Value = <?= $counter ?></p>
    <p>Back to Session Counter page: (<a href="session_counter.php">session_counter.php</a>)</p>
</body>
</html>