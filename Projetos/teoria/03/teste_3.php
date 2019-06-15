<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Arrays</title>
    </head>
    <body>
        <h1>Arrays</h1>
        <a href='../index.html#03php'>Voltar ao ínicio</a>
        <hr>
        <h3>Indice numerico - 1</h3>
        <p>Os arrays podem definir um indice numérico de forma automática - neste caso, os índices começam por zero</p>
        <?php
        $cars = array("Saab","Volvo","BMW","Toyota");
        
        for ($i=0; $i<4; $i++) {
            echo "indice = $i, valor = ".$cars[$i]."<br>";
        }
        ?>
        <p>Os arrays "numericos" são similares aos arrays associativos. Têm a particularidade das chaves serem criadas automaticamente</p>
        <?php
        foreach ($cars as $key => $value) {
            echo "chave = $key, valor = $value<br>";
        }
        ?>
        <p>Para provar a afirmação anterior, veja a próxima secção de código e o resultado da execução do mesmo</p>
        <?php
        $cars["NovaChave"] = "Mercedes";
        foreach ($cars as $key => $value) {
            echo "Chave = $key, valor = $value<br>";
        }
        ?>
        <p>De seguida será apagado um dos elementos (Volvo) do Array</p>
        <?php
        unset($cars[1]);  // irá apagar o "Volvo"
        foreach ($cars as $key => $value) {
            echo "Chave = $key, valor = $value<br>";
        }
        ?>        
        <h3>Funções</h3> 
        Utilização de algumas funções para arrays
        <p>Total de elementos no array = <?php echo count($cars); ?></p>
        <p>O valor "Mercedes" existe ou não no array? Resposta = <?php echo in_array("Mercedes", $cars); ?></p>
        <p>O valor "Porsche" existe ou não no array? Resposta = <?php echo in_array("Porsche", $cars); ?></p>
        <p>A chave [0] existe ou não no array? Resposta = <?php echo array_key_exists(0, $cars); ?></p>
        <p>A chave [1] existe ou não no array? Resposta = <?php echo array_key_exists(1, $cars); ?></p>
        
        
        <h3>var_dump</h3> 
        <p>Array "completo": <b>var_dump($cars)</b></p>
        <?php
        var_dump($cars);
        ?>
        <p>Só as <b>chaves</b> do array: <b>var_dump(array_keys($cars))</b></p>
        <?php
        var_dump(array_keys($cars));
        ?>
        <p>Só os <b>valores</b> do array: <b>var_dump(array_values($cars))</b>
        <?php
        var_dump(array_values($cars));
        ?>
    </body>
</html>
