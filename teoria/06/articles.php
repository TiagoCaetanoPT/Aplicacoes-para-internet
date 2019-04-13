<?php
require_once "vendor/autoload.php";

use Controllers\ArticleController;

$controller = new ArticleController;
$controller->getArticles();
