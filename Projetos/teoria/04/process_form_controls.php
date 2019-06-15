<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Process Form: form controls</title>
</head>
<body>
    <h1>Process Form: form controls</h1>
    <a href='../index.html#04forms'>Back to the start</a>
    <hr>
    <hr>
    <a href='form_controls.html'>Back to the form</a>
    <hr>
    <h3>$_POST</h3>
    <?php var_dump($_POST); ?>
    <h3>Checkboxs</h3>
    <h4>Active</h4>
    <p>Is Active = <?= $_POST['active']??'no'?></p>
    <h4>Courses</h4>
    <?php
        $courses = $_POST['courses']??[];
        var_dump($courses);
    ?>

</body>
</html>