<?php
  session_start();
  $name = $_POST["firstName"] ?? "User";
  // Insert data on a DB

  $_SESSION['flashmessage'] = "Information about '$name' has been stored!";
  header("Location: session_flashmsg.php");
