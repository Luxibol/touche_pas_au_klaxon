<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use Bramus\Router\Router;

session_start();

$router = new Router();

// Page d'accueil
$router->get('/', function () {
    (new \App\Controllers\HomeController())->index();
});

// Connexion
$router->get('/login', function () {
    (new \App\Controllers\AuthController())->showLoginForm();
});
$router->post('/login', function () {
    (new \App\Controllers\AuthController())->login();
});

// Déconnexion
$router->get('/logout', function () {
    session_destroy();
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    header("Location: $base/");
    exit;
});

// Création de trajet
$router->get('/trajet/create', function () {
    (new \App\Controllers\TrajetController())->create();
});
$router->post('/trajet/create', function () {
    (new \App\Controllers\TrajetController())->store();
});

$router->run();
