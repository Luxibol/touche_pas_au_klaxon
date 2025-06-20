<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Bramus\Router\Router;
use App\Controllers\{
    HomeController,
    AuthController,
    TrajetController,
    AdminController
};

session_start();

$router = new Router();

/**
 * Routes publiques
 */
$router->get('/', fn() => (new HomeController())->index());
$router->get('/login', fn() => (new AuthController())->showLoginForm());
$router->post('/login', fn() => (new AuthController())->login());
$router->get('/logout', function () {
    session_destroy();
    header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/');
    exit;
});

/**
 * Routes pour les trajets (utilisateur connecté)
 */
$router->get('/trajet/create', fn() => (new TrajetController())->create());
$router->post('/trajet/create', fn() => (new TrajetController())->store());
$router->get('/trajet/edit/(\d+)', fn($id) => (new TrajetController())->edit($id));
$router->post('/trajet/edit/(\d+)', fn($id) => (new TrajetController())->update($id));
$router->post('/trajet/delete/(\d+)', fn($id) => (new TrajetController())->delete($id));

/**
 * Routes administrateur
 */
$router->get('/dashboard/users', fn() => (new AdminController())->listUsers());

$router->get('/dashboard/agences', fn() => (new AdminController())->listAgences());
$router->get('/dashboard/agences/create', fn() => (new AdminController())->createAgenceForm());
$router->post('/dashboard/agences/create', fn() => (new AdminController())->storeAgence());
$router->get('/dashboard/agences/edit/(\d+)', fn($id) => (new AdminController())->editAgenceForm($id));
$router->post('/dashboard/agences/edit/(\d+)', fn($id) => (new AdminController())->updateAgence($id));
$router->post('/dashboard/agences/delete/(\d+)', fn($id) => (new AdminController())->deleteAgence($id));

$router->get('/dashboard/trajets', fn() => (new AdminController())->listTrajets());
$router->post('/dashboard/trajets/delete/(\d+)', fn($id) => (new AdminController())->deleteTrajet($id));

$router->run();
