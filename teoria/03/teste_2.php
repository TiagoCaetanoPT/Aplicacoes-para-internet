<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Variáveis</title>
    </head>
    <body>
        <h1>Variáveis</h1>
        <a href='../index.html#03php'>Voltar ao ínicio</a>
        <hr>
        <h3>Strings e concatenação</h3>
        <?php
        $x = 16;
        echo "O João tem <b>$x</b>anos <br>";
        echo 'A Maria tem <b>$x</b> anos <br>';
        echo "O João tem <b>" . $x . "</b> anos <br>";
        echo 'A Maria tem <b>' . $x . '</b> anos <br>';
        echo "Compare as 2 próximas linhas <br>";
        echo "O João tem <b>" . $x + 8 . "</b> anos <br>";
        echo "O João tem <b>" . ($x + 8) . "</b> anos <br>";
        $a = ["um","dois","três"];
        echo "valor do primeiro elemento do array a é $a[0]<br>";
        echo "valor do segundo elemento do array a é " . $a[1] . "<br>";
        $b = ["um"=>"one","dois"=>"two","três"=>"three"];
        // Following line will provoque a Parse error (syntax error)
        //echo "valor do primeiro elemento do array $b é $b['um']<br>";
        echo "valor do primeiro elemento do array b é $b[um]<br>";
        echo "valor do segundo elemento do array b é " . $b['dois'] . "<br>";
        ?>
        <h3>Datas e if</h3>
        <?php
        $d = time();
        echo "Data e hora atual = $d<br>";
        echo "Data e hora atual = ".date("d/m/Y", $d)."<br>";
        echo "Data e hora atual = ".date("D, d M Y - H:i:s", $d)."<br>";
        $d1 = date("D");
        if ($d1 == "Fri") {
            echo "Bom fim de semana!";
            echo "Até segunda!";
        } elseif ($d1 == "Mon") {
            echo "Bolas é segunda!";
        } else {
            echo "Bom dia!";
        }
        echo "<hr>Extrair informação da data:<br>";
        $d2 = getdate();
        echo $d2;   // Not valid, $d2 is an array. It is not a string nor convertible to a string
        print_r($d2);
        var_dump($d2);
        ?>
    </body>
</html>
