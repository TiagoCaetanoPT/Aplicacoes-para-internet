<?php
if (empty($_POST)) {
    header('Location: insert.php');
    exit();
}

$name = $_POST["name"] ?? "";
$age = $_POST["age"] ?? "";

require_once "connection.php";

$pdo = dbConn();
$stmt = $pdo->prepare('insert into users (name, age) values (:name, :age)');
$stmt->execute(["name"=>$name, "age"=>$age]);

header('Location: query.php');
