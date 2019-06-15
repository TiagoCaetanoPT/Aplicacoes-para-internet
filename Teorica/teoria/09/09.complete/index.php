<?php

require 'vendor/autoload.php';

use Api\Route;

$route = Route::defaultRoute();
$route->execute()->render();
