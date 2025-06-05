<?php

use App\Route\Router;

$router = new Router();

// 🔐 Enregistrement des middlewares
$router->registerMiddleware('auth', function () {
    if (!isset($_SESSION['user'])) {
        header('Location: /public/login');
        return false;
    }
    return true;
});

$router->registerMiddleware('admin', function () {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        http_response_code(403);
        echo "Accès réservé aux administrateurs.";
        return false;
    }
    return true;
});

// 📌 Routes
$router->get('', 'HomeController@index');
// $router->get('profil', 'UserController@profil')->middleware('auth');
// $router->get('admin/dashboard', 'AdminController@index')->middleware('auth', 'admin');

$router->dispatch();
