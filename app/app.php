<?php
// app/app.php

// 1. Carga configuración
require __DIR__ . '/config.php';

// 2. Carga clases principales
require __DIR__ . '/classes/Autoloader.php';
require __DIR__ . '/classes/Router.php';
require __DIR__ . '/classes/DB.php';


// 3. Arranca el autoloader
$autoloader = new Autoloader();
$autoloader->register();

// 4. Instancia el router y defínelo como global
$router = new Router();

// Ruta de inicio
$router->add('GET', '/', 'HomeController@index');
// Listar tareas
$router->add('GET', '/tasks', 'TasksController@index');
// Formulario de creación
$router->add('GET',  '/tasks/create', 'TasksController@create');
// Almacenar nueva tarea
$router->add('POST', '/tasks',        'TasksController@store');
// Formulario de edición
$router->add('GET',  '/tasks/{id}/edit', 'TasksController@edit');
// Procesar edición
$router->add('POST', '/tasks/{id}',      'TasksController@update');
// Ver detalles de tarea
$router->add('GET',    '/tasks/{id}',     'TasksController@show');
// Eliminar tarea
$router->add('DELETE', '/tasks/{id}',     'TasksController@destroy');


