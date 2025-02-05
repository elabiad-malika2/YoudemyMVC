<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Controllers\HomeController;
use App\Core\Router; 

$route = new Router();
$route->get('/', [HomeController::class, 'index']);

?>