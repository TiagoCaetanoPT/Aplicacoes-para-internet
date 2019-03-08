    <?php
    $lines = ($_GET["linhas"]??'')?:10;
    $cols = ($_GET["colunas"]??'')?:10;

    // $lines and $columns will be available on php02.view.php

    // Add PHP code here

    require('php02.view.php');
    
    if (!empty($_GET['linhas']) || !empty($_GET['colunas'])){
        echo times_table_view($lines, $cols);
    }
    

    