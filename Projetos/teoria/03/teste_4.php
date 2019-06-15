<?php

function add($x, $y)
{
    $total = $x + $y;
    return $total;
}

function incrementa(&$valor, $incremento)
{
    $valor = $valor + $incremento;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Funções</title>
    </head>
    <body>
        <?php
        //Utilização da função Add
        $a = add(12, 5);
        echo "valor de a = add(12,5) = $a <br>";
        $a = add($a, 5);
        echo "valor de a = add(a,5) = $a <br>";
        incrementa($a, 10);
        echo "valor de a = incrementa(a,10) = $a <br>";
        ?>
        <hr>
        <a href='../index.html#03php'>Voltar ao ínicio</a>
    </body>
</html>
