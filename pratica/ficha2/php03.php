<!DOCTYPE html>
<html lang=pt dir="ltr">
<head>
  <meta charset="utf-8">
  <title>PHP: Prime numbers</title>

  <link rel="stylesheet" href="style.css">

</head>
<body>

  <h1>Exercicio 3</h1>


  <?php
  function  primos($n){

    for ($i=0; $i < $n; $i++) {

      $contar = 0;
      for ($j=1; $j<=$i; $j++) {
        if ($i % $j == 0) {
          $contar++;
        }
      }

      if ($contar == 2) {
        echo($i.",");
      }
    }
  }

  primos(100)
  ?>




</body>
</html>
