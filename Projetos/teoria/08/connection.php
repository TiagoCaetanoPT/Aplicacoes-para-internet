<?php
$global_pdo_connection = null;
function dbConn()
{
    global $global_pdo_connection;
    if (!empty($global_pdo_connection)) {
        return $global_pdo_connection;
    }
    $host= 'localhost';
    $dbname= 'ainet_teoria';
    $user= 'homestead';
    $password= 'secret';
    $charset= 'utf8';
    $dsn= "mysql:host=$host;dbname=$dbname;charset=$charset";
    $opt= [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $global_pdo_connection = new PDO($dsn, $user, $password, $opt);
    return $global_pdo_connection;
}
