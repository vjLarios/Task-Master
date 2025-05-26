<?php
// app/app.php

// 1. Carga configuración
require __DIR__ . '/config.php';

// 2. Carga clases principales
require __DIR__ . '/classes/Autoloader.php';
require __DIR__ . '/classes/Router.php';

// 3. Arranca el autoloader
$autoloader = new Autoloader();
$autoloader->register();

// 4. Instancia el router y defínelo como global
$router = new Router();

// Ruta de inicio
$router->add('GET', '/', 'HomeController@index');
// Listar tareas
$router->add('GET', '/tasks', 'TasksController@index');

