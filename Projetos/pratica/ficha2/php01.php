<?php

  $string = "Hello World";
  $int = 12;
  $float = 5.8;
  $bool = true;

 ?>


<!DOCTYPE html>
<html lang=pt dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PHP: Using vars</title>
  </head>
  <body>

    <h1>Exercicio 1</h1>

    <p><?= $string; ?></p>
    <p><?php echo $int; ?></p>
    <p><?php echo $float; ?></p>
    <p><?php echo $bool; ?></p>

  </body>
</html>
