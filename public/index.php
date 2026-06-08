<?php

declare(strict_types=1);
session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');


/*
|------------------------------------------------
-------------------------------------------------
-
| Load Autoloader
|------------------------------------------------
-------------------------------------------------
-
|
| Load the application's autoloader
so class can
| automatically be included when
instantiated.
|
*/

require_once __DIR__ . '/../app/core/Autoloader.php';
require_once __DIR__ . '/../app/core/Router.php';

/*
|-----------------------------------------------
------------------------------------------------
-
| Register Autoloader
|-----------------------------------------------
------------------------------------------------
-
*/

Autoloader::register();

/*
|-----------------------------------------------
------------------------------------------------
-
| Load Router.php
|-----------------------------------------------
------------------------------------------------
-
|
| If the autoloader works correctly,
PHP will automatically load Router.php
|
|
*/

require_once __DIR__ . '/../app/core/Router.php';

/*
|-----------------------------------------------
------------------------------------------------
-
| Define routes
|-----------------------------------------------
------------------------------------------------
-
*/

$router = new Router();
$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [HomeController::class, 'about']);
$router->get('/contact', [HomeController::class, 'contact']);
$router->post('/contact', [HomeController::class, 'contactSubmit']);
$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'store']);
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'authenticate']);
$router->post('/logout', [AuthController::class, 'logout']);
$router->get('/posts/{id}', [PostController::class, 'show']);
$router->get('/posts', [PostController::class, 'index']);
$router->get('/posts/create', [PostController::class, 'create']);
$router->post('/posts/store', [PostController::class, 'store']);
$router->get('/posts/edit/{id}', [PostController::class, 'edit']);
$router->post('/posts/update/{id}', [PostController::class, 'update']);
$router->post('/posts/delete/{id}', [PostController::class, 'delete']);
$router->post('/post/{id}/comment', [CommentController::class, 'store']);
$router->get('/comments/edit/{id}', [CommentController::class, 'edit']);
$router->post('/comments/update/{id}', [CommentController::class, 'update']);
$router->post('/comments/delete/{id}', [CommentController::class, 'delete']);

/*
|-----------------------------------------------
------------------------------------------------
-
| Run Router
|-----------------------------------------------
------------------------------------------------
-
*/

$router->dispatch();
