<?php
require_once './inc/funcoes.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>hello world</title>
    </head>
    <body>
        <a href='../index.html#03php'>Voltar ao ínicio</a>
        <hr>
        <?php
        require './inc/seccao1.php';
        ?>
        <p>
            Este ficheiro (teste_8.php) e o ficheiro './inc/seccao1.php' incluem (através da função require_once) o ficheiro './inc/funcoes.php'.
        </p>
        <p>
            Se em vez da função require_once fosse usada a função require ou include, o ficheiro './inc/funcoes.php' poderia ser incluido duas vezes, o que provocaria um erro - isto porque as funções só podem ser definidas uma vez.
        </p>
        <p>
            No ficheiro './inc/seccao1.php', experimente alterar a função require_once pela função require. Verifique o que acontece.
        </p>
        <p>No caso do ficheiro './inc/seccao1.php' este já pode ser incluido várias vezes, porque o objetivo do mesmo é criar uma secção que se pretende repetir N vezes. Apesar de usar uma função declarada noutro ficheiro, o ficheiro './inc/seccao1.php' não declara nenhuma função nova (se declarasse, não poderia ser usada a função require 2 vezes) 
        </p>
        
        <?php
        require './inc/seccao1.php';
        ?>
        
        
    </body>
</html>
