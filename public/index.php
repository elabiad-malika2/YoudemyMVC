<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Controllers\HomeController;
use App\Controllers\TagController;
use App\Core\Router;

$route = new Router();
$route->get('/aa', "HomeController","index");
$route->get('/dashboardAdmin', "HomeController","showAdmin");
$route->get('/dashboardAdmin', "TagController","show");
$route->post('/tag/create', "TagController","add");

$uri = str_replace('/YoudemyMVC/public', '', strtok($_SERVER['REQUEST_URI'], '?'));
$route->dispatch($uri);
?>