<?php
  session_start();
  $flash_message = $_SESSION['flashmessage'] ?? "";
  unset($_SESSION['flashmessage']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Session: Flash Messages</title>
</head>
<body>
    <h1>Session: Flash Messages</h1>
    <a href='../index.html#07headerscookiessessions'>Back to the start</a>
    <hr>
    <?php
    if (!empty($flash_message)) {
        echo "<h3>$flash_message</h3><hr>";
    }
    ?>
    <form action="session_flashmsg_process.php" method="post">
        <div>
            <label for="firstName_id">First Name:</label>
            <input type="text" id="firstName_id" name="firstName">
        </div>
        <div>
            <label for="age_id">Age:</label>
            <input type="text" id="age_id" name="age">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
</body>
</html>