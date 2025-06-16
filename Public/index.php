<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Bramus\Router\Router;

session_start();

$router = new Router();

// Page d'accueil
$router->get('/', function () {
    $controller = new \App\Controllers\HomeController();
    $controller->index();
});


$router->run();
