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
