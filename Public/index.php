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


$router->get('/trajet/edit/(\d+)', function ($id) {
    (new \App\Controllers\TrajetController())->edit($id);
});

$router->post('/trajet/edit/(\d+)', function ($id) {
    (new \App\Controllers\TrajetController())->update($id);
});

$router->post('/trajet/delete/(\d+)', function ($id) {
    (new \App\Controllers\TrajetController())->delete($id);
});

$router->post('/trajet/update/(\d+)', function ($id) {
    (new \App\Controllers\TrajetController())->update($id);
});

$router->post('/trajet/delete/(\d+)', function ($id) {
    (new \App\Controllers\TrajetController())->delete($id);
});

$router->get('/dashboard/users', function () {
    (new \App\Controllers\AdminController())->listUsers();
});

use App\Controllers\AdminController;

// Liste des agences
$router->get('/dashboard/agences', function () {
    (new \App\Controllers\AdminController())->listAgences();
});

// Formulaire de création d’une agence
$router->get('/dashboard/agences/create', function () {
    (new \App\Controllers\AdminController())->createAgenceForm();
});
$router->post('/dashboard/agences/create', function () {
    (new \App\Controllers\AdminController())->storeAgence();
});

// Formulaire de modification d’une agence
$router->get('/dashboard/agences/edit/(\d+)', function ($id) {
    (new \App\Controllers\AdminController())->editAgenceForm($id);
});
$router->post('/dashboard/agences/edit/(\d+)', function ($id) {
    (new \App\Controllers\AdminController())->updateAgence($id);
});

// Suppression d’une agence
$router->post('/dashboard/agences/delete/(\d+)', function ($id) {
    (new \App\Controllers\AdminController())->deleteAgence($id);
});



$router->run();
