    <?php
    $lines = ($_GET["linhas"]??'')?:10;
    $cols = ($_GET["colunas"]??'')?:10;
    $operation = ($_GET["operation"]??'')?:'*';

    $msgLinha="";
    if () {
        
    }

    //filter_var($lines, FILTER_VALIDATE_INT,
    //["options" => ["min_range" => 1, "max_range"=> 20]])

    // $lines and $columns will be available on php02.view.php

    // Add PHP code here

    require('php05.view.php');
    
    if (!empty($_GET['linhas']) || !empty($_GET['colunas'])){
        echo times_table_view($lines, $cols, $operation);
    }
    

    echo "<p class='error'> 'Linhas' têm que ser um caractere entre 1 e 20. </p>";
