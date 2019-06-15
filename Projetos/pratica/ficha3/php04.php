    <?php
    $lines = ($_POST["linhas"]??'')?:10;
    $cols = ($_POST["colunas"]??'')?:10;
    $operation = ($_POST["operation"]??'')?:'*';

    // $lines and $columns will be available on php02.view.php

    // Add PHP code here

    require('php04.view.php');
    
    if (!empty($_POST['linhas']) || !empty($_POST['colunas'])){
        echo times_table_view($lines, $cols, $operation);
    }
    

    