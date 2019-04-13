<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Form: submit to the same page</title>
</head>
<body>
    <h1>Form: submit to the same page</h1>
    <a href='../index.html#04forms'>Back to the start</a>
    <hr>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="get">
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
    <h1>Check:</h1>
    <p>Check what happens the first time the page is loaded. Try to find out why it happens.</p>
    <hr>
    <?= $_GET['age']?>
    <h3>$_GET</h3>
    <?php var_dump($_GET); ?>    
</body>
</html>
