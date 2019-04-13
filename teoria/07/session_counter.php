<?php
  session_start();
  $counter = $_SESSION['counter'] ?? 0;
  $counter++;
  $_SESSION['counter'] = $counter;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session: Counter</title>
</head>
<body>
    <h1>Session: Counter</h1>
    <a href='../index.html#07headerscookiessessions'>Back to the start</a>
    <hr>
    <p>This page will use a session variable to store an access counter</p>
    <p>Couter Value = <?= $counter ?></p>
    <p>Other pages may also use the Session variable. Try this page: (<a href="session_counter_2.php">session_counter_2.php</a>)</p>
</body>
</html>