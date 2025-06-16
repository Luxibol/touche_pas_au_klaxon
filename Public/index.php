<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Bramus\Router\Router;

session_start();

$router = new Router();

// Route page d'accueil
$router->get('/', function () {
    (new \App\Controllers\HomeController())->index();
});

// Formulaire de connexion (GET)
$router->get('/login', function () {
    (new \App\Controllers\AuthController())->showLoginForm();
});

// Traitement du login (POST)
$router->post('/login', function () {
    (new \App\Controllers\AuthController())->login();
});

$router->get('/logout', function () {
    session_start(); // au cas où
    session_destroy();

    // Redirige proprement vers la racine du projet
    $base = dirname($_SERVER['SCRIPT_NAME']);
    $base = rtrim($base, '/\\');
    header("Location: $base/");
    exit;
});





$router->run();
