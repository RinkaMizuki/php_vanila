<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\SessionMiddleware;
use App\Router;

$router = new Router();
// Home
$router->get('/', HomeController::class, 'index', [SessionMiddleware::class]);

//User
$router->get('/users', UserController::class, 'index', [SessionMiddleware::class, AuthMiddleware::class]);
$router->get('/users/create', UserController::class, 'getCreateUserForm', [SessionMiddleware::class, AuthMiddleware::class]);
$router->post('/users/create', UserController::class, 'postCreateUserForm', [SessionMiddleware::class, AuthMiddleware::class]);
$router->delete('/users/delete', UserController::class, 'deleteUser', [SessionMiddleware::class, AuthMiddleware::class]);
$router->get('/users/update', UserController::class, 'getUpdateUserForm', [SessionMiddleware::class, AuthMiddleware::class]);
$router->post('/users/update', UserController::class, 'postUpdateUserForm', [SessionMiddleware::class, AuthMiddleware::class]);

//Auth
$router->get('/login', AuthController::class, 'getLoginForm', [SessionMiddleware::class]);
$router->get('/register', AuthController::class, 'getRegisterForm', [SessionMiddleware::class]);
$router->get('/logout', AuthController::class, 'getLogoutUser', [SessionMiddleware::class]);
$router->post('/login', AuthController::class, 'postLoginUser', [SessionMiddleware::class]);
$router->post('/register', AuthController::class, 'postRegisterUser', [SessionMiddleware::class]);
$router->get('/auth/profile/:id', AuthController::class, 'getAuthProfile', [SessionMiddleware::class, AuthMiddleware::class]);
$router->post('/auth/profile/update', AuthController::class, 'postUpdateAuthProfile', [SessionMiddleware::class, AuthMiddleware::class]);

$router->dispatch();
