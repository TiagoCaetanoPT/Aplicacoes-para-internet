<?php
  $counter = $_COOKIE['counter'] ?? 0;
  $counter++;
  // set a cookie called counter. Cookie expires after 300s
  setcookie('counter', $counter, time() + 300);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cookies: Counter</title>
</head>
<body>
    <h1>Cookies: Counter</h1>
    <a href='../index.html#07headerscookiessessions'>Back to the start</a>
    <hr>
    <p>This page will use a cookie to store an access counter (this context only)</p>
    <p>Couter Value = <?= $counter ?></p>
</body>
</html>