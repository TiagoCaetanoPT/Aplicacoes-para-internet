<?php
    require_once "vendor/autoload.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>DVD Class v.4</title>
    </head>
    <body>
        <h1>DVD Class v.4</h1>
        <h3>Classes on separate files - Composer Autoload</h3>
        <p>Check composer.json file</p>
        <a href='../index.html#05poo'>Back to the start</a>
        <hr>
        <p>
            <?php
                $dvd1 = new DVD("47 Ronin", 25, 2013);
                echo $dvd1;

                $dvd2 = new DVD("Matrix", 25, 1999);
                echo "<br>get_class = " . get_class($dvd2);                    // Outputs DVD
                echo "<br>get_parent_class = " . get_parent_class($dvd2);      // Outputs Product
                echo "<br>instanceof DVD = " . ($dvd2 instanceof DVD);         // Outputs 1 (true)
                echo "<br>instanceof Product = ". ($dvd2 instanceof Product);  // Outputs 1 (true)
            ?>
        </p>
    </body>
</html>
