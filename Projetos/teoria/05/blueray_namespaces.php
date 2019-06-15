<?php
   require_once "vendor/autoload.php";

    use meu\produto;  // The same as    use meu\produto as produto
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>BlueRay Class</title>
    </head>
    <body>
        <h1>BlueRay Class</h1>
        <h3>Using Namespaces</h3>
        <p>Check composer.json file</p>
        <a href='../index.html#05poo'>Back to the start</a>
        <hr>
        <p>
            <?php
                $blueray1 = new \meu\produto\BlueRay("47 Ronin", 46, 2013);

                echo "<hr>" . $blueray1;
                echo "<hr><br>get_class = " . get_class($blueray1);                    // Outputs BlueRay
                echo "<br>get_parent_class = " . get_parent_class($blueray1);      // Outputs Produto
                echo "<br>instanceof BlueRay = " . ($blueray1 instanceof BlueRay);         // Outputs "" (false)
                echo "<br>instanceof Produto = ". ($blueray1 instanceof Produto);  // Outputs "" (false)
                echo "<br>instanceof \meu\produto\BlueRay = " . ($blueray1 instanceof \meu\produto\BlueRay);         // Outputs 1 (true)
                echo "<br>instanceof \meu\produto\Produto = ". ($blueray1 instanceof \meu\produto\Produto);  // Outputs 1 (true)

                $blueray2 = new produto\BlueRay("Matrix", 49, 1999);
                
                echo "<hr>" . $blueray2;
                echo "<hr><br>get_class = " . get_class($blueray2);                    // Outputs BlueRay
                echo "<br>get_parent_class = " . get_parent_class($blueray2);      // Outputs Produto
                echo "<br>instanceof BlueRay = " . ($blueray2 instanceof BlueRay);         // Outputs "" (false)
                echo "<br>instanceof Produto = ". ($blueray2 instanceof Produto);  // Outputs "" (false)
                echo "<br>instanceof \meu\produto\BlueRay = " . ($blueray2 instanceof \meu\produto\BlueRay);         // Outputs 1 (true)
                echo "<br>instanceof \meu\produto\Produto = ". ($blueray2 instanceof \meu\produto\Produto);  // Outputs 1 (true)
            ?>
        </p>
    </body>
</html>
