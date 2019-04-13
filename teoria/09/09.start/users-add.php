<?php
require_once "vendor/autoload.php";

use Controllers\UserController;

$controller = new UserController;
$controller->addUser();
